/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : vdato_empty

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-20 08:36:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for help_cat
-- ----------------------------
DROP TABLE IF EXISTS `help_cat`;
CREATE TABLE `help_cat` (
  `help_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`help_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of help_cat
-- ----------------------------
INSERT INTO `help_cat` VALUES ('1', 'Tổng quan', '', 'A');
INSERT INTO `help_cat` VALUES ('2', 'Trang chủ', '', 'A');
INSERT INTO `help_cat` VALUES ('3', 'Dashboard', null, 'A');
INSERT INTO `help_cat` VALUES ('11', 'Quản lý setting', null, 'A');
INSERT INTO `help_cat` VALUES ('12', 'Quản lý role', null, 'A');
INSERT INTO `help_cat` VALUES ('13', 'Quản lý file', null, 'A');
INSERT INTO `help_cat` VALUES ('14', 'Quản lý help', null, 'A');
INSERT INTO `help_cat` VALUES ('15', 'Quản lý language', null, 'D');
INSERT INTO `help_cat` VALUES ('16', 'Quản lý language translate', null, 'D');
INSERT INTO `help_cat` VALUES ('17', 'Quản lý email template', null, 'D');
INSERT INTO `help_cat` VALUES ('18', 'Quản lý layout', null, 'D');
INSERT INTO `help_cat` VALUES ('19', 'Quản lý plugin', null, 'D');
