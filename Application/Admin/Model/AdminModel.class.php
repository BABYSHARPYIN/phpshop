<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model 
{
	protected $insertFields = array('username','password','cpassword');
	protected $updateFields = array('id','username','password','cpassword');
	protected $_validate = array(
		array('username', 'require', '用户名不能为空！', 1, 'regex', 3),
		array('username', '1,30', '用户名的值最长不能超过 30 个字符！', 1, 'length', 3),
		//第六个参数：规则什么时候生效：1、添加时生效 2、修改时生效 3、所有情况都生效
		array('password', 'require', '密码不能为空！', 1, 'regex', 1),
		array('username', '', '用户名已经存在！', 1, 'unique', 3),
		array('cpassword', 'password', '两次密码输入不一致！', 1, 'confirm', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($username = I('get.username'))
			$where['username'] = array('like', "%$username%");
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')
		->field('a.*,GROUP_CONCAT(c.role_name) role_name')
		->join('LEFT JOIN __ADMIN_ROLE__ b ON a.id=b.admin_id
						LEFT JOIN __ROLE__ c ON b.role_id=c.id')
		->where($where)
		->group('a.id')
		->limit($page->firstRow.','.$page->listRows)
		->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
		$data['password'] = md5($data['password']);
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
		$roleId = I('post.role_id');
		$arModel = D('admin_role');
		$arModel->where(array(
			'admin_id'=>$option['where']['id'],
		))->delete();
		foreach($roleId as $v){
			$arModel->add(array(
				'admin_id' => $option['where']['id'],
				'role_id' => $v,
			));
		}

		if($data['password']){
			$data['password'] = md5($data['password']);
		}else{
		 unset ($data['password']); //从表单中删除这个字段，就不会修改表单
		}
	}
	protected function _after_insert(&$data, $options)
	{
		$roleId = I('post.role_id');
		$arModel = D('admin_role');
		foreach($roleId as $v){
			$arModel->add(array(
				'admin_id' => $data['id'],
				'role_id' => $v,
			));
		}
	}
	// 删除前
	protected function _before_delete($option)
	{
		if($option['where']['id'] == 1)
		{
			$this->error = '超级管理员无法删除！';
			return FALSE;
		}
		$arModel = D('admin_role');
		$arModel->where(array(
			'admin_id'=>array('eq',$option['where']['id'])
		))->delete();
	}
	/************************************ 其他方法 ********************************************/
}