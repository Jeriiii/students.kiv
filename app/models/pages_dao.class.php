<?php

require_once 'abstract_dao.class.php';

/**
 * Obstarává tabulku se stránkami
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class PagesDao extends AbstractDao {

	const TABLE_NAME = "pages";

	/* columns */
	const COLUMN_ID = "id";
	const COLUMN_NAME = "name";
	const COLUMN_URL = "url";

	public function getTableName() {
		return self::TABLE_NAME;
	}

	/**
	 * Najde stránku podle jména.
	 * @param string $name Název stránky.
	 * @return PDOStatement|boolean Jedna stránka.
	 */
	public function findByName($name) {
		$query = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_NAME . " = ?";
		$stmt = $this->database->query($query, $name);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Najde stránku podle její url.
	 * @param string $url Jméno url.
	 * @return PDOStatement|boolean Jedna stránka.
	 */
	public function findByUrl($url) {
		$query = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_URL . " = ?";
		$stmt = $this->database->query($query, $url);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Vrátí domovskou stránku. (stránka s nejnižším id)
	 * @return PDOStatement|boolean Domovská stránka.
	 */
	public function findHomepage() {
		$query = "SELECT * FROM " . $this->getTableName();
		$stmt = $this->database->query($query);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

}
