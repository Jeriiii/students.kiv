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

-- Exportování struktury pro tabulka students_kiv.kukral_admins
CREATE TABLE IF NOT EXISTS `kukral_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku students_kiv.kukral_admins: ~2 rows (přibližně)
/*!40000 ALTER TABLE `kukral_admins` DISABLE KEYS */;
INSERT INTO `kukral_admins` (`id`, `name`) VALUES
	(1, 'admin');
/*!40000 ALTER TABLE `kukral_admins` ENABLE KEYS */;


-- Exportování struktury pro tabulka students_kiv.kukral_files
CREATE TABLE IF NOT EXISTS `kukral_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `suffix` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_files_pages` (`page_id`),
  CONSTRAINT `FK_files_pages` FOREIGN KEY (`page_id`) REFERENCES `kukral_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku students_kiv.kukral_files: ~1 rows (přibližně)
/*!40000 ALTER TABLE `kukral_files` DISABLE KEYS */;
INSERT INTO `kukral_files` (`id`, `page_id`, `name`, `suffix`) VALUES
	(1, 1, 'neco', 'pdf');
/*!40000 ALTER TABLE `kukral_files` ENABLE KEYS */;


-- Exportování struktury pro tabulka students_kiv.kukral_links
CREATE TABLE IF NOT EXISTS `kukral_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku students_kiv.kukral_links: ~2 rows (přibližně)
/*!40000 ALTER TABLE `kukral_links` DISABLE KEYS */;
INSERT INTO `kukral_links` (`id`, `name`, `url`) VALUES
	(1, 'link1', 'https://www.facebook.com/groups/227063950782223/386074698214480/?notif_t=group_activity'),
	(2, 'link2', 'https://www.facebook.com/groups/227063950782223/386074698214480/?notif_t=group_activity');
/*!40000 ALTER TABLE `kukral_links` ENABLE KEYS */;


-- Exportování struktury pro tabulka students_kiv.kukral_pages
CREATE TABLE IF NOT EXISTS `kukral_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` text,
  `form` tinyint(1) unsigned DEFAULT '0' COMMENT '1=contact form, 2 = sign in',
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku students_kiv.kukral_pages: ~4 rows (přibližně)
/*!40000 ALTER TABLE `kukral_pages` DISABLE KEYS */;
INSERT INTO `kukral_pages` (`id`, `name`, `content`, `form`, `url`) VALUES
	(1, 'neco', 'neco text', 0, 'neco'),
	(2, 'neco jineho 22', 'neco uplne jineho', 0, 'neco-jineho-22'),
	(3, 'kontakty', 'Kontaktní formulář', 1, 'kontakty'),
	(4, 'Přihlášení', NULL, 2, 'prihlaseni');
/*!40000 ALTER TABLE `kukral_pages` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
