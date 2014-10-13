<?php

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

	/** @var array Proměnné v adrese */
	public $query = array();

	public function __construct($url) {
		$this->url = $url;
		$parseUrl = parse_url($url);

		$this->path = array_key_exists("path", $parseUrl) ? $parseUrl["path"] : "";
		/* parsování query */
		if (array_key_exists("query", $parseUrl)) {
			parse_str($parseUrl["query"], $this->query);
		}
	}

}
