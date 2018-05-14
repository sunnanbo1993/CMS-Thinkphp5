<?php
namespace app\index\controller;

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

    public function index(){
        $action = $this->param['action'] ?? '';
        switch ($action) {
            case 'list':
                $main_content = $this->list();
                break;
            case 'add':
                $main_content = $this->add();
                break;
            default:
                $main_content = $this->list();
                break;
        }
        
        $this->assign('main_content',$main_content);
        return $this->fetch('index');
    }
    public function list(){
        $this->assign('title','xx管理');
        return $this->fetch('list');
    }
    public function add(){
        return $this->fetch('add');
    }

    
}
