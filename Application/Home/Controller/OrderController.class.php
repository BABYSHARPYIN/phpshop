<?php

namespace Home\Controller;

use Think\Controller;

class OrderController extends Controller
{
	//下单
	public function add()
	{
		//如果会员没有登录就跳到登录页面，登陆成功之后再跳回到这个页面
		$memberId = session('m_id');
		if (!$memberId) {
			//先把登陆成功之后要调回的地址存到session
			session('returnUrl', U('Order/add'));
			redirect(U('Member/login')); //如果乜有登录跳转到登陆页面
		}
		if (IS_POST) {
			$orderModel = D('Admin/Order');
			if ($orderModel->create(I('post.'), 1))
			 {
				if ($orderId = $orderModel->add()) {
					$this->success('下单成功!', U('order_success?id='.$orderId));
					exit;
				}
			}
			$this->error($orderModel->getError());
		}
		// 先取出购物车中所有的商品
		$cartModel = D('Cart');
		$data = $cartModel->cartList();
		// 设置页面信息
		$this->assign(array(
			'data' => $data,
			'_page_title' => '定单确认页',
			'_page_keywords' => '定单确认页',
			'_page_description' => '定单确认页',
		));
		$this->display();
	}
	public function order_success()
	{
		var_dump($_GET);
	}
}
