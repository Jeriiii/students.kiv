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
	 * @return Route Routa která odpovídá aktuální adrese.
	 * @throws Exception Controler nenalezen
	 */
	public function getRoute() {
		foreach ($this->routes as $route) {
			$path = "/" . $this->url->path; // přidání lomítka aby souhlasilo s názvem rout
			// pokud url obsahuje značku z routy
			if (strpos($path, $route->getUrl()) !== false) {
				$route->setPageName($this->url->path);
				return $route;
			}
		}

		throw new Exception("Controller was not found to url " . $this->url->path);
	}

	/**
	 * Vrátí lokaci zaregistrovanou v routách k danému kontroleru.
	 * @param string $controlerName Název kontroleru.
	 * @return string Lokace kontroleru zadaná v routách.
	 * @throws Exception Kontroler nebyl nalezen.
	 */
	public function getControlerLocation($controlerName) {
		foreach ($this->routes as $route) {
			if ($controlerName == $route->getControlerName()) {
				$location = $route->getUrl();
				break;
			}
		}

		if (empty($location)) {
			throw new Exception("Controler with name " . $controlerName . " havn´t route.");
		}

		return $location;
	}

}
