<?php

require_once 'url.class.php';
require_once 'router.class.php';
require_once 'database.class.php';
require_once APP_DIR . '/controlers/front_controler.class.php';

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
		$route = $router->getRoute();
		$controlName = $route->getControlerName();
		$pageName = $route->getPageName();
		$templateName = lcfirst(str_replace("Controler", "", $controlName));

		$database = new Database($this->container->connection);
		$controler = new $controlName($url->query, $database, $templateName, $url->basePath, $router);
		$controler->action($pageName);
		$controler->render($pageName);
	}

}
