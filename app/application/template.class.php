<?php

/**
 * Obecná template, která se stará o načítání view.
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Template {

	/** @var string Název templaty */
	private $viewName;

	/** @var string Název složky pro templaty */
	private $viewFolderName;

	/** @var string Relativní cesta do adresáře WWW */
	public $basePath;

	/** @var array Proměnné templaty */
	private $vars = array();

	/** @var Messages Zprávy pro uživatele. */
	private $messages;

	/** @var User Aktuální uživatel */
	public $user;

	public function __construct($basePath, User $user, Messages $messages, $viewFolderName, $viewName = NULL) {
		$this->viewName = $viewName;
		$this->viewFolderName = $viewFolderName;
		$this->basePath = $basePath;
		$this->messages = $messages;
		$this->user = $user;
	}

	/**
	 * Obecný setter pro nastavení proměnných.
	 * @param string $name Název proměnné.
	 * @param mixed $value Hodnota proměnné.
	 */
	public function __set($name, $value) {
		$this->vars[$name] = $value;
	}

	function render() {
		/* pokusí se najít specifický view */
		$path = APP_DIR . '/views/' . $this->viewFolderName . '/' . $this->viewName . '.php';
		if (!file_exists($path)) {
			/* pokud ho nenajde, použije defaultní */
			$path = APP_DIR . '/views/' . $this->viewFolderName . '/default.php';
		}

		if (file_exists($path) == false) {
			throw new Exception('Template not found in ' . $path);
			return false;
		}

		/* pokusí se najít specifický view */
		$layoutPath = APP_DIR . '/views/' . $this->viewFolderName . '/layout.php';
		if (!file_exists($layoutPath)) {
			/* pokud ho nenajde, použije defaultní */
			$layoutPath = APP_DIR . '/views/layout.php';
		}
		// Načítání proměnných do templaty
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}
		//Načítání proměnné basePath
		$basePath = $this->basePath;
		//Načítání zpráv pro uživatele
		$messages = $this->messages;
		//Aktuální uživatel
		$user = $this->user;
		//vlozeni sablony
		$includeTemplate = $path;

		include ($layoutPath);
	}

}
