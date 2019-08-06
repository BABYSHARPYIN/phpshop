<?php
return array(
	//'配置项'=>'配置值'
	'HTML_CACHE_ON'     =>    TRUE, // 开启静态缓存
	'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
	'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
	//这个模块中那些页面生成静态页
	'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
		// 定义格式1 数组方式
		'index:index'    =>     array('index', '60'),//首页生成index.shtml一分钟
		'index:goods'    =>     array('goods-{id}', '60'),//商品页生成goods-id.shtml一分钟
		// // 定义格式1 数组方式
		// '静态地址'    =>     array('静态规则', '有效期', '附加规则'),
	)
);
