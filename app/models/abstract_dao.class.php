<?php

/**
 * AbstractDao
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class AbstractDao {

	/** @var Database Zastřešuje práci nad databází. */
	protected $database;

	public function __construct(Database $database) {
		$this->database = $database;
	}

	/**
	 * Vrátí všechny řádky z tabulky.
	 * @return array Pole s řádky.
	 */
	public function getAll() {
		$query = "SELECT * FROM " . $this->getTableName();
		$stmt = $this->database->query($query);
		return $this->stmtsToArray($stmt);
	}

	/**
	 * Vloží data do databáze.
	 * @param array $data Data které se mají vložit.
	 */
	public function insert(array $data) {
		$names = array();
		$values = array();
		foreach ($data as $name => $val) {
			$names[] = $name;
			$values[] = mysql_real_escape_string($val); // ochrana proti SQL injection
		}
		$query = "INSERT INTO " . self::TABLE_NAME . " (" . implode(",", $names) . ")" . " VALUES(" . implode(",", $values) . ");";
		$this->database->query($query);
	}

	/**
	 * Vloží vytažené objekty z databáze do pole, aby se dalo proiterovat.
	 * @param PDOStatement $stmts Objekty, které se mají vložit do pole.
	 * @return array Pole objektů vytažených z DB.
	 */
	protected function stmtsToArray($stmts) {
		$arrStmts = array();
		while ($stmt = $stmts->fetch(PDO::FETCH_OBJ)) {
			$arrStmts[] = $stmt;
		}
		return $arrStmts;
	}

}
