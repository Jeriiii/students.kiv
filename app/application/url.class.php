<?php

require_once 'query.class.php';

/**
 * Parsuje url
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Url {

	/** @var string Originální url. */
	private $url;

	/** @var string Adresa za lomítkem */
	public $path;

	/** @var string Název routy, která zastupuje kontroler */
	public $roteName;

	/** @var string Relativní cesta do adresáře WWW */
	public $basePath;

	/** @var array Proměnné v adrese */
	public $query = array();

	public function __construct($url) {
		$this->url = $url;
		$this->basePath = $this->getBaseUrl();
		$parseUrl = parse_url($url);

		$path = array_key_exists("path", $parseUrl) ? $parseUrl["path"] : "";
		$this->path = $path;

		$this->parseQuery($_GET);
	}

	/**
	 * Uloží všechny get parametry s vyjímkou vyhrazeného q
	 * @param array $queries Paramerty
	 */
	private function parseQuery($queries) {
		/* parsování query */
		$this->query = new Query();
		foreach ($queries as $key => $param) {
			if ($key != "q") { // vyhrazené pro path stránky
				$this->query->$key = $param;
			}
		}
	}

	public function getBaseUrl() {
		$scriptPath = $_SERVER["PHP_SELF"];
		$basePath = str_replace("/index.php", "", $scriptPath); // odstranění "/index.php"
		return $basePath;
	}

}
