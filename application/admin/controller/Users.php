<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Url;

class Users extends Controller
{

    /**
     * 添加角色
     * 创建人 刘东奇
     * 时间 2018-05-16 16:39:01
     */
    public function roleadd()
    {
        parent::userauthHtml(8);
        $compt = new \app\data\service\competence\CompetenceService();
        $result = parent::comptList();

        $this->assign('slist',$result['slist']);
        $this->assign('volist',$result['volist']);
        return $this->fetch('add');
    }
    /**
     * 修改角色
     * 创建人 刘东奇
     * 时间 2018-05-16 16:39:01
     */
    public function roleedit()
    {
        parent::userauthHtml(9);
        $role = new \app\data\service\role\RoleService();
        $result = $role->roleRoomEdit();
        if ($result)
        {
            $this->assign('result',$result);
            //获取权限数据
            $compt =  parent::comptList();
            $this->assign('volist',$compt['volist']);
            $this->assign('slist',$compt['slist']);
            return $this->fetch('edit');
        }
        else
        {
            parent::operating(request()->path(),1,'数据不存在');
            $this->assign('content','没有找到相关数据，请关闭本窗口');
            return $this->fetch('Public/err');
        }
    }

    /**
     * 删除角色
     * 创建人 刘东奇
     * 时间 2018-05-16 16:39:01
     */
    public function roledel()
    {
        //验证用户权限
        parent::userauth(10);
        //判断是否是ajax请求
        if (request()->isAjax())
        {
            if (input('post.post')=='ok')
            {
                $id = input('post.id');
                $id = intval($id);
                if ($id==1)
                {
                    parent::operating(request()->path(),1,'不能删除系统默认角色');
                    return array('s'=>'不能删除此角色');
                }
                $role = new \app\data\service\role\RoleService();
                $result = $role->roleRoomDel();
                if ($result)
                {
                    parent::operating(request()->path(),0,'删除成功');
                    return array('s'=>'ok');
                }
                else
                {
                    parent::operating(request()->path(),1,'数据不存在：'.$id);
                    return array('s'=>'数据不存在');
                }
            }
            else
            {
                parent::operating(request()->path(),1,'非法请求');
                return array('s'=>'非法请求');
            }
        }
        else
        {
            parent::operating(request()->path(),1,'非法请求');
            return array('s'=>'非法请求');
        }
    }
}
