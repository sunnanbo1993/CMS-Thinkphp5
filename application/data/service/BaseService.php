<?php
/**
* 公共Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service;
use think\Session as Session;
use think\Request as Request;
use think\Controller;
use think\Image;


class BaseService 
{
	public $uadmin;//管理员信息
	public $verify;//验证码
	public $expire;//缓存时间
	public $user;//缓存时间
	
	public function __construct()
	{
		header("Content-Type: text/html;charset=utf-8"); 
		$this->init();
	}
	
	/**
	* 初始化数据
	* 创建人 刘东奇
	* 更新时间 2018-05-16 16:10:01
	*/
	public function init()
	{
		//管理员信息
		$this->uadmin = Session::get('ThinkUser');		
		//验证码
		//$this->verify = Session::get('verify');
		//缓存时间
		$this->expire = Session::get('expire');	
	}
	
	/**
	* 判断管理员登录状态
	* 创建人 刘东奇
	* 更新时间 2018-05-16 16:10:01
	*/
	public function checkAdminSession()
	{
		$nowtime = time();
		if($this->uadmin==null) 
		{
			return false;
		}
		else 
		{
			if(($nowtime - $this->uadmin['Logintime']) > $this->expire)
			{
				$statis = new \app\data\service\statis\StatisService();
				$where['Uid'] = Session::get('ThinkUser.ID');
				$del = $statis->statisDel($where);
				session(null);
				return '登录超时';
			}
			else
			{
				$uid = $this->uadmin['ID'];				
				$user = new \app\data\service\user\UserService ;				
				$result = $user->userCount("ID = $uid") ;
				
				if ($result != 1) {
					session(null);
					return '非法用户登录';
				}else {
					$this->sessionPack('ThinkUser.Logintime',$nowtime);				
					return intval($uid);
				}				
			}
		}
	}
	
    /**
     * 信息验证 
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */
	public function checkInfo($type, $info)
	{
		$arr = array();		
		$arr = explode('|',$type);
		
		$str = array();
		$str = explode('|',$info);
		
		foreach($arr as $key=>$v)
		{
			switch($v)
			{
				//用户名
				case 'username';
					if (!preg_match('/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{2,16}$/u',$str[$key])) 
					{
						return '请输入合法的用户名';
					}
				break;
				//密码
				case 'password';
					if (strlen($str[$key])<6 || strlen($str[$key])>18) 
					{				
						return '请输入6位数以上的密码';
					}				
				break;
//				//验证码
//				case 'code';
//					if (!captcha_check($str[$key]))
//					{
//						return '请输入正确的验证码';
//					}
//				break;
			}
		}
	}
	
    /**
     * 地理位置信息获取 
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */
	public function area() 
	{
	    $area = array();
	    //位置获取
	    $Ip = new \Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
	    $area = $Ip->getlocation();	// 获取某个IP地址所在的位
	    return $area;
	}	
	
    /**
     * 验证IP 
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */
	public function checkIp($resip, $area) 
	{

		if ($resip) {
			if ($resip['Status'] == 1) 
			{
				//保存日志
				$this->loginlog(0,'未知','<div class="de2">被封锁IP尝试登录</div>',$area['country'].'.'.$area['area'],$area['ip']);
				return '您的IP异常已被封禁，请等待管理员解除封禁！';
			}
			else 
			{
				$endtime = strtotime($resip['EndTime']); //结束时间
				if (($endtime - date('Y-m-d')) > 1) 
				{
					//保存日志
					$this->loginlog(0,'未知','<div class="de2">被封锁帐号尝试登录</div>',$area['country'].'.'.$area['area'],$area['ip']);
					return '您的IP异常已被封禁，请等待管理员解除封禁！';
				}
			}
		}
	}
    /**
     * 加密方式 
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */	
	public function HashPassword($password) 
	{
	    $password = sha1(md5($password));
		return $password;
	}
	
    /**
     * session封装更新 
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */	
	public function sessionPack($name, $data) 
	{
	    Session::set($name, $data);
	}
	
    /**
     * session读取
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */	
	public function sessionGets($name) 
	{
	    return Session::get($name);
	}
	
    /**
     * 用户权限验证
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */
	 public function userauthHtml($auth) {
		//当前用户权限获取
		$comp = explode(',',Session::get('ThinkUser.Competence'));		
		array_pop($comp);
		if (!in_array($auth,$comp)) {
			return false;
		}
	 }
    /**
     * 合并数组
	 * @param string $cache 缓存 默认值为空
	 * @param array $data 合并数组
	 * @param array $lable 默认数组
	 * @param array $arr 传参数组
	 * 创建人 刘东奇
	 * 时间 2018-05-16 16:10:01
     */
	public function mergeArray($arr=array())
	{
		$lable = array();
		$data = array();
		$lable['where'] = '' ;
		$lable['cache'] = '' ;//查询不缓存
		$lable['field'] = '*';
		$lable['order'] ='';
		$lable['page']  = 15 ;
		//合并数组
		$data = array_merge($lable, $arr);
		return $data;
	}	 

	
}