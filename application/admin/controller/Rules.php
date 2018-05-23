<?php
// +----------------------------------------------------------------------
// | Description: 权限
// +----------------------------------------------------------------------
// | Author: liudongqi <liudongqi@pdmi.cn>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use \think\Controller;
use think\Request;

class Rules extends Controller
{
    /**
     * 规则列表
     * 创建人 刘东奇
     * 时间 2018-05-16 16:12:55
     */
    public function index()
    {
//        Hook::listen('userauthHtml');
//        $keyword = input('request.keyword');
//        $user = new \app\data\service\user\UserService();
//        $type = 1 ;
//        $lists  = $user->userListShow($type);
//        $volist = $lists->toArray();
//        $role = new \app\data\service\role\RoleService();
//
//        foreach($volist['data'] as $k=>$v)
//        {
//            $roleIfon = $role->roleRoomEditDoo("ID='{$v['Roleid']}'", 'Rolename');
//            $volist['data'][$k]['Rolename'] = $roleIfon['Rolename'];
//        }
//        $this->assign('volist',$volist);
//        $this->assign('keyword',$keyword);
//        $this->assign('lists',$lists);
        return $this->fetch();
    }
}
