<?php

namespace BrainBlast\JsonRpc;

abstract class JsonRpcHandlerBase
{
	private $methods = array();

	abstract protected function registerMethods();

	public function declareMethod($methodName, $method, $default = '{ /* No Parameters */ }')
	{
		if (is_null($method)) {
			throw new \Exception("Method pointer is null in delcaration.");	
		}

		$this->methods[$methodName] = array(
			'name' => $methodName,
			'method' => $method,
			'default' => $default
		 );
	}

	public function __construct()
	{
		$this->registerMethods();
	}

	public function getMethodNames()
	{
		$result = array();
		foreach ($this->methods as $key => $value) {
			$result[] = $key;
		}

		return $result;
	}

	public function getDefaultForMethod($methodName)
	{
		return $this->methods[$methodName]['default'];
	}

	public function getMethodInfo() 
	{
		$result = array();
		foreach ($this->methods as $value) {
			$result[$value['name']] = $value['default'];
		}
		return $result;
	}

	public function executeMethod($methodName, array $params)
	{
		$methodInfo = $this->methods[$methodName];
		if (is_null($methodInfo)) {
			throw new \Exception("Not a known method: $methodName.");
		}

		$method = $methodInfo['method'];
		if (is_null($method)) {
			throw new \Exception("Method pointer is null.");
			
		}

		return call_user_func($method, $params);
	}

	public function handleRequest($msgBody)
	{
		$json = json_decode($msgBody, true);
		if (is_null($json)) {
			$err = json_last_error();
			return json_encode(array(
				'success' => false,
				'error' => self::messageForJsonError($err),
				'details' => $msgBody
				));
		}

		$id = $json['id'];
		$method = $json['method'];
		$params = $json['params'];
		if (is_null($id) || is_null($method) || is_null($params)) {
			return json_encode(array(
				'success' => false,
				'error' => 'Malformed Request'
				));
		}

		try {
			$result = $this->executeMethod($method, $params);
			return json_encode(array(
				'id' => $id,
				'success' => true,
				'result' => $result
				));
		}
		catch (\Exception $e)
		{
			return json_encode(array(
				'id' => $id,
				'success' => false,
				'error' => $e->getMessage()
				));
		}
	}

	public static function messageForJsonError($errorCode) 
	{
		switch ($errorCode) {
			case JSON_ERROR_NONE:
				return "Not an error";
			case JSON_ERROR_DEPTH:
				return "JSON data too deep";
			case JSON_ERROR_STATE_MISMATCH:
				return "Malformed JSON";
			case JSON_ERROR_CTRL_CHAR:
				return "Incorrect encoding";
			case JSON_ERROR_SYNTAX:
				return "Syntax error";
			case JSON_ERROR_UTF8:
				return "Invalid UTF8 characters";
			case JSON_ERROR_RECURSION:
				return "Recursion Error";
			case JSON_ERROR_INF_OR_NAN:
				return "Invalid values";
			case JSON_ERROR_UNSUPPORTED_TYPE:
				return "Unsupported Type";

		}
	}
}
