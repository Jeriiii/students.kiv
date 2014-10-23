<?php

require_once APP_DIR . '/application/template.class.php';

/**
 * Základní třída controler pro celou aplikaci
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Controler {

	/** @var Database Pro pr8ci s databází */
	protected $database;

	/** @var Template */
	protected $template;

	/** @var string Relativní cesta do adresáře WWW */
	protected $basePath;

	/** @var Router Routování adres */
	private $router;

	/** @var Query Parametry předané v adrese */
	public $query;

	/** @var PostParam Parametry předané v post požadavku */
	public $postParam;

	/** @var Messages Zprávy co se mají zobrazit příjemci */
	public $messages;

	public function __construct(PostParam $postParam, Query $query, Messages $messages, Database $database, $templateName, $basePath, $router) {
		$this->messages = $messages;
		$this->postParam = $postParam;
		$this->query = $query;
		$this->database = $database;
		$this->router = $router;
		$this->basePath = $basePath;
		$this->template = new Template($templateName, $basePath, $messages);
	}

	/**
	 * Přesměruje stránku na daný controller.
	 * @param string $controlerName Název kontroleru, na který se má stránka přesměrovat.
	 * @param string $pageName Název stránky, na kterou se má přesměrovat.
	 */
	protected function redirect($controlerName, $pageName = "") {
		if ($controlerName == "this") {
			$location = $this->getThisLocation();
		} else {
			$location = $this->getLocation($controlerName, $pageName);
		}

		header("Location: " . $location);
	}

	/**
	 * Vrátí lokaci, na které se uživatel nachází.
	 * @return string Aktuální lokace, na které se uživatel nachází.
	 */
	private function getThisLocation() {
		$currentRoute = $this->router->getRoute();
		$baseUrl = $currentRoute->getUrl();
		$pageName = $currentRoute->getPageName();

		$location = $this->basePath . $baseUrl . $pageName;

		return $location;
	}

	/**
	 * Vrátí lokaci podle názvu kontroleru a stránky
	 * @param string $controlerName Název kontroleru, na který se má stránka přesměrovat.
	 * @param string $pageName Název stránky, na kterou se má přesměrovat.
	 */
	private function getLocation($controlerName, $pageName = "") {
		$controlerLocation = $this->router->getControlerLocation($controlerName);

		// vytvoření nové lokace
		$location = $this->basePath . $controlerLocation;
		if ($pageName) {
			$location = $location . $pageName;
		}

		return $location;
	}

}
