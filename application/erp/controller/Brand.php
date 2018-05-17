<?php
namespace app\erp\controller;

use \think\Controller;
use think\Request;
use base\Result;

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
        $this->assign('list', $list);
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
        $state = -1;
        $msg = '添加失败';
        $number = create_guid();

        $data = [
            'number'      => $number,
            'brand_name'  => $this->param['name'],
            'brand_state' => $this->param['state'],
            'brand_sort'  => $this->param['sort'],
            'brand_desc'  => $this->param['desc'],
        ];
        $brand_id = $this->model->insertBrandDataReturnId($data);
        if($brand_id !== 0){
            $state = 1;
            $msg   = '添加成功';
        }
        return (new Result($state, $msg))->return();
    }
    public function edit()
    {
        $info = $this->model->getBrandInfoDataById($this->param['id']);
        $this->assign('info', $info);
        return $this->fetch();
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
