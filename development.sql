/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50612
Source Host           : 127.0.0.1:3306
Source Database       : development

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-05-01 20:02:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_code` varchar(32) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='User login information';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'kalpa', '1d35c65407dd6fc56872f0bbd8c4e298', 'kalpa', 'Perera', 'kalpa@gmail.com', '10fdb54531e64da1d73f173e7a6278f0', '1');
INSERT INTO `user` VALUES ('2', 'kasun', '031110d8a7024dfcbf57eedda7c9dac9', 'Kasun', 'Perera', 'kasun@gmail.com', '7a9e2b3c05cfc358c3ea422b8f7ef6dc', '1');
INSERT INTO `user` VALUES ('3', 'kumara', '9e063e37e13e17c942a9afd9c4375e2e', 'Kumara', 'Perera', 'kumara@gmail.com', 'ccd3b1db1872cbdfa6a8972c6410e043', '1');
