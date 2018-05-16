<?php
namespace app\index\controller;

use app\behavior\checkAuth;
use \think\Controller;
use think\Request;
use \think\Hook;
class Index extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
    }

    public function index()
    {
        $result = Hook::listen('run');
        if(empty($result))
        {
            $this->error('您还没有登录',url('/login/index'));
        }
        else
        {
            $this->error($result,url('/login/index'));
        }
        return $this->fetch();
    }
    public function welcome()
    {
        return $this->fetch();
    }
}
