<?php

/**
 * Slouží k přenášení hodnot mezi třídami
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Container {

	/** @var array Zaznamenané routy */
	private $routes = array();

	/** @var array Proměnné kontaineru. */
	private $vars = array();

	/**
	 * @param string $name Název proměnné.
	 * @param mixed $value Hodnota proměnné.
	 */
	public function __set($name, $value) {
		$this->vars[$name] = $value;
	}

	/**
	 * @param string $name Název proměnné.
	 */
	public function __get($name) {
		return $this->vars[$name];
	}

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
