-- --------------------------------------------------------
-- Host:                         192.168.1.70
-- Server version:               10.6.10-MariaDB-log - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table laravel_crud_test.lflb_metadata
CREATE TABLE IF NOT EXISTS `lflb_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_oldid` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contributor` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identifier` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rights` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_crud_test.lflb_metadata: ~21 rows (approximately)
INSERT INTO `lflb_metadata` (`id`, `_oldid`, `contributor`, `creator`, `description`, `format`, `identifier`, `language`, `publisher`, `relation`, `rights`, `source`, `subject`, `type`, `created_at`, `updated_at`) VALUES
	(1, '5e88daac27c9bd3223eafa7f', '', 'Wendy Giangiorgi', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(2, '5e88ddbc27c9bd3223eafaa6', '', 'Amy Wagliardo', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(3, '5e8a1ff5a903963fa7bcf6d8', '', 'Mary and Steve Saville-Dauer', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(4, '5e8a2063a903963fa7bcf6e0', '', 'Mary and Steve Saville-Dauer', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(5, '5e8a251ca903963fa7bcf73a', '', 'Emily Watts', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(6, '5e8a2837a903963fa7bcf75d', '', 'Emily Watts', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(7, '5e8a3520a903963fa7bcf81e', '', 'Ellen Peter', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(8, '5e8a3537a903963fa7bcf828', '', 'Ann Vertovec', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(9, '5e8b82ea1ae89658cf8fdab6', '', 'Margaret Walker', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(10, '5e90d442bf145b53a38c45b6', '', 'Maddie Dugan', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(11, '5e9211153409066117dca049', '', 'Frank Sibley', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(12, '5e94a7443074e20bd232d861', '', 'Jennifer Randolph', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(13, '5e97673fa825962fb754a440', '', 'Ralph Behrens', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(14, '5e98b44a2f118533e7569cf4', '', 'Angelica Gail Sturm', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(15, '5e9b4e026272ae4fabfa82ab', '', 'Laurie Stein', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(16, '5ea2614ed136f978069174a7', 'Brenda Dick', '', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(17, '5ea5ec14d136f97806917903', '', 'Ralph Behrens', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(18, '5eb77bb4695c7f655f2b7ed0', '', 'Eileen Looby Weber', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(19, '5eb77bc8695c7f655f2b7ed8', '', 'Eileen Looby Weber', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(20, '5f03d6d5b728ea72b3584e14', '', '', '', '', '', '', 'Chicago Tribune', '', '', 'ProQuest Historical Newspapers', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58'),
	(21, '60089ead27f3740017c919ec', 'Ashley Canner', '', '', '', '', '', '', '', '', '', '', '', '2023-01-25 22:21:58', '2023-01-25 22:21:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
