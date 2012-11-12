-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.28-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-11-12 22:27:56
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cinema`;


-- Dumping structure for table cinema.elements
CREATE TABLE IF NOT EXISTS `elements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_place` int(10) unsigned NOT NULL COMMENT 'sál',
  `id_user` int(10) unsigned NOT NULL,
  `serie` smallint(3) unsigned NOT NULL,
  `element` smallint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- Dumping data for table cinema.elements: ~3 rows (approximately)
/*!40000 ALTER TABLE `elements` DISABLE KEYS */;
INSERT INTO `elements` (`id`, `id_place`, `id_user`, `serie`, `element`) VALUES
	(43, 1, 0, 1, 5),
	(45, 1, 0, 1, 3),
	(47, 1, 2, 0, 2);
/*!40000 ALTER TABLE `elements` ENABLE KEYS */;


-- Dumping structure for table cinema.elements_for_json
CREATE TABLE IF NOT EXISTS `elements_for_json` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(10) NOT NULL DEFAULT '0',
  `serie` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table cinema.elements_for_json: ~10 rows (approximately)
/*!40000 ALTER TABLE `elements_for_json` DISABLE KEYS */;
INSERT INTO `elements_for_json` (`id`, `type`, `serie`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 1, 1),
	(4, 1, 2),
	(5, 1, 2),
	(6, 1, 2),
	(7, 1, 3),
	(8, 1, 3),
	(9, 1, 3),
	(10, 2, 4);
/*!40000 ALTER TABLE `elements_for_json` ENABLE KEYS */;


-- Dumping structure for table cinema.films
CREATE TABLE IF NOT EXISTS `films` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `hall` int(10) NOT NULL COMMENT 'places',
  `start` time NOT NULL,
  `end` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table cinema.films: ~4 rows (approximately)
/*!40000 ALTER TABLE `films` DISABLE KEYS */;
INSERT INTO `films` (`id`, `name`, `hall`, `start`, `end`) VALUES
	(1, 'Příběh hraček', 1, '10:00:00', '12:00:00'),
	(2, 'Hledá se Nemo', 1, '12:00:00', '14:00:00'),
	(3, 'Walle', 2, '15:00:00', '17:00:00'),
	(4, 'Vzhuru do oblak', 2, '17:00:00', '20:00:00');
/*!40000 ALTER TABLE `films` ENABLE KEYS */;


-- Dumping structure for table cinema.moves
CREATE TABLE IF NOT EXISTS `moves` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table cinema.moves: ~4 rows (approximately)
/*!40000 ALTER TABLE `moves` DISABLE KEYS */;
INSERT INTO `moves` (`id`, `name`) VALUES
	(1, 'Bathman'),
	(2, 'Avatar'),
	(3, 'Harry Potter a Relikvie smrti 2'),
	(4, 'Doba Ledová 4');
/*!40000 ALTER TABLE `moves` ENABLE KEYS */;


-- Dumping structure for table cinema.places
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table cinema.places: ~3 rows (approximately)
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` (`id`, `file`) VALUES
	(1, 'input1.xls'),
	(2, 'input2.xls'),
	(3, 'input3.xls');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;


-- Dumping structure for table cinema.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table cinema.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `mail`, `password`) VALUES
	(2, 'P.Kukral@seznam.cz', 'e26256d0d2e39dc4fc5f5a28c593fcae'),
	(3, '', 'd41d8cd98f00b204e9800998ecf8427e');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
