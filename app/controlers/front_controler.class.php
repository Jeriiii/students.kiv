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
		$pagesDao = $this->createPagesDao();
		$this->page = $pagesDao->findByUrl($pageName);
		if (!$this->page) {
			/* stránka nebyla nalezena */
			if ($pageName == "") {
				$this->page = $pagesDao->findHomepage();
			} else {
				$this->messages->addMessage("Stránka kterou hledáte nebyla nalezena");
				$this->redirect("FrontControler");
			}
		}
		if ($this->page->form == PagesDao::TYPE_CONTACT && !$this->user->isLoggedIn()) { // zatím to nebude fungovat, spustí se to až na serveru
			$this->messages->addMessage("Pro kontaktování supportu se nejdříve přihlašte.");
			$this->redirect("FrontControler", "prihlaseni");
		}
		$this->pages = $pagesDao->getMenu();

		$filesDao = $this->createFilesDao();
		$this->files = $filesDao->getByPageId($this->page->id);

		$linksDao = $this->createLinksDao();
		$this->links = $linksDao->getAll();
	}

	public function render($pageName) {
		$this->template->pages = $this->pages;
		$this->template->links = $this->links;
		$this->template->page = $this->page;
		$this->template->files = $this->files;
		$this->template->tittle = "Web pro studenty";
		$this->template->render();
	}

	/**
	 * Odchytí odeslání přihlašovacího formuláře.
	 */
	public function submitSigninForm() {
		$userName = $this->postParam->login;
		$password = $this->postParam->password;

//		if (!pam_auth($userName, $password, $error)) {
//			$this->messages->addMessage("Neplatné uživatelské jméno nebo heslo");
//			$this->redirect("this");
//		}

		$this->signInUser($userName);

		$this->messages->addMessage("Byl jste úspěšně přihlášen.");
		$this->redirect("FrontControler");
	}

	/**
	 * Metoda co se postará o zpracování odeslaného kontaktního formuláře.
	 */
	public function submitContactForm() {
		if ($this->postParam->note) {
			$to = "to@email.com";
			$from = "from@email.com";
			$this->sendMail($this->postParam->note, $to, $from);
			$this->messages->addMessage("Formulář byl úspěšně odeslán.");
		} else {
			$this->messages->addMessage("Vyplňte prosím pole pro popsání Vašeho problému.");
		}
		$this->redirect("this");
	}

	/**
	 * Pošle email na support
	 * @param string $note Text zprávy.
	 * @param string $to Mailová adresa komu se má poslat.
	 * @param string $from Mailová adresa od koho se má poslat.
	 */
	private function sendMail($note, $to, $from) {
		$subject = "Support - students.kiv.zcu.cz";
		mail($to, $subject, $note, "From: " . $from);
	}

}
