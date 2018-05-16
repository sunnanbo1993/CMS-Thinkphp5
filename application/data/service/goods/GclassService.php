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

namespace app\data\service\goods;
use app\data\model\goods\GclassModel  as GclassModel;
use app\data\service\BaseService as BaseService;

class GclassService extends BaseService 
{
	protected $cache = 'gclass';
	
	public function __construct()
	{
		parent::__construct();	
		$this->gclass = new GclassModel();
		$this->cache = 'gclass';
		//统计分类种类数量
		$cache = $this->cache;
		$count = \think\Cache::get($cache.'P');
		if(!$count)
		{
			$where['gc_id']=array('>',0);
			$count = $this->gclassCount();
			\think\Cache::set($cache.'P',$count);
			\think\Cache::set('goodsP',$count);			
		}
	}
	
    /**
     * 查询商品分类列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function gclassList($where='', $field='*', $order='sort asc', $cache='gclass')
	{
		$list = $this->gclass->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取商品分类信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function gclassInfo($where='', $field='*')
	{		
		$info =  $this->gclass->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计商品分类数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function gclassCount($where='')
	{		
		$Count =  $this->gclass->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function gclassSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->gclass->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function gclassSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->gclass->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function gclassColumn($where='', $field='')
	{		
		$Column =  $this->gclass->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条商品分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function gclassAdd($data='')
	{
		$list = $this->gclass->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条商品分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function gclassAddAll($data='')
	{
		$list = $this->gclass->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 商品分类分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-10 21:31:15
     */
	public function gclassPageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'sort asc';
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
		$list = $this->gclass->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新商品分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function gclassSave($where="", $data="")
    {	
        $save = $this->gclass->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条商品分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function gclassDel($where='')
    {		
        $del = $this->gclass->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条商品分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function gclassDelMost($id_arr='')
    {		
        $delAll = $this->gclass->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 商品分类列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 21:39:01
     */
	public function gclassListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
    	$where = array();
		$data = array();
		$cache = '';
		$where['gc_id'] = array('>',0);
		$data['where'] = $where ;
		$data['field'] = $field;
		$data['page'] = $page;
		$data['cache'] = $cache;
    	$lists  = $this->gclassPageList($data);
		$volist = false;
		//dump($lists);die;
		if($lists && !$type)
		{
			$result = $lists->toArray();
			$volist = $result;
			
			 while(list($k,$v)=each($result['data']))
			 {	 
				 foreach($volist['data'] as $key => $vv)
				 {
					 $volist['data'][$key]['add_time'] = date('Y-m-d',$vv['addtime']) ;
					 if($v['gc_id']===$vv['pid'])
					 {
						 $volist['data'][$key]['p_name'] = $v['name_en'].'&nbsp;('.$v['name_ch'].')' ;		
						 
					 }
				 }
			 }
		}
		else if($lists && $type)
		{
			$result = $lists->toArray();
			$volist = $result['data'];			
		}
		
        return $volist;
	}
	
    /**
     * 按条件添加一条商品分类
	 * 创建人 韦丽明
	 * 时间 2017-09-10 21:39:01
     */
	public function gclassRoomAdd() 
	{
		// 商品分类POST数据
		$type = 'add';
		$data = $this->inputData($type);		
		if($this->gclassAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新商品分类
	 * 创建人 韦丽明
	 * 时间 2017-09-10 21:39:01
     */
	public function gclassRoomEdit() 
	{
		$id = input('get.gc_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->gclassInfo("gc_id=$id");
		if($result)
		{
			//获取被选中商品分类和所有商品分类
			$arr = $this->liegthGcalss($result);		
			return $arr;		
		}
	}

    /**
     * 按条件修改处理商品分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 13:34:05
     */
	public function gclassRoomEditDoo() 
	{
		$id = input('post.gc_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		// 商品分类POST数据
		$type = 'edit';
		$data = $this->inputData($type);
		$where = array();		
		$where['gc_id'] = $id;

		if($this->gclassSave($where, $data))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}

    /**
     * 删除商品分类操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:10:16
     */
	public function gclassRoomDel() 
	{
		$id = input('post.gc_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['gc_id'] = $id;		
    	$info = $this->gclassInfo($where);
		if($info && $this->gclassDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}	
	
    /**
     * 批量删除商品分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function gclassRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->gclassDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 商品分类POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:15
     */
	public function inputData($type) 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
			break;
			case 'add';			
			$data['addtime']         = time();			
			break;
		}   	
		$data['name_en']      = input('post.name_en');
		$data['name_ch']      = input('post.name_ch');			
		$data['pid']          = input('post.pid');			
		$data['sort']         = input('post.sort');	
		$data['states']       = 1 ;				
		input('post.description') && $data['description'] = htmlentities(input('post.description'));		
		return $data;
	}
	
	/*
	* 商品分类
	* 创建人 韦丽明
	* 时间 2017-09-11 13:22:15
	*/
	public function gclassAll() 
	{
		$where = array();
		$where['gc_id'] = ['>',0];
		$where['states'] = ['>',0];
		$field = 'gc_id,name_en,name_ch,pid';
    	$result = $this->gclassList($where, $field);
		$volist = $result;
		
		while(list($k,$v)=each($result))
		{	 
			foreach($volist as $key => $vv)
			{
				if($v['pid']===$vv['gc_id'])
				{
					$volist[$key]['son'][] = $v ;
				}
				else
				{
					$volist[$key]['son'] = '';
				}
			}
		}
		return $volist;
	}
	 
    /**
     * 获取被选中商品分类和所有商品分类
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:28:01
     */
	 public function goodsGcalss($result) 
	 {
		$arr = array();
		$where = array();
		$where['gc_id'] = ['>',0];
		$where['states'] = ['>',0];	
		$volist = $this->gclassList($where, $field='gc_id,name_en,name_ch,pid');
		if(is_object($volist))
		{
			$volist = $volist->toArray();
		}
		else
		{
			$volist["data"] = $volist ;
		}		
		
		while(list($k,$v)=each($volist['data']))
		{	 
			 if(is_array($result))
			 {
				 foreach($result["data"] as $key => $vv)
				 {						
					 if($v['gc_id']===$vv['pid'])
					 {
						$result["data"][$key]['p_name'] = $v['name_en'];					 
					 }
				 }				 
			 }
			 else
			 {
				 if($v['gc_id']===$result)
				 {
					//$result = $v['name_en'].'&nbsp;('.$v['name_ch'].')' ;	
					$result = $v['name_en'] ;							
				 }			 
			 }
		}		
		return $result;		
	 }
	 
    /**
     * 获取被选中商品分类和所有商品分类
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:28:01
     */
	 public function liegthGcalss($result) 
	 {
		$arr = array();
		$where = array();
		$where['gc_id'] = ['>',0];
		$where['states'] = ['>',0];			
		$volist = $this->gclassList($where, $field='gc_id,name_en,name_ch,pid');
		if(is_object($volist))
		{
			$volist = $volist->toArray();
		}
		else
		{
			$volist["data"] = $volist ;
		}
		$liegth = 0 ;
		foreach($volist["data"] as $key=>$v)
		{
			if($result['pid']===$v['gc_id'])
			{
				$volist["data"][$key]['liegth'] = 1 ;
				$liegth = 1 ;
			}
			else
			{
				$volist["data"][$key]['liegth'] = 0 ;
			}
		}

		$arr['result'] = $result;
		$arr['volist'] = $volist["data"];
		$arr['liegth'] = $liegth;			
		return $arr;		
	 }
	
}