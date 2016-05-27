/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : cshop

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2016-05-27 17:59:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position` int(255) DEFAULT '888',
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('61', 'Quần', '/danh-muc-san-pham/quan', '0', '888', '1');
INSERT INTO `category` VALUES ('62', 'Áo', '/danh-muc-san-pham/ao', '0', '888', '1');
INSERT INTO `category` VALUES ('63', 'Quần jean', '/danh-muc-san-pham/quan-jean', '61', '888', '1');
INSERT INTO `category` VALUES ('64', 'Quân kaki', '/danh-muc-san-pham/quan-kaki', '61', '888', '1');
INSERT INTO `category` VALUES ('65', 'Quần sooc', '/danh-muc-san-pham/quan-sooc', '61', '888', '1');
INSERT INTO `category` VALUES ('66', 'Áo phông', '/danh-muc-san-pham/ao', '62', '888', '1');
INSERT INTO `category` VALUES ('67', 'Áo sơ mi', '/danh-muc-san-pham/ao-so-mi', '62', '888', '1');
INSERT INTO `category` VALUES ('68', 'Váy', '/danh-muc-san-pham/vay', '0', '888', '1');
INSERT INTO `category` VALUES ('69', 'Phụ kiện', '/danh-muc-san-pham/phu-kien', '0', '888', '1');
INSERT INTO `category` VALUES ('70', 'Đồng hồ', '/danh-muc-san-pham/dong-ho', '69', '888', '1');
INSERT INTO `category` VALUES ('71', 'Mũ', '/danh-muc-san-pham/mu', '69', '888', '1');

-- ----------------------------
-- Table structure for functional
-- ----------------------------
DROP TABLE IF EXISTS `functional`;
CREATE TABLE `functional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `controller_id` varchar(50) DEFAULT NULL,
  `action_id` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of functional
-- ----------------------------
INSERT INTO `functional` VALUES ('77', 'User', '', null, '', '0');
INSERT INTO `functional` VALUES ('78', 'Tất cả user', '/admin/member/admin', 'member', 'admin', '77');
INSERT INTO `functional` VALUES ('79', 'Thêm mới', '/admin/member/create', 'member', 'create', '77');
INSERT INTO `functional` VALUES ('80', 'Sản phẩm', '', null, '', '0');
INSERT INTO `functional` VALUES ('81', 'Tất cả', '/admin/product/admin', 'product', 'admin', '80');
INSERT INTO `functional` VALUES ('82', 'Thêm mới', '/admin/product/create', 'product', 'create', '80');
INSERT INTO `functional` VALUES ('83', 'Cập nhật', '/admin/product/update', 'product', 'update', '80');
INSERT INTO `functional` VALUES ('84', 'Active', '/admin/product/active', 'product', 'active', '80');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Administrator', 'Nhóm có quyền cao nhất');
INSERT INTO `groups` VALUES ('2', 'Editor', 'BTV');
INSERT INTO `groups` VALUES ('3', 'Contributor', 'CTV');
INSERT INTO `groups` VALUES ('4', 'Customer', 'Khách hàng');

-- ----------------------------
-- Table structure for group_functional
-- ----------------------------
DROP TABLE IF EXISTS `group_functional`;
CREATE TABLE `group_functional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `functional_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1301 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group_functional
-- ----------------------------
INSERT INTO `group_functional` VALUES ('1229', '5', '58');
INSERT INTO `group_functional` VALUES ('1230', '5', '59');
INSERT INTO `group_functional` VALUES ('1231', '5', '60');
INSERT INTO `group_functional` VALUES ('1232', '5', '61');
INSERT INTO `group_functional` VALUES ('1233', '5', '64');
INSERT INTO `group_functional` VALUES ('1234', '5', '65');
INSERT INTO `group_functional` VALUES ('1235', '5', '69');
INSERT INTO `group_functional` VALUES ('1236', '5', '70');
INSERT INTO `group_functional` VALUES ('1237', '5', '72');
INSERT INTO `group_functional` VALUES ('1238', '5', '73');
INSERT INTO `group_functional` VALUES ('1239', '5', '74');
INSERT INTO `group_functional` VALUES ('1240', '5', '75');
INSERT INTO `group_functional` VALUES ('1241', '5', '76');
INSERT INTO `group_functional` VALUES ('1242', '4', '58');
INSERT INTO `group_functional` VALUES ('1243', '4', '59');
INSERT INTO `group_functional` VALUES ('1244', '4', '60');
INSERT INTO `group_functional` VALUES ('1245', '4', '65');
INSERT INTO `group_functional` VALUES ('1246', '4', '69');
INSERT INTO `group_functional` VALUES ('1247', '4', '70');
INSERT INTO `group_functional` VALUES ('1248', '4', '72');
INSERT INTO `group_functional` VALUES ('1249', '4', '73');
INSERT INTO `group_functional` VALUES ('1250', '4', '74');
INSERT INTO `group_functional` VALUES ('1251', '4', '75');
INSERT INTO `group_functional` VALUES ('1252', '4', '76');
INSERT INTO `group_functional` VALUES ('1253', '3', '58');
INSERT INTO `group_functional` VALUES ('1254', '3', '59');
INSERT INTO `group_functional` VALUES ('1255', '3', '60');
INSERT INTO `group_functional` VALUES ('1256', '3', '61');
INSERT INTO `group_functional` VALUES ('1257', '3', '62');
INSERT INTO `group_functional` VALUES ('1258', '3', '63');
INSERT INTO `group_functional` VALUES ('1259', '3', '65');
INSERT INTO `group_functional` VALUES ('1260', '3', '66');
INSERT INTO `group_functional` VALUES ('1261', '3', '67');
INSERT INTO `group_functional` VALUES ('1262', '3', '69');
INSERT INTO `group_functional` VALUES ('1263', '3', '70');
INSERT INTO `group_functional` VALUES ('1264', '3', '72');
INSERT INTO `group_functional` VALUES ('1265', '3', '76');
INSERT INTO `group_functional` VALUES ('1278', '6', '58');
INSERT INTO `group_functional` VALUES ('1279', '6', '59');
INSERT INTO `group_functional` VALUES ('1280', '6', '60');
INSERT INTO `group_functional` VALUES ('1281', '6', '61');
INSERT INTO `group_functional` VALUES ('1282', '6', '65');
INSERT INTO `group_functional` VALUES ('1283', '6', '69');
INSERT INTO `group_functional` VALUES ('1284', '6', '70');
INSERT INTO `group_functional` VALUES ('1285', '6', '72');
INSERT INTO `group_functional` VALUES ('1286', '6', '73');
INSERT INTO `group_functional` VALUES ('1287', '6', '74');
INSERT INTO `group_functional` VALUES ('1288', '6', '75');
INSERT INTO `group_functional` VALUES ('1289', '6', '76');
INSERT INTO `group_functional` VALUES ('1290', '2', '80');
INSERT INTO `group_functional` VALUES ('1291', '2', '81');
INSERT INTO `group_functional` VALUES ('1292', '2', '82');
INSERT INTO `group_functional` VALUES ('1293', '2', '83');
INSERT INTO `group_functional` VALUES ('1294', '1', '77');
INSERT INTO `group_functional` VALUES ('1295', '1', '78');
INSERT INTO `group_functional` VALUES ('1296', '1', '79');
INSERT INTO `group_functional` VALUES ('1297', '1', '80');
INSERT INTO `group_functional` VALUES ('1298', '1', '81');
INSERT INTO `group_functional` VALUES ('1299', '1', '82');
INSERT INTO `group_functional` VALUES ('1300', '1', '83');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `display_name` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT '0' COMMENT 'Xac dinh la user hay admin',
  `address` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `gender` tinyint(4) DEFAULT '10',
  `birthday` date DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `type_ctv` int(11) DEFAULT NULL COMMENT 'Loại CTV',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'CTB', 'admin', '2570949c64339542ac0a1068840742e4', null, '', '1', null, '1', '1', null, null, null, null, null);
INSERT INTO `member` VALUES ('25', 'Nguyễn Văn A', 'nguyenvana', '8f140cd752e5f564967f0d5ca5808d23', null, '', '0', null, '1', '10', null, null, null, null, null);
INSERT INTO `member` VALUES ('26', 'Nguyễn Văn B', 'nguyenvanb', 'cc522e829a5c4386dbc2c71bb7ab60a5', null, '', '0', null, '1', '10', null, null, null, null, null);
INSERT INTO `member` VALUES ('27', 'Nguyễn Văn D', 'nguyenvand', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '0', null, '1', '10', null, null, '26', null, '1');

-- ----------------------------
-- Table structure for member_group
-- ----------------------------
DROP TABLE IF EXISTS `member_group`;
CREATE TABLE `member_group` (
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member_group
-- ----------------------------
INSERT INTO `member_group` VALUES ('1', '1');
INSERT INTO `member_group` VALUES ('23', '1');
INSERT INTO `member_group` VALUES ('24', '2');
INSERT INTO `member_group` VALUES ('25', '3');
INSERT INTO `member_group` VALUES ('26', '4');
INSERT INTO `member_group` VALUES ('27', '5');
INSERT INTO `member_group` VALUES ('28', '2');
INSERT INTO `member_group` VALUES ('29', '5');
INSERT INTO `member_group` VALUES ('30', '1');
INSERT INTO `member_group` VALUES ('31', '5');
INSERT INTO `member_group` VALUES ('32', '6');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` tinyint(255) DEFAULT '1' COMMENT '0 - Trang chủ |  1 Page | 2 - Cate',
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '0', 'Trang chủ', '/', '1', '1');
INSERT INTO `menu` VALUES ('2', '0', 'Giới thiệu', '/gioi-thieu', '2', '2');
INSERT INTO `menu` VALUES ('3', '1', 'Sản phẩm', '/danh-muc-san-pham', '1', '2');
INSERT INTO `menu` VALUES ('4', '2', 'Quần', '/danh-muc-san-pham/quan', '1', '3');

-- ----------------------------
-- Table structure for menu_admin
-- ----------------------------
DROP TABLE IF EXISTS `menu_admin`;
CREATE TABLE `menu_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu_admin
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `note` text,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', 'Tạ Văn Chinh', '0974125516', 'Thạch Thất - Hà Nội', 'chinh.tv91@gmail.com', null, '1', 'Giao hàng trong ngày', '2016-05-24 15:10:43');

-- ----------------------------
-- Table structure for orders_product
-- ----------------------------
DROP TABLE IF EXISTS `orders_product`;
CREATE TABLE `orders_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders_product
-- ----------------------------
INSERT INTO `orders_product` VALUES ('1', '1', '7', '2');
INSERT INTO `orders_product` VALUES ('2', '1', '8', '1');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text,
  `layout` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `create_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', 'Liên hệ', '/lien-he', '<p>Nội dung trang li&ecirc;n hệ</p>\r\n', '0', '1', '2016-05-27 10:33:13', null);

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` tinyint(4) DEFAULT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------

-- ----------------------------
-- Table structure for post_type
-- ----------------------------
DROP TABLE IF EXISTS `post_type`;
CREATE TABLE `post_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post_type
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `feature` tinyint(4) DEFAULT '0',
  `sapo` varchar(500) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT '1' COMMENT 'Tình trạng',
  `stock` tinyint(4) DEFAULT '1' COMMENT 'Kho',
  `custom_field` text COMMENT 'Json',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('7', 'Áo sơ mi nam', 'ao-so-mi-nam-8th16s018-fg010-201605690.jpg', '12345', '120000', '5', '2016-05-20 15:09:14', null, '1', null, '1', 'Mô tả ngắn gọn\r\n', '<p>Chi tiết sản phẩm &aacute;o sơ mi Nam</p>\r\n', '3', '1', null);
INSERT INTO `product` VALUES ('8', 'Quần âu nam', 'quan-au-nam-8bp16s001-sk017-201605445.jpg', '', '430000', null, '2016-05-20 16:03:53', '2016-05-23 13:58:50', '1', '1', '0', 'Quần âu nam', '<p>Quần &acirc;u nam</p>\r\n', '1', '1', '[{\"label\":\"N\\u1eb7ng\",\"value\":\"180kg\"}]');
INSERT INTO `product` VALUES ('9', 'Quần âu nam', 'quan-au-nam-8bp16s001-sk017-201605445.jpg', '-', '549000', null, '2016-05-20 17:06:56', '2016-05-23 13:45:41', '1', '1', '0', 'Quần âu nam', '<p>Quần &acirc;u nam</p>\r\n', '2', '0', '[{\"label\":\"N\\u1eb7ng\",\"value\":\"190kg\"},{\"label\":\"Cao\",\"value\":\"180cm\"}]');

-- ----------------------------
-- Table structure for product_category
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`,`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_category
-- ----------------------------
INSERT INTO `product_category` VALUES ('15', '7', '66');
INSERT INTO `product_category` VALUES ('33', '8', '63');
INSERT INTO `product_category` VALUES ('28', '8', '64');
INSERT INTO `product_category` VALUES ('34', '8', '65');
INSERT INTO `product_category` VALUES ('29', '9', '64');

-- ----------------------------
-- Table structure for product_gallery
-- ----------------------------
DROP TABLE IF EXISTS `product_gallery`;
CREATE TABLE `product_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`,`image`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_gallery
-- ----------------------------
INSERT INTO `product_gallery` VALUES ('1', '7', 'ao-so-mi-nam-8th16s018-fg010-201605338.jpg');
INSERT INTO `product_gallery` VALUES ('2', '7', 'ao-so-mi-nam-8th16s018-fg010-201605521.jpg');

-- ----------------------------
-- Table structure for product_tag
-- ----------------------------
DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE `product_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`,`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_tag
-- ----------------------------
INSERT INTO `product_tag` VALUES ('5', '7', '2');
INSERT INTO `product_tag` VALUES ('1', '7', '4');
INSERT INTO `product_tag` VALUES ('13', '8', '5');
INSERT INTO `product_tag` VALUES ('14', '9', '5');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES ('1', 'Slide 1', '#', '12212110143239789400726644049947-201605962.jpg', '0', '1');
INSERT INTO `slide` VALUES ('2', 'Slide 2', '#', 'c3602016-05-06-06-09-23-432-201605699-201605375.jpg', '1', '3');
INSERT INTO `slide` VALUES ('3', 'Slide 3', '#', '20160506061755-201605597-201605631.jpg', '1', '2');

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `display_home` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', 'Sơ mi', '0');
INSERT INTO `tag` VALUES ('2', 'Phông hè 2016', '0');
INSERT INTO `tag` VALUES ('3', 'minh vuong', '0');
INSERT INTO `tag` VALUES ('4', 'Áo đẹp', '0');
INSERT INTO `tag` VALUES ('5', 'quần âu', '0');

-- ----------------------------
-- Table structure for web_config
-- ----------------------------
DROP TABLE IF EXISTS `web_config`;
CREATE TABLE `web_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_title` varchar(255) DEFAULT '' COMMENT 'Web title',
  `meta_description` varchar(512) DEFAULT '' COMMENT 'Description',
  `meta_keyword` varchar(512) DEFAULT '' COMMENT 'Keyword',
  `fanpage_url` varchar(255) DEFAULT NULL COMMENT 'Link fanpage',
  `secret_id` varchar(255) DEFAULT NULL,
  `app_id` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL COMMENT 'Link Youtube',
  `hotline` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_config
-- ----------------------------
INSERT INTO `web_config` VALUES ('1', 'Thời trang Việt Nam', '', '', '', '', '', '', '0974 12 55 16', 'chinh.tv91@gmail.com');
