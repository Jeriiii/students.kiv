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

	/** @var array Parametry předané v adrese */
	public $query;

	public function __construct(array $query, Database $database, $templateName, $basePath, $router) {
		$this->query = $query;
		$this->database = $database;
		$this->router = $router;
		$this->basePath = $basePath;
		$this->template = new Template($templateName, $basePath);
	}

	/**
	 * Přesměruje stránku na daný controller.
	 * @param string $controlerName Název kontroleru, na který se má stránka přesměrovat.
	 * @param string $pageName Název stránky, na kterou se má přesměrovat.
	 */
	protected function redirect($controlerName, $pageName = "") {
		$controlerLocation = $this->router->getControlerLocation($controlerName);

		$location = $this->basePath . $controlerLocation;
		if ($pageName) {
			$location = $location . $pageName;
		}

		header("Location: " . $location);
	}

}
