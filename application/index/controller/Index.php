<?php
namespace app\index\controller;

use \think\Controller;
use think\Request;

class Index extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
    }

    public function index(){
        $menu = $this->_menu();
        $this->assign('menu',$menu);
        $topNav = $this->_topNav();
        $this->assign('topNav',$topNav);
        $main_content = $this->_mainContent();
        $this->assign('main_content',$main_content);
        $main_crumbs = $this->_mainCrumbs();
        $this->assign('main_crumbs',$main_crumbs);
        return $this->fetch();
    }
    public function _menu(){
        return $this->fetch('left_menu');
    }
    public function _topNav(){
        return $this->fetch('top_nav');
    }
    public function _mainContent(){
        return $this->fetch('main_content');
    }
    public function _mainCrumbs(){
        return $this->fetch('main_crumbs');
    }
}
