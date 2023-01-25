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

-- Dumping structure for table laravel_crud_test.lflb_categories
CREATE TABLE IF NOT EXISTS `lflb_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_oldid` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coverPhoto` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_categories_old` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_categories` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FALSE',
  `introText` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `bodyText` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `mainImage` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_crud_test.lflb_categories: ~32 rows (approximately)
INSERT INTO `lflb_categories` (`id`, `_oldid`, `title`, `description`, `coverPhoto`, `sub_categories_old`, `sub_categories`, `featured`, `introText`, `bodyText`, `mainImage`) VALUES
	(1, '5d95253ce8c73901d5b3a740', 'Changing The World', '', '3b6d7c70-e6de-11e9-9eb7-df2d05a0fe20.undefined', '5d95253ce8c73901d5b3a741,5d95253ce8c73901d5b3a742,5d95253de8c73901d5b3a743,5d95253de8c73901d5b3a744,5d95253de8c73901d5b3a745', '1,2,3,4,5', 'TRUE', '<h2>Author F. Scott Fitzgerald once wrote that he thought Lake Forest “the most glamorous place in the world.” Due to the wide scope of influence of so many that have called these towns home, Lake Forest and Lake Bluff have garnered national renown.</h2>', '<h3>In industry and finance, politics and philanthropy, inspiring great works of art and creating them, local residents have made their marks on the world. Sometimes this happens far away – in towering structures halfway across the globe, or even on a jou', 'CHANGING-HEADER.jpg'),
	(2, '5e18ce8bddaf5705be11fd0e', 'Timeline', '', '19109100-4785-11ea-aba7-1b48e92d690c-2500.jpeg', '5e18ce8bddaf5705be11fd0f,5e18ce8bddaf5705be11fd10,5e18ce8bddaf5705be11fd11,5e18ce8bddaf5705be11fd12,5e18ce8bddaf5705be11fd13,5e18ce8bddaf5705be11fd14,5e18ce8bddaf5705be11fd15,5e18ce8bddaf5705be11fd16,5e18ce8bddaf5705be11fd17,5e18ce8bddaf5705be11fd18,5e18ce8bddaf5705be11fd19,5e18ce8bddaf5705be11fd1a,5e18ce8bddaf5705be11fd1b,5e18ce8bddaf5705be11fd1c,5e18ce8bddaf5705be11fd1d,5e18ce8bddaf5705be11fd1e,5e18ce8bddaf5705be11fd1f,5e18ce8bddaf5705be11fd20', '31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48', 'FALSE', '', '', ''),
	(3, '5e10208cddaf5705be11f380', 'Newcomers', '', 'ee03e7f0-4784-11ea-aba7-1b48e92d690c-2500.jpeg', '5e10208cddaf5705be11f381,5e10208cddaf5705be11f382,5e10208cddaf5705be11f383,5e10208cddaf5705be11f384,5e10208cddaf5705be11f385', '26,27,28,29,30', 'TRUE', '<h2>From their beginnings, Lake Forest and Lake Bluff have been marked by people willing to try someplace new. Paleo-Indians built camps in the Skokie Valley, a transition point between wetland and woodland resources. Potawatomi expanded here southward fr', '<h3>The 1833 Treaty of Chicago removed the Potawatomi and opened the area to European settlement. Many of these pioneers had journeyed far from homes in Ireland and Scotland to build new lives and farms. Soon they were joined by others journeying a shorte', 'NEW-HEADER.jpg'),
	(4, '5da8a8e415a11502181b3154', 'Cooler By The Lake', '', '82dd0740-4784-11ea-aba7-1b48e92d690c-2500.jpeg', '5da8a8e415a11502181b3155,5da8a8e415a11502181b3156,5da8a8e415a11502181b3157,5da8a8e415a11502181b3158,5dc0ba88843bff7701becdcd', '6,7,8,9,10', 'TRUE', '<h2>From bluff to forest, the lake forms the backbone of these communities, and tells a big part of their story. Situated on America’s “third coast,” Chicago’s Lake Michigan border spurred the development of the metropolis, as well as its North Shore subu', '<h3>The attraction of a summer spent by the lake, whether in homes, hotels or camp meetings, inspired many of the towns’ early visitors, who often soon became permanent residents.</h3><h3>The first golf swing in the Midwest cut through the breeze above ou', 'COOLER-HEADER.png'),
	(5, '5e100bbcddaf5705be11f291', 'Nature By Design', '', 'd8c907d0-4784-11ea-aba7-1b48e92d690c-2500.jpeg', '5e100bbcddaf5705be11f292,5e100bbcddaf5705be11f293,5e100bbcddaf5705be11f294,5e100bbcddaf5705be11f295,5e100bbcddaf5705be11f296', '21,22,23,24,25', 'FALSE', '<h2>In 1857, Almerin Hotchkiss created a town plan for Lake Forest – curvilinear, park-like, embracing the ravines and unique terrain – that made it one of the first large-scale designed suburbs in the country. From this foundation, an essential community', '<h3>The natural setting drew landscape architects and gardeners, who sought to showcase and frame its beauty, giving rise to a national reputation.</h3><h3>As the land transitioned – from farm to gentleman farm to subdivision, from expansive estate to hom', 'NATURE-HEADER.png'),
	(6, '5df02fe636713532ceccfcb2', 'Making It Home', '', 'be5e07b0-4784-11ea-aba7-1b48e92d690c-2500.jpeg', '5df02fe636713532ceccfcb3,5df02fe636713532ceccfcb4,5df02fe636713532ceccfcb5,5df02fe636713532ceccfcb6,5df02fe636713532ceccfcb7', '16,17,18,19,20', 'TRUE', '<h2>Life in Lake Forest and Lake Bluff begins at home – architectural masterworks and converted coach-houses, homes with gates or in subdivisions, behind winding drives or in dormitories, homes with long histories or whose story is brand new.</h2>', '<h3>From the beginning, living and learning have been intertwined – learning at school or academy or college, learning at camp or church or club.</h3><h3>Many who live and learn in Lake Forest and Lake Bluff work in Chicago. But these towns have always be', 'MAKING-HEADER.png'),
	(7, '5dc0c336843bff7701bece38', 'Deer Path Middle School Museum Experience', '', 'e807fdb0-01ce-11ea-8b47-bf7269a63b7f.jpg', '', '', 'FALSE', '', '', ''),
	(8, '5dcefd8771b1d821a0ab98ca', 'Getting Here', '', 'a3168a40-4784-11ea-aba7-1b48e92d690c-2500.jpeg', '5dcefd8771b1d821a0ab98cb,5dcefd8771b1d821a0ab98cc,5dcefd8771b1d821a0ab98cd,5dcefd8771b1d821a0ab98ce,5dcefd8771b1d821a0ab98cf', '11,12,13,14,15', 'FALSE', '<h2>The stories of Lake Forest and Lake Bluff begin with pathways. The receding of the glaciers thousands of years ago created a unique network of ridges, rivers and ravines, navigated by early peoples passing through. The high ground became thoroughfares', '<h3>But it was the railroad connection to Chicago – built in 1855 – that truly set the stage. The beauty of the natural setting combined with accessibility by rail to a growing metropolis led to the establishment of Lake Forest and Lake Bluff in the mid-t', 'GETTING-HEADER.png'),
	(9, '5ec54940e3e04b4ebda4a022', 'Exhibits', '', '8b402270-9aac-11ea-841b-03e84066a74a-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(10, '5e3b23e04d4fc82459705970', 'Home & Abroad', 'Home life and travel experiences of young women in the 1920s and 2020s', '245f3220-4855-11ea-aba7-1b48e92d690c-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(11, '5e3d83cc6b73eb0e7924f46c', 'Education and Work', 'For 1920s women, education and work opportunities expanded, but only until marriage. ', '7d7c49e0-49bf-11ea-bd99-97c1ba3fab5c-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(12, '5e3c3f284d4fc82459705d49', 'Independence', 'Male authority dominated young women\'s lives in the 1920s, from passports to purchases to property. ', 'fcc55ce0-48fd-11ea-aba7-1b48e92d690c-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(13, '5efe8b41448aeb5ec77eab68', 'Archives', 'Archival materials like programs, flyers, letters, emails, etc.', '66335860-bccd-11ea-9085-5de00ccc9254-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(14, '5f03d789b728ea72b3584e2c', 'Videos', 'Visual recordings of events, people, stories', 'cdde6ba0-bff5-11ea-a44b-abad5b265d60-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(15, '5efe8b10448aeb5ec77eab5f', 'New articles', 'Clippings of articles from local news sources', '48b524d0-bccd-11ea-9085-5de00ccc9254-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(16, '5f03d143b728ea72b3584def', 'Oral Histories', 'Oral history interviews - transcripts, audio, video', '10ff0240-bff2-11ea-a44b-abad5b265d60-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(17, '5efe8ae0448aeb5ec77eab56', 'Photographs', 'Historic or current images of people, places, events', '2c602f00-bccd-11ea-9085-5de00ccc9254-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(18, '5efe8994448aeb5ec77eab44', 'Biographical profiles', 'Profiles of individuals or families who\'ve made their mark on Lake Forest-Lake Bluff', '6615b3b0-bccc-11ea-9085-5de00ccc9254-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(19, '5f14aa5e02eecf36938ebd1f', 'Student Stories', 'Images, experiences and reflections submitted by students', '473ca9f0-d1e7-11ea-ac8c-9178f4963936-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(20, '5f52604d56c35d5ae23025aa', 'News Stories', 'News from our schools', '2e6bdbd0-eec5-11ea-bce8-9946b8601487-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(21, '5f14aa6e02eecf36938ebd20', 'Parent Stories', 'Images, experiences and reflections submitted by parents and caregivers', '4f2c1100-d1e7-11ea-ac8c-9178f4963936-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(22, '5f14aa8b02eecf36938ebd21', 'Teacher Stories', 'Images, experiences and reflections submitted by teachers and staff', '58ba33f0-d1e7-11ea-ac8c-9178f4963936-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(23, '60dde008ebd2c30017d2a78b', 'Marketing Through Maps', 'The lines and dots and names written on a map give structure to the land and its built environment.', '76852d50-de88-11eb-b1a0-577592a3c30a-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(24, '60dccebd65ade40017fdd5aa', 'City Planning: Balancing Nature and Need', 'It is one of the dilemmas of settling land: People move to a place because of the natural beauty, th', '60a3d400-de88-11eb-8309-6526772ed0c2-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(25, '60dcdb2f80a7d50017122787', 'Mapping the Shifting Sands', 'Beyond the built world are maps that focus on the land itself. Geologic surveying of the US official', '9fac4d80-de88-11eb-b1a0-577592a3c30a-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(26, '60dcd8cf65ade40017fdd5ec', 'Passing Through and Settling In', 'Maps are built from the stories of people, their stops and starts, migrations and habitations, the c', '6b6f8000-de88-11eb-8309-6526772ed0c2-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(27, '60d63205b6a3a2001764d6d2', 'Introduction', 'People have created maps for more than 15 000 years The very first maps were of the stars on the cav', '54fc9510-de88-11eb-8309-6526772ed0c2-2500.jpeg', '', '', 'FALSE', '', '', ''),
	(28, '61b264b125108a0018a14990', 'Adventure', 'Adventure', 'c1a5fdd0-5dce-11ec-b13f-ef3bd649a7e3-2500.jpeg', '', '', 'TRUE', '', '', ''),
	(29, '61b2649d25108a0018a14981', 'Ancestral', 'Ancestral', 'b99a8340-5dce-11ec-8faf-73156275cda3-2500.jpeg', '', '', 'TRUE', '', '', ''),
	(30, '61b2646f9ca70c0018b667a7', 'The Grand Tour', 'The Grand Tour', '93421370-5dce-11ec-8faf-73156275cda3-2500.jpeg', '', '', 'TRUE', '', '', ''),
	(31, '61b2648a9ca70c0018b667aa', 'Education', 'Education', 'a801f730-5dce-11ec-b13f-ef3bd649a7e3-2500.jpeg', '', '', 'TRUE', '', '', ''),
	(32, '61b264c425108a0018a1499c', 'Spiritual', 'Spiritual', '5177e400-5ea1-11ec-8fc1-1795dec819c4-2500.jpeg', '', '', 'TRUE', '', '', '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
