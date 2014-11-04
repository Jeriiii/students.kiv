<?php

require_once 'base_controler.class.php';

/**
 * Controler, který se stará o práci v administraci
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class AdminControler extends BaseControler {

	/** @var array Všechny stránky. */
	private $pages;

	/** PDOStatement Aktuální stránka.  */
	private $page;

	/** @var array Administrátoři */
	private $admins;

	/** @var array Odkazy na stránce */
	private $links;

	public function action($pageName) {
		$pagesDao = $this->createPagesDao();
		$this->pages = $pagesDao->getAll();
	}

	public function render($pageName) {
		$this->template->active = "pages";
		$this->template->pages = $this->pages;
		$this->template->render();
	}

	public function actionChangePage($pageName) {
		$pagesDao = $this->createPagesDao();
		$this->page = $pagesDao->findById($this->query->id);
		if (!$this->page) {
			/* stránka nebyla nalezena */
			$this->messages->addMessage("Stránka kterou hledáte nebyla nalezena");
			$this->redirect("AdminControler");
		}
	}

	public function renderChangePage($pageName) {
		$this->template->active = "pages";
		$this->template->name = $this->page->name;
		$this->template->content = $this->page->content;
		$this->template->pageId = $this->page->id;
		$this->template->render();
	}

	public function actionAdmins($pageName) {
		$adminsDao = $this->createAdminsDao();
		$this->admins = $adminsDao->getAll();
	}

	public function renderAdmins($pageName) {
		$this->template->active = "admins";
		$this->template->admins = $this->admins;
		$this->template->render();
	}

	public function actionLinks($pageName) {
		$linksDao = $this->createLinksDao();
		$this->links = $linksDao->getAll();
	}

	public function renderLinks($pageName) {
		$this->template->active = "links";
		$this->template->links = $this->links;
		$this->template->render();
	}

	/**
	 * Vloží novou stránku
	 */
	public function submitNewPageForm() {
		$pageDao = $this->createPagesDao();
		$this->validatePage();
		$pageDao->insertPage($this->postParam->name, $this->postParam->content);
		$this->messages->addMessage("Stránka byla vytvořena.");
		$this->redirect("this");
	}

	/**
	 * Upraví stránku
	 */
	public function submitChangePageForm() {
		$pageDao = $this->createPagesDao();
		$this->validatePage();
		$pageDao->updatePage($this->query->id, $this->postParam->name, $this->postParam->content);
		$this->messages->addMessage("Stránka byla změněna.");
		$this->redirect("this");
	}

	/**
	 * Vloží nového administráotra
	 */
	public function submitAdminNewForm() {
		$adminsDao = $this->createAdminsDao();
		$this->validateAdmin();
		$adminsDao->insert(array(
			AdminsDao::COLUMN_NAME => $this->postParam->login
		));
		$this->messages->addMessage("Administrátor byl vytvořen.");
		$this->redirect("this");
	}

	/**
	 * Vloží nový odkaz
	 */
	public function submitLinkNewForm() {
		$linksDao = $this->createLinksDao();
		$this->validateLink();
		$linksDao->insert(array(
			LinksDao::COLUMN_NAME => $this->postParam->name,
			LinksDao::COLUMN_URL => $this->postParam->url
		));
		$this->messages->addMessage("Link byl vytvořen.");
		$this->redirect("this");
	}

	/**
	 * Zkontroluje, zda má stránka všechny potřebné parametry
	 */
	private function validatePage() {
		$name = $this->postParam->name;
		if (empty($name)) {
			$this->messages->addMessage("Vyplňte prosím název stránky");
			$this->redirect("this");
		}
		if (strlen($name) > 50) {
			$this->messages->addMessage("Název stránky nesmí mít více než 50 znaků");
			$this->redirect("this");
		}
	}

	/**
	 * Zkontroluje, zda má admin všechny potřebné parametry
	 */
	private function validateAdmin() {
		$login = $this->postParam->login;
		if (empty($login)) {
			$this->messages->addMessage("Vyplňte prosím login");
			$this->redirect("this");
		}
		if (strlen($login) > 30) {
			$this->messages->addMessage("Login nesmí mít více než 30 znaků");
			$this->redirect("this");
		}
	}

	/**
	 * Zkontroluje, zda má link všechny potřebné parametry
	 */
	private function validateLink() {
		$name = $this->postParam->name;
		$url = $this->postParam->url;
		if (empty($name) || empty($url)) {
			$this->messages->addMessage("Vyplňte prosím název a url odkazu");
			$this->redirect("this");
		}
		if (strlen($name) > 30) {
			$this->messages->addMessage("Náyev nesmí mít více než 30 znaků");
			$this->redirect("this");
		}
		if (strlen($url) > 200) {
			$this->messages->addMessage("Url nesmí mít více než 200 znaků");
			$this->redirect("this");
		}
	}

	/**
	 * Zkontroluje, zda je nastavený parametr DO
	 */
	public function checkDoParam() {
		parent::checkDoParam();
		$this->checkDeletePage();
		$this->checkDeleteAdmin();
		$this->checkDeleteLink();
	}

	/**
	 * Pokud bylo zmáčknuto tlačítko na smazání stránky, smaže ji.
	 */
	private function checkDeletePage() {
		if ($this->query->do == "delete-page") {
			/* smaže stránku */
			$pageDao = $this->createPagesDao();
			$pageDao->delete($this->query->id);
			$this->messages->addMessage("Stránka byla smazána");
			$this->redirect("this");
		}
	}

	/**
	 * Pokud bylo zmáčknuto tlačítko na smazání administráotra, smaže ho.
	 */
	private function checkDeleteAdmin() {
		if ($this->query->do == "delete-admin") {
			/* smaže administrátora */
			$adminDao = $this->createAdminsDao();
			$adminDao->delete($this->query->id);
			$this->messages->addMessage("Uživatel byl smazán");
			$this->redirect("this");
		}
	}

	/**
	 * Pokud bylo zmáčknuto tlačítko na smazání linku, smaže ho.
	 */
	public function checkDeleteLink() {
		if ($this->query->do == "delete-link") {
			/* smaže administrátora */
			$linksDao = $this->createLinksDao();
			$linksDao->delete($this->query->id);
			$this->messages->addMessage("Link byl smazán");
			$this->redirect("this");
		}
	}

}