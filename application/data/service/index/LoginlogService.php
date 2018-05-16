<?php
/**
* 登录日志Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-09-14
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\index;
use app\data\model\index\LoginlogModel  as LoginlogModel;
use app\data\service\BaseService as BaseService;

class LoginlogService extends BaseService 
{
	protected $cache = 'loginlogs';
	
	public function __construct()
	{
		parent::__construct();	
		$this->loginlog = new LoginlogModel();
		$this->cache = 'loginlogs';
	}
	
    /**
     * 查询登录日志列表
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:10:21
     */
	public function loginlogList($where='', $field='*', $order='ID desc', $cache='loginlogs')
	{
		$list = $this->loginlog->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取登录日志信息
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function loginlogInfo($where='', $field='*')
	{		
		$info =  $this->loginlog->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计登录日志数量
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function loginlogCount($where='')
	{		
		$Count =  $this->loginlog->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function loginlogSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->loginlog->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function loginlogSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->loginlog->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function loginlogColumn($where='', $field='')
	{		
		$Column =  $this->loginlog->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条登录日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function loginlogAdd($data='')
	{
		$list = $this->loginlog->getAdd($data, $this->cache);
		return $list;
	}
		
    /**
     * 添加多条登录日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function loginlogAddAll($data='')
	{
		$list = $this->loginlog->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 登录日志分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:31:15
     */
	public function loginlogPageList($data)
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
		$list = $this->loginlog->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新登录日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 22:19:05
     */
    public function loginlogSave($where="", $data="")
    {	
        $save = $this->loginlog->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条登录日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:05:08      
     */
    public function loginlogDel($where='')
    {		
        $del = $this->loginlog->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条登录日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:08:51       
     */
    public function loginlogDelMost($id_arr='')
    {		
        $delAll = $this->loginlog->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 登录日志列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function loginlogListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$keyword      = input('request.keyword');
		
    	$where = array();
		$data = array();
		$cache = '';
		if ($keyword!=null) 
		{
		    $where['Description'] =array('like',"%$keyword%");
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
    	$lists  = $this->loginlogPageList($data);	
        return $lists;
	}

    /**
     * 删除登录日志登录
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:10:16
     */
	public function loginlogRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->loginlogInfo($where);
		if($info && $this->loginlogDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}	
	
    /**
     * 批量删除登录日志
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:35:11
     */
	public function loginlogRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->loginlogDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 添加一条登录日志
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function loginlogRoomAdd($url, $status, $description) 
	{
		// 登录日志POST数据
		$type = 'add';
		$data = $this->inputData($type, $url, $status, $description);		
		if($this->loginlogAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 登录日志POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:52:15
     */
	public function inputData($type, $url='', $status='', $description='') 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
				$data['Status'] = $status;
			break;
			case 'add';
			
				if($status==='2')
				{
					$data['Status'] = 1;
				}
				else
				{
					$data['Status'] = $status;	
					$data['Uid'] = parent::sessionGets('ThinkUser.ID');		
				}					
				$data['Url'] = $url;
				$data['Description'] = $description;
				$data['Ip'] = get_client_ip();
				$data['Dtime'] = date('Y-m-d H:i:s');
			break;
		}   	
		
		return $data;
	}
	
}