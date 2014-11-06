<?php

/**
 * Base controler pro všechny v aplikaci
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class BaseControler extends Controler {

	public function createPagesDao() {
		return new PagesDao($this->database);
	}

	public function createFilesDao() {
		return new FilesDao($this->database);
	}

	public function createLinksDao() {
		return new LinksDao($this->database);
	}

	public function createAdminsDao() {
		return new AdminsDao($this->database);
	}

	/**
	 * Přihlásí uživatele do systému.
	 * @param string $userName Jméno uživatele.
	 */
	public function signInUser($userName) {
		$adminDao = $this->createAdminsDao();
		$isAdmin = FALSE;
		if ($adminDao->isAdmin($userName)) {
			$isAdmin = TRUE;
		}

		$this->user->signIn($userName, $isAdmin);
	}

	/**
	 * Odhlášení uživatele.
	 */
	public function signOut() {
		$this->user->signOut();
	}

	public function checkDoParam() {
		parent::checkDoParam();
	}

}
