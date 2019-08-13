/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3306
 Source Schema         : phpshop

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 12/08/2019 12:38:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for shop_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_admin
-- ----------------------------
INSERT INTO `shop_admin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for shop_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin_role`;
CREATE TABLE `shop_admin_role`  (
  `admin_id` mediumint(8) UNSIGNED NOT NULL COMMENT '管理员id',
  `role_id` mediumint(8) UNSIGNED NOT NULL COMMENT '角色id',
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员角色' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_attribute
-- ----------------------------
DROP TABLE IF EXISTS `shop_attribute`;
CREATE TABLE `shop_attribute`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `attr_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '属性名称',
  `attr_type` enum('唯一','可选') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '属性类型',
  `attr_option_values` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '属性可选值',
  `type_id` mediumint(8) UNSIGNED NOT NULL COMMENT '所属类型Id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type_id`(`type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '属性表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_attribute
-- ----------------------------
INSERT INTO `shop_attribute` VALUES (1, '是', '唯一', '', 5);
INSERT INTO `shop_attribute` VALUES (2, '精装修', '唯一', '是', 7);
INSERT INTO `shop_attribute` VALUES (3, '家具配齐', '唯一', '是', 7);
INSERT INTO `shop_attribute` VALUES (4, '无线网络', '唯一', '是', 7);
INSERT INTO `shop_attribute` VALUES (5, '24小时不间断热水', '唯一', '是', 7);
INSERT INTO `shop_attribute` VALUES (6, '早餐供应', '唯一', '是', 7);
INSERT INTO `shop_attribute` VALUES (7, '早餐供应', '可选', '有,无', 7);

-- ----------------------------
-- Table structure for shop_brand
-- ----------------------------
DROP TABLE IF EXISTS `shop_brand`;
CREATE TABLE `shop_brand`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `brand_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '品牌名称',
  `site_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '官方网址',
  `logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '品牌Logo图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '品牌' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_brand
-- ----------------------------
INSERT INTO `shop_brand` VALUES (1, '世嘉君座', '', 'Brand/2019-08-05/5d478fc782dc0.jpg');
INSERT INTO `shop_brand` VALUES (2, '世嘉铭座', '', 'Brand/2019-08-05/5d478fd167070.jpg');

-- ----------------------------
-- Table structure for shop_cart
-- ----------------------------
DROP TABLE IF EXISTS `shop_cart`;
CREATE TABLE `shop_cart`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `goods_attr_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品属性Id',
  `goods_number` mediumint(8) UNSIGNED NOT NULL COMMENT '购买的数量',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员Id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `member_id`(`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '购物车' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_category`;
CREATE TABLE `shop_category`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `cat_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `parent_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类的Id,0:顶级分类',
  `is_floor` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '是否推荐楼层',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_category
-- ----------------------------
INSERT INTO `shop_category` VALUES (1, '长租', 0, '是');
INSERT INTO `shop_category` VALUES (2, '短租', 0, '是');
INSERT INTO `shop_category` VALUES (3, '日租', 0, '是');
INSERT INTO `shop_category` VALUES (4, '酒店', 0, '是');
INSERT INTO `shop_category` VALUES (5, '城市商圈', 1, '是');
INSERT INTO `shop_category` VALUES (6, '地铁延边', 1, '是');
INSERT INTO `shop_category` VALUES (7, '地铁延边', 2, '是');
INSERT INTO `shop_category` VALUES (8, '城市商圈', 2, '是');

-- ----------------------------
-- Table structure for shop_comment
-- ----------------------------
DROP TABLE IF EXISTS `shop_comment`;
CREATE TABLE `shop_comment`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员Id',
  `content` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `addtime` datetime(0) NOT NULL COMMENT '发表时间',
  `star` tinyint(3) UNSIGNED NOT NULL COMMENT '分值',
  `click_count` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '有用的数字',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '评论' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_comment
-- ----------------------------
INSERT INTO `shop_comment` VALUES (1, 2, 3, '测试', '2019-08-11 16:54:19', 5, 0);
INSERT INTO `shop_comment` VALUES (2, 2, 3, '再次测试评论系统', '2019-08-11 16:55:07', 5, 0);

-- ----------------------------
-- Table structure for shop_comment_reply
-- ----------------------------
DROP TABLE IF EXISTS `shop_comment_reply`;
CREATE TABLE `shop_comment_reply`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `comment_id` mediumint(8) UNSIGNED NOT NULL COMMENT '评论Id',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员Id',
  `content` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `addtime` datetime(0) NOT NULL COMMENT '发表时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comment_id`(`comment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '评论回复' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_comment_reply
-- ----------------------------
INSERT INTO `shop_comment_reply` VALUES (1, 1, 3, '测试评论回复功能', '2019-08-11 16:55:29');

-- ----------------------------
-- Table structure for shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名称',
  `market_price` decimal(10, 2) NOT NULL COMMENT '市场价格',
  `shop_price` decimal(10, 2) NOT NULL COMMENT '本店价格',
  `goods_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '商品描述',
  `is_on_sale` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '是' COMMENT '是否上架',
  `is_delete` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '是否放到回收站',
  `addtime` datetime(0) NOT NULL COMMENT '添加时间',
  `logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '原图',
  `sm_logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '小图',
  `mid_logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '中图',
  `big_logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '大图',
  `mbig_logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '更大图',
  `brand_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '品牌id',
  `cat_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '主分类Id',
  `type_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '类型Id',
  `promote_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '促销价格',
  `promote_start_date` datetime(0) NOT NULL COMMENT '促销开始时间',
  `promote_end_date` datetime(0) NOT NULL COMMENT '促销结束时间',
  `is_new` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '是否新品',
  `is_hot` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '是否热卖',
  `is_best` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '是否精品',
  `sort_num` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '排序的数字',
  `is_floor` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '是否推荐楼层',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shop_price`(`shop_price`) USING BTREE,
  INDEX `addtime`(`addtime`) USING BTREE,
  INDEX `brand_id`(`brand_id`) USING BTREE,
  INDEX `cat_id`(`cat_id`) USING BTREE,
  INDEX `is_on_sale`(`is_on_sale`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods
-- ----------------------------
INSERT INTO `shop_goods` VALUES (1, '地铁延边', 0.00, 5555.00, '', '是', '否', '2019-08-05 10:14:30', 'Goods/2019-08-05/5d4791061ccf0.jpg', 'Goods/2019-08-05/thumb_3_5d4791061ccf0.jpg', 'Goods/2019-08-05/thumb_2_5d4791061ccf0.jpg', 'Goods/2019-08-05/thumb_1_5d4791061ccf0.jpg', 'Goods/2019-08-05/thumb_0_5d4791061ccf0.jpg', 2, 1, 0, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '是', '是', '是', 100, '是');
INSERT INTO `shop_goods` VALUES (2, '城市商圈', 0.00, 7777.00, '', '是', '否', '2019-08-05 10:15:31', 'Goods/2019-08-05/5d479161c5058.jpg', 'Goods/2019-08-05/thumb_3_5d479161c5058.jpg', 'Goods/2019-08-05/thumb_2_5d479161c5058.jpg', 'Goods/2019-08-05/thumb_1_5d479161c5058.jpg', 'Goods/2019-08-05/thumb_0_5d479161c5058.jpg', 2, 1, 0, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '是', '是', '是', 100, '是');
INSERT INTO `shop_goods` VALUES (3, '商品属性测试', 0.00, 4500.00, '<p><img src=\"http://www.shop.com/Public/umeditor1_2_2-utf8-php/php/upload/20190805/15649747354371.png\" alt=\"15649747354371.png\" /></p><p><img src=\"http://www.shop.com/Public/umeditor1_2_2-utf8-php/php/upload/20190805/15649747388738.png\" alt=\"15649747388738.png\" /></p><p><img src=\"http://www.shop.com/Public/umeditor1_2_2-utf8-php/php/upload/20190805/1564974740183.jpg\" alt=\"1564974740183.jpg\" /></p><p><img src=\"http://www.shop.com/Public/umeditor1_2_2-utf8-php/php/upload/20190805/15649747423849.png\" alt=\"15649747423849.png\" /></p><p><br /></p>', '是', '否', '2019-08-05 10:20:29', 'Goods/2019-08-05/5d4792900c350.jpg', 'Goods/2019-08-05/thumb_3_5d4792900c350.jpg', 'Goods/2019-08-05/thumb_2_5d4792900c350.jpg', 'Goods/2019-08-05/thumb_1_5d4792900c350.jpg', 'Goods/2019-08-05/thumb_0_5d4792900c350.jpg', 1, 2, 7, 99.00, '2019-08-01 00:00:00', '2019-08-07 00:00:00', '是', '是', '是', 100, '是');
INSERT INTO `shop_goods` VALUES (4, '城市商圈', 0.00, 9999999.00, '', '是', '否', '2019-08-11 11:04:24', 'Goods/2019-08-11/5d4f85da89f08.jpg', 'Goods/2019-08-11/thumb_3_5d4f85da89f08.jpg', 'Goods/2019-08-11/thumb_2_5d4f85da89f08.jpg', 'Goods/2019-08-11/thumb_1_5d4f85da89f08.jpg', 'Goods/2019-08-11/thumb_0_5d4f85da89f08.jpg', 2, 1, 0, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '是', '是', '是', 100, '是');

-- ----------------------------
-- Table structure for shop_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_attr`;
CREATE TABLE `shop_goods_attr`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `attr_value` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_id` mediumint(8) UNSIGNED NOT NULL COMMENT '属性Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `attr_id`(`attr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品属性' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods_attr
-- ----------------------------
INSERT INTO `shop_goods_attr` VALUES (1, '是', 2, 3);
INSERT INTO `shop_goods_attr` VALUES (2, '是', 3, 3);
INSERT INTO `shop_goods_attr` VALUES (3, '是', 4, 3);
INSERT INTO `shop_goods_attr` VALUES (4, '是', 5, 3);
INSERT INTO `shop_goods_attr` VALUES (5, '是', 6, 3);
INSERT INTO `shop_goods_attr` VALUES (6, '有', 7, 3);
INSERT INTO `shop_goods_attr` VALUES (7, '无', 7, 3);

-- ----------------------------
-- Table structure for shop_goods_cat
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_cat`;
CREATE TABLE `shop_goods_cat`  (
  `cat_id` mediumint(8) UNSIGNED NOT NULL COMMENT '分类id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `cat_id`(`cat_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品扩展分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods_cat
-- ----------------------------
INSERT INTO `shop_goods_cat` VALUES (7, 3);
INSERT INTO `shop_goods_cat` VALUES (5, 2);
INSERT INTO `shop_goods_cat` VALUES (6, 1);
INSERT INTO `shop_goods_cat` VALUES (5, 4);

-- ----------------------------
-- Table structure for shop_goods_number
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_number`;
CREATE TABLE `shop_goods_number`  (
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `goods_number` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存量',
  `goods_attr_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品属性表的ID,如果有多个，就用程序拼成字符串存到这个字段中',
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '库存量' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods_number
-- ----------------------------
INSERT INTO `shop_goods_number` VALUES (2, 873, '');

-- ----------------------------
-- Table structure for shop_goods_pic
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_pic`;
CREATE TABLE `shop_goods_pic`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `pic` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '原图',
  `sm_pic` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '小图',
  `mid_pic` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '中图',
  `big_pic` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '大图',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品相册' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods_pic
-- ----------------------------
INSERT INTO `shop_goods_pic` VALUES (1, 'Goods/2019-08-05/5d479af79cbd0.png', 'Goods/2019-08-05/thumb_2_5d479af79cbd0.png', 'Goods/2019-08-05/thumb_1_5d479af79cbd0.png', 'Goods/2019-08-05/thumb_0_5d479af79cbd0.png', 3);
INSERT INTO `shop_goods_pic` VALUES (2, 'Goods/2019-08-05/5d479af7d5228.jpg', 'Goods/2019-08-05/thumb_2_5d479af7d5228.jpg', 'Goods/2019-08-05/thumb_1_5d479af7d5228.jpg', 'Goods/2019-08-05/thumb_0_5d479af7d5228.jpg', 3);

-- ----------------------------
-- Table structure for shop_member
-- ----------------------------
DROP TABLE IF EXISTS `shop_member`;
CREATE TABLE `shop_member`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `face` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `jifen` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '积分',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '会员' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_member
-- ----------------------------
INSERT INTO `shop_member` VALUES (1, '123123', '4297f44b13955235245b2497399d7a93', '', 0);
INSERT INTO `shop_member` VALUES (2, '测试账号', '4297f44b13955235245b2497399d7a93', '', 0);
INSERT INTO `shop_member` VALUES (3, 'phpshop', 'f6fdffe48c908deb0f4c3bd36c032e72', '', 10000);

-- ----------------------------
-- Table structure for shop_member_level
-- ----------------------------
DROP TABLE IF EXISTS `shop_member_level`;
CREATE TABLE `shop_member_level`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `level_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '级别名称',
  `jifen_bottom` mediumint(8) UNSIGNED NOT NULL COMMENT '积分下限',
  `jifen_top` mediumint(8) UNSIGNED NOT NULL COMMENT '积分上限',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '会员级别' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_member_level
-- ----------------------------
INSERT INTO `shop_member_level` VALUES (1, '初级会员', 0, 999);
INSERT INTO `shop_member_level` VALUES (2, '中级会员', 1000, 4000);
INSERT INTO `shop_member_level` VALUES (3, '高级会员', 4999, 10000);

-- ----------------------------
-- Table structure for shop_member_price
-- ----------------------------
DROP TABLE IF EXISTS `shop_member_price`;
CREATE TABLE `shop_member_price`  (
  `price` decimal(10, 2) NOT NULL COMMENT '会员价格',
  `level_id` mediumint(8) UNSIGNED NOT NULL COMMENT '级别Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  INDEX `level_id`(`level_id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '会员价格' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_member_price
-- ----------------------------
INSERT INTO `shop_member_price` VALUES (950.00, 2, 3);
INSERT INTO `shop_member_price` VALUES (930.00, 3, 3);

-- ----------------------------
-- Table structure for shop_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE `shop_order`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员Id',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '下单时间',
  `pay_status` enum('是','否') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '支付状态',
  `pay_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付之间',
  `total_price` decimal(10, 2) NOT NULL COMMENT '定单总价',
  `shr_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人姓名',
  `shr_tel` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人电话',
  `shr_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人身份证号',
  `post_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '定单状态，0：未确认，1：确认中，2：已确认',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `member_id`(`member_id`) USING BTREE,
  INDEX `addtime`(`addtime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 79 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '定单基本信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_order
-- ----------------------------
INSERT INTO `shop_order` VALUES (78, 3, 1565328713, '否', 0, 18.00, '999999', '999999999', '123123', 0);

-- ----------------------------
-- Table structure for shop_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_order_goods`;
CREATE TABLE `shop_order_goods`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `order_id` mediumint(8) UNSIGNED NOT NULL COMMENT '定单Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '定单Id',
  `goods_attr_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品属性Id',
  `goods_number` mediumint(8) UNSIGNED NOT NULL COMMENT '购买的数量',
  `price` decimal(10, 2) NOT NULL COMMENT '购买的价格',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 66 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '定单商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_order_goods
-- ----------------------------
INSERT INTO `shop_order_goods` VALUES (1, 14, 2, '', 5, 9.00);
INSERT INTO `shop_order_goods` VALUES (2, 15, 2, '', 1, 9.00);
INSERT INTO `shop_order_goods` VALUES (3, 16, 2, '', 1, 9.00);
INSERT INTO `shop_order_goods` VALUES (4, 17, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (5, 18, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (6, 19, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (7, 20, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (8, 21, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (9, 22, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (10, 23, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (11, 24, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (12, 25, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (13, 26, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (14, 27, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (15, 28, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (16, 29, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (17, 30, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (18, 31, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (19, 32, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (20, 33, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (21, 34, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (22, 35, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (23, 36, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (24, 37, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (25, 38, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (26, 39, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (27, 40, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (28, 41, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (29, 42, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (30, 43, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (31, 44, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (32, 45, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (33, 46, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (34, 47, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (35, 48, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (36, 49, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (37, 50, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (38, 51, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (39, 52, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (40, 53, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (41, 54, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (42, 55, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (43, 56, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (44, 57, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (45, 58, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (46, 59, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (47, 60, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (48, 61, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (49, 62, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (50, 63, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (51, 64, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (52, 65, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (53, 66, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (54, 67, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (55, 68, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (56, 69, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (57, 70, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (58, 71, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (59, 72, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (60, 73, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (61, 74, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (62, 75, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (63, 76, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (64, 77, 2, '', 2, 9.00);
INSERT INTO `shop_order_goods` VALUES (65, 78, 2, '', 2, 9.00);

-- ----------------------------
-- Table structure for shop_privilege
-- ----------------------------
DROP TABLE IF EXISTS `shop_privilege`;
CREATE TABLE `shop_privilege`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pri_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限名称',
  `module_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块名称',
  `controller_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '控制器名称',
  `action_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '方法名称',
  `parent_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级权限Id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_privilege
-- ----------------------------
INSERT INTO `shop_privilege` VALUES (1, '商品模块', '', '', '', 0);
INSERT INTO `shop_privilege` VALUES (2, '商品列表', 'Admin', 'Goods', 'lst', 1);
INSERT INTO `shop_privilege` VALUES (3, '添加商品', 'Admin', 'Goods', 'add', 2);
INSERT INTO `shop_privilege` VALUES (4, '修改商品', 'Admin', 'Goods', 'edit', 2);
INSERT INTO `shop_privilege` VALUES (5, '删除商品', 'Admin', 'Goods', 'delete', 2);
INSERT INTO `shop_privilege` VALUES (6, '分类列表', 'Admin', 'Category', 'lst', 1);
INSERT INTO `shop_privilege` VALUES (7, '添加分类', 'Admin', 'Category', 'add', 6);
INSERT INTO `shop_privilege` VALUES (8, '修改分类', 'Admin', 'Category', 'edit', 6);
INSERT INTO `shop_privilege` VALUES (9, '删除分类', 'Admin', 'Category', 'delete', 6);
INSERT INTO `shop_privilege` VALUES (10, 'RBAC', '', '', '', 0);
INSERT INTO `shop_privilege` VALUES (11, '权限列表', 'Admin', 'Privilege', 'lst', 10);
INSERT INTO `shop_privilege` VALUES (12, '添加权限', 'Privilege', 'Admin', 'add', 11);
INSERT INTO `shop_privilege` VALUES (13, '修改权限', 'Admin', 'Privilege', 'edit', 11);
INSERT INTO `shop_privilege` VALUES (14, '删除权限', 'Admin', 'Privilege', 'delete', 11);
INSERT INTO `shop_privilege` VALUES (15, '角色列表', 'Admin', 'Role', 'lst', 10);
INSERT INTO `shop_privilege` VALUES (16, '添加角色', 'Admin', 'Role', 'add', 15);
INSERT INTO `shop_privilege` VALUES (17, '修改角色', 'Admin', 'Role', 'edit', 15);
INSERT INTO `shop_privilege` VALUES (18, '删除角色', 'Admin', 'Role', 'delete', 15);
INSERT INTO `shop_privilege` VALUES (19, '管理员列表', 'Admin', 'Admin', 'lst', 10);
INSERT INTO `shop_privilege` VALUES (20, '添加管理员', 'Admin', 'Admin', 'add', 19);
INSERT INTO `shop_privilege` VALUES (21, '修改管理员', 'Admin', 'Admin', 'edit', 19);
INSERT INTO `shop_privilege` VALUES (22, '删除管理员', 'Admin', 'Admin', 'delete', 19);
INSERT INTO `shop_privilege` VALUES (23, '类型列表', 'Admin', 'Type', 'lst', 1);
INSERT INTO `shop_privilege` VALUES (24, '添加类型', 'Admin', 'Type', 'add', 23);
INSERT INTO `shop_privilege` VALUES (25, '修改类型', 'Admin', 'Type', 'edit', 23);
INSERT INTO `shop_privilege` VALUES (26, '删除类型', 'Admin', 'Type', 'delete', 23);
INSERT INTO `shop_privilege` VALUES (27, '属性列表', 'Admin', 'Attribute', 'lst', 23);
INSERT INTO `shop_privilege` VALUES (28, '添加属性', 'Admin', 'Attribute', 'add', 27);
INSERT INTO `shop_privilege` VALUES (29, '修改属性', 'Admin', 'Attribute', 'edit', 27);
INSERT INTO `shop_privilege` VALUES (30, '删除属性', 'Admin', 'Attribute', 'delete', 27);
INSERT INTO `shop_privilege` VALUES (31, 'ajax删除商品属性', 'Admin', 'Goods', 'ajaxDelGoodsAttr', 4);
INSERT INTO `shop_privilege` VALUES (32, 'ajax删除商品相册图片', 'Admin', 'Goods', 'ajaxDelImage', 4);
INSERT INTO `shop_privilege` VALUES (33, '会员管理', '', '', '', 0);
INSERT INTO `shop_privilege` VALUES (34, '会员级别列表', 'Admin', 'MemberLevel', 'lst', 33);
INSERT INTO `shop_privilege` VALUES (35, '添加会员级别', 'Admin', 'MemberLevel', 'add', 34);
INSERT INTO `shop_privilege` VALUES (36, '修改会员级别', 'Admin', 'MemberLevel', 'edit', 34);
INSERT INTO `shop_privilege` VALUES (37, '删除会员级别', 'Admin', 'MemberLevel', 'delete', 34);
INSERT INTO `shop_privilege` VALUES (38, '品牌列表', 'Admin', 'Brand', 'lst', 1);
INSERT INTO `shop_privilege` VALUES (39, '添加品牌', 'Admin', 'Brand', 'add', 38);
INSERT INTO `shop_privilege` VALUES (40, '修改品牌', 'Admin', 'Brand', 'edit', 38);
INSERT INTO `shop_privilege` VALUES (41, '删除品牌', 'Admin', 'Brand', 'delete', 38);

-- ----------------------------
-- Table structure for shop_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_role`;
CREATE TABLE `shop_role`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_role_pri
-- ----------------------------
DROP TABLE IF EXISTS `shop_role_pri`;
CREATE TABLE `shop_role_pri`  (
  `pri_id` mediumint(8) UNSIGNED NOT NULL COMMENT '权限id',
  `role_id` mediumint(8) UNSIGNED NOT NULL COMMENT '角色id',
  INDEX `pri_id`(`pri_id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色权限' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_sphinx_id
-- ----------------------------
DROP TABLE IF EXISTS `shop_sphinx_id`;
CREATE TABLE `shop_sphinx_id`  (
  `id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已经创建好索引的最后一件id'
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'sphinx' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_sphinx_id
-- ----------------------------
INSERT INTO `shop_sphinx_id` VALUES (0);

-- ----------------------------
-- Table structure for shop_type
-- ----------------------------
DROP TABLE IF EXISTS `shop_type`;
CREATE TABLE `shop_type`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `type_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '类型' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_type
-- ----------------------------
INSERT INTO `shop_type` VALUES (7, '短租');

-- ----------------------------
-- Table structure for shop_yinxiang
-- ----------------------------
DROP TABLE IF EXISTS `shop_yinxiang`;
CREATE TABLE `shop_yinxiang`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `yx_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '印象名称',
  `yx_count` smallint(5) UNSIGNED NOT NULL DEFAULT 1 COMMENT '印象的次数',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '印象' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_yinxiang
-- ----------------------------
INSERT INTO `shop_yinxiang` VALUES (1, 2, 'asfdaf', 1);
INSERT INTO `shop_yinxiang` VALUES (2, 2, '非常好', 1);

SET FOREIGN_KEY_CHECKS = 1;
