<?php
/**
* 管理员Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\user;
use app\data\model\user\UserModel  as UserModel;
use app\data\service\BaseService as BaseService;
use think\Request as Request;

class UserService extends BaseService 
{
	
	protected $cache = 'users';
	
	public function __construct()
	{
		parent::__construct();
		
		//禁止访问user数据库
		if(!$this->uadmin && false===request()->isAjax())
		{
			exit('页面错误！');
		}
		$this->cache = 'users';
		$this->user = new UserModel();
	}
	
    /**
     * 查询管理员列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function userList($where='', $order="ID desc", $field='*')
	{
		$list = $this->user->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取管理员信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function userInfo($where='', $field='*')
	{		
		$info =  $this->user->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计管理员数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function userCount($where='')
	{		
		$Count =  $this->user->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function userSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->user->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function userSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->user->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function userColumn($where='', $field='')
	{		
		$Column =  $this->user->getColumn($where, $field);
		return $Column;
	}
	
	
    /**
     * 添加一条管理员数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function userAdd($data='')
	{
		$list = $this->user->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条管理员数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function userAddAll($data='')
	{
		$list = $this->user->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 管理员分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function userPageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'ID desc';
		}else{
			$order = $lable['order'];
		}	
		$page  = $lable['page'];
		$cache = $lable['cache'];		
		//后台默认不分类缓存
		if(!$where && $cache===''){
			$cache = $this->cache; 
		}		
		//有条件情况下
		if($where){}		
		$list = $this->user->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新管理员数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function userSave($where="", $data="")
    {	
        $save = $this->user->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条管理员数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function userDel($where='')
    {		
        $del = $this->user->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条管理员数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function userDelMost($id_arr='')
    {		
        $delAll = $this->user->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 管理员列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function userListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$keyword = input('request.keyword');
    	$where = array();
		$data = array();
		$cache = '';
		if($keyword!=""){
		    $where['Username']=$keyword;
		}
		if($c_pid && is_numeric($c_pid)){
			//前台分页缓存 列如“1goodsC”
			$cache = $this->cache ;
			$cache = $c_pid.$cache.'C';
		}
		$data['where'] = $where ;
		$data['field'] = $field;
		$data['page'] = $page;
		$data['cache'] = $cache;
    	$lists  = $this->userPageList($data);
		$volist = false;
		if($lists && !$type)
		{
			$volist = $lists->toArray();
		}
		else if($lists && $type)
		{
			$volist = $lists;
		}
        return $volist;
	}
	
	 /**
     * 按条件添加一条管理员
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function userRoomAdd($role='') 
	{
		//管理员POST数据
		$type = 'add' ;
		$data = $this->inputData($type, $role);
		if($data===1)
		{
			return '请输入6~18位数的安全密码！';
		}
		else if($data===0)
		{
			return '请输入正确的邮箱地址';
		}
		$check = $this->checkAdmin($type, $data);
		if($check)
		{
			return $check;
		}
		$add = $this->userAdd($data);
		
		if($add)
		{
			return $add;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新管理员
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function userRoomEdit() 
	{
		$id = input('get.id');
		if(!empty(input('get.editHtml')))
		{
			$id = parent::sessionGets('ThinkUser.ID');
		}
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->userInfo("ID=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理管理员
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function userRoomEditDoo($role='') 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//管理员POST数据
		$type = 'edit' ;
		$data = $this->inputData($type, $role);
		if($data===1)
		{
			return '请输入6~18位数的安全密码！';
		}
		else if($data===0)
		{
			return '请输入正确的邮箱地址';
		}
		$where = array();		
		$where['ID'] = $id;
		$check = $this->checkAdmin($type, $data);
		if($check)
		{
			return $check;
		}
		$info = $this->userInfo($where);
		
		if($info && $this->userSave($where, $data))
		{
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件修改处理管理员
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function userEditPws($role='') 
	{
		$id = parent::sessionGets('ThinkUser.ID');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//管理员POST数据
		$type = 'pws' ;
		$data = $this->inputData($type, $role);
		if($data===1)
		{
			return '请输入6~18位数的安全密码！';
		}
		else if($data===0)
		{
			return '请输入正确的邮箱地址';
		}
		$where = array();		
		$where['ID'] = $id;
		$info = $this->userInfo($where);
		
		if($info && $this->userSave($where, $data))
		{
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 管理员POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:58:22
     */
	public function inputData($type, $role) 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
			break;
			case 'add';	
				$data['Dtime'] = date('Y-m-d H:i:s',time());
				if(empty(input('post.password')))
				{
					return false;
				}
			break;
			case 'pws';
			break;
		}
		
		if(empty(input('post.pws')))
		{
			$data['Roleid']      = input('post.roleid');
			$data['Username']    = input('post.username');		
			$data['Description'] = input('post.description');
			$data['Status']      = input('post.status');
			$data['leader_id']   = input('post.leader_id');	
			$data['Competence'] = $role;
		}
		
		$data['Email'] = input('post.email');
		
		if($data['Email'] && !preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i',$data['Email']))
		{
			return 0;
		}
		
		if(!empty(input('post.password')) && (strlen(input('post.password'))>18 || strlen(input('post.password'))<6))
		{
			return 1;
		}
		
		if(input('post.password'))
		{
			$data['Password'] = parent::HashPassword(input('post.password')) ;
		}
		
		return $data;
	}
	
    /**
     * 删除管理员操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function userRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->userInfo($where);
		if($info && $this->userDel($where))
		{				
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除管理员分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function userRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->userDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 管理员登录
	 * 创建人 韦丽明
	 * 时间 2017-09-06 21:15:1110
     */
	public function adminLogin($username, $password, $area='')
	{
		$where['Username']  = $username;
		//账号是否存在
		$filed = "*" ;	
		//加密方式
		$password = parent::HashPassword($password) ;		
		$where['Password']  = $password;		
		if($info = $this->userInfo($where,$filed)) 
		{			
			//账号状态
			if($info['Status']<>0) 
			{
				parent::loginlog($info['ID'],$username,'<div class="de2">违规帐号登录</div>',$area['country'].'.'.$area['area'],$area['ip']);
				return '当前帐号已被封禁，请等待解除～！';
			}
			
			//IP管理员位置获取
			$loginlog['Loginarea'] = $area['country'].'.'.$area['area'];
			$loginlog['Loginip'] = $area['ip'];
			$loginlog['Logintime'] = date('Y-m-d H:i:s');
			//更新
			$updata = $this->userSetField('ID = '.$info['ID'], $loginlog);
			
			//登录次数加1
			$this->userSetInc('ID = '.$info['ID'], 'Logincount', 1);

			//日志记录
			parent::loginlog($info['ID'],$username,'<div class="de1">登录成功</div>',$area['country'].'.'.$area['area'],$area['ip']);
			
			//保存到session
			$info['Loginarea'] = $area['country'].'.'.$area['area'];
			$info['Loginip'] = $area['ip'];
			$info['Logintime'] = time();
			$info['Logincount'] = $info['Logincount']+1;
			$subordinate_arr = $this->userColumn('leader_id = '.$info['ID'], 'ID');
			
			$info['subordinate_id'] = implode(",", $subordinate_arr);
			parent::sessionPack('ThinkUser',$info);
			//销毁验证码session
			parent::sessionPack('verify',null);
			//缓存时间
			parent::sessionPack('expire',3600);

			return 'ok';	
	   }
	   else
	   {
			parent::loginlog($info['ID'],$username,'<div class="de2">用户不存在或者登录密码错误</div>',$area['country'].'.'.$area['area'],$area['ip']);

			return '用户不存在或者登录密码错误！';			
       }	
   }

    /**
     * 添加/修改管理员验证
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function checkAdmin($type, $data) 
	{
		$where = array();
		$where['Username'] = $data['Username'] ;
		$error = 0;
		switch($type)
		{
			case 'edit';
				$where['ID'] = array('neq',input('post.id'));
				$user = $this->userInfo($where);
				
				if($user)
				{
					$error = '用户名已存在!';
				}
			break;
			case 'add';
				$count = $this->userCount($where);
				if($count)
				{
					$error = '用户名已存在!';
				}
			break;
		}

		if(empty($data['Username']) && !$error)
		{
			$error = '请输入用户名称!';
		}
		if((strlen($data['Username'])>20 || strlen($data['Username'])<2) && !$error)
		{
			$error = '用户名称请在2-20个字符以内！';
		}
		if((!preg_match('/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{2,16}$/u',$data['Username'])) && !$error)
		{
			$error = '请输入合法的用户名！';
		}

		if(!is_numeric($data['Status']) && !$error)
		{
			$error = '状态获取值不正确!';
		}
		
		return $error;
	}   
}