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

	/** @var string Url cesta do dané template např. admin/new */
	private $urlPath;

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

	public function setPageName($urlPath) {
		if ($urlPath == "/") { //na homepage se stává, že se dá do názvu lomítko
			$urlPath = "";
		}
		$this->urlPath = $urlPath;
		$pageName = str_replace($this->url, "", "/" . $urlPath); //odstraní název controleru z názvu stránky
		$this->pageName = $pageName;
	}

	public function getPageName() {
		return $this->pageName;
	}

	public function getUrlPath() {
		return $this->urlPath;
	}

}
