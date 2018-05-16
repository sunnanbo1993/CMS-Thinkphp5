<?php
/**
* 友情链接Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\links;
use app\data\model\links\LinkModel  as LinkModel;
use app\data\service\BaseService as BaseService;

class LinkService extends BaseService 
{
	protected $cache = 'links';	
	
	public function __construct()
	{
		parent::__construct();
		$this->links = new LinkModel();
		$this->cache = 'links';
		
	}
	
    /**
     * 查询友情链接列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function linksList($where='', $order='link_sort asc', $field='*', $cache='links')
	{	
		$list = $this->links->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取友情链接信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function linksInfo($where='', $field='*')
	{		
		$info =  $this->links->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计友情链接数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function linksCount($where='')
	{		
		$Count =  $this->links->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function linksSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->links->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function linksSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->links->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function linksColumn($where='', $field='')
	{		
		$Column =  $this->links->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条友情链接数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function linksAdd($data='')
	{
		$list = $this->links->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条友情链接数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function linksAddAll($data='')
	{
		$list = $this->links->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 友情链接分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function linksPageList($where='', $field='*', $order="link_sort asc", $page=15)
	{	
		$list = $this->links->getPageList($where, $field, $order, $page, $this->cache);
		return $list;
	}
	
	/**
     * 更新友情链接数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function linksSave($where="", $data="")
    {	
        $save = $this->links->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条友情链接数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function linksDel($where='')
    {		
        $del = $this->links->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条友情链接数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function linksDelMost($id_arr='')
    {		
        $delAll = $this->links->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 友情链接列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function linksListShow($type=0) 
	{
		$link_title = input('get.link_title');
    	$where = array();
    	if($link_title!="")
		{
    		$where['link_title'] = array("LIKE","%$link_title%");
    	}
		$where['link_id'] = array('>',0);

    	$lists  = $this->linksPageList($where);
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
     * 按条件添加一条友情链接
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function linksRoomAdd() 
	{
		//友情链接POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->linksAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新友情链接
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function linksRoomEdit() 
	{
		$id = input('get.link_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->linksInfo("link_id=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理友情链接
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function linksRoomEditDoo() 
	{
		$id = input('post.link_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//友情链接POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['link_id'] = $id;
		$info = $this->linksInfo($where);
		
		if($info && $this->linksSave($where, $data))
		{	
			//删除原图片
			$this->linksDelImg($info['link_pic']);	
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 友情链接POST数据
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
			break;
		}   	
		if(!empty($_FILES['link_pic']['tmp_name']))
		{
		    $file = parent::upload('link','link_pic');
			//dump($file);die;
		    if($file){
		        $data['link_pic'] = $file;
		    }else{
		        return false;
		    }
		}
		input('post.link_title') && $data['link_title'] = input('post.link_title');
		input('post.link_url') &&	$data['link_url'] = input('post.link_url');
		input('post.link_sort') &&	$data['link_sort'] = input('post.link_sort');	
		
		return $data;
	}
	
    /**
     * 删除友情链接操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function linksRoomDel() 
	{
		$id = input('post.link_id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['link_id'] = $id;		
    	$info = $this->linksInfo($where);
		if($info && $this->linksDel($where))
		{
			//删除原图片
			$this->linksDelImg($info['link_pic']);				
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除友情链接分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function linksRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->linksDelMost($id))
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
	public function linksDelImg($img) 
	{
		$primary_file = '';
		$primary_file = $img;
		if(!empty($primary_file))
		{
			$imgUrl = $primary_file;
			$unlink = parent::unlikFile($imgUrl);
		}
	}
	
    /**
     * 删除单个友情链接图片
	 * 创建人 韦丽明
	 * 时间 2017-09-15 00:33:04
     */
	public function linksDelOnePic() 
	{
	    $data = array();
		$where = array();
	    $id = input('post.key');
	    $data['link_pic'] = "";
		$where['link_id'] = $id;
		
		if($this->linksSave($where, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
}