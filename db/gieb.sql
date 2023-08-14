/*
 Navicat Premium Data Transfer

 Source Server         : db3
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3310
 Source Schema         : gieb

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 14/08/2023 21:35:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mform
-- ----------------------------
DROP TABLE IF EXISTS `mform`;
CREATE TABLE `mform`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detail_created` datetime(0) NULL DEFAULT NULL,
  `date_modified` datetime(0) NULL DEFAULT NULL,
  `app` int(11) NULL DEFAULT NULL,
  `app1` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mform
-- ----------------------------
INSERT INTO `mform` VALUES (2, '001/VII/2023', '2023-07-31 10:57:07', '2023-07-31 10:57:07', 1, '2023-07-31 10:58:11');
INSERT INTO `mform` VALUES (3, '001/VIII/2023', '2023-08-03 04:17:15', '2023-08-03 04:17:15', 0, '2023-08-14 13:03:41');

-- ----------------------------
-- Table structure for muser
-- ----------------------------
DROP TABLE IF EXISTS `muser`;
CREATE TABLE `muser`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of muser
-- ----------------------------
INSERT INTO `muser` VALUES (1, 'admin', '$2y$10$PuMnzjUHri9F87tBUyxRROFR82t10yXEHLfgfpc2Dy1LNc9KkSXBG');
INSERT INTO `muser` VALUES (2, 'head', '$2y$10$PuMnzjUHri9F87tBUyxRROFR82t10yXEHLfgfpc2Dy1LNc9KkSXBG');

-- ----------------------------
-- Table structure for vform
-- ----------------------------
DROP TABLE IF EXISTS `vform`;
CREATE TABLE `vform`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mform` int(11) NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `budget` double NULL DEFAULT NULL,
  `detail_created` datetime(0) NULL DEFAULT NULL,
  `date_modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vform
-- ----------------------------
INSERT INTO `vform` VALUES (2, 2, 'Coba1', 100000, '2023-07-31 10:57:14', '2023-07-31 10:57:14');
INSERT INTO `vform` VALUES (3, 2, 'coba2', 25000, '2023-07-31 10:57:14', '2023-07-31 10:57:14');
INSERT INTO `vform` VALUES (4, 3, 'Keperluan atk toko bulan agustus 2023', 500000, '2023-08-14 13:03:41', '2023-08-14 13:03:41');

SET FOREIGN_KEY_CHECKS = 1;
