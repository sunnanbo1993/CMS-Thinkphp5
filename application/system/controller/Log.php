<?php
namespace app\system\controller;

use \think\Controller;
use think\Request;

class Log extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
    }

    public function index(){
        return $this->fetch();
    }
    public function detail(){
    	$id = $this->param['id'];
    	$this->assign('id',$id);
    	return $this->fetch();
    }
}
