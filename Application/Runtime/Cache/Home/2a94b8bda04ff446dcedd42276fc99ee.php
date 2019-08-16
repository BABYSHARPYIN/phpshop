<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>
        <?php echo $_page_title; ?>
    </title>
    <meta name="keywords" content="<?php echo $_page_keywords; ?>" />
    <meta name="description" content="<?php echo $_page_description; ?>" />
    <!-- 引入公共的CSS -->
    <link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">
    <!-- 引入公共的JS -->
    <script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/header.js"></script>
</head>

<body>
    <!-- 顶部导航 start -->
    <div class="topnav">
        <div class="topnav_bd w990 bc">
            <div class="topnav_left">

            </div>
            <div class="topnav_right fr">
                <ul>
                    <li id="logInfo"></li>
                    <li class="line">|</li>
                    <li>我的订单</li>
                    <li class="line">|</li>
                    <li>客户服务</li>

                </ul>
            </div>
        </div>
    </div>
    <!-- 顶部导航 end -->
    <div style="clear:both;"></div>

    
<!-- 引入这个页面特有的CSS和JS -->
<link rel="stylesheet" href="/Public/Home/style/index.css" type="text/css">
<script type="text/javascript" src="/Public/Home/js/index.js"></script>
<!-- 引入导航条文件 -->
<!-- 头部 start -->
<div class="header w1210 bc mt15">
    <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
    <div class="logo w1210">
        <h1 class="fl">
            <a href="index.html"><img src="/Public/Home/images/logo.png" alt="聚亿顺商城"></a>
        </h1>
        <!-- 头部搜索 start -->
        <div class="search fl">
            <div class="search_form">
                <div class="form_left fl"></div>
                <form action="" name="serarch" method="get" class="fl">
                    <input id="key" name="key" type="text" class="txt" value="<?php echo I('get.key', '请输入商品关键字'); ?>" />
                    <input onclick="location.href='<?php echo U('Search/key_search', '', FALSE); ?>/key/'+$('#key').val();" type="button" class="btn" value="搜索" />
                </form>
                <div class="form_right fl"></div>
            </div>

            <div style="clear:both;"></div>

            <div class="hot_search">
                <strong>热门搜索:</strong>
                <a href="">酒店长租</a>
                <a href="">酒店短租</a>
                <a href="">娱乐轰趴</a>
                <a href="">城市商圈</a>
            </div>
        </div>
        <!-- 头部搜索 end -->

        <!-- 购物车 start -->
        <div class="cart fl">
            <dl>
                <dt>
						<a id="cart_list" href="<?php echo U('Cart/lst'); ?>">去购物车结算</a>
						<b></b>
					</dt>
                <dd>
                    <div class="prompt" id="cart_div_list">
                        <img src="/Public/Home/images/loading.gif" />
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 购物车 end -->
    </div>
    <!-- 头部上半部分 end -->

    <div style="clear:both;"></div>

    <!-- 导航条部分 start -->
    <div class="nav w1210 bc mt10">
        <!--  商品分类部分 start-->
        <div class="category fl <?php if($_show_nav == 0) echo 'cat1'; ?>">
            <div class="cat_hd <?php if($_show_nav == 0) echo 'off'; ?>">
                <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，并将cat_bd设置为不显示(加上类none即可)，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>

            <div class="cat_bd <?php if($_show_nav == 0) echo 'none'; ?>">
                <!-- 循环输出三层分类数据 -->
                <?php foreach ($catData as $k => $v): ?>
                <div class="cat <?php if($k==0) echo 'item1'; ?>">
                    <h3>
                        <a href="<?php echo U('Search/cat_search?cat_id='.$v['id']),'',FALSE; ?>">
                            <?php echo $v['cat_name'];?>
                        </a> <b></b></h3>
                    <div class="cat_detail none">
                        <?php foreach ($v['children'] as $k1 => $v1): ?>
                        <dl <?php if($k1==0) echo 'class="dl_1st"'; ?>>
                            <dt><a href="<?php echo U('Search/cat_search?cat_id='.$v1['id']),'',FALSE; ?>"><?php echo $v1['cat_name'];?></a></dt>
                            <dd>
                                <?php foreach ($v1['children'] as $k2 => $v2): ?>
                                <a href="<?php echo U('Search/cat_search?cat_id='.$v2['id']),'',FALSE; ?>">
                                    <?php echo $v2['cat_name'];?>
                                </a>
                                <?php endforeach; ?>
                            </dd>
                        </dl>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
        <!--  商品分类部分 end-->

        <div class="navitems fl">
            <ul class="fl">
                <li class="current"><a href="">首页</a></li>
                <li><a href="">酒店长租</a></li>
                <li><a href="">酒店短租</a></li>
                <li><a href="">娱乐轰趴</a></li>
                <li><a href="">豪宅别墅</a></li>
                <li><a href="">城市商圈</a></li>
            </ul>
            <div class="right_corner fl"></div>
        </div>
    </div>
    <!-- 导航条部分 end -->
</div>
<!-- 头部 end-->

<div style="clear:both;"></div>

<script>
    <?php $ic = C('IMAGE_CONFIG'); ?>
    var picView = "<?php echo $ic['viewPath']; ?>";
    $("#cart_list").mouseover(function() {
        $.ajax({
            type: "GET",
            url: "<?php echo U('Cart/ajaxCartList'); ?>",
            dataType: "json",
            success: function(data) {
                // 拼出HTML放到页中
                var html = "<table>";
                $(data).each(function(k, v) {
                    html += "<tr>";
                    html += '<td><img width="50" src="' + picView + v.mid_logo + '" /></td>';
                    html += '<td>' + v.goods_name + '</td>';
                    html += '</tr>';
                });
                html += "</table>";
                $("#cart_div_list").html(html);
            }
        });
    });
</script>
<!-- 综合区域 start 包括幻灯展示，商城快报 -->
<div class="colligate w1210 bc mt10">
    <!-- 幻灯区域 start -->
    <div class="slide fl">
        <div class="area">
            <div class="slide_items">
                <ul>
                    <li>
                        <a href=""><img src="/Public/Home/images/index_slide1.jpg" alt="" /></a>
                    </li>
                    <li>
                        <a href=""><img src="/Public/Home/images/index_slide2.jpg" alt="" /></a>
                    </li>
                    <li>
                        <a href=""><img src="/Public/Home/images/index_slide3.jpg" alt="" /></a>
                    </li>
                    <li>
                        <a href=""><img src="/Public/Home/images/index_slide4.jpg" alt="" /></a>
                    </li>
                    <li>
                        <a href=""><img src="/Public/Home/images/index_slide5.jpg" alt="" /></a>
                    </li>
                    <li>
                        <a href=""><img src="/Public/Home/images/index_slide6.jpg" alt="" /></a>
                    </li>
                </ul>
            </div>
            <div class="slide_controls">
                <ul>
                    <li class="on">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 幻灯区域 end-->

    <!-- 快报区域 start-->
    <div class="coll_right fl ml10">
        <div class="ad">
            <a href=""><img src="/Public/Home/images/ad.jpg" alt="" /></a>
        </div>



    </div>
    <!-- 快报区域 end-->
</div>
<!-- -综合区域 end -->

<div style="clear:both;"></div>

<!-- 导购区域 start -->
<div class="guide w1210 bc mt15">
    <!-- 导购左边区域 start -->
    <div class="guide_content fl">
        <h2>
            <span class="on">近期促销</span>
            <span>热门房型</span>
            <span>特挑精选</span>
            <span>新品上架</span>
            <span class="last">猜您喜欢</span>
        </h2>

        <div class="guide_wrap">
            <!-- 近期促销 start-->
            <div class="crazy">
                <ul>
                    <?php foreach($goods1 as $k=>$v):?>
                    <li>
                        <dl>
                            <dt><a href="<?php echo U('goods?id='.$v['id']); ?>"><?php showImage($v['mid_logo']); ?></a></dt>
                            <dd>
                                <a href="<?php echo U('goods?id='.$v['id']); ?>">
                                    <?php echo $v['goods_name']; ?>
                                </a>
                            </dd>
                            <dd><span>售价：</span><strong> ￥<?php echo $v['promote_price']; ?>元</strong></dd>
                        </dl>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- 近期促销 end-->

            <!-- 热门商品 start -->
            <div class="hot none">
                <ul>
                    <?php foreach($goods3 as $k=>$v):?>
                    <li>
                        <dl>
                            <dt><a href="<?php echo U('goods?id='.$v['id']); ?>"><?php showImage($v['mid_logo']); ?></a></dt>
                            <dd>
                                <a href="<?php echo U('goods?id='.$v['id']); ?>">
                                    <?php echo $v['goods_name']; ?>
                                </a>
                            </dd>
                            <dd><span>售价：</span><strong> ￥<?php echo $v['shop_price']; ?>元</strong></dd>
                        </dl>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- 热门商品 end -->

            <!-- 精品商品 atart -->
            <div class="recommend none">
                <ul>
                    <?php foreach($goods4 as $k=>$v):?>
                    <li>
                        <dl>
                            <dt><a href="<?php echo U('goods?id='.$v['id']); ?>"><?php showImage($v['mid_logo']); ?></a></dt>
                            <dd>
                                <a href="<?php echo U('goods?id='.$v['id']); ?>">
                                    <?php echo $v['goods_name']; ?>
                                </a>
                            </dd>
                            <dd><span>售价：</span><strong> ￥<?php echo $v['shop_price']; ?>元</strong></dd>
                        </dl>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- 精品商品 end -->

            <!-- 新品上架 start-->
            <div class="new none">
                <ul>
                    <?php foreach($goods2 as $k=>$v):?>
                    <li>
                        <dl>
                            <dt><a href="<?php echo U('goods?id='.$v['id']); ?>"><?php showImage($v['mid_logo']); ?></a></dt>
                            <dd>
                                <a href="<?php echo U('goods?id='.$v['id']); ?>">
                                    <?php echo $v['goods_name']; ?>
                                </a>
                            </dd>
                            <dd><span>售价：</span><strong> ￥<?php echo $v['shop_price']; ?>元</strong></dd>
                        </dl>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- 新品上架 end-->

            <!-- 猜您喜欢 start -->
            <div class="guess none">
                <ul>
                    <li>
                        <dl>
                            <dt><a href=""><img src="/Public\Home\images\index_slide2.jpg" alt="" /></a></dt>
                            <dd><a href="">两室一厅豪华卧居</a></dd>
                            <dd><span>售价：</span><strong> XXXX</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="/Public\Home\images\index_slide2.jpg" alt="" /></a></dt>
                            <dd><a href="">两室一厅豪华卧居</a></dd>
                            <dd><span>售价：</span><strong>XXXX</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="/Public\Home\images\index_slide2.jpg" alt="" /></a></dt>
                            <dd><a href="">两室一厅豪华卧居</a></dd>
                            <dd><span>售价：</span><strong>XXXX</strong></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!-- 猜您喜欢 end -->

        </div>

    </div>
    <!-- 导购左边区域 end -->

    <!-- 侧栏 网站首发 start-->
    <div class="sidebar fl ml10">
        <h2><strong>特价优惠</strong></h2>
        <div class="sidebar_wrap">
            <dl class="first">
                <dt class="fl"><a href=""><img src="/Public/Home/images/viewsonic.jpg" alt="" /></a></dt>
                <dd><strong><a href="">ViewSonic优派N710 </a></strong> <em>首发</em></dd>
                <dd>苹果iphone 5免费送！攀高作为全球智能语音血压计领导品牌，新推出的黑金刚高端智能电子血压计，改变传统测量方式让血压测量迈入一体化时代。</dd>
            </dl>

            <dl>
                <dt class="fr"><a href=""><img src="/Public/Home/images/samsung.jpg" alt="" /></a></dt>
                <dd><strong><a href="">Samsung三星Galaxy</a></strong> <em>首发</em></dd>
                <dd>电视百科全书，360°无死角操控，感受智能新体验！双核CPU+双核GPU+MEMC运动防抖，58寸大屏打造全新视听盛宴！</dd>
            </dl>
        </div>


    </div>
    <!-- 侧栏 网站首发 end -->

</div>
<!-- 导购区域 end -->

<div style="clear:both;"></div>

<?php foreach($floorData as $k=>$v): ?>
<!--1F 电脑办公 start -->
<div class="floor1 floor w1210 bc mt10">
    <!-- 1F 左侧 start -->
    <div class="floor_left fl">
        <!-- 商品分类信息 start-->
        <div class="cate fl">
            <h2>
                <?php echo $v['cat_name']; ?>
            </h2>
            <div class="cate_wrap">
                <ul>
                    <?php foreach($v['subCat'] as $k1=>$v1): ?>
                    <li><a href=""><b>.</b><?php echo $v1['cat_name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <p>
                    <a href=""><img src="/Public/Home/images/notebook.jpg" alt="" /></a>
                </p>
            </div>


        </div>
        <!-- 商品分类信息 end-->

        <!-- 商品列表信息 start-->
        <div class="goodslist fl">
            <h2>
                <?php foreach ($v['recSubCat'] as $k1 => $v1): ?>
                <span <?php if($k1==0 ) echo 'class="on"'; ?>><?php echo $v1['cat_name']; ?></span>
                <?php endforeach; ?>
            </h2>
            <div class="goodslist_wrap">
                <!-- 有几个按钮就循环几个放商品的DIV，默认只显示第一个 -->
                <?php foreach ($v['recSubCat'] as $k1 => $v1): ?>
                <div <?php if($k1>0) echo 'class="none"'; ?>>
                    <ul>
                        <?php foreach ($v1['goods'] as $k2 => $v2): ?>
                        <li>
                            <dl>
                                <dt><a href="<?php echo U('goods?id='.$v2['id']); ?>"><?php showImage($v2['mid_logo']); ?></a></dt>
                                <dd>
                                    <a href="<?php echo U('goods?id='.$v2['id']); ?>">
                                        <?php echo $v2['goods_name']; ?>
                                    </a>
                                </dd>
                                <dd><span>售价：</span> <strong>￥<?php echo $v2['shop_price']; ?>元</strong></dd>
                            </dl>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- 商品列表信息 end-->
    </div>
    <!-- 1F 左侧 end -->

    <!-- 右侧 start -->
    <div class="sidebar fl ml10">
        <!-- 品牌旗舰店 start -->
        <div class="brand">
            <h2><a href="">更多品牌&nbsp;></a><strong>品牌旗舰店</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <?php foreach ($v['brand'] as $k => $v): ?>
                    <li>
                        <a href="">
                            <?php showImage($v['logo']);?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- 品牌旗舰店 end -->

        <!-- 分类资讯 start -->
        <div class="info mt10">
            <h2><strong>分类资讯</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <li><a href=""><b>.</b>iphone 5s土豪金大量到货</a></li>
                    <li><a href=""><b>.</b>三星note 3低价促销</a></li>
                    <li><a href=""><b>.</b>thinkpad x240即将上市</a></li>
                    <li><a href=""><b>.</b>双十一来临，众商家血拼</a></li>
                </ul>
            </div>

        </div>
        <!-- 分类资讯 end -->

        <!-- 广告 start -->
        <div class="ads mt10">
            <a href=""><img src="/Public/Home/images/canon.jpg" alt="" /></a>
        </div>
        <!-- 广告 end -->
    </div>
    <!-- 右侧 end -->

</div>
<!--1F 电脑办公 end -->
<?php endforeach; ?>
<!-- 底部导航 start -->
<div class="bottomnav w1210 bc mt10">
    <div class="bnav1">
        <h3><b></b> <em>购物指南</em></h3>
        <ul>
            <li><a href="">购物流程</a></li>
            <li><a href="">会员介绍</a></li>
            <li><a href="">团购/机票/充值/点卡</a></li>
            <li><a href="">常见问题</a></li>
            <li><a href="">大家电</a></li>
            <li><a href="">联系客服</a></li>
        </ul>
    </div>

    <div class="bnav2">
        <h3><b></b> <em>配送方式</em></h3>
        <ul>
            <li><a href="">上门自提</a></li>
            <li><a href="">快速运输</a></li>
            <li><a href="">特快专递（EMS）</a></li>
            <li><a href="">如何送礼</a></li>
            <li><a href="">海外购物</a></li>
        </ul>
    </div>


    <div class="bnav3">
        <h3><b></b> <em>支付方式</em></h3>
        <ul>
            <li><a href="">货到付款</a></li>
            <li><a href="">在线支付</a></li>
            <li><a href="">分期付款</a></li>
            <li><a href="">邮局汇款</a></li>
            <li><a href="">公司转账</a></li>
        </ul>
    </div>

    <div class="bnav4">
        <h3><b></b> <em>售后服务</em></h3>
        <ul>
            <li><a href="">退换货政策</a></li>
            <li><a href="">退换货流程</a></li>
            <li><a href="">价格保护</a></li>
            <li><a href="">退款说明</a></li>
            <li><a href="">返修/退换货</a></li>
            <li><a href="">退款申请</a></li>
        </ul>
    </div>

    <div class="bnav5">
        <h3><b></b> <em>特色服务</em></h3>
        <ul>
            <li><a href="">夺宝岛</a></li>
            <li><a href="">DIY装机</a></li>
            <li><a href="">延保服务</a></li>
            <li><a href="">家电下乡</a></li>
            <li><a href="">京东礼品卡</a></li>
            <li><a href="">能效补贴</a></li>
        </ul>
    </div>
</div>
<!-- 底部导航 end -->

    <div style="clear:both;"></div>
    <!-- 底部版权 start -->
    <div class="footer w1210 bc mt15">
        <p class="links">
            <a href="">关于我们</a> |
            <a href="">联系我们</a> |
            <a href="">人才招聘</a> |
            <a href="">商家入驻</a> |
            <a href="">千寻网</a> |
            <a href="">奢侈品网</a> |
            <a href="">广告服务</a> |
            <a href="">移动终端</a> |
            <a href="">友情链接</a> |
            <a href="">销售联盟</a> |
            <a href="">聚亿顺论坛</a>
        </p>
        <p class="copyright">
            © 2005-2013 京东网上商城 版权所有，并保留所有权利。 ICP备案证书号:京ICP证070359号
        </p>
        <p class="auth">
            <a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
            <a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
            <a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
            <a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
        </p>
    </div>
    <!-- 底部版权 end -->

</body>

</html>

<script>
    // 判断登录状态 
    $.ajax({
        type: "GET",
        url: "<?php echo U('Member/ajaxChkLogin'); ?>",
        dataType: "json",
        success: function(data) {
            if (data.login == 1)
                var li = '您好，' + data.username + ' [<a href="<?php echo U('Member/logout'); ?>">退出</a>]';
            else
                var li = '您好，欢迎来到聚亿顺！[<a href="<?php echo U('Member/login'); ?>">登录</a>] [<a href="<?php echo U(' Member / regist '); ?>">免费注册</a>]'
                $("#logInfo").html(li);
        }
    });
</script>