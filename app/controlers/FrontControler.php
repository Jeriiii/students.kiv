<?php

require_once APP_DIR . '/application/Template.php';

/**
 * Controler, který se stará o veškeré požadavky na front-endu
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class FrontControler {

	/** @var Template */
	private $template;

	public function __construct() {
		$templateName = "front";
		$this->template = new Template($templateName);
	}

	public function render() {
		$this->template->render();
	}

}
