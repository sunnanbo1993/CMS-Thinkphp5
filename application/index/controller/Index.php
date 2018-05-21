<?php
namespace app\index\controller;

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
        Hook::add('run','app\\behavior\\checkAuth');
        Hook::listen('run');
    }
    public function welcome()
    {
        return $this->fetch();
    }
}
