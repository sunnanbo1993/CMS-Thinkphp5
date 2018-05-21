<?php 
namespace app\behavior;

use think\Request;
use \think\Controller;
use app\data\service\BaseService as BaseService;
/**
 * 管理员登录状态
 * 创建人 刘东奇
 * 更新时间 2018-05-16 16:02:15
 */
class checkAuth
{
	private $module;
	private $controller;
	private $action;
	private $no_login_url = [
		'/login/index/index',
		'/login/index/login',
		'/index/index/login'
	];
	public function __construct()
	{
		list($this->module, $this->controller, $this->action) = (Request::instance()->dispatch()['module'] == '') ?(array("index", "index", "index")):(Request::instance()->dispatch()['module']);
		$this->controller = ($this->controller == '') ? ('index'):($this->controller);
		$this->action     = ($this->action == '') ? ('index'):($this->controller);
	}
	/**
	 * 管理员登录状态
	 * 创建人 刘东奇
	 * 更新时间 2018-05-16 16:02:15
	 */
	public function run()
	{
		$this->isCheckLogin();
	}
	/**
	 * 管理员登录状态
	 * 创建人 刘东奇
	 * 更新时间 2018-05-16 16:02:15
	 */
	public function isCheckLogin()
	{
		$arr = [];

		$Base = new BaseService();
		$response = $Base->checkAdminSession();
		//var_dump($response);die;
//		$url = '/'.$this->module.'/'.$this->controller.'/'.$this->action;
//		if(in_array($url, $this->no_login_url)){
				if($response==false){
					jsAlerts('请您登陆');
				}
				if($response=='登录超时'){
					jsAlerts('登陆超时');
				}if($response=='非法用户登陆'){
					jsAlerts('非法用户登陆');
				}
//		}else{
//			jsAlerts('非法路径');
//		}
	}
	/**
	 * 用户权限验证1(ajax发送返回验证)
	 * 创建人 刘东奇
	 * 更新时间 2018-05-16 16:02:15
	 */
	public function userauth($auth)
	{
		$Base = new BaseService();
		$result = $Base->userauthHtml($auth);
		if(false===$result)
		{
			$err=array('s'=>'抱歉，您没有此操作权限');
			exit(json_encode($err));
		}
	}

	/**
	 * 用户权限验证2(页面)
	 *创建人 刘东奇
	 * 更新时间 2018-05-16 16:02:15
	 */
	public function userauthHtml($auth)
	{

		$Base = new BaseService();
		$result = $Base->userauthHtml($auth);
		if(false===$result)
		{
			$this->assign('content', '抱歉，您没有此操作权限');
			exit($this->fetch('index/index'));
		}
	}
}