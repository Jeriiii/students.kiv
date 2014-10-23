<?php

/**
 * Zastupuje aktuální session
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class Session extends Box {

	public function __set($name, $value) {
		parent::__set($name, $value);
		//proměnná se ukládá vždy i přímo do sečny
		$_SESSION[$name] = $value;
	}

}
