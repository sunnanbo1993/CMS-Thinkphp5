<?php
/**
* 新闻单页Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\page;
use app\data\model\page\PageModel  as PageModel;
use app\data\service\BaseService as BaseService;

class PageService extends BaseService 
{
	protected $cache = 'pages';	
	
	public function __construct()
	{
		parent::__construct();
		$this->pages = new PageModel();
		$this->cache = 'pages';
		
	}
	
    /**
     * 查询新闻单页列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function pagesList($where='', $order='id desc', $field='*', $cache='pages')
	{	
		$list = $this->pages->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取新闻单页信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function pagesInfo($where='', $field='*')
	{		
		$info =  $this->pages->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计新闻单页数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function pagesCount($where='')
	{		
		$Count =  $this->pages->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function pagesSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->pages->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function pagesSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->pages->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function pagesColumn($where='', $field='')
	{		
		$Column =  $this->pages->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条新闻单页数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function pagesAdd($data='')
	{
		$list = $this->pages->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条新闻单页数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function pagesAddAll($data='')
	{
		$list = $this->pages->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 新闻单页分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function pagesPageList($data)
	{
		$lable = array();
		//合并数组
		$lable = parent::mergeArray($data);		
		$where = $lable['where'];
		$field = $lable['field'];
		if(empty($lable['order'])){			
			$order = 'id desc';
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
		$list = $this->pages->getPageList($where, $field, $order, $page, $cache);
		return $list;
	}
	
	/**
     * 更新新闻单页数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function pagesSave($where="", $data="")
    {	
        $save = $this->pages->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条新闻单页数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:05:08      
     */
    public function pagesDel($where='')
    {		
        $del = $this->pages->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条新闻单页数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:08:51       
     */
    public function pagesDelMost($id_arr='')
    {		
        $delAll = $this->pages->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 新闻单页列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function pagesListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$where = array();
		$data = array();
		$cache = '';
		$title = input('get.title');
		$title_alias = input('get.title_alias');
    	if($title!=""){
    		$where['title'] = array("LIKE","%$title%");
    	}
    	if($title_alias!=""){
    		$where['title_alias'] = array("LIKE","%$title_alias%");
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
    	$lists  = $this->pagesPageList($data);
		$volist = false;
		if($lists)
		{
			$volist = $lists;
		}
        return $volist;
	}

	
	 /**
     * 按条件添加一条新闻单页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 16:49:11
     */
	public function pagesRoomAdd() 
	{
		//新闻单页POST数据
		$type = 'add' ;
		$data = $this->inputData($type);
		if($this->pagesAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 按条件更新新闻单页
	 * 创建人 韦丽明
	 * 时间 2017-09-11 18:27:59
     */
	public function pagesRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
    	$result = $this->pagesInfo("id=$id");
		return $result;
	}
	
    /**
     * 按条件修改处理新闻单页
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function pagesRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		//新闻单页POST数据
		$type = 'edit' ;
		$data = $this->inputData($type);
		$where = array();		
		$where['id'] = $id;
		$info = $this->pagesInfo($where);
		
		if($info && $this->pagesSave($where, $data))
		{
			//删除原图片
			if(!empty($_FILES['attach_thumb']['tmp_name']))
			{
				parent::DelImg($info['attach_thumb']);
			}			
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 新闻单页POST数据
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
		if(!empty($_FILES['attach_thumb']['tmp_name']))
		{
		    $file = parent::upload('page','attach_thumb');
			//dump($file);die;
		    if($file){
		        $data['attach_thumb'] = $file;
		    }else{
		        return false;
		    }
		}
		
		input('post.title') && $data['title'] = input('post.title');
		input('post.title_second') && $data['title_second'] = input('post.title_second');	
		input('post.title_alias') && $data['title_alias'] = input('post.title_alias');
		input('post.intro') && $data['intro'] = input('post.intro');
		input('post.seo_title') && $data['seo_title'] = input('post.seo_title');
		input('post.seo_keywords') && $data['seo_keywords'] = input('post.seo_keywords');
		input('post.seo_description') && $data['seo_description'] = input('post.seo_description');
		input('post.content') && $data['content'] = htmlspecialchars(input('post.content'));
		
		return $data;
	}
	
    /**
     * 删除新闻单页操作
	 * 创建人 韦丽明
	 * 时间 2017-09-11 21:19:04
     */
	public function pagesRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['id'] = $id;		
    	$info = $this->pagesInfo($where);
		if($info && $this->pagesDel($where))
		{
			//删除原图片
			if(!empty($_FILES['attach_thumb']['tmp_name']))
			{
				parent::DelImg($info['attach_thumb']);
			}
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 批量删除新闻单页
	 * 创建人 韦丽明
	 * 时间 2017-09-11 14:35:11
     */
	public function pagesRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->pagesDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 删除单个图片
	 * 创建人 韦丽明
	 * 时间 2017-09-15 00:33:04
     */
	public function pagesDelOnePic() 
	{
	    $data = array();
		$where = array();
	    $id = input('post.key');
	    $data['attach_thumb'] = "";
		$where['id'] = $id;
		
		if($this->pagesSave($where, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
}