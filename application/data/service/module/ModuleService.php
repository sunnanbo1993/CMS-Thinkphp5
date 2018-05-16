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

namespace app\data\service\module;
use app\data\model\module\ModuleModel  as ModuleModel;
use app\data\service\BaseService as BaseService;

class ModuleService extends BaseService 
{
	protected $cache = 'modules';
	protected $pid = 0;	
	
	public function __construct()
	{
		parent::__construct();
		$this->module = new ModuleModel();
		$this->cache = 'modules';
	}
	
    /**
     * 查询后台模块列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function moduleList($where='', $field='*', $order='Msort asc', $cache='')
	{	
		$list = $this->module->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取后台模块信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function moduleInfo($where='', $field='*')
	{		
		$info =  $this->module->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计后台模块数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function moduleCount($where='')
	{		
		$Count =  $this->module->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function moduleSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->module->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function moduleSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->module->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function moduleColumn($where='', $field='')
	{		
		$Column =  $this->module->getColumn($where, $field);		
		return $Column;
	}
	
    /**
     * 添加一条后台模块数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function moduleAdd($data='')
	{
		$list = $this->module->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条后台模块数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function moduleAddAll($data='')
	{
		$list = $this->module->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 后台模块分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function modulePageList($where='', $field='*', $order="ID desc", $page=15, $cache="modules")
	{	
		$list = $this->module->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新后台模块数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function moduleSave($where="", $data="")
    {	
        $save = $this->module->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条后台模块数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function moduleDel($where='')
    {		
        $del = $this->module->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条后台模块数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function moduleDelMost($id_arr='')
    {
        $delAll = $this->module->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 后台模块列表
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function moduleListShow() 
	{		
		$where['ID'] = array('>',0);
    	$lists  = $this->moduleList($where);
		$volist  = $this->moduleForeach($lists);
        return $volist;
	}
	
    /**
     * 添加后台模块页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function moduleAddShow() 
	{		
		$where['ID'] = array('>',0);
		$where['Status'] = array('=',0);
		$file="ID,Sid,ModuleName,Msort";
    	$lists  = $this->moduleColumn($where, $file);
		$volist  = $this->moduleForeach($lists);
		return $volist;
	}
	
	 /**
     * 无极分类
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */	
	public function moduleForeach($lists)
	{
		$result = $lists;		
		$html = "──";
		$level = 0 ;
		$volist = array();		
		while(list($k,$v)=each($lists))
		{	 
			 if(is_array($result))
			 {
				$v['classname'] = $v['ModuleName'];
				$v['html'] = str_repeat($html,$level);
					
				if($v['Sid']==0)
				{
					$level = 0 ;
					$volist[] = $v;
				}				
				 foreach($result as $key => $vv)
				 {					
					 if($v['ID']===$vv['Sid'])
					 {
						$vv['classname'] = $vv['ModuleName'];
						$vv['html'] = str_repeat($html,$level+1);
						$arr = array();
						$arr[] = $vv;
						//合并数组
						$volist = array_merge($volist,$arr);
					 }
				 } 
			 } 
		}
		//dump($volist);die;
        return $volist;		
	}
	
	 /**
     * 按条件添加一条后台模块
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function moduleRoomAdd() 
	{
		//后台模块POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->moduleAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新后台模块
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function moduleRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$result = false;
    	$result = $this->moduleInfo("ID=$id");		
		return $result;
	}
	
    /**
     * 按条件修改处理后台模块
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function moduleRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//后台模块POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['ID'] = $id;
		
		if($this->moduleSave($where, $data))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 后台模块POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:58:22
     */
	public function inputData($type) 
	{		
		$data = array();
		switch($type)
		{
			case  "edit";
				$data['Sid'] = input('post.pid_edit');
			break;							
			case  "add";	
				$data['Sid'] = input('post.pid');
				$data['Dtime'] = date('Y-m-d H:i:s',time());			
			break;
		} 	
		$data['ModuleName']  = input('post.mname');
		$data['ModuleImg']   = input('post.img');
		$data['ModuleUrl']   = input('post.url');
		$data['Status']      = input('post.status');
		$data['Msort']       = input('post.msort');
		$data['Description'] = input('post.description');		
		return $data;
	}
	
    /**
     * 删除后台模块操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function moduleRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->moduleInfo($where);
		if($info && $this->moduleDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除后台模块
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function moduleRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->moduleDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	
}