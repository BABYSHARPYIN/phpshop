<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller 
{
	public function ajaxGetPl()
	{
		$goodsId = I('get.goods_id');
		$model = D('Admin/Comment');
		$data = $model->search($goodsId, 5);
		echo json_encode($data);
	}
	// AJAX发表评论
	public function add()
	{
		if(IS_POST)
		{
			$model = D('Admin/Comment');
			if($model->create(I('post.'), 1))
			{
				if($id = $model->add())
					$this->success(array(
						'id' => $id,
						'face' => session('face'),
						'username' => session('m_username'),
						'addtime' => date('Y-m-d H:i:s'),
						'content' => I('post.content'),
						'star' => I('post.star'),
					), '');
			}
			$this->error($model->getError(), '');
		}
	}
	// AJAX回复
	public function reply()
	{
		if(IS_POST)
		{
			$model = D('Admin/CommentReply');
			if($model->create(I('post.'), 1))
			{
				if($model->add())
					$this->success(array(
						'face' => session('face'),
						'username' => session('m_username'),
						'addtime' => date('Y-m-d H:i:s'),
						'content' => I('post.content'),
					));
			}
			$this->error($model->getError());
		}
	}
}





