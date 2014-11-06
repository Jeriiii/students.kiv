<?php

/**
 * Obstarává tabulku administrátory stránky
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class AdminsDao extends AbstractDao {

	const TABLE_NAME = "kukral_admins";

	/* columns */
	const COLUMN_ID = "id";
	const COLUMN_NAME = "name";

	public function getTableName() {
		return self::TABLE_NAME;
	}

	/**
	 * Je tento uživatel adminem?
	 * @param string $name Jméno uživatele.
	 * @return boolean TRUE = uživatel je admin, jinak FALSE.
	 */
	public function isAdmin($name) {
		$query = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_NAME . " = ?";
		$stmt = $this->database->query($query, $name);
		$admin = $stmt->fetch(PDO::FETCH_OBJ);

		if (empty($admin)) {
			return FALSE;
		}
		return TRUE;
	}

}
