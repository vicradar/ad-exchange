<?php

namespace BrainBlast\JsonRpc;

class TestRpcHandler extends JsonRpcHandlerBase
{
	protected function registerMethods()
	{
		$this->declareMethod('testMethod', array($this, 'testMethod'), json_encode(array(
			'test' => 'Enter a Test Param'
			)));
	}

	protected function testMethod($params)
	{
		return array(
			'firstKey' => 'firstValue', 
			'secondKey' => 'secondValue'
			);
	}
}