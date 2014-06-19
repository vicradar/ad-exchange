<?php

namespace BrainBlast\JsonRpc;

class AdExchangeHandler extends JsonRpcHandlerBase
{
	protected $dbHandle;

	protected function __construct($db) 
	{
		parent::__construct();

		$this->dbHandle = $db;
	}

	protected function registerMethods()
	{
		$this->declareMethod('Get_AdList', array($this, 'getAdList'), json_encode(array(
			'platform' => 'iPhone'
			)));
	}

	protected function getAdList($params)
	{
		$query = "SELECT * "
		$statement = $this->dbHandle->prepare()

	}

	private function getFilesForPlatform($platform)
	{
		$query = 
			"SELECT identifier, adItemIdentifier, sourceUrl, usedAsPath, originalName, fileHash " . 
			"FROM AdFile "
			"WHERE "

	}

	private function getAdItemsForPlatform($platform)
	{
		$query = 
			"SELECT identifier, targetProtocol, rootFileIdentifier " .
			"FROM AdItem " .
			"WHERE %s = 1";
		$

	}

	private function getPlatformField
}