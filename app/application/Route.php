<?php

/**
 * Stará se o strávné vybrání controleru podle zadané adresy
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Route {

	/** @var string Url na které se má reagovat. */
	private $url;

	/** @var string Název kontroleru, který se má zavolat. */
	private $controlerName;

	public function __construct($url, $controlerName) {
		$this->url = $url;
		$this->controlerName = $controlerName;
	}

	public function getUrl() {
		return $this->url;
	}

	public function getControlerName() {
		return $this->controlerName;
	}

}
