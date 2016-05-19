/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : phimbathu

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-11-15 11:47:04
*/

SET FOREIGN_KEY_CHECKS=0;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of functional
-- ----------------------------
INSERT INTO `functional` VALUES ('1', 'Quản lý thể loại phim', 'http://phimbathu.com/admin/category/admin', 'category', 'admin');
INSERT INTO `functional` VALUES ('2', 'Quản lý chức năng', 'http://localhost:2036/admin/functional/admin', 'functional', 'admin');
INSERT INTO `functional` VALUES ('3', 'Quản lý nhóm', 'http://localhost:2036/admin/groups/admin', 'groups', 'admin');
INSERT INTO `functional` VALUES ('4', 'Thêm mới thể loại phim', 'http://phimbathu.com/admin/category/create', 'category', 'create');
INSERT INTO `functional` VALUES ('5', 'Quản lý phim', 'http://phimbathu.com/admin/film/admin', 'film', 'admin');
INSERT INTO `functional` VALUES ('6', 'Thêm mới phim', 'http://phimbathu.com/admin/film/create', 'film', 'create');
INSERT INTO `functional` VALUES ('7', 'Cập nhật phim', 'http://phimbathu.com/admin/film/update', 'film', 'update');
INSERT INTO `functional` VALUES ('8', 'Thêm mới tập phim', 'http://phimbathu.com/admin/episode/create', 'episode', 'create');
INSERT INTO `functional` VALUES ('9', 'Quản lý tập phim', 'http://phimbathu.com/admin/episode/admin', 'episode', 'admin');
INSERT INTO `functional` VALUES ('10', 'Cập nhật tập phim', 'http://phimbathu.com/admin/episode/update', 'episode', 'update');
INSERT INTO `functional` VALUES ('11', 'Quản lý tags', 'http://phimbathu.com/admin/tag/admin', 'tag', 'admin');
INSERT INTO `functional` VALUES ('12', 'Thêm mới tags', 'http://phimbathu.com/admin/tag/create', 'tag', 'create');
INSERT INTO `functional` VALUES ('13', 'Cập nhật tag', 'http://phimbathu.com/admin/tag/update', 'tag', 'update');
INSERT INTO `functional` VALUES ('14', 'Quản lý diễn viên', 'http://phimbathu.com/admin/actor/admin', 'actor', 'admin');
INSERT INTO `functional` VALUES ('15', 'Cập nhật diễn viên', 'http://phimbathu.com/admin/actor/update', 'actor', 'update');
INSERT INTO `functional` VALUES ('16', 'Thêm mới diễn viên', 'http://phimbathu.com/admin/actor/create', 'actor', 'create');
INSERT INTO `functional` VALUES ('17', 'Quản lý tác giả', 'http://phimbathu.com/admin/director/admin', 'director', 'admin');
INSERT INTO `functional` VALUES ('18', 'Thêm mới tác giả', 'http://phimbathu.com/admin/director/create', 'director', 'create');
INSERT INTO `functional` VALUES ('19', 'Cập nhật tác giả', 'http://phimbathu.com/admin/director/update', 'director', 'update');
INSERT INTO `functional` VALUES ('20', 'Xem chi tiết thể loại', 'http://phimbathu.com/admin/category/view', 'category', 'view');
INSERT INTO `functional` VALUES ('21', 'Xem chi tiết quốc gia', 'http://phimbathu.com/admin/city/view', 'city', 'view');
INSERT INTO `functional` VALUES ('22', 'Xem chi tiết diễn viên', 'http://phimbathu.com/admin/actor/view', 'actor', 'view');
INSERT INTO `functional` VALUES ('23', 'Xem chi tiết tác giả', 'http://phimbathu.com/admin/director/view', 'director', 'view');
INSERT INTO `functional` VALUES ('24', 'Xem chi tiết phim', 'http://localhost:2036/admin/film/view', 'film', 'view');
INSERT INTO `functional` VALUES ('25', 'Xem chi tiết tags', 'http://localhost:2036/admin/tag/view', 'tag', 'view');
INSERT INTO `functional` VALUES ('26', 'Xem chi tiết user', 'http://localhost:2036/admin/user/view', 'user', 'view');
INSERT INTO `functional` VALUES ('27', 'Xem widget', 'http://localhost:2036/admin/widget/view', 'widget', 'view');
INSERT INTO `functional` VALUES ('28', 'Xem webconfig', 'http://localhost:2036/admin/webconfig/view', 'webconfig', 'view');
INSERT INTO `functional` VALUES ('29', 'Quản lý tài khoản admin', 'http://phimbathu.com/admin/member/admin', 'member', 'admin');
INSERT INTO `functional` VALUES ('30', 'Thêm mới tài khoản admin', 'http://phimbathu.com/admin/member/create', 'member', 'create');
INSERT INTO `functional` VALUES ('31', 'Quản lý user', 'http://phimbathu.com/admin/user/admin', 'user', 'admin');
INSERT INTO `functional` VALUES ('32', 'Quản lý webconfig', 'http://localhost:2036/admin/webconfig/admin', 'webconfig', 'admin');
INSERT INTO `functional` VALUES ('33', 'Xóa user', 'http://localhost:2036/admin/user/delete', 'user', 'delete');
INSERT INTO `functional` VALUES ('34', 'Cập nhật webconfig', 'http://localhost:2036/admin/webconfig/update', 'webconfig', 'update');
INSERT INTO `functional` VALUES ('35', 'Thêm mới nhóm admin', 'http://phimbathu.com/admin/groups/create', 'groups', 'create');
INSERT INTO `functional` VALUES ('36', 'Xem chi tiết nhóm', 'http://phimbathu.com/admin/groups/view', 'groups', 'view');
INSERT INTO `functional` VALUES ('37', 'Cập nhật thông tin tài khoản admin', 'http://phimbathu.com/admin/member/update', 'member', 'update');
INSERT INTO `functional` VALUES ('38', 'Cập nhật thông tin nhóm', 'http://localhost:2036/admin/groups/update', 'groups', 'update');
INSERT INTO `functional` VALUES ('39', 'Upload ảnh cho phim', 'http://phimbathu.com/admin/film/uploadimage', 'film', 'uploadimage');
INSERT INTO `functional` VALUES ('40', 'Thêm link nhanh', 'http://phimbathu.com/admin/film/AddLinkQuickly', 'film', 'AddLinkQuickly');
INSERT INTO `functional` VALUES ('41', 'Quản lý phim người dùng upload', 'http://phimbathu.com/admin/filmupload/admin', 'filmupload', 'admin');
INSERT INTO `functional` VALUES ('42', 'Duyệt phim upload', 'http://phimbathu.com/admin/filmupload/update', 'filmupload', 'update');
INSERT INTO `functional` VALUES ('43', 'Tìm kiếm tag', 'http://phimbathu.com/admin/tag/autocomplete', 'tag', 'autocomplete');
INSERT INTO `functional` VALUES ('44', 'Thêm nhanh tag', 'http://phimbathu.com/admin/tag/QuickAdd', 'tag', 'QuickAdd');
INSERT INTO `functional` VALUES ('45', 'Tìm kiếm diễn viên', 'http://phimbathu.com/admin/actor/autocomplete', 'actor', 'autocomplete');
INSERT INTO `functional` VALUES ('46', 'Thêm nhanh diễn viên', 'http://phimbathu.com/admin/actor/quickadd', 'actor', 'quickadd');
INSERT INTO `functional` VALUES ('47', 'Tìm kiếm tác giả', 'http://phimbathu.com/admin/director/autocomplete', 'director', 'autocomplete');
INSERT INTO `functional` VALUES ('48', 'Thêm nhanh tác giả', 'http://phimbathu.com/admin/director/quickadd', 'director', 'quickadd');
INSERT INTO `functional` VALUES ('49', 'Tìm kiếm phim', 'http://phimbathu.com/admin/film/autocomplete', 'film', 'autocomplete');
INSERT INTO `functional` VALUES ('50', 'Quản lý quảng cáo', 'http://localhost:2028/admin/ads/admin', 'ads', 'admin');

-- ----------------------------
-- Table structure for group_functional
-- ----------------------------
DROP TABLE IF EXISTS `group_functional`;
CREATE TABLE `group_functional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `functional_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=828 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group_functional
-- ----------------------------
INSERT INTO `group_functional` VALUES ('372', '3', '1');
INSERT INTO `group_functional` VALUES ('373', '3', '4');
INSERT INTO `group_functional` VALUES ('374', '3', '8');
INSERT INTO `group_functional` VALUES ('375', '3', '14');
INSERT INTO `group_functional` VALUES ('376', '3', '16');
INSERT INTO `group_functional` VALUES ('377', '3', '24');
INSERT INTO `group_functional` VALUES ('720', '1', '1');
INSERT INTO `group_functional` VALUES ('721', '1', '2');
INSERT INTO `group_functional` VALUES ('722', '1', '3');
INSERT INTO `group_functional` VALUES ('723', '1', '4');
INSERT INTO `group_functional` VALUES ('724', '1', '5');
INSERT INTO `group_functional` VALUES ('725', '1', '6');
INSERT INTO `group_functional` VALUES ('726', '1', '7');
INSERT INTO `group_functional` VALUES ('727', '1', '8');
INSERT INTO `group_functional` VALUES ('728', '1', '9');
INSERT INTO `group_functional` VALUES ('729', '1', '10');
INSERT INTO `group_functional` VALUES ('730', '1', '11');
INSERT INTO `group_functional` VALUES ('731', '1', '12');
INSERT INTO `group_functional` VALUES ('732', '1', '13');
INSERT INTO `group_functional` VALUES ('733', '1', '14');
INSERT INTO `group_functional` VALUES ('734', '1', '15');
INSERT INTO `group_functional` VALUES ('735', '1', '16');
INSERT INTO `group_functional` VALUES ('736', '1', '17');
INSERT INTO `group_functional` VALUES ('737', '1', '18');
INSERT INTO `group_functional` VALUES ('738', '1', '19');
INSERT INTO `group_functional` VALUES ('739', '1', '20');
INSERT INTO `group_functional` VALUES ('740', '1', '21');
INSERT INTO `group_functional` VALUES ('741', '1', '22');
INSERT INTO `group_functional` VALUES ('742', '1', '23');
INSERT INTO `group_functional` VALUES ('743', '1', '24');
INSERT INTO `group_functional` VALUES ('744', '1', '25');
INSERT INTO `group_functional` VALUES ('745', '1', '26');
INSERT INTO `group_functional` VALUES ('746', '1', '27');
INSERT INTO `group_functional` VALUES ('747', '1', '28');
INSERT INTO `group_functional` VALUES ('748', '1', '29');
INSERT INTO `group_functional` VALUES ('749', '1', '30');
INSERT INTO `group_functional` VALUES ('750', '1', '31');
INSERT INTO `group_functional` VALUES ('751', '1', '32');
INSERT INTO `group_functional` VALUES ('752', '1', '33');
INSERT INTO `group_functional` VALUES ('753', '1', '34');
INSERT INTO `group_functional` VALUES ('754', '1', '35');
INSERT INTO `group_functional` VALUES ('755', '1', '36');
INSERT INTO `group_functional` VALUES ('756', '1', '37');
INSERT INTO `group_functional` VALUES ('757', '1', '38');
INSERT INTO `group_functional` VALUES ('758', '1', '39');
INSERT INTO `group_functional` VALUES ('759', '1', '40');
INSERT INTO `group_functional` VALUES ('760', '1', '41');
INSERT INTO `group_functional` VALUES ('761', '1', '42');
INSERT INTO `group_functional` VALUES ('762', '1', '43');
INSERT INTO `group_functional` VALUES ('763', '1', '44');
INSERT INTO `group_functional` VALUES ('764', '1', '45');
INSERT INTO `group_functional` VALUES ('765', '1', '46');
INSERT INTO `group_functional` VALUES ('766', '1', '47');
INSERT INTO `group_functional` VALUES ('767', '1', '48');
INSERT INTO `group_functional` VALUES ('768', '1', '49');
INSERT INTO `group_functional` VALUES ('769', '2', '1');
INSERT INTO `group_functional` VALUES ('770', '2', '4');
INSERT INTO `group_functional` VALUES ('771', '2', '5');
INSERT INTO `group_functional` VALUES ('772', '2', '6');
INSERT INTO `group_functional` VALUES ('773', '2', '7');
INSERT INTO `group_functional` VALUES ('774', '2', '8');
INSERT INTO `group_functional` VALUES ('775', '2', '9');
INSERT INTO `group_functional` VALUES ('776', '2', '10');
INSERT INTO `group_functional` VALUES ('777', '2', '11');
INSERT INTO `group_functional` VALUES ('778', '2', '12');
INSERT INTO `group_functional` VALUES ('779', '2', '13');
INSERT INTO `group_functional` VALUES ('780', '2', '14');
INSERT INTO `group_functional` VALUES ('781', '2', '15');
INSERT INTO `group_functional` VALUES ('782', '2', '16');
INSERT INTO `group_functional` VALUES ('783', '2', '17');
INSERT INTO `group_functional` VALUES ('784', '2', '18');
INSERT INTO `group_functional` VALUES ('785', '2', '19');
INSERT INTO `group_functional` VALUES ('786', '2', '20');
INSERT INTO `group_functional` VALUES ('787', '2', '21');
INSERT INTO `group_functional` VALUES ('788', '2', '22');
INSERT INTO `group_functional` VALUES ('789', '2', '23');
INSERT INTO `group_functional` VALUES ('790', '2', '24');
INSERT INTO `group_functional` VALUES ('791', '2', '25');
INSERT INTO `group_functional` VALUES ('792', '2', '39');
INSERT INTO `group_functional` VALUES ('793', '2', '43');
INSERT INTO `group_functional` VALUES ('794', '2', '44');
INSERT INTO `group_functional` VALUES ('795', '2', '45');
INSERT INTO `group_functional` VALUES ('796', '2', '46');
INSERT INTO `group_functional` VALUES ('797', '2', '47');
INSERT INTO `group_functional` VALUES ('798', '2', '48');
INSERT INTO `group_functional` VALUES ('799', '2', '49');
INSERT INTO `group_functional` VALUES ('800', '3', '1');
INSERT INTO `group_functional` VALUES ('801', '3', '5');
INSERT INTO `group_functional` VALUES ('802', '3', '6');
INSERT INTO `group_functional` VALUES ('803', '3', '7');
INSERT INTO `group_functional` VALUES ('804', '3', '8');
INSERT INTO `group_functional` VALUES ('805', '3', '9');
INSERT INTO `group_functional` VALUES ('806', '3', '10');
INSERT INTO `group_functional` VALUES ('807', '3', '11');
INSERT INTO `group_functional` VALUES ('808', '3', '12');
INSERT INTO `group_functional` VALUES ('809', '3', '13');
INSERT INTO `group_functional` VALUES ('810', '3', '14');
INSERT INTO `group_functional` VALUES ('811', '3', '15');
INSERT INTO `group_functional` VALUES ('812', '3', '16');
INSERT INTO `group_functional` VALUES ('813', '3', '17');
INSERT INTO `group_functional` VALUES ('814', '3', '18');
INSERT INTO `group_functional` VALUES ('815', '3', '19');
INSERT INTO `group_functional` VALUES ('816', '3', '22');
INSERT INTO `group_functional` VALUES ('817', '3', '23');
INSERT INTO `group_functional` VALUES ('818', '3', '24');
INSERT INTO `group_functional` VALUES ('819', '3', '25');
INSERT INTO `group_functional` VALUES ('820', '3', '39');
INSERT INTO `group_functional` VALUES ('821', '3', '43');
INSERT INTO `group_functional` VALUES ('822', '3', '44');
INSERT INTO `group_functional` VALUES ('823', '3', '45');
INSERT INTO `group_functional` VALUES ('824', '3', '46');
INSERT INTO `group_functional` VALUES ('825', '3', '47');
INSERT INTO `group_functional` VALUES ('826', '3', '48');
INSERT INTO `group_functional` VALUES ('827', '3', '49');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Supper admin', '');
INSERT INTO `groups` VALUES ('2', 'Admin', '');
INSERT INTO `groups` VALUES ('3', 'Cộng tác viên', 'Cộng tác viên');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'CTB', 'admin', '2570949c64339542ac0a1068840742e4', '', '', '1', '', '1', '1', '0000-00-00', null);
INSERT INTO `member` VALUES ('3', 'Nam PV', 'nampv', 'dcc21b67ccc9cfb4c4359b07e58e4f74', null, '', '1', null, '1', '1', null, null);
INSERT INTO `member` VALUES ('15', 'nam', 'nam', '202cb962ac59075b964b07152d234b70', null, '', '0', null, '0', '10', null, null);
INSERT INTO `member` VALUES ('16', 'Chinh', 'tavanchinh', '2570949c64339542ac0a1068840742e4', null, '', '0', null, '1', '10', null, null);
INSERT INTO `member` VALUES ('17', 'content', 'content', 'a8ee4e022344282a8d9baf5b2090469c', null, '', '0', null, '1', '10', null, null);
INSERT INTO `member` VALUES ('18', 'TVC', 'tavanchinh91', '2570949c64339542ac0a1068840742e4', null, '', '0', null, '1', '10', null, null);
INSERT INTO `member` VALUES ('19', 'content2', 'content2', 'a8ee4e022344282a8d9baf5b2090469c', null, '', '0', null, '1', '10', null, null);
INSERT INTO `member` VALUES ('20', 'content3', 'content3', 'a8ee4e022344282a8d9baf5b2090469c', null, '', '0', null, '1', '10', null, null);
INSERT INTO `member` VALUES ('21', 'noidung', 'noidung', 'a8ee4e022344282a8d9baf5b2090469c', null, '', '0', null, '1', '10', null, null);
INSERT INTO `member` VALUES ('22', 'hungpn', 'hungpn', '97eaea930e4ca12d7ac181567f747d34', null, '', '0', null, '1', '10', null, null);
INSERT INTO `member` VALUES ('23', 'Tạ Văn Chinh', 'ctv_tvc', '2570949c64339542ac0a1068840742e4', null, '', '0', null, '1', '10', null, null);

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
INSERT INTO `member_group` VALUES ('3', '1');
INSERT INTO `member_group` VALUES ('15', '2');
INSERT INTO `member_group` VALUES ('16', '2');
INSERT INTO `member_group` VALUES ('17', '2');
INSERT INTO `member_group` VALUES ('18', '2');
INSERT INTO `member_group` VALUES ('19', '2');
INSERT INTO `member_group` VALUES ('20', '2');
INSERT INTO `member_group` VALUES ('21', '1');
INSERT INTO `member_group` VALUES ('21', '2');
INSERT INTO `member_group` VALUES ('22', '1');
INSERT INTO `member_group` VALUES ('22', '2');
INSERT INTO `member_group` VALUES ('23', '3');
