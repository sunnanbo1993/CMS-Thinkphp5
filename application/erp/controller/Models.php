<?php
namespace app\erp\controller;

use \think\Controller;
use think\Request;

class Models extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();        
        $this->model = model('models');
    }
    public function index()
    {
        $list = $this->model->getModelsListData();
        return $this->fetch();
    }
    public function detail()
    {
        $info = $this->model->getModelsInfoDataById();
    }
    public function add()
    {
        return $this->fetch();
    }
    public function addSubmit()
    {
        $data = [];
        $brand_id = $this->model->insertModelsDataReturnId($data);
        if($brand_id !== 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function edit()
    {
        $info = $this->model->getModelsInfoDataById();
    }
    public function editSubmit()
    {
        $count = $this->model->updateModelsDataById();
    }
    public function delSubmit()
    {
        $count = $this->model->delModelsDataById();
    }
}
