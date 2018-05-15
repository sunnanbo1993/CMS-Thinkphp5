<?php
namespace app\erp\controller;

use \think\Controller;
use think\Request;

class Customer extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();        
        $this->model = model('customer');
    }
    public function index()
    {
        $list = $this->model->getCustomerListData();
        return $this->fetch();
    }
    public function detail()
    {
        $info = $this->model->getCustomerInfoDataById();
    }
    public function add()
    {
        return $this->fetch();
    }
    public function addSubmit()
    {
        $data = [];
        $brand_id = $this->model->insertCustomerDataReturnId($data);
        if($brand_id !== 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function edit()
    {
        $info = $this->model->getCustomerInfoDataById();
    }
    public function editSubmit()
    {
        $count = $this->model->updateCustomerDataById();
    }
    public function delSubmit()
    {
        $count = $this->model->delCustomerDataById();
    }
}
