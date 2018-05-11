<?php
namespace app\admin\controller;

use \think\Controller;
use think\Request;

class User extends Controller
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
    public function add(){
        return $this->fetch();
    }
}
