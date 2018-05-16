<?php
/**
* 前端导航Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\system;
use app\data\model\system\NavModel  as NavModel;
use app\data\service\BaseService as BaseService;

class NavService extends BaseService 
{
	protected $cache = '';
	
	public function __construct()
	{
		parent::__construct();		
		$this->nav = new NavModel();
		$this->cache = 'navs';
	}
	
    /**
     * 查询前端导航列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function navList($where='', $field='*', $order='sort asc')
	{
		$list = $this->nav->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取前端导航信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function navInfo($where='', $field='*')
	{		
		$info =  $this->nav->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计前端导航数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function navCount($where='')
	{		
		$Count =  $this->nav->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function navSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->nav->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function navSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->nav->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function navColumn($where='', $field='')
	{		
		$Column =  $this->nav->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条前端导航数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function navAdd($data='')
	{
		$list = $this->nav->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条前端导航数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function navAddAll($data='')
	{
		$list = $this->nav->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 前端导航分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function navPageList($where='', $field='*', $order="sort asc", $page=15)
	{	
		$list = $this->nav->getPageList($where, $field, $order, $page, $this->cache);
		return $list;
	}
	
	/**
     * 更新前端导航数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function navSave($where="", $data="")
    {	
        $save = $this->nav->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条前端导航数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function navDel($where='')
    {		
        $del = $this->nav->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条前端导航数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function navDelMost($id_arr='')
    {		
        $delAll = $this->nav->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 前端导航列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function navListShow($type=0) 
	{
    	$where = array();
    	$where['id'] = ['>',0];
    	$lists  = $this->navPageList($where);
		$volist = false;
		if($lists && !$type)
		{
			$volist = $lists->toArray();
		}
		else if($lists && $type)
		{
			$volist = $lists ;
		}
        return $volist;
	}
	
	 /**
     * 按条件添加一条前端导航
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function navRoomAdd() 
	{
		//前端导航POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->navAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新前端导航
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function navRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->navInfo("id=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理前端导航
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function navRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//前端导航POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['id'] = $id;
		$info = $this->navInfo($where);
		
		if($this->navSave($where, $data))
		{
			//删除原图片
			if(!empty($_FILES['nav_image']['tmp_name']))
			{
				parent::DelImg(input('post.primary_nav'));
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 前端导航POST数据
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
		if(!empty($_FILES['nav_image']['tmp_name']))
		{
		    $file = parent::upload('navs','nav_image');
			//dump($file);die;
		    if($file){
		        $data['nav_image'] = $file;
		    }else{
		        return false;
		    }
		}
		
			$data['name']            = input('post.name');
			$data['english']          = input('post.english');
			input('post.pid') ? $data['pid'] = input('post.pid') : $data['pid'] = 0;
			$data['url']             = input('post.url');
			$data['sort']             = input('post.sort');			
			input('post.description') && $data['description'] = htmlentities(input('post.description'));
		
		return $data;
	}
	
    /**
     * 删除前端导航操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function navRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['id'] = $id;		
    	$info = $this->navInfo($where);
		if($info && $this->navDel($where))
		{
			//删除原图片
			if(!empty($_FILES['nav_image']['tmp_name']))
			{
				parent::DelImg(input('post.primary_nav'));
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除前端导航
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function navRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->navDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 删除单个前端导航图片
	 * 创建人 韦丽明
	 * 时间 2017-09-15 00:33:04
     */
	public function navDelOnePic() 
	{
	    $data = array();
		$where = array();
	    $id = input('post.key');
	    $data['	nav_image'] = "";
		$where['id'] = $id;
		
		if($this->navSave($where, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
}