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
  `billing_subtotal` float(10,2) NOT NULL,
  `billing_tax` float(10,2) NOT NULL,
  `billing_service` float(10,2) NOT NULL,
  `billing_other` float(10,2) NOT NULL,
  `billing_total` float(10,2) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_billing: ~6 rows (approximately)
DELETE FROM `hot_billing`;
/*!40000 ALTER TABLE `hot_billing` DISABLE KEYS */;
INSERT INTO `hot_billing` (`billing_id`, `billing_receipt_no`, `guest_type`, `guest_id`, `guest_name`, `guest_gender`, `guest_phone`, `guest_id_type`, `guest_id_no`, `user_id`, `user_realname`, `billing_date_in`, `billing_time_in`, `billing_date_out`, `billing_time_out`, `billing_num_day`, `billing_subtotal`, `billing_tax`, `billing_service`, `billing_other`, `billing_total`, `billing_payment_type`, `billing_down_payment`, `billing_payment`, `billing_change`, `billing_cancel_note`, `billing_status`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '180829000001', 0, 0, 'Suparji', 'L', '123456', 2, '330812356', 0, '', '2018-08-30', '11:04:58', '2018-08-30', '11:04:58', 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 200000.00, 0.00, 0.00, '', 1, '2018-08-29 09:37:20', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(2, '180830000001', 0, 0, 'Paiman', 'L', '', 1, '', 0, '', '2018-08-30', '12:24:16', '2018-08-30', '12:24:16', 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 1, '2018-08-30 11:06:44', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(3, '180830000002', 0, 0, 'Superman', 'L', '', 1, '', 0, '', '2018-08-30', '12:49:17', '2018-08-30', '12:49:17', 1, 0.00, 20000.00, 20000.00, 0.00, 240000.00, 0, 0.00, 0.00, 0.00, '', 1, '2018-08-30 12:25:48', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(4, '180830000003', 0, 0, 'Paino', 'L', '123', 1, '12312312', 0, '', '2018-08-30', '12:51:06', '2018-08-30', '12:51:06', 1, 500000.00, 60000.00, 10000.00, 0.00, 670000.00, 0, 0.00, 0.00, 0.00, '', 1, '2018-08-30 12:51:06', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(5, '180830000004', 0, 0, 'ffff', 'L', '12345', 1, '', 0, '', '2018-08-30', '12:52:03', '2018-08-30', '12:52:03', 1, 250000.00, 25000.00, 0.00, 0.00, 275000.00, 0, 0.00, 0.00, 0.00, '', 1, '2018-08-30 12:52:03', 'System', '0000-00-00 00:00:00', '', 1, 0),
	(6, '180830000005', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-30 13:02:41', 'System', '0000-00-00 00:00:00', '', 1, 0);
/*!40000 ALTER TABLE `hot_billing` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_billing_extra
CREATE TABLE IF NOT EXISTS `hot_billing_extra` (
  `billing_extra_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `extra_id` int(11) NOT NULL,
  `extra_name` varchar(128) NOT NULL,
  `extra_charge` float(10,2) NOT NULL,
  `extra_amount` float(10,2) NOT NULL,
  `extra_subtotal` float(10,2) NOT NULL,
  `extra_tax` float(10,2) NOT NULL,
  `extra_total` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_extra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_extra: ~4 rows (approximately)
DELETE FROM `hot_billing_extra`;
/*!40000 ALTER TABLE `hot_billing_extra` DISABLE KEYS */;
INSERT INTO `hot_billing_extra` (`billing_extra_id`, `billing_id`, `extra_id`, `extra_name`, `extra_charge`, `extra_amount`, `extra_subtotal`, `extra_tax`, `extra_total`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(8, 1, 1, 'Single bed', 100000.00, 3.00, 300000.00, 30000.00, 330000.00, '2018-08-30 11:05:19', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(9, 3, 1, 'Single bed', 100000.00, 1.00, 100000.00, 10000.00, 110000.00, '2018-08-30 12:49:39', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(10, 4, 2, 'Double Bed', 250000.00, 2.00, 500000.00, 50000.00, 550000.00, '2018-08-30 12:51:18', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(11, 5, 2, 'Double Bed', 250000.00, 1.00, 250000.00, 25000.00, 275000.00, '2018-08-30 12:52:11', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_billing_extra` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_billing_fnb
CREATE TABLE IF NOT EXISTS `hot_billing_fnb` (
  `billing_fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `fnb_id` int(11) NOT NULL,
  `fnb_name` varchar(128) NOT NULL,
  `fnb_charge` float(10,2) NOT NULL,
  `fnb_amount` float(10,2) NOT NULL,
  `fnb_subtotal` float(10,2) NOT NULL,
  `fnb_tax` float(10,2) NOT NULL,
  `fnb_total` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_fnb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_fnb: ~2 rows (approximately)
DELETE FROM `hot_billing_fnb`;
/*!40000 ALTER TABLE `hot_billing_fnb` DISABLE KEYS */;
INSERT INTO `hot_billing_fnb` (`billing_fnb_id`, `billing_id`, `fnb_id`, `fnb_name`, `fnb_charge`, `fnb_amount`, `fnb_subtotal`, `fnb_tax`, `fnb_total`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(2, 3, 1, 'Roti Mari', 50000.00, 1.00, 50000.00, 5000.00, 55000.00, '2018-08-30 12:49:54', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(3, 3, 2, 'Roti Tawar', 7000.00, 2.00, 14000.00, 1400.00, 15400.00, '2018-08-30 12:49:59', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
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
  `room_type_duration` float(10,2) NOT NULL,
  `room_type_subtotal` float(10,2) NOT NULL,
  `room_type_tax` float(10,2) NOT NULL,
  `room_type_service` float(10,2) NOT NULL,
  `room_type_other` float(10,2) NOT NULL,
  `room_type_total` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_room: ~5 rows (approximately)
DELETE FROM `hot_billing_room`;
/*!40000 ALTER TABLE `hot_billing_room` DISABLE KEYS */;
INSERT INTO `hot_billing_room` (`billing_room_id`, `billing_id`, `room_id`, `room_name`, `room_type_id`, `room_type_name`, `room_type_charge`, `room_type_duration`, `room_type_subtotal`, `room_type_tax`, `room_type_service`, `room_type_other`, `room_type_total`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(18, 1, 110, 'Melati - 10', 1, 'Melati', 100000.00, 0.00, 0.00, 10000.00, 0.00, 0.00, 110000.00, '2018-08-30 11:05:12', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(19, 2, 110, 'Melati - 10', 1, 'Melati', 100000.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 120000.00, '2018-08-30 12:24:24', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(20, 3, 110, 'Melati - 10', 1, 'Melati', 100000.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 120000.00, '2018-08-30 12:49:25', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(21, 3, 13, 'Melati - 03', 1, 'Melati', 100000.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 120000.00, '2018-08-30 12:49:32', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(22, 4, 11, 'Melati - 01', 1, 'Melati', 100000.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 120000.00, '2018-08-30 12:51:12', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(23, 6, 12, 'Melati - 02', 1, 'Melati', 100000.00, 1.00, 100000.00, 10000.00, 10000.00, 0.00, 120000.00, '2018-08-30 14:44:21', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_billing_room` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_billing_service
CREATE TABLE IF NOT EXISTS `hot_billing_service` (
  `billing_service_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `service_id` int(11) NOT NULL,
  `service_name` varchar(128) NOT NULL,
  `service_charge` float(10,2) NOT NULL,
  `service_amount` float(10,2) NOT NULL,
  `service_subtotal` float(10,2) NOT NULL,
  `service_tax` float(10,2) NOT NULL,
  `service_total` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_service: ~2 rows (approximately)
DELETE FROM `hot_billing_service`;
/*!40000 ALTER TABLE `hot_billing_service` DISABLE KEYS */;
INSERT INTO `hot_billing_service` (`billing_service_id`, `billing_id`, `service_id`, `service_name`, `service_charge`, `service_amount`, `service_subtotal`, `service_tax`, `service_total`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(4, 1, 1, 'handuk', 10000.00, 2.00, 20000.00, 2000.00, 22000.00, '2018-08-30 11:05:26', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(5, 3, 1, 'handuk', 10000.00, 2.00, 20000.00, 2000.00, 22000.00, '2018-08-30 12:49:47', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_billing_service` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking: ~0 rows (approximately)
DELETE FROM `hot_booking`;
/*!40000 ALTER TABLE `hot_booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_booking` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking_diskon
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking_diskon: ~0 rows (approximately)
DELETE FROM `hot_booking_diskon`;
/*!40000 ALTER TABLE `hot_booking_diskon` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_booking_diskon` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking_room
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking_room: ~0 rows (approximately)
DELETE FROM `hot_booking_room`;
/*!40000 ALTER TABLE `hot_booking_room` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_booking_room` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_booking_service
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_booking_service: ~0 rows (approximately)
DELETE FROM `hot_booking_service`;
/*!40000 ALTER TABLE `hot_booking_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_booking_service` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_category
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
  `status` int(155) DEFAULT NULL,
  `before_tax` int(155) DEFAULT NULL,
  `tax` int(155) DEFAULT NULL,
  `after_tax` int(155) DEFAULT NULL,
  `service_hotel` int(155) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_category: ~0 rows (approximately)
DELETE FROM `hot_category`;
/*!40000 ALTER TABLE `hot_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_category` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_charge_type
CREATE TABLE IF NOT EXISTS `hot_charge_type` (
  `charge_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_type_code` varchar(15) NOT NULL,
  `charge_type_name` varchar(128) NOT NULL,
  `charge_type_ratio` float(10,2) NOT NULL DEFAULT '0.00',
  `charge_type_desc` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`charge_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_charge_type: ~3 rows (approximately)
DELETE FROM `hot_charge_type`;
/*!40000 ALTER TABLE `hot_charge_type` DISABLE KEYS */;
INSERT INTO `hot_charge_type` (`charge_type_id`, `charge_type_code`, `charge_type_name`, `charge_type_ratio`, `charge_type_desc`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '1.1.1.01.05', 'Pajak Daerah Hotel ', 10.00, 'Pajak Daerah', '2018-08-20 10:21:11', 'System', '2018-08-24 10:48:53', 'Super Restaurant', 1, 0),
	(2, 'SRV', 'Servis Hotel', 10.00, 'Biaya Servis', '2018-08-20 10:21:11', 'System', '2018-08-30 12:24:09', 'Super Hotel', 1, 0),
	(3, 'OTR', 'Biaya lain-lain', 1.00, '', '2018-08-24 10:45:15', 'Super Restaurant', '2018-08-25 20:22:04', 'Super Hotel', 0, 0);
/*!40000 ALTER TABLE `hot_charge_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_client
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
  `client_logo` varchar(255) DEFAULT NULL,
  `client_is_taxed` tinyint(1) NOT NULL DEFAULT '1',
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
INSERT INTO `hot_client` (`client_id`, `client_name`, `client_brand`, `client_status`, `client_street`, `client_subdistrict`, `client_district`, `client_city`, `client_province`, `client_email`, `client_phone_1`, `client_phone_2`, `client_npwp`, `client_npwpd`, `client_owner_name`, `client_owner_address`, `client_notes`, `client_serial_number`, `client_keyboard_status`, `client_logo`, `client_is_taxed`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	('1', 'CV Prisma Hotel', 'Prisma Hotel', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, NULL, 1, '2018-05-08 10:26:03', 'System', '2018-08-30 10:42:18', 'Super Hotel', 1, 0);
/*!40000 ALTER TABLE `hot_client` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_discount
CREATE TABLE IF NOT EXISTS `hot_discount` (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(128) NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT '1',
  `discount_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_discount: ~2 rows (approximately)
DELETE FROM `hot_discount`;
/*!40000 ALTER TABLE `hot_discount` DISABLE KEYS */;
INSERT INTO `hot_discount` (`discount_id`, `discount_name`, `discount_type`, `discount_amount`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Hut RI', 1, 10.00, '2018-08-21 08:33:21', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'HUr', 2, 10000.00, '2018-08-21 08:33:29', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_discount` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_diskon
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
  `nominal` int(155) DEFAULT NULL,
  PRIMARY KEY (`diskon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_diskon: ~0 rows (approximately)
DELETE FROM `hot_diskon`;
/*!40000 ALTER TABLE `hot_diskon` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_diskon` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_extra
CREATE TABLE IF NOT EXISTS `hot_extra` (
  `extra_id` int(11) NOT NULL AUTO_INCREMENT,
  `extra_name` varchar(128) NOT NULL,
  `extra_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`extra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_extra: ~2 rows (approximately)
DELETE FROM `hot_extra`;
/*!40000 ALTER TABLE `hot_extra` DISABLE KEYS */;
INSERT INTO `hot_extra` (`extra_id`, `extra_name`, `extra_charge`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Single bed', 100000.00, '2018-08-22 20:33:52', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'Double Bed', 250000.00, '2018-08-22 20:34:00', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_extra` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_fnb
CREATE TABLE IF NOT EXISTS `hot_fnb` (
  `fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fnb_name` varchar(128) NOT NULL,
  `fnb_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fnb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_fnb: ~2 rows (approximately)
DELETE FROM `hot_fnb`;
/*!40000 ALTER TABLE `hot_fnb` DISABLE KEYS */;
INSERT INTO `hot_fnb` (`fnb_id`, `fnb_name`, `fnb_charge`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Roti Mari', 50000.00, '2018-08-22 20:57:27', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'Roti Tawar', 7000.00, '2018-08-22 20:57:34', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_fnb` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_guest
CREATE TABLE IF NOT EXISTS `hot_guest` (
  `guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_name` varchar(128) NOT NULL,
  `guest_gender` char(1) NOT NULL,
  `guest_type` tinyint(1) NOT NULL DEFAULT '0',
  `guest_phone` varchar(128) NOT NULL,
  `guest_address` varchar(255) NOT NULL,
  `guest_id_type` tinyint(1) NOT NULL DEFAULT '1',
  `guest_id_no` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_guest: ~0 rows (approximately)
DELETE FROM `hot_guest`;
/*!40000 ALTER TABLE `hot_guest` DISABLE KEYS */;
INSERT INTO `hot_guest` (`guest_id`, `guest_name`, `guest_gender`, `guest_type`, `guest_phone`, `guest_address`, `guest_id_type`, `guest_id_no`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Budi Raharyanto', 'L', 1, '1235', '', 2, '123344531231231231', '2018-08-26 06:26:13', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);
/*!40000 ALTER TABLE `hot_guest` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_log
CREATE TABLE IF NOT EXISTS `hot_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_log: ~51 rows (approximately)
DELETE FROM `hot_log`;
/*!40000 ALTER TABLE `hot_log` DISABLE KEYS */;
INSERT INTO `hot_log` (`log_id`, `user_id`, `user_realname`, `log_type`, `log_date`, `log_time`) VALUES
	(1, 1, 'Super Hotel', 'Sign In', '2018-08-20', '05:19:05'),
	(2, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '05:22:32'),
	(3, 1, 'Super Hotel', 'Sign In', '2018-08-20', '05:22:51'),
	(4, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '05:25:20'),
	(5, 2, 'Admin Hotel', 'Sign In', '2018-08-20', '05:25:27'),
	(6, 2, 'Admin Hotel', 'Sign Out', '2018-08-20', '05:25:38'),
	(7, 3, 'Cashier Hotel', 'Sign In', '2018-08-20', '05:25:46'),
	(8, 3, 'Cashier Hotel', 'Sign Out', '2018-08-20', '05:25:54'),
	(9, 2, 'Admin Hotel', 'Sign In', '2018-08-20', '05:34:04'),
	(10, 2, 'Admin Hotel', 'Sign Out', '2018-08-20', '05:34:14'),
	(11, 1, 'Super Hotel', 'Sign In', '2018-08-20', '05:43:33'),
	(12, 1, 'Super Hotel', 'Sign In', '2018-08-20', '09:46:44'),
	(13, 1, 'Super Hotel', 'Sign In', '2018-08-20', '09:49:25'),
	(14, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '14:45:49'),
	(15, 1, 'Super Hotel', 'Sign In', '2018-08-20', '14:45:55'),
	(16, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '14:46:04'),
	(17, 1, 'Super Hotel', 'Sign In', '2018-08-20', '14:46:08'),
	(18, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '14:46:34'),
	(19, 1, 'Super Hotel', 'Sign In', '2018-08-20', '14:46:35'),
	(20, 1, 'Super Hotel', 'Sign In', '2018-08-20', '14:55:19'),
	(21, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '15:10:39'),
	(22, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:11:18'),
	(23, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:14:22'),
	(24, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:14:54'),
	(25, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:15:21'),
	(26, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:15:55'),
	(27, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:17:16'),
	(28, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:24:50'),
	(29, 1, 'Super Hotel', 'Sign In', '2018-08-21', '08:25:29'),
	(30, 1, 'Super Hotel', 'Sign Out', '2018-08-21', '08:29:50'),
	(31, 1, 'Super Hotel', 'Sign In', '2018-08-21', '08:30:54'),
	(32, 1, 'Super Hotel', 'Sign In', '2018-08-21', '08:33:13'),
	(33, 1, 'Super Hotel', 'Sign In', '2018-08-22', '14:50:44'),
	(34, 1, 'Super Hotel', 'Sign In', '2018-08-22', '19:55:08'),
	(35, 1, 'Super Hotel', 'Sign In', '2018-08-23', '09:56:01'),
	(36, 1, 'Super Hotel', 'Sign In', '2018-08-23', '14:25:33'),
	(37, 1, 'Super Hotel', 'Sign In', '2018-08-24', '07:37:16'),
	(38, 1, 'Super Hotel', 'Sign In', '2018-08-24', '07:38:39'),
	(39, 1, 'Super Hotel', 'Sign In', '2018-08-24', '08:00:43'),
	(40, 1, 'Super Hotel', 'Sign Out', '2018-08-24', '10:17:47'),
	(41, 1, 'Super Hotel', 'Sign In', '2018-08-25', '19:06:16'),
	(42, 1, 'Super Hotel', 'Sign In', '2018-08-26', '16:41:12'),
	(43, 1, 'Super Hotel', 'Sign In', '2018-08-27', '05:51:21'),
	(44, 1, 'Super Hotel', 'Sign In', '2018-08-27', '08:09:20'),
	(45, 1, 'Super Hotel', 'Sign In', '2018-08-27', '18:36:53'),
	(46, 1, 'Super Hotel', 'Sign In', '2018-08-27', '18:54:24'),
	(47, 1, 'Super Hotel', 'Sign In', '2018-08-28', '08:45:28'),
	(48, 1, 'Super Hotel', 'Sign In', '2018-08-29', '08:39:47'),
	(49, 1, 'Super Hotel', 'Sign In', '2018-08-30', '08:37:55'),
	(50, 1, 'Super Hotel', 'Sign In', '2018-08-30', '11:36:13'),
	(51, 1, 'Super Hotel', 'Sign In', '2018-08-30', '12:17:48');
/*!40000 ALTER TABLE `hot_log` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_member
CREATE TABLE IF NOT EXISTS `hot_member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(128) NOT NULL,
  `member_gender` char(1) NOT NULL,
  `member_phone` varchar(128) NOT NULL,
  `member_address` varchar(255) NOT NULL,
  `member_id_type` tinyint(1) NOT NULL DEFAULT '1',
  `member_id_no` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_member: ~2 rows (approximately)
DELETE FROM `hot_member`;
/*!40000 ALTER TABLE `hot_member` DISABLE KEYS */;
INSERT INTO `hot_member` (`member_id`, `member_name`, `member_gender`, `member_phone`, `member_address`, `member_id_type`, `member_id_no`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Suparman', 'L', '', '', 1, '', '2018-08-21 11:04:16', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0),
	(2, 'AA123AA', 'P', '12345', '', 2, '12312312319826387125', '2018-08-21 12:12:22', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);
/*!40000 ALTER TABLE `hot_member` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_module
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

-- Dumping data for table prisma_pos.hot_module: ~22 rows (approximately)
DELETE FROM `hot_module`;
/*!40000 ALTER TABLE `hot_module` DISABLE KEYS */;
INSERT INTO `hot_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`, `module_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_actived`, `is_deleted`) VALUES
	('01', '', 'Dashboard', 'hot_dashboard', 'hot_dashboard', 'index', 'dashboard', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02', '', 'Master', '', '', '#', 'cubes', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.01', '02', 'Jenis Biaya', 'hot_charge_type', 'hot_charge_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.02', '02', 'Tipe Kamar', 'hot_room_type', 'hot_room_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.03', '02', 'Kamar', 'hot_room', 'hot_room', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.05', '02', 'Tamu', 'hot_guest', 'hot_guest', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.06', '02', 'Pelayanan', 'hot_service', 'hot_service', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.07', '02', 'Ekstra', 'hot_extra', 'hot_extra', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.08', '02', 'FnB', 'hot_fnb', 'hot_fnb', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('02.09', '02', 'Diskon', 'hot_discount', 'hot_discount', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('03', '', 'Reservasi', 'hot_reservation', 'hot_reservation', 'index', 'address-book-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('04', '', 'Laporan', '', '', '#', 'files-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('04.01', '04', 'Laporan Reservasi (semua)', 'hot_report_reservation', 'hot_report_reservation', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('04.02', '04', 'Laporan Reservasi  (resepsionis)', 'hot_report_receptionist', 'hot_report_receptionist', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('04.03', '04', 'Laporan Pembayaran', 'hot_report_payment', 'hot_report_payment', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('04.04', '04', 'Laporan Piutang', 'hot_report_credit', 'hot_report_credit', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('99.01', '99', 'Modul', 'hot_module', 'hot_module', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('99.02', '99', 'Role', 'hot_role', 'hot_role', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('99.03', '99', 'Pengguna', 'hot_user', 'hot_user', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('99.04', '99', 'Hak Akses', 'hot_permission', 'hot_permission', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
	('99.05', '99', 'Client', 'hot_client', 'hot_client', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
/*!40000 ALTER TABLE `hot_module` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_payment
CREATE TABLE IF NOT EXISTS `hot_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `subtotal` int(155) DEFAULT '0',
  `disc` int(155) DEFAULT '0',
  `grand_total` int(155) DEFAULT '0',
  `bayar` int(155) DEFAULT NULL,
  `sisa` int(155) DEFAULT NULL,
  `cashed` int(155) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `posting_st` tinyint(1) NOT NULL DEFAULT '0',
  `posting_date` datetime DEFAULT NULL,
  `status` int(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_payment: ~0 rows (approximately)
DELETE FROM `hot_payment`;
/*!40000 ALTER TABLE `hot_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `hot_payment` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_permission
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_permission: ~45 rows (approximately)
DELETE FROM `hot_permission`;
/*!40000 ALTER TABLE `hot_permission` DISABLE KEYS */;
INSERT INTO `hot_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created`, `created_by`) VALUES
	(1, 0, '01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(2, 0, '02', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(3, 0, '02.01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(4, 0, '02.02', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(5, 0, '02.03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(6, 0, '02.04', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(7, 0, '02.05', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(8, 0, '02.06', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(9, 0, '02.07', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(10, 0, '02.08', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(11, 0, '02.09', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(12, 0, '03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(13, 0, '04', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(14, 0, '04.01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(15, 0, '04.02', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(16, 0, '04.03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(17, 0, '04.04', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(18, 0, '99', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(19, 0, '99.01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(20, 0, '99.02', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(21, 0, '99.03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(22, 0, '99.04', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(23, 0, '99.05', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(24, 1, '01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(25, 1, '02', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(26, 1, '02.01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(27, 1, '02.02', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(28, 1, '02.03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(29, 1, '02.04', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(30, 1, '02.05', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(31, 1, '02.06', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(32, 1, '02.07', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(33, 1, '02.08', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(34, 1, '02.09', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(35, 1, '03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(36, 1, '04', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(37, 1, '04.01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(38, 1, '04.02', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(39, 1, '04.03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(40, 1, '04.04', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(41, 1, '99', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(42, 1, '99.03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(43, 1, '99.05', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(44, 3, '01', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System'),
	(45, 3, '03', 1, 1, 1, 1, '2018-08-20 05:33:20', 'System');
/*!40000 ALTER TABLE `hot_permission` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_role
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
CREATE TABLE IF NOT EXISTS `hot_room` (
  `room_id` varchar(50) NOT NULL,
  `room_name` varchar(50) NOT NULL DEFAULT '0',
  `room_type_id` int(11) NOT NULL DEFAULT '0',
  `room_no` varchar(10) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_room: ~10 rows (approximately)
DELETE FROM `hot_room`;
/*!40000 ALTER TABLE `hot_room` DISABLE KEYS */;
INSERT INTO `hot_room` (`room_id`, `room_name`, `room_type_id`, `room_no`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	('11', 'Melati - 01', 1, '1', '2018-08-21 15:27:11', 'Super Hotel', NULL, 'System', 1, 0),
	('110', 'Melati - 10', 1, '10', '2018-08-21 15:27:12', 'Super Hotel', NULL, 'System', 1, 0),
	('12', 'Melati - 02', 1, '2', '2018-08-21 15:27:11', 'Super Hotel', NULL, 'System', 1, 0),
	('13', 'Melati - 03', 1, '3', '2018-08-21 15:27:11', 'Super Hotel', NULL, 'System', 1, 0),
	('14', 'Melati - 04', 1, '4', '2018-08-21 15:27:12', 'Super Hotel', NULL, 'System', 1, 0),
	('15', 'Melati - 05', 1, '5', '2018-08-21 15:27:12', 'Super Hotel', NULL, 'System', 1, 0),
	('16', 'Melati - 06', 1, '6', '2018-08-21 15:27:12', 'Super Hotel', NULL, 'System', 1, 0),
	('17', 'Melati - 07', 1, '7', '2018-08-21 15:27:12', 'Super Hotel', NULL, 'System', 1, 0),
	('18', 'Melati - 08', 1, '8', '2018-08-21 15:27:12', 'Super Hotel', NULL, 'System', 1, 0),
	('19', 'Melati - 09', 1, '9', '2018-08-21 15:27:12', 'Super Hotel', NULL, 'System', 1, 0);
/*!40000 ALTER TABLE `hot_room` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_room_type
CREATE TABLE IF NOT EXISTS `hot_room_type` (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_name` varchar(128) NOT NULL,
  `room_type_charge` float(10,2) NOT NULL,
  `room_type_desc` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`room_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prisma_pos.hot_room_type: ~1 rows (approximately)
DELETE FROM `hot_room_type`;
/*!40000 ALTER TABLE `hot_room_type` DISABLE KEYS */;
INSERT INTO `hot_room_type` (`room_type_id`, `room_type_name`, `room_type_charge`, `room_type_desc`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'Melati', 100000.00, '', '2018-08-21 15:27:11', 'Super Hotel', NULL, '', 1, 0),
	(2, 'fasdfasd', 90909.09, '', '2018-08-25 20:31:26', 'System', NULL, '', 1, 0);
/*!40000 ALTER TABLE `hot_room_type` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_service
CREATE TABLE IF NOT EXISTS `hot_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(128) NOT NULL,
  `service_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_service: ~0 rows (approximately)
DELETE FROM `hot_service`;
/*!40000 ALTER TABLE `hot_service` DISABLE KEYS */;
INSERT INTO `hot_service` (`service_id`, `service_name`, `service_charge`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, 'handuk', 10000.00, '2018-08-20 15:16:18', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_service` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_tax
CREATE TABLE IF NOT EXISTS `hot_tax` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(15) NOT NULL,
  `tax_name` varchar(128) NOT NULL,
  `tax_ratio` float(10,2) NOT NULL COMMENT 'in percent',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_tax: ~0 rows (approximately)
DELETE FROM `hot_tax`;
/*!40000 ALTER TABLE `hot_tax` DISABLE KEYS */;
INSERT INTO `hot_tax` (`tax_id`, `tax_code`, `tax_name`, `tax_ratio`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(1, '1.1.1.01.05\r\n', 'Pajak Hotel', 10.00, '2018-07-05 09:49:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_tax` ENABLE KEYS */;

-- Dumping structure for table prisma_pos.hot_user
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
