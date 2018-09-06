/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100125
 Source Host           : localhost:3306
 Source Schema         : prisma_pos

 Target Server Type    : MySQL
 Target Server Version : 100125
 File Encoding         : 65001

 Date: 06/09/2018 10:51:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kar_billing
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing`;
CREATE TABLE `kar_billing`  (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_receipt_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_type` tinyint(1) NOT NULL DEFAULT 0,
  `guest_id` int(11) NOT NULL,
  `guest_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_gender` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_phone` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_id_type` tinyint(1) NOT NULL,
  `guest_id_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `billing_date_in` date NOT NULL,
  `billing_time_in` time(0) NOT NULL,
  `billing_date_out` date NOT NULL,
  `billing_time_out` time(0) NOT NULL,
  `billing_num_day` int(11) NOT NULL,
  `billing_subtotal` float(10, 2) NOT NULL,
  `billing_tax` float(10, 2) NOT NULL,
  `billing_service` float(10, 2) NOT NULL,
  `billing_other` float(10, 2) NOT NULL,
  `billing_total` float(10, 2) NOT NULL,
  `billing_payment_type` tinyint(1) NOT NULL,
  `billing_down_payment` float(10, 2) NOT NULL,
  `billing_payment` float(10, 2) NOT NULL,
  `billing_change` float(10, 2) NOT NULL,
  `billing_cancel_note` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `billing_status` tinyint(1) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_billing
-- ----------------------------
INSERT INTO `kar_billing` VALUES (1, '180906000001', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-09-06 10:40:57', 'System', '0000-00-00 00:00:00', '', 1, 0);

-- ----------------------------
-- Table structure for kar_billing_extra
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing_extra`;
CREATE TABLE `kar_billing_extra`  (
  `billing_extra_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT 0,
  `extra_id` int(11) NOT NULL,
  `extra_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `extra_charge` float(10, 2) NOT NULL,
  `extra_amount` float(10, 2) NOT NULL,
  `extra_subtotal` float(10, 2) NOT NULL,
  `extra_tax` float(10, 2) NOT NULL,
  `extra_total` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_extra_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_billing_fnb
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing_fnb`;
CREATE TABLE `kar_billing_fnb`  (
  `billing_fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT 0,
  `fnb_id` int(11) NOT NULL,
  `fnb_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fnb_charge` float(10, 2) NOT NULL,
  `fnb_amount` float(10, 2) NOT NULL,
  `fnb_subtotal` float(10, 2) NOT NULL,
  `fnb_tax` float(10, 2) NOT NULL,
  `fnb_total` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_fnb_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_billing_non_tax
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing_non_tax`;
CREATE TABLE `kar_billing_non_tax`  (
  `billing_non_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT 0,
  `non_tax_id` int(11) NOT NULL,
  `non_tax_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `non_tax_charge` float(10, 2) NOT NULL,
  `non_tax_amount` float(10, 2) NOT NULL,
  `non_tax_total` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_non_tax_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_billing_room
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing_room`;
CREATE TABLE `kar_billing_room`  (
  `billing_room_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT 0,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_type_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_type_charge` float(10, 2) NOT NULL,
  `room_type_duration` float(10, 2) NOT NULL,
  `room_type_subtotal` float(10, 2) NOT NULL,
  `room_type_tax` float(10, 2) NOT NULL,
  `room_type_service` float(10, 2) NOT NULL,
  `room_type_other` float(10, 2) NOT NULL,
  `room_type_total` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_room_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_billing_service
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing_service`;
CREATE TABLE `kar_billing_service`  (
  `billing_service_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT 0,
  `service_id` int(11) NOT NULL,
  `service_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `service_charge` float(10, 2) NOT NULL,
  `service_amount` float(10, 2) NOT NULL,
  `service_subtotal` float(10, 2) NOT NULL,
  `service_tax` float(10, 2) NOT NULL,
  `service_total` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_service_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_booking
-- ----------------------------
DROP TABLE IF EXISTS `kar_booking`;
CREATE TABLE `kar_booking`  (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_id` int(155) NOT NULL,
  `service_id` int(155) NULL DEFAULT NULL,
  `number_of_days` int(155) NOT NULL,
  `room_id` int(155) NOT NULL,
  `date_booking` date NOT NULL,
  `date_booking_from` date NOT NULL,
  `date_booking_to` date NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `opsi_hari` int(155) NULL DEFAULT 0,
  PRIMARY KEY (`booking_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_booking_diskon
-- ----------------------------
DROP TABLE IF EXISTS `kar_booking_diskon`;
CREATE TABLE `kar_booking_diskon`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `diskon_id` int(155) NOT NULL,
  `price` int(155) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_booking_room
-- ----------------------------
DROP TABLE IF EXISTS `kar_booking_room`;
CREATE TABLE `kar_booking_room`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `room_id` int(155) NOT NULL,
  `price` int(155) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_booking_service
-- ----------------------------
DROP TABLE IF EXISTS `kar_booking_service`;
CREATE TABLE `kar_booking_service`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `service_id` int(155) NOT NULL,
  `price` int(155) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_category
-- ----------------------------
DROP TABLE IF EXISTS `kar_category`;
CREATE TABLE `kar_category`  (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `category_price` int(155) NULL DEFAULT NULL,
  `category_desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` int(155) NULL DEFAULT NULL,
  `before_tax` int(155) NULL DEFAULT NULL,
  `tax` int(155) NULL DEFAULT NULL,
  `after_tax` int(155) NULL DEFAULT NULL,
  `service_hotel` int(155) NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_charge_type
-- ----------------------------
DROP TABLE IF EXISTS `kar_charge_type`;
CREATE TABLE `kar_charge_type`  (
  `charge_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_type_code` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `charge_type_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `charge_type_ratio` float(10, 2) NOT NULL DEFAULT 0.00,
  `charge_type_desc` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`charge_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_charge_type
-- ----------------------------
INSERT INTO `kar_charge_type` VALUES (1, '1.1.1.01.05', 'Pajak Karaoke', 15.00, 'Pajak Daerah', '2018-09-03 07:51:25', 'System', '2018-09-06 10:27:03', 'System', 1, 0);
INSERT INTO `kar_charge_type` VALUES (2, 'SRV', 'Servis Karaoke', 10.00, 'Biaya Servis', '2018-09-03 07:51:25', 'System', '2018-09-06 10:28:34', 'Super Hotel', 0, 0);
INSERT INTO `kar_charge_type` VALUES (3, 'OTH', 'Biaya Lain-lain', 1.00, 'Biaya Lain-lain', '2018-09-03 07:51:35', 'System', '2018-09-04 15:57:42', 'Super Hotel', 0, 0);

-- ----------------------------
-- Table structure for kar_client
-- ----------------------------
DROP TABLE IF EXISTS `kar_client`;
CREATE TABLE `kar_client`  (
  `client_id` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_brand` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_status` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_street` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_subdistrict` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_district` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_city` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_province` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_email` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_phone_1` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_phone_2` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_npwp` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_npwpd` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_owner_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_owner_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_serial_number` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_keyboard_status` tinyint(1) NOT NULL DEFAULT 1,
  `client_logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_is_taxed` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`client_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_client
-- ----------------------------
INSERT INTO `kar_client` VALUES ('1', 'CV Prisma Karaoke', 'Prisma Hotel', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 1, 'update-hotel-griya-persada3.png', 1, '2018-05-08 10:26:03', 'System', '2018-09-06 10:17:23', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for kar_discount
-- ----------------------------
DROP TABLE IF EXISTS `kar_discount`;
CREATE TABLE `kar_discount`  (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT 1,
  `discount_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`discount_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_discount
-- ----------------------------
INSERT INTO `kar_discount` VALUES (1, 'Diskon Akhir Tahun', 1, 10.00, '2018-09-03 08:18:31', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_discount` VALUES (2, 'Testing', 2, 50000.00, '2018-09-05 08:38:35', 'Super Hotel', '2018-09-05 08:38:49', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for kar_diskon
-- ----------------------------
DROP TABLE IF EXISTS `kar_diskon`;
CREATE TABLE `kar_diskon`  (
  `diskon_id` int(11) NOT NULL AUTO_INCREMENT,
  `diskon_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `diskon_price` int(155) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `nominal` int(155) NULL DEFAULT NULL,
  PRIMARY KEY (`diskon_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_extra
-- ----------------------------
DROP TABLE IF EXISTS `kar_extra`;
CREATE TABLE `kar_extra`  (
  `extra_id` int(11) NOT NULL AUTO_INCREMENT,
  `extra_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `extra_charge` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`extra_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_extra
-- ----------------------------
INSERT INTO `kar_extra` VALUES (1, 'Selimut', 5000.00, '2018-09-03 08:18:08', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_extra` VALUES (2, 'Testing', 45454.55, '2018-09-05 08:37:34', 'Super Hotel', '2018-09-05 08:37:52', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for kar_fnb
-- ----------------------------
DROP TABLE IF EXISTS `kar_fnb`;
CREATE TABLE `kar_fnb`  (
  `fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fnb_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fnb_charge` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fnb_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_fnb
-- ----------------------------
INSERT INTO `kar_fnb` VALUES (1, 'Ayam Geprek', 12000.00, '2018-09-03 08:18:24', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_fnb` VALUES (2, 'Testing', 45454.55, '2018-09-05 08:38:07', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for kar_guest
-- ----------------------------
DROP TABLE IF EXISTS `kar_guest`;
CREATE TABLE `kar_guest`  (
  `guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_type` tinyint(1) NOT NULL DEFAULT 0,
  `guest_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_gender` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_phone` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `guest_id_type` tinyint(1) NOT NULL DEFAULT 1,
  `guest_id_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`guest_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_guest
-- ----------------------------
INSERT INTO `kar_guest` VALUES (1, 0, 'Joko Susilo', 'L', '', '', 1, '', '2018-09-04 11:51:28', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_guest` VALUES (2, 1, 'Joko Samino', 'L', '', '', 1, '', '2018-09-04 11:51:55', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for kar_log
-- ----------------------------
DROP TABLE IF EXISTS `kar_log`;
CREATE TABLE `kar_log`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_type` enum('Sign In','Sign Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time(0) NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_log
-- ----------------------------
INSERT INTO `kar_log` VALUES (1, 1, 'Super Hotel', 'Sign In', '2018-09-03', '08:00:23');
INSERT INTO `kar_log` VALUES (2, 1, 'Super Hotel', 'Sign Out', '2018-09-03', '08:16:55');
INSERT INTO `kar_log` VALUES (3, 1, 'Super Hotel', 'Sign In', '2018-09-03', '08:17:03');
INSERT INTO `kar_log` VALUES (4, 1, 'Super Hotel', 'Sign In', '2018-09-03', '08:19:06');
INSERT INTO `kar_log` VALUES (5, 1, 'Super Hotel', 'Sign In', '2018-09-03', '09:31:04');
INSERT INTO `kar_log` VALUES (6, 1, 'Super Hotel', 'Sign In', '2018-09-03', '13:30:55');
INSERT INTO `kar_log` VALUES (7, 1, 'Super Hotel', 'Sign In', '2018-09-03', '16:02:10');
INSERT INTO `kar_log` VALUES (8, 1, 'Super Hotel', 'Sign Out', '2018-09-03', '16:26:59');
INSERT INTO `kar_log` VALUES (9, 3, 'Cashier Hotel', 'Sign In', '2018-09-03', '16:27:29');
INSERT INTO `kar_log` VALUES (10, 1, 'Super Hotel', 'Sign In', '2018-09-03', '18:55:42');
INSERT INTO `kar_log` VALUES (11, 1, 'Super Hotel', 'Sign Out', '2018-09-03', '18:55:47');
INSERT INTO `kar_log` VALUES (12, 1, 'Super Hotel', 'Sign In', '2018-09-03', '18:56:00');
INSERT INTO `kar_log` VALUES (13, 1, 'Super Hotel', 'Sign In', '2018-09-05', '05:18:13');
INSERT INTO `kar_log` VALUES (14, 1, 'Super Hotel', 'Sign In', '2018-09-05', '05:21:25');
INSERT INTO `kar_log` VALUES (15, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:18:03');
INSERT INTO `kar_log` VALUES (16, 1, 'Super Hotel', 'Sign Out', '2018-09-05', '07:23:16');
INSERT INTO `kar_log` VALUES (17, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:23:23');
INSERT INTO `kar_log` VALUES (18, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:23:41');
INSERT INTO `kar_log` VALUES (19, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:37:53');
INSERT INTO `kar_log` VALUES (20, 1, 'Super Hotel', 'Sign In', '2018-09-05', '08:55:48');
INSERT INTO `kar_log` VALUES (21, 1, 'Super Hotel', 'Sign Out', '2018-09-05', '14:13:41');
INSERT INTO `kar_log` VALUES (22, 1, 'Super Hotel', 'Sign In', '2018-09-05', '22:39:51');
INSERT INTO `kar_log` VALUES (23, 1, 'Super Karaoke', 'Sign In', '2018-09-06', '10:08:10');
INSERT INTO `kar_log` VALUES (24, 1, 'Super Karaoke', 'Sign In', '2018-09-06', '10:09:47');
INSERT INTO `kar_log` VALUES (25, 1, 'Super Karaoke', 'Sign In', '2018-09-06', '10:10:25');
INSERT INTO `kar_log` VALUES (26, 1, 'Super Karaoke', 'Sign In', '2018-09-06', '10:11:07');
INSERT INTO `kar_log` VALUES (27, 1, 'Super Karaoke', 'Sign In', '2018-09-06', '10:12:28');
INSERT INTO `kar_log` VALUES (28, 1, 'Super Karaoke', 'Sign In', '2018-09-06', '10:13:16');

-- ----------------------------
-- Table structure for kar_member
-- ----------------------------
DROP TABLE IF EXISTS `kar_member`;
CREATE TABLE `kar_member`  (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_phone` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_id_type` tinyint(1) NOT NULL DEFAULT 1,
  `member_id_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`member_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_module
-- ----------------------------
DROP TABLE IF EXISTS `kar_module`;
CREATE TABLE `kar_module`  (
  `module_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `module_parent` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `module_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `module_folder` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `module_controller` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `module_url` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `module_icon` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_actived` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`module_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_module
-- ----------------------------
INSERT INTO `kar_module` VALUES ('01', '', 'Dashboard', 'kar_dashboard', 'kar_dashboard', 'index', 'dashboard', '2018-08-18 05:51:24', '', '2018-09-06 10:13:07', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02', '', 'Master', '', '', '#', 'cubes', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.01', '02', 'Jenis Biaya', 'kar_charge_type', 'kar_charge_type', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:22:02', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.02', '02', 'Tipe Room', 'kar_room_type', 'kar_room_type', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:50:32', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.03', '02', 'Room', 'kar_room', 'kar_room', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:50:29', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.05', '02', 'Tamu', 'kar_guest', 'kar_guest', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:22:22', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.06', '02', 'Pelayanan', 'kar_service', 'kar_service', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:22:28', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.07', '02', 'Ekstra', 'kar_extra', 'kar_extra', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:22:33', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.08', '02', 'FnB', 'kar_fnb', 'kar_fnb', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:22:39', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.09', '02', 'Diskon', 'kar_discount', 'kar_discount', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:22:46', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.10', '02', 'Non Pajak', 'kar_non_tax', 'kar_non_tax', 'index', '', '2018-09-03 07:51:35', 'System', '2018-09-06 10:22:51', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('03', '', 'Reservasi', 'kar_reservation', 'kar_reservation', 'index', 'address-book-o', '2018-08-18 05:51:24', '', '2018-09-06 10:22:57', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04', '', 'Laporan', '', '', '#', 'files-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.01', '04', 'Laporan Reservasi (semua)', 'kar_report_reservation', 'kar_report_reservation', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:02', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.02', '04', 'Laporan Reservasi  (resepsionis)', 'kar_report_receptionist', 'kar_report_receptionist', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:07', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.03', '04', 'Laporan Pembayaran', 'kar_report_payment', 'kar_report_payment', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:14', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.04', '04', 'Laporan Piutang', 'kar_report_credit', 'kar_report_credit', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:20', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.01', '99', 'Modul', 'kar_module', 'kar_module', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:25', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.02', '99', 'Role', 'kar_role', 'kar_role', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:32', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.03', '99', 'Pengguna', 'kar_user', 'kar_user', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:37', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.04', '99', 'Hak Akses', 'kar_permission', 'kar_permission', 'index', '', '2018-08-18 05:51:24', '', '2018-09-06 10:23:43', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.05', '99', 'Client', 'hot_client', 'hot_client', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);

-- ----------------------------
-- Table structure for kar_non_tax
-- ----------------------------
DROP TABLE IF EXISTS `kar_non_tax`;
CREATE TABLE `kar_non_tax`  (
  `non_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `non_tax_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `non_tax_charge` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`non_tax_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_non_tax
-- ----------------------------
INSERT INTO `kar_non_tax` VALUES (1, 'LC', 80000.00, '2018-09-05 05:45:50', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_non_tax` VALUES (2, 'Testing', 50000.00, '2018-09-05 08:38:57', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for kar_payment
-- ----------------------------
DROP TABLE IF EXISTS `kar_payment`;
CREATE TABLE `kar_payment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(155) NOT NULL,
  `subtotal` int(155) NULL DEFAULT 0,
  `disc` int(155) NULL DEFAULT 0,
  `grand_total` int(155) NULL DEFAULT 0,
  `bayar` int(155) NULL DEFAULT NULL,
  `sisa` int(155) NULL DEFAULT NULL,
  `cashed` int(155) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `posting_st` tinyint(1) NOT NULL DEFAULT 0,
  `posting_date` datetime(0) NULL DEFAULT NULL,
  `status` int(155) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_permission
-- ----------------------------
DROP TABLE IF EXISTS `kar_permission`;
CREATE TABLE `kar_permission`  (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `_create` int(1) NULL DEFAULT NULL,
  `_read` int(1) NULL DEFAULT NULL,
  `_update` int(1) NULL DEFAULT NULL,
  `_delete` int(1) NULL DEFAULT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`permission_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_permission
-- ----------------------------
INSERT INTO `kar_permission` VALUES (1, 0, '01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (2, 0, '02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (3, 0, '02.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (4, 0, '02.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (5, 0, '02.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (6, 0, '02.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (7, 0, '02.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (8, 0, '02.06', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (9, 0, '02.07', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (10, 0, '02.08', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (11, 0, '02.09', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (12, 0, '03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (13, 0, '04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (14, 0, '04.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (15, 0, '04.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (16, 0, '04.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (17, 0, '04.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (18, 0, '99', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (19, 0, '99.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (20, 0, '99.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (21, 0, '99.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (22, 0, '99.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (23, 0, '99.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (24, 1, '01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (25, 1, '02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (26, 1, '02.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (27, 1, '02.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (28, 1, '02.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (29, 1, '02.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (30, 1, '02.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (31, 1, '02.06', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (32, 1, '02.07', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (33, 1, '02.08', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (34, 1, '02.09', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (35, 1, '03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (36, 1, '04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (37, 1, '04.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (38, 1, '04.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (39, 1, '04.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (40, 1, '04.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (41, 1, '99', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (42, 1, '99.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (43, 1, '99.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `kar_permission` VALUES (47, 1, '02.10', 1, 1, 1, 1, '2018-09-03 07:51:35', 'System');
INSERT INTO `kar_permission` VALUES (48, 3, '01', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (49, 3, '02', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (50, 3, '02.01', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (51, 3, '03', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');

-- ----------------------------
-- Table structure for kar_role
-- ----------------------------
DROP TABLE IF EXISTS `kar_role`;
CREATE TABLE `kar_role`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_role
-- ----------------------------
INSERT INTO `kar_role` VALUES (0, 'Super Administrator Karaoke', '2018-03-30 11:16:36', 'Super Administrator', '2018-09-06 10:10:16', 'Super Administrator', 1, 0);
INSERT INTO `kar_role` VALUES (1, 'Administrator Karaoke', '2018-03-30 11:18:19', 'Super Karaoke', '2018-09-06 10:09:13', 'Super Karaoke', 1, 0);
INSERT INTO `kar_role` VALUES (3, 'Cashier Karaoke', '2018-05-08 13:42:21', 'Admin Karaoke', '2018-09-06 10:09:28', 'Super Karaoke', 1, 0);

-- ----------------------------
-- Table structure for kar_room
-- ----------------------------
DROP TABLE IF EXISTS `kar_room`;
CREATE TABLE `kar_room`  (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_id` int(11) NOT NULL DEFAULT 0,
  `room_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `room_no` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`room_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_room_type
-- ----------------------------
DROP TABLE IF EXISTS `kar_room_type`;
CREATE TABLE `kar_room_type`  (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_type_charge` float(10, 2) NOT NULL,
  `room_type_desc` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`room_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_service
-- ----------------------------
DROP TABLE IF EXISTS `kar_service`;
CREATE TABLE `kar_service`  (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `service_charge` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`service_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_service
-- ----------------------------
INSERT INTO `kar_service` VALUES (1, 'Sarapan Pagi', 18181.82, '2018-09-03 08:18:41', 'Super Hotel', '2018-09-04 15:35:17', 'Super Hotel', 1, 0);
INSERT INTO `kar_service` VALUES (2, 'Test', 45454.55, '2018-09-04 16:47:35', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_service` VALUES (3, 'Pelayanan Murah', 45454.55, '2018-09-04 17:32:35', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_service` VALUES (4, 'Testing', 45454.55, '2018-09-05 08:37:02', 'Super Hotel', '2018-09-05 08:37:20', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for kar_tax
-- ----------------------------
DROP TABLE IF EXISTS `kar_tax`;
CREATE TABLE `kar_tax`  (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tax_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tax_ratio` float(10, 2) NOT NULL COMMENT 'in percent',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tax_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_tax
-- ----------------------------
INSERT INTO `kar_tax` VALUES (1, '1.1.1.01.05\r\n', 'Pajak Hotel', 10.00, '2018-07-05 09:49:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for kar_user
-- ----------------------------
DROP TABLE IF EXISTS `kar_user`;
CREATE TABLE `kar_user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_password` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_user
-- ----------------------------
INSERT INTO `kar_user` VALUES (1, 'superkaraoke', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Karaoke', '2018-04-04 10:45:37', 'System', '2018-09-06 08:31:28', 'System', 1, 0);
INSERT INTO `kar_user` VALUES (2, 'adminkaraoke', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Karaoke', '2018-05-08 13:40:40', 'System', '2018-09-06 08:31:43', 'System', 1, 0);
INSERT INTO `kar_user` VALUES (3, 'cashierkaraoke', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Karaoke', '2018-05-08 13:43:54', 'System', '2018-09-06 08:31:39', 'System', 1, 0);

SET FOREIGN_KEY_CHECKS = 1;
