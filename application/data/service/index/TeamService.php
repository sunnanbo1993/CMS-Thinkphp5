<?php
/**
* 团队Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\index;
use app\data\model\index\TeamModel  as TeamModel;
use app\data\service\BaseService as BaseService;

class TeamService extends BaseService 
{
	protected $cache = '';
	
	public function __construct()
	{
		parent::__construct();		
		$this->team = new TeamModel();
		$this->cache = 'teams';
	}
	
    /**
     * 查询团队列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function teamList($where='', $field='*', $order='sort asc')
	{
		$list = $this->team->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取团队信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function teamInfo($where='', $field='*')
	{		
		$info =  $this->team->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计团队数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function teamCount($where='')
	{		
		$Count =  $this->team->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function teamSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->team->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function teamSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->team->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function teamColumn($where='', $field='')
	{		
		$Column =  $this->team->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条团队数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function teamAdd($data='')
	{
		$list = $this->team->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条团队数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function teamAddAll($data='')
	{
		$list = $this->team->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 团队分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function teamPageList($data)
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
		$list = $this->team->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新团队数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function teamSave($where="", $data="")
    {	
        $save = $this->team->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条团队数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function teamDel($where='')
    {		
        $del = $this->team->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条团队数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function teamDelMost($id_arr='')
    {		
        $delAll = $this->team->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 团队列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function teamListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$post        = input('get.post');
		$name  = input('get.name');
    	$where = array();
		$data = array();
		$cache = '';
    	if($post!=""){
    		$where['post'] = array("LIKE","%$post%");
    	}
    	if($name!=""){
    		$where['name'] = array("LIKE","%$name%");
    	}
		$data['where'] = $where ;
		$data['field'] = $field;
		$data['page'] = $page;
		$data['cache'] = $cache;
    	$lists  = $this->teamPageList($data);
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
     * 按条件添加一条团队
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function teamRoomAdd() 
	{
		//团队POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->teamAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新团队
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function teamRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->teamInfo("id=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理团队
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function teamRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//团队POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['id'] = $id;
		$info = $this->teamInfo($where);
		
		if($this->teamSave($where, $data))
		{
			//删除原图片
			if(!empty($_FILES['user_pic']['tmp_name']))
			{
				parent::DelImg($info['user_pic']);
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 团队POST数据
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
		
		if(!empty($_FILES['user_pic']['tmp_name']))
		{
		    $file = parent::upload('team','user_pic');
		    if($file)
			{
		        $data['user_pic'] = $file;
		    }
			else
			{
		        return false;
		    }
		}
		
		$data['name']        = input('post.name');
		$data['post']        = input('post.post');
		$data['sort']        = input('post.sort');
		$data['description'] = htmlentities(input('post.description'));
		
		return $data;
	}
	
    /**
     * 删除团队操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function teamRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['id'] = $id;		
    	$info = $this->teamInfo($where);
		if($info && $this->teamDel($where))
		{
			//删除原图片
			if(!empty($_FILES['user_pic']['tmp_name']))
			{
				parent::DelImg($info['user_pic']);
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除团队
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function teamRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->teamDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 删除单个团队图片
	 * 创建人 韦丽明
	 * 时间 2017-09-15 00:33:04
     */
	public function teamDelOnePic() 
	{
	    $data = array();
		$where = array();
	    $id = input('post.key');
	    $data['user_pic'] = "";
		$where['id'] = $id;
		
		if($this->teamSave($where, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
}