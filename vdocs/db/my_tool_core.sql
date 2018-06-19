/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : my_tool

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-06-02 14:47:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT 'en',
  `crt_date` datetime DEFAULT NULL,
  `crt_by` int(11) DEFAULT NULL,
  `mod_date` datetime DEFAULT NULL,
  `mod_by` int(11) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_false` tinyint(4) DEFAULT '0',
  `active_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', '4', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'my_tool@gmail.com', 'en', null, null, null, null, 'A', '0', '');

-- ----------------------------
-- Table structure for admin_detail
-- ----------------------------
DROP TABLE IF EXISTS `admin_detail`;
CREATE TABLE `admin_detail` (
  `admin_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT '1' COMMENT '=1(male) else =0(female)',
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`admin_detail_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admin_detail
-- ----------------------------
INSERT INTO `admin_detail` VALUES ('1', '1', 'Admin', '123456', 'address', 'upload/images/admin.png', '1', '1984-10-27');

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT '0',
  PRIMARY KEY (`city_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('3', 'TP.HCM', '2', '242', '0');
INSERT INTO `city` VALUES ('2', 'Hà Nội', '1', '242', '0');
INSERT INTO `city` VALUES ('10', 'Yên Bái', '999', '242', '0');
INSERT INTO `city` VALUES ('11', 'Vĩnh Phúc', '999', '242', '0');
INSERT INTO `city` VALUES ('12', 'Vĩnh Long', '999', '242', '0');
INSERT INTO `city` VALUES ('13', 'Tuyên Quang', '999', '242', '0');
INSERT INTO `city` VALUES ('14', 'Trà Vinh', '999', '242', '0');
INSERT INTO `city` VALUES ('15', 'Tiền Giang', '999', '242', '0');
INSERT INTO `city` VALUES ('16', 'Thừa Thiên Huế', '999', '242', '0');
INSERT INTO `city` VALUES ('17', 'Thanh Hóa', '999', '242', '0');
INSERT INTO `city` VALUES ('18', 'Thái Nguyên', '999', '242', '0');
INSERT INTO `city` VALUES ('19', 'Thái Bình', '999', '242', '0');
INSERT INTO `city` VALUES ('21', 'Tây Ninh', '999', '242', '0');
INSERT INTO `city` VALUES ('22', 'Sơn La', '999', '242', '0');
INSERT INTO `city` VALUES ('23', 'Sóc Trăng', '999', '242', '0');
INSERT INTO `city` VALUES ('24', 'Quảng Trị', '999', '242', '0');
INSERT INTO `city` VALUES ('25', 'Quảng Ninh', '999', '242', '0');
INSERT INTO `city` VALUES ('26', 'Quảng Ngãi', '999', '242', '0');
INSERT INTO `city` VALUES ('27', 'Quảng Nam', '999', '242', '0');
INSERT INTO `city` VALUES ('28', 'Quảng Bình', '999', '242', '0');
INSERT INTO `city` VALUES ('29', 'Phú Yên', '999', '242', '0');
INSERT INTO `city` VALUES ('30', 'Phú Thọ', '999', '242', '0');
INSERT INTO `city` VALUES ('31', 'Ninh Thuận', '999', '242', '0');
INSERT INTO `city` VALUES ('32', 'Ninh Bình', '999', '242', '0');
INSERT INTO `city` VALUES ('33', 'Nghệ An', '999', '242', '0');
INSERT INTO `city` VALUES ('34', 'Nam Định', '999', '242', '0');
INSERT INTO `city` VALUES ('35', 'Long An', '999', '242', '0');
INSERT INTO `city` VALUES ('36', 'Lào Cai', '999', '242', '0');
INSERT INTO `city` VALUES ('37', 'Lạng Sơn', '999', '242', '0');
INSERT INTO `city` VALUES ('38', 'Lâm Đồng', '999', '242', '0');
INSERT INTO `city` VALUES ('39', 'Lai Châu', '999', '242', '0');
INSERT INTO `city` VALUES ('40', 'Kon Tum', '999', '242', '0');
INSERT INTO `city` VALUES ('41', 'Kiên Giang', '999', '242', '0');
INSERT INTO `city` VALUES ('42', 'Khánh Hòa', '999', '242', '0');
INSERT INTO `city` VALUES ('43', 'Hưng Yên', '999', '242', '0');
INSERT INTO `city` VALUES ('44', 'Hòa Bình', '999', '242', '0');
INSERT INTO `city` VALUES ('45', 'Hậu Giang', '999', '242', '0');
INSERT INTO `city` VALUES ('46', 'Hải Dương', '999', '242', '0');
INSERT INTO `city` VALUES ('47', 'Hà Tĩnh', '999', '242', '0');
INSERT INTO `city` VALUES ('49', 'Hà Nam ', '999', '242', '0');
INSERT INTO `city` VALUES ('50', 'Hà Giang', '999', '242', '0');
INSERT INTO `city` VALUES ('51', 'Gia Lai', '999', '242', '0');
INSERT INTO `city` VALUES ('52', 'Đồng Tháp', '999', '242', '0');
INSERT INTO `city` VALUES ('53', 'Đồng Nai', '999', '242', '0');
INSERT INTO `city` VALUES ('54', 'Điện Biên', '999', '242', '0');
INSERT INTO `city` VALUES ('55', 'Đắk Nông', '999', '242', '0');
INSERT INTO `city` VALUES ('56', 'Đắk Lắk', '999', '242', '0');
INSERT INTO `city` VALUES ('57', 'Cao Bằng', '999', '242', '0');
INSERT INTO `city` VALUES ('58', 'Cà Mau', '999', '242', '0');
INSERT INTO `city` VALUES ('59', 'Bình Thuận', '999', '242', '0');
INSERT INTO `city` VALUES ('60', 'Bình Phước', '999', '242', '0');
INSERT INTO `city` VALUES ('61', 'Bình Dương', '999', '242', '0');
INSERT INTO `city` VALUES ('62', 'Bình Định', '999', '242', '0');
INSERT INTO `city` VALUES ('63', 'Bến Tre', '999', '242', '0');
INSERT INTO `city` VALUES ('64', 'Bắc Ninh', '999', '242', '0');
INSERT INTO `city` VALUES ('65', 'Bạc Liêu', '999', '242', '0');
INSERT INTO `city` VALUES ('66', 'Bắc Kạn', '999', '242', '0');
INSERT INTO `city` VALUES ('67', 'Bắc Giang', '999', '242', '0');
INSERT INTO `city` VALUES ('68', 'Bà Rịa - Vũng Tàu', '999', '242', '0');
INSERT INTO `city` VALUES ('69', 'An Giang', '999', '242', '0');
INSERT INTO `city` VALUES ('70', 'Hải Phòng', '3', '242', '0');
INSERT INTO `city` VALUES ('71', 'Đà Nẵng', '999', '242', '0');
INSERT INTO `city` VALUES ('72', 'Cần Thơ', '999', '242', '0');

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`,`order`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('12', 'Armenia', 'am', '1');
INSERT INTO `country` VALUES ('14', 'Australia', 'au', '1');
INSERT INTO `country` VALUES ('242', 'Việt Nam', 'vn', '0');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT 'en',
  `crt_date` datetime DEFAULT NULL,
  `crt_by` int(11) DEFAULT NULL,
  `mod_date` datetime DEFAULT NULL,
  `mod_by` int(11) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_provider` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `oauth_id` int(11) DEFAULT '0',
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of customer
-- ----------------------------

-- ----------------------------
-- Table structure for customer_address
-- ----------------------------
DROP TABLE IF EXISTS `customer_address`;
CREATE TABLE `customer_address` (
  `customer_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_shipping` tinyint(4) DEFAULT '1',
  `default_billing` tinyint(4) DEFAULT '1',
  `country_id` int(11) DEFAULT '0',
  `state_id` int(11) DEFAULT '0',
  `city_id` int(11) DEFAULT '0',
  `district_id` int(11) DEFAULT '0',
  `post_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_address_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of customer_address
-- ----------------------------

-- ----------------------------
-- Table structure for customer_detail
-- ----------------------------
DROP TABLE IF EXISTS `customer_detail`;
CREATE TABLE `customer_detail` (
  `customer_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT '1' COMMENT '=1(male) else =0(female)',
  `birthday` date DEFAULT NULL,
  `receive_email` tinyint(4) DEFAULT '1' COMMENT '1(yes), 0(no)',
  PRIMARY KEY (`customer_detail_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of customer_detail
-- ----------------------------

-- ----------------------------
-- Table structure for customer_review
-- ----------------------------
DROP TABLE IF EXISTS `customer_review`;
CREATE TABLE `customer_review` (
  `customer_review_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `career` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '=1(male) else =0(female)',
  `content` text COLLATE utf8_unicode_ci,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `crt_date` date DEFAULT NULL,
  PRIMARY KEY (`customer_review_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of customer_review
-- ----------------------------

-- ----------------------------
-- Table structure for district
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`district_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=901 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of district
-- ----------------------------
INSERT INTO `district` VALUES ('113', 'Từ Liêm', '2', '1');
INSERT INTO `district` VALUES ('114', 'Thanh Trì', '2', '2');
INSERT INTO `district` VALUES ('115', 'Sóc Sơn', '2', '3');
INSERT INTO `district` VALUES ('116', 'Gia Lâm', '2', '4');
INSERT INTO `district` VALUES ('117', 'Đông Anh', '2', '5');
INSERT INTO `district` VALUES ('118', 'Long Biên', '2', '6');
INSERT INTO `district` VALUES ('119', 'Hoàng Mai', '2', '7');
INSERT INTO `district` VALUES ('120', 'Cầu Giấy', '2', '8');
INSERT INTO `district` VALUES ('121', 'Tây Hồ', '2', '9');
INSERT INTO `district` VALUES ('122', 'Thanh Xuân', '2', '10');
INSERT INTO `district` VALUES ('123', 'Hai Bà Trưng', '2', '11');
INSERT INTO `district` VALUES ('124', 'Đống Đa', '2', '12');
INSERT INTO `district` VALUES ('125', 'Ba Đình', '2', '13');
INSERT INTO `district` VALUES ('126', 'Hoàn Kiếm', '2', '14');
INSERT INTO `district` VALUES ('127', 'Quận 1', '3', '1');
INSERT INTO `district` VALUES ('128', 'Quận 2', '3', '2');
INSERT INTO `district` VALUES ('129', 'Quận 3', '3', '3');
INSERT INTO `district` VALUES ('130', 'Quận 4', '3', '4');
INSERT INTO `district` VALUES ('131', 'Quận 5', '3', '5');
INSERT INTO `district` VALUES ('132', 'Quận 6', '3', '6');
INSERT INTO `district` VALUES ('133', 'Quận 7', '3', '7');
INSERT INTO `district` VALUES ('134', 'Quận 8', '3', '8');
INSERT INTO `district` VALUES ('135', 'Quận 9', '3', '9');
INSERT INTO `district` VALUES ('136', 'Quận 10', '3', '10');
INSERT INTO `district` VALUES ('137', 'Quận 11', '3', '11');
INSERT INTO `district` VALUES ('138', 'Quận 12', '3', '12');
INSERT INTO `district` VALUES ('139', 'Quận Phú Nhuận', '3', '13');
INSERT INTO `district` VALUES ('140', 'Quận Bình Thạnh', '3', '14');
INSERT INTO `district` VALUES ('141', 'Quận Tân Bình', '3', '15');
INSERT INTO `district` VALUES ('142', 'Quận Tân Phú', '3', '16');
INSERT INTO `district` VALUES ('143', 'Quận Gò Vấp', '3', '17');
INSERT INTO `district` VALUES ('144', 'Quận Thủ Đức', '3', '18');
INSERT INTO `district` VALUES ('145', 'Quận Bình Tân', '3', '19');
INSERT INTO `district` VALUES ('146', 'Huyện Bình Chánh', '3', '20');
INSERT INTO `district` VALUES ('147', 'Huyện Củ Chi', '3', '21');
INSERT INTO `district` VALUES ('149', 'Huyện Nhà Bè', '3', '22');
INSERT INTO `district` VALUES ('150', 'Huyện Cần Giờ', '3', '23');
INSERT INTO `district` VALUES ('151', 'Bà Rịa', '68', '1');
INSERT INTO `district` VALUES ('152', 'Châu Đất', '68', '2');
INSERT INTO `district` VALUES ('153', 'Côn Đảo', '68', '3');
INSERT INTO `district` VALUES ('154', 'Long Đất', '68', '4');
INSERT INTO `district` VALUES ('155', 'Tân Thành', '68', '5');
INSERT INTO `district` VALUES ('156', 'Vũng Tàu', '68', '6');
INSERT INTO `district` VALUES ('157', 'Xuyên Mộc', '68', '7');
INSERT INTO `district` VALUES ('158', 'An Lão', '62', '1');
INSERT INTO `district` VALUES ('159', 'An Nhơn', '62', '2');
INSERT INTO `district` VALUES ('160', 'Hoài Ân', '62', '3');
INSERT INTO `district` VALUES ('161', 'Hoài Nhơn', '62', '4');
INSERT INTO `district` VALUES ('162', 'Phù Cát', '62', '5');
INSERT INTO `district` VALUES ('163', 'Phù Mỹ', '62', '6');
INSERT INTO `district` VALUES ('164', 'Qui Nhơn', '62', '7');
INSERT INTO `district` VALUES ('165', 'Tây Sơn', '62', '8');
INSERT INTO `district` VALUES ('166', 'Tuy Phước', '62', '9');
INSERT INTO `district` VALUES ('167', 'Vân Canh', '62', '10');
INSERT INTO `district` VALUES ('168', 'Vĩnh Thạnh', '62', '11');
INSERT INTO `district` VALUES ('169', 'Ba Bể', '66', '1');
INSERT INTO `district` VALUES ('170', 'Bắc Kạn', '66', '2');
INSERT INTO `district` VALUES ('171', 'Bạch Thông ', '66', '3');
INSERT INTO `district` VALUES ('172', 'Chợ Đồn', '66', '4');
INSERT INTO `district` VALUES ('173', 'Chợ Mới', '66', '5');
INSERT INTO `district` VALUES ('174', 'Na Rì', '66', '6');
INSERT INTO `district` VALUES ('175', 'Ngân Sơn', '66', '7');
INSERT INTO `district` VALUES ('176', 'Bảo Lạc', '57', '1');
INSERT INTO `district` VALUES ('177', 'Cao Bắng', '57', '2');
INSERT INTO `district` VALUES ('178', 'Hạ Lang', '57', '3');
INSERT INTO `district` VALUES ('179', 'Hà Quảng', '57', '4');
INSERT INTO `district` VALUES ('180', 'Hòa An', '57', '5');
INSERT INTO `district` VALUES ('181', 'Nguyên Bình', '57', '6');
INSERT INTO `district` VALUES ('182', 'Quảng Hòa', '57', '7');
INSERT INTO `district` VALUES ('183', 'Thạch An', '57', '8');
INSERT INTO `district` VALUES ('184', 'Thông Nông', '57', '9');
INSERT INTO `district` VALUES ('185', 'Trà Lĩnh', '57', '10');
INSERT INTO `district` VALUES ('186', 'Trùng Khánh', '57', '11');
INSERT INTO `district` VALUES ('187', 'An Khê', '51', '1');
INSERT INTO `district` VALUES ('188', 'Ayun Pa ', '51', '2');
INSERT INTO `district` VALUES ('189', 'Chư Păh', '51', '3');
INSERT INTO `district` VALUES ('190', 'Chư Prông  ', '51', '4');
INSERT INTO `district` VALUES ('191', 'Chư Sê ', '51', '5');
INSERT INTO `district` VALUES ('192', 'Đức Cơ  ', '51', '6');
INSERT INTO `district` VALUES ('193', 'KBang  ', '51', '7');
INSERT INTO `district` VALUES ('194', 'Krông Chro', '51', '8');
INSERT INTO `district` VALUES ('195', 'Krông Pa ', '51', '9');
INSERT INTO `district` VALUES ('196', 'La Grai  ', '51', '10');
INSERT INTO `district` VALUES ('197', 'Mang Yang ', '51', '11');
INSERT INTO `district` VALUES ('198', 'Pleiku', '51', '12');
INSERT INTO `district` VALUES ('214', 'Cẩm Xuyên', '47', '1');
INSERT INTO `district` VALUES ('215', 'Can Lộc', '47', '2');
INSERT INTO `district` VALUES ('216', 'Đức Thọ', '47', '3');
INSERT INTO `district` VALUES ('217', 'Hà Tĩnh', '47', '4');
INSERT INTO `district` VALUES ('218', 'Hồng Lĩnh', '47', '5');
INSERT INTO `district` VALUES ('219', 'Hương Khê', '47', '6');
INSERT INTO `district` VALUES ('220', 'Hương Sơn', '47', '7');
INSERT INTO `district` VALUES ('221', 'Kỳ Anh', '47', '8');
INSERT INTO `district` VALUES ('222', 'Nghi Xuân', '47', '9');
INSERT INTO `district` VALUES ('223', 'Thạch Hà', '47', '10');
INSERT INTO `district` VALUES ('224', 'Đà Bắc', '44', '1');
INSERT INTO `district` VALUES ('225', 'Hòa Bình', '44', '2');
INSERT INTO `district` VALUES ('226', 'Kim Bôi', '44', '3');
INSERT INTO `district` VALUES ('227', 'Kỳ Sơn', '44', '4');
INSERT INTO `district` VALUES ('228', 'Lạc Sơn', '44', '5');
INSERT INTO `district` VALUES ('229', 'Lạc Thủy', '44', '6');
INSERT INTO `district` VALUES ('230', 'Lương Sơn', '44', '7');
INSERT INTO `district` VALUES ('231', 'Mai Châu', '44', '8');
INSERT INTO `district` VALUES ('232', 'Tân Lạc', '44', '9');
INSERT INTO `district` VALUES ('233', 'Yên Thủy', '44', '10');
INSERT INTO `district` VALUES ('234', 'Bình Giang', '46', '1');
INSERT INTO `district` VALUES ('235', 'Cẩm Giàng', '46', '2');
INSERT INTO `district` VALUES ('236', 'Chí Linh', '46', '3');
INSERT INTO `district` VALUES ('238', 'Gia Lộc', '46', '4');
INSERT INTO `district` VALUES ('239', 'Hải Dương', '46', '5');
INSERT INTO `district` VALUES ('241', 'Kim Thành', '46', '6');
INSERT INTO `district` VALUES ('242', 'Nam Sách', '46', '7');
INSERT INTO `district` VALUES ('243', 'Ninh Giang', '46', '8');
INSERT INTO `district` VALUES ('244', 'Kinh Môn', '46', '9');
INSERT INTO `district` VALUES ('245', 'Ninh Giang', '46', '10');
INSERT INTO `district` VALUES ('246', 'Thanh Hà', '46', '11');
INSERT INTO `district` VALUES ('247', 'Thanh Miện', '46', '12');
INSERT INTO `district` VALUES ('248', 'Từ Kỳ', '46', '13');
INSERT INTO `district` VALUES ('249', 'An Hải', '70', '1');
INSERT INTO `district` VALUES ('250', 'An Lão', '70', '2');
INSERT INTO `district` VALUES ('251', 'Bạch Long Vỹ', '70', '3');
INSERT INTO `district` VALUES ('253', 'Đồ Sơn', '70', '4');
INSERT INTO `district` VALUES ('254', 'Hồng Bàng', '70', '5');
INSERT INTO `district` VALUES ('255', 'Kiến An', '70', '6');
INSERT INTO `district` VALUES ('256', 'Kiến Thụy', '70', '7');
INSERT INTO `district` VALUES ('257', 'Lê Chân', '70', '8');
INSERT INTO `district` VALUES ('258', 'Ngô Quyền', '70', '9');
INSERT INTO `district` VALUES ('259', 'Thủy Nguyên', '70', '10');
INSERT INTO `district` VALUES ('260', 'Tiên Lãng', '70', '11');
INSERT INTO `district` VALUES ('261', 'Vĩnh Bảo', '70', '12');
INSERT INTO `district` VALUES ('262', 'Ân Thi', '43', '1');
INSERT INTO `district` VALUES ('263', 'Hưng Yên', '43', '2');
INSERT INTO `district` VALUES ('264', 'Khoái Châu', '43', '3');
INSERT INTO `district` VALUES ('265', 'Tiên Lữ', '43', '4');
INSERT INTO `district` VALUES ('266', 'Văn Giang', '43', '5');
INSERT INTO `district` VALUES ('267', 'Văn Lâm', '43', '6');
INSERT INTO `district` VALUES ('268', 'Yên Mỹ', '43', '7');
INSERT INTO `district` VALUES ('269', 'Nha Trang', '42', '1');
INSERT INTO `district` VALUES ('270', 'Khánh Vĩnh', '42', '2');
INSERT INTO `district` VALUES ('271', 'Diên Khánh', '42', '3');
INSERT INTO `district` VALUES ('272', 'Ninh Hòa', '42', '4');
INSERT INTO `district` VALUES ('273', 'Khánh Sơn', '42', '5');
INSERT INTO `district` VALUES ('274', 'Cam Ranh', '42', '6');
INSERT INTO `district` VALUES ('275', 'Trường Sa', '42', '7');
INSERT INTO `district` VALUES ('276', 'Vạn Ninh', '42', '8');
INSERT INTO `district` VALUES ('277', 'An Biên', '41', '1');
INSERT INTO `district` VALUES ('278', 'An Minh', '41', '2');
INSERT INTO `district` VALUES ('279', 'Châu Thành', '41', '3');
INSERT INTO `district` VALUES ('280', 'Gò Quao', '41', '4');
INSERT INTO `district` VALUES ('281', 'Gồng Giềng', '41', '5');
INSERT INTO `district` VALUES ('282', 'Hà Tiên', '41', '6');
INSERT INTO `district` VALUES ('283', 'Hòn Đất', '41', '7');
INSERT INTO `district` VALUES ('284', 'Kiên Hải', '41', '8');
INSERT INTO `district` VALUES ('285', 'Phú Quốc', '41', '9');
INSERT INTO `district` VALUES ('286', 'Rạch Giá', '41', '10');
INSERT INTO `district` VALUES ('287', 'Tân Hiệp', '41', '11');
INSERT INTO `district` VALUES ('288', 'Vĩnh Thuận', '41', '12');
INSERT INTO `district` VALUES ('290', 'Đắk Glei', '40', '1');
INSERT INTO `district` VALUES ('291', 'Đắk Tô', '40', '2');
INSERT INTO `district` VALUES ('292', 'Kon Plông', '40', '3');
INSERT INTO `district` VALUES ('293', 'Kon Tum', '40', '4');
INSERT INTO `district` VALUES ('294', 'Ngọc Hồi', '40', '5');
INSERT INTO `district` VALUES ('295', 'Sa Thầy', '40', '6');
INSERT INTO `district` VALUES ('296', 'Điện Biên', '39', '1');
INSERT INTO `district` VALUES ('297', 'Điện Biên Đông', '39', '2');
INSERT INTO `district` VALUES ('298', 'Điện Biên Phủ', '39', '3');
INSERT INTO `district` VALUES ('299', 'Lai Châu', '39', '4');
INSERT INTO `district` VALUES ('300', 'Mường Lay', '39', '5');
INSERT INTO `district` VALUES ('301', 'Mường Tè', '39', '6');
INSERT INTO `district` VALUES ('302', 'Phong Thổ', '39', '7');
INSERT INTO `district` VALUES ('303', 'Sìn Hồ', '39', '8');
INSERT INTO `district` VALUES ('304', 'Tủa Chùa', '39', '9');
INSERT INTO `district` VALUES ('305', 'Tuần Giáo', '39', '10');
INSERT INTO `district` VALUES ('306', 'Bắc Hà', '36', '1');
INSERT INTO `district` VALUES ('307', 'Bảo Thắng', '36', '2');
INSERT INTO `district` VALUES ('308', 'Bảo Yên', '36', '3');
INSERT INTO `district` VALUES ('309', 'Bát Xát', '36', '4');
INSERT INTO `district` VALUES ('310', 'Cam Đường', '36', '5');
INSERT INTO `district` VALUES ('311', 'Lào Cai', '36', '6');
INSERT INTO `district` VALUES ('312', 'Mường Khương', '36', '7');
INSERT INTO `district` VALUES ('313', 'Sa Pa', '36', '8');
INSERT INTO `district` VALUES ('314', 'Than Uyên', '36', '9');
INSERT INTO `district` VALUES ('315', 'Văn Bàn', '36', '10');
INSERT INTO `district` VALUES ('316', 'Xi Ma Cai', '36', '11');
INSERT INTO `district` VALUES ('317', 'Bảo Lâm', '38', '1');
INSERT INTO `district` VALUES ('318', 'Bảo Lộc', '38', '2');
INSERT INTO `district` VALUES ('319', 'Cát Tiên', '38', '3');
INSERT INTO `district` VALUES ('320', 'Đà Lạt', '38', '4');
INSERT INTO `district` VALUES ('321', 'Đạ Tẻh', '38', '5');
INSERT INTO `district` VALUES ('322', 'Đạ Huoai', '38', '6');
INSERT INTO `district` VALUES ('323', 'Di Linh', '38', '7');
INSERT INTO `district` VALUES ('324', 'Đơn Dương', '38', '8');
INSERT INTO `district` VALUES ('325', 'Đức Trọng', '38', '9');
INSERT INTO `district` VALUES ('326', 'Lạc Dương', '38', '10');
INSERT INTO `district` VALUES ('327', 'Lâm Hà', '38', '11');
INSERT INTO `district` VALUES ('328', 'Bắc Sơn', '37', '1');
INSERT INTO `district` VALUES ('329', 'Bình Gia', '37', '2');
INSERT INTO `district` VALUES ('330', 'Cao Lăng', '37', '3');
INSERT INTO `district` VALUES ('331', 'Cao Lộc', '37', '4');
INSERT INTO `district` VALUES ('332', 'Đình Lập', '37', '5');
INSERT INTO `district` VALUES ('333', 'Hữu Lũng', '37', '6');
INSERT INTO `district` VALUES ('334', 'Lạng Sơn', '37', '7');
INSERT INTO `district` VALUES ('336', 'Lộc Bình', '37', '8');
INSERT INTO `district` VALUES ('337', 'Tràng Định', '37', '9');
INSERT INTO `district` VALUES ('341', 'Bến Lức', '35', '1');
INSERT INTO `district` VALUES ('342', 'Văn Lãng', '37', '10');
INSERT INTO `district` VALUES ('343', 'Văn Quang', '37', '11');
INSERT INTO `district` VALUES ('344', 'Cần Đước', '35', '2');
INSERT INTO `district` VALUES ('345', 'Cần Giuộc', '35', '3');
INSERT INTO `district` VALUES ('346', 'Châu Thành', '35', '4');
INSERT INTO `district` VALUES ('347', 'Đức Hòa', '35', '5');
INSERT INTO `district` VALUES ('348', 'Đức Huệ', '35', '6');
INSERT INTO `district` VALUES ('349', 'Mộc Hóa', '35', '7');
INSERT INTO `district` VALUES ('350', 'Tân An', '35', '8');
INSERT INTO `district` VALUES ('351', 'Tân Hưng', '35', '9');
INSERT INTO `district` VALUES ('352', 'Tân Thạnh', '35', '10');
INSERT INTO `district` VALUES ('354', 'Tân Trụ', '35', '11');
INSERT INTO `district` VALUES ('355', 'Thạnh Hóa', '35', '12');
INSERT INTO `district` VALUES ('356', 'Thủ Thừa', '35', '13');
INSERT INTO `district` VALUES ('357', 'Vĩnh Hưng', '35', '14');
INSERT INTO `district` VALUES ('358', 'Giao Thủy', '34', '1');
INSERT INTO `district` VALUES ('360', 'Hải Hậu', '34', '2');
INSERT INTO `district` VALUES ('361', 'Mỹ Lộc', '34', '3');
INSERT INTO `district` VALUES ('362', 'Nam Định', '34', '4');
INSERT INTO `district` VALUES ('363', 'Nam Trực', '34', '5');
INSERT INTO `district` VALUES ('364', 'Nghĩa Hưng', '34', '6');
INSERT INTO `district` VALUES ('365', 'Trực Ninh', '34', '7');
INSERT INTO `district` VALUES ('366', 'Vụ Bản', '34', '8');
INSERT INTO `district` VALUES ('367', 'Xuân Trường', '34', '9');
INSERT INTO `district` VALUES ('368', 'Ý Yên', '34', '10');
INSERT INTO `district` VALUES ('369', 'Anh Sơn', '33', '1');
INSERT INTO `district` VALUES ('370', 'Con Cuông', '33', '2');
INSERT INTO `district` VALUES ('371', 'Cửa Lò', '33', '3');
INSERT INTO `district` VALUES ('372', 'Diễn Châu', '33', '4');
INSERT INTO `district` VALUES ('373', 'Đô Lương', '33', '5');
INSERT INTO `district` VALUES ('374', 'Hưng Nguyên', '33', '6');
INSERT INTO `district` VALUES ('375', 'Kỳ Sơn', '33', '7');
INSERT INTO `district` VALUES ('376', 'Nam Đàn', '33', '8');
INSERT INTO `district` VALUES ('377', 'Nghi Lộc', '33', '9');
INSERT INTO `district` VALUES ('378', 'Nghĩa Đàn', '33', '10');
INSERT INTO `district` VALUES ('379', 'Quế Phong', '33', '11');
INSERT INTO `district` VALUES ('380', 'Quỳ Châu', '33', '12');
INSERT INTO `district` VALUES ('381', 'Quỳ Hợp', '33', '13');
INSERT INTO `district` VALUES ('382', 'Quỳnh Lưu', '33', '14');
INSERT INTO `district` VALUES ('383', 'Tân Kỳ', '33', '15');
INSERT INTO `district` VALUES ('384', 'Thanh Chương', '33', '16');
INSERT INTO `district` VALUES ('385', 'Tương Dương', '33', '17');
INSERT INTO `district` VALUES ('386', 'Vinh', '33', '18');
INSERT INTO `district` VALUES ('387', 'Yên Thành', '33', '19');
INSERT INTO `district` VALUES ('388', 'Đoan Hùng', '30', '1');
INSERT INTO `district` VALUES ('389', 'Hạ Hòa', '30', '2');
INSERT INTO `district` VALUES ('390', 'Lâm Thao', '30', '3');
INSERT INTO `district` VALUES ('391', 'Phù Ninh', '30', '4');
INSERT INTO `district` VALUES ('392', 'Phú Thọ', '30', '5');
INSERT INTO `district` VALUES ('393', 'Sông Thao', '30', '6');
INSERT INTO `district` VALUES ('394', 'Tam Nông', '30', '7');
INSERT INTO `district` VALUES ('395', 'Thanh Ba', '30', '8');
INSERT INTO `district` VALUES ('396', 'Thanh Sơn', '30', '9');
INSERT INTO `district` VALUES ('397', 'Thanh Thủy', '30', '10');
INSERT INTO `district` VALUES ('398', 'Việt Trì', '30', '11');
INSERT INTO `district` VALUES ('399', 'Yên Lập', '30', '12');
INSERT INTO `district` VALUES ('400', 'Đại Lộc', '27', '1');
INSERT INTO `district` VALUES ('401', 'Điện Bàn', '27', '2');
INSERT INTO `district` VALUES ('402', 'Duy Xuyên', '27', '3');
INSERT INTO `district` VALUES ('403', 'Hiên', '27', '4');
INSERT INTO `district` VALUES ('404', 'Hiệp Đức', '27', '5');
INSERT INTO `district` VALUES ('405', 'Hội An', '27', '6');
INSERT INTO `district` VALUES ('406', 'Nam Giang', '27', '7');
INSERT INTO `district` VALUES ('407', 'Núi Thành', '27', '8');
INSERT INTO `district` VALUES ('408', 'Phước Sơn', '27', '9');
INSERT INTO `district` VALUES ('409', 'Quế Sơn', '27', '10');
INSERT INTO `district` VALUES ('410', 'Tam Kỳ', '27', '11');
INSERT INTO `district` VALUES ('411', 'Thăng Bình', '27', '12');
INSERT INTO `district` VALUES ('412', 'Tiên Phước', '27', '13');
INSERT INTO `district` VALUES ('413', 'Trà My', '27', '14');
INSERT INTO `district` VALUES ('414', 'Cam Lộ', '24', '1');
INSERT INTO `district` VALUES ('415', 'Đa Krông', '24', '2');
INSERT INTO `district` VALUES ('416', 'Đông Hà', '24', '3');
INSERT INTO `district` VALUES ('417', 'Gio Linh', '24', '4');
INSERT INTO `district` VALUES ('418', 'Hải Lăng', '24', '5');
INSERT INTO `district` VALUES ('419', 'Hướng Hóa', '24', '6');
INSERT INTO `district` VALUES ('420', 'Quảng Trị', '24', '7');
INSERT INTO `district` VALUES ('421', 'Triệu Phong', '24', '8');
INSERT INTO `district` VALUES ('422', 'Vĩnh Linh', '24', '9');
INSERT INTO `district` VALUES ('423', 'A Lưới', '16', '1');
INSERT INTO `district` VALUES ('424', 'Huế', '16', '2');
INSERT INTO `district` VALUES ('425', 'Hương Thủy', '16', '3');
INSERT INTO `district` VALUES ('426', 'Hương Trà', '16', '4');
INSERT INTO `district` VALUES ('427', 'Nam Đông', '16', '5');
INSERT INTO `district` VALUES ('428', 'Phong Điền', '16', '6');
INSERT INTO `district` VALUES ('429', 'Phú Lộc', '16', '7');
INSERT INTO `district` VALUES ('430', 'Phú Vang', '16', '8');
INSERT INTO `district` VALUES ('431', 'Quảng Điền', '16', '9');
INSERT INTO `district` VALUES ('432', 'Đông Hưng', '19', '1');
INSERT INTO `district` VALUES ('433', 'Hưng Hà', '19', '2');
INSERT INTO `district` VALUES ('434', 'Kiến Xương', '19', '3');
INSERT INTO `district` VALUES ('435', 'Quỳnh Phụ', '19', '4');
INSERT INTO `district` VALUES ('436', 'Thái Bình', '19', '5');
INSERT INTO `district` VALUES ('437', 'Thái Thụy', '19', '6');
INSERT INTO `district` VALUES ('438', 'Tiền Hải', '19', '7');
INSERT INTO `district` VALUES ('439', 'Vũ Thư', '19', '8');
INSERT INTO `district` VALUES ('440', 'Càng Long', '14', '1');
INSERT INTO `district` VALUES ('441', 'Cầu Kè', '14', '2');
INSERT INTO `district` VALUES ('442', 'Cầu Ngang', '14', '3');
INSERT INTO `district` VALUES ('443', 'Châu Thành', '14', '4');
INSERT INTO `district` VALUES ('444', 'Duyên Hải', '14', '5');
INSERT INTO `district` VALUES ('445', 'Tiểu Cần', '14', '6');
INSERT INTO `district` VALUES ('446', 'Trà Cú', '14', '7');
INSERT INTO `district` VALUES ('447', 'Trà Vinh', '14', '8');
INSERT INTO `district` VALUES ('448', 'Bình Xuyên', '11', '1');
INSERT INTO `district` VALUES ('449', 'Lập Thạch', '11', '2');
INSERT INTO `district` VALUES ('450', 'Mê Linh', '2', '15');
INSERT INTO `district` VALUES ('451', 'Tam Dương', '11', '3');
INSERT INTO `district` VALUES ('452', 'Vĩnh Tường', '11', '4');
INSERT INTO `district` VALUES ('453', 'Vĩnh Yên', '11', '5');
INSERT INTO `district` VALUES ('454', 'Yên Lạc', '11', '6');
INSERT INTO `district` VALUES ('455', 'Buôn Đôn', '56', '1');
INSERT INTO `district` VALUES ('456', 'Buôn Ma Thuột', '56', '2');
INSERT INTO `district` VALUES ('457', 'Cư Jút', '56', '3');
INSERT INTO `district` VALUES ('458', 'Cư M\'gar', '56', '4');
INSERT INTO `district` VALUES ('459', 'Đắk Mil', '56', '5');
INSERT INTO `district` VALUES ('460', 'Đắk Nông', '56', '6');
INSERT INTO `district` VALUES ('461', 'Đắk R\'lấp', '56', '7');
INSERT INTO `district` VALUES ('462', 'Ea H\'leo', '56', '8');
INSERT INTO `district` VALUES ('463', 'Ea Kra', '56', '9');
INSERT INTO `district` VALUES ('464', 'Ea Súp', '56', '10');
INSERT INTO `district` VALUES ('465', 'Krông A Na', '56', '11');
INSERT INTO `district` VALUES ('466', 'Krông Bông', '56', '12');
INSERT INTO `district` VALUES ('467', 'Krông Búk', '56', '13');
INSERT INTO `district` VALUES ('468', 'Krông Năng', '56', '14');
INSERT INTO `district` VALUES ('469', 'Krông Nô', '56', '15');
INSERT INTO `district` VALUES ('470', 'Krông Pắc', '56', '16');
INSERT INTO `district` VALUES ('471', 'Lắk', '56', '17');
INSERT INTO `district` VALUES ('472', 'M\'Đrắt', '56', '18');
INSERT INTO `district` VALUES ('473', 'Bến Cát', '61', '1');
INSERT INTO `district` VALUES ('474', 'Dầu Tiếng', '61', '2');
INSERT INTO `district` VALUES ('475', 'Dĩ An', '61', '3');
INSERT INTO `district` VALUES ('476', 'Tân Uyên', '61', '4');
INSERT INTO `district` VALUES ('477', 'Thủ Dầu Một', '61', '5');
INSERT INTO `district` VALUES ('478', 'Thuận An', '61', '6');
INSERT INTO `district` VALUES ('479', 'Bạc Liêu', '65', '1');
INSERT INTO `district` VALUES ('480', 'Giá Rai', '65', '2');
INSERT INTO `district` VALUES ('481', 'Hồng Dân', '65', '3');
INSERT INTO `district` VALUES ('482', 'Vĩnh Lợi', '65', '4');
INSERT INTO `district` VALUES ('483', 'Bắc Ninh', '64', '1');
INSERT INTO `district` VALUES ('484', 'Gia Bình', '64', '2');
INSERT INTO `district` VALUES ('485', 'Lương Tài', '64', '3');
INSERT INTO `district` VALUES ('486', 'Quế Võ', '64', '4');
INSERT INTO `district` VALUES ('487', 'Thuận Thành', '64', '5');
INSERT INTO `district` VALUES ('488', 'Tiên Du', '64', '6');
INSERT INTO `district` VALUES ('489', 'Từ Sơn', '64', '7');
INSERT INTO `district` VALUES ('490', 'Yên Phong', '64', '8');
INSERT INTO `district` VALUES ('491', 'Cà Mau', '58', '1');
INSERT INTO `district` VALUES ('492', 'Cái Nước', '58', '2');
INSERT INTO `district` VALUES ('493', 'Đầm Dơi', '58', '3');
INSERT INTO `district` VALUES ('494', 'Ngọc Hiển', '58', '4');
INSERT INTO `district` VALUES ('495', 'Thới Bình', '58', '5');
INSERT INTO `district` VALUES ('496', 'Trần Văn Thời', '58', '6');
INSERT INTO `district` VALUES ('497', 'U Minh', '58', '7');
INSERT INTO `district` VALUES ('498', 'Bắc Mê', '50', '1');
INSERT INTO `district` VALUES ('499', 'Bắc Quang', '50', '2');
INSERT INTO `district` VALUES ('500', 'Đồng Văn', '50', '3');
INSERT INTO `district` VALUES ('501', 'Hà Giang', '50', '4');
INSERT INTO `district` VALUES ('502', 'Hoàng Su Phì', '50', '5');
INSERT INTO `district` VALUES ('503', 'Mèo Vạt', '50', '6');
INSERT INTO `district` VALUES ('504', 'Quản Bạ', '50', '7');
INSERT INTO `district` VALUES ('505', 'Vị Xuyên', '50', '8');
INSERT INTO `district` VALUES ('506', 'Xín Mần', '50', '9');
INSERT INTO `district` VALUES ('507', 'Yên Minh', '50', '10');
INSERT INTO `district` VALUES ('568', 'Hoa Lư', '32', '1');
INSERT INTO `district` VALUES ('569', 'Kim Sơn', '32', '2');
INSERT INTO `district` VALUES ('571', 'Nho Quan', '32', '3');
INSERT INTO `district` VALUES ('572', 'Ninh Bình', '32', '4');
INSERT INTO `district` VALUES ('573', 'Tam Điệp', '32', '5');
INSERT INTO `district` VALUES ('574', 'Yên Khánh', '32', '6');
INSERT INTO `district` VALUES ('575', 'Yên Mô', '32', '7');
INSERT INTO `district` VALUES ('576', 'Đồng Xuân', '29', '1');
INSERT INTO `district` VALUES ('577', 'Sơn Hòa', '29', '2');
INSERT INTO `district` VALUES ('578', 'Sông Cầu', '29', '3');
INSERT INTO `district` VALUES ('579', 'Sông Hinh', '29', '4');
INSERT INTO `district` VALUES ('580', 'Tuy An', '29', '5');
INSERT INTO `district` VALUES ('581', 'Tuy Hòa', '29', '6');
INSERT INTO `district` VALUES ('582', 'Ba Tơ', '26', '1');
INSERT INTO `district` VALUES ('583', 'Bình Sơn', '26', '2');
INSERT INTO `district` VALUES ('584', 'Đức Phổ', '26', '3');
INSERT INTO `district` VALUES ('585', 'Lý Sơn', '26', '4');
INSERT INTO `district` VALUES ('586', 'Minh Long', '26', '5');
INSERT INTO `district` VALUES ('587', 'Mộ Đức', '26', '6');
INSERT INTO `district` VALUES ('588', 'Nghĩa Hành', '26', '7');
INSERT INTO `district` VALUES ('589', 'Quãng Ngãi', '26', '8');
INSERT INTO `district` VALUES ('590', 'Sơn Hà', '26', '9');
INSERT INTO `district` VALUES ('591', 'Sơn Tây', '26', '10');
INSERT INTO `district` VALUES ('592', 'Sơn Tịnh', '26', '11');
INSERT INTO `district` VALUES ('593', 'Trà Bồng', '26', '12');
INSERT INTO `district` VALUES ('594', 'Tư Nghĩa', '26', '13');
INSERT INTO `district` VALUES ('595', 'Kế Sách', '23', '1');
INSERT INTO `district` VALUES ('596', 'Long Phú', '23', '2');
INSERT INTO `district` VALUES ('597', 'Mỹ Tú', '23', '3');
INSERT INTO `district` VALUES ('598', 'Mỹ Xuyên', '23', '4');
INSERT INTO `district` VALUES ('599', 'Sóc Trăng', '23', '5');
INSERT INTO `district` VALUES ('600', 'Thanh Trị', '23', '6');
INSERT INTO `district` VALUES ('601', 'Vĩnh Châu', '23', '7');
INSERT INTO `district` VALUES ('602', 'Bến Cầu', '21', '1');
INSERT INTO `district` VALUES ('603', 'Châu Thành', '21', '2');
INSERT INTO `district` VALUES ('604', 'Dương Minh Châu', '21', '3');
INSERT INTO `district` VALUES ('605', 'Gò Dầu', '21', '4');
INSERT INTO `district` VALUES ('606', 'Hòa Thành', '21', '5');
INSERT INTO `district` VALUES ('607', 'Tân Biên', '21', '6');
INSERT INTO `district` VALUES ('608', 'Tân Châu', '21', '7');
INSERT INTO `district` VALUES ('609', 'Tây Ninh', '21', '8');
INSERT INTO `district` VALUES ('610', 'Trảng Bàng', '21', '9');
INSERT INTO `district` VALUES ('611', 'Đại Từ', '18', '1');
INSERT INTO `district` VALUES ('612', 'Định Hóa', '18', '2');
INSERT INTO `district` VALUES ('613', 'Đồng Hỷ', '18', '3');
INSERT INTO `district` VALUES ('614', 'Phổ Yên', '18', '4');
INSERT INTO `district` VALUES ('615', 'Phú Bình', '18', '5');
INSERT INTO `district` VALUES ('616', 'Phú Lương', '18', '6');
INSERT INTO `district` VALUES ('617', 'Sông Công', '18', '7');
INSERT INTO `district` VALUES ('618', 'Thái Nguyên', '18', '8');
INSERT INTO `district` VALUES ('619', 'Võ Nhai', '18', '9');
INSERT INTO `district` VALUES ('620', 'Chiêm Hóa', '13', '1');
INSERT INTO `district` VALUES ('621', 'Hàm Yên', '13', '2');
INSERT INTO `district` VALUES ('622', 'Na Hang', '13', '3');
INSERT INTO `district` VALUES ('623', 'Sơn Dương', '13', '4');
INSERT INTO `district` VALUES ('624', 'Tuyên Quang', '13', '5');
INSERT INTO `district` VALUES ('625', 'Yên Sơn', '13', '6');
INSERT INTO `district` VALUES ('626', 'Lục Yên', '10', '1');
INSERT INTO `district` VALUES ('627', 'Mù Căng Chải', '10', '2');
INSERT INTO `district` VALUES ('628', 'Trạm Tấu', '10', '3');
INSERT INTO `district` VALUES ('629', 'Trấn Yên', '10', '4');
INSERT INTO `district` VALUES ('630', 'Văn Chấn', '10', '5');
INSERT INTO `district` VALUES ('631', 'Văn Yên', '10', '6');
INSERT INTO `district` VALUES ('632', 'Yên Bái', '10', '7');
INSERT INTO `district` VALUES ('633', 'Yên Bình', '10', '8');
INSERT INTO `district` VALUES ('634', 'Biên Hòa', '53', '1');
INSERT INTO `district` VALUES ('635', 'Định Quán', '53', '2');
INSERT INTO `district` VALUES ('636', 'Long Khánh', '53', '3');
INSERT INTO `district` VALUES ('637', 'Long Thành', '53', '4');
INSERT INTO `district` VALUES ('638', 'Nhơn Trạch', '53', '5');
INSERT INTO `district` VALUES ('639', 'Tân Phú', '53', '6');
INSERT INTO `district` VALUES ('640', 'Thống Nhất', '53', '7');
INSERT INTO `district` VALUES ('641', 'Vĩnh Cừu', '53', '8');
INSERT INTO `district` VALUES ('642', 'Xuân Lộc', '53', '9');
INSERT INTO `district` VALUES ('643', 'An Phú', '69', '1');
INSERT INTO `district` VALUES ('644', 'Châu Đốc', '69', '2');
INSERT INTO `district` VALUES ('645', 'Châu Phú', '69', '3');
INSERT INTO `district` VALUES ('646', 'Châu Thành', '69', '4');
INSERT INTO `district` VALUES ('647', 'Chợ Mới', '69', '5');
INSERT INTO `district` VALUES ('648', 'Long Xuyên', '69', '6');
INSERT INTO `district` VALUES ('649', 'Phú Tân', '69', '7');
INSERT INTO `district` VALUES ('650', 'Tân Châu', '69', '8');
INSERT INTO `district` VALUES ('651', 'Thoại Sơn', '69', '9');
INSERT INTO `district` VALUES ('652', 'Tịnh Biên', '69', '10');
INSERT INTO `district` VALUES ('653', 'Tri Tôn', '69', '11');
INSERT INTO `district` VALUES ('654', 'Bắc Bình', '59', '1');
INSERT INTO `district` VALUES ('655', 'Đức Linh', '59', '2');
INSERT INTO `district` VALUES ('656', 'Hàm Tân', '59', '3');
INSERT INTO `district` VALUES ('657', 'Hàm Thuận Bắc', '59', '4');
INSERT INTO `district` VALUES ('658', 'Hàm Thuận Nam', '59', '5');
INSERT INTO `district` VALUES ('659', 'Phan Thiết', '59', '6');
INSERT INTO `district` VALUES ('660', 'Phú Quí', '59', '7');
INSERT INTO `district` VALUES ('661', 'Tánh Linh', '59', '8');
INSERT INTO `district` VALUES ('662', 'Tuy Phong', '59', '9');
INSERT INTO `district` VALUES ('663', 'Bắc Giang', '67', '1');
INSERT INTO `district` VALUES ('664', 'Hiệp Hòa', '67', '2');
INSERT INTO `district` VALUES ('665', 'Lạng Giang', '67', '3');
INSERT INTO `district` VALUES ('666', 'Lục Nam', '67', '4');
INSERT INTO `district` VALUES ('667', 'Lục Ngạn', '67', '5');
INSERT INTO `district` VALUES ('668', 'Sơn Động', '67', '6');
INSERT INTO `district` VALUES ('669', 'Tân Yên', '67', '7');
INSERT INTO `district` VALUES ('670', 'Việt Yên', '67', '8');
INSERT INTO `district` VALUES ('671', 'Yên Dũng', '67', '9');
INSERT INTO `district` VALUES ('672', 'Yên Thế', '67', '10');
INSERT INTO `district` VALUES ('673', 'Ba Tri', '63', '1');
INSERT INTO `district` VALUES ('674', 'Bến Tre', '63', '2');
INSERT INTO `district` VALUES ('675', 'Bình Đại', '63', '3');
INSERT INTO `district` VALUES ('676', 'Châu Thành', '63', '4');
INSERT INTO `district` VALUES ('677', 'Chợ Lách', '63', '5');
INSERT INTO `district` VALUES ('678', 'Giồng Trôm', '63', '6');
INSERT INTO `district` VALUES ('679', 'Mỏ Cày', '63', '7');
INSERT INTO `district` VALUES ('680', 'Thạnh Phú', '63', '8');
INSERT INTO `district` VALUES ('681', 'Cần Thơ', '72', '1');
INSERT INTO `district` VALUES ('682', 'Châu Thành', '45', '1');
INSERT INTO `district` VALUES ('683', 'Long Mỹ', '45', '2');
INSERT INTO `district` VALUES ('684', 'Ô Môn', '72', '2');
INSERT INTO `district` VALUES ('685', 'Phụng Hiệp', '45', '3');
INSERT INTO `district` VALUES ('686', 'Thốt Nốt', '72', '3');
INSERT INTO `district` VALUES ('687', 'Vị Thanh', '45', '4');
INSERT INTO `district` VALUES ('688', 'Vị Thủy', '45', '5');
INSERT INTO `district` VALUES ('689', 'Bình Lục', '49', '1');
INSERT INTO `district` VALUES ('690', 'Duy Tiên', '49', '2');
INSERT INTO `district` VALUES ('691', 'Kim Bảng', '49', '3');
INSERT INTO `district` VALUES ('692', 'Lý Nhân', '49', '4');
INSERT INTO `district` VALUES ('693', 'Phủ Lý', '49', '5');
INSERT INTO `district` VALUES ('694', 'Thanh Liêm', '49', '6');
INSERT INTO `district` VALUES ('705', 'Ân Thi', '43', '8');
INSERT INTO `district` VALUES ('706', 'Hưng Yên', '43', '9');
INSERT INTO `district` VALUES ('707', 'Khoái Châu', '43', '10');
INSERT INTO `district` VALUES ('708', 'Kim Động', '43', '11');
INSERT INTO `district` VALUES ('709', 'Mỹ Hào', '43', '12');
INSERT INTO `district` VALUES ('710', 'Phù Cừ', '43', '13');
INSERT INTO `district` VALUES ('715', 'Đắk Glei', '40', '7');
INSERT INTO `district` VALUES ('716', 'Đắk Hà', '40', '8');
INSERT INTO `district` VALUES ('717', 'Đắk Tô', '40', '9');
INSERT INTO `district` VALUES ('718', 'Kon Plông', '40', '10');
INSERT INTO `district` VALUES ('719', 'Kon Tum', '40', '11');
INSERT INTO `district` VALUES ('720', 'Ngọc Hồi', '40', '12');
INSERT INTO `district` VALUES ('721', 'Sa Thầy', '40', '13');
INSERT INTO `district` VALUES ('743', 'Ninh Hải', '31', '1');
INSERT INTO `district` VALUES ('744', 'Ninh Phước', '31', '2');
INSERT INTO `district` VALUES ('745', 'Ninh Sơn', '31', '3');
INSERT INTO `district` VALUES ('746', 'Phan Rang - Tháp Chàm', '31', '4');
INSERT INTO `district` VALUES ('747', 'Bố Trạch', '28', '1');
INSERT INTO `district` VALUES ('748', 'Đồng Hới', '28', '2');
INSERT INTO `district` VALUES ('749', 'Lệ Thủy', '28', '3');
INSERT INTO `district` VALUES ('750', 'Quảng Ninh', '28', '4');
INSERT INTO `district` VALUES ('751', 'Quảng Trạch', '28', '5');
INSERT INTO `district` VALUES ('752', 'Tuyên Hóa', '28', '6');
INSERT INTO `district` VALUES ('753', 'Ba Chế', '25', '1');
INSERT INTO `district` VALUES ('754', 'Bình Liêu', '25', '2');
INSERT INTO `district` VALUES ('755', 'Cẩm Phả', '25', '3');
INSERT INTO `district` VALUES ('756', 'Cô Tô', '25', '4');
INSERT INTO `district` VALUES ('757', 'Đông Triều', '25', '5');
INSERT INTO `district` VALUES ('758', 'Hạ Long', '25', '6');
INSERT INTO `district` VALUES ('759', 'Hoành Bồ', '25', '7');
INSERT INTO `district` VALUES ('760', 'Móng Cái', '25', '8');
INSERT INTO `district` VALUES ('761', 'Quảng Hà', '25', '9');
INSERT INTO `district` VALUES ('762', 'Tiên Yên', '25', '10');
INSERT INTO `district` VALUES ('763', 'Uông Bí', '25', '11');
INSERT INTO `district` VALUES ('764', 'Vân Đồn', '25', '12');
INSERT INTO `district` VALUES ('765', 'Yên Hưng', '25', '13');
INSERT INTO `district` VALUES ('766', 'Bắc Yên', '22', '1');
INSERT INTO `district` VALUES ('767', 'Mai Sơn', '22', '2');
INSERT INTO `district` VALUES ('768', 'Mộc Châu', '22', '3');
INSERT INTO `district` VALUES ('769', 'Muờng La', '22', '4');
INSERT INTO `district` VALUES ('770', 'Phù Yên', '22', '5');
INSERT INTO `district` VALUES ('771', 'Quỳnh Nhai', '22', '6');
INSERT INTO `district` VALUES ('772', 'Sơn La', '22', '7');
INSERT INTO `district` VALUES ('773', 'Sông Mã', '22', '8');
INSERT INTO `district` VALUES ('774', 'Thuận Châu', '22', '9');
INSERT INTO `district` VALUES ('775', 'Yên Châu', '22', '10');
INSERT INTO `district` VALUES ('776', 'Bá Thước', '17', '1');
INSERT INTO `district` VALUES ('777', 'Bỉm Sơn', '17', '2');
INSERT INTO `district` VALUES ('778', 'Cẩm Thủy', '17', '3');
INSERT INTO `district` VALUES ('779', 'Đông Sơn', '17', '4');
INSERT INTO `district` VALUES ('780', 'Hà Trung', '17', '5');
INSERT INTO `district` VALUES ('781', 'Hậu Lộc', '17', '6');
INSERT INTO `district` VALUES ('782', 'Hoằng Hóa', '17', '7');
INSERT INTO `district` VALUES ('783', 'Lang Chánh', '17', '8');
INSERT INTO `district` VALUES ('784', 'Mường Lát', '17', '9');
INSERT INTO `district` VALUES ('785', 'Nga Sơn', '17', '10');
INSERT INTO `district` VALUES ('786', 'Ngọc Lặc', '17', '11');
INSERT INTO `district` VALUES ('787', 'Như Thanh', '17', '12');
INSERT INTO `district` VALUES ('788', 'Như Xuân', '17', '13');
INSERT INTO `district` VALUES ('789', 'Nông Cống', '17', '14');
INSERT INTO `district` VALUES ('790', 'Quan Hóa', '17', '15');
INSERT INTO `district` VALUES ('791', 'Quan Sơn', '17', '16');
INSERT INTO `district` VALUES ('792', 'Quảng Xương', '17', '17');
INSERT INTO `district` VALUES ('793', 'Sầm Sơn', '17', '18');
INSERT INTO `district` VALUES ('794', 'Thạch Thành', '17', '19');
INSERT INTO `district` VALUES ('795', 'Thanh Hóa', '17', '20');
INSERT INTO `district` VALUES ('796', 'Thọ Xuân', '17', '21');
INSERT INTO `district` VALUES ('797', 'Thường Xuân', '17', '22');
INSERT INTO `district` VALUES ('798', 'Tĩnh Gia', '17', '23');
INSERT INTO `district` VALUES ('799', 'Thiệu Hóa', '17', '24');
INSERT INTO `district` VALUES ('800', 'Triệu Sơn', '17', '25');
INSERT INTO `district` VALUES ('801', 'Vĩnh Lộc', '17', '26');
INSERT INTO `district` VALUES ('802', 'Yên Định', '17', '27');
INSERT INTO `district` VALUES ('803', 'Cái Bè', '15', '1');
INSERT INTO `district` VALUES ('804', 'Cai Lậy', '15', '2');
INSERT INTO `district` VALUES ('805', 'Châu Thành', '15', '3');
INSERT INTO `district` VALUES ('806', 'Chợ Gạo', '15', '4');
INSERT INTO `district` VALUES ('807', 'Gò Công', '15', '5');
INSERT INTO `district` VALUES ('808', 'Gò Công Đông', '15', '6');
INSERT INTO `district` VALUES ('809', 'Gò Công Tây', '15', '7');
INSERT INTO `district` VALUES ('810', 'Mỹ Tho', '15', '8');
INSERT INTO `district` VALUES ('811', 'Tân Phước', '15', '9');
INSERT INTO `district` VALUES ('812', 'Bình Minh', '12', '1');
INSERT INTO `district` VALUES ('813', 'Long Hồ', '12', '2');
INSERT INTO `district` VALUES ('814', 'Mang Thít', '12', '3');
INSERT INTO `district` VALUES ('815', 'Tam Bình', '12', '4');
INSERT INTO `district` VALUES ('816', 'Trà Ôn', '12', '5');
INSERT INTO `district` VALUES ('817', 'Vĩnh Long', '12', '6');
INSERT INTO `district` VALUES ('818', 'Vũng Liêm', '12', '7');
INSERT INTO `district` VALUES ('819', 'Đảo Hòang Sa', '71', '1');
INSERT INTO `district` VALUES ('820', 'Hải Châu', '71', '2');
INSERT INTO `district` VALUES ('821', 'Hòa Vang', '71', '3');
INSERT INTO `district` VALUES ('822', 'Liên Chiểu', '71', '4');
INSERT INTO `district` VALUES ('823', 'Ngũ Hành Sơn', '71', '5');
INSERT INTO `district` VALUES ('824', 'Sơn Trà', '71', '6');
INSERT INTO `district` VALUES ('825', 'Thanh Khê', '71', '7');
INSERT INTO `district` VALUES ('826', 'Cao Lãnh', '52', '1');
INSERT INTO `district` VALUES ('827', 'Châu Thành', '52', '2');
INSERT INTO `district` VALUES ('828', 'Hồng Ngự', '52', '3');
INSERT INTO `district` VALUES ('829', 'Lai Vung', '52', '4');
INSERT INTO `district` VALUES ('830', 'Lấp Vò', '52', '5');
INSERT INTO `district` VALUES ('831', 'Tam Nông', '52', '6');
INSERT INTO `district` VALUES ('832', 'Tân Hồng', '52', '7');
INSERT INTO `district` VALUES ('833', 'Thanh Bình', '52', '8');
INSERT INTO `district` VALUES ('834', 'Tháp Mười', '52', '9');
INSERT INTO `district` VALUES ('835', 'Xa Đéc', '52', '10');
INSERT INTO `district` VALUES ('836', 'Bình Long', '60', '1');
INSERT INTO `district` VALUES ('837', 'Ninh Kiều', '72', '4');
INSERT INTO `district` VALUES ('838', 'Trảng Bom', '53', '10');
INSERT INTO `district` VALUES ('839', 'Phước Long', '60', '2');
INSERT INTO `district` VALUES ('840', 'Vân Điền', '2', '16');
INSERT INTO `district` VALUES ('841', 'Lái Thiêu', '61', '7');
INSERT INTO `district` VALUES ('844', 'Cẩm Lệ', '71', '8');
INSERT INTO `district` VALUES ('848', 'Cái Răng', '72', '5');
INSERT INTO `district` VALUES ('849', 'Liên Hưng', '35', '15');
INSERT INTO `district` VALUES ('850', 'Phúc Yên', '11', '7');
INSERT INTO `district` VALUES ('851', 'Bù Ðăng', '60', '3');
INSERT INTO `district` VALUES ('852', 'Chơn Thành', '60', '4');
INSERT INTO `district` VALUES ('853', 'Tam Đảo', '11', '8');
INSERT INTO `district` VALUES ('854', 'Cát Bà', '70', '13');
INSERT INTO `district` VALUES ('855', 'Bình Thủy', '72', '6');
INSERT INTO `district` VALUES ('856', 'Huyện Hóc Môn', '3', '24');
INSERT INTO `district` VALUES ('857', 'Ba Vì', '2', '17');
INSERT INTO `district` VALUES ('858', 'Chương Mỹ', '2', '18');
INSERT INTO `district` VALUES ('859', 'Đan Phượng', '2', '19');
INSERT INTO `district` VALUES ('860', 'Hà Đông', '2', '20');
INSERT INTO `district` VALUES ('861', 'Hoài Đức', '2', '21');
INSERT INTO `district` VALUES ('862', 'Mỹ Đức', '2', '22');
INSERT INTO `district` VALUES ('863', 'Phú Xuyên', '2', '23');
INSERT INTO `district` VALUES ('864', 'Phúc Thọ', '2', '24');
INSERT INTO `district` VALUES ('865', 'Quốc Oai', '2', '25');
INSERT INTO `district` VALUES ('866', 'Sơn Tây', '2', '26');
INSERT INTO `district` VALUES ('867', 'Thạch Thất', '2', '27');
INSERT INTO `district` VALUES ('868', 'Thanh Oai', '2', '28');
INSERT INTO `district` VALUES ('869', 'Thường Tín', '2', '29');
INSERT INTO `district` VALUES ('871', 'Ứng Hòa', '2', '30');
INSERT INTO `district` VALUES ('872', 'Gia Viễn', '32', '8');
INSERT INTO `district` VALUES ('873', 'Cao Phong', '44', '11');
INSERT INTO `district` VALUES ('874', 'Sốp Cộp', '22', '11');
INSERT INTO `district` VALUES ('875', 'Cẩm Khê', '30', '13');
INSERT INTO `district` VALUES ('876', 'Tân Sơn', '30', '14');
INSERT INTO `district` VALUES ('877', 'Đông Hòa', '29', '7');
INSERT INTO `district` VALUES ('878', 'Tây Hòa', '29', '8');
INSERT INTO `district` VALUES ('879', 'Phú Hòa', '29', '9');
INSERT INTO `district` VALUES ('880', 'Minh Hóa', '28', '7');
INSERT INTO `district` VALUES ('881', 'Vũ Quang', '47', '11');
INSERT INTO `district` VALUES ('882', 'Lộc Hà', '47', '12');
INSERT INTO `district` VALUES ('883', 'Thái Hòa', '33', '20');
INSERT INTO `district` VALUES ('884', 'Phước Long', '65', '5');
INSERT INTO `district` VALUES ('885', 'Đông Hải', '65', '6');
INSERT INTO `district` VALUES ('886', 'Hòa Bình', '65', '7');
INSERT INTO `district` VALUES ('887', 'Năm Căn', '58', '8');
INSERT INTO `district` VALUES ('888', 'Phú Tân', '58', '9');
INSERT INTO `district` VALUES ('890', 'Châu Thành A', '45', '6');
INSERT INTO `district` VALUES ('891', 'Ngã Bảy', '45', '7');
INSERT INTO `district` VALUES ('892', 'Phong Điền', '72', '7');
INSERT INTO `district` VALUES ('893', 'Cờ Đỏ', '72', '8');
INSERT INTO `district` VALUES ('894', 'Thới Lai', '72', '9');
INSERT INTO `district` VALUES ('895', 'Vĩnh Thạnh', '72', '10');
INSERT INTO `district` VALUES ('896', 'Phú Giáo', '61', '8');
INSERT INTO `district` VALUES ('897', 'La Gi', '59', '10');
INSERT INTO `district` VALUES ('898', 'Long Điền', '68', '8');
INSERT INTO `district` VALUES ('899', 'Đất Đỏ', '68', '9');
INSERT INTO `district` VALUES ('900', 'Dương Kinh', '70', '14');

-- ----------------------------
-- Table structure for email_template
-- ----------------------------
DROP TABLE IF EXISTS `email_template`;
CREATE TABLE `email_template` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `note` text COLLATE utf8_unicode_ci,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`email_template_id`) USING BTREE,
  UNIQUE KEY `key` (`key`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of email_template
-- ----------------------------

-- ----------------------------
-- Table structure for file
-- ----------------------------
DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `orig_name` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vitual_path` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_map` varchar(225) COLLATE utf8_unicode_ci DEFAULT 'product',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'image/jpeg',
  `size` int(11) DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`file_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of file
-- ----------------------------

-- ----------------------------
-- Table structure for language
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `country_code` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `default` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`language_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES ('1', 'en', 'English', 'A', 'us', '1');
INSERT INTO `language` VALUES ('2', 'vi', 'Vietnam', 'D', 'vn', '0');

-- ----------------------------
-- Table structure for language_value
-- ----------------------------
DROP TABLE IF EXISTS `language_value`;
CREATE TABLE `language_value` (
  `language_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `key` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`language_value_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=639 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of language_value
-- ----------------------------
INSERT INTO `language_value` VALUES ('1', 'vi', 'Admin username is exist', '');
INSERT INTO `language_value` VALUES ('2', 'vi', 'Admin emaiayout is exist', '');
INSERT INTO `language_value` VALUES ('3', 'vi', 'Current password incorect', '');
INSERT INTO `language_value` VALUES ('4', 'vi', 'Passwords do not match!!', '');
INSERT INTO `language_value` VALUES ('5', 'vi', 'Update successful', '');
INSERT INTO `language_value` VALUES ('6', 'vi', 'Admin add success', '');
INSERT INTO `language_value` VALUES ('7', 'vi', 'Delete is success!', '');
INSERT INTO `language_value` VALUES ('8', 'vi', 'Admin not exist', '');
INSERT INTO `language_value` VALUES ('9', 'vi', 'Not delete admin account system', 'Không xóa được tài khoản của hệ thống');
INSERT INTO `language_value` VALUES ('10', 'vi', 'Account not found', 'Tài khoản không tìm thấy');
INSERT INTO `language_value` VALUES ('11', 'vi', 'Update successful.', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES ('12', 'vi', 'Login Successfully', 'Đăng nhập thành công');
INSERT INTO `language_value` VALUES ('13', 'vi', 'Account is disable', '');
INSERT INTO `language_value` VALUES ('14', 'vi', 'Wrong username or password', 'Lỗi tên đăng nhập hoặc mật khẩu');
INSERT INTO `language_value` VALUES ('15', 'vi', 'Customer username is exist', '');
INSERT INTO `language_value` VALUES ('16', 'vi', 'Customer email is exist', '');
INSERT INTO `language_value` VALUES ('17', 'vi', 'Password and confirm passwordemail is not match', '');
INSERT INTO `language_value` VALUES ('18', 'vi', 'New password not empty', 'Mật khẩu mới không được để trống');
INSERT INTO `language_value` VALUES ('19', 'vi', 'Confirm password not empty', '');
INSERT INTO `language_value` VALUES ('20', 'vi', 'Customer add success', '');
INSERT INTO `language_value` VALUES ('21', 'vi', 'Customer not exist', '');
INSERT INTO `language_value` VALUES ('22', 'vi', 'Email Template key is exist', '');
INSERT INTO `language_value` VALUES ('23', 'vi', 'Email Template add success', '');
INSERT INTO `language_value` VALUES ('24', 'vi', 'Email Template update success', '');
INSERT INTO `language_value` VALUES ('25', 'vi', 'Email Template not exist', '');
INSERT INTO `language_value` VALUES ('26', 'vi', 'Changed settings successfully!', 'Thay đổi cấu hình thành công');
INSERT INTO `language_value` VALUES ('27', 'vi', 'Language code is exist', '');
INSERT INTO `language_value` VALUES ('28', 'vi', 'Default must select', '');
INSERT INTO `language_value` VALUES ('29', 'vi', 'Status must active for default language', '');
INSERT INTO `language_value` VALUES ('30', 'vi', 'Language add success', '');
INSERT INTO `language_value` VALUES ('31', 'vi', 'Language update success', '');
INSERT INTO `language_value` VALUES ('32', 'vi', 'Language delete success', '');
INSERT INTO `language_value` VALUES ('33', 'vi', 'Language not exist', '');
INSERT INTO `language_value` VALUES ('34', 'vi', 'Not delete default language', '');
INSERT INTO `language_value` VALUES ('35', 'vi', 'Not delete this language. <br>Pre delete language value of this', '');
INSERT INTO `language_value` VALUES ('36', 'vi', 'Language key is exist', '');
INSERT INTO `language_value` VALUES ('37', 'vi', 'Language value is updated. <br>Language value added is %s', '');
INSERT INTO `language_value` VALUES ('38', 'vi', 'All language value have <br>key = %s <br>is deleted', '');
INSERT INTO `language_value` VALUES ('39', 'vi', 'Language value add success', '');
INSERT INTO `language_value` VALUES ('40', 'vi', 'Layout is not action = $action', '');
INSERT INTO `language_value` VALUES ('41', 'vi', '%s layout is success!', '');
INSERT INTO `language_value` VALUES ('42', 'vi', 'Not action = $action in AdminLayoutController.', '');
INSERT INTO `language_value` VALUES ('43', 'vi', 'Not action = $action in layout_widget_action_ajax.', '');
INSERT INTO `language_value` VALUES ('44', 'vi', 'Not action = $action in layout_row_action_ajax', '');
INSERT INTO `language_value` VALUES ('45', 'vi', 'Menu name is exist', '');
INSERT INTO `language_value` VALUES ('46', 'vi', 'Menu add success', '');
INSERT INTO `language_value` VALUES ('47', 'vi', 'Menu update success', '');
INSERT INTO `language_value` VALUES ('48', 'vi', 'Menu not exist', '');
INSERT INTO `language_value` VALUES ('49', 'vi', 'Plugin pluginCode is exist', '');
INSERT INTO `language_value` VALUES ('50', 'vi', 'Not found file: plugin/$pluginCode/action.php', '');
INSERT INTO `language_value` VALUES ('51', 'vi', 'Not found file: plugin/$pluginCode/config/action_config.php', '');
INSERT INTO `language_value` VALUES ('52', 'vi', 'Plugin add success', '');
INSERT INTO `language_value` VALUES ('53', 'vi', 'Plugin update success', '');
INSERT INTO `language_value` VALUES ('54', 'vi', 'Plugin not exist', '');
INSERT INTO `language_value` VALUES ('55', 'vi', 'Role name is exist', 'Tên role đã tồn tại');
INSERT INTO `language_value` VALUES ('56', 'vi', 'Updated successfully!', '');
INSERT INTO `language_value` VALUES ('57', 'vi', 'Add successfully!', '');
INSERT INTO `language_value` VALUES ('58', 'vi', 'Not delete role system', '');
INSERT INTO `language_value` VALUES ('59', 'vi', 'Not delete because exsit admin account have this role.', '');
INSERT INTO `language_value` VALUES ('60', 'vi', 'Not delete because exsit customer account have this role.', '');
INSERT INTO `language_value` VALUES ('61', 'vi', 'Router is exist', 'Router đã tồn tại');
INSERT INTO `language_value` VALUES ('62', 'vi', 'Router add success', 'Thêm router thành công');
INSERT INTO `language_value` VALUES ('63', 'vi', 'Router update success', 'Router cập nhật thành công');
INSERT INTO `language_value` VALUES ('64', 'vi', 'Router not exist', 'Router đã tồn tại');
INSERT INTO `language_value` VALUES ('65', 'vi', 'Setting not found', 'Cấu hình không tìm thấy');
INSERT INTO `language_value` VALUES ('66', 'vi', 'Not found file %s', '');
INSERT INTO `language_value` VALUES ('67', 'vi', 'Widget controller is exist', '');
INSERT INTO `language_value` VALUES ('68', 'vi', 'Widget add success', '');
INSERT INTO `language_value` VALUES ('69', 'vi', 'Widget update success', '');
INSERT INTO `language_value` VALUES ('70', 'vi', 'Widget not exist', '');
INSERT INTO `language_value` VALUES ('71', 'vi', 'Delete file $controller.php before delete widget', '');
INSERT INTO `language_value` VALUES ('72', 'vi', 'Account not logined', '');
INSERT INTO `language_value` VALUES ('73', 'vi', 'Make default shipping is success', '');
INSERT INTO `language_value` VALUES ('74', 'vi', 'Make default billing is success', '');
INSERT INTO `language_value` VALUES ('75', 'vi', 'Delete addess is success', '');
INSERT INTO `language_value` VALUES ('76', 'vi', 'Orders #$orderId not exist', '');
INSERT INTO `language_value` VALUES ('77', 'vi', 'Login false. Account is disable', '');
INSERT INTO `language_value` VALUES ('78', 'vi', 'Login is successful!', 'Đăng nhập thành công');
INSERT INTO `language_value` VALUES ('79', 'vi', 'Login false. Check your spelling and try again', 'Đăng nhập sai. Hãy kiểm tra lại tên đăng nhập hoặc mật khẩu');
INSERT INTO `language_value` VALUES ('80', 'vi', 'Logout is successful!', 'Đăng xuất thành công');
INSERT INTO `language_value` VALUES ('81', 'vi', 'Email is exist', 'Email đã tồn tại trong hệ thống');
INSERT INTO `language_value` VALUES ('82', 'vi', 'Passwords length must bigger 6!', 'Mật khẩu phải có độ dài lớn hơn 6');
INSERT INTO `language_value` VALUES ('83', 'vi', 'Passwords do not match!', 'Mật khẩu không khớp');
INSERT INTO `language_value` VALUES ('84', 'vi', 'Date incorrect', '');
INSERT INTO `language_value` VALUES ('85', 'vi', 'Register is successful!', 'Đăng ký thành công');
INSERT INTO `language_value` VALUES ('86', 'vi', 'Account is active', '');
INSERT INTO `language_value` VALUES ('87', 'vi', 'Verify is successful!', '');
INSERT INTO `language_value` VALUES ('88', 'vi', 'Check email to reset password', '');
INSERT INTO `language_value` VALUES ('89', 'vi', 'Reset password success', '');
INSERT INTO `language_value` VALUES ('90', 'vi', 'Email not exist', 'Email đã tồn tại trong hệ thống');
INSERT INTO `language_value` VALUES ('91', 'vi', 'Url incorrect. Please check again', '');
INSERT INTO `language_value` VALUES ('92', 'vi', 'Email address or resetPasswordCode incorrect', '');
INSERT INTO `language_value` VALUES ('93', 'vi', 'Select a country', 'Lựa chọn 1 đất nước');
INSERT INTO `language_value` VALUES ('94', 'vi', '---', '');
INSERT INTO `language_value` VALUES ('95', 'vi', 'Select a state', 'Chọn 1 bang');
INSERT INTO `language_value` VALUES ('96', 'vi', 'Select a city', 'Chọn 1 thành phố');
INSERT INTO `language_value` VALUES ('97', 'vi', 'Select a district', 'Chọn 1 quận/huyện');
INSERT INTO `language_value` VALUES ('98', 'vi', 'Home', 'Trang chủ');
INSERT INTO `language_value` VALUES ('99', 'vi', 'Product', 'Sản phẩm');
INSERT INTO `language_value` VALUES ('100', 'vi', 'News', 'Tin tức');
INSERT INTO `language_value` VALUES ('101', 'vi', 'News tag', 'Nhóm tin tức');
INSERT INTO `language_value` VALUES ('102', 'vi', 'Image preview', 'Xem trước hình ảnh');
INSERT INTO `language_value` VALUES ('103', 'vi', 'Select image', 'Chọn hình ảnh');
INSERT INTO `language_value` VALUES ('104', 'vi', 'Edit Account', 'Sửa tài khoản');
INSERT INTO `language_value` VALUES ('105', 'vi', 'Account information', 'Tài khoản admin');
INSERT INTO `language_value` VALUES ('106', 'vi', 'Admin information', 'Thông tin admin');
INSERT INTO `language_value` VALUES ('107', 'vi', 'Edit Admin', 'Sửa admin');
INSERT INTO `language_value` VALUES ('108', 'vi', 'Add Admin', 'Thêm admin');
INSERT INTO `language_value` VALUES ('109', 'vi', 'Feature is disable, this enable in edit mode', 'Tính năng bị vô hiệu hóa, nó sẽ được kích hoạt ở chế độ sửa');
INSERT INTO `language_value` VALUES ('110', 'vi', 'Admin Manage', 'Quản lý admin');
INSERT INTO `language_value` VALUES ('111', 'vi', 'Add Customer', 'Thêm khách hàng');
INSERT INTO `language_value` VALUES ('112', 'vi', 'Edit Customer', 'Sửa khách hàng');
INSERT INTO `language_value` VALUES ('113', 'vi', 'General', 'Thông tin chung');
INSERT INTO `language_value` VALUES ('114', 'vi', 'Address', 'Địa chỉ');
INSERT INTO `language_value` VALUES ('115', 'vi', 'Please save customer before add address', '');
INSERT INTO `language_value` VALUES ('116', 'vi', 'District', '');
INSERT INTO `language_value` VALUES ('117', 'vi', 'City', '');
INSERT INTO `language_value` VALUES ('118', 'vi', 'State', '');
INSERT INTO `language_value` VALUES ('119', 'vi', 'Country', '');
INSERT INTO `language_value` VALUES ('120', 'vi', 'Post code', '');
INSERT INTO `language_value` VALUES ('121', 'vi', 'Customer Manage', '');
INSERT INTO `language_value` VALUES ('122', 'vi', 'Edit Email Template', 'Sửa mẫu email');
INSERT INTO `language_value` VALUES ('123', 'vi', 'Add Email Template', 'Thêm mẫu email');
INSERT INTO `language_value` VALUES ('124', 'vi', 'Email Template Manage', 'Quản lý mẫu email');
INSERT INTO `language_value` VALUES ('125', 'vi', 'File Manager', 'Quản lý file');
INSERT INTO `language_value` VALUES ('126', 'vi', 'File upload setting', 'Cấu hình file');
INSERT INTO `language_value` VALUES ('127', 'vi', 'Field', 'Trường');
INSERT INTO `language_value` VALUES ('128', 'vi', 'Type', 'Kiểu');
INSERT INTO `language_value` VALUES ('129', 'vi', 'Null', 'Null1');
INSERT INTO `language_value` VALUES ('130', 'vi', 'Key', 'Khóa');
INSERT INTO `language_value` VALUES ('131', 'vi', 'Default', 'Mặc định');
INSERT INTO `language_value` VALUES ('132', 'vi', 'Extra', '');
INSERT INTO `language_value` VALUES ('133', 'vi', 'Table list', '');
INSERT INTO `language_value` VALUES ('134', 'vi', 'Table info', '');
INSERT INTO `language_value` VALUES ('135', 'vi', 'Add {tableText}', '');
INSERT INTO `language_value` VALUES ('136', 'vi', 'Edit {tableText}', '');
INSERT INTO `language_value` VALUES ('137', 'vi', '{tableText} name is exist', '');
INSERT INTO `language_value` VALUES ('138', 'vi', '{tableText} add success', '');
INSERT INTO `language_value` VALUES ('139', 'vi', '{tableText} update success', '');
INSERT INTO `language_value` VALUES ('140', 'vi', '{tableText} not exist', '');
INSERT INTO `language_value` VALUES ('141', 'vi', '{tableText} Manage', '');
INSERT INTO `language_value` VALUES ('142', 'vi', 'Total orders', 'Tổng đơn hàng');
INSERT INTO `language_value` VALUES ('143', 'vi', 'View more', 'Xem thêm');
INSERT INTO `language_value` VALUES ('144', 'vi', 'Total products', 'Tổng sản phẩm');
INSERT INTO `language_value` VALUES ('145', 'vi', 'Total category', 'Tổng danh mục');
INSERT INTO `language_value` VALUES ('146', 'vi', 'Total customer', 'Tổng khách hàng');
INSERT INTO `language_value` VALUES ('147', 'vi', 'Orders statistic', 'Thống kê đơn hàng theo giá trị');
INSERT INTO `language_value` VALUES ('148', 'vi', 'Select all', 'Chọn tất cả');
INSERT INTO `language_value` VALUES ('149', 'vi', 'Statistic by year', 'Thống kê theo năm');
INSERT INTO `language_value` VALUES ('150', 'vi', 'Orders group by status', 'Thống kê đơn hàng theo trạng thái');
INSERT INTO `language_value` VALUES ('151', 'vi', 'Orders latest', 'Đơn hàng tạo gần nhất');
INSERT INTO `language_value` VALUES ('152', 'vi', 'Products latest', 'Sản phẩm thêm gần nhất');
INSERT INTO `language_value` VALUES ('153', 'vi', 'Edit Language', '');
INSERT INTO `language_value` VALUES ('154', 'vi', 'Add Language', '');
INSERT INTO `language_value` VALUES ('155', 'vi', 'Language Manage', '');
INSERT INTO `language_value` VALUES ('156', 'vi', 'Add language value', '');
INSERT INTO `language_value` VALUES ('157', 'vi', 'Total: %s', 'Tổng tiền: %s');
INSERT INTO `language_value` VALUES ('158', 'vi', 'Filter language name', '');
INSERT INTO `language_value` VALUES ('159', 'vi', 'Language Value Manage', '');
INSERT INTO `language_value` VALUES ('160', 'vi', 'Import auto', '');
INSERT INTO `language_value` VALUES ('161', 'vi', 'This action will scan the entire source code to identify the language up will take time. Do you want to continue?', '');
INSERT INTO `language_value` VALUES ('162', 'vi', 'Add widget', '');
INSERT INTO `language_value` VALUES ('163', 'vi', 'Edit widget', '');
INSERT INTO `language_value` VALUES ('164', 'vi', 'Row setting', '');
INSERT INTO `language_value` VALUES ('165', 'vi', 'Widgets list is empty', '');
INSERT INTO `language_value` VALUES ('166', 'vi', 'Add class', 'Thêm lớp');
INSERT INTO `language_value` VALUES ('167', 'vi', 'Full width', '');
INSERT INTO `language_value` VALUES ('168', 'vi', 'Yes', 'Có');
INSERT INTO `language_value` VALUES ('169', 'vi', 'No', '');
INSERT INTO `language_value` VALUES ('170', 'vi', 'Cols class', '');
INSERT INTO `language_value` VALUES ('171', 'vi', 'Col', '');
INSERT INTO `language_value` VALUES ('172', 'vi', 'Layout manage', 'Quản lý layout');
INSERT INTO `language_value` VALUES ('173', 'vi', 'Layout', 'Layout');
INSERT INTO `language_value` VALUES ('174', 'vi', 'Layout system', 'Layout hệ thống');
INSERT INTO `language_value` VALUES ('175', 'vi', 'Desktop', '');
INSERT INTO `language_value` VALUES ('176', 'vi', 'Mobile', '');
INSERT INTO `language_value` VALUES ('177', 'vi', 'Option', '');
INSERT INTO `language_value` VALUES ('178', 'vi', 'Custom Css', '');
INSERT INTO `language_value` VALUES ('179', 'vi', 'Header', 'Đầu trang');
INSERT INTO `language_value` VALUES ('180', 'vi', 'Main content', 'Nội dung chính');
INSERT INTO `language_value` VALUES ('181', 'vi', 'Footer', 'Chân trang');
INSERT INTO `language_value` VALUES ('182', 'vi', 'Layout row add success', 'Thêm dòng vào layout thành công');
INSERT INTO `language_value` VALUES ('183', 'vi', 'Add a row', 'Thêm 1 dòng');
INSERT INTO `language_value` VALUES ('184', 'vi', 'Cols', '');
INSERT INTO `language_value` VALUES ('185', 'vi', 'Move row', '');
INSERT INTO `language_value` VALUES ('186', 'vi', 'Delete row', '');
INSERT INTO `language_value` VALUES ('187', 'vi', 'Setting row', '');
INSERT INTO `language_value` VALUES ('188', 'vi', 'Delete widget', '');
INSERT INTO `language_value` VALUES ('189', 'vi', 'Setting widget', '');
INSERT INTO `language_value` VALUES ('190', 'vi', 'Navbar top', '');
INSERT INTO `language_value` VALUES ('191', 'vi', 'Slidebar left', '');
INSERT INTO `language_value` VALUES ('192', 'vi', 'Slidebar right', '');
INSERT INTO `language_value` VALUES ('193', 'vi', 'Column class', '');
INSERT INTO `language_value` VALUES ('194', 'vi', 'Layout row detele success', '');
INSERT INTO `language_value` VALUES ('195', 'vi', 'Widget detele success', '');
INSERT INTO `language_value` VALUES ('196', 'vi', 'This <b>Header</b> panel. Switch to <u>layout system</u> tab to config this', 'Đây là phần <b>Đầu trang</b>. Hãy chuyển qua phần <u>layout hệ thống</u> để cấu hình');
INSERT INTO `language_value` VALUES ('197', 'vi', 'This <b>Footer</b> panel. Switch to <u>layout system</u> tab to config this', 'Đây là phần <b>Chân trang</b>. Hãy chuyển qua phần <u>layout hệ thống</u> để cấu hình');
INSERT INTO `language_value` VALUES ('198', 'vi', 'Disable widgets', '');
INSERT INTO `language_value` VALUES ('199', 'vi', 'Mobile layout setting', '');
INSERT INTO `language_value` VALUES ('200', 'vi', 'System content', 'Nội dung hệ thống');
INSERT INTO `language_value` VALUES ('201', 'vi', 'Administrator', '');
INSERT INTO `language_value` VALUES ('202', 'vi', 'Login to your account', 'Đăng nhập vào hệ thống quản trị');
INSERT INTO `language_value` VALUES ('203', 'vi', 'Enter username and password', 'Diền tên đăng nhập và mật khẩu');
INSERT INTO `language_value` VALUES ('204', 'vi', 'Remember me', 'Ghi nhớ');
INSERT INTO `language_value` VALUES ('205', 'vi', 'Login', 'Đăng nhập');
INSERT INTO `language_value` VALUES ('206', 'vi', 'Forgot your password ?', '');
INSERT INTO `language_value` VALUES ('207', 'vi', 'click here', '');
INSERT INTO `language_value` VALUES ('208', 'vi', 'to reset your password', '');
INSERT INTO `language_value` VALUES ('209', 'vi', 'Add Menu', 'Thêm menu');
INSERT INTO `language_value` VALUES ('210', 'vi', 'Edit Menu', 'Sửa menu');
INSERT INTO `language_value` VALUES ('211', 'vi', 'Menu Manage', 'Quản lý menu');
INSERT INTO `language_value` VALUES ('212', 'vi', 'Edit menu', 'Sửa menu');
INSERT INTO `language_value` VALUES ('213', 'vi', 'Add menu', 'Thêm menu');
INSERT INTO `language_value` VALUES ('214', 'vi', 'Custom links', 'Nhập liên kết');
INSERT INTO `language_value` VALUES ('215', 'vi', 'Pages', 'Trang tĩnh');
INSERT INTO `language_value` VALUES ('216', 'vi', 'Categories', 'Danh mục sản phẩm');
INSERT INTO `language_value` VALUES ('217', 'vi', 'Expand All', 'Mở rộng tất cả');
INSERT INTO `language_value` VALUES ('218', 'vi', 'Collapse All', 'Thu gọn tất cả');
INSERT INTO `language_value` VALUES ('219', 'vi', 'Menu info', 'Thông tin menu');
INSERT INTO `language_value` VALUES ('220', 'vi', 'Save', 'Lưu');
INSERT INTO `language_value` VALUES ('221', 'vi', 'Delete menu', 'Xóa menu');
INSERT INTO `language_value` VALUES ('222', 'vi', 'Menu not found. Click add menu button to insert to menu.', '');
INSERT INTO `language_value` VALUES ('223', 'vi', 'Edit Nav Link', '');
INSERT INTO `language_value` VALUES ('224', 'vi', 'Add Nav Link', '');
INSERT INTO `language_value` VALUES ('225', 'vi', 'Nav Link Manage', '');
INSERT INTO `language_value` VALUES ('226', 'vi', 'Show info', '');
INSERT INTO `language_value` VALUES ('227', 'vi', 'Add item', '');
INSERT INTO `language_value` VALUES ('228', 'vi', 'Edit Plugin', '');
INSERT INTO `language_value` VALUES ('229', 'vi', 'Add Plugin', '');
INSERT INTO `language_value` VALUES ('230', 'vi', 'Plugin Manage', '');
INSERT INTO `language_value` VALUES ('231', 'vi', 'Add role', 'Thêm quyền');
INSERT INTO `language_value` VALUES ('232', 'vi', 'Edit role', 'Sửa quyền');
INSERT INTO `language_value` VALUES ('234', 'vi', 'Permission', 'Quyền');
INSERT INTO `language_value` VALUES ('235', 'vi', 'Add a new user group', 'Thêm mới 1 nhóm người dùng');
INSERT INTO `language_value` VALUES ('236', 'vi', 'Edit user group', '');
INSERT INTO `language_value` VALUES ('237', 'vi', 'Group Name', 'Nhóm quản trị');
INSERT INTO `language_value` VALUES ('238', 'vi', 'Role Manage', 'Quản lý quyền');
INSERT INTO `language_value` VALUES ('239', 'vi', 'Add Router', '');
INSERT INTO `language_value` VALUES ('240', 'vi', 'Edit Router', 'Sửa router');
INSERT INTO `language_value` VALUES ('241', 'vi', 'Router Manage', 'Quản lý router');
INSERT INTO `language_value` VALUES ('242', 'vi', 'Settings for %s', 'Cấu hình cho %s');
INSERT INTO `language_value` VALUES ('243', 'vi', 'Add Widget', '');
INSERT INTO `language_value` VALUES ('244', 'vi', 'Edit Widget', '');
INSERT INTO `language_value` VALUES ('245', 'vi', 'Widget Manage', '');
INSERT INTO `language_value` VALUES ('246', 'vi', 'My account', 'Tài khoản của tôi');
INSERT INTO `language_value` VALUES ('247', 'vi', 'Log out', 'Đăng xuất');
INSERT INTO `language_value` VALUES ('248', 'vi', 'Settings', 'Cấu hình');
INSERT INTO `language_value` VALUES ('249', 'vi', 'Dashboard', 'Bảng điều khiển');
INSERT INTO `language_value` VALUES ('250', 'vi', 'Language manage', '');
INSERT INTO `language_value` VALUES ('251', 'vi', 'Default language', '');
INSERT INTO `language_value` VALUES ('252', 'vi', 'label', 'Nhãn');
INSERT INTO `language_value` VALUES ('253', 'vi', 'description', 'Mô tả');
INSERT INTO `language_value` VALUES ('254', 'vi', 'placeholder', '');
INSERT INTO `language_value` VALUES ('255', 'vi', 'placeholder1', '');
INSERT INTO `language_value` VALUES ('256', 'vi', 'placeholder2', '');
INSERT INTO `language_value` VALUES ('257', 'vi', 'From', '');
INSERT INTO `language_value` VALUES ('258', 'vi', 'text', '');
INSERT INTO `language_value` VALUES ('259', 'vi', 'To', '');
INSERT INTO `language_value` VALUES ('260', 'vi', 'Delete item', 'Xóa đối tượng');
INSERT INTO `language_value` VALUES ('261', 'vi', 'Add image', 'Thêm hình ảnh');
INSERT INTO `language_value` VALUES ('263', 'vi', 'Select All Backend', '');
INSERT INTO `language_value` VALUES ('264', 'vi', 'Select All Frontend', '');
INSERT INTO `language_value` VALUES ('265', 'vi', 'UnSelect All', 'Không chọn');
INSERT INTO `language_value` VALUES ('266', 'vi', 'Add tag', '');
INSERT INTO `language_value` VALUES ('267', 'vi', 'Choose from tags list', '');
INSERT INTO `language_value` VALUES ('268', 'vi', 'Select tag', '');
INSERT INTO `language_value` VALUES ('269', 'vi', 'Tags selected list', '');
INSERT INTO `language_value` VALUES ('270', 'vi', 'Remove tag', '');
INSERT INTO `language_value` VALUES ('271', 'vi', 'Tag name is required', '');
INSERT INTO `language_value` VALUES ('272', 'vi', '%s star', '');
INSERT INTO `language_value` VALUES ('273', 'vi', 'heading', '');
INSERT INTO `language_value` VALUES ('274', 'vi', 'PAGE %s OF %s <i>(item %s of %s)</i>', 'Trang %s / %s <i>(số lượng %s / %s)</i>');
INSERT INTO `language_value` VALUES ('275', 'vi', 'Go to first page', '');
INSERT INTO `language_value` VALUES ('276', 'vi', 'Go to page %s', '');
INSERT INTO `language_value` VALUES ('277', 'vi', 'Go to last page', '');
INSERT INTO `language_value` VALUES ('278', 'vi', 'Back', 'Quay lại');
INSERT INTO `language_value` VALUES ('279', 'vi', 'Reset', '');
INSERT INTO `language_value` VALUES ('280', 'vi', 'More', 'Thông tin thêm');
INSERT INTO `language_value` VALUES ('281', 'vi', 'Oops!<br>The site does not exist', 'Rất tiếc!<br>Địa chỉ trang web không tồn tại');
INSERT INTO `language_value` VALUES ('282', 'vi', 'Go to home', 'Đi tới trang chủ');
INSERT INTO `language_value` VALUES ('283', 'vi', 'Email', 'Email');
INSERT INTO `language_value` VALUES ('284', 'vi', 'Password', 'Mật khẩu');
INSERT INTO `language_value` VALUES ('285', 'vi', 'Confirm Password', 'Gõ lại mật khẩu');
INSERT INTO `language_value` VALUES ('286', 'vi', 'Name', 'Tên');
INSERT INTO `language_value` VALUES ('287', 'vi', 'Mobile Number', 'Số di động');
INSERT INTO `language_value` VALUES ('288', 'vi', 'Birthday', 'Ngày sinh');
INSERT INTO `language_value` VALUES ('289', 'vi', 'Update', 'Cập nhật');
INSERT INTO `language_value` VALUES ('290', 'vi', 'Orders information', 'Thông tin đơn hàng');
INSERT INTO `language_value` VALUES ('291', 'vi', 'Note', 'Ghi chú');
INSERT INTO `language_value` VALUES ('292', 'vi', 'Total', 'Tồng tiền');
INSERT INTO `language_value` VALUES ('293', 'vi', 'Created on', 'Ngày tạo');
INSERT INTO `language_value` VALUES ('294', 'vi', 'Modified on', 'Người sửa');
INSERT INTO `language_value` VALUES ('295', 'vi', 'Customer info', 'Thông tin khách hàng');
INSERT INTO `language_value` VALUES ('296', 'vi', 'Phone', 'Điện thoại');
INSERT INTO `language_value` VALUES ('297', 'vi', 'Product list', 'Danh mục sản phẩm');
INSERT INTO `language_value` VALUES ('298', 'vi', 'Add Orders', 'Thêm đơn hàng');
INSERT INTO `language_value` VALUES ('299', 'vi', 'Orders Subtotal', '');
INSERT INTO `language_value` VALUES ('300', 'vi', 'Shipping price', '');
INSERT INTO `language_value` VALUES ('301', 'vi', 'price', 'Giá');
INSERT INTO `language_value` VALUES ('302', 'vi', 'Previous', 'Quay lại');
INSERT INTO `language_value` VALUES ('303', 'vi', 'Next', 'Tiếp theo');
INSERT INTO `language_value` VALUES ('304', 'vi', 'View all', 'Xem tất cả');
INSERT INTO `language_value` VALUES ('305', 'vi', 'View less', 'Thu nhỏ lại');
INSERT INTO `language_value` VALUES ('306', 'vi', 'Oops! The Page you requested was not found!', 'Rất tiếc! Trang web bạn yêu cầu không tìm thấy');
INSERT INTO `language_value` VALUES ('307', 'vi', 'Return home', 'Quay lại trang chủ');
INSERT INTO `language_value` VALUES ('308', 'vi', 'Admin login', '');
INSERT INTO `language_value` VALUES ('309', 'vi', 'Apply', 'Áp dụng');
INSERT INTO `language_value` VALUES ('310', 'vi', 'Administrator Panel', 'Bảng điều kiển');
INSERT INTO `language_value` VALUES ('311', 'vi', 'Giỏ hàng (%s)', '');
INSERT INTO `language_value` VALUES ('312', 'vi', 'Giỏ hàng', '');
INSERT INTO `language_value` VALUES ('313', 'vi', '<i>FacebookCommentWidget apply for product detail page only</i>. \r\n					Go to <a href=', '');
INSERT INTO `language_value` VALUES ('314', 'vi', 'Your shopping bag is empty', '');
INSERT INTO `language_value` VALUES ('315', 'vi', 'SHOP NOW', 'MUA NGAY');
INSERT INTO `language_value` VALUES ('316', 'vi', 'to find your favorite product', '');
INSERT INTO `language_value` VALUES ('317', 'vi', 'Slider name is exist', '');
INSERT INTO `language_value` VALUES ('318', 'vi', 'Slider add success', '');
INSERT INTO `language_value` VALUES ('319', 'vi', 'Slider update success', '');
INSERT INTO `language_value` VALUES ('320', 'vi', 'Slider not exist', '');
INSERT INTO `language_value` VALUES ('321', 'vi', 'Edit Slider', '');
INSERT INTO `language_value` VALUES ('322', 'vi', 'Add Slider', '');
INSERT INTO `language_value` VALUES ('323', 'vi', 'Overview', '');
INSERT INTO `language_value` VALUES ('324', 'vi', 'Images', 'Hình ảnh');
INSERT INTO `language_value` VALUES ('325', 'vi', 'This function will enable in edit page!', '');
INSERT INTO `language_value` VALUES ('326', 'vi', 'Add image is success', 'Thêm hình ảnh thành công');
INSERT INTO `language_value` VALUES ('327', 'vi', 'Delete image is success', 'Xóa hình ảnh thành công');
INSERT INTO `language_value` VALUES ('328', 'vi', 'Slider Manage', '');
INSERT INTO `language_value` VALUES ('329', 'vi', 'Name is exist', '');
INSERT INTO `language_value` VALUES ('330', 'vi', 'Add is success', '');
INSERT INTO `language_value` VALUES ('331', 'vi', 'Update is success', '');
INSERT INTO `language_value` VALUES ('332', 'vi', 'Delete attribute is success', 'Xóa thuộc tính thành công');
INSERT INTO `language_value` VALUES ('333', 'vi', 'Product filter not exist', '');
INSERT INTO `language_value` VALUES ('334', 'vi', 'Category name is exist', 'Danh mục sản phẩm đã tồn tại');
INSERT INTO `language_value` VALUES ('335', 'vi', 'Cannot choose itself as its parent', 'Không được chọn danh mục con là cha');
INSERT INTO `language_value` VALUES ('336', 'vi', 'Add category success!', 'Thêm danh mục thành cộng');
INSERT INTO `language_value` VALUES ('337', 'vi', 'Edit category success!', '');
INSERT INTO `language_value` VALUES ('338', 'vi', 'Delete Success!', '');
INSERT INTO `language_value` VALUES ('339', 'vi', 'Category not exist', '');
INSERT INTO `language_value` VALUES ('340', 'vi', 'Category not exist.', '');
INSERT INTO `language_value` VALUES ('341', 'vi', 'Delete error! <br>Category have sub child', '');
INSERT INTO `language_value` VALUES ('342', 'vi', 'Delete error! <br>Category have product', '');
INSERT INTO `language_value` VALUES ('343', 'vi', 'Checkout update success', '');
INSERT INTO `language_value` VALUES ('344', 'vi', 'Checkout is invalid', '');
INSERT INTO `language_value` VALUES ('345', 'vi', 'Currency currencyCode is exist', '');
INSERT INTO `language_value` VALUES ('346', 'vi', 'Currency default must select', '');
INSERT INTO `language_value` VALUES ('347', 'vi', 'Status must active for default currency', '');
INSERT INTO `language_value` VALUES ('348', 'vi', 'Currency add success', '');
INSERT INTO `language_value` VALUES ('349', 'vi', 'Currency update success', '');
INSERT INTO `language_value` VALUES ('350', 'vi', 'Currency not exist', '');
INSERT INTO `language_value` VALUES ('351', 'vi', 'Not delete with default currency', '');
INSERT INTO `language_value` VALUES ('352', 'vi', 'Manufac name is exist', '');
INSERT INTO `language_value` VALUES ('353', 'vi', 'Manufac add success', '');
INSERT INTO `language_value` VALUES ('354', 'vi', 'Manufac update success', '');
INSERT INTO `language_value` VALUES ('355', 'vi', 'Manufac not exist', '');
INSERT INTO `language_value` VALUES ('356', 'vi', 'Order Status name is exist', 'Tên trạng thái đơn hàng đã tồn tại');
INSERT INTO `language_value` VALUES ('357', 'vi', 'Order Status add success', 'Thêm trạng thái đơn hàng thành công');
INSERT INTO `language_value` VALUES ('358', 'vi', 'Order Status update success', 'Cập nhật trạng thái đơn hàng thành công');
INSERT INTO `language_value` VALUES ('359', 'vi', 'Order Status not exist', 'Trạng thái đơn hàng không tồn tại');
INSERT INTO `language_value` VALUES ('360', 'vi', 'Not delete status of system', 'Không được xóa trạng thái đơn hàng của hệ thống');
INSERT INTO `language_value` VALUES ('361', 'vi', 'Orders update success', 'Đơn hàng cập nhật thành công');
INSERT INTO `language_value` VALUES ('362', 'vi', 'Orders delete success', 'Đơn hàng  xóa thành công');
INSERT INTO `language_value` VALUES ('363', 'vi', 'Product name is exist', 'Tên sản phẩm đã tồn tại');
INSERT INTO `language_value` VALUES ('364', 'vi', 'Product code is exist', 'Mã sản phẩm đã tồn tại');
INSERT INTO `language_value` VALUES ('365', 'vi', 'Add is success!', 'Thêm thành công');
INSERT INTO `language_value` VALUES ('366', 'vi', 'Access deny', 'Truy cập bị từ chối');
INSERT INTO `language_value` VALUES ('367', 'vi', 'Report status', '');
INSERT INTO `language_value` VALUES ('368', 'vi', 'Report description', '');
INSERT INTO `language_value` VALUES ('369', 'vi', 'error', 'Lỗi');
INSERT INTO `language_value` VALUES ('370', 'vi', 'Not found product %s', 'Không tìm thấy sản phẩm %s');
INSERT INTO `language_value` VALUES ('371', 'vi', 'add', 'Thêm');
INSERT INTO `language_value` VALUES ('372', 'vi', 'Add product #%s', 'Thêm sản phẩm #%s');
INSERT INTO `language_value` VALUES ('373', 'vi', 'no change', 'Không thay đổi');
INSERT INTO `language_value` VALUES ('374', 'vi', 'edit', 'Sửa');
INSERT INTO `language_value` VALUES ('375', 'vi', 'Edit product #%s width field [%s]', '');
INSERT INTO `language_value` VALUES ('376', 'vi', 'Update is success!', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES ('377', 'vi', 'Import product is success!', '');
INSERT INTO `language_value` VALUES ('378', 'vi', 'Product not exist', 'Sản phẩm không tồn tại');
INSERT INTO `language_value` VALUES ('379', 'vi', 'Action not support', 'Hành động không được hỗ trợ');
INSERT INTO `language_value` VALUES ('380', 'vi', 'Product not delete. <br>Delete order before delete product', 'Không xóa được sản phẩm này.<br>Hãy xóa đơn hàng trước.');
INSERT INTO `language_value` VALUES ('381', 'vi', 'Change product quantity is success', 'Thay đổi số lượng sản phẩm thành công');
INSERT INTO `language_value` VALUES ('382', 'vi', 'Remove product is success', 'Xóa sản phẩm thành công');
INSERT INTO `language_value` VALUES ('383', 'vi', 'Clear cart is success', 'Xóa giỏ hàng thành công');
INSERT INTO `language_value` VALUES ('384', 'vi', 'Login Failed! Wrong username or password!', 'Dăng nhập lỗi. Kiểm tra lại tên đăng nhập hoặc mật khẩu');
INSERT INTO `language_value` VALUES ('385', 'vi', 'Orders is success. Check your email to view detail', 'Đơn hàng được tạo thành công. Hãy kiểm tra email của bạn để biết thông tin chii tiết.');
INSERT INTO `language_value` VALUES ('386', 'vi', 'Orders is empty', 'Đơn hàng trống');
INSERT INTO `language_value` VALUES ('387', 'vi', 'Add product wishlist is success', 'Thêm sản phẩm quan tâm thành công');
INSERT INTO `language_value` VALUES ('388', 'vi', 'You must be logged on to use this functions', 'Bạn phải đăng nhập mới thực hiện được chức năng này');
INSERT INTO `language_value` VALUES ('389', 'vi', 'Delete product wishlist is success', 'Xóa sản phẩm quan tâm thành công');
INSERT INTO `language_value` VALUES ('390', 'vi', 'Delete product wishlist is error', 'Xóa sản phẩm quan tâm có lỗi');
INSERT INTO `language_value` VALUES ('391', 'vi', 'Delete all product wishlist is success', 'Toàn bộ sản phẩm quan tâm đã được thành công');
INSERT INTO `language_value` VALUES ('392', 'vi', 'Emty---', 'Trống---');
INSERT INTO `language_value` VALUES ('393', 'vi', 'New Attribute', 'Thêm thuộc tính');
INSERT INTO `language_value` VALUES ('394', 'vi', 'Edit Attribute', 'Sửa thuộc tính');
INSERT INTO `language_value` VALUES ('395', 'vi', 'Attribute Value', 'Giá trị thuộc tính');
INSERT INTO `language_value` VALUES ('396', 'vi', 'Add attribute value', 'Thêm giá trị thuộc tính');
INSERT INTO `language_value` VALUES ('397', 'vi', 'Attribute Manage', 'Quản lý thuộc tính');
INSERT INTO `language_value` VALUES ('398', 'vi', 'Add Attribute', 'Thêm thuộc tính');
INSERT INTO `language_value` VALUES ('399', 'vi', 'Edit Category', '');
INSERT INTO `language_value` VALUES ('400', 'vi', 'Add Category', 'Thêm danh mục');
INSERT INTO `language_value` VALUES ('401', 'vi', 'Category Manage', '');
INSERT INTO `language_value` VALUES ('402', 'vi', 'Checkout %s edit [%s]', '');
INSERT INTO `language_value` VALUES ('403', 'vi', 'Checkout %s add [%s]', '');
INSERT INTO `language_value` VALUES ('404', 'vi', 'Setting', 'Cấu hình');
INSERT INTO `language_value` VALUES ('405', 'vi', 'Add %s', 'Thêm %s');
INSERT INTO `language_value` VALUES ('406', 'vi', 'Edit Currency', 'Sửa tiền tệ');
INSERT INTO `language_value` VALUES ('407', 'vi', 'Add Currency', 'Thêm tiền tệ');
INSERT INTO `language_value` VALUES ('408', 'vi', 'Currency Manage', 'Quản lý tiền tệ');
INSERT INTO `language_value` VALUES ('409', 'vi', 'Edit Manufac', '');
INSERT INTO `language_value` VALUES ('410', 'vi', 'Add Manufac', '');
INSERT INTO `language_value` VALUES ('411', 'vi', 'Manufac Manage', '');
INSERT INTO `language_value` VALUES ('412', 'vi', 'Add Order Status', 'Thêm trạng thái đơn hàng');
INSERT INTO `language_value` VALUES ('413', 'vi', 'Edit Order Status', 'Sửa trạng thái đơn hàng');
INSERT INTO `language_value` VALUES ('414', 'vi', 'Order Status Manage', 'Quản lý trạng thái đơn hàng');
INSERT INTO `language_value` VALUES ('415', 'vi', 'Edit orders #$orderId', 'Sửa đơn hàng #%');
INSERT INTO `language_value` VALUES ('416', 'vi', 'Add orders', '');
INSERT INTO `language_value` VALUES ('417', 'vi', 'Status', 'Trạng thái');
INSERT INTO `language_value` VALUES ('418', 'vi', 'Note (customer)', 'Ghi chú (khách hàng)');
INSERT INTO `language_value` VALUES ('419', 'vi', 'Comment', 'Khách hàng');
INSERT INTO `language_value` VALUES ('420', 'vi', 'History', 'Lịch sử');
INSERT INTO `language_value` VALUES ('421', 'vi', 'Empty', 'Trống');
INSERT INTO `language_value` VALUES ('422', 'vi', 'Orders Manage', 'Quản lý đơn hàng');
INSERT INTO `language_value` VALUES ('423', 'vi', 'Export data', 'Xuất dữ liệu');
INSERT INTO `language_value` VALUES ('424', 'vi', 'New product', 'Thêm sản phẩm mới');
INSERT INTO `language_value` VALUES ('425', 'vi', 'Edit product', 'Sửa sản phẩm');
INSERT INTO `language_value` VALUES ('426', 'vi', 'Extension', 'Mở rộng');
INSERT INTO `language_value` VALUES ('427', 'vi', 'Please save product before add attribute', 'Làm ơn lưu sản phẩm trước khi sử dụng tính năng này');
INSERT INTO `language_value` VALUES ('428', 'vi', 'Select a attribute', 'Chọn 1 thuộc tính');
INSERT INTO `language_value` VALUES ('429', 'vi', 'Add attribute', 'Thêm thuộc tính');
INSERT INTO `language_value` VALUES ('430', 'vi', 'Delete attribute', 'Xóa thuộc tính');
INSERT INTO `language_value` VALUES ('431', 'vi', 'Select none', 'Không chọn');
INSERT INTO `language_value` VALUES ('432', 'vi', 'Use char | to insert mutil attribute value.', '');
INSERT INTO `language_value` VALUES ('433', 'vi', 'Show all image', 'Hiển thị toàn bộ hình ảnh');
INSERT INTO `language_value` VALUES ('434', 'vi', 'Value', 'Giá trị');
INSERT INTO `language_value` VALUES ('435', 'vi', 'Each image link or video (youtube) link write on per line', 'Mỗi liên kết (image, youtube) ghi trên 1 dòng');
INSERT INTO `language_value` VALUES ('436', 'vi', 'Each image or video (youtube) write on per line', 'Mỗi liên kết (image, youtube) ghi trên 1 dòng');
INSERT INTO `language_value` VALUES ('437', 'vi', 'Products Manage', 'Quản lý sản phẩm');
INSERT INTO `language_value` VALUES ('438', 'vi', 'Add product', 'Thêm sản phẩm');
INSERT INTO `language_value` VALUES ('439', 'vi', 'Advance action', 'Hành đồng nâng cao');
INSERT INTO `language_value` VALUES ('440', 'vi', 'Import', 'Nhập dữ liệu');
INSERT INTO `language_value` VALUES ('441', 'vi', 'Report file', '');
INSERT INTO `language_value` VALUES ('442', 'vi', 'Image dir', '');
INSERT INTO `language_value` VALUES ('443', 'vi', 'Copy folder path at File Manage', '');
INSERT INTO `language_value` VALUES ('444', 'vi', 'Export', 'Xuất dữ liệu');
INSERT INTO `language_value` VALUES ('445', 'vi', 'Checkout', 'Thanh toán');
INSERT INTO `language_value` VALUES ('446', 'vi', 'Confirm orders', 'Xác nhận đơn hàng');
INSERT INTO `language_value` VALUES ('447', 'vi', 'Please check back again to confirm orders', '');
INSERT INTO `language_value` VALUES ('448', 'vi', 'Confirm', 'Xác nhận');
INSERT INTO `language_value` VALUES ('449', 'vi', 'Category', 'Danh mục');
INSERT INTO `language_value` VALUES ('450', 'vi', 'Filters', 'Bộ lọc');
INSERT INTO `language_value` VALUES ('451', 'vi', 'ShopLips', '');
INSERT INTO `language_value` VALUES ('452', 'vi', 'Show all options', '');
INSERT INTO `language_value` VALUES ('453', 'vi', 'Clear fillters', '');
INSERT INTO `language_value` VALUES ('454', 'vi', 'Price', 'Giá');
INSERT INTO `language_value` VALUES ('455', 'vi', 'Search', 'Tìm kiếm');
INSERT INTO `language_value` VALUES ('456', 'vi', 'Search results for', 'Kết quả tìm kiếm');
INSERT INTO `language_value` VALUES ('457', 'vi', 'Sorry, beautiful', '');
INSERT INTO `language_value` VALUES ('458', 'vi', 'We couldn', '');
INSERT INTO `language_value` VALUES ('459', 'vi', 'Did you mean', '');
INSERT INTO `language_value` VALUES ('460', 'vi', 'BUT DON', '');
INSERT INTO `language_value` VALUES ('461', 'vi', 'Double check the spelling', '');
INSERT INTO `language_value` VALUES ('462', 'vi', 'Limit your search to one or two words', '');
INSERT INTO `language_value` VALUES ('463', 'vi', 'Be less specific—try using general words and terms to find similar products', '');
INSERT INTO `language_value` VALUES ('464', 'vi', 'If you cannot find what you are looking for, why not let our trained staff recommend something', '');
INSERT INTO `language_value` VALUES ('465', 'vi', 'Our Customer Service Representatives are available now to help', '');
INSERT INTO `language_value` VALUES ('466', 'vi', 'Contact Us', 'Liên hệ');
INSERT INTO `language_value` VALUES ('467', 'vi', 'or call', '');
INSERT INTO `language_value` VALUES ('468', 'vi', 'quick shop', '');
INSERT INTO `language_value` VALUES ('469', 'vi', 'Regular Price', '');
INSERT INTO `language_value` VALUES ('470', 'vi', 'Sale Price', '');
INSERT INTO `language_value` VALUES ('471', 'vi', 'NEW', 'Mới');
INSERT INTO `language_value` VALUES ('472', 'vi', 'SALE', 'Giảm giá');
INSERT INTO `language_value` VALUES ('473', 'vi', 'No data', '');
INSERT INTO `language_value` VALUES ('474', 'vi', 'Continue shopping', 'Tiếp tục mua hàng');
INSERT INTO `language_value` VALUES ('475', 'vi', 'Remove', '');
INSERT INTO `language_value` VALUES ('476', 'vi', 'level == -1 => select all category <br>level == 0 => select category root only<br>level == 1[2,3..] => select category root and child 1st[2nd, 3th...]', '');
INSERT INTO `language_value` VALUES ('477', 'vi', 'Product ID', 'ID sản phẩm');
INSERT INTO `language_value` VALUES ('478', 'vi', 'Product name', 'Tên sản phẩm');
INSERT INTO `language_value` VALUES ('479', 'vi', 'Product price', 'Giá sản phẩm');
INSERT INTO `language_value` VALUES ('480', 'vi', 'Product discount', 'Giá khuyến mãi');
INSERT INTO `language_value` VALUES ('481', 'vi', 'Descending', 'Giảm dần');
INSERT INTO `language_value` VALUES ('482', 'vi', 'Ascending', 'Tăng dần');
INSERT INTO `language_value` VALUES ('483', 'vi', '<i class=', '');
INSERT INTO `language_value` VALUES ('484', 'vi', 'News Category name is exist', '');
INSERT INTO `language_value` VALUES ('485', 'vi', 'News Category add success', '');
INSERT INTO `language_value` VALUES ('486', 'vi', 'News Category update success', '');
INSERT INTO `language_value` VALUES ('487', 'vi', 'News Category not exist', 'Danh mục tin tức không tồn tại');
INSERT INTO `language_value` VALUES ('488', 'vi', 'Delete error! <br>Because category have child', '');
INSERT INTO `language_value` VALUES ('489', 'vi', 'News title is exist', 'Tiêu đề của tin tức đã tồn tại');
INSERT INTO `language_value` VALUES ('490', 'vi', 'News add success', 'Thêm tin tức thành công');
INSERT INTO `language_value` VALUES ('491', 'vi', 'News update success', 'Cập nhật tin tức thành công');
INSERT INTO `language_value` VALUES ('492', 'vi', 'News not exist', 'tin tức không tồn tại');
INSERT INTO `language_value` VALUES ('493', 'vi', 'News Tag name is exist', 'Nhóm tin tức không tồn tại');
INSERT INTO `language_value` VALUES ('494', 'vi', 'Add tag is success', '');
INSERT INTO `language_value` VALUES ('495', 'vi', 'Tag is exist', '');
INSERT INTO `language_value` VALUES ('496', 'vi', 'Remove tag is success', '');
INSERT INTO `language_value` VALUES ('497', 'vi', 'News Tag add success', '');
INSERT INTO `language_value` VALUES ('498', 'vi', 'News Tag update success', '');
INSERT INTO `language_value` VALUES ('499', 'vi', 'News Tag not exist', '');
INSERT INTO `language_value` VALUES ('500', 'vi', 'Edit News', 'Sửa tin tức');
INSERT INTO `language_value` VALUES ('501', 'vi', 'Add News', 'Thêm tin tức');
INSERT INTO `language_value` VALUES ('502', 'vi', 'Input data incorrect. Please check again', 'Nhập dữ liệu không đúng, vui lòng kiểm tra lại');
INSERT INTO `language_value` VALUES ('503', 'vi', 'News Manage', 'Quản lý tin tức');
INSERT INTO `language_value` VALUES ('504', 'vi', 'Add News Category', 'Thêm danh mục tin tức');
INSERT INTO `language_value` VALUES ('505', 'vi', 'Edit News Category', 'Sửa danh mục tin tức');
INSERT INTO `language_value` VALUES ('506', 'vi', 'News Category Manage', 'Quản lý dan mục tin tức');
INSERT INTO `language_value` VALUES ('507', 'vi', 'Add News Tag', 'Thêm nhóm tin tức');
INSERT INTO `language_value` VALUES ('508', 'vi', 'Edit News Tag', 'Sửa nhóm tin tức');
INSERT INTO `language_value` VALUES ('509', 'vi', 'News Tag Manage', 'Quản lý nhóm tin tức');
INSERT INTO `language_value` VALUES ('510', 'vi', 'Contact not exist', 'Liên hệ không tồn tại');
INSERT INTO `language_value` VALUES ('511', 'vi', 'Your contact was sent to administrator', '');
INSERT INTO `language_value` VALUES ('512', 'vi', 'Contact Manage', 'Quản lý liên hệ');
INSERT INTO `language_value` VALUES ('513', 'vi', 'View Contact Info', '');
INSERT INTO `language_value` VALUES ('514', 'vi', 'Static Page title is exist', 'Tiêu đề của trang tĩnh đã tồn tại');
INSERT INTO `language_value` VALUES ('515', 'vi', 'Static Page add success', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES ('516', 'vi', 'Static Page update success', 'Cập nhật thành công');
INSERT INTO `language_value` VALUES ('517', 'vi', 'Static Page not exist', 'Trang không tồn tại');
INSERT INTO `language_value` VALUES ('518', 'vi', 'Page not exist', 'Trang không tồn tại');
INSERT INTO `language_value` VALUES ('519', 'vi', 'Add Static Page', 'Thêm trang tĩnh');
INSERT INTO `language_value` VALUES ('520', 'vi', 'Edit Static Page', 'Sửa trang tĩnh');
INSERT INTO `language_value` VALUES ('521', 'vi', 'Static Page Manage', 'Quản lý trang tĩnh');
INSERT INTO `language_value` VALUES ('522', 'vi', 'Customer Review name is exist', 'Tên đã tồn tại');
INSERT INTO `language_value` VALUES ('523', 'vi', 'Customer Review add success', 'Nhận xét khách hàng thêm thành công');
INSERT INTO `language_value` VALUES ('524', 'vi', 'Customer Review update success', 'Nhận xét khách hàng cập nhật thành công');
INSERT INTO `language_value` VALUES ('525', 'vi', 'Customer Review not exist', 'Nhận xét khách hàng không tồn tại');
INSERT INTO `language_value` VALUES ('526', 'vi', 'Add Customer Review', 'Thêm nhận xét khách hàng');
INSERT INTO `language_value` VALUES ('527', 'vi', 'Edit Customer Review', 'Sửa nhận xét khách hàng');
INSERT INTO `language_value` VALUES ('528', 'vi', 'Customer Review Manage', 'Nhận xét khách hàng');
INSERT INTO `language_value` VALUES ('529', 'vi', 'Newsletter name is exist', '');
INSERT INTO `language_value` VALUES ('530', 'vi', 'Newsletter add success', '');
INSERT INTO `language_value` VALUES ('531', 'vi', 'Newsletter update success', '');
INSERT INTO `language_value` VALUES ('532', 'vi', 'Newsletter not exist', '');
INSERT INTO `language_value` VALUES ('533', 'vi', 'Newsletter email add success', '');
INSERT INTO `language_value` VALUES ('534', 'vi', 'Newsletter email update success', '');
INSERT INTO `language_value` VALUES ('535', 'vi', 'Send email newsletter success', '');
INSERT INTO `language_value` VALUES ('536', 'vi', 'Newsletter Email not exist', '');
INSERT INTO `language_value` VALUES ('537', 'vi', 'You email already subcribed!', 'Email của bạn đã được đăng ký');
INSERT INTO `language_value` VALUES ('538', 'vi', 'Add Newsletter', '');
INSERT INTO `language_value` VALUES ('539', 'vi', 'Edit Newsletter', '');
INSERT INTO `language_value` VALUES ('540', 'vi', 'Newsletter Manage', '');
INSERT INTO `language_value` VALUES ('541', 'vi', 'Add Newsletter Email', '');
INSERT INTO `language_value` VALUES ('542', 'vi', 'Edit Newsletter Email', 'Sửa newsletter email template');
INSERT INTO `language_value` VALUES ('543', 'vi', 'Newsletter Email Template Manage', 'Quản lý newsletter email template');
INSERT INTO `language_value` VALUES ('544', 'vi', 'Add Newsletter Email Template', 'Thêm newsletter email template');
INSERT INTO `language_value` VALUES ('545', 'vi', 'Send email newsletter', 'Gửi email newsletter');
INSERT INTO `language_value` VALUES ('546', 'vi', 'Email list', 'Danh sách email');
INSERT INTO `language_value` VALUES ('547', 'vi', 'Select newsletter email to send', 'Lựa chọn email từ danh sách newsletter để gửi');
INSERT INTO `language_value` VALUES ('548', 'vi', 'Select customer email to send', ' Lựa chọn email từ danh sách khách hàng để gửi');
INSERT INTO `language_value` VALUES ('549', 'vi', 'Send email', 'Gửi email');
INSERT INTO `language_value` VALUES ('550', 'vi', 'Email sended list', 'Danh sách email đã gửi');
INSERT INTO `language_value` VALUES ('551', 'vi', 'Email info', 'Thông tin email');
INSERT INTO `language_value` VALUES ('552', 'vi', 'No email selected', 'Không có email được chọn');
INSERT INTO `language_value` VALUES ('553', 'vi', 'Profile Center', '');
INSERT INTO `language_value` VALUES ('554', 'vi', 'Help', 'Trợ giúp');
INSERT INTO `language_value` VALUES ('555', 'vi', 'Welcome to your subscriber profile page', '');
INSERT INTO `language_value` VALUES ('556', 'vi', 'You may use this page at any time to change or update the information you have provided us', '');
INSERT INTO `language_value` VALUES ('557', 'vi', 'On This Page', '');
INSERT INTO `language_value` VALUES ('558', 'vi', 'My Personal Information', '');
INSERT INTO `language_value` VALUES ('559', 'vi', 'Unsubscribe From All', '');
INSERT INTO `language_value` VALUES ('560', 'vi', 'Add or edit your personal information here. Once you have made changes to your information', '');
INSERT INTO `language_value` VALUES ('561', 'vi', 'click the', '');
INSERT INTO `language_value` VALUES ('562', 'vi', 'button', '');
INSERT INTO `language_value` VALUES ('563', 'vi', 'Indicates a required field', '');
INSERT INTO `language_value` VALUES ('564', 'vi', 'Email Address', '');
INSERT INTO `language_value` VALUES ('565', 'vi', 'Top of Page', '');
INSERT INTO `language_value` VALUES ('566', 'vi', 'If you wish to unsubscribe from ALL publications from', '');
INSERT INTO `language_value` VALUES ('567', 'vi', 'check the box and click the update button below', '');
INSERT INTO `language_value` VALUES ('568', 'vi', 'I no longer wish to receive any future publications', '');
INSERT INTO `language_value` VALUES ('569', 'vi', 'Thank You', '');
INSERT INTO `language_value` VALUES ('570', 'vi', 'You have been resubscribed to emails from', '');
INSERT INTO `language_value` VALUES ('571', 'vi', 'To view and edit the information you have given us and manage how', '');
INSERT INTO `language_value` VALUES ('572', 'vi', 'communicates with you', '');
INSERT INTO `language_value` VALUES ('573', 'vi', 'visit the', '');
INSERT INTO `language_value` VALUES ('574', 'vi', 'sign up for email', '');
INSERT INTO `language_value` VALUES ('575', 'vi', 'close', '');
INSERT INTO `language_value` VALUES ('576', 'vi', 'Thank you for signing up for our mailing list', '');
INSERT INTO `language_value` VALUES ('577', 'vi', 'You have been unsubscribed from this publication', '');
INSERT INTO `language_value` VALUES ('578', 'vi', 'If you wish to resubscribe to emails from', '');
INSERT INTO `language_value` VALUES ('579', 'vi', 'click', '');
INSERT INTO `language_value` VALUES ('580', 'vi', 'Resubscribe', '');
INSERT INTO `language_value` VALUES ('581', 'vi', 'Contact', 'Liên hệ');
INSERT INTO `language_value` VALUES ('582', 'vi', 'Product search', 'Tìm kiếm sản phẩm');
INSERT INTO `language_value` VALUES ('583', 'vi', 'Count', 'Tổng số');
INSERT INTO `language_value` VALUES ('584', 'vi', 'Orders total by day', 'Tổng tiền đơn hàng theo ngày');
INSERT INTO `language_value` VALUES ('585', 'vi', 'Orders total by month', 'Tổng tiền đơn hàng theo tháng');
INSERT INTO `language_value` VALUES ('586', 'vi', 'Orders total by year', 'Tổng tiền đơn hàng theo năm');
INSERT INTO `language_value` VALUES ('587', 'vi', 'Create date', 'Ngày tạo');
INSERT INTO `language_value` VALUES ('588', 'vi', 'Customer', 'Khách hàng');
INSERT INTO `language_value` VALUES ('589', 'vi', 'Tool', 'Công cụ');
INSERT INTO `language_value` VALUES ('590', 'vi', 'Summary', 'Tóm lược');
INSERT INTO `language_value` VALUES ('591', 'vi', 'Title', 'Tiêu đề');
INSERT INTO `language_value` VALUES ('592', 'vi', 'Image', 'Ảnh');
INSERT INTO `language_value` VALUES ('593', 'vi', 'Page list', 'Danh sách trang');
INSERT INTO `language_value` VALUES ('594', 'vi', 'Order', 'Thứ tự');
INSERT INTO `language_value` VALUES ('595', 'vi', 'Product count', 'Số lượng sản phẩm');
INSERT INTO `language_value` VALUES ('596', 'vi', 'Parent', 'Danh mục cha');
INSERT INTO `language_value` VALUES ('597', 'vi', 'Category name', 'Danh mục');
INSERT INTO `language_value` VALUES ('598', 'vi', 'Sale of (đ)', 'Giá gốc (đ)');
INSERT INTO `language_value` VALUES ('599', 'vi', 'Price (đ)', 'Giá (đ)');
INSERT INTO `language_value` VALUES ('600', 'vi', 'Image primary', 'Hình ảnh chính');
INSERT INTO `language_value` VALUES ('601', 'vi', 'Attribute', 'Thuộc tính');
INSERT INTO `language_value` VALUES ('602', 'vi', 'Link', 'Liên kết');
INSERT INTO `language_value` VALUES ('603', 'vi', 'Menu list', 'Danh sách menu');
INSERT INTO `language_value` VALUES ('604', 'vi', 'Career', 'Nghề nhiệp');
INSERT INTO `language_value` VALUES ('605', 'vi', 'Content', 'Nội dung');
INSERT INTO `language_value` VALUES ('606', 'vi', 'News count', 'Số lượng tin tức');
INSERT INTO `language_value` VALUES ('607', 'vi', 'Subscribe', 'Theo dõi');
INSERT INTO `language_value` VALUES ('608', 'vi', 'Subject', 'Tiêu đề');
INSERT INTO `language_value` VALUES ('609', 'vi', 'Permission count', 'Số lượng quyền');
INSERT INTO `language_value` VALUES ('610', 'vi', 'Role type', 'Kiễu');
INSERT INTO `language_value` VALUES ('611', 'vi', 'Role name', 'Tên');
INSERT INTO `language_value` VALUES ('612', 'vi', 'Alias by', 'Định danh theo');
INSERT INTO `language_value` VALUES ('613', 'vi', 'Alias', 'Định danh');
INSERT INTO `language_value` VALUES ('614', 'vi', 'Prefix', 'Tiền tố');
INSERT INTO `language_value` VALUES ('615', 'vi', 'Suffix', 'Hậu tố');
INSERT INTO `language_value` VALUES ('616', 'vi', 'Url Count', 'Số lượng url');
INSERT INTO `language_value` VALUES ('617', 'vi', 'New password', 'Mật khẩu mới');
INSERT INTO `language_value` VALUES ('618', 'vi', 'Current password', 'Mật khẩu hiện tại');
INSERT INTO `language_value` VALUES ('619', 'vi', 'Receive email', 'Nhận email');
INSERT INTO `language_value` VALUES ('620', 'vi', 'First name', 'Tên');
INSERT INTO `language_value` VALUES ('621', 'vi', 'Site map is update success', 'Site map đã được cập nhật thành công');
INSERT INTO `language_value` VALUES ('622', 'vi', 'Total link %s', 'Tổng số liên kết %s');
INSERT INTO `language_value` VALUES ('623', 'vi', 'Product category page', 'Trang danh mục sản phẩm');
INSERT INTO `language_value` VALUES ('624', 'vi', 'Product page', 'Trang sản phẩm');
INSERT INTO `language_value` VALUES ('625', 'vi', 'News category page', 'Trang danh mục tin tức');
INSERT INTO `language_value` VALUES ('626', 'vi', 'News page', 'Trang tin tức');
INSERT INTO `language_value` VALUES ('627', 'vi', 'Static page page', 'Trang tĩnh');
INSERT INTO `language_value` VALUES ('628', 'vi', 'Other page', 'Các trang còn lại');
INSERT INTO `language_value` VALUES ('629', 'vi', 'View sitemap', 'Xem sitemap');
INSERT INTO `language_value` VALUES ('630', 'vi', 'Sitemap info', 'Thông tin sitemap');
INSERT INTO `language_value` VALUES ('631', 'vi', 'Product unit', 'Đơn vị tính');
INSERT INTO `language_value` VALUES ('632', 'vi', 'Unit', 'Đơn vị tính');
INSERT INTO `language_value` VALUES ('633', 'vi', 'Shipping cost', 'Phí giao hàng');
INSERT INTO `language_value` VALUES ('634', 'vi', 'Discount', 'Chiết khấu');
INSERT INTO `language_value` VALUES ('635', 'vi', 'Percen', 'Phần trăm %');
INSERT INTO `language_value` VALUES ('636', 'vi', 'Add and close', 'Thêm và đóng');
INSERT INTO `language_value` VALUES ('637', 'vi', 'Edit and close', 'Sửa và đóng');
INSERT INTO `language_value` VALUES ('638', 'vi', 'Edit success', 'Cập nhật thành công');

-- ----------------------------
-- Table structure for layout
-- ----------------------------
DROP TABLE IF EXISTS `layout`;
CREATE TABLE `layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dispatch` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `system_header` tinyint(1) DEFAULT '1',
  `system_footer` tinyint(1) DEFAULT '1',
  `layout_style` text COLLATE utf8_unicode_ci,
  `layout_script` text COLLATE utf8_unicode_ci,
  `plugin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT '999',
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`layout_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of layout
-- ----------------------------
INSERT INTO `layout` VALUES ('1', 'Trang chủ', 'home', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', null, '0', 'A');
INSERT INTO `layout` VALUES ('2', 'Danh mục sản phẩm', 'home/product/list', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', 'shop', '20', 'A');
INSERT INTO `layout` VALUES ('3', 'Sản phẩm', 'home/product/detail', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', 'shop', '21', 'A');
INSERT INTO `layout` VALUES ('4', 'Giỏ hàng', 'home/cart', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', 'shop', '23', 'D');
INSERT INTO `layout` VALUES ('5', 'Thanh toán', 'home/checkout', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', 'shop', '24', 'D');
INSERT INTO `layout` VALUES ('6', 'Đăt hàng thành công', 'home/checkout/done', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', 'shop', '25', 'D');
INSERT INTO `layout` VALUES ('8', 'Tìm kiếm', 'home/search', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', 'shop', '26', 'A');
INSERT INTO `layout` VALUES ('11', 'Thông tin tài khoản', 'home/account', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '3', 'A');
INSERT INTO `layout` VALUES ('12', 'Account address', 'home/account/address', '1', '1', '{\"head\":\"<!-- style of widget on head -->\\n<link href=\'http:\\/\\/localhost\\/my_tool\\/resource\\/frontend\\/theme.basic\\/css\\/CustomViewWidget.css\' rel=\'stylesheet\' type=\'text\\/css\'>\\n\",\"footer\":\"\"}', '{\"head\":\"<!-- script of widget on head -->\\n<script src=\'http:\\/\\/localhost\\/my_tool\\/resource\\/frontend\\/theme.basic\\/js\\/CustomViewWidget.js\' type=\'text\\/javascript\'><\\/script>\\n\",\"footer\":\"\"}', '', '4', 'D');
INSERT INTO `layout` VALUES ('14', 'Sản phẩm quan tâm', 'home/product/wishlist', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '5', 'A');
INSERT INTO `layout` VALUES ('15', 'Đơn hàng của bạn', 'home/account/orders', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '6', 'D');
INSERT INTO `layout` VALUES ('16', 'Đăng ký', 'home/register', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '2', 'A');
INSERT INTO `layout` VALUES ('17', 'Quên mật khẩu', 'home/forget_password', '0', '0', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '7', 'D');
INSERT INTO `layout` VALUES ('18', 'Lấy mật khẩu', 'home/reset_password', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '8', 'D');
INSERT INTO `layout` VALUES ('19', 'Ý kiến khách hàng', 'home/customer_review', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', 'customer_review', '9', 'D');
INSERT INTO `layout` VALUES ('22', 'Trang tĩnh', 'home/static_page/view', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '30', 'A');
INSERT INTO `layout` VALUES ('23', 'Liên hệ', 'home/contact', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '50', 'A');
INSERT INTO `layout` VALUES ('24', 'Đăng nhập', 'home/login', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '1', 'A');
INSERT INTO `layout` VALUES ('25', 'Danh mục tin tức', 'home/news/list', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '31', 'A');
INSERT INTO `layout` VALUES ('26', 'Tin tức', 'home/news/detail', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '32', 'A');
INSERT INTO `layout` VALUES ('27', 'Nhóm tin tức', 'home/news/tag', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '33', 'D');
INSERT INTO `layout` VALUES ('28', 'Thẻ (tag) sản phẩm', 'home/product/tag', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '22', 'A');
INSERT INTO `layout` VALUES ('404', 'Không tìm thấy (404)', 'home/404', '1', '1', '{\"head\":\"\",\"footer\":\"\"}', '{\"head\":\"\",\"footer\":\"\"}', '', '404', 'D');

-- ----------------------------
-- Table structure for layout_row
-- ----------------------------
DROP TABLE IF EXISTS `layout_row`;
CREATE TABLE `layout_row` (
  `layout_row_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `group` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '= header, footer if row is system row else = null',
  `cols` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `layout_widget_list` text COLLATE utf8_unicode_ci,
  `setting` text COLLATE utf8_unicode_ci,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`layout_row_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of layout_row
-- ----------------------------
INSERT INTO `layout_row` VALUES ('1', '1', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('2', '0', 'mobile_system', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('7', '2', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('8', '3', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('9', '4', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"247\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('10', '5', 'mobile', '0', '0', '{\"main_content\":\"\",\"slidebar_left\":\"\",\"slidebar_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('12', '2', '', '1', '0', '[\"122\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"1\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('13', '3', '', '1', '0', '[\"104\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('16', '11', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('18', '11', '', '1', '0', '[\"172\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('21', '14', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('23', '12', 'mobile', '0', '0', '{\"main_content\":\"\",\"slidebar_left\":\"\",\"slidebar_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('25', '15', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"257-258\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('26', '12', '', '1', '999', '[\"23\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('30', '14', '', '1', '0', '[\"173\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('31', '15', '', '1', '0', '[\"174-26\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('32', '16', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('33', '16', '', '1', '1', '[\"27\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('34', '17', 'mobile', '0', '0', '{\"main_content\":\"\",\"slidebar_left\":\"\",\"slidebar_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('35', '17', '', '1', '0', '[\"28\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('36', '18', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"259\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('37', '18', '', '1', '0', '[\"29\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\"}', 'A');
INSERT INTO `layout_row` VALUES ('38', '4', '', '1', '0', '[\"30\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('41', '22', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('43', '8', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('45', '7', 'mobile', '0', '0', '{\"main_content\":\"\",\"slidebar_left\":\"\",\"slidebar_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('46', '6', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"248\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('49', '5', '', '1', '0', '[\"175-35\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('51', '23', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"271-267\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('52', '23', '', '1', '1', '[\"41\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\"}', 'A');
INSERT INTO `layout_row` VALUES ('62', '9', 'mobile', '0', '0', '[]', '[]', 'A');
INSERT INTO `layout_row` VALUES ('64', '13', 'mobile', '0', '0', '[]', '[]', 'A');
INSERT INTO `layout_row` VALUES ('66', '0', 'header', '1', '1', '[\"299\"]', '{\"add_class\":\"header_row\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('76', '3', '', '2', '1', '[\"345-284\",\"14-349\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-3 side_bar\",\"col_class_1\":\"col-md-9\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('79', '404', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"268\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('80', '404', '', '1', '0', '[\"120\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md--12\"}', 'A');
INSERT INTO `layout_row` VALUES ('81', '19', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"260-261\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('82', '19', '', '1', '0', '[\"123\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('83', '19', '', '2', '1', '[\"129\",\"124-125-126-127-202\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"col-md-9\",\"col_class_1\":\"col-md-3\"}', 'A');
INSERT INTO `layout_row` VALUES ('84', '24', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('85', '24', '', '1', '1', '[\"130\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\"}', 'A');
INSERT INTO `layout_row` VALUES ('86', '25', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('87', '25', '', '1', '0', '[\"139\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('88', '26', 'mobile', '0', '0', 'null', '[]', 'A');
INSERT INTO `layout_row` VALUES ('89', '26', '', '1', '0', '[\"133\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('90', '26', '', '2', '1', '[\"352-353-292\",\"132\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-3 side_bar\",\"col_class_1\":\"col-md-9\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('91', '25', '', '2', '1', '[\"350-354-351\",\"131\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-3 side_bar\",\"col_class_1\":\"col-md-9\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('93', '27', 'mobile', '0', '0', '{\"mobile_widget_left\":\"\",\"mobile_widget_content\":\"274-266\",\"mobile_widget_right\":\"\"}', '[]', 'A');
INSERT INTO `layout_row` VALUES ('94', '27', '', '1', '0', '[\"153\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('95', '27', '', '2', '1', '[\"152\",\"154-155-156-157-198\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"col-md-9 col-left\",\"col_class_1\":\"col-md-3 col-right\"}', 'A');
INSERT INTO `layout_row` VALUES ('97', '22', '', '2', '1', '[\"357-358-356\",\"55\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-3 side_bar\",\"col_class_1\":\"col-md-9\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('98', '22', '', '1', '0', '[\"355\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('99', '23', '', '1', '0', '[\"171\"]', '{\"add_class\":\"margin-top-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('100', '6', '', '1', '0', '[\"184\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"col_class_0\":\"\"}', 'A');
INSERT INTO `layout_row` VALUES ('108', '0', 'footer', '1', '1', '[\"207\"]', '{\"add_class\":\"\",\"full_width\":\"1\",\"status\":\"A\",\"col_class_0\":\"col-md-12\"}', 'A');
INSERT INTO `layout_row` VALUES ('112', '10', 'mobile', '0', '0', '[]', '[]', 'A');
INSERT INTO `layout_row` VALUES ('113', '20', 'mobile', '0', '0', '[]', '[]', 'A');
INSERT INTO `layout_row` VALUES ('114', '21', 'mobile', '0', '0', '[]', '[]', 'A');
INSERT INTO `layout_row` VALUES ('115', '266', 'mobile', '0', '0', '[]', '[]', 'A');
INSERT INTO `layout_row` VALUES ('119', '11', '', '1', '1', '[\"18\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\"}', 'A');
INSERT INTO `layout_row` VALUES ('120', '14', '', '1', '1', '[\"119\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\"}', 'A');
INSERT INTO `layout_row` VALUES ('124', '1', '', '1', '1', '[\"334\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('127', '1', '', '1', '6', '[\"117\"]', '{\"add_class\":\"margin-top-10 margin-bottom-20\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('129', '1', '', '1', '3', '[\"338\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('131', '1', '', '1', '4', '[\"339\"]', '{\"add_class\":\"margin-top-10 margin-bottom-20\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('139', '1', '', '2', '0', '[\"312\",\"187\"]', '{\"add_class\":\"padding-bottom-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-3\",\"col_class_1\":\"col-md-9\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('142', '0', 'header', '1', '2', '[\"328\"]', '{\"add_class\":\"main_menu_row\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('144', '1', '', '1', '5', '[\"121-331-330\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('146', '0', 'header', '1', '0', '[\"333\"]', '{\"add_class\":\"topbar\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"\",\"bg_color\":\"rgb(26, 26, 38)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('147', '1', '', '2', '2', '[\"336\",\"337\"]', '{\"add_class\":\"group-banner margin-top-20 margin-bottom-20\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-6 group-banner-item group-banner-1\",\"col_class_1\":\"col-md-6 group-banner-item group-banner-2\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('148', '0', 'footer', '3', '0', '[\"340\",\"314\",\"321\"]', '{\"add_class\":\"footer_row margin-top-10\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-6\",\"col_class_1\":\"col-md-3\",\"col_class_2\":\"col-md-3\",\"bg_color\":\"rgb(51, 51, 51)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('149', '2', '', '2', '1', '[\"342-341-343\",\"11\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-3 side_bar\",\"col_class_1\":\"col-md-9\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('151', '24', '', '1', '0', '[\"347\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"1\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('154', '16', '', '1', '0', '[\"359\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"1\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('155', '8', '', '1', '0', '[\"159\"]', '{\"add_class\":\"margin-bottom-10\",\"full_width\":\"1\",\"status\":\"A\",\"col_class_0\":\"col-md-12\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/bgcrumb.png\",\"bg_image_size\":\"cover\",\"bg_image_repeat\":\"no-repeat\"}', 'A');
INSERT INTO `layout_row` VALUES ('156', '8', '', '2', '2', '[\"360-361-362\",\"33\"]', '{\"add_class\":\"\",\"full_width\":\"0\",\"status\":\"A\",\"col_class_0\":\"col-md-3 side_bar\",\"col_class_1\":\"col-md-9\",\"bg_color\":\"rgb(255, 255, 255)\",\"bg_image\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"bg_image_size\":\"auto\",\"bg_image_repeat\":\"no-repeat\"}', 'A');

-- ----------------------------
-- Table structure for layout_widget
-- ----------------------------
DROP TABLE IF EXISTS `layout_widget`;
CREATE TABLE `layout_widget` (
  `layout_widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `layout_row_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `widget_controller` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'D',
  `setting` text COLLATE utf8_unicode_ci,
  `order` int(11) DEFAULT '0',
  `status` varchar(2) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`layout_widget_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=363 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of layout_widget
-- ----------------------------
INSERT INTO `layout_widget` VALUES ('-1', '-1', '-1', '11', 'MenuWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MenuWidget\",\"title\":\"Main menu\",\"show_title\":\"0\",\"class\":\"\",\"menuId\":\"1\",\"style\":\"main\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('11', '2', '11', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"11\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('14', '3', '13', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"14\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('18', '11', '18', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"18\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('23', '12', '26', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"23\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('26', '15', '31', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"26\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('27', '16', '33', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"27\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('28', '17', '35', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"28\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('29', '18', '37', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"29\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('30', '4', '38', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"30\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('33', '8', '44', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"33\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('35', '5', '49', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"35\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('41', '23', '52', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"41\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('55', '22', '50', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"55\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('61', '1', '6', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"\",\"showTitle\":\"N\",\"addClass\":\"\",\"text\":\"\"}', '0', 'A');
INSERT INTO `layout_widget` VALUES ('94', '1', '72', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"b\",\"show_title\":\"0\",\"addClass\":\"\",\"text\":\"\"}', '0', 'A');
INSERT INTO `layout_widget` VALUES ('104', '3', '13', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"104\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('117', '1', '6', '5', 'LightSliderImageWidget', 'desktop', '{\"layout_widget_id\":\"117\",\"widget_controller\":\"LightSliderImageWidget\",\"title\":\"\\u0110\\u1ed1i t\\u00e1c\",\"show_title\":\"1\",\"class\":\"block_home brand_image_slide\",\"sliderId\":\"1\",\"height\":\"\",\"items_limit\":\"10\",\"items_desktop\":\"5\",\"items_mobile\":\"\",\"auto_play\":\"0\",\"pagination\":\"0\"}', '11', 'A');
INSERT INTO `layout_widget` VALUES ('119', '14', '30', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('120', '404', '80', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('121', '1', '72', '8', 'ProductListWidget', 'desktop', '{\"layout_widget_id\":\"121\",\"widget_controller\":\"ProductListWidget\",\"title\":\"G\\u1ed1m s\\u1ee9 phong th\\u1ee7y\",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"category_id\":\"13\",\"style\":\"home\",\"order_by\":\"p.product_id\",\"order_direction\":\"DESC\",\"mobile_show\":\"1\"}', '8', 'A');
INSERT INTO `layout_widget` VALUES ('122', '2', '12', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"122\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('123', '19', '82', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('124', '19', '83', '12', 'YoutubeWidget', 'desktop', '{\"layout_widget_id\":\"124\",\"widget_controller\":\"YoutubeWidget\",\"title\":\"Video\",\"show_title\":\"1\",\"class\":\"\",\"url\":\"http:\\/\\/www.youtube.com\\/watch?v=S_qku-XSdQY\",\"auto_play\":\"0\",\"allowfullscreen\":\"1\",\"width\":\"\",\"height\":\"\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('125', '19', '83', '13', 'FacebookLikeBoxWidget', 'desktop', '{\"layout_widget_id\":\"125\",\"widget_controller\":\"FacebookLikeBoxWidget\",\"title\":\"Theo d\\u00f5i ch\\u00fang t\\u00f4i tr\\u00ean Facebook\",\"show_title\":\"1\",\"class\":\"\",\"url\":\"http:\\/\\/www.facebook.com\\/my_toolbattrang\\/\",\"show_timeline\":\"1\",\"show_face_friend\":\"1\",\"width\":\"\",\"height\":\"\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('126', '19', '83', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"126\",\"widget_controller\":\"ImageWidget\",\"title\":\"T\\u01b0 v\\u1ea5n h\\u1ed7 tr\\u1ee3 24\\/7\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/san-pham\\/hotline-mobitv-0978001900.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('127', '19', '83', '9', 'ProductBestSellerWidget', 'desktop', '{\"layout_widget_id\":\"127\",\"widget_controller\":\"ProductBestSellerWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m b\\u00e1n ch\\u1ea1y\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"style2\",\"items_limit\":\"6\",\"items_desktop\":\"6\",\"items_mobile\":\"\",\"auto_play\":\"0\",\"pagination\":\"0\"}', '6', 'A');
INSERT INTO `layout_widget` VALUES ('129', '19', '83', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('130', '24', '85', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('131', '25', '87', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('132', '26', '89', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('133', '26', '89', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('139', '25', '87', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"139\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('152', '27', '94', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('153', '27', '94', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('154', '27', '95', '12', 'YoutubeWidget', 'desktop', '{\"layout_widget_id\":\"154\",\"widget_controller\":\"YoutubeWidget\",\"title\":\"Video\",\"show_title\":\"1\",\"class\":\"\",\"url\":\"http:\\/\\/www.youtube.com\\/watch?v=S_qku-XSdQY\",\"auto_play\":\"0\",\"allowfullscreen\":\"1\",\"width\":\"\",\"height\":\"\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('155', '27', '95', '13', 'FacebookLikeBoxWidget', 'desktop', '{\"layout_widget_id\":\"155\",\"widget_controller\":\"FacebookLikeBoxWidget\",\"title\":\"Theo d\\u00f5i ch\\u00fang t\\u00f4i tr\\u00ean Faceboo\",\"show_title\":\"1\",\"class\":\"\",\"url\":\"http:\\/\\/www.facebook.com\\/my_toolbattrang\\/\",\"show_timeline\":\"1\",\"show_face_friend\":\"0\",\"width\":\"\",\"height\":\"\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('156', '27', '95', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"156\",\"widget_controller\":\"ImageWidget\",\"title\":\"T\\u01b0 v\\u1ea5n h\\u1ed7 tr\\u1ee3 24\\/7\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/san-pham\\/hotline-mobitv-0978001900.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('157', '27', '95', '9', 'ProductBestSellerWidget', 'desktop', '{\"layout_widget_id\":\"157\",\"widget_controller\":\"ProductBestSellerWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m b\\u00e1n ch\\u1ea1y\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"style2\",\"items_limit\":\"6\",\"items_desktop\":\"6\",\"items_mobile\":\"\",\"auto_play\":\"0\",\"pagination\":\"0\"}', '6', 'A');
INSERT INTO `layout_widget` VALUES ('159', '8', '44', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('171', '23', '52', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"171\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('172', '11', '18', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('173', '14', '30', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('174', '15', '31', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('175', '5', '49', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('184', '6', '100', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('187', '1', '102', '5', 'LightSliderImageWidget', 'desktop', '{\"layout_widget_id\":\"187\",\"widget_controller\":\"LightSliderImageWidget\",\"title\":\"Banner\",\"show_title\":\"0\",\"class\":\"\",\"sliderId\":\"2\",\"height\":\"\",\"items_limit\":\"\",\"items_show\":\"1\",\"auto_play\":\"1\",\"pagination\":\"0\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('198', '27', '95', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"198\",\"widget_controller\":\"ImageWidget\",\"title\":\"Qu\\u00e0 t\\u1eb7ng g\\u1ed1m s\\u1ee9 in logo\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/qua-tang.jpg\",\"url\":\"http:\\/\\/localhost\\/my_tool\\/qua-tang-doanh-nghiep-in-logo\",\"target\":\"_self\"}', '7', 'A');
INSERT INTO `layout_widget` VALUES ('202', '19', '83', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"202\",\"widget_controller\":\"ImageWidget\",\"title\":\"Qu\\u00e0 t\\u1eb7ng g\\u1ed1m s\\u1ee9 in logo\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/qua-tang.jpg\",\"url\":\"http:\\/\\/localhost\\/my_tool\\/qua-tang-doanh-nghiep-in-logo\",\"target\":\"_self\"}', '7', 'A');
INSERT INTO `layout_widget` VALUES ('205', '0', '108', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"Scroll to top\",\"show_title\":\"0\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('207', '0', '108', '3', 'CustomViewWidget', 'desktop', '{\"layout_widget_id\":\"207\",\"widget_controller\":\"CustomViewWidget\",\"title\":\"Scroll to top\",\"fileName\":\"scroll_to_top.php\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('209', '0', '0', '5', 'LightSliderImageWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"LightSliderImageWidget\",\"title\":\"Banner\",\"show_title\":\"0\",\"class\":\"\",\"sliderId\":\"2\",\"height\":\"\",\"items_limit\":\"\",\"items_desktop\":\"\",\"items_mobile\":\"\",\"auto_play\":\"1\",\"pagination\":\"0\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('210', '0', '0', '19', 'ProductNewWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductNewWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m m\\u1edbi\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"style2\",\"items_limit\":\"\",\"items_desktop\":\"\",\"items_mobile\":\"\",\"auto_play\":\"1\",\"pagination\":\"0\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('211', '0', '0', '1', 'TextWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"1\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('212', '0', '0', '1', 'TextWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"2\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('213', '0', '0', '1', 'TextWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"3\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('214', '0', '0', '1', 'TextWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"4\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('215', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"1\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('216', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"w\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('217', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"<p>1<\\/p>\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('218', '0', '0', '2', 'ImageWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ImageWidget\",\"title\":\"\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/no-image.png\",\"url\":\"\",\"target\":\"_blank\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('219', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('220', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('221', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('222', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"1\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('223', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"2\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('230', '0', '0', '3', 'CustomViewWidget', 'mobile_system', '{\"layout_widget_id\":\"230\",\"widget_controller\":\"CustomViewWidget\",\"title\":\"C\\u00f4ng ty TNHH G\\u1ed1m Lam\",\"show_title\":\"0\",\"class\":\"footer-info\",\"path\":\"footer\\/contact.php\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('231', '0', '0', '3', 'CustomViewWidget', 'mobile_system', '{\"layout_widget_id\":\"231\",\"widget_controller\":\"CustomViewWidget\",\"title\":\"\\u0110\\u0103ng k\\u00fd\",\"show_title\":\"1\",\"class\":\"footer-info\",\"path\":\"footer\\/newsletter.php\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('232', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"232\",\"widget_controller\":\"TextWidget\",\"title\":\"Copyright\",\"show_title\":\"0\",\"addClass\":\"footer-copyright\",\"text\":\"<p class=\\\"text-center\\\">\\u00a9 2016 GBT Corporation. All rights reserved<\\/p>\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('233', '0', '0', '18', 'ProductCategoryWidget', 'mobile_system', '{\"layout_widget_id\":\"233\",\"widget_controller\":\"ProductCategoryWidget\",\"title\":\"T\\u1ea5t c\\u1ea3 c\\u00e1c danh m\\u1ee5c\",\"show_title\":\"1\",\"class\":\"footer-quick-menu\",\"style\":\"style2.mobile\",\"level\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('234', '0', '0', '3', 'CustomViewWidget', 'mobile_system', '{\"layout_widget_id\":\"\",\"widget_controller\":\"CustomViewWidget\",\"title\":\"header_action\",\"show_title\":\"0\",\"class\":\"\",\"path\":\"header\\/header_action.php\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('235', '0', '0', '19', 'ProductNewWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductNewWidget\",\"title\":\"SPM\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"style2\",\"items_limit\":\"\",\"items_desktop\":\"\",\"items_mobile\":\"\",\"auto_play\":\"0\",\"pagination\":\"0\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('236', '0', '0', '1', 'TextWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"111\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('237', '0', '0', '1', 'TextWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"11\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('238', '0', '0', '1', 'TextWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"2\",\"show_title\":\"1\",\"addClass\":\"\",\"text\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('242', '0', '0', '5', 'LightSliderImageWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"LightSliderImageWidget\",\"title\":\"Banner\",\"show_title\":\"0\",\"class\":\"\",\"sliderId\":\"2\",\"height\":\"\",\"items_limit\":\"\",\"items_desktop\":\"\",\"items_mobile\":\"\",\"auto_play\":\"1\",\"pagination\":\"0\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('243', '0', '0', '19', 'ProductNewWidget', 'mobile', '{\"layout_widget_id\":\"243\",\"widget_controller\":\"ProductNewWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m m\\u1edbi\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"style1\",\"items_limit\":\"\",\"auto_play\":\"0\",\"pagination\":\"0\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('244', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('245', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('246', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"246\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"breadcrumb_mobile\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('247', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('248', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('249', '0', '0', '6', 'ProductRelateWidget', 'mobile', '{\"layout_widget_id\":\"249\",\"widget_controller\":\"ProductRelateWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m li\\u00ean quan\",\"show_title\":\"1\",\"class\":\"\",\"items_limit\":\"\",\"auto_play\":\"0\",\"pagination\":\"0\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('250', '0', '0', '9', 'ProductBestSellerWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductBestSellerWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m b\\u00e1n ch\\u1ea1y\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"style2\",\"items_limit\":\"\",\"items_desktop\":\"\",\"items_mobile\":\"\",\"auto_play\":\"0\",\"pagination\":\"0\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('251', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('252', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('253', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"253\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"breadcrumb_mobile\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('254', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('255', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"breadcrumb_mobile\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('256', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('257', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"breadcrumb_mobile\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('258', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('259', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('260', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"breadcrumb_mobile\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('261', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('262', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('263', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('264', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('265', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('266', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('267', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('268', '0', '0', '4', 'MainContentWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('269', '0', '0', '1', 'TextWidget', 'mobile_system', '{\"layout_widget_id\":\"269\",\"widget_controller\":\"TextWidget\",\"title\":\"Hot line\",\"show_title\":\"0\",\"addClass\":\"\",\"text\":\"<div class=\\\"mobile_phone\\\"><a class=\\\"number\\\" title=\\\"Hotline\\\" href=\\\"tel:0961554050\\\"> <i class=\\\"fa fa-phone fa-2x\\\"><\\/i>\\u00a0 <\\/a><\\/div>\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('270', '0', '108', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"H\\u1ed7 tr\\u1ee3 tr\\u1ef1c tuy\\u1ebfn\",\"show_title\":\"0\",\"addClass\":\"\",\"text\":\"\\r\\n\\r\\n\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('271', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"Breadcrumb\",\"show_title\":\"0\",\"class\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('272', '0', '0', '11', 'MenuWidget', 'mobile_system', '{\"layout_widget_id\":\"272\",\"widget_controller\":\"MenuWidget\",\"title\":\"Menu footer\",\"show_title\":\"0\",\"class\":\"menu_footer_phone\",\"menuId\":\"12\",\"style\":\"horizontal\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('273', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"273\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('274', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('275', '0', '0', '16', 'BreadcrumbWidget', 'mobile', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('276', '1', '105', '30', 'NewsLatestWidget', 'desktop', '{\"layout_widget_id\":\"276\",\"widget_controller\":\"NewsLatestWidget\",\"title\":\"Tin t\\u1ee9c m\\u1edbi nh\\u1ea5t\",\"class\":\"\",\"bg_color\":\"rgba(255, 255, 255, 0.8)\",\"style\":\"home\",\"mobile_show\":\"1\"}', '2', 'D');
INSERT INTO `layout_widget` VALUES ('284', '3', '76', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"284\",\"widget_controller\":\"ImageWidget\",\"title\":\"Khuy\\u1ebfn m\\u00e3i hot\",\"show_title\":\"1\",\"class\":\"sidebar_box\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/aside_banner.png\",\"url\":\"http:\\/\\/my_tool\",\"target\":\"_blank\",\"mobile_show\":\"1\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('292', '26', '90', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"292\",\"widget_controller\":\"ImageWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m hot\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/aside_banner.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('299', '0', '123', '3', 'CustomViewWidget', 'desktop', '{\"layout_widget_id\":\"299\",\"widget_controller\":\"CustomViewWidget\",\"title\":\"header\",\"fileName\":\"header.php\",\"mobile_show\":\"1\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('312', '1', '126', '18', 'ProductCategoryWidget', 'desktop', '{\"layout_widget_id\":\"312\",\"widget_controller\":\"ProductCategoryWidget\",\"title\":\"Danh m\\u1ee5c s\\u1ea3n ph\\u1ea9m\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"menu\",\"mobile_show\":\"1\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('314', '0', '128', '11', 'MenuWidget', 'desktop', '{\"layout_widget_id\":\"314\",\"widget_controller\":\"MenuWidget\",\"title\":\"H\\u1ed7 tr\\u1ee3 kh\\u00e1ch h\\u00e0ng\",\"show_title\":\"1\",\"class\":\"footer_block footer_menu\",\"menuId\":\"6\",\"style\":\"vertical\",\"mobile_show\":\"1\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('321', '0', '128', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"321\",\"widget_controller\":\"ImageWidget\",\"title\":\"B\\u1ea3n \\u0111\\u1ed3\",\"show_title\":\"0\",\"class\":\"margin-top-20\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/ban-do.png\",\"url\":\"http:\\/\\/www.google.com\\/maps?ll=21.005049,105.821411&z=15&t=m&hl=vi-VN&gl=US&mapclient=embed&q=Ng%C3%A3+T%C6%B0+S%E1%BB%9F+%C4%90%E1%BB%91ng+%C4%90a+H%C3%A0+N%E1%BB%99i+Vi%E1%BB%87t+Nam\",\"target\":\"_blank\",\"mobile_show\":\"1\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('328', '0', '142', '11', 'MenuWidget', 'desktop', '{\"layout_widget_id\":\"328\",\"widget_controller\":\"MenuWidget\",\"title\":\"Main menu\",\"show_title\":\"0\",\"class\":\"\",\"menuId\":\"1\",\"style\":\"main\",\"mobile_show\":\"1\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('330', '1', '143', '8', 'ProductListWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductListWidget\",\"title\":\"\\u1ea4m ch\\u00e9n B\\u00e1t Tr\\u00e0ng v\\u00e0 c\\u00e1c \\u0111\\u1ed3 gia d\\u1ee5ng kh\\u00e1c  \",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"category_id\":\"30\",\"style\":\"home\",\"order_by\":\"p.product_id\",\"order_direction\":\"DESC\",\"mobile_show\":\"1\"}', '10', 'A');
INSERT INTO `layout_widget` VALUES ('331', '1', '144', '8', 'ProductListWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductListWidget\",\"title\":\"S\\u1ee9 v\\u1ebd v\\u00e0ng 24K Haidoco\",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"category_id\":\"27\",\"style\":\"home\",\"order_by\":\"p.product_id\",\"order_direction\":\"DESC\",\"mobile_show\":\"1\"}', '9', 'A');
INSERT INTO `layout_widget` VALUES ('333', '0', '66', '3', 'CustomViewWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"CustomViewWidget\",\"title\":\"header_top\",\"fileName\":\"header_top.php\",\"mobile_show\":\"1\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('334', '1', '124', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"header_extra\",\"show_title\":\"0\",\"class\":\"\",\"text\":\"<div class=\\\"privateStore\\\">\\r\\n<div class=\\\"col-provate-4\\\">\\r\\n<div class=\\\"privateStoreItem1\\\">\\r\\n<div class=\\\"privateIcon\\\"><i class=\\\"fa fa-usd\\\" aria-hidden=\\\"true\\\"><\\/i><\\/div>\\r\\n<div class=\\\"privateContent\\\">\\r\\n<div class=\\\"privateTitle\\\">Tr\\u1ea3 h\\u00e0ng & ho\\u00e0n ti\\u1ec1n<\\/div>\\r\\n<p>Kh\\u00e1ch h\\u00e0ng ho\\u00e0n tr\\u1ea3 h\\u00e0ng \\u0111\\u01b0\\u1ee3c ho\\u00e0n tr\\u1ea3 100% s\\u1ed1 ti\\u1ec1n \\u0111\\u00e3 chi tr\\u1ea3 tr\\u01b0\\u1edbc \\u0111\\u00f3<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<div class=\\\"col-provate-4 col-provate-42\\\">\\r\\n<div class=\\\"privateStoreItem2\\\">\\r\\n<div class=\\\"privateIcon\\\"><i class=\\\"fa fa-car\\\" aria-hidden=\\\"true\\\"><\\/i><\\/div>\\r\\n<div class=\\\"privateContent\\\">\\r\\n<div class=\\\"privateTitle\\\">Mi\\u1ec5n ph\\u00ed v\\u1eadn chuy\\u1ec3n<\\/div>\\r\\n<p>Ch\\u00fang t\\u00f4i mi\\u1ec5n ph\\u00ed v\\u1eabn chuy\\u1ec3n cho to\\u00e0n b\\u1ed9 kh\\u00e1ch h\\u00e0ng trong n\\u1ed9i th\\u00e0nh<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<div class=\\\"col-provate-4\\\">\\r\\n<div class=\\\"privateStoreItem3\\\">\\r\\n<div class=\\\"privateIcon\\\"><i class=\\\"fa fa-paper-plane\\\" aria-hidden=\\\"true\\\"><\\/i><\\/div>\\r\\n<div class=\\\"privateContent\\\">\\r\\n<div class=\\\"privateTitle\\\">B\\u1ea3o m\\u1eadt th\\u00f4ng tin<\\/div>\\r\\n<p>C\\u00f4ng ty cam k\\u1ebft b\\u1ea3o m\\u1eadt tuy\\u1ec7t \\u0111\\u1ed1i th\\u00f4ng tin c\\u00e1 nh\\u00e2n c\\u1ee7a kh\\u00e1ch h\\u00e0ng<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\",\"mobile_show\":\"1\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('335', '1', '139', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"335\",\"widget_controller\":\"TextWidget\",\"title\":\"Header_extra\",\"show_title\":\"0\",\"class\":\"margin-top-10\",\"text\":\"<div class=\\\"privateStore\\\">\\r\\n<div class=\\\"col-provate-4\\\">\\r\\n<div class=\\\"privateStoreItem1\\\">\\r\\n<div class=\\\"privateIcon\\\"><i class=\\\"fa fa-usd\\\" aria-hidden=\\\"true\\\"><\\/i><\\/div>\\r\\n<div class=\\\"privateContent\\\">\\r\\n<div class=\\\"privateTitle\\\">Tr\\u1ea3 h\\u00e0ng & ho\\u00e0n ti\\u1ec1n<\\/div>\\r\\n<p>Kh\\u00e1ch h\\u00e0ng ho\\u00e0n tr\\u1ea3 h\\u00e0ng \\u0111\\u01b0\\u1ee3c ho\\u00e0n tr\\u1ea3 100% s\\u1ed1 ti\\u1ec1n \\u0111\\u00e3 chi tr\\u1ea3 tr\\u01b0\\u1edbc \\u0111\\u00f3<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<div class=\\\"col-provate-4 col-provate-42\\\">\\r\\n<div class=\\\"privateStoreItem2\\\">\\r\\n<div class=\\\"privateIcon\\\"><i class=\\\"fa fa-car\\\" aria-hidden=\\\"true\\\"><\\/i><\\/div>\\r\\n<div class=\\\"privateContent\\\">\\r\\n<div class=\\\"privateTitle\\\">Mi\\u1ec5n ph\\u00ed v\\u1eadn chuy\\u1ec3n<\\/div>\\r\\n<p>Ch\\u00fang t\\u00f4i mi\\u1ec5n ph\\u00ed v\\u1eabn chuy\\u1ec3n cho to\\u00e0n b\\u1ed9 kh\\u00e1ch h\\u00e0ng trong n\\u1ed9i th\\u00e0nh<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<div class=\\\"col-provate-4\\\">\\r\\n<div class=\\\"privateStoreItem3\\\">\\r\\n<div class=\\\"privateIcon\\\"><i class=\\\"fa fa-paper-plane\\\" aria-hidden=\\\"true\\\"><\\/i><\\/div>\\r\\n<div class=\\\"privateContent\\\">\\r\\n<div class=\\\"privateTitle\\\">B\\u1ea3o m\\u1eadt th\\u00f4ng tin<\\/div>\\r\\n<p>C\\u00f4ng ty cam k\\u1ebft b\\u1ea3o m\\u1eadt tuy\\u1ec7t \\u0111\\u1ed1i th\\u00f4ng tin c\\u00e1 nh\\u00e2n c\\u1ee7a kh\\u00e1ch h\\u00e0ng<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\",\"mobile_show\":\"1\"}', '1', 'D');
INSERT INTO `layout_widget` VALUES ('336', '1', '147', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ImageWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/home\\/bannerslider1.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('337', '1', '147', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ImageWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/home\\/bannerslider2.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('338', '1', '129', '52', 'ProductGroupWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductGroupWidget\",\"title\":\"Nh\\u00f3m s\\u1ea3n ph\\u1ea9m theo m\\u1edbi, n\\u1ed5i b\\u1eadt, b\\u00e1n ch\\u1ea1y...\",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"style1\",\"mobile_show\":\"1\"}', '6', 'A');
INSERT INTO `layout_widget` VALUES ('339', '1', '131', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"339\",\"widget_controller\":\"ImageWidget\",\"title\":\"Khuy\\u1ebfn m\\u00e3i\",\"show_title\":\"0\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/home\\/bannersection.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '7', 'A');
INSERT INTO `layout_widget` VALUES ('340', '0', '148', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"340\",\"widget_controller\":\"TextWidget\",\"title\":\"Th\\u00f4ng tin li\\u00ean l\\u1ea1c\",\"show_title\":\"1\",\"class\":\"footer_block\",\"text\":\"<ul class=\\\"list-menu\\\">\\r\\n<li>\\r\\n<p>C\\u00f4ng ty C\\u1ed5 Ph\\u1ea7n Vua G\\u1ed1m S\\u1ee9,\\u00a0<span>ho\\u1ea1t \\u0111\\u1ed9ng trong l\\u0129nh v\\u1ef1c \\u0111\\u1ed3 g\\u1ed1m cao c\\u1ea5p...<\\/span><\\/p>\\r\\n<\\/li>\\r\\n<li><strong>\\u0110\\u1ecba ch\\u1ec9:<\\/strong> 52 Th\\u1ed1ng Nh\\u1ea5t, L\\u00ea Thanh Ngh\\u1ecb, Tp H\\u1ea3i D\\u01b0\\u01a1ng, H\\u1ea3i D\\u01b0\\u01a1ng<\\/li>\\r\\n<li><strong>Email:<\\/strong> <a href=\\\"mailto:info@my_tool.vn\\\" target=\\\"_top\\\">info@my_tool.vn<\\/a><\\/li>\\r\\n<li><strong>\\u0110i\\u1ec7n tho\\u1ea1i:<\\/strong> <a href=\\\"tel: 0904317266\\\"> 0904317266<\\/a><\\/li>\\r\\n<\\/ul>\\r\\n<ul class=\\\"simple-list footer_social\\\">\\r\\n<li><a href=\\\"http:\\/\\/www.facebook.com\\/my_tool\\/\\\" title=\\\"Vua g\\u1ed1m s\\u1ee9\\\"> <i class=\\\"fa fa-facebook-square fa-2x\\\"><\\/i> <\\/a><\\/li>\\r\\n<li><a href=\\\"http:\\/\\/www.youtube.com\\/channel\\/my_tool\\\" title=\\\"Vua g\\u1ed1m s\\u1ee9\\\"> <i class=\\\"fa fa-youtube-square fa-2x\\\"><\\/i> <\\/a><\\/li>\\r\\n<\\/ul>\",\"mobile_show\":\"1\"}', '0', 'S');
INSERT INTO `layout_widget` VALUES ('341', '2', '149', '53', 'ProductTagWidget', 'desktop', '{\"layout_widget_id\":\"341\",\"widget_controller\":\"ProductTagWidget\",\"title\":\"Tag\",\"show_title\":\"1\",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"style1\",\"mobile_show\":\"1\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('342', '2', '149', '18', 'ProductCategoryWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductCategoryWidget\",\"title\":\"Danh m\\u1ee5c s\\u1ea3n ph\\u1ea9m\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"menu\",\"mobile_show\":\"1\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('343', '2', '149', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"343\",\"widget_controller\":\"ImageWidget\",\"title\":\"Khuy\\u1ebfn m\\u00e3i hot\",\"show_title\":\"1\",\"class\":\"sidebar_box\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/aside_banner.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('344', '2', '12', '1', 'TextWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"TextWidget\",\"title\":\"Breadcrumb2\",\"show_title\":\"0\",\"class\":\"\",\"text\":\"<section class=\\\"bread-crumb\\\">\\r\\n<div class=\\\"container\\\">\\r\\n<div class=\\\"row\\\">\\r\\n<div class=\\\"col-xs-12\\\">\\r\\n<div class=\\\"title-crumb\\\" title=\\\"\\\">N\\u1ed9i th\\u1ea5t ph\\u00f2ng kh\\u00e1ch<\\/div>\\r\\n<ul class=\\\"breadcrumb\\\" itemscope=\\\"\\\" itemtype=\\\"http:\\/\\/data-vocabulary.org\\/Breadcrumb\\\">\\r\\n<li class=\\\"home\\\"><a itemprop=\\\"url\\\" href=\\\"http:\\/\\/localhost\\/\\\"><span itemprop=\\\"title\\\">Trang ch\\u1ee7<\\/span><\\/a> <span><i class=\\\"fa fa-angle-double-right\\\"><\\/i><\\/span><\\/li>\\r\\n<li><strong><span itemprop=\\\"title\\\"> N\\u1ed9i th\\u1ea5t ph\\u00f2ng kh\\u00e1ch<\\/span><\\/strong><\\/li>\\r\\n<\\/ul>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/section>\",\"mobile_show\":\"1\"}', '1', 'D');
INSERT INTO `layout_widget` VALUES ('345', '3', '76', '18', 'ProductCategoryWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductCategoryWidget\",\"title\":\"Danh m\\u1ee5c s\\u1ea3n ph\\u1ea9m\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"menu\",\"mobile_show\":\"1\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('347', '24', '151', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\",\"mobile_show\":\"1\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('348', '3', '152', '4', 'MainContentWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"MainContentWidget\",\"results\":\"success\",\"mobile_show\":\"1\"}', '1', 'D');
INSERT INTO `layout_widget` VALUES ('349', '3', '152', '6', 'ProductRelateWidget', 'desktop', '{\"layout_widget_id\":\"349\",\"widget_controller\":\"ProductRelateWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m c\\u00f9ng lo\\u1ea1i\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"style1\",\"mobile_show\":\"1\"}', '5', 'A');
INSERT INTO `layout_widget` VALUES ('350', '25', '91', '31', 'NewsCategoryWidget', 'desktop', '{\"layout_widget_id\":\"350\",\"widget_controller\":\"NewsCategoryWidget\",\"title\":\"Danh m\\u1ee5c b\\u00e0i vi\\u1ebft\",\"show_title\":\"1\",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"menu\",\"mobile_show\":\"1\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('351', '25', '91', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ImageWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m hot\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/aside_banner.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('352', '26', '90', '31', 'NewsCategoryWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"NewsCategoryWidget\",\"title\":\"Danh m\\u1ee5c b\\u00e0i vi\\u1ebft\",\"show_title\":\"1\",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"menu\",\"mobile_show\":\"1\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('353', '26', '90', '32', 'NewsRelateWidget', 'desktop', '{\"layout_widget_id\":\"353\",\"widget_controller\":\"NewsRelateWidget\",\"title\":\"B\\u00e0i vi\\u1ebft li\\u00ean quan\",\"show_title\":\"1\",\"class\":\"\",\"limit\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"style1\",\"mobile_show\":\"1\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('354', '25', '91', '30', 'NewsLatestWidget', 'desktop', '{\"layout_widget_id\":\"354\",\"widget_controller\":\"NewsLatestWidget\",\"title\":\"B\\u00e0i vi\\u1ebft m\\u1edbi nh\\u1ea5t\",\"show_title\":\"1\",\"class\":\"\",\"limit\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"style1\",\"mobile_show\":\"1\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('355', '22', '98', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\",\"mobile_show\":\"1\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('356', '22', '97', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ImageWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m hot\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/aside_banner.png\",\"url\":\"http:\\/\\/103.200.22.81\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '4', 'A');
INSERT INTO `layout_widget` VALUES ('357', '22', '97', '18', 'ProductCategoryWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductCategoryWidget\",\"title\":\"Danh m\\u1ee5c s\\u1ea3n ph\\u1ea9m\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"menu\",\"mobile_show\":\"1\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('358', '22', '97', '19', 'ProductNewWidget', 'desktop', '{\"layout_widget_id\":\"358\",\"widget_controller\":\"ProductNewWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m m\\u1edbi\",\"show_title\":\"1\",\"class\":\"\",\"limit\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"side_bar\",\"mobile_show\":\"1\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('359', '16', '154', '16', 'BreadcrumbWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"BreadcrumbWidget\",\"title\":\"\",\"show_title\":\"0\",\"class\":\"\",\"mobile_show\":\"1\"}', '1', 'A');
INSERT INTO `layout_widget` VALUES ('360', '8', '156', '18', 'ProductCategoryWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductCategoryWidget\",\"title\":\"Danh m\\u1ee5c s\\u1ea3n ph\\u1ea9m\",\"show_title\":\"1\",\"class\":\"\",\"style\":\"menu\",\"mobile_show\":\"1\"}', '2', 'A');
INSERT INTO `layout_widget` VALUES ('361', '8', '156', '53', 'ProductTagWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ProductTagWidget\",\"title\":\"Tag\",\"show_title\":\"1\",\"class\":\"\",\"bg_color\":\"rgb(255, 255, 255)\",\"style\":\"style1\",\"mobile_show\":\"1\"}', '3', 'A');
INSERT INTO `layout_widget` VALUES ('362', '8', '156', '2', 'ImageWidget', 'desktop', '{\"layout_widget_id\":\"\",\"widget_controller\":\"ImageWidget\",\"title\":\"S\\u1ea3n ph\\u1ea9m hot\",\"show_title\":\"1\",\"class\":\"\",\"src\":\"http:\\/\\/localhost\\/my_tool\\/upload\\/images\\/aside_banner.png\",\"url\":\"http:\\/\\/localhost\\/my_tool\",\"target\":\"_self\",\"mobile_show\":\"1\"}', '4', 'A');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Main menu');
INSERT INTO `menu` VALUES ('2', 'Top menu');
INSERT INTO `menu` VALUES ('3', 'Bộ ấm chén');
INSERT INTO `menu` VALUES ('4', 'Đồ thờ cúng');
INSERT INTO `menu` VALUES ('5', 'Tranh gốm sứ');
INSERT INTO `menu` VALUES ('6', 'Hỗ trợ khách hàng');
INSERT INTO `menu` VALUES ('7', 'Chính sách');
INSERT INTO `menu` VALUES ('8', 'Cam kết');
INSERT INTO `menu` VALUES ('10', 'Bộ đồ ăn');
INSERT INTO `menu` VALUES ('11', 'Lọ hoa & Cốc');
INSERT INTO `menu` VALUES ('12', 'Menu footer phone');

-- ----------------------------
-- Table structure for menu_item
-- ----------------------------
DROP TABLE IF EXISTS `menu_item`;
CREATE TABLE `menu_item` (
  `menu_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `params` text,
  `class` varchar(255) DEFAULT NULL,
  `icon` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menu_item
-- ----------------------------
INSERT INTO `menu_item` VALUES ('5', '6', '0', 'Hướng dẫn thanh toán', '#1', 'custom_link', '0', '[]', '', '', '0', '1');
INSERT INTO `menu_item` VALUES ('6', '6', '0', 'Thông tin cửa hàng', '#2', 'custom_link', '0', '[]', '', '', '0', '2');
INSERT INTO `menu_item` VALUES ('7', '6', '0', 'Mua số lượng lớn', '#3', 'custom_link', '0', '[]', '', '', '0', '3');
INSERT INTO `menu_item` VALUES ('8', '6', '0', 'Chính sách bảo hành', '#4', 'custom_link', '0', '[]', '', '', '0', '4');
INSERT INTO `menu_item` VALUES ('9', '6', '0', 'Báo lỗi thanh toán', '#5', 'custom_link', '0', '[]', '', '', '0', '5');
INSERT INTO `menu_item` VALUES ('10', '6', '0', 'Các câu hỏi thường gặp', '#6', 'custom_link', '0', '[]', '', '', '0', '6');
INSERT INTO `menu_item` VALUES ('20', '1', '0', 'Tin tức', 'http://localhost/my_tool/tin-tuc', 'custom_link', '0', '[]', '', '', '0', '5');
INSERT INTO `menu_item` VALUES ('23', '1', '0', 'Liên hệ', 'http://localhost/my_tool/lien-he', 'custom_link', '0', '[]', '', '', '0', '6');
INSERT INTO `menu_item` VALUES ('24', '1', '0', 'Trang chủ', 'http://localhost/my_tool', 'custom_link', '0', '[]', '', '', '0', '1');
INSERT INTO `menu_item` VALUES ('25', '8', '0', 'Cam kết 1', '#1', 'custom_link', '0', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('26', '8', '0', 'Cam kết 2', '#2', 'custom_link', '0', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('27', '8', '0', 'Cam kết 3', '#3', 'custom_link', '0', '[]', null, '', '0', '3');
INSERT INTO `menu_item` VALUES ('28', '8', '0', 'Cam kết 4', '#4', 'custom_link', '0', '[]', null, '', '0', '4');
INSERT INTO `menu_item` VALUES ('29', '8', '0', 'Cam kết 5', '#5', 'custom_link', '0', '[]', null, '', '0', '5');
INSERT INTO `menu_item` VALUES ('30', '8', '0', 'Cam kết 6', '#6', 'custom_link', '0', '[]', null, '', '0', '6');
INSERT INTO `menu_item` VALUES ('32', '1', '0', 'Về chúng tôi', 'http://localhost/my_tool/ve-chung-toi.html', 'page_link', '1', '[]', '', '', '0', '3');
INSERT INTO `menu_item` VALUES ('35', '2', '0', 'Tuyển dụng', 'http://localhost/my_tool/tuyen-dung.html', 'page_link', '3', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('36', '2', '0', 'Đại lý', 'http://localhost/my_tool/dai-ly.html', 'page_link', '4', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('37', '7', '0', 'Quy định đổi - trả', 'http://localhost/my_tool/quy-dinh-doi-tra.html', 'page_link', '5', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('38', '7', '0', 'Chính sách thanh toán', 'http://localhost/my_tool/chinh-sach-thanh-toan.html', 'page_link', '6', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('39', '7', '0', 'Chính sách bán hàng', 'http://localhost/my_tool/chinh-sach-ban-hang.html', 'page_link', '7', '[]', null, '', '0', '3');
INSERT INTO `menu_item` VALUES ('40', '7', '0', 'Chính sách bảo hành', 'http://localhost/my_tool/chinh-sach-bao-hanh.html', 'page_link', '8', '[]', null, '', '0', '4');
INSERT INTO `menu_item` VALUES ('41', '7', '0', 'Hướng dẫn gửi trả hàng', 'http://localhost/my_tool/huong-dan-gui-tra-hang.html', 'page_link', '9', '[]', null, '', '0', '6');
INSERT INTO `menu_item` VALUES ('42', '7', '0', 'Chính sách vận chuyển', 'http://localhost/my_tool/chinh-sach-van-chuyen.html', 'page_link', '10', '[]', null, '', '0', '5');
INSERT INTO `menu_item` VALUES ('49', '3', '0', 'Ấm chén tử sa', 'http://localhost/my_tool/am-chen-bat-trang/am-chen-tu-sa', 'category_link', '20', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('50', '3', '0', 'Ấm chén gia dụng', 'http://localhost/my_tool/am-chen-bat-trang/am-chen-gia-dung', 'category_link', '21', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('51', '4', '0', 'Đồ thờ men rạn đắp nổi', 'http://localhost/my_tool/do-tho-cung/do-tho-men-ran-dap-noi', 'category_link', '8', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('52', '4', '0', 'Đồ thờ Men lam vẽ tay', 'http://localhost/my_tool/do-tho-cung/do-tho-men-lam-ve-tay', 'category_link', '9', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('53', '4', '0', 'Đồ thờ Men xanh ngọc cổ', 'http://localhost/my_tool/do-tho-cung/do-tho-men-xanh-ngoc-co', 'category_link', '10', '[]', null, '', '0', '3');
INSERT INTO `menu_item` VALUES ('54', '4', '0', 'Đồ thờ Vàng kim', 'http://localhost/my_tool/do-tho-cung/do-tho-vang-kim', 'category_link', '11', '[]', null, '', '0', '4');
INSERT INTO `menu_item` VALUES ('55', '4', '0', 'Đồ thờ Men lam phổ thông', 'http://localhost/my_tool/do-tho-cung/do-tho-men-lam-pho-thong', 'category_link', '12', '[]', null, '', '0', '5');
INSERT INTO `menu_item` VALUES ('57', '5', '0', 'Tranh gốm sứ có sẵn', 'http://localhost/my_tool/tranh-gom-su/tranh-gom-su-co-san', 'category_link', '44', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('58', '5', '0', 'Tranh gốm sứ ghép theo yêu cầu', 'http://localhost/my_tool/tranh-gom-su/tranh-gom-su-ghep-theo-yeu-cau', 'category_link', '45', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('59', '10', '0', 'Tổng hợp bộ đồ ăn Vua Gốm Sứ', 'http://localhost/my_tool/bo-do-an-gom-bat-trang/tong-hop-bo-do-an-gom-lam', 'category_link', '22', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('60', '10', '0', 'Bộ đồ ăn Hoa sen dát vàng', 'http://localhost/my_tool/bo-do-an/bo-do-an-hoa-sen-dat-vang', 'category_link', '46', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('61', '10', '0', 'Bộ đồ ăn Vuốt tay Men lam vẽ mai', 'http://localhost/my_tool/bo-do-an/bo-do-an-vuot-tay-men-lam-ve-mai', 'category_link', '51', '[]', null, '', '0', '4');
INSERT INTO `menu_item` VALUES ('62', '10', '0', 'Bộ đồ ăn Sứ trắng cao cấp', 'http://localhost/my_tool/bo-do-an/bo-do-an-su-trang-cao-cap', 'category_link', '63', '[]', null, '', '0', '3');
INSERT INTO `menu_item` VALUES ('63', '10', '0', 'Bộ đồ ăn Đào nâu Nhật', 'http://localhost/my_tool/bo-do-an/bo-do-an-dao-nau-nhat', 'category_link', '56', '[]', null, '', '0', '6');
INSERT INTO `menu_item` VALUES ('65', '11', '0', 'Lọ hoa theo bộ', 'http://localhost/my_tool/lo-hoa-coc/lo-hoa-theo-bo', 'category_link', '24', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('66', '11', '0', 'Cốc gốm sứ', 'http://localhost/my_tool/lo-hoa-coc/coc-gom-su', 'category_link', '26', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('67', '12', '0', 'Về chúng tôi', 'http://localhost/my_tool/ve-chung-toi.html', 'page_link', '1', '[]', null, '', '0', '1');
INSERT INTO `menu_item` VALUES ('68', '12', '0', 'Tin tức gốm sứ', 'http://localhost/my_tool/tin-tuc', 'custom_link', '0', '[]', null, '', '0', '2');
INSERT INTO `menu_item` VALUES ('69', '12', '0', 'Kiến thức và nghệ thuật', 'http://localhost/my_tool/tin-tuc/kien-thuc-va-nghe-thuat', 'custom_link', '0', '[]', null, '', '0', '3');
INSERT INTO `menu_item` VALUES ('70', '12', '0', 'Hướng dẫn mua hàng', 'http://localhost/my_tool/huong-dan-mua-hang.html', 'page_link', '2', '[]', null, '', '0', '4');
INSERT INTO `menu_item` VALUES ('71', '12', '0', 'Liên hệ', 'http://localhost/my_tool/lien-he', 'custom_link', '0', '[]', null, '', '0', '6');
INSERT INTO `menu_item` VALUES ('72', '12', '0', 'Khách hàng nói về chúng tôi', 'http://localhost/my_tool/testimonial', 'custom_link', '0', '[]', null, '', '0', '5');
INSERT INTO `menu_item` VALUES ('95', '3', '0', 'Ấm chén khác', 'http://localhost/my_tool/bo-am-chen/am-chen-khac', 'category_link', '68', '[]', null, '', '0', '3');
INSERT INTO `menu_item` VALUES ('96', '3', '0', 'Khay đựng ấm chén', 'http://localhost/my_tool/bo-am-chen/khay-dung-am-chen', 'category_link', '69', '[]', null, '', '0', '4');
INSERT INTO `menu_item` VALUES ('98', '1', '0', 'Chính sách', 'http://localhost/my_tool/chinh-sach', 'custom_link', '0', '[]', '', '', '0', '4');
INSERT INTO `menu_item` VALUES ('102', '1', '0', 'Tìm kiếm', '', 'search_item', '0', '[]', '', '', '0', '7');
INSERT INTO `menu_item` VALUES ('103', '1', '0', 'Sản phẩm', 'http://localhost/my_tool/san-pham', 'custom_link', '0', '[]', '', '', '0', '2');
INSERT INTO `menu_item` VALUES ('104', '1', '103', 'Gốm sứ thờ cúng', 'http://localhost/my_tool/gom-su-tho-cung', 'custom_link', '0', '[]', '', '', '1', '1');
INSERT INTO `menu_item` VALUES ('105', '1', '103', '	Gốm sứ phong thủy', 'http://localhost/my_tool/gom-su-phong-thuy', 'custom_link', '0', '[]', '', '', '1', '2');
INSERT INTO `menu_item` VALUES ('106', '1', '103', 'Sứ vẽ vàng 24K Haidoco', 'http://localhost/my_tool/su-ve-vang-24k-haidoco', 'custom_link', '0', '[]', '', '', '1', '3');
INSERT INTO `menu_item` VALUES ('107', '1', '103', 'Chum sành khử độc Bát Tràng', 'http://localhost/my_tool/chum-sanh-khu-doc-bat-trang', 'custom_link', '0', '[]', '', '', '1', '4');

-- ----------------------------
-- Table structure for nav_link
-- ----------------------------
DROP TABLE IF EXISTS `nav_link`;
CREATE TABLE `nav_link` (
  `nav_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `title` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(111) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `plugin_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`nav_link_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of nav_link
-- ----------------------------
INSERT INTO `nav_link` VALUES ('10', '0', 'Hệ thống', '', '', '1', null);
INSERT INTO `nav_link` VALUES ('12', '10', 'Quản lý admin', 'admin/admin/manage', 'fa fa-user', '2', null);
INSERT INTO `nav_link` VALUES ('13', '10', 'Quản lý khách hàng', 'admin/customer/manage', 'fa fa-users', '3', '');
INSERT INTO `nav_link` VALUES ('15', '10', 'Quản lý mẫu email', 'admin/email_template/manage', 'fa fa-envelope', '1', null);
INSERT INTO `nav_link` VALUES ('80', '0', 'File', '', '', '4', null);
INSERT INTO `nav_link` VALUES ('81', '80', 'Quản lý file', 'admin/file/manage', 'fa fa-file-o', '1', null);
INSERT INTO `nav_link` VALUES ('82', '80', 'Cấu hình file', 'admin/file/setting', 'fa fa-cog', '2', null);
INSERT INTO `nav_link` VALUES ('90', '0', 'Website', '', '', '3', null);
INSERT INTO `nav_link` VALUES ('91', '90', 'Quản lý giao diện', 'admin/layout/manage', 'fa fa fa-bars', '1', null);
INSERT INTO `nav_link` VALUES ('177', '233', 'Quản lý slider', 'admin/slider/manage', 'fa fa-sliders', '3', 'slider');
INSERT INTO `nav_link` VALUES ('207', '0', 'Sản phẩm', null, null, '2', 'shop');
INSERT INTO `nav_link` VALUES ('208', '207', 'Danh mục sản phẩm', 'admin/category/manage', 'fa fa-folder-open', '1', 'shop');
INSERT INTO `nav_link` VALUES ('210', '207', 'Quản lý sản phẩm', 'admin/product/manage', 'fab fa-product-hunt', '2', 'shop');
INSERT INTO `nav_link` VALUES ('233', '0', 'Mở rộng', '', '', '6', 'contact');
INSERT INTO `nav_link` VALUES ('234', '233', 'Quản lý contact', 'admin/contact/manage', 'fa fa-file-o', '2', 'contact');
INSERT INTO `nav_link` VALUES ('239', '90', 'Quản lý menu', 'admin/menu/manage', 'fa fa-bars', '2', '');
INSERT INTO `nav_link` VALUES ('240', '233', 'Quản lý trang tĩnh', 'admin/static_page/manage', 'fa fa-file-o', '1', 'static_page');
INSERT INTO `nav_link` VALUES ('249', '0', 'Tin tức', '', '', '5', '');
INSERT INTO `nav_link` VALUES ('250', '249', 'Danh mục tin tức', 'admin/news_category/manage', 'fa fa-bars', '1', '');
INSERT INTO `nav_link` VALUES ('251', '249', 'Quản lý tin tức', 'admin/news/manage', 'fas fa-newspaper', '2', '');
INSERT INTO `nav_link` VALUES ('254', '233', 'Quản lý newsletter', 'admin/newsletter/manage', 'fa fa-envelope', '4', 'newsletter');
INSERT INTO `nav_link` VALUES ('258', '90', 'Sitemap info', 'admin/site_map', 'fa fa-sitemap', '3', null);
INSERT INTO `nav_link` VALUES ('259', '0', 'Help', null, null, '7', 'help');
INSERT INTO `nav_link` VALUES ('260', '259', 'Help list', 'admin/help/list', 'fa fa-bars', '1', 'help');
INSERT INTO `nav_link` VALUES ('261', '207', 'Product tags', 'admin/product_tag/manage', 'fa fa-tags', '3', null);
INSERT INTO `nav_link` VALUES ('262', '207', 'Sản phẩm bán chạy', 'admin/product_best_seller/manage', 'fab fa-product-hunt', '5', null);
INSERT INTO `nav_link` VALUES ('263', '207', 'Sản phẩm tiêu biểu', 'admin/product_feature/manage', 'fab fa-product-hunt', '4', null);

-- ----------------------------
-- Table structure for plugin
-- ----------------------------
DROP TABLE IF EXISTS `plugin`;
CREATE TABLE `plugin` (
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `priority` int(11) DEFAULT '0',
  `file_list` text COLLATE utf8_unicode_ci,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`plugin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of plugin
-- ----------------------------
INSERT INTO `plugin` VALUES ('24', 'scraper_data', '{\"name\":\"scraper_data plugin\",\"description\":\"scraper_data plugin description\",\"version\":\"1.0\",\"author\":\"TaiPV\",\"url\":\"zpham.com\"}', '0', '[]', 'A');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'backend',
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'Guest', 'frontend');
INSERT INTO `role` VALUES ('2', 'Member', 'frontend');
INSERT INTO `role` VALUES ('4', 'Admin', 'backend');

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `role_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission` text COLLATE utf8_unicode_ci,
  `status` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`role_permission_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES ('1', '1', '[\"home\\/404\",\"home\",\"home\\/set\\/session\",\"home\\/lop_ca_nhan\",\"home\\/lop_nhom\",\"home\\/account\",\"home\\/account\\/address\",\"home\\/account\\/address\\/action\",\"home\\/account\\/orders\",\"home\\/logout\",\"home\\/login\",\"home\\/register\",\"home\\/register\\/validate\",\"home\\/account\\/verify\",\"home\\/forget_password\",\"home\\/reset_password\",\"home\\/google\\/login\",\"home\\/facebook\\/login\",\"home\\/facebook\\/login\\/callback\",\"home\\/twitter\\/login\",\"home\\/twitter\\/login\\/callback\",\"home\\/address_ajax\",\"home\\/customer\\/address\\/add\\/view\",\"home\\/customer\\/address\\/add\",\"home\\/customer\\/address\\/edit\\/view\",\"home\\/customer\\/address\\/edit\",\"home\\/customer\\/address\\/delete\\/view\",\"home\\/customer\\/address\\/delete\",\"home\\/customer\\/address\\/refresh\",\"home\\/product\\/list\",\"home\\/product\\/detail\",\"home\\/product\\/detail\\/select_color\",\"home\\/product\\/popup\",\"home\\/product\\/tag\",\"home\\/cart\",\"home\\/cart\\/add_product\",\"home\\/cart\\/change_quantity\",\"home\\/cart\\/recalculate\",\"home\\/cart\\/remove_product\",\"home\\/cart\\/clear_cart\",\"home\\/checkout\",\"home\\/checkout_ajax\",\"home\\/checkout\\/return_url\",\"home\\/checkout\\/cancel_url\",\"home\\/checkout\\/done\",\"home\\/orders\\/history\",\"home\\/orders\\/detail\",\"home\\/search\",\"home\\/search\\/getAutocompleteData\",\"home\\/product\\/wishlist\",\"home\\/product\\/wishlist\\/add\",\"home\\/product\\/wishlist\\/delete\",\"home\\/product\\/wishlist\\/delete_all\",\"home\\/news\\/list\",\"home\\/news\\/detail\",\"home\\/news\\/tag\",\"home\\/contact\",\"home\\/static_page\\/view\",\"home\\/customer_review\",\"home\\/submit_newsletter\",\"home\\/submit_newsletter\\/send_email\",\"home\\/unsubscribe_newsletter\",\"home\\/resubscribe_newsletter\",\"home\\/newsletter\\/profile_center\",\"home\\/newsletter\\/popup\\/show\",\"home\\/ui\\/product\\/detail\"]', 'A');
INSERT INTO `role_permission` VALUES ('2', '2', '[\"home\\/404\",\"home\",\"home\\/set\\/session\",\"home\\/lop_ca_nhan\",\"home\\/lop_nhom\",\"home\\/account\",\"home\\/account\\/address\",\"home\\/account\\/address\\/action\",\"home\\/account\\/orders\",\"home\\/logout\",\"home\\/login\",\"home\\/register\",\"home\\/register\\/validate\",\"home\\/account\\/verify\",\"home\\/forget_password\",\"home\\/reset_password\",\"home\\/google\\/login\",\"home\\/facebook\\/login\",\"home\\/facebook\\/login\\/callback\",\"home\\/twitter\\/login\",\"home\\/twitter\\/login\\/callback\",\"home\\/address_ajax\",\"home\\/customer\\/address\\/add\\/view\",\"home\\/customer\\/address\\/add\",\"home\\/customer\\/address\\/edit\\/view\",\"home\\/customer\\/address\\/edit\",\"home\\/customer\\/address\\/delete\\/view\",\"home\\/customer\\/address\\/delete\",\"home\\/customer\\/address\\/refresh\",\"home\\/product\\/list\",\"home\\/product\\/detail\",\"home\\/product\\/detail\\/select_color\",\"home\\/product\\/popup\",\"home\\/product\\/tag\",\"home\\/cart\",\"home\\/cart\\/add_product\",\"home\\/cart\\/change_quantity\",\"home\\/cart\\/recalculate\",\"home\\/cart\\/remove_product\",\"home\\/cart\\/clear_cart\",\"home\\/checkout\",\"home\\/checkout_ajax\",\"home\\/checkout\\/return_url\",\"home\\/checkout\\/cancel_url\",\"home\\/checkout\\/done\",\"home\\/orders\\/history\",\"home\\/orders\\/detail\",\"home\\/search\",\"home\\/search\\/getAutocompleteData\",\"home\\/product\\/wishlist\",\"home\\/product\\/wishlist\\/add\",\"home\\/product\\/wishlist\\/delete\",\"home\\/product\\/wishlist\\/delete_all\",\"home\\/news\\/list\",\"home\\/news\\/detail\",\"home\\/news\\/tag\",\"home\\/contact\",\"home\\/static_page\\/view\",\"home\\/customer_review\",\"home\\/submit_newsletter\",\"home\\/submit_newsletter\\/send_email\",\"home\\/unsubscribe_newsletter\",\"home\\/resubscribe_newsletter\",\"home\\/newsletter\\/profile_center\",\"home\\/newsletter\\/popup\\/show\",\"home\\/ui\\/product\\/detail\"]', 'A');
INSERT INTO `role_permission` VALUES ('4', '4', '[\"admin\\/404\",\"admin\\/account\",\"admin\\/login\",\"admin\\/logout\",\"admin\\/active\\/account\",\"admin\\/index\",\"admin\\/index\\/statistic_ajax\",\"admin\\/site_map\",\"admin\\/file\\/add_image_ajax\",\"admin\\/setting\\/manage\",\"admin\\/nav_link\\/manage\",\"admin\\/nav_link\\/action\",\"admin\\/menu\\/manage\",\"admin\\/menu\\/action\",\"admin\\/menu\\/validate_ajax\",\"admin\\/menu\\/add\",\"admin\\/menu\\/edit\",\"admin\\/menu\\/delete\",\"admin\\/router\\/manage\",\"admin\\/router\\/validate_ajax\",\"admin\\/router\\/add\",\"admin\\/router\\/edit\",\"admin\\/language\\/manage\",\"admin\\/language\\/validate_ajax\",\"admin\\/language\\/add\",\"admin\\/language\\/edit\",\"admin\\/language\\/delete\",\"admin\\/language_value\\/manage\",\"admin\\/language_value\\/add\",\"admin\\/language_value\\/add\\/validate\",\"admin\\/language_value\\/import_auto\",\"admin\\/language_value\\/save\",\"admin\\/language_value\\/delete\",\"admin\\/layout\\/manage\",\"admin\\/layout\\/layout_widget_action_ajax\",\"admin\\/layout\\/layout_row_action_ajax\",\"admin\\/file\\/manage\",\"admin\\/file\\/setting\",\"admin\\/role\\/manage\",\"admin\\/role\\/add\",\"admin\\/role\\/edit\",\"admin\\/role\\/validate_ajax\",\"admin\\/role\\/delete\",\"admin\\/admin\\/manage\",\"admin\\/admin\\/manage_ajax\",\"admin\\/admin\\/validate_ajax\",\"admin\\/admin\\/add\",\"admin\\/admin\\/edit\",\"admin\\/admin\\/delete\",\"admin\\/email_template\\/manage\",\"admin\\/email_template\\/validate_ajax\",\"admin\\/email_template\\/add\",\"admin\\/email_template\\/edit\",\"admin\\/email_template\\/delete\",\"admin\\/email_template\\/manage_ajax\",\"admin\\/plugin\\/manage\",\"admin\\/plugin\\/manage_ajax\",\"admin\\/plugin\\/validate_ajax\",\"admin\\/plugin\\/add\",\"admin\\/plugin\\/edit\",\"admin\\/plugin\\/delete\",\"admin\\/widget\\/manage\",\"admin\\/widget\\/validate_ajax\",\"admin\\/widget\\/add\",\"admin\\/widget\\/edit\",\"admin\\/widget\\/delete\",\"admin\\/customer\\/manage\",\"admin\\/customer\\/manage_ajax\",\"admin\\/customer\\/validate_ajax\",\"admin\\/customer\\/add\",\"admin\\/customer\\/edit\",\"admin\\/customer\\/delete\",\"admin\\/customer\\/export\",\"admin\\/gen_code\",\"admin\\/gen_code_action_ajax\",\"admin\\/slider\\/manage\",\"admin\\/slider\\/manage_ajax\",\"admin\\/slider\\/validate_ajax\",\"admin\\/slider\\/add\",\"admin\\/slider\\/edit\",\"admin\\/slider\\/delete\",\"admin\\/slider\\/add_image\",\"admin\\/slider\\/delete_image\",\"admin\\/currency\\/manage\",\"admin\\/currency\\/validate_ajax\",\"admin\\/currency\\/add\",\"admin\\/currency\\/edit\",\"admin\\/currency\\/delete\",\"admin\\/category\\/manage\",\"admin\\/category\\/validate_ajax\",\"admin\\/category\\/add\",\"admin\\/category\\/edit\",\"admin\\/category\\/delete\",\"admin\\/product\\/manage\",\"admin\\/product\\/manage_ajax\",\"admin\\/product\\/add\\/view\",\"admin\\/product\\/add\",\"admin\\/product\\/edit\\/view\",\"admin\\/product\\/edit\",\"admin\\/product\\/delete\",\"admin\\/product\\/import\",\"admin\\/product\\/export\",\"admin\\/product\\/attribute_action\",\"admin\\/product_tag\\/manage\",\"admin\\/product_tag\\/validate_ajax\",\"admin\\/product_tag\\/action\",\"admin\\/product_tag\\/add\",\"admin\\/product_tag\\/edit\",\"admin\\/product_tag\\/delete\",\"admin\\/manufac\\/manage\",\"admin\\/manufac\\/validate_ajax\",\"admin\\/manufac\\/add\",\"admin\\/manufac\\/edit\",\"admin\\/manufac\\/delete\",\"admin\\/attribute\\/manage\",\"admin\\/attribute\\/validate_ajax\",\"admin\\/attribute\\/edit\",\"admin\\/attribute\\/add\",\"admin\\/attribute\\/delete\",\"admin\\/attribute\\/delete_attribute_value\",\"admin\\/attribute\\/add_attribute_value\",\"admin\\/checkout\\/manage\",\"admin\\/checkout\\/manage_ajax\",\"admin\\/checkout\\/add\",\"admin\\/checkout\\/edit\",\"admin\\/checkout\\/delete\",\"admin\\/orders\\/manage\",\"admin\\/orders\\/edit\",\"admin\\/orders\\/delete\",\"admin\\/orders\\/export\",\"admin\\/order_status\\/manage\",\"admin\\/order_status\\/validate_ajax\",\"admin\\/order_status\\/add\",\"admin\\/order_status\\/edit\",\"admin\\/order_status\\/delete\",\"admin\\/product_search\\/manage\",\"admin\\/product_search\\/manage_ajax\",\"admin\\/product_search\\/validate_ajax\",\"admin\\/product_search\\/add\",\"admin\\/product_search\\/edit\",\"admin\\/product_search\\/delete\",\"admin\\/news_category\\/manage\",\"admin\\/news_category\\/validate_ajax\",\"admin\\/news_category\\/add\",\"admin\\/news_category\\/edit\",\"admin\\/news_category\\/delete\",\"admin\\/news\\/manage\",\"admin\\/news\\/manage_ajax\",\"admin\\/news\\/validate_ajax\",\"admin\\/news\\/add\",\"admin\\/news\\/edit\",\"admin\\/news\\/view\",\"admin\\/news\\/delete\",\"admin\\/news_tag\\/manage\",\"admin\\/news_tag\\/validate_ajax\",\"admin\\/news_tag\\/action\",\"admin\\/news_tag\\/add\",\"admin\\/news_tag\\/edit\",\"admin\\/news_tag\\/delete\",\"admin\\/contact\\/manage\",\"admin\\/contact\\/change_trainer\",\"admin\\/contact\\/change_status\",\"admin\\/contact\\/change_source\",\"admin\\/contact\\/validate_ajax\",\"admin\\/contact\\/add\",\"admin\\/contact\\/edit\",\"admin\\/contact\\/delete\",\"admin\\/contact\\/import\",\"admin\\/contact\\/export\",\"admin\\/static_page\\/manage\",\"admin\\/static_page\\/manage_ajax\",\"admin\\/static_page\\/validate_ajax\",\"admin\\/static_page\\/add\",\"admin\\/static_page\\/edit\",\"admin\\/static_page\\/delete\",\"admin\\/customer_review\\/manage\",\"admin\\/customer_review\\/manage_ajax\",\"admin\\/customer_review\\/validate_ajax\",\"admin\\/customer_review\\/add\",\"admin\\/customer_review\\/edit\",\"admin\\/customer_review\\/delete\",\"admin\\/newsletter\\/manage\",\"admin\\/newsletter\\/manage_ajax\",\"admin\\/newsletter\\/validate_ajax\",\"admin\\/newsletter\\/add\",\"admin\\/newsletter\\/edit\",\"admin\\/newsletter\\/view\",\"admin\\/newsletter\\/delete\",\"admin\\/newsletter\\/email_manage\",\"admin\\/newsletter\\/email_validate_ajax\",\"admin\\/newsletter\\/email_add\",\"admin\\/newsletter\\/email_edit\",\"admin\\/newsletter\\/email_delete\",\"admin\\/newsletter\\/email_send\",\"admin\\/help\\/manage\",\"admin\\/help\\/validate_ajax\",\"admin\\/help\\/add\",\"admin\\/help\\/edit\",\"admin\\/help\\/view\",\"admin\\/help\\/delete\",\"admin\\/help\\/list\",\"admin\\/help_cat\\/manage\",\"admin\\/help_cat\\/validate_ajax\",\"admin\\/help_cat\\/add\",\"admin\\/help_cat\\/edit\",\"admin\\/help_cat\\/delete\",\"admin\\/video\\/manage\",\"admin\\/video\\/manage_ajax\",\"admin\\/video\\/validate_ajax\",\"admin\\/video\\/add\",\"admin\\/video\\/edit\",\"admin\\/video\\/delete\"]', 'A');

-- ----------------------------
-- Table structure for router
-- ----------------------------
DROP TABLE IF EXISTS `router`;
CREATE TABLE `router` (
  `router_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `pk_name` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `suffix` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT ''''', short, full',
  `alias_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias_list` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `callback` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`router_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of router
-- ----------------------------
INSERT INTO `router` VALUES ('1', '1', null, '', '', 'home', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('2', '2', 'categoryId', '', '', '', '%full_path%', '{\"%name%\":\"%name%\",\"%full_path%\":\"%full_path%\"}', 'updateRouterUrlCategoryPageList');
INSERT INTO `router` VALUES ('3', '3', 'productId', '', '.html', '', '%sub_path%', '{\"%name%\":\"%name%\",\"%sub_path%\":\"%sub_path%\",\"%full_path%\":\"%full_path%\"}', 'updateRouterUrlProductPageList');
INSERT INTO `router` VALUES ('4', '4', null, '', '', 'cart', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('5', '5', null, '', '', 'thanh-toan', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('6', '6', '', '', '', 'dat-hang-thanh-cong', 'alias', '{\"alias\":\"alias\"}', '');
INSERT INTO `router` VALUES ('8', '8', null, '', '', 'search', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('11', '11', null, '', '', 'tai-khoan', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('12', '12', null, '', '', 'account/address', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('14', '14', '', '', '', 'tai-khoan/san-pham-quan-tam', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('15', '15', '', '', '', 'tai-khoan/don-hang-da-mua', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('16', '16', null, '', '', 'dang-ky', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('17', '17', null, '', '', 'forget-password', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('18', '18', null, '', '', 'reset-password', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('19', '19', '', '', '', 'testimonial', 'alias', '{\"alias\":\"alias\"}', '');
INSERT INTO `router` VALUES ('22', '22', 'staticPageId', '', '.html', '', '%name%', '{\"%name%\":\"%name%\"}', 'updateRouterUrlStaticPageList');
INSERT INTO `router` VALUES ('23', '23', null, '', '', 'lien-he', 'alias', '{\"alias\":\"alias\"}', null);
INSERT INTO `router` VALUES ('24', '24', '', '', '', 'dang-nhap', 'alias', '{\"alias\":\"alias\"}', '');
INSERT INTO `router` VALUES ('25', '25', 'newsCategoryId', 'tin-tuc/', '', '', '%full_path%', '{\"%name%\":\"%name%\",\"%full_path%\":\"%full_path%\"}', 'updateRouterUrlNewsCategoryPageList');
INSERT INTO `router` VALUES ('26', '26', 'newsId', 'tin-tuc/', '.html', '', '%full_path%', '{\"%name%\":\"%name%\",\"%sub_path%\":\"%sub_path%\",\"%full_path%\":\"%full_path%\"}', 'updateRouterUrlNewsPageList');
INSERT INTO `router` VALUES ('27', '27', 'newsTagId', 'nhom-tin/', '', '', '%name%', '{\"%name%\":\"%name%\"}', 'updateRouterUrlNewsTagPageList');
INSERT INTO `router` VALUES ('28', '28', 'productTagId', 'product-tag/', '', '', '%name%', '{\"%name%\":\"%name%\"}', 'updateRouterUrlProductTagPageList');
INSERT INTO `router` VALUES ('404', '404', null, '', '', '404', 'alias', '{\"alias\":\"alias\"}', null);

-- ----------------------------
-- Table structure for router_url
-- ----------------------------
DROP TABLE IF EXISTS `router_url`;
CREATE TABLE `router_url` (
  `router_url_id` int(11) NOT NULL AUTO_INCREMENT,
  `router_id` int(11) NOT NULL,
  `alias` varchar(225) DEFAULT NULL,
  `dispatch` varchar(255) DEFAULT NULL,
  `pk_name` varchar(225) DEFAULT NULL,
  `pk_value` varchar(225) DEFAULT NULL,
  `redirect_to` varchar(225) DEFAULT NULL,
  `is_del` int(1) DEFAULT '0',
  PRIMARY KEY (`router_url_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=868 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of router_url
-- ----------------------------
INSERT INTO `router_url` VALUES ('1', '0', 'admin', 'admin/index', '', '', '', '0');
INSERT INTO `router_url` VALUES ('3', '0', 'logout', 'home/logout', '', '', '', '0');
INSERT INTO `router_url` VALUES ('100', '0', 'san-pham', 'home/product/list', '', '', '', '0');
INSERT INTO `router_url` VALUES ('120', '0', 'tin-tuc', 'home/news/list', '', '', '', '0');
INSERT INTO `router_url` VALUES ('121', '0', 'tin-tuc-tag', 'home/news/tag', '', '', '', '0');
INSERT INTO `router_url` VALUES ('404', '0', '404.html', 'home/404', '', '', '', '0');
INSERT INTO `router_url` VALUES ('500', '1', 'home', 'home', null, null, '', '0');

-- ----------------------------
-- Table structure for seo_info
-- ----------------------------
DROP TABLE IF EXISTS `seo_info`;
CREATE TABLE `seo_info` (
  `item_id` int(11) NOT NULL,
  `type` enum('product_category','page','product','new','new_category') NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keywords` text,
  `description` text,
  PRIMARY KEY (`item_id`,`type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of seo_info
-- ----------------------------
INSERT INTO `seo_info` VALUES ('110', 'product_category', null, '', '', '');
INSERT INTO `seo_info` VALUES ('111', 'product_category', null, '', '', '');
INSERT INTO `seo_info` VALUES ('112', 'product_category', null, '', '', '');
INSERT INTO `seo_info` VALUES ('113', 'product_category', null, '', '', '');
INSERT INTO `seo_info` VALUES ('114', 'product_category', null, '', '', '');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `setting_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci NOT NULL,
  `setting_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT '0',
  `setting_group_id` int(11) DEFAULT '0',
  `value_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'text',
  `function` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'functionName in arrayHelper get all value of this',
  `status` varchar(2) COLLATE utf8_unicode_ci DEFAULT 'A',
  `required` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`setting_name`) USING BTREE,
  UNIQUE KEY `setting_name_UNIQUE` (`setting_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('album_limit', '6', 'custom_page', '1', '11', 'number', '', 'A', '1');
INSERT INTO `setting` VALUES ('base_url', 'http://localhost/my_tool', 'general', '1', '4', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('checkout_done_message', '', 'custom_page', '2', '18', 'textarea', '', 'A', '0');
INSERT INTO `setting` VALUES ('checkout_done_message_mobile', '', 'custom_page', '3', '18', 'textarea', '', 'A', '1');
INSERT INTO `setting` VALUES ('checkout_info', '', 'custom_page', '1', '18', 'textarea', '', 'A', '0');
INSERT INTO `setting` VALUES ('company_address', '', 'company_info', '4', '17', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('company_email', '', 'company_info', '3', '17', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('company_google_map', '', 'company_info', '5', '17', 'textarea_only', '', 'A', '0');
INSERT INTO `setting` VALUES ('company_name', '', 'company_info', '1', '17', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('company_phone', '', 'company_info', '2', '17', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('contact_header', '', 'custom_page', '1', '19', 'textarea', '', 'A', '0');
INSERT INTO `setting` VALUES ('custom_css', '', '', '0', '0', 'textarea', null, 'D', '0');
INSERT INTO `setting` VALUES ('customer_support_username', '0', 'general', '1', '6', 'number', 'get10', 'D', '1');
INSERT INTO `setting` VALUES ('date_format', 'Y/m/d', 'general', '0', '5', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('date_picker_format', 'dd/mm/yyyy', 'general', '2', '5', 'text', '', 'A', '1');
INSERT INTO `setting` VALUES ('date_time_format', 'Y/m/d  H:i:s', 'general', '1', '5', 'text', '', 'A', '1');
INSERT INTO `setting` VALUES ('email_method', 'smtp', 'email', '2', '1', 'text', 'getEmailMethod', 'A', '1');
INSERT INTO `setting` VALUES ('email_send_allow', '1', 'email', '1', '1', 'text', 'get10', 'A', '1');
INSERT INTO `setting` VALUES ('facebook_app_id', '1972176876399096', 'facebook_api', '0', '21', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('facebook_app_secret', '05097725a057ff6b8bd5b2641572593d', 'facebook_api', '1', '21', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('facebook_redirect_url', 'http://localhost/my_tool/index.php?r=home/facebook/login/callback', 'facebook_api', '2', '21', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('font_family', '', 'general', '1', '24', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('font_link', '', 'general', '0', '24', 'textarea_only', '', 'A', '0');
INSERT INTO `setting` VALUES ('font_size', '', 'general', '2', '24', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('from_email_address', 'my_tool.smtp@gmail.com', 'email', '1', '3', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('google_client_id', '327444993154-nani2be29kvleb01f33hckq6avb5bhgl.apps.googleusercontent.com', 'google_api', '0', '22', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('google_client_secret', 'IbgUQeomkQ422XdpDbmMIHFU', 'google_api', '1', '22', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('google_redirect_url', 'http://localhost/my_tool/index.php?r=home/google/login', 'google_api', '2', '22', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('image_large_height', '400', 'file_upload', '0', '9', 'number', null, 'D', '1');
INSERT INTO `setting` VALUES ('image_large_width', '400', 'file_upload', '0', '9', 'number', null, 'D', '1');
INSERT INTO `setting` VALUES ('image_max_height', '1024', 'file_upload', '0', '9', 'number', null, 'D', '1');
INSERT INTO `setting` VALUES ('image_max_width', '1024', 'file_upload', '0', '9', 'number', null, 'D', '1');
INSERT INTO `setting` VALUES ('image_small_height', '100', 'file_upload', '0', '9', 'number', null, 'D', '1');
INSERT INTO `setting` VALUES ('image_small_width', '100', 'file_upload', '0', '9', 'number', null, 'D', '1');
INSERT INTO `setting` VALUES ('item_per_page', '20', 'general', '5', '4', 'number', null, 'A', '1');
INSERT INTO `setting` VALUES ('logo', 'http://localhost/my_tool/upload/images/no-image.png', 'general', '2', '6', 'file', '', 'A', '1');
INSERT INTO `setting` VALUES ('logo_small', 'http://localhost/my_tool/upload/images/no-image.png', 'general', '4', '6', 'file', null, 'A', '1');
INSERT INTO `setting` VALUES ('meta_description', 'Meta description', 'seo', '2', '15', 'text', '', 'A', '1');
INSERT INTO `setting` VALUES ('meta_keywords', 'Meta keywords', 'seo', '1', '15', 'text', '', 'A', '1');
INSERT INTO `setting` VALUES ('no_image', 'http://localhost/my_tool/upload/images/no-image.png', 'general', '0', '4', 'text', '', 'D', '1');
INSERT INTO `setting` VALUES ('numbers_orders_latest', '6', 'custom_page', '2', '13', 'number', '', 'A', '1');
INSERT INTO `setting` VALUES ('numbers_product_latest', '6', 'custom_page', '3', '13', 'number', '', 'A', '1');
INSERT INTO `setting` VALUES ('option_resize', '3', 'file_upload', '0', '9', 'text', null, 'D', '1');
INSERT INTO `setting` VALUES ('orders_statistic_step', '2000000', 'custom_page', '1', '13', 'number', '', 'A', '1');
INSERT INTO `setting` VALUES ('product_import_image_dir', 'upload/images/san-pham', 'shop', '0', '0', 'text', '', 'D', '1');
INSERT INTO `setting` VALUES ('product_import_report_file', 'upload/report/product-import-report [2016y-12m-04d-23h-18m-16s].xlsx', 'shop', '0', '0', 'text', '', 'D', '1');
INSERT INTO `setting` VALUES ('product_required_code', '1', '', '0', '0', 'text', '', 'D', '0');
INSERT INTO `setting` VALUES ('router_url', '1', 'router_url', '1', '7', 'number', 'get10', 'A', '1');
INSERT INTO `setting` VALUES ('script_on_footer', '', 'custom_page', '2', '20', 'textarea_only', '', 'A', '0');
INSERT INTO `setting` VALUES ('script_on_head', '', 'custom_page', '1', '20', 'textarea_only', '', 'A', '0');
INSERT INTO `setting` VALUES ('ship_info', '', 'custom_page', '1', '14', 'textarea', '', 'A', '1');
INSERT INTO `setting` VALUES ('site_icon', 'http://localhost/my_tool/upload/images/no-image.png', 'general', '1', '6', 'file', null, 'A', '1');
INSERT INTO `setting` VALUES ('site_name', 'my_tool', 'general', '2', '4', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('smtp_auth', '1', 'email', '5', '2', 'text', 'getEmailSmtpAuth', 'A', '1');
INSERT INTO `setting` VALUES ('smtp_host', 'smtp.gmail.com', 'email', '1', '2', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('smtp_port', '465', 'email', '2', '2', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('smtp_pwd', 'my_tool123', 'email', '4', '2', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('smtp_secure', 'ssl', 'email', '6', '2', 'text', 'getEmailSmtpSecure', 'A', '1');
INSERT INTO `setting` VALUES ('smtp_user', 'my_tool.smtp@gmail.com', 'email', '3', '2', 'text', null, 'A', '1');
INSERT INTO `setting` VALUES ('social_facebook', 'http://www.facebook.com/my_tool', 'seo', '1', '16', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('social_google_plus', 'http://plus.google.com/my_tool', 'seo', '2', '16', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('social_instagram', 'http://instagram.com/my_tool', 'seo', '5', '16', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('social_pinterest', 'http://www.pinterest.com/my_tool', 'seo', '6', '16', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('social_twitter', 'http://twitter.com/my_tool', 'seo', '4', '16', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('social_youtube', 'http://www.youtube.com/channel/my_tool', 'seo', '3', '16', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('sologan', '', 'general', '3', '4', 'text', '', 'D', '1');
INSERT INTO `setting` VALUES ('twitter_consumer_key', 'k7ICGU8Gfrre45ypPpYr3hptA', 'twitter_api', '0', '23', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('twitter_consumer_secret', 'Hqy141Nx36TvRTVfpopmL1GvT4HnqosD58VUaVWr2T55VKmhpu', 'twitter_api', '1', '23', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('twitter_oauth_callback', 'http://103.200.22.81/vdato_empty/index.php?r=home/twitter', 'twitter_api', '2', '23', 'text', '', 'A', '0');
INSERT INTO `setting` VALUES ('video_limit', '6', 'custom_page', '2', '11', 'number', null, 'A', '1');

-- ----------------------------
-- Table structure for setting_group
-- ----------------------------
DROP TABLE IF EXISTS `setting_group`;
CREATE TABLE `setting_group` (
  `setting_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`setting_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of setting_group
-- ----------------------------
INSERT INTO `setting_group` VALUES ('1', 'email', 'General', '2', 'A');
INSERT INTO `setting_group` VALUES ('2', 'email', 'SMTP server settings', '2', 'A');
INSERT INTO `setting_group` VALUES ('3', 'email', 'Email settings', '2', 'A');
INSERT INTO `setting_group` VALUES ('4', 'general', 'General', '1', 'A');
INSERT INTO `setting_group` VALUES ('5', 'general', 'Date format', '1', 'A');
INSERT INTO `setting_group` VALUES ('6', 'general', 'Image', '1', 'A');
INSERT INTO `setting_group` VALUES ('7', 'router_url', 'General', '11', 'A');
INSERT INTO `setting_group` VALUES ('9', 'file_upload', 'General', '9', 'D');
INSERT INTO `setting_group` VALUES ('11', 'custom_page', 'Trang chủ', '5', 'A');
INSERT INTO `setting_group` VALUES ('13', 'custom_page', 'Dashboard', '5', 'D');
INSERT INTO `setting_group` VALUES ('14', 'custom_page', 'Trang sản phẩm', '5', 'D');
INSERT INTO `setting_group` VALUES ('15', 'seo', 'General', '3', 'A');
INSERT INTO `setting_group` VALUES ('16', 'seo', 'Social', '3', 'D');
INSERT INTO `setting_group` VALUES ('17', 'company_info', 'General', '4', 'D');
INSERT INTO `setting_group` VALUES ('18', 'custom_page', 'Trang thanh toán', '5', 'D');
INSERT INTO `setting_group` VALUES ('19', 'custom_page', 'Trang liên hệ', '5', 'A');
INSERT INTO `setting_group` VALUES ('20', 'custom_page', 'Mã JavaScript', '5', 'A');
INSERT INTO `setting_group` VALUES ('21', 'facebook_api', 'Facebook api', '10', 'D');
INSERT INTO `setting_group` VALUES ('22', 'google_api', 'Google api', '10', 'D');
INSERT INTO `setting_group` VALUES ('23', 'twitter_api', 'Twitter api', '10', 'D');
INSERT INTO `setting_group` VALUES ('24', 'general', 'Font', '1', 'D');

-- ----------------------------
-- Table structure for system_log
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;
CREATE TABLE `system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `note` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of system_log
-- ----------------------------

-- ----------------------------
-- Table structure for template
-- ----------------------------
DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`template_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of template
-- ----------------------------
INSERT INTO `template` VALUES ('1', 'theme.basic', 'D');
INSERT INTO `template` VALUES ('2', 'vuagomsu', 'A');

-- ----------------------------
-- Table structure for widget
-- ----------------------------
DROP TABLE IF EXISTS `widget`;
CREATE TABLE `widget` (
  `widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_cat_id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plugin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`widget_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of widget
-- ----------------------------
INSERT INTO `widget` VALUES ('1', '1', 'Văn bản', 'TextWidget', 'Widget hiển thị nội dung là 1 đoạn văn bản hoạc code html', 'fa fa-font', '', 'A');
INSERT INTO `widget` VALUES ('2', '1', 'Hình ảnh', 'ImageWidget', 'Widget hiển thị hình ảnh', 'fa fa-image', null, 'A');
INSERT INTO `widget` VALUES ('3', '100', 'Custom View***', 'CustomViewWidget', 'Widget đặc biệt sử lý các tác vụ phức tạp', 'fa fa-code', null, 'A');
INSERT INTO `widget` VALUES ('4', '100', 'Main Content ***', 'MainContentWidget', 'Widget hiển thị nội dung chính của trang', 'fa fa-star', '', 'A');
INSERT INTO `widget` VALUES ('5', '2', 'Trình chiếu ảnh', 'LightSliderImageWidget', 'Widget hiển thị slider ảnh', 'fas fa-sliders-h', 'slider', 'A');
INSERT INTO `widget` VALUES ('6', '3', 'Sản phẩm liên quan', 'ProductRelateWidget', 'Widget hiển thị sản phẩm liên quan', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('7', '3', 'Sản phẩm đã xem', 'ProductViewedWidget', 'Widget hiển thị sản phẩm đã xem', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('8', '3', 'Sàn phẩm trong danh mục', 'ProductListWidget', 'Widget hiển thị các sản phẩm top trong 1 danh mục', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('9', '3', 'Sản phẩm bán chạy', 'ProductBestSellerWidget', 'Widget hiển thị sản phẩm bán chạy', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('11', '1', 'Menu', 'MenuWidget', 'Widget hiển thị menu', 'fa fa-bars', '', 'A');
INSERT INTO `widget` VALUES ('12', '2', 'Youtube', 'YoutubeWidget', 'Widget hiển thị youtube video', 'fa fa-youtube-square', '', 'A');
INSERT INTO `widget` VALUES ('13', '2', 'Facebook Like Box', 'FacebookLikeBoxWidget', 'Widget hiển thị fabook like box', 'fa fa-facebook-square', '', 'A');
INSERT INTO `widget` VALUES ('15', '2', 'Facebook Comment', 'FacebookCommentWidget', 'Display a facebook comment on your site', 'fa fa-comment', '', 'D');
INSERT INTO `widget` VALUES ('16', '2', 'Breadcrumb', 'BreadcrumbWidget', 'Widget hiển thị breadcrumb cùa sản phẩm, tìn bài...', 'fa fa-map-signs', '', 'A');
INSERT INTO `widget` VALUES ('17', '2', 'Testimonial', 'TestimonialWidget', 'Display testimonial on your site', 'fa fa-comments-o', 'customer_review', 'D');
INSERT INTO `widget` VALUES ('18', '3', 'Danh mục sản phẩm', 'ProductCategoryWidget', 'Widget hiển thị danh sách danh mục sản phẩm', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('19', '3', 'Sản phẩm mới', 'ProductNewWidget', 'Widget hiển thị sản phẩm mới', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('20', '2', 'YoutubeRandom', 'YoutubeRandomWidget', 'Display a youtube video random on your site', 'fa fa-youtube', '', 'D');
INSERT INTO `widget` VALUES ('30', '4', 'Tin tức mới nhất', 'NewsLatestWidget', 'Widget hiển thị tức mới nhất', 'fas fa-newspaper', 'news', 'A');
INSERT INTO `widget` VALUES ('31', '4', 'Danh mục tin tức', 'NewsCategoryWidget', 'Widget hiển thị danh mục tin tức', 'fas fa-newspaper', 'news', 'A');
INSERT INTO `widget` VALUES ('32', '4', 'Tin tức liên quan', 'NewsRelateWidget', 'Widget hiển thị tin tức liên quan', 'fas fa-newspaper', 'news', 'A');
INSERT INTO `widget` VALUES ('51', '3', 'Sản phẩm khuyến mại', 'ProductPromotionWidget', 'Widget hiển thị sản phẩm khuyến mại', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('52', '3', 'Nhóm sản phẩm', 'ProductGroupWidget', 'Widget hiển thị sản phẩm theo các nhóm mới, nổi bật, bán chạy...', 'fab fa-product-hunt', 'shop', 'A');
INSERT INTO `widget` VALUES ('53', '3', 'Thẻ sản phẩm (tag)', 'ProductTagWidget', 'Widget hiển thị danh sách các thẻ (tag) của sản phẩm có trong danh mục hoặc trong cùng thẻ', 'fab fa-product-hunt', 'shop', 'A');

-- ----------------------------
-- Table structure for widget_cat
-- ----------------------------
DROP TABLE IF EXISTS `widget_cat`;
CREATE TABLE `widget_cat` (
  `widget_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`widget_cat_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of widget_cat
-- ----------------------------
INSERT INTO `widget_cat` VALUES ('1', 'Basic ', 'Interface containing basic widgets');
INSERT INTO `widget_cat` VALUES ('2', 'Extension', 'Interface containing extension widgets');
INSERT INTO `widget_cat` VALUES ('3', 'Product', 'Widget  list of plugin shop');
INSERT INTO `widget_cat` VALUES ('4', 'News', 'Widget  list of plugin news');
INSERT INTO `widget_cat` VALUES ('100', 'Special', 'Widget  list of plugin news');
