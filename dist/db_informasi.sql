/*
 Navicat Premium Dump SQL

 Source Server         : Lokal
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_informasi

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 10/10/2025 14:55:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for grade
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade`  (
  `id_grade` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `line` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lot` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `checked` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_grade`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of grade
-- ----------------------------

-- ----------------------------
-- Table structure for grade_b
-- ----------------------------
DROP TABLE IF EXISTS `grade_b`;
CREATE TABLE `grade_b`  (
  `id_grade` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `line` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lot` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `checked` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_grade`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of grade_b
-- ----------------------------

-- ----------------------------
-- Table structure for infoqc
-- ----------------------------
DROP TABLE IF EXISTS `infoqc`;
CREATE TABLE `infoqc`  (
  `id_grade` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `line` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lot` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `checked` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_grade`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of infoqc
-- ----------------------------

-- ----------------------------
-- Table structure for std
-- ----------------------------
DROP TABLE IF EXISTS `std`;
CREATE TABLE `std`  (
  `id_dokumen` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `departemen` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `video` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of std
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for wi
-- ----------------------------
DROP TABLE IF EXISTS `wi`;
CREATE TABLE `wi`  (
  `id_dokumen` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `departemen` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `video` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of wi
-- ----------------------------
INSERT INTO `wi` VALUES ('WI-ITE-13-00 ', 'PETUNJUK MENYAMBUNGKAN PERANGKAT KE INFOCUS RUANG TRAINING', 'PGA IT', 'WI MENYAMBUNGKAN PERANGKAT KE INFOCUS RUANG TRAINING', '', '2025', 'pdfWI-ITE-13-00 .pdf', 'Aktif', 'video-WI-ITE-13-00 .mp4');

SET FOREIGN_KEY_CHECKS = 1;
