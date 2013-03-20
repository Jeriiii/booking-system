-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.28-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-03-15 20:59:56
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cinema`;


-- Dumping structure for table cinema.input_elements_for_json
CREATE TABLE IF NOT EXISTS `input_elements_for_json` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(10) NOT NULL DEFAULT '0',
  `serie` int(10) NOT NULL DEFAULT '0',
  `id_place` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `place` (`id_place`),
  CONSTRAINT `input_elements_for_json_place` FOREIGN KEY (`id_place`) REFERENCES `places` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='slouží pro uložení sedadel v sále pro ukázku formátu JSON';

-- Dumping data for table cinema.input_elements_for_json: ~10 rows (approximately)
/*!40000 ALTER TABLE `input_elements_for_json` DISABLE KEYS */;
INSERT INTO `input_elements_for_json` (`id`, `type`, `serie`, `id_place`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 1),
	(3, 1, 1, 1),
	(4, 1, 2, 1),
	(5, 1, 2, 1),
	(6, 1, 2, 1),
	(7, 1, 3, 1),
	(8, 1, 3, 1),
	(9, 1, 3, 1),
	(10, 2, 4, 1);
/*!40000 ALTER TABLE `input_elements_for_json` ENABLE KEYS */;


-- Dumping structure for table cinema.movies
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `id_place` int(10) unsigned NOT NULL COMMENT 'places',
  `start` time NOT NULL,
  `end` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movies_id_place` (`id_place`),
  CONSTRAINT `movies_id_place` FOREIGN KEY (`id_place`) REFERENCES `places` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='obsahuje filmy, jejich jména, začátek a konec filmu a v jakém se promítají sále';

-- Dumping data for table cinema.movies: ~4 rows (approximately)
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` (`id`, `name`, `id_place`, `start`, `end`) VALUES
	(1, 'Příběh hraček', 1, '10:00:00', '12:00:00'),
	(2, 'Hledá se Nemo', 1, '12:00:00', '14:00:00'),
	(3, 'Walle', 2, '15:00:00', '17:00:00'),
	(4, 'Vzhuru do oblak', 2, '17:00:00', '20:00:00');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;


-- Dumping structure for table cinema.places
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'sal 1, sal 2',
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='ukládají se zde jména míst a odkazy na jména souborů';

-- Dumping data for table cinema.places: ~3 rows (approximately)
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` (`id`, `name`, `file`) VALUES
	(1, 'sál 1', 'input1.xls'),
	(2, 'sál 2', 'input2.xls'),
	(3, 'sál 3', 'input3.xls');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;


-- Dumping structure for table cinema.reserved_elements
CREATE TABLE IF NOT EXISTS `reserved_elements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_place` int(10) unsigned NOT NULL COMMENT 'sál',
  `id_user` int(10) unsigned NOT NULL,
  `serie_number` smallint(3) unsigned NOT NULL,
  `element_number` smallint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_place` (`id_place`),
  KEY `reserved_elements_id_user` (`id_user`),
  CONSTRAINT `reserved_elements_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `reserved_elements_id_place` FOREIGN KEY (`id_place`) REFERENCES `places` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='slouží pro uložení rezervovaných sedadel';

-- Dumping data for table cinema.reserved_elements: ~0 rows (approximately)
/*!40000 ALTER TABLE `reserved_elements` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserved_elements` ENABLE KEYS */;


-- Dumping structure for table cinema.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL COMMENT 'email',
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='slouží pro správu uživatelů';

-- Dumping data for table cinema.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`) VALUES
	(2, 'P.Kukral@seznam.cz', 'e26256d0d2e39dc4fc5f5a28c593fcae'),
	(4, 'test', '098f6bcd4621d373cade4e832627b4f6');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
