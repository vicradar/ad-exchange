<?php
define("DS", DIRECTORY_SEPARATOR);
define("DIR_BASE", realpath(__DIR__) . DS );
define("DIR_PUBLIC", realpath(__DIR__) . DS . "Public" . DS);
define("DIR_LIB", realpath(__DIR__) . DS . "Library" . DS);
define("DIR_TEMPLATES", realpath(__DIR__) . DS . "Templates" . DS);
define("DIR_DB_SCRIPTS", realpath(__DIR__) . DS . "DatabaseScripts" . DS);

spl_autoload_register(function($className) {
    $filename = DIR_LIB . str_replace('\\', DS, $className) . '.php';

    if(file_exists($filename))
    {
        require $filename;
    }

});

$dbHandle = new PDO('mysql:dbname=Test;host=localhost', 'root', 'root') OR die('Can\'t Connect to DB.');
$dbVersioner = new BrainBlast\Database\VersionedDatabase($dbHandle);

$dbVersioner->updateDatabase(1, DIR_DB_SCRIPTS . 'TestScript.%d.sql');
