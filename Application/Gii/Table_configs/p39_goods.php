<?php
return array(
	'tableName' => 'p39_goods',    // 表名
	'tableCnName' => '商品',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('goods_name','market_price','shop_price','goods_desc','is_on_sale')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','goods_name','market_price','shop_price','goods_desc','is_on_sale')",
	'validate' => "
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,150', '商品名称的值最长不能超过 150 个字符！', 1, 'length', 3),
		array('market_price', 'require', '市场价格不能为空！', 1, 'regex', 3),
		array('market_price', 'currency', '市场价格必须是货币格式！', 1, 'regex', 3),
		array('shop_price', 'require', '本店价格不能为空！', 1, 'regex', 3),
		array('shop_price', 'currency', '本店价格必须是货币格式！', 1, 'regex', 3),
		array('is_on_sale', '是,否', \"是否上架的值只能是在 '是,否' 中的一个值！\", 2, 'in', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'goods_name' => array(
			'text' => '商品名称',
			'type' => 'text',
			'default' => '',
		),
		'market_price' => array(
			'text' => '市场价格',
			'type' => 'text',
			'default' => '',
		),
		'shop_price' => array(
			'text' => '本店价格',
			'type' => 'text',
			'default' => '',
		),
		'goods_desc' => array(
			'text' => '商品描述',
			'type' => 'html',
			'default' => '',
		),
		'is_on_sale' => array(
			'text' => '是否上架',
			'type' => 'radio',
			'values' => array(
				'是' => '是',
				'否' => '否',
			),
			'default' => '是',
		),
		'logo' => array(
			'text' => '原图',
			'type' => 'file',
			'thumbs' => array(
				array(700, 700, 1),
				array(350, 350, 1),
				array(130, 130, 1),
				array(50, 50, 1),
			),
			'save_fields' => array('logo', 'mbig_logo', 'big_logo', 'mid_logo', 'sm_logo'),
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('goods_name', 'normal', '', 'like', '商品名称'),
		array('market_price', 'between', 'market_pricefrom,market_priceto', '', '市场价格'),
		array('shop_price', 'between', 'shop_pricefrom,shop_priceto', '', '本店价格'),
		array('is_on_sale', 'in', '是-上架,否-下架', '', '是否上架'),
		array('addtime', 'betweenTime', 'addtimefrom,addtimeto', '', '添加时间'),
	),
);