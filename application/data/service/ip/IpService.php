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

namespace app\data\service\ip;
use app\data\model\ip\IpModel  as IpModel;
use app\data\service\BaseService as BaseService;

class IpService extends BaseService 
{
	protected $cache = '';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->cache = 'ipss';
		
		$this->ip = new IpModel();
		
	}
	
    /**
     * 查询Ip列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function ipList($where='', $order='ID desc', $field='*')
	{
		$list = $this->ip->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取Ip信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function ipInfo($where='', $field='*')
	{		
		$info =  $this->ip->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计Ip数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function ipCount($where='')
	{		
		$Count =  $this->ip->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function ipSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->ip->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function ipSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->ip->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function ipColumn($where='', $field='')
	{		
		$Column =  $this->ip->getColumn($where, $field, $this->cache);
		return $Column;
	}
	
	
    /**
     * 添加一条IP数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function ipAdd($data='')
	{
		$list = $this->ip->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条IP数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function ipAddAll($data='')
	{
		$list = $this->ip->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * IP分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function ipPageList($data)
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
		$list = $this->ip->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新IP数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function ipSave($where="", $data="")
    {	
        $save = $this->ip->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条IP数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function ipDel($where='')
    {		
        $del = $this->ip->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条IP数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function ipDelMost($id_arr='')
    {		
        $delAll = $this->ip->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * IP列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function ipListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$keyword  = input('request.keyword');
    	$where = array();
		$data = array();
		$cache = '';
	    if ($keyword!=null) {
			$where['Ip'] = $keyword;
		}
		$data['where'] = $where ;
		$data['field'] = $field;
		$data['page'] = $page;
		$data['cache'] = $cache;
    	$lists  = $this->ipPageList($data);
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
     * 按条件添加一条IP
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function ipRoomAdd() 
	{
		//IPPOST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->ipAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新IP
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function ipRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->ipInfo("ID=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理IP
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function ipRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//IPPOST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['ID'] = $id;
		$info = $this->ipInfo($where);
		
		if($info && $this->ipSave($where, $data))
		{	
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * IPPOST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:58:22
     */
	public function inputData($type) 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
			break;
			case 'add';
				$data['Dtime']       = date('Y-m-d H:i:s');	
			break;
		}   	
		$data['Uid']         = session('ThinkUser.ID');
		$data['Ip']          = input('post.ip');
		$data['StartTime']   = input('post.stime');
		$data['EndTime']     = input('post.etime');
		$data['Status']      = input('post.status');
		$data['Description'] = input('post.description');
		return $data;
	}
	
    /**
     * 删除IP操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function ipRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->ipInfo($where);
		if($info && $this->ipDel($where))
		{
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除IP分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function ipRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->ipDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	
}