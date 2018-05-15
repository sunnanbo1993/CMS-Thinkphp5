<?php
namespace app\erp\controller;

use \think\Controller;
use think\Request;

class Sell extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
        $this->model = model('sell');
    }
    public function index()
    {
        $list = $this->model->getSellListData();
        return $this->fetch();
    }
    public function detail()
    {
        $info = $this->model->getSellInfoDataById();
    }
    public function add()
    {
        return $this->fetch();
    }
    public function addSubmit()
    {
        $data = [];
        $brand_id = $this->model->insertSellDataReturnId($data);
        if($brand_id !== 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function edit()
    {
        $info = $this->model->getSellInfoDataById();
    }
    public function editSubmit()
    {
        $count = $this->model->updateSellDataById();
    }
    public function delSubmit()
    {
        $count = $this->model->delSellDataById();
    }
}
