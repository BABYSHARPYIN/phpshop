<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        //设置页面信息
        $this->assign(array(
            '_page_title' => '首页',
        ));
        $this->display();
    }

    public function goods()
    {
        //设置页面信息
        $this->assign(array(
            '_page_title' => '商品详情页',
        ));
        $this->display();
    }
}
