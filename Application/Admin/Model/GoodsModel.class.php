<?php

namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model
{
	// 添加时调用create方法允许接收的字段
	protected $insertFields = 'cat_id,goods_name,market_price,shop_price,is_on_sale,goods_desc,brand_id';
	// 修改时调用create方法允许接收的字段
	protected $updateFields = 'cat_id,id,goods_name,market_price,shop_price,is_on_sale,goods_desc,brand_id';
	//定义验证规则
	protected $_validate = array(
		array('cat_id', 'require', '必须选择一个主分类！', 1),
		array('goods_name', 'require', '商品名称不能为空！', 1),
		array('market_price', 'currency', '市场价格必须是货币类型！', 1),
		array('shop_price', 'currency', '本店价格必须是货币类型！', 1),
	);

	// 这个方法在添加之前会自动被调用 --》 钩子方法
	// 第一个参数：表单中即将要插入到数据库中的数据->数组
	// &按引用传递：函数内部要修改函数外部传进来的变量必须按钮引用传递，除非传递的是一个对象,因为对象默认是按引用传递的
	protected function _before_insert(&$data, $option)
	{
		/**************** 处理LOGO *******************/
		// 判断有没有选择图片
		if ($_FILES['logo']['error'] == 0) {
			$ret = uploadOne('logo', 'Goods', array(
				array(700, 700),
				array(350, 350),
				array(130, 130),
				array(50, 50),
			));
			$data['logo'] = $ret['images'][0];
			$data['mbig_logo'] = $ret['images'][1];
			$data['big_logo'] = $ret['images'][2];
			$data['mid_logo'] = $ret['images'][3];
			$data['sm_logo'] = $ret['images'][4];
		}
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime'] = date('Y-m-d H:i:s', time());
		// 我们自己来过滤这个字段
		$data['goods_desc'] = removeXSS($_POST['goods_desc']);
	}

	protected function _before_update(&$data, $option)
	{
		$id = $option['where']['id'];  // 要修改的商品的ID
		/************ 处理相册图片 *****************/
		if (isset($_FILES['pic'])) {
			$pics = array();
			foreach ($_FILES['pic']['name'] as $k => $v) {
				$pics[] = array(
					'name' => $v,
					'type' => $_FILES['pic']['type'][$k],
					'tmp_name' => $_FILES['pic']['tmp_name'][$k],
					'error' => $_FILES['pic']['error'][$k],
					'size' => $_FILES['pic']['size'][$k],
				);
			}
			$_FILES = $pics;  // 把处理好的数组赋给$_FILES，因为uploadOne函数是到$_FILES中找图片
			$gpModel = D('goods_pic');
			// 循环每个上传
			foreach ($pics as $k => $v) {
				if ($v['error'] == 0) {
					$ret = uploadOne($k, 'Goods', array(
						array(650, 650),
						array(350, 350),
						array(50, 50),
					));
					if ($ret['ok'] == 1) {
						$gpModel->add(array(
							'pic' => $ret['images'][0],
							'big_pic' => $ret['images'][1],
							'mid_pic' => $ret['images'][2],
							'sm_pic' => $ret['images'][3],
							'goods_id' => $id,
						));
					}
				}
			}
		}
		/************ 处理会员价格 ****************/
		$mp = I('post.member_price');
		$mpModel = D('member_price');
		// 先删除原来的会员价格
		$mpModel->where(array(
			'goods_id' => array('eq', $id),
		))->delete();
		foreach ($mp as $k => $v) {
			$_v = (float) $v;
			// 如果设置了会员价格就插入到表中
			if ($_v > 0) {
				$mpModel->add(array(
					'price' => $_v,
					'level_id' => $k,
					'goods_id' => $id,
				));
			}
		}
		/**************** 处理LOGO *******************/
		// 判断有没有选择图片
		if ($_FILES['logo']['error'] == 0) {
			$ret = uploadOne('logo', 'Goods', array(
				array(700, 700),
				array(350, 350),
				array(130, 130),
				array(50, 50),
			));
			$data['logo'] = $ret['images'][0];
			$data['mbig_logo'] = $ret['images'][1];
			$data['big_logo'] = $ret['images'][2];
			$data['mid_logo'] = $ret['images'][3];
			$data['sm_logo'] = $ret['images'][4];
			/*************** 删除原来的图片 *******************/
			// 先查询出原来图片的路径
			$oldLogo = $this->field('logo,mbig_logo,big_logo,mid_logo,sm_logo')->find($id);
			deleteImage($oldLogo);
		}

		// 我们自己来过滤这个字段
		$data['goods_desc'] = removeXSS($_POST['goods_desc']);
	}

	protected function _before_delete($option)
	{
		$id = $option['where']['id'];   // 要删除的商品的ID
		/************** 删除相册中的图片 ********************/
		// 先从相册表中取出相册所在硬盘的路径
		$gpModel = D('goods_pic');
		$pics = $gpModel->field('pic,sm_pic,mid_pic,big_pic')->where(array(
			'goods_id' => array('eq', $id),
		))->select();
		// 循环每个图片从硬盘上删除图片
		foreach ($pics as $k => $v)
			deleteImage($v);  //删除pic,sm_pic,mid_pic,big_pic四张
		// 从数据库中把记录删除
		$gpModel->where(array(
			'goods_id' => array('eq', $id),
		))->delete();
		/*************** 删除原来的图片 *******************/
		// 先查询出原来图片的路径
		$oldLogo = $this->field('logo,mbig_logo,big_logo,mid_logo,sm_logo')->find($id);
		deleteImage($oldLogo);
		/************* 删除会员价格 ******************/
		$mpModel = D('member_price');
		$mpModel->where(array(
			'goods_id' => array('eq', $id),
		))->delete();
	}
	/**
	 * 取出一个分类下所有商品的ID(既考虑主分类也考虑了扩展分类)
	 */
	public function getGoodsIdByCatId($catId)
	{
		//先取出所有在分类的id
		$catModel = D('category');
		$children = $catModel->getChildren($catId);
		//和子分类放在一起
		$children[] = $catId;
		/**取出主分类或者扩展分类在这些分类中的商品 */
		//取出主分类下的商品ID
		$gids = $this->field('id')->where(array(
			'cat_id' => array('in', $children), //主分类下的商品
		))->select();

		//取出扩展分类下的ID
		$gcModel = D('goods_cat');
		$gids1 = $gcModel->field('DISTINCT goods_id id')->where(array(
			'cat_id' => array('IN', $children)
		))->select();

		//把主分类下的ID和扩展分类下的商品ID合并成一个二维数组【两个都不为空时合并，否则取出不为空的数组】
		if ($gids && $gids1)
			$gids = array_merge($gids, $gids1);
		elseif ($gids1)
			$gids = $gids1;

		//二维转一维数组
		$id = array();
		foreach ($gids as $k => $v) {
			if (!in_array($v['id'], $id))	//判断去重
				$id[] = $v['id'];
		}
		return $id;
	}

	/**
	 * 实现翻页、搜索、排序
	 *
	 */
	public function search($perPage = 5)
	{
		/*************** 搜索 ******************/
		$where = array();  // 空的where条件
		// 商品名称
		$gn = I('get.gn');
		if ($gn)
			$where['a.goods_name'] = array('like', "%$gn%");  // WHERE goods_name LIKE '%$gn%'
		// 价格
		$fp = I('get.fp');
		$tp = I('get.tp');
		if ($fp && $tp)
			$where['a.shop_price'] = array('between', array($fp, $tp)); // WHERE shop_price BETWEEN $fp AND $tp
		elseif ($fp)
			$where['a.shop_price'] = array('egt', $fp);   // WHERE shop_price >= $fp
		elseif ($tp)
			$where['a.shop_price'] = array('elt', $tp);   // WHERE shop_price <= $fp
		// 是否上架
		$ios = I('get.ios');
		if ($ios)
			$where['a.is_on_sale'] = array('eq', $ios);  // WHERE is_on_sale = $ios
		// 添加时间
		$fa = I('get.fa');
		$ta = I('get.ta');
		if ($fa && $ta)
			$where['a.addtime'] = array('between', array($fa, $ta)); // WHERE shop_price BETWEEN $fp AND $tp
		elseif ($fa)
			$where['a.addtime'] = array('egt', $fa);   // WHERE shop_price >= $fp
		elseif ($ta)
			$where['a.addtime'] = array('elt', $ta);   // WHERE shop_price <= $fp
		// 品牌
		$brandId = I('get.brand_id');
		if ($brandId)
			$where['a.brand_id'] = array('eq', $brandId);
		//主分类的搜索
		$catId = I('get.cat_id');
		if ($catId) {
			//先查询出这个分类ID下所有的商品
			$gids =	$this->getGoodsIdByCatId($catId);

			//应用到取数据的where上
			$where['a.id'] = array('in', $gids);
		}

		/*************** 翻页 ****************/
		// 取出总的记录数
		$count = $this->where($where)->count();
		// 生成翻页类的对象
		$pageObj = new \Think\Page($count, $perPage);
		// 设置样式
		$pageObj->setConfig('next', '下一页');
		$pageObj->setConfig('prev', '上一页');
		// 生成页面下面显示的上一页、下一页的字符串
		$pageString = $pageObj->show();

		/***************** 排序 *****************/
		$orderby = 'a.id';      // 默认的排序字段 
		$orderway = 'desc';   // 默认的排序方式
		$odby = I('get.odby');
		if ($odby) {
			if ($odby == 'id_asc')
				$orderway = 'asc';
			elseif ($odby == 'price_desc')
				$orderby = 'shop_price';
			elseif ($odby == 'price_asc') {
				$orderby = 'shop_price';
				$orderway = 'asc';
			}
		}

		/************** 取某一页的数据 ***************/
		/**
		 * SELECT a.*,b.brand_name FROM p39_goods a LEFT JOIN p39_brand b ON a.brand_id=b.id
		 */
		$data = $this->order("$orderby $orderway")                    // 排序
			->field('a.*,b.brand_name,c.cat_name,GROUP_CONCAT(e.cat_name) ext_cat_name') //GROUP_CONCAT将分组内的值拼在一起默认使用','连接
			->alias('a')
			->join('LEFT JOIN __BRAND__ b ON a.brand_id=b.id
						LEFT JOIN __CATEGORY__ c ON a.cat_id = c.id
						LEFT JOIN __GOODS_CAT__ d ON a.id = d.goods_id
						LEFT JOIN __CATEGORY__ e ON d.cat_id = e.id')				//取主分类名称
			->where($where)                                               // 搜索
			->limit($pageObj->firstRow . ',' . $pageObj->listRows)            // 翻页
			->group('a.id') //根据商品id分组
			->select();

		/************** 返回数据 ******************/
		return array(
			'data' => $data,  // 数据
			'page' => $pageString,  // 翻页字符串
		);
	}

	/**
	 * 商品添加之后会调用这个方法，其中$data['id']就是新添加的商品的ID
	 */
	protected function _after_insert($data, $option)
	{
		/**************处理扩展分类 */
		$ecid = I('post.ext_cat_id');
		if ($ecid) {
			$gcModel = D('goods_cat');
			foreach ($ecid as $k => $v) {
				if (empty($v)) {
					continue;
				}
				$gcModel->add(array(
					'cat_id' => $v,
					'goods_id' => $data['id'],
				));
			}
		}
		/************ 处理相册图片 *****************/
		if (isset($_FILES['pic'])) {
			$pics = array();
			foreach ($_FILES['pic']['name'] as $k => $v) {
				$pics[] = array(
					'name' => $v,
					'type' => $_FILES['pic']['type'][$k],
					'tmp_name' => $_FILES['pic']['tmp_name'][$k],
					'error' => $_FILES['pic']['error'][$k],
					'size' => $_FILES['pic']['size'][$k],
				);
			}
			$_FILES = $pics;  // 把处理好的数组赋给$_FILES，因为uploadOne函数是到$_FILES中找图片
			$gpModel = D('goods_pic');
			// 循环每个上传
			foreach ($pics as $k => $v) {
				if ($v['error'] == 0) {
					$ret = uploadOne($k, 'Goods', array(
						array(650, 650),
						array(350, 350),
						array(50, 50),
					));
					if ($ret['ok'] == 1) {
						$gpModel->add(array(
							'pic' => $ret['images'][0],
							'big_pic' => $ret['images'][1],
							'mid_pic' => $ret['images'][2],
							'sm_pic' => $ret['images'][3],
							'goods_id' => $data['id'],
						));
					}
				}
			}
		}
		/************ 处理会员价格 ****************/
		$mp = I('post.member_price');
		$mpModel = D('member_price');
		foreach ($mp as $k => $v) {
			$_v = (float) $v;
			// 如果设置了会员价格就插入到表中
			if ($_v > 0) {
				$mpModel->add(array(
					'price' => $_v,
					'level_id' => $k,
					'goods_id' => $data['id'],
				));
			}
		}
	}
}
