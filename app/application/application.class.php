<?php

require_once 'url.class.php';
require_once 'router.class.php';
require_once 'database.class.php';
require_once 'post_param.class.php';
require_once 'messages.class.php';
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

	/**
	 * Spustí aplikaci - zjistí jakou používá routu a podle ní spustí příslušný controler
	 */
	public function run() {
		$this->init();

		$container = $this->container;

		$route = $container->router->getRoute();
		$postParam = $this->getPostParam($_POST);
		$messages = new Messages();

		$controlName = $route->getControlerName();
		$pageName = $route->getPageName();
		$templateName = lcfirst(str_replace("Controler", "", $controlName));

		$database = new Database($this->container->connection);
		$url = $this->container->url;
		$controler = new $controlName($postParam, $url->query, $messages, $database, $templateName, $url->basePath, $container->router);
		$controler->action($pageName);

		$controler->checkSubmitForm();
		die();
		$controler->render($pageName);
	}

	/**
	 * Nastaví prostředí pro běh samotné aplikace.
	 */
	private function init() {
		$container = $this->container;

		$container->url = new Url($container->url);
		$container->router = new Router($container->getRoutes(), $this->container->url);
	}

	/**
	 * Vrátí post požadavky uložené v přepravce.
	 * @param array $postParams Post parametry.
	 */
	private function getPostParam($postParams) {
		$postParam = new PostParam($postParams);

		foreach ($postParams as $name => $post) {
			$postParam->$name = $post;
		}

		return $postParam;
	}

	public function getSession($sessionParam) {
		$session = new Session();

		foreach ($sessionParam as $name => $param) {
			$session->$name = $param;
		}

		return $session;
	}

}
