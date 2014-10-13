<?php

require_once APP_DIR . '/controlers/FrontControler.php';
require_once APP_DIR . '/application/Application.php';
require_once APP_DIR . '/application/Route.php';
require_once APP_DIR . '/application/Container.php';

$container = new Container();

// TODO - zatím je adresa na tvrdo
$container->url = "http://students.kiv.zcu.cz/neco";

$container->addRoute(new Route("/admin/", "AdminControler"));
$container->addRoute(new Route("/", "FrontControler")); //když nespadne nikam jinam

$application = new Application($container);
$application->run();
