<?php
//initialization. to be included atop all pages
session_start();

//require __DIR__ . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mvcblog/vendor/autoload.php';

$GLOBALS['config'] = array (
	'mysql' => array(
		'host' => '127.0.0.1',
		'port' => '80',
		'username' => 'root',
		'password' => '',
		'db' => 'mvcblog'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token',
		'user' => 'loggedIn'
	)
);
require_once 'functions/Sanitize.php';
require_once 'functions/Getconfig.php';

$path = '/mvcblog/';

define('URL', $path);

$controllerPath = 'classes/controllers/';

$dashboard = $posts = $users = $profile = $webpages = $comments = '';

define('CTRL_PATH', $controllerPath)

?>