/*
 Navicat MySQL Data Transfer

 Source Server         : dockerTest
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 22/02/2021 14:03:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_user_list
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_list`;
CREATE TABLE `admin_user_list` (
  `adminId` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `adminName` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '昵称',
  `adminAccount` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '账号',
  `adminPassword` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '密码',
  `addTime` int DEFAULT NULL COMMENT '创建时间',
  `lastLoginTime` int DEFAULT NULL COMMENT '上次登陆的时间',
  `lastLoginIp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '上次登陆的Ip',
  `adminSession` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`adminId`) USING BTREE,
  UNIQUE KEY `adminAccount` (`adminAccount`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='管理员列表';

-- ----------------------------
-- Records of admin_user_list
-- ----------------------------
BEGIN;
INSERT INTO `admin_user_list` VALUES (60, '单元测试用户', 'unitTest', 'e10adc3949ba59abbe56e057f20f883e', NULL, 1605519240, '127.0.0.1', '1hiEXFd7Jbo4VsR28Pez9SlfyWajNBYG');
INSERT INTO `admin_user_list` VALUES (61, '测试文本oOte0M', '测试文本J5ujXL', '测试文本iZ7TlA', 1, 0, '测试文本PAMgxr', '测试文本Woe1wB');
INSERT INTO `admin_user_list` VALUES (62, '测试文本KH5Aym', '测试文本hdXPxs', '测试文本Ck57UX', 1, 1, '测试文本D9ebRn', '测试文本QjJhM0');
INSERT INTO `admin_user_list` VALUES (63, '测试文本IfSEXk', '测试文本XHAfea', '测试文本zxiQw4', 0, 2, '测试文本TPH1sZ', '测试文本uAYKFi');
COMMIT;

-- ----------------------------
-- Table structure for article_category_list
-- ----------------------------
DROP TABLE IF EXISTS `article_category_list`;
CREATE TABLE `article_category_list` (
  `categoryId` int unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `categoryName` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '分类名称',
  `pid` int unsigned NOT NULL COMMENT '父级分类id',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`categoryId`) USING BTREE,
  KEY `categoryName` (`categoryName`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of article_category_list
-- ----------------------------
BEGIN;
INSERT INTO `article_category_list` VALUES (1, '1001', 0, '0');
INSERT INTO `article_category_list` VALUES (103, '1002', 0, '444');
INSERT INTO `article_category_list` VALUES (106, '123', 0, '1');
INSERT INTO `article_category_list` VALUES (137, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (138, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (150, '1111', 0, '0');
INSERT INTO `article_category_list` VALUES (152, '10025840', 0, '444');
INSERT INTO `article_category_list` VALUES (153, '1111', 0, '0');
INSERT INTO `article_category_list` VALUES (154, '1111', 0, '0');
INSERT INTO `article_category_list` VALUES (156, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (157, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (158, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (159, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (160, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (161, '1111', 0, '0');
INSERT INTO `article_category_list` VALUES (163, '10023428', 0, '444');
INSERT INTO `article_category_list` VALUES (164, '1111', 0, '0');
INSERT INTO `article_category_list` VALUES (165, '1111', 0, '0');
INSERT INTO `article_category_list` VALUES (167, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (168, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (169, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (170, '测试分类名', 0, '0');
INSERT INTO `article_category_list` VALUES (171, '测试分类名', 0, '0');
COMMIT;

-- ----------------------------
-- Table structure for article_list
-- ----------------------------
DROP TABLE IF EXISTS `article_list`;
CREATE TABLE `article_list` (
  `articleId` int unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `categoryId` int NOT NULL COMMENT '分类id',
  `categoryName` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '分类名称',
  `title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '标题',
  `imgUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '简介',
  `adminId` int DEFAULT NULL COMMENT '后台用户Id',
  `author` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '作者',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '内容',
  `state` tinyint unsigned NOT NULL COMMENT '状态 1正常,0隐藏',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `articleCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '文章code',
  `addTime` int unsigned NOT NULL COMMENT '新增时间',
  `updateTime` int unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`articleId`) USING BTREE,
  KEY `categoryId` (`categoryId`) USING BTREE,
  KEY `categoryName` (`categoryName`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of article_list
-- ----------------------------
BEGIN;
INSERT INTO `article_list` VALUES (1, 106, '123', '', 'https://imgsa.baidu.com/forum/w%3D580/sign=2092b2c7e8fe9925cb0c695804a95ee4/bd4c162fb9389b5055794a508d35e5dde6116e48.jpg', '简介', 1, '00', '<p>内容</p>', 0, '备注', '332', 2032, 1598839154);
INSERT INTO `article_list` VALUES (2, 103, '1002', '标题', '1.jpg', '简介', NULL, '作者', '内容', 1, '备注', NULL, 0, 1598606065);
INSERT INTO `article_list` VALUES (177, 106, '123', '标题', '1.jpg', '简介', 1, 'zyx', '<p>内容123</p>', 1, '备注', 'code', 1598605134, 1598839141);
INSERT INTO `article_list` VALUES (186, 0, '测试分类名', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599103885, NULL);
INSERT INTO `article_list` VALUES (187, 0, '123', '', NULL, NULL, 5, 'zjz', NULL, 1, NULL, NULL, 1599207996, NULL);
INSERT INTO `article_list` VALUES (188, 0, '123', '', NULL, NULL, 5, 'zjz', NULL, 1, NULL, NULL, 1599208057, NULL);
INSERT INTO `article_list` VALUES (189, 0, '123', '', NULL, NULL, 5, 'zjz', NULL, 1, NULL, NULL, 1599208287, NULL);
INSERT INTO `article_list` VALUES (190, 0, '123', '', NULL, NULL, 5, 'zjz', NULL, 1, NULL, NULL, 1599208351, NULL);
INSERT INTO `article_list` VALUES (192, 0, '测试分类名', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599208461, NULL);
INSERT INTO `article_list` VALUES (193, 137, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599208512, NULL);
INSERT INTO `article_list` VALUES (194, 138, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599208520, NULL);
INSERT INTO `article_list` VALUES (196, 0, '1001', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599208537, NULL);
INSERT INTO `article_list` VALUES (198, 0, '1001', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599208561, NULL);
INSERT INTO `article_list` VALUES (200, 0, '测试分类名', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599208626, NULL);
INSERT INTO `article_list` VALUES (203, 0, '测试分类名', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599208685, NULL);
INSERT INTO `article_list` VALUES (205, 0, '测试分类名', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599208696, NULL);
INSERT INTO `article_list` VALUES (216, 138, '测试分类名', '123', '', '1', 5, 'zjz', '1', 1, NULL, '', 1599209599, NULL);
INSERT INTO `article_list` VALUES (217, 138, '测试分类名', '123', '', '', 5, 'zjz', '<p>1231<strong>23</strong></p>', 1, NULL, '', 1599209699, NULL);
INSERT INTO `article_list` VALUES (219, 138, '测试分类名', '123', '', '', 5, 'zjz', '<p><img src=\"http://fs-laboom.oss-cn-beijing.aliyuncs.com/UEditorImg/20200904/16:56:04649811599209764473986.png\" title=\"16:56:04649811599209764473986.png\" alt=\"image.png\"/>12</p>', 1, NULL, '', 1599209777, NULL);
INSERT INTO `article_list` VALUES (220, 156, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599212304, NULL);
INSERT INTO `article_list` VALUES (222, 157, '测试分类名', '标题', '1.jpg', '简介', NULL, '作者', '测试', 1, '0', '1111', 1599212305, 1599212305);
INSERT INTO `article_list` VALUES (224, 159, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599212306, NULL);
INSERT INTO `article_list` VALUES (225, 160, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599212307, NULL);
INSERT INTO `article_list` VALUES (226, 167, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599212639, NULL);
INSERT INTO `article_list` VALUES (227, 0, '测试分类名', '', NULL, NULL, 4, 'zxc', NULL, 1, NULL, NULL, 1599212640, NULL);
INSERT INTO `article_list` VALUES (228, 168, '测试分类名', '标题', '1.jpg', '简介', NULL, '作者', '测试', 1, '0', '1111', 1599212640, 1599212641);
INSERT INTO `article_list` VALUES (230, 170, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599212642, NULL);
INSERT INTO `article_list` VALUES (231, 171, '测试分类名', '测试1', NULL, '测试2', NULL, '测试', '测试', 1, '0', '1111', 1599212643, NULL);
COMMIT;

-- ----------------------------
-- Table structure for user_list
-- ----------------------------
DROP TABLE IF EXISTS `user_list`;
CREATE TABLE `user_list` (
  `userId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户名',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '昵称',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '密码',
  `phone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '手机号',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '头像地址',
  `addTime` int DEFAULT NULL COMMENT '创建的时间',
  `state` tinyint(1) DEFAULT '1' COMMENT '状态',
  `session` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`userId`) USING BTREE,
  UNIQUE KEY `account` (`account`) USING BTREE,
  UNIQUE KEY `phone` (`phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1821 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='用户信息表';

SET FOREIGN_KEY_CHECKS = 1;
