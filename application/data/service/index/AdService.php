<?php
/**
* 广告Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\index;
use app\data\model\index\AdModel  as AdModel;
use app\data\service\BaseService as BaseService;

class AdService extends BaseService 
{
	protected $cache = 'adlists';
	
	public function __construct()
	{
		parent::__construct();		
		$this->ad = new AdModel();
		$this->cache = 'adlists';
	}
	
    /**
     * 查询广告列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function adList($where='', $field='*', $order='sort_order asc')
	{
		$list = $this->ad->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取广告信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function adInfo($where='', $field='*')
	{		
		$info =  $this->ad->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计广告数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function adCount($where='')
	{		
		$Count =  $this->ad->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function adSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->ad->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function adSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->ad->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function adColumn($where='', $field='')
	{		
		$Column =  $this->ad->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条广告数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function adAdd($data='')
	{
		$list = $this->ad->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条广告数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function adAddAll($data='')
	{
		$list = $this->ad->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 广告分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function adPageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'sort_order asc';
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
		$list = $this->ad->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新广告数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function adSave($where="", $data="")
    {	
        $save = $this->ad->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条广告数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function adDel($where='')
    {		
        $del = $this->ad->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条广告数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function adDelMost($id_arr='')
    {		
        $delAll = $this->ad->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 广告列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function adListShow($field='*', $c_pid=0, $page=15) 
	{
		$title        = input('get.title');
		$title_alias  = input('get.title_alias');
    	$where = array();
		$data = array();
		$cache = '';
    	if($title!="")
		{
    		$where['title'] = array("LIKE","%$title%");
    	}
    	if($title_alias!="")
		{
    		$where['title_alias'] = array("LIKE","%$title_alias%");
    	}
		$data['where'] = $where ;
		$data['field'] = $field;
		$data['page'] = $page;
		$data['cache'] = $cache;
    	$lists  = $this->adPageList($data);
		$volist = false;
		if($lists)
		{
			$volist = $lists->toArray();
		}		
        return $volist;
	}
	
	 /**
     * 按条件添加一条广告
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function adRoomAdd() 
	{
		//广告POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->adAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新广告
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function adRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->adInfo("id=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理广告
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function adRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//广告POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['id'] = $id;
		$info = $this->adInfo($where);
		
		if($this->adSave($where, $data))
		{
			//删除原图片
			if(!empty($_FILES['attach_file']['tmp_name']))
			{
				parent::DelImg($info['attach_file']);
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 广告POST数据
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
			     $data['create_time'] = time();			
			break;
		}   	
		if(!empty($_FILES['attach_file']['tmp_name']))
		{
		    $file = parent::upload('ad','attach_file');
			//dump($file);die;
		    if($file){
		        $data['attach_file'] = $file;
		    }else{
		        return false;
		    }
		}
		
		input('post.title') && $data['title'] = input('post.title');
		input('post.title_alias') && $data['title_alias'] = input('post.title_alias');
		input('post.link_url') && $data['link_url'] = input('post.link_url');
		input('post.image_url') && $data['image_url'] = input('post.image_url');
		input('post.width') && $data['width'] = input('post.width');
		input('post.height') && $data['height'] = input('post.height');
		input('post.intro') && $data['intro'] = input('post.intro');
		input('post.start_time') && $data['start_time'] = strtotime(input('post.start_time'));
		input('post.expired_time') && $data['expired_time'] = strtotime(input('post.expired_time'));
		input('post.sort_order') && $data['sort_order'] = input('post.sort_order');
		input('post.status_is') && $data['status_is'] = input('post.status_is');
		
		return $data;
	}
	
    /**
     * 删除广告操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function adRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['id'] = $id;		
    	$info = $this->adInfo($where);
		if($info && $this->adDel($where))
		{
			//删除原图片
			if(!empty($_FILES['attach_file']['tmp_name']))
			{
				parent::DelImg($info['attach_file']);
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除广告
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function adRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->adDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 删除单个广告图片
	 * 创建人 韦丽明
	 * 时间 2017-09-15 00:33:04
     */
	public function adDelOnePic() 
	{
	    $data = array();
		$where = array();
	    $id = input('post.key');
	    $data['attach_file'] = "";
		$where['id'] = $id;
		
		if($this->adSave($where, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
}