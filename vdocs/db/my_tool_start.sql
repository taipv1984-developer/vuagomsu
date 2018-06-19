/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 100121
 Source Host           : localhost:3306
 Source Schema         : my_tool

 Target Server Type    : MySQL
 Target Server Version : 100121
 File Encoding         : 65001

 Date: 31/01/2018 21:54:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `language_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'en',
  `crt_date` datetime(0) NULL DEFAULT NULL,
  `crt_by` int(11) NULL DEFAULT NULL,
  `mod_date` datetime(0) NULL DEFAULT NULL,
  `mod_by` int(11) NULL DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `login_false` tinyint(4) NULL DEFAULT 0,
  `active_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'my_tool@gmail.com', 'en', NULL, NULL, NULL, NULL, 'A', 0, '');

-- ----------------------------
-- Table structure for admin_detail
-- ----------------------------
DROP TABLE IF EXISTS `admin_detail`;
CREATE TABLE `admin_detail`  (
  `admin_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `gender` tinyint(4) NULL DEFAULT 1 COMMENT '=1(male) else =0(female)',
  `birthday` date NULL DEFAULT NULL,
  PRIMARY KEY (`admin_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_detail
-- ----------------------------
INSERT INTO `admin_detail` VALUES (1, 1, 'Admin', '123456', 'address', 'upload/images/admin.png', 1, '1984-10-27');

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city`  (
  `city_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`city_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES (3, 'TP.HCM', 2, 242, 0);
INSERT INTO `city` VALUES (2, 'Hà Nội', 1, 242, 0);
INSERT INTO `city` VALUES (10, 'Yên Bái', 999, 242, 0);
INSERT INTO `city` VALUES (11, 'Vĩnh Phúc', 999, 242, 0);
INSERT INTO `city` VALUES (12, 'Vĩnh Long', 999, 242, 0);
INSERT INTO `city` VALUES (13, 'Tuyên Quang', 999, 242, 0);
INSERT INTO `city` VALUES (14, 'Trà Vinh', 999, 242, 0);
INSERT INTO `city` VALUES (15, 'Tiền Giang', 999, 242, 0);
INSERT INTO `city` VALUES (16, 'Thừa Thiên Huế', 999, 242, 0);
INSERT INTO `city` VALUES (17, 'Thanh Hóa', 999, 242, 0);
INSERT INTO `city` VALUES (18, 'Thái Nguyên', 999, 242, 0);
INSERT INTO `city` VALUES (19, 'Thái Bình', 999, 242, 0);
INSERT INTO `city` VALUES (21, 'Tây Ninh', 999, 242, 0);
INSERT INTO `city` VALUES (22, 'Sơn La', 999, 242, 0);
INSERT INTO `city` VALUES (23, 'Sóc Trăng', 999, 242, 0);
INSERT INTO `city` VALUES (24, 'Quảng Trị', 999, 242, 0);
INSERT INTO `city` VALUES (25, 'Quảng Ninh', 999, 242, 0);
INSERT INTO `city` VALUES (26, 'Quảng Ngãi', 999, 242, 0);
INSERT INTO `city` VALUES (27, 'Quảng Nam', 999, 242, 0);
INSERT INTO `city` VALUES (28, 'Quảng Bình', 999, 242, 0);
INSERT INTO `city` VALUES (29, 'Phú Yên', 999, 242, 0);
INSERT INTO `city` VALUES (30, 'Phú Thọ', 999, 242, 0);
INSERT INTO `city` VALUES (31, 'Ninh Thuận', 999, 242, 0);
INSERT INTO `city` VALUES (32, 'Ninh Bình', 999, 242, 0);
INSERT INTO `city` VALUES (33, 'Nghệ An', 999, 242, 0);
INSERT INTO `city` VALUES (34, 'Nam Định', 999, 242, 0);
INSERT INTO `city` VALUES (35, 'Long An', 999, 242, 0);
INSERT INTO `city` VALUES (36, 'Lào Cai', 999, 242, 0);
INSERT INTO `city` VALUES (37, 'Lạng Sơn', 999, 242, 0);
INSERT INTO `city` VALUES (38, 'Lâm Đồng', 999, 242, 0);
INSERT INTO `city` VALUES (39, 'Lai Châu', 999, 242, 0);
INSERT INTO `city` VALUES (40, 'Kon Tum', 999, 242, 0);
INSERT INTO `city` VALUES (41, 'Kiên Giang', 999, 242, 0);
INSERT INTO `city` VALUES (42, 'Khánh Hòa', 999, 242, 0);
INSERT INTO `city` VALUES (43, 'Hưng Yên', 999, 242, 0);
INSERT INTO `city` VALUES (44, 'Hòa Bình', 999, 242, 0);
INSERT INTO `city` VALUES (45, 'Hậu Giang', 999, 242, 0);
INSERT INTO `city` VALUES (46, 'Hải Dương', 999, 242, 0);
INSERT INTO `city` VALUES (47, 'Hà Tĩnh', 999, 242, 0);
INSERT INTO `city` VALUES (49, 'Hà Nam ', 999, 242, 0);
INSERT INTO `city` VALUES (50, 'Hà Giang', 999, 242, 0);
INSERT INTO `city` VALUES (51, 'Gia Lai', 999, 242, 0);
INSERT INTO `city` VALUES (52, 'Đồng Tháp', 999, 242, 0);
INSERT INTO `city` VALUES (53, 'Đồng Nai', 999, 242, 0);
INSERT INTO `city` VALUES (54, 'Điện Biên', 999, 242, 0);
INSERT INTO `city` VALUES (55, 'Đắk Nông', 999, 242, 0);
INSERT INTO `city` VALUES (56, 'Đắk Lắk', 999, 242, 0);
INSERT INTO `city` VALUES (57, 'Cao Bằng', 999, 242, 0);
INSERT INTO `city` VALUES (58, 'Cà Mau', 999, 242, 0);
INSERT INTO `city` VALUES (59, 'Bình Thuận', 999, 242, 0);
INSERT INTO `city` VALUES (60, 'Bình Phước', 999, 242, 0);
INSERT INTO `city` VALUES (61, 'Bình Dương', 999, 242, 0);
INSERT INTO `city` VALUES (62, 'Bình Định', 999, 242, 0);
INSERT INTO `city` VALUES (63, 'Bến Tre', 999, 242, 0);
INSERT INTO `city` VALUES (64, 'Bắc Ninh', 999, 242, 0);
INSERT INTO `city` VALUES (65, 'Bạc Liêu', 999, 242, 0);
INSERT INTO `city` VALUES (66, 'Bắc Kạn', 999, 242, 0);
INSERT INTO `city` VALUES (67, 'Bắc Giang', 999, 242, 0);
INSERT INTO `city` VALUES (68, 'Bà Rịa - Vũng Tàu', 999, 242, 0);
INSERT INTO `city` VALUES (69, 'An Giang', 999, 242, 0);
INSERT INTO `city` VALUES (70, 'Hải Phòng', 3, 242, 0);
INSERT INTO `city` VALUES (71, 'Đà Nẵng', 999, 242, 0);
INSERT INTO `city` VALUES (72, 'Cần Thơ', 999, 242, 0);

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country`  (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`country_id`, `order`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 250 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES (12, 'Armenia', 'am', 1);
INSERT INTO `country` VALUES (14, 'Australia', 'au', 1);
INSERT INTO `country` VALUES (242, 'Việt Nam', 'vn', 0);

-- ----------------------------
-- Table structure for currency
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency`  (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_code` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `after` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `symbol` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coefficient` double NOT NULL DEFAULT 1,
  `is_primary` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `decimals_separator` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '.',
  `thousands_separator` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT ',',
  `decimals` smallint(5) NOT NULL DEFAULT 2,
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`currency_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of currency
-- ----------------------------
INSERT INTO `currency` VALUES (1, 'USD', 'US Dollars', 'N', '$', 20, 'N', '.', ',', 2, 'A');
INSERT INTO `currency` VALUES (2, 'EUR', 'Euro', 'N', '€', 25, 'N', '.', ',', 2, 'A');
INSERT INTO `currency` VALUES (3, 'VNĐ', 'VN Đồng', 'Y', 'đ', 1, 'Y', '.', ',', 0, 'A');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `language_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'en',
  `crt_date` datetime(0) NULL DEFAULT NULL,
  `crt_by` int(11) NULL DEFAULT NULL,
  `mod_date` datetime(0) NULL DEFAULT NULL,
  `mod_by` int(11) NULL DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `active_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `reset_password_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `oauth_provider` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '',
  `oauth_id` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for customer_address
-- ----------------------------
DROP TABLE IF EXISTS `customer_address`;
CREATE TABLE `customer_address`  (
  `customer_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `default_shipping` tinyint(4) NULL DEFAULT 1,
  `default_billing` tinyint(4) NULL DEFAULT 1,
  `country_id` int(11) NULL DEFAULT 0,
  `state_id` int(11) NULL DEFAULT 0,
  `city_id` int(11) NULL DEFAULT 0,
  `district_id` int(11) NULL DEFAULT 0,
  `post_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`customer_address_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for customer_detail
-- ----------------------------
DROP TABLE IF EXISTS `customer_detail`;
CREATE TABLE `customer_detail`  (
  `customer_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `gender` tinyint(4) NULL DEFAULT 1 COMMENT '=1(male) else =0(female)',
  `birthday` date NULL DEFAULT NULL,
  `receive_email` tinyint(4) NULL DEFAULT 1 COMMENT '1(yes), 0(no)',
  PRIMARY KEY (`customer_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for customer_review
-- ----------------------------
DROP TABLE IF EXISTS `customer_review`;
CREATE TABLE `customer_review`  (
  `customer_review_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `career` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '1' COMMENT '=1(male) else =0(female)',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `crt_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`customer_review_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for district
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district`  (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`district_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 901 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of district
-- ----------------------------
INSERT INTO `district` VALUES (113, 'Từ Liêm', 2, 1);
INSERT INTO `district` VALUES (114, 'Thanh Trì', 2, 2);
INSERT INTO `district` VALUES (115, 'Sóc Sơn', 2, 3);
INSERT INTO `district` VALUES (116, 'Gia Lâm', 2, 4);
INSERT INTO `district` VALUES (117, 'Đông Anh', 2, 5);
INSERT INTO `district` VALUES (118, 'Long Biên', 2, 6);
INSERT INTO `district` VALUES (119, 'Hoàng Mai', 2, 7);
INSERT INTO `district` VALUES (120, 'Cầu Giấy', 2, 8);
INSERT INTO `district` VALUES (121, 'Tây Hồ', 2, 9);
INSERT INTO `district` VALUES (122, 'Thanh Xuân', 2, 10);
INSERT INTO `district` VALUES (123, 'Hai Bà Trưng', 2, 11);
INSERT INTO `district` VALUES (124, 'Đống Đa', 2, 12);
INSERT INTO `district` VALUES (125, 'Ba Đình', 2, 13);
INSERT INTO `district` VALUES (126, 'Hoàn Kiếm', 2, 14);
INSERT INTO `district` VALUES (127, 'Quận 1', 3, 1);
INSERT INTO `district` VALUES (128, 'Quận 2', 3, 2);
INSERT INTO `district` VALUES (129, 'Quận 3', 3, 3);
INSERT INTO `district` VALUES (130, 'Quận 4', 3, 4);
INSERT INTO `district` VALUES (131, 'Quận 5', 3, 5);
INSERT INTO `district` VALUES (132, 'Quận 6', 3, 6);
INSERT INTO `district` VALUES (133, 'Quận 7', 3, 7);
INSERT INTO `district` VALUES (134, 'Quận 8', 3, 8);
INSERT INTO `district` VALUES (135, 'Quận 9', 3, 9);
INSERT INTO `district` VALUES (136, 'Quận 10', 3, 10);
INSERT INTO `district` VALUES (137, 'Quận 11', 3, 11);
INSERT INTO `district` VALUES (138, 'Quận 12', 3, 12);
INSERT INTO `district` VALUES (139, 'Quận Phú Nhuận', 3, 13);
INSERT INTO `district` VALUES (140, 'Quận Bình Thạnh', 3, 14);
INSERT INTO `district` VALUES (141, 'Quận Tân Bình', 3, 15);
INSERT INTO `district` VALUES (142, 'Quận Tân Phú', 3, 16);
INSERT INTO `district` VALUES (143, 'Quận Gò Vấp', 3, 17);
INSERT INTO `district` VALUES (144, 'Quận Thủ Đức', 3, 18);
INSERT INTO `district` VALUES (145, 'Quận Bình Tân', 3, 19);
INSERT INTO `district` VALUES (146, 'Huyện Bình Chánh', 3, 20);
INSERT INTO `district` VALUES (147, 'Huyện Củ Chi', 3, 21);
INSERT INTO `district` VALUES (149, 'Huyện Nhà Bè', 3, 22);
INSERT INTO `district` VALUES (150, 'Huyện Cần Giờ', 3, 23);
INSERT INTO `district` VALUES (151, 'Bà Rịa', 68, 1);
INSERT INTO `district` VALUES (152, 'Châu Đất', 68, 2);
INSERT INTO `district` VALUES (153, 'Côn Đảo', 68, 3);
INSERT INTO `district` VALUES (154, 'Long Đất', 68, 4);
INSERT INTO `district` VALUES (155, 'Tân Thành', 68, 5);
INSERT INTO `district` VALUES (156, 'Vũng Tàu', 68, 6);
INSERT INTO `district` VALUES (157, 'Xuyên Mộc', 68, 7);
INSERT INTO `district` VALUES (158, 'An Lão', 62, 1);
INSERT INTO `district` VALUES (159, 'An Nhơn', 62, 2);
INSERT INTO `district` VALUES (160, 'Hoài Ân', 62, 3);
INSERT INTO `district` VALUES (161, 'Hoài Nhơn', 62, 4);
INSERT INTO `district` VALUES (162, 'Phù Cát', 62, 5);
INSERT INTO `district` VALUES (163, 'Phù Mỹ', 62, 6);
INSERT INTO `district` VALUES (164, 'Qui Nhơn', 62, 7);
INSERT INTO `district` VALUES (165, 'Tây Sơn', 62, 8);
INSERT INTO `district` VALUES (166, 'Tuy Phước', 62, 9);
INSERT INTO `district` VALUES (167, 'Vân Canh', 62, 10);
INSERT INTO `district` VALUES (168, 'Vĩnh Thạnh', 62, 11);
INSERT INTO `district` VALUES (169, 'Ba Bể', 66, 1);
INSERT INTO `district` VALUES (170, 'Bắc Kạn', 66, 2);
INSERT INTO `district` VALUES (171, 'Bạch Thông ', 66, 3);
INSERT INTO `district` VALUES (172, 'Chợ Đồn', 66, 4);
INSERT INTO `district` VALUES (173, 'Chợ Mới', 66, 5);
INSERT INTO `district` VALUES (174, 'Na Rì', 66, 6);
INSERT INTO `district` VALUES (175, 'Ngân Sơn', 66, 7);
INSERT INTO `district` VALUES (176, 'Bảo Lạc', 57, 1);
INSERT INTO `district` VALUES (177, 'Cao Bắng', 57, 2);
INSERT INTO `district` VALUES (178, 'Hạ Lang', 57, 3);
INSERT INTO `district` VALUES (179, 'Hà Quảng', 57, 4);
INSERT INTO `district` VALUES (180, 'Hòa An', 57, 5);
INSERT INTO `district` VALUES (181, 'Nguyên Bình', 57, 6);
INSERT INTO `district` VALUES (182, 'Quảng Hòa', 57, 7);
INSERT INTO `district` VALUES (183, 'Thạch An', 57, 8);
INSERT INTO `district` VALUES (184, 'Thông Nông', 57, 9);
INSERT INTO `district` VALUES (185, 'Trà Lĩnh', 57, 10);
INSERT INTO `district` VALUES (186, 'Trùng Khánh', 57, 11);
INSERT INTO `district` VALUES (187, 'An Khê', 51, 1);
INSERT INTO `district` VALUES (188, 'Ayun Pa ', 51, 2);
INSERT INTO `district` VALUES (189, 'Chư Păh', 51, 3);
INSERT INTO `district` VALUES (190, 'Chư Prông  ', 51, 4);
INSERT INTO `district` VALUES (191, 'Chư Sê ', 51, 5);
INSERT INTO `district` VALUES (192, 'Đức Cơ  ', 51, 6);
INSERT INTO `district` VALUES (193, 'KBang  ', 51, 7);
INSERT INTO `district` VALUES (194, 'Krông Chro', 51, 8);
INSERT INTO `district` VALUES (195, 'Krông Pa ', 51, 9);
INSERT INTO `district` VALUES (196, 'La Grai  ', 51, 10);
INSERT INTO `district` VALUES (197, 'Mang Yang ', 51, 11);
INSERT INTO `district` VALUES (198, 'Pleiku', 51, 12);
INSERT INTO `district` VALUES (214, 'Cẩm Xuyên', 47, 1);
INSERT INTO `district` VALUES (215, 'Can Lộc', 47, 2);
INSERT INTO `district` VALUES (216, 'Đức Thọ', 47, 3);
INSERT INTO `district` VALUES (217, 'Hà Tĩnh', 47, 4);
INSERT INTO `district` VALUES (218, 'Hồng Lĩnh', 47, 5);
INSERT INTO `district` VALUES (219, 'Hương Khê', 47, 6);
INSERT INTO `district` VALUES (220, 'Hương Sơn', 47, 7);
INSERT INTO `district` VALUES (221, 'Kỳ Anh', 47, 8);
INSERT INTO `district` VALUES (222, 'Nghi Xuân', 47, 9);
INSERT INTO `district` VALUES (223, 'Thạch Hà', 47, 10);
INSERT INTO `district` VALUES (224, 'Đà Bắc', 44, 1);
INSERT INTO `district` VALUES (225, 'Hòa Bình', 44, 2);
INSERT INTO `district` VALUES (226, 'Kim Bôi', 44, 3);
INSERT INTO `district` VALUES (227, 'Kỳ Sơn', 44, 4);
INSERT INTO `district` VALUES (228, 'Lạc Sơn', 44, 5);
INSERT INTO `district` VALUES (229, 'Lạc Thủy', 44, 6);
INSERT INTO `district` VALUES (230, 'Lương Sơn', 44, 7);
INSERT INTO `district` VALUES (231, 'Mai Châu', 44, 8);
INSERT INTO `district` VALUES (232, 'Tân Lạc', 44, 9);
INSERT INTO `district` VALUES (233, 'Yên Thủy', 44, 10);
INSERT INTO `district` VALUES (234, 'Bình Giang', 46, 1);
INSERT INTO `district` VALUES (235, 'Cẩm Giàng', 46, 2);
INSERT INTO `district` VALUES (236, 'Chí Linh', 46, 3);
INSERT INTO `district` VALUES (238, 'Gia Lộc', 46, 4);
INSERT INTO `district` VALUES (239, 'Hải Dương', 46, 5);
INSERT INTO `district` VALUES (241, 'Kim Thành', 46, 6);
INSERT INTO `district` VALUES (242, 'Nam Sách', 46, 7);
INSERT INTO `district` VALUES (243, 'Ninh Giang', 46, 8);
INSERT INTO `district` VALUES (244, 'Kinh Môn', 46, 9);
INSERT INTO `district` VALUES (245, 'Ninh Giang', 46, 10);
INSERT INTO `district` VALUES (246, 'Thanh Hà', 46, 11);
INSERT INTO `district` VALUES (247, 'Thanh Miện', 46, 12);
INSERT INTO `district` VALUES (248, 'Từ Kỳ', 46, 13);
INSERT INTO `district` VALUES (249, 'An Hải', 70, 1);
INSERT INTO `district` VALUES (250, 'An Lão', 70, 2);
INSERT INTO `district` VALUES (251, 'Bạch Long Vỹ', 70, 3);
INSERT INTO `district` VALUES (253, 'Đồ Sơn', 70, 4);
INSERT INTO `district` VALUES (254, 'Hồng Bàng', 70, 5);
INSERT INTO `district` VALUES (255, 'Kiến An', 70, 6);
INSERT INTO `district` VALUES (256, 'Kiến Thụy', 70, 7);
INSERT INTO `district` VALUES (257, 'Lê Chân', 70, 8);
INSERT INTO `district` VALUES (258, 'Ngô Quyền', 70, 9);
INSERT INTO `district` VALUES (259, 'Thủy Nguyên', 70, 10);
INSERT INTO `district` VALUES (260, 'Tiên Lãng', 70, 11);
INSERT INTO `district` VALUES (261, 'Vĩnh Bảo', 70, 12);
INSERT INTO `district` VALUES (262, 'Ân Thi', 43, 1);
INSERT INTO `district` VALUES (263, 'Hưng Yên', 43, 2);
INSERT INTO `district` VALUES (264, 'Khoái Châu', 43, 3);
INSERT INTO `district` VALUES (265, 'Tiên Lữ', 43, 4);
INSERT INTO `district` VALUES (266, 'Văn Giang', 43, 5);
INSERT INTO `district` VALUES (267, 'Văn Lâm', 43, 6);
INSERT INTO `district` VALUES (268, 'Yên Mỹ', 43, 7);
INSERT INTO `district` VALUES (269, 'Nha Trang', 42, 1);
INSERT INTO `district` VALUES (270, 'Khánh Vĩnh', 42, 2);
INSERT INTO `district` VALUES (271, 'Diên Khánh', 42, 3);
INSERT INTO `district` VALUES (272, 'Ninh Hòa', 42, 4);
INSERT INTO `district` VALUES (273, 'Khánh Sơn', 42, 5);
INSERT INTO `district` VALUES (274, 'Cam Ranh', 42, 6);
INSERT INTO `district` VALUES (275, 'Trường Sa', 42, 7);
INSERT INTO `district` VALUES (276, 'Vạn Ninh', 42, 8);
INSERT INTO `district` VALUES (277, 'An Biên', 41, 1);
INSERT INTO `district` VALUES (278, 'An Minh', 41, 2);
INSERT INTO `district` VALUES (279, 'Châu Thành', 41, 3);
INSERT INTO `district` VALUES (280, 'Gò Quao', 41, 4);
INSERT INTO `district` VALUES (281, 'Gồng Giềng', 41, 5);
INSERT INTO `district` VALUES (282, 'Hà Tiên', 41, 6);
INSERT INTO `district` VALUES (283, 'Hòn Đất', 41, 7);
INSERT INTO `district` VALUES (284, 'Kiên Hải', 41, 8);
INSERT INTO `district` VALUES (285, 'Phú Quốc', 41, 9);
INSERT INTO `district` VALUES (286, 'Rạch Giá', 41, 10);
INSERT INTO `district` VALUES (287, 'Tân Hiệp', 41, 11);
INSERT INTO `district` VALUES (288, 'Vĩnh Thuận', 41, 12);
INSERT INTO `district` VALUES (290, 'Đắk Glei', 40, 1);
INSERT INTO `district` VALUES (291, 'Đắk Tô', 40, 2);
INSERT INTO `district` VALUES (292, 'Kon Plông', 40, 3);
INSERT INTO `district` VALUES (293, 'Kon Tum', 40, 4);
INSERT INTO `district` VALUES (294, 'Ngọc Hồi', 40, 5);
INSERT INTO `district` VALUES (295, 'Sa Thầy', 40, 6);
INSERT INTO `district` VALUES (296, 'Điện Biên', 39, 1);
INSERT INTO `district` VALUES (297, 'Điện Biên Đông', 39, 2);
INSERT INTO `district` VALUES (298, 'Điện Biên Phủ', 39, 3);
INSERT INTO `district` VALUES (299, 'Lai Châu', 39, 4);
INSERT INTO `district` VALUES (300, 'Mường Lay', 39, 5);
INSERT INTO `district` VALUES (301, 'Mường Tè', 39, 6);
INSERT INTO `district` VALUES (302, 'Phong Thổ', 39, 7);
INSERT INTO `district` VALUES (303, 'Sìn Hồ', 39, 8);
INSERT INTO `district` VALUES (304, 'Tủa Chùa', 39, 9);
INSERT INTO `district` VALUES (305, 'Tuần Giáo', 39, 10);
INSERT INTO `district` VALUES (306, 'Bắc Hà', 36, 1);
INSERT INTO `district` VALUES (307, 'Bảo Thắng', 36, 2);
INSERT INTO `district` VALUES (308, 'Bảo Yên', 36, 3);
INSERT INTO `district` VALUES (309, 'Bát Xát', 36, 4);
INSERT INTO `district` VALUES (310, 'Cam Đường', 36, 5);
INSERT INTO `district` VALUES (311, 'Lào Cai', 36, 6);
INSERT INTO `district` VALUES (312, 'Mường Khương', 36, 7);
INSERT INTO `district` VALUES (313, 'Sa Pa', 36, 8);
INSERT INTO `district` VALUES (314, 'Than Uyên', 36, 9);
INSERT INTO `district` VALUES (315, 'Văn Bàn', 36, 10);
INSERT INTO `district` VALUES (316, 'Xi Ma Cai', 36, 11);
INSERT INTO `district` VALUES (317, 'Bảo Lâm', 38, 1);
INSERT INTO `district` VALUES (318, 'Bảo Lộc', 38, 2);
INSERT INTO `district` VALUES (319, 'Cát Tiên', 38, 3);
INSERT INTO `district` VALUES (320, 'Đà Lạt', 38, 4);
INSERT INTO `district` VALUES (321, 'Đạ Tẻh', 38, 5);
INSERT INTO `district` VALUES (322, 'Đạ Huoai', 38, 6);
INSERT INTO `district` VALUES (323, 'Di Linh', 38, 7);
INSERT INTO `district` VALUES (324, 'Đơn Dương', 38, 8);
INSERT INTO `district` VALUES (325, 'Đức Trọng', 38, 9);
INSERT INTO `district` VALUES (326, 'Lạc Dương', 38, 10);
INSERT INTO `district` VALUES (327, 'Lâm Hà', 38, 11);
INSERT INTO `district` VALUES (328, 'Bắc Sơn', 37, 1);
INSERT INTO `district` VALUES (329, 'Bình Gia', 37, 2);
INSERT INTO `district` VALUES (330, 'Cao Lăng', 37, 3);
INSERT INTO `district` VALUES (331, 'Cao Lộc', 37, 4);
INSERT INTO `district` VALUES (332, 'Đình Lập', 37, 5);
INSERT INTO `district` VALUES (333, 'Hữu Lũng', 37, 6);
INSERT INTO `district` VALUES (334, 'Lạng Sơn', 37, 7);
INSERT INTO `district` VALUES (336, 'Lộc Bình', 37, 8);
INSERT INTO `district` VALUES (337, 'Tràng Định', 37, 9);
INSERT INTO `district` VALUES (341, 'Bến Lức', 35, 1);
INSERT INTO `district` VALUES (342, 'Văn Lãng', 37, 10);
INSERT INTO `district` VALUES (343, 'Văn Quang', 37, 11);
INSERT INTO `district` VALUES (344, 'Cần Đước', 35, 2);
INSERT INTO `district` VALUES (345, 'Cần Giuộc', 35, 3);
INSERT INTO `district` VALUES (346, 'Châu Thành', 35, 4);
INSERT INTO `district` VALUES (347, 'Đức Hòa', 35, 5);
INSERT INTO `district` VALUES (348, 'Đức Huệ', 35, 6);
INSERT INTO `district` VALUES (349, 'Mộc Hóa', 35, 7);
INSERT INTO `district` VALUES (350, 'Tân An', 35, 8);
INSERT INTO `district` VALUES (351, 'Tân Hưng', 35, 9);
INSERT INTO `district` VALUES (352, 'Tân Thạnh', 35, 10);
INSERT INTO `district` VALUES (354, 'Tân Trụ', 35, 11);
INSERT INTO `district` VALUES (355, 'Thạnh Hóa', 35, 12);
INSERT INTO `district` VALUES (356, 'Thủ Thừa', 35, 13);
INSERT INTO `district` VALUES (357, 'Vĩnh Hưng', 35, 14);
INSERT INTO `district` VALUES (358, 'Giao Thủy', 34, 1);
INSERT INTO `district` VALUES (360, 'Hải Hậu', 34, 2);
INSERT INTO `district` VALUES (361, 'Mỹ Lộc', 34, 3);
INSERT INTO `district` VALUES (362, 'Nam Định', 34, 4);
INSERT INTO `district` VALUES (363, 'Nam Trực', 34, 5);
INSERT INTO `district` VALUES (364, 'Nghĩa Hưng', 34, 6);
INSERT INTO `district` VALUES (365, 'Trực Ninh', 34, 7);
INSERT INTO `district` VALUES (366, 'Vụ Bản', 34, 8);
INSERT INTO `district` VALUES (367, 'Xuân Trường', 34, 9);
INSERT INTO `district` VALUES (368, 'Ý Yên', 34, 10);
INSERT INTO `district` VALUES (369, 'Anh Sơn', 33, 1);
INSERT INTO `district` VALUES (370, 'Con Cuông', 33, 2);
INSERT INTO `district` VALUES (371, 'Cửa Lò', 33, 3);
INSERT INTO `district` VALUES (372, 'Diễn Châu', 33, 4);
INSERT INTO `district` VALUES (373, 'Đô Lương', 33, 5);
INSERT INTO `district` VALUES (374, 'Hưng Nguyên', 33, 6);
INSERT INTO `district` VALUES (375, 'Kỳ Sơn', 33, 7);
INSERT INTO `district` VALUES (376, 'Nam Đàn', 33, 8);
INSERT INTO `district` VALUES (377, 'Nghi Lộc', 33, 9);
INSERT INTO `district` VALUES (378, 'Nghĩa Đàn', 33, 10);
INSERT INTO `district` VALUES (379, 'Quế Phong', 33, 11);
INSERT INTO `district` VALUES (380, 'Quỳ Châu', 33, 12);
INSERT INTO `district` VALUES (381, 'Quỳ Hợp', 33, 13);
INSERT INTO `district` VALUES (382, 'Quỳnh Lưu', 33, 14);
INSERT INTO `district` VALUES (383, 'Tân Kỳ', 33, 15);
INSERT INTO `district` VALUES (384, 'Thanh Chương', 33, 16);
INSERT INTO `district` VALUES (385, 'Tương Dương', 33, 17);
INSERT INTO `district` VALUES (386, 'Vinh', 33, 18);
INSERT INTO `district` VALUES (387, 'Yên Thành', 33, 19);
INSERT INTO `district` VALUES (388, 'Đoan Hùng', 30, 1);
INSERT INTO `district` VALUES (389, 'Hạ Hòa', 30, 2);
INSERT INTO `district` VALUES (390, 'Lâm Thao', 30, 3);
INSERT INTO `district` VALUES (391, 'Phù Ninh', 30, 4);
INSERT INTO `district` VALUES (392, 'Phú Thọ', 30, 5);
INSERT INTO `district` VALUES (393, 'Sông Thao', 30, 6);
INSERT INTO `district` VALUES (394, 'Tam Nông', 30, 7);
INSERT INTO `district` VALUES (395, 'Thanh Ba', 30, 8);
INSERT INTO `district` VALUES (396, 'Thanh Sơn', 30, 9);
INSERT INTO `district` VALUES (397, 'Thanh Thủy', 30, 10);
INSERT INTO `district` VALUES (398, 'Việt Trì', 30, 11);
INSERT INTO `district` VALUES (399, 'Yên Lập', 30, 12);
INSERT INTO `district` VALUES (400, 'Đại Lộc', 27, 1);
INSERT INTO `district` VALUES (401, 'Điện Bàn', 27, 2);
INSERT INTO `district` VALUES (402, 'Duy Xuyên', 27, 3);
INSERT INTO `district` VALUES (403, 'Hiên', 27, 4);
INSERT INTO `district` VALUES (404, 'Hiệp Đức', 27, 5);
INSERT INTO `district` VALUES (405, 'Hội An', 27, 6);
INSERT INTO `district` VALUES (406, 'Nam Giang', 27, 7);
INSERT INTO `district` VALUES (407, 'Núi Thành', 27, 8);
INSERT INTO `district` VALUES (408, 'Phước Sơn', 27, 9);
INSERT INTO `district` VALUES (409, 'Quế Sơn', 27, 10);
INSERT INTO `district` VALUES (410, 'Tam Kỳ', 27, 11);
INSERT INTO `district` VALUES (411, 'Thăng Bình', 27, 12);
INSERT INTO `district` VALUES (412, 'Tiên Phước', 27, 13);
INSERT INTO `district` VALUES (413, 'Trà My', 27, 14);
INSERT INTO `district` VALUES (414, 'Cam Lộ', 24, 1);
INSERT INTO `district` VALUES (415, 'Đa Krông', 24, 2);
INSERT INTO `district` VALUES (416, 'Đông Hà', 24, 3);
INSERT INTO `district` VALUES (417, 'Gio Linh', 24, 4);
INSERT INTO `district` VALUES (418, 'Hải Lăng', 24, 5);
INSERT INTO `district` VALUES (419, 'Hướng Hóa', 24, 6);
INSERT INTO `district` VALUES (420, 'Quảng Trị', 24, 7);
INSERT INTO `district` VALUES (421, 'Triệu Phong', 24, 8);
INSERT INTO `district` VALUES (422, 'Vĩnh Linh', 24, 9);
INSERT INTO `district` VALUES (423, 'A Lưới', 16, 1);
INSERT INTO `district` VALUES (424, 'Huế', 16, 2);
INSERT INTO `district` VALUES (425, 'Hương Thủy', 16, 3);
INSERT INTO `district` VALUES (426, 'Hương Trà', 16, 4);
INSERT INTO `district` VALUES (427, 'Nam Đông', 16, 5);
INSERT INTO `district` VALUES (428, 'Phong Điền', 16, 6);
INSERT INTO `district` VALUES (429, 'Phú Lộc', 16, 7);
INSERT INTO `district` VALUES (430, 'Phú Vang', 16, 8);
INSERT INTO `district` VALUES (431, 'Quảng Điền', 16, 9);
INSERT INTO `district` VALUES (432, 'Đông Hưng', 19, 1);
INSERT INTO `district` VALUES (433, 'Hưng Hà', 19, 2);
INSERT INTO `district` VALUES (434, 'Kiến Xương', 19, 3);
INSERT INTO `district` VALUES (435, 'Quỳnh Phụ', 19, 4);
INSERT INTO `district` VALUES (436, 'Thái Bình', 19, 5);
INSERT INTO `district` VALUES (437, 'Thái Thụy', 19, 6);
INSERT INTO `district` VALUES (438, 'Tiền Hải', 19, 7);
INSERT INTO `district` VALUES (439, 'Vũ Thư', 19, 8);
INSERT INTO `district` VALUES (440, 'Càng Long', 14, 1);
INSERT INTO `district` VALUES (441, 'Cầu Kè', 14, 2);
INSERT INTO `district` VALUES (442, 'Cầu Ngang', 14, 3);
INSERT INTO `district` VALUES (443, 'Châu Thành', 14, 4);
INSERT INTO `district` VALUES (444, 'Duyên Hải', 14, 5);
INSERT INTO `district` VALUES (445, 'Tiểu Cần', 14, 6);
INSERT INTO `district` VALUES (446, 'Trà Cú', 14, 7);
INSERT INTO `district` VALUES (447, 'Trà Vinh', 14, 8);
INSERT INTO `district` VALUES (448, 'Bình Xuyên', 11, 1);
INSERT INTO `district` VALUES (449, 'Lập Thạch', 11, 2);
INSERT INTO `district` VALUES (450, 'Mê Linh', 2, 15);
INSERT INTO `district` VALUES (451, 'Tam Dương', 11, 3);
INSERT INTO `district` VALUES (452, 'Vĩnh Tường', 11, 4);
INSERT INTO `district` VALUES (453, 'Vĩnh Yên', 11, 5);
INSERT INTO `district` VALUES (454, 'Yên Lạc', 11, 6);
INSERT INTO `district` VALUES (455, 'Buôn Đôn', 56, 1);
INSERT INTO `district` VALUES (456, 'Buôn Ma Thuột', 56, 2);
INSERT INTO `district` VALUES (457, 'Cư Jút', 56, 3);
INSERT INTO `district` VALUES (458, 'Cư M\'gar', 56, 4);
INSERT INTO `district` VALUES (459, 'Đắk Mil', 56, 5);
INSERT INTO `district` VALUES (460, 'Đắk Nông', 56, 6);
INSERT INTO `district` VALUES (461, 'Đắk R\'lấp', 56, 7);
INSERT INTO `district` VALUES (462, 'Ea H\'leo', 56, 8);
INSERT INTO `district` VALUES (463, 'Ea Kra', 56, 9);
INSERT INTO `district` VALUES (464, 'Ea Súp', 56, 10);
INSERT INTO `district` VALUES (465, 'Krông A Na', 56, 11);
INSERT INTO `district` VALUES (466, 'Krông Bông', 56, 12);
INSERT INTO `district` VALUES (467, 'Krông Búk', 56, 13);
INSERT INTO `district` VALUES (468, 'Krông Năng', 56, 14);
INSERT INTO `district` VALUES (469, 'Krông Nô', 56, 15);
INSERT INTO `district` VALUES (470, 'Krông Pắc', 56, 16);
INSERT INTO `district` VALUES (471, 'Lắk', 56, 17);
INSERT INTO `district` VALUES (472, 'M\'Đrắt', 56, 18);
INSERT INTO `district` VALUES (473, 'Bến Cát', 61, 1);
INSERT INTO `district` VALUES (474, 'Dầu Tiếng', 61, 2);
INSERT INTO `district` VALUES (475, 'Dĩ An', 61, 3);
INSERT INTO `district` VALUES (476, 'Tân Uyên', 61, 4);
INSERT INTO `district` VALUES (477, 'Thủ Dầu Một', 61, 5);
INSERT INTO `district` VALUES (478, 'Thuận An', 61, 6);
INSERT INTO `district` VALUES (479, 'Bạc Liêu', 65, 1);
INSERT INTO `district` VALUES (480, 'Giá Rai', 65, 2);
INSERT INTO `district` VALUES (481, 'Hồng Dân', 65, 3);
INSERT INTO `district` VALUES (482, 'Vĩnh Lợi', 65, 4);
INSERT INTO `district` VALUES (483, 'Bắc Ninh', 64, 1);
INSERT INTO `district` VALUES (484, 'Gia Bình', 64, 2);
INSERT INTO `district` VALUES (485, 'Lương Tài', 64, 3);
INSERT INTO `district` VALUES (486, 'Quế Võ', 64, 4);
INSERT INTO `district` VALUES (487, 'Thuận Thành', 64, 5);
INSERT INTO `district` VALUES (488, 'Tiên Du', 64, 6);
INSERT INTO `district` VALUES (489, 'Từ Sơn', 64, 7);
INSERT INTO `district` VALUES (490, 'Yên Phong', 64, 8);
INSERT INTO `district` VALUES (491, 'Cà Mau', 58, 1);
INSERT INTO `district` VALUES (492, 'Cái Nước', 58, 2);
INSERT INTO `district` VALUES (493, 'Đầm Dơi', 58, 3);
INSERT INTO `district` VALUES (494, 'Ngọc Hiển', 58, 4);
INSERT INTO `district` VALUES (495, 'Thới Bình', 58, 5);
INSERT INTO `district` VALUES (496, 'Trần Văn Thời', 58, 6);
INSERT INTO `district` VALUES (497, 'U Minh', 58, 7);
INSERT INTO `district` VALUES (498, 'Bắc Mê', 50, 1);
INSERT INTO `district` VALUES (499, 'Bắc Quang', 50, 2);
INSERT INTO `district` VALUES (500, 'Đồng Văn', 50, 3);
INSERT INTO `district` VALUES (501, 'Hà Giang', 50, 4);
INSERT INTO `district` VALUES (502, 'Hoàng Su Phì', 50, 5);
INSERT INTO `district` VALUES (503, 'Mèo Vạt', 50, 6);
INSERT INTO `district` VALUES (504, 'Quản Bạ', 50, 7);
INSERT INTO `district` VALUES (505, 'Vị Xuyên', 50, 8);
INSERT INTO `district` VALUES (506, 'Xín Mần', 50, 9);
INSERT INTO `district` VALUES (507, 'Yên Minh', 50, 10);
INSERT INTO `district` VALUES (568, 'Hoa Lư', 32, 1);
INSERT INTO `district` VALUES (569, 'Kim Sơn', 32, 2);
INSERT INTO `district` VALUES (571, 'Nho Quan', 32, 3);
INSERT INTO `district` VALUES (572, 'Ninh Bình', 32, 4);
INSERT INTO `district` VALUES (573, 'Tam Điệp', 32, 5);
INSERT INTO `district` VALUES (574, 'Yên Khánh', 32, 6);
INSERT INTO `district` VALUES (575, 'Yên Mô', 32, 7);
INSERT INTO `district` VALUES (576, 'Đồng Xuân', 29, 1);
INSERT INTO `district` VALUES (577, 'Sơn Hòa', 29, 2);
INSERT INTO `district` VALUES (578, 'Sông Cầu', 29, 3);
INSERT INTO `district` VALUES (579, 'Sông Hinh', 29, 4);
INSERT INTO `district` VALUES (580, 'Tuy An', 29, 5);
INSERT INTO `district` VALUES (581, 'Tuy Hòa', 29, 6);
INSERT INTO `district` VALUES (582, 'Ba Tơ', 26, 1);
INSERT INTO `district` VALUES (583, 'Bình Sơn', 26, 2);
INSERT INTO `district` VALUES (584, 'Đức Phổ', 26, 3);
INSERT INTO `district` VALUES (585, 'Lý Sơn', 26, 4);
INSERT INTO `district` VALUES (586, 'Minh Long', 26, 5);
INSERT INTO `district` VALUES (587, 'Mộ Đức', 26, 6);
INSERT INTO `district` VALUES (588, 'Nghĩa Hành', 26, 7);
INSERT INTO `district` VALUES (589, 'Quãng Ngãi', 26, 8);
INSERT INTO `district` VALUES (590, 'Sơn Hà', 26, 9);
INSERT INTO `district` VALUES (591, 'Sơn Tây', 26, 10);
INSERT INTO `district` VALUES (592, 'Sơn Tịnh', 26, 11);
INSERT INTO `district` VALUES (593, 'Trà Bồng', 26, 12);
INSERT INTO `district` VALUES (594, 'Tư Nghĩa', 26, 13);
INSERT INTO `district` VALUES (595, 'Kế Sách', 23, 1);
INSERT INTO `district` VALUES (596, 'Long Phú', 23, 2);
INSERT INTO `district` VALUES (597, 'Mỹ Tú', 23, 3);
INSERT INTO `district` VALUES (598, 'Mỹ Xuyên', 23, 4);
INSERT INTO `district` VALUES (599, 'Sóc Trăng', 23, 5);
INSERT INTO `district` VALUES (600, 'Thanh Trị', 23, 6);
INSERT INTO `district` VALUES (601, 'Vĩnh Châu', 23, 7);
INSERT INTO `district` VALUES (602, 'Bến Cầu', 21, 1);
INSERT INTO `district` VALUES (603, 'Châu Thành', 21, 2);
INSERT INTO `district` VALUES (604, 'Dương Minh Châu', 21, 3);
INSERT INTO `district` VALUES (605, 'Gò Dầu', 21, 4);
INSERT INTO `district` VALUES (606, 'Hòa Thành', 21, 5);
INSERT INTO `district` VALUES (607, 'Tân Biên', 21, 6);
INSERT INTO `district` VALUES (608, 'Tân Châu', 21, 7);
INSERT INTO `district` VALUES (609, 'Tây Ninh', 21, 8);
INSERT INTO `district` VALUES (610, 'Trảng Bàng', 21, 9);
INSERT INTO `district` VALUES (611, 'Đại Từ', 18, 1);
INSERT INTO `district` VALUES (612, 'Định Hóa', 18, 2);
INSERT INTO `district` VALUES (613, 'Đồng Hỷ', 18, 3);
INSERT INTO `district` VALUES (614, 'Phổ Yên', 18, 4);
INSERT INTO `district` VALUES (615, 'Phú Bình', 18, 5);
INSERT INTO `district` VALUES (616, 'Phú Lương', 18, 6);
INSERT INTO `district` VALUES (617, 'Sông Công', 18, 7);
INSERT INTO `district` VALUES (618, 'Thái Nguyên', 18, 8);
INSERT INTO `district` VALUES (619, 'Võ Nhai', 18, 9);
INSERT INTO `district` VALUES (620, 'Chiêm Hóa', 13, 1);
INSERT INTO `district` VALUES (621, 'Hàm Yên', 13, 2);
INSERT INTO `district` VALUES (622, 'Na Hang', 13, 3);
INSERT INTO `district` VALUES (623, 'Sơn Dương', 13, 4);
INSERT INTO `district` VALUES (624, 'Tuyên Quang', 13, 5);
INSERT INTO `district` VALUES (625, 'Yên Sơn', 13, 6);
INSERT INTO `district` VALUES (626, 'Lục Yên', 10, 1);
INSERT INTO `district` VALUES (627, 'Mù Căng Chải', 10, 2);
INSERT INTO `district` VALUES (628, 'Trạm Tấu', 10, 3);
INSERT INTO `district` VALUES (629, 'Trấn Yên', 10, 4);
INSERT INTO `district` VALUES (630, 'Văn Chấn', 10, 5);
INSERT INTO `district` VALUES (631, 'Văn Yên', 10, 6);
INSERT INTO `district` VALUES (632, 'Yên Bái', 10, 7);
INSERT INTO `district` VALUES (633, 'Yên Bình', 10, 8);
INSERT INTO `district` VALUES (634, 'Biên Hòa', 53, 1);
INSERT INTO `district` VALUES (635, 'Định Quán', 53, 2);
INSERT INTO `district` VALUES (636, 'Long Khánh', 53, 3);
INSERT INTO `district` VALUES (637, 'Long Thành', 53, 4);
INSERT INTO `district` VALUES (638, 'Nhơn Trạch', 53, 5);
INSERT INTO `district` VALUES (639, 'Tân Phú', 53, 6);
INSERT INTO `district` VALUES (640, 'Thống Nhất', 53, 7);
INSERT INTO `district` VALUES (641, 'Vĩnh Cừu', 53, 8);
INSERT INTO `district` VALUES (642, 'Xuân Lộc', 53, 9);
INSERT INTO `district` VALUES (643, 'An Phú', 69, 1);
INSERT INTO `district` VALUES (644, 'Châu Đốc', 69, 2);
INSERT INTO `district` VALUES (645, 'Châu Phú', 69, 3);
INSERT INTO `district` VALUES (646, 'Châu Thành', 69, 4);
INSERT INTO `district` VALUES (647, 'Chợ Mới', 69, 5);
INSERT INTO `district` VALUES (648, 'Long Xuyên', 69, 6);
INSERT INTO `district` VALUES (649, 'Phú Tân', 69, 7);
INSERT INTO `district` VALUES (650, 'Tân Châu', 69, 8);
INSERT INTO `district` VALUES (651, 'Thoại Sơn', 69, 9);
INSERT INTO `district` VALUES (652, 'Tịnh Biên', 69, 10);
INSERT INTO `district` VALUES (653, 'Tri Tôn', 69, 11);
INSERT INTO `district` VALUES (654, 'Bắc Bình', 59, 1);
INSERT INTO `district` VALUES (655, 'Đức Linh', 59, 2);
INSERT INTO `district` VALUES (656, 'Hàm Tân', 59, 3);
INSERT INTO `district` VALUES (657, 'Hàm Thuận Bắc', 59, 4);
INSERT INTO `district` VALUES (658, 'Hàm Thuận Nam', 59, 5);
INSERT INTO `district` VALUES (659, 'Phan Thiết', 59, 6);
INSERT INTO `district` VALUES (660, 'Phú Quí', 59, 7);
INSERT INTO `district` VALUES (661, 'Tánh Linh', 59, 8);
INSERT INTO `district` VALUES (662, 'Tuy Phong', 59, 9);
INSERT INTO `district` VALUES (663, 'Bắc Giang', 67, 1);
INSERT INTO `district` VALUES (664, 'Hiệp Hòa', 67, 2);
INSERT INTO `district` VALUES (665, 'Lạng Giang', 67, 3);
INSERT INTO `district` VALUES (666, 'Lục Nam', 67, 4);
INSERT INTO `district` VALUES (667, 'Lục Ngạn', 67, 5);
INSERT INTO `district` VALUES (668, 'Sơn Động', 67, 6);
INSERT INTO `district` VALUES (669, 'Tân Yên', 67, 7);
INSERT INTO `district` VALUES (670, 'Việt Yên', 67, 8);
INSERT INTO `district` VALUES (671, 'Yên Dũng', 67, 9);
INSERT INTO `district` VALUES (672, 'Yên Thế', 67, 10);
INSERT INTO `district` VALUES (673, 'Ba Tri', 63, 1);
INSERT INTO `district` VALUES (674, 'Bến Tre', 63, 2);
INSERT INTO `district` VALUES (675, 'Bình Đại', 63, 3);
INSERT INTO `district` VALUES (676, 'Châu Thành', 63, 4);
INSERT INTO `district` VALUES (677, 'Chợ Lách', 63, 5);
INSERT INTO `district` VALUES (678, 'Giồng Trôm', 63, 6);
INSERT INTO `district` VALUES (679, 'Mỏ Cày', 63, 7);
INSERT INTO `district` VALUES (680, 'Thạnh Phú', 63, 8);
INSERT INTO `district` VALUES (681, 'Cần Thơ', 72, 1);
INSERT INTO `district` VALUES (682, 'Châu Thành', 45, 1);
INSERT INTO `district` VALUES (683, 'Long Mỹ', 45, 2);
INSERT INTO `district` VALUES (684, 'Ô Môn', 72, 2);
INSERT INTO `district` VALUES (685, 'Phụng Hiệp', 45, 3);
INSERT INTO `district` VALUES (686, 'Thốt Nốt', 72, 3);
INSERT INTO `district` VALUES (687, 'Vị Thanh', 45, 4);
INSERT INTO `district` VALUES (688, 'Vị Thủy', 45, 5);
INSERT INTO `district` VALUES (689, 'Bình Lục', 49, 1);
INSERT INTO `district` VALUES (690, 'Duy Tiên', 49, 2);
INSERT INTO `district` VALUES (691, 'Kim Bảng', 49, 3);
INSERT INTO `district` VALUES (692, 'Lý Nhân', 49, 4);
INSERT INTO `district` VALUES (693, 'Phủ Lý', 49, 5);
INSERT INTO `district` VALUES (694, 'Thanh Liêm', 49, 6);
INSERT INTO `district` VALUES (705, 'Ân Thi', 43, 8);
INSERT INTO `district` VALUES (706, 'Hưng Yên', 43, 9);
INSERT INTO `district` VALUES (707, 'Khoái Châu', 43, 10);
INSERT INTO `district` VALUES (708, 'Kim Động', 43, 11);
INSERT INTO `district` VALUES (709, 'Mỹ Hào', 43, 12);
INSERT INTO `district` VALUES (710, 'Phù Cừ', 43, 13);
INSERT INTO `district` VALUES (715, 'Đắk Glei', 40, 7);
INSERT INTO `district` VALUES (716, 'Đắk Hà', 40, 8);
INSERT INTO `district` VALUES (717, 'Đắk Tô', 40, 9);
INSERT INTO `district` VALUES (718, 'Kon Plông', 40, 10);
INSERT INTO `district` VALUES (719, 'Kon Tum', 40, 11);
INSERT INTO `district` VALUES (720, 'Ngọc Hồi', 40, 12);
INSERT INTO `district` VALUES (721, 'Sa Thầy', 40, 13);
INSERT INTO `district` VALUES (743, 'Ninh Hải', 31, 1);
INSERT INTO `district` VALUES (744, 'Ninh Phước', 31, 2);
INSERT INTO `district` VALUES (745, 'Ninh Sơn', 31, 3);
INSERT INTO `district` VALUES (746, 'Phan Rang - Tháp Chàm', 31, 4);
INSERT INTO `district` VALUES (747, 'Bố Trạch', 28, 1);
INSERT INTO `district` VALUES (748, 'Đồng Hới', 28, 2);
INSERT INTO `district` VALUES (749, 'Lệ Thủy', 28, 3);
INSERT INTO `district` VALUES (750, 'Quảng Ninh', 28, 4);
INSERT INTO `district` VALUES (751, 'Quảng Trạch', 28, 5);
INSERT INTO `district` VALUES (752, 'Tuyên Hóa', 28, 6);
INSERT INTO `district` VALUES (753, 'Ba Chế', 25, 1);
INSERT INTO `district` VALUES (754, 'Bình Liêu', 25, 2);
INSERT INTO `district` VALUES (755, 'Cẩm Phả', 25, 3);
INSERT INTO `district` VALUES (756, 'Cô Tô', 25, 4);
INSERT INTO `district` VALUES (757, 'Đông Triều', 25, 5);
INSERT INTO `district` VALUES (758, 'Hạ Long', 25, 6);
INSERT INTO `district` VALUES (759, 'Hoành Bồ', 25, 7);
INSERT INTO `district` VALUES (760, 'Móng Cái', 25, 8);
INSERT INTO `district` VALUES (761, 'Quảng Hà', 25, 9);
INSERT INTO `district` VALUES (762, 'Tiên Yên', 25, 10);
INSERT INTO `district` VALUES (763, 'Uông Bí', 25, 11);
INSERT INTO `district` VALUES (764, 'Vân Đồn', 25, 12);
INSERT INTO `district` VALUES (765, 'Yên Hưng', 25, 13);
INSERT INTO `district` VALUES (766, 'Bắc Yên', 22, 1);
INSERT INTO `district` VALUES (767, 'Mai Sơn', 22, 2);
INSERT INTO `district` VALUES (768, 'Mộc Châu', 22, 3);
INSERT INTO `district` VALUES (769, 'Muờng La', 22, 4);
INSERT INTO `district` VALUES (770, 'Phù Yên', 22, 5);
INSERT INTO `district` VALUES (771, 'Quỳnh Nhai', 22, 6);
INSERT INTO `district` VALUES (772, 'Sơn La', 22, 7);
INSERT INTO `district` VALUES (773, 'Sông Mã', 22, 8);
INSERT INTO `district` VALUES (774, 'Thuận Châu', 22, 9);
INSERT INTO `district` VALUES (775, 'Yên Châu', 22, 10);
INSERT INTO `district` VALUES (776, 'Bá Thước', 17, 1);
INSERT INTO `district` VALUES (777, 'Bỉm Sơn', 17, 2);
INSERT INTO `district` VALUES (778, 'Cẩm Thủy', 17, 3);
INSERT INTO `district` VALUES (779, 'Đông Sơn', 17, 4);
INSERT INTO `district` VALUES (780, 'Hà Trung', 17, 5);
INSERT INTO `district` VALUES (781, 'Hậu Lộc', 17, 6);
INSERT INTO `district` VALUES (782, 'Hoằng Hóa', 17, 7);
INSERT INTO `district` VALUES (783, 'Lang Chánh', 17, 8);
INSERT INTO `district` VALUES (784, 'Mường Lát', 17, 9);
INSERT INTO `district` VALUES (785, 'Nga Sơn', 17, 10);
INSERT INTO `district` VALUES (786, 'Ngọc Lặc', 17, 11);
INSERT INTO `district` VALUES (787, 'Như Thanh', 17, 12);
INSERT INTO `district` VALUES (788, 'Như Xuân', 17, 13);
INSERT INTO `district` VALUES (789, 'Nông Cống', 17, 14);
INSERT INTO `district` VALUES (790, 'Quan Hóa', 17, 15);
INSERT INTO `district` VALUES (791, 'Quan Sơn', 17, 16);
INSERT INTO `district` VALUES (792, 'Quảng Xương', 17, 17);
INSERT INTO `district` VALUES (793, 'Sầm Sơn', 17, 18);
INSERT INTO `district` VALUES (794, 'Thạch Thành', 17, 19);
INSERT INTO `district` VALUES (795, 'Thanh Hóa', 17, 20);
INSERT INTO `district` VALUES (796, 'Thọ Xuân', 17, 21);
INSERT INTO `district` VALUES (797, 'Thường Xuân', 17, 22);
INSERT INTO `district` VALUES (798, 'Tĩnh Gia', 17, 23);
INSERT INTO `district` VALUES (799, 'Thiệu Hóa', 17, 24);
INSERT INTO `district` VALUES (800, 'Triệu Sơn', 17, 25);
INSERT INTO `district` VALUES (801, 'Vĩnh Lộc', 17, 26);
INSERT INTO `district` VALUES (802, 'Yên Định', 17, 27);
INSERT INTO `district` VALUES (803, 'Cái Bè', 15, 1);
INSERT INTO `district` VALUES (804, 'Cai Lậy', 15, 2);
INSERT INTO `district` VALUES (805, 'Châu Thành', 15, 3);
INSERT INTO `district` VALUES (806, 'Chợ Gạo', 15, 4);
INSERT INTO `district` VALUES (807, 'Gò Công', 15, 5);
INSERT INTO `district` VALUES (808, 'Gò Công Đông', 15, 6);
INSERT INTO `district` VALUES (809, 'Gò Công Tây', 15, 7);
INSERT INTO `district` VALUES (810, 'Mỹ Tho', 15, 8);
INSERT INTO `district` VALUES (811, 'Tân Phước', 15, 9);
INSERT INTO `district` VALUES (812, 'Bình Minh', 12, 1);
INSERT INTO `district` VALUES (813, 'Long Hồ', 12, 2);
INSERT INTO `district` VALUES (814, 'Mang Thít', 12, 3);
INSERT INTO `district` VALUES (815, 'Tam Bình', 12, 4);
INSERT INTO `district` VALUES (816, 'Trà Ôn', 12, 5);
INSERT INTO `district` VALUES (817, 'Vĩnh Long', 12, 6);
INSERT INTO `district` VALUES (818, 'Vũng Liêm', 12, 7);
INSERT INTO `district` VALUES (819, 'Đảo Hòang Sa', 71, 1);
INSERT INTO `district` VALUES (820, 'Hải Châu', 71, 2);
INSERT INTO `district` VALUES (821, 'Hòa Vang', 71, 3);
INSERT INTO `district` VALUES (822, 'Liên Chiểu', 71, 4);
INSERT INTO `district` VALUES (823, 'Ngũ Hành Sơn', 71, 5);
INSERT INTO `district` VALUES (824, 'Sơn Trà', 71, 6);
INSERT INTO `district` VALUES (825, 'Thanh Khê', 71, 7);
INSERT INTO `district` VALUES (826, 'Cao Lãnh', 52, 1);
INSERT INTO `district` VALUES (827, 'Châu Thành', 52, 2);
INSERT INTO `district` VALUES (828, 'Hồng Ngự', 52, 3);
INSERT INTO `district` VALUES (829, 'Lai Vung', 52, 4);
INSERT INTO `district` VALUES (830, 'Lấp Vò', 52, 5);
INSERT INTO `district` VALUES (831, 'Tam Nông', 52, 6);
INSERT INTO `district` VALUES (832, 'Tân Hồng', 52, 7);
INSERT INTO `district` VALUES (833, 'Thanh Bình', 52, 8);
INSERT INTO `district` VALUES (834, 'Tháp Mười', 52, 9);
INSERT INTO `district` VALUES (835, 'Xa Đéc', 52, 10);
INSERT INTO `district` VALUES (836, 'Bình Long', 60, 1);
INSERT INTO `district` VALUES (837, 'Ninh Kiều', 72, 4);
INSERT INTO `district` VALUES (838, 'Trảng Bom', 53, 10);
INSERT INTO `district` VALUES (839, 'Phước Long', 60, 2);
INSERT INTO `district` VALUES (840, 'Vân Điền', 2, 16);
INSERT INTO `district` VALUES (841, 'Lái Thiêu', 61, 7);
INSERT INTO `district` VALUES (844, 'Cẩm Lệ', 71, 8);
INSERT INTO `district` VALUES (848, 'Cái Răng', 72, 5);
INSERT INTO `district` VALUES (849, 'Liên Hưng', 35, 15);
INSERT INTO `district` VALUES (850, 'Phúc Yên', 11, 7);
INSERT INTO `district` VALUES (851, 'Bù Ðăng', 60, 3);
INSERT INTO `district` VALUES (852, 'Chơn Thành', 60, 4);
INSERT INTO `district` VALUES (853, 'Tam Đảo', 11, 8);
INSERT INTO `district` VALUES (854, 'Cát Bà', 70, 13);
INSERT INTO `district` VALUES (855, 'Bình Thủy', 72, 6);
INSERT INTO `district` VALUES (856, 'Huyện Hóc Môn', 3, 24);
INSERT INTO `district` VALUES (857, 'Ba Vì', 2, 17);
INSERT INTO `district` VALUES (858, 'Chương Mỹ', 2, 18);
INSERT INTO `district` VALUES (859, 'Đan Phượng', 2, 19);
INSERT INTO `district` VALUES (860, 'Hà Đông', 2, 20);
INSERT INTO `district` VALUES (861, 'Hoài Đức', 2, 21);
INSERT INTO `district` VALUES (862, 'Mỹ Đức', 2, 22);
INSERT INTO `district` VALUES (863, 'Phú Xuyên', 2, 23);
INSERT INTO `district` VALUES (864, 'Phúc Thọ', 2, 24);
INSERT INTO `district` VALUES (865, 'Quốc Oai', 2, 25);
INSERT INTO `district` VALUES (866, 'Sơn Tây', 2, 26);
INSERT INTO `district` VALUES (867, 'Thạch Thất', 2, 27);
INSERT INTO `district` VALUES (868, 'Thanh Oai', 2, 28);
INSERT INTO `district` VALUES (869, 'Thường Tín', 2, 29);
INSERT INTO `district` VALUES (871, 'Ứng Hòa', 2, 30);
INSERT INTO `district` VALUES (872, 'Gia Viễn', 32, 8);
INSERT INTO `district` VALUES (873, 'Cao Phong', 44, 11);
INSERT INTO `district` VALUES (874, 'Sốp Cộp', 22, 11);
INSERT INTO `district` VALUES (875, 'Cẩm Khê', 30, 13);
INSERT INTO `district` VALUES (876, 'Tân Sơn', 30, 14);
INSERT INTO `district` VALUES (877, 'Đông Hòa', 29, 7);
INSERT INTO `district` VALUES (878, 'Tây Hòa', 29, 8);
INSERT INTO `district` VALUES (879, 'Phú Hòa', 29, 9);
INSERT INTO `district` VALUES (880, 'Minh Hóa', 28, 7);
INSERT INTO `district` VALUES (881, 'Vũ Quang', 47, 11);
INSERT INTO `district` VALUES (882, 'Lộc Hà', 47, 12);
INSERT INTO `district` VALUES (883, 'Thái Hòa', 33, 20);
INSERT INTO `district` VALUES (884, 'Phước Long', 65, 5);
INSERT INTO `district` VALUES (885, 'Đông Hải', 65, 6);
INSERT INTO `district` VALUES (886, 'Hòa Bình', 65, 7);
INSERT INTO `district` VALUES (887, 'Năm Căn', 58, 8);
INSERT INTO `district` VALUES (888, 'Phú Tân', 58, 9);
INSERT INTO `district` VALUES (890, 'Châu Thành A', 45, 6);
INSERT INTO `district` VALUES (891, 'Ngã Bảy', 45, 7);
INSERT INTO `district` VALUES (892, 'Phong Điền', 72, 7);
INSERT INTO `district` VALUES (893, 'Cờ Đỏ', 72, 8);
INSERT INTO `district` VALUES (894, 'Thới Lai', 72, 9);
INSERT INTO `district` VALUES (895, 'Vĩnh Thạnh', 72, 10);
INSERT INTO `district` VALUES (896, 'Phú Giáo', 61, 8);
INSERT INTO `district` VALUES (897, 'La Gi', 59, 10);
INSERT INTO `district` VALUES (898, 'Long Điền', 68, 8);
INSERT INTO `district` VALUES (899, 'Đất Đỏ', 68, 9);
INSERT INTO `district` VALUES (900, 'Dương Kinh', 70, 14);

-- ----------------------------
-- Table structure for email_template
-- ----------------------------
DROP TABLE IF EXISTS `email_template`;
CREATE TABLE `email_template`  (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`email_template_id`) USING BTREE,
  UNIQUE INDEX `key`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for file
-- ----------------------------
DROP TABLE IF EXISTS `file`;
CREATE TABLE `file`  (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `orig_name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `vitual_path` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `table_map` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'product',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'image/jpeg',
  `size` int(11) NULL DEFAULT NULL,
  `status` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`file_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for help
-- ----------------------------
DROP TABLE IF EXISTS `help`;
CREATE TABLE `help`  (
  `help_id` int(11) NOT NULL AUTO_INCREMENT,
  `help_cat_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `router` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`help_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for help_cat
-- ----------------------------
DROP TABLE IF EXISTS `help_cat`;
CREATE TABLE `help_cat`  (
  `help_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`help_cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for language
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language`  (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `country_code` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `default` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`language_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES (1, 'en', 'English', 'A', 'us', 0);
INSERT INTO `language` VALUES (2, 'vi', 'Vietnam', 'A', 'vn', 1);

-- ----------------------------
-- Table structure for language_value
-- ----------------------------
DROP TABLE IF EXISTS `language_value`;
CREATE TABLE `language_value`  (
  `language_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `key` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`language_value_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 639 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of language_value
-- ----------------------------
INSERT INTO `language_value` VALUES (1, 'vi', 'Admin username is exist', '');
INSERT INTO `language_value` VALUES (2, 'vi', 'Admin emaiayout is exist', '');
INSERT INTO `language_value` VALUES (3, 'vi', 'Current password incorect', '');
INSERT INTO `language_value` VALUES (4, 'vi', 'Passwords do not match!!', '');
INSERT INTO `language_value` VALUES (5, 'vi', 'Update successful', '');
INSERT INTO `language_value` VALUES (6, 'vi', 'Admin add success', '');
INSERT INTO `language_value` VALUES (7, 'vi', 'Delete is success!', '');
INSERT INTO `language_value` VALUES (8, 'vi', 'Admin not exist', '');
INSERT INTO `language_value` VALUES (9, 'vi', 'Not delete admin account system', 'Không xóa được tài khoản của hệ thống');
INSERT INTO `language_value` VALUES (10, 'vi', 'Account not found', 'Tài khoản không tìm thấy');
INSERT INTO `language_value` VALUES (11, 'vi', 'Update successful.', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES (12, 'vi', 'Login Successfully', 'Đăng nhập thành công');
INSERT INTO `language_value` VALUES (13, 'vi', 'Account is disable', '');
INSERT INTO `language_value` VALUES (14, 'vi', 'Wrong username or password', 'Lỗi tên đăng nhập hoặc mật khẩu');
INSERT INTO `language_value` VALUES (15, 'vi', 'Customer username is exist', '');
INSERT INTO `language_value` VALUES (16, 'vi', 'Customer email is exist', '');
INSERT INTO `language_value` VALUES (17, 'vi', 'Password and confirm passwordemail is not match', '');
INSERT INTO `language_value` VALUES (18, 'vi', 'New password not empty', 'Mật khẩu mới không được để trống');
INSERT INTO `language_value` VALUES (19, 'vi', 'Confirm password not empty', '');
INSERT INTO `language_value` VALUES (20, 'vi', 'Customer add success', '');
INSERT INTO `language_value` VALUES (21, 'vi', 'Customer not exist', '');
INSERT INTO `language_value` VALUES (22, 'vi', 'Email Template key is exist', '');
INSERT INTO `language_value` VALUES (23, 'vi', 'Email Template add success', '');
INSERT INTO `language_value` VALUES (24, 'vi', 'Email Template update success', '');
INSERT INTO `language_value` VALUES (25, 'vi', 'Email Template not exist', '');
INSERT INTO `language_value` VALUES (26, 'vi', 'Changed settings successfully!', 'Thay đổi cấu hình thành công');
INSERT INTO `language_value` VALUES (27, 'vi', 'Language code is exist', '');
INSERT INTO `language_value` VALUES (28, 'vi', 'Default must select', '');
INSERT INTO `language_value` VALUES (29, 'vi', 'Status must active for default language', '');
INSERT INTO `language_value` VALUES (30, 'vi', 'Language add success', '');
INSERT INTO `language_value` VALUES (31, 'vi', 'Language update success', '');
INSERT INTO `language_value` VALUES (32, 'vi', 'Language delete success', '');
INSERT INTO `language_value` VALUES (33, 'vi', 'Language not exist', '');
INSERT INTO `language_value` VALUES (34, 'vi', 'Not delete default language', '');
INSERT INTO `language_value` VALUES (35, 'vi', 'Not delete this language. <br>Pre delete language value of this', '');
INSERT INTO `language_value` VALUES (36, 'vi', 'Language key is exist', '');
INSERT INTO `language_value` VALUES (37, 'vi', 'Language value is updated. <br>Language value added is %s', '');
INSERT INTO `language_value` VALUES (38, 'vi', 'All language value have <br>key = %s <br>is deleted', '');
INSERT INTO `language_value` VALUES (39, 'vi', 'Language value add success', '');
INSERT INTO `language_value` VALUES (40, 'vi', 'Layout is not action = $action', '');
INSERT INTO `language_value` VALUES (41, 'vi', '%s layout is success!', '');
INSERT INTO `language_value` VALUES (42, 'vi', 'Not action = $action in AdminLayoutController.', '');
INSERT INTO `language_value` VALUES (43, 'vi', 'Not action = $action in layout_widget_action_ajax.', '');
INSERT INTO `language_value` VALUES (44, 'vi', 'Not action = $action in layout_row_action_ajax', '');
INSERT INTO `language_value` VALUES (45, 'vi', 'Menu name is exist', '');
INSERT INTO `language_value` VALUES (46, 'vi', 'Menu add success', '');
INSERT INTO `language_value` VALUES (47, 'vi', 'Menu update success', '');
INSERT INTO `language_value` VALUES (48, 'vi', 'Menu not exist', '');
INSERT INTO `language_value` VALUES (49, 'vi', 'Plugin pluginCode is exist', '');
INSERT INTO `language_value` VALUES (50, 'vi', 'Not found file: plugin/$pluginCode/action.php', '');
INSERT INTO `language_value` VALUES (51, 'vi', 'Not found file: plugin/$pluginCode/config/action_config.php', '');
INSERT INTO `language_value` VALUES (52, 'vi', 'Plugin add success', '');
INSERT INTO `language_value` VALUES (53, 'vi', 'Plugin update success', '');
INSERT INTO `language_value` VALUES (54, 'vi', 'Plugin not exist', '');
INSERT INTO `language_value` VALUES (55, 'vi', 'Role name is exist', 'Tên role đã tồn tại');
INSERT INTO `language_value` VALUES (56, 'vi', 'Updated successfully!', '');
INSERT INTO `language_value` VALUES (57, 'vi', 'Add successfully!', '');
INSERT INTO `language_value` VALUES (58, 'vi', 'Not delete role system', '');
INSERT INTO `language_value` VALUES (59, 'vi', 'Not delete because exsit admin account have this role.', '');
INSERT INTO `language_value` VALUES (60, 'vi', 'Not delete because exsit customer account have this role.', '');
INSERT INTO `language_value` VALUES (61, 'vi', 'Router is exist', 'Router đã tồn tại');
INSERT INTO `language_value` VALUES (62, 'vi', 'Router add success', 'Thêm router thành công');
INSERT INTO `language_value` VALUES (63, 'vi', 'Router update success', 'Router cập nhật thành công');
INSERT INTO `language_value` VALUES (64, 'vi', 'Router not exist', 'Router đã tồn tại');
INSERT INTO `language_value` VALUES (65, 'vi', 'Setting not found', 'Cấu hình không tìm thấy');
INSERT INTO `language_value` VALUES (66, 'vi', 'Not found file %s', '');
INSERT INTO `language_value` VALUES (67, 'vi', 'Widget controller is exist', '');
INSERT INTO `language_value` VALUES (68, 'vi', 'Widget add success', '');
INSERT INTO `language_value` VALUES (69, 'vi', 'Widget update success', '');
INSERT INTO `language_value` VALUES (70, 'vi', 'Widget not exist', '');
INSERT INTO `language_value` VALUES (71, 'vi', 'Delete file $controller.php before delete widget', '');
INSERT INTO `language_value` VALUES (72, 'vi', 'Account not logined', '');
INSERT INTO `language_value` VALUES (73, 'vi', 'Make default shipping is success', '');
INSERT INTO `language_value` VALUES (74, 'vi', 'Make default billing is success', '');
INSERT INTO `language_value` VALUES (75, 'vi', 'Delete addess is success', '');
INSERT INTO `language_value` VALUES (76, 'vi', 'Orders #$orderId not exist', '');
INSERT INTO `language_value` VALUES (77, 'vi', 'Login false. Account is disable', '');
INSERT INTO `language_value` VALUES (78, 'vi', 'Login is successful!', 'Đăng nhập thành công');
INSERT INTO `language_value` VALUES (79, 'vi', 'Login false. Check your spelling and try again', 'Đăng nhập sai. Hãy kiểm tra lại tên đăng nhập hoặc mật khẩu');
INSERT INTO `language_value` VALUES (80, 'vi', 'Logout is successful!', 'Đăng xuất thành công');
INSERT INTO `language_value` VALUES (81, 'vi', 'Email is exist', 'Email đã tồn tại trong hệ thống');
INSERT INTO `language_value` VALUES (82, 'vi', 'Passwords length must bigger 6!', 'Mật khẩu phải có độ dài lớn hơn 6');
INSERT INTO `language_value` VALUES (83, 'vi', 'Passwords do not match!', 'Mật khẩu không khớp');
INSERT INTO `language_value` VALUES (84, 'vi', 'Date incorrect', '');
INSERT INTO `language_value` VALUES (85, 'vi', 'Register is successful!', 'Đăng ký thành công');
INSERT INTO `language_value` VALUES (86, 'vi', 'Account is active', '');
INSERT INTO `language_value` VALUES (87, 'vi', 'Verify is successful!', '');
INSERT INTO `language_value` VALUES (88, 'vi', 'Check email to reset password', '');
INSERT INTO `language_value` VALUES (89, 'vi', 'Reset password success', '');
INSERT INTO `language_value` VALUES (90, 'vi', 'Email not exist', 'Email đã tồn tại trong hệ thống');
INSERT INTO `language_value` VALUES (91, 'vi', 'Url incorrect. Please check again', '');
INSERT INTO `language_value` VALUES (92, 'vi', 'Email address or resetPasswordCode incorrect', '');
INSERT INTO `language_value` VALUES (93, 'vi', 'Select a country', 'Lựa chọn 1 đất nước');
INSERT INTO `language_value` VALUES (94, 'vi', '---', '');
INSERT INTO `language_value` VALUES (95, 'vi', 'Select a state', 'Chọn 1 bang');
INSERT INTO `language_value` VALUES (96, 'vi', 'Select a city', 'Chọn 1 thành phố');
INSERT INTO `language_value` VALUES (97, 'vi', 'Select a district', 'Chọn 1 quận/huyện');
INSERT INTO `language_value` VALUES (98, 'vi', 'Home', 'Trang chủ');
INSERT INTO `language_value` VALUES (99, 'vi', 'Product', 'Sản phẩm');
INSERT INTO `language_value` VALUES (100, 'vi', 'News', 'Tin tức');
INSERT INTO `language_value` VALUES (101, 'vi', 'News tag', 'Nhóm tin tức');
INSERT INTO `language_value` VALUES (102, 'vi', 'Image preview', 'Xem trước hình ảnh');
INSERT INTO `language_value` VALUES (103, 'vi', 'Select image', 'Chọn hình ảnh');
INSERT INTO `language_value` VALUES (104, 'vi', 'Edit Account', 'Sửa tài khoản');
INSERT INTO `language_value` VALUES (105, 'vi', 'Account information', 'Tài khoản admin');
INSERT INTO `language_value` VALUES (106, 'vi', 'Admin information', 'Thông tin admin');
INSERT INTO `language_value` VALUES (107, 'vi', 'Edit Admin', 'Sửa admin');
INSERT INTO `language_value` VALUES (108, 'vi', 'Add Admin', 'Thêm admin');
INSERT INTO `language_value` VALUES (109, 'vi', 'Feature is disable, this enable in edit mode', 'Tính năng bị vô hiệu hóa, nó sẽ được kích hoạt ở chế độ sửa');
INSERT INTO `language_value` VALUES (110, 'vi', 'Admin Manage', 'Quản lý admin');
INSERT INTO `language_value` VALUES (111, 'vi', 'Add Customer', 'Thêm khách hàng');
INSERT INTO `language_value` VALUES (112, 'vi', 'Edit Customer', 'Sửa khách hàng');
INSERT INTO `language_value` VALUES (113, 'vi', 'General', 'Thông tin chung');
INSERT INTO `language_value` VALUES (114, 'vi', 'Address', 'Địa chỉ');
INSERT INTO `language_value` VALUES (115, 'vi', 'Please save customer before add address', '');
INSERT INTO `language_value` VALUES (116, 'vi', 'District', '');
INSERT INTO `language_value` VALUES (117, 'vi', 'City', '');
INSERT INTO `language_value` VALUES (118, 'vi', 'State', '');
INSERT INTO `language_value` VALUES (119, 'vi', 'Country', '');
INSERT INTO `language_value` VALUES (120, 'vi', 'Post code', '');
INSERT INTO `language_value` VALUES (121, 'vi', 'Customer Manage', '');
INSERT INTO `language_value` VALUES (122, 'vi', 'Edit Email Template', 'Sửa mẫu email');
INSERT INTO `language_value` VALUES (123, 'vi', 'Add Email Template', 'Thêm mẫu email');
INSERT INTO `language_value` VALUES (124, 'vi', 'Email Template Manage', 'Quản lý mẫu email');
INSERT INTO `language_value` VALUES (125, 'vi', 'File Manager', 'Quản lý file');
INSERT INTO `language_value` VALUES (126, 'vi', 'File upload setting', 'Cấu hình file');
INSERT INTO `language_value` VALUES (127, 'vi', 'Field', 'Trường');
INSERT INTO `language_value` VALUES (128, 'vi', 'Type', 'Kiểu');
INSERT INTO `language_value` VALUES (129, 'vi', 'Null', 'Null1');
INSERT INTO `language_value` VALUES (130, 'vi', 'Key', 'Khóa');
INSERT INTO `language_value` VALUES (131, 'vi', 'Default', 'Mặc định');
INSERT INTO `language_value` VALUES (132, 'vi', 'Extra', '');
INSERT INTO `language_value` VALUES (133, 'vi', 'Table list', '');
INSERT INTO `language_value` VALUES (134, 'vi', 'Table info', '');
INSERT INTO `language_value` VALUES (135, 'vi', 'Add {tableText}', '');
INSERT INTO `language_value` VALUES (136, 'vi', 'Edit {tableText}', '');
INSERT INTO `language_value` VALUES (137, 'vi', '{tableText} name is exist', '');
INSERT INTO `language_value` VALUES (138, 'vi', '{tableText} add success', '');
INSERT INTO `language_value` VALUES (139, 'vi', '{tableText} update success', '');
INSERT INTO `language_value` VALUES (140, 'vi', '{tableText} not exist', '');
INSERT INTO `language_value` VALUES (141, 'vi', '{tableText} Manage', '');
INSERT INTO `language_value` VALUES (142, 'vi', 'Total orders', 'Tổng đơn hàng');
INSERT INTO `language_value` VALUES (143, 'vi', 'View more', 'Xem thêm');
INSERT INTO `language_value` VALUES (144, 'vi', 'Total products', 'Tổng sản phẩm');
INSERT INTO `language_value` VALUES (145, 'vi', 'Total category', 'Tổng danh mục');
INSERT INTO `language_value` VALUES (146, 'vi', 'Total customer', 'Tổng khách hàng');
INSERT INTO `language_value` VALUES (147, 'vi', 'Orders statistic', 'Thống kê đơn hàng theo giá trị');
INSERT INTO `language_value` VALUES (148, 'vi', 'Select all', 'Chọn tất cả');
INSERT INTO `language_value` VALUES (149, 'vi', 'Statistic by year', 'Thống kê theo năm');
INSERT INTO `language_value` VALUES (150, 'vi', 'Orders group by status', 'Thống kê đơn hàng theo trạng thái');
INSERT INTO `language_value` VALUES (151, 'vi', 'Orders latest', 'Đơn hàng tạo gần nhất');
INSERT INTO `language_value` VALUES (152, 'vi', 'Products latest', 'Sản phẩm thêm gần nhất');
INSERT INTO `language_value` VALUES (153, 'vi', 'Edit Language', '');
INSERT INTO `language_value` VALUES (154, 'vi', 'Add Language', '');
INSERT INTO `language_value` VALUES (155, 'vi', 'Language Manage', '');
INSERT INTO `language_value` VALUES (156, 'vi', 'Add language value', '');
INSERT INTO `language_value` VALUES (157, 'vi', 'Total: %s', 'Tổng tiền: %s');
INSERT INTO `language_value` VALUES (158, 'vi', 'Filter language name', '');
INSERT INTO `language_value` VALUES (159, 'vi', 'Language Value Manage', '');
INSERT INTO `language_value` VALUES (160, 'vi', 'Import auto', '');
INSERT INTO `language_value` VALUES (161, 'vi', 'This action will scan the entire source code to identify the language up will take time. Do you want to continue?', '');
INSERT INTO `language_value` VALUES (162, 'vi', 'Add widget', '');
INSERT INTO `language_value` VALUES (163, 'vi', 'Edit widget', '');
INSERT INTO `language_value` VALUES (164, 'vi', 'Row setting', '');
INSERT INTO `language_value` VALUES (165, 'vi', 'Widgets list is empty', '');
INSERT INTO `language_value` VALUES (166, 'vi', 'Add class', 'Thêm lớp');
INSERT INTO `language_value` VALUES (167, 'vi', 'Full width', '');
INSERT INTO `language_value` VALUES (168, 'vi', 'Yes', 'Có');
INSERT INTO `language_value` VALUES (169, 'vi', 'No', '');
INSERT INTO `language_value` VALUES (170, 'vi', 'Cols class', '');
INSERT INTO `language_value` VALUES (171, 'vi', 'Col', '');
INSERT INTO `language_value` VALUES (172, 'vi', 'Layout manage', 'Quản lý layout');
INSERT INTO `language_value` VALUES (173, 'vi', 'Layout', 'Layout');
INSERT INTO `language_value` VALUES (174, 'vi', 'Layout system', 'Layout hệ thống');
INSERT INTO `language_value` VALUES (175, 'vi', 'Desktop', '');
INSERT INTO `language_value` VALUES (176, 'vi', 'Mobile', '');
INSERT INTO `language_value` VALUES (177, 'vi', 'Option', '');
INSERT INTO `language_value` VALUES (178, 'vi', 'Custom Css', '');
INSERT INTO `language_value` VALUES (179, 'vi', 'Header', 'Đầu trang');
INSERT INTO `language_value` VALUES (180, 'vi', 'Main content', 'Nội dung chính');
INSERT INTO `language_value` VALUES (181, 'vi', 'Footer', 'Chân trang');
INSERT INTO `language_value` VALUES (182, 'vi', 'Layout row add success', 'Thêm dòng vào layout thành công');
INSERT INTO `language_value` VALUES (183, 'vi', 'Add a row', 'Thêm 1 dòng');
INSERT INTO `language_value` VALUES (184, 'vi', 'Cols', '');
INSERT INTO `language_value` VALUES (185, 'vi', 'Move row', '');
INSERT INTO `language_value` VALUES (186, 'vi', 'Delete row', '');
INSERT INTO `language_value` VALUES (187, 'vi', 'Setting row', '');
INSERT INTO `language_value` VALUES (188, 'vi', 'Delete widget', '');
INSERT INTO `language_value` VALUES (189, 'vi', 'Setting widget', '');
INSERT INTO `language_value` VALUES (190, 'vi', 'Navbar top', '');
INSERT INTO `language_value` VALUES (191, 'vi', 'Slidebar left', '');
INSERT INTO `language_value` VALUES (192, 'vi', 'Slidebar right', '');
INSERT INTO `language_value` VALUES (193, 'vi', 'Column class', '');
INSERT INTO `language_value` VALUES (194, 'vi', 'Layout row detele success', '');
INSERT INTO `language_value` VALUES (195, 'vi', 'Widget detele success', '');
INSERT INTO `language_value` VALUES (196, 'vi', 'This <b>Header</b> panel. Switch to <u>layout system</u> tab to config this', 'Đây là phần <b>Đầu trang</b>. Hãy chuyển qua phần <u>layout hệ thống</u> để cấu hình');
INSERT INTO `language_value` VALUES (197, 'vi', 'This <b>Footer</b> panel. Switch to <u>layout system</u> tab to config this', 'Đây là phần <b>Chân trang</b>. Hãy chuyển qua phần <u>layout hệ thống</u> để cấu hình');
INSERT INTO `language_value` VALUES (198, 'vi', 'Disable widgets', '');
INSERT INTO `language_value` VALUES (199, 'vi', 'Mobile layout setting', '');
INSERT INTO `language_value` VALUES (200, 'vi', 'System content', 'Nội dung hệ thống');
INSERT INTO `language_value` VALUES (201, 'vi', 'Administrator', '');
INSERT INTO `language_value` VALUES (202, 'vi', 'Login to your account', 'Đăng nhập vào hệ thống quản trị');
INSERT INTO `language_value` VALUES (203, 'vi', 'Enter username and password', 'Diền tên đăng nhập và mật khẩu');
INSERT INTO `language_value` VALUES (204, 'vi', 'Remember me', 'Ghi nhớ');
INSERT INTO `language_value` VALUES (205, 'vi', 'Login', 'Đăng nhập');
INSERT INTO `language_value` VALUES (206, 'vi', 'Forgot your password ?', '');
INSERT INTO `language_value` VALUES (207, 'vi', 'click here', '');
INSERT INTO `language_value` VALUES (208, 'vi', 'to reset your password', '');
INSERT INTO `language_value` VALUES (209, 'vi', 'Add Menu', 'Thêm menu');
INSERT INTO `language_value` VALUES (210, 'vi', 'Edit Menu', 'Sửa menu');
INSERT INTO `language_value` VALUES (211, 'vi', 'Menu Manage', 'Quản lý menu');
INSERT INTO `language_value` VALUES (212, 'vi', 'Edit menu', 'Sửa menu');
INSERT INTO `language_value` VALUES (213, 'vi', 'Add menu', 'Thêm menu');
INSERT INTO `language_value` VALUES (214, 'vi', 'Custom links', 'Nhập liên kết');
INSERT INTO `language_value` VALUES (215, 'vi', 'Pages', 'Trang tĩnh');
INSERT INTO `language_value` VALUES (216, 'vi', 'Categories', 'Danh mục sản phẩm');
INSERT INTO `language_value` VALUES (217, 'vi', 'Expand All', 'Mở rộng tất cả');
INSERT INTO `language_value` VALUES (218, 'vi', 'Collapse All', 'Thu gọn tất cả');
INSERT INTO `language_value` VALUES (219, 'vi', 'Menu info', 'Thông tin menu');
INSERT INTO `language_value` VALUES (220, 'vi', 'Save', 'Lưu');
INSERT INTO `language_value` VALUES (221, 'vi', 'Delete menu', 'Xóa menu');
INSERT INTO `language_value` VALUES (222, 'vi', 'Menu not found. Click add menu button to insert to menu.', '');
INSERT INTO `language_value` VALUES (223, 'vi', 'Edit Nav Link', '');
INSERT INTO `language_value` VALUES (224, 'vi', 'Add Nav Link', '');
INSERT INTO `language_value` VALUES (225, 'vi', 'Nav Link Manage', '');
INSERT INTO `language_value` VALUES (226, 'vi', 'Show info', '');
INSERT INTO `language_value` VALUES (227, 'vi', 'Add item', '');
INSERT INTO `language_value` VALUES (228, 'vi', 'Edit Plugin', '');
INSERT INTO `language_value` VALUES (229, 'vi', 'Add Plugin', '');
INSERT INTO `language_value` VALUES (230, 'vi', 'Plugin Manage', '');
INSERT INTO `language_value` VALUES (231, 'vi', 'Add role', 'Thêm quyền');
INSERT INTO `language_value` VALUES (232, 'vi', 'Edit role', 'Sửa quyền');
INSERT INTO `language_value` VALUES (234, 'vi', 'Permission', 'Quyền');
INSERT INTO `language_value` VALUES (235, 'vi', 'Add a new user group', 'Thêm mới 1 nhóm người dùng');
INSERT INTO `language_value` VALUES (236, 'vi', 'Edit user group', '');
INSERT INTO `language_value` VALUES (237, 'vi', 'Group Name', 'Nhóm quản trị');
INSERT INTO `language_value` VALUES (238, 'vi', 'Role Manage', 'Quản lý quyền');
INSERT INTO `language_value` VALUES (239, 'vi', 'Add Router', '');
INSERT INTO `language_value` VALUES (240, 'vi', 'Edit Router', 'Sửa router');
INSERT INTO `language_value` VALUES (241, 'vi', 'Router Manage', 'Quản lý router');
INSERT INTO `language_value` VALUES (242, 'vi', 'Settings for %s', 'Cấu hình cho %s');
INSERT INTO `language_value` VALUES (243, 'vi', 'Add Widget', '');
INSERT INTO `language_value` VALUES (244, 'vi', 'Edit Widget', '');
INSERT INTO `language_value` VALUES (245, 'vi', 'Widget Manage', '');
INSERT INTO `language_value` VALUES (246, 'vi', 'My account', 'Tài khoản của tôi');
INSERT INTO `language_value` VALUES (247, 'vi', 'Log out', 'Đăng xuất');
INSERT INTO `language_value` VALUES (248, 'vi', 'Settings', 'Cấu hình');
INSERT INTO `language_value` VALUES (249, 'vi', 'Dashboard', 'Bảng điều khiển');
INSERT INTO `language_value` VALUES (250, 'vi', 'Language manage', '');
INSERT INTO `language_value` VALUES (251, 'vi', 'Default language', '');
INSERT INTO `language_value` VALUES (252, 'vi', 'label', 'Nhãn');
INSERT INTO `language_value` VALUES (253, 'vi', 'description', 'Mô tả');
INSERT INTO `language_value` VALUES (254, 'vi', 'placeholder', '');
INSERT INTO `language_value` VALUES (255, 'vi', 'placeholder1', '');
INSERT INTO `language_value` VALUES (256, 'vi', 'placeholder2', '');
INSERT INTO `language_value` VALUES (257, 'vi', 'From', '');
INSERT INTO `language_value` VALUES (258, 'vi', 'text', '');
INSERT INTO `language_value` VALUES (259, 'vi', 'To', '');
INSERT INTO `language_value` VALUES (260, 'vi', 'Delete item', 'Xóa đối tượng');
INSERT INTO `language_value` VALUES (261, 'vi', 'Add image', 'Thêm hình ảnh');
INSERT INTO `language_value` VALUES (263, 'vi', 'Select All Backend', '');
INSERT INTO `language_value` VALUES (264, 'vi', 'Select All Frontend', '');
INSERT INTO `language_value` VALUES (265, 'vi', 'UnSelect All', 'Không chọn');
INSERT INTO `language_value` VALUES (266, 'vi', 'Add tag', '');
INSERT INTO `language_value` VALUES (267, 'vi', 'Choose from tags list', '');
INSERT INTO `language_value` VALUES (268, 'vi', 'Select tag', '');
INSERT INTO `language_value` VALUES (269, 'vi', 'Tags selected list', '');
INSERT INTO `language_value` VALUES (270, 'vi', 'Remove tag', '');
INSERT INTO `language_value` VALUES (271, 'vi', 'Tag name is required', '');
INSERT INTO `language_value` VALUES (272, 'vi', '%s star', '');
INSERT INTO `language_value` VALUES (273, 'vi', 'heading', '');
INSERT INTO `language_value` VALUES (274, 'vi', 'PAGE %s OF %s <i>(item %s of %s)</i>', 'Trang %s / %s <i>(số lượng %s / %s)</i>');
INSERT INTO `language_value` VALUES (275, 'vi', 'Go to first page', '');
INSERT INTO `language_value` VALUES (276, 'vi', 'Go to page %s', '');
INSERT INTO `language_value` VALUES (277, 'vi', 'Go to last page', '');
INSERT INTO `language_value` VALUES (278, 'vi', 'Back', 'Quay lại');
INSERT INTO `language_value` VALUES (279, 'vi', 'Reset', '');
INSERT INTO `language_value` VALUES (280, 'vi', 'More', 'Thông tin thêm');
INSERT INTO `language_value` VALUES (281, 'vi', 'Oops!<br>The site does not exist', 'Rất tiếc!<br>Địa chỉ trang web không tồn tại');
INSERT INTO `language_value` VALUES (282, 'vi', 'Go to home', 'Đi tới trang chủ');
INSERT INTO `language_value` VALUES (283, 'vi', 'Email', 'Email');
INSERT INTO `language_value` VALUES (284, 'vi', 'Password', 'Mật khẩu');
INSERT INTO `language_value` VALUES (285, 'vi', 'Confirm Password', 'Gõ lại mật khẩu');
INSERT INTO `language_value` VALUES (286, 'vi', 'Name', 'Tên');
INSERT INTO `language_value` VALUES (287, 'vi', 'Mobile Number', 'Số di động');
INSERT INTO `language_value` VALUES (288, 'vi', 'Birthday', 'Ngày sinh');
INSERT INTO `language_value` VALUES (289, 'vi', 'Update', 'Cập nhật');
INSERT INTO `language_value` VALUES (290, 'vi', 'Orders information', 'Thông tin đơn hàng');
INSERT INTO `language_value` VALUES (291, 'vi', 'Note', 'Ghi chú');
INSERT INTO `language_value` VALUES (292, 'vi', 'Total', 'Tồng tiền');
INSERT INTO `language_value` VALUES (293, 'vi', 'Created on', 'Ngày tạo');
INSERT INTO `language_value` VALUES (294, 'vi', 'Modified on', 'Người sửa');
INSERT INTO `language_value` VALUES (295, 'vi', 'Customer info', 'Thông tin khách hàng');
INSERT INTO `language_value` VALUES (296, 'vi', 'Phone', 'Điện thoại');
INSERT INTO `language_value` VALUES (297, 'vi', 'Product list', 'Danh mục sản phẩm');
INSERT INTO `language_value` VALUES (298, 'vi', 'Add Orders', 'Thêm đơn hàng');
INSERT INTO `language_value` VALUES (299, 'vi', 'Orders Subtotal', '');
INSERT INTO `language_value` VALUES (300, 'vi', 'Shipping price', '');
INSERT INTO `language_value` VALUES (301, 'vi', 'price', 'Giá');
INSERT INTO `language_value` VALUES (302, 'vi', 'Previous', 'Quay lại');
INSERT INTO `language_value` VALUES (303, 'vi', 'Next', 'Tiếp theo');
INSERT INTO `language_value` VALUES (304, 'vi', 'View all', 'Xem tất cả');
INSERT INTO `language_value` VALUES (305, 'vi', 'View less', 'Thu nhỏ lại');
INSERT INTO `language_value` VALUES (306, 'vi', 'Oops! The Page you requested was not found!', 'Rất tiếc! Trang web bạn yêu cầu không tìm thấy');
INSERT INTO `language_value` VALUES (307, 'vi', 'Return home', 'Quay lại trang chủ');
INSERT INTO `language_value` VALUES (308, 'vi', 'Admin login', '');
INSERT INTO `language_value` VALUES (309, 'vi', 'Apply', 'Áp dụng');
INSERT INTO `language_value` VALUES (310, 'vi', 'Administrator Panel', 'Bảng điều kiển');
INSERT INTO `language_value` VALUES (311, 'vi', 'Giỏ hàng (%s)', '');
INSERT INTO `language_value` VALUES (312, 'vi', 'Giỏ hàng', '');
INSERT INTO `language_value` VALUES (313, 'vi', '<i>FacebookCommentWidget apply for product detail page only</i>. \r\n					Go to <a href=', '');
INSERT INTO `language_value` VALUES (314, 'vi', 'Your shopping bag is empty', '');
INSERT INTO `language_value` VALUES (315, 'vi', 'SHOP NOW', 'MUA NGAY');
INSERT INTO `language_value` VALUES (316, 'vi', 'to find your favorite product', '');
INSERT INTO `language_value` VALUES (317, 'vi', 'Slider name is exist', '');
INSERT INTO `language_value` VALUES (318, 'vi', 'Slider add success', '');
INSERT INTO `language_value` VALUES (319, 'vi', 'Slider update success', '');
INSERT INTO `language_value` VALUES (320, 'vi', 'Slider not exist', '');
INSERT INTO `language_value` VALUES (321, 'vi', 'Edit Slider', '');
INSERT INTO `language_value` VALUES (322, 'vi', 'Add Slider', '');
INSERT INTO `language_value` VALUES (323, 'vi', 'Overview', '');
INSERT INTO `language_value` VALUES (324, 'vi', 'Images', 'Hình ảnh');
INSERT INTO `language_value` VALUES (325, 'vi', 'This function will enable in edit page!', '');
INSERT INTO `language_value` VALUES (326, 'vi', 'Add image is success', 'Thêm hình ảnh thành công');
INSERT INTO `language_value` VALUES (327, 'vi', 'Delete image is success', 'Xóa hình ảnh thành công');
INSERT INTO `language_value` VALUES (328, 'vi', 'Slider Manage', '');
INSERT INTO `language_value` VALUES (329, 'vi', 'Name is exist', '');
INSERT INTO `language_value` VALUES (330, 'vi', 'Add is success', '');
INSERT INTO `language_value` VALUES (331, 'vi', 'Update is success', '');
INSERT INTO `language_value` VALUES (332, 'vi', 'Delete attribute is success', 'Xóa thuộc tính thành công');
INSERT INTO `language_value` VALUES (333, 'vi', 'Product filter not exist', '');
INSERT INTO `language_value` VALUES (334, 'vi', 'Category name is exist', 'Danh mục sản phẩm đã tồn tại');
INSERT INTO `language_value` VALUES (335, 'vi', 'Cannot choose itself as its parent', 'Không được chọn danh mục con là cha');
INSERT INTO `language_value` VALUES (336, 'vi', 'Add category success!', 'Thêm danh mục thành cộng');
INSERT INTO `language_value` VALUES (337, 'vi', 'Edit category success!', '');
INSERT INTO `language_value` VALUES (338, 'vi', 'Delete Success!', '');
INSERT INTO `language_value` VALUES (339, 'vi', 'Category not exist', '');
INSERT INTO `language_value` VALUES (340, 'vi', 'Category not exist.', '');
INSERT INTO `language_value` VALUES (341, 'vi', 'Delete error! <br>Category have sub child', '');
INSERT INTO `language_value` VALUES (342, 'vi', 'Delete error! <br>Category have product', '');
INSERT INTO `language_value` VALUES (343, 'vi', 'Checkout update success', '');
INSERT INTO `language_value` VALUES (344, 'vi', 'Checkout is invalid', '');
INSERT INTO `language_value` VALUES (345, 'vi', 'Currency currencyCode is exist', '');
INSERT INTO `language_value` VALUES (346, 'vi', 'Currency default must select', '');
INSERT INTO `language_value` VALUES (347, 'vi', 'Status must active for default currency', '');
INSERT INTO `language_value` VALUES (348, 'vi', 'Currency add success', '');
INSERT INTO `language_value` VALUES (349, 'vi', 'Currency update success', '');
INSERT INTO `language_value` VALUES (350, 'vi', 'Currency not exist', '');
INSERT INTO `language_value` VALUES (351, 'vi', 'Not delete with default currency', '');
INSERT INTO `language_value` VALUES (352, 'vi', 'Manufac name is exist', '');
INSERT INTO `language_value` VALUES (353, 'vi', 'Manufac add success', '');
INSERT INTO `language_value` VALUES (354, 'vi', 'Manufac update success', '');
INSERT INTO `language_value` VALUES (355, 'vi', 'Manufac not exist', '');
INSERT INTO `language_value` VALUES (356, 'vi', 'Order Status name is exist', 'Tên trạng thái đơn hàng đã tồn tại');
INSERT INTO `language_value` VALUES (357, 'vi', 'Order Status add success', 'Thêm trạng thái đơn hàng thành công');
INSERT INTO `language_value` VALUES (358, 'vi', 'Order Status update success', 'Cập nhật trạng thái đơn hàng thành công');
INSERT INTO `language_value` VALUES (359, 'vi', 'Order Status not exist', 'Trạng thái đơn hàng không tồn tại');
INSERT INTO `language_value` VALUES (360, 'vi', 'Not delete status of system', 'Không được xóa trạng thái đơn hàng của hệ thống');
INSERT INTO `language_value` VALUES (361, 'vi', 'Orders update success', 'Đơn hàng cập nhật thành công');
INSERT INTO `language_value` VALUES (362, 'vi', 'Orders delete success', 'Đơn hàng  xóa thành công');
INSERT INTO `language_value` VALUES (363, 'vi', 'Product name is exist', 'Tên sản phẩm đã tồn tại');
INSERT INTO `language_value` VALUES (364, 'vi', 'Product code is exist', 'Mã sản phẩm đã tồn tại');
INSERT INTO `language_value` VALUES (365, 'vi', 'Add is success!', 'Thêm thành công');
INSERT INTO `language_value` VALUES (366, 'vi', 'Access deny', 'Truy cập bị từ chối');
INSERT INTO `language_value` VALUES (367, 'vi', 'Report status', '');
INSERT INTO `language_value` VALUES (368, 'vi', 'Report description', '');
INSERT INTO `language_value` VALUES (369, 'vi', 'error', 'Lỗi');
INSERT INTO `language_value` VALUES (370, 'vi', 'Not found product %s', 'Không tìm thấy sản phẩm %s');
INSERT INTO `language_value` VALUES (371, 'vi', 'add', 'Thêm');
INSERT INTO `language_value` VALUES (372, 'vi', 'Add product #%s', 'Thêm sản phẩm #%s');
INSERT INTO `language_value` VALUES (373, 'vi', 'no change', 'Không thay đổi');
INSERT INTO `language_value` VALUES (374, 'vi', 'edit', 'Sửa');
INSERT INTO `language_value` VALUES (375, 'vi', 'Edit product #%s width field [%s]', '');
INSERT INTO `language_value` VALUES (376, 'vi', 'Update is success!', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES (377, 'vi', 'Import product is success!', '');
INSERT INTO `language_value` VALUES (378, 'vi', 'Product not exist', 'Sản phẩm không tồn tại');
INSERT INTO `language_value` VALUES (379, 'vi', 'Action not support', 'Hành động không được hỗ trợ');
INSERT INTO `language_value` VALUES (380, 'vi', 'Product not delete. <br>Delete order before delete product', 'Không xóa được sản phẩm này.<br>Hãy xóa đơn hàng trước.');
INSERT INTO `language_value` VALUES (381, 'vi', 'Change product quantity is success', 'Thay đổi số lượng sản phẩm thành công');
INSERT INTO `language_value` VALUES (382, 'vi', 'Remove product is success', 'Xóa sản phẩm thành công');
INSERT INTO `language_value` VALUES (383, 'vi', 'Clear cart is success', 'Xóa giỏ hàng thành công');
INSERT INTO `language_value` VALUES (384, 'vi', 'Login Failed! Wrong username or password!', 'Dăng nhập lỗi. Kiểm tra lại tên đăng nhập hoặc mật khẩu');
INSERT INTO `language_value` VALUES (385, 'vi', 'Orders is success. Check your email to view detail', 'Đơn hàng được tạo thành công. Hãy kiểm tra email của bạn để biết thông tin chii tiết.');
INSERT INTO `language_value` VALUES (386, 'vi', 'Orders is empty', 'Đơn hàng trống');
INSERT INTO `language_value` VALUES (387, 'vi', 'Add product wishlist is success', 'Thêm sản phẩm quan tâm thành công');
INSERT INTO `language_value` VALUES (388, 'vi', 'You must be logged on to use this functions', 'Bạn phải đăng nhập mới thực hiện được chức năng này');
INSERT INTO `language_value` VALUES (389, 'vi', 'Delete product wishlist is success', 'Xóa sản phẩm quan tâm thành công');
INSERT INTO `language_value` VALUES (390, 'vi', 'Delete product wishlist is error', 'Xóa sản phẩm quan tâm có lỗi');
INSERT INTO `language_value` VALUES (391, 'vi', 'Delete all product wishlist is success', 'Toàn bộ sản phẩm quan tâm đã được thành công');
INSERT INTO `language_value` VALUES (392, 'vi', 'Emty---', 'Trống---');
INSERT INTO `language_value` VALUES (393, 'vi', 'New Attribute', 'Thêm thuộc tính');
INSERT INTO `language_value` VALUES (394, 'vi', 'Edit Attribute', 'Sửa thuộc tính');
INSERT INTO `language_value` VALUES (395, 'vi', 'Attribute Value', 'Giá trị thuộc tính');
INSERT INTO `language_value` VALUES (396, 'vi', 'Add attribute value', 'Thêm giá trị thuộc tính');
INSERT INTO `language_value` VALUES (397, 'vi', 'Attribute Manage', 'Quản lý thuộc tính');
INSERT INTO `language_value` VALUES (398, 'vi', 'Add Attribute', 'Thêm thuộc tính');
INSERT INTO `language_value` VALUES (399, 'vi', 'Edit Category', '');
INSERT INTO `language_value` VALUES (400, 'vi', 'Add Category', 'Thêm danh mục');
INSERT INTO `language_value` VALUES (401, 'vi', 'Category Manage', '');
INSERT INTO `language_value` VALUES (402, 'vi', 'Checkout %s edit [%s]', '');
INSERT INTO `language_value` VALUES (403, 'vi', 'Checkout %s add [%s]', '');
INSERT INTO `language_value` VALUES (404, 'vi', 'Setting', 'Cấu hình');
INSERT INTO `language_value` VALUES (405, 'vi', 'Add %s', 'Thêm %s');
INSERT INTO `language_value` VALUES (406, 'vi', 'Edit Currency', 'Sửa tiền tệ');
INSERT INTO `language_value` VALUES (407, 'vi', 'Add Currency', 'Thêm tiền tệ');
INSERT INTO `language_value` VALUES (408, 'vi', 'Currency Manage', 'Quản lý tiền tệ');
INSERT INTO `language_value` VALUES (409, 'vi', 'Edit Manufac', '');
INSERT INTO `language_value` VALUES (410, 'vi', 'Add Manufac', '');
INSERT INTO `language_value` VALUES (411, 'vi', 'Manufac Manage', '');
INSERT INTO `language_value` VALUES (412, 'vi', 'Add Order Status', 'Thêm trạng thái đơn hàng');
INSERT INTO `language_value` VALUES (413, 'vi', 'Edit Order Status', 'Sửa trạng thái đơn hàng');
INSERT INTO `language_value` VALUES (414, 'vi', 'Order Status Manage', 'Quản lý trạng thái đơn hàng');
INSERT INTO `language_value` VALUES (415, 'vi', 'Edit orders #$orderId', 'Sửa đơn hàng #%');
INSERT INTO `language_value` VALUES (416, 'vi', 'Add orders', '');
INSERT INTO `language_value` VALUES (417, 'vi', 'Status', 'Trạng thái');
INSERT INTO `language_value` VALUES (418, 'vi', 'Note (customer)', 'Ghi chú (khách hàng)');
INSERT INTO `language_value` VALUES (419, 'vi', 'Comment', 'Khách hàng');
INSERT INTO `language_value` VALUES (420, 'vi', 'History', 'Lịch sử');
INSERT INTO `language_value` VALUES (421, 'vi', 'Empty', 'Trống');
INSERT INTO `language_value` VALUES (422, 'vi', 'Orders Manage', 'Quản lý đơn hàng');
INSERT INTO `language_value` VALUES (423, 'vi', 'Export data', 'Xuất dữ liệu');
INSERT INTO `language_value` VALUES (424, 'vi', 'New product', 'Thêm sản phẩm mới');
INSERT INTO `language_value` VALUES (425, 'vi', 'Edit product', 'Sửa sản phẩm');
INSERT INTO `language_value` VALUES (426, 'vi', 'Extension', 'Mở rộng');
INSERT INTO `language_value` VALUES (427, 'vi', 'Please save product before add attribute', 'Làm ơn lưu sản phẩm trước khi sử dụng tính năng này');
INSERT INTO `language_value` VALUES (428, 'vi', 'Select a attribute', 'Chọn 1 thuộc tính');
INSERT INTO `language_value` VALUES (429, 'vi', 'Add attribute', 'Thêm thuộc tính');
INSERT INTO `language_value` VALUES (430, 'vi', 'Delete attribute', 'Xóa thuộc tính');
INSERT INTO `language_value` VALUES (431, 'vi', 'Select none', 'Không chọn');
INSERT INTO `language_value` VALUES (432, 'vi', 'Use char | to insert mutil attribute value.', '');
INSERT INTO `language_value` VALUES (433, 'vi', 'Show all image', 'Hiển thị toàn bộ hình ảnh');
INSERT INTO `language_value` VALUES (434, 'vi', 'Value', 'Giá trị');
INSERT INTO `language_value` VALUES (435, 'vi', 'Each image link or video (youtube) link write on per line', 'Mỗi liên kết (image, youtube) ghi trên 1 dòng');
INSERT INTO `language_value` VALUES (436, 'vi', 'Each image or video (youtube) write on per line', 'Mỗi liên kết (image, youtube) ghi trên 1 dòng');
INSERT INTO `language_value` VALUES (437, 'vi', 'Products Manage', 'Quản lý sản phẩm');
INSERT INTO `language_value` VALUES (438, 'vi', 'Add product', 'Thêm sản phẩm');
INSERT INTO `language_value` VALUES (439, 'vi', 'Advance action', 'Hành đồng nâng cao');
INSERT INTO `language_value` VALUES (440, 'vi', 'Import', 'Nhập dữ liệu');
INSERT INTO `language_value` VALUES (441, 'vi', 'Report file', '');
INSERT INTO `language_value` VALUES (442, 'vi', 'Image dir', '');
INSERT INTO `language_value` VALUES (443, 'vi', 'Copy folder path at File Manage', '');
INSERT INTO `language_value` VALUES (444, 'vi', 'Export', 'Xuất dữ liệu');
INSERT INTO `language_value` VALUES (445, 'vi', 'Checkout', 'Thanh toán');
INSERT INTO `language_value` VALUES (446, 'vi', 'Confirm orders', 'Xác nhận đơn hàng');
INSERT INTO `language_value` VALUES (447, 'vi', 'Please check back again to confirm orders', '');
INSERT INTO `language_value` VALUES (448, 'vi', 'Confirm', 'Xác nhận');
INSERT INTO `language_value` VALUES (449, 'vi', 'Category', 'Danh mục');
INSERT INTO `language_value` VALUES (450, 'vi', 'Filters', 'Bộ lọc');
INSERT INTO `language_value` VALUES (451, 'vi', 'ShopLips', '');
INSERT INTO `language_value` VALUES (452, 'vi', 'Show all options', '');
INSERT INTO `language_value` VALUES (453, 'vi', 'Clear fillters', '');
INSERT INTO `language_value` VALUES (454, 'vi', 'Price', 'Giá');
INSERT INTO `language_value` VALUES (455, 'vi', 'Search', 'Tìm kiếm');
INSERT INTO `language_value` VALUES (456, 'vi', 'Search results for', 'Kết quả tìm kiếm');
INSERT INTO `language_value` VALUES (457, 'vi', 'Sorry, beautiful', '');
INSERT INTO `language_value` VALUES (458, 'vi', 'We couldn', '');
INSERT INTO `language_value` VALUES (459, 'vi', 'Did you mean', '');
INSERT INTO `language_value` VALUES (460, 'vi', 'BUT DON', '');
INSERT INTO `language_value` VALUES (461, 'vi', 'Double check the spelling', '');
INSERT INTO `language_value` VALUES (462, 'vi', 'Limit your search to one or two words', '');
INSERT INTO `language_value` VALUES (463, 'vi', 'Be less specific—try using general words and terms to find similar products', '');
INSERT INTO `language_value` VALUES (464, 'vi', 'If you cannot find what you are looking for, why not let our trained staff recommend something', '');
INSERT INTO `language_value` VALUES (465, 'vi', 'Our Customer Service Representatives are available now to help', '');
INSERT INTO `language_value` VALUES (466, 'vi', 'Contact Us', 'Liên hệ');
INSERT INTO `language_value` VALUES (467, 'vi', 'or call', '');
INSERT INTO `language_value` VALUES (468, 'vi', 'quick shop', '');
INSERT INTO `language_value` VALUES (469, 'vi', 'Regular Price', '');
INSERT INTO `language_value` VALUES (470, 'vi', 'Sale Price', '');
INSERT INTO `language_value` VALUES (471, 'vi', 'NEW', 'Mới');
INSERT INTO `language_value` VALUES (472, 'vi', 'SALE', 'Giảm giá');
INSERT INTO `language_value` VALUES (473, 'vi', 'No data', '');
INSERT INTO `language_value` VALUES (474, 'vi', 'Continue shopping', 'Tiếp tục mua hàng');
INSERT INTO `language_value` VALUES (475, 'vi', 'Remove', '');
INSERT INTO `language_value` VALUES (476, 'vi', 'level == -1 => select all category <br>level == 0 => select category root only<br>level == 1[2,3..] => select category root and child 1st[2nd, 3th...]', '');
INSERT INTO `language_value` VALUES (477, 'vi', 'Product ID', 'ID sản phẩm');
INSERT INTO `language_value` VALUES (478, 'vi', 'Product name', 'Tên sản phẩm');
INSERT INTO `language_value` VALUES (479, 'vi', 'Product price', 'Giá sản phẩm');
INSERT INTO `language_value` VALUES (480, 'vi', 'Product discount', 'Giá khuyến mãi');
INSERT INTO `language_value` VALUES (481, 'vi', 'Descending', 'Giảm dần');
INSERT INTO `language_value` VALUES (482, 'vi', 'Ascending', 'Tăng dần');
INSERT INTO `language_value` VALUES (483, 'vi', '<i class=', '');
INSERT INTO `language_value` VALUES (484, 'vi', 'News Category name is exist', '');
INSERT INTO `language_value` VALUES (485, 'vi', 'News Category add success', '');
INSERT INTO `language_value` VALUES (486, 'vi', 'News Category update success', '');
INSERT INTO `language_value` VALUES (487, 'vi', 'News Category not exist', 'Danh mục tin tức không tồn tại');
INSERT INTO `language_value` VALUES (488, 'vi', 'Delete error! <br>Because category have child', '');
INSERT INTO `language_value` VALUES (489, 'vi', 'News title is exist', 'Tiêu đề của tin tức đã tồn tại');
INSERT INTO `language_value` VALUES (490, 'vi', 'News add success', 'Thêm tin tức thành công');
INSERT INTO `language_value` VALUES (491, 'vi', 'News update success', 'Cập nhật tin tức thành công');
INSERT INTO `language_value` VALUES (492, 'vi', 'News not exist', 'tin tức không tồn tại');
INSERT INTO `language_value` VALUES (493, 'vi', 'News Tag name is exist', 'Nhóm tin tức không tồn tại');
INSERT INTO `language_value` VALUES (494, 'vi', 'Add tag is success', '');
INSERT INTO `language_value` VALUES (495, 'vi', 'Tag is exist', '');
INSERT INTO `language_value` VALUES (496, 'vi', 'Remove tag is success', '');
INSERT INTO `language_value` VALUES (497, 'vi', 'News Tag add success', '');
INSERT INTO `language_value` VALUES (498, 'vi', 'News Tag update success', '');
INSERT INTO `language_value` VALUES (499, 'vi', 'News Tag not exist', '');
INSERT INTO `language_value` VALUES (500, 'vi', 'Edit News', 'Sửa tin tức');
INSERT INTO `language_value` VALUES (501, 'vi', 'Add News', 'Thêm tin tức');
INSERT INTO `language_value` VALUES (502, 'vi', 'Input data incorrect. Please check again', 'Nhập dữ liệu không đúng, vui lòng kiểm tra lại');
INSERT INTO `language_value` VALUES (503, 'vi', 'News Manage', 'Quản lý tin tức');
INSERT INTO `language_value` VALUES (504, 'vi', 'Add News Category', 'Thêm danh mục tin tức');
INSERT INTO `language_value` VALUES (505, 'vi', 'Edit News Category', 'Sửa danh mục tin tức');
INSERT INTO `language_value` VALUES (506, 'vi', 'News Category Manage', 'Quản lý dan mục tin tức');
INSERT INTO `language_value` VALUES (507, 'vi', 'Add News Tag', 'Thêm nhóm tin tức');
INSERT INTO `language_value` VALUES (508, 'vi', 'Edit News Tag', 'Sửa nhóm tin tức');
INSERT INTO `language_value` VALUES (509, 'vi', 'News Tag Manage', 'Quản lý nhóm tin tức');
INSERT INTO `language_value` VALUES (510, 'vi', 'Contact not exist', 'Liên hệ không tồn tại');
INSERT INTO `language_value` VALUES (511, 'vi', 'Your contact was sent to administrator', '');
INSERT INTO `language_value` VALUES (512, 'vi', 'Contact Manage', 'Quản lý liên hệ');
INSERT INTO `language_value` VALUES (513, 'vi', 'View Contact Info', '');
INSERT INTO `language_value` VALUES (514, 'vi', 'Static Page title is exist', 'Tiêu đề của trang tĩnh đã tồn tại');
INSERT INTO `language_value` VALUES (515, 'vi', 'Static Page add success', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES (516, 'vi', 'Static Page update success', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES (517, 'vi', 'Static Page not exist', 'Trang không tồn tại');
INSERT INTO `language_value` VALUES (518, 'vi', 'Page not exist', 'Trang không tồn tại');
INSERT INTO `language_value` VALUES (519, 'vi', 'Add Static Page', 'Thêm trang tĩnh');
INSERT INTO `language_value` VALUES (520, 'vi', 'Edit Static Page', 'Sửa trang tĩnh');
INSERT INTO `language_value` VALUES (521, 'vi', 'Static Page Manage', 'Quản lý trang tĩnh');
INSERT INTO `language_value` VALUES (522, 'vi', 'Customer Review name is exist', 'Tên đã tồn tại');
INSERT INTO `language_value` VALUES (523, 'vi', 'Customer Review add success', 'Nhận xét khách hàng thêm thành công');
INSERT INTO `language_value` VALUES (524, 'vi', 'Customer Review update success', 'Nhận xét khách hàng cập nhật thành công');
INSERT INTO `language_value` VALUES (525, 'vi', 'Customer Review not exist', 'Nhận xét khách hàng không tồn tại');
INSERT INTO `language_value` VALUES (526, 'vi', 'Add Customer Review', 'Thêm nhận xét khách hàng');
INSERT INTO `language_value` VALUES (527, 'vi', 'Edit Customer Review', 'Sửa nhận xét khách hàng');
INSERT INTO `language_value` VALUES (528, 'vi', 'Customer Review Manage', 'Nhận xét khách hàng');
INSERT INTO `language_value` VALUES (529, 'vi', 'Newsletter name is exist', '');
INSERT INTO `language_value` VALUES (530, 'vi', 'Newsletter add success', '');
INSERT INTO `language_value` VALUES (531, 'vi', 'Newsletter update success', '');
INSERT INTO `language_value` VALUES (532, 'vi', 'Newsletter not exist', '');
INSERT INTO `language_value` VALUES (533, 'vi', 'Newsletter email add success', '');
INSERT INTO `language_value` VALUES (534, 'vi', 'Newsletter email update success', '');
INSERT INTO `language_value` VALUES (535, 'vi', 'Send email newsletter success', '');
INSERT INTO `language_value` VALUES (536, 'vi', 'Newsletter Email not exist', '');
INSERT INTO `language_value` VALUES (537, 'vi', 'You email already subcribed!', 'Email của bạn đã được đăng ký');
INSERT INTO `language_value` VALUES (538, 'vi', 'Add Newsletter', '');
INSERT INTO `language_value` VALUES (539, 'vi', 'Edit Newsletter', '');
INSERT INTO `language_value` VALUES (540, 'vi', 'Newsletter Manage', '');
INSERT INTO `language_value` VALUES (541, 'vi', 'Add Newsletter Email', '');
INSERT INTO `language_value` VALUES (542, 'vi', 'Edit Newsletter Email', 'Sửa newsletter email template');
INSERT INTO `language_value` VALUES (543, 'vi', 'Newsletter Email Template Manage', 'Quản lý newsletter email template');
INSERT INTO `language_value` VALUES (544, 'vi', 'Add Newsletter Email Template', 'Thêm newsletter email template');
INSERT INTO `language_value` VALUES (545, 'vi', 'Send email newsletter', 'Gửi email newsletter');
INSERT INTO `language_value` VALUES (546, 'vi', 'Email list', 'Danh sách email');
INSERT INTO `language_value` VALUES (547, 'vi', 'Select newsletter email to send', 'Lựa chọn email từ danh sách newsletter để gửi');
INSERT INTO `language_value` VALUES (548, 'vi', 'Select customer email to send', ' Lựa chọn email từ danh sách khách hàng để gửi');
INSERT INTO `language_value` VALUES (549, 'vi', 'Send email', 'Gửi email');
INSERT INTO `language_value` VALUES (550, 'vi', 'Email sended list', 'Danh sách email đã gửi');
INSERT INTO `language_value` VALUES (551, 'vi', 'Email info', 'Thông tin email');
INSERT INTO `language_value` VALUES (552, 'vi', 'No email selected', 'Không có email được chọn');
INSERT INTO `language_value` VALUES (553, 'vi', 'Profile Center', '');
INSERT INTO `language_value` VALUES (554, 'vi', 'Help', 'Trợ giúp');
INSERT INTO `language_value` VALUES (555, 'vi', 'Welcome to your subscriber profile page', '');
INSERT INTO `language_value` VALUES (556, 'vi', 'You may use this page at any time to change or update the information you have provided us', '');
INSERT INTO `language_value` VALUES (557, 'vi', 'On This Page', '');
INSERT INTO `language_value` VALUES (558, 'vi', 'My Personal Information', '');
INSERT INTO `language_value` VALUES (559, 'vi', 'Unsubscribe From All', '');
INSERT INTO `language_value` VALUES (560, 'vi', 'Add or edit your personal information here. Once you have made changes to your information', '');
INSERT INTO `language_value` VALUES (561, 'vi', 'click the', '');
INSERT INTO `language_value` VALUES (562, 'vi', 'button', '');
INSERT INTO `language_value` VALUES (563, 'vi', 'Indicates a required field', '');
INSERT INTO `language_value` VALUES (564, 'vi', 'Email Address', '');
INSERT INTO `language_value` VALUES (565, 'vi', 'Top of Page', '');
INSERT INTO `language_value` VALUES (566, 'vi', 'If you wish to unsubscribe from ALL publications from', '');
INSERT INTO `language_value` VALUES (567, 'vi', 'check the box and click the update button below', '');
INSERT INTO `language_value` VALUES (568, 'vi', 'I no longer wish to receive any future publications', '');
INSERT INTO `language_value` VALUES (569, 'vi', 'Thank You', '');
INSERT INTO `language_value` VALUES (570, 'vi', 'You have been resubscribed to emails from', '');
INSERT INTO `language_value` VALUES (571, 'vi', 'To view and edit the information you have given us and manage how', '');
INSERT INTO `language_value` VALUES (572, 'vi', 'communicates with you', '');
INSERT INTO `language_value` VALUES (573, 'vi', 'visit the', '');
INSERT INTO `language_value` VALUES (574, 'vi', 'sign up for email', '');
INSERT INTO `language_value` VALUES (575, 'vi', 'close', '');
INSERT INTO `language_value` VALUES (576, 'vi', 'Thank you for signing up for our mailing list', '');
INSERT INTO `language_value` VALUES (577, 'vi', 'You have been unsubscribed from this publication', '');
INSERT INTO `language_value` VALUES (578, 'vi', 'If you wish to resubscribe to emails from', '');
INSERT INTO `language_value` VALUES (579, 'vi', 'click', '');
INSERT INTO `language_value` VALUES (580, 'vi', 'Resubscribe', '');
INSERT INTO `language_value` VALUES (581, 'vi', 'Contact', 'Liên hệ');
INSERT INTO `language_value` VALUES (582, 'vi', 'Product search', 'Tìm kiếm sản phẩm');
INSERT INTO `language_value` VALUES (583, 'vi', 'Count', 'Tổng số');
INSERT INTO `language_value` VALUES (584, 'vi', 'Orders total by day', 'Tổng tiền đơn hàng theo ngày');
INSERT INTO `language_value` VALUES (585, 'vi', 'Orders total by month', 'Tổng tiền đơn hàng theo tháng');
INSERT INTO `language_value` VALUES (586, 'vi', 'Orders total by year', 'Tổng tiền đơn hàng theo năm');
INSERT INTO `language_value` VALUES (587, 'vi', 'Create date', 'Ngày tạo');
INSERT INTO `language_value` VALUES (588, 'vi', 'Customer', 'Khách hàng');
INSERT INTO `language_value` VALUES (589, 'vi', 'Tool', 'Công cụ');
INSERT INTO `language_value` VALUES (590, 'vi', 'Summary', 'Tóm lược');
INSERT INTO `language_value` VALUES (591, 'vi', 'Title', 'Tiêu đề');
INSERT INTO `language_value` VALUES (592, 'vi', 'Image', 'Ảnh');
INSERT INTO `language_value` VALUES (593, 'vi', 'Page list', 'Danh sách trang');
INSERT INTO `language_value` VALUES (594, 'vi', 'Order', 'Thứ tự');
INSERT INTO `language_value` VALUES (595, 'vi', 'Product count', 'Số lượng sản phẩm');
INSERT INTO `language_value` VALUES (596, 'vi', 'Parent', 'Danh mục cha');
INSERT INTO `language_value` VALUES (597, 'vi', 'Category name', 'Danh mục');
INSERT INTO `language_value` VALUES (598, 'vi', 'Sale of (đ)', 'Giá gốc (đ)');
INSERT INTO `language_value` VALUES (599, 'vi', 'Price (đ)', 'Giá (đ)');
INSERT INTO `language_value` VALUES (600, 'vi', 'Image primary', 'Hình ảnh chính');
INSERT INTO `language_value` VALUES (601, 'vi', 'Attribute', 'Thuộc tính');
INSERT INTO `language_value` VALUES (602, 'vi', 'Link', 'Liên kết');
INSERT INTO `language_value` VALUES (603, 'vi', 'Menu list', 'Danh sách menu');
INSERT INTO `language_value` VALUES (604, 'vi', 'Career', 'Nghề nhiệp');
INSERT INTO `language_value` VALUES (605, 'vi', 'Content', 'Nội dung');
INSERT INTO `language_value` VALUES (606, 'vi', 'News count', 'Số lượng tin tức');
INSERT INTO `language_value` VALUES (607, 'vi', 'Subscribe', 'Theo dõi');
INSERT INTO `language_value` VALUES (608, 'vi', 'Subject', 'Tiêu đề');
INSERT INTO `language_value` VALUES (609, 'vi', 'Permission count', 'Số lượng quyền');
INSERT INTO `language_value` VALUES (610, 'vi', 'Role type', 'Kiễu');
INSERT INTO `language_value` VALUES (611, 'vi', 'Role name', 'Tên');
INSERT INTO `language_value` VALUES (612, 'vi', 'Alias by', 'Định danh theo');
INSERT INTO `language_value` VALUES (613, 'vi', 'Alias', 'Định danh');
INSERT INTO `language_value` VALUES (614, 'vi', 'Prefix', 'Tiền tố');
INSERT INTO `language_value` VALUES (615, 'vi', 'Suffix', 'Hậu tố');
INSERT INTO `language_value` VALUES (616, 'vi', 'Url Count', 'Số lượng url');
INSERT INTO `language_value` VALUES (617, 'vi', 'New password', 'Mật khẩu mới');
INSERT INTO `language_value` VALUES (618, 'vi', 'Current password', 'Mật khẩu hiện tại');
INSERT INTO `language_value` VALUES (619, 'vi', 'Receive email', 'Nhận email');
INSERT INTO `language_value` VALUES (620, 'vi', 'First name', 'Tên');
INSERT INTO `language_value` VALUES (621, 'vi', 'Site map is update success', 'Site map đã được cập nhật thành công');
INSERT INTO `language_value` VALUES (622, 'vi', 'Total link %s', 'Tổng số liên kết %s');
INSERT INTO `language_value` VALUES (623, 'vi', 'Product category page', 'Trang danh mục sản phẩm');
INSERT INTO `language_value` VALUES (624, 'vi', 'Product page', 'Trang sản phẩm');
INSERT INTO `language_value` VALUES (625, 'vi', 'News category page', 'Trang danh mục tin tức');
INSERT INTO `language_value` VALUES (626, 'vi', 'News page', 'Trang tin tức');
INSERT INTO `language_value` VALUES (627, 'vi', 'Static page page', 'Trang tĩnh');
INSERT INTO `language_value` VALUES (628, 'vi', 'Other page', 'Các trang còn lại');
INSERT INTO `language_value` VALUES (629, 'vi', 'View sitemap', 'Xem sitemap');
INSERT INTO `language_value` VALUES (630, 'vi', 'Sitemap info', 'Thông tin sitemap');
INSERT INTO `language_value` VALUES (631, 'vi', 'Product unit', 'Đơn vị tính');
INSERT INTO `language_value` VALUES (632, 'vi', 'Unit', 'Đơn vị tính');
INSERT INTO `language_value` VALUES (633, 'vi', 'Shipping cost', 'Phí giao hàng');
INSERT INTO `language_value` VALUES (634, 'vi', 'Discount', 'Chiết khấu');
INSERT INTO `language_value` VALUES (635, 'vi', 'Percen', 'Phần trăm %');
INSERT INTO `language_value` VALUES (636, 'vi', 'Add and close', 'Thêm và đóng');
INSERT INTO `language_value` VALUES (637, 'vi', 'Edit and close', 'Sửa và đóng');
INSERT INTO `language_value` VALUES (638, 'vi', 'Edit success', 'Cập nhật thành công');

-- ----------------------------
-- Table structure for layout
-- ----------------------------
DROP TABLE IF EXISTS `layout`;
CREATE TABLE `layout`  (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `dispatch` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `system_header` tinyint(1) NULL DEFAULT 1,
  `system_footer` tinyint(1) NULL DEFAULT 1,
  `layout_style` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `layout_script` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `plugin_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT 999,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`layout_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 405 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of layout
-- ----------------------------
INSERT INTO `layout` VALUES (1, 'Trang chủ', 'home', 1, 1, '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', NULL, 0, 'A');
INSERT INTO `layout` VALUES (404, 'Không tìm thấy (404)', 'home/404', 1, 1, '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', 404, 'A');

-- ----------------------------
-- Table structure for layout_row
-- ----------------------------
DROP TABLE IF EXISTS `layout_row`;
CREATE TABLE `layout_row`  (
  `layout_row_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `group` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '= header, footer if row is system row else = null',
  `cols` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `layout_widget_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `setting` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`layout_row_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of layout_row
-- ----------------------------
INSERT INTO `layout_row` VALUES (1, 1, 'mobile', 0, 0, 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES (2, 0, 'mobile_system', 0, 0, 'null', '[]', 'A');

-- ----------------------------
-- Table structure for layout_widget
-- ----------------------------
DROP TABLE IF EXISTS `layout_widget`;
CREATE TABLE `layout_widget`  (
  `layout_widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `layout_row_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `widget_controller` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'D',
  `setting` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `order` int(11) NULL DEFAULT 0,
  `status` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`layout_widget_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for menu_item
-- ----------------------------
DROP TABLE IF EXISTS `menu_item`;
CREATE TABLE `menu_item`  (
  `menu_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `table_id` int(11) NULL DEFAULT NULL,
  `params` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `level` int(11) NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for nav_link
-- ----------------------------
DROP TABLE IF EXISTS `nav_link`;
CREATE TABLE `nav_link`  (
  `nav_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `title` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `plugin_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`nav_link_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nav_link
-- ----------------------------
INSERT INTO `nav_link` VALUES (1, 0, 'System', '', '', 1, NULL);
INSERT INTO `nav_link` VALUES (2, 0, 'Website', '', 'icon-list', 2, NULL);
INSERT INTO `nav_link` VALUES (5, 1, 'Role manage', 'admin/role/manage', 'fa fa-unlock', 1, NULL);
INSERT INTO `nav_link` VALUES (6, 1, 'Email template', 'admin/email_template/manage', 'fa fa-envelope', 3, NULL);
INSERT INTO `nav_link` VALUES (7, 2, 'Layout manage', 'admin/layout/manage', 'fa fa-bars', 1, NULL);
INSERT INTO `nav_link` VALUES (8, 1, 'Language manage', 'admin/language/manage', 'fa fa-language', 4, NULL);
INSERT INTO `nav_link` VALUES (11, 10, 'Contact manage', 'admin/contact/manage&contactModel.status=P', 'fa fa-star', 1, NULL);
INSERT INTO `nav_link` VALUES (12, 10, 'Trainer manage', 'admin/trainer/manage', 'fa fa-support', 2, NULL);
INSERT INTO `nav_link` VALUES (13, 10, 'Album manage', 'admin/album/manage', 'fa fa-book', 3, NULL);
INSERT INTO `nav_link` VALUES (14, 10, 'Video manage', 'admin/video/manage', 'fa fa-youtube-play', 4, NULL);
INSERT INTO `nav_link` VALUES (55, 2, 'File manage', 'admin/file/manage', 'fa fa-bars', 2, NULL);
INSERT INTO `nav_link` VALUES (57, 54, 'File setting', 'admin/file/setting', 'icon-list', 1, NULL);
INSERT INTO `nav_link` VALUES (64, 63, 'Import', 'admin/extension/import', 'icon-list', NULL, NULL);
INSERT INTO `nav_link` VALUES (65, 63, 'Plugin', 'admin/extension/manage&extension_type=plugin', 'icon-list', NULL, NULL);
INSERT INTO `nav_link` VALUES (66, 63, 'Payment', 'admin/extension/manage&extension_type=payment', 'icon-list', NULL, NULL);
INSERT INTO `nav_link` VALUES (67, 63, 'Shipping', 'admin/extension/manage&extension_type=shipping', 'icon-list', NULL, NULL);
INSERT INTO `nav_link` VALUES (68, 63, 'Surcharge', 'admin/extension/manage&extension_type=surcharge', 'icon-list', NULL, NULL);
INSERT INTO `nav_link` VALUES (69, 1, 'Nav link manage', 'admin/nav_link/manage', 'fa fa-bars', 5, NULL);
INSERT INTO `nav_link` VALUES (70, 1, 'Admin manage', 'admin/admin/manage', 'fa fa-user', 2, NULL);
INSERT INTO `nav_link` VALUES (71, 10, 'Image slider', 'admin/slider/manage', 'fa fa-sliders', 5, NULL);
INSERT INTO `nav_link` VALUES (72, 2, 'Menu manage', 'admin/menu/manage', 'fa fa-bars', 3, NULL);
INSERT INTO `nav_link` VALUES (75, 0, 'Extra', '', '', 3, NULL);
INSERT INTO `nav_link` VALUES (76, 1, 'Router url', 'admin/router/manage', 'fa fa-link', 6, NULL);

-- ----------------------------
-- Table structure for plugin
-- ----------------------------
DROP TABLE IF EXISTS `plugin`;
CREATE TABLE `plugin`  (
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `priority` int(11) NULL DEFAULT 0,
  `file_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`plugin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'backend',
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'Guest', 'frontend');
INSERT INTO `role` VALUES (2, 'Member', 'frontend');
INSERT INTO `role` VALUES (4, 'Admin', 'backend');

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission`  (
  `role_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`role_permission_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES (1, 1, '[\"home\\/404\",\"home\",\"home\\/set\\/session\",\"home\\/lop_ca_nhan\",\"home\\/lop_nhom\",\"home\\/account\",\"home\\/account\\/address\",\"home\\/account\\/address\\/action\",\"home\\/account\\/orders\",\"home\\/logout\",\"home\\/login\",\"home\\/register\",\"home\\/register\\/validate\",\"home\\/account\\/verify\",\"home\\/forget_password\",\"home\\/reset_password\",\"home\\/google\\/login\",\"home\\/facebook\\/login\",\"home\\/facebook\\/login\\/callback\",\"home\\/twitter\\/login\",\"home\\/twitter\\/login\\/callback\",\"home\\/address_ajax\",\"home\\/customer\\/address\\/add\\/view\",\"home\\/customer\\/address\\/add\",\"home\\/customer\\/address\\/edit\\/view\",\"home\\/customer\\/address\\/edit\",\"home\\/customer\\/address\\/delete\\/view\",\"home\\/customer\\/address\\/delete\",\"home\\/customer\\/address\\/refresh\"]', 'A');
INSERT INTO `role_permission` VALUES (2, 2, '[\"home\\/404\",\"home\",\"home\\/set\\/session\",\"home\\/lop_ca_nhan\",\"home\\/lop_nhom\",\"home\\/account\",\"home\\/account\\/address\",\"home\\/account\\/address\\/action\",\"home\\/account\\/orders\",\"home\\/logout\",\"home\\/login\",\"home\\/register\",\"home\\/register\\/validate\",\"home\\/account\\/verify\",\"home\\/forget_password\",\"home\\/reset_password\",\"home\\/google\\/login\",\"home\\/facebook\\/login\",\"home\\/facebook\\/login\\/callback\",\"home\\/twitter\\/login\",\"home\\/twitter\\/login\\/callback\",\"home\\/address_ajax\",\"home\\/customer\\/address\\/add\\/view\",\"home\\/customer\\/address\\/add\",\"home\\/customer\\/address\\/edit\\/view\",\"home\\/customer\\/address\\/edit\",\"home\\/customer\\/address\\/delete\\/view\",\"home\\/customer\\/address\\/delete\",\"home\\/customer\\/address\\/refresh\"]', 'A');
INSERT INTO `role_permission` VALUES (4, 4, '[\"admin\\/404\",\"admin\\/account\",\"admin\\/login\",\"admin\\/logout\",\"admin\\/active\\/account\",\"admin\\/index\",\"admin\\/index\\/statistic_ajax\",\"admin\\/file\\/add_image_ajax\",\"admin\\/setting\\/manage\",\"admin\\/nav_link\\/manage\",\"admin\\/nav_link\\/action\",\"admin\\/menu\\/manage\",\"admin\\/menu\\/action\",\"admin\\/menu\\/validate_ajax\",\"admin\\/menu\\/add\",\"admin\\/menu\\/edit\",\"admin\\/menu\\/delete\",\"admin\\/router\\/manage\",\"admin\\/router\\/validate_ajax\",\"admin\\/router\\/add\",\"admin\\/router\\/edit\",\"admin\\/language\\/manage\",\"admin\\/language\\/validate_ajax\",\"admin\\/language\\/add\",\"admin\\/language\\/edit\",\"admin\\/language\\/delete\",\"admin\\/language_value\\/manage\",\"admin\\/language_value\\/add\",\"admin\\/language_value\\/add\\/validate\",\"admin\\/language_value\\/import_auto\",\"admin\\/language_value\\/save\",\"admin\\/language_value\\/delete\",\"admin\\/layout\\/manage\",\"admin\\/layout\\/layout_widget_action_ajax\",\"admin\\/layout\\/layout_row_action_ajax\",\"admin\\/file\\/manage\",\"admin\\/file\\/setting\",\"admin\\/role\\/manage\",\"admin\\/role\\/add\",\"admin\\/role\\/edit\",\"admin\\/role\\/validate_ajax\",\"admin\\/role\\/delete\",\"admin\\/admin\\/manage\",\"admin\\/admin\\/manage_ajax\",\"admin\\/admin\\/validate_ajax\",\"admin\\/admin\\/add\",\"admin\\/admin\\/edit\",\"admin\\/admin\\/delete\",\"admin\\/email_template\\/manage\",\"admin\\/email_template\\/validate_ajax\",\"admin\\/email_template\\/add\",\"admin\\/email_template\\/edit\",\"admin\\/email_template\\/delete\",\"admin\\/email_template\\/manage_ajax\",\"admin\\/plugin\\/manage\",\"admin\\/plugin\\/manage_ajax\",\"admin\\/plugin\\/validate_ajax\",\"admin\\/plugin\\/add\",\"admin\\/plugin\\/edit\",\"admin\\/plugin\\/delete\",\"admin\\/widget\\/manage\",\"admin\\/widget\\/validate_ajax\",\"admin\\/widget\\/add\",\"admin\\/widget\\/edit\",\"admin\\/widget\\/delete\",\"admin\\/customer\\/manage\",\"admin\\/customer\\/manage_ajax\",\"admin\\/customer\\/validate_ajax\",\"admin\\/customer\\/add\",\"admin\\/customer\\/edit\",\"admin\\/customer\\/delete\",\"admin\\/customer\\/export\",\"admin\\/gen_code\",\"admin\\/gen_code_action_ajax\"]', 'A');

-- ----------------------------
-- Table structure for router
-- ----------------------------
DROP TABLE IF EXISTS `router`;
CREATE TABLE `router`  (
  `router_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `pk_name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `prefix` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '',
  `suffix` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '\'\', short, full',
  `alias_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `alias_list` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `callback` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`router_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 405 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of router
-- ----------------------------
INSERT INTO `router` VALUES (1, 1, NULL, '', '', 'home', 'alias', '{\"alias\":\"alias\"}', NULL);
INSERT INTO `router` VALUES (404, 404, NULL, '', '', '404', 'alias', '{\"alias\":\"alias\"}', NULL);

-- ----------------------------
-- Table structure for router_url
-- ----------------------------
DROP TABLE IF EXISTS `router_url`;
CREATE TABLE `router_url`  (
  `router_url_id` int(11) NOT NULL AUTO_INCREMENT,
  `router_id` int(11) NOT NULL,
  `alias` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `dispatch` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `pk_name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `pk_value` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `redirect_to` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_del` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`router_url_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of router_url
-- ----------------------------
INSERT INTO `router_url` VALUES (1, 0, '404.html', 'home/404', '', '', '404', 0);
INSERT INTO `router_url` VALUES (2, 0, 'logout', 'home/logout', '', '', '', 0);
INSERT INTO `router_url` VALUES (3, 0, 'admin', 'admin/index', '', '', '', 0);
INSERT INTO `router_url` VALUES (11, 1, 'home', 'home', NULL, NULL, '', 0);
INSERT INTO `router_url` VALUES (12, 404, '404', 'home/404', NULL, NULL, '', 0);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `setting_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `setting_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NULL DEFAULT 0,
  `setting_group_id` int(11) NULL DEFAULT 0,
  `value_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'text',
  `function` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'functionName in arrayHelper get all value of this',
  `status` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  `required` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`setting_name`) USING BTREE,
  UNIQUE INDEX `setting_name_UNIQUE`(`setting_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('album_limit', '6', 'custom_page', 1, 11, 'number', '', 'A', 1);
INSERT INTO `setting` VALUES ('base_url', 'http://localhost/my_tool', 'general', 1, 4, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('checkout_done_message', '', 'custom_page', 2, 18, 'textarea', '', 'A', 0);
INSERT INTO `setting` VALUES ('checkout_done_message_mobile', '', 'custom_page', 3, 18, 'textarea', '', 'A', 1);
INSERT INTO `setting` VALUES ('checkout_info', '', 'custom_page', 1, 18, 'textarea', '', 'A', 0);
INSERT INTO `setting` VALUES ('company_address', '', 'company_info', 4, 17, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('company_email', '', 'company_info', 3, 17, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('company_google_map', '', 'company_info', 5, 17, 'textarea_only', '', 'A', 0);
INSERT INTO `setting` VALUES ('company_name', '', 'company_info', 1, 17, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('company_phone', '', 'company_info', 2, 17, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('contact_header', '', 'custom_page', 1, 19, 'textarea', '', 'A', 0);
INSERT INTO `setting` VALUES ('custom_css', '', '', 0, 0, 'textarea', NULL, 'D', 0);
INSERT INTO `setting` VALUES ('customer_support_username', '0', 'general', 1, 6, 'number', 'get10', 'D', 1);
INSERT INTO `setting` VALUES ('date_format', 'Y/m/d', 'general', 0, 5, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('date_picker_format', 'dd/mm/yyyy', 'general', 2, 5, 'text', '', 'A', 1);
INSERT INTO `setting` VALUES ('date_time_format', 'Y/m/d  H:i:s', 'general', 1, 5, 'text', '', 'A', 1);
INSERT INTO `setting` VALUES ('email_method', 'smtp', 'email', 2, 1, 'text', 'getEmailMethod', 'A', 1);
INSERT INTO `setting` VALUES ('email_send_allow', '1', 'email', 1, 1, 'text', 'get10', 'A', 1);
INSERT INTO `setting` VALUES ('facebook_app_id', '1972176876399096', 'facebook_api', 0, 21, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('facebook_app_secret', '05097725a057ff6b8bd5b2641572593d', 'facebook_api', 1, 21, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('facebook_redirect_url', 'http://localhost/my_tool/index.php?r=home/facebook/login/callback', 'facebook_api', 2, 21, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('font_family', '', 'general', 1, 24, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('font_link', '', 'general', 0, 24, 'textarea_only', '', 'A', 0);
INSERT INTO `setting` VALUES ('font_size', '', 'general', 2, 24, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('from_email_address', 'my_tool.smtp@gmail.com', 'email', 1, 3, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('google_client_id', '327444993154-nani2be29kvleb01f33hckq6avb5bhgl.apps.googleusercontent.com', 'google_api', 0, 22, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('google_client_secret', 'IbgUQeomkQ422XdpDbmMIHFU', 'google_api', 1, 22, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('google_redirect_url', 'http://localhost/my_tool/index.php?r=home/google/login', 'google_api', 2, 22, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('image_large_height', '400', 'file_upload', 0, 9, 'number', NULL, 'D', 1);
INSERT INTO `setting` VALUES ('image_large_width', '400', 'file_upload', 0, 9, 'number', NULL, 'D', 1);
INSERT INTO `setting` VALUES ('image_max_height', '1024', 'file_upload', 0, 9, 'number', NULL, 'D', 1);
INSERT INTO `setting` VALUES ('image_max_width', '1024', 'file_upload', 0, 9, 'number', NULL, 'D', 1);
INSERT INTO `setting` VALUES ('image_small_height', '100', 'file_upload', 0, 9, 'number', NULL, 'D', 1);
INSERT INTO `setting` VALUES ('image_small_width', '100', 'file_upload', 0, 9, 'number', NULL, 'D', 1);
INSERT INTO `setting` VALUES ('item_per_page', '20', 'general', 5, 4, 'number', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('logo', 'http://localhost/my_tool/upload/images/no-image.png', 'general', 2, 6, 'file', '', 'A', 1);
INSERT INTO `setting` VALUES ('logo_small', 'http://localhost/my_tool/upload/images/no-image.png', 'general', 4, 6, 'file', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('meta_description', 'Meta description', 'seo', 2, 15, 'text', '', 'A', 1);
INSERT INTO `setting` VALUES ('meta_keywords', 'Meta keywords', 'seo', 1, 15, 'text', '', 'A', 1);
INSERT INTO `setting` VALUES ('no_image', 'http://localhost/my_tool/upload/images/no-image.png', 'general', 0, 4, 'text', '', 'D', 1);
INSERT INTO `setting` VALUES ('numbers_orders_latest', '6', 'custom_page', 2, 13, 'number', '', 'A', 1);
INSERT INTO `setting` VALUES ('numbers_product_latest', '6', 'custom_page', 3, 13, 'number', '', 'A', 1);
INSERT INTO `setting` VALUES ('option_resize', '3', 'file_upload', 0, 9, 'text', NULL, 'D', 1);
INSERT INTO `setting` VALUES ('orders_statistic_step', '2000000', 'custom_page', 1, 13, 'number', '', 'A', 1);
INSERT INTO `setting` VALUES ('product_import_image_dir', 'upload/images/san-pham', 'shop', 0, 0, 'text', '', 'D', 1);
INSERT INTO `setting` VALUES ('product_import_report_file', 'upload/report/product-import-report [2016y-12m-04d-23h-18m-16s].xlsx', 'shop', 0, 0, 'text', '', 'D', 1);
INSERT INTO `setting` VALUES ('product_required_code', '1', '', 0, 0, 'text', '', 'D', 0);
INSERT INTO `setting` VALUES ('router_url', '1', 'router_url', 1, 7, 'number', 'get10', 'A', 1);
INSERT INTO `setting` VALUES ('script_on_footer', '', 'custom_page', 2, 20, 'textarea_only', '', 'A', 0);
INSERT INTO `setting` VALUES ('script_on_head', '', 'custom_page', 1, 20, 'textarea_only', '', 'A', 0);
INSERT INTO `setting` VALUES ('ship_info', '', 'custom_page', 1, 14, 'textarea', '', 'A', 1);
INSERT INTO `setting` VALUES ('site_icon', 'http://localhost/my_tool/upload/images/no-image.png', 'general', 1, 6, 'file', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('site_name', 'my_tool', 'general', 2, 4, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('smtp_auth', '1', 'email', 5, 2, 'text', 'getEmailSmtpAuth', 'A', 1);
INSERT INTO `setting` VALUES ('smtp_host', 'smtp.gmail.com', 'email', 1, 2, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('smtp_port', '465', 'email', 2, 2, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('smtp_pwd', 'my_tool123', 'email', 4, 2, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('smtp_secure', 'ssl', 'email', 6, 2, 'text', 'getEmailSmtpSecure', 'A', 1);
INSERT INTO `setting` VALUES ('smtp_user', 'my_tool.smtp@gmail.com', 'email', 3, 2, 'text', NULL, 'A', 1);
INSERT INTO `setting` VALUES ('social_facebook', 'http://www.facebook.com/my_tool', 'seo', 1, 16, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('social_google_plus', 'http://plus.google.com/my_tool', 'seo', 2, 16, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('social_instagram', 'http://instagram.com/my_tool', 'seo', 5, 16, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('social_pinterest', 'http://www.pinterest.com/my_tool', 'seo', 6, 16, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('social_twitter', 'http://twitter.com/my_tool', 'seo', 4, 16, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('social_youtube', 'http://www.youtube.com/channel/my_tool', 'seo', 3, 16, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('sologan', '', 'general', 3, 4, 'text', '', 'D', 1);
INSERT INTO `setting` VALUES ('twitter_consumer_key', 'k7ICGU8Gfrre45ypPpYr3hptA', 'twitter_api', 0, 23, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('twitter_consumer_secret', 'Hqy141Nx36TvRTVfpopmL1GvT4HnqosD58VUaVWr2T55VKmhpu', 'twitter_api', 1, 23, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('twitter_oauth_callback', 'http://103.200.22.81/vdato_empty/index.php?r=home/twitter', 'twitter_api', 2, 23, 'text', '', 'A', 0);
INSERT INTO `setting` VALUES ('video_limit', '6', 'custom_page', 2, 11, 'number', NULL, 'A', 1);

-- ----------------------------
-- Table structure for setting_group
-- ----------------------------
DROP TABLE IF EXISTS `setting_group`;
CREATE TABLE `setting_group`  (
  `setting_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`setting_group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setting_group
-- ----------------------------
INSERT INTO `setting_group` VALUES (1, 'email', 'General', 2, 'A');
INSERT INTO `setting_group` VALUES (2, 'email', 'SMTP server settings', 2, 'A');
INSERT INTO `setting_group` VALUES (3, 'email', 'Email settings', 2, 'A');
INSERT INTO `setting_group` VALUES (4, 'general', 'General', 1, 'A');
INSERT INTO `setting_group` VALUES (5, 'general', 'Date format', 1, 'A');
INSERT INTO `setting_group` VALUES (6, 'general', 'Image', 1, 'A');
INSERT INTO `setting_group` VALUES (7, 'router_url', 'General', 11, 'A');
INSERT INTO `setting_group` VALUES (9, 'file_upload', 'General', 9, 'D');
INSERT INTO `setting_group` VALUES (11, 'custom_page', 'Trang chủ', 5, 'A');
INSERT INTO `setting_group` VALUES (13, 'custom_page', 'Dashboard', 5, 'D');
INSERT INTO `setting_group` VALUES (14, 'custom_page', 'Trang sản phẩm', 5, 'D');
INSERT INTO `setting_group` VALUES (15, 'seo', 'General', 3, 'A');
INSERT INTO `setting_group` VALUES (16, 'seo', 'Social', 3, 'D');
INSERT INTO `setting_group` VALUES (17, 'company_info', 'General', 4, 'D');
INSERT INTO `setting_group` VALUES (18, 'custom_page', 'Trang thanh toán', 5, 'D');
INSERT INTO `setting_group` VALUES (19, 'custom_page', 'Trang liên hệ', 5, 'A');
INSERT INTO `setting_group` VALUES (20, 'custom_page', 'Mã JavaScript', 5, 'A');
INSERT INTO `setting_group` VALUES (21, 'facebook_api', 'Facebook api', 10, 'D');
INSERT INTO `setting_group` VALUES (22, 'google_api', 'Google api', 10, 'D');
INSERT INTO `setting_group` VALUES (23, 'twitter_api', 'Twitter api', 10, 'D');
INSERT INTO `setting_group` VALUES (24, 'general', 'Font', 1, 'D');

-- ----------------------------
-- Table structure for template
-- ----------------------------
DROP TABLE IF EXISTS `template`;
CREATE TABLE `template`  (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`template_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of template
-- ----------------------------
INSERT INTO `template` VALUES (1, 'theme.basic', 'A');

-- ----------------------------
-- Table structure for widget
-- ----------------------------
DROP TABLE IF EXISTS `widget`;
CREATE TABLE `widget`  (
  `widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_cat_id` int(11) NOT NULL,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `plugin_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'A',
  PRIMARY KEY (`widget_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of widget
-- ----------------------------
INSERT INTO `widget` VALUES (1, 1, 'Văn bản', 'TextWidget', 'Widget hiển thị nội dung là 1 đoạn văn bản hoạc code html', 'fa fa-font', '', 'A');
INSERT INTO `widget` VALUES (2, 1, 'Hình ảnh', 'ImageWidget', 'Widget hiển thị hình ảnh', 'fa fa-image', NULL, 'A');
INSERT INTO `widget` VALUES (3, 100, 'Custom View***', 'CustomViewWidget', 'Widget đặc biệt sử lý các tác vụ phức tạp', 'fa fa-star', NULL, 'A');
INSERT INTO `widget` VALUES (4, 100, 'Main Content ***', 'MainContentWidget', 'Widget hiển thị nội dung chính của trang', 'fa fa-star', '', 'A');
INSERT INTO `widget` VALUES (5, 2, 'Trình chiếu ảnh', 'LightSliderImageWidget', 'Widget hiển thị slider ảnh', 'fa fa-sliders', 'slider', 'A');
INSERT INTO `widget` VALUES (11, 1, 'Menu', 'MenuWidget', 'Widget hiển thị menu', 'fa fa-bars', '', 'A');
INSERT INTO `widget` VALUES (12, 2, 'Youtube', 'YoutubeWidget', 'Widget hiển thị youtube video', 'fa fa-youtube-square', '', 'A');
INSERT INTO `widget` VALUES (13, 2, 'Facebook Like Box', 'FacebookLikeBoxWidget', 'Widget hiển thị fabook like box', 'fa fa-facebook-square', '', 'A');
INSERT INTO `widget` VALUES (15, 2, 'Facebook Comment', 'FacebookCommentWidget', 'Display a facebook comment on your site', 'fa fa-comment', '', 'D');
INSERT INTO `widget` VALUES (16, 2, 'Breadcrumb', 'BreadcrumbWidget', 'Widget hiển thị breadcrumb cùa sản phẩm, tìn bài...', 'fa fa-map-signs', '', 'A');
INSERT INTO `widget` VALUES (20, 2, 'YoutubeRandom', 'YoutubeRandomWidget', 'Display a youtube video random on your site', 'fa fa-youtube', '', 'D');
INSERT INTO `widget` VALUES (30, 4, 'Tin tức mới nhất', 'NewsLatestWidget', 'Widget hiển thị tức mới nhất', 'fa fa-newspaper-o', 'news', 'A');
INSERT INTO `widget` VALUES (31, 4, 'Danh mục tin tức', 'NewsCategoryWidget', 'Widget hiển thị danh mục tin tức', 'fa fa-newspaper-o', 'news', 'A');
INSERT INTO `widget` VALUES (32, 4, 'Tin tức liên quan', 'NewsRelateWidget', 'Widget hiển thị tin tức liên quan', 'fa fa-newspaper-o', 'news', 'A');
INSERT INTO `widget` VALUES (33, 1, 'HTML', 'HtmlWidget', 'Widget hiển thị nội dung là 1 đoạn code html', 'fa fa-code', '', 'A');

-- ----------------------------
-- Table structure for widget_cat
-- ----------------------------
DROP TABLE IF EXISTS `widget_cat`;
CREATE TABLE `widget_cat`  (
  `widget_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`widget_cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of widget_cat
-- ----------------------------
INSERT INTO `widget_cat` VALUES (1, 'Basic ', 'Interface containing basic widgets');
INSERT INTO `widget_cat` VALUES (2, 'Extension', 'Interface containing extension widgets');
INSERT INTO `widget_cat` VALUES (3, 'Product', 'Widget  list of plugin shop');
INSERT INTO `widget_cat` VALUES (4, 'News', 'Widget  list of plugin news');
INSERT INTO `widget_cat` VALUES (100, 'Special', 'Widget  list of plugin news');

SET FOREIGN_KEY_CHECKS = 1;
