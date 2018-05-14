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
        $controller = $this->param['c'] ?? '';
        switch ($controller) {
            case 'brand':
                $main_content = $this->brand();
                break;
            case 'mobile':
                $main_content = $this->mobile();
                break;
            case 'customer':
                $main_content = $this->customer();
                break;
            case 'integral':
                $main_content = $this->integral();
                break;
            case 'store':
                $main_content = $this->store();
                break;
            case 'sell':
                $main_content = $this->sell();
                break;
            default:
                $main_content = $this->brand();
                break;
        }
        $this->assign('main_content',$main_content);
        return $this->fetch('index');
    }
    public function brand(){
        $this->param['thead'] = [
            '','品牌名称','状态','排序','操作'
        ];
        $this->param['title'] = '品牌列表';
        $this->param['add_title'] = '新增品牌';
        $this->param['data'] = $this->brandData();
        return $this->action();
    }
    public function mobile(){
        $this->param['thead'] = [
            '','机型名称','品牌','状态','排序','操作'
        ];
        $this->param['title'] = '机型列表';
        $this->param['add_title'] = '新增机型';
        $this->param['data'] = $this->mobileData();
        return $this->action();
    }
    public function customer(){
        $this->param['thead'] = [
            '','客户名称','手机号','最后一次购买时间','操作'
        ];
        $this->param['title'] = '客户列表';
        $this->param['add_title'] = '新增客户';
        $this->param['data'] = $this->customerData();
        return $this->action();
    }
    public function integral(){
        $this->param['thead'] = [
            '','积分分数','赠品名称','赠品价值','状态','排序','操作'
        ];
        $this->param['title'] = '积分兑换列表';
        $this->param['add_title'] = '新增积分兑换';
        $this->param['data'] = $this->integralData();
        return $this->action();
    }
    public function store(){
        $this->param['thead'] = [
            '','机型名称','颜色','内存','进货价格','出货价格','库存数量','操作'
        ];
        $this->param['title'] = '库存列表';
        $this->param['add_title'] = '新增库存';
        $this->param['data'] = $this->storeData();
        return $this->action();
    }
    public function sell(){
        $this->param['thead'] = [
            '','销售时间','客户名称','购买机型','来源','操作'
        ];
        $this->param['title'] = '销售列表';
        $this->param['add_title'] = '新增销售';
        $this->param['data'] = $this->sellData();
        return $this->action();
    }
    public function action(){
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
        return $main_content;
    }
    public function list(){
        $this->assign('title', $this->param['title']);
        $this->assign('thead', $this->param['thead']);
        $this->assign('c', $this->param['c']);
        $this->assign('data', $this->param['data']);
        return $this->fetch('list');
    }
    public function add(){
        $this->assign('add_title', $this->param['add_title']);
        $this->assign('c', $this->param['c']);
        return $this->fetch('add');
    }
    public function brandData(){
        $data = [
            [
                'brand_name' => 'oppo',
                'state' => '1',
                'sort' => '99',
            ],
            [
                'brand_name' => 'vivo',
                'state' => '1',
                'sort' => '99',
            ],
            [
                'brand_name' => '苹果',
                'state' => '1',
                'sort' => '99',
            ]
        ];
        return $data;
    }
    public function mobileData(){
        $data = [
            [
                'model_name' => 'R11S',
                'brand_name' => 'oppo',
                'state' => '1',
                'sort' => '99',
            ],
            [
                'model_name' => 'X21',
                'brand_name' => 'vivo',
                'state' => '1',
                'sort' => '99',
            ],
            [
                'model_name' => 'iphoneX',
                'brand_name' => '苹果',
                'state' => '1',
                'sort' => '99',
            ]
        ];
        return $data;
    }
    public function customerData(){
        $data = [
            [
                'customer_name' => '张三',
                'mobile' => '18888888888',
                'last_buy_time' => date('Y-m-d'),
            ],
            [
                'customer_name' => '张三',
                'mobile' => '18888888888',
                'last_buy_time' => date('Y-m-d'),
            ],
            [
                'customer_name' => '张三',
                'mobile' => '18888888888',
                'last_buy_time' => date('Y-m-d'),
            ]
        ];
        return $data;
    }
    public function integralData(){
        $data = [
            [
                'integral_amount' => 999,
                'complimentary_name' => '电饭煲',
                'complimentary_price' => 9996,
                'state' => '1',
                'sort' => '99',
            ],
            [
                'integral_amount' => 999,
                'complimentary_name' => '电饭煲',
                'complimentary_price' => 9996,
                'state' => '1',
                'sort' => '99',
            ],
            [
                'integral_amount' => 999,
                'complimentary_name' => '电饭煲',
                'complimentary_price' => 9996,
                'state' => '1',
                'sort' => '99',
            ]
        ];
        return $data;
    }
    public function storeData(){
        $data = [
            [
                'model_name' => 'R11S',
                'color' => '红色',
                'ram' => '256',
                'purchase_price' => '2456',
                'sell_price' => '2998',
                'store_amount' => '13',
            ],
            [
                'model_name' => 'R11S',
                'color' => '红色',
                'ram' => '256',
                'purchase_price' => '2456',
                'sell_price' => '2998',
                'store_amount' => '13',
            ],[
                'model_name' => 'R11S',
                'color' => '红色',
                'ram' => '256',
                'purchase_price' => '2456',
                'sell_price' => '2998',
                'store_amount' => '13',
            ]
        ];
        return $data;
    }
    public function sellData(){
        $data = [
            [
                'sell_date' => date('Y-m-d'),
                'customer_name' => '张三',
                'mobile_name' => '1111',
                'source' => '1',
            ],
            [
                'sell_date' => date('Y-m-d'),
                'customer_name' => '李四',
                'mobile_name' => '1111',
                'source' => '1',
            ],
            [
                'sell_date' => date('Y-m-d'),
                'customer_name' => '王五',
                'mobile_name' => '1111',
                'source' => '1',
            ]
        ];
        return $data;
    }
    public function data(){
        $data = [
            [
                'name' => '1111',
                'sell_date' => date('Y-m-d'),
                'customer_name' => '1111',
                'mobile_name' => '1111',
                'state' => '1',
                'sort' => '99',
            ],
            [
                'name' => '1111',
                'sell_date' => date('Y-m-d'),
                'customer_name' => '1111',
                'mobile_name' => '1111',
                'state' => '1',
                'sort' => '99',
            ],
            [
                'name' => '1111',
                'sell_date' => date('Y-m-d'),
                'customer_name' => '1111',
                'mobile_name' => '1111',
                'state' => '1',
                'sort' => '99',
            ]
        ];
        return $data;
    }
    
}
