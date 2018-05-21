<?php
namespace app\login\controller;

use think\Controller;
use think\Request;
use think\Url;
use base\Result;
use app\data\service\BaseService as BaseService;

class Index extends Controller
{
    protected $param = [];
    public function __construct()
    {
        parent::__construct();
        $this->param = Request::instance()->param();
    }
    /**
     * 后台登录页面
     * 创建人 刘东奇
     * 时间 2018-05-16 16:10:01
     */
    public function index()
    {
        return $this->fetch();
    }
    /**
     * 管理员登录
     * 创建人 刘东奇
     * 时间 2018-05-16 16:10:01
     */
    public function login()
    {
            $login = array();
            $Base = new BaseService();
            //验证
            $type = 'username|password';
            $info = input('request.username')."|".input('request.password');
            $check = $Base->checkInfo($type, $info);
            if($check)
            {
                $state = 2;
               return  json(['code' => $state, 'msg' => $check]);
            }
            //地理位置信息获取
            $area = $Base->area();
            //账号信息判断
            $user = new \app\data\service\user\UserService();
            $username = input('request.username');
            $password = input('request.password');
            $ruesult = $user->adminLogin($username, $password, $area);
            if($ruesult=='ok'){
                $state = 1;
                $msg = '登陆成功';
                return json(['code' => $state, 'msg' => $msg]);
            }else{
                $state = 2;
                $msg = '用户不存在或者登录密码错误！';
                return json(['code' => $state, 'msg' => $msg]);
            }
    }
    /**
     * 退出登录
     * 创建人 刘东奇
     * 时间 2018-05-16 16:10:01
     */
    public function quit()
    {
        $statis = new \app\data\service\statis\StatisService();
        $where['Uid'] = \think\Session::get('ThinkUser.ID');
        $del = $statis->statisDel($where);
        \think\Session::clear('think');
        //后台地址
        $adminurl = \think\Config::get('cmm_admin');
        $this->redirect('/'.$adminurl);
    }
}
