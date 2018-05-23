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
	* 更新时间 2017-07-12 13:45:30
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
	* 创建人 韦丽明
	* 更新时间 2017-09-07 15:26:33
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
			if(($nowtime - $this->uadmin['Logintime']) > 2)
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
	 * 时间 2018-05-18 21:15:11
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
			}
		}
	}
	
    /**
     * 地理位置信息获取 
	 * 创建人 韦丽明
	 * 时间 2017-09-06 21:33:05
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
	 * 创建人 韦丽明
	 * 时间 2017-09-06 21:47:12
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
     * 登录日志记录 
	 * 创建人 韦丽明
	 * 时间 2017-09-06 21:47:12
     */	
	public function loginlog($uid,$username,$description,$area,$cip) 
	{
	    //登录日志记录
	    $hlog['Uid'] = $uid;
	    $hlog['User'] = $username;
	    $hlog['Description'] = $description;
	    $hlog['Area'] = $area;
	    $hlog['Loginip'] = $cip;
	    $hlog['Dtime'] = date('Y-m-d H:i:s');
	    $log = new \app\data\service\index\LoginlogService();
		$log->loginlogAdd($hlog);
	}
	
    /**
     * 加密方式 
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:12:05
     */	
	public function HashPassword($password) 
	{
	    $password = sha1(md5($password));
		return $password;
	}
	
    /**
     * session封装更新 
	 * 创建人 韦丽明
	 * 时间 2017-09-07 11:39:06
     */	
	public function sessionPack($name, $data) 
	{
	    Session::set($name, $data);
	}
	
    /**
     * session读取
	 * 创建人 韦丽明
	 * 时间 2017-09-07 11:47:15
     */	
	public function sessionGets($name) 
	{
	    return Session::get($name);
	}
	
    /**
     * 用户权限验证
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:28:01
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
     * 上传图片
	 * 创建人 韦丽明
	 * 时间 2017-09-10 21:26:02
     */	 
	public function upload($name='', $file = "attach_file", $type=0, $w=350 ,$h=350)
	{		
	    // 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file($file);
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . $name);
		
	    if($info)
		{
			$info = '/uploads/'.$name.'/'.$info->getSaveName();
	         //生成缩略图
			 if ($type===2) 
			 {				 
				$thumb = $this->thumbImg($info, $name, $type, $w, $h); 
			 }	 
	    }
		else
		{
	        // 上传失败获取错误信息 /uploads/goods/
	        //echo $file->getError();
	    }
		
		if($type===2)
		{			
			$pic = array('info'=>$info,'thumb'=>$thumb);
			unset($thumb);
			return $pic;
		}
		else
		{
			return $info;
		}	    
	}
	
    /**
     * 图片压缩
	 * 创建人 韦丽明
	 * 时间 2017-09-10 21:27:55
     */	
	public function thumbImg($img, $name, $type ,$w=375 ,$h=286, $goods='')
	{
		
		$img = './'.$img;
		// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
		$riqi = date("Y-m-d",time());
		$i = rand(0,1000000000);		
		$g_id = time() ;
		
		if ($type==1) 
		{
			$name = './uploads/thumb/'.$name.'/item'.$g_id.".jpg";
		} 
		else if ($type==2) 
		{				
			$url = './uploads/thumb/'.$name;			
			@mkdir('./uploads/thumb/',777,true);
			@mkdir($url,777,true);
			@chmod($url, 0777);
				
			$path = $url ;
			if (!file_exists($path)){
				define($path, __DIR__);
				mkdir($path); 
			}
				
			$path2 = $url.'/'.$riqi;
			@mkdir($path2,777,true);
			@chmod($path2, 0777);				
			if (!file_exists($path2)) {
				mkdir($path2); 
			}				
			$name = $path2.'/'.$name.$g_id.$i.".jpg";
		}

		if (file_exists($img)) 
		{
			if (!file_exists($name)) 
			{	
				$image = \think\Image::open($img);				
				//dump($name);die;
				$image->thumb($w, $h,\think\Image::THUMB_CENTER)->save($name,'jpg');
			}
			$name = substr($name,1);
			$pic = $name ;
			return $pic;		
		}
	 }

    /**
     * 删除图片
	 * 创建人 韦丽明
	 * 时间 2017-09-10 21:27:55
     */
	public function unlikFile($imgUrl='', $type=0)
	{
		//判读图片是否存在
		if(!$type)
		{
			$fileDel = ROOT_PATH.'public'.$imgUrl;
		}
		else
		{
			$fileDel = $imgUrl;
		}
		
		if(file_exists($fileDel))
		{
			unlink($fileDel);
			return true;
		}
		else
		{
			return false;
		}		
	}
	
    /**
     * 删除原图片
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function DelImg($img) 
	{
		$primary_file = '';
		$primary_file = $img;
		if(!empty($primary_file))
		{
			$imgUrl = $primary_file;
			$unlink = $this->unlikFile($imgUrl);
		}
	}
    /**
     * 合并数组
	 * @param string $cache 缓存 默认值为空
	 * @param array $data 合并数组
	 * @param array $lable 默认数组
	 * @param array $arr 传参数组
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:28:13
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