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
        $this->model = model('store');
    }
    public function index()
    {
        $list = $this->model->getStoreListData();
        return $this->fetch();
    }
    public function detail()
    {
        $info = $this->model->getStoreInfoDataById();
    }
    public function add()
    {
        return $this->fetch();
    }
    public function addSubmit()
    {
        $data = [];
        $brand_id = $this->model->insertStoreDataReturnId($data);
        if($brand_id !== 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function edit()
    {
        $info = $this->model->getStoreInfoDataById();
    }
    public function editSubmit()
    {
        $count = $this->model->updateStoreDataById();
    }
    public function delSubmit()
    {
        $count = $this->model->delStoreDataById();
    }
}
