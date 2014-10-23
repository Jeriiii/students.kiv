<?php

/**
 * Třída která pracuje s přihlášeným - nepřihlášeným uživatelem
 *
 * @author Sarif
 */
class User {

	/** @var Session sečna */
	private $session;

	public function __construct(Session $session) {
		$this->session = $session;
	}

	/**
	 * Přihlásí uživatele do aplikace
	 * @param string $userName Jméno uživatele.
	 * @param boolean $isAdmin TRUE = Je uživatel adminem, jinak FALSE.
	 */
	public function signIn($userName, $isAdmin = FALSE) {
		$this->session->userName = $userName;
		$this->session->isUserAdmin = $isAdmin;
	}

	/**
	 * Odhlásí uživatele z aplikace
	 */
	public function signOut() {
		$this->session->userName = null;
	}

	/**
	 * Je uživatel přihlášen?
	 * @return boolean TRUE - uživatel je přihlášen, jinak FALSE
	 */
	public function isLoggedIn() {
		if (isset($this->session->userName)) {
			return TRUE;
		}

		return FALSE;
	}

}
