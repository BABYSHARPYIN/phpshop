<?php

namespace Home\Controller;

use Think\Controller;

class NavController extends Controller
{
    public function __construct() //构造函数
    {
      //必须先调用父类的构造函数
      parent::__construct();
      $catModel = D('Admin/Category');
      $catData = $catModel ->getNavData();
      $this -> assign('catData',$catData);
    }
}