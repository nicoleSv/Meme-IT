<?php 

$host = 'localhost';
$db_name = 'www_61987';
$username = 'root';
$password = '';

$root = '/MemeIt/';
$rootPath = $_SERVER['DOCUMENT_ROOT'].$root;
$controllersPath = $rootPath.'controllers/';
$modelsPath = $rootPath.'models/';
$viewsPath = $rootPath.'views/';

$method = $_SERVER['REQUEST_METHOD'];
$filename = $_SERVER['SCRIPT_NAME'];
$full_url = $_SERVER['REQUEST_URI'];
$url = str_replace($filename,'',$full_url);
$location = $_SERVER['REQUEST_SCHEME'].'://'. $_SERVER['SERVER_NAME'].$root;

// Define constants
define('ROOT', $root);
define('CONTROLLERS_DIR', $controllersPath);
define('MODELS_DIR', $modelsPath);
define('VIEWS_DIR', $viewsPath);

define('HTTP_METHOD', $method);
define('URL', $url);
define('LOCATION', $location);

// Database config
define('DB_HOST', $host);
define('DB_NAME', $db_name);
define('DB_USER', $username);
define('DB_PASS', $password);

?>