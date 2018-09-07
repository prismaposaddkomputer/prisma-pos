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

 Date: 06/09/2018 08:24:57
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
INSERT INTO `app_install` VALUES (1, 3, 1, '2018-04-18 12:14:03', 'System', '2018-09-05 22:39:44', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of app_version
-- ----------------------------
INSERT INTO `app_version` VALUES (1, '1.0', '2018-07-05 18:00:00', '2018-09-03 07:50:59');
INSERT INTO `app_version` VALUES (2, '1.1', '2018-07-09 14:16:00', '2018-09-03 07:51:00');
INSERT INTO `app_version` VALUES (3, '1.2', '2018-07-16 11:20:00', '2018-09-03 07:51:01');
INSERT INTO `app_version` VALUES (4, '1.3', '2018-07-17 10:00:00', '2018-09-03 07:51:01');
INSERT INTO `app_version` VALUES (5, '1.4', '2018-07-17 10:41:00', '2018-09-03 07:51:04');
INSERT INTO `app_version` VALUES (6, '1.5', '2018-07-18 11:52:00', '2018-09-03 07:51:08');
INSERT INTO `app_version` VALUES (7, '1.6', '2018-07-22 19:47:00', '2018-09-03 07:51:09');
INSERT INTO `app_version` VALUES (8, '1.7', '2018-08-07 10:46:00', '2018-09-03 07:51:10');
INSERT INTO `app_version` VALUES (9, '1.8', '2018-08-07 12:12:00', '2018-09-03 07:51:10');
INSERT INTO `app_version` VALUES (10, '1.9', '2018-08-07 14:12:00', '2018-09-03 07:51:13');
INSERT INTO `app_version` VALUES (11, '2.0', '2018-08-08 11:15:00', '2018-09-03 07:51:16');
INSERT INTO `app_version` VALUES (12, '2.1', '2018-08-13 12:12:00', '2018-09-03 07:51:23');
INSERT INTO `app_version` VALUES (13, '2.2.1', '2018-08-18 09:00:00', '2018-09-03 07:51:23');
INSERT INTO `app_version` VALUES (14, '2.2.2', '2018-08-20 09:00:00', '2018-09-03 07:51:23');
INSERT INTO `app_version` VALUES (15, '2.2.3', '2018-08-21 09:40:00', '2018-09-03 07:51:25');
INSERT INTO `app_version` VALUES (16, '2.2.4', '2018-08-21 10:20:00', '2018-09-03 07:51:26');
INSERT INTO `app_version` VALUES (17, '2.2.5', '2018-08-21 10:20:00', '2018-09-03 07:51:26');
INSERT INTO `app_version` VALUES (18, '2.2.6', '2018-08-21 14:45:00', '2018-09-03 07:51:27');
INSERT INTO `app_version` VALUES (19, '2.2.7', '2018-08-21 14:56:00', '2018-09-03 07:51:27');
INSERT INTO `app_version` VALUES (20, '2.2.8', '2018-08-21 14:56:00', '2018-09-03 07:51:28');
INSERT INTO `app_version` VALUES (21, '2.2.9', '2018-08-21 15:13:00', '2018-09-03 07:51:29');
INSERT INTO `app_version` VALUES (22, '2.3.0', '2018-08-21 15:20:00', '2018-09-03 07:51:35');
INSERT INTO `app_version` VALUES (23, '2.3.1', '2018-08-22 08:30:00', '2018-09-03 07:51:35');
INSERT INTO `app_version` VALUES (24, '2.3.2', '2018-09-02 07:01:00', '2018-09-03 07:51:35');
INSERT INTO `app_version` VALUES (25, '2.3.3', '2018-09-02 07:58:00', '2018-09-03 07:51:35');
INSERT INTO `app_version` VALUES (26, '2.3.4', '2018-09-02 08:07:00', '2018-09-03 07:51:36');
INSERT INTO `app_version` VALUES (27, '2.3.5', '2018-09-02 08:15:00', '2018-09-03 07:51:37');
INSERT INTO `app_version` VALUES (28, '2.3.6', '2018-09-02 08:24:00', '2018-09-03 07:51:38');
INSERT INTO `app_version` VALUES (29, '2.3.7', '2018-09-02 08:28:00', '2018-09-03 07:51:39');
INSERT INTO `app_version` VALUES (30, '2.3.8', '2018-09-02 08:51:00', '2018-09-03 07:51:41');
INSERT INTO `app_version` VALUES (31, '2.3.9', '2018-09-02 08:56:00', '2018-09-03 07:51:42');
INSERT INTO `app_version` VALUES (32, '2.4.0', '2018-09-02 12:19:00', '2018-09-03 07:51:42');
INSERT INTO `app_version` VALUES (33, '2.4.1', '2018-09-04 18:57:00', '2018-09-05 05:18:05');

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
INSERT INTO `hot_billing` VALUES (1, '180905000001', 0, 0, 'Testing', 'L', '', 1, '', 1, 'Super Hotel', '2018-09-05', '14:00:00', '2018-09-06', '12:00:00', 2, 45454.55, 4545.45, 0.00, 0.00, 50000.00, 0, 0.00, 100000.00, 50000.00, '', 2, '2018-09-05 10:29:15', 'System', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);
INSERT INTO `hot_billing` VALUES (2, '180905000002', 0, 0, 'Testing', 'L', '', 1, '', 1, 'Super Hotel', '2018-09-05', '10:53:22', '2018-09-06', '12:00:00', 2, 90909.10, 9090.91, 0.00, 0.00, 100000.00, 0, 0.00, 100000.00, 0.00, '', 2, '2018-09-05 11:05:00', 'System', '0000-00-00 00:00:00', 'Super Restaurant', 1, 0);
INSERT INTO `hot_billing` VALUES (3, '180905000003', 0, 0, 'Piutang', 'L', '', 1, '', 1, 'Super Hotel', '2018-09-05', '13:52:02', '2018-09-06', '13:52:02', 2, 90909.10, 9090.91, 0.00, 0.00, 100000.00, 0, 0.00, 0.00, 0.00, '', 1, '2018-09-05 11:09:23', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `hot_billing` VALUES (4, '180905000004', 0, 0, '', '', '', 0, '', 0, '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', 0, '2018-09-05 15:54:46', 'System', '0000-00-00 00:00:00', '', 1, 0);

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
-- Table structure for hot_billing_non_tax
-- ----------------------------
DROP TABLE IF EXISTS `hot_billing_non_tax`;
CREATE TABLE `hot_billing_non_tax`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_billing_room
-- ----------------------------
INSERT INTO `hot_billing_room` VALUES (1, 1, 501, 'Testing - 01', 5, 'Testing', 45454.55, 1.00, 45454.55, 4545.45, 0.00, 0.00, 50000.00, '2018-09-05 10:29:55', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_billing_room` VALUES (2, 2, 501, 'Testing - 01', 5, 'Testing', 45454.55, 2.00, 90909.10, 9090.91, 0.00, 0.00, 100000.00, '2018-09-05 11:05:51', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_billing_room` VALUES (5, 3, 501, 'Testing - 01', 5, 'Testing', 45454.55, 2.00, 90909.10, 9090.91, 0.00, 0.00, 100000.00, '2018-09-05 13:52:11', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
INSERT INTO `hot_charge_type` VALUES (1, '1.1.1.01.05', 'Pajak Hotel', 10.00, 'Pajak Daerah', '2018-09-03 07:51:25', 'System', NULL, 'System', 1, 0);
INSERT INTO `hot_charge_type` VALUES (2, 'SRV', 'Servis Hotel', 10.00, 'Biaya Servis', '2018-09-03 07:51:25', 'System', '2018-09-04 15:57:49', 'Super Hotel', 0, 0);
INSERT INTO `hot_charge_type` VALUES (3, 'OTH', 'Biaya Lain-lain', 1.00, 'Biaya Lain-lain', '2018-09-03 07:51:35', 'System', '2018-09-04 15:57:42', 'Super Hotel', 0, 0);

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
INSERT INTO `hot_client` VALUES ('1', 'CV Prisma Hotel', 'Prisma Hotel', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 1, 'update-hotel-griya-persada3.png', 1, '2018-05-08 10:26:03', 'System', '2018-09-05 12:01:50', 'Super Hotel', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_discount
-- ----------------------------
INSERT INTO `hot_discount` VALUES (1, 'Diskon Akhir Tahun', 1, 10.00, '2018-09-03 08:18:31', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_discount` VALUES (2, 'Testing', 2, 50000.00, '2018-09-05 08:38:35', 'Super Hotel', '2018-09-05 08:38:49', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for hot_diskon
-- ----------------------------
DROP TABLE IF EXISTS `hot_diskon`;
CREATE TABLE `hot_diskon`  (
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
-- Table structure for hot_extra
-- ----------------------------
DROP TABLE IF EXISTS `hot_extra`;
CREATE TABLE `hot_extra`  (
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
-- Records of hot_extra
-- ----------------------------
INSERT INTO `hot_extra` VALUES (1, 'Selimut', 5000.00, '2018-09-03 08:18:08', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_extra` VALUES (2, 'Testing', 45454.55, '2018-09-05 08:37:34', 'Super Hotel', '2018-09-05 08:37:52', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for hot_fnb
-- ----------------------------
DROP TABLE IF EXISTS `hot_fnb`;
CREATE TABLE `hot_fnb`  (
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
-- Records of hot_fnb
-- ----------------------------
INSERT INTO `hot_fnb` VALUES (1, 'Ayam Geprek', 12000.00, '2018-09-03 08:18:24', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_fnb` VALUES (2, 'Testing', 45454.55, '2018-09-05 08:38:07', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);

-- ----------------------------
-- Table structure for hot_guest
-- ----------------------------
DROP TABLE IF EXISTS `hot_guest`;
CREATE TABLE `hot_guest`  (
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
-- Records of hot_guest
-- ----------------------------
INSERT INTO `hot_guest` VALUES (1, 0, 'Joko Susilo', 'L', '', '', 1, '', '2018-09-04 11:51:28', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_guest` VALUES (2, 1, 'Joko Samino', 'L', '', '', 1, '', '2018-09-04 11:51:55', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_log
-- ----------------------------
INSERT INTO `hot_log` VALUES (1, 1, 'Super Hotel', 'Sign In', '2018-09-03', '08:00:23');
INSERT INTO `hot_log` VALUES (2, 1, 'Super Hotel', 'Sign Out', '2018-09-03', '08:16:55');
INSERT INTO `hot_log` VALUES (3, 1, 'Super Hotel', 'Sign In', '2018-09-03', '08:17:03');
INSERT INTO `hot_log` VALUES (4, 1, 'Super Hotel', 'Sign In', '2018-09-03', '08:19:06');
INSERT INTO `hot_log` VALUES (5, 1, 'Super Hotel', 'Sign In', '2018-09-03', '09:31:04');
INSERT INTO `hot_log` VALUES (6, 1, 'Super Hotel', 'Sign In', '2018-09-03', '13:30:55');
INSERT INTO `hot_log` VALUES (7, 1, 'Super Hotel', 'Sign In', '2018-09-03', '16:02:10');
INSERT INTO `hot_log` VALUES (8, 1, 'Super Hotel', 'Sign Out', '2018-09-03', '16:26:59');
INSERT INTO `hot_log` VALUES (9, 3, 'Cashier Hotel', 'Sign In', '2018-09-03', '16:27:29');
INSERT INTO `hot_log` VALUES (10, 1, 'Super Hotel', 'Sign In', '2018-09-03', '18:55:42');
INSERT INTO `hot_log` VALUES (11, 1, 'Super Hotel', 'Sign Out', '2018-09-03', '18:55:47');
INSERT INTO `hot_log` VALUES (12, 1, 'Super Hotel', 'Sign In', '2018-09-03', '18:56:00');
INSERT INTO `hot_log` VALUES (13, 1, 'Super Hotel', 'Sign In', '2018-09-05', '05:18:13');
INSERT INTO `hot_log` VALUES (14, 1, 'Super Hotel', 'Sign In', '2018-09-05', '05:21:25');
INSERT INTO `hot_log` VALUES (15, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:18:03');
INSERT INTO `hot_log` VALUES (16, 1, 'Super Hotel', 'Sign Out', '2018-09-05', '07:23:16');
INSERT INTO `hot_log` VALUES (17, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:23:23');
INSERT INTO `hot_log` VALUES (18, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:23:41');
INSERT INTO `hot_log` VALUES (19, 1, 'Super Hotel', 'Sign In', '2018-09-05', '07:37:53');
INSERT INTO `hot_log` VALUES (20, 1, 'Super Hotel', 'Sign In', '2018-09-05', '08:55:48');
INSERT INTO `hot_log` VALUES (21, 1, 'Super Hotel', 'Sign Out', '2018-09-05', '14:13:41');
INSERT INTO `hot_log` VALUES (22, 1, 'Super Hotel', 'Sign In', '2018-09-05', '22:39:51');

-- ----------------------------
-- Table structure for hot_member
-- ----------------------------
DROP TABLE IF EXISTS `hot_member`;
CREATE TABLE `hot_member`  (
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
INSERT INTO `hot_module` VALUES ('02.05', '02', 'Tamu', 'hot_guest', 'hot_guest', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.06', '02', 'Pelayanan', 'hot_service', 'hot_service', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.07', '02', 'Ekstra', 'hot_extra', 'hot_extra', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.08', '02', 'FnB', 'hot_fnb', 'hot_fnb', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.09', '02', 'Diskon', 'hot_discount', 'hot_discount', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0);
INSERT INTO `hot_module` VALUES ('02.10', '02', 'Non Pajak', 'hot_non_tax', 'hot_non_tax', 'index', '', '2018-09-03 07:51:35', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
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
-- Records of hot_non_tax
-- ----------------------------
INSERT INTO `hot_non_tax` VALUES (1, 'LC', 80000.00, '2018-09-05 05:45:50', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_non_tax` VALUES (2, 'Testing', 50000.00, '2018-09-05 08:38:57', 'Super Hotel', '0000-00-00 00:00:00', 'Super Hotel', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_permission
-- ----------------------------
INSERT INTO `hot_permission` VALUES (1, 0, '01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (2, 0, '02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (3, 0, '02.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (4, 0, '02.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (5, 0, '02.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (6, 0, '02.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (7, 0, '02.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (8, 0, '02.06', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (9, 0, '02.07', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (10, 0, '02.08', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (11, 0, '02.09', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (12, 0, '03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (13, 0, '04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (14, 0, '04.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (15, 0, '04.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (16, 0, '04.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (17, 0, '04.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (18, 0, '99', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (19, 0, '99.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (20, 0, '99.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (21, 0, '99.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (22, 0, '99.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (23, 0, '99.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (24, 1, '01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (25, 1, '02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (26, 1, '02.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (27, 1, '02.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (28, 1, '02.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (29, 1, '02.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (30, 1, '02.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (31, 1, '02.06', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (32, 1, '02.07', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (33, 1, '02.08', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (34, 1, '02.09', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (35, 1, '03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (36, 1, '04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (37, 1, '04.01', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (38, 1, '04.02', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (39, 1, '04.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (40, 1, '04.04', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (41, 1, '99', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (42, 1, '99.03', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (43, 1, '99.05', 1, 1, 1, 1, '2018-09-03 07:51:23', 'System');
INSERT INTO `hot_permission` VALUES (46, 0, '02.10', 1, 1, 1, 1, '2018-09-03 07:51:35', 'System');
INSERT INTO `hot_permission` VALUES (47, 1, '02.10', 1, 1, 1, 1, '2018-09-03 07:51:35', 'System');
INSERT INTO `hot_permission` VALUES (48, 3, '01', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (49, 3, '02', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (50, 3, '02.01', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');
INSERT INTO `hot_permission` VALUES (51, 3, '03', 1, 1, 1, 1, '2018-09-03 16:26:52', 'Super Hotel');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_role
-- ----------------------------
INSERT INTO `hot_role` VALUES (0, 'Super Administrator Hotel', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-18 13:44:46', 'Super Administrator', 1, 0);
INSERT INTO `hot_role` VALUES (1, 'Administrator Hotel', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-18 13:44:51', 'Super Administrator', 1, 0);
INSERT INTO `hot_role` VALUES (3, 'Cashier Hotel', '2018-05-08 13:42:21', 'Admin Hotel', '2018-05-18 13:45:02', 'Super Retail', 1, 0);

-- ----------------------------
-- Table structure for hot_room
-- ----------------------------
DROP TABLE IF EXISTS `hot_room`;
CREATE TABLE `hot_room`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 506 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_room
-- ----------------------------
INSERT INTO `hot_room` VALUES (101, 1, 'Super - 01', '1', '2018-09-03 08:00:54', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (102, 1, 'Super - 02', '2', '2018-09-03 08:00:54', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (103, 1, 'Super - 03', '3', '2018-09-03 08:00:54', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (104, 1, 'Super - 04', '4', '2018-09-03 08:00:54', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (105, 1, 'Super - 05', '5', '2018-09-03 08:00:55', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (106, 1, 'Super - 06', '6', '2018-09-03 08:00:55', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (107, 1, 'Super - 07', '7', '2018-09-03 08:00:55', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (201, 2, 'Gold - 01', '1', '2018-09-03 14:12:58', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (202, 2, 'Gold - 02', '2', '2018-09-03 14:12:59', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (203, 2, 'Gold - 03', '3', '2018-09-03 14:12:59', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (204, 2, 'Gold - 04', '4', '2018-09-03 14:12:59', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (205, 2, 'Gold - 05', '5', '2018-09-03 14:12:59', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (206, 2, 'Gold - 06', '6', '2018-09-03 14:12:59', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (207, 2, 'Gold - 07', '7', '2018-09-03 14:12:59', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (301, 3, 'Murah - 01', '1', '2018-09-04 17:32:16', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (302, 3, 'Murah - 02', '2', '2018-09-04 17:32:17', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (303, 3, 'Murah - 03', '3', '2018-09-04 17:32:17', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (304, 3, 'Murah - 04', '4', '2018-09-04 17:32:17', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (305, 3, 'Murah - 05', '5', '2018-09-04 17:32:17', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (401, 4, 'Melati - 01', '1', '2018-09-04 20:20:05', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (402, 4, 'Melati - 02', '2', '2018-09-04 20:20:05', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (403, 4, 'Melati - 03', '3', '2018-09-04 20:20:05', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (404, 4, 'Melati - 04', '4', '2018-09-04 20:20:06', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (405, 4, 'Melati - 05', '5', '2018-09-04 20:20:06', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (406, 4, 'Melati - 06', '6', '2018-09-04 20:20:06', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (407, 4, 'Melati - 07', '7', '2018-09-04 20:20:06', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (408, 4, 'Melati - 08', '8', '2018-09-04 20:20:06', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (409, 4, 'Melati - 09', '9', '2018-09-04 20:20:06', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (410, 4, 'Melati - 10', '10', '2018-09-04 20:20:06', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (501, 5, 'Testing - 01', '1', '2018-09-05 08:35:52', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (502, 5, 'Testing - 02', '2', '2018-09-05 08:35:52', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (503, 5, 'Testing - 03', '3', '2018-09-05 08:35:52', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (504, 5, 'Testing - 04', '4', '2018-09-05 08:35:52', 'Super Hotel', NULL, 'System', 1, 0);
INSERT INTO `hot_room` VALUES (505, 5, 'Testing - 05', '5', '2018-09-05 08:35:52', 'Super Hotel', NULL, 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_room_type
-- ----------------------------
INSERT INTO `hot_room_type` VALUES (1, 'Super', 82644.63, '', '2018-09-03 08:00:54', 'System', NULL, '', 1, 0);
INSERT INTO `hot_room_type` VALUES (2, 'Gold', 45454.55, '', '2018-09-03 14:12:58', 'System', '2018-09-04 16:32:18', 'Super Hotel', 1, 0);
INSERT INTO `hot_room_type` VALUES (3, 'Murah', 45454.55, '', '2018-09-04 17:32:16', 'System', NULL, '', 1, 0);
INSERT INTO `hot_room_type` VALUES (4, 'Melati', 45454.55, '', '2018-09-04 20:20:05', 'System', NULL, '', 1, 0);
INSERT INTO `hot_room_type` VALUES (5, 'Testing', 45454.55, '', '2018-09-05 08:35:52', 'System', '2018-09-05 08:36:12', 'Super Hotel', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_service
-- ----------------------------
INSERT INTO `hot_service` VALUES (1, 'Sarapan Pagi', 18181.82, '2018-09-03 08:18:41', 'Super Hotel', '2018-09-04 15:35:17', 'Super Hotel', 1, 0);
INSERT INTO `hot_service` VALUES (2, 'Test', 45454.55, '2018-09-04 16:47:35', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_service` VALUES (3, 'Pelayanan Murah', 45454.55, '2018-09-04 17:32:35', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `hot_service` VALUES (4, 'Testing', 45454.55, '2018-09-05 08:37:02', 'Super Hotel', '2018-09-05 08:37:20', 'Super Hotel', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hot_user
-- ----------------------------
INSERT INTO `hot_user` VALUES (1, 'superhotel', 0, '21232f297a57a5a743894a0e4a801fc3', 'Super Hotel', '2018-04-04 10:45:37', 'System', '2018-09-05 07:23:32', 'System', 1, 0);
INSERT INTO `hot_user` VALUES (2, 'adminhotel', 1, '21232f297a57a5a743894a0e4a801fc3', 'Admin Hotel', '2018-05-08 13:40:40', 'System', '2018-09-05 07:23:30', 'System', 1, 0);
INSERT INTO `hot_user` VALUES (3, 'cashierhotel', 3, '21232f297a57a5a743894a0e4a801fc3', 'Cashier Hotel', '2018-05-08 13:43:54', 'System', '2018-09-05 07:23:26', 'System', 1, 0);

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
INSERT INTO `kar_client` VALUES ('1', 'CV Prisma Karaoke', 'Prisma Karaoke', 'sendiri', 'Jalan Gajahmada 56', 'Warungboto', 'Umbulharjo', 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'buat@gmail.com', '123', '123', '1234', '1234', 'Sujo', 'jalan manggis\r\n', 'Tidak ada', '1234-1234-1234', 0, 1, NULL, '2018-05-08 10:26:03', 'System', '2018-06-25 09:32:58', 'Super Karaoke', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kar_member
-- ----------------------------
DROP TABLE IF EXISTS `kar_member`;
CREATE TABLE `kar_member`  (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type_id` int(11) NOT NULL DEFAULT 0,
  `member_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_fax` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
INSERT INTO `kar_module` VALUES ('01', '', 'Dashboard', 'kar_dashboard', 'kar_dashboard', 'index', 'dashboard', '2018-04-04 10:26:27', 'Super Administrator', '2018-05-18 10:41:20', 'Super Administrator', 1, 0);
INSERT INTO `kar_module` VALUES ('02', '', 'Master', '', '', '#', 'cubes', '2018-06-01 20:12:17', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('02.01', '02', 'Waktu', 'kar_time', 'kar_time', 'index', 'clock-o', '2018-06-01 21:06:07', 'Super Karaoke', '2018-06-01 21:17:41', 'Super Karaoke', 1, 0);
INSERT INTO `kar_module` VALUES ('02.02', '02', 'Tipe Ruang', 'kar_room_type', 'kar_room_type', 'index', 'home', '2018-06-01 20:21:07', 'Super Karaoke', '2018-06-02 06:30:00', 'Super Karaoke', 1, 0);
INSERT INTO `kar_module` VALUES ('02.03', '02', 'Ruang', 'kar_room', 'kar_room', 'index', 'home', '2018-06-01 22:23:54', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('02.04', '02', 'Tipe Member', 'kar_member_type', 'kar_member_type', 'index', 'users', '2018-06-02 08:39:21', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('02.05', '02', 'Member', 'kar_member', 'kar_member', 'index', 'user', '2018-06-02 08:56:52', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('02.06', '02', 'Service Charge', 'kar_service_charge', 'kar_service_charge', 'index', 'plus', '2018-06-02 09:08:35', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('02.07', '02', 'Bank', 'kar_bank', 'kar_bank', 'index', 'university', '2018-06-02 16:20:27', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('03', '', 'Kasir', 'kar_cashier', 'kar_cashier', 'index', 'laptop', '2018-06-02 12:00:37', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('04', '', 'Laporan', '', '', 'index', 'files-o', '2018-06-03 15:38:31', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('04.01', '04', 'Penyewaan (Semua)', 'kar_report_billing', 'kar_report_billing', 'index', 'file', '2018-06-03 15:40:53', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('04.02', '04', 'Penyewaan (Kasir)', 'kar_report_billing_cashier', 'kar_report_billing_cashier', 'index', 'laptop', '2018-06-03 20:58:38', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('04.03', '04', 'Penyewaan (Member)', 'kar_report_billing_member', 'kar_report_billing_member', 'index', 'users', '2018-06-03 21:17:10', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('04.04', '04', 'Shift', 'kar_report_shift', 'kar_report_shift', 'index', 'user', '2018-06-03 21:38:26', 'Super Karaoke', '2018-06-03 21:40:01', 'Super Karaoke', 1, 0);
INSERT INTO `kar_module` VALUES ('04.05', '04', 'Log Akses', 'kar_report_log', 'kar_report_log', 'index', 'users', '2018-06-05 08:21:20', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `kar_module` VALUES ('04.06', '04', 'Piutang', 'kar_report_credit', 'kar_report_credit', 'index', 'credit-card', '2018-06-08 10:30:50', 'Super Karaoke', '2018-06-08 10:40:14', 'Super Karaoke', 1, 0);
INSERT INTO `kar_module` VALUES ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-04-04 09:41:46', 'Super Administrator', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `kar_module` VALUES ('99.01', '99', 'Modul', 'kar_module', 'kar_module', 'index', 'window-restore', '2018-04-04 09:44:01', 'Super Administrator', '2018-05-18 10:41:46', 'Super Administrator', 1, 0);
INSERT INTO `kar_module` VALUES ('99.02', '99', 'Role', 'kar_role', 'kar_role', 'index', 'users', '2018-04-04 09:46:50', 'Super Administrator', '2018-05-18 10:41:49', 'Super Administrator', 1, 0);
INSERT INTO `kar_module` VALUES ('99.03', '99', 'Pengguna', 'kar_user', 'kar_user', 'index', '', '2018-04-04 10:37:41', 'Super Administrator', '2018-05-18 10:41:52', 'Super Administrator', 1, 0);
INSERT INTO `kar_module` VALUES ('99.04', '99', 'Hak Akses', 'kar_permission', 'kar_permission', 'index', 'list', '2018-04-05 08:20:56', 'Super Administrator', '2018-05-18 10:41:55', '', 1, 0);
INSERT INTO `kar_module` VALUES ('99.05', '99', 'Client', 'kar_client', 'kar_client', 'index', 'th-large', '2018-04-05 17:31:04', 'Super Administrator', '2018-05-18 10:41:58', 'Super Administrator', 1, 0);
INSERT INTO `kar_module` VALUES ('99.06', '99', 'Struk', 'kar_receipt', 'kar_receipt', 'index', 'print', '2018-06-07 09:27:58', 'Super Karaoke', '0000-00-00 00:00:00', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 902 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_permission
-- ----------------------------
INSERT INTO `kar_permission` VALUES (878, 0, '01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (879, 0, '02', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (880, 0, '02.01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (881, 0, '02.02', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (882, 0, '02.03', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (883, 0, '02.04', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (884, 0, '02.05', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (885, 0, '02.06', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (886, 0, '02.07', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (887, 0, '03', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (888, 0, '04', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (889, 0, '04.01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (890, 0, '04.02', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (891, 0, '04.03', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (892, 0, '04.04', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (893, 0, '04.05', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (894, 0, '04.06', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (895, 0, '99', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (896, 0, '99.01', 1, 1, 1, 1, '2018-06-08 10:39:00', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (897, 0, '99.02', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (898, 0, '99.03', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (899, 0, '99.04', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (900, 0, '99.05', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (901, 0, '99.06', 1, 1, 1, 1, '2018-06-08 10:39:01', 'Super Karaoke');

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
INSERT INTO `kar_role` VALUES (0, 'Super Administrator Karaoke', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-18 10:44:11', 'Super Administrator', 1, 0);
INSERT INTO `kar_role` VALUES (1, 'Administrator Karaoke', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-18 10:44:21', 'Super Administrator', 1, 0);
INSERT INTO `kar_role` VALUES (2, 'Cashier Karaoke', '2018-05-08 13:42:21', 'Admin Retail', '2018-06-03 21:04:44', 'Super Retail', 1, 0);
INSERT INTO `kar_role` VALUES (5, 'a', '2018-05-18 10:44:41', 'Super Karaoke', '2018-05-18 10:44:44', 'System', 1, 1);

-- ----------------------------
-- Table structure for kar_room
-- ----------------------------
DROP TABLE IF EXISTS `kar_room`;
CREATE TABLE `kar_room`  (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_code` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `room_is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
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
  `room_type_capacity` int(11) NOT NULL,
  `weekday_happy_hours` float(10, 2) NOT NULL,
  `weekday_business_hours` float(10, 2) NOT NULL,
  `weekend_happy_hours` float(10, 2) NOT NULL,
  `weekend_business_hours` float(10, 2) NOT NULL,
  `holiday_happy_hours` float(10, 2) NOT NULL,
  `holiday_business_hours` float(10, 2) NOT NULL,
  `created` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `updated` timestamp(0) NOT NULL,
  `updated_by` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`room_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of par_brand
-- ----------------------------
INSERT INTO `par_brand` VALUES (0, 'Lainnya\r\n', '2018-05-22 10:20:18', 'System', '2018-07-05 15:42:49', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of par_role
-- ----------------------------
INSERT INTO `par_role` VALUES (0, 'Super Administrator Parking', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-17 13:50:14', 'Super Administrator', 1, 0);
INSERT INTO `par_role` VALUES (1, 'Administrator Parking', '2018-03-30 11:18:19', 'Super Administrator', '2018-05-17 13:50:10', 'Super Administrator', 1, 0);
INSERT INTO `par_role` VALUES (2, 'Cashier Parking In', '2018-05-08 13:42:21', 'Admin Retail', '2018-07-05 15:43:44', 'Super Parking', 1, 0);
INSERT INTO `par_role` VALUES (3, 'Cashier Parking Out', '2018-05-24 15:03:20', 'Super Parking', '2018-07-05 15:43:47', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_billing
-- ----------------------------
INSERT INTO `res_billing` VALUES (1, '180905000001', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-09-05', '14:21:36', '', 1, 20000.00, 1, NULL, 0, '', '', 0.00, 1727.28, 0.00, 17272.72, 19000.00, 19000.00, 1000.00, 17272.72, 15545.44, '2018-09-05 14:21:55', 'Super Restaurant', '2018-09-05 14:24:14', 'Super Restaurant', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (2, '180905000002', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-09-05', '14:24:15', '', 0, 0.00, -2, '', 0, '', '', 0.00, 28636.36, 0.00, 286363.56, 314999.91, 314999.91, 0.00, 286363.56, 257727.20, '2018-09-05 14:25:24', 'Super Restaurant', '2018-09-05 14:25:36', 'Super Restaurant', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (3, '180905000003', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-09-05', '14:25:37', '', 0, 0.00, -2, '', 0, '', '', 0.00, 28636.36, 0.00, 286363.56, 314999.91, 314999.91, 0.00, 286363.56, 257727.20, '2018-09-05 14:25:40', 'Super Restaurant', '2018-09-05 14:25:49', 'Super Restaurant', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (4, '180905000004', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-09-05', '14:25:49', '', 0, 0.00, -2, '', 0, '', '', 0.00, 43636.35, 0.00, 436363.53, 479999.88, 479999.88, 0.00, 436363.53, 392727.16, '2018-09-05 14:25:56', 'Super Restaurant', '2018-09-05 14:26:02', 'Super Restaurant', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (5, '180905000005', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-09-05', '14:26:02', '', 0, 0.00, -2, '', 0, '', '', 0.00, 15000.00, 0.00, 149999.95, 164999.95, 164999.95, 0.00, 149999.95, 134999.95, '2018-09-05 14:27:05', 'Super Restaurant', '2018-09-05 14:27:31', 'Super Restaurant', 1, 0, 0, NULL);
INSERT INTO `res_billing` VALUES (6, '180905000006', 1, 'Super Restaurant', 1, 'Umum', 'TXS', '2018-09-05', '14:27:31', '', 0, 0.00, -1, NULL, 0, '', '', 0.00, 15000.00, 0.00, 149999.95, 164999.95, 164999.95, 0.00, 149999.95, 134999.95, '2018-09-05 14:27:45', 'Super Restaurant', '2018-09-05 14:35:38', 'Super Restaurant', 1, 0, 0, NULL);

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
INSERT INTO `res_billing_detail` VALUES (1, 1, 'TXS', 1, 'Ayam Geprek', 13636.36, 15000.00, 0.00, 1, 1363.64, 0.00, 0.00, 13636.36, 15000.00, 13636.36, 12272.72, '2018-09-05 14:21:55', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (2, 1, 'TXS', 2, 'Es Teh', 1818.18, 2000.00, 0.00, 2, 363.64, 0.00, 0.00, 3636.36, 4000.00, 3636.36, 3272.72, '2018-09-05 14:24:01', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (3, 2, 'TXS', 1, 'Ayam Geprek', 13636.36, 15000.00, 0.00, 21, 28636.36, 0.00, 0.00, 286363.56, 314999.91, 286363.56, 257727.20, '2018-09-05 14:25:24', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (4, 3, 'TXS', 1, 'Ayam Geprek', 13636.36, 15000.00, 0.00, 21, 28636.36, 0.00, 0.00, 286363.56, 314999.91, 286363.56, 257727.20, '2018-09-05 14:25:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (5, 4, 'TXS', 1, 'Ayam Geprek', 13636.36, 15000.00, 0.00, 32, 43636.35, 0.00, 0.00, 436363.53, 479999.88, 436363.53, 392727.16, '2018-09-05 14:25:56', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (6, 5, 'TXS', 1, 'Ayam Geprek', 13636.36, 15000.00, 0.00, 11, 15000.00, 0.00, 0.00, 149999.95, 164999.95, 149999.95, 134999.95, '2018-09-05 14:27:05', 'System', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_billing_detail` VALUES (7, 6, 'TXS', 1, 'Ayam Geprek', 13636.36, 15000.00, 0.00, 11, 15000.00, 0.00, 0.00, 149999.95, 164999.95, 149999.95, 134999.95, '2018-09-05 14:27:45', 'System', '0000-00-00 00:00:00', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_category
-- ----------------------------
INSERT INTO `res_category` VALUES (0, 'Tidak Terkategori', '2018-05-08 13:26:31', 'System', '2018-05-08 13:26:44', 'System', 1, 0);
INSERT INTO `res_category` VALUES (1, 'Makanan', '2018-09-05 14:18:29', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_category` VALUES (2, 'Makanan', '2018-09-05 14:18:33', 'Super Restaurant', '2018-09-05 14:18:36', 'System', 1, 1);
INSERT INTO `res_category` VALUES (3, 'Minuman', '2018-09-05 14:18:41', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);

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
INSERT INTO `res_customer` VALUES (1, 'Umum', '1', '', '', '', '2018-09-05 14:21:06', 'Super Restaurant', '0000-00-00 00:00:00', '', 1, 0);

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
INSERT INTO `res_item` VALUES (1, 1, 0, 1, 'Ayam Geprek', '01', '', 13636.36, 1364.00, 15000.00, 0, '2018-09-05 14:19:38', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);
INSERT INTO `res_item` VALUES (2, 3, 0, 1, 'Es Teh', '02', '', 1818.18, 181.82, 2000.00, 0, '2018-09-05 14:20:54', 'Super Restaurant', '0000-00-00 00:00:00', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_log
-- ----------------------------
INSERT INTO `res_log` VALUES (1, 1, 'Super Restaurant', 'Sign In', '2018-09-05', '14:14:05');

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
INSERT INTO `res_permission` VALUES (1, 0, '01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (2, 0, '02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (3, 0, '02.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (4, 0, '02.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (5, 0, '02.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (6, 0, '02.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (7, 0, '02.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (8, 0, '02.06', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (9, 0, '02.07', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (10, 0, '02.08', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (11, 0, '03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (12, 0, '03.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (13, 0, '03.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (14, 0, '03.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (15, 0, '04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (16, 0, '04.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (17, 0, '04.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (18, 0, '04.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (19, 0, '04.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (20, 0, '04.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (21, 0, '05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (22, 0, '05.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (23, 0, '05.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (24, 0, '05.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (25, 0, '05.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (26, 0, '05.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (27, 0, '05.06', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (28, 0, '05.07', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (29, 0, '05.08', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (30, 0, '05.09', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (31, 0, '05.10', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (32, 0, '05.11', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (33, 0, '99', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (34, 0, '99.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (35, 0, '99.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (36, 0, '99.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (37, 0, '99.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (38, 0, '99.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (39, 0, '99.06', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (40, 1, '01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (41, 1, '02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (42, 1, '02.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (43, 1, '02.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (44, 1, '02.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (45, 1, '02.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (46, 1, '02.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (47, 1, '02.06', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (48, 1, '02.08', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (49, 1, '03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (50, 1, '03.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (51, 1, '03.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (52, 1, '03.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (53, 1, '04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (54, 1, '04.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (55, 1, '04.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (56, 1, '04.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (57, 1, '04.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (58, 1, '04.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (59, 1, '05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (60, 1, '05.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (61, 1, '05.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (62, 1, '05.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (63, 1, '05.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (64, 1, '05.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (65, 1, '05.06', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (66, 1, '05.07', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (67, 1, '05.08', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (68, 1, '05.09', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (69, 1, '05.10', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (70, 1, '05.11', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (71, 1, '99', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (72, 1, '99.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (73, 1, '99.05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (74, 2, '01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (75, 2, '03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (76, 2, '03.01', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (77, 2, '03.02', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (78, 2, '03.03', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (79, 2, '05', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');
INSERT INTO `res_permission` VALUES (80, 2, '05.04', 1, 1, 1, 1, '2018-09-03 07:51:09', 'System');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_role
-- ----------------------------
INSERT INTO `res_role` VALUES (0, 'Super Administrator Restaurant', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-08 13:40:17', 'Super Administrator', 1, 0);
INSERT INTO `res_role` VALUES (1, 'Administrator Restaurant', '2018-03-30 11:18:19', 'Super Administrator', '2018-04-19 11:04:57', 'Super Administrator', 1, 0);
INSERT INTO `res_role` VALUES (2, 'Cashier Restaurant', '2018-05-08 13:42:21', 'Admin Restaurant', '2018-05-28 22:17:09', 'Super Restaurant', 1, 0);

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
INSERT INTO `res_shift` VALUES (1, 1, 'Super Restaurant', 1, 0, '2018-09-05', '14:21:35', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-09-05 14:21:35', 'Super Restaurant', '0000-00-00 00:00:00', 'System');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_stock
-- ----------------------------
INSERT INTO `res_stock` VALUES (1, 1, 'TXS', '2018-09-05', 1, 0.00, -1.00, 0.00, 0.00, '2018-09-05 14:24:15', 'Super Restaurant');
INSERT INTO `res_stock` VALUES (2, 1, 'TXS', '2018-09-05', 2, 0.00, -2.00, 0.00, 0.00, '2018-09-05 14:24:15', 'Super Restaurant');

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of res_unit
-- ----------------------------
INSERT INTO `res_unit` VALUES (0, 'pcs', 'Pieces', '2018-05-08 13:31:41', 'System', '2018-06-04 09:01:43', '', 1, 0);
INSERT INTO `res_unit` VALUES (1, 'gr', 'Gram', '2018-06-04 09:02:07', 'System', '2018-06-04 09:02:10', '', 1, 0);
INSERT INTO `res_unit` VALUES (2, 'kg', 'Kilogram', '2018-06-04 09:02:32', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (3, 'doz', 'Lusin', '2018-06-04 09:02:46', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (4, 'pks', 'Packs', '2018-06-04 09:03:03', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (5, 'gross', 'Gross', '2018-06-04 09:03:16', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `res_unit` VALUES (6, 'krtn', 'Karton', '2018-06-04 09:03:28', 'System', '0000-00-00 00:00:00', '', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_category
-- ----------------------------
INSERT INTO `ret_category` VALUES (0, 'Tidak Terkategori', '2018-05-08 13:26:31', 'System', '2018-05-08 13:26:44', 'System', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_customer
-- ----------------------------
INSERT INTO `ret_customer` VALUES (0, 'Umum', '1234567890', '1234567890', 'umum@umum.com', 'Umum', '2018-05-08 11:07:30', 'Super Administrator', '2018-05-08 13:33:20', '', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_role
-- ----------------------------
INSERT INTO `ret_role` VALUES (0, 'Super Administrator Retail', '2018-03-30 11:16:36', 'Super Administrator', '2018-05-08 13:40:17', 'Super Administrator', 1, 0);
INSERT INTO `ret_role` VALUES (1, 'Administrator Retail', '2018-03-30 11:18:19', 'Super Administrator', '2018-04-19 11:04:57', 'Super Administrator', 1, 0);
INSERT INTO `ret_role` VALUES (2, 'Cashier Retail', '2018-05-08 13:42:21', 'Admin Retail', '2018-05-28 22:17:09', 'Super Retail', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ret_unit
-- ----------------------------
INSERT INTO `ret_unit` VALUES (0, 'pcs', 'Pieces', '2018-05-08 13:31:41', 'System', '2018-06-04 09:01:43', '', 1, 0);
INSERT INTO `ret_unit` VALUES (1, 'gr', 'Gram', '2018-06-04 09:02:07', 'System', '2018-06-04 09:02:10', '', 1, 0);
INSERT INTO `ret_unit` VALUES (2, 'kg', 'Kilogram', '2018-06-04 09:02:32', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (3, 'doz', 'Lusin', '2018-06-04 09:02:46', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (4, 'pks', 'Packs', '2018-06-04 09:03:03', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (5, 'gross', 'Gross', '2018-06-04 09:03:16', 'System', '0000-00-00 00:00:00', '', 1, 0);
INSERT INTO `ret_unit` VALUES (6, 'krtn', 'Karton', '2018-06-04 09:03:28', 'System', '0000-00-00 00:00:00', '', 1, 0);

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
