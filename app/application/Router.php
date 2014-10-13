<?php

/**
 * Nastaví správnou routu
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Router {

	/** @var array Registrované routy. */
	private $routes = array();

	/** @var Url Aktuální url */
	private $url;

	public function __construct($routes, Url $url) {
		$this->routes = $routes;
		$this->url = $url;
	}

	/**
	 * Vrátí název controleru.
	 * @return string Název controleru.
	 * @throws Exception Controler nenalezen
	 */
	public function getControlerName() {
		foreach ($this->routes as $route) {
			// pokud url obsahuje značku z routy
			if (strpos($this->url->path, $route->getUrl()) !== false) {
				return $route->getControlerName();
			}
		}

		throw new Exception("Controller was not found to url " . $this->url->path);
	}

}
