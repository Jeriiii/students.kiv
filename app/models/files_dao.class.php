<?php

/**
 * Obstarává tabulku se soubory
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class FilesDao extends AbstractDao {

	const TABLE_NAME = "kukral_files";

	/* columns */
	const COLUMN_ID = "id";
	const COLUMN_NAME = "name";
	const COLUMN_SUFFIX = "suffix";
	const COLUMN_PAGE_ID = "page_id";

	public function getTableName() {
		return self::TABLE_NAME;
	}

	/**
	 * Vrátí soubory podle Id stránky
	 * @param int $pageId Id stránky
	 * @return array Pole se soubory.
	 */
	public function getByPageId($pageId) {
		$query = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_PAGE_ID . " = ?";
		$stmt = $this->database->query($query, $pageId);
		return $this->stmtsToArray($stmt);
	}

}
