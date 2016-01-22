-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for vrijeme
CREATE DATABASE IF NOT EXISTS `vrijeme` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `vrijeme`;


-- Dumping structure for table vrijeme.vrijeme_osijek
CREATE TABLE IF NOT EXISTS `vrijeme_osijek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vrijeme` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `temperatura_C` int(11) DEFAULT NULL,
  `temperatura_K` int(11) NOT NULL,
  `vlaznost` int(11) NOT NULL,
  `tlak` int(11) NOT NULL,
  `vjetar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vrijeme.vrijeme_osijek: ~0 rows (approximately)
/*!40000 ALTER TABLE `vrijeme_osijek` DISABLE KEYS */;
INSERT INTO `vrijeme_osijek` (`id`, `vrijeme`, `temperatura_C`, `temperatura_K`, `vlaznost`, `tlak`, `vjetar`) VALUES
	(3, '2016-01-22 11:59:28', -2, 272, 74, 1036, 1),
	(7, '2016-01-22 12:25:45', -1, 273, 78, 1036, 1),
	(8, '2016-01-22 12:31:52', -1, 273, 78, 1036, 1),
	(9, '2016-01-22 13:25:30', 0, 273, 59, 1035, 3),
	(10, '2016-01-22 13:46:47', 0, 273, 59, 1035, 3),
	(11, '2016-01-22 14:21:38', 0, 274, 50, 1035, 2);
/*!40000 ALTER TABLE `vrijeme_osijek` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
