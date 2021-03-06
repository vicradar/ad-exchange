<?php

require_once('../config.php');
use BrainBlast\JsonRpc\AdExchangeHandler;

$handler = new AdExchangeHandler($dbHandle);

if ($_SERVER['REQUEST_METHOD']=='POST') {
	$entityBody = file_get_contents('php://input');
	echo $handler->handleRequest($entityBody);
} else {
	$methods = $handler->getMethodInfo();
	$title = "TestRpc Test Interface";
	include(DIR_TEMPLATES . 'JsonRpc.tmpl');
}
