<?php
/**
* 新闻分类Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\news;
use app\data\model\news\NewsclassModel  as NewsclassModel;
use app\data\service\BaseService as BaseService;

class NewsclassService extends BaseService 
{
	protected $cache = 'nclass';	
	
	public function __construct()
	{
		parent::__construct();
		$this->nclass = new NewsclassModel();
		$this->cache = 'nclass';
		
	}
	
    /**
     * 查询新闻分类列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function nclassList($where='', $order='ID desc', $field='*', $cache='nclass')
	{	
		$list = $this->nclass->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取新闻分类信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function nclassInfo($where='', $field='*')
	{		
		$info =  $this->nclass->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计新闻分类数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function nclassCount($where='')
	{		
		$Count =  $this->nclass->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function nclassSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->nclass->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function nclassSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->nclass->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function nclassColumn($where='', $field='')
	{		
		$Column =  $this->nclass->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条新闻分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function nclassAdd($data='')
	{
		$list = $this->nclass->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条新闻分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function nclassAddAll($data='')
	{
		$list = $this->nclass->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 新闻分类分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function nclassPageList($where='', $field='*', $order="ID desc", $page=15)
	{	
		$list = $this->nclass->getPageList($where, $field, $order, $page, $this->cache);
		return $list;
	}
	
	/**
     * 更新新闻分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function nclassSave($where="", $data="")
    {	
        $save = $this->nclass->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条新闻分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function nclassDel($where='')
    {		
        $del = $this->nclass->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条新闻分类数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function nclassDelMost($id_arr='')
    {		
        $delAll = $this->nclass->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 新闻分类列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function nclassListShow($type=0) 
	{
		$where['ID'] = array('>',0);

    	$lists  = $this->nclassPageList($where);
		$volist = false;
		if($lists && !$type)
		{
			$volist = $lists;
		}
		else if($lists && $type)
		{
			$result = $lists;
			$volist = $this->nclassUname($result);
		}
		
        return $volist;
	}
		
    /**
     * 新闻分类发布人
	 * 创建人 韦丽明
	 * 时间 2017-09-10 15:11:08       
     */
    public function nclassUname($result)
    {
		if(!$result)
		{
			return false;
		}
		$where['ID'] = array('>',0);
		$user = new \app\data\service\user\UserService();
		$userList = $user->userList($where, 'ID desc', 'ID,Username');
		$volist = $result;

		while(list($k,$v)=each($userList))
		{
			if(is_array($volist))
			{
				 foreach($volist as $key => $vv)
				 { 
					 if($v['ID']===$vv['Uid'])
					 {
						 $volist[$key]['Username'] = $v['Username'] ; 
					 }
					 else
					 {
						 if(!$vv['Uid'])
						 {
							$volist[$key]['Username'] = ''; 
						 }						 
					 }
				 }
			}
			else
			{
				if($v['ID']===$volist)
				{
					$volist = $v['Username'] ; 
				}				
			}
		}
		return $volist;  
    }
	
    /**
     * 新闻分类名
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function newsClass($result) 
	{
		if(!$result)
		{
			return false;
		}
		$where['ID'] = array('>',0);
		$nclass = $this->nclassList($where);
		$volist = $result;
		
		while(list($k,$v)=each($nclass))
		{
			if(is_array($volist))
			{
				 foreach($volist as $key => $vv)
				 {					
					 if($vv['pid']===$v['ID'])
					 {
						 $volist[$key]['ClassName'] = $v['ClassName'] ; 
					 }
					 else
					 {
						 if(!$vv['pid'])
						 {
							$volist[$key]['ClassName'] = ''; 
						 }						 
					 }
				 }
			}
			else
			{				
				if($v['ID']===$volist)
				{
					$volist = $v['ClassName'] ; 
				}
			}
		}

		 
		return $volist;  
	}	
	
	 /**
     * 按条件添加一条新闻分类
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function nclassRoomAdd() 
	{
		//新闻分类POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->nclassAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新新闻分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function nclassRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->nclassInfo("ID=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理新闻分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function nclassRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//新闻分类POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['ID'] = $id;
		$info = $this->nclassInfo($where);
		
		if($info && $this->nclassSave($where, $data))
		{	
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 新闻分类POST数据
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
				$data['Dtime'] = date('Y-m-d H:i:s',time());
				$data['Uid'] = parent::sessionGets('ThinkUser.ID');
			break;
		}   	
		input('post.classname') &&	$data['ClassName'] = input('post.classname');
		input('post.description') && $data['Description'] = input('post.description');	
		
		return $data;
	}
	
    /**
     * 删除新闻分类操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function nclassRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->nclassInfo($where);
		if($info && $this->nclassDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除新闻分类分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function nclassRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->nclassDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}	
	
}