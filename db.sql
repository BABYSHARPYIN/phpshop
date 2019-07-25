create database phpshop;
use phpshop;
set names utf8;

drop table if exists shop_goods;
create table shop_goods
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_name varchar(150) not null comment '商品名称',
	market_price decimal(10,2) not null comment '市场价格',
	shop_price decimal(10,2) not null comment '本店价格',
	goods_desc longtext comment '商品描述',
	is_on_sale enum('是','否') not null default '是' comment '是否上架',
	is_delete enum('是','否') not null default '否' comment '是否放到回收站',
	addtime datetime not null comment '添加时间',
	logo varchar(150) not null default '' comment '原图',
	sm_logo varchar(150) not null default '' comment '小图',
	mid_logo varchar(150) not null default '' comment '中图',
	big_logo varchar(150) not null default '' comment '大图',
	mbig_logo varchar(150) not null default '' comment '更大图',
	brand_id mediumint unsigned not null default '0' comment '品牌id',
	primary key (id),
	key shop_price(shop_price),
	key addtime(addtime),
	key brand_id(brand_id),
	key is_on_sale(is_on_sale)
)engine=MyISAM default charset=utf8 comment '商品';

drop table if exists shop_brand;
create table shop_brand
(
	id mediumint unsigned not null auto_increment comment 'Id',
	brand_name varchar(30) not null comment '品牌名称',
	site_url varchar(150) not null default '' comment '官方网址',
	logo varchar(150) not null default '' comment '品牌Logo图片',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '品牌';

drop table if exists shop_member_level;
create table shop_member_level
(
	id mediumint unsigned not null auto_increment comment 'Id',
	level_name varchar(30) not null comment '级别名称',
	jifen_bottom mediumint unsigned not null comment '积分下限',
	jifen_top mediumint unsigned not null comment '积分上限',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '会员级别';

drop table if exists shop_member_price;
create table shop_member_price
(
	price decimal(10,2) not null comment '会员价格',
	level_id mediumint unsigned not null comment '级别Id',
	goods_id mediumint unsigned not null comment '商品Id',
	key level_id(level_id),
	key goods_id(goods_id)
)engine=MyISAM default charset=utf8 comment '会员价格';

drop table if exists shop_goods_pic;
create table shop_goods_pic
(
	id mediumint unsigned not null auto_increment comment 'Id',
	pic varchar(150) not null comment '原图',
	sm_pic varchar(150) not null comment '小图',
	mid_pic varchar(150) not null comment '中图',
	big_pic varchar(150) not null comment '大图',
	goods_id mediumint unsigned not null comment '商品Id',
	primary key (id),
	key goods_id(goods_id)
)engine=MyISAM default charset=utf8 comment '商品相册';


/****属性相关表*****/
DROP TABLE IF EXISTS shop_type;
create table shop_type
(
	id mediumint unsigned not null auto_increment comment 'Id',
	type_name VARCHAR(30) not null comment '类型名称',
	primary key (id)
)engine=MyISAM default charset=utf8 comment '类型';


DROP TABLE IF EXISTS shop_attribute;
create table shop_attribute
(
	id mediumint unsigned not null auto_increment comment 'Id',
	attr_name VARCHAR(30) not null comment '属性名称',
	attr_type enum('唯一','可选') not null comment '属性类型',
	attr_option_values VARCHAR(300) not null DEFAULT'' comment '属性可选值',
	type_id mediumint unsigned not NULL comment '所属类型Id',
	primary key (id),
	key type_id(type_id)
)engine=MyISAM default charset=utf8 comment '属性';


DROP TABLE IF EXISTS shop_goods_attr;
create table shop_goods_attr
(
	id mediumint unsigned not null auto_increment comment 'Id',
	attr_value VARCHAR(150) not null DEFAULT '' comment '属性值',
	attr_id mediumint unsigned not null comment '属性Id',
	goods_id mediumint unsigned not null comment '商品Id',
	primary key (id),
	key goods_id(goods_id),
	key attr_id(attr_id)
)engine=MyISAM default charset=utf8 comment '商品属性';


DROP TABLE IF EXISTS shop_goods_number;
create table shop_goods_number
(
	goods_id mediumint unsigned not null comment '商品Id',
	goods_number mediumint unsigned not null DEFAULT'0' comment '库存量',
	goods_attr_id varchar(150) not null comment '商品属性表ID，如果有多个，就用程序拼成字符串存到这个字段中',
	key goods_id(goods_id)
)engine=MyISAM default charset=utf8 comment '库存量';



















