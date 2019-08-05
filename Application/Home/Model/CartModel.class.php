<?php

namespace Home\Model;

use THINK\Model;

class Cart extends Model
{
  //加入购物车时，允许接收的字段
  protected $insertFields = 'goods_id,goods_attr_id,goods_number';
  //加入购物车时的表单验证规则
  protected $_validate = array(
    array('goods_id', 'require', '必须选择商品', 1),
    array('goods_number', 'require', '库存量不足', 1, 'callback'),
  );
  //检查库存量
  public function chkGoodsNumber($goodsNumber)
  {
    //选择的商品属性id
    $gaid = I('post.goods_attr_id');
    sort($gaid, SORT_NUMERIC); //以数字的方式升序排列
    $gaid = implode(',', $gaid);
    //取出库存量
    $gnModel = D('goods_number');
    $gn = $gnModel->field('goods_number')->where(array(
      'goods_id' => I('post.goods_id'),
      'goods_attr_id' => $gaid,
    ))->find();
    //返回库存量是否够
    return ($gn['goods_number'] >= $goodsNumber);
  }
  //重写父类的ADD方法：判断，如果没有登录存COOKIE，否侧存data
  public function add()
  {
    $memberId = session('m_id');
    if ($memberId) {
      $has = $this->field('id')->where(array(
        'member_id' => $memberId,
        'goods_id' => $this->goods_id,
        'goods_attr_id' => $this->goods_attr_id,
      ))->find();
      if ($has)
        $this->where(array(
          'id' => array('eq', $has['id']),
        ))->setInc('goods_number', $this->goods_number);
      //调用父类的ADD方法
      else
        parent::add(array(
          'member_id' => $memberId,
          'goods_id' => $this->goods_id,
          'goods_attr_id' => $this->goods_attr_id,
          'goods_number' => $this->goods_number,
        ));
    } else {
      //从cookie中取出购物车的一维数组
      $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
      //先拼一个下标
      $key = $this->goods_id . '-' . $this->goods_attr_id;
      if (isset($cart[$key]))
        $cart[$key] += $this->goods_number;
      else
        //把商品加进去
        $cart[$key] = $this->goods_number;
      //把一维数组存回到COOKIE
      setcookie('cart', serialize($cart), time() + 3 * 86400, '/');  //三天后购物车中的商品将会过期

    }
  }
}
