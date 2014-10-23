<?php

require_once 'box.class.php';

/**
 * Slouží k přenášení hodnot mezi třídami
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Container extends Box {

	/** @var array Zaznamenané routy */
	private $routes = array();

	/**
	 * Přidá další routu
	 * @param Route $route Routa.
	 */
	public function addRoute(Route $route) {
		$this->routes[] = $route;
	}

	public function getRoutes() {
		return $this->routes;
	}

}
