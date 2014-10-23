<?php

/**
 * Přepravka pro zprávy
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Messages {

	/**
	 * @var array Zprávy pro uživatele
	 */
	public $messages;

	public function __construct() {
		//TO DO - dodělat načítání ze sečny;
	}

	/**
	 * Přidá další zprávu do zpráv.
	 * @param string $message Zpráva.
	 */
	public function addMessage($message) {
		$this->messages[] = $message;
	}

	/**
	 * Vrátí a smaže všechny zprávy.
	 */
	public function getMessages() {
		//TO DO
	}

}
