-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for voting_system
CREATE DATABASE IF NOT EXISTS `voting_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `voting_system`;

-- Dumping structure for table voting_system.voters
CREATE TABLE IF NOT EXISTS `voters` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Count` varchar(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table voting_system.voters: ~1 rows (approximately)
REPLACE INTO `voters` (`id`, `Name`, `Position`, `Count`) VALUES
	(2, 'Karl', 'President', '0'),
	(4, 'Berto', 'Author', '0'),
	(5, 'Emily', 'President', '0'),
	(6, 'Liam', 'President', '0'),
	(7, 'Sophia', 'President', '0'),
	(8, 'Noah', 'Vice President', '0'),
	(9, 'Olivia', 'Vice President', '0'),
	(10, 'Ethan', 'Vice President', '0'),
	(11, 'Ava', 'Secretary', '0'),
	(12, 'Jackson', 'Secretary', '0'),
	(13, 'Emma', 'Secretary', '0'),
	(14, 'Aiden', 'Secretary', '0'),
	(15, 'Isabella', 'Author', '0'),
	(16, 'Lucas', 'Author', '0'),
	(17, 'Mia', 'Author', '0'),
	(18, 'Mason', 'Author', '0'),
	(19, 'Charlotte', 'Surgent', '0'),
	(20, 'Logan', 'Surgent', '0'),
	(21, 'Amelia', 'Surgent', '0'),
	(22, 'Elijah', 'Surgent', '0'),
	(23, 'Harper', 'President', '0'),
	(24, 'Oliver', 'President', '0');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
