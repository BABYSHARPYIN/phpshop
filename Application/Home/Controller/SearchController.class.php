<?php

namespace Home\Controller;

use SphinxClient;

class SearchController extends NavController
{
  // 分类搜索
  public function cat_search()
  {
    $catId = I('get.cat_id');

    // 取出商品和翻页
    $goodsModel = D('Admin/Goods');
    $data = $goodsModel->cat_search($catId);

    // 根据上面搜索出来的商品计算筛选条件
    $catModel = D('Admin/Category');
    $searchFilter = $catModel->getSearchConditionByGoodsId($data['goods_id']);

    // 设置页面信息
    $this->assign(array(
      'page' => $data['page'],
      'data' => $data['data'],
      'searchFilter' => $searchFilter,
      '_page_title' => '分类搜索页',
      '_page_keywords' => '分类搜索页',
      '_page_description' => '分类搜索页',
    ));
    $this->display();
  }
  // 关键字搜索
  public function key_search()
  {
    //搜索关键字
    $key = I('get.key');

    // header('Content-Type:Text/html;cahrset=utf-8;');
    // //搜索SPHINX
    // require('./sphinxapi.php');
    // $sph = new \SphinxClient();
    // $sph -> SetServer('localhost',9312);
    // //第一个参数：要查询的关键字
    // //第二个参数：sphinx中索引的名字默认是*，所有的索引
    // $ret = $sph->Query($key,'goods');
    // //提取出商品的id
    // $ids = array_keys($ret['matches']);
    // $gModel = D('Goods');
    // $ret = $gModel->field('id,goods_name')->where(array(
    //   'id' => array('in',$ids), 
    // ))->select();
    // var_dump($ret);

    // 取出商品和翻页
    $goodsModel = D('Admin/Goods');
    $data = $goodsModel->key_search($key);

    // 根据上面搜索出来的商品计算筛选条件
    $catModel = D('Admin/Category');
    $searchFilter = $catModel->getSearchConditionByGoodsId($data['goods_id']);

    // 设置页面信息
    $this->assign(array(
      'page' => $data['page'],
      'data' => $data['data'],
      'searchFilter' => $searchFilter,
      '_page_title' => '关键字搜索页',
      '_page_keywords' => '关键字搜索页',
      '_page_description' => '关键字搜索页',
    ));
    $this->display();
  }
}
