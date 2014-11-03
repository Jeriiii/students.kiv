<?php

require_once 'abstract_dao.class.php';

/**
 * Obstarává tabulku se stránkami
 *
 * @author Petr Kukrál <p.kukral@kukral.eu>
 */
class PagesDao extends AbstractDao {

	const TABLE_NAME = "kukral_pages";

	/* columns */
	const COLUMN_ID = "id";
	const COLUMN_NAME = "name";
	const COLUMN_URL = "url";
	const COLUMN_FORM = "form";
	const COLUMN_CONTENT = "content";


	/* typy */
	const TYPE_CONTACT = 1;
	const TYPE_SIGN_IN = 2;

	public function getTableName() {
		return self::TABLE_NAME;
	}

	/**
	 * Vrátí stránky co se mají vypsat do menu.
	 * @return array Pole s řádky.
	 */
	public function getMenu() {
		$query = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_FORM . " != ?";
		$stmt = $this->database->query($query, "2");
		return $this->stmtsToArray($stmt);
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
	 * Najde stránku podle Id.
	 * @param string $id Id stránky.
	 * @return PDOStatement|boolean Jedna stránka.
	 */
	public function findById($id) {
		$query = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_ID . " = ?";
		$stmt = $this->database->query($query, $id);
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

	/**
	 * Vloží novou stránku
	 * @param string $name Název stránky.
	 * @param string $content Text stránky.
	 */
	public function insertPage($name, $content) {
		parent::insert(array(
			self::COLUMN_NAME => $name,
			self::COLUMN_URL => self::webalize($name),
			self::COLUMN_CONTENT => $content,
		));
	}

	/**
	 * Upraví stránku
	 * @param string $name Název stránky.
	 * @param string $content Text stránky.
	 */
	public function updatePage($id, $name, $content) {
		parent::update($id, array(
			self::COLUMN_NAME => $name,
			self::COLUMN_URL => self::webalize($name),
			self::COLUMN_CONTENT => $content,
		));
	}

	/**
	 * Převede do ASCII. Převzato z http://api.nette.org/2.0.14/source-Utils.Strings.php.html#175-191
	 * @param  string  UTF-8 encoding
	 * @return string  ASCII
	 */
	private static function toAscii($s) {
		$s = preg_replace('#[^\x09\x0A\x0D\x20-\x7E\xA0-\x{2FF}\x{370}-\x{10FFFF}]#u', '', $s);
		$s = strtr($s, '`\'"^~', "\x01\x02\x03\x04\x05");
		if (ICONV_IMPL === 'glibc') {
			$s = @iconv('UTF-8', 'WINDOWS-1250//TRANSLIT', $s); // intentionally @
			$s = strtr($s, "\xa5\xa3\xbc\x8c\xa7\x8a\xaa\x8d\x8f\x8e\xaf\xb9\xb3\xbe\x9c\x9a\xba\x9d\x9f\x9e"
				. "\xbf\xc0\xc1\xc2\xc3\xc4\xc5\xc6\xc7\xc8\xc9\xca\xcb\xcc\xcd\xce\xcf\xd0\xd1\xd2\xd3"
				. "\xd4\xd5\xd6\xd7\xd8\xd9\xda\xdb\xdc\xdd\xde\xdf\xe0\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8"
				. "\xe9\xea\xeb\xec\xed\xee\xef\xf0\xf1\xf2\xf3\xf4\xf5\xf6\xf8\xf9\xfa\xfb\xfc\xfd\xfe\x96", "ALLSSSSTZZZallssstzzzRAAAALCCCEEEEIIDDNNOOOOxRUUUUYTsraaaalccceeeeiiddnnooooruuuuyt-");
		} else {
			$s = @iconv('UTF-8', 'ASCII//TRANSLIT', $s); // intentionally @
		}
		$s = str_replace(array('`', "'", '"', '^', '~'), '', $s);
		return strtr($s, "\x01\x02\x03\x04\x05", '`\'"^~');
	}

	/**
	 * Převede do webově bezpečného názvu. Převzato z http://api.nette.org/2.0.14/source-Utils.Strings.php.html#175-191
	 * @param  string  UTF-8 encoding
	 * @param  string  Dovolené znaky
	 * @param  bool
	 * @return string
	 */
	private static function webalize($s, $charlist = NULL, $lower = TRUE) {
		$s = self::toAscii($s);
		if ($lower) {
			$s = strtolower($s);
		}
		$s = preg_replace('#[^a-z0-9' . preg_quote($charlist, '#') . ']+#i', '-', $s);
		$s = trim($s, '-');
		return $s;
	}

}
