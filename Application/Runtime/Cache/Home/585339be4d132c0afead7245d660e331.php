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

    

<link rel="stylesheet" href="/Public/Home/style/fillin.css" type="text/css">
<script type="text/javascript" src="/Public/Home/js/cart2.js"></script>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl">
            <a href="index.html"><img src="/Public/Home/images/logo.png" alt="京西商城"></a>
        </h2>
        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="fillin w990 bc mt15">
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>

    <div class="fillin_bd">
        <!-- 收货人信息  start-->
        <div class="address">
            <h3>客户信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>
            <div class="address_info">
                <p>王超平 13555555555 </p>
                <p>北京 昌平区 西三旗 建材城西路金燕龙办公楼一层 </p>
            </div>

            <div class="address_select none">
                <ul>
                    <li class="cur">
                        <input type="radio" name="address" checked="checked" />王超平 北京市 昌平区 建材城西路金燕龙办公楼一层 13555555555
                        <a href="">设为默认地址</a>
                        <a href="">编辑</a>
                        <a href="">删除</a>
                    </li>
                    <li>
                        <input type="radio" name="address" />王超平 湖北省 武汉市 武昌 关山光谷软件园1号201 13333333333
                        <a href="">设为默认地址</a>
                        <a href="">编辑</a>
                        <a href="">删除</a>
                    </li>
                    <li><input type="radio" name="address" class="new_address" />使用新地址</li>
                </ul>
                <form action="/index.php/Home/Order/add.html" method="POST" class="none" name="address_form">
                    <ul>
                        <li>
                            <label for=""><span>*</span>姓 名：</label>
                            <input type="text" name="shr_name" class="txt" />
                        </li>
                        <li>
                            <label for=""><span>*</span>手机号码：</label>
                            <input type="text" name="shr_tel" class="txt" />
                        </li>
                        <li>
                            <label for=""><span>*</span>身份证号：</label>
                            <input type="text" name="shr_id" class="txt" />
                        </li>
                    </ul>
                </form>
                <a href="" class="confirm_btn"><span>保存收货人信息</span></a>
            </div>
        </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start -->
        <div class="delivery">
            <h3>送货方式 <a href="javascript:;" id="delivery_modify">[修改]</a></h3>
            <div class="delivery_info">
                <p>普通快递送货上门</p>
                <p>送货时间不限</p>
            </div>

            <div class="delivery_select none">
                <table>
                    <thead>
                        <tr>
                            <th class="col1">送货方式</th>
                            <th class="col2">运费</th>
                            <th class="col3">运费标准</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="cur">
                            <td>
                                <input type="radio" name="delivery" checked="checked" />普通快递送货上门
                                <select name="" id="">
										<option value="">时间不限</option>
										<option value="">工作日，周一到周五</option>
										<option value="">周六日及公众假期</option>
									</select>
                            </td>
                            <td>￥10.00</td>
                            <td>每张订单不满499.00元,运费15.00元, 订单4...</td>
                        </tr>
                        <tr>

                            <td><input type="radio" name="delivery" />特快专递</td>
                            <td>￥40.00</td>
                            <td>每张订单不满499.00元,运费40.00元, 订单4...</td>
                        </tr>
                        <tr>

                            <td><input type="radio" name="delivery" />加急快递送货上门</td>
                            <td>￥40.00</td>
                            <td>每张订单不满499.00元,运费40.00元, 订单4...</td>
                        </tr>
                        <tr>

                            <td><input type="radio" name="delivery" />平邮</td>
                            <td>￥10.00</td>
                            <td>每张订单不满499.00元,运费15.00元, 订单4...</td>
                        </tr>
                    </tbody>
                </table>
                <a href="" class="confirm_btn"><span>确认送货方式</span></a>
            </div>
        </div>
        <!-- 配送方式 end -->

        <!-- 支付方式  start-->
        <div class="pay">
            <h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>
            <div class="pay_info">
                <p>货到付款</p>
            </div>

            <div class="pay_select none">
                <table>
                    <tr class="cur">
                        <td class="col1"><input type="radio" name="pay" />货到付款</td>
                        <td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />在线支付</td>
                        <td class="col2">即时到帐，支持绝大数银行借记卡及部分银行信用卡</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />上门自提</td>
                        <td class="col2">自提时付款，支持现金、POS刷卡、支票支付</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />邮局汇款</td>
                        <td class="col2">通过快钱平台收款 汇款后1-3个工作日到账</td>
                    </tr>
                </table>
                <a href="" class="confirm_btn"><span>确认支付方式</span></a>
            </div>
        </div>
        <!-- 支付方式  end-->

        <!-- 发票信息 start-->
        <div class="receipt">
            <h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
            <div class="receipt_info">
                <p>个人发票</p>
                <p>内容：明细</p>
            </div>

            <div class="receipt_select none">
                <form action="">
                    <ul>
                        <li>
                            <label for="">发票抬头：</label>
                            <input type="radio" name="type" checked="checked" class="personal" />个人
                            <input type="radio" name="type" class="company" />单位
                            <input type="text" class="txt company_input" disabled="disabled" />
                        </li>
                        <li>
                            <label for="">发票内容：</label>
                            <input type="radio" name="content" checked="checked" />明细
                            <input type="radio" name="content" />办公用品
                            <input type="radio" name="content" />体育休闲
                            <input type="radio" name="content" />耗材
                        </li>
                    </ul>
                </form>
                <a href="" class="confirm_btn"><span>确认发票信息</span></a>
            </div>
        </div>
        <!-- 发票信息 end-->

        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                    <tr>
                        <th class="col1">商品名称</th>
                        <th class="col2">商品信息</th>
                        <th class="col3">单价</th>
                        <th class="col4">数量</th>
                        <th class="col5">小计</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $tp = 0; foreach ($data as $k => $v): ?>
                    <tr>
                        <td class="col1">
                            <a href="">
                                <?php showImage($v['mid_logo']); ?>
                            </a>
                            <strong><a href="<?php echo U('Index/goods?id='.$v['goods_id']); ?>"><?php echo $v['goods_name']; ?></a></strong></td>
                        <td class="col2">
                            <?php foreach ($v['gaData'] as $k1 => $v1): ?>
                            <p>
                                <?php echo $v1['attr_name']; ?>：
                                <?php echo $v1['attr_value']; ?>
                            </p>
                            <?php endforeach; ?>
                        </td>
                        <td class="col3">￥<span><?php echo $v['price']; ?>元</span></td>
                        <td class="col4">
                            <?php echo $v['goods_number']; ?>
                        </td>
                        <td class="col5">￥<span><?php $xj = $v['price'] * $v['goods_number'];$tp+=$xj;echo $xj; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo $tp; ?></span></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->

    </div>

    <div class="fillin_ft">
        <a onclick="document.forms['address_form'].submit();" href="javascript:void(0);"><span>提交订单</span></a>
        <p>应付总额：<strong>￥<?php echo $tp; ?>元</strong></p>

    </div>
</div>
<!-- 主体部分 end -->

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
            <a href="">京西论坛</a>
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
                var li = '您好，欢迎来到京西！[<a href="<?php echo U('Member/login'); ?>">登录</a>] [<a href="<?php echo U(' Member / regist '); ?>">免费注册</a>]'
                $("#logInfo").html(li);
        }
    });
</script>