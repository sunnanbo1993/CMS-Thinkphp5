<?php
/**
* 权限Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-09-14
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\competence;
use app\data\model\competence\CompetenceModel  as CompetenceModel;
use app\data\service\BaseService as BaseService;

class CompetenceService extends BaseService 
{
	protected $cache = '';
	
	public function __construct()
	{
		parent::__construct();	
		$this->competen = new CompetenceModel();
		$this->cache = 'competens';
	}
	
    /**
     * 查询权限列表
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:10:21
     */
	public function competenceList($where='', $field='*', $order='Dtime asc')
	{
		$list = $this->competen->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取权限信息
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function competenceInfo($where='', $field='*')
	{		
		$info =  $this->competen->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计权限数量
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function competenceCount($where='')
	{		
		$Count =  $this->competen->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function competenceSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->competen->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function competenceSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->competen->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function competenceColumn($where='', $field='')
	{		
		$Column =  $this->competen->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条权限数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function competenceAdd($data='')
	{
		$list = $this->competen->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条权限数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function competenceAddAll($data='')
	{
		$list = $this->competen->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 权限分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:31:15
     */
	public function competencePageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'Dtime asc';
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
		$list = $this->competen->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新权限数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 22:19:05
     */
    public function competenceSave($where="", $data="")
    {	
        $save = $this->competen->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条权限数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:05:08      
     */
    public function competenceDel($where='')
    {		
        $del = $this->competen->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条权限数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:08:51       
     */
    public function competenceDelMost($id_arr='')
    {		
        $delAll = $this->competen->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 权限列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function competenceListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
    	$where = array();
		$data = array();
		$cache = '';
		$keyword = input('request.keyword');
		if($keyword!=""){
		    $where['Cname']=$keyword;
		}		
		$where['ID'] = array('>',0);
		$where['Sid']     = array("EQ",0);
		$data['where'] = $where ;
		$data['field'] = $field;
		$data['page'] = $page;
		$data['cache'] = $cache;
    	$lists  = $this->competencePageList($data);
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
     * 按条件更新权限
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function competenceRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) 
		{
			return false;
		}
		$id=intval($id);
		$where = array();
		$where['ID'] = $id;	
		$result = false;
    	$result = $this->competenceInfo($where);	
		return $result;
	}

    /**
     * 按条件修改处理权限
	 * 创建人 韦丽明
	 * 时间 2017-09-14 13:34:05
     */
	public function competenceRoomEditDoo($where='') 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) 
		{
			return false;
		}
		$id=intval($id);
		// 权限POST数据
		$type = 'edit';
		$data = $this->inputData($type);
		if(!$where)
		{
			$where = array();		
			$where['ID'] = $id;			
		}
		if($this->competenceSave($where, $data))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}

    /**
     * 删除权限操作
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:10:16
     */
	public function competenceRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) 
		{
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->competenceInfo($where);
		if($info && $this->competenceDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}	
	
    /**
     * 批量删除权限
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:35:11
     */
	public function competenceRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->competenceDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 添加一条权限
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function competenceRoomAdd() 
	{
		// 权限POST数据
		$type = 'add';
		$data = $this->inputData($type);		
		if($this->competenceAdd($data))
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
			break;
			case 'add';
				$data['Dtime'] = date('Y-m-d H:i:s',time());
			break;
		}   	
		$data['Sid']         = input('post.sid');
		$data['Cname']       = input('post.cname');
		$data['Description'] = input('post.description');
		$data['Status']      = input('post.status');		
		return $data;
	}
	
}