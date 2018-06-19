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

 Date: 28/05/2018 09:24:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for newsletter
-- ----------------------------
DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter`  (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `subscribe` tinyint(4) NULL DEFAULT 1,
  `crt_date` datetime(0) NULL DEFAULT NULL,
  `crt_by` int(11) NULL DEFAULT NULL,
  `mod_date` datetime(0) NULL DEFAULT NULL,
  `mod_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`newsletter_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of newsletter
-- ----------------------------
INSERT INTO `newsletter` VALUES (1, 'taipv1984@gmail.com', 1, '2016-12-27 22:16:11', 0, NULL, NULL);
INSERT INTO `newsletter` VALUES (2, 'huyen@gmail.com', 1, '2016-12-30 09:03:29', 1, NULL, NULL);
INSERT INTO `newsletter` VALUES (6, 'taipv1984@gmail.com12', 1, '2016-12-30 21:32:03', 2, NULL, NULL);
INSERT INTO `newsletter` VALUES (7, 'lamthuyet@gmail.com', 1, '2017-05-05 11:13:23', 0, NULL, NULL);
INSERT INTO `newsletter` VALUES (8, 'thuyetlam@my_tool.vn', 1, '2017-05-06 10:54:14', 0, NULL, NULL);
INSERT INTO `newsletter` VALUES (9, '3@3', 1, '2017-08-30 10:13:03', 0, NULL, NULL);

-- ----------------------------
-- Table structure for newsletter_email_template
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_email_template`;
CREATE TABLE `newsletter_email_template`  (
  `newsletter_email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`newsletter_email_template_id`) USING BTREE,
  UNIQUE INDEX `key_UNIQUE`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of newsletter_email_template
-- ----------------------------
INSERT INTO `newsletter_email_template` VALUES (1, 'khuyen_mai_cuoi_nam', 'Sản phẩm giảm giá cuối năm', '<div style=\"margin: 0px; padding: 0px;\">Vua Gốm Sứ company xin thông báo các sp giảm giá cuối năm</div>\r\n<div style=\"margin: 0px; padding: 0px;\">gồm</div>\r\n<div style=\"margin: 0px; padding: 0px;\"> </div>\r\n<div style=\"margin: 0px; padding: 0px;\">chén nước</div>\r\n<div style=\"margin: 0px; padding: 0px;\">tranh sơn thủy</div>\r\n<div style=\"margin: 0px; padding: 0px;\">...</div>');

SET FOREIGN_KEY_CHECKS = 1;
