/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100121
 Source Host           : 127.0.0.1:3306
 Source Schema         : my_tool

 Target Server Type    : MySQL
 Target Server Version : 100121
 File Encoding         : 65001

 Date: 28/05/2018 09:27:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact`  (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NULL DEFAULT 0,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `subject` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `status` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'pending',
  `crt_date` datetime(0) NULL DEFAULT NULL,
  `crt_by` int(11) NULL DEFAULT NULL,
  `mod_date` datetime(0) NULL DEFAULT NULL,
  `mod_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`contact_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of contact
-- ----------------------------
INSERT INTO `contact` VALUES (1, 0, 'nam', 'email@gmail.com', '123', 'address', 'subject', 'message', 'pending', '2017-01-04 15:16:21', 1, NULL, NULL);
INSERT INTO `contact` VALUES (2, 0, 'nam', 'email@gmail.com', '123', 'address', 'subject', 'message', 'pending', '2017-01-04 15:17:50', 1, NULL, NULL);
INSERT INTO `contact` VALUES (3, 1, 'Phạm Văn Tài ', 'taipv1984@gmail.com', '0962628801', 'Hai Phong', 'customer contact', 'customer message', 'watched', '2017-01-04 15:40:48', 1, '2017-01-04 16:25:11', 1);
INSERT INTO `contact` VALUES (6, 1, 'Phạm Tăn Tài', 'taipv1984.customer@gmail.com', '0962628801', '123', '', '', 'pending', '2017-01-04 17:00:03', 1, NULL, NULL);
INSERT INTO `contact` VALUES (7, 0, 'nam', 'taipv1984@gmail.com', '123', '456', '789', 'message', 'pending', '2017-01-04 17:12:11', 0, NULL, NULL);
INSERT INTO `contact` VALUES (8, 1, 'Phạm Tăn Tài', 'taipv1984.customer@gmail.com', '0962628801', '123', 'test logined', 'ok or not ok?', 'pending', '2017-01-04 17:26:25', 1, NULL, NULL);
INSERT INTO `contact` VALUES (9, 0, 'tai', 'taipv1984@gmail.com', '1', '2', '3', '4', 'pending', '2017-01-09 23:04:35', 0, NULL, NULL);
INSERT INTO `contact` VALUES (10, 0, '1', 'taipv1984@gmail.com', '2', '3', '4', '5', 'pending', '2017-01-09 23:07:04', 0, NULL, NULL);
INSERT INTO `contact` VALUES (11, 0, 'tai', 'taipv1984@gmail.com', '123', '456', '789', '', 'pending', '2017-07-13 10:25:27', 0, NULL, NULL);
INSERT INTO `contact` VALUES (12, 0, '1', 'taipv1984@gmail.com', '1', '2', '3', '4', 'pending', '2017-07-13 10:30:40', 0, NULL, NULL);
INSERT INTO `contact` VALUES (13, 0, 'ta', 'taipv1984@gmail.com', '1', '2', '3', '4', 'pending', '2017-07-13 10:33:22', 0, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
