<?php

namespace BrainBlast\Database;

use \Exception;
use \PDO;

class VersionedDatabase 
{
	private $dbHandle;

	public $versionTable = '__Version';
	private $updateStatement;

	public function __construct($dbHandle)
	{
		$this->dbHandle = $dbHandle;
	}

	public function updateDatabase($targetVersion=-1, $scriptTemplate=null)
	{
		$version = $this->getCurrentVersion();

		while ($version < $targetVersion) 
		{
			$version += 1;
			$scriptName = sprintf($scriptTemplate, $version);
			$this->dbHandle->beginTransaction();
			$success = $this->executeScript($scriptName);
			if ($success) {
				$success = $this->writeVersionRecord($version);
			}
			if ($success) {
				$this->dbHandle->commit();
			} else {
				$this->dbHandle->rollBack();
				throw new Exception("Error executing database update script.");
			}
		}
	}

	protected function tableExists($tableName)
	{
		$statement = $this->dbHandle->prepare("SHOW TABLES LIKE ?");
		$statement->bindValue(1, $tableName, PDO::PARAM_STR);
		$statement->execute();
		$rowCount = $statement->rowCount();
		return $rowCount > 0;
	}

	protected function createVersionTable()
	{
		$query = 
			"CREATE TABLE $this->versionTable (" .
			"id INT(11) PRIMARY KEY AUTO_INCREMENT, " .
			"version INT(11) NOT NULL, " . 
			"applied TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP " .
			");";
		$rows = $this->dbHandle->exec($query);
		if ($rows===false) {
			throw new Exception("Failed to create version table.");
		}

		return true;		
	}

	public function writeVersionRecord($version)
	{
		if (!$this->updateStatement) {
			$query = 
				"INSERT INTO $this->versionTable (version) " .
				"VALUE (?)";

			$this->updateStatement = $this->dbHandle->prepare($query);
			if (!$this->updateStatement) {
				throw new Exception("Error preparing statement for version record. Code: " . $this->dbHandle->errorCode());
			}

		}

		$this->updateStatement->bindValue(1, $version, PDO::PARAM_INT);

		$success = $this->updateStatement->execute();

		if (!$success) {
			return false;
		}

		return true;
	}

	public function getCurrentVersion()
	{
		if (!$this->tableExists($this->versionTable)) {
			$this->createVersionTable();
		}
		$currentVersion = -1;

		$query = 
			"SELECT MAX(version) " .
			"FROM $this->versionTable ";
		$rs = $this->dbHandle->query($query);
		while ($row = $rs->fetch()) {
			$value = array_values($row)[0];
			if ($value===null) {

			} else {
				$currentVersion = $value;
			}
		}
		return $currentVersion;
	}

	public function executeScript($fileName)
	{
		$lines = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		if ($lines===false) {
			throw new Exception("Database upgrade script file missing.");			
		}

		$success = true;

		$query = "";
		foreach ($lines as $singleLine) {
			if ($singleLine=='----') {
				if (strlen($query)) {
					$success = $this->executeUpdate($query);
				}
				$query = "";
				if (!$success) {
					break;
				}
			} else {
				if (strlen($query) > 0) {
					$query = $query . " ";
				}
				$query = $query . ' ' . $singleLine;
			}
		}

		if (strlen($query) > 0) {
			$success = $this->executeUpdate($query);
		}

		return $success;
	}

	protected function executeUpdate($query) 
	{
		$statement = $this->dbHandle->prepare($query);
		if (!$statement) {
			return false;
		}

		$success = $statement->execute();
		return $success;
	}
}