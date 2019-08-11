<?php

namespace Admin\Model;

use Think\Model;

class CategoryModel extends Model
{
	protected $insertFields = array('cat_name', 'parent_id', 'is_floor');
	protected $updateFields = array('id', 'cat_name', 'parent_id', 'is_floor');
	protected $_validate = array(
		array('cat_name', 'require', '分类名称不能为空！', 1, 'regex', 3),
	);

	// 找一个分类所有子分类的ID
	public function getChildren($catId)
	{
		// 取出所有的分类
		$data = $this->select();
		// 递归从所有的分类中挑出子分类的ID
		return $this->_getChildren($data, $catId, TRUE);
	}
	/**
	 * 递归从数据中找子分类
	 */
	private function _getChildren($data, $catId, $isClear = FALSE)
	{
		static $_ret = array();  // 保存找到的子分类的ID
		if ($isClear)
			$_ret = array();
		// 循环所有的分类找子分类
		foreach ($data as $k => $v) {
			if ($v['parent_id'] == $catId) {
				$_ret[] = $v['id'];
				// 再找这个$v的子分类
				$this->_getChildren($data, $v['id']);
			}
		}
		return $_ret;
	}
	// 获取树形数据
	public function getTree()
	{
		$data = $this->select();
		return $this->_getTree($data);
	}
	private function _getTree($data, $parent_id = 0, $level = 0)
	{
		static $_ret = array();
		foreach ($data as $k => $v) {
			if ($v['parent_id'] == $parent_id) {
				$v['level'] = $level;  // 用来标记这个分类是第几级的
				$_ret[] = $v;
				// 找子分类
				$this->_getTree($data, $v['id'], $level + 1);
			}
		}
		return $_ret;
	}

	protected function _before_delete(&$option)
	{
		/************** 修改原$option，把所有子分类的ID也加进来，这样TP会一起删除掉 *******/
		// 先找出所有子分类的ID
		$children = $this->getChildren($option['where']['id']);
		$children[] = $option['where']['id'];
		$option['where']['id'] = array(
			0 => 'IN',
			1 => implode(',', $children),
		);
	}
	/**
	 * 获取导航条上的数据
	 *
	 */
	public function getNavData()
	{
		// 先从缓存中取出数据
		$catData = S('catData');
		// 判断如果没有缓存或者缓存过期就重新构造数组
		if (!$catData) {
			// 取出所有的分类
			$all = $this->select();
			$ret = array();
			// 循环所有的分类找出顶级分类
			foreach ($all as $k => $v) {
				if ($v['parent_id'] == 0) {
					// 循环所有的分类找出这个顶级分类的子分类
					foreach ($all as $k1 => $v1) {
						if ($v1['parent_id'] == $v['id']) {
							// 循环所有的分类找出这个二级分类的子分类
							foreach ($all as $k2 => $v2) {
								if ($v2['parent_id'] == $v1['id']) {
									$v1['children'][] = $v2;
								}
							}
							$v['children'][] = $v1;
						}
					}
					$ret[] = $v;
				}
			}
			// 把数组缓存1天
			S('catData', $ret, 86400);
			return $ret;
		} else
			return $catData;  // 有缓存直接返回缓存数据
	}
	/**
	 * 取出一个分类所有上级分类
	 */
	public function parentPath($catId)
	{
		static $ret = array();
		$info = $this->field('id,cat_name,partent_id')->find($catId);
		$ret[] = $info;
		//如果还有上级再取上级的信息
		if($info['parent_id']>0)
			$this ->parentPath($info['parent_id']);
		return $ret;
	}
	/**
	 * 获取前台首页楼层中的数据
	 */
	public function floorData()
	{
		$floorData = S('floorData');
		if ($floorData)
			return $floorData;
		else {
			//先取出推荐到楼层的顶级分类
			$ret = $this->where(array(
				'parent_id' => array('eq', 0),
				'is_floor' => array('eq', '是'),
			))->select();
			$goodsModel = D('Admin/Goods');
			//循环每个楼层取出楼层中的数据
			foreach ($ret as $k => $v) {
				/*********这个楼层中的品牌数据 */
				//思路：先取出这个楼层下所有的商品ID
				$goodsId = $goodsModel->getGoodsIdByCatId($v['id']);
				//再取出这些商品所用到的品牌
				$ret[$k]['brand'] = $goodsModel->alias('a')
					->join('LEFT JOIN __BRAND__ b ON a.brand_id=b.id')
					->field('DISTINCT a.brand_id,b.brand_name,b.logo') //唯一的品牌
					->where(array(
						'a.id' => array('in', $goodsId),
						'a.brand_id' => array('neq', 0), //品牌ID不等于0的商品
					))->limit(9)->select();

				/**取出未推荐的二级分类，并保存到这个顶级分类的subCat字段中 */
				$ret[$k]['subCat'] =	$this->where(array(
					'parent_id' => array('eq', $v['id']),
					'is_floor' => array('eq', '否'),
				))->select();
				/**取出推荐的二级分类，并保存到这个顶级分类的subCat字段中 */
				$ret[$k]['recSubCat'] =	$this->where(array(
					'parent_id' => array('eq', $v['id']),
					'is_floor' => array('eq', '是'),
				))->select();
				/**循环每个推荐的二级分类取出分类下的8件被推荐到楼层的商品 */
				foreach ($ret[$k]['recSubCat'] as $k1 => &$v1) {
					//取出这个分类下所有商品的ID并返回一维数组
					$gids = $goodsModel->getGoodsIdByCatId($v1['id']);
					//再根据商品ID取出商品的详细信息
					$v1['goods'] = $goodsModel->field('id,mid_logo,goods_name,shop_price')
						->where(array(
							'is_on_sale' => array('eq', '是'),
							'is_floor' => array('eq', '是'),
							'id' => array('in', $gids),
						))->order('sort_num ASC')->limit(8)->select();
				}
			}
			S('floorData', $ret, 86400);
			return $ret;
		}
	}
	/**
	 * cat_search搜索页
	 */
	public function getSearchConditionByGoodsId($goodsId)
	{
		$ret = array();  // 返回的数组
		
		$goodsModel = D('Admin/Goods');
		// 先取出这个分类下所有商品的id
		//$goodsId = $goodsModel->getGoodsIdByCatId($catId);
		
		/***************** 品牌 ********************/
		// 根据商品ID取出品牌ID再连品牌表取出品牌名称
		$ret['brand'] = $goodsModel->alias('a')
		->field('DISTINCT brand_id,b.brand_name,b.logo')
		->join('LEFT JOIN __BRAND__ b ON a.brand_id=b.id')
		->where(array(
			'a.id' => array('in', $goodsId),
			'a.brand_id' => array('neq', 0),
		))->select();
		
		/***************** 价格区间段 *****************/
		$sectionCount = 6;  // 默认分几段
		// 取出这个分类下最大和最小的价格
		$priceInfo = $goodsModel->field('MAX(shop_price) max_price,MIN(shop_price) min_price')
		->where(array(
			'id' => array('in', $goodsId),
		))->find();
		
		// 最大价和最小价的区间
		$priceSection = $priceInfo['max_price'] - $priceInfo['min_price'];
		// 分类下商品的数量
		$goodsCount = count($goodsId);
		// 只有商品数量有这些时价格才分段
		if($goodsCount > 1)
		{
			// 根据最大价和最小价的差值计算分几段
			if($priceSection < 1000)
				$sectionCount = 2;
			elseif ($priceSection < 5000)
				$sectionCount = 4;
			elseif ($priceSection < 10000)
				$sectionCount = 6;
			else 
				$sectionCount = 7;
			// 根据这些段数分段
			$pricePerSection = ceil($priceSection / $sectionCount);  // 每段的范围
			$price = array();   // 存放最终的分段数据
			$firstPrice = 0;   // 第一个价格段的开始价格
			// 循环放每个段
			for($i=0; $i<$sectionCount; $i++)
			{
				// 每段结束的价格
				$_tmpEnd = $firstPrice+$pricePerSection;
				// 把结束的价格取整
				$_tmpEnd = ((ceil($_tmpEnd / 100)) * 100 - 1);
				$price[] = $firstPrice . '-' . $_tmpEnd;
				// 计算下一个的价格段的开始价格
				$firstPrice = $_tmpEnd+1;
			}
			// 放到返回的数组中
			$ret['price'] = $price;
		}
		
		/***************** 商品属性 ********************/
		$gaModel = D('goods_attr');
		$gaData = $gaModel->alias('a')
		->field('DISTINCT a.attr_id,a.attr_value,b.attr_name')
		->join('LEFT JOIN __ATTRIBUTE__ b ON a.attr_id=b.id')
		->where(array(
			'a.goods_id' => array('in', $goodsId),
			'a.attr_value' => array('neq', ''),
		))
		->select();
		// 处理这个属性数组：把属性相同的放到一起用属性名称做为下标-》2维转3维
		$_gaData = array();
		foreach ($gaData as $k => $v)
		{
			$_gaData[$v['attr_name']][] = $v;
		}
		// 放到返回数组中
		$ret['gaData'] = $_gaData;
		
		// 返回数组
		return $ret;
	}
}
