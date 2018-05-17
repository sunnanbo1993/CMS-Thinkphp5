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
        $brand_list = $this->model->getBrandListData();
        $this->assign('brand_list', $brand_list);
        return $this->fetch();
    }
    public function addSubmit()
    {
        $state = -1;
        $msg = '添加失败';
        $number = create_guid();
        $data = [
            'number'       => $number,
            'brand_id'     => $this->param['brand'],
            'models_name'  => $this->param['name'],
            'models_state' => $this->param['state'],
            'models_sort'  => $this->param['sort'],
            'models_desc'  => $this->param['desc'],
        ];
        $color_array  = explode(',', $this->param['color']);
        $memory_array = explode(',', $this->param['memory']);
        $models_id = $this->model->insertModelsDataReturnId($data, $color_array, $memory_array);
        if($models_id !== 0){
            $state = 1;
            $msg   = '添加成功';
        }
        return (new Result($state, $msg))->return();
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
