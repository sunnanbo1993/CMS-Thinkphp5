<?php
namespace app\erp\controller;

use \think\Controller;
use think\Request;

class Store extends Controller
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
    public function add()
    {
        return $this->fetch();
    }
}
