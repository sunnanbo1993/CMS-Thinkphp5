<?php
/**
* 权限组Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-09-14
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\role;
use app\data\model\role\RoleModel  as RoleModel;
use app\data\service\BaseService as BaseService;

class RoleService extends BaseService 
{
	protected $cache = '';
	
	public function __construct()
	{
		parent::__construct();	
		$this->role = new RoleModel();
		$this->cache = 'roles';
	}
	
    /**
     * 查询权限组列表
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:10:21
     */
	public function roleList($where='', $field='*', $order='ID asc')
	{
		$list = $this->role->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取权限组信息
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function roleInfo($where='', $field='*')
	{		
		$info =  $this->role->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计权限组数量
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function roleCount($where='')
	{		
		$Count =  $this->role->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function roleSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->role->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function roleSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->role->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function roleColumn($where='', $field='')
	{		
		$Column =  $this->role->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条权限组数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function roleAdd($data='')
	{
		$list = $this->role->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条权限组数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function roleAddAll($data='')
	{
		$list = $this->role->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 权限组分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:31:15
     */
	public function rolePageList($where='', $field='*', $order="ID asc", $page=15)
	{
		
		$list = $this->role->getPageList($where, $field, $order, $page, $this->cache);
		return $list;
	}
	
	/**
     * 更新权限组数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 22:19:05
     */
    public function roleSave($where="", $data="")
    {	
        $save = $this->role->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条权限组数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:05:08      
     */
    public function roleDel($where='')
    {		
        $del = $this->role->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条权限组数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:08:51       
     */
    public function roleDelMost($id_arr='')
    {		
        $delAll = $this->role->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 权限组列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function roleListShow($type=0) 
	{
    	$where = array();
		
		$where['ID'] = array('>',0);
    	$lists  = $this->rolePageList($where);
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
     * 按条件更新权限组
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function roleRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();
		$where['ID'] = $id;
		$result = false;		
    	$result = $this->roleInfo($where);	
		return $result;
	}

    /**
     * 按条件修改处理权限组
	 * 创建人 韦丽明
	 * 时间 2017-09-14 13:34:05
     */
	public function roleRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		// 权限组POST数据
		$type = 'edit';
		$data = $this->inputData($type);
		$where = array();		
		$where['ID'] = $id;
		if($this->roleSave($where, $data))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}

    /**
     * 删除权限组操作
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:10:16
     */
	public function roleRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->roleInfo($where);
		if($info && $this->roleDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}	
	
    /**
     * 批量删除权限组
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:35:11
     */
	public function roleRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->roleDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 添加一条权限组
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function roleRoomAdd() 
	{
		// 权限组POST数据
		$type = 'add';
		$data = $this->inputData($type);		
		if($this->roleAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 权限组POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:52:15
     */
	public function inputData($type) 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
			break;
			case 'add';
				$data['Dtime'] = date('Y-m-d H:i:s',time()) ;
			break;
		}   	
		$data['Rolename']    = input('post.rolename');
		$data['Description'] = input('post.description');
		$data['Competence']  = input('post.comp');
		$data['Status']      = input('post.status');		
		return $data;
	}
	
}