-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-10-15 11:20:41
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php39`
--

-- --------------------------------------------------------

--
-- 表的结构 `p39_brand`
--

CREATE TABLE IF NOT EXISTS `p39_brand` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `brand_name` varchar(30) NOT NULL COMMENT '品牌名称',
  `site_url` varchar(150) NOT NULL DEFAULT '' COMMENT '官方网址',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌Logo图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `p39_brand`
--

INSERT INTO `p39_brand` (`id`, `brand_name`, `site_url`, `logo`) VALUES
(2, '苹果', '', 'Brand/2015-10-13/561cc92ba6c33.jpg'),
(3, '小米', '', ''),
(4, '三星', '', ''),
(5, '华为', '', ''),
(6, '酷派', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `p39_goods`
--

CREATE TABLE IF NOT EXISTS `p39_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_name` varchar(150) NOT NULL COMMENT '商品名称',
  `market_price` decimal(10,2) NOT NULL COMMENT '市场价格',
  `shop_price` decimal(10,2) NOT NULL COMMENT '本店价格',
  `goods_desc` longtext COMMENT '商品描述',
  `is_on_sale` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否上架',
  `is_delete` enum('是','否') NOT NULL DEFAULT '否' COMMENT '是否放到回收站',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '原图',
  `sm_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '小图',
  `mid_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '中图',
  `big_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '大图',
  `mbig_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '更大图',
  `brand_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
  PRIMARY KEY (`id`),
  KEY `shop_price` (`shop_price`),
  KEY `addtime` (`addtime`),
  KEY `brand_id` (`brand_id`),
  KEY `is_on_sale` (`is_on_sale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `p39_goods`
--

INSERT INTO `p39_goods` (`id`, `goods_name`, `market_price`, `shop_price`, `goods_desc`, `is_on_sale`, `is_delete`, `addtime`, `logo`, `sm_logo`, `mid_logo`, `big_logo`, `mbig_logo`, `brand_id`) VALUES
(2, '新的联想商品', '123.00', '321.00', '', '是', '否', '2015-10-15 14:48:03', '', '', '', '', '', 0),
(3, '测试相册', '111.00', '222.00', '', '是', '否', '2015-10-15 16:05:05', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `p39_goods_pic`
--

CREATE TABLE IF NOT EXISTS `p39_goods_pic` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `pic` varchar(150) NOT NULL COMMENT '原图',
  `sm_pic` varchar(150) NOT NULL COMMENT '小图',
  `mid_pic` varchar(150) NOT NULL COMMENT '中图',
  `big_pic` varchar(150) NOT NULL COMMENT '大图',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品相册' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `p39_goods_pic`
--

INSERT INTO `p39_goods_pic` (`id`, `pic`, `sm_pic`, `mid_pic`, `big_pic`, `goods_id`) VALUES
(2, 'Goods/2015-10-15/561f5e4374c7d.jpg', 'Goods/2015-10-15/thumb_2_561f5e4374c7d.jpg', 'Goods/2015-10-15/thumb_1_561f5e4374c7d.jpg', 'Goods/2015-10-15/thumb_0_561f5e4374c7d.jpg', 3),
(4, 'Goods/2015-10-15/561f6f5e19948.jpg', 'Goods/2015-10-15/thumb_2_561f6f5e19948.jpg', 'Goods/2015-10-15/thumb_1_561f6f5e19948.jpg', 'Goods/2015-10-15/thumb_0_561f6f5e19948.jpg', 3),
(5, 'Goods/2015-10-15/561f6f6018a1a.jpg', 'Goods/2015-10-15/thumb_2_561f6f6018a1a.jpg', 'Goods/2015-10-15/thumb_1_561f6f6018a1a.jpg', 'Goods/2015-10-15/thumb_0_561f6f6018a1a.jpg', 3),
(6, 'Goods/2015-10-15/561f6f612ab67.jpg', 'Goods/2015-10-15/thumb_2_561f6f612ab67.jpg', 'Goods/2015-10-15/thumb_1_561f6f612ab67.jpg', 'Goods/2015-10-15/thumb_0_561f6f612ab67.jpg', 3),
(7, 'Goods/2015-10-15/561f6f7151c1c.gif', 'Goods/2015-10-15/thumb_2_561f6f7151c1c.gif', 'Goods/2015-10-15/thumb_1_561f6f7151c1c.gif', 'Goods/2015-10-15/thumb_0_561f6f7151c1c.gif', 3);

-- --------------------------------------------------------

--
-- 表的结构 `p39_member_level`
--

CREATE TABLE IF NOT EXISTS `p39_member_level` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `level_name` varchar(30) NOT NULL COMMENT '级别名称',
  `jifen_bottom` mediumint(8) unsigned NOT NULL COMMENT '积分下限',
  `jifen_top` mediumint(8) unsigned NOT NULL COMMENT '积分上限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员级别' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `p39_member_level`
--

INSERT INTO `p39_member_level` (`id`, `level_name`, `jifen_bottom`, `jifen_top`) VALUES
(1, '注册会员', 0, 5000),
(2, '初级会员', 5001, 10000),
(3, '高级会员', 10001, 20000),
(4, 'VIP', 20001, 16777215);

-- --------------------------------------------------------

--
-- 表的结构 `p39_member_price`
--

CREATE TABLE IF NOT EXISTS `p39_member_price` (
  `price` decimal(10,2) NOT NULL COMMENT '会员价格',
  `level_id` mediumint(8) unsigned NOT NULL COMMENT '级别Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  KEY `level_id` (`level_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员价格';

--
-- 转存表中的数据 `p39_member_price`
--

INSERT INTO `p39_member_price` (`price`, `level_id`, `goods_id`) VALUES
('333.00', 2, 2),
('444.00', 4, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
