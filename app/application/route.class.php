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

	/** @var string Název stránky - plní se až při procházení rout v routeru */
	private $pageName = null;

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

	public function setPageName($pageName) {
		if ($pageName == "/") { //na homepage se stává, že se dá do názvu lomítko
			$pageName = "";
		}
		$this->pageName = $pageName;
	}

	public function getPageName() {
		return $this->pageName;
	}

}
