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

 Date: 07/09/2018 11:18:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 125 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kar_permission
-- ----------------------------
INSERT INTO `kar_permission` VALUES (77, 0, '01', 1, 1, 1, 1, '2018-09-06 12:10:36', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (78, 0, '02', 1, 1, 1, 1, '2018-09-06 12:10:36', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (79, 0, '02.01', 1, 1, 1, 1, '2018-09-06 12:10:36', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (80, 0, '02.02', 1, 1, 1, 1, '2018-09-06 12:10:36', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (81, 0, '02.03', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (82, 0, '02.04', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (83, 0, '02.05', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (84, 0, '02.06', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (85, 0, '02.07', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (86, 0, '02.08', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (87, 0, '02.09', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (88, 0, '03', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (89, 0, '04', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (90, 0, '04.01', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (91, 0, '04.02', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (92, 0, '04.03', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (93, 0, '04.04', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (94, 0, '99', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (95, 0, '99.01', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (96, 0, '99.02', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (97, 0, '99.03', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (98, 0, '99.04', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (99, 0, '99.05', 1, 1, 1, 1, '2018-09-06 12:10:37', 'Super Karaoke');
INSERT INTO `kar_permission` VALUES (100, 1, '01', 1, 1, 1, 1, '2018-09-07 11:18:01', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (101, 1, '02', 1, 1, 1, 1, '2018-09-07 11:18:01', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (102, 1, '02.01', 1, 1, 1, 1, '2018-09-07 11:18:01', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (103, 1, '02.02', 1, 1, 1, 1, '2018-09-07 11:18:01', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (104, 1, '02.03', 1, 1, 1, 1, '2018-09-07 11:18:01', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (105, 1, '02.04', 1, 1, 1, 1, '2018-09-07 11:18:01', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (106, 1, '02.05', 1, 1, 1, 1, '2018-09-07 11:18:01', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (107, 1, '02.06', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (108, 1, '02.07', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (109, 1, '02.08', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (110, 1, '02.09', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (111, 1, '03', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (112, 1, '04', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (113, 1, '04.01', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (114, 1, '04.02', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (115, 1, '04.03', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (116, 1, '04.04', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (117, 1, '99', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (118, 1, '99.01', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (119, 1, '99.02', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (120, 1, '99.03', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (121, 1, '99.04', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (122, 1, '99.05', 1, 1, 1, 1, '2018-09-07 11:18:02', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (123, 3, '01', 1, 1, 1, 1, '2018-09-07 11:18:21', 'Super Hotel');
INSERT INTO `kar_permission` VALUES (124, 3, '03', 1, 1, 1, 1, '2018-09-07 11:18:21', 'Super Hotel');

SET FOREIGN_KEY_CHECKS = 1;
