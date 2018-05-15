<?php
namespace app\erp\controller;

use \think\Controller;
use think\Request;

class Brand extends Controller
{
    protected $param = [];
    protected $model;
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
        $this->model = model('brand');
    }
    public function index()
    {
        $list = $this->model->getBrandListData();
        return $this->fetch();
    }
    public function detail()
    {
        $info = $this->model->getBrandInfoDataById();
    }
    public function add()
    {
        return $this->fetch();
    }
    public function addSubmit()
    {
        $data = [];
        $brand_id = $this->model->insertBrandDataReturnId($data);
        if($brand_id !== 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function edit()
    {
        $info = $this->model->getBrandInfoDataById();
    }
    public function editSubmit()
    {
        $count = $this->model->updateBrandDataById();
    }
    public function delSubmit()
    {
        $count = $this->model->delBrandDataById();
    }
}
