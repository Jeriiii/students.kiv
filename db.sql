-- --------------------------------------------------------
-- Hostitel:                     127.0.0.1
-- Verze serveru:                5.6.15-log - MySQL Community Server (GPL)
-- OS serveru:                   Win64
-- HeidiSQL Verze:               8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportování struktury pro tabulka students_kiv.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `suffix` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_files_pages` (`page_id`),
  CONSTRAINT `FK_files_pages` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku students_kiv.files: ~1 rows (přibližně)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` (`id`, `page_id`, `name`, `suffix`) VALUES
	(1, 1, 'neco', 'pdf');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


-- Exportování struktury pro tabulka students_kiv.links
CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku students_kiv.links: ~2 rows (přibližně)
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` (`id`, `name`, `url`) VALUES
	(1, 'link1', 'https://www.facebook.com/groups/227063950782223/386074698214480/?notif_t=group_activity'),
	(2, 'link2', 'https://www.facebook.com/groups/227063950782223/386074698214480/?notif_t=group_activity');
/*!40000 ALTER TABLE `links` ENABLE KEYS */;


-- Exportování struktury pro tabulka students_kiv.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` text,
  `form` tinyint(1) unsigned DEFAULT '0',
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku students_kiv.pages: ~3 rows (přibližně)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `name`, `content`, `form`, `url`) VALUES
	(1, 'neco', 'neco text', 0, 'neco'),
	(2, 'neco jineho', 'neco uplne jineho', 0, 'neco-jineho'),
	(3, 'kontakty', 'Kontaktní formulář', 1, 'kontakty');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
