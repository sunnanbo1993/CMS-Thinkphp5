<?php
namespace app\index\controller;

use think\Request;

class Index extends Common
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
    }
    public function index()
    {
    	$menu_list_html = $this->_menu();
        $this->assign('menu_list_html',$menu_list_html);

        $resp_list_html = $this->_resp();
    	$this->assign('resp_list_html',$resp_list_html);

        $top_nav_list_html = $this->_topNav();
        $this->assign('top_nav_list_html',$top_nav_list_html);

        $welcome_html = $this->_welcome();
    	$this->assign('welcome_html',$welcome_html);

        $content_html = $this->_content();
        $this->assign('content_html',$content_html);

        return $this->fetch();
    }

    public function _menu()
    {
    	return $this->fetch('menu');
    }
    public function _resp()
    {
        return $this->fetch('resp');
    }
    public function _topNav()
    {
        return $this->fetch('topnav');
    }
    public function _welcome()
    {
    	return $this->fetch('welcome');
    }
    public function _content()
    {
        $act = $this->param['act'] ?? '';
        switch ($act) {
            case 'list':
                return $this->_list();
                break;
            case 'add':
                return $this->_add();
                break;
            default:
                return $this->_list();
                break;
                break;
        }
        
    }
    public function _add(){
        return $this->fetch('add');
    }
    public function _list()
    {
        return $this->fetch('list');
    }
    public function _detail()
    {
        return $this->fetch('detail');
    }
}
