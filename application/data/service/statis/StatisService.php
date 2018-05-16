<?php
/**
* 在线人数统计Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\statis;
use app\data\model\statis\StatisModel  as StatisModel;
use app\data\service\BaseService as BaseService;

class StatisService extends BaseService 
{
	protected $cache = '';
	
	public function __construct()
	{
		parent::__construct();		
		$this->cache = 'statis';		
		$this->statis = new StatisModel();
		
	}
	
    /**
     * 查询在线人数统计列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function statisList($where='', $order='ID desc', $field='*')
	{
		$list = $this->statis->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取在线人数统计信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function statisInfo($where='', $field='*')
	{		
		$info =  $this->statis->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计在线人数统计数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function statisCount($where='')
	{		
		$Count =  $this->statis->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function statisSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->statis->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function statisSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->statis->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function statisColumn($where='', $field='')
	{		
		$Column =  $this->statis->getColumn($where, $field, $this->cache);
		return $Column;
	}
	
	/**
     * 更新在线人数统计数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function statisSave($where="", $data="")
    {	
        $save = $this->statis->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 添加一条在线人数统计数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function statisAdd($data='')
	{
		$list = $this->statis->getAdd($data, $this->cache);
		return $list;
	}
	
    /**
     * 删除一条在线人数统计数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function statisDel($where='')
    {		
        $del = $this->statis->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条在线人数统计数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function statisDelMost($id_arr='')
    {		
        $delAll = $this->statis->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 按条件修改处理在线人数统计
	 * 创建人 韦丽明
	 * 时间 2017-09-14 13:34:05
     */
	public function statisRoomEditDoo($where='') 
	{
		// 权限POST数据
		$type = 'edit';
		$data = $this->inputData($type);
		if(!$where)
		{
			$where = array();		
			$where['Uid'] = \think\Session::get('ThinkUser.ID');			
		}
		if($this->statisSave($where, $data))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 添加一条在线人数统计
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function statisRoomAdd() 
	{
		// 权限POST数据
		$type = 'add';
		$data = $this->inputData($type);
		if(!$data)
		{
			return false;
		}
		if($this->statisAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 权限POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:52:15
     */
	public function inputData($type) 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
				$data['Uid'] = \think\Session::get('ThinkUser.ID');
			break;
			case 'add';				  
				  $where['Uid'] = \think\Session::get('ThinkUser.ID');
				  $info = $this->statisInfo($where);
				  if($info)
				  {
					  return false;
				  }
			break;
		} 
		
		$data['Dtime'] = time();		
		return $data;
	}	

	
	
}