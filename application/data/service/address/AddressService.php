<?php
/**
* 地址Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\address;
use app\data\model\address\AddressModel  as AddressModel;
use app\data\service\BaseService as BaseService;

class AddressService extends BaseService 
{
	protected $cache = 'address';	
	
	public function __construct()
	{
		parent::__construct();
		$this->address = new AddressModel();
		$this->cache = 'address';
		
	}
	
    /**
     * 查询地址列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function addressList($where='', $order='id desc', $field='*', $cache='address')
	{	
		$list = $this->address->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取地址信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function addressInfo($where='', $field='*')
	{		
		$info =  $this->address->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计地址数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function addressCount($where='')
	{		
		$Count =  $this->address->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function addressSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->address->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function addressSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->address->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function addressColumn($where='', $field='')
	{		
		$Column =  $this->address->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条地址数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function addressAdd($data='')
	{
		$list = $this->address->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条地址数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function addressAddAll($data='')
	{
		$list = $this->address->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 地址分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function addressPageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'id desc';
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
		$list = $this->address->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新地址数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function addressSave($where="", $data="")
    {	
        $save = $this->address->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条地址数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function addressDel($where='')
    {		
        $del = $this->address->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条地址数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function addressDelMost($id_arr='')
    {		
        $delAll = $this->address->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 地址列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function addressListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
    	$where = array();
		$data = array();
		$cache = '';
		$where['id'] = array('>',0);
		$data['where'] = $where ;
		$data['field'] = $field;
		$data['page'] = $page;
		$data['cache'] = $cache;
    	$lists  = $this->addressPageList($data);
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
     * 按条件添加一条地址
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function addressRoomAdd() 
	{
		//地址POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->addressAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新地址
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function addressRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->addressInfo("id=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理地址
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function addressRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//地址POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['id'] = $id;
		$info = $this->addressInfo($where);
		
		if($info && $this->addressSave($where, $data))
		{
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 地址POST数据
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
				$data['addtime'] = time();
			break;
		}  
		input('post.email') && $data['email'] = input('post.email');
		input('post.phone') &&	$data['phone'] = input('post.phone');
		input('post.tel') && $data['tel'] = input('post.tel');
		input('post.skype') && $data['skype'] = input('post.skype');
		input('post.contacts') && $data['contacts'] = input('post.contacts');
		input('post.address') && $data['address'] = input('post.address');		
		
		return $data;
	}
	
    /**
     * 删除地址操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function addressRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['id'] = $id;		
    	$info = $this->addressInfo($where);
		if($info && $this->addressDel($where))
		{				
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除地址分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function addressRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->addressDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	
}