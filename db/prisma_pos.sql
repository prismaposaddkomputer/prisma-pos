-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for prisma_pos
DROP DATABASE IF EXISTS `prisma_pos`;
CREATE DATABASE IF NOT EXISTS `prisma_pos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `prisma_pos`;

-- Dumping structure for table prisma_pos.app_install
DROP TABLE IF EXISTS `app_install`;
CREATE TABLE IF NOT EXISTS `app_install` (
  `install_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(1) NOT NULL DEFAULT '0',
  `install_status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`install_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.app_install: ~0 rows (approximately)
DELETE FROM `app_install`;
/*!40000 ALTER TABLE `app_install` DISABLE KEYS */;
INSERT INTO `app_install` (`install_id`, `type_id`, `install_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 1, '2018-04-18 12:14:03', 'System', '2018-07-03 09:40:41', 'System', 1, 0);
/*!40000 ALTER TABLE `app_install` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.app_type
DROP TABLE IF EXISTS `app_type`;
CREATE TABLE IF NOT EXISTS `app_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) NOT NULL,
  `type_icon` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.app_type: ~5 rows (approximately)
DELETE FROM `app_type`;
/*!40000 ALTER TABLE `app_type` DISABLE KEYS */;
INSERT INTO `app_type` (`type_id`, `type_name`, `type_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Prisma Retail', 'shopping-cart', '2018-04-18 12:15:09', 'System', '2018-04-18 12:25:11', 'System', 1, 0),
	(2, 'Prisma Restaurant', 'cutlery', '2018-04-18 12:15:36', 'System', '2018-04-18 12:20:19', 'System', 1, 0),
	(3, 'Prisma Hotel', 'hotel', '2018-04-18 12:15:36', 'System', '2018-04-18 12:24:27', 'System', 1, 0),
	(4, 'Prisma Karaoke', 'microphone', '2018-04-18 12:16:07', 'System', '2018-04-18 12:25:06', 'System', 1, 0),
	(5, 'Prisma Parking', 'car', '2018-05-17 11:33:54', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `app_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking
DROP TABLE IF EXISTS `hot_booking`;
CREATE TABLE IF NOT EXISTS `hot_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(128) NOT NULL,
  `guest_id` int(155) NOT NULL,
  `service_id` int(155) DEFAULT NULL,
  `number_of_days` int(155) NOT NULL,
  `room_id` int(155) NOT NULL,
  `date_booking` date NOT NULL,
  `date_booking_from` date NOT NULL,
  `date_booking_to` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `opsi_hari` int(155) DEFAULT '0',
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking: ~3 rows (approximately)
DELETE FROM `hot_booking`;
/*!40000 ALTER TABLE `hot_booking` DISABLE KEYS */;
INSERT INTO `hot_booking` (`booking_id`, `booking_code`, `guest_id`, `service_id`, `number_of_days`, `room_id`, `date_booking`, `date_booking_from`, `date_booking_to`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`, `opsi_hari`) VALUES
	(24, '2073', 7, 6, 3, 9, '2018-06-10', '2018-06-10', '2018-06-13', '2018-06-10 08:01:24', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, NULL),
	(25, '2097', 7, 6, 0, 6, '0000-00-00', '0000-00-00', '0000-00-00', '2018-06-10 08:01:34', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, NULL),
	(26, '2115', 7, 6, 3, 8, '2018-06-10', '2018-06-10', '2018-06-13', '2018-06-10 08:01:44', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, NULL);
/*!40000 ALTER TABLE `hot_booking` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking_diskon
DROP TABLE IF EXISTS `hot_booking_diskon`;
CREATE TABLE IF NOT EXISTS `hot_booking_diskon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `diskon_id` int(155) NOT NULL,
  `price` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking_diskon: ~3 rows (approximately)
DELETE FROM `hot_booking_diskon`;
/*!40000 ALTER TABLE `hot_booking_diskon` DISABLE KEYS */;
INSERT INTO `hot_booking_diskon` (`id`, `booking_id`, `diskon_id`, `price`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 0, 0, 0, '2018-05-22 15:56:03', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 1),
	(5, 0, 0, 0, '2018-06-02 15:40:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 1),
	(6, 0, 3000, 0, '2018-06-02 15:57:44', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);
/*!40000 ALTER TABLE `hot_booking_diskon` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking_room
DROP TABLE IF EXISTS `hot_booking_room`;
CREATE TABLE IF NOT EXISTS `hot_booking_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `room_id` int(155) NOT NULL,
  `price` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking_room: ~3 rows (approximately)
DELETE FROM `hot_booking_room`;
/*!40000 ALTER TABLE `hot_booking_room` DISABLE KEYS */;
INSERT INTO `hot_booking_room` (`id`, `booking_id`, `room_id`, `price`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 0, 0, 0, '2018-05-22 15:56:03', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 1),
	(5, 0, 0, 0, '2018-06-02 15:40:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 1),
	(6, 0, 3000, 0, '2018-06-02 15:57:44', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);
/*!40000 ALTER TABLE `hot_booking_room` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking_service
DROP TABLE IF EXISTS `hot_booking_service`;
CREATE TABLE IF NOT EXISTS `hot_booking_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `service_id` int(155) NOT NULL,
  `price` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking_service: ~3 rows (approximately)
DELETE FROM `hot_booking_service`;
/*!40000 ALTER TABLE `hot_booking_service` DISABLE KEYS */;
INSERT INTO `hot_booking_service` (`id`, `booking_id`, `service_id`, `price`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 0, 0, 0, '2018-05-22 15:56:03', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 1),
	(5, 0, 0, 0, '2018-06-02 15:40:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 1),
	(6, 0, 3000, 0, '2018-06-02 15:57:44', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);
/*!40000 ALTER TABLE `hot_booking_service` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_category
DROP TABLE IF EXISTS `hot_category`;
CREATE TABLE IF NOT EXISTS `hot_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `category_price` int(155) DEFAULT NULL,
  `category_desc` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_category: ~2 rows (approximately)
DELETE FROM `hot_category`;
/*!40000 ALTER TABLE `hot_category` DISABLE KEYS */;
INSERT INTO `hot_category` (`category_id`, `category_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`, `category_price`, `category_desc`) VALUES
	(4, 'sdsdsd', '2018-05-22 15:56:03', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 1, NULL, NULL),
	(5, 'Deluxe', '2018-06-02 15:40:51', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0, 4000, 'Ok');
/*!40000 ALTER TABLE `hot_category` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_client
DROP TABLE IF EXISTS `hot_client`;
CREATE TABLE IF NOT EXISTS `hot_client` (
  `client_id` varchar(32) NOT NULL,
  `client_name` varchar(32) NOT NULL,
  `client_brand` varchar(32) NOT NULL,
  `client_status` varchar(32) NOT NULL,
  `client_street` varchar(128) NOT NULL,
  `client_subdistrict` varchar(32) NOT NULL,
  `client_district` varchar(32) NOT NULL,
  `client_city` varchar(32) NOT NULL,
  `client_province` varchar(32) NOT NULL,
  `client_email` varchar(32) NOT NULL,
  `client_phone_1` varchar(15) NOT NULL,
  `client_phone_2` varchar(15) NOT NULL,
  `client_npwp` varchar(64) NOT NULL,
  `client_npwpd` varchar(64) NOT NULL,
  `client_owner_name` varchar(64) NOT NULL,
  `client_owner_address` text NOT NULL,
  `client_notes` text NOT NULL,
  `client_serial_number` varchar(20) NOT NULL,
  `client_keyboard_status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_client: ~0 rows (approximately)
DELETE FROM `hot_client`;
/*!40000 ALTER TABLE `hot_client` DISABLE KEYS */;
INSERT INTO `hot_client` (`client_id`, `client_name`, `client_brand`, `client_status`, `client_street`, `client_subdistrict`, `client_district`, `client_city`, `client_province`, `client_email`, `client_phone_1`, `client_phone_2`, `client_npwp`, `client_npwpd`, `client_owner_name`, `client_owner_address`, `client_notes`, `client_serial_number`, `client_keyboard_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	('1', 'CV Prisma Hotel', 'Prisma Hotel', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Hotel', 1, 0);
/*!40000 ALTER TABLE `hot_client` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_diskon
DROP TABLE IF EXISTS `hot_diskon`;
CREATE TABLE IF NOT EXISTS `hot_diskon` (
  `diskon_id` int(11) NOT NULL AUTO_INCREMENT,
  `diskon_name` varchar(128) NOT NULL,
  `diskon_price` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`diskon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_diskon: ~5 rows (approximately)
DELETE FROM `hot_diskon`;
/*!40000 ALTER TABLE `hot_diskon` DISABLE KEYS */;
INSERT INTO `hot_diskon` (`diskon_id`, `diskon_name`, `diskon_price`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 'sdsdsd', 0, '2018-05-22 15:56:03', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 1),
	(5, 'asas', 0, '2018-06-02 15:40:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 1),
	(6, 'wwssss', 3000, '2018-06-02 15:57:44', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 0, 1),
	(7, 'Akhir Tahun', 50, '2018-06-03 09:31:26', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0),
	(8, 'Awal Tahun', 20, '2018-06-10 01:23:20', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_diskon` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_guest
DROP TABLE IF EXISTS `hot_guest`;
CREATE TABLE IF NOT EXISTS `hot_guest` (
  `guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_name` varchar(128) NOT NULL,
  `guest_job` varchar(128) NOT NULL,
  `guest_gender` enum('L','P') NOT NULL,
  `guest_email` varchar(128) NOT NULL,
  `guest_address` text NOT NULL,
  `guest_number` int(155) NOT NULL,
  `guest_phone` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_guest: ~5 rows (approximately)
DELETE FROM `hot_guest`;
/*!40000 ALTER TABLE `hot_guest` DISABLE KEYS */;
INSERT INTO `hot_guest` (`guest_id`, `guest_name`, `guest_job`, `guest_gender`, `guest_email`, `guest_address`, `guest_number`, `guest_phone`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 'sdsdsd', '', 'L', '', '', 0, 0, '2018-05-22 15:56:03', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 1),
	(5, 'asas', '', 'L', '', '', 0, 0, '2018-06-02 15:40:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 1),
	(6, 'wwssss', '', 'L', '', '', 3000, 0, '2018-06-02 15:57:44', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 0, 1),
	(7, 'Adi', 'Mahasiswa', 'P', 'a@mail.com', 'Slmean', 92389238, 334, '2018-06-03 08:05:06', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 0, 0),
	(8, 'Paijo', 'Mahasiswa', 'P', 'a@mail.com', 'asas', 3478347, 3434, '2018-06-03 13:21:06', 'Super Hotel', '0000-00-00 00:00:00', 'System', 0, 0);
/*!40000 ALTER TABLE `hot_guest` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_log
DROP TABLE IF EXISTS `hot_log`;
CREATE TABLE IF NOT EXISTS `hot_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_log: ~4 rows (approximately)
DELETE FROM `hot_log`;
/*!40000 ALTER TABLE `hot_log` DISABLE KEYS */;
INSERT INTO `hot_log` (`log_id`, `user_id`, `user_realname`, `log_type`, `log_date`, `log_time`) VALUES
	(12, 1, 'Super Hotel', 'Sign In', '2018-06-10', '03:59:45'),
	(13, 1, 'Super Hotel', 'Sign In', '2018-06-10', '06:49:17'),
	(14, 1, 'Super Hotel', 'Sign In', '2018-06-21', '11:39:16'),
	(15, 1, 'Super Hotel', 'Sign Out', '2018-06-21', '11:40:17'),
	(16, 1, 'Super Hotel', 'Sign In', '2018-07-02', '16:20:35');
/*!40000 ALTER TABLE `hot_log` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_module
DROP TABLE IF EXISTS `hot_module`;
CREATE TABLE IF NOT EXISTS `hot_module` (
  `module_id` varchar(15) NOT NULL,
  `module_parent` varchar(15) NOT NULL,
  `module_name` varchar(32) NOT NULL,
  `module_folder` varchar(32) NOT NULL,
  `module_controller` varchar(32) NOT NULL,
  `module_url` varchar(32) NOT NULL,
  `module_icon` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_actived` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_module: ~18 rows (approximately)
DELETE FROM `hot_module`;
/*!40000 ALTER TABLE `hot_module` DISABLE KEYS */;
INSERT INTO `hot_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`, `module_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_actived`, `is_deleted`) VALUES
	('01', '', 'Dashboard', 'hot_dashboard', 'hot_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-05-18 13:42:41', 'Super Administrator', 1, 0),
	('02', '', 'Master', '', '', '#', 'cubes', '2018-05-22 15:39:02', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.01', '02', 'Tipe Kamar', 'hot_category', 'hot_category', 'index', 'cube', '2018-05-22 15:44:03', 'Super Hotel', '2018-06-03 07:36:54', 'Super Hotel', 1, 0),
	('02.02', '02', 'Kamar', 'hot_room', 'hot_room', 'index', 'cube', '2018-06-02 15:38:32', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.03', '02', 'Pelayanan Kamar', 'hot_service', 'hot_service', 'index', 'cube', '2018-06-02 15:56:55', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.04', '02', 'Tamu', 'hot_guest', 'hot_guest', 'index', 'cube', '2018-06-03 07:51:07', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.05', '02', 'Diskon', 'hot_diskon', 'hot_diskon', 'index', '', '2018-06-03 09:28:04', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	('03', '', 'Pemesanan', 'hot_booking', 'hot_booking', 'index', 'fa ticket-alt', '2018-06-03 09:22:02', 'Super Hotel', '2018-06-03 09:24:32', 'Super Hotel', 1, 0),
	('04', '', 'Pembayaran', 'hot_payment', 'hot_payment', 'index', 'fa fa-credit-card', '2018-06-03 09:23:03', 'Super Hotel', '2018-06-03 09:24:47', 'Super Hotel', 1, 0),
	('05', '', 'Laporan', 'hot_report', 'hot_report', 'index', 'fa fa-file', '2018-06-03 09:23:59', 'Super Hotel', '2018-06-03 09:24:58', 'Super Hotel', 1, 0),
	('05.01', '05', 'Laporan Pemesanan', 'hot_report_booking', 'hot_report_booking', 'index', 'fa-credit-card', '2018-06-10 01:22:08', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	('05.02', '05', 'Laporan Pembayaran', 'hot_report_payment', 'hot_report_payment', 'index', 'fa-credit-card', '2018-06-10 01:22:46', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('99.01', '99', 'Modul', 'hot_module', 'hot_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-05-18 13:42:44', 'Super Administrator', 1, 0),
	('99.02', '99', 'Role', 'hot_role', 'hot_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-05-18 13:42:47', 'Super Administrator', 1, 0),
	('99.03', '99', 'Pengguna', 'hot_user', 'hot_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-05-18 13:43:05', 'Super Administrator', 1, 0),
	('99.04', '99', 'Hak Akses', 'hot_permission', 'hot_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-05-18 13:43:09', '', 1, 0),
	('99.05', '99', 'Client', 'hot_client', 'hot_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-05-18 13:43:13', 'Super Administrator', 1, 0);
/*!40000 ALTER TABLE `hot_module` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_payment
DROP TABLE IF EXISTS `hot_payment`;
CREATE TABLE IF NOT EXISTS `hot_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `subtotal` int(155) DEFAULT '0',
  `disc` int(155) DEFAULT '0',
  `grand_total` int(155) DEFAULT '0',
  `cashed` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_payment: ~3 rows (approximately)
DELETE FROM `hot_payment`;
/*!40000 ALTER TABLE `hot_payment` DISABLE KEYS */;
INSERT INTO `hot_payment` (`id`, `booking_id`, `subtotal`, `disc`, `grand_total`, `cashed`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(15, 24, 4000, 0, 0, 1, '2018-06-10 08:01:24', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0),
	(16, 25, 4000, 50, 2000, 1, '2018-06-10 08:01:34', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0),
	(17, 26, 0, 0, 0, 0, '2018-06-10 08:01:44', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_payment` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_permission
DROP TABLE IF EXISTS `hot_permission`;
CREATE TABLE IF NOT EXISTS `hot_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` varchar(25) NOT NULL,
  `_create` int(1) DEFAULT NULL,
  `_read` int(1) DEFAULT NULL,
  `_update` int(1) DEFAULT NULL,
  `_delete` int(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=692 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_permission: ~18 rows (approximately)
DELETE FROM `hot_permission`;
/*!40000 ALTER TABLE `hot_permission` DISABLE KEYS */;
INSERT INTO `hot_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created`, `created_by`) VALUES
	(674, 0, '01', 1, 1, 1, 1, '2018-06-10 01:23:00', 'Super Hotel'),
	(675, 0, '02', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(676, 0, '02.01', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(677, 0, '02.02', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(678, 0, '02.03', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(679, 0, '02.04', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(680, 0, '02.05', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(681, 0, '03', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(682, 0, '04', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(683, 0, '05', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(684, 0, '05.01', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(685, 0, '05.02', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(686, 0, '99', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(687, 0, '99.01', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(688, 0, '99.02', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(689, 0, '99.03', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(690, 0, '99.04', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel'),
	(691, 0, '99.05', 1, 1, 1, 1, '2018-06-10 01:23:01', 'Super Hotel');
/*!40000 ALTER TABLE `hot_permission` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_role
DROP TABLE IF EXISTS `hot_role`;
CREATE TABLE IF NOT EXISTS `hot_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_role: ~3 rows (approximately)
DELETE FROM `hot_role`;
/*!40000 ALTER TABLE `hot_role` DISABLE KEYS */;
INSERT INTO `hot_role` (`role_id`, `role_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Super Administrator Hotel', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-18 13:44:46', 'Super Administrator', 1, 0),
	(1, 'Administrator Hotel', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-18 13:44:51', 'Super Administrator', 1, 0),
	(3, 'Cashier Hotel', '2018-05-08 13:42:21', 'Admin Hotel', '2018-05-18 13:45:02', 'Super Retail', 1, 0);
/*!40000 ALTER TABLE `hot_role` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_room
DROP TABLE IF EXISTS `hot_room`;
CREATE TABLE IF NOT EXISTS `hot_room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `room_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `room_number` int(155) NOT NULL,
  `room_floor` int(155) NOT NULL,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_room: ~4 rows (approximately)
DELETE FROM `hot_room`;
/*!40000 ALTER TABLE `hot_room` DISABLE KEYS */;
INSERT INTO `hot_room` (`room_id`, `category_id`, `room_name`, `created`, `room_number`, `room_floor`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(6, 5, 'Super 1', '2018-06-03 07:12:06', 6, 4, 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0),
	(7, 5, 'Super 2', '2018-06-03 12:28:28', 3, 2, 'Super Hotel', '0000-00-00 00:00:00', 'System', 0, 1),
	(8, 5, 'Super 2', '2018-06-03 12:30:31', 2, 5, 'Super Hotel', '0000-00-00 00:00:00', 'System', 0, 0),
	(9, 5, 'Super VVIP', '2018-06-10 07:59:41', 24, 4, 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_room` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_service
DROP TABLE IF EXISTS `hot_service`;
CREATE TABLE IF NOT EXISTS `hot_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(128) NOT NULL,
  `service_price` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_service: ~4 rows (approximately)
DELETE FROM `hot_service`;
/*!40000 ALTER TABLE `hot_service` DISABLE KEYS */;
INSERT INTO `hot_service` (`service_id`, `service_name`, `service_price`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 'sdsdsd', 0, '2018-05-22 15:56:03', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 1),
	(5, 'asas', 0, '2018-06-02 15:40:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 1),
	(6, 'Laundry', 3000, '2018-06-02 15:57:44', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0),
	(7, 'Breakfast', 50000, '2018-06-03 11:35:16', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_service` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_user
DROP TABLE IF EXISTS `hot_user`;
CREATE TABLE IF NOT EXISTS `hot_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_user: ~3 rows (approximately)
DELETE FROM `hot_user`;
/*!40000 ALTER TABLE `hot_user` DISABLE KEYS */;
INSERT INTO `hot_user` (`user_id`, `user_name`, `role_id`, `user_password`, `user_realname`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'superhotel', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Hotel', '2018-04-04 10:45:37', 'System', '2018-05-17 14:51:48', 'System', 1, 0),
	(2, 'adminhotel', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Hotel', '2018-05-08 13:40:40', 'System', '2018-05-17 14:51:52', 'System', 1, 0),
	(3, 'cashierhotel', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Hotel', '2018-05-08 13:43:54', 'System', '2018-05-17 14:51:57', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_user` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_bank
DROP TABLE IF EXISTS `kar_bank`;
CREATE TABLE IF NOT EXISTS `kar_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_id` int(11) NOT NULL,
  `bank_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_bank: ~0 rows (approximately)
DELETE FROM `kar_bank`;
/*!40000 ALTER TABLE `kar_bank` DISABLE KEYS */;
INSERT INTO `kar_bank` (`bank_id`, `payment_type_id`, `bank_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(3, 2, 'BRIS - Bank Rakyat Indonesia Syariah', '2018-06-02 16:23:59', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_bank` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_billing
DROP TABLE IF EXISTS `kar_billing`;
CREATE TABLE IF NOT EXISTS `kar_billing` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(128) NOT NULL,
  `tx_room_price` float(10,2) NOT NULL,
  `tx_duration` int(11) NOT NULL,
  `tx_room_price_total` float(10,2) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time_start` time NOT NULL,
  `tx_time_end` time NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `tx_payment` float(10,2) NOT NULL,
  `tx_status` int(1) NOT NULL DEFAULT '0',
  `tx_cancel_notes` text,
  `bank_id` int(11) NOT NULL,
  `bank_card_no` varchar(32) NOT NULL,
  `tx_total_tax` float(10,2) NOT NULL,
  `tx_total_discount` float(10,2) NOT NULL,
  `tx_total_before_tax` float(10,2) NOT NULL,
  `tx_total_after_tax` float(10,2) NOT NULL,
  `tx_total_grand` float(10,2) NOT NULL,
  `tx_change` float(10,2) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_billing: ~3 rows (approximately)
DELETE FROM `kar_billing`;
/*!40000 ALTER TABLE `kar_billing` DISABLE KEYS */;
INSERT INTO `kar_billing` (`tx_id`, `tx_receipt_no`, `user_id`, `user_realname`, `member_id`, `member_name`, `room_id`, `room_name`, `tx_room_price`, `tx_duration`, `tx_room_price_total`, `tx_date`, `tx_time_start`, `tx_time_end`, `payment_type_id`, `tx_payment`, `tx_status`, `tx_cancel_notes`, `bank_id`, `bank_card_no`, `tx_total_tax`, `tx_total_discount`, `tx_total_before_tax`, `tx_total_after_tax`, `tx_total_grand`, `tx_change`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '0', 1, 'Super Karaoke', 1, 'Surya', 2, 'D01', 50000.00, 1, 50000.00, '2018-06-08', '10:38:31', '11:38:31', 1, 100000.00, 2, NULL, 0, '', 0.00, 0.00, 50000.00, 0.00, 50000.00, 50000.00, '2018-06-08 10:38:31', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, '180626000001', 1, 'Super Karaoke', 1, 'Surya', 1, 'E01', 20000.00, 2, 40000.00, '2018-06-26', '11:28:11', '13:28:11', 0, 0.00, 0, NULL, 0, '', 0.00, 0.00, 40000.00, 0.00, 40000.00, 0.00, '2018-06-26 11:28:11', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, '180626000002', 1, 'Super Karaoke', 1, 'Surya', 2, 'D01', 50000.00, 2, 40000.00, '2018-06-26', '11:28:26', '13:28:26', 1, 50000.00, 2, NULL, 0, '', 0.00, 0.00, 40000.00, 0.00, 40000.00, 10000.00, '2018-06-26 11:28:26', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_billing` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_billing_service_charge
DROP TABLE IF EXISTS `kar_billing_service_charge`;
CREATE TABLE IF NOT EXISTS `kar_billing_service_charge` (
  `tx_service_charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `service_charge_id` int(11) NOT NULL,
  `service_charge_name` varchar(128) NOT NULL,
  `service_charge_price` float(10,2) NOT NULL,
  `service_charge_amount` int(11) NOT NULL,
  `service_charge_total` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_service_charge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_billing_service_charge: ~0 rows (approximately)
DELETE FROM `kar_billing_service_charge`;
/*!40000 ALTER TABLE `kar_billing_service_charge` DISABLE KEYS */;
INSERT INTO `kar_billing_service_charge` (`tx_service_charge_id`, `tx_id`, `service_charge_id`, `service_charge_name`, `service_charge_price`, `service_charge_amount`, `service_charge_total`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 2, 'Handuk Panas', 250.00, 25, 6250.00, '2018-06-03 20:55:29', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_billing_service_charge` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_client
DROP TABLE IF EXISTS `kar_client`;
CREATE TABLE IF NOT EXISTS `kar_client` (
  `client_id` varchar(32) NOT NULL,
  `client_name` varchar(32) NOT NULL,
  `client_brand` varchar(32) NOT NULL,
  `client_status` varchar(32) NOT NULL,
  `client_street` varchar(128) NOT NULL,
  `client_subdistrict` varchar(32) NOT NULL,
  `client_district` varchar(32) NOT NULL,
  `client_city` varchar(32) NOT NULL,
  `client_province` varchar(32) NOT NULL,
  `client_email` varchar(32) NOT NULL,
  `client_phone_1` varchar(15) NOT NULL,
  `client_phone_2` varchar(15) NOT NULL,
  `client_npwp` varchar(64) NOT NULL,
  `client_npwpd` varchar(64) NOT NULL,
  `client_owner_name` varchar(64) NOT NULL,
  `client_owner_address` text NOT NULL,
  `client_notes` text NOT NULL,
  `client_serial_number` varchar(20) NOT NULL,
  `client_keyboard_status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.kar_client: ~0 rows (approximately)
DELETE FROM `kar_client`;
/*!40000 ALTER TABLE `kar_client` DISABLE KEYS */;
INSERT INTO `kar_client` (`client_id`, `client_name`, `client_brand`, `client_status`, `client_street`, `client_subdistrict`, `client_district`, `client_city`, `client_province`, `client_email`, `client_phone_1`, `client_phone_2`, `client_npwp`, `client_npwpd`, `client_owner_name`, `client_owner_address`, `client_notes`, `client_serial_number`, `client_keyboard_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	('1', 'CV Prisma Karaoke', 'Prisma Karaoke', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Karaoke', 1, 0);
/*!40000 ALTER TABLE `kar_client` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_log
DROP TABLE IF EXISTS `kar_log`;
CREATE TABLE IF NOT EXISTS `kar_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_log: ~32 rows (approximately)
DELETE FROM `kar_log`;
/*!40000 ALTER TABLE `kar_log` DISABLE KEYS */;
INSERT INTO `kar_log` (`log_id`, `user_id`, `user_realname`, `log_type`, `log_date`, `log_time`) VALUES
	(1, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:14:23'),
	(2, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:14:23'),
	(3, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:19:02'),
	(4, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:22:12'),
	(5, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:22:15'),
	(6, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:23:26'),
	(7, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:23:49'),
	(8, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:24:41'),
	(9, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:24:43'),
	(10, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:31:55'),
	(11, 1, 'Super Retail', 'Sign Out', '2018-06-04', '15:27:29'),
	(12, 1, 'Super Karaoke', 'Sign In', '2018-06-04', '15:30:30'),
	(13, 1, 'Super Karaoke', 'Sign Out', '2018-06-04', '15:40:48'),
	(14, 1, 'Super Karaoke', 'Sign In', '2018-06-05', '08:20:34'),
	(15, 1, 'Super Karaoke', 'Sign Out', '2018-06-05', '08:27:24'),
	(16, 1, 'Super Karaoke', 'Sign In', '2018-06-05', '13:03:20'),
	(17, 1, 'Super Karaoke', 'Sign Out', '2018-06-05', '13:51:20'),
	(18, 1, 'Super Karaoke', 'Sign In', '2018-06-06', '10:05:00'),
	(19, 1, 'Super Karaoke', 'Sign Out', '2018-06-06', '10:11:32'),
	(20, 1, 'Super Karaoke', 'Sign In', '2018-06-07', '09:27:08'),
	(21, 1, 'Super Karaoke', 'Sign Out', '2018-06-07', '09:42:45'),
	(22, 1, 'Super Karaoke', 'Sign In', '2018-06-08', '10:29:52'),
	(23, 1, 'Super Karaoke', 'Sign Out', '2018-06-08', '10:51:11'),
	(24, 1, 'Super Karaoke', 'Sign In', '2018-06-26', '09:52:21'),
	(25, 1, 'Super Karaoke', 'Sign Out', '2018-06-26', '10:00:35'),
	(26, 1, 'Super Karaoke', 'Sign In', '2018-06-26', '11:19:02'),
	(27, 1, 'Super Karaoke', 'Sign Out', '2018-06-26', '11:29:17'),
	(28, 1, 'Super Karaoke', 'Sign In', '2018-07-02', '11:47:55'),
	(29, 1, 'Super Karaoke', 'Sign Out', '2018-07-02', '11:48:04'),
	(30, 1, 'Super Karaoke', 'Sign In', '2018-07-03', '08:38:01'),
	(31, 1, 'Super Karaoke', 'Sign Out', '2018-07-03', '08:41:17'),
	(32, 1, 'Super Karaoke', 'Sign In', '2018-07-03', '08:44:19'),
	(33, 1, 'Super Karaoke', 'Sign Out', '2018-07-03', '09:40:31');
/*!40000 ALTER TABLE `kar_log` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_member
DROP TABLE IF EXISTS `kar_member`;
CREATE TABLE IF NOT EXISTS `kar_member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type_id` int(11) NOT NULL DEFAULT '0',
  `member_name` varchar(255) NOT NULL,
  `member_phone` varchar(20) NOT NULL,
  `member_fax` varchar(20) NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `member_address` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_member: ~2 rows (approximately)
DELETE FROM `kar_member`;
/*!40000 ALTER TABLE `kar_member` DISABLE KEYS */;
INSERT INTO `kar_member` (`member_id`, `member_type_id`, `member_name`, `member_phone`, `member_fax`, `member_email`, `member_address`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 'Surya', '123', '', 'dm@gmail.com', 'dafsd', '2018-06-02 09:05:22', 'Super Karaoke', '0000-00-00 00:00:00', '', 1, 0),
	(2, 1, 'Budi', '1234', '', '', '', '2018-06-03 07:05:13', 'Super Karaoke', '0000-00-00 00:00:00', '', 1, 0);
/*!40000 ALTER TABLE `kar_member` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_member_type
DROP TABLE IF EXISTS `kar_member_type`;
CREATE TABLE IF NOT EXISTS `kar_member_type` (
  `member_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type_name` varchar(128) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.kar_member_type: ~0 rows (approximately)
DELETE FROM `kar_member_type`;
/*!40000 ALTER TABLE `kar_member_type` DISABLE KEYS */;
INSERT INTO `kar_member_type` (`member_type_id`, `member_type_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Gold', '2018-06-02 08:44:44', 'Super Karaoke', NULL, 'System', 1, 0);
/*!40000 ALTER TABLE `kar_member_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_module
DROP TABLE IF EXISTS `kar_module`;
CREATE TABLE IF NOT EXISTS `kar_module` (
  `module_id` varchar(15) NOT NULL,
  `module_parent` varchar(15) NOT NULL,
  `module_name` varchar(32) NOT NULL,
  `module_folder` varchar(32) NOT NULL,
  `module_controller` varchar(32) NOT NULL,
  `module_url` varchar(32) NOT NULL,
  `module_icon` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_actived` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.kar_module: ~24 rows (approximately)
DELETE FROM `kar_module`;
/*!40000 ALTER TABLE `kar_module` DISABLE KEYS */;
INSERT INTO `kar_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`, `module_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_actived`, `is_deleted`) VALUES
	('01', '', 'Dashboard', 'kar_dashboard', 'kar_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-05-18 10:41:20', 'Super Administrator', 1, 0),
	('02', '', 'Master', '', '', '#', 'cubes', '2018-06-01 20:12:17', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.01', '02', 'Waktu', 'kar_time', 'kar_time', 'index', 'clock-o', '2018-06-01 21:06:07', 'Super Karaoke', '2018-06-01 21:17:41', 'Super Karaoke', 1, 0),
	('02.02', '02', 'Tipe Ruang', 'kar_room_type', 'kar_room_type', 'index', 'home', '2018-06-01 20:21:07', 'Super Karaoke', '2018-06-02 06:30:00', 'Super Karaoke', 1, 0),
	('02.03', '02', 'Ruang', 'kar_room', 'kar_room', 'index', 'home', '2018-06-01 22:23:54', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.04', '02', 'Tipe Member', 'kar_member_type', 'kar_member_type', 'index', 'users', '2018-06-02 08:39:21', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.05', '02', 'Member', 'kar_member', 'kar_member', 'index', 'user', '2018-06-02 08:56:52', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.06', '02', 'Service Charge', 'kar_service_charge', 'kar_service_charge', 'index', 'plus', '2018-06-02 09:08:35', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.07', '02', 'Bank', 'kar_bank', 'kar_bank', 'index', 'university', '2018-06-02 16:20:27', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('03', '', 'Kasir', 'kar_cashier', 'kar_cashier', 'index', 'laptop', '2018-06-02 12:00:37', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('04', '', 'Laporan', '', '', 'index', 'files-o', '2018-06-03 15:38:31', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('04.01', '04', 'Penyewaan (Semua)', 'kar_report_billing', 'kar_report_billing', 'index', 'file', '2018-06-03 15:40:53', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('04.02', '04', 'Penyewaan (Kasir)', 'kar_report_billing_cashier', 'kar_report_billing_cashier', 'index', 'laptop', '2018-06-03 20:58:38', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('04.03', '04', 'Penyewaan (Member)', 'kar_report_billing_member', 'kar_report_billing_member', 'index', 'users', '2018-06-03 21:17:10', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('04.04', '04', 'Shift', 'kar_report_shift', 'kar_report_shift', 'index', 'user', '2018-06-03 21:38:26', 'Super Karaoke', '2018-06-03 21:40:01', 'Super Karaoke', 1, 0),
	('04.05', '04', 'Log Akses', 'kar_report_log', 'kar_report_log', 'index', 'users', '2018-06-05 08:21:20', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0),
	('04.06', '04', 'Piutang', 'kar_report_credit', 'kar_report_credit', 'index', 'credit-card', '2018-06-08 10:30:50', 'Super Karaoke', '2018-06-08 10:40:14', 'Super Karaoke', 1, 0),
	('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('99.01', '99', 'Modul', 'kar_module', 'kar_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-05-18 10:41:46', 'Super Administrator', 1, 0),
	('99.02', '99', 'Role', 'kar_role', 'kar_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-05-18 10:41:49', 'Super Administrator', 1, 0),
	('99.03', '99', 'Pengguna', 'kar_user', 'kar_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-05-18 10:41:52', 'Super Administrator', 1, 0),
	('99.04', '99', 'Hak Akses', 'kar_permission', 'kar_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-05-18 10:41:55', '', 1, 0),
	('99.05', '99', 'Client', 'kar_client', 'kar_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-05-18 10:41:58', 'Super Administrator', 1, 0),
	('99.06', '99', 'Struk', 'kar_receipt', 'kar_receipt', 'index', 'print', '2018-06-07 09:27:58', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_module` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_payment_type
DROP TABLE IF EXISTS `kar_payment_type`;
CREATE TABLE IF NOT EXISTS `kar_payment_type` (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_payment_type: ~3 rows (approximately)
DELETE FROM `kar_payment_type`;
/*!40000 ALTER TABLE `kar_payment_type` DISABLE KEYS */;
INSERT INTO `kar_payment_type` (`payment_type_id`, `payment_type_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Cash', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'Debit Card', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 'Credit Card', '2018-04-19 19:34:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_payment_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_permission
DROP TABLE IF EXISTS `kar_permission`;
CREATE TABLE IF NOT EXISTS `kar_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` varchar(25) NOT NULL,
  `_create` int(1) DEFAULT NULL,
  `_read` int(1) DEFAULT NULL,
  `_update` int(1) DEFAULT NULL,
  `_delete` int(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=902 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.kar_permission: ~24 rows (approximately)
DELETE FROM `kar_permission`;
/*!40000 ALTER TABLE `kar_permission` DISABLE KEYS */;
INSERT INTO `kar_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created`, `created_by`) VALUES
	(878, 0, '01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(879, 0, '02', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(880, 0, '02.01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(881, 0, '02.02', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(882, 0, '02.03', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(883, 0, '02.04', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(884, 0, '02.05', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(885, 0, '02.06', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(886, 0, '02.07', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(887, 0, '03', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(888, 0, '04', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(889, 0, '04.01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(890, 0, '04.02', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(891, 0, '04.03', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(892, 0, '04.04', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(893, 0, '04.05', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(894, 0, '04.06', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(895, 0, '99', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(896, 0, '99.01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke'),
	(897, 0, '99.02', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke'),
	(898, 0, '99.03', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke'),
	(899, 0, '99.04', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke'),
	(900, 0, '99.05', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke'),
	(901, 0, '99.06', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke');
/*!40000 ALTER TABLE `kar_permission` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_receipt
DROP TABLE IF EXISTS `kar_receipt`;
CREATE TABLE IF NOT EXISTS `kar_receipt` (
  `receipt_id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `receipt_name` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_street` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_district` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_city` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_province` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_npwp` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_footer` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`receipt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_receipt: ~0 rows (approximately)
DELETE FROM `kar_receipt`;
/*!40000 ALTER TABLE `kar_receipt` DISABLE KEYS */;
INSERT INTO `kar_receipt` (`receipt_id`, `receipt_name`, `receipt_street`, `receipt_district`, `receipt_city`, `receipt_province`, `receipt_npwp`, `receipt_footer`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 'Arigato', '2018-06-07 09:30:49', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_receipt` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_role
DROP TABLE IF EXISTS `kar_role`;
CREATE TABLE IF NOT EXISTS `kar_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.kar_role: ~4 rows (approximately)
DELETE FROM `kar_role`;
/*!40000 ALTER TABLE `kar_role` DISABLE KEYS */;
INSERT INTO `kar_role` (`role_id`, `role_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Super Administrator Karaoke', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-18 10:44:11', 'Super Administrator', 1, 0),
	(1, 'Administrator Karaoke', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-18 10:44:21', 'Super Administrator', 1, 0),
	(2, 'Cashier Karaoke', '2018-05-08 13:42:21', 'Admin Retail', '2018-06-03 21:04:44', 'Super Retail', 1, 0),
	(5, 'a', '2018-05-18 10:44:41', 'Super Karaoke', '2018-05-18 10:44:44', 'System', 1, 1);
/*!40000 ALTER TABLE `kar_role` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_room
DROP TABLE IF EXISTS `kar_room`;
CREATE TABLE IF NOT EXISTS `kar_room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_code` varchar(128) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_name` varchar(128) NOT NULL,
  `room_is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_room: ~2 rows (approximately)
DELETE FROM `kar_room`;
/*!40000 ALTER TABLE `kar_room` DISABLE KEYS */;
INSERT INTO `kar_room` (`room_id`, `room_code`, `room_type_id`, `room_name`, `room_is_used`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'E01', 3, 'E01', 0, '2018-06-01 22:36:49', 'Super Karaoke', '0000-00-00 00:00:00', 'Super Karaoke', 1, 0),
	(2, 'D01', 2, 'D01', 0, '2018-06-02 09:04:46', 'Super Karaoke', '0000-00-00 00:00:00', 'Super Karaoke', 1, 0);
/*!40000 ALTER TABLE `kar_room` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_room_type
DROP TABLE IF EXISTS `kar_room_type`;
CREATE TABLE IF NOT EXISTS `kar_room_type` (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_name` varchar(128) NOT NULL,
  `room_type_capacity` int(11) NOT NULL,
  `weekday_happy_hours` float(10,2) NOT NULL,
  `weekday_business_hours` float(10,2) NOT NULL,
  `weekend_happy_hours` float(10,2) NOT NULL,
  `weekend_business_hours` float(10,2) NOT NULL,
  `holiday_happy_hours` float(10,2) NOT NULL,
  `holiday_business_hours` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`room_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_room_type: ~2 rows (approximately)
DELETE FROM `kar_room_type`;
/*!40000 ALTER TABLE `kar_room_type` DISABLE KEYS */;
INSERT INTO `kar_room_type` (`room_type_id`, `room_type_name`, `room_type_capacity`, `weekday_happy_hours`, `weekday_business_hours`, `weekend_happy_hours`, `weekend_business_hours`, `holiday_happy_hours`, `holiday_business_hours`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(2, 'Deluxe', 0, 50000.00, 50000.00, 20000.00, 20000.00, 30000.00, 30000.00, '2018-06-01 22:00:54', 'Super Karaoke', '0000-00-00 00:00:00', 'Super Karaoke', 1, 0),
	(3, 'Economy', 5, 20000.00, 20000.00, 25000.00, 25000.00, 25000.00, 20000.00, '2018-06-01 22:20:40', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_room_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_service_charge
DROP TABLE IF EXISTS `kar_service_charge`;
CREATE TABLE IF NOT EXISTS `kar_service_charge` (
  `service_charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_charge_name` varchar(128) NOT NULL DEFAULT '0',
  `service_charge_price` float(10,2) NOT NULL DEFAULT '0.00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_charge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_service_charge: ~2 rows (approximately)
DELETE FROM `kar_service_charge`;
/*!40000 ALTER TABLE `kar_service_charge` DISABLE KEYS */;
INSERT INTO `kar_service_charge` (`service_charge_id`, `service_charge_name`, `service_charge_price`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(2, 'Handuk Panas', 250.00, '2018-06-02 09:15:32', 'Super Karaoke', NULL, 'System', 1, 0),
	(3, 'Telo', 25000.00, '2018-06-02 09:16:41', 'Super Karaoke', '2018-06-02 09:16:46', 'Super Karaoke', 1, 0);
/*!40000 ALTER TABLE `kar_service_charge` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_shift
DROP TABLE IF EXISTS `kar_shift`;
CREATE TABLE IF NOT EXISTS `kar_shift` (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date DEFAULT NULL,
  `shift_in_time` time DEFAULT NULL,
  `shift_out_date` date DEFAULT NULL,
  `shift_out_time` time DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT '0',
  `money_in_50k` int(11) NOT NULL DEFAULT '0',
  `money_in_20k` int(11) NOT NULL DEFAULT '0',
  `money_in_10k` int(11) NOT NULL DEFAULT '0',
  `money_in_5k` int(11) NOT NULL DEFAULT '0',
  `money_in_2k` int(11) NOT NULL DEFAULT '0',
  `money_in_1k` int(11) NOT NULL DEFAULT '0',
  `money_in_total` int(11) NOT NULL DEFAULT '0',
  `coin_in_1k` int(11) NOT NULL DEFAULT '0',
  `coin_in_500` int(11) NOT NULL DEFAULT '0',
  `coin_in_200` int(11) NOT NULL DEFAULT '0',
  `coin_in_100` int(11) NOT NULL DEFAULT '0',
  `coin_in_50` int(11) NOT NULL DEFAULT '0',
  `coin_in_25` int(11) NOT NULL DEFAULT '0',
  `coin_in_total` int(11) NOT NULL DEFAULT '0',
  `total_in` int(11) NOT NULL DEFAULT '0',
  `money_out_100k` int(11) NOT NULL DEFAULT '0',
  `money_out_50k` int(11) NOT NULL DEFAULT '0',
  `money_out_20k` int(11) NOT NULL DEFAULT '0',
  `money_out_10k` int(11) NOT NULL DEFAULT '0',
  `money_out_5k` int(11) NOT NULL DEFAULT '0',
  `money_out_2k` int(11) NOT NULL DEFAULT '0',
  `money_out_1k` int(11) NOT NULL DEFAULT '0',
  `money_out_total` int(11) NOT NULL DEFAULT '0',
  `coin_out_1k` int(11) NOT NULL DEFAULT '0',
  `coin_out_500` int(11) NOT NULL DEFAULT '0',
  `coin_out_200` int(11) NOT NULL DEFAULT '0',
  `coin_out_100` int(11) NOT NULL DEFAULT '0',
  `coin_out_50` int(11) NOT NULL DEFAULT '0',
  `coin_out_25` int(11) NOT NULL DEFAULT '0',
  `coin_out_total` int(11) NOT NULL DEFAULT '0',
  `total_out` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.kar_shift: ~6 rows (approximately)
DELETE FROM `kar_shift`;
/*!40000 ALTER TABLE `kar_shift` DISABLE KEYS */;
INSERT INTO `kar_shift` (`shift_id`, `user_id`, `user_realname`, `shift_in_status`, `shift_out_status`, `shift_in_date`, `shift_in_time`, `shift_out_date`, `shift_out_time`, `money_in_100k`, `money_in_50k`, `money_in_20k`, `money_in_10k`, `money_in_5k`, `money_in_2k`, `money_in_1k`, `money_in_total`, `coin_in_1k`, `coin_in_500`, `coin_in_200`, `coin_in_100`, `coin_in_50`, `coin_in_25`, `coin_in_total`, `total_in`, `money_out_100k`, `money_out_50k`, `money_out_20k`, `money_out_10k`, `money_out_5k`, `money_out_2k`, `money_out_1k`, `money_out_total`, `coin_out_1k`, `coin_out_500`, `coin_out_200`, `coin_out_100`, `coin_out_50`, `coin_out_25`, `coin_out_total`, `total_out`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	(1, 1, 'Super Retail', 1, 1, '2018-05-28', '10:13:28', '2018-05-28', '10:14:30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:13:28', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(2, 1, 'Super Retail', 1, 1, '2018-05-28', '10:17:11', '2018-05-28', '10:17:17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:17:11', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(3, 1, 'Super Retail', 1, 1, '2018-05-28', '10:19:49', '2018-05-30', '20:57:05', 1, 1, 1, 12, 1, 1, 0, 297000, 5, 5, 51, 1, 1, 1, 17875, 314875, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:19:49', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(4, 1, 'Super Karaoke', 1, 1, '2018-05-30', '20:57:07', '2018-06-02', '16:35:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-30 20:57:07', 'Super Retail', '0000-00-00 00:00:00', 'Super Karaoke'),
	(5, 1, 'Super Karaoke', 1, 1, '2018-06-02', '16:35:54', '2018-06-03', '07:26:35', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-02 16:35:54', 'Super Karaoke', '0000-00-00 00:00:00', 'Super Karaoke'),
	(6, 1, 'Super Karaoke', 1, 0, '2018-06-03', '07:26:53', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-03 07:26:53', 'Super Karaoke', '0000-00-00 00:00:00', 'System');
/*!40000 ALTER TABLE `kar_shift` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_time
DROP TABLE IF EXISTS `kar_time`;
CREATE TABLE IF NOT EXISTS `kar_time` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_name` varchar(128) NOT NULL,
  `time_start` time NOT NULL DEFAULT '00:00:00',
  `time_end` time NOT NULL DEFAULT '00:00:00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.kar_time: ~2 rows (approximately)
DELETE FROM `kar_time`;
/*!40000 ALTER TABLE `kar_time` DISABLE KEYS */;
INSERT INTO `kar_time` (`time_id`, `time_name`, `time_start`, `time_end`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Happy Hours', '08:00:00', '18:00:00', '2018-06-01 21:19:36', 'Super Karaoke', '2018-06-04 08:21:10', 'System', 1, 0),
	(2, 'Business Hours', '18:01:00', '24:00:00', '2018-06-01 21:22:20', 'Super Karaoke', '2018-06-03 20:43:16', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_time` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.kar_user
DROP TABLE IF EXISTS `kar_user`;
CREATE TABLE IF NOT EXISTS `kar_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.kar_user: ~3 rows (approximately)
DELETE FROM `kar_user`;
/*!40000 ALTER TABLE `kar_user` DISABLE KEYS */;
INSERT INTO `kar_user` (`user_id`, `user_name`, `role_id`, `user_password`, `user_realname`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'superkaraoke', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Karaoke', '2018-04-04 10:45:37', 'System', '2018-05-18 10:32:05', 'System', 1, 0),
	(2, 'adminkaraoke', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Karaoke', '2018-05-08 13:40:40', 'System', '2018-05-18 10:32:10', 'System', 1, 0),
	(3, 'cashierkaraoke', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Karaoke', '2018-05-08 13:43:54', 'System', '2018-05-18 10:32:16', 'System', 1, 0);
/*!40000 ALTER TABLE `kar_user` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_billing
DROP TABLE IF EXISTS `par_billing`;
CREATE TABLE IF NOT EXISTS `par_billing` (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `user_id_in` int(11) NOT NULL,
  `user_realname_in` varchar(128) NOT NULL,
  `user_id_out` int(11) DEFAULT NULL,
  `user_realname_out` varchar(128) DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `category_rate` float(10,2) NOT NULL,
  `category_is_flat` tinyint(1) NOT NULL,
  `category_per_hour` float(10,2) NOT NULL,
  `billing_tnkb` varchar(128) NOT NULL,
  `billing_status_in` tinyint(1) NOT NULL,
  `billing_status_out` tinyint(1) NOT NULL,
  `billing_date_in` date NOT NULL,
  `billing_time_in` time NOT NULL,
  `billing_date_out` date NOT NULL,
  `billing_time_out` time NOT NULL,
  `billing_duration` int(11) NOT NULL,
  `billing_total` float(10,2) NOT NULL,
  `billing_payment` float(10,2) NOT NULL,
  `billing_change` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_billing: ~15 rows (approximately)
DELETE FROM `par_billing`;
/*!40000 ALTER TABLE `par_billing` DISABLE KEYS */;
INSERT INTO `par_billing` (`billing_id`, `receipt_no`, `user_id_in`, `user_realname_in`, `user_id_out`, `user_realname_out`, `brand_id`, `brand_name`, `category_id`, `category_name`, `category_rate`, `category_is_flat`, `category_per_hour`, `billing_tnkb`, `billing_status_in`, `billing_status_out`, `billing_date_in`, `billing_time_in`, `billing_date_out`, `billing_time_out`, `billing_duration`, `billing_total`, `billing_payment`, `billing_change`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '180626000001', 1, 'Super Parking', 1, 'Super Parking', 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'AA123AA', 1, 1, '2018-06-26', '10:55:00', '2018-06-26', '11:12:33', 1, 2000.00, 5000.00, 3.00, '2018-06-26 10:55:00', 'Super Parking', '2018-06-26 11:12:37', 'Super Parking', 1, 0),
	(2, '180702000001', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'A', 1, 0, '2018-07-02', '11:52:29', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:52:29', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, '180702000002', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, '1', 1, 0, '2018-07-02', '11:52:39', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:52:39', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, '180702000003', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, '2', 1, 0, '2018-07-02', '11:53:04', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:53:04', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(5, '180702000004', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, '2', 1, 0, '2018-07-02', '11:53:36', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:53:36', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(6, '180702000005', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, '123', 1, 0, '2018-07-02', '11:54:51', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:54:51', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(7, '180702000006', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, '123', 1, 0, '2018-07-02', '11:55:24', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:55:24', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(8, '180702000007', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, '1234', 1, 0, '2018-07-02', '11:57:14', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:57:14', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, '180702000008', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'AA123CS', 1, 0, '2018-07-02', '11:59:12', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:59:12', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, '180702000009', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'AA123CC', 1, 0, '2018-07-02', '11:59:33', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:59:33', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, '180702000010', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'ZZ1231AC', 1, 0, '2018-07-02', '11:59:54', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 11:59:54', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(12, '180702000011', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'AA1AA', 1, 0, '2018-07-02', '12:00:35', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 12:00:35', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(13, '180702000012', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'DD6661UP', 1, 0, '2018-07-02', '12:02:38', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 12:02:38', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(14, '180702000013', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'AA1234VC', 1, 0, '2018-07-02', '12:03:07', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 12:03:07', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(15, '180702000014', 1, 'Super Parking', NULL, NULL, 2, 'Nissan', 4, 'Sepeda Motor', 2000.00, 1, 1000.00, 'AA8888DCS', 1, 0, '2018-07-02', '12:09:22', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, '2018-07-02 12:09:22', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `par_billing` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_brand
DROP TABLE IF EXISTS `par_brand`;
CREATE TABLE IF NOT EXISTS `par_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `update_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_brand: ~2 rows (approximately)
DELETE FROM `par_brand`;
/*!40000 ALTER TABLE `par_brand` DISABLE KEYS */;
INSERT INTO `par_brand` (`brand_id`, `brand_name`, `created`, `created_by`, `updated`, `update_by`, `is_active`, `is_deleted`) VALUES
	(2, 'Nissan', '2018-05-22 10:21:39', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	(99, 'Lainnya\r\n', '2018-05-22 10:20:18', 'System', '2018-05-22 10:43:06', 'System', 1, 0);
/*!40000 ALTER TABLE `par_brand` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_category
DROP TABLE IF EXISTS `par_category`;
CREATE TABLE IF NOT EXISTS `par_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) NOT NULL,
  `category_is_flat` tinyint(1) NOT NULL DEFAULT '0',
  `category_rate` float(10,2) NOT NULL,
  `category_per_hour` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_category: ~2 rows (approximately)
DELETE FROM `par_category`;
/*!40000 ALTER TABLE `par_category` DISABLE KEYS */;
INSERT INTO `par_category` (`category_id`, `category_name`, `category_is_flat`, `category_rate`, `category_per_hour`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 'Sepeda Motor', 1, 2000.00, 1000.00, '2018-05-22 09:06:50', 'Super Parking', '2018-05-22 09:41:18', 'Super Parking', 1, 0),
	(99, 'Tidak Terkategori', 0, 0.00, 0.00, '2018-05-08 13:26:31', 'System', '2018-05-22 10:43:22', 'System', 1, 0);
/*!40000 ALTER TABLE `par_category` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_client
DROP TABLE IF EXISTS `par_client`;
CREATE TABLE IF NOT EXISTS `par_client` (
  `client_id` varchar(32) NOT NULL,
  `client_name` varchar(32) NOT NULL,
  `client_brand` varchar(32) NOT NULL,
  `client_status` varchar(32) NOT NULL,
  `client_street` varchar(128) NOT NULL,
  `client_subdistrict` varchar(32) NOT NULL,
  `client_district` varchar(32) NOT NULL,
  `client_city` varchar(32) NOT NULL,
  `client_province` varchar(32) NOT NULL,
  `client_email` varchar(32) NOT NULL,
  `client_phone_1` varchar(15) NOT NULL,
  `client_phone_2` varchar(15) NOT NULL,
  `client_npwp` varchar(64) NOT NULL,
  `client_npwpd` varchar(64) NOT NULL,
  `client_owner_name` varchar(64) NOT NULL,
  `client_owner_address` text NOT NULL,
  `client_notes` text NOT NULL,
  `client_serial_number` varchar(20) NOT NULL,
  `client_keyboard_status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_client: ~0 rows (approximately)
DELETE FROM `par_client`;
/*!40000 ALTER TABLE `par_client` DISABLE KEYS */;
INSERT INTO `par_client` (`client_id`, `client_name`, `client_brand`, `client_status`, `client_street`, `client_subdistrict`, `client_district`, `client_city`, `client_province`, `client_email`, `client_phone_1`, `client_phone_2`, `client_npwp`, `client_npwpd`, `client_owner_name`, `client_owner_address`, `client_notes`, `client_serial_number`, `client_keyboard_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	('1', 'CV Prisma Parking', 'Prisma Parking', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Parking', 1, 0);
/*!40000 ALTER TABLE `par_client` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_log
DROP TABLE IF EXISTS `par_log`;
CREATE TABLE IF NOT EXISTS `par_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.par_log: ~27 rows (approximately)
DELETE FROM `par_log`;
/*!40000 ALTER TABLE `par_log` DISABLE KEYS */;
INSERT INTO `par_log` (`log_id`, `user_id`, `user_realname`, `log_type`, `log_date`, `log_time`) VALUES
	(1, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:14:23'),
	(2, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:14:23'),
	(3, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:19:02'),
	(4, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:22:12'),
	(5, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:22:15'),
	(6, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:23:26'),
	(7, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:23:49'),
	(8, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:24:41'),
	(9, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:24:43'),
	(10, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:31:55'),
	(11, 1, 'Super Retail', 'Sign Out', '2018-06-04', '15:27:29'),
	(12, 1, 'Super Parking', 'Sign In', '2018-06-05', '08:27:45'),
	(13, 1, 'Super Parking', 'Sign Out', '2018-06-05', '08:39:04'),
	(14, 1, 'Super Parking', 'Sign In', '2018-06-05', '08:40:24'),
	(15, 1, 'Super Parking', 'Sign Out', '2018-06-05', '09:50:12'),
	(16, 1, 'Super Parking', 'Sign In', '2018-06-05', '13:51:33'),
	(17, 1, 'Super Parking', 'Sign Out', '2018-06-05', '14:16:33'),
	(18, 1, 'Super Parking', 'Sign In', '2018-06-06', '10:11:47'),
	(19, 1, 'Super Parking', 'Sign Out', '2018-06-06', '10:32:34'),
	(20, 1, 'Super Parking', 'Sign In', '2018-06-07', '09:46:56'),
	(21, 1, 'Super Parking', 'Sign Out', '2018-06-07', '10:01:49'),
	(22, 1, 'Super Parking', 'Sign In', '2018-06-07', '10:26:03'),
	(23, 1, 'Super Parking', 'Sign Out', '2018-06-07', '10:56:55'),
	(24, 1, 'Super Parking', 'Sign In', '2018-06-08', '10:53:37'),
	(25, 1, 'Super Parking', 'Sign Out', '2018-06-08', '11:36:27'),
	(26, 1, 'Super Parking', 'Sign In', '2018-06-26', '10:00:51'),
	(27, 1, 'Super Parking', 'Sign Out', '2018-06-26', '11:18:23'),
	(28, 1, 'Super Parking', 'Sign In', '2018-07-02', '11:48:08'),
	(29, 1, 'Super Parking', 'Sign Out', '2018-07-02', '12:48:34');
/*!40000 ALTER TABLE `par_log` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_module
DROP TABLE IF EXISTS `par_module`;
CREATE TABLE IF NOT EXISTS `par_module` (
  `module_id` varchar(15) NOT NULL,
  `module_parent` varchar(15) NOT NULL,
  `module_name` varchar(32) NOT NULL,
  `module_folder` varchar(32) NOT NULL,
  `module_controller` varchar(32) NOT NULL,
  `module_url` varchar(32) NOT NULL,
  `module_icon` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_actived` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_module: ~20 rows (approximately)
DELETE FROM `par_module`;
/*!40000 ALTER TABLE `par_module` DISABLE KEYS */;
INSERT INTO `par_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`, `module_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_actived`, `is_deleted`) VALUES
	('01', '', 'Dashboard', 'par_dashboard', 'par_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-05-17 13:53:19', 'Super Administrator', 1, 0),
	('02', '', 'Master', '', '', '#', 'cubes', '2018-05-17 14:14:25', 'Super Parking', '2018-05-17 14:34:37', 'Super Parking', 1, 0),
	('02.01', '02', 'Kategori & Tarif', 'par_category', 'par_category', 'index', '', '2018-05-17 14:39:24', 'Super Parking', '2018-05-22 09:17:28', 'Super Parking', 1, 0),
	('02.02', '02', 'Merek', 'par_brand', 'par_brand', 'index', 'car', '2018-05-22 10:16:30', 'Super Parking', '2018-05-22 10:20:56', 'Super Parking', 1, 0),
	('04', '', 'Parkir Masuk', 'par_parking_in', 'par_parking_in', 'index', 'sign-in', '2018-05-22 09:57:57', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	('05', '', 'Parkir Keluar', 'par_parking_out', 'par_parking_out', 'index', 'sign-out', '2018-05-22 14:55:42', 'Super Parking', '2018-05-23 11:46:46', 'Super Parking', 1, 0),
	('06', '', 'Laporan', '', '', '#', 'files-o', '2018-05-24 15:02:11', 'Super Parking', '2018-05-24 15:16:44', 'Super Parking', 1, 0),
	('06.01', '06', 'Parkir Masuk', 'par_report_parking_in', 'par_report_parking_in', 'index', 'sign-in', '2018-05-24 15:18:48', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	('06.02', '06', 'Parkir Keluar', 'par_report_parking_out', 'par_report_parking_out', 'index', 'sign-out', '2018-05-25 13:55:34', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	('06.03', '06', 'Pendapatan', 'par_report_income', 'par_report_income', 'index', 'money', '2018-05-25 14:27:28', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0),
	('06.04', '06', 'Pendapatan (Kasir)', 'par_report_income_user', 'par_report_income_user', 'index', 'users', '2018-06-05 09:12:38', 'Super Parking', '2018-06-05 09:13:03', 'System', 1, 0),
	('06.06', '06', 'Shift', 'par_report_shift', 'par_report_shift', 'index', 'transfer', '2018-05-27 09:18:33', 'Super Parking', '2018-06-08 10:56:05', 'System', 1, 0),
	('06.07', '06', 'Log Akses', 'par_report_log', 'par_report_log', 'index', 'users', '2018-06-05 08:34:09', 'Super Parking', '2018-06-08 10:56:01', 'System', 1, 0),
	('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('99.01', '99', 'Modul', 'par_module', 'par_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-05-17 13:53:48', 'Super Administrator', 1, 0),
	('99.02', '99', 'Role', 'par_role', 'par_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-05-17 13:53:51', 'Super Administrator', 1, 0),
	('99.03', '99', 'Pengguna', 'par_user', 'par_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-05-17 13:53:55', 'Super Administrator', 1, 0),
	('99.04', '99', 'Hak Akses', 'par_permission', 'par_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-05-17 13:53:42', '', 1, 0),
	('99.05', '99', 'Client', 'par_client', 'par_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-05-17 13:53:58', 'Super Administrator', 1, 0),
	('99.06', '99', 'Struk', 'par_receipt', 'par_receipt', 'index', 'print', '2018-06-07 09:48:10', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `par_module` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_permission
DROP TABLE IF EXISTS `par_permission`;
CREATE TABLE IF NOT EXISTS `par_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` varchar(25) NOT NULL,
  `_create` int(1) DEFAULT NULL,
  `_read` int(1) DEFAULT NULL,
  `_update` int(1) DEFAULT NULL,
  `_delete` int(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=799 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_permission: ~37 rows (approximately)
DELETE FROM `par_permission`;
/*!40000 ALTER TABLE `par_permission` DISABLE KEYS */;
INSERT INTO `par_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created`, `created_by`) VALUES
	(722, 3, '01', 1, 1, 1, 1, '2018-05-27 10:37:25', 'Super Parking'),
	(723, 3, '04', 1, 1, 1, 1, '2018-05-27 10:37:25', 'Super Parking'),
	(726, 1, '01', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(727, 1, '02', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(728, 1, '02.01', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(729, 1, '02.02', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(730, 1, '06', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(731, 1, '06.01', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(732, 1, '06.02', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(733, 1, '06.03', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(734, 1, '06.04', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(735, 1, '99', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(736, 1, '99.03', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(737, 1, '99.05', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking'),
	(738, 5, '01', 1, 1, 1, 1, '2018-05-27 10:42:50', 'Super Parking'),
	(739, 5, '05', 1, 1, 1, 1, '2018-05-27 10:42:50', 'Super Parking'),
	(778, 0, '01', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(779, 0, '02', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(780, 0, '02.01', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(781, 0, '02.02', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(782, 0, '04', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(783, 0, '05', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(784, 0, '06', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(785, 0, '06.01', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(786, 0, '06.02', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(787, 0, '06.03', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(788, 0, '06.04', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(789, 0, '06.05', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking'),
	(790, 0, '06.06', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(791, 0, '06.07', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(792, 0, '99', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(793, 0, '99.01', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(794, 0, '99.02', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(795, 0, '99.03', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(796, 0, '99.04', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(797, 0, '99.05', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking'),
	(798, 0, '99.06', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
/*!40000 ALTER TABLE `par_permission` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_receipt
DROP TABLE IF EXISTS `par_receipt`;
CREATE TABLE IF NOT EXISTS `par_receipt` (
  `receipt_id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `receipt_name` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_street` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_district` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_city` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_province` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_npwp` tinyint(1) NOT NULL DEFAULT '1',
  `receipt_footer` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`receipt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.par_receipt: ~0 rows (approximately)
DELETE FROM `par_receipt`;
/*!40000 ALTER TABLE `par_receipt` DISABLE KEYS */;
INSERT INTO `par_receipt` (`receipt_id`, `receipt_name`, `receipt_street`, `receipt_district`, `receipt_city`, `receipt_province`, `receipt_npwp`, `receipt_footer`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 'Thank you', '2018-06-07 09:24:25', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `par_receipt` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_role
DROP TABLE IF EXISTS `par_role`;
CREATE TABLE IF NOT EXISTS `par_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_role: ~5 rows (approximately)
DELETE FROM `par_role`;
/*!40000 ALTER TABLE `par_role` DISABLE KEYS */;
INSERT INTO `par_role` (`role_id`, `role_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Super Administrator Parking', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-17 13:50:14', 'Super Administrator', 1, 0),
	(1, 'Administrator Parking', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-17 13:50:10', 'Super Administrator', 1, 0),
	(3, 'Cashier Parking In', '2018-05-08 13:42:21', 'Admin Retail', '2018-05-24 15:03:13', 'Super Parking', 1, 0),
	(4, 'a', '2018-05-17 14:06:42', 'Super Parking', '2018-05-17 14:06:46', 'System', 1, 1),
	(5, 'Cashier Parking Out', '2018-05-24 15:03:20', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `par_role` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_shift
DROP TABLE IF EXISTS `par_shift`;
CREATE TABLE IF NOT EXISTS `par_shift` (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `parking_type` tinyint(1) NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date DEFAULT NULL,
  `shift_in_time` time DEFAULT NULL,
  `shift_out_date` date DEFAULT NULL,
  `shift_out_time` time DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT '0',
  `money_in_50k` int(11) NOT NULL DEFAULT '0',
  `money_in_20k` int(11) NOT NULL DEFAULT '0',
  `money_in_10k` int(11) NOT NULL DEFAULT '0',
  `money_in_5k` int(11) NOT NULL DEFAULT '0',
  `money_in_2k` int(11) NOT NULL DEFAULT '0',
  `money_in_1k` int(11) NOT NULL DEFAULT '0',
  `money_in_total` int(11) NOT NULL DEFAULT '0',
  `coin_in_1k` int(11) NOT NULL DEFAULT '0',
  `coin_in_500` int(11) NOT NULL DEFAULT '0',
  `coin_in_200` int(11) NOT NULL DEFAULT '0',
  `coin_in_100` int(11) NOT NULL DEFAULT '0',
  `coin_in_50` int(11) NOT NULL DEFAULT '0',
  `coin_in_25` int(11) NOT NULL DEFAULT '0',
  `coin_in_total` int(11) NOT NULL DEFAULT '0',
  `total_in` int(11) NOT NULL DEFAULT '0',
  `money_out_100k` int(11) NOT NULL DEFAULT '0',
  `money_out_50k` int(11) NOT NULL DEFAULT '0',
  `money_out_20k` int(11) NOT NULL DEFAULT '0',
  `money_out_10k` int(11) NOT NULL DEFAULT '0',
  `money_out_5k` int(11) NOT NULL DEFAULT '0',
  `money_out_2k` int(11) NOT NULL DEFAULT '0',
  `money_out_1k` int(11) NOT NULL DEFAULT '0',
  `money_out_total` int(11) NOT NULL DEFAULT '0',
  `coin_out_1k` int(11) NOT NULL DEFAULT '0',
  `coin_out_500` int(11) NOT NULL DEFAULT '0',
  `coin_out_200` int(11) NOT NULL DEFAULT '0',
  `coin_out_100` int(11) NOT NULL DEFAULT '0',
  `coin_out_50` int(11) NOT NULL DEFAULT '0',
  `coin_out_25` int(11) NOT NULL DEFAULT '0',
  `coin_out_total` int(11) NOT NULL DEFAULT '0',
  `total_out` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.par_shift: ~5 rows (approximately)
DELETE FROM `par_shift`;
/*!40000 ALTER TABLE `par_shift` DISABLE KEYS */;
INSERT INTO `par_shift` (`shift_id`, `user_id`, `user_realname`, `parking_type`, `shift_in_status`, `shift_out_status`, `shift_in_date`, `shift_in_time`, `shift_out_date`, `shift_out_time`, `money_in_100k`, `money_in_50k`, `money_in_20k`, `money_in_10k`, `money_in_5k`, `money_in_2k`, `money_in_1k`, `money_in_total`, `coin_in_1k`, `coin_in_500`, `coin_in_200`, `coin_in_100`, `coin_in_50`, `coin_in_25`, `coin_in_total`, `total_in`, `money_out_100k`, `money_out_50k`, `money_out_20k`, `money_out_10k`, `money_out_5k`, `money_out_2k`, `money_out_1k`, `money_out_total`, `coin_out_1k`, `coin_out_500`, `coin_out_200`, `coin_out_100`, `coin_out_50`, `coin_out_25`, `coin_out_total`, `total_out`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	(1, 1, 'Super Parking', 0, 1, 1, '2018-05-27', '09:40:47', '2018-05-27', '10:01:38', 5, 5, 12, 2, 2, 2, 2, 1026000, 0, 1, 1, 0, 0, 0, 700, 1026700, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-27 09:40:47', 'Super Parking', '2018-05-27 10:01:38', 'Super Parking'),
	(2, 1, 'Super Parking', 1, 1, 0, '2018-05-27', '09:52:13', NULL, NULL, 2, 3, 1, 12, 0, 0, 0, 490000, 0, 0, 0, 0, 0, 0, 0, 490000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-27 09:52:13', 'Super Parking', '0000-00-00 00:00:00', 'System'),
	(3, 1, 'Super Karaoke', 0, 1, 1, '2018-05-27', '10:29:44', '2018-06-03', '07:25:36', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-27 10:29:44', 'Super Parking', '2018-06-03 07:25:36', 'Super Karaoke'),
	(4, 4, 'Cashier Parking Out', 1, 1, 0, '2018-05-27', '10:43:12', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-27 10:43:12', 'Cashier Parking Out', '0000-00-00 00:00:00', 'System'),
	(5, 1, 'Super Parking', 0, 1, 0, '2018-06-05', '08:43:26', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-05 08:43:26', 'Super Parking', '0000-00-00 00:00:00', 'System');
/*!40000 ALTER TABLE `par_shift` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.par_user
DROP TABLE IF EXISTS `par_user`;
CREATE TABLE IF NOT EXISTS `par_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.par_user: ~4 rows (approximately)
DELETE FROM `par_user`;
/*!40000 ALTER TABLE `par_user` DISABLE KEYS */;
INSERT INTO `par_user` (`user_id`, `user_name`, `role_id`, `user_password`, `user_realname`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'superparking', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Parking', '2018-04-04 10:45:37', 'System', '2018-05-17 11:39:14', 'System', 1, 0),
	(2, 'adminparking', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Parking', '2018-05-08 13:40:40', 'System', '2018-05-17 11:39:09', 'System', 1, 0),
	(3, 'cashierparkingin', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Parking In', '2018-05-08 13:43:54', 'System', '2018-05-24 15:03:52', 'Super Parking', 1, 0),
	(4, 'cashierparkingout', 5, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Parking Out', '2018-05-24 15:04:06', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `par_user` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_bank
DROP TABLE IF EXISTS `res_bank`;
CREATE TABLE IF NOT EXISTS `res_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_id` int(11) NOT NULL,
  `bank_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_bank: ~2 rows (approximately)
DELETE FROM `res_bank`;
/*!40000 ALTER TABLE `res_bank` DISABLE KEYS */;
INSERT INTO `res_bank` (`bank_id`, `payment_type_id`, `bank_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 'BNI - Bank Rakyat Indonesia', '2018-05-08 13:49:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 2, 'BRIS - Bank Rakyat Indonesia Syariah', '2018-05-28 08:40:29', 'Super Restaurant', '2018-05-28 08:40:41', 'Super Restaurant', 1, 0);
/*!40000 ALTER TABLE `res_bank` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_billing
DROP TABLE IF EXISTS `res_billing`;
CREATE TABLE IF NOT EXISTS `res_billing` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time NOT NULL,
  `tx_notes` text NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `tx_payment` float(10,2) NOT NULL,
  `tx_status` int(1) NOT NULL DEFAULT '0',
  `tx_cancel_notes` text,
  `bank_id` int(11) NOT NULL,
  `bank_card_no` varchar(32) NOT NULL,
  `bank_reference_no` varchar(32) NOT NULL,
  `tx_total_buy_average` float(10,2) NOT NULL,
  `tx_total_tax` float(10,2) NOT NULL,
  `tx_total_discount` float(10,2) NOT NULL,
  `tx_total_before_tax` float(10,2) NOT NULL,
  `tx_total_after_tax` float(10,2) NOT NULL,
  `tx_total_grand` float(10,2) NOT NULL,
  `tx_change` float(10,2) NOT NULL,
  `tx_total_profit_before_tax` float(10,2) NOT NULL,
  `tx_total_profit_after_tax` float(10,2) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_billing: ~3 rows (approximately)
DELETE FROM `res_billing`;
/*!40000 ALTER TABLE `res_billing` DISABLE KEYS */;
INSERT INTO `res_billing` (`tx_id`, `tx_receipt_no`, `user_id`, `user_realname`, `customer_id`, `customer_name`, `tx_type`, `tx_date`, `tx_time`, `tx_notes`, `payment_type_id`, `tx_payment`, `tx_status`, `tx_cancel_notes`, `bank_id`, `bank_card_no`, `bank_reference_no`, `tx_total_buy_average`, `tx_total_tax`, `tx_total_discount`, `tx_total_before_tax`, `tx_total_after_tax`, `tx_total_grand`, `tx_change`, `tx_total_profit_before_tax`, `tx_total_profit_after_tax`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '180628000001', 1, 'Super Restaurant', 0, 'Umum', 'TXS', '2018-06-28', '11:42:18', '', 1, 5000.00, 1, NULL, 0, '', '', 0.00, 400.00, 0.00, 4000.00, 4400.00, 4400.00, 600.00, 4000.00, 3600.00, '2018-06-28 11:42:23', 'Super Restaurant', '2018-06-28 11:43:19', 'System', 1, 0),
	(2, '180628000002', 1, 'Super Restaurant', 0, 'Umum', 'TXS', '2018-06-28', '13:44:46', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 4000.00, 0.00, 40000.00, 44000.00, 44000.00, 0.00, 40000.00, 36000.00, '2018-06-28 13:44:51', 'Super Restaurant', '2018-06-29 03:44:12', 'System', 1, 0),
	(3, '180629000001', 1, 'Super Restaurant', 0, 'Umum', 'TXS', '2018-06-29', '03:44:12', '', 1, 4000.00, 1, NULL, 0, '', '', 0.00, 360.00, 0.00, 3600.00, 3960.00, 3960.00, 40.00, 3600.00, 3240.00, '2018-06-29 03:44:18', 'Super Restaurant', '2018-06-29 03:44:26', 'System', 1, 0);
/*!40000 ALTER TABLE `res_billing` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_billing_buyall
DROP TABLE IF EXISTS `res_billing_buyall`;
CREATE TABLE IF NOT EXISTS `res_billing_buyall` (
  `billing_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `promo_buyall_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_billing_buyall: ~0 rows (approximately)
DELETE FROM `res_billing_buyall`;
/*!40000 ALTER TABLE `res_billing_buyall` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_billing_buyall` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_billing_buyget
DROP TABLE IF EXISTS `res_billing_buyget`;
CREATE TABLE IF NOT EXISTS `res_billing_buyget` (
  `billing_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `promo_buyget_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_billing_buyget: ~0 rows (approximately)
DELETE FROM `res_billing_buyget`;
/*!40000 ALTER TABLE `res_billing_buyget` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_billing_buyget` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_billing_buyitem
DROP TABLE IF EXISTS `res_billing_buyitem`;
CREATE TABLE IF NOT EXISTS `res_billing_buyitem` (
  `billing_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `promo_buyitem_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_billing_buyitem: ~0 rows (approximately)
DELETE FROM `res_billing_buyitem`;
/*!40000 ALTER TABLE `res_billing_buyitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_billing_buyitem` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_billing_detail
DROP TABLE IF EXISTS `res_billing_detail`;
CREATE TABLE IF NOT EXISTS `res_billing_detail` (
  `billing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_price_before_tax` float(10,2) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `item_price_buy_average` float(10,2) NOT NULL,
  `tx_amount` float NOT NULL,
  `tx_subtotal_tax` float(10,2) NOT NULL,
  `tx_subtotal_discount` float(10,2) NOT NULL,
  `tx_subtotal_buy_average` float(10,2) NOT NULL,
  `tx_subtotal_before_tax` float(10,2) NOT NULL,
  `tx_subtotal_after_tax` float(10,2) NOT NULL,
  `tx_subtotal_profit_before_tax` float(10,2) NOT NULL,
  `tx_subtotal_profit_after_tax` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.res_billing_detail: ~3 rows (approximately)
DELETE FROM `res_billing_detail`;
/*!40000 ALTER TABLE `res_billing_detail` DISABLE KEYS */;
INSERT INTO `res_billing_detail` (`billing_detail_id`, `tx_id`, `tx_type`, `item_id`, `item_name`, `item_price_before_tax`, `item_price_after_tax`, `item_price_buy_average`, `tx_amount`, `tx_subtotal_tax`, `tx_subtotal_discount`, `tx_subtotal_buy_average`, `tx_subtotal_before_tax`, `tx_subtotal_after_tax`, `tx_subtotal_profit_before_tax`, `tx_subtotal_profit_after_tax`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 1, 400.00, 0.00, 0.00, 4000.00, 4400.00, 4000.00, 3600.00, '2018-06-28 11:42:21', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 2, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 10, 4000.00, 0.00, 0.00, 40000.00, 44000.00, 40000.00, 36000.00, '2018-06-28 13:44:51', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 3, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 2, 360.00, 0.00, 0.00, 3600.00, 3960.00, 3600.00, 3240.00, '2018-06-29 03:44:17', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_billing_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_cashier_shift
DROP TABLE IF EXISTS `res_cashier_shift`;
CREATE TABLE IF NOT EXISTS `res_cashier_shift` (
  `cashier_shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `money_100k` int(11) NOT NULL,
  `money_50k` int(11) NOT NULL,
  `money_20k` int(11) NOT NULL,
  `money_10k` int(11) NOT NULL,
  `money_5k` int(11) NOT NULL,
  `money_2k` int(11) NOT NULL,
  `money_1k` int(11) NOT NULL,
  `money_total` int(11) NOT NULL,
  `coin_1k` int(11) NOT NULL,
  `coin_500` int(11) NOT NULL,
  `coin_200` int(11) NOT NULL,
  `coin_100` int(11) NOT NULL,
  `coin_50` int(11) NOT NULL,
  `coin_25` int(11) NOT NULL,
  `coin_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`cashier_shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_cashier_shift: ~0 rows (approximately)
DELETE FROM `res_cashier_shift`;
/*!40000 ALTER TABLE `res_cashier_shift` DISABLE KEYS */;
INSERT INTO `res_cashier_shift` (`cashier_shift_id`, `user_id`, `type`, `money_100k`, `money_50k`, `money_20k`, `money_10k`, `money_5k`, `money_2k`, `money_1k`, `money_total`, `coin_1k`, `coin_500`, `coin_200`, `coin_100`, `coin_50`, `coin_25`, `coin_total`, `total`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	(1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-21 09:28:31', 'Super Parking', '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `res_cashier_shift` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_category
DROP TABLE IF EXISTS `res_category`;
CREATE TABLE IF NOT EXISTS `res_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_category: ~14 rows (approximately)
DELETE FROM `res_category`;
/*!40000 ALTER TABLE `res_category` DISABLE KEYS */;
INSERT INTO `res_category` (`category_id`, `category_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Tidak Terkategori', '2018-05-08 13:26:31', 'System', '2018-05-08 13:26:44', 'System', 1, 0),
	(1, 'Movies', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'Tools', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 'Kids', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 'Industrial', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(5, 'Music', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(6, 'Movies', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(7, 'Games', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(8, 'Grocery', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, 'Movies', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, 'Computers', '2018-06-04 09:00:14', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, 'gggg', '2018-06-05 11:09:22', 'Super Restaurant', '2018-06-05 11:12:19', 'System', 1, 1),
	(12, 'ffffff', '2018-06-05 11:11:47', 'Super Restaurant', '2018-06-05 11:11:59', 'System', 1, 1),
	(13, 'ttttt', '2018-06-06 08:51:36', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_category` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_client
DROP TABLE IF EXISTS `res_client`;
CREATE TABLE IF NOT EXISTS `res_client` (
  `client_id` varchar(32) NOT NULL,
  `client_name` varchar(32) NOT NULL,
  `client_brand` varchar(32) NOT NULL,
  `client_status` varchar(32) NOT NULL,
  `client_street` varchar(128) NOT NULL,
  `client_subdistrict` varchar(32) NOT NULL,
  `client_district` varchar(32) NOT NULL,
  `client_city` varchar(32) NOT NULL,
  `client_province` varchar(32) NOT NULL,
  `client_email` varchar(32) NOT NULL,
  `client_phone_1` varchar(15) NOT NULL,
  `client_phone_2` varchar(15) NOT NULL,
  `client_npwp` varchar(64) NOT NULL,
  `client_npwpd` varchar(64) NOT NULL,
  `client_owner_name` varchar(64) NOT NULL,
  `client_owner_address` text NOT NULL,
  `client_notes` text NOT NULL,
  `client_serial_number` varchar(20) NOT NULL,
  `client_keyboard_status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_client: ~0 rows (approximately)
DELETE FROM `res_client`;
/*!40000 ALTER TABLE `res_client` DISABLE KEYS */;
INSERT INTO `res_client` (`client_id`, `client_name`, `client_brand`, `client_status`, `client_street`, `client_subdistrict`, `client_district`, `client_city`, `client_province`, `client_email`, `client_phone_1`, `client_phone_2`, `client_npwp`, `client_npwpd`, `client_owner_name`, `client_owner_address`, `client_notes`, `client_serial_number`, `client_keyboard_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	('1', 'CV Prisma Restaurant', 'Prisma Restaurant', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Restaurant', 1, 0);
/*!40000 ALTER TABLE `res_client` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_customer
DROP TABLE IF EXISTS `res_customer`;
CREATE TABLE IF NOT EXISTS `res_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_fax` varchar(20) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_customer: ~8 rows (approximately)
DELETE FROM `res_customer`;
/*!40000 ALTER TABLE `res_customer` DISABLE KEYS */;
INSERT INTO `res_customer` (`customer_id`, `customer_name`, `customer_phone`, `customer_fax`, `customer_email`, `customer_address`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Umum', '1234567890', '1234567890', 'umum@umum.com', 'Umum', '2018-05-08 11:07:30', 'Super Administrator', '2018-05-08 13:33:20', '', 1, 0),
	(2, 'rqwer', 'qwe234', '', 'df', 'asadf', '2018-05-08 13:57:00', 'Super Restaurant', '2018-05-08 14:02:53', '', 1, 1),
	(3, '', '', '', '', '', '2018-05-08 14:04:02', 'Super Restaurant', '2018-05-08 14:04:12', '', 1, 1),
	(4, 'Budi', '12345', '', 'budi@gmail.com', 'Jalan persatuan', '2018-05-28 08:35:42', 'Super Restaurant', '2018-05-28 08:35:48', '', 1, 1),
	(5, 'Khusus', '1234', '', 'telo@giam', 'cas', '2018-05-28 11:21:09', 'Super Restaurant', '0000-00-00 00:00:00', '', 1, 0),
	(6, 'Super', '123', '', 'a@gmal.com', 'asdf', '2018-06-04 10:01:20', '', '0000-00-00 00:00:00', '', 1, 0),
	(7, 'Tutu', '123', '', 'fasd@gmao.', 'fasdf', '2018-06-04 10:02:14', '', '0000-00-00 00:00:00', '', 1, 0),
	(8, 'Sdf', '123', '', 'adsf@gmaoi.com', 'asdfa', '2018-06-04 10:03:16', '', '0000-00-00 00:00:00', '', 1, 0);
/*!40000 ALTER TABLE `res_customer` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_item
DROP TABLE IF EXISTS `res_item`;
CREATE TABLE IF NOT EXISTS `res_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_barcode` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `item_price_before_tax` float(10,2) NOT NULL,
  `is_package` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL DEFAULT 'System',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_item: ~3 rows (approximately)
DELETE FROM `res_item`;
/*!40000 ALTER TABLE `res_item` DISABLE KEYS */;
INSERT INTO `res_item` (`item_id`, `category_id`, `unit_id`, `tax_id`, `item_name`, `item_barcode`, `item_desc`, `item_price_before_tax`, `is_package`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 0, 1, 'Ayam Goreng', '123', '', 4000.00, 0, '2018-05-14 11:06:00', 'Super Restaurant', '2018-05-28 08:30:17', 'Super Restaurant', 1, 0),
	(2, 3, 0, 1, 'Es Teh', '12354', '', 1800.00, 0, '2018-05-14 11:06:21', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 0, 0, 1, 'Paket 1', '', '', 5000.00, 1, '2018-05-14 11:06:43', 'Super Restaurant', '2018-05-28 08:30:35', 'System', 1, 1);
/*!40000 ALTER TABLE `res_item` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_item_package
DROP TABLE IF EXISTS `res_item_package`;
CREATE TABLE IF NOT EXISTS `res_item_package` (
  `item_package_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_detail_id` int(11) NOT NULL,
  `item_detail_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_item_package: ~0 rows (approximately)
DELETE FROM `res_item_package`;
/*!40000 ALTER TABLE `res_item_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_item_package` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_location
DROP TABLE IF EXISTS `res_location`;
CREATE TABLE IF NOT EXISTS `res_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(128) NOT NULL,
  `location_code` varchar(128) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_location: ~0 rows (approximately)
DELETE FROM `res_location`;
/*!40000 ALTER TABLE `res_location` DISABLE KEYS */;
INSERT INTO `res_location` (`location_id`, `location_name`, `location_code`, `is_available`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Meja 01', 'M01', 0, '2018-05-21 10:18:00', 'Super Parking', '2018-05-21 10:24:08', 'Super Parking', 1, 0);
/*!40000 ALTER TABLE `res_location` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_log
DROP TABLE IF EXISTS `res_log`;
CREATE TABLE IF NOT EXISTS `res_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.res_log: ~54 rows (approximately)
DELETE FROM `res_log`;
/*!40000 ALTER TABLE `res_log` DISABLE KEYS */;
INSERT INTO `res_log` (`log_id`, `user_id`, `user_realname`, `log_type`, `log_date`, `log_time`) VALUES
	(0, 1, 'Super Restaurant', 'Sign In', '2018-06-06', '08:39:04'),
	(1, 1, 'Super Restaurant', 'Sign In', '2018-06-04', '14:14:23'),
	(2, 1, 'Super Restaurant', 'Sign In', '2018-06-04', '14:14:23'),
	(3, 1, 'Super Restaurant', 'Sign In', '2018-06-04', '14:19:02'),
	(4, 1, 'Super Restaurant', 'Sign Out', '2018-06-04', '14:22:12'),
	(5, 1, 'Super Restaurant', 'Sign Out', '2018-06-04', '14:22:15'),
	(6, 1, 'Super Restaurant', 'Sign Out', '2018-06-04', '14:23:26'),
	(7, 1, 'Super Restaurant', 'Sign Out', '2018-06-04', '14:23:49'),
	(8, 1, 'Super Restaurant', 'Sign In', '2018-06-04', '14:24:41'),
	(9, 1, 'Super Restaurant', 'Sign Out', '2018-06-04', '14:24:43'),
	(10, 1, 'Super Restaurant', 'Sign In', '2018-06-04', '14:31:55'),
	(11, 1, 'Super Restaurant', 'Sign Out', '2018-06-04', '15:27:29'),
	(12, 1, 'Super Restaurant', 'Sign In', '2018-06-05', '09:50:38'),
	(13, 1, 'Super Restaurant', 'Sign Out', '2018-06-05', '10:57:15'),
	(14, 1, 'Super Restaurant', 'Sign In', '2018-06-05', '10:57:22'),
	(15, 1, 'Super Restaurant', 'Sign Out', '2018-06-05', '12:16:22'),
	(16, 1, 'Super Restaurant', 'Sign In', '2018-06-05', '14:16:53'),
	(17, 1, 'Super Restaurant', 'Sign Out', '2018-06-06', '09:35:30'),
	(18, 1, 'Super Restaurant', 'Sign In', '2018-06-06', '09:50:30'),
	(19, 1, 'Super Restaurant', 'Sign Out', '2018-06-06', '09:50:46'),
	(20, 1, 'Super Restaurant', 'Sign In', '2018-06-06', '10:44:02'),
	(21, 1, 'Super Restaurant', 'Sign In', '2018-06-07', '08:44:30'),
	(22, 1, 'Super Restaurant', 'Sign Out', '2018-06-07', '09:20:13'),
	(23, 1, 'Super Restaurant', 'Sign In', '2018-06-07', '10:59:33'),
	(24, 1, 'Super Restaurant', 'Sign Out', '2018-06-07', '15:01:44'),
	(25, 1, 'Super Restaurant', 'Sign In', '2018-06-08', '09:21:18'),
	(26, 1, 'Super Restaurant', 'Sign Out', '2018-06-08', '10:24:18'),
	(27, 1, 'Super Restaurant', 'Sign In', '2018-06-08', '11:36:43'),
	(28, 1, 'Super Restaurant', 'Sign In', '2018-06-13', '10:05:52'),
	(29, 1, 'Super Restaurant', 'Sign In', '2018-06-21', '08:14:16'),
	(30, 1, 'Super Restaurant', 'Sign Out', '2018-06-21', '09:49:03'),
	(31, 1, 'Super Restaurant', 'Sign In', '2018-06-21', '11:40:30'),
	(32, 1, 'Super Restaurant', 'Sign In', '2018-06-21', '14:20:56'),
	(33, 1, 'Super Restaurant', 'Sign In', '2018-06-22', '10:33:53'),
	(34, 1, 'Super Restaurant', 'Sign In', '2018-06-22', '10:37:45'),
	(35, 1, 'Super Restaurant', 'Sign In', '2018-06-22', '11:03:19'),
	(36, 1, 'Super Restaurant', 'Sign In', '2018-06-22', '11:27:07'),
	(37, 1, 'Super Restaurant', 'Sign In', '2018-06-25', '09:57:52'),
	(38, 1, 'Super Restaurant', 'Sign Out', '2018-06-25', '10:25:00'),
	(39, 1, 'Super Restaurant', 'Sign In', '2018-06-25', '10:25:31'),
	(40, 1, 'Super Restaurant', 'Sign In', '2018-06-26', '08:48:08'),
	(41, 1, 'Super Restaurant', 'Sign Out', '2018-06-26', '09:27:20'),
	(42, 1, 'Super Restaurant', 'Sign In', '2018-06-26', '11:32:53'),
	(43, 1, 'Super Restaurant', 'Sign In', '2018-06-26', '14:51:52'),
	(44, 1, 'Super Restaurant', 'Sign In', '2018-06-27', '09:30:32'),
	(45, 1, 'Super Restaurant', 'Sign In', '2018-06-27', '13:14:48'),
	(46, 1, 'Super Restaurant', 'Sign Out', '2018-06-27', '13:30:19'),
	(47, 1, 'Super Restaurant', 'Sign In', '2018-06-27', '13:30:25'),
	(48, 1, 'Super Restaurant', 'Sign In', '2018-06-28', '10:32:48'),
	(49, 1, 'Super Restaurant', 'Sign Out', '2018-06-28', '11:31:40'),
	(50, 1, 'Super Restaurant', 'Sign In', '2018-06-28', '11:32:13'),
	(51, 1, 'Super Restaurant', 'Sign In', '2018-06-28', '11:41:20'),
	(52, 1, 'Super Restaurant', 'Sign In', '2018-06-29', '03:36:31'),
	(53, 1, 'Super Restaurant', 'Sign Out', '2018-06-29', '03:36:39'),
	(54, 1, 'Super Restaurant', 'Sign In', '2018-07-02', '11:05:35'),
	(55, 1, 'Super Restaurant', 'Sign Out', '2018-07-02', '11:08:26');
/*!40000 ALTER TABLE `res_log` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_module
DROP TABLE IF EXISTS `res_module`;
CREATE TABLE IF NOT EXISTS `res_module` (
  `module_id` varchar(15) NOT NULL,
  `module_parent` varchar(15) NOT NULL,
  `module_name` varchar(32) NOT NULL,
  `module_folder` varchar(32) NOT NULL,
  `module_controller` varchar(32) NOT NULL,
  `module_url` varchar(32) NOT NULL,
  `module_icon` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_actived` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_module: ~39 rows (approximately)
DELETE FROM `res_module`;
/*!40000 ALTER TABLE `res_module` DISABLE KEYS */;
INSERT INTO `res_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`, `module_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_actived`, `is_deleted`) VALUES
	('01', '', 'Dashboard', 'res_dashboard', 'res_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-04-19 10:40:13', 'Super Administrator', 1, 0),
	('02', '', 'Master', '', '', '#', 'cubes', '2018-04-05 19:44:13', 'superadmin', '2018-04-05 19:45:13', 'superadmin', 1, 0),
	('02.01', '02', 'Kategori', 'res_category', 'res_category', 'index', 'paperclip', '2018-04-05 19:47:02', 'superadmin', '2018-04-05 21:22:37', 'Super Administrator', 1, 0),
	('02.02', '02', 'Satuan', 'res_unit', 'res_unit', 'index', 'dot-circle-o', '2018-04-05 22:14:53', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.03', '02', 'Item', 'res_item', 'res_item', 'index', 'list', '2018-04-07 15:49:43', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.04', '02', 'Suplier', 'res_supplier', 'res_supplier', 'index', 'truck', '2018-04-09 18:13:11', 'Super Administrator', '2018-04-09 18:53:55', 'Super Administrator', 1, 0),
	('02.05', '02', 'Pelanggan', 'res_customer', 'res_customer', 'index', 'users', '2018-04-10 08:56:24', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.06', '02', 'Bank', 'res_bank', 'res_bank', 'index', 'bank', '2018-04-18 08:38:55', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.07', '02', 'Pajak', 'res_tax', 'res_tax', 'index', 'chain', '2018-04-19 19:48:06', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.08', '02', 'Promo', 'res_promo', 'res_promo', 'index', 'ticket', '2018-04-20 09:21:42', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0),
	('03', '', 'Transaksi', '', '', '#', 'exchange', '2018-04-17 10:05:10', 'Super Administrator', '2018-06-07 11:17:10', 'Super Restaurant', 1, 0),
	('03.01', '03', 'Kasir', 'res_cashier', 'res_cashier', 'index', 'laptop', '2018-06-07 11:17:32', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	('03.02', '03', 'Retur', 'res_return', 'res_return', 'index', 'undo', '2018-06-07 11:19:02', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	('03.03', '03', 'Void', 'res_void', 'res_void', 'index', 'ban', '2018-06-07 14:17:41', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	('04', '', 'Inventori', '', '', '#', 'archive', '2018-04-10 10:37:46', 'Super Administrator', '2018-06-08 12:26:52', 'Super Restaurant', 1, 0),
	('04.01', '04', 'Stok Masuk', 'res_stock_in', 'res_stock_in', 'index', 'sign-in', '2018-04-10 10:54:00', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('04.02', '04', 'Stok Keluar', 'res_stock_out', 'res_stock_out', 'index', 'sign-out', '2018-04-11 10:48:29', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('04.03', '04', 'Stok Opname', 'res_stock_opname', 'res_stock_opname', 'index', 'exchange', '2018-04-11 13:54:55', 'Super Administrator', '2018-04-11 14:01:18', 'Super Administrator', 1, 0),
	('04.04', '04', 'Rekap Stok', 'res_stock_recap', 'res_stock_recap', 'index', 'files-o', '2018-04-11 14:11:28', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('04.05', '04', 'Purchace Order', 'res_po', 'res_po', 'index', 'file-text', '2018-04-12 12:36:57', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('05', '', 'Laporan', '', '', '#', 'files-o', '2018-05-04 09:10:39', 'Super Administrator', '2018-05-28 10:30:22', 'Super Restaurant', 1, 0),
	('05.01', '05', 'Penjualan (Semua)', 'res_report_selling', 'res_report_selling', 'index', 'money', '2018-05-28 10:32:42', 'Super Restaurant', '2018-05-28 10:53:56', 'Super Restaurant', 1, 0),
	('05.02', '05', 'Penjualan (Pelanggan)', 'res_report_selling_customer', 'res_report_selling_customer', 'index', 'users', '2018-05-28 10:52:44', 'Super Restaurant', '2018-05-28 10:53:42', 'Super Restaurant', 1, 0),
	('05.03', '05', 'Penjualan (Kategori)', 'res_report_selling_category', 'res_report_selling_category', 'index', 'cubes', '2018-05-28 11:41:33', 'Super Restaurant', '2018-05-28 14:18:04', 'Super Restaurant', 1, 0),
	('05.04', '05', 'Penjualan (Kasir)', 'res_report_selling_user', 'res_report_selling_user', 'index', 'laptop', '2018-06-04 09:06:23', 'Super Restaurant', '2018-06-04 09:18:32', 'Super Restaurant', 1, 0),
	('05.05', '05', 'Penjualan (Item)', 'res_report_selling_item', 'res_report_selling_item', 'index', 'cube', '2018-05-28 14:17:59', 'Super Restaurant', '2018-06-04 09:08:45', 'System', 1, 0),
	('05.06', '05', 'Omzet (Semua)', 'res_report_profit', 'res_report_profit', 'index', 'bar-chart', '2018-05-28 14:58:02', 'Super Restaurant', '2018-06-04 09:08:40', 'Super Restaurant', 1, 0),
	('05.07', '05', 'Omzet (Kasir)', 'res_report_profit_cashier', 'res_report_profit_cashier', 'index', 'laptop', '2018-05-28 15:33:42', 'Super Restaurant', '2018-06-08 10:20:55', 'Super Restaurant', 1, 0),
	('05.08', '05', 'Piutang', 'res_report_credit', 'res_report_credit', 'index', 'credit-card', '2018-06-08 09:51:51', 'Super Restaurant', '2018-06-08 10:20:49', 'Super Restaurant', 1, 0),
	('05.09', '05', 'Stok Barang', 'res_report_stock', 'res_report_stock', 'index', 'archive', '2018-05-29 21:31:00', 'Super Restaurant', '2018-06-08 09:52:48', 'System', 1, 0),
	('05.10', '05', 'Shift', 'res_report_shift', 'res_report_shift', 'index', 'transfer', '2018-05-29 21:58:13', 'Super Restaurant', '2018-06-08 09:52:41', 'System', 1, 0),
	('05.11', '05', 'Log Akses', 'res_report_log', 'res_report_log', 'index', 'files-o', '2018-06-04 14:33:00', 'Super Restaurant', '2018-06-08 09:52:36', 'Super Restaurant', 1, 0),
	('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('99.01', '99', 'Modul', 'res_module', 'res_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-04-19 10:40:32', 'Super Administrator', 1, 0),
	('99.02', '99', 'Role', 'res_role', 'res_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-04-19 10:40:40', 'Super Administrator', 1, 0),
	('99.03', '99', 'Pengguna', 'res_user', 'res_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-04-19 10:40:49', 'Super Administrator', 1, 0),
	('99.04', '99', 'Hak Akses', 'res_permission', 'res_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-04-19 10:40:56', '', 1, 0),
	('99.05', '99', 'Client', 'res_client', 'res_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-04-20 08:15:47', 'Super Administrator', 1, 0);
/*!40000 ALTER TABLE `res_module` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_payment_type
DROP TABLE IF EXISTS `res_payment_type`;
CREATE TABLE IF NOT EXISTS `res_payment_type` (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_payment_type: ~3 rows (approximately)
DELETE FROM `res_payment_type`;
/*!40000 ALTER TABLE `res_payment_type` DISABLE KEYS */;
INSERT INTO `res_payment_type` (`payment_type_id`, `payment_type_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Cash', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'Debit Card', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 'Credit Card', '2018-04-19 19:34:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_payment_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_permission
DROP TABLE IF EXISTS `res_permission`;
CREATE TABLE IF NOT EXISTS `res_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` varchar(25) NOT NULL,
  `_create` int(1) DEFAULT NULL,
  `_read` int(1) DEFAULT NULL,
  `_update` int(1) DEFAULT NULL,
  `_delete` int(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1093 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_permission: ~76 rows (approximately)
DELETE FROM `res_permission`;
/*!40000 ALTER TABLE `res_permission` DISABLE KEYS */;
INSERT INTO `res_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created`, `created_by`) VALUES
	(521, 3, '01', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Restaurant'),
	(522, 3, '03', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Restaurant'),
	(523, 3, '03.01', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Restaurant'),
	(524, 3, '03.02', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Restaurant'),
	(807, 1, '01', 1, 1, 1, 1, '2018-06-01 07:50:53', 'Super Restaurant'),
	(808, 1, '02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(809, 1, '02.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(810, 1, '02.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(811, 1, '02.03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(812, 1, '02.04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(813, 1, '02.05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(814, 1, '02.06', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(815, 1, '02.07', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(816, 1, '02.08', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(817, 1, '03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(818, 1, '04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(819, 1, '04.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(820, 1, '04.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(821, 1, '04.03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(822, 1, '04.04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(823, 1, '04.05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(824, 1, '05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(825, 1, '05.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(826, 1, '05.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Restaurant'),
	(827, 1, '05.03', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(828, 1, '05.04', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(829, 1, '05.05', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(830, 1, '05.06', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(831, 1, '05.07', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(832, 1, '05.08', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(833, 1, '99', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(834, 1, '99.03', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(835, 1, '99.05', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Restaurant'),
	(836, 2, '01', 1, 1, 1, 1, '2018-06-04 09:26:38', 'Super Restaurant'),
	(837, 2, '03', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Restaurant'),
	(838, 2, '05', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Restaurant'),
	(839, 2, '05.04', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Restaurant'),
	(1054, 0, '01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1055, 0, '02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1056, 0, '02.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1057, 0, '02.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1058, 0, '02.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1059, 0, '02.04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1060, 0, '02.05', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1061, 0, '02.06', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1062, 0, '02.07', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1063, 0, '02.08', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1064, 0, '03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1065, 0, '03.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1066, 0, '03.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1067, 0, '03.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1068, 0, '04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1069, 0, '04.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1070, 0, '04.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1071, 0, '04.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1072, 0, '04.04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1073, 0, '04.05', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Restaurant'),
	(1074, 0, '05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1075, 0, '05.01', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1076, 0, '05.02', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1077, 0, '05.03', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1078, 0, '05.04', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1079, 0, '05.05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1080, 0, '05.06', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1081, 0, '05.07', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1082, 0, '05.08', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1083, 0, '05.09', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1084, 0, '05.10', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1085, 0, '05.11', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1086, 0, '99', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1087, 0, '99.01', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1088, 0, '99.02', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1089, 0, '99.03', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1090, 0, '99.04', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1091, 0, '99.05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant'),
	(1092, 0, '99.06', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Restaurant');
/*!40000 ALTER TABLE `res_permission` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_po
DROP TABLE IF EXISTS `res_po`;
CREATE TABLE IF NOT EXISTS `res_po` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_po_no` varchar(255) NOT NULL,
  `tx_po_receiver` varchar(255) NOT NULL,
  `tx_notes` text NOT NULL,
  `tx_status` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_po: ~2 rows (approximately)
DELETE FROM `res_po`;
/*!40000 ALTER TABLE `res_po` DISABLE KEYS */;
INSERT INTO `res_po` (`tx_id`, `tx_receipt_no`, `supplier_id`, `tx_type`, `tx_date`, `tx_po_no`, `tx_po_receiver`, `tx_notes`, `tx_status`, `created`, `created_by`) VALUES
	(1, '180626000001', 4, 'TXP', '2018-06-26', '1231', '', 'fasdfa', 0, '2018-06-26 11:50:56', 'Super Restaurant'),
	(2, '180626000002', 4, 'TXP', '2018-06-26', '1231', '', 'afsfas', 0, '2018-06-26 11:51:17', 'Super Restaurant');
/*!40000 ALTER TABLE `res_po` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_po_detail
DROP TABLE IF EXISTS `res_po_detail`;
CREATE TABLE IF NOT EXISTS `res_po_detail` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_demand` float(10,2) NOT NULL,
  `stock_receive` float(10,2) NOT NULL,
  `stock_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_po_detail: ~2 rows (approximately)
DELETE FROM `res_po_detail`;
/*!40000 ALTER TABLE `res_po_detail` DISABLE KEYS */;
INSERT INTO `res_po_detail` (`stock_id`, `tx_id`, `tx_type`, `tx_date`, `item_id`, `stock_demand`, `stock_receive`, `stock_price`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	(4, 1, 'TXP', '2018-06-26', 1, 12.00, 0.00, 12.00, '2018-06-26 11:50:56', 'Super Restaurant', '0000-00-00 00:00:00', ''),
	(5, 2, 'TXP', '2018-06-26', 1, 12.00, 0.00, 12.00, '2018-06-26 11:51:17', 'Super Restaurant', '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `res_po_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_promo
DROP TABLE IF EXISTS `res_promo`;
CREATE TABLE IF NOT EXISTS `res_promo` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_id` int(1) NOT NULL,
  `promo_name` varchar(255) NOT NULL,
  `promo_date_start` date NOT NULL,
  `promo_date_end` date NOT NULL,
  `promo_time_start` time NOT NULL,
  `promo_time_end` time NOT NULL,
  `promo_sunday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_monday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_tuesday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_wednesday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_thursday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_friday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_saturday` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_promo: ~4 rows (approximately)
DELETE FROM `res_promo`;
/*!40000 ALTER TABLE `res_promo` DISABLE KEYS */;
INSERT INTO `res_promo` (`promo_id`, `promo_type_id`, `promo_name`, `promo_date_start`, `promo_date_end`, `promo_time_start`, `promo_time_end`, `promo_sunday`, `promo_monday`, `promo_tuesday`, `promo_wednesday`, `promo_thursday`, `promo_friday`, `promo_saturday`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 'Promo ayam beli 5 diskon 5%', '2018-05-01', '2018-05-31', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-14 11:13:13', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 1, 'Beli 3 Es Teh Gratis 1', '2018-05-01', '2018-05-31', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-15 09:36:17', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 3, 'Setiap Belanja 100.000 diskon 3%', '2018-05-01', '2018-05-31', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-15 09:56:44', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 1, 'Super Promo', '2018-05-28', '2018-05-28', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-28 08:51:08', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_promo` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_promo_buyall
DROP TABLE IF EXISTS `res_promo_buyall`;
CREATE TABLE IF NOT EXISTS `res_promo_buyall` (
  `promo_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` float(10,2) NOT NULL COMMENT 'in_percent',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_buyall_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_promo_buyall: ~0 rows (approximately)
DELETE FROM `res_promo_buyall`;
/*!40000 ALTER TABLE `res_promo_buyall` DISABLE KEYS */;
INSERT INTO `res_promo_buyall` (`promo_buyall_id`, `promo_id`, `buy_amount`, `get_discount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 3, 100000.00, 3.00, '2018-05-15 09:56:44', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_promo_buyall` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_promo_buyget
DROP TABLE IF EXISTS `res_promo_buyget`;
CREATE TABLE IF NOT EXISTS `res_promo_buyget` (
  `promo_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_buyget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_promo_buyget: ~2 rows (approximately)
DELETE FROM `res_promo_buyget`;
/*!40000 ALTER TABLE `res_promo_buyget` DISABLE KEYS */;
INSERT INTO `res_promo_buyget` (`promo_buyget_id`, `promo_id`, `buy_item_id`, `buy_amount`, `get_item_id`, `get_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 2, 3.00, 2, 1.00, '2018-05-15 09:36:17', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 4, 1, 2.00, 2, 3.00, '2018-05-28 08:51:07', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_promo_buyget` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_promo_buyitem
DROP TABLE IF EXISTS `res_promo_buyitem`;
CREATE TABLE IF NOT EXISTS `res_promo_buyitem` (
  `promo_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` float(10,2) NOT NULL COMMENT 'in_percent',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_buyitem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_promo_buyitem: ~0 rows (approximately)
DELETE FROM `res_promo_buyitem`;
/*!40000 ALTER TABLE `res_promo_buyitem` DISABLE KEYS */;
INSERT INTO `res_promo_buyitem` (`promo_buyitem_id`, `promo_id`, `buy_item_id`, `buy_amount`, `get_discount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 1, 5.00, 5.00, '2018-05-14 11:13:12', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_promo_buyitem` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_promo_type
DROP TABLE IF EXISTS `res_promo_type`;
CREATE TABLE IF NOT EXISTS `res_promo_type` (
  `promo_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_code` varchar(3) NOT NULL,
  `promo_type_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_promo_type: ~3 rows (approximately)
DELETE FROM `res_promo_type`;
/*!40000 ALTER TABLE `res_promo_type` DISABLE KEYS */;
INSERT INTO `res_promo_type` (`promo_type_id`, `promo_type_code`, `promo_type_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'PRB', 'Promo Buy Get', '2018-05-08 14:09:30', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'PRI', 'Promo Buy Item', '2018-05-08 14:09:30', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 'PRA', 'Promo Buy All\r\n', '2018-05-08 14:09:49', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_promo_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_return
DROP TABLE IF EXISTS `res_return`;
CREATE TABLE IF NOT EXISTS `res_return` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXR',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time NOT NULL,
  `return_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.res_return: ~0 rows (approximately)
DELETE FROM `res_return`;
/*!40000 ALTER TABLE `res_return` DISABLE KEYS */;
INSERT INTO `res_return` (`tx_id`, `tx_id_source`, `tx_receipt_no`, `tx_type`, `user_id`, `user_realname`, `customer_id`, `customer_name`, `tx_date`, `tx_time`, `return_notes`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, '180628000001', 'TXR', 1, 'Super Restaurant', 0, 'Umum', '2018-06-28', '12:47:15', 'Tidak enak', '2018-06-28 12:47:15', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_return` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_return_detail
DROP TABLE IF EXISTS `res_return_detail`;
CREATE TABLE IF NOT EXISTS `res_return_detail` (
  `return_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXR',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `tx_amount` float NOT NULL,
  `return_amount` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`return_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.res_return_detail: ~0 rows (approximately)
DELETE FROM `res_return_detail`;
/*!40000 ALTER TABLE `res_return_detail` DISABLE KEYS */;
INSERT INTO `res_return_detail` (`return_detail_id`, `tx_id`, `tx_type`, `item_id`, `item_name`, `item_price_after_tax`, `tx_amount`, `return_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 'TXR', 1, 'Ayam Goreng', 4400.00, 1, 1, '2018-06-28 12:47:16', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_return_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_role
DROP TABLE IF EXISTS `res_role`;
CREATE TABLE IF NOT EXISTS `res_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_role: ~3 rows (approximately)
DELETE FROM `res_role`;
/*!40000 ALTER TABLE `res_role` DISABLE KEYS */;
INSERT INTO `res_role` (`role_id`, `role_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Super Administrator Restaurant', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-08 13:40:17', 'Super Administrator', 1, 0),
	(1, 'Administrator Restaurant', '2018-03-30 11:18:19', 'Super Administrator', '2018-04-19 11:04:57', 'Super Administrator', 1, 0),
	(2, 'Cashier Restaurant', '2018-05-08 13:42:21', 'Admin Restaurant', '2018-05-28 22:17:09', 'Super Restaurant', 1, 0);
/*!40000 ALTER TABLE `res_role` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_shift
DROP TABLE IF EXISTS `res_shift`;
CREATE TABLE IF NOT EXISTS `res_shift` (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date DEFAULT NULL,
  `shift_in_time` time DEFAULT NULL,
  `shift_out_date` date DEFAULT NULL,
  `shift_out_time` time DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT '0',
  `money_in_50k` int(11) NOT NULL DEFAULT '0',
  `money_in_20k` int(11) NOT NULL DEFAULT '0',
  `money_in_10k` int(11) NOT NULL DEFAULT '0',
  `money_in_5k` int(11) NOT NULL DEFAULT '0',
  `money_in_2k` int(11) NOT NULL DEFAULT '0',
  `money_in_1k` int(11) NOT NULL DEFAULT '0',
  `money_in_total` int(11) NOT NULL DEFAULT '0',
  `coin_in_1k` int(11) NOT NULL DEFAULT '0',
  `coin_in_500` int(11) NOT NULL DEFAULT '0',
  `coin_in_200` int(11) NOT NULL DEFAULT '0',
  `coin_in_100` int(11) NOT NULL DEFAULT '0',
  `coin_in_50` int(11) NOT NULL DEFAULT '0',
  `coin_in_25` int(11) NOT NULL DEFAULT '0',
  `coin_in_total` int(11) NOT NULL DEFAULT '0',
  `total_in` int(11) NOT NULL DEFAULT '0',
  `money_out_100k` int(11) NOT NULL DEFAULT '0',
  `money_out_50k` int(11) NOT NULL DEFAULT '0',
  `money_out_20k` int(11) NOT NULL DEFAULT '0',
  `money_out_10k` int(11) NOT NULL DEFAULT '0',
  `money_out_5k` int(11) NOT NULL DEFAULT '0',
  `money_out_2k` int(11) NOT NULL DEFAULT '0',
  `money_out_1k` int(11) NOT NULL DEFAULT '0',
  `money_out_total` int(11) NOT NULL DEFAULT '0',
  `coin_out_1k` int(11) NOT NULL DEFAULT '0',
  `coin_out_500` int(11) NOT NULL DEFAULT '0',
  `coin_out_200` int(11) NOT NULL DEFAULT '0',
  `coin_out_100` int(11) NOT NULL DEFAULT '0',
  `coin_out_50` int(11) NOT NULL DEFAULT '0',
  `coin_out_25` int(11) NOT NULL DEFAULT '0',
  `coin_out_total` int(11) NOT NULL DEFAULT '0',
  `total_out` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.res_shift: ~5 rows (approximately)
DELETE FROM `res_shift`;
/*!40000 ALTER TABLE `res_shift` DISABLE KEYS */;
INSERT INTO `res_shift` (`shift_id`, `user_id`, `user_realname`, `shift_in_status`, `shift_out_status`, `shift_in_date`, `shift_in_time`, `shift_out_date`, `shift_out_time`, `money_in_100k`, `money_in_50k`, `money_in_20k`, `money_in_10k`, `money_in_5k`, `money_in_2k`, `money_in_1k`, `money_in_total`, `coin_in_1k`, `coin_in_500`, `coin_in_200`, `coin_in_100`, `coin_in_50`, `coin_in_25`, `coin_in_total`, `total_in`, `money_out_100k`, `money_out_50k`, `money_out_20k`, `money_out_10k`, `money_out_5k`, `money_out_2k`, `money_out_1k`, `money_out_total`, `coin_out_1k`, `coin_out_500`, `coin_out_200`, `coin_out_100`, `coin_out_50`, `coin_out_25`, `coin_out_total`, `total_out`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	(1, 1, 'Super Restaurant', 1, 1, '2018-05-28', '10:13:28', '2018-05-28', '10:14:30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:13:28', 'Super Restaurant', '0000-00-00 00:00:00', 'Super Restaurant'),
	(2, 1, 'Super Restaurant', 1, 1, '2018-05-28', '10:17:11', '2018-05-28', '10:17:17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:17:11', 'Super Restaurant', '0000-00-00 00:00:00', 'Super Restaurant'),
	(3, 1, 'Super Restaurant', 1, 1, '2018-05-28', '10:19:49', '2018-05-30', '20:57:05', 1, 1, 1, 12, 1, 1, 0, 297000, 5, 5, 51, 1, 1, 1, 17875, 314875, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:19:49', 'Super Restaurant', '0000-00-00 00:00:00', 'Super Restaurant'),
	(4, 1, 'Super Restaurant', 1, 1, '2018-05-30', '20:57:07', '2018-06-05', '10:57:10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-30 20:57:07', 'Super Restaurant', '0000-00-00 00:00:00', 'Super Restaurant'),
	(5, 1, 'Super Restaurant', 1, 0, '2018-06-05', '11:49:27', NULL, NULL, 56, 0, 0, 0, 0, 0, 0, 5600000, 0, 0, 0, 0, 0, 0, 0, 5600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-05 11:49:27', 'Super Restaurant', '0000-00-00 00:00:00', 'System');
/*!40000 ALTER TABLE `res_shift` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_stock
DROP TABLE IF EXISTS `res_stock`;
CREATE TABLE IF NOT EXISTS `res_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_in` float(10,2) NOT NULL,
  `stock_out` float(10,2) NOT NULL,
  `stock_adjustment` float(10,2) NOT NULL,
  `stock_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_stock: ~4 rows (approximately)
DELETE FROM `res_stock`;
/*!40000 ALTER TABLE `res_stock` DISABLE KEYS */;
INSERT INTO `res_stock` (`stock_id`, `tx_id`, `tx_type`, `tx_date`, `item_id`, `stock_in`, `stock_out`, `stock_adjustment`, `stock_price`, `created`, `created_by`) VALUES
	(1, 1, 'TXS', '2018-06-28', 1, 0.00, -1.00, 0.00, 0.00, '2018-06-28 11:43:19', 'Super Restaurant'),
	(2, 1, 'TXR', '2018-06-28', 1, 1.00, 0.00, 0.00, 0.00, '2018-06-28 12:47:16', 'System'),
	(3, 12, 'TXV', '2018-06-28', 1, 1.00, 0.00, 0.00, 0.00, '2018-06-28 12:51:48', 'System'),
	(4, 3, 'TXS', '2018-06-29', 2, 0.00, -2.00, 0.00, 0.00, '2018-06-29 03:44:26', 'Super Restaurant');
/*!40000 ALTER TABLE `res_stock` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_stock_in
DROP TABLE IF EXISTS `res_stock_in`;
CREATE TABLE IF NOT EXISTS `res_stock_in` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_stock_in: ~0 rows (approximately)
DELETE FROM `res_stock_in`;
/*!40000 ALTER TABLE `res_stock_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_stock_in` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_stock_opname
DROP TABLE IF EXISTS `res_stock_opname`;
CREATE TABLE IF NOT EXISTS `res_stock_opname` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text NOT NULL,
  `tx_status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_stock_opname: ~0 rows (approximately)
DELETE FROM `res_stock_opname`;
/*!40000 ALTER TABLE `res_stock_opname` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_stock_opname` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_stock_opname_detail
DROP TABLE IF EXISTS `res_stock_opname_detail`;
CREATE TABLE IF NOT EXISTS `res_stock_opname_detail` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_last` float(10,2) NOT NULL,
  `stock_now` float(10,2) NOT NULL,
  `stock_adjustment` float(10,2) NOT NULL,
  `stock_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_stock_opname_detail: ~0 rows (approximately)
DELETE FROM `res_stock_opname_detail`;
/*!40000 ALTER TABLE `res_stock_opname_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_stock_opname_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_stock_out
DROP TABLE IF EXISTS `res_stock_out`;
CREATE TABLE IF NOT EXISTS `res_stock_out` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_stock_out: ~0 rows (approximately)
DELETE FROM `res_stock_out`;
/*!40000 ALTER TABLE `res_stock_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `res_stock_out` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_supplier
DROP TABLE IF EXISTS `res_supplier`;
CREATE TABLE IF NOT EXISTS `res_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_phone` varchar(20) NOT NULL,
  `supplier_fax` varchar(20) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_address` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_supplier: ~5 rows (approximately)
DELETE FROM `res_supplier`;
/*!40000 ALTER TABLE `res_supplier` DISABLE KEYS */;
INSERT INTO `res_supplier` (`supplier_id`, `supplier_name`, `supplier_phone`, `supplier_fax`, `supplier_email`, `supplier_address`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'asdfasd12312', 'fasdfa', '1231231', '3212!fa@fahsd.com', 'hdalkjsdfa\r\n', '2018-05-08 13:56:44', 'Super Restaurant', '2018-05-08 13:56:50', 'Super Restaurant', 1, 1),
	(2, '', '', '', '', '', '2018-05-08 14:01:37', 'Super Restaurant', '2018-05-08 14:02:21', '', 1, 1),
	(3, '', '', '', '', '', '2018-05-08 14:02:03', 'Super Restaurant', '2018-05-08 14:02:24', '', 1, 1),
	(4, 'CV Mitra Abadi', '0293 713123', '085637283', 'mitra@miraabadi.com', 'Jalan Kenanga\r\n', '2018-05-09 08:40:54', 'Super Restaurant', '2018-06-04 09:04:14', 'Super Restaurant', 1, 0),
	(5, 'fasd', '121', '123', 'a@a.com', 'asdf', '2018-05-28 08:32:23', 'Super Restaurant', '2018-05-28 08:32:26', '', 1, 1);
/*!40000 ALTER TABLE `res_supplier` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_tax
DROP TABLE IF EXISTS `res_tax`;
CREATE TABLE IF NOT EXISTS `res_tax` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(8) NOT NULL,
  `tax_name` varchar(128) NOT NULL,
  `tax_ratio` float(10,2) NOT NULL COMMENT 'in percent',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_tax: ~0 rows (approximately)
DELETE FROM `res_tax`;
/*!40000 ALTER TABLE `res_tax` DISABLE KEYS */;
INSERT INTO `res_tax` (`tax_id`, `tax_code`, `tax_name`, `tax_ratio`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'PPn', 'Pajak Penjualan', 10.00, '2018-05-08 11:05:43', 'Super Administrator', '2018-05-09 08:35:14', 'System', 1, 0);
/*!40000 ALTER TABLE `res_tax` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_tx_type
DROP TABLE IF EXISTS `res_tx_type`;
CREATE TABLE IF NOT EXISTS `res_tx_type` (
  `tx_type` varchar(3) NOT NULL,
  `tx_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`tx_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_tx_type: ~6 rows (approximately)
DELETE FROM `res_tx_type`;
/*!40000 ALTER TABLE `res_tx_type` DISABLE KEYS */;
INSERT INTO `res_tx_type` (`tx_type`, `tx_name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	('TXA', 'Adjustment', '2018-04-11 13:59:45', 'System', '0000-00-00 00:00:00', ''),
	('TXI', 'In Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', ''),
	('TXO', 'Out Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', ''),
	('TXP', 'Purchase Order\r\n', '2018-04-12 14:15:57', 'System', '0000-00-00 00:00:00', ''),
	('TXR', 'Receive Order', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', ''),
	('TXS', 'Selling ', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `res_tx_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_unit
DROP TABLE IF EXISTS `res_unit`;
CREATE TABLE IF NOT EXISTS `res_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(10) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_unit: ~7 rows (approximately)
DELETE FROM `res_unit`;
/*!40000 ALTER TABLE `res_unit` DISABLE KEYS */;
INSERT INTO `res_unit` (`unit_id`, `unit_code`, `unit_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'pcs', 'Pieces', '2018-05-08 13:31:41', 'System', '2018-06-04 09:01:43', '', 1, 0),
	(1, 'gr', 'Gram', '2018-06-04 09:02:07', 'System', '2018-06-04 09:02:10', '', 1, 0),
	(2, 'kg', 'Kilogram', '2018-06-04 09:02:32', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(3, 'doz', 'Lusin', '2018-06-04 09:02:46', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(4, 'pks', 'Packs', '2018-06-04 09:03:03', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(5, 'gross', 'Gross', '2018-06-04 09:03:16', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(6, 'krtn', 'Karton', '2018-06-04 09:03:28', 'System', '0000-00-00 00:00:00', '', 1, 0);
/*!40000 ALTER TABLE `res_unit` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_user
DROP TABLE IF EXISTS `res_user`;
CREATE TABLE IF NOT EXISTS `res_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.res_user: ~3 rows (approximately)
DELETE FROM `res_user`;
/*!40000 ALTER TABLE `res_user` DISABLE KEYS */;
INSERT INTO `res_user` (`user_id`, `user_name`, `role_id`, `user_password`, `user_realname`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'superrestaurant', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Restaurant', '2018-04-04 10:45:37', '', '2018-05-08 13:40:06', 'Super Administrator', 1, 0),
	(2, 'adminrestaurant', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Restaurant', '2018-05-08 13:40:40', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 'cashierrestaurant', 2, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Restaurant', '2018-06-04 09:27:29', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_user` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_void
DROP TABLE IF EXISTS `res_void`;
CREATE TABLE IF NOT EXISTS `res_void` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXV',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time NOT NULL,
  `void_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.res_void: ~5 rows (approximately)
DELETE FROM `res_void`;
/*!40000 ALTER TABLE `res_void` DISABLE KEYS */;
INSERT INTO `res_void` (`tx_id`, `tx_receipt_no`, `tx_id_source`, `tx_type`, `user_id`, `user_realname`, `customer_id`, `customer_name`, `tx_date`, `tx_time`, `void_notes`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(8, '0', 1, 'TXV', 1, 'Super Restaurant', 0, 'Umum', '2018-06-07', '14:54:17', '', '2018-06-07 14:54:17', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, '0', 0, 'TXV', 1, 'Super Restaurant', 0, 'Umum', '2018-06-13', '10:06:20', '', '2018-06-13 10:06:20', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, '180627000002', 21, 'TXV', 1, 'Super Restaurant', 0, 'Umum', '2018-06-27', '13:24:40', '', '2018-06-27 13:24:40', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, '180627000002', 21, 'TXV', 1, 'Super Restaurant', 0, 'Umum', '2018-06-27', '13:29:57', 'fasdfasd', '2018-06-27 13:29:57', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(12, '180628000001', 1, 'TXV', 1, 'Super Restaurant', 0, 'Umum', '2018-06-28', '12:51:48', 'tidak ', '2018-06-28 12:51:48', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_void` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.res_void_detail
DROP TABLE IF EXISTS `res_void_detail`;
CREATE TABLE IF NOT EXISTS `res_void_detail` (
  `void_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXV',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `tx_amount` float NOT NULL,
  `void_amount` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`void_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.res_void_detail: ~5 rows (approximately)
DELETE FROM `res_void_detail`;
/*!40000 ALTER TABLE `res_void_detail` DISABLE KEYS */;
INSERT INTO `res_void_detail` (`void_detail_id`, `tx_id`, `tx_type`, `item_id`, `item_name`, `item_price_after_tax`, `tx_amount`, `void_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(9, 8, 'TXV', 1, 'Ayam Goreng', 4400.00, 1, 1, '2018-06-07 14:54:17', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, 9, 'TXV', 1, 'Ayam Goreng', 4400.00, 2, 2, '2018-06-13 10:06:22', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, 10, 'TXV', 2, 'Es Teh', 1980.00, 2, 2, '2018-06-27 13:24:40', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(12, 11, 'TXV', 2, 'Es Teh', 1980.00, 2, 2, '2018-06-27 13:29:57', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0),
	(13, 12, 'TXV', 1, 'Ayam Goreng', 4400.00, 1, 1, '2018-06-28 12:51:48', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `res_void_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_bank
DROP TABLE IF EXISTS `ret_bank`;
CREATE TABLE IF NOT EXISTS `ret_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_id` int(11) NOT NULL,
  `bank_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_bank: ~2 rows (approximately)
DELETE FROM `ret_bank`;
/*!40000 ALTER TABLE `ret_bank` DISABLE KEYS */;
INSERT INTO `ret_bank` (`bank_id`, `payment_type_id`, `bank_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 'BNI - Bank Rakyat Indonesia', '2018-05-08 13:49:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 2, 'BRIS - Bank Rakyat Indonesia Syariah', '2018-05-28 08:40:29', 'Super Retail', '2018-05-28 08:40:41', 'Super Retail', 1, 0);
/*!40000 ALTER TABLE `ret_bank` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_billing
DROP TABLE IF EXISTS `ret_billing`;
CREATE TABLE IF NOT EXISTS `ret_billing` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time NOT NULL,
  `tx_notes` text NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `tx_payment` float(10,2) NOT NULL,
  `tx_status` int(1) NOT NULL DEFAULT '0',
  `tx_cancel_notes` text,
  `bank_id` int(11) NOT NULL,
  `bank_card_no` varchar(32) NOT NULL,
  `bank_reference_no` varchar(32) NOT NULL,
  `tx_total_buy_average` float(10,2) NOT NULL,
  `tx_total_tax` float(10,2) NOT NULL,
  `tx_total_discount` float(10,2) NOT NULL,
  `tx_total_before_tax` float(10,2) NOT NULL,
  `tx_total_after_tax` float(10,2) NOT NULL,
  `tx_total_grand` float(10,2) NOT NULL,
  `tx_change` float(10,2) NOT NULL,
  `tx_total_profit_before_tax` float(10,2) NOT NULL,
  `tx_total_profit_after_tax` float(10,2) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_billing: ~37 rows (approximately)
DELETE FROM `ret_billing`;
/*!40000 ALTER TABLE `ret_billing` DISABLE KEYS */;
INSERT INTO `ret_billing` (`tx_id`, `tx_receipt_no`, `user_id`, `user_realname`, `customer_id`, `customer_name`, `tx_type`, `tx_date`, `tx_time`, `tx_notes`, `payment_type_id`, `tx_payment`, `tx_status`, `tx_cancel_notes`, `bank_id`, `bank_card_no`, `bank_reference_no`, `tx_total_buy_average`, `tx_total_tax`, `tx_total_discount`, `tx_total_before_tax`, `tx_total_after_tax`, `tx_total_grand`, `tx_change`, `tx_total_profit_before_tax`, `tx_total_profit_after_tax`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '180628000001', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-06-28', '11:42:18', '', 1, 5000.00, 1, NULL, 0, '', '', 0.00, 400.00, 0.00, 4000.00, 4400.00, 4400.00, 600.00, 4000.00, 3600.00, '2018-06-28 11:42:23', 'Super Retail', '2018-06-28 11:43:19', 'System', 1, 0),
	(2, '180628000002', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-06-28', '13:44:46', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 4000.00, 0.00, 40000.00, 44000.00, 44000.00, 0.00, 40000.00, 36000.00, '2018-06-28 13:44:51', 'Super Retail', '2018-07-02 09:18:59', 'System', 1, 0),
	(3, '180702000001', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '09:28:48', '', 1, 10000.00, 1, NULL, 0, '', '', 0.00, 400.00, 0.00, 4000.00, 4400.00, 4400.00, 5600.00, 4000.00, 3600.00, '2018-07-02 09:28:51', 'Super Retail', '2018-07-02 09:28:57', 'System', 1, 0),
	(4, '180702000002', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '09:30:45', '', 1, 2000.00, 1, NULL, 0, '', '', 0.00, 180.00, 0.00, 1800.00, 1980.00, 1980.00, 20.00, 1800.00, 1620.00, '2018-07-02 09:30:47', 'Super Retail', '2018-07-02 09:30:51', 'System', 1, 0),
	(5, '180702000003', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '09:31:00', '', 1, 10000.00, 1, NULL, 0, '', '', 0.00, 540.00, 0.00, 5400.00, 5940.00, 5940.00, 4060.00, 5400.00, 4860.00, '2018-07-02 09:31:05', 'Super Retail', '2018-07-02 09:31:09', 'System', 1, 0),
	(6, '180702000004', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '09:31:47', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 720.00, 0.00, 7200.00, 7920.00, 7920.00, 42080.00, 7200.00, 6480.00, '2018-07-02 09:31:49', 'Super Retail', '2018-07-02 09:31:54', 'System', 1, 0),
	(7, '180702000005', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:29:16', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 1380.00, 0.00, 13800.00, 15180.00, 15180.00, 34820.00, 13800.00, 12420.00, '2018-07-02 10:29:18', 'Super Retail', '2018-07-02 10:29:26', 'Super Retail', 1, 0),
	(8, '180702000006', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:32:43', '', 1, 100000.00, 1, NULL, 0, '', '', 0.00, 4400.00, 0.00, 44000.00, 48400.00, 48400.00, 51600.00, 44000.00, 39600.00, '2018-07-02 10:32:48', 'Super Retail', '2018-07-02 10:33:00', 'System', 1, 0),
	(9, '180702000007', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:33:00', '', 1, 20000.00, 1, NULL, 0, '', '', 0.00, 180.00, 0.00, 1800.00, 1980.00, 1980.00, 18020.00, 1800.00, 1620.00, '2018-07-02 10:34:10', 'Super Retail', '2018-07-02 10:38:33', 'System', 1, 0),
	(10, '180702000008', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:38:43', '', 1, 2000.00, 1, NULL, 0, '', '', 0.00, 180.00, 0.00, 1800.00, 1980.00, 1980.00, 20.00, 1800.00, 1620.00, '2018-07-02 10:38:45', 'Super Retail', '2018-07-02 10:38:51', 'System', 1, 0),
	(11, '180702000009', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:49:45', '', 1, 100000.00, 1, NULL, 0, '', '', 0.00, 2000.00, 0.00, 20000.00, 22000.00, 22000.00, 78000.00, 20000.00, 18000.00, '2018-07-02 10:49:51', 'Super Retail', '2018-07-02 10:49:58', 'System', 1, 0),
	(12, '180702000010', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:49:59', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2000.00, 0.00, 20000.00, 22000.00, 22000.00, 28000.00, 20000.00, 18000.00, '2018-07-02 10:50:36', 'Super Retail', '2018-07-02 10:50:41', 'System', 1, 0),
	(13, '180702000011', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:51:07', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 23600.00, 24000.00, 21600.00, '2018-07-02 10:51:11', 'Super Retail', '2018-07-02 10:51:17', 'System', 1, 0),
	(14, '180702000012', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:51:28', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 23600.00, 24000.00, 21600.00, '2018-07-02 10:51:31', 'Super Retail', '2018-07-02 10:51:35', 'System', 1, 0),
	(15, '180702000013', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:53:04', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 360.00, 0.00, 3600.00, 3960.00, 3960.00, 46040.00, 3600.00, 3240.00, '2018-07-02 10:53:06', 'Super Retail', '2018-07-02 10:53:10', 'System', 1, 0),
	(16, '180702000014', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:53:23', '', 1, 100000.00, 1, NULL, 0, '', '', 0.00, 1080.00, 0.00, 10800.00, 11880.00, 11880.00, 88120.00, 10800.00, 9720.00, '2018-07-02 10:53:27', 'Super Retail', '2018-07-02 10:53:34', 'System', 1, 0),
	(17, '180702000015', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:55:41', '', 1, 100000.00, 1, NULL, 0, '', '', 0.00, 2000.00, 0.00, 20000.00, 22000.00, 22000.00, 78000.00, 20000.00, 18000.00, '2018-07-02 10:55:44', 'Super Retail', '2018-07-02 10:55:49', 'System', 1, 0),
	(18, '180702000016', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:57:35', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 23600.00, 24000.00, 21600.00, '2018-07-02 10:57:39', 'Super Retail', '2018-07-02 10:57:43', 'System', 1, 0),
	(19, '180702000017', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:58:06', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2800.00, 0.00, 28000.00, 30800.00, 30800.00, 19200.00, 28000.00, 25200.00, '2018-07-02 10:58:12', 'Super Retail', '2018-07-02 10:58:15', 'System', 1, 0),
	(20, '180702000018', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '10:58:16', '', 1, 2000.00, 1, NULL, 0, '', '', 0.00, 180.00, 0.00, 1800.00, 1980.00, 1980.00, 20.00, 1800.00, 1620.00, '2018-07-02 10:59:08', 'Super Retail', '2018-07-02 10:59:14', 'System', 1, 0),
	(21, '180702000019', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:08:56', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 13200.00, 0.00, 132000.00, 145200.00, 145200.00, 0.00, 132000.00, 118800.00, '2018-07-02 11:13:45', 'Super Retail', '2018-07-03 08:41:32', 'Super Retail', 1, 0),
	(22, '180702000020', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:13:58', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 0.00, 24000.00, 21600.00, '2018-07-02 11:14:07', 'Super Retail', '2018-07-03 08:41:32', 'System', 1, 0),
	(23, '180702000021', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:14:26', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 4000.00, 0.00, 40000.00, 44000.00, 44000.00, 0.00, 40000.00, 36000.00, '2018-07-02 11:14:30', 'Super Retail', '2018-07-03 08:41:32', 'System', 1, 0),
	(24, '180702000022', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:20:14', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 23600.00, 24000.00, 21600.00, '2018-07-02 11:20:18', 'Super Retail', '2018-07-02 11:20:23', 'System', 1, 0),
	(25, '180702000023', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:20:48', '', 1, 22222.00, 1, NULL, 0, '', '', 0.00, 400.00, 0.00, 4000.00, 4400.00, 4400.00, 17822.00, 4000.00, 3600.00, '2018-07-02 11:20:54', 'Super Retail', '2018-07-02 11:20:58', 'System', 1, 0),
	(26, '180702000024', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:21:42', '', 1, 100000.00, 1, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 73600.00, 24000.00, 21600.00, '2018-07-02 11:21:48', 'Super Retail', '2018-07-02 11:21:56', 'System', 1, 0),
	(27, '180702000025', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:23:27', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 23600.00, 24000.00, 21600.00, '2018-07-02 11:23:31', 'Super Retail', '2018-07-02 11:23:34', 'System', 1, 0),
	(28, '180702000026', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:24:23', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2400.00, 0.00, 24000.00, 26400.00, 26400.00, 23600.00, 24000.00, 21600.00, '2018-07-02 11:24:27', 'Super Retail', '2018-07-02 11:24:39', 'System', 1, 0),
	(29, '180702000027', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:24:39', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 2800.00, 0.00, 28000.00, 30800.00, 30800.00, 0.00, 28000.00, 25200.00, '2018-07-02 11:25:02', 'Super Retail', '2018-07-03 08:41:32', 'System', 1, 0),
	(30, '180702000028', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:27:39', '', 2, 0.00, 1, NULL, 1, '20000', '', 0.00, 800.00, 0.00, 8000.00, 8800.00, 8800.00, 0.00, 8000.00, 7200.00, '2018-07-02 11:27:42', 'Super Retail', '2018-07-02 11:27:48', 'System', 1, 0),
	(31, '180702000029', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:29:30', '', 2, 4400.00, 1, NULL, 1, '123', '', 0.00, 400.00, 0.00, 4000.00, 4400.00, 4400.00, 0.00, 4000.00, 3600.00, '2018-07-02 11:29:32', 'Super Retail', '2018-07-02 11:29:35', 'System', 1, 0),
	(32, '180702000030', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:29:36', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 2000.00, 0.00, 20000.00, 22000.00, 22000.00, 0.00, 20000.00, 18000.00, '2018-07-02 11:30:32', 'Super Retail', '2018-07-03 08:41:32', 'System', 1, 0),
	(33, '180702000031', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:30:36', '', 0, 0.00, -2, NULL, 0, '', '', 0.00, 1600.00, 0.00, 16000.00, 17600.00, 17600.00, 0.00, 16000.00, 14400.00, '2018-07-02 11:30:39', 'Super Retail', '2018-07-03 08:41:32', 'System', 1, 0),
	(34, '180702000032', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:30:40', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2000.00, 0.00, 20000.00, 22000.00, 22000.00, 28000.00, 20000.00, 18000.00, '2018-07-02 11:30:43', 'Super Retail', '2018-07-02 11:30:47', 'System', 1, 0),
	(35, '180702000033', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:30:47', '', 2, 5940.00, 1, NULL, 1, '123', '', 0.00, 540.00, 0.00, 5400.00, 5940.00, 5940.00, 0.00, 5400.00, 4860.00, '2018-07-02 11:31:05', 'Super Retail', '2018-07-02 11:31:09', 'System', 1, 0),
	(36, '180702000034', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-02', '11:42:42', '', 1, 50000.00, 1, NULL, 0, '', '', 56218.00, 180.00, 0.00, 1800.00, 1980.00, 1980.00, 48020.00, 0.00, 0.00, '2018-07-02 11:42:45', 'Super Retail', '2018-07-02 11:42:49', 'System', 1, 0),
	(37, '180703000001', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-03', '08:41:32', '', 1, 50000.00, 1, NULL, 0, '', '', 70030.00, 4000.00, 0.00, 40000.00, 44000.00, 44000.00, 6000.00, 0.00, 0.00, '2018-07-03 08:41:37', 'Super Retail', '2018-07-03 08:41:42', 'System', 1, 0),
	(38, '180703000002', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-03', '08:41:53', '', 1, 50000.00, 1, NULL, 0, '', '', 28492.00, 180.00, 0.00, 1800.00, 1980.00, 1980.00, 48020.00, 0.00, 0.00, '2018-07-03 08:43:15', 'Super Retail', '2018-07-03 08:43:24', 'System', 1, 0),
	(39, '180704000001', 1, 'Super Retail', 0, 'Umum', 'TXS', '2018-07-04', '13:17:41', '', 0, 0.00, -1, NULL, 0, '', '', 170952.00, 1080.00, 0.00, 10800.00, 11880.00, 11880.00, 0.00, 0.00, 0.00, '2018-07-04 13:17:45', 'Super Retail', '2018-07-04 13:17:54', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_billing` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_billing_buyall
DROP TABLE IF EXISTS `ret_billing_buyall`;
CREATE TABLE IF NOT EXISTS `ret_billing_buyall` (
  `billing_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `promo_buyall_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_billing_buyall: ~0 rows (approximately)
DELETE FROM `ret_billing_buyall`;
/*!40000 ALTER TABLE `ret_billing_buyall` DISABLE KEYS */;
/*!40000 ALTER TABLE `ret_billing_buyall` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_billing_buyget
DROP TABLE IF EXISTS `ret_billing_buyget`;
CREATE TABLE IF NOT EXISTS `ret_billing_buyget` (
  `billing_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `promo_buyget_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_billing_buyget: ~17 rows (approximately)
DELETE FROM `ret_billing_buyget`;
/*!40000 ALTER TABLE `ret_billing_buyget` DISABLE KEYS */;
INSERT INTO `ret_billing_buyget` (`billing_buyget_id`, `tx_id`, `tx_type`, `promo_buyget_id`, `buy_item_id`, `buy_amount`, `get_item_id`, `get_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 11, 'PRB', 3, 1, 5.00, 1, 1.00, '2018-07-02 10:49:51', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(2, 12, 'PRB', 3, 1, 5.00, 1, 1.00, '2018-07-02 10:50:36', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(3, 13, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 10:51:11', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(4, 14, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 10:51:31', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(5, 17, 'PRB', 3, 1, 5.00, 1, 1.00, '2018-07-02 10:55:44', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(6, 18, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 10:57:38', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(7, 19, 'PRB', 3, 1, 7.00, 1, 1.00, '2018-07-02 10:58:12', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(8, 21, 'PRB', 3, 1, 33.00, 1, 1.00, '2018-07-02 11:13:45', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(9, 22, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 11:14:07', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(10, 23, 'PRB', 3, 1, 10.00, 1, 1.00, '2018-07-02 11:14:30', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(11, 24, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 11:20:18', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(12, 26, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 11:21:48', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(13, 27, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 11:23:31', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(14, 28, 'PRB', 3, 1, 6.00, 1, 1.00, '2018-07-02 11:24:27', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(15, 29, 'PRB', 3, 1, 7.00, 1, 1.00, '2018-07-02 11:25:02', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(16, 32, 'PRB', 3, 1, 5.00, 1, 1.00, '2018-07-02 11:30:32', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(17, 34, 'PRB', 3, 1, 5.00, 1, 1.00, '2018-07-02 11:30:43', 'System', '0000-00-00 00:00:00', 'System', 0, 0),
	(18, 37, 'PRB', 3, 1, 10.00, 1, 1.00, '2018-07-03 08:41:37', 'System', '0000-00-00 00:00:00', 'System', 0, 0);
/*!40000 ALTER TABLE `ret_billing_buyget` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_billing_buyitem
DROP TABLE IF EXISTS `ret_billing_buyitem`;
CREATE TABLE IF NOT EXISTS `ret_billing_buyitem` (
  `billing_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `promo_buyitem_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_billing_buyitem: ~0 rows (approximately)
DELETE FROM `ret_billing_buyitem`;
/*!40000 ALTER TABLE `ret_billing_buyitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `ret_billing_buyitem` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_billing_detail
DROP TABLE IF EXISTS `ret_billing_detail`;
CREATE TABLE IF NOT EXISTS `ret_billing_detail` (
  `billing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_price_before_tax` float(10,2) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `item_price_buy_average` float(10,2) NOT NULL,
  `tx_amount` float NOT NULL,
  `tx_subtotal_tax` float(10,2) NOT NULL,
  `tx_subtotal_discount` float(10,2) NOT NULL,
  `tx_subtotal_buy_average` float(10,2) NOT NULL,
  `tx_subtotal_before_tax` float(10,2) NOT NULL,
  `tx_subtotal_after_tax` float(10,2) NOT NULL,
  `tx_subtotal_profit_before_tax` float(10,2) NOT NULL,
  `tx_subtotal_profit_after_tax` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.ret_billing_detail: ~38 rows (approximately)
DELETE FROM `ret_billing_detail`;
/*!40000 ALTER TABLE `ret_billing_detail` DISABLE KEYS */;
INSERT INTO `ret_billing_detail` (`billing_detail_id`, `tx_id`, `tx_type`, `item_id`, `item_name`, `item_price_before_tax`, `item_price_after_tax`, `item_price_buy_average`, `tx_amount`, `tx_subtotal_tax`, `tx_subtotal_discount`, `tx_subtotal_buy_average`, `tx_subtotal_before_tax`, `tx_subtotal_after_tax`, `tx_subtotal_profit_before_tax`, `tx_subtotal_profit_after_tax`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 1, 400.00, 0.00, 0.00, 4000.00, 4400.00, 4000.00, 3600.00, '2018-06-28 11:42:21', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 2, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 10, 4000.00, 0.00, 0.00, 40000.00, 44000.00, 40000.00, 36000.00, '2018-06-28 13:44:51', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 3, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 1, 400.00, 0.00, 0.00, 4000.00, 4400.00, 4000.00, 3600.00, '2018-07-02 09:28:51', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 4, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 1, 180.00, 0.00, 0.00, 1800.00, 1980.00, 1800.00, 1620.00, '2018-07-02 09:30:47', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(5, 5, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 3, 540.00, 0.00, 0.00, 5400.00, 5940.00, 5400.00, 4860.00, '2018-07-02 09:31:05', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(6, 6, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 4, 720.00, 0.00, 0.00, 7200.00, 7920.00, 7200.00, 6480.00, '2018-07-02 09:31:49', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(7, 7, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 1, 180.00, 0.00, 0.00, 1800.00, 1980.00, 1800.00, 1620.00, '2018-07-02 10:29:18', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(8, 7, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 3, 1200.00, 0.00, 0.00, 12000.00, 13200.00, 12000.00, 10800.00, '2018-07-02 10:29:22', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, 8, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 11, 4400.00, 0.00, 0.00, 44000.00, 48400.00, 44000.00, 39600.00, '2018-07-02 10:32:48', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, 9, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 1, 180.00, 0.00, 0.00, 1800.00, 1980.00, 1800.00, 1620.00, '2018-07-02 10:34:10', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, 10, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 1, 180.00, 0.00, 0.00, 1800.00, 1980.00, 1800.00, 1620.00, '2018-07-02 10:38:45', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(12, 11, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 5, 2000.00, 0.00, 0.00, 20000.00, 22000.00, 20000.00, 18000.00, '2018-07-02 10:49:51', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(13, 12, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 5, 2000.00, 0.00, 0.00, 20000.00, 22000.00, 20000.00, 18000.00, '2018-07-02 10:50:36', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(14, 13, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 10:51:10', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(15, 14, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 10:51:31', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(16, 15, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 2, 360.00, 0.00, 0.00, 3600.00, 3960.00, 3600.00, 3240.00, '2018-07-02 10:53:06', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(17, 16, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 6, 1080.00, 0.00, 0.00, 10800.00, 11880.00, 10800.00, 9720.00, '2018-07-02 10:53:27', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(18, 17, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 5, 2000.00, 0.00, 0.00, 20000.00, 22000.00, 20000.00, 18000.00, '2018-07-02 10:55:44', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(19, 18, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 10:57:38', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(20, 19, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 7, 2800.00, 0.00, 0.00, 28000.00, 30800.00, 28000.00, 25200.00, '2018-07-02 10:58:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(21, 20, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 1, 180.00, 0.00, 0.00, 1800.00, 1980.00, 1800.00, 1620.00, '2018-07-02 10:59:08', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(22, 21, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 33, 13200.00, 0.00, 0.00, 132000.00, 145200.00, 132000.00, 118800.00, '2018-07-02 11:13:45', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(23, 22, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 11:14:07', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(24, 23, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 10, 4000.00, 0.00, 0.00, 40000.00, 44000.00, 40000.00, 36000.00, '2018-07-02 11:14:30', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(25, 24, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 11:20:18', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(26, 25, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 1, 400.00, 0.00, 0.00, 4000.00, 4400.00, 4000.00, 3600.00, '2018-07-02 11:20:54', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(27, 26, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 11:21:48', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(28, 27, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 11:23:31', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(29, 28, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 6, 2400.00, 0.00, 0.00, 24000.00, 26400.00, 24000.00, 21600.00, '2018-07-02 11:24:26', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(30, 29, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 7, 2800.00, 0.00, 0.00, 28000.00, 30800.00, 28000.00, 25200.00, '2018-07-02 11:25:01', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(31, 30, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 2, 800.00, 0.00, 0.00, 8000.00, 8800.00, 8000.00, 7200.00, '2018-07-02 11:27:41', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(32, 31, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 1, 400.00, 0.00, 0.00, 4000.00, 4400.00, 4000.00, 3600.00, '2018-07-02 11:29:32', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(33, 32, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 5, 2000.00, 0.00, 0.00, 20000.00, 22000.00, 20000.00, 18000.00, '2018-07-02 11:30:32', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(34, 33, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 4, 1600.00, 0.00, 0.00, 16000.00, 17600.00, 16000.00, 14400.00, '2018-07-02 11:30:39', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(35, 34, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 0.00, 5, 2000.00, 0.00, 0.00, 20000.00, 22000.00, 20000.00, 18000.00, '2018-07-02 11:30:43', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(36, 35, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 0.00, 3, 540.00, 0.00, 0.00, 5400.00, 5940.00, 5400.00, 4860.00, '2018-07-02 11:31:05', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(37, 36, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 56218.00, 1, 180.00, 0.00, 56218.00, 1800.00, 1980.00, -54418.00, -54598.00, '2018-07-02 11:42:45', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(38, 37, 'TXS', 1, 'Ayam Goreng', 4000.00, 4400.00, 7003.00, 10, 4000.00, 0.00, 70030.00, 40000.00, 44000.00, -30030.00, -34030.00, '2018-07-03 08:41:37', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(39, 38, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 28492.00, 1, 180.00, 0.00, 28492.00, 1800.00, 1980.00, -26692.00, -26872.00, '2018-07-03 08:43:14', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(40, 39, 'TXS', 2, 'Es Teh', 1800.00, 1980.00, 28492.00, 6, 1080.00, 0.00, 170952.00, 10800.00, 11880.00, -160152.00, -161232.00, '2018-07-04 13:17:45', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_billing_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_category
DROP TABLE IF EXISTS `ret_category`;
CREATE TABLE IF NOT EXISTS `ret_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_category: ~14 rows (approximately)
DELETE FROM `ret_category`;
/*!40000 ALTER TABLE `ret_category` DISABLE KEYS */;
INSERT INTO `ret_category` (`category_id`, `category_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Tidak Terkategori', '2018-05-08 13:26:31', 'System', '2018-05-08 13:26:44', 'System', 1, 0),
	(1, 'Movies', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'Tools', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 'Kids', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 'Industrial', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(5, 'Music', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(6, 'Movies', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(7, 'Games', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(8, 'Grocery', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, 'Movies', '2018-06-04 09:00:13', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, 'Computers', '2018-06-04 09:00:14', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, 'gggg', '2018-06-05 11:09:22', 'Super Retail', '2018-06-05 11:12:19', 'System', 1, 1),
	(12, 'ffffff', '2018-06-05 11:11:47', 'Super Retail', '2018-06-05 11:11:59', 'System', 1, 1),
	(13, 'ttttt', '2018-06-06 08:51:36', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_category` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_client
DROP TABLE IF EXISTS `ret_client`;
CREATE TABLE IF NOT EXISTS `ret_client` (
  `client_id` varchar(32) NOT NULL,
  `client_name` varchar(32) NOT NULL,
  `client_brand` varchar(32) NOT NULL,
  `client_status` varchar(32) NOT NULL,
  `client_street` varchar(128) NOT NULL,
  `client_subdistrict` varchar(32) NOT NULL,
  `client_district` varchar(32) NOT NULL,
  `client_city` varchar(32) NOT NULL,
  `client_province` varchar(32) NOT NULL,
  `client_email` varchar(32) NOT NULL,
  `client_phone_1` varchar(15) NOT NULL,
  `client_phone_2` varchar(15) NOT NULL,
  `client_npwp` varchar(64) NOT NULL,
  `client_npwpd` varchar(64) NOT NULL,
  `client_owner_name` varchar(64) NOT NULL,
  `client_owner_address` text NOT NULL,
  `client_notes` text NOT NULL,
  `client_serial_number` varchar(20) NOT NULL,
  `client_keyboard_status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_client: ~0 rows (approximately)
DELETE FROM `ret_client`;
/*!40000 ALTER TABLE `ret_client` DISABLE KEYS */;
INSERT INTO `ret_client` (`client_id`, `client_name`, `client_brand`, `client_status`, `client_street`, `client_subdistrict`, `client_district`, `client_city`, `client_province`, `client_email`, `client_phone_1`, `client_phone_2`, `client_npwp`, `client_npwpd`, `client_owner_name`, `client_owner_address`, `client_notes`, `client_serial_number`, `client_keyboard_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	('1', 'CV Prisma Retail', 'Prisma Retail', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Retail', 1, 0);
/*!40000 ALTER TABLE `ret_client` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_customer
DROP TABLE IF EXISTS `ret_customer`;
CREATE TABLE IF NOT EXISTS `ret_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_fax` varchar(20) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_customer: ~8 rows (approximately)
DELETE FROM `ret_customer`;
/*!40000 ALTER TABLE `ret_customer` DISABLE KEYS */;
INSERT INTO `ret_customer` (`customer_id`, `customer_name`, `customer_phone`, `customer_fax`, `customer_email`, `customer_address`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Umum', '1234567890', '1234567890', 'umum@umum.com', 'Umum', '2018-05-08 11:07:30', 'Super Administrator', '2018-05-08 13:33:20', '', 1, 0),
	(2, 'rqwer', 'qwe234', '', 'df', 'asadf', '2018-05-08 13:57:00', 'Super Retail', '2018-05-08 14:02:53', '', 1, 1),
	(3, '', '', '', '', '', '2018-05-08 14:04:02', 'Super Retail', '2018-05-08 14:04:12', '', 1, 1),
	(4, 'Budi', '12345', '', 'budi@gmail.com', 'Jalan persatuan', '2018-05-28 08:35:42', 'Super Retail', '2018-05-28 08:35:48', '', 1, 1),
	(5, 'Khusus', '1234', '', 'telo@giam', 'cas', '2018-05-28 11:21:09', 'Super Retail', '0000-00-00 00:00:00', '', 1, 0),
	(6, 'Super', '123', '', 'a@gmal.com', 'asdf', '2018-06-04 10:01:20', '', '0000-00-00 00:00:00', '', 1, 0),
	(7, 'Tutu', '123', '', 'fasd@gmao.', 'fasdf', '2018-06-04 10:02:14', '', '0000-00-00 00:00:00', '', 1, 0),
	(8, 'Sdf', '123', '', 'adsf@gmaoi.com', 'asdfa', '2018-06-04 10:03:16', '', '0000-00-00 00:00:00', '', 1, 0);
/*!40000 ALTER TABLE `ret_customer` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_item
DROP TABLE IF EXISTS `ret_item`;
CREATE TABLE IF NOT EXISTS `ret_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_barcode` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `item_price_before_tax` float(10,2) NOT NULL,
  `is_package` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL DEFAULT 'System',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_item: ~3 rows (approximately)
DELETE FROM `ret_item`;
/*!40000 ALTER TABLE `ret_item` DISABLE KEYS */;
INSERT INTO `ret_item` (`item_id`, `category_id`, `unit_id`, `tax_id`, `item_name`, `item_barcode`, `item_desc`, `item_price_before_tax`, `is_package`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 0, 1, 'Ayam Goreng', '123', '', 4000.00, 0, '2018-05-14 11:06:00', 'Super Retail', '2018-05-28 08:30:17', 'Super Retail', 1, 0),
	(2, 3, 0, 1, 'Es Teh', '12354', '', 1800.00, 0, '2018-05-14 11:06:21', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 0, 0, 1, 'Paket 1', '', '', 5000.00, 1, '2018-05-14 11:06:43', 'Super Retail', '2018-05-28 08:30:35', 'System', 1, 1);
/*!40000 ALTER TABLE `ret_item` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_item_package
DROP TABLE IF EXISTS `ret_item_package`;
CREATE TABLE IF NOT EXISTS `ret_item_package` (
  `item_package_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_detail_id` int(11) NOT NULL,
  `item_detail_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_item_package: ~0 rows (approximately)
DELETE FROM `ret_item_package`;
/*!40000 ALTER TABLE `ret_item_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `ret_item_package` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_log
DROP TABLE IF EXISTS `ret_log`;
CREATE TABLE IF NOT EXISTS `ret_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.ret_log: ~65 rows (approximately)
DELETE FROM `ret_log`;
/*!40000 ALTER TABLE `ret_log` DISABLE KEYS */;
INSERT INTO `ret_log` (`log_id`, `user_id`, `user_realname`, `log_type`, `log_date`, `log_time`) VALUES
	(0, 1, 'Super Retail', 'Sign In', '2018-06-06', '08:39:04'),
	(1, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:14:23'),
	(2, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:14:23'),
	(3, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:19:02'),
	(4, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:22:12'),
	(5, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:22:15'),
	(6, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:23:26'),
	(7, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:23:49'),
	(8, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:24:41'),
	(9, 1, 'Super Retail', 'Sign Out', '2018-06-04', '14:24:43'),
	(10, 1, 'Super Retail', 'Sign In', '2018-06-04', '14:31:55'),
	(11, 1, 'Super Retail', 'Sign Out', '2018-06-04', '15:27:29'),
	(12, 1, 'Super Retail', 'Sign In', '2018-06-05', '09:50:38'),
	(13, 1, 'Super Retail', 'Sign Out', '2018-06-05', '10:57:15'),
	(14, 1, 'Super Retail', 'Sign In', '2018-06-05', '10:57:22'),
	(15, 1, 'Super Retail', 'Sign Out', '2018-06-05', '12:16:22'),
	(16, 1, 'Super Retail', 'Sign In', '2018-06-05', '14:16:53'),
	(17, 1, 'Super Retail', 'Sign Out', '2018-06-06', '09:35:30'),
	(18, 1, 'Super Retail', 'Sign In', '2018-06-06', '09:50:30'),
	(19, 1, 'Super Retail', 'Sign Out', '2018-06-06', '09:50:46'),
	(20, 1, 'Super Retail', 'Sign In', '2018-06-06', '10:44:02'),
	(21, 1, 'Super Retail', 'Sign In', '2018-06-07', '08:44:30'),
	(22, 1, 'Super Retail', 'Sign Out', '2018-06-07', '09:20:13'),
	(23, 1, 'Super Retail', 'Sign In', '2018-06-07', '10:59:33'),
	(24, 1, 'Super Retail', 'Sign Out', '2018-06-07', '15:01:44'),
	(25, 1, 'Super Retail', 'Sign In', '2018-06-08', '09:21:18'),
	(26, 1, 'Super Retail', 'Sign Out', '2018-06-08', '10:24:18'),
	(27, 1, 'Super Retail', 'Sign In', '2018-06-08', '11:36:43'),
	(28, 1, 'Super Retail', 'Sign In', '2018-06-13', '10:05:52'),
	(29, 1, 'Super Retail', 'Sign In', '2018-06-21', '08:14:16'),
	(30, 1, 'Super Retail', 'Sign Out', '2018-06-21', '09:49:03'),
	(31, 1, 'Super Retail', 'Sign In', '2018-06-21', '11:40:30'),
	(32, 1, 'Super Retail', 'Sign In', '2018-06-21', '14:20:56'),
	(33, 1, 'Super Retail', 'Sign In', '2018-06-22', '10:33:53'),
	(34, 1, 'Super Retail', 'Sign In', '2018-06-22', '10:37:45'),
	(35, 1, 'Super Retail', 'Sign In', '2018-06-22', '11:03:19'),
	(36, 1, 'Super Retail', 'Sign In', '2018-06-22', '11:27:07'),
	(37, 1, 'Super Retail', 'Sign In', '2018-06-25', '09:57:52'),
	(38, 1, 'Super Retail', 'Sign Out', '2018-06-25', '10:25:00'),
	(39, 1, 'Super Retail', 'Sign In', '2018-06-25', '10:25:31'),
	(40, 1, 'Super Retail', 'Sign In', '2018-06-26', '08:48:08'),
	(41, 1, 'Super Retail', 'Sign Out', '2018-06-26', '09:27:20'),
	(42, 1, 'Super Retail', 'Sign In', '2018-06-26', '11:32:53'),
	(43, 1, 'Super Retail', 'Sign In', '2018-06-26', '14:51:52'),
	(44, 1, 'Super Retail', 'Sign In', '2018-06-27', '09:30:32'),
	(45, 1, 'Super Retail', 'Sign In', '2018-06-27', '13:14:48'),
	(46, 1, 'Super Retail', 'Sign Out', '2018-06-27', '13:30:19'),
	(47, 1, 'Super Retail', 'Sign In', '2018-06-27', '13:30:25'),
	(48, 1, 'Super Retail', 'Sign In', '2018-06-28', '10:32:48'),
	(49, 1, 'Super Retail', 'Sign Out', '2018-06-28', '11:31:40'),
	(50, 1, 'Super Retail', 'Sign In', '2018-06-28', '11:32:13'),
	(51, 1, 'Super Retail', 'Sign In', '2018-06-28', '11:41:20'),
	(52, 1, 'Super Retail', 'Sign In', '2018-06-29', '03:36:31'),
	(53, 1, 'Super Retail', 'Sign Out', '2018-06-29', '03:36:39'),
	(54, 1, 'Super Retail', 'Sign In', '2018-07-02', '09:10:46'),
	(55, 1, 'Super Retail', 'Sign Out', '2018-07-02', '11:05:18'),
	(56, 1, 'Super Retail', 'Sign In', '2018-07-02', '11:08:36'),
	(57, 1, 'Super Retail', 'Sign Out', '2018-07-02', '11:42:23'),
	(58, 1, 'Super Retail', 'Sign In', '2018-07-02', '11:42:39'),
	(59, 1, 'Super Retail', 'Sign Out', '2018-07-02', '11:47:45'),
	(60, 1, 'Super Retail', 'Sign In', '2018-07-02', '12:50:57'),
	(61, 1, 'Super Retail', 'Sign In', '2018-07-02', '12:59:49'),
	(62, 1, 'Super Retail', 'Sign In', '2018-07-03', '08:33:12'),
	(63, 1, 'Super Retail', 'Sign Out', '2018-07-03', '08:36:47'),
	(64, 1, 'Super Retail', 'Sign In', '2018-07-03', '08:41:27'),
	(65, 1, 'Super Retail', 'Sign Out', '2018-07-03', '08:43:43'),
	(66, 1, 'Super Retail', 'Sign In', '2018-07-03', '09:40:52'),
	(67, 1, 'Super Retail', 'Sign In', '2018-07-03', '09:57:43'),
	(68, 1, 'Super Retail', 'Sign In', '2018-07-03', '10:01:40'),
	(69, 1, 'Super Retail', 'Sign In', '2018-07-04', '08:12:03'),
	(70, 1, 'Super Retail', 'Sign In', '2018-07-04', '09:30:52'),
	(71, 1, 'Super Retail', 'Sign In', '2018-07-04', '10:25:15'),
	(72, 1, 'Super Retail', 'Sign Out', '2018-07-04', '12:53:02'),
	(73, 1, 'Super Retail', 'Sign In', '2018-07-04', '13:10:37');
/*!40000 ALTER TABLE `ret_log` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_module
DROP TABLE IF EXISTS `ret_module`;
CREATE TABLE IF NOT EXISTS `ret_module` (
  `module_id` varchar(15) NOT NULL,
  `module_parent` varchar(15) NOT NULL,
  `module_name` varchar(32) NOT NULL,
  `module_folder` varchar(32) NOT NULL,
  `module_controller` varchar(32) NOT NULL,
  `module_url` varchar(32) NOT NULL,
  `module_icon` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_actived` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_module: ~39 rows (approximately)
DELETE FROM `ret_module`;
/*!40000 ALTER TABLE `ret_module` DISABLE KEYS */;
INSERT INTO `ret_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`, `module_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_actived`, `is_deleted`) VALUES
	('01', '', 'Dashboard', 'ret_dashboard', 'ret_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-04-19 10:40:13', 'Super Administrator', 1, 0),
	('02', '', 'Master', '', '', '#', 'cubes', '2018-04-05 19:44:13', 'superadmin', '2018-04-05 19:45:13', 'superadmin', 1, 0),
	('02.01', '02', 'Kategori', 'ret_category', 'ret_category', 'index', 'paperclip', '2018-04-05 19:47:02', 'superadmin', '2018-04-05 21:22:37', 'Super Administrator', 1, 0),
	('02.02', '02', 'Satuan', 'ret_unit', 'ret_unit', 'index', 'dot-circle-o', '2018-04-05 22:14:53', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.03', '02', 'Item', 'ret_item', 'ret_item', 'index', 'list', '2018-04-07 15:49:43', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.04', '02', 'Suplier', 'ret_supplier', 'ret_supplier', 'index', 'truck', '2018-04-09 18:13:11', 'Super Administrator', '2018-04-09 18:53:55', 'Super Administrator', 1, 0),
	('02.05', '02', 'Pelanggan', 'ret_customer', 'ret_customer', 'index', 'users', '2018-04-10 08:56:24', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.06', '02', 'Bank', 'ret_bank', 'ret_bank', 'index', 'bank', '2018-04-18 08:38:55', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('02.07', '02', 'Pajak', 'ret_tax', 'ret_tax', 'index', 'chain', '2018-04-19 19:48:06', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0),
	('02.08', '02', 'Promo', 'ret_promo', 'ret_promo', 'index', 'ticket', '2018-04-20 09:21:42', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0),
	('03', '', 'Transaksi', '', '', '#', 'exchange', '2018-04-17 10:05:10', 'Super Administrator', '2018-06-07 11:17:10', 'Super Retail', 1, 0),
	('03.01', '03', 'Kasir', 'ret_cashier', 'ret_cashier', 'index', 'laptop', '2018-06-07 11:17:32', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	('03.02', '03', 'Retur', 'ret_return', 'ret_return', 'index', 'undo', '2018-06-07 11:19:02', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	('03.03', '03', 'Void', 'ret_void', 'ret_void', 'index', 'ban', '2018-06-07 14:17:41', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	('04', '', 'Inventori', '', '', '#', 'archive', '2018-04-10 10:37:46', 'Super Administrator', '2018-06-08 12:26:52', 'Super Retail', 1, 0),
	('04.01', '04', 'Stok Masuk', 'ret_stock_in', 'ret_stock_in', 'index', 'sign-in', '2018-04-10 10:54:00', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('04.02', '04', 'Stok Keluar', 'ret_stock_out', 'ret_stock_out', 'index', 'sign-out', '2018-04-11 10:48:29', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('04.03', '04', 'Stok Opname', 'ret_stock_opname', 'ret_stock_opname', 'index', 'exchange', '2018-04-11 13:54:55', 'Super Administrator', '2018-04-11 14:01:18', 'Super Administrator', 1, 0),
	('04.04', '04', 'Rekap Stok', 'ret_stock_recap', 'ret_stock_recap', 'index', 'files-o', '2018-04-11 14:11:28', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('04.05', '04', 'Purchace Order', 'ret_po', 'ret_po', 'index', 'file-text', '2018-04-12 12:36:57', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('05', '', 'Laporan', '', '', '#', 'files-o', '2018-05-04 09:10:39', 'Super Administrator', '2018-05-28 10:30:22', 'Super Retail', 1, 0),
	('05.01', '05', 'Penjualan (Semua)', 'ret_report_selling', 'ret_report_selling', 'index', 'money', '2018-05-28 10:32:42', 'Super Retail', '2018-05-28 10:53:56', 'Super Retail', 1, 0),
	('05.02', '05', 'Penjualan (Pelanggan)', 'ret_report_selling_customer', 'ret_report_selling_customer', 'index', 'users', '2018-05-28 10:52:44', 'Super Retail', '2018-05-28 10:53:42', 'Super Retail', 1, 0),
	('05.03', '05', 'Penjualan (Kategori)', 'ret_report_selling_category', 'ret_report_selling_category', 'index', 'cubes', '2018-05-28 11:41:33', 'Super Retail', '2018-05-28 14:18:04', 'Super Retail', 1, 0),
	('05.04', '05', 'Penjualan (Kasir)', 'ret_report_selling_user', 'ret_report_selling_user', 'index', 'laptop', '2018-06-04 09:06:23', 'Super Retail', '2018-06-04 09:18:32', 'Super Retail', 1, 0),
	('05.05', '05', 'Penjualan (Item)', 'ret_report_selling_item', 'ret_report_selling_item', 'index', 'cube', '2018-05-28 14:17:59', 'Super Retail', '2018-06-04 09:08:45', 'System', 1, 0),
	('05.06', '05', 'Omzet (Semua)', 'ret_report_profit', 'ret_report_profit', 'index', 'bar-chart', '2018-05-28 14:58:02', 'Super Retail', '2018-06-04 09:08:40', 'Super Retail', 1, 0),
	('05.07', '05', 'Omzet (Kasir)', 'ret_report_profit_cashier', 'ret_report_profit_cashier', 'index', 'laptop', '2018-05-28 15:33:42', 'Super Retail', '2018-06-08 10:20:55', 'Super Retail', 1, 0),
	('05.08', '05', 'Piutang', 'ret_report_credit', 'ret_report_credit', 'index', 'credit-card', '2018-06-08 09:51:51', 'Super Retail', '2018-06-08 10:20:49', 'Super Retail', 1, 0),
	('05.09', '05', 'Stok Barang', 'ret_report_stock', 'ret_report_stock', 'index', 'archive', '2018-05-29 21:31:00', 'Super Retail', '2018-06-08 09:52:48', 'System', 1, 0),
	('05.10', '05', 'Shift', 'ret_report_shift', 'ret_report_shift', 'index', 'transfer', '2018-05-29 21:58:13', 'Super Retail', '2018-06-08 09:52:41', 'System', 1, 0),
	('05.11', '05', 'Log Akses', 'ret_report_log', 'ret_report_log', 'index', 'files-o', '2018-06-04 14:33:00', 'Super Retail', '2018-06-08 09:52:36', 'Super Retail', 1, 0),
	('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0),
	('99.01', '99', 'Modul', 'ret_module', 'ret_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-04-19 10:40:32', 'Super Administrator', 1, 0),
	('99.02', '99', 'Role', 'ret_role', 'ret_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-04-19 10:40:40', 'Super Administrator', 1, 0),
	('99.03', '99', 'Pengguna', 'ret_user', 'ret_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-04-19 10:40:49', 'Super Administrator', 1, 0),
	('99.04', '99', 'Hak Akses', 'ret_permission', 'ret_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-04-19 10:40:56', '', 1, 0),
	('99.05', '99', 'Client', 'ret_client', 'ret_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-04-20 08:15:47', 'Super Administrator', 1, 0);
/*!40000 ALTER TABLE `ret_module` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_payment_type
DROP TABLE IF EXISTS `ret_payment_type`;
CREATE TABLE IF NOT EXISTS `ret_payment_type` (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_payment_type: ~3 rows (approximately)
DELETE FROM `ret_payment_type`;
/*!40000 ALTER TABLE `ret_payment_type` DISABLE KEYS */;
INSERT INTO `ret_payment_type` (`payment_type_id`, `payment_type_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Cash', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'Debit Card', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 'Credit Card', '2018-04-19 19:34:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_payment_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_permission
DROP TABLE IF EXISTS `ret_permission`;
CREATE TABLE IF NOT EXISTS `ret_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` varchar(25) NOT NULL,
  `_create` int(1) DEFAULT NULL,
  `_read` int(1) DEFAULT NULL,
  `_update` int(1) DEFAULT NULL,
  `_delete` int(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1093 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_permission: ~76 rows (approximately)
DELETE FROM `ret_permission`;
/*!40000 ALTER TABLE `ret_permission` DISABLE KEYS */;
INSERT INTO `ret_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created`, `created_by`) VALUES
	(521, 3, '01', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail'),
	(522, 3, '03', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail'),
	(523, 3, '03.01', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail'),
	(524, 3, '03.02', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail'),
	(807, 1, '01', 1, 1, 1, 1, '2018-06-01 07:50:53', 'Super Retail'),
	(808, 1, '02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(809, 1, '02.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(810, 1, '02.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(811, 1, '02.03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(812, 1, '02.04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(813, 1, '02.05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(814, 1, '02.06', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(815, 1, '02.07', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(816, 1, '02.08', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(817, 1, '03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(818, 1, '04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(819, 1, '04.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(820, 1, '04.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(821, 1, '04.03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(822, 1, '04.04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(823, 1, '04.05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(824, 1, '05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(825, 1, '05.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(826, 1, '05.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail'),
	(827, 1, '05.03', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(828, 1, '05.04', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(829, 1, '05.05', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(830, 1, '05.06', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(831, 1, '05.07', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(832, 1, '05.08', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(833, 1, '99', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(834, 1, '99.03', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(835, 1, '99.05', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail'),
	(836, 2, '01', 1, 1, 1, 1, '2018-06-04 09:26:38', 'Super Retail'),
	(837, 2, '03', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Retail'),
	(838, 2, '05', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Retail'),
	(839, 2, '05.04', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Retail'),
	(1054, 0, '01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1055, 0, '02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1056, 0, '02.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1057, 0, '02.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1058, 0, '02.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1059, 0, '02.04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1060, 0, '02.05', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1061, 0, '02.06', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1062, 0, '02.07', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1063, 0, '02.08', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1064, 0, '03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1065, 0, '03.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1066, 0, '03.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1067, 0, '03.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1068, 0, '04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1069, 0, '04.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1070, 0, '04.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1071, 0, '04.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1072, 0, '04.04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1073, 0, '04.05', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail'),
	(1074, 0, '05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1075, 0, '05.01', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1076, 0, '05.02', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1077, 0, '05.03', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1078, 0, '05.04', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1079, 0, '05.05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1080, 0, '05.06', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1081, 0, '05.07', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1082, 0, '05.08', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1083, 0, '05.09', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1084, 0, '05.10', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1085, 0, '05.11', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1086, 0, '99', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1087, 0, '99.01', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1088, 0, '99.02', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1089, 0, '99.03', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1090, 0, '99.04', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1091, 0, '99.05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail'),
	(1092, 0, '99.06', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
/*!40000 ALTER TABLE `ret_permission` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_po
DROP TABLE IF EXISTS `ret_po`;
CREATE TABLE IF NOT EXISTS `ret_po` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_po_no` varchar(255) NOT NULL,
  `tx_po_receiver` varchar(255) NOT NULL,
  `tx_notes` text NOT NULL,
  `tx_status` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_po: ~2 rows (approximately)
DELETE FROM `ret_po`;
/*!40000 ALTER TABLE `ret_po` DISABLE KEYS */;
INSERT INTO `ret_po` (`tx_id`, `tx_receipt_no`, `supplier_id`, `tx_type`, `tx_date`, `tx_po_no`, `tx_po_receiver`, `tx_notes`, `tx_status`, `created`, `created_by`) VALUES
	(1, '180626000001', 4, 'TXP', '2018-06-26', '1231', '', 'fasdfa', 0, '2018-06-26 11:50:56', 'Super Retail'),
	(2, '180626000002', 4, 'TXP', '2018-06-26', '1231', '', 'afsfas', 0, '2018-06-26 11:51:17', 'Super Retail');
/*!40000 ALTER TABLE `ret_po` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_po_detail
DROP TABLE IF EXISTS `ret_po_detail`;
CREATE TABLE IF NOT EXISTS `ret_po_detail` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_demand` float(10,2) NOT NULL,
  `stock_receive` float(10,2) NOT NULL,
  `stock_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_po_detail: ~2 rows (approximately)
DELETE FROM `ret_po_detail`;
/*!40000 ALTER TABLE `ret_po_detail` DISABLE KEYS */;
INSERT INTO `ret_po_detail` (`stock_id`, `tx_id`, `tx_type`, `tx_date`, `item_id`, `stock_demand`, `stock_receive`, `stock_price`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	(4, 1, 'TXP', '2018-06-26', 1, 12.00, 0.00, 12.00, '2018-06-26 11:50:56', 'Super Retail', '0000-00-00 00:00:00', ''),
	(5, 2, 'TXP', '2018-06-26', 1, 12.00, 0.00, 12.00, '2018-06-26 11:51:17', 'Super Retail', '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `ret_po_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_promo
DROP TABLE IF EXISTS `ret_promo`;
CREATE TABLE IF NOT EXISTS `ret_promo` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_id` int(1) NOT NULL,
  `promo_name` varchar(255) NOT NULL,
  `promo_date_start` date NOT NULL,
  `promo_date_end` date NOT NULL,
  `promo_time_start` time NOT NULL,
  `promo_time_end` time NOT NULL,
  `promo_sunday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_monday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_tuesday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_wednesday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_thursday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_friday` tinyint(1) NOT NULL DEFAULT '0',
  `promo_saturday` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_promo: ~4 rows (approximately)
DELETE FROM `ret_promo`;
/*!40000 ALTER TABLE `ret_promo` DISABLE KEYS */;
INSERT INTO `ret_promo` (`promo_id`, `promo_type_id`, `promo_name`, `promo_date_start`, `promo_date_end`, `promo_time_start`, `promo_time_end`, `promo_sunday`, `promo_monday`, `promo_tuesday`, `promo_wednesday`, `promo_thursday`, `promo_friday`, `promo_saturday`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 'Promo ayam beli 5 diskon 5%', '2018-05-01', '2018-05-31', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-14 11:13:13', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 1, 'Beli 3 Es Teh Gratis 1', '2018-05-01', '2018-05-31', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-15 09:36:17', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 3, 'Setiap Belanja 100.000 diskon 3%', '2018-05-01', '2018-05-31', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-15 09:56:44', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 1, 'Super Promo', '2018-05-28', '2018-05-28', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-05-28 08:51:08', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(5, 1, 'Beli 5 dapet 1', '2018-07-01', '2018-07-31', '00:00:01', '23:59:59', 1, 1, 1, 1, 1, 1, 1, '2018-07-02 10:49:43', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_promo` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_promo_buyall
DROP TABLE IF EXISTS `ret_promo_buyall`;
CREATE TABLE IF NOT EXISTS `ret_promo_buyall` (
  `promo_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` float(10,2) NOT NULL COMMENT 'in_percent',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_buyall_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_promo_buyall: ~0 rows (approximately)
DELETE FROM `ret_promo_buyall`;
/*!40000 ALTER TABLE `ret_promo_buyall` DISABLE KEYS */;
INSERT INTO `ret_promo_buyall` (`promo_buyall_id`, `promo_id`, `buy_amount`, `get_discount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 3, 100000.00, 3.00, '2018-05-15 09:56:44', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_promo_buyall` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_promo_buyget
DROP TABLE IF EXISTS `ret_promo_buyget`;
CREATE TABLE IF NOT EXISTS `ret_promo_buyget` (
  `promo_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_buyget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_promo_buyget: ~2 rows (approximately)
DELETE FROM `ret_promo_buyget`;
/*!40000 ALTER TABLE `ret_promo_buyget` DISABLE KEYS */;
INSERT INTO `ret_promo_buyget` (`promo_buyget_id`, `promo_id`, `buy_item_id`, `buy_amount`, `get_item_id`, `get_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 2, 3.00, 2, 1.00, '2018-05-15 09:36:17', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 4, 1, 2.00, 2, 3.00, '2018-05-28 08:51:07', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 5, 1, 5.00, 1, 1.00, '2018-07-02 10:49:42', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_promo_buyget` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_promo_buyitem
DROP TABLE IF EXISTS `ret_promo_buyitem`;
CREATE TABLE IF NOT EXISTS `ret_promo_buyitem` (
  `promo_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10,2) NOT NULL,
  `get_discount` float(10,2) NOT NULL COMMENT 'in_percent',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_buyitem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_promo_buyitem: ~0 rows (approximately)
DELETE FROM `ret_promo_buyitem`;
/*!40000 ALTER TABLE `ret_promo_buyitem` DISABLE KEYS */;
INSERT INTO `ret_promo_buyitem` (`promo_buyitem_id`, `promo_id`, `buy_item_id`, `buy_amount`, `get_discount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 1, 5.00, 5.00, '2018-05-14 11:13:12', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_promo_buyitem` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_promo_type
DROP TABLE IF EXISTS `ret_promo_type`;
CREATE TABLE IF NOT EXISTS `ret_promo_type` (
  `promo_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_code` varchar(3) NOT NULL,
  `promo_type_name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_promo_type: ~3 rows (approximately)
DELETE FROM `ret_promo_type`;
/*!40000 ALTER TABLE `ret_promo_type` DISABLE KEYS */;
INSERT INTO `ret_promo_type` (`promo_type_id`, `promo_type_code`, `promo_type_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'PRB', 'Promo Buy Get', '2018-05-08 14:09:30', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'PRI', 'Promo Buy Item', '2018-05-08 14:09:30', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 'PRA', 'Promo Buy All\r\n', '2018-05-08 14:09:49', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_promo_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_return
DROP TABLE IF EXISTS `ret_return`;
CREATE TABLE IF NOT EXISTS `ret_return` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXR',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time NOT NULL,
  `return_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.ret_return: ~0 rows (approximately)
DELETE FROM `ret_return`;
/*!40000 ALTER TABLE `ret_return` DISABLE KEYS */;
INSERT INTO `ret_return` (`tx_id`, `tx_id_source`, `tx_receipt_no`, `tx_type`, `user_id`, `user_realname`, `customer_id`, `customer_name`, `tx_date`, `tx_time`, `return_notes`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, '180628000001', 'TXR', 1, 'Super Retail', 0, 'Umum', '2018-06-28', '12:47:15', 'Tidak enak', '2018-06-28 12:47:15', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_return` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_return_detail
DROP TABLE IF EXISTS `ret_return_detail`;
CREATE TABLE IF NOT EXISTS `ret_return_detail` (
  `return_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXR',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `tx_amount` float NOT NULL,
  `return_amount` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`return_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.ret_return_detail: ~0 rows (approximately)
DELETE FROM `ret_return_detail`;
/*!40000 ALTER TABLE `ret_return_detail` DISABLE KEYS */;
INSERT INTO `ret_return_detail` (`return_detail_id`, `tx_id`, `tx_type`, `item_id`, `item_name`, `item_price_after_tax`, `tx_amount`, `return_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 'TXR', 1, 'Ayam Goreng', 4400.00, 1, 1, '2018-06-28 12:47:16', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_return_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_role
DROP TABLE IF EXISTS `ret_role`;
CREATE TABLE IF NOT EXISTS `ret_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_role: ~3 rows (approximately)
DELETE FROM `ret_role`;
/*!40000 ALTER TABLE `ret_role` DISABLE KEYS */;
INSERT INTO `ret_role` (`role_id`, `role_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'Super Administrator Retail', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-08 13:40:17', 'Super Administrator', 1, 0),
	(1, 'Administrator Retail', '2018-03-30 11:18:19', 'Super Administrator', '2018-04-19 11:04:57', 'Super Administrator', 1, 0),
	(2, 'Cashier Retail', '2018-05-08 13:42:21', 'Admin Retail', '2018-05-28 22:17:09', 'Super Retail', 1, 0);
/*!40000 ALTER TABLE `ret_role` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_shift
DROP TABLE IF EXISTS `ret_shift`;
CREATE TABLE IF NOT EXISTS `ret_shift` (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date DEFAULT NULL,
  `shift_in_time` time DEFAULT NULL,
  `shift_out_date` date DEFAULT NULL,
  `shift_out_time` time DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT '0',
  `money_in_50k` int(11) NOT NULL DEFAULT '0',
  `money_in_20k` int(11) NOT NULL DEFAULT '0',
  `money_in_10k` int(11) NOT NULL DEFAULT '0',
  `money_in_5k` int(11) NOT NULL DEFAULT '0',
  `money_in_2k` int(11) NOT NULL DEFAULT '0',
  `money_in_1k` int(11) NOT NULL DEFAULT '0',
  `money_in_total` int(11) NOT NULL DEFAULT '0',
  `coin_in_1k` int(11) NOT NULL DEFAULT '0',
  `coin_in_500` int(11) NOT NULL DEFAULT '0',
  `coin_in_200` int(11) NOT NULL DEFAULT '0',
  `coin_in_100` int(11) NOT NULL DEFAULT '0',
  `coin_in_50` int(11) NOT NULL DEFAULT '0',
  `coin_in_25` int(11) NOT NULL DEFAULT '0',
  `coin_in_total` int(11) NOT NULL DEFAULT '0',
  `total_in` int(11) NOT NULL DEFAULT '0',
  `money_out_100k` int(11) NOT NULL DEFAULT '0',
  `money_out_50k` int(11) NOT NULL DEFAULT '0',
  `money_out_20k` int(11) NOT NULL DEFAULT '0',
  `money_out_10k` int(11) NOT NULL DEFAULT '0',
  `money_out_5k` int(11) NOT NULL DEFAULT '0',
  `money_out_2k` int(11) NOT NULL DEFAULT '0',
  `money_out_1k` int(11) NOT NULL DEFAULT '0',
  `money_out_total` int(11) NOT NULL DEFAULT '0',
  `coin_out_1k` int(11) NOT NULL DEFAULT '0',
  `coin_out_500` int(11) NOT NULL DEFAULT '0',
  `coin_out_200` int(11) NOT NULL DEFAULT '0',
  `coin_out_100` int(11) NOT NULL DEFAULT '0',
  `coin_out_50` int(11) NOT NULL DEFAULT '0',
  `coin_out_25` int(11) NOT NULL DEFAULT '0',
  `coin_out_total` int(11) NOT NULL DEFAULT '0',
  `total_out` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.ret_shift: ~5 rows (approximately)
DELETE FROM `ret_shift`;
/*!40000 ALTER TABLE `ret_shift` DISABLE KEYS */;
INSERT INTO `ret_shift` (`shift_id`, `user_id`, `user_realname`, `shift_in_status`, `shift_out_status`, `shift_in_date`, `shift_in_time`, `shift_out_date`, `shift_out_time`, `money_in_100k`, `money_in_50k`, `money_in_20k`, `money_in_10k`, `money_in_5k`, `money_in_2k`, `money_in_1k`, `money_in_total`, `coin_in_1k`, `coin_in_500`, `coin_in_200`, `coin_in_100`, `coin_in_50`, `coin_in_25`, `coin_in_total`, `total_in`, `money_out_100k`, `money_out_50k`, `money_out_20k`, `money_out_10k`, `money_out_5k`, `money_out_2k`, `money_out_1k`, `money_out_total`, `coin_out_1k`, `coin_out_500`, `coin_out_200`, `coin_out_100`, `coin_out_50`, `coin_out_25`, `coin_out_total`, `total_out`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	(1, 1, 'Super Retail', 1, 1, '2018-05-28', '10:13:28', '2018-05-28', '10:14:30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:13:28', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(2, 1, 'Super Retail', 1, 1, '2018-05-28', '10:17:11', '2018-05-28', '10:17:17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:17:11', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(3, 1, 'Super Retail', 1, 1, '2018-05-28', '10:19:49', '2018-05-30', '20:57:05', 1, 1, 1, 12, 1, 1, 0, 297000, 5, 5, 51, 1, 1, 1, 17875, 314875, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:19:49', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(4, 1, 'Super Retail', 1, 1, '2018-05-30', '20:57:07', '2018-06-05', '10:57:10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-30 20:57:07', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(5, 1, 'Super Retail', 1, 1, '2018-06-05', '11:49:27', '2018-07-03', '08:43:40', 56, 0, 0, 0, 0, 0, 0, 5600000, 0, 0, 0, 0, 0, 0, 0, 5600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-05 11:49:27', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail'),
	(6, 1, 'Super Retail', 1, 0, '2018-07-04', '13:17:31', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-07-04 13:17:31', 'Super Retail', '0000-00-00 00:00:00', 'System');
/*!40000 ALTER TABLE `ret_shift` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_stock
DROP TABLE IF EXISTS `ret_stock`;
CREATE TABLE IF NOT EXISTS `ret_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_in` float(10,2) NOT NULL,
  `stock_out` float(10,2) NOT NULL,
  `stock_adjustment` float(10,2) NOT NULL,
  `stock_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_stock: ~55 rows (approximately)
DELETE FROM `ret_stock`;
/*!40000 ALTER TABLE `ret_stock` DISABLE KEYS */;
INSERT INTO `ret_stock` (`stock_id`, `tx_id`, `tx_type`, `tx_date`, `item_id`, `stock_in`, `stock_out`, `stock_adjustment`, `stock_price`, `created`, `created_by`) VALUES
	(1, 1, 'TXS', '2018-06-28', 1, 0.00, -1.00, 0.00, 0.00, '2018-06-28 11:43:19', 'Super Retail'),
	(2, 1, 'TXR', '2018-06-28', 1, 1.00, 0.00, 0.00, 0.00, '2018-06-28 12:47:16', 'System'),
	(3, 12, 'TXV', '2018-06-28', 1, 1.00, 0.00, 0.00, 0.00, '2018-06-28 12:51:48', 'System'),
	(4, 3, 'TXS', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 09:28:57', 'Super Retail'),
	(5, 4, 'TXS', '2018-07-02', 2, 0.00, -1.00, 0.00, 0.00, '2018-07-02 09:30:51', 'Super Retail'),
	(6, 5, 'TXS', '2018-07-02', 2, 0.00, -3.00, 0.00, 0.00, '2018-07-02 09:31:10', 'Super Retail'),
	(7, 6, 'TXS', '2018-07-02', 2, 0.00, -4.00, 0.00, 0.00, '2018-07-02 09:31:55', 'Super Retail'),
	(8, 7, 'TXS', '2018-07-02', 2, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:29:26', 'Super Retail'),
	(9, 7, 'TXS', '2018-07-02', 1, 0.00, -3.00, 0.00, 0.00, '2018-07-02 10:29:26', 'Super Retail'),
	(10, 8, 'TXS', '2018-07-02', 1, 0.00, -11.00, 0.00, 0.00, '2018-07-02 10:33:00', 'Super Retail'),
	(11, 9, 'TXS', '2018-07-02', 2, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:38:33', 'Super Retail'),
	(12, 10, 'TXS', '2018-07-02', 2, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:38:51', 'Super Retail'),
	(13, 11, 'TXS', '2018-07-02', 1, 0.00, -5.00, 0.00, 0.00, '2018-07-02 10:49:58', 'Super Retail'),
	(14, 11, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:49:58', 'Super Retail'),
	(15, 12, 'TXS', '2018-07-02', 1, 0.00, -5.00, 0.00, 0.00, '2018-07-02 10:50:41', 'Super Retail'),
	(16, 12, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:50:41', 'Super Retail'),
	(17, 13, 'TXS', '2018-07-02', 1, 0.00, -6.00, 0.00, 0.00, '2018-07-02 10:51:17', 'Super Retail'),
	(18, 13, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:51:17', 'Super Retail'),
	(19, 14, 'TXS', '2018-07-02', 1, 0.00, -6.00, 0.00, 0.00, '2018-07-02 10:51:36', 'Super Retail'),
	(20, 14, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:51:36', 'Super Retail'),
	(21, 15, 'TXS', '2018-07-02', 2, 0.00, -2.00, 0.00, 0.00, '2018-07-02 10:53:10', 'Super Retail'),
	(22, 16, 'TXS', '2018-07-02', 2, 0.00, -6.00, 0.00, 0.00, '2018-07-02 10:53:35', 'Super Retail'),
	(23, 17, 'TXS', '2018-07-02', 1, 0.00, -5.00, 0.00, 0.00, '2018-07-02 10:55:49', 'Super Retail'),
	(24, 17, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:55:49', 'Super Retail'),
	(25, 18, 'TXS', '2018-07-02', 1, 0.00, -6.00, 0.00, 0.00, '2018-07-02 10:57:43', 'Super Retail'),
	(26, 18, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:57:43', 'Super Retail'),
	(27, 19, 'TXS', '2018-07-02', 1, 0.00, -7.00, 0.00, 0.00, '2018-07-02 10:58:15', 'Super Retail'),
	(28, 19, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:58:16', 'Super Retail'),
	(29, 20, 'TXS', '2018-07-02', 2, 0.00, -1.00, 0.00, 0.00, '2018-07-02 10:59:14', 'Super Retail'),
	(30, 24, 'TXS', '2018-07-02', 1, 0.00, -6.00, 0.00, 0.00, '2018-07-02 11:20:23', 'Super Retail'),
	(31, 24, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:20:23', 'Super Retail'),
	(32, 25, 'TXS', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:20:58', 'Super Retail'),
	(33, 26, 'TXS', '2018-07-02', 1, 0.00, -6.00, 0.00, 0.00, '2018-07-02 11:21:56', 'Super Retail'),
	(34, 26, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:21:56', 'Super Retail'),
	(35, 27, 'TXS', '2018-07-02', 1, 0.00, -6.00, 0.00, 0.00, '2018-07-02 11:23:34', 'Super Retail'),
	(36, 27, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:23:35', 'Super Retail'),
	(37, 28, 'TXS', '2018-07-02', 1, 0.00, -6.00, 0.00, 0.00, '2018-07-02 11:24:39', 'Super Retail'),
	(38, 28, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:24:39', 'Super Retail'),
	(39, 30, 'TXS', '2018-07-02', 1, 0.00, -2.00, 0.00, 0.00, '2018-07-02 11:27:48', 'Super Retail'),
	(40, 30, 'TXS', '2018-07-02', 1, 0.00, -2.00, 0.00, 0.00, '2018-07-02 11:27:48', 'Super Retail'),
	(41, 31, 'TXS', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:29:36', 'Super Retail'),
	(42, 34, 'TXS', '2018-07-02', 1, 0.00, -5.00, 0.00, 0.00, '2018-07-02 11:30:47', 'Super Retail'),
	(43, 34, 'PRB', '2018-07-02', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:30:47', 'Super Retail'),
	(44, 35, 'TXS', '2018-07-02', 2, 0.00, -3.00, 0.00, 0.00, '2018-07-02 11:31:09', 'Super Retail'),
	(45, 3, 'TXA', '2018-07-02', 1, 0.00, 0.00, 113.00, 12312.00, '2018-07-02 11:33:09', 'Super Retail'),
	(46, 3, 'TXA', '2018-07-02', 2, 0.00, 0.00, 35.00, 112312.00, '2018-07-02 11:33:09', 'Super Retail'),
	(47, 3, 'TXA', '2018-07-02', 3, 0.00, 0.00, 12.00, 1213.00, '2018-07-02 11:33:09', 'Super Retail'),
	(48, 1, 'TXI', '2018-07-02', 1, 1.00, 0.00, 0.00, 2345.00, '2018-07-02 11:40:18', 'Super Retail'),
	(49, 2, 'TXI', '2018-07-02', 2, 12.00, 0.00, 0.00, 123.00, '2018-07-02 11:41:21', 'Super Retail'),
	(50, 36, 'TXS', '2018-07-02', 2, 0.00, -1.00, 0.00, 0.00, '2018-07-02 11:42:49', 'Super Retail'),
	(51, 8, 'TXA', '2018-07-02', 1, 0.00, 0.00, -1.00, 1232.00, '2018-07-02 11:46:56', 'Super Retail'),
	(52, 8, 'TXA', '2018-07-02', 2, 0.00, 0.00, -11.00, 1213.00, '2018-07-02 11:46:56', 'Super Retail'),
	(53, 8, 'TXA', '2018-07-02', 3, 0.00, 0.00, 0.00, 12312.00, '2018-07-02 11:46:56', 'Super Retail'),
	(54, 9, 'TXA', '2018-07-02', 1, 0.00, 0.00, 0.00, 12123.00, '2018-07-02 11:47:23', 'Super Retail'),
	(55, 9, 'TXA', '2018-07-02', 2, 0.00, 0.00, 0.00, 321.00, '2018-07-02 11:47:23', 'Super Retail'),
	(56, 9, 'TXA', '2018-07-02', 3, 0.00, 0.00, 0.00, 123.00, '2018-07-02 11:47:23', 'Super Retail'),
	(57, 37, 'TXS', '2018-07-03', 1, 0.00, -10.00, 0.00, 0.00, '2018-07-03 08:41:42', 'Super Retail'),
	(58, 37, 'PRB', '2018-07-03', 1, 0.00, -1.00, 0.00, 0.00, '2018-07-03 08:41:42', 'Super Retail'),
	(59, 38, 'TXS', '2018-07-03', 2, 0.00, -1.00, 0.00, 0.00, '2018-07-03 08:43:24', 'Super Retail');
/*!40000 ALTER TABLE `ret_stock` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_stock_in
DROP TABLE IF EXISTS `ret_stock_in`;
CREATE TABLE IF NOT EXISTS `ret_stock_in` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_stock_in: ~2 rows (approximately)
DELETE FROM `ret_stock_in`;
/*!40000 ALTER TABLE `ret_stock_in` DISABLE KEYS */;
INSERT INTO `ret_stock_in` (`tx_id`, `tx_receipt_no`, `tx_type`, `tx_date`, `tx_notes`, `created`, `created_by`) VALUES
	(1, '180702000001', 'TXI', '2018-07-02', '123123', '2018-07-02 11:40:18', 'Super Retail'),
	(2, '180702000002', 'TXI', '2018-07-02', 'fasd', '2018-07-02 11:41:21', 'Super Retail');
/*!40000 ALTER TABLE `ret_stock_in` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_stock_opname
DROP TABLE IF EXISTS `ret_stock_opname`;
CREATE TABLE IF NOT EXISTS `ret_stock_opname` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text NOT NULL,
  `tx_status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_stock_opname: ~8 rows (approximately)
DELETE FROM `ret_stock_opname`;
/*!40000 ALTER TABLE `ret_stock_opname` DISABLE KEYS */;
INSERT INTO `ret_stock_opname` (`tx_id`, `tx_receipt_no`, `tx_type`, `tx_date`, `tx_notes`, `tx_status`, `created`, `created_by`) VALUES
	(1, '0', 'TXA', '2018-07-02', 'fasd', 0, '2018-07-02 09:36:08', 'Super Retail'),
	(2, '0', 'TXA', '2018-07-02', 'qe', 0, '2018-07-02 09:36:19', 'Super Retail'),
	(3, '180702000001', 'TXA', '2018-07-02', 'sadfasdf', 1, '2018-07-02 11:33:09', 'Super Retail'),
	(4, '180702000002', 'TXA', '2018-07-02', 'fasdfasd', 0, '2018-07-02 11:33:41', 'Super Retail'),
	(5, '180702000002', 'TXA', '2018-07-02', 'fasdfasd', 0, '2018-07-02 11:33:41', 'Super Retail'),
	(6, '180702000003', 'TXA', '2018-07-02', 'dqwq', 0, '2018-07-02 11:33:56', 'Super Retail'),
	(7, '180702000004', 'TXA', '2018-07-02', '12312', 0, '2018-07-02 11:46:28', 'Super Retail'),
	(8, '180702000005', 'TXA', '2018-07-02', 'fasdfasdf', 1, '2018-07-02 11:46:55', 'Super Retail'),
	(9, '180702000006', 'TXA', '2018-07-02', 'fasdfasd', 1, '2018-07-02 11:47:16', 'Super Retail');
/*!40000 ALTER TABLE `ret_stock_opname` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_stock_opname_detail
DROP TABLE IF EXISTS `ret_stock_opname_detail`;
CREATE TABLE IF NOT EXISTS `ret_stock_opname_detail` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_last` float(10,2) NOT NULL,
  `stock_now` float(10,2) NOT NULL,
  `stock_adjustment` float(10,2) NOT NULL,
  `stock_price` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_stock_opname_detail: ~24 rows (approximately)
DELETE FROM `ret_stock_opname_detail`;
/*!40000 ALTER TABLE `ret_stock_opname_detail` DISABLE KEYS */;
INSERT INTO `ret_stock_opname_detail` (`stock_id`, `tx_id`, `tx_type`, `tx_date`, `item_id`, `stock_last`, `stock_now`, `stock_adjustment`, `stock_price`, `created`, `created_by`) VALUES
	(1, 1, 'TXA', '2018-07-02', 1, 0.00, 12.00, 12.00, 1.00, '2018-07-02 09:36:08', 'Super Retail'),
	(2, 1, 'TXA', '2018-07-02', 2, -8.00, 12.00, 20.00, 2.00, '2018-07-02 09:36:08', 'Super Retail'),
	(3, 1, 'TXA', '2018-07-02', 3, 0.00, 12.00, 12.00, 1.00, '2018-07-02 09:36:08', 'Super Retail'),
	(4, 2, 'TXA', '2018-07-02', 1, 0.00, 0.00, 0.00, 0.00, '2018-07-02 09:36:19', 'Super Retail'),
	(5, 2, 'TXA', '2018-07-02', 2, -8.00, 0.00, 0.00, 0.00, '2018-07-02 09:36:19', 'Super Retail'),
	(6, 2, 'TXA', '2018-07-02', 3, 0.00, 0.00, 0.00, 0.00, '2018-07-02 09:36:19', 'Super Retail'),
	(7, 3, 'TXA', '2018-07-02', 1, -101.00, 12.00, 113.00, 12312.00, '2018-07-02 11:33:09', 'Super Retail'),
	(8, 3, 'TXA', '2018-07-02', 2, -23.00, 12.00, 35.00, 112312.00, '2018-07-02 11:33:09', 'Super Retail'),
	(9, 3, 'TXA', '2018-07-02', 3, 0.00, 12.00, 12.00, 1213.00, '2018-07-02 11:33:09', 'Super Retail'),
	(10, 4, 'TXA', '2018-07-02', 1, 12.00, 1.23, 1219.00, 0.00, '2018-07-02 11:33:41', 'Super Retail'),
	(11, 4, 'TXA', '2018-07-02', 2, 12.00, 0.00, 0.00, 0.00, '2018-07-02 11:33:41', 'Super Retail'),
	(12, 4, 'TXA', '2018-07-02', 3, 12.00, 12.31, 12300.00, 0.00, '2018-07-02 11:33:41', 'Super Retail'),
	(13, 4, 'TXA', '2018-07-02', 1, 12.00, 1.23, 1219.00, 0.00, '2018-07-02 11:33:41', 'Super Retail'),
	(14, 4, 'TXA', '2018-07-02', 2, 12.00, 0.00, 0.00, 0.00, '2018-07-02 11:33:41', 'Super Retail'),
	(15, 4, 'TXA', '2018-07-02', 3, 12.00, 12.31, 12300.00, 0.00, '2018-07-02 11:33:41', 'Super Retail'),
	(16, 6, 'TXA', '2018-07-02', 1, 12.00, 12.00, 0.00, 12.00, '2018-07-02 11:33:56', 'Super Retail'),
	(17, 6, 'TXA', '2018-07-02', 2, 12.00, 12.00, 0.00, 12.00, '2018-07-02 11:33:56', 'Super Retail'),
	(18, 6, 'TXA', '2018-07-02', 3, 12.00, 12.00, 0.00, 0.00, '2018-07-02 11:33:56', 'Super Retail'),
	(19, 7, 'TXA', '2018-07-02', 1, 13.00, 12.00, -1.00, 3121.00, '2018-07-02 11:46:28', 'Super Retail'),
	(20, 7, 'TXA', '2018-07-02', 2, 23.00, 12.00, -11.00, 3232.00, '2018-07-02 11:46:28', 'Super Retail'),
	(21, 7, 'TXA', '2018-07-02', 3, 12.00, 12.00, 0.00, 2341.00, '2018-07-02 11:46:28', 'Super Retail'),
	(22, 8, 'TXA', '2018-07-02', 1, 13.00, 12.00, -1.00, 1232.00, '2018-07-02 11:46:56', 'Super Retail'),
	(23, 8, 'TXA', '2018-07-02', 2, 23.00, 12.00, -11.00, 1213.00, '2018-07-02 11:46:56', 'Super Retail'),
	(24, 8, 'TXA', '2018-07-02', 3, 12.00, 12.00, 0.00, 12312.00, '2018-07-02 11:46:56', 'Super Retail'),
	(25, 9, 'TXA', '2018-07-02', 1, 12.00, 12.00, 0.00, 12123.00, '2018-07-02 11:47:16', 'Super Retail'),
	(26, 9, 'TXA', '2018-07-02', 2, 12.00, 12.00, 0.00, 321.00, '2018-07-02 11:47:16', 'Super Retail'),
	(27, 9, 'TXA', '2018-07-02', 3, 12.00, 32.00, 0.00, 123.00, '2018-07-02 11:47:16', 'Super Retail');
/*!40000 ALTER TABLE `ret_stock_opname_detail` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_stock_out
DROP TABLE IF EXISTS `ret_stock_out`;
CREATE TABLE IF NOT EXISTS `ret_stock_out` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_stock_out: ~0 rows (approximately)
DELETE FROM `ret_stock_out`;
/*!40000 ALTER TABLE `ret_stock_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `ret_stock_out` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_supplier
DROP TABLE IF EXISTS `ret_supplier`;
CREATE TABLE IF NOT EXISTS `ret_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_phone` varchar(20) NOT NULL,
  `supplier_fax` varchar(20) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_address` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_supplier: ~5 rows (approximately)
DELETE FROM `ret_supplier`;
/*!40000 ALTER TABLE `ret_supplier` DISABLE KEYS */;
INSERT INTO `ret_supplier` (`supplier_id`, `supplier_name`, `supplier_phone`, `supplier_fax`, `supplier_email`, `supplier_address`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'asdfasd12312', 'fasdfa', '1231231', '3212!fa@fahsd.com', 'hdalkjsdfa\r\n', '2018-05-08 13:56:44', 'Super Retail', '2018-05-08 13:56:50', 'Super Retail', 1, 1),
	(2, '', '', '', '', '', '2018-05-08 14:01:37', 'Super Retail', '2018-05-08 14:02:21', '', 1, 1),
	(3, '', '', '', '', '', '2018-05-08 14:02:03', 'Super Retail', '2018-05-08 14:02:24', '', 1, 1),
	(4, 'CV Mitra Abadi', '0293 713123', '085637283', 'mitra@miraabadi.com', 'Jalan Kenanga\r\n', '2018-05-09 08:40:54', 'Super Retail', '2018-06-04 09:04:14', 'Super Retail', 1, 0),
	(5, 'fasd', '121', '123', 'a@a.com', 'asdf', '2018-05-28 08:32:23', 'Super Retail', '2018-05-28 08:32:26', '', 1, 1);
/*!40000 ALTER TABLE `ret_supplier` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_tax
DROP TABLE IF EXISTS `ret_tax`;
CREATE TABLE IF NOT EXISTS `ret_tax` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(8) NOT NULL,
  `tax_name` varchar(128) NOT NULL,
  `tax_ratio` float(10,2) NOT NULL COMMENT 'in percent',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_tax: ~0 rows (approximately)
DELETE FROM `ret_tax`;
/*!40000 ALTER TABLE `ret_tax` DISABLE KEYS */;
INSERT INTO `ret_tax` (`tax_id`, `tax_code`, `tax_name`, `tax_ratio`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'PPn', 'Pajak Penjualan', 10.00, '2018-05-08 11:05:43', 'Super Administrator', '2018-05-09 08:35:14', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_tax` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_tx_type
DROP TABLE IF EXISTS `ret_tx_type`;
CREATE TABLE IF NOT EXISTS `ret_tx_type` (
  `tx_type` varchar(3) NOT NULL,
  `tx_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`tx_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_tx_type: ~6 rows (approximately)
DELETE FROM `ret_tx_type`;
/*!40000 ALTER TABLE `ret_tx_type` DISABLE KEYS */;
INSERT INTO `ret_tx_type` (`tx_type`, `tx_name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
	('TXA', 'Adjustment', '2018-04-11 13:59:45', 'System', '0000-00-00 00:00:00', ''),
	('TXI', 'In Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', ''),
	('TXO', 'Out Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', ''),
	('TXP', 'Purchase Order\r\n', '2018-04-12 14:15:57', 'System', '0000-00-00 00:00:00', ''),
	('TXR', 'Receive Order', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', ''),
	('TXS', 'Selling ', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `ret_tx_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_unit
DROP TABLE IF EXISTS `ret_unit`;
CREATE TABLE IF NOT EXISTS `ret_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(10) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_unit: ~7 rows (approximately)
DELETE FROM `ret_unit`;
/*!40000 ALTER TABLE `ret_unit` DISABLE KEYS */;
INSERT INTO `ret_unit` (`unit_id`, `unit_code`, `unit_name`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(0, 'pcs', 'Pieces', '2018-05-08 13:31:41', 'System', '2018-06-04 09:01:43', '', 1, 0),
	(1, 'gr', 'Gram', '2018-06-04 09:02:07', 'System', '2018-06-04 09:02:10', '', 1, 0),
	(2, 'kg', 'Kilogram', '2018-06-04 09:02:32', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(3, 'doz', 'Lusin', '2018-06-04 09:02:46', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(4, 'pks', 'Packs', '2018-06-04 09:03:03', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(5, 'gross', 'Gross', '2018-06-04 09:03:16', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(6, 'krtn', 'Karton', '2018-06-04 09:03:28', 'System', '0000-00-00 00:00:00', '', 1, 0);
/*!40000 ALTER TABLE `ret_unit` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_user
DROP TABLE IF EXISTS `ret_user`;
CREATE TABLE IF NOT EXISTS `ret_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.ret_user: ~3 rows (approximately)
DELETE FROM `ret_user`;
/*!40000 ALTER TABLE `ret_user` DISABLE KEYS */;
INSERT INTO `ret_user` (`user_id`, `user_name`, `role_id`, `user_password`, `user_realname`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'superretail', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Retail', '2018-04-04 10:45:37', '', '2018-05-08 13:40:06', 'Super Administrator', 1, 0),
	(2, 'adminretail', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Retail', '2018-05-08 13:40:40', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 'cashierretail', 2, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Retail', '2018-06-04 09:27:29', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_user` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_void
DROP TABLE IF EXISTS `ret_void`;
CREATE TABLE IF NOT EXISTS `ret_void` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXV',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time NOT NULL,
  `void_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.ret_void: ~5 rows (approximately)
DELETE FROM `ret_void`;
/*!40000 ALTER TABLE `ret_void` DISABLE KEYS */;
INSERT INTO `ret_void` (`tx_id`, `tx_receipt_no`, `tx_id_source`, `tx_type`, `user_id`, `user_realname`, `customer_id`, `customer_name`, `tx_date`, `tx_time`, `void_notes`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(8, '0', 1, 'TXV', 1, 'Super Retail', 0, 'Umum', '2018-06-07', '14:54:17', '', '2018-06-07 14:54:17', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, '0', 0, 'TXV', 1, 'Super Retail', 0, 'Umum', '2018-06-13', '10:06:20', '', '2018-06-13 10:06:20', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, '180627000002', 21, 'TXV', 1, 'Super Retail', 0, 'Umum', '2018-06-27', '13:24:40', '', '2018-06-27 13:24:40', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, '180627000002', 21, 'TXV', 1, 'Super Retail', 0, 'Umum', '2018-06-27', '13:29:57', 'fasdfasd', '2018-06-27 13:29:57', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(12, '180628000001', 1, 'TXV', 1, 'Super Retail', 0, 'Umum', '2018-06-28', '12:51:48', 'tidak ', '2018-06-28 12:51:48', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_void` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.ret_void_detail
DROP TABLE IF EXISTS `ret_void_detail`;
CREATE TABLE IF NOT EXISTS `ret_void_detail` (
  `void_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL DEFAULT 'TXV',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `tx_amount` float NOT NULL,
  `void_amount` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`void_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.ret_void_detail: ~5 rows (approximately)
DELETE FROM `ret_void_detail`;
/*!40000 ALTER TABLE `ret_void_detail` DISABLE KEYS */;
INSERT INTO `ret_void_detail` (`void_detail_id`, `tx_id`, `tx_type`, `item_id`, `item_name`, `item_price_after_tax`, `tx_amount`, `void_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(9, 8, 'TXV', 1, 'Ayam Goreng', 4400.00, 1, 1, '2018-06-07 14:54:17', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, 9, 'TXV', 1, 'Ayam Goreng', 4400.00, 2, 2, '2018-06-13 10:06:22', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, 10, 'TXV', 2, 'Es Teh', 1980.00, 2, 2, '2018-06-27 13:24:40', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(12, 11, 'TXV', 2, 'Es Teh', 1980.00, 2, 2, '2018-06-27 13:29:57', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0),
	(13, 12, 'TXV', 1, 'Ayam Goreng', 4400.00, 1, 1, '2018-06-28 12:51:48', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `ret_void_detail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
