<?php

/**
 * Základní třída controler pro celou aplikaci
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Controler {

	/** @var Database Pro pr8ci s databází */
	protected $database;

	/** @var Template */
	protected $template;

	/** @var string Relativní cesta do adresáře WWW */
	protected $basePath;

	/** @var Router Routování adres */
	protected $router;

	/** @var Query Parametry předané v adrese */
	public $query;

	/** @var PostParam Parametry předané v post požadavku */
	public $postParam;

	/** @var Messages Zprávy co se mají zobrazit příjemci */
	public $messages;

	/** @var User Aktuální uživatel */
	public $user;

	public function __construct(Container $container, $viewFolderName) {
		$this->user = $container->user;
		$this->messages = $container->messages;
		$this->postParam = $container->postParam;
		$this->query = $container->url->query;
		$this->database = $container->database;
		$this->router = $container->router;
		$this->basePath = $container->url->basePath;
		$viewName = $this->router->getRoute()->getPageName();
		$this->template = new Template($this->basePath, $this->user, $this->messages, $viewFolderName, $viewName);
	}

	/**
	 * Metoda co se spouští jako první po vytvoření controlleru. Spouští se vždy pro controller,
	 * proto je zde vhodné udělat třeba zabezpečení controlleru pro adminsitraci.
	 */
	public function startUp() {

	}

	/**
	 * Přesměruje stránku na daný controller.
	 * @param string $controlerName Název kontroleru, na který se má stránka přesměrovat.
	 * @param string $pageName Název stránky, na kterou se má přesměrovat.
	 * @param array $queries Proměnné v url
	 */
	protected function redirect($controlerName, $pageName = "", $queries = array()) {
		if ($controlerName == "this") {
			$location = $this->getThisLocation();
		} else {
			$location = $this->getLocation($controlerName, $pageName);
		}

		/* přidá queries */
		if (!empty($queries)) {
			$urlQuery;
			foreach ($queries as $name => $value) {
				$urlQuery[] = "$name=$value";
			}
			$urlQuery = implode("&", $urlQuery);
			$location = $location . "?" . $urlQuery;
		}

		header("Location: " . $location);
		die(); //okamžitě se ukončí vykonávání scriptu
	}

	/**
	 * Vrátí lokaci, na které se uživatel nachází.
	 * @return string Aktuální lokace, na které se uživatel nachází.
	 */
	private function getThisLocation() {
		$currentRoute = $this->router->getRoute();
		$baseUrl = $currentRoute->getUrl();
		$pageName = $currentRoute->getPageName();

		$location = $this->basePath . $baseUrl . $pageName;

		$queries = $this->query->getVariables();
		if (!empty($queries)) {
			$urlQuery;
			foreach ($queries as $name => $value) {
				$urlQuery[] = "$name=$value";
			}
			$urlQuery = implode("&", $urlQuery);
			$location = $location . "?" . $urlQuery;
		}

		return $location;
	}

	/**
	 * Vrátí lokaci podle názvu kontroleru a stránky
	 * @param string $controlerName Název kontroleru, na který se má stránka přesměrovat.
	 * @param string $pageName Název stránky, na kterou se má přesměrovat.
	 */
	private function getLocation($controlerName, $pageName = "") {
		$controlerLocation = $this->router->getControlerLocation($controlerName);

		// vytvoření nové lokace
		$location = $this->basePath . $controlerLocation;
		if ($pageName) {
			$location = $location . $pageName;
		}

		return $location;
	}

	/**
	 * Zkontroluje, zda je nastavený parametr DO
	 */
	public function checkDoParam() {
		$this->checkSubmitForm();
		$this->checkSignOut();
	}

	/**
	 * Zkontroluje, zda byl odeslán formulář. Pokud ano, pokusí se zavolat obslužnou metodu.
	 * @throws Exception Pokud metoda neexistuje, nahlásí chybu.
	 */
	private function checkSubmitForm() {
		if ($this->query->do == "submit-form") {
			$submitFormMethod = "submit" . ucfirst($this->query->form);
			if (method_exists($this, $submitFormMethod)) {
				call_user_func(array($this, $submitFormMethod));
			} else {
				throw new Exception("Method $submitFormMethod not exist.");
			}
		}
	}

	/**
	 * Odhlásí uživatele.
	 */
	private function checkSignOut() {
		if ($this->query->do == "sign-out") {
			$this->signOut();
			$this->messages->addMessage("Byl jste úspěšně odhlášen");
			$this->redirect("FrontControler");
		}
	}

}
