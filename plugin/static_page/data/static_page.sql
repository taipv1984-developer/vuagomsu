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

 Date: 28/05/2018 09:21:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for static_page
-- ----------------------------
DROP TABLE IF EXISTS `static_page`;
CREATE TABLE `static_page`  (
  `static_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `summary` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `status` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `crt_date` datetime(0) NULL DEFAULT NULL,
  `crt_by` int(11) NULL DEFAULT NULL,
  `mod_date` datetime(0) NULL DEFAULT NULL,
  `mod_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`static_page_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = swe7 COLLATE = swe7_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of static_page
-- ----------------------------
INSERT INTO `static_page` VALUES (1, 'upload/images/logo.png', 'Về chúng tôi', '', '<p><strong>Để bắt kịp với đà phát triển của xã hội, thoát ra khỏi cái bóng của một hộ kinh doanh cá thể vốn thường thấy ở một làng nghề gốm sứ truyền thống, chúng tôi đã mạnh dạn thành lập công ty để có thể chủ động hơn trong việc cung cấp các sản phẩm tới người tiêu dùng và thuận tiện hơn cho việc hợp tác với các đối tác đặt hàng sản xuất gốm sứ Bát Tràng theo yêu cầu.</strong></p>\r\n<p><br /><img src=\"http://localhost/my_tool/upload/images/logo.jpg\" alt=\"logo\" />Công ty Trách nhiệm hữu hạn sản xuất và dịch vụ thương mại gốm sứ Bát Tràng (cty TNHH SX &amp; DVTM Gốm sứ Bát Tràng) của chúng tôi hoạt động trên cơ sở giấy chứng nhận đăng ký doanh nghiệp số 0105949123 do Sở kế hoạch và đầu tư thành phố Hà Nội cấp với cùng mã số thuế doanh nghiệp là 0105949123.</p>\r\n<p>Với nền tảng là một cơ sở sản xuất gốm sứ Bát Tràng thủ công của một làng nghề truyền thống từ lâu đời, chúng tôi cung cấp các sản phẩm gốm sứ Bát Tràng với độ tinh xảo cao, các sản phẩm đảm bảo được làm theo đúng quy trình thủ công của một làng nghề, không vì lợi nhuận mà đánh mất một thương hiệu lâu đời, không vì lợi nhuận mà đánh mất uy tín của chính mình đối với khách hàng. Do tính chất của việc sản xuất gốm sứ Bát Tràng là sản xuất thủ công nên chúng tôi không thể nào có thể sản xuất được tất cả các sản phẩm của một làng nghề được, nên với các yêu cầu của khách hàng mà chúng tôi không đáp ứng được thì chúng tôi sẽ là cầu nối giúp quý khách hàng tìm được sản phẩm ưng ý nhất trong một làng nghề rộng lớn. Với vai trò là một công ty chúng tôi sẽ giúp quý khách có những lựa chọn tốt nhất mà không phải mất nhiều thời gian tìm kiếm trên mạng và trong làng nghề.</p>\r\n<p>Mục tiêu thành lập công ty của chúng tôi là  đưa thương hiệu gốm sứ Bát Tràng được phát triển hơn nữa, trở thành một thương hiệu mạnh của đất nước Việt Nam, đưa các sản phẩm gốm sứ Bát Tràng cao cấp tới tận tay người tiêu dùng với giá thành thấp nhất.</p>\r\n<p>Công ty chúng tôi hân hạnh được phục vụ quý khách hàng</p>\r\n<p> </p>\r\n<p>Trân trọng thông báo</p>', 'A', '2016-12-18 20:19:10', 1, '2017-01-03 22:58:02', 1);
INSERT INTO `static_page` VALUES (2, 'upload/images/logo-header.png', 'Hướng dẫn mua hàng', '', '<p>Chúng tôi rất cảm kích khi được các Bạn dành thời gian quý báu và quyết định mua sắm <strong>sản phẩm Vua Gốm Sứ</strong> tại trang web : www.my_tool.com.vn</p>\r\n<p>Chúng tôi luôn sẳn sàng và luôn có sự chuẩn bị tốt nhất nhằm phục vụ các Bạn theo cách chuyên nghiệp. Để nội dung giao dịch mua bán kết thúc tốt đẹp, các Bạn vui lòng hợp tác cùng chúng tôi thực hiện đầy đủ, chính xác theo thứ tự các bước mua hàng trực tuyến sau đây :</p>\r\n<p> 1 - Tham khảo đầy đủ 10 nhóm hàng và chọn các sản phẩm yêu thích nhất.</p>\r\n<p> 2 - Kiểm tra lại danh sách hàng hóa đã chọn và điền số lượng cần mua (Tại đơn hàng của Bạn).</p>\r\n<p> 3 - Điền thông tin đầy đủ, chính xác và cần thiết : Thông tin chính - Nội dung giao nhận hàng hóa.</p>\r\n<p> 4 - Khi số lượng hàng hóa Bạn chọn được chúng tôi phúc đáp xác nhận qua email hay điện thoại. Các Bạn vui lòng xem lại 03 nội dung giao dịch : Danh sách hàng hóa - Nội dung xuất hóa đơn (nếu có) - Nội dung giao nhận hàng hóa. Tất nhiên các Bạn đừng quên gởi ý kiến phản hồi đến chúng tôi.</p>\r\n<p> 5 - Khi Bạn thực sự hài lòng về tình trạng đơn hàng mà chúng tôi đã cung cấp đầy đủ thông tin. Các Bạn vui lòng thực hiện chuyển tiền theo giá trị đơn hàng và phí vận chuyển (nếu có) theo nội dung giao dịch giữa hai bên.</p>\r\n<p> 6 - Sau khi chuyển tiền, các Bạn kiểm tra email để nhận thư phúc đáp và lịch giao hàng cụ thể của chúng tôi.</p>\r\n<p> 7 - Nếu đặt hàng trực tiếp qua điện thoại, các Bạn nhớ chọn trước sản phẩm và cập nhật đầy đủ sản phẩm tại nội dung đơn hàng của Bạn. Sau khi hoàn tất đơn hàng, các bạn gọi điện trực tiếp đến chúng tôi để bắt đầu thực hiện giao dịch mua bán.</p>\r\n<p> * Trường hợp đặt hàng với số lượng lớn. Chúng tôi rất mong các Bạn liên hệ trực tiếp với chúng tôi tại văn phòng : số 6Bis 46A Phạm Ngọc Thạch, Trung Tự, Đống Đa, Hà Nội hay liên hệ với chúng tôi qua email info@my_tool.vn. Chúng tôi rất vui mừng và chân thành cám ơn các Bạn đã ủng hộ chúng tôi và giúp chúng tôi có thêm nhiều điều kiện thuận lợi để phục vụ các Bạn. Chúng tôi cam kết, chắc chắn sẽ luôn làm việc nỗ lực, hết mình để đem đến sự yên tâm và hài lòng cho các Bạn.</p>', 'A', '2016-12-20 20:19:50', 1, '2017-05-03 19:01:39', 1);
INSERT INTO `static_page` VALUES (3, 'upload/images/logo.png', 'Tuyển dụng', '', '<p><strong>Công ty TNHH Vua Gốm Sứ là đơn vị sản xuất và phân phối hàng gốm sứ Bát Tràng cao cấp. Do nhu cầu phát triển, chúng tôi cần tuyển dụng thêm các vị trí sau:</strong></p>\r\n<div>\r\n<p><strong>VT1:  Nhân viên bán hàng tại Showroom:</strong></p>\r\n<p> <strong><img src=\"http://media.web5s.com.vn/sites/2343//employmentopportunities.jpg\" alt=\"\" /></strong></p>\r\n<p><strong>1- Mô tả công việc:</strong></p>\r\n<p>- Trông cửa hàng, bán hàng cho khách đến showroom</p>\r\n<p>- Trả lời fanpage/hotline</p>\r\n<p>- Thực hiện các công việc quản lý cửa hàng khác (kiểm kho, làm giá, báo cáo…)</p>\r\n<p><strong>2 - Thời gian làm việc:</strong></p>\r\n<p>Từ thứ 2 đến chủ nhật, từ 8h sáng đến 9h tối. (Có thể đăng ký làm giờ hành chính, làm ca, làm full). Tháng nghỉ 2-4 ngày.</p>\r\n<p><strong>3 – Yêu cầu:</strong></p>\r\n<p>Nữ, độ tuổi từ 19 đến 25</p>\r\n<p>Ngoại hình khá, giao tiếp tốt</p>\r\n<p>Nhanh nhẹn, cẩn thận</p>\r\n<p>Trung thực, nhiệt tình, tinh thần trách nhiệm cao</p>\r\n<p><strong>4- Chế độ:</strong></p>\r\n<p>Lương cứng: từ 2,5 đến 5tr tùy theo thời gian và ca làm.</p>\r\n<p>Thưởng % theo doanh thu của hàng.</p>\r\n<p>Môi trường làm việc chuyên nghiệp, thân thiện.</p>\r\n<p>Được đào tạo phát triển và có cơ hội gắn bó lâu dài, phát triển lên các vị trí quản lý, làm hành chính.</p>\r\n<p> </p>\r\n<p><strong>Liên hệ:</strong></p>\r\n<p>Công ty TNHH Vua Gốm Sứ/Showroom Phạm Ngọc Thạch</p>\r\n<p>Số 6Bis ngõ 46A Phạm Ngọc Thạch</p>\r\n<p>Hotline: 0961 55 40 50 (Ms. Huyền)</p>\r\n<p>Email: <em><a href=\"mailto:info@my_tool.vn\">info@my_tool.vn</a></em></p>\r\n<p><em>Website: </em><a href=\"http://my_toolbattrang.com/\">http://localhost/my_tool/</a></p>\r\n</div>', 'A', '2017-01-04 08:23:17', 1, '2017-05-03 18:57:29', 1);
INSERT INTO `static_page` VALUES (4, 'upload/images/logo.png', 'Đại lý', '', '<p>Đang cập nhật...</p>', 'A', '2017-01-04 08:25:26', 1, '2017-05-03 21:55:56', 1);
INSERT INTO `static_page` VALUES (5, 'upload/images/logo.png', 'Quy định đổi - trả', '', '<p>Quy định đổi / trả...</p>', 'A', '2017-01-11 09:22:58', 1, '2017-01-11 09:23:24', 1);
INSERT INTO `static_page` VALUES (6, 'upload/images/logo.png', 'Chính sách thanh toán', '', '<p>Chính sách thanh toán...</p>', 'A', '2017-01-11 09:23:53', 1, NULL, NULL);
INSERT INTO `static_page` VALUES (7, 'upload/images/logo.png', 'Chính sách bán hàng', '', '<p>Chính sách bán hàng...</p>', 'A', '2017-01-11 09:24:11', 1, NULL, NULL);
INSERT INTO `static_page` VALUES (8, 'upload/images/logo.png', 'Chính sách bảo hành', '', '<p>Chính sách bảo hành..</p>', 'A', '2017-01-11 09:24:25', 1, NULL, NULL);
INSERT INTO `static_page` VALUES (9, 'upload/images/logo.png', 'Hướng dẫn gửi trả hàng', '', '<p>Hướng dẫn gửi trả hàng...</p>', 'A', '2017-01-11 09:24:44', 1, NULL, NULL);
INSERT INTO `static_page` VALUES (10, 'upload/images/logo.png', 'Chính sách vận chuyển', '', '<p>Chính sách vận chuyển...</p>', 'A', '2017-01-11 09:27:45', 1, NULL, NULL);

-- ----------------------------
-- Table structure for static_page_detail
-- ----------------------------
DROP TABLE IF EXISTS `static_page_detail`;
CREATE TABLE `static_page_detail`  (
  `static_page_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `static_page_id` int(11) NOT NULL,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `sub_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `open_link` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`static_page_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of static_page_detail
-- ----------------------------
INSERT INTO `static_page_detail` VALUES (14, 4, 'NYX MARKDOWNS', 'LOOKING FOR THE BEST MAKEUP STEALS? YOU’VE COME TO THE RIGHT PLACE! GET THESE NYX SALE ITEMS BEFORE THEY\'RE GONE.', 'Sale items are not combinable with any other offers. No further discounts apply.', '#');
INSERT INTO `static_page_detail` VALUES (15, 4, 'FREE SHIPPING PROMOTION', 'DON’T TRIP, IT’S FREE TO SHIP! NYX OFFERS FREE SHIPPING ON ORDERS OVER $25 - ALWAYS!', 'Standard shipping is free for orders of $25 or more before tax less any discounts. Unfortunately, orders shipping to Alaska and Hawaii are ineligible for this promotion.', '#');
INSERT INTO `static_page_detail` VALUES (16, 5, 'Do you have limits on how much product I can order?', 'THERE IS A MAXIMUM OF 10 ITEMS PER SHADE IN ORDER TO GIVE EVERYONE A CHANCE TO GRAB THEIR MAKEUP BAG MUST-HAVES! NOTE THAT LIMITED-EDITION ITEMS MAY HAVE A DIFFERENT MAXIMUM AMOUNT.', '', '');
INSERT INTO `static_page_detail` VALUES (17, 5, 'Why was I charged extra?', 'AFTER SUBMITTING YOUR ORDER, THE TOTAL PLUS $1 IS AUTHORIZED TO COVER ANY POTENTIAL TAX DISCREPANCIES. THIS PENDING TRANSACTION NEVER SETTLES AND DROPS FROM YOUR BANK ACCOUNT WITHIN A FEW BUSINESS DAYS. THE PAYMENT METHOD IS CHARGED FOR THE FINAL TOTAL AMOUNT THE DAY THE ORDER SHIPS.', '', '');
INSERT INTO `static_page_detail` VALUES (18, 5, 'Why is my order on hold?', 'YOU MAY BE CONTACTED VIA EMAIL FOR VERIFICATION AS ALL ORDERS ARE SUBJECT TO REVIEW. THE SOONER YOU GET BACK TO US, THE SOONER WE CAN SHIP OUT YOUR NYX HAUL.', '', '');
INSERT INTO `static_page_detail` VALUES (19, 5, 'Do you have limits on how much product I can order?', 'THERE IS A MAXIMUM OF 10 ITEMS PER SHADE IN ORDER TO GIVE EVERYONE A CHANCE TO GRAB THEIR MAKEUP BAG MUST-HAVES! NOTE THAT LIMITED-EDITION ITEMS MAY HAVE A DIFFERENT MAXIMUM AMOUNT.', '', '');

SET FOREIGN_KEY_CHECKS = 1;
