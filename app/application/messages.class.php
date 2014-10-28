<?php

/**
 * Přepravka pro zprávy
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Messages {

	/**
	 * @var Session Sečna
	 */
	private $session;

	public function __construct(Session $session) {
		$this->session = $session;
		$messages = $this->session->messages;
		if (empty($messages) && !is_array($messages)) {
			$this->session->messages = array();
		}
	}

	/**
	 * Přidá další zprávu do zpráv.
	 * @param string $messages Zpráva.
	 */
	public function addMessage($messages) {
		$this->session->messages = $this->session->messages + array($messages);
	}

	/**
	 * Vrátí všechny zprávy.
	 * @return array Zprávy pro uživatele.
	 */
	public function getAll() {
		return $this->session->messages;
	}

	/**
	 * SMAŽE všechny zprávy.
	 * @return array Zprávy pro uživatele.
	 */
	public function clear() {
		$this->session->messages = array();
	}

}
