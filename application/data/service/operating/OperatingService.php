<?php
/**
* 操作日志Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-09-14
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\operating;
use app\data\model\operating\OperatingModel  as OperatingModel;
use app\data\service\BaseService as BaseService;

class OperatingService extends BaseService 
{
	protected $cache = 'operatings';
	
	public function __construct()
	{
		parent::__construct();	
		$this->operating = new OperatingModel();
		$this->cache = 'operatings';
	}
	
    /**
     * 查询操作日志列表
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:10:21
     */
	public function operatingList($where='', $field='*', $order='ID desc', $cache='operatings')
	{
		$list = $this->operating->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取操作日志信息
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function operatingInfo($where='', $field='*')
	{		
		$info =  $this->operating->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计操作日志数量
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function operatingCount($where='')
	{		
		$Count =  $this->operating->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function operatingSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->operating->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function operatingSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->operating->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function operatingColumn($where='', $field='')
	{		
		$Column =  $this->operating->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条操作日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function operatingAdd($data='')
	{
		$list = $this->operating->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条操作日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function operatingAddAll($data='')
	{
		$list = $this->operating->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 操作日志分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:31:15
     */
	public function operatingPageList($data)
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
		$list = $this->operating->getPageList($where, $field, $order, $page, $this->cache);
		return $list;
	}
	
	/**
     * 更新操作日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 22:19:05
     */
    public function operatingSave($where="", $data="")
    {	
        $save = $this->operating->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条操作日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:05:08      
     */
    public function operatingDel($where='')
    {		
        $del = $this->operating->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条操作日志数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:08:51       
     */
    public function operatingDelMost($id_arr='')
    {		
        $delAll = $this->operating->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 操作日志列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function operatingListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$keyword      = input('request.keyword');
		$Url          = input('get.Url');
		$Ip           = input('get.Ip');
		$Uid          = input('get.Uid');
		$Status       = input('request.Status');
		
    	$where = array();
		$data = array();
		$cache = '';		
		if($Status!=null)
		{
		    $where['Status']  =   $Status;
		}
		if ($keyword!=null) 
		{
		    $where['Description'] =array('like',"%$keyword%");;
		}
		if ($Url!=null) 
		{
		    $where['Url'] = $Url;
		}
		if ($Ip!=null) 
		{
		    $where['Ip'] = $Ip;
		}
		if ($Uid!=null) 
		{
		    $where['Uid'] = intval($Uid);
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

    	$lists  = $this->operatingPageList($data);	
        return $lists;
	}

    /**
     * 删除操作日志操作
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:10:16
     */
	public function operatingRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->operatingInfo($where);
		if($info && $this->operatingDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}	
	
    /**
     * 批量删除操作日志
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:35:11
     */
	public function operatingRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->operatingDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 添加一条操作日志
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function operatingRoomAdd($url, $status, $description) 
	{
		// 操作日志POST数据
		$type = 'add';
		$data = $this->inputData($type, $url, $status, $description);		
		if($this->operatingAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 操作日志POST数据
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