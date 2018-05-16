<?php 
namespace app\behavior;
use think\Controller;
use think\Request;
use think\Url;
use think\Session;
use think\Config;
use think\Cache;

use app\data\service\BaseService as BaseService;
class checkAuth
{
	public function run()
	{
		/**
		 * 管理员登录状态
		 * 创建人 刘东奇
		 * 更新时间 2018-05-16 16:02:15
		 */
		$Base = new BaseService();
		$result = $Base->checkAdminSession();
		return $result;
	}

//	/**
//	 * 用户权限验证1(ajax发送返回验证)
//	 * 创建人 刘东奇
//	 * 更新时间 2018-05-16 16:02:15
//	 */
//	public function userauth($auth)
//	{
//		$Base = new BaseService();
//		$result = $Base->userauthHtml($auth);
//		if(false===$result)
//		{
//			$err=array('s'=>'抱歉，您没有此操作权限');
//			exit(json_encode($err));
//		}
//	}

//	/**
//	 * 用户权限验证2(页面)
//	 *创建人 刘东奇
//	 * 更新时间 2018-05-16 16:02:15
//	 */
//	public function userauthHtml($auth)
//	{
//
//		$Base = new BaseService();
//		$result = $Base->userauthHtml($auth);
//		if(false===$result)
//		{
//			$this->assign('content', '抱歉，您没有此操作权限');
//			exit($this->fetch('public/error'));
//		}
//	}
//	//更新缓存
//	public function upadteCache($cache, $data)
//	{
//		$cache = Cache::set($cache, $data);
//	}
//
//	//获取缓存
//	public function getCache($cache)
//	{
//		$cache = Cache::get($cache);
//	}
//
//	//删除缓存
//	public function delCache($cache)
//	{
//		$cache = Cache::rm($cache);
//	}
//
//	//更新session
//	public function updateSession($name, $value)
//	{
//		Session::set($name, $value);
//	}
//
//	/**
//	 *  按条件查询所有权限
//	 * 创建人 刘东奇
//	 * 更新时间 2018-05-16 16:02:15
//	 */
//	protected function comptList($type=0)
//	{
//		$compt = new \app\data\service\competence\CompetenceService();
//		$where = array();
//		$result = array();
//		$where['Sid'] = 0;
//		$where['Status'] = 0;
//		$filed = 'ID,Sid,Cname,Status';
//		if(!$type)
//		{
//			$result['slist'] = $compt->competenceColumn('Sid<>0 AND Status=0', $filed);
//		}
//		$result['volist'] = $compt->competenceColumn($where, $filed);
//		return  $result ;
//	}
//
//	/**
//	 *  一键清空缓存
//	 * 创建人 刘东奇
//	 * 更新时间 2018-05-16 16:02:15
//	 */
//	public function clearcache()
//	{
//		//验证用户权限
//		$this->userauth(24);
//		$request = Request::instance();
//		if ($request->isAjax())
//		{
//			if (input('request.clear')=='ok')
//			{
//				//清楚缓存
//				self::delAllDir();
//				//加载网站设置
//				$set = new \app\data\service\system\SetService();
//				$list = $set->setListShow();
//				return json(['s'=>'ok']);
//			}
//			else
//			{
//				return json(['s'=>'非法请求']);
//			}
//		}
//		else
//		{
//			return json(['s'=>'非法请求']);
//		}
//
//	}
//
//	/**
//	 *  删除所有Runtime文件
//	 * 创建人 刘东奇
//	 * 更新时间 2018-05-16 16:02:15
//	 */
//	public function delAllDir()
//	{
//		$request = Request::instance();
//		//清楚缓存
//		Cache::clear();
//		$fileDel = ROOT_PATH.'runtime';
//
//		if (!file_exists($fileDel))
//		{
//			$fileDel = ROOT_PATH.'runtime';
//		}
//
//		if (file_exists($fileDel))
//		{
//			$this->delDir($fileDel);
//			$this->operating($request->path(),0,'清空站点缓存');
//			return json(['s'=>'ok']);
//		}
//		else
//		{
//			return json(['s'=>'缓存目录不存在']);
//		}	return json(['s'=>'非法请求']);
//	}
}