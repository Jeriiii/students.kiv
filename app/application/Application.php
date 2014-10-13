<?php

require_once 'Url.php';
require_once 'Router.php';
require_once APP_DIR . '/controlers/FrontControler.php';

/**
 * Stará se o spuštění celé aplikace.
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Application {

	/** @var Container Přepravka na proměnné. */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function run() {
		$container = $this->container;
		$url = new Url($container->url);
		$router = new Router($container->getRoutes(), $url);
		$controlName = $router->getControlerName();

		$controler = new $controlName;
		$controler->render();
	}

}
