<?php

require_once 'base_controler.class.php';

/**
 * Controler, který se stará o veškeré požadavky na front-endu
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class FrontControler extends BaseControler {

	/** PDOStatement Aktuální stránka.  */
	private $page;

	/** array Všechny stránky.  */
	private $pages;

	/** array Všechny soubory přiřazené k aktuální stránce.  */
	private $files;

	/** array Všechny odkazy.  */
	private $links;

	public function action($pageName) {
		if (array_key_exists("do", $this->query) && $this->query == "send-form") {
			$this->sendContactForm();
		}

		$pagesDao = $this->createPagesDao();
		$this->page = $pagesDao->findByName($pageName);
		if (!$this->page) {
			/* stránka nebyla nalezena */
			if ($pageName == "") {
				$this->page = $pagesDao->findHomepage();
			} else {
				$this->redirect("FrontControler");
			}
		}
		if (FALSE && $this->page->form) { // zatím to nebude fungovat, spustí se to až na serveru
			if (!pam_auth($username, $password, $error)) {
				if (!empty($error)) { // nepřihlášený uživatel
					$this->redirect("FrontControler");
				}
			}
		}
		$this->pages = $pagesDao->getAll();

		$filesDao = $this->createFilesDao();
		$this->files = $filesDao->getByPageId($this->page->id);

		$linksDao = $this->createLinksDao();
		$this->links = $linksDao->getAll();
	}

	public function sendContactForm() {

	}

	public function render($pageName) {
		$this->template->pages = $this->pages;
		$this->template->links = $this->links;
		$this->template->page = $this->page;
		$this->template->files = $this->files;
		$this->template->tittle = "Web pro studenty";
		$this->template->render();
	}

}
