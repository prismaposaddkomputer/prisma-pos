-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5280
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table prisma_pos.hot_billing
CREATE TABLE IF NOT EXISTS `hot_billing` (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_receipt_no` varchar(50) NOT NULL,
  `guest_type` tinyint(1) NOT NULL DEFAULT '0',
  `guest_id` int(11) NOT NULL,
  `guest_name` varchar(128) NOT NULL,
  `guest_gender` char(1) NOT NULL,
  `guest_phone` varchar(15) NOT NULL,
  `guest_id_type` tinyint(1) NOT NULL,
  `guest_id_no` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `billing_date_in` date NOT NULL,
  `billing_time_in` time NOT NULL,
  `billing_date_out` date NOT NULL,
  `billing_time_out` time NOT NULL,
  `billing_num_day` int(11) NOT NULL,
  `billing_sub_total` float(10,2) NOT NULL,
  `billing_grand_total` float(10,2) NOT NULL,
  `billing_payment_type` tinyint(1) NOT NULL,
  `billing_down_payment` float(10,2) NOT NULL,
  `billing_payment` float(10,2) NOT NULL,
  `billing_change` float(10,2) NOT NULL,
  `billing_cancel_note` varchar(128) NOT NULL,
  `billing_status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_billing: ~9 rows (approximately)
DELETE FROM `hot_billing`;
/*!40000 ALTER TABLE `hot_billing` DISABLE KEYS */;
INSERT INTO `hot_billing` (`billing_id`, `billing_receipt_no`, `guest_type`, `guest_id`, `guest_name`, `guest_gender`, `guest_phone`, `guest_id_type`, `guest_id_no`, `user_id`, `user_realname`, `billing_date_in`, `billing_time_in`, `billing_date_out`, `billing_time_out`, `billing_num_day`, `billing_sub_total`, `billing_grand_total`, `billing_payment_type`, `billing_down_payment`, `billing_payment`, `billing_change`, `billing_cancel_note`, `billing_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '180823000001', 1, 0, 'Suparman', 'L', '', 1, '', 1, 'Super Hotel', '2018-08-23', '10:18:04', '2018-08-23', '10:18:04', 0, 200000.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-23 10:18:20', 'Super Hotel', '0000-00-00 00:00:00', '', 1, 0),
	(2, '180824000001', 0, 0, 'Supardi', 'L', '', 1, '', 1, 'Super Hotel', '2018-08-24', '10:04:50', '2018-08-24', '10:04:50', 0, 710000.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-24 10:06:02', 'Super Hotel', '0000-00-00 00:00:00', '', 1, 0),
	(3, '', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-26 18:37:29', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(4, '180826000001', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-26 19:52:32', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(5, '180826000001', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-26 19:52:47', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(6, '180826000002', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-26 20:01:22', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(7, '180826000003', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-26 20:01:24', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(8, '180826000004', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 1, '2018-08-26 20:01:26', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(9, '180826000005', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-26 20:31:21', 'System', '0000-00-00 00:00:00', '', 1, 0);
/*!40000 ALTER TABLE `hot_billing` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_billing_extra
CREATE TABLE IF NOT EXISTS `hot_billing_extra` (
  `billing_extra_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `extra_id` int(11) NOT NULL,
  `extra_name` varchar(128) NOT NULL,
  `extra_charge` float(10,2) NOT NULL,
  `extra_amount` float(10,2) NOT NULL,
  `extra_total` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_extra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_extra: ~11 rows (approximately)
DELETE FROM `hot_billing_extra`;
/*!40000 ALTER TABLE `hot_billing_extra` DISABLE KEYS */;
INSERT INTO `hot_billing_extra` (`billing_extra_id`, `billing_id`, `extra_id`, `extra_name`, `extra_charge`, `extra_amount`, `extra_total`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 1, 1, 'Single bed', 100000.00, 0.00, 0.00, '2018-08-23 03:54:01', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 1, 1, 'Single bed', 100000.00, 0.00, 0.00, '2018-08-23 03:54:01', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 1, 2, 'Double Bed', 250000.00, 0.00, 0.00, '2018-08-23 04:03:31', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(4, 1, 2, 'Double Bed', 250000.00, 0.00, 0.00, '2018-08-23 04:05:24', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(5, 1, 2, 'Double Bed', 250000.00, 0.00, 0.00, '2018-08-23 04:05:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(6, 1, 2, 'Double Bed', 250000.00, 0.00, 0.00, '2018-08-23 04:05:49', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(7, 2, 2, 'Double Bed', 250000.00, 0.00, 0.00, '2018-08-23 08:54:39', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(8, 3, 1, 'Single bed', 100000.00, 0.00, 0.00, '2018-08-23 10:00:36', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, 2, 1, 'Single bed', 100000.00, 0.00, 0.00, '2018-08-24 10:06:02', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, 2, 2, 'Double Bed', 250000.00, 0.00, 0.00, '2018-08-24 10:06:02', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_billing_extra` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_billing_fnb
CREATE TABLE IF NOT EXISTS `hot_billing_fnb` (
  `billing_fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `fnb_id` int(11) NOT NULL,
  `fnb_name` varchar(128) NOT NULL,
  `fnb_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_fnb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_fnb: ~1 rows (approximately)
DELETE FROM `hot_billing_fnb`;
/*!40000 ALTER TABLE `hot_billing_fnb` DISABLE KEYS */;
INSERT INTO `hot_billing_fnb` (`billing_fnb_id`, `billing_id`, `fnb_id`, `fnb_name`, `fnb_charge`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 3, 1, 'Roti Mari', 50000.00, '2018-08-23 10:00:36', 'System', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 2, 1, 'Roti Mari', 50000.00, '2018-08-24 10:06:02', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_billing_fnb` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_billing_room
CREATE TABLE IF NOT EXISTS `hot_billing_room` (
  `billing_room_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `room_id` int(11) NOT NULL,
  `room_name` varchar(128) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_type_name` varchar(128) NOT NULL,
  `room_type_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_room: ~0 rows (approximately)
DELETE FROM `hot_billing_room`;
/*!40000 ALTER TABLE `hot_billing_room` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_billing_room` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_billing_service
CREATE TABLE IF NOT EXISTS `hot_billing_service` (
  `billing_service_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `service_id` int(11) NOT NULL,
  `service_name` varchar(128) NOT NULL,
  `service_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_service: ~1 rows (approximately)
DELETE FROM `hot_billing_service`;
/*!40000 ALTER TABLE `hot_billing_service` DISABLE KEYS */;
INSERT INTO `hot_billing_service` (`billing_service_id`, `billing_id`, `service_id`, `service_name`, `service_charge`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 2, 1, 'handuk', 10000.00, '2018-08-24 10:06:02', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_billing_service` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
