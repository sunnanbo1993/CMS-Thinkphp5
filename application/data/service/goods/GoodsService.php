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
use app\data\model\goods\GoodsModel  as GoodsModel;
use app\data\service\BaseService as BaseService;

class GoodsService extends BaseService 
{
	protected $cache = 'goods';
	protected $pid = 0;	
	
	public function __construct()
	{
		parent::__construct();
		$this->goods = new GoodsModel();
		$this->cache = 'goods';
		//dump($this->pid);die;
	}
	
    /**
     * 查询商品列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function goodsList($where='', $field='*', $order='goods_id desc', $cache='goods')
	{	
		$list = $this->goods->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取商品信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function goodsInfo($where='', $field='*')
	{		
		$info =  $this->goods->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计商品数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function goodsCount($where='')
	{		
		$Count =  $this->goods->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function goodsSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->goods->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function goodsSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->goods->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function goodsColumn($where='', $field='')
	{		
		$Column =  $this->goods->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条商品数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function goodsAdd($data='')
	{
		$list = $this->goods->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条商品数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function goodsAddAll($data='')
	{
		$list = $this->goods->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 商品分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function goodsPageList($data)
	{	
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'goods_id desc';
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
		//dump($where);die;
		$list = $this->goods->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新商品数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function goodsSave($where="", $data="")
    {	
        $save = $this->goods->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条商品数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function goodsDel($where='')
    {		
        $del = $this->goods->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条商品数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function goodsDelMost($id_arr='')
    {
		$gclass = new \app\data\service\goods\GclassService();
		//所有的分类
		$where['gc_id'] = array('>',0);
		$field = 'gc_id';
		$pidList = $gclass->gclassList($where, $field);
		foreach($pidList as $key=>$v)
		{
			//删除所有缓存
			$this->goods->getClearAllPid($v['gc_id'], $this->cache);
		}
		
        $delAll = $this->goods->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 商品列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function goodsListShow($type=0, $page=15, $gc_pid=0) 
	{
		$goods_sn         = input('get.goods_sn');
		$goods_name       = input('get.goods_name');
		$barcode          = input('get.barcode');
		$pid          	  = input('get.pid');		
    	$where = array();
		$data = array();
		$cache = '';
    	if($goods_sn!=""){
    		$where['goods_sn'] = array("LIKE","%$goods_sn%");
    	}
    	if($goods_name!=""){
			$where['goods_name'] = array("LIKE","%$goods_name%");
    	}
    	if($barcode!=""){
    		$where['barcode'] = array("LIKE","%$barcode%");
    	}
    	if($pid!=""){
    		$where['pid'] = explode('|',$pid)[0];
    	}
		
		if($gc_pid && is_numeric($gc_pid)){
			$where['pid'] = $gc_pid ;
			//前台分页缓存 列如“1goodsC”
			$cache = $this->cache ;
			$cache = $gc_pid.$cache.'C';
		}		
		$data['where'] = $where ;
		$data['cache'] = $cache ;
		$data['field'] = '*';
		$data['page']  = $page ;
		
    	$lists  = $this->goodsPageList($data);	
		
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
     * 按条件添加一条商品
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function goodsRoomAdd() 
	{
		//商品POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->goodsAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新商品
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function goodsRoomEdit() 
	{
		$id = input('get.goods_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->goodsInfo("goods_id=$id");
		$result['organizers'] = json_decode($result['organizers'],TRUE);
		
		if($result)
		{
			$gclass = new \app\data\service\goods\GclassService();
			//获取被选中商品分类和所有商品分类
		    $arr = $gclass->liegthGcalss($result);		
			return $arr;		
		}
	}
	
    /**
     * 按条件修改处理商品
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function goodsRoomEditDoo() 
	{
		$id = input('post.goods_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//商品POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['goods_id'] = $id;
		
		if($this->goodsSave($where, $data))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 商品POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:58:22
     */
	public function inputData($type) 
	{		
		$data = array();
		switch($type)
		{
			case  "edit";
				$data['pid'] = input('post.pid_edit');
			break;							
			case  "add";	
				$data['pid'] = input('post.pid');
				$data['create_time'] = time();			
			break;
		} 		
		//多张图片
		$num = 1;
		foreach($_FILES as $key=>$v)
		{
			$pic = 'minpic'.$num;
			if(!empty($v['tmp_name']))
			{
				$type = 2 ;
				$file = parent::upload('goods', $key, $type);
				if($file){
					$data[$key] = $file['info'];
					$data[$pic] = $file['thumb'];
				}else{
					return false;
				}					
			}
			unset($pic);
			unset($file);
			$num++;
		}
		
		//自定义属性
		$organi_name = array();
		$organi_value = array();
		input('post.organi_name/a') && $organi_name = input('post.organi_name/a');
		input('post.organi_value/a') && $organi_value = input('post.organi_value/a');	
		$vlue = array();
		foreach($organi_name as $key=>$v)
		{
			if($v)
			{
				if(!$organi_value[$key])
				{
					$organi_value[$key] = 0;
				}
				$vlue[$v] = $organi_value[$key];
			}
		}

		$data['organizers']          = json_encode($vlue);
		$data['goods_sn']            = input('post.goods_sn');
		$data['goods_name']          = input('post.goods_name');
		$data['price']               = input('post.price');
		$data['barcode']             = input('post.barcode');
		$data['download']            = input('post.download');							
		input('post.content') && $data['goods_content'] = htmlentities(input('post.content'));
		input('post.description') && $data['description'] = htmlentities(input('post.description'));		
		return $data;
	}
	
    /**
     * 删除商品操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function goodsRoomDel() 
	{
		$id = input('post.goods_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['goods_id'] = $id;		
    	$info = $this->goodsInfo($where);
		if($info && $this->goodsDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 删除原图片
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function goodsDelImg() 
	{
		$i = 1 ;
		foreach($_FILES as $key=>$v)
		{
			$primary_file = '';
			if(!empty($v[$key]['tmp_name']))
			{
				$primary_file = input('post.'.$key);
				$primary_min = input('post.'.$key);	
				if(!empty($primary_file)){
					$imgUrl = $primary_file;
					$unlink = parent::unlikFile($imgUrl);
					//删除缩列图
					$primary_min && parent::unlikFile($primary_min, 1);
				}						
			}
			$i++;
		}
	}
	
    /**
     * 批量删除商品
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function goodsRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->goodsDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	
}