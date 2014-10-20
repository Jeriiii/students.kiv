<?php

require_once APP_DIR . '/models/pages_dao.class.php';
require_once APP_DIR . '/models/files_dao.class.php';
require_once APP_DIR . '/models/links_dao.class.php';
require_once APP_DIR . '/application/controler.class.php';

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

}
