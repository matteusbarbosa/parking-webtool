/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `tecweb_t1` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `tecweb_t1`;

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(3, 'José', '2016-10-11 16:16:03');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(4, 'Alfredo', '2016-10-11 16:16:13');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(5, 'Roberto', '2016-10-11 16:16:26');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(6, 'Luzia', '2016-10-11 16:16:32');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(7, 'sdasd', '2016-10-17 17:59:11');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(8, 'qweqweqweqwe', '2016-10-17 17:59:33');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(9, 'sdasdasd', '2016-10-17 18:00:40');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(10, 'sdasdas', '2016-10-17 18:01:05');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(11, 'asdasdasddsa', '2016-10-17 18:02:41');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(12, 'asdasdas', '2016-10-17 18:03:23');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(15, 'asdasdas', '2016-10-17 18:42:00');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(16, 'sdasdasdasda', '2016-10-17 17:51:32');
INSERT INTO `client` (`id`, `name`, `created_at`) VALUES
	(17, 'sdasdasa', '2016-10-17 17:55:06');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `parking` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_parking_client` (`client_id`),
  KEY `FK_parking_vehicle` (`vehicle_id`),
  CONSTRAINT `FK_parking_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_parking_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `parking` DISABLE KEYS */;
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(4, 11, 5, 'aasdasd', '2016-10-17 18:02:42', '2016-10-17 17:43:52');
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(5, 12, 6, 'dasdasdasd', '2016-10-17 18:03:23', NULL);
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(7, 15, 9, 'asdasdasd', '2016-10-17 18:42:00', '2016-10-17 17:42:12');
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(8, 4, 4, 'asdasd', '2016-10-17 17:47:45', '2016-10-17 17:51:11');
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(9, 16, 10, 'asdadasd', '2016-10-17 17:51:32', NULL);
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(10, 4, 4, 'asdadasd', '2016-10-17 17:54:10', '2016-10-17 17:54:30');
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(11, 4, 4, 'asdasdasd', '2016-10-17 17:54:14', '2016-10-17 17:54:18');
INSERT INTO `parking` (`id`, `client_id`, `vehicle_id`, `details`, `start_at`, `end_at`) VALUES
	(12, 17, 11, 'asdasdasd', '2016-10-17 17:55:06', '2016-10-17 17:55:12');
/*!40000 ALTER TABLE `parking` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `method_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_payment_vehicle` (`vehicle_id`),
  KEY `FK_payment_payment_method` (`method_id`),
  CONSTRAINT `FK_payment_payment_method` FOREIGN KEY (`method_id`) REFERENCES `payment_method` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payment_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` (`id`, `vehicle_id`, `method_id`, `price`, `created_at`) VALUES
	(4, 5, 1, 2.64, '2016-10-17 17:43:52');
INSERT INTO `payment` (`id`, `vehicle_id`, `method_id`, `price`, `created_at`) VALUES
	(5, 4, 1, 0.51, '2016-10-17 17:51:11');
INSERT INTO `payment` (`id`, `vehicle_id`, `method_id`, `price`, `created_at`) VALUES
	(6, 4, 1, 0.09, '2016-10-17 17:54:30');
INSERT INTO `payment` (`id`, `vehicle_id`, `method_id`, `price`, `created_at`) VALUES
	(7, 11, 1, 0, '2016-10-17 17:55:12');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `payment_method` DISABLE KEYS */;
INSERT INTO `payment_method` (`id`, `title`, `tax_price`) VALUES
	(1, 'Dinheiro', 1);
INSERT INTO `payment_method` (`id`, `title`, `tax_price`) VALUES
	(2, 'Crédito', 1.5);
INSERT INTO `payment_method` (`id`, `title`, `tax_price`) VALUES
	(3, 'Débito', 1.2);
/*!40000 ALTER TABLE `payment_method` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plaque` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `FK_vehicle_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` (`id`, `client_id`, `title`, `model`, `plaque`, `created_at`) VALUES
	(2, 5, 'PUNTO', 'FIAT', 'ABDC-1010', '2016-10-06 14:19:48');
INSERT INTO `vehicle` (`id`, `client_id`, `title`, `model`, `plaque`, `created_at`) VALUES
	(4, 4, 'CB300', 'HONDA', 'AHNC-4585', '2016-10-11 16:15:41');
INSERT INTO `vehicle` (`id`, `client_id`, `title`, `model`, `plaque`, `created_at`) VALUES
	(5, 11, '', '', 'asdasdasdd', '2016-10-17 18:02:41');
INSERT INTO `vehicle` (`id`, `client_id`, `title`, `model`, `plaque`, `created_at`) VALUES
	(6, 12, '', '', 'asdasd', '2016-10-17 18:03:23');
INSERT INTO `vehicle` (`id`, `client_id`, `title`, `model`, `plaque`, `created_at`) VALUES
	(9, 15, '', '', 'dasdasdasd', '2016-10-17 18:42:00');
INSERT INTO `vehicle` (`id`, `client_id`, `title`, `model`, `plaque`, `created_at`) VALUES
	(10, 16, '', '', 'asdasdasd', '2016-10-17 17:51:32');
INSERT INTO `vehicle` (`id`, `client_id`, `title`, `model`, `plaque`, `created_at`) VALUES
	(11, 17, '', '', 'asdasda', '2016-10-17 17:55:06');
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
