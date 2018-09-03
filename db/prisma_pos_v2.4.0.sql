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

-- Dumping structure for table prisma_pos.app_install
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.app_type
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.app_version
CREATE TABLE IF NOT EXISTS `app_version` (
  `version_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_now` varchar(10) NOT NULL DEFAULT '0',
  `version_release` timestamp NULL DEFAULT NULL,
  `version_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`version_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.hot_fnb
CREATE TABLE IF NOT EXISTS `hot_fnb` (
  `fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fnb_name` varchar(128) NOT NULL,
  `fnb_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fnb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.hot_guest
CREATE TABLE IF NOT EXISTS `hot_guest` (
  `guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_type` tinyint(1) NOT NULL DEFAULT '0',
  `guest_name` varchar(128) NOT NULL,
  `guest_gender` char(1) NOT NULL,
  `guest_phone` varchar(128) NOT NULL,
  `guest_address` varchar(255) NOT NULL,
  `guest_id_type` tinyint(1) NOT NULL DEFAULT '1',
  `guest_id_no` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.hot_log
CREATE TABLE IF NOT EXISTS `hot_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.hot_member
CREATE TABLE IF NOT EXISTS `hot_member` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(128) NOT NULL,
  `member_phone` varchar(128) NOT NULL,
  `member_address` varchar(255) NOT NULL,
  `member_id_type` tinyint(1) NOT NULL DEFAULT '1',
  `member_id_no` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.hot_non_tax
CREATE TABLE IF NOT EXISTS `hot_non_tax` (
  `non_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `non_tax_name` varchar(128) NOT NULL,
  `non_tax_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`non_tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.hot_room
CREATE TABLE IF NOT EXISTS `hot_room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_id` int(11) NOT NULL DEFAULT '0',
  `room_name` varchar(50) NOT NULL DEFAULT '0',
  `room_no` varchar(10) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.hot_service
CREATE TABLE IF NOT EXISTS `hot_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(128) NOT NULL,
  `service_charge` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
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

-- Data exporting was unselected.
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_bank
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_billing
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
  `posting_st` tinyint(1) NOT NULL DEFAULT '0',
  `posting_date` datetime DEFAULT NULL,
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_billing_service_charge
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_client
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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT '1',
  `client_logo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_log
CREATE TABLE IF NOT EXISTS `kar_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_member
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_member_type
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_module
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_payment_type
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_permission
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_role
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_room
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_room_type
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_service_charge
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_shift
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_tax
CREATE TABLE IF NOT EXISTS `kar_tax` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_time
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.kar_user
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_billing
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
  `category_not_flat` tinyint(1) NOT NULL,
  `category_per_hour` float(10,2) NOT NULL,
  `billing_tnkb` varchar(128) NOT NULL,
  `billing_status_in` tinyint(1) NOT NULL,
  `billing_status_out` tinyint(1) NOT NULL,
  `billing_date_in` date NOT NULL,
  `billing_time_in` time NOT NULL,
  `billing_date_out` date NOT NULL,
  `billing_time_out` time NOT NULL,
  `billing_duration` int(11) NOT NULL,
  `billing_subtotal` float(10,2) NOT NULL,
  `billing_tax` float(10,2) NOT NULL,
  `billing_total_grand` float(10,2) NOT NULL,
  `billing_payment` float(10,2) NOT NULL,
  `billing_change` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `posting_st` tinyint(1) NOT NULL DEFAULT '0',
  `posting_date` datetime DEFAULT NULL,
  PRIMARY KEY (`billing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_brand
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_category
CREATE TABLE IF NOT EXISTS `par_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) NOT NULL,
  `category_not_flat` tinyint(1) NOT NULL DEFAULT '0',
  `category_rate` float(10,2) NOT NULL,
  `category_per_hour` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_client
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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT '1',
  `client_logo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_log
CREATE TABLE IF NOT EXISTS `par_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_module
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_permission
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_role
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_shift
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_tax
CREATE TABLE IF NOT EXISTS `par_tax` (
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.par_user
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_bank
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_billing
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
  `posting_st` tinyint(1) NOT NULL DEFAULT '0',
  `posting_date` datetime DEFAULT NULL,
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_billing_buyall
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_billing_buyget
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_billing_buyitem
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_billing_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_category
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_client
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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT '1',
  `client_logo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_customer
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_item
CREATE TABLE IF NOT EXISTS `res_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_barcode` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `item_price_before_tax` float(10,2) NOT NULL,
  `item_tax` float(10,2) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `is_package` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL DEFAULT 'System',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_item_package
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_location
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_log
CREATE TABLE IF NOT EXISTS `res_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_module
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_payment_type
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_permission
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_po
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_po_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_promo
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_promo_buyall
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_promo_buyget
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_promo_buyitem
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_promo_type
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_return
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_return_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_role
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_shift
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_stock
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_stock_in
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_stock_opname
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_stock_opname_detail
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_stock_out
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_supplier
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_tax
CREATE TABLE IF NOT EXISTS `res_tax` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(15) NOT NULL,
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_tx_type
CREATE TABLE IF NOT EXISTS `res_tx_type` (
  `tx_type` varchar(3) NOT NULL,
  `tx_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`tx_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_unit
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_user
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_void
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.res_void_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_bank
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_billing
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
  `posting_st` tinyint(1) NOT NULL DEFAULT '0',
  `posting_date` datetime DEFAULT NULL,
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_billing_buyall
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_billing_buyget
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_billing_buyitem
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_billing_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_category
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_client
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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT '1',
  `client_logo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(32) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_customer
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_item
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_item_package
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_log
CREATE TABLE IF NOT EXISTS `ret_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) NOT NULL,
  `log_type` enum('Sign In','Sign Out') NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_module
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_payment_type
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_permission
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_po
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_po_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_promo
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_promo_buyall
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_promo_buyget
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_promo_buyitem
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_promo_type
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_return
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_return_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_role
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_shift
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_stock
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_stock_in
CREATE TABLE IF NOT EXISTS `ret_stock_in` (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) NOT NULL DEFAULT '0',
  `tx_type` varchar(3) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_stock_opname
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_stock_opname_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_stock_out
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_supplier
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_tax
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_tx_type
CREATE TABLE IF NOT EXISTS `ret_tx_type` (
  `tx_type` varchar(3) NOT NULL,
  `tx_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`tx_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_unit
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_user
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

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_void
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table prisma_pos.ret_void_detail
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
