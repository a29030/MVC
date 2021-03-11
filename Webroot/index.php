<?php
define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
require_once "../vendor/autoload.php";
use MVC\Dispatcher;
use MVC\Request;
use MVC\Router;
$dispatch = new Dispatcher();
$dispatch->dispatch();

