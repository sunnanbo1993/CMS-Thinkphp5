<?php
namespace app\login\controller;

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
    public function index()
    {
        return $this->fetch();
    }
}
