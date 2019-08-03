<?php

namespace Home\Controller;

class IndexController extends NavController
{
    public function index()
    {
        //取出促销的商品
        $goodsModel = D('Admin/Goods');
        $goods1 = $goodsModel->getPromoteGoods();
        $goods2 = $goodsModel->getRecGoods('is_new');//新品
        $goods3 = $goodsModel->getRecGoods('is_hot');//热门
        $goods4 = $goodsModel->getRecGoods('is_best');//精品
        //取出首页楼层的数据
        $catModel = D('Admin/Category');
        $floorData =  $catModel->floorData();
        $this->assign(array(
            'goods1' => $goods1,
            'goods2' => $goods2,
            'goods3' => $goods3,
            'goods4' => $goods4,
            'floorData' => $floorData,
            
        ));
        //设置页面信息
        $this->assign(array(
            '_show_nav' => 1,
            '_page_title' => '首页',
            '_page_keywords'=>'首页',
            '_page_description'=>'首页',
        ));
        $this->display();
    }

    public function goods()
    {
        //设置页面信息
        $this->assign(array(
            '_page_title' => '商品详情页',
            '_page_keywords' => '商品详情页',
            '_page_description' => '商品详情页',
        ));
        $this->display();
    }
}
