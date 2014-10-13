<?php

/**
 * Obecná template, která se stará o načítání view.
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Template {

	/** @var string Název templaty */
	private $viewName;

	/** @var array Proměnné templaty */
	private $vars = array();

	public function __construct($viewName) {
		$this->viewName = $viewName;
	}

	/**
	 * Obecný setter pro nastavení proměnných.
	 * @param string $name Název proměnné.
	 * @param mixed $value Hodnota proměnné.
	 */
	public function __set($name, $value) {
		$this->vars[$name] = $value;
	}

	function render() {
		$path = APP_DIR . '/views/' . $this->viewName . '.php';

		if (file_exists($path) == false) {
			throw new Exception('Template not found in ' . $path);
			return false;
		}

		// Načítání proměnných do templaty
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		include ($path);
	}

}
