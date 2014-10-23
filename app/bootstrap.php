<?php

require_once APP_DIR . '/controlers/front_controler.class.php';
require_once APP_DIR . '/application/application.class.php';
require_once APP_DIR . '/application/route.class.php';
require_once APP_DIR . '/application/container.class.php';
require_once APP_DIR . '/application/connection.class.php';

$container = new Container();

// načítání url
$container->url = array_key_exists("q", $_GET) ? $_GET["q"] : "/";

$connection = new Connection("mysql", "localhost", "students_kiv", "root", "root");
$container->connection = $connection;

$container->addRoute(new Route("/admin/", "AdminControler"));
$container->addRoute(new Route("/", "FrontControler")); //když nespadne nikam jinam

session_start();

$application = new Application($container);
$application->run();
