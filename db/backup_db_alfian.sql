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

 Date: 30/08/2018 15:24:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for app_install
-- ----------------------------
DROP TABLE IF EXISTS `app_install`;
CREATE TABLE `app_install`  (
  `install_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(1) NOT NULL DEFAULT 0,
  `install_status` tinyint(1) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`install_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of app_install
-- ----------------------------
INSERT INTO `app_install` VALUES (1, 3, 1, '2018-04-18 12:14:03', 'System', '2018-08-28 08:43:07', 'System', 1, 0);

-- ----------------------------
-- Table structure for app_type
-- ----------------------------
DROP TABLE IF EXISTS `app_type`;
CREATE TABLE `app_type`  (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type_icon` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of app_type
-- ----------------------------
INSERT INTO `app_type` VALUES (1, 'Prisma Retail', 'shopping-cart', '2018-04-18 12:15:09', 'System', '2018-04-18 12:25:11', 'System', 1, 0);
INSERT INTO `app_type` VALUES (2, 'Prisma Restaurant', 'cutlery', '2018-04-18 12:15:36', 'System', '2018-04-18 12:20:19', 'System', 1, 0);
INSERT INTO `app_type` VALUES (3, 'Prisma Hotel', 'hotel', '2018-04-18 12:15:36', 'System', '2018-04-18 12:24:27', 'System', 1, 0);
INSERT INTO `app_type` VALUES (4, 'Prisma Karaoke', 'microphone', '2018-04-18 12:16:07', 'System', '2018-04-18 12:25:06', 'System', 1, 0);
INSERT INTO `app_type` VALUES (5, 'Prisma Parking', 'car', '2018-05-17 11:33:54', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for app_version
-- ----------------------------
DROP TABLE IF EXISTS `app_version`;
CREATE TABLE `app_version`  (
  `version_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_now` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `version_release` timestamp(0) NULL DEFAULT NULL,
  `version_updated` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`version_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of app_version
-- ----------------------------
INSERT INTO `app_version` VALUES (1, '1.0', '2018-07-05 18:00:00', '2018-08-13 09:02:01');
INSERT INTO `app_version` VALUES (2, '1.1', '2018-07-09 14:16:00', '2018-08-13 09:02:02');
INSERT INTO `app_version` VALUES (3, '1.2', '2018-07-16 11:20:00', '2018-08-13 09:02:03');
INSERT INTO `app_version` VALUES (4, '1.3', '2018-07-17 10:00:00', '2018-08-13 09:02:03');
INSERT INTO `app_version` VALUES (5, '1.4', '2018-07-17 10:41:00', '2018-08-13 09:02:06');
INSERT INTO `app_version` VALUES (6, '1.5', '2018-07-18 11:52:00', '2018-08-13 09:02:10');
INSERT INTO `app_version` VALUES (7, '1.6', '2018-07-22 19:47:00', '2018-08-13 09:02:14');
INSERT INTO `app_version` VALUES (8, '1.7', '2018-08-07 10:46:00', '2018-08-13 09:02:16');
INSERT INTO `app_version` VALUES (9, '1.8', '2018-08-07 12:12:00', '2018-08-13 09:02:16');
INSERT INTO `app_version` VALUES (10, '1.9', '2018-08-07 14:12:00', '2018-08-13 09:02:19');
INSERT INTO `app_version` VALUES (11, '2.0', '2018-08-08 11:15:00', '2018-08-13 09:02:22');
INSERT INTO `app_version` VALUES (12, '2.1', '2018-08-13 12:12:00', '2018-08-13 20:46:02');
INSERT INTO `app_version` VALUES (13, '2.2.1', '2018-08-18 09:00:00', '2018-08-20 10:45:08');
INSERT INTO `app_version` VALUES (14, '2.2.2', '2018-08-20 09:00:00', '2018-08-20 10:45:08');
INSERT INTO `app_version` VALUES (15, '2.2.3', '2018-08-21 09:40:00', '2018-08-20 10:45:10');
INSERT INTO `app_version` VALUES (16, '2.2.4', '2018-08-21 10:20:00', '2018-08-20 10:45:11');
INSERT INTO `app_version` VALUES (17, '2.2.5', '2018-08-21 10:20:00', '2018-08-20 15:10:10');
INSERT INTO `app_version` VALUES (18, '2.2.6', '2018-08-21 14:45:00', '2018-08-21 08:24:30');
INSERT INTO `app_version` VALUES (19, '2.2.7', '2018-08-21 14:56:00', '2018-08-21 08:24:30');
INSERT INTO `app_version` VALUES (20, '2.2.8', '2018-08-21 14:56:00', '2018-08-21 08:24:31');
INSERT INTO `app_version` VALUES (21, '2.2.9', '2018-08-21 15:13:00', '2018-08-21 08:24:31');
INSERT INTO `app_version` VALUES (22, '2.3.0', '2018-08-21 15:20:00', '2018-08-21 08:24:32');
INSERT INTO `app_version` VALUES (23, '2.3.1', '2018-08-22 08:30:00', '2018-08-21 14:44:04');

-- ----------------------------
-- Table structure for hot_billing
-- ----------------------------
DROP TABLE IF EXISTS `hot_billing`;
CREATE TABLE `hot_billing`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_billing
-- ----------------------------
INSERT INTO `hot_billing` VALUES (4, '180830000001', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-08-30 15:23:23', 'System', '0000-00-00 00:00:00', '', 1, 0);

-- ----------------------------
-- Table structure for hot_billing_extra
-- ----------------------------
DROP TABLE IF EXISTS `hot_billing_extra`;
CREATE TABLE `hot_billing_extra`  (
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
-- Table structure for hot_billing_fnb
-- ----------------------------
DROP TABLE IF EXISTS `hot_billing_fnb`;
CREATE TABLE `hot_billing_fnb`  (
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
-- Table structure for hot_billing_room
-- ----------------------------
DROP TABLE IF EXISTS `hot_billing_room`;
CREATE TABLE `hot_billing_room`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_billing_room
-- ----------------------------
INSERT INTO `hot_billing_room` VALUES (3, 1, 802, 'Gold - 02', 8, 'Gold', 83333.33, 2.00, 166666.67, 16666.67, 16666.67, 0.00, 200000.00, '2018-08-30 15:23:32', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for hot_billing_service
-- ----------------------------
DROP TABLE IF EXISTS `hot_billing_service`;
CREATE TABLE `hot_billing_service`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hot_booking
-- ----------------------------
DROP TABLE IF EXISTS `hot_booking`;
CREATE TABLE `hot_booking`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_booking
-- ----------------------------
INSERT INTO `hot_booking` VALUES (1, '2102', 1, 1, 2, 1, '2018-08-13', '2018-08-13', '2018-08-15', '2018-08-13 10:07:40', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0);
INSERT INTO `hot_booking` VALUES (2, '2116', 1, 0, 2, 1, '2018-08-13', '2018-08-13', '2018-08-15', '2018-08-13 20:47:23', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0);
INSERT INTO `hot_booking` VALUES (3, '2047', 3, 1, 3, 1, '2018-08-14', '2018-08-14', '2018-08-17', '2018-08-14 10:00:59', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0, 0);
INSERT INTO `hot_booking` VALUES (4, '2081', 1, 1, 2, 1, '2018-08-14', '2018-08-14', '2018-08-16', '2018-08-14 10:05:15', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0, 0);
INSERT INTO `hot_booking` VALUES (5, '2108', 3, 0, 3, 4, '2018-08-15', '2018-08-15', '2018-08-18', '2018-08-15 10:11:57', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0, 0);
INSERT INTO `hot_booking` VALUES (6, '2154', 5, 0, 2, 3, '2018-08-15', '2018-08-15', '2018-08-17', '2018-08-15 10:21:59', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0);
INSERT INTO `hot_booking` VALUES (7, '2077', 7, 0, 1, 4, '2018-08-15', '2018-08-15', '2018-08-16', '2018-08-15 10:36:22', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0);

-- ----------------------------
-- Table structure for hot_booking_diskon
-- ----------------------------
DROP TABLE IF EXISTS `hot_booking_diskon`;
CREATE TABLE `hot_booking_diskon`  (
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
-- Table structure for hot_booking_room
-- ----------------------------
DROP TABLE IF EXISTS `hot_booking_room`;
CREATE TABLE `hot_booking_room`  (
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
-- Table structure for hot_booking_service
-- ----------------------------
DROP TABLE IF EXISTS `hot_booking_service`;
CREATE TABLE `hot_booking_service`  (
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
-- Table structure for hot_category
-- ----------------------------
DROP TABLE IF EXISTS `hot_category`;
CREATE TABLE `hot_category`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_category
-- ----------------------------
INSERT INTO `hot_category` VALUES (1, 'Deluxe Room', '2018-08-13 09:49:36', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0, '', 1, 27273, 2727, 30000, NULL);
INSERT INTO `hot_category` VALUES (2, 'Standard Hotel', '2018-08-13 20:49:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 1, 0, '', 1, 25000, 2500, 30000, 2500);
INSERT INTO `hot_category` VALUES (3, 'Standar Room', '2018-08-14 09:54:37', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0, '', 0, 30000, 3000, 36000, 3000);
INSERT INTO `hot_category` VALUES (4, 'tipe 1', '2018-08-15 10:23:39', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0, '', 0, 30000, 3000, 36000, 3000);
INSERT INTO `hot_category` VALUES (5, 'test', '2018-08-15 13:50:24', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0, 0, '', 1, 25000, 2500, 30000, 2500);

-- ----------------------------
-- Table structure for hot_charge_type
-- ----------------------------
DROP TABLE IF EXISTS `hot_charge_type`;
CREATE TABLE `hot_charge_type`  (
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
-- Records of hot_charge_type
-- ----------------------------
INSERT INTO `hot_charge_type` VALUES (1, '1.1.1.01.05', 'Pajak Hotel', 10.00, 'Pajak Daerah', '2018-08-20 10:45:11', 'System', NULL, 'System', 1, 0);
INSERT INTO `hot_charge_type` VALUES (2, 'SRV', 'Servis Hotel', 10.00, 'Biaya Servis', '2018-08-20 10:45:11', 'System', '2018-08-27 09:29:21', 'Super Karaoke', 1, 0);
INSERT INTO `hot_charge_type` VALUES (3, 'BLL', 'Biaya Lain-Lain', 1.00, 'Biaya Lain-Lain', '2018-08-29 07:05:50', 'System', '2018-08-29 15:34:25', 'Super Hotel', 0, 0);

-- ----------------------------
-- Table structure for hot_client
-- ----------------------------
DROP TABLE IF EXISTS `hot_client`;
CREATE TABLE `hot_client`  (
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
-- Records of hot_client
-- ----------------------------
INSERT INTO `hot_client` VALUES ('1', 'CV Prisma Hotel', 'Prisma Hotel', 'sendiri', 'Jalan Gajahmada 57', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 1, 'update-hotel-griya-persada1.png', 1, '2018-05-08 10:26:03', 'System', '2018-08-29 15:17:57', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for hot_discount
-- ----------------------------
DROP TABLE IF EXISTS `hot_discount`;
CREATE TABLE `hot_discount`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hot_extra
-- ----------------------------
DROP TABLE IF EXISTS `hot_extra`;
CREATE TABLE `hot_extra`  (
  `extra_id` int(11) NOT NULL,
  `extra_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `extra_charge` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`extra_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hot_fnb
-- ----------------------------
DROP TABLE IF EXISTS `hot_fnb`;
CREATE TABLE `hot_fnb`  (
  `fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fnb_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fnb_charge` float(10, 2) NULL DEFAULT NULL,
  `created` timestamp(0) NULL DEFAULT NULL,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `is_active` tinyint(1) NULL DEFAULT 1,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`fnb_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_fnb
-- ----------------------------
INSERT INTO `hot_fnb` VALUES (1, 'Ayam Goreng1', 100000.00, NULL, 'Super Hotel', '2018-08-20 13:05:16', 'Super Hotel', 1, 1);
INSERT INTO `hot_fnb` VALUES (2, 'Ayam Geprek', 2000.00, NULL, 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_fnb` VALUES (3, 'Ayam Goreng', 3000.00, NULL, 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_fnb` VALUES (4, 'Test', 2000.00, NULL, 'Super Hotel', '2018-08-27 11:41:35', 'System', 1, 1);

-- ----------------------------
-- Table structure for hot_guest
-- ----------------------------
DROP TABLE IF EXISTS `hot_guest`;
CREATE TABLE `hot_guest`  (
  `guest_id` int(11) NOT NULL,
  `guest_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
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
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hot_log
-- ----------------------------
DROP TABLE IF EXISTS `hot_log`;
CREATE TABLE `hot_log`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_type` enum('Sign In','Sign Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time(0) NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 120 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_log
-- ----------------------------
INSERT INTO `hot_log` VALUES (1, 1, 'Super Hotel', 'Sign In', '2018-08-13', '09:03:31');
INSERT INTO `hot_log` VALUES (2, 1, 'Super Hotel', 'Sign In', '2018-08-13', '09:44:41');
INSERT INTO `hot_log` VALUES (3, 1, 'Super Hotel', 'Sign In', '2018-08-13', '10:09:36');
INSERT INTO `hot_log` VALUES (4, 1, 'Super Hotel', 'Sign In', '2018-08-13', '10:09:50');
INSERT INTO `hot_log` VALUES (5, 1, 'Super Hotel', 'Sign In', '2018-08-13', '10:11:18');
INSERT INTO `hot_log` VALUES (6, 1, 'Super Hotel', 'Sign Out', '2018-08-13', '10:22:11');
INSERT INTO `hot_log` VALUES (7, 1, 'Super Hotel', 'Sign In', '2018-08-13', '10:22:21');
INSERT INTO `hot_log` VALUES (8, 1, 'Super Hotel', 'Sign In', '2018-08-13', '10:22:42');
INSERT INTO `hot_log` VALUES (9, 1, 'Super Hotel', 'Sign In', '2018-08-13', '10:36:10');
INSERT INTO `hot_log` VALUES (10, 1, 'Super Hotel', 'Sign In', '2018-08-13', '11:52:29');
INSERT INTO `hot_log` VALUES (11, 1, 'Super Hotel', 'Sign In', '2018-08-13', '14:22:36');
INSERT INTO `hot_log` VALUES (12, 1, 'Super Hotel', 'Sign In', '2018-08-13', '20:46:18');
INSERT INTO `hot_log` VALUES (13, 1, 'Super Hotel', 'Sign In', '2018-08-14', '09:52:05');
INSERT INTO `hot_log` VALUES (14, 1, 'Super Hotel', 'Sign Out', '2018-08-14', '10:13:29');
INSERT INTO `hot_log` VALUES (15, 4, 'Alfian', 'Sign In', '2018-08-14', '10:13:36');
INSERT INTO `hot_log` VALUES (16, 1, 'Super Hotel', 'Sign In', '2018-08-14', '10:13:54');
INSERT INTO `hot_log` VALUES (17, 1, 'Super Hotel', 'Sign Out', '2018-08-14', '10:18:55');
INSERT INTO `hot_log` VALUES (18, 3, 'Cashier Hotel', 'Sign In', '2018-08-14', '10:19:11');
INSERT INTO `hot_log` VALUES (19, 1, 'Super Hotel', 'Sign In', '2018-08-14', '10:19:24');
INSERT INTO `hot_log` VALUES (20, 1, 'Super Hotel', 'Sign In', '2018-08-15', '10:09:44');
INSERT INTO `hot_log` VALUES (21, 1, 'Super Hotel', 'Sign Out', '2018-08-15', '10:15:16');
INSERT INTO `hot_log` VALUES (22, 1, 'Super Hotel', 'Sign In', '2018-08-15', '10:15:33');
INSERT INTO `hot_log` VALUES (23, 1, 'Super Hotel', 'Sign Out', '2018-08-15', '10:15:36');
INSERT INTO `hot_log` VALUES (24, 1, 'Super Hotel', 'Sign In', '2018-08-15', '10:16:53');
INSERT INTO `hot_log` VALUES (25, 1, 'Super Hotel', 'Sign Out', '2018-08-15', '10:16:59');
INSERT INTO `hot_log` VALUES (26, 1, 'Super Hotel', 'Sign In', '2018-08-15', '10:17:10');
INSERT INTO `hot_log` VALUES (27, 1, 'Super Hotel', 'Sign Out', '2018-08-15', '10:19:23');
INSERT INTO `hot_log` VALUES (28, 1, 'Super Hotel', 'Sign In', '2018-08-15', '10:19:54');
INSERT INTO `hot_log` VALUES (29, 1, 'Super Hotel', 'Sign Out', '2018-08-15', '11:05:02');
INSERT INTO `hot_log` VALUES (30, 1, 'Super Hotel', 'Sign In', '2018-08-15', '11:19:35');
INSERT INTO `hot_log` VALUES (31, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:05:03');
INSERT INTO `hot_log` VALUES (32, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:15:30');
INSERT INTO `hot_log` VALUES (33, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:34:27');
INSERT INTO `hot_log` VALUES (34, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:52:30');
INSERT INTO `hot_log` VALUES (35, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:53:04');
INSERT INTO `hot_log` VALUES (36, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:54:07');
INSERT INTO `hot_log` VALUES (37, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:54:33');
INSERT INTO `hot_log` VALUES (38, 1, 'Super Hotel', 'Sign In', '2018-08-15', '12:58:08');
INSERT INTO `hot_log` VALUES (39, 1, 'Super Hotel', 'Sign In', '2018-08-15', '13:36:35');
INSERT INTO `hot_log` VALUES (40, 1, 'Super Hotel', 'Sign In', '2018-08-15', '13:37:08');
INSERT INTO `hot_log` VALUES (41, 1, 'Super Hotel', 'Sign In', '2018-08-15', '13:38:04');
INSERT INTO `hot_log` VALUES (42, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:22:20');
INSERT INTO `hot_log` VALUES (43, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:29:04');
INSERT INTO `hot_log` VALUES (44, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:39:35');
INSERT INTO `hot_log` VALUES (45, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:39:45');
INSERT INTO `hot_log` VALUES (46, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:43:08');
INSERT INTO `hot_log` VALUES (47, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:43:59');
INSERT INTO `hot_log` VALUES (48, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:44:09');
INSERT INTO `hot_log` VALUES (49, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:48:41');
INSERT INTO `hot_log` VALUES (50, 1, 'Super Hotel', 'Sign In', '2018-08-20', '10:50:16');
INSERT INTO `hot_log` VALUES (51, 1, 'Super Hotel', 'Sign In', '2018-08-20', '11:22:47');
INSERT INTO `hot_log` VALUES (52, 1, 'Super Hotel', 'Sign In', '2018-08-20', '11:25:29');
INSERT INTO `hot_log` VALUES (53, 1, 'Super Hotel', 'Sign In', '2018-08-20', '11:25:59');
INSERT INTO `hot_log` VALUES (54, 1, 'Super Hotel', 'Sign In', '2018-08-20', '11:26:16');
INSERT INTO `hot_log` VALUES (55, 1, 'Super Hotel', 'Sign In', '2018-08-20', '11:26:25');
INSERT INTO `hot_log` VALUES (56, 1, 'Super Hotel', 'Sign In', '2018-08-20', '11:28:58');
INSERT INTO `hot_log` VALUES (57, 1, 'Super Hotel', 'Sign In', '2018-08-20', '11:29:03');
INSERT INTO `hot_log` VALUES (58, 1, 'Super Hotel', 'Sign In', '2018-08-20', '14:43:17');
INSERT INTO `hot_log` VALUES (59, 1, 'Super Hotel', 'Sign In', '2018-08-20', '14:43:46');
INSERT INTO `hot_log` VALUES (60, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '15:05:19');
INSERT INTO `hot_log` VALUES (61, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:05:27');
INSERT INTO `hot_log` VALUES (62, 1, 'Super Hotel', 'Sign Out', '2018-08-20', '15:10:09');
INSERT INTO `hot_log` VALUES (63, 1, 'Super Hotel', 'Sign In', '2018-08-20', '15:11:28');
INSERT INTO `hot_log` VALUES (64, 1, 'Super Hotel', 'Sign In', '2018-08-20', '17:19:54');
INSERT INTO `hot_log` VALUES (65, 1, 'Super Hotel', 'Sign In', '2018-08-20', '17:20:05');
INSERT INTO `hot_log` VALUES (66, 1, 'Super Hotel', 'Sign In', '2018-08-20', '17:38:36');
INSERT INTO `hot_log` VALUES (67, 1, 'Super Hotel', 'Sign In', '2018-08-20', '17:44:13');
INSERT INTO `hot_log` VALUES (68, 1, 'Super Hotel', 'Sign In', '2018-08-20', '18:25:59');
INSERT INTO `hot_log` VALUES (69, 1, 'Super Hotel', 'Sign In', '2018-08-20', '18:26:11');
INSERT INTO `hot_log` VALUES (70, 1, 'Super Hotel', 'Sign In', '2018-08-21', '07:20:57');
INSERT INTO `hot_log` VALUES (71, 1, 'Super Hotel', 'Sign In', '2018-08-21', '08:08:17');
INSERT INTO `hot_log` VALUES (72, 1, 'Super Hotel', 'Sign In', '2018-08-21', '08:24:40');
INSERT INTO `hot_log` VALUES (73, 1, 'Super Hotel', 'Sign In', '2018-08-21', '09:14:42');
INSERT INTO `hot_log` VALUES (74, 1, 'Super Hotel', 'Sign In', '2018-08-21', '11:19:47');
INSERT INTO `hot_log` VALUES (75, 1, 'Super Hotel', 'Sign In', '2018-08-21', '14:44:13');
INSERT INTO `hot_log` VALUES (76, 1, 'Super Hotel', 'Sign In', '2018-08-21', '14:46:41');
INSERT INTO `hot_log` VALUES (77, 1, 'Super Hotel', 'Sign Out', '2018-08-21', '14:49:30');
INSERT INTO `hot_log` VALUES (78, 1, 'Super Hotel', 'Sign In', '2018-08-21', '14:49:37');
INSERT INTO `hot_log` VALUES (79, 1, 'Super Hotel', 'Sign Out', '2018-08-21', '14:54:27');
INSERT INTO `hot_log` VALUES (80, 1, 'Super Hotel', 'Sign In', '2018-08-21', '14:54:37');
INSERT INTO `hot_log` VALUES (81, 1, 'Super Hotel', 'Sign In', '2018-08-21', '15:32:09');
INSERT INTO `hot_log` VALUES (82, 1, 'Super Hotel', 'Sign In', '2018-08-21', '15:38:14');
INSERT INTO `hot_log` VALUES (83, 1, 'Super Hotel', 'Sign In', '2018-08-21', '18:35:33');
INSERT INTO `hot_log` VALUES (84, 1, 'Super Hotel', 'Sign In', '2018-08-21', '18:36:22');
INSERT INTO `hot_log` VALUES (85, 1, 'Super Hotel', 'Sign In', '2018-08-21', '18:37:52');
INSERT INTO `hot_log` VALUES (86, 1, 'Super Hotel', 'Sign In', '2018-08-22', '21:22:46');
INSERT INTO `hot_log` VALUES (87, 1, 'Super Hotel', 'Sign In', '2018-08-22', '21:24:55');
INSERT INTO `hot_log` VALUES (88, 1, 'Super Hotel', 'Sign In', '2018-08-27', '07:55:31');
INSERT INTO `hot_log` VALUES (89, 1, 'Super Hotel', 'Sign Out', '2018-08-27', '08:58:02');
INSERT INTO `hot_log` VALUES (90, 1, 'Super Hotel', 'Sign In', '2018-08-27', '11:33:13');
INSERT INTO `hot_log` VALUES (91, 1, 'Super Hotel', 'Sign Out', '2018-08-27', '11:33:20');
INSERT INTO `hot_log` VALUES (92, 1, 'Super Hotel', 'Sign In', '2018-08-27', '11:40:51');
INSERT INTO `hot_log` VALUES (93, 1, 'Super Hotel', 'Sign Out', '2018-08-27', '11:56:48');
INSERT INTO `hot_log` VALUES (94, 1, 'Super Hotel', 'Sign In', '2018-08-27', '14:45:11');
INSERT INTO `hot_log` VALUES (95, 1, 'Super Hotel', 'Sign Out', '2018-08-27', '14:45:26');
INSERT INTO `hot_log` VALUES (96, 1, 'Super Hotel', 'Sign In', '2018-08-27', '15:27:06');
INSERT INTO `hot_log` VALUES (97, 1, 'Super Hotel', 'Sign Out', '2018-08-27', '16:09:46');
INSERT INTO `hot_log` VALUES (98, 1, 'Super Hotel', 'Sign In', '2018-08-27', '16:17:03');
INSERT INTO `hot_log` VALUES (99, 1, 'Super Hotel', 'Sign Out', '2018-08-27', '19:37:31');
INSERT INTO `hot_log` VALUES (100, 1, 'Super Hotel', 'Sign In', '2018-08-27', '19:37:40');
INSERT INTO `hot_log` VALUES (101, 1, 'Super Hotel', 'Sign In', '2018-08-28', '07:23:54');
INSERT INTO `hot_log` VALUES (102, 1, 'Super Hotel', 'Sign In', '2018-08-28', '08:42:18');
INSERT INTO `hot_log` VALUES (103, 1, 'Super Hotel', 'Sign Out', '2018-08-28', '08:42:34');
INSERT INTO `hot_log` VALUES (104, 1, 'Super Hotel', 'Sign In', '2018-08-28', '08:43:23');
INSERT INTO `hot_log` VALUES (105, 1, 'Super Hotel', 'Sign In', '2018-08-29', '06:49:08');
INSERT INTO `hot_log` VALUES (106, 1, 'Super Hotel', 'Sign In', '2018-08-29', '12:09:14');
INSERT INTO `hot_log` VALUES (107, 1, 'Super Hotel', 'Sign In', '2018-08-29', '22:33:20');
INSERT INTO `hot_log` VALUES (108, 1, 'Super Hotel', 'Sign In', '2018-08-29', '22:34:02');
INSERT INTO `hot_log` VALUES (109, 1, 'Super Hotel', 'Sign In', '2018-08-30', '05:44:49');
INSERT INTO `hot_log` VALUES (110, 1, 'Super Hotel', 'Sign Out', '2018-08-30', '08:14:31');
INSERT INTO `hot_log` VALUES (111, 4, 'Alfian', 'Sign In', '2018-08-30', '08:14:39');
INSERT INTO `hot_log` VALUES (112, 4, 'Alfian', 'Sign Out', '2018-08-30', '08:14:48');
INSERT INTO `hot_log` VALUES (113, 1, 'Super Hotel', 'Sign In', '2018-08-30', '08:15:05');
INSERT INTO `hot_log` VALUES (114, 1, 'Super Hotel', 'Sign Out', '2018-08-30', '08:15:34');
INSERT INTO `hot_log` VALUES (115, 4, 'Alfian', 'Sign In', '2018-08-30', '08:15:40');
INSERT INTO `hot_log` VALUES (116, 4, 'Alfian', 'Sign Out', '2018-08-30', '08:17:13');
INSERT INTO `hot_log` VALUES (117, 1, 'Super Hotel', 'Sign In', '2018-08-30', '08:17:20');
INSERT INTO `hot_log` VALUES (118, 1, 'Super Hotel', 'Sign In', '2018-08-30', '14:46:15');
INSERT INTO `hot_log` VALUES (119, 1, 'Super Hotel', 'Sign In', '2018-08-30', '15:22:35');

-- ----------------------------
-- Table structure for hot_member
-- ----------------------------
DROP TABLE IF EXISTS `hot_member`;
CREATE TABLE `hot_member`  (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_phone` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_id_type` tinyint(1) NULL DEFAULT 1,
  `member_id_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_gender` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_member
-- ----------------------------
INSERT INTO `hot_member` VALUES (1, 'Test', '', NULL, 1, '', 'L', '2018-08-27 11:55:14', 'Super Hotel', '2018-08-27 11:55:34', 'Super Hotel', 1, 0);
INSERT INTO `hot_member` VALUES (2, 'Test', '0855', NULL, 3, '555', 'L', '2018-08-27 11:55:26', 'Super Hotel', '2018-08-27 11:55:30', 'System', 1, 1);

-- ----------------------------
-- Table structure for hot_module
-- ----------------------------
DROP TABLE IF EXISTS `hot_module`;
CREATE TABLE `hot_module`  (
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
-- Records of hot_module
-- ----------------------------
INSERT INTO `hot_module` VALUES ('01', '', 'Dashboard', 'hot_dashboard', 'hot_dashboard', 'index', 'dashboard', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02', '', 'Master', '', '', '#', 'cubes', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.01', '02', 'Jenis Biaya', 'hot_charge_type', 'hot_charge_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.02', '02', 'Tipe Kamar', 'hot_room_type', 'hot_room_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.03', '02', 'Kamar', 'hot_room', 'hot_room', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.04', '02', 'Tamu Langganan', 'hot_member', 'hot_member', 'index', '', '2018-08-18 05:51:24', '', '2018-08-20 15:04:05', 'Super Hotel', 0, 0);
INSERT INTO `hot_module` VALUES ('02.06', '02', 'Pelayanan', 'hot_service', 'hot_service', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.07', '02', 'Ekstra', 'hot_extra', 'hot_extra', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.08', '02', 'FnB', 'hot_fnb', 'hot_fnb', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.09', '02', 'Diskon', 'hot_discount', 'hot_discount', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.10', '02', 'Non Pajak', 'hot_non_tax', 'hot_non_tax', 'index', '', '2018-08-30 10:55:05', 'System', '2018-08-30 10:56:34', 'System', 0, 0);
INSERT INTO `hot_module` VALUES ('03', '', 'Reservasi', 'hot_reservation', 'hot_reservation', 'index', 'address-book-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('04', '', 'Laporan', '', '', '#', 'files-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('04.01', '04', 'Laporan Reservasi (semua)', 'hot_report_reservation', 'hot_report_reservation', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('04.02', '04', 'Laporan Reservasi  (resepsionis)', 'hot_report_receptionist', 'hot_report_receptionist', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('04.03', '04', 'Laporan Pembayaran', 'hot_report_payment', 'hot_report_payment', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('04.04', '04', 'Laporan Piutang', 'hot_report_credit', 'hot_report_credit', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('99.01', '99', 'Modul', 'hot_module', 'hot_module', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('99.02', '99', 'Role', 'hot_role', 'hot_role', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('99.03', '99', 'Pengguna', 'hot_user', 'hot_user', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('99.04', '99', 'Hak Akses', 'hot_permission', 'hot_permission', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('99.05', '99', 'Client', 'hot_client', 'hot_client', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);

-- ----------------------------
-- Table structure for hot_non_tax
-- ----------------------------
DROP TABLE IF EXISTS `hot_non_tax`;
CREATE TABLE `hot_non_tax`  (
  `non_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `non_tax_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `non_tax_charge` float(10, 2) NULL DEFAULT NULL,
  `created` timestamp(0) NULL DEFAULT NULL,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `is_active` tinyint(1) NULL DEFAULT 1,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`non_tax_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_non_tax
-- ----------------------------
INSERT INTO `hot_non_tax` VALUES (7, 'MIRAS', 120000.00, NULL, 'Super Hotel', NULL, 'System', 1, 0);

-- ----------------------------
-- Table structure for hot_payment
-- ----------------------------
DROP TABLE IF EXISTS `hot_payment`;
CREATE TABLE `hot_payment`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_payment
-- ----------------------------
INSERT INTO `hot_payment` VALUES (1, 1, 40000, 10, 36000, 50000, 14000, 1, '2018-08-13 10:07:40', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0, 0, NULL, NULL);
INSERT INTO `hot_payment` VALUES (2, 2, 30000, 0, 30000, 50000, 20000, 1, '2018-08-13 20:47:24', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0, 0, NULL, NULL);
INSERT INTO `hot_payment` VALUES (3, 3, 40000, 0, 40000, 50000, 10000, 1, '2018-08-14 10:00:59', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0, 0, NULL, NULL);
INSERT INTO `hot_payment` VALUES (4, 4, 40000, 0, 40000, 50000, 10000, 1, '2018-08-14 10:05:15', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0, 0, NULL, NULL);
INSERT INTO `hot_payment` VALUES (5, 5, 0, 0, 0, NULL, NULL, 0, '2018-08-15 10:11:57', 'System', '0000-00-00 00:00:00', 'System', 1, 0, 0, NULL, NULL);
INSERT INTO `hot_payment` VALUES (6, 6, 30000, 0, 30000, 50000, 20000, 1, '2018-08-15 10:21:59', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0, 0, NULL, NULL);
INSERT INTO `hot_payment` VALUES (7, 7, 36000, 0, 36000, 100000, 64000, 1, '2018-08-15 10:36:22', 'System', '0000-00-00 00:00:00', 'Super Hotel', 0, 0, 0, NULL, NULL);

-- ----------------------------
-- Table structure for hot_permission
-- ----------------------------
DROP TABLE IF EXISTS `hot_permission`;
CREATE TABLE `hot_permission`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_permission
-- ----------------------------
INSERT INTO `hot_permission` VALUES (44, 3, '01', 1, 1, 1, 1, '2018-08-20 10:45:08', 'System');
INSERT INTO `hot_permission` VALUES (45, 3, '03', 1, 1, 1, 1, '2018-08-20 10:45:08', 'System');
INSERT INTO `hot_permission` VALUES (46, 1, '01', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (47, 1, '02', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (48, 1, '02.01', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (49, 1, '02.02', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (50, 1, '02.03', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (51, 1, '02.04', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (52, 1, '02.06', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (53, 1, '02.07', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (54, 1, '02.08', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (55, 1, '02.09', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (56, 1, '02.10', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (57, 1, '03', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (58, 1, '04', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (59, 1, '04.01', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (60, 1, '04.02', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (61, 1, '04.03', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (62, 1, '04.04', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (63, 1, '99', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (64, 1, '99.03', 1, 1, 1, 1, '2018-08-30 10:57:14', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (65, 1, '99.05', 1, 1, 1, 1, '2018-08-30 10:57:15', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (66, 0, '01', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (67, 0, '02', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (68, 0, '02.01', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (69, 0, '02.02', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (70, 0, '02.03', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (71, 0, '02.04', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (72, 0, '02.06', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (73, 0, '02.07', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (74, 0, '02.08', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (75, 0, '02.09', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (76, 0, '02.10', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (77, 0, '03', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (78, 0, '04', 1, 1, 1, 1, '2018-08-30 10:58:59', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (79, 0, '04.01', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (80, 0, '04.02', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (81, 0, '04.03', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (82, 0, '04.04', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (83, 0, '99', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (84, 0, '99.01', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (85, 0, '99.02', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (86, 0, '99.03', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (87, 0, '99.04', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (88, 0, '99.05', 1, 1, 1, 1, '2018-08-30 10:59:00', 'Super Hotel');

-- ----------------------------
-- Table structure for hot_role
-- ----------------------------
DROP TABLE IF EXISTS `hot_role`;
CREATE TABLE `hot_role`  (
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
-- Records of hot_role
-- ----------------------------
INSERT INTO `hot_role` VALUES (0, 'Super Administrator Hotel', '2018-03-30 11:16:36', 'Super Administrator', '2018-08-30 10:58:36', 'Super Administrator', 1, 0);
INSERT INTO `hot_role` VALUES (1, 'Administrator Hotel', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-18 13:44:51', 'Super Administrator', 1, 0);
INSERT INTO `hot_role` VALUES (3, 'Cashier Hotel', '2018-05-08 13:42:21', 'Admin Hotel', '2018-05-18 13:45:02', 'Super Retail', 1, 0);

-- ----------------------------
-- Table structure for hot_room
-- ----------------------------
DROP TABLE IF EXISTS `hot_room`;
CREATE TABLE `hot_room`  (
  `room_id` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_type_id` int(11) NOT NULL DEFAULT 0,
  `room_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `room_no` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`room_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_room
-- ----------------------------
INSERT INTO `hot_room` VALUES ('801', 8, 'Gold - 01', '1', '2018-08-30 15:23:19', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES ('802', 8, 'Gold - 02', '2', '2018-08-30 15:23:19', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES ('803', 8, 'Gold - 03', '3', '2018-08-30 15:23:19', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES ('804', 8, 'Gold - 04', '4', '2018-08-30 15:23:19', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES ('805', 8, 'Gold - 05', '5', '2018-08-30 15:23:19', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES ('806', 8, 'Gold - 06', '6', '2018-08-30 15:23:19', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES ('807', 8, 'Gold - 07', '7', '2018-08-30 15:23:19', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES ('808', 8, 'Gold - 08', '8', '2018-08-30 15:23:20', 'Super Hotel', NULL, 'System', 1, 0);

-- ----------------------------
-- Table structure for hot_room_type
-- ----------------------------
DROP TABLE IF EXISTS `hot_room_type`;
CREATE TABLE `hot_room_type`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_room_type
-- ----------------------------
INSERT INTO `hot_room_type` VALUES (8, 'Gold', 83333.33, '', '2018-08-30 15:23:19', 'System', NULL, '', 1, 0);

-- ----------------------------
-- Table structure for hot_service
-- ----------------------------
DROP TABLE IF EXISTS `hot_service`;
CREATE TABLE `hot_service`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_service
-- ----------------------------
INSERT INTO `hot_service` VALUES (1, 't', 0.00, '2018-08-21 14:35:07', 'Super Hotel', '2018-08-21 14:35:11', 'System', 1, 1);
INSERT INTO `hot_service` VALUES (2, 'Pijat', 50000.00, '2018-08-21 14:38:12', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_service` VALUES (3, 'Sarapan Pagi', 10000.00, '2018-08-27 14:11:44', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for hot_tax
-- ----------------------------
DROP TABLE IF EXISTS `hot_tax`;
CREATE TABLE `hot_tax`  (
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
-- Records of hot_tax
-- ----------------------------
INSERT INTO `hot_tax` VALUES (1, '1.1.1.01.05\r\n', 'Pajak Hotel', 10.00, '2018-07-05 09:49:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for hot_user
-- ----------------------------
DROP TABLE IF EXISTS `hot_user`;
CREATE TABLE `hot_user`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_user
-- ----------------------------
INSERT INTO `hot_user` VALUES (1, 'superhotel', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Hotel', '2018-04-04 10:45:37', 'System', '2018-05-17 14:51:48', 'System', 1, 0);
INSERT INTO `hot_user` VALUES (2, 'adminhotel', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Hotel', '2018-05-08 13:40:40', 'System', '2018-05-17 14:51:52', 'System', 1, 0);
INSERT INTO `hot_user` VALUES (3, 'cashierhotel', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Hotel', '2018-05-08 13:43:54', 'System', '2018-05-17 14:51:57', 'System', 1, 0);
INSERT INTO `hot_user` VALUES (4, 'alfian', 3, '64fc0802fbae681ee55a9a4b87f0aec7', 'Alfian', '2018-08-14 10:13:22', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for kar_bank
-- ----------------------------
DROP TABLE IF EXISTS `kar_bank`;
CREATE TABLE `kar_bank`  (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_id` int(11) NOT NULL,
  `bank_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bank_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_billing
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing`;
CREATE TABLE `kar_billing`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_room_price` float(10, 2) NOT NULL,
  `tx_duration` int(11) NOT NULL,
  `tx_room_price_total` float(10, 2) NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time_start` time(0) NOT NULL,
  `tx_time_end` time(0) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `tx_payment` float(10, 2) NOT NULL,
  `tx_status` int(1) NOT NULL DEFAULT 0,
  `tx_cancel_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `bank_id` int(11) NOT NULL,
  `bank_card_no` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_total_tax` float(10, 2) NOT NULL,
  `tx_total_discount` float(10, 2) NOT NULL,
  `tx_total_before_tax` float(10, 2) NOT NULL,
  `tx_total_after_tax` float(10, 2) NOT NULL,
  `tx_total_grand` float(10, 2) NOT NULL,
  `tx_change` float(10, 2) NOT NULL,
  `created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `posting_st` tinyint(1) NOT NULL DEFAULT 0,
  `posting_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_billing_service_charge
-- ----------------------------
DROP TABLE IF EXISTS `kar_billing_service_charge`;
CREATE TABLE `kar_billing_service_charge`  (
  `tx_service_charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `service_charge_id` int(11) NOT NULL,
  `service_charge_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `service_charge_price` float(10, 2) NOT NULL,
  `service_charge_amount` int(11) NOT NULL,
  `service_charge_total` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tx_service_charge_id`) USING BTREE
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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_charge_type
-- ----------------------------
INSERT INTO `kar_charge_type` VALUES (1, '1.1.1.01.05', 'Pajak Karaoke', 15.00, 'Pajak Daerah', '2018-08-20 10:45:11', 'System', '2018-08-27 09:22:37', 'System', 1, 0);
INSERT INTO `kar_charge_type` VALUES (2, 'SRV', 'Servis Karaoke', 10.00, 'Biaya Servis', '2018-08-20 10:45:11', 'System', '2018-08-27 09:32:01', 'Super Karaoke', 1, 0);

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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT 1,
  `client_logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `client_is_taxed` tinyint(1) NULL DEFAULT NULL,
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
INSERT INTO `kar_client` VALUES ('1', 'CV Prisma Karaoke', 'Prisma Karaoke', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 1, 1, NULL, NULL, '2018-05-08 10:26:03', 'System', '2018-08-27 10:01:44', 'Super Karaoke', 1, 0);

-- ----------------------------
-- Table structure for kar_discount
-- ----------------------------
DROP TABLE IF EXISTS `kar_discount`;
CREATE TABLE `kar_discount`  (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT 1,
  `discount_group` tinyint(1) NULL DEFAULT NULL,
  `discount_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`discount_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_discount
-- ----------------------------
INSERT INTO `kar_discount` VALUES (3, 'Diskon Ruangan', 1, 1, 10.00, '2018-08-27 15:01:28', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_discount` VALUES (4, 'Diskon Member', 2, 2, 20000.00, '2018-08-27 15:02:06', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_discount` VALUES (5, 'Diskon Total', 1, 3, 20.00, '2018-08-27 15:02:21', 'Super Karaoke', '2018-08-27 15:02:45', 'Super Karaoke', 1, 0);

-- ----------------------------
-- Table structure for kar_fnb
-- ----------------------------
DROP TABLE IF EXISTS `kar_fnb`;
CREATE TABLE `kar_fnb`  (
  `fnb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fnb_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fnb_charge` float(10, 2) NULL DEFAULT NULL,
  `created` timestamp(0) NULL DEFAULT NULL,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `is_active` tinyint(1) NULL DEFAULT 1,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`fnb_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_fnb
-- ----------------------------
INSERT INTO `kar_fnb` VALUES (5, 'Ayam Geprek', 12000.00, NULL, 'Super Karaoke', '2018-08-27 14:20:19', 'Super Karaoke', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_log
-- ----------------------------
INSERT INTO `kar_log` VALUES (1, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '08:58:20');
INSERT INTO `kar_log` VALUES (2, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '09:01:48');
INSERT INTO `kar_log` VALUES (3, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '09:04:50');
INSERT INTO `kar_log` VALUES (4, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '09:05:05');
INSERT INTO `kar_log` VALUES (5, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '09:05:46');
INSERT INTO `kar_log` VALUES (6, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '09:06:09');
INSERT INTO `kar_log` VALUES (7, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '09:08:34');
INSERT INTO `kar_log` VALUES (8, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '09:29:40');
INSERT INTO `kar_log` VALUES (9, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '09:29:47');
INSERT INTO `kar_log` VALUES (10, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '10:17:46');
INSERT INTO `kar_log` VALUES (11, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '10:39:46');
INSERT INTO `kar_log` VALUES (12, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '10:39:52');
INSERT INTO `kar_log` VALUES (13, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '11:33:06');
INSERT INTO `kar_log` VALUES (14, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '11:33:37');
INSERT INTO `kar_log` VALUES (15, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '11:40:45');
INSERT INTO `kar_log` VALUES (16, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '11:57:02');
INSERT INTO `kar_log` VALUES (17, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '12:11:09');
INSERT INTO `kar_log` VALUES (18, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '12:11:22');
INSERT INTO `kar_log` VALUES (19, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '12:13:06');
INSERT INTO `kar_log` VALUES (20, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '12:13:12');
INSERT INTO `kar_log` VALUES (21, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '14:11:52');
INSERT INTO `kar_log` VALUES (22, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '14:11:59');
INSERT INTO `kar_log` VALUES (23, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '14:12:53');
INSERT INTO `kar_log` VALUES (24, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '14:18:27');
INSERT INTO `kar_log` VALUES (25, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '14:19:39');
INSERT INTO `kar_log` VALUES (26, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '14:45:05');
INSERT INTO `kar_log` VALUES (27, 1, 'Super Karaoke', 'Sign In', '2018-08-27', '14:45:35');
INSERT INTO `kar_log` VALUES (28, 1, 'Super Karaoke', 'Sign Out', '2018-08-27', '15:26:59');
INSERT INTO `kar_log` VALUES (29, 1, 'Super Karaoke', 'Sign In', '2018-08-28', '08:42:48');
INSERT INTO `kar_log` VALUES (30, 1, 'Super Karaoke', 'Sign Out', '2018-08-28', '08:43:04');

-- ----------------------------
-- Table structure for kar_member
-- ----------------------------
DROP TABLE IF EXISTS `kar_member`;
CREATE TABLE `kar_member`  (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_phone` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_id_type` tinyint(1) NULL DEFAULT 1,
  `member_id_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_gender` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_type` tinyint(1) NULL DEFAULT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_member
-- ----------------------------
INSERT INTO `kar_member` VALUES (4, 'Biasa', '', NULL, 1, '', 'P', 0, '2018-08-27 14:51:04', 'Super Karaoke', '2018-08-27 14:52:33', 'Super Karaoke', 1, 0);
INSERT INTO `kar_member` VALUES (5, 'Langganan', '', NULL, 1, '', 'L', 1, '2018-08-27 14:51:12', 'Super Karaoke', '2018-08-27 14:52:26', 'Super Karaoke', 1, 0);

-- ----------------------------
-- Table structure for kar_member_type
-- ----------------------------
DROP TABLE IF EXISTS `kar_member_type`;
CREATE TABLE `kar_member_type`  (
  `member_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`member_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
INSERT INTO `kar_module` VALUES ('01', '', 'Dashboard', 'kar_dashboard', 'kar_dashboard', 'index', 'dashboard', '2018-08-18 05:51:24', '', '2018-08-27 08:52:10', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02', '', 'Master', '', '', '#', 'cubes', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.01', '02', 'Jenis Biaya', 'kar_charge_type', 'kar_charge_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:52:40', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.02', '02', 'Tipe Ruang', 'kar_room_type', 'kar_room_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 09:00:28', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.03', '02', 'Ruang', 'kar_room', 'kar_room', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:52:56', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.04', '02', 'Tamu', 'kar_member', 'kar_member', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:53:04', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.06', '02', 'Pelayanan', 'kar_service', 'kar_service', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:53:12', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.07', '02', 'FnB', 'kar_fnb', 'kar_fnb', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:53:47', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.08', '02', 'Non Pajak', 'kar_non_tax', 'kar_non_tax', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:55:15', '', 0, 0);
INSERT INTO `kar_module` VALUES ('02.09', '02', 'Diskon', 'kar_discount', 'kar_discount', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:55:35', '', 0, 0);
INSERT INTO `kar_module` VALUES ('03', '', 'Pemesanan', 'kar_reservation', 'kar_reservation', 'index', 'address-book-o', '2018-08-18 05:51:24', '', '2018-08-27 08:55:41', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04', '', 'Laporan', '', '', '#', 'files-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.01', '04', 'Laporan Pemesanan (semua)', 'kar_report_reservation', 'kar_report_reservation', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:55:48', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.02', '04', 'Laporan Pemesanan (resepsionis)', 'kar_report_receptionist', 'kar_report_receptionist', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 15:06:52', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.03', '04', 'Laporan Pembayaran', 'kar_report_payment', 'kar_report_payment', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:56:28', '', 0, 0);
INSERT INTO `kar_module` VALUES ('04.04', '04', 'Laporan Piutang', 'kar_report_credit', 'kar_report_credit', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:56:35', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.01', '99', 'Modul', 'kar_module', 'kar_module', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:56:44', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.02', '99', 'Role', 'kar_role', 'kar_role', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:56:51', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.03', '99', 'Pengguna', 'kar_user', 'kar_user', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:56:57', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.04', '99', 'Hak Akses', 'kar_permission', 'kar_permission', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:57:04', '', 0, 0);
INSERT INTO `kar_module` VALUES ('99.05', '99', 'Client', 'kar_client', 'kar_client', 'index', '', '2018-08-18 05:51:24', '', '2018-08-27 08:57:11', '', 0, 0);

-- ----------------------------
-- Table structure for kar_non_tax
-- ----------------------------
DROP TABLE IF EXISTS `kar_non_tax`;
CREATE TABLE `kar_non_tax`  (
  `non_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `non_tax_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `non_tax_charge` float(10, 2) NULL DEFAULT NULL,
  `created` timestamp(0) NULL DEFAULT NULL,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'System',
  `is_active` tinyint(1) NULL DEFAULT 1,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`non_tax_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_non_tax
-- ----------------------------
INSERT INTO `kar_non_tax` VALUES (6, 'LC', 80000.00, NULL, 'Super Karaoke', '2018-08-27 14:30:43', 'Super Karaoke', 1, 0);

-- ----------------------------
-- Table structure for kar_payment_type
-- ----------------------------
DROP TABLE IF EXISTS `kar_payment_type`;
CREATE TABLE `kar_payment_type`  (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`payment_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_payment_type
-- ----------------------------
INSERT INTO `kar_payment_type` VALUES (1, 'Cash', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_payment_type` VALUES (2, 'Debit Card', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_payment_type` VALUES (3, 'Credit Card', '2018-04-19 19:34:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 954 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_permission
-- ----------------------------
INSERT INTO `kar_permission` VALUES (932, 0, '01', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (933, 0, '02', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (934, 0, '02.01', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (935, 0, '02.02', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (936, 0, '02.03', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (937, 0, '02.04', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (938, 0, '02.06', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (939, 0, '02.07', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (940, 0, '02.08', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (941, 0, '02.09', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (942, 0, '03', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (943, 0, '04', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (944, 0, '04.01', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (945, 0, '04.02', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (946, 0, '04.03', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (947, 0, '04.04', 1, 1, 1, 1, '2018-08-27 09:08:05', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (948, 0, '99', 1, 1, 1, 1, '2018-08-27 09:08:06', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (949, 0, '99.01', 1, 1, 1, 1, '2018-08-27 09:08:06', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (950, 0, '99.02', 1, 1, 1, 1, '2018-08-27 09:08:06', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (951, 0, '99.03', 1, 1, 1, 1, '2018-08-27 09:08:06', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (952, 0, '99.04', 1, 1, 1, 1, '2018-08-27 09:08:06', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (953, 0, '99.05', 1, 1, 1, 1, '2018-08-27 09:08:06', 'Super Karaoke');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_role
-- ----------------------------
INSERT INTO `kar_role` VALUES (0, 'Super Administrator Karaoke', '2018-03-30 11:16:36', 'Super Administrator', '2018-08-27 09:05:33', 'Super Administrator', 1, 0);
INSERT INTO `kar_role` VALUES (1, 'Administrator Karaoke', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-18 10:44:21', 'Super Administrator', 1, 0);
INSERT INTO `kar_role` VALUES (2, 'Cashier Karaoke', '2018-05-08 13:42:21', 'Admin Retail', '2018-06-03 21:04:44', 'Super Retail', 1, 0);
INSERT INTO `kar_role` VALUES (5, 'a', '2018-05-18 10:44:41', 'Super Karaoke', '2018-05-18 10:44:44', 'System', 1, 1);

-- ----------------------------
-- Table structure for kar_room
-- ----------------------------
DROP TABLE IF EXISTS `kar_room`;
CREATE TABLE `kar_room`  (
  `room_id` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_type_id` int(11) NOT NULL DEFAULT 0,
  `room_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `room_no` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`room_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_room
-- ----------------------------
INSERT INTO `kar_room` VALUES ('601', 6, 'Diva Family - 01', '1', '2018-08-27 10:31:01', 'Super Karaoke', '2018-08-27 10:41:15', 'Super Karaoke', 1, 0);
INSERT INTO `kar_room` VALUES ('602', 6, 'Diva Family - 02', '2', '2018-08-27 10:31:01', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('603', 6, 'Diva Family - 03', '3', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('604', 6, 'Diva Family - 04', '4', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('605', 6, 'Diva Family - 05', '5', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('606', 6, 'Diva Family - 06', '6', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('607', 6, 'Diva Family - 07', '7', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('608', 6, 'Diva Family - 08', '8', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('609', 6, 'Diva Family - 09', '9', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);
INSERT INTO `kar_room` VALUES ('610', 6, 'Diva Family - 10', '10', '2018-08-27 10:31:02', 'Super Karaoke', NULL, 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_room_type
-- ----------------------------
INSERT INTO `kar_room_type` VALUES (6, 'Diva Family', 100000.00, '', '2018-08-27 10:31:01', 'System', '2018-08-27 10:40:29', 'Super Karaoke', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_service
-- ----------------------------
INSERT INTO `kar_service` VALUES (1, 't', 0.00, '2018-08-21 14:35:07', 'Super Hotel', '2018-08-21 14:35:11', 'System', 1, 1);
INSERT INTO `kar_service` VALUES (2, 'Pijat', 50000.00, '2018-08-21 14:38:12', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_service` VALUES (3, 'Sarapan Pagi', 10000.00, '2018-08-27 14:13:06', 'Super Karaoke', '2018-08-27 14:13:32', 'Super Karaoke', 1, 0);

-- ----------------------------
-- Table structure for kar_service_charge
-- ----------------------------
DROP TABLE IF EXISTS `kar_service_charge`;
CREATE TABLE `kar_service_charge`  (
  `service_charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_charge_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `service_charge_price` float(10, 2) NOT NULL DEFAULT 0.00,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`service_charge_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_shift
-- ----------------------------
DROP TABLE IF EXISTS `kar_shift`;
CREATE TABLE `kar_shift`  (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date NULL DEFAULT NULL,
  `shift_in_time` time(0) NULL DEFAULT NULL,
  `shift_out_date` date NULL DEFAULT NULL,
  `shift_out_time` time(0) NULL DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT 0,
  `money_in_50k` int(11) NOT NULL DEFAULT 0,
  `money_in_20k` int(11) NOT NULL DEFAULT 0,
  `money_in_10k` int(11) NOT NULL DEFAULT 0,
  `money_in_5k` int(11) NOT NULL DEFAULT 0,
  `money_in_2k` int(11) NOT NULL DEFAULT 0,
  `money_in_1k` int(11) NOT NULL DEFAULT 0,
  `money_in_total` int(11) NOT NULL DEFAULT 0,
  `coin_in_1k` int(11) NOT NULL DEFAULT 0,
  `coin_in_500` int(11) NOT NULL DEFAULT 0,
  `coin_in_200` int(11) NOT NULL DEFAULT 0,
  `coin_in_100` int(11) NOT NULL DEFAULT 0,
  `coin_in_50` int(11) NOT NULL DEFAULT 0,
  `coin_in_25` int(11) NOT NULL DEFAULT 0,
  `coin_in_total` int(11) NOT NULL DEFAULT 0,
  `total_in` int(11) NOT NULL DEFAULT 0,
  `money_out_100k` int(11) NOT NULL DEFAULT 0,
  `money_out_50k` int(11) NOT NULL DEFAULT 0,
  `money_out_20k` int(11) NOT NULL DEFAULT 0,
  `money_out_10k` int(11) NOT NULL DEFAULT 0,
  `money_out_5k` int(11) NOT NULL DEFAULT 0,
  `money_out_2k` int(11) NOT NULL DEFAULT 0,
  `money_out_1k` int(11) NOT NULL DEFAULT 0,
  `money_out_total` int(11) NOT NULL DEFAULT 0,
  `coin_out_1k` int(11) NOT NULL DEFAULT 0,
  `coin_out_500` int(11) NOT NULL DEFAULT 0,
  `coin_out_200` int(11) NOT NULL DEFAULT 0,
  `coin_out_100` int(11) NOT NULL DEFAULT 0,
  `coin_out_50` int(11) NOT NULL DEFAULT 0,
  `coin_out_25` int(11) NOT NULL DEFAULT 0,
  `coin_out_total` int(11) NOT NULL DEFAULT 0,
  `total_out` int(11) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_shift
-- ----------------------------
INSERT INTO `kar_shift` VALUES (1, 1, 'Super Retail', 1, 1, '2018-05-28', '10:13:28', '2018-05-28', '10:14:30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:13:28', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail');
INSERT INTO `kar_shift` VALUES (2, 1, 'Super Retail', 1, 1, '2018-05-28', '10:17:11', '2018-05-28', '10:17:17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:17:11', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail');
INSERT INTO `kar_shift` VALUES (3, 1, 'Super Retail', 1, 1, '2018-05-28', '10:19:49', '2018-05-30', '20:57:05', 1, 1, 1, 12, 1, 1, 0, 297000, 5, 5, 51, 1, 1, 1, 17875, 314875, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-28 10:19:49', 'Super Retail', '0000-00-00 00:00:00', 'Super Retail');
INSERT INTO `kar_shift` VALUES (4, 1, 'Super Karaoke', 1, 1, '2018-05-30', '20:57:07', '2018-06-02', '16:35:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-30 20:57:07', 'Super Retail', '0000-00-00 00:00:00', 'Super Karaoke');
INSERT INTO `kar_shift` VALUES (5, 1, 'Super Karaoke', 1, 1, '2018-06-02', '16:35:54', '2018-06-03', '07:26:35', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-02 16:35:54', 'Super Karaoke', '0000-00-00 00:00:00', 'Super Karaoke');
INSERT INTO `kar_shift` VALUES (6, 1, 'Super Karaoke', 1, 0, '2018-06-03', '07:26:53', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-03 07:26:53', 'Super Karaoke', '0000-00-00 00:00:00', 'System');

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
INSERT INTO `kar_tax` VALUES (1, '1.1.1.03.05', 'Pajak Diskotek, Karaoke, dan Klab MalamDiskotek, Karaoke, dan Klab Malam', 15.00, '2018-07-05 14:11:05', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for kar_time
-- ----------------------------
DROP TABLE IF EXISTS `kar_time`;
CREATE TABLE `kar_time`  (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `time_start` time(0) NOT NULL DEFAULT '00:00:00',
  `time_end` time(0) NOT NULL DEFAULT '00:00:00',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`time_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_time
-- ----------------------------
INSERT INTO `kar_time` VALUES (1, 'Happy Hours', '08:00:00', '18:00:00', '2018-06-01 21:19:36', 'Super Karaoke', '2018-06-04 08:21:10', 'System', 1, 0);
INSERT INTO `kar_time` VALUES (2, 'Business Hours', '18:01:00', '24:00:00', '2018-06-01 21:22:20', 'Super Karaoke', '2018-06-03 20:43:16', 'System', 1, 0);

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
INSERT INTO `kar_user` VALUES (1, 'superkaraoke', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Karaoke', '2018-04-04 10:45:37', 'System', '2018-05-18 10:32:05', 'System', 1, 0);
INSERT INTO `kar_user` VALUES (2, 'adminkaraoke', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Karaoke', '2018-05-08 13:40:40', 'System', '2018-05-18 10:32:10', 'System', 1, 0);
INSERT INTO `kar_user` VALUES (3, 'cashierkaraoke', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Karaoke', '2018-05-08 13:43:54', 'System', '2018-05-18 10:32:16', 'System', 1, 0);

-- ----------------------------
-- Table structure for par_billing
-- ----------------------------
DROP TABLE IF EXISTS `par_billing`;
CREATE TABLE `par_billing`  (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `user_id_in` int(11) NOT NULL,
  `user_realname_in` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id_out` int(11) NULL DEFAULT NULL,
  `user_realname_out` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `category_rate` float(10, 2) NOT NULL,
  `category_not_flat` tinyint(1) NOT NULL,
  `category_per_hour` float(10, 2) NOT NULL,
  `billing_tnkb` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `billing_status_in` tinyint(1) NOT NULL,
  `billing_status_out` tinyint(1) NOT NULL,
  `billing_date_in` date NOT NULL,
  `billing_time_in` time(0) NOT NULL,
  `billing_date_out` date NOT NULL,
  `billing_time_out` time(0) NOT NULL,
  `billing_duration` int(11) NOT NULL,
  `billing_subtotal` float(10, 2) NOT NULL,
  `billing_tax` float(10, 2) NOT NULL,
  `billing_total_grand` float(10, 2) NOT NULL,
  `billing_payment` float(10, 2) NOT NULL,
  `billing_change` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `posting_st` tinyint(1) NOT NULL DEFAULT 0,
  `posting_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`billing_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for par_brand
-- ----------------------------
DROP TABLE IF EXISTS `par_brand`;
CREATE TABLE `par_brand`  (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `update_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`brand_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of par_brand
-- ----------------------------
INSERT INTO `par_brand` VALUES (1, 'Lainnya\r\n', '2018-05-22 10:20:18', 'System', '2018-07-05 15:42:49', 'System', 1, 0);

-- ----------------------------
-- Table structure for par_category
-- ----------------------------
DROP TABLE IF EXISTS `par_category`;
CREATE TABLE `par_category`  (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `category_not_flat` tinyint(1) NOT NULL DEFAULT 0,
  `category_rate` float(10, 2) NOT NULL,
  `category_per_hour` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for par_client
-- ----------------------------
DROP TABLE IF EXISTS `par_client`;
CREATE TABLE `par_client`  (
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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT 1,
  `client_logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`client_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of par_client
-- ----------------------------
INSERT INTO `par_client` VALUES ('1', 'CV Prisma Parking', 'Prisma Parking', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, 1, NULL, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Parking', 1, 0);

-- ----------------------------
-- Table structure for par_log
-- ----------------------------
DROP TABLE IF EXISTS `par_log`;
CREATE TABLE `par_log`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_type` enum('Sign In','Sign Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time(0) NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for par_module
-- ----------------------------
DROP TABLE IF EXISTS `par_module`;
CREATE TABLE `par_module`  (
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
-- Records of par_module
-- ----------------------------
INSERT INTO `par_module` VALUES ('01', '', 'Dashboard', 'par_dashboard', 'par_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-05-17 13:53:19', 'Super Administrator', 1, 0);
INSERT INTO `par_module` VALUES ('02', '', 'Master', '', '', '#', 'cubes', '2018-05-17 14:14:25', 'Super Parking', '2018-05-17 14:34:37', 'Super Parking', 1, 0);
INSERT INTO `par_module` VALUES ('02.01', '02', 'Kategori & Tarif', 'par_category', 'par_category', 'index', '', '2018-05-17 14:39:24', 'Super Parking', '2018-05-22 09:17:28', 'Super Parking', 1, 0);
INSERT INTO `par_module` VALUES ('02.02', '02', 'Merek', 'par_brand', 'par_brand', 'index', 'car', '2018-05-22 10:16:30', 'Super Parking', '2018-05-22 10:20:56', 'Super Parking', 1, 0);
INSERT INTO `par_module` VALUES ('04', '', 'Parkir Masuk', 'par_parking_in', 'par_parking_in', 'index', 'sign-in', '2018-05-22 09:57:57', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `par_module` VALUES ('05', '', 'Parkir Keluar', 'par_parking_out', 'par_parking_out', 'index', 'sign-out', '2018-05-22 14:55:42', 'Super Parking', '2018-05-23 11:46:46', 'Super Parking', 1, 0);
INSERT INTO `par_module` VALUES ('06', '', 'Laporan', '', '', '#', 'files-o', '2018-05-24 15:02:11', 'Super Parking', '2018-05-24 15:16:44', 'Super Parking', 1, 0);
INSERT INTO `par_module` VALUES ('06.01', '06', 'Parkir Masuk', 'par_report_parking_in', 'par_report_parking_in', 'index', 'sign-in', '2018-05-24 15:18:48', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `par_module` VALUES ('06.02', '06', 'Parkir Keluar', 'par_report_parking_out', 'par_report_parking_out', 'index', 'sign-out', '2018-05-25 13:55:34', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `par_module` VALUES ('06.03', '06', 'Pendapatan', 'par_report_income', 'par_report_income', 'index', 'money', '2018-05-25 14:27:28', 'Super Parking', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `par_module` VALUES ('06.04', '06', 'Pendapatan (Kasir)', 'par_report_income_user', 'par_report_income_user', 'index', 'users', '2018-06-05 09:12:38', 'Super Parking', '2018-06-05 09:13:03', 'System', 1, 0);
INSERT INTO `par_module` VALUES ('06.06', '06', 'Shift', 'par_report_shift', 'par_report_shift', 'index', 'transfer', '2018-05-27 09:18:33', 'Super Parking', '2018-06-08 10:56:05', 'System', 1, 0);
INSERT INTO `par_module` VALUES ('06.07', '06', 'Log Akses', 'par_report_log', 'par_report_log', 'index', 'users', '2018-06-05 08:34:09', 'Super Parking', '2018-06-08 10:56:01', 'System', 1, 0);
INSERT INTO `par_module` VALUES ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `par_module` VALUES ('99.01', '99', 'Modul', 'par_module', 'par_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-05-17 13:53:48', 'Super Administrator', 1, 0);
INSERT INTO `par_module` VALUES ('99.02', '99', 'Role', 'par_role', 'par_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-05-17 13:53:51', 'Super Administrator', 1, 0);
INSERT INTO `par_module` VALUES ('99.03', '99', 'Pengguna', 'par_user', 'par_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-05-17 13:53:55', 'Super Administrator', 1, 0);
INSERT INTO `par_module` VALUES ('99.04', '99', 'Hak Akses', 'par_permission', 'par_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-05-17 13:53:42', '', 1, 0);
INSERT INTO `par_module` VALUES ('99.05', '99', 'Client', 'par_client', 'par_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-05-17 13:53:58', 'Super Administrator', 1, 0);

-- ----------------------------
-- Table structure for par_permission
-- ----------------------------
DROP TABLE IF EXISTS `par_permission`;
CREATE TABLE `par_permission`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 799 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of par_permission
-- ----------------------------
INSERT INTO `par_permission` VALUES (722, 3, '01', 1, 1, 1, 1, '2018-05-27 10:37:25', 'Super Parking');
INSERT INTO `par_permission` VALUES (723, 3, '04', 1, 1, 1, 1, '2018-05-27 10:37:25', 'Super Parking');
INSERT INTO `par_permission` VALUES (726, 1, '01', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (727, 1, '02', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (728, 1, '02.01', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (729, 1, '02.02', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (730, 1, '06', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (731, 1, '06.01', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (732, 1, '06.02', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (733, 1, '06.03', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (734, 1, '06.04', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (735, 1, '99', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (736, 1, '99.03', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (737, 1, '99.05', 1, 1, 1, 1, '2018-05-27 10:41:08', 'Super Parking');
INSERT INTO `par_permission` VALUES (738, 5, '01', 1, 1, 1, 1, '2018-05-27 10:42:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (739, 5, '05', 1, 1, 1, 1, '2018-05-27 10:42:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (778, 0, '01', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (779, 0, '02', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (780, 0, '02.01', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (781, 0, '02.02', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (782, 0, '04', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (783, 0, '05', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (784, 0, '06', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (785, 0, '06.01', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (786, 0, '06.02', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (787, 0, '06.03', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (788, 0, '06.04', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (789, 0, '06.05', 1, 1, 1, 1, '2018-06-08 10:54:50', 'Super Parking');
INSERT INTO `par_permission` VALUES (790, 0, '06.06', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (791, 0, '06.07', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (792, 0, '99', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (793, 0, '99.01', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (794, 0, '99.02', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (795, 0, '99.03', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (796, 0, '99.04', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (797, 0, '99.05', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');
INSERT INTO `par_permission` VALUES (798, 0, '99.06', 1, 1, 1, 1, '2018-06-08 10:54:51', 'Super Parking');

-- ----------------------------
-- Table structure for par_role
-- ----------------------------
DROP TABLE IF EXISTS `par_role`;
CREATE TABLE `par_role`  (
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
-- Records of par_role
-- ----------------------------
INSERT INTO `par_role` VALUES (1, 'Administrator Parking', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-17 13:50:10', 'Super Administrator', 1, 0);
INSERT INTO `par_role` VALUES (2, 'Cashier Parking In', '2018-05-08 13:42:21', 'Admin Retail', '2018-07-05 15:43:44', 'Super Parking', 1, 0);
INSERT INTO `par_role` VALUES (3, 'Cashier Parking Out', '2018-05-24 15:03:20', 'Super Parking', '2018-07-05 15:43:47', 'System', 1, 0);
INSERT INTO `par_role` VALUES (4, 'Super Administrator Parking', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-17 13:50:14', 'Super Administrator', 1, 0);

-- ----------------------------
-- Table structure for par_shift
-- ----------------------------
DROP TABLE IF EXISTS `par_shift`;
CREATE TABLE `par_shift`  (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `parking_type` tinyint(1) NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date NULL DEFAULT NULL,
  `shift_in_time` time(0) NULL DEFAULT NULL,
  `shift_out_date` date NULL DEFAULT NULL,
  `shift_out_time` time(0) NULL DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT 0,
  `money_in_50k` int(11) NOT NULL DEFAULT 0,
  `money_in_20k` int(11) NOT NULL DEFAULT 0,
  `money_in_10k` int(11) NOT NULL DEFAULT 0,
  `money_in_5k` int(11) NOT NULL DEFAULT 0,
  `money_in_2k` int(11) NOT NULL DEFAULT 0,
  `money_in_1k` int(11) NOT NULL DEFAULT 0,
  `money_in_total` int(11) NOT NULL DEFAULT 0,
  `coin_in_1k` int(11) NOT NULL DEFAULT 0,
  `coin_in_500` int(11) NOT NULL DEFAULT 0,
  `coin_in_200` int(11) NOT NULL DEFAULT 0,
  `coin_in_100` int(11) NOT NULL DEFAULT 0,
  `coin_in_50` int(11) NOT NULL DEFAULT 0,
  `coin_in_25` int(11) NOT NULL DEFAULT 0,
  `coin_in_total` int(11) NOT NULL DEFAULT 0,
  `total_in` int(11) NOT NULL DEFAULT 0,
  `money_out_100k` int(11) NOT NULL DEFAULT 0,
  `money_out_50k` int(11) NOT NULL DEFAULT 0,
  `money_out_20k` int(11) NOT NULL DEFAULT 0,
  `money_out_10k` int(11) NOT NULL DEFAULT 0,
  `money_out_5k` int(11) NOT NULL DEFAULT 0,
  `money_out_2k` int(11) NOT NULL DEFAULT 0,
  `money_out_1k` int(11) NOT NULL DEFAULT 0,
  `money_out_total` int(11) NOT NULL DEFAULT 0,
  `coin_out_1k` int(11) NOT NULL DEFAULT 0,
  `coin_out_500` int(11) NOT NULL DEFAULT 0,
  `coin_out_200` int(11) NOT NULL DEFAULT 0,
  `coin_out_100` int(11) NOT NULL DEFAULT 0,
  `coin_out_50` int(11) NOT NULL DEFAULT 0,
  `coin_out_25` int(11) NOT NULL DEFAULT 0,
  `coin_out_total` int(11) NOT NULL DEFAULT 0,
  `total_out` int(11) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for par_tax
-- ----------------------------
DROP TABLE IF EXISTS `par_tax`;
CREATE TABLE `par_tax`  (
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
-- Records of par_tax
-- ----------------------------
INSERT INTO `par_tax` VALUES (1, '1.1.1.07.01\r\n', 'Pajak Parkir', 15.00, '2018-07-05 09:49:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for par_user
-- ----------------------------
DROP TABLE IF EXISTS `par_user`;
CREATE TABLE `par_user`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of par_user
-- ----------------------------
INSERT INTO `par_user` VALUES (1, 'superparking', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Parking', '2018-04-04 10:45:37', 'System', '2018-05-17 11:39:14', 'System', 1, 0);
INSERT INTO `par_user` VALUES (2, 'adminparking', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Parking', '2018-05-08 13:40:40', 'System', '2018-05-17 11:39:09', 'System', 1, 0);
INSERT INTO `par_user` VALUES (3, 'cashierparkingin', 2, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Parking In', '2018-05-08 13:43:54', 'System', '2018-07-05 15:44:08', 'Super Parking', 1, 0);
INSERT INTO `par_user` VALUES (4, 'cashierparkingout', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Parking Out', '2018-05-24 15:04:06', 'Super Parking', '2018-07-05 15:44:18', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_bank
-- ----------------------------
DROP TABLE IF EXISTS `res_bank`;
CREATE TABLE `res_bank`  (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_id` int(11) NOT NULL,
  `bank_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bank_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_billing
-- ----------------------------
DROP TABLE IF EXISTS `res_billing`;
CREATE TABLE `res_billing`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time(0) NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `tx_payment` float(10, 2) NOT NULL,
  `tx_status` int(1) NOT NULL DEFAULT 0,
  `tx_cancel_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `bank_id` int(11) NOT NULL,
  `bank_card_no` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bank_reference_no` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_total_buy_average` float(10, 2) NOT NULL,
  `tx_total_tax` float(10, 2) NOT NULL,
  `tx_total_discount` float(10, 2) NOT NULL,
  `tx_total_before_tax` float(10, 2) NOT NULL,
  `tx_total_after_tax` float(10, 2) NOT NULL,
  `tx_total_grand` float(10, 2) NOT NULL,
  `tx_change` float(10, 2) NOT NULL,
  `tx_total_profit_before_tax` float(10, 2) NOT NULL,
  `tx_total_profit_after_tax` float(10, 2) NOT NULL,
  `created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `posting_st` tinyint(1) NOT NULL DEFAULT 0,
  `posting_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_billing
-- ----------------------------
INSERT INTO `res_billing` VALUES (1, '180827000001', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-08-27', '16:12:30', '', 1, 100000.00, 1, NULL, 0, '', '', 0.00, 8727.27, 0.00, 87272.72, 95999.99, 95999.99, 4000.01, 87272.72, 78545.45, '2018-08-27 16:12:32', 'Super Restaurant', '2018-08-27 16:12:47', 'Super Restaurant', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (2, '180827000002', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-07-27', '16:12:56', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 2563.64, 0.00, 25636.36, 28200.00, 28200.00, 21800.00, 25636.36, 23072.72, '2018-08-27 16:12:57', 'Super Restaurant', '2018-08-29 09:53:11', 'Super Restaurant', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (3, '180829000001', 1, 'Super Hotel', 1, 'Umum', 'TXS', '2017-08-29', '09:57:41', '', 1, 50000.00, 1, NULL, 0, '', '', 0.00, 1200.00, 0.00, 12000.00, 13200.00, 13200.00, 36800.00, 12000.00, 10800.00, '2018-08-29 09:57:44', 'Super Hotel', '2018-08-29 09:58:12', 'System', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (4, '180829000001', 1, 'Super Hotel', 1, 'Umum', 'TXS', '2018-08-29', '12:01:18', '', 1, 20000.00, 1, NULL, 0, '', '', 0.00, 1363.64, 0.00, 13636.36, 15000.00, 15000.00, 5000.00, 13636.36, 12272.72, '2018-08-29 12:01:20', 'Super Hotel', '2018-08-29 12:01:29', 'System', 1, 0, 0, NULL);

-- ----------------------------
-- Table structure for res_billing_buyall
-- ----------------------------
DROP TABLE IF EXISTS `res_billing_buyall`;
CREATE TABLE `res_billing_buyall`  (
  `billing_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_buyall_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyall_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_billing_buyget
-- ----------------------------
DROP TABLE IF EXISTS `res_billing_buyget`;
CREATE TABLE `res_billing_buyget`  (
  `billing_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_buyget_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyget_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_billing_buyitem
-- ----------------------------
DROP TABLE IF EXISTS `res_billing_buyitem`;
CREATE TABLE `res_billing_buyitem`  (
  `billing_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_buyitem_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyitem_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_billing_detail
-- ----------------------------
DROP TABLE IF EXISTS `res_billing_detail`;
CREATE TABLE `res_billing_detail`  (
  `billing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_before_tax` float(10, 2) NOT NULL,
  `item_price_after_tax` float(10, 2) NOT NULL,
  `item_price_buy_average` float(10, 2) NOT NULL,
  `tx_amount` float NOT NULL,
  `tx_subtotal_tax` float(10, 2) NOT NULL,
  `tx_subtotal_discount` float(10, 2) NOT NULL,
  `tx_subtotal_buy_average` float(10, 2) NOT NULL,
  `tx_subtotal_before_tax` float(10, 2) NOT NULL,
  `tx_subtotal_after_tax` float(10, 2) NOT NULL,
  `tx_subtotal_profit_before_tax` float(10, 2) NOT NULL,
  `tx_subtotal_profit_after_tax` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_billing_detail
-- ----------------------------
INSERT INTO `res_billing_detail` VALUES (1, 0, 'TXS', 2, 'Ayam Bakar', 13636.36, 15000.00, 0.00, 11, 15000.00, 0.00, 0.00, 149999.95, 164999.95, 149999.95, 134999.95, '2018-08-27 16:12:16', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (2, 1, 'TXS', 2, 'Ayam Bakar', 13636.36, 15000.00, 0.00, 2, 2727.27, 0.00, 0.00, 27272.72, 29999.99, 27272.72, 24545.45, '2018-08-27 16:12:32', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (3, 1, 'TXS', 1, 'Ayam Geprek', 12000.00, 13200.00, 0.00, 5, 6000.00, 0.00, 0.00, 60000.00, 66000.00, 60000.00, 54000.00, '2018-08-27 16:12:36', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (4, 2, 'TXS', 2, 'Ayam Bakar', 13636.36, 15000.00, 0.00, 1, 1363.64, 0.00, 0.00, 13636.36, 15000.00, 13636.36, 12272.72, '2018-08-27 16:12:57', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (5, 2, 'TXS', 1, 'Ayam Geprek', 12000.00, 13200.00, 0.00, 1, 1200.00, 0.00, 0.00, 12000.00, 13200.00, 12000.00, 10800.00, '2018-08-27 16:12:59', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (6, 3, 'TXS', 1, 'Ayam Geprek', 12000.00, 13200.00, 0.00, 1, 1200.00, 0.00, 0.00, 12000.00, 13200.00, 12000.00, 10800.00, '2018-08-29 09:57:44', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (7, 4, 'TXS', 2, 'Ayam Bakar', 13636.36, 15000.00, 0.00, 1, 1363.64, 0.00, 0.00, 13636.36, 15000.00, 13636.36, 12272.72, '2018-08-29 12:01:20', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_category
-- ----------------------------
DROP TABLE IF EXISTS `res_category`;
CREATE TABLE `res_category`  (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_category
-- ----------------------------
INSERT INTO `res_category` VALUES (1, 'Tidak Terkategori', '2018-05-08 13:26:31', 'System', '2018-05-08 13:26:44', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_client
-- ----------------------------
DROP TABLE IF EXISTS `res_client`;
CREATE TABLE `res_client`  (
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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT 1,
  `client_logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`client_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_client
-- ----------------------------
INSERT INTO `res_client` VALUES ('1', 'CV Prisma Restaurant', 'Prisma Restaurant', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, 1, NULL, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Restaurant', 1, 0);

-- ----------------------------
-- Table structure for res_customer
-- ----------------------------
DROP TABLE IF EXISTS `res_customer`;
CREATE TABLE `res_customer`  (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_fax` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_customer
-- ----------------------------
INSERT INTO `res_customer` VALUES (1, 'Umum', '0', '', '', '', '2018-08-27 16:12:28', 'Super Restaurant', '0000-00-00 00:00:00', '', 1, 0);

-- ----------------------------
-- Table structure for res_item
-- ----------------------------
DROP TABLE IF EXISTS `res_item`;
CREATE TABLE `res_item`  (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `item_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_barcode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_before_tax` float(10, 2) NOT NULL,
  `item_tax` float(10, 2) NOT NULL,
  `item_price_after_tax` float(10, 2) NOT NULL,
  `is_package` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`item_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_item
-- ----------------------------
INSERT INTO `res_item` VALUES (1, 1, 1, 1, 'Ayam Geprek', '01', '', 12000.00, 1200.00, 13200.00, 0, '2018-08-27 16:11:47', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_item` VALUES (2, 1, 1, 1, 'Ayam Bakar', '02', '', 13636.36, 1363.64, 15000.00, 0, '2018-08-27 16:12:04', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_item_package
-- ----------------------------
DROP TABLE IF EXISTS `res_item_package`;
CREATE TABLE `res_item_package`  (
  `item_package_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_detail_id` int(11) NOT NULL,
  `item_detail_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`item_package_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_location
-- ----------------------------
DROP TABLE IF EXISTS `res_location`;
CREATE TABLE `res_location`  (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `location_code` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`location_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_log
-- ----------------------------
DROP TABLE IF EXISTS `res_log`;
CREATE TABLE `res_log`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_type` enum('Sign In','Sign Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time(0) NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_log
-- ----------------------------
INSERT INTO `res_log` VALUES (1, 1, 'Super Restaurant', 'Sign In', '2018-08-27', '16:09:54');
INSERT INTO `res_log` VALUES (2, 1, 'Super Restaurant', 'Sign Out', '2018-08-27', '16:16:54');

-- ----------------------------
-- Table structure for res_module
-- ----------------------------
DROP TABLE IF EXISTS `res_module`;
CREATE TABLE `res_module`  (
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
-- Records of res_module
-- ----------------------------
INSERT INTO `res_module` VALUES ('01', '', 'Dashboard', 'res_dashboard', 'res_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-04-19 10:40:13', 'Super Administrator', 1, 0);
INSERT INTO `res_module` VALUES ('02', '', 'Master', '', '', '#', 'cubes', '2018-04-05 19:44:13', 'superadmin', '2018-04-05 19:45:13', 'superadmin', 1, 0);
INSERT INTO `res_module` VALUES ('02.01', '02', 'Kategori', 'res_category', 'res_category', 'index', 'paperclip', '2018-04-05 19:47:02', 'superadmin', '2018-04-05 21:22:37', 'Super Administrator', 1, 0);
INSERT INTO `res_module` VALUES ('02.02', '02', 'Satuan', 'res_unit', 'res_unit', 'index', 'dot-circle-o', '2018-04-05 22:14:53', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('02.03', '02', 'Item', 'res_item', 'res_item', 'index', 'list', '2018-04-07 15:49:43', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('02.04', '02', 'Suplier', 'res_supplier', 'res_supplier', 'index', 'truck', '2018-04-09 18:13:11', 'Super Administrator', '2018-04-09 18:53:55', 'Super Administrator', 1, 0);
INSERT INTO `res_module` VALUES ('02.05', '02', 'Pelanggan', 'res_customer', 'res_customer', 'index', 'users', '2018-04-10 08:56:24', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('02.06', '02', 'Bank', 'res_bank', 'res_bank', 'index', 'bank', '2018-04-18 08:38:55', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('02.07', '02', 'Pajak', 'res_tax', 'res_tax', 'index', 'chain', '2018-04-19 19:48:06', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('02.08', '02', 'Promo', 'res_promo', 'res_promo', 'index', 'ticket', '2018-04-20 09:21:42', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('03', '', 'Transaksi', '', '', '#', 'exchange', '2018-04-17 10:05:10', 'Super Administrator', '2018-06-07 11:17:10', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('03.01', '03', 'Kasir', 'res_cashier', 'res_cashier', 'index', 'laptop', '2018-06-07 11:17:32', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('03.02', '03', 'Retur', 'res_return', 'res_return', 'index', 'undo', '2018-06-07 11:19:02', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('03.03', '03', 'Void', 'res_void', 'res_void', 'index', 'ban', '2018-06-07 14:17:41', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('04', '', 'Inventori', '', '', '#', 'archive', '2018-04-10 10:37:46', 'Super Administrator', '2018-06-08 12:26:52', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('04.01', '04', 'Stok Masuk', 'res_stock_in', 'res_stock_in', 'index', 'sign-in', '2018-04-10 10:54:00', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('04.02', '04', 'Stok Keluar', 'res_stock_out', 'res_stock_out', 'index', 'sign-out', '2018-04-11 10:48:29', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('04.03', '04', 'Stok Opname', 'res_stock_opname', 'res_stock_opname', 'index', 'exchange', '2018-04-11 13:54:55', 'Super Administrator', '2018-04-11 14:01:18', 'Super Administrator', 1, 0);
INSERT INTO `res_module` VALUES ('04.04', '04', 'Rekap Stok', 'res_stock_recap', 'res_stock_recap', 'index', 'files-o', '2018-04-11 14:11:28', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('04.05', '04', 'Purchace Order', 'res_po', 'res_po', 'index', 'file-text', '2018-04-12 12:36:57', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('05', '', 'Laporan', '', '', '#', 'files-o', '2018-05-04 09:10:39', 'Super Administrator', '2018-05-28 10:30:22', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.01', '05', 'Penjualan (Semua)', 'res_report_selling', 'res_report_selling', 'index', 'money', '2018-05-28 10:32:42', 'Super Restaurant', '2018-05-28 10:53:56', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.02', '05', 'Penjualan (Pelanggan)', 'res_report_selling_customer', 'res_report_selling_customer', 'index', 'users', '2018-05-28 10:52:44', 'Super Restaurant', '2018-05-28 10:53:42', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.03', '05', 'Penjualan (Kategori)', 'res_report_selling_category', 'res_report_selling_category', 'index', 'cubes', '2018-05-28 11:41:33', 'Super Restaurant', '2018-05-28 14:18:04', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.04', '05', 'Penjualan (Kasir)', 'res_report_selling_user', 'res_report_selling_user', 'index', 'laptop', '2018-06-04 09:06:23', 'Super Restaurant', '2018-06-04 09:18:32', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.05', '05', 'Penjualan (Item)', 'res_report_selling_item', 'res_report_selling_item', 'index', 'cube', '2018-05-28 14:17:59', 'Super Restaurant', '2018-06-04 09:08:45', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('05.06', '05', 'Omzet (Semua)', 'res_report_profit', 'res_report_profit', 'index', 'bar-chart', '2018-05-28 14:58:02', 'Super Restaurant', '2018-06-04 09:08:40', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.07', '05', 'Omzet (Kasir)', 'res_report_profit_cashier', 'res_report_profit_cashier', 'index', 'laptop', '2018-05-28 15:33:42', 'Super Restaurant', '2018-06-08 10:20:55', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.08', '05', 'Piutang', 'res_report_credit', 'res_report_credit', 'index', 'credit-card', '2018-06-08 09:51:51', 'Super Restaurant', '2018-06-08 10:20:49', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('05.09', '05', 'Stok Barang', 'res_report_stock', 'res_report_stock', 'index', 'archive', '2018-05-29 21:31:00', 'Super Restaurant', '2018-06-08 09:52:48', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('05.10', '05', 'Shift', 'res_report_shift', 'res_report_shift', 'index', 'transfer', '2018-05-29 21:58:13', 'Super Restaurant', '2018-06-08 09:52:41', 'System', 1, 0);
INSERT INTO `res_module` VALUES ('05.11', '05', 'Log Akses', 'res_report_log', 'res_report_log', 'index', 'files-o', '2018-06-04 14:33:00', 'Super Restaurant', '2018-06-08 09:52:36', 'Super Restaurant', 1, 0);
INSERT INTO `res_module` VALUES ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_module` VALUES ('99.01', '99', 'Modul', 'res_module', 'res_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-04-19 10:40:32', 'Super Administrator', 1, 0);
INSERT INTO `res_module` VALUES ('99.02', '99', 'Role', 'res_role', 'res_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-04-19 10:40:40', 'Super Administrator', 1, 0);
INSERT INTO `res_module` VALUES ('99.03', '99', 'Pengguna', 'res_user', 'res_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-04-19 10:40:49', 'Super Administrator', 1, 0);
INSERT INTO `res_module` VALUES ('99.04', '99', 'Hak Akses', 'res_permission', 'res_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-04-19 10:40:56', '', 1, 0);
INSERT INTO `res_module` VALUES ('99.05', '99', 'Client', 'res_client', 'res_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-04-20 08:15:47', 'Super Administrator', 1, 0);

-- ----------------------------
-- Table structure for res_payment_type
-- ----------------------------
DROP TABLE IF EXISTS `res_payment_type`;
CREATE TABLE `res_payment_type`  (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`payment_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_payment_type
-- ----------------------------
INSERT INTO `res_payment_type` VALUES (1, 'Cash', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_payment_type` VALUES (2, 'Debit Card', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_payment_type` VALUES (3, 'Credit Card', '2018-04-19 19:34:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_permission
-- ----------------------------
DROP TABLE IF EXISTS `res_permission`;
CREATE TABLE `res_permission`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 81 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_permission
-- ----------------------------
INSERT INTO `res_permission` VALUES (1, 0, '01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (2, 0, '02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (3, 0, '02.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (4, 0, '02.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (5, 0, '02.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (6, 0, '02.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (7, 0, '02.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (8, 0, '02.06', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (9, 0, '02.07', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (10, 0, '02.08', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (11, 0, '03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (12, 0, '03.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (13, 0, '03.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (14, 0, '03.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (15, 0, '04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (16, 0, '04.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (17, 0, '04.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (18, 0, '04.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (19, 0, '04.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (20, 0, '04.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (21, 0, '05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (22, 0, '05.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (23, 0, '05.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (24, 0, '05.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (25, 0, '05.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (26, 0, '05.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (27, 0, '05.06', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (28, 0, '05.07', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (29, 0, '05.08', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (30, 0, '05.09', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (31, 0, '05.10', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (32, 0, '05.11', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (33, 0, '99', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (34, 0, '99.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (35, 0, '99.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (36, 0, '99.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (37, 0, '99.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (38, 0, '99.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (39, 0, '99.06', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (40, 1, '01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (41, 1, '02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (42, 1, '02.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (43, 1, '02.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (44, 1, '02.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (45, 1, '02.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (46, 1, '02.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (47, 1, '02.06', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (48, 1, '02.08', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (49, 1, '03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (50, 1, '03.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (51, 1, '03.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (52, 1, '03.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (53, 1, '04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (54, 1, '04.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (55, 1, '04.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (56, 1, '04.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (57, 1, '04.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (58, 1, '04.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (59, 1, '05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (60, 1, '05.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (61, 1, '05.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (62, 1, '05.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (63, 1, '05.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (64, 1, '05.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (65, 1, '05.06', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (66, 1, '05.07', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (67, 1, '05.08', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (68, 1, '05.09', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (69, 1, '05.10', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (70, 1, '05.11', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (71, 1, '99', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (72, 1, '99.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (73, 1, '99.05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (74, 2, '01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (75, 2, '03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (76, 2, '03.01', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (77, 2, '03.02', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (78, 2, '03.03', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (79, 2, '05', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');
INSERT INTO `res_permission` VALUES (80, 2, '05.04', 1, 1, 1, 1, '2018-08-13 09:02:15', 'System');

-- ----------------------------
-- Table structure for res_po
-- ----------------------------
DROP TABLE IF EXISTS `res_po`;
CREATE TABLE `res_po`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_po_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_po_receiver` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_status` int(1) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_po_detail
-- ----------------------------
DROP TABLE IF EXISTS `res_po_detail`;
CREATE TABLE `res_po_detail`  (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_demand` float(10, 2) NOT NULL,
  `stock_receive` float(10, 2) NOT NULL,
  `stock_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_promo
-- ----------------------------
DROP TABLE IF EXISTS `res_promo`;
CREATE TABLE `res_promo`  (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_id` int(1) NOT NULL,
  `promo_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_date_start` date NOT NULL,
  `promo_date_end` date NOT NULL,
  `promo_time_start` time(0) NOT NULL,
  `promo_time_end` time(0) NOT NULL,
  `promo_sunday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_monday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_tuesday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_wednesday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_thursday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_friday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_saturday` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_promo_buyall
-- ----------------------------
DROP TABLE IF EXISTS `res_promo_buyall`;
CREATE TABLE `res_promo_buyall`  (
  `promo_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` float(10, 2) NOT NULL COMMENT 'in_percent',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_buyall_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_promo_buyget
-- ----------------------------
DROP TABLE IF EXISTS `res_promo_buyget`;
CREATE TABLE `res_promo_buyget`  (
  `promo_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_buyget_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_promo_buyitem
-- ----------------------------
DROP TABLE IF EXISTS `res_promo_buyitem`;
CREATE TABLE `res_promo_buyitem`  (
  `promo_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` float(10, 2) NOT NULL COMMENT 'in_percent',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_buyitem_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_promo_type
-- ----------------------------
DROP TABLE IF EXISTS `res_promo_type`;
CREATE TABLE `res_promo_type`  (
  `promo_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_code` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_type_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_promo_type
-- ----------------------------
INSERT INTO `res_promo_type` VALUES (1, 'PRB', 'Promo Buy Get', '2018-07-05 15:36:45', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_promo_type` VALUES (2, 'PRI', 'Promo Buy Item', '2018-07-05 15:36:55', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_promo_type` VALUES (3, 'PRA', 'Promo Buy All', '2018-07-05 15:38:53', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_return
-- ----------------------------
DROP TABLE IF EXISTS `res_return`;
CREATE TABLE `res_return`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXR',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time(0) NOT NULL,
  `return_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_return_detail
-- ----------------------------
DROP TABLE IF EXISTS `res_return_detail`;
CREATE TABLE `res_return_detail`  (
  `return_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXR',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_after_tax` float(10, 2) NOT NULL,
  `tx_amount` float NOT NULL,
  `return_amount` float NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`return_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_role
-- ----------------------------
DROP TABLE IF EXISTS `res_role`;
CREATE TABLE `res_role`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_role
-- ----------------------------
INSERT INTO `res_role` VALUES (1, 'Administrator Restaurant', '2018-03-30 11:18:19', 'Super Administrator', '2018-04-19 11:04:57', 'Super Administrator', 1, 0);
INSERT INTO `res_role` VALUES (2, 'Cashier Restaurant', '2018-05-08 13:42:21', 'Admin Restaurant', '2018-05-28 22:17:09', 'Super Restaurant', 1, 0);
INSERT INTO `res_role` VALUES (3, 'Super Administrator Restaurant', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-08 13:40:17', 'Super Administrator', 1, 0);

-- ----------------------------
-- Table structure for res_shift
-- ----------------------------
DROP TABLE IF EXISTS `res_shift`;
CREATE TABLE `res_shift`  (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date NULL DEFAULT NULL,
  `shift_in_time` time(0) NULL DEFAULT NULL,
  `shift_out_date` date NULL DEFAULT NULL,
  `shift_out_time` time(0) NULL DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT 0,
  `money_in_50k` int(11) NOT NULL DEFAULT 0,
  `money_in_20k` int(11) NOT NULL DEFAULT 0,
  `money_in_10k` int(11) NOT NULL DEFAULT 0,
  `money_in_5k` int(11) NOT NULL DEFAULT 0,
  `money_in_2k` int(11) NOT NULL DEFAULT 0,
  `money_in_1k` int(11) NOT NULL DEFAULT 0,
  `money_in_total` int(11) NOT NULL DEFAULT 0,
  `coin_in_1k` int(11) NOT NULL DEFAULT 0,
  `coin_in_500` int(11) NOT NULL DEFAULT 0,
  `coin_in_200` int(11) NOT NULL DEFAULT 0,
  `coin_in_100` int(11) NOT NULL DEFAULT 0,
  `coin_in_50` int(11) NOT NULL DEFAULT 0,
  `coin_in_25` int(11) NOT NULL DEFAULT 0,
  `coin_in_total` int(11) NOT NULL DEFAULT 0,
  `total_in` int(11) NOT NULL DEFAULT 0,
  `money_out_100k` int(11) NOT NULL DEFAULT 0,
  `money_out_50k` int(11) NOT NULL DEFAULT 0,
  `money_out_20k` int(11) NOT NULL DEFAULT 0,
  `money_out_10k` int(11) NOT NULL DEFAULT 0,
  `money_out_5k` int(11) NOT NULL DEFAULT 0,
  `money_out_2k` int(11) NOT NULL DEFAULT 0,
  `money_out_1k` int(11) NOT NULL DEFAULT 0,
  `money_out_total` int(11) NOT NULL DEFAULT 0,
  `coin_out_1k` int(11) NOT NULL DEFAULT 0,
  `coin_out_500` int(11) NOT NULL DEFAULT 0,
  `coin_out_200` int(11) NOT NULL DEFAULT 0,
  `coin_out_100` int(11) NOT NULL DEFAULT 0,
  `coin_out_50` int(11) NOT NULL DEFAULT 0,
  `coin_out_25` int(11) NOT NULL DEFAULT 0,
  `coin_out_total` int(11) NOT NULL DEFAULT 0,
  `total_out` int(11) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_shift
-- ----------------------------
INSERT INTO `res_shift` VALUES (1, 1, 'Super Restaurant', 1, 0, '2018-08-27', '16:12:13', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-08-27 16:12:13', 'Super Restaurant', '0000-00-00 00:00:00', 'System');

-- ----------------------------
-- Table structure for res_stock
-- ----------------------------
DROP TABLE IF EXISTS `res_stock`;
CREATE TABLE `res_stock`  (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_in` float(10, 2) NOT NULL,
  `stock_out` float(10, 2) NOT NULL,
  `stock_adjustment` float(10, 2) NOT NULL,
  `stock_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_stock
-- ----------------------------
INSERT INTO `res_stock` VALUES (1, 1, 'TXS', '2018-08-27', 2, 0.00, -2.00, 0.00, 0.00, '2018-08-27 16:12:47', 'Super Restaurant');
INSERT INTO `res_stock` VALUES (2, 1, 'TXS', '2018-08-27', 1, 0.00, -5.00, 0.00, 0.00, '2018-08-27 16:12:47', 'Super Restaurant');
INSERT INTO `res_stock` VALUES (3, 2, 'TXS', '2018-08-27', 2, 0.00, -1.00, 0.00, 0.00, '2018-08-27 16:13:05', 'Super Restaurant');
INSERT INTO `res_stock` VALUES (4, 2, 'TXS', '2018-08-27', 1, 0.00, -1.00, 0.00, 0.00, '2018-08-27 16:13:05', 'Super Restaurant');
INSERT INTO `res_stock` VALUES (5, 3, 'TXS', '2018-08-29', 1, 0.00, -1.00, 0.00, 0.00, '2018-08-29 09:57:49', 'Super Hotel');
INSERT INTO `res_stock` VALUES (6, 4, 'TXS', '2018-08-29', 2, 0.00, -1.00, 0.00, 0.00, '2018-08-29 12:01:29', 'Super Hotel');

-- ----------------------------
-- Table structure for res_stock_in
-- ----------------------------
DROP TABLE IF EXISTS `res_stock_in`;
CREATE TABLE `res_stock_in`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_stock_opname
-- ----------------------------
DROP TABLE IF EXISTS `res_stock_opname`;
CREATE TABLE `res_stock_opname`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_status` tinyint(1) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_stock_opname_detail
-- ----------------------------
DROP TABLE IF EXISTS `res_stock_opname_detail`;
CREATE TABLE `res_stock_opname_detail`  (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_last` float(10, 2) NOT NULL,
  `stock_now` float(10, 2) NOT NULL,
  `stock_adjustment` float(10, 2) NOT NULL,
  `stock_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_stock_out
-- ----------------------------
DROP TABLE IF EXISTS `res_stock_out`;
CREATE TABLE `res_stock_out`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_supplier
-- ----------------------------
DROP TABLE IF EXISTS `res_supplier`;
CREATE TABLE `res_supplier`  (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_fax` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`supplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_tax
-- ----------------------------
DROP TABLE IF EXISTS `res_tax`;
CREATE TABLE `res_tax`  (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tax_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tax_ratio` float(10, 2) NOT NULL COMMENT 'in percent',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tax_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_tax
-- ----------------------------
INSERT INTO `res_tax` VALUES (1, '1.1.1.02.01', 'Pajak Restoran', 10.00, '2018-05-08 11:05:43', 'Super Administrator', '2018-07-05 15:45:07', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_tx_type
-- ----------------------------
DROP TABLE IF EXISTS `res_tx_type`;
CREATE TABLE `res_tx_type`  (
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`tx_type`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_tx_type
-- ----------------------------
INSERT INTO `res_tx_type` VALUES ('TXA', 'Adjustment', '2018-04-11 13:59:45', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `res_tx_type` VALUES ('TXI', 'In Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `res_tx_type` VALUES ('TXO', 'Out Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `res_tx_type` VALUES ('TXP', 'Purchase Order\r\n', '2018-04-12 14:15:57', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `res_tx_type` VALUES ('TXR', 'Receive Order', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `res_tx_type` VALUES ('TXS', 'Selling ', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for res_unit
-- ----------------------------
DROP TABLE IF EXISTS `res_unit`;
CREATE TABLE `res_unit`  (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `unit_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`unit_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_unit
-- ----------------------------
INSERT INTO `res_unit` VALUES (1, 'gr', 'Gram', '2018-06-04 09:02:07', 'System', '2018-06-04 09:02:10', '', 1, 0);
INSERT INTO `res_unit` VALUES (2, 'kg', 'Kilogram', '2018-06-04 09:02:32', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (3, 'doz', 'Lusin', '2018-06-04 09:02:46', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (4, 'pks', 'Packs', '2018-06-04 09:03:03', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (5, 'gross', 'Gross', '2018-06-04 09:03:16', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (6, 'krtn', 'Karton', '2018-06-04 09:03:28', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (7, 'pcs', 'Pieces', '2018-05-08 13:31:41', 'System', '2018-06-04 09:01:43', '', 1, 0);

-- ----------------------------
-- Table structure for res_user
-- ----------------------------
DROP TABLE IF EXISTS `res_user`;
CREATE TABLE `res_user`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_user
-- ----------------------------
INSERT INTO `res_user` VALUES (1, 'superrestaurant', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Restaurant', '2018-04-04 10:45:37', '', '2018-05-08 13:40:06', 'Super Administrator', 1, 0);
INSERT INTO `res_user` VALUES (2, 'adminrestaurant', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Restaurant', '2018-05-08 13:40:40', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_user` VALUES (4, 'cashierrestaurant', 2, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Restaurant', '2018-06-04 09:27:29', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for res_void
-- ----------------------------
DROP TABLE IF EXISTS `res_void`;
CREATE TABLE `res_void`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXV',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time(0) NOT NULL,
  `void_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for res_void_detail
-- ----------------------------
DROP TABLE IF EXISTS `res_void_detail`;
CREATE TABLE `res_void_detail`  (
  `void_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXV',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_after_tax` float(10, 2) NOT NULL,
  `tx_amount` float NOT NULL,
  `void_amount` float NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`void_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_bank
-- ----------------------------
DROP TABLE IF EXISTS `ret_bank`;
CREATE TABLE `ret_bank`  (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_id` int(11) NOT NULL,
  `bank_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bank_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_billing
-- ----------------------------
DROP TABLE IF EXISTS `ret_billing`;
CREATE TABLE `ret_billing`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time(0) NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `tx_payment` float(10, 2) NOT NULL,
  `tx_status` int(1) NOT NULL DEFAULT 0,
  `tx_cancel_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `bank_id` int(11) NOT NULL,
  `bank_card_no` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bank_reference_no` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_total_buy_average` float(10, 2) NOT NULL,
  `tx_total_tax` float(10, 2) NOT NULL,
  `tx_total_discount` float(10, 2) NOT NULL,
  `tx_total_before_tax` float(10, 2) NOT NULL,
  `tx_total_after_tax` float(10, 2) NOT NULL,
  `tx_total_grand` float(10, 2) NOT NULL,
  `tx_change` float(10, 2) NOT NULL,
  `tx_total_profit_before_tax` float(10, 2) NOT NULL,
  `tx_total_profit_after_tax` float(10, 2) NOT NULL,
  `created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `posting_st` tinyint(1) NOT NULL DEFAULT 0,
  `posting_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_billing_buyall
-- ----------------------------
DROP TABLE IF EXISTS `ret_billing_buyall`;
CREATE TABLE `ret_billing_buyall`  (
  `billing_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_buyall_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyall_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_billing_buyget
-- ----------------------------
DROP TABLE IF EXISTS `ret_billing_buyget`;
CREATE TABLE `ret_billing_buyget`  (
  `billing_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_buyget_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyget_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_billing_buyitem
-- ----------------------------
DROP TABLE IF EXISTS `ret_billing_buyitem`;
CREATE TABLE `ret_billing_buyitem`  (
  `billing_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_buyitem_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` int(11) NOT NULL,
  `get_discount_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`billing_buyitem_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_billing_detail
-- ----------------------------
DROP TABLE IF EXISTS `ret_billing_detail`;
CREATE TABLE `ret_billing_detail`  (
  `billing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_before_tax` float(10, 2) NOT NULL,
  `item_price_after_tax` float(10, 2) NOT NULL,
  `item_price_buy_average` float(10, 2) NOT NULL,
  `tx_amount` float NOT NULL,
  `tx_subtotal_tax` float(10, 2) NOT NULL,
  `tx_subtotal_discount` float(10, 2) NOT NULL,
  `tx_subtotal_buy_average` float(10, 2) NOT NULL,
  `tx_subtotal_before_tax` float(10, 2) NOT NULL,
  `tx_subtotal_after_tax` float(10, 2) NOT NULL,
  `tx_subtotal_profit_before_tax` float(10, 2) NOT NULL,
  `tx_subtotal_profit_after_tax` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`billing_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_category
-- ----------------------------
DROP TABLE IF EXISTS `ret_category`;
CREATE TABLE `ret_category`  (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_category
-- ----------------------------
INSERT INTO `ret_category` VALUES (1, 'Tidak Terkategori', '2018-05-08 13:26:31', 'System', '2018-05-08 13:26:44', 'System', 1, 0);

-- ----------------------------
-- Table structure for ret_client
-- ----------------------------
DROP TABLE IF EXISTS `ret_client`;
CREATE TABLE `ret_client`  (
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
  `client_receipt_is_taxed` tinyint(1) NOT NULL DEFAULT 1,
  `client_logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`client_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_client
-- ----------------------------
INSERT INTO `ret_client` VALUES ('1', 'CV Prisma Retail', 'Prisma Retail', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, 1, NULL, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Retail', 1, 0);

-- ----------------------------
-- Table structure for ret_customer
-- ----------------------------
DROP TABLE IF EXISTS `ret_customer`;
CREATE TABLE `ret_customer`  (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_fax` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_customer
-- ----------------------------
INSERT INTO `ret_customer` VALUES (1, 'Umum', '1234567890', '1234567890', 'umum@umum.com', 'Umum', '2018-05-08 11:07:30', 'Super Administrator', '2018-05-08 13:33:20', '', 1, 0);

-- ----------------------------
-- Table structure for ret_item
-- ----------------------------
DROP TABLE IF EXISTS `ret_item`;
CREATE TABLE `ret_item`  (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `item_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_barcode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_before_tax` float(10, 2) NOT NULL,
  `is_package` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`item_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_item_package
-- ----------------------------
DROP TABLE IF EXISTS `ret_item_package`;
CREATE TABLE `ret_item_package`  (
  `item_package_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_detail_id` int(11) NOT NULL,
  `item_detail_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`item_package_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_log
-- ----------------------------
DROP TABLE IF EXISTS `ret_log`;
CREATE TABLE `ret_log`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_type` enum('Sign In','Sign Out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time(0) NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_module
-- ----------------------------
DROP TABLE IF EXISTS `ret_module`;
CREATE TABLE `ret_module`  (
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
-- Records of ret_module
-- ----------------------------
INSERT INTO `ret_module` VALUES ('01', '', 'Dashboard', 'ret_dashboard', 'ret_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-04-19 10:40:13', 'Super Administrator', 1, 0);
INSERT INTO `ret_module` VALUES ('02', '', 'Master', '', '', '#', 'cubes', '2018-04-05 19:44:13', 'superadmin', '2018-04-05 19:45:13', 'superadmin', 1, 0);
INSERT INTO `ret_module` VALUES ('02.01', '02', 'Kategori', 'ret_category', 'ret_category', 'index', 'paperclip', '2018-04-05 19:47:02', 'superadmin', '2018-04-05 21:22:37', 'Super Administrator', 1, 0);
INSERT INTO `ret_module` VALUES ('02.02', '02', 'Satuan', 'ret_unit', 'ret_unit', 'index', 'dot-circle-o', '2018-04-05 22:14:53', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('02.03', '02', 'Item', 'ret_item', 'ret_item', 'index', 'list', '2018-04-07 15:49:43', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('02.04', '02', 'Suplier', 'ret_supplier', 'ret_supplier', 'index', 'truck', '2018-04-09 18:13:11', 'Super Administrator', '2018-04-09 18:53:55', 'Super Administrator', 1, 0);
INSERT INTO `ret_module` VALUES ('02.05', '02', 'Pelanggan', 'ret_customer', 'ret_customer', 'index', 'users', '2018-04-10 08:56:24', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('02.06', '02', 'Bank', 'ret_bank', 'ret_bank', 'index', 'bank', '2018-04-18 08:38:55', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('02.07', '02', 'Pajak', 'ret_tax', 'ret_tax', 'index', 'chain', '2018-04-19 19:48:06', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('02.08', '02', 'Promo', 'ret_promo', 'ret_promo', 'index', 'ticket', '2018-04-20 09:21:42', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('03', '', 'Transaksi', '', '', '#', 'exchange', '2018-04-17 10:05:10', 'Super Administrator', '2018-06-07 11:17:10', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('03.01', '03', 'Kasir', 'ret_cashier', 'ret_cashier', 'index', 'laptop', '2018-06-07 11:17:32', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('03.02', '03', 'Retur', 'ret_return', 'ret_return', 'index', 'undo', '2018-06-07 11:19:02', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('03.03', '03', 'Void', 'ret_void', 'ret_void', 'index', 'ban', '2018-06-07 14:17:41', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('04', '', 'Inventori', '', '', '#', 'archive', '2018-04-10 10:37:46', 'Super Administrator', '2018-06-08 12:26:52', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('04.01', '04', 'Stok Masuk', 'ret_stock_in', 'ret_stock_in', 'index', 'sign-in', '2018-04-10 10:54:00', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('04.02', '04', 'Stok Keluar', 'ret_stock_out', 'ret_stock_out', 'index', 'sign-out', '2018-04-11 10:48:29', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('04.03', '04', 'Stok Opname', 'ret_stock_opname', 'ret_stock_opname', 'index', 'exchange', '2018-04-11 13:54:55', 'Super Administrator', '2018-04-11 14:01:18', 'Super Administrator', 1, 0);
INSERT INTO `ret_module` VALUES ('04.04', '04', 'Rekap Stok', 'ret_stock_recap', 'ret_stock_recap', 'index', 'files-o', '2018-04-11 14:11:28', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('04.05', '04', 'Purchace Order', 'ret_po', 'ret_po', 'index', 'file-text', '2018-04-12 12:36:57', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('05', '', 'Laporan', '', '', '#', 'files-o', '2018-05-04 09:10:39', 'Super Administrator', '2018-05-28 10:30:22', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.01', '05', 'Penjualan (Semua)', 'ret_report_selling', 'ret_report_selling', 'index', 'money', '2018-05-28 10:32:42', 'Super Retail', '2018-05-28 10:53:56', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.02', '05', 'Penjualan (Pelanggan)', 'ret_report_selling_customer', 'ret_report_selling_customer', 'index', 'users', '2018-05-28 10:52:44', 'Super Retail', '2018-05-28 10:53:42', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.03', '05', 'Penjualan (Kategori)', 'ret_report_selling_category', 'ret_report_selling_category', 'index', 'cubes', '2018-05-28 11:41:33', 'Super Retail', '2018-05-28 14:18:04', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.04', '05', 'Penjualan (Kasir)', 'ret_report_selling_user', 'ret_report_selling_user', 'index', 'laptop', '2018-06-04 09:06:23', 'Super Retail', '2018-06-04 09:18:32', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.05', '05', 'Penjualan (Item)', 'ret_report_selling_item', 'ret_report_selling_item', 'index', 'cube', '2018-05-28 14:17:59', 'Super Retail', '2018-06-04 09:08:45', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('05.06', '05', 'Omzet (Semua)', 'ret_report_profit', 'ret_report_profit', 'index', 'bar-chart', '2018-05-28 14:58:02', 'Super Retail', '2018-06-04 09:08:40', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.07', '05', 'Omzet (Kasir)', 'ret_report_profit_cashier', 'ret_report_profit_cashier', 'index', 'laptop', '2018-05-28 15:33:42', 'Super Retail', '2018-06-08 10:20:55', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.08', '05', 'Piutang', 'ret_report_credit', 'ret_report_credit', 'index', 'credit-card', '2018-06-08 09:51:51', 'Super Retail', '2018-06-08 10:20:49', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('05.09', '05', 'Stok Barang', 'ret_report_stock', 'ret_report_stock', 'index', 'archive', '2018-05-29 21:31:00', 'Super Retail', '2018-06-08 09:52:48', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('05.10', '05', 'Shift', 'ret_report_shift', 'ret_report_shift', 'index', 'transfer', '2018-05-29 21:58:13', 'Super Retail', '2018-06-08 09:52:41', 'System', 1, 0);
INSERT INTO `ret_module` VALUES ('05.11', '05', 'Log Akses', 'ret_report_log', 'ret_report_log', 'index', 'files-o', '2018-06-04 14:33:00', 'Super Retail', '2018-06-08 09:52:36', 'Super Retail', 1, 0);
INSERT INTO `ret_module` VALUES ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_module` VALUES ('99.01', '99', 'Modul', 'ret_module', 'ret_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-04-19 10:40:32', 'Super Administrator', 1, 0);
INSERT INTO `ret_module` VALUES ('99.02', '99', 'Role', 'ret_role', 'ret_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-04-19 10:40:40', 'Super Administrator', 1, 0);
INSERT INTO `ret_module` VALUES ('99.03', '99', 'Pengguna', 'ret_user', 'ret_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-04-19 10:40:49', 'Super Administrator', 1, 0);
INSERT INTO `ret_module` VALUES ('99.04', '99', 'Hak Akses', 'ret_permission', 'ret_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-04-19 10:40:56', '', 1, 0);
INSERT INTO `ret_module` VALUES ('99.05', '99', 'Client', 'ret_client', 'ret_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-04-20 08:15:47', 'Super Administrator', 1, 0);

-- ----------------------------
-- Table structure for ret_payment_type
-- ----------------------------
DROP TABLE IF EXISTS `ret_payment_type`;
CREATE TABLE `ret_payment_type`  (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`payment_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_payment_type
-- ----------------------------
INSERT INTO `ret_payment_type` VALUES (1, 'Cash', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_payment_type` VALUES (2, 'Debit Card', '2018-04-19 19:34:04', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_payment_type` VALUES (3, 'Credit Card', '2018-04-19 19:34:12', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for ret_permission
-- ----------------------------
DROP TABLE IF EXISTS `ret_permission`;
CREATE TABLE `ret_permission`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 1093 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_permission
-- ----------------------------
INSERT INTO `ret_permission` VALUES (521, 3, '01', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail');
INSERT INTO `ret_permission` VALUES (522, 3, '03', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail');
INSERT INTO `ret_permission` VALUES (523, 3, '03.01', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail');
INSERT INTO `ret_permission` VALUES (524, 3, '03.02', 1, 1, 1, 1, '2018-05-08 13:42:51', 'Admin Retail');
INSERT INTO `ret_permission` VALUES (807, 1, '01', 1, 1, 1, 1, '2018-06-01 07:50:53', 'Super Retail');
INSERT INTO `ret_permission` VALUES (808, 1, '02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (809, 1, '02.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (810, 1, '02.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (811, 1, '02.03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (812, 1, '02.04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (813, 1, '02.05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (814, 1, '02.06', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (815, 1, '02.07', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (816, 1, '02.08', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (817, 1, '03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (818, 1, '04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (819, 1, '04.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (820, 1, '04.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (821, 1, '04.03', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (822, 1, '04.04', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (823, 1, '04.05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (824, 1, '05', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (825, 1, '05.01', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (826, 1, '05.02', 1, 1, 1, 1, '2018-06-01 07:50:54', 'Super Retail');
INSERT INTO `ret_permission` VALUES (827, 1, '05.03', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (828, 1, '05.04', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (829, 1, '05.05', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (830, 1, '05.06', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (831, 1, '05.07', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (832, 1, '05.08', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (833, 1, '99', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (834, 1, '99.03', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (835, 1, '99.05', 1, 1, 1, 1, '2018-06-01 07:50:55', 'Super Retail');
INSERT INTO `ret_permission` VALUES (836, 2, '01', 1, 1, 1, 1, '2018-06-04 09:26:38', 'Super Retail');
INSERT INTO `ret_permission` VALUES (837, 2, '03', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Retail');
INSERT INTO `ret_permission` VALUES (838, 2, '05', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Retail');
INSERT INTO `ret_permission` VALUES (839, 2, '05.04', 1, 1, 1, 1, '2018-06-04 09:26:39', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1054, 0, '01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1055, 0, '02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1056, 0, '02.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1057, 0, '02.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1058, 0, '02.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1059, 0, '02.04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1060, 0, '02.05', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1061, 0, '02.06', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1062, 0, '02.07', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1063, 0, '02.08', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1064, 0, '03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1065, 0, '03.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1066, 0, '03.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1067, 0, '03.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1068, 0, '04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1069, 0, '04.01', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1070, 0, '04.02', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1071, 0, '04.03', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1072, 0, '04.04', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1073, 0, '04.05', 1, 1, 1, 1, '2018-06-08 09:53:19', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1074, 0, '05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1075, 0, '05.01', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1076, 0, '05.02', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1077, 0, '05.03', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1078, 0, '05.04', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1079, 0, '05.05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1080, 0, '05.06', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1081, 0, '05.07', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1082, 0, '05.08', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1083, 0, '05.09', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1084, 0, '05.10', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1085, 0, '05.11', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1086, 0, '99', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1087, 0, '99.01', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1088, 0, '99.02', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1089, 0, '99.03', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1090, 0, '99.04', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1091, 0, '99.05', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');
INSERT INTO `ret_permission` VALUES (1092, 0, '99.06', 1, 1, 1, 1, '2018-06-08 09:53:20', 'Super Retail');

-- ----------------------------
-- Table structure for ret_po
-- ----------------------------
DROP TABLE IF EXISTS `ret_po`;
CREATE TABLE `ret_po`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_po_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_po_receiver` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_status` int(1) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_po_detail
-- ----------------------------
DROP TABLE IF EXISTS `ret_po_detail`;
CREATE TABLE `ret_po_detail`  (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_demand` float(10, 2) NOT NULL,
  `stock_receive` float(10, 2) NOT NULL,
  `stock_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_promo
-- ----------------------------
DROP TABLE IF EXISTS `ret_promo`;
CREATE TABLE `ret_promo`  (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_id` int(1) NOT NULL,
  `promo_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_date_start` date NOT NULL,
  `promo_date_end` date NOT NULL,
  `promo_time_start` time(0) NOT NULL,
  `promo_time_end` time(0) NOT NULL,
  `promo_sunday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_monday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_tuesday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_wednesday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_thursday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_friday` tinyint(1) NOT NULL DEFAULT 0,
  `promo_saturday` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_promo_buyall
-- ----------------------------
DROP TABLE IF EXISTS `ret_promo_buyall`;
CREATE TABLE `ret_promo_buyall`  (
  `promo_buyall_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` float(10, 2) NOT NULL COMMENT 'in_percent',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_buyall_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_promo_buyget
-- ----------------------------
DROP TABLE IF EXISTS `ret_promo_buyget`;
CREATE TABLE `ret_promo_buyget`  (
  `promo_buyget_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_item_id` int(11) NOT NULL,
  `get_amount` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_buyget_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_promo_buyitem
-- ----------------------------
DROP TABLE IF EXISTS `ret_promo_buyitem`;
CREATE TABLE `ret_promo_buyitem`  (
  `promo_buyitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `buy_item_id` int(11) NOT NULL,
  `buy_amount` float(10, 2) NOT NULL,
  `get_discount` float(10, 2) NOT NULL COMMENT 'in_percent',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_buyitem_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_promo_type
-- ----------------------------
DROP TABLE IF EXISTS `ret_promo_type`;
CREATE TABLE `ret_promo_type`  (
  `promo_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_type_code` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo_type_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`promo_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_promo_type
-- ----------------------------
INSERT INTO `ret_promo_type` VALUES (1, 'PRB', 'Promo Buy Get', '2018-05-08 14:09:30', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_promo_type` VALUES (2, 'PRI', 'Promo Buy Item', '2018-05-08 14:09:30', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_promo_type` VALUES (3, 'PRA', 'Promo Buy All\r\n', '2018-05-08 14:09:49', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for ret_return
-- ----------------------------
DROP TABLE IF EXISTS `ret_return`;
CREATE TABLE `ret_return`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXR',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time(0) NOT NULL,
  `return_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_return_detail
-- ----------------------------
DROP TABLE IF EXISTS `ret_return_detail`;
CREATE TABLE `ret_return_detail`  (
  `return_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXR',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_after_tax` float(10, 2) NOT NULL,
  `tx_amount` float NOT NULL,
  `return_amount` float NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`return_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_role
-- ----------------------------
DROP TABLE IF EXISTS `ret_role`;
CREATE TABLE `ret_role`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_role
-- ----------------------------
INSERT INTO `ret_role` VALUES (1, 'Administrator Retail', '2018-03-30 11:18:19', 'Super Administrator', '2018-04-19 11:04:57', 'Super Administrator', 1, 0);
INSERT INTO `ret_role` VALUES (2, 'Cashier Retail', '2018-05-08 13:42:21', 'Admin Retail', '2018-05-28 22:17:09', 'Super Retail', 1, 0);
INSERT INTO `ret_role` VALUES (3, 'Super Administrator Retail', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-08 13:40:17', 'Super Administrator', 1, 0);

-- ----------------------------
-- Table structure for ret_shift
-- ----------------------------
DROP TABLE IF EXISTS `ret_shift`;
CREATE TABLE `ret_shift`  (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `shift_in_status` tinyint(1) NOT NULL,
  `shift_out_status` tinyint(1) NOT NULL,
  `shift_in_date` date NULL DEFAULT NULL,
  `shift_in_time` time(0) NULL DEFAULT NULL,
  `shift_out_date` date NULL DEFAULT NULL,
  `shift_out_time` time(0) NULL DEFAULT NULL,
  `money_in_100k` int(11) NOT NULL DEFAULT 0,
  `money_in_50k` int(11) NOT NULL DEFAULT 0,
  `money_in_20k` int(11) NOT NULL DEFAULT 0,
  `money_in_10k` int(11) NOT NULL DEFAULT 0,
  `money_in_5k` int(11) NOT NULL DEFAULT 0,
  `money_in_2k` int(11) NOT NULL DEFAULT 0,
  `money_in_1k` int(11) NOT NULL DEFAULT 0,
  `money_in_total` int(11) NOT NULL DEFAULT 0,
  `coin_in_1k` int(11) NOT NULL DEFAULT 0,
  `coin_in_500` int(11) NOT NULL DEFAULT 0,
  `coin_in_200` int(11) NOT NULL DEFAULT 0,
  `coin_in_100` int(11) NOT NULL DEFAULT 0,
  `coin_in_50` int(11) NOT NULL DEFAULT 0,
  `coin_in_25` int(11) NOT NULL DEFAULT 0,
  `coin_in_total` int(11) NOT NULL DEFAULT 0,
  `total_in` int(11) NOT NULL DEFAULT 0,
  `money_out_100k` int(11) NOT NULL DEFAULT 0,
  `money_out_50k` int(11) NOT NULL DEFAULT 0,
  `money_out_20k` int(11) NOT NULL DEFAULT 0,
  `money_out_10k` int(11) NOT NULL DEFAULT 0,
  `money_out_5k` int(11) NOT NULL DEFAULT 0,
  `money_out_2k` int(11) NOT NULL DEFAULT 0,
  `money_out_1k` int(11) NOT NULL DEFAULT 0,
  `money_out_total` int(11) NOT NULL DEFAULT 0,
  `coin_out_1k` int(11) NOT NULL DEFAULT 0,
  `coin_out_500` int(11) NOT NULL DEFAULT 0,
  `coin_out_200` int(11) NOT NULL DEFAULT 0,
  `coin_out_100` int(11) NOT NULL DEFAULT 0,
  `coin_out_50` int(11) NOT NULL DEFAULT 0,
  `coin_out_25` int(11) NOT NULL DEFAULT 0,
  `coin_out_total` int(11) NOT NULL DEFAULT 0,
  `total_out` int(11) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`shift_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_stock
-- ----------------------------
DROP TABLE IF EXISTS `ret_stock`;
CREATE TABLE `ret_stock`  (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_in` float(10, 2) NOT NULL,
  `stock_out` float(10, 2) NOT NULL,
  `stock_adjustment` float(10, 2) NOT NULL,
  `stock_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_stock_in
-- ----------------------------
DROP TABLE IF EXISTS `ret_stock_in`;
CREATE TABLE `ret_stock_in`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_stock_opname
-- ----------------------------
DROP TABLE IF EXISTS `ret_stock_opname`;
CREATE TABLE `ret_stock_opname`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_status` tinyint(1) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_stock_opname_detail
-- ----------------------------
DROP TABLE IF EXISTS `ret_stock_opname_detail`;
CREATE TABLE `ret_stock_opname_detail`  (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_last` float(10, 2) NOT NULL,
  `stock_now` float(10, 2) NOT NULL,
  `stock_adjustment` float(10, 2) NOT NULL,
  `stock_price` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_stock_out
-- ----------------------------
DROP TABLE IF EXISTS `ret_stock_out`;
CREATE TABLE `ret_stock_out`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_supplier
-- ----------------------------
DROP TABLE IF EXISTS `ret_supplier`;
CREATE TABLE `ret_supplier`  (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_fax` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supplier_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`supplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_tax
-- ----------------------------
DROP TABLE IF EXISTS `ret_tax`;
CREATE TABLE `ret_tax`  (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tax_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tax_ratio` float(10, 2) NOT NULL COMMENT 'in percent',
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tax_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_tax
-- ----------------------------
INSERT INTO `ret_tax` VALUES (1, 'PPn', 'Pajak Penjualan', 10.00, '2018-05-08 11:05:43', 'Super Administrator', '2018-05-09 08:35:14', 'System', 1, 0);

-- ----------------------------
-- Table structure for ret_tx_type
-- ----------------------------
DROP TABLE IF EXISTS `ret_tx_type`;
CREATE TABLE `ret_tx_type`  (
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`tx_type`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_tx_type
-- ----------------------------
INSERT INTO `ret_tx_type` VALUES ('TXA', 'Adjustment', '2018-04-11 13:59:45', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `ret_tx_type` VALUES ('TXI', 'In Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `ret_tx_type` VALUES ('TXO', 'Out Stock', '2018-04-10 12:56:36', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `ret_tx_type` VALUES ('TXP', 'Purchase Order\r\n', '2018-04-12 14:15:57', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `ret_tx_type` VALUES ('TXR', 'Receive Order', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', '');
INSERT INTO `ret_tx_type` VALUES ('TXS', 'Selling ', '2018-04-10 12:57:16', 'System', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for ret_unit
-- ----------------------------
DROP TABLE IF EXISTS `ret_unit`;
CREATE TABLE `ret_unit`  (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `unit_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`unit_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_unit
-- ----------------------------
INSERT INTO `ret_unit` VALUES (1, 'gr', 'Gram', '2018-06-04 09:02:07', 'System', '2018-06-04 09:02:10', '', 1, 0);
INSERT INTO `ret_unit` VALUES (2, 'kg', 'Kilogram', '2018-06-04 09:02:32', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (3, 'doz', 'Lusin', '2018-06-04 09:02:46', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (4, 'pks', 'Packs', '2018-06-04 09:03:03', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (5, 'gross', 'Gross', '2018-06-04 09:03:16', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (6, 'krtn', 'Karton', '2018-06-04 09:03:28', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (7, 'pcs', 'Pieces', '2018-05-08 13:31:41', 'System', '2018-06-04 09:01:43', '', 1, 0);

-- ----------------------------
-- Table structure for ret_user
-- ----------------------------
DROP TABLE IF EXISTS `ret_user`;
CREATE TABLE `ret_user`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_user
-- ----------------------------
INSERT INTO `ret_user` VALUES (1, 'superretail', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Retail', '2018-04-04 10:45:37', '', '2018-05-08 13:40:06', 'Super Administrator', 1, 0);
INSERT INTO `ret_user` VALUES (2, 'adminretail', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Retail', '2018-05-08 13:40:40', 'Super Administrator', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `ret_user` VALUES (4, 'cashierretail', 2, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Retail', '2018-06-04 09:27:29', 'Super Retail', '0000-00-00 00:00:00', 'System', 1, 0);

-- ----------------------------
-- Table structure for ret_void
-- ----------------------------
DROP TABLE IF EXISTS `ret_void`;
CREATE TABLE `ret_void`  (
  `tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_receipt_no` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tx_id_source` int(11) NOT NULL COMMENT 'Billing Id',
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXV',
  `user_id` int(11) NOT NULL,
  `user_realname` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tx_date` date NOT NULL,
  `tx_time` time(0) NOT NULL,
  `void_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ret_void_detail
-- ----------------------------
DROP TABLE IF EXISTS `ret_void_detail`;
CREATE TABLE `ret_void_detail`  (
  `void_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TXV',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_price_after_tax` float(10, 2) NOT NULL,
  `tx_amount` float NOT NULL,
  `void_amount` float NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`void_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
