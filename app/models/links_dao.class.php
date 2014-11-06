<?php

/**
 * Obstarává tabulku s odkazy
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class LinksDao extends AbstractDao {

	const TABLE_NAME = "kukral_links";

	/* columns */
	const COLUMN_ID = "id";
	const COLUMN_NAME = "name";
	const COLUMN_URL = "url";

	public function getTableName() {
		return self::TABLE_NAME;
	}

}
