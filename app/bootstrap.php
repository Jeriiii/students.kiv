<?php

require_once APP_DIR . '/config/config.php';

/* autoloading */

function __autoload($className) {
	$class_name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $className));
	$autoload[] = APP_DIR . "/application/$class_name.class.php";
	$autoload[] = APP_DIR . "/controlers/$class_name.class.php";
	$autoload[] = APP_DIR . "/models/$class_name.class.php";
	foreach ($autoload as $path) {
		if (file_exists($path)) {
			require_once($path);
		}
	}
}

$container = new Container();
// načítání url
$container->url = array_key_exists("q", $_GET) ? $_GET["q"] : "/";

$connection = new Connection(DB_DRIVER, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$container->connection = $connection;

$container->addRoute(new Route("/admin/", "AdminControler"));
$container->addRoute(new Route("/", "FrontControler")); //když nespadne nikam jinam

session_start();

$application = new Application($container);
$application->run();
