<?php
namespace app\admin\controller;

use \think\Controller;
use think\Request;

class Account extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
    }
    public function index()
    {
        return $this->fetch();
    }
    public function detail()
    {
        return $this->fetch();
    }

}
