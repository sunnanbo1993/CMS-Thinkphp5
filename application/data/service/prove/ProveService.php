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

namespace app\data\service\prove;
use app\data\model\prove\ProveModel  as ProveModel;
use app\data\service\BaseService as BaseService;

class ProveService extends BaseService 
{
	protected $cache = 'proves';
	
	public function __construct()
	{
		parent::__construct();
		$this->prove = new ProveModel();
		$this->cache = 'proves';
	}
	
    /**
     * 查询证书列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function proveList($where='', $field='*', $order='p_id desc')
	{	
		$list = $this->prove->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取证书信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function proveInfo($where='', $field='*')
	{		
		$info =  $this->prove->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计证书数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function proveCount($where='')
	{		
		$Count =  $this->prove->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function proveSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->prove->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function proveSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->prove->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function proveColumn($where='', $field='')
	{		
		$Column =  $this->prove->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条证书数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function proveAdd($data='')
	{
		$list = $this->prove->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条证书数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function proveAddAll($data='')
	{
		$list = $this->prove->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 证书分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function provePageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'p_id desc';
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
		$list = $this->prove->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新证书数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function proveSave($where="", $data="")
    {	
        $save = $this->prove->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条证书数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function proveDel($where='')
    {		
        $del = $this->prove->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条证书数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function proveDelMost($id_arr='')
    {
        $delAll = $this->prove->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 证书列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function proveListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$p_name         = input('get.p_name');
		
    	$where = array();
		$data = array();
		$cache = '';
    	if($p_name!="")
		{
    		$where['p_name'] = array("LIKE","%$p_name%");
			//查询时不缓存
			$cache = '';
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
		//dump($cache);die;
		$where['p_id'] = array('>',0);
    	$lists  = $this->provePageList($data);	
		$volist = false;
		if($lists && !$type)
		{
			if(is_object($lists))
			{
				$volist = $lists->toArray();
			}else
			{
				$volist["data"] = $lists ;
			}
		}
		else if($lists && $type)
		{
			$volist = $lists;
		}
        return $volist;
	}
	
	 /**
     * 按条件添加一条证书
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function proveRoomAdd() 
	{
		//证书POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->proveAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新证书
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function proveRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$result = false;
    	$result = $this->proveInfo("p_id=$id");
		
		return $result;
	}
	
    /**
     * 按条件修改处理证书
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function proveRoomEditDoo() 
	{
		$id = input('post.p_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//证书POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['p_id'] = $id;
		$info = $this->proveInfo($where);
		if($info && $this->proveSave($where, $data))
		{
			//删除原图片
			if(!empty($_FILES['p_image']['tmp_name']))
			{
				parent::DelImg($info['p_image']);
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 证书POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:58:22
     */
	public function inputData($type) 
	{		
		$data = array();
		switch($type)
		{
			case  "edit";
			
			break;							
			case  "add";	
				$data['addtime'] = time();			
			break;
		} 
		
		if(!empty($_FILES['p_image']['tmp_name']))
		{
		    $file = parent::upload('proves','p_image', 2);			
		    if($file){
		        $data['p_image'] = $file['info'];
				$data['minpic'] = $file['thumb'];
		    }else{
		        return false;
		    }
		}
		//dump($data);die;
		
		$data['p_name']            = input('post.p_name');
		input('post.p_content') && $data['p_content'] = htmlentities(input('post.p_content'));	
		
		return $data;
	}
	
    /**
     * 删除证书操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function proveRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['p_id'] = $id;		
    	$info = $this->proveInfo($where);
		if($info && $this->proveDel($where))
		{
			//删除原图片
			if(!empty($_FILES['p_image']['tmp_name']))
			{
				parent::DelImg($info['p_image']);
			}
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除证书
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function proveRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->proveDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	
}