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

 Date: 28/05/2018 09:22:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for slider
-- ----------------------------
DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider`  (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`slider_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of slider
-- ----------------------------
INSERT INTO `slider` VALUES (1, 'Logo đối tác', '');
INSERT INTO `slider` VALUES (2, 'Banner main', '');
INSERT INTO `slider` VALUES (3, 'Banner bottom', '');

-- ----------------------------
-- Table structure for slider_image
-- ----------------------------
DROP TABLE IF EXISTS `slider_image`;
CREATE TABLE `slider_image`  (
  `slider_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`slider_image_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of slider_image
-- ----------------------------
INSERT INTO `slider_image` VALUES (12, 1, 'upload/images/doi-tac/b-logo1.png', '', '', '', 3);
INSERT INTO `slider_image` VALUES (13, 1, 'upload/images/doi-tac/b-logo2.png', '', '', '', 4);
INSERT INTO `slider_image` VALUES (14, 1, 'upload/images/doi-tac/b-logo3.png', '', '', '', 5);
INSERT INTO `slider_image` VALUES (15, 1, 'upload/images/doi-tac/b-logo4.png', '', '', '', 6);
INSERT INTO `slider_image` VALUES (17, 1, 'upload/images/doi-tac/b-logo5.png', '', '', '', 7);
INSERT INTO `slider_image` VALUES (18, 1, 'upload/images/doi-tac/b-logo6.png', '', '', '', 8);
INSERT INTO `slider_image` VALUES (19, 3, 'upload/images/slider/thumb1.jpg', '', '', 'http://localhost/my_tool', 999);
INSERT INTO `slider_image` VALUES (20, 3, 'upload/images/slider/thumb2.jpg', '', '', 'http://localhost/my_tool', 999);
INSERT INTO `slider_image` VALUES (22, 3, 'upload/images/slider/thumb3.jpg', '', '', 'http://localhost/my_tool', 999);
INSERT INTO `slider_image` VALUES (25, 2, 'upload/images/slider/banner1.jpg', '', '', 'http://localhost/my_tool', 999);
INSERT INTO `slider_image` VALUES (26, 2, 'upload/images/slider/banner2.jpg', '', '', 'http://localhost/my_tool', 999);
INSERT INTO `slider_image` VALUES (27, 2, 'upload/images/slider/banner3.jpg', '', '', 'http://localhost/my_tool', 999);
INSERT INTO `slider_image` VALUES (28, 2, 'upload/images/slider/banner4.jpg', '', '', 'http://localhost/my_tool', 999);
INSERT INTO `slider_image` VALUES (30, 1, 'upload/images/doi-tac/b-logo7.png', '', '', '', 999);
INSERT INTO `slider_image` VALUES (31, 1, 'upload/images/doi-tac/b-logo8.png', '', '', '', 999);

SET FOREIGN_KEY_CHECKS = 1;
