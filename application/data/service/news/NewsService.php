<?php
/**
* 新闻Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\news;
use app\data\model\news\NewsModel  as NewsModel;
use app\data\service\BaseService as BaseService;

class NewsService extends BaseService 
{
	protected $cache = '';	
	
	public function __construct()
	{
		parent::__construct();
		$this->news = new NewsModel();
		$this->cache = 'news';
		
	}
	
    /**
     * 查询新闻列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function newsList($where='', $cache='news', $order='ID desc', $field='*')
	{	
		$list = $this->news->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取新闻信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function newsInfo($where='', $field='*')
	{		
		$info =  $this->news->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计新闻数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function newsCount($where='')
	{		
		$Count =  $this->news->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function newsSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->news->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function newsSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->news->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function newsColumn($where='', $field='')
	{		
		$Column =  $this->news->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条新闻数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function newsAdd($data='')
	{
		$list = $this->news->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条新闻数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function newsAddAll($data='')
	{
		$list = $this->news->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 新闻分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function newsPageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'ID desc';
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
		$list = $this->news->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新新闻数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function newsSave($where="", $data="")
    {	
        $save = $this->news->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条新闻数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function newsDel($where='')
    {		
        $del = $this->news->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条新闻数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function newsDelMost($id_arr='')
    {		
        $delAll = $this->news->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 新闻列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function newsListShow($pid=0) 
	{
		$where = array();
		!$pid && $pid = input('request.pid');
		if ($pid!='') 
		{
		    $where['pid'] = intval($pid);
		}
		$where['ID'] = array('>',0);
    	$lists  = $this->newsPageList($where);
		$volist = false;
		if($lists)
		{
			$volist = $lists;
		}
        return $volist;
	}

	
	 /**
     * 按条件添加一条新闻
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function newsRoomAdd() 
	{
		//新闻POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->newsAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新新闻
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function newsRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) 
		{
			return false;
		}
		$id=intval($id);
    	$result = $this->newsInfo("ID=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理新闻
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function newsRoomEditDoo() 
	{
		$id = input('post.ID');
		if ($id=='' || !is_numeric($id)) 
		{
			return false;
		}
		$id=intval($id);
		//新闻POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['ID'] = $id;
		$info = $this->newsInfo($where);
		
		if($info && $this->newsSave($where, $data))
		{	
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 新闻POST数据
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
		input('post.pid') && $data['pid'] = input('post.pid');
		input('post.Title') && $data['Title'] = input('post.Title');	
		input('post.Sortid') && $data['Sortid'] = input('post.Sortid');
		input('post.Description') && $data['Description'] = htmlspecialchars(input('post.Description'));
		input('post.Content') && $data['Content'] = htmlspecialchars(input('post.Content'));
		
		return $data;
	}
	
    /**
     * 删除新闻操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function newsRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) 
		{
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['ID'] = $id;		
    	$info = $this->newsInfo($where);
		if($info && $this->newsDel($where))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除新闻分类
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function newsRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->newsDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	
}