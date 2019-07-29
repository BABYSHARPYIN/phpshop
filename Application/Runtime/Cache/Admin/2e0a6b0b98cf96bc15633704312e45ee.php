<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
</head>

<body>
    <h1>
        <?php if($_page_btn_name): ?>
        <span class="action-span"><a href="<?php echo $_page_btn_link; ?>"><?php echo $_page_btn_name; ?></a></span>
        <?php endif; ?>
        <span class="action-span1"><a href="#">管理中心</a></span>
        <span id="search_id" class="action-span1"> - <?php echo $_page_title; ?> </span>
        <div style="clear:both"></div>
    </h1>

    <!--  内容  -->
    

<!-- 搜索 -->
<div class="form-div search_form_div">
    <form action="/index.php/Admin/Admin/lst" method="GET" name="search_form">
        <p>
            用户名：
            <input type="text" name="username" size="30" value="<?php echo I('get.username'); ?>" />
        </p>
        <p><input type="submit" value=" 搜索 " class="button" /></p>
    </form>
</div>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th>用户名</th>
            <th>密码</th>
            <th>确认密码</th>
            <th width="60">操作</th>
        </tr>
        <?php foreach ($data as $k => $v): ?>
        <tr class="tron">
            <td>
                <?php echo $v['username']; ?>
            </td>
            <td>
                <?php echo $v['password']; ?>
            </td>
            <td>
                <?php echo $v['cpassword']; ?>
            </td>
            <td align="center">
                <a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a>
                <?php if($v['id']>1): ?>
                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">|移除</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(preg_match('/\d/', $page)): ?>
        <tr>
            <td align="right" nowrap="true" colspan="99" height="30">
                <?php echo $page; ?>
            </td>
        </tr>
        <?php endif; ?>
    </table>
</div>

<script>
</script>

<script src="/Public/Admin/Js/tron.js"></script>

    <div id="footer"> 共执行 29 个查询，用时 0.539249 秒，Gzip 已禁用，内存占用 3.502 MB 版权所有 © 2005-2021 yinruizuishuai@gmail.com，并保留所有权利。</div>
</body>

</html>