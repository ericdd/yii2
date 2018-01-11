/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yii2

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-11 16:29:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog
-- ----------------------------
INSERT INTO `blog` VALUES ('1', 'Yii2 Model的一些常用rules规则', '提示：打印出Validator::$builtInValidators可以看到被支持的所有validators', '2018-01-11 16:04:50');
INSERT INTO `blog` VALUES ('2', '市场研究机构 Counterpoinxxx', '市场研究机构 Counterpoint 日前对 2017 年三季度各手机厂商的利润进行了调查。数据显示，苹果手机单台利润高达 1', '2018-01-11 16:22:19');
INSERT INTO `blog` VALUES ('6', 'a', 'aass', '2018-01-11 16:24:38');
INSERT INTO `blog` VALUES ('5', 'Yii2之设置默认值', '1.在模型中的rules方法中定义默认值，这个默认值是当提交的数据没有值得情况下生效。而在页面的js检测是不会与这发生关系的，在页面中设置默认值请往下看。', '2018-01-11 16:14:55');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1515640255');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1515640260');
INSERT INTO `migration` VALUES ('m180111_065008_create_blog_table', '1515653534');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'nolan', 'YN2FIFdWlB63FRw2h-vaeTggqzjRdZ7G', '$2y$13$A7EjXlpjCknve5ZS5T8doOUzy8g3M66PfqRm.6CkHkeSiWYoBKzJW', null, '260741887@qq.com', '10', '1515640387', '1515640387');
