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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
