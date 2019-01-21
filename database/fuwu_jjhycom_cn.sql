/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : fuwu_jjhycom_cn

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-12-29 17:33:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for check_workyard_records
-- ----------------------------
DROP TABLE IF EXISTS `check_workyard_records`;
CREATE TABLE `check_workyard_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workyard_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `checked_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of check_workyard_records
-- ----------------------------
INSERT INTO `check_workyard_records` VALUES ('6', '6', 'ENABLED', 'ok', 'admin', '2018-12-14 10:26:44', '2018-12-14 10:26:44');
INSERT INTO `check_workyard_records` VALUES ('7', '4', 'CHECK_FAILED', 'failed', 'admin', '2018-12-14 10:29:34', '2018-12-14 10:29:34');
INSERT INTO `check_workyard_records` VALUES ('8', '1', 'ENABLED', 'sdfs', 'admin', '2018-12-14 10:33:40', '2018-12-14 10:33:40');
INSERT INTO `check_workyard_records` VALUES ('9', '2', 'ENABLED', '', 'admin', '2018-12-14 11:18:08', '2018-12-14 11:18:08');
INSERT INTO `check_workyard_records` VALUES ('10', '3', 'ENABLED', '', 'admin', '2018-12-14 11:23:30', '2018-12-14 11:23:30');
INSERT INTO `check_workyard_records` VALUES ('11', '22', 'ENABLED', '', 'admin', '2018-12-19 11:43:11', '2018-12-19 11:43:11');
INSERT INTO `check_workyard_records` VALUES ('12', '22', 'ENABLED', 'hahhh', 'admin', '2018-12-19 14:01:09', '2018-12-19 14:01:09');
INSERT INTO `check_workyard_records` VALUES ('13', '22', 'CHECK_FAILED', 'sfsdfdsf', 'admin', '2018-12-19 14:02:50', '2018-12-19 14:02:50');
INSERT INTO `check_workyard_records` VALUES ('14', '22', 'ENABLED', '', 'admin', '2018-12-19 14:14:55', '2018-12-19 14:14:55');
INSERT INTO `check_workyard_records` VALUES ('15', '31', 'ENABLED', '', 'admin', '2018-12-28 16:13:58', '2018-12-28 16:13:58');
INSERT INTO `check_workyard_records` VALUES ('16', '30', 'ENABLED', '', 'admin', '2018-12-28 16:16:28', '2018-12-28 16:16:28');
INSERT INTO `check_workyard_records` VALUES ('17', '29', 'ENABLED', '', 'admin', '2018-12-28 16:26:03', '2018-12-28 16:26:03');
INSERT INTO `check_workyard_records` VALUES ('18', '31', 'ENABLED', '', 'admin', '2018-12-28 16:27:00', '2018-12-28 16:27:00');
INSERT INTO `check_workyard_records` VALUES ('19', '29', 'ENABLED', '', 'admin', '2018-12-28 16:28:41', '2018-12-28 16:28:41');
INSERT INTO `check_workyard_records` VALUES ('20', '30', 'ENABLED', '', 'admin', '2018-12-28 16:29:25', '2018-12-28 16:29:25');
INSERT INTO `check_workyard_records` VALUES ('21', '31', 'ENABLED', '', 'admin', '2018-12-28 16:29:51', '2018-12-28 16:29:51');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_12_04_163831_websites', '2');
INSERT INTO `migrations` VALUES ('4', '2018_12_05_085951_websites', '3');
INSERT INTO `migrations` VALUES ('5', '2018_12_05_144246_add_to_users', '4');
INSERT INTO `migrations` VALUES ('6', '2018_12_11_150603_create_item_types_tables', '5');
INSERT INTO `migrations` VALUES ('7', '2018_12_12_152813_create_workyards_table', '6');
INSERT INTO `migrations` VALUES ('9', '2018_12_13_090609_create_checked_workyard_table', '7');
INSERT INTO `migrations` VALUES ('10', '2018_12_14_163521_create_oauth_table', '8');
INSERT INTO `migrations` VALUES ('13', '2018_12_18_131520_create_workyard_user_table', '9');
INSERT INTO `migrations` VALUES ('14', '2018_12_19_151725_create_repair_orders_table', '10');
INSERT INTO `migrations` VALUES ('23', '2018_12_20_142317_create_status_user_table', '11');
INSERT INTO `migrations` VALUES ('24', '2018_12_20_142330_create_status_workyard_table', '11');
INSERT INTO `migrations` VALUES ('25', '2018_12_20_142400_create_status_repair_order_table', '11');
INSERT INTO `migrations` VALUES ('26', '2018_12_20_142420_create_grade_repair_order_table', '11');
INSERT INTO `migrations` VALUES ('27', '2018_12_20_172002_create_offers_table', '12');
INSERT INTO `migrations` VALUES ('28', '2018_12_20_172340_create_offers_status_table', '12');
INSERT INTO `migrations` VALUES ('29', '2018_12_21_114511_create_settings_table', '13');
INSERT INTO `migrations` VALUES ('30', '2018_12_21_114550_create_role_table', '13');
INSERT INTO `migrations` VALUES ('33', '2018_12_21_165457_create_user_role_status_table', '14');
INSERT INTO `migrations` VALUES ('34', '2018_12_24_092847_create_role_status_table', '14');
INSERT INTO `migrations` VALUES ('35', '2018_12_24_130749_create_skills_table', '15');

-- ----------------------------
-- Table structure for oauth
-- ----------------------------
DROP TABLE IF EXISTS `oauth`;
CREATE TABLE `oauth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of oauth
-- ----------------------------
INSERT INTO `oauth` VALUES ('9', 'WEIXIN', 'o7qaF0qSp7_PFvqalZLJ3mcGFBSU', '23', '2018-12-21 17:09:10', '2018-12-21 17:09:10');

-- ----------------------------
-- Table structure for offers
-- ----------------------------
DROP TABLE IF EXISTS `offers`;
CREATE TABLE `offers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `repair_order_id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `days` decimal(8,1) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of offers
-- ----------------------------
INSERT INTO `offers` VALUES ('19', '23', '2', '12.00', '33.0', 'FAILED', '2018-12-26 12:14:04', '2018-12-26 14:14:59');

-- ----------------------------
-- Table structure for offers_status
-- ----------------------------
DROP TABLE IF EXISTS `offers_status`;
CREATE TABLE `offers_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of offers_status
-- ----------------------------
INSERT INTO `offers_status` VALUES ('1', 'WAIT_CONFIRM', '待确认');
INSERT INTO `offers_status` VALUES ('2', 'REFUSEED', '被拒绝');
INSERT INTO `offers_status` VALUES ('3', 'CONFIRMED', '报价成功');
INSERT INTO `offers_status` VALUES ('4', 'FAILED', '报价失败');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for repair_orders
-- ----------------------------
DROP TABLE IF EXISTS `repair_orders`;
CREATE TABLE `repair_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `workyard_id` int(11) NOT NULL,
  `repair_type_id` int(11) NOT NULL,
  `desc` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `contact_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `offer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `days` decimal(8,1) NOT NULL DEFAULT '0.0' COMMENT '维修天数',
  `worker_id` int(10) unsigned NOT NULL DEFAULT '0',
  `confirmed_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '报价确认或分配维修工时间',
  `completed_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of repair_orders
-- ----------------------------
INSERT INTO `repair_orders` VALUES ('2', '15453632982325', 'WORKING', '23', '31', '3', 'sfsd', '是的', '13001030857', '3_URGENT', '2018-12-21 11:34:58', '2018-12-27 15:14:14', '0', '0.0', '23', '2018-12-28 10:15:59', '2018-12-28 10:15:58');
INSERT INTO `repair_orders` VALUES ('4', '1181221130144556', 'WORKING', '23', '31', '4', '', 'name', '13001030857', '3_URGENT', '2018-12-21 13:01:44', '2018-12-28 15:51:08', '4', '0.0', '23', '2018-12-28 15:51:08', '2018-12-28 15:51:08');
INSERT INTO `repair_orders` VALUES ('5', 'wer', 'WAIT_DISTRIBUTE', '23', '31', '4', '', 'sdf', '13001030857', '3_URGENT', null, '2018-12-27 15:21:18', '0', '0.0', '0', '2018-12-28 15:57:59', '2018-12-28 15:57:59');
INSERT INTO `repair_orders` VALUES ('6', 'w', 'WAIT_DISTRIBUTE', '23', '30', '4', '很骄傲和附近的京津冀很骄傲返回键第三方或附近的加了哈飞机撒电话交换机放寒假回家甲方和机顶盒', '12', '13001030857', '3_URGENT', '2018-12-28 15:45:03', '2018-12-28 15:53:07', '0', '0.0', '23', '2018-12-28 15:57:57', '2018-12-28 15:57:57');
INSERT INTO `repair_orders` VALUES ('7', '12', 'WORKING', '23', '30', '4', '12', '12', '13001030857', '3_URGENT', null, '2018-12-28 16:03:45', '0', '0.0', '24', '2018-12-28 16:03:45', '2018-12-28 16:03:45');
INSERT INTO `repair_orders` VALUES ('8', 'd', 'WAIT_DISTRIBUTE', '23', '31', '4', '12', '12', '13001030857', '3_URGENT', null, '2018-12-27 15:50:41', '0', '0.0', '0', '2018-12-28 15:57:55', '2018-12-28 15:57:55');
INSERT INTO `repair_orders` VALUES ('9', '1181226142045731', 'WAIT_DISTRIBUTE', '23', '29', '3', '阿道夫', '秦崇', '13001030857', '2_GENERAL_', '2018-12-26 14:20:45', '2018-12-28 15:53:36', '0', '0.0', '23', '2018-12-28 15:57:53', '2018-12-28 15:57:53');
INSERT INTO `repair_orders` VALUES ('10', '1181226144411143', 'WAIT_DISTRIBUTE', '23', '29', '2', 'sdf', '秦崇', '15313715521', '1_NOT_URGENT', '2018-12-26 14:44:11', '2018-12-27 15:23:18', '0', '0.0', '0', '2018-12-28 15:57:52', '2018-12-28 15:57:52');
INSERT INTO `repair_orders` VALUES ('11', '1181226144957149', 'WAIT_DISTRIBUTE', '23', '29', '4', '12323', '12', '13001030857', '2_GENERAL_', '2018-12-26 14:49:57', '2018-12-28 15:54:04', '0', '0.0', '23', '2018-12-28 15:57:49', '2018-12-28 15:57:49');

-- ----------------------------
-- Table structure for repair_order_grade
-- ----------------------------
DROP TABLE IF EXISTS `repair_order_grade`;
CREATE TABLE `repair_order_grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of repair_order_grade
-- ----------------------------
INSERT INTO `repair_order_grade` VALUES ('1', '1_NOT_URGENT', '不紧急');
INSERT INTO `repair_order_grade` VALUES ('2', '2_GENERAL_', '一般');
INSERT INTO `repair_order_grade` VALUES ('3', '3_URGENT', '紧急');
INSERT INTO `repair_order_grade` VALUES ('4', '4_VERY_URGENT', '非常紧急');

-- ----------------------------
-- Table structure for repair_order_status
-- ----------------------------
DROP TABLE IF EXISTS `repair_order_status`;
CREATE TABLE `repair_order_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of repair_order_status
-- ----------------------------
INSERT INTO `repair_order_status` VALUES ('1', 'WAIR_WORKER', '报价中');
INSERT INTO `repair_order_status` VALUES ('2', 'WORKING', '维修中');
INSERT INTO `repair_order_status` VALUES ('3', 'COMPLETED', '维修完成');
INSERT INTO `repair_order_status` VALUES ('4', 'CLOSED', '已关闭');
INSERT INTO `repair_order_status` VALUES ('5', 'WAIT_DISTRIBUTE', '待系统派单');

-- ----------------------------
-- Table structure for repair_types
-- ----------------------------
DROP TABLE IF EXISTS `repair_types`;
CREATE TABLE `repair_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of repair_types
-- ----------------------------
INSERT INTO `repair_types` VALUES ('2', '1sf', null, '2018-12-12 11:08:09', 'sdf');
INSERT INTO `repair_types` VALUES ('3', '中文', null, '2018-12-12 13:52:54', 'dfg');
INSERT INTO `repair_types` VALUES ('4', '1233cc', '2018-12-11 16:41:06', '2018-12-11 16:41:06', '12312');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'GUEST', '游客');
INSERT INTO `roles` VALUES ('2', 'SUPER_USER', '超级管理员');
INSERT INTO `roles` VALUES ('3', 'WORKYARD_ADMIN', '项目管理员');
INSERT INTO `roles` VALUES ('4', 'WORKER', '维修工');

-- ----------------------------
-- Table structure for role_status
-- ----------------------------
DROP TABLE IF EXISTS `role_status`;
CREATE TABLE `role_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`desc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_status
-- ----------------------------
INSERT INTO `role_status` VALUES ('1', 'WORKER_ENABLED', '正常');
INSERT INTO `role_status` VALUES ('2', 'WORKER_FORBIDDEN', '禁用');
INSERT INTO `role_status` VALUES ('3', 'WORKER_WAIT_INIT', '等待注册');
INSERT INTO `role_status` VALUES ('4', 'WORKYARD_ADMIN_ENABLED', '正常');
INSERT INTO `role_status` VALUES ('5', 'WORKYARD_ADMIN_FORBIDDEN', '禁用');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `worker_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`role`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('13', '23', 'WORKER', 'WORKER_ENABLED', '2018-12-28 17:06:11', '2018-12-28 17:06:11', 'FULL_TIME');
INSERT INTO `role_user` VALUES ('14', '23', 'WORKYARD_ADMIN', 'WORKYARD_ADMIN_FORBIDDEN', '2018-12-28 14:05:36', '2018-12-28 14:05:36', '');
INSERT INTO `role_user` VALUES ('15', '24', 'WORKER', 'WORKER_ENABLED', '2018-12-28 17:04:08', '2018-12-28 17:04:08', 'PART_TIME');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'need_check_workyard_on_create', 'yes', '2018-12-21 11:47:53', '2018-12-21 12:12:31');
INSERT INTO `settings` VALUES ('2', 'can_offer_repair_order', 'yes', '2018-12-21 11:56:03', '2018-12-26 14:21:16');

-- ----------------------------
-- Table structure for skills
-- ----------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `skill` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of skills
-- ----------------------------
INSERT INTO `skills` VALUES ('4', '23', '1212qwqw1212qwqw1212qwqw1212qwqw', '2018-12-24 13:40:53', '2018-12-24 14:35:27');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `realname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tel` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `workyard_id` int(10) unsigned NOT NULL DEFAULT '0',
  `province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `district` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '1250857765@qq.com', null, '$2y$10$jxOXjfI5msN60e.0kUWND.NYl9DkmS3hBPvWEgZpINzMIQHiR7//6', 'C93Lwd8ZP66A3toKna5n3YuDKFoJjhSAVEHueVM8inQTjW0jMjxLUqMf7DRB', '2018-12-06 09:42:37', '2018-12-11 14:53:36', '/storage/avatar/1/6ETSaIDEOyyxaOgfc1o8Ow8edNLMSzCSWB4WPxcb.jpeg', 'SUPER_USER', '秦崇', '15313715521', '0', null, null, null);
INSERT INTO `users` VALUES ('23', 'o7qaF0qSp7_PFvqalZLJ3mcGFBSU', '', null, '', 'PdEghnZSSA706wRWv3phIiHaUE0UErSVNgVp2TkWsCxfHgQu1UCqFiCYxv2X', '2018-12-18 14:33:32', '2018-12-26 14:52:17', '', 'WORKYARD_ADMIN', 'asdsd', '13001030857', '30', '110000', '110000', '110101');
INSERT INTO `users` VALUES ('24', 'werw', '', null, '', null, null, null, '', 'WORKER', '41545454', '454545454', '0', null, '', '');

-- ----------------------------
-- Table structure for user_workyard
-- ----------------------------
DROP TABLE IF EXISTS `user_workyard`;
CREATE TABLE `user_workyard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workyard_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_workyard
-- ----------------------------
INSERT INTO `user_workyard` VALUES ('1', '1', '2');
INSERT INTO `user_workyard` VALUES ('6', '25', '23');
INSERT INTO `user_workyard` VALUES ('7', '23', '23');
INSERT INTO `user_workyard` VALUES ('8', '26', '23');
INSERT INTO `user_workyard` VALUES ('9', '27', '23');
INSERT INTO `user_workyard` VALUES ('10', '28', '23');
INSERT INTO `user_workyard` VALUES ('11', '29', '23');
INSERT INTO `user_workyard` VALUES ('12', '30', '23');
INSERT INTO `user_workyard` VALUES ('13', '31', '23');

-- ----------------------------
-- Table structure for websites
-- ----------------------------
DROP TABLE IF EXISTS `websites`;
CREATE TABLE `websites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `record` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ico` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`website`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of websites
-- ----------------------------
INSERT INTO `websites` VALUES ('1', 'admin', '工地派单', '备案信息s许昌', '/storage/website/admin/ico/D7KniElqxv95vQlUuuaQskPBTU4kTN1KIYQXa7dl.ico', null, '2018-12-26 15:54:21', '');

-- ----------------------------
-- Table structure for worker_types
-- ----------------------------
DROP TABLE IF EXISTS `worker_types`;
CREATE TABLE `worker_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of worker_types
-- ----------------------------
INSERT INTO `worker_types` VALUES ('1', 'PART_TIME', '兼职');
INSERT INTO `worker_types` VALUES ('2', 'FULL_TIME', '全职');

-- ----------------------------
-- Table structure for workyards
-- ----------------------------
DROP TABLE IF EXISTS `workyards`;
CREATE TABLE `workyards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `workyards_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of workyards
-- ----------------------------
INSERT INTO `workyards` VALUES ('29', 'qwq', 'qw', 'qw', '0', 'ENABLED', '2018-12-25 13:20:31', '2018-12-28 16:28:41', '110000', '110100', '110101');
INSERT INTO `workyards` VALUES ('30', 'ceshi', '', 'adfdf', '0', 'ENABLED', '2018-12-25 13:31:15', '2018-12-28 16:29:25', '220000', '220100', '220102');
INSERT INTO `workyards` VALUES ('31', 'sfsfs', '', 'sdfds', '0', 'ENABLED', '2018-12-25 13:36:19', '2018-12-28 16:33:01', '110000', '110100', '110101');

-- ----------------------------
-- Table structure for workyard_status
-- ----------------------------
DROP TABLE IF EXISTS `workyard_status`;
CREATE TABLE `workyard_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of workyard_status
-- ----------------------------
INSERT INTO `workyard_status` VALUES ('1', 'WAIT_CHECK', '待审核');
INSERT INTO `workyard_status` VALUES ('2', 'CHECK_FAILED', '审核失败');
INSERT INTO `workyard_status` VALUES ('3', 'ENABLED', '正常');
INSERT INTO `workyard_status` VALUES ('4', 'FORBIDDEN', '已禁用');
