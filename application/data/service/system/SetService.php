<?php
/**
* 设置Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-07-12
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\system;
use app\data\model\system\SetModel  as SetModel;
use app\data\service\BaseService as BaseService;

class SetService extends BaseService 
{
	protected $cache = '';
	
	public function __construct()
	{
		parent::__construct();
		//分类缓存		
		$pid = input('post.pid');
		if(!$pid)
		{
			$pid = input('get.pid');
		}
		if(!$pid)
		{
			$pid = 1;
		}
		$this->cache = $pid.'webSet';		
		$this->set = new SetModel();		
	}
	
    /**
     * 查询设置列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function setList($where='', $order='id desc', $field='*')
	{
		$list = $this->set->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取设置信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function setInfo($where='', $field='*')
	{		
		$info =  $this->set->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计设置数量
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function setCount($where='')
	{		
		$Count =  $this->set->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function setSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->set->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-07-12 11:57:05           
     */	
	public function setSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->set->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function setColumn($where='', $field='')
	{		
		$Column =  $this->set->getColumn($where, $field, $this->cache);
		return $Column;
	}
	
    /**
     * 设置分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:40:15
     */
	public function setPageList($where='', $field='*', $order="id desc", $page=15)
	{	
		$list = $this->set->getPageList($where, $field, $order, $page, $this->cache);
		
		return $list;
	}
	
	/**
     * 更新设置数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function setSave($where="", $data="")
    {	
        $save = $this->set->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 设置列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-10 20:10:00
     */
	public function setListShow($type=0) 
	{
		$where = array();
		$pid = 1 ;
		if(input('get.pid'))
		{
			$pid = input('get.pid');
		}		
		//$pid 必须是正整数
		if(!preg_match("/^[1-9][0-9]*$/",$pid)){
			return false;
		}
		$where ['type']= $pid;
		$where['id'] = array('>',0);
		//查询类型
		$explain = "list" ;
		if(input('get.explain'))
		{
			$explain = input('get.explain');
		}		
		$volist = false;
		if($explain==='list')
		{
			$lists  = $this->setPageList($where);
			
			if($lists && !$type)
			{
				$volist = $lists->toArray();
			}
			else if($lists && $type)
			{
				$volist = $lists;
			}
			
		}
		return $volist;     
	}
	
    /**
     * 按条件修改处理设置
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:52:01
     */
	public function setRoomEditDoo() 
	{
		//设置POST数据
		$type = 'edit' ;
		$list = $this->inputData($type);
		
		//批量修改
		$j = 0 ;
		foreach($list as $key=>$v)
		{
			if($v)
			{
				$data = array();
				$where =array();
				$where ['name']= $key;
				$data['value'] = $v ;
				$update = $this->setSave($where, $data);
				if($update)
				{
					$j++;
				}						
			}
		}
		if($j>0)
		{
			$result = true ;
		}
		else
		{
			$result = false ;
		}
		
		if($result)
		{
			//删除原图片
			if(!empty($_FILES['web_logo']['tmp_name']))
			{
				$primary_file = input('post.primary_logo');
				parent::DelImg($primary_file);
			}
			if(!empty($_FILES['web_ico']['tmp_name']))
			{
				$primary_file = input('post.primary_ico');
				parent::DelImg($primary_file);
			}
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 设置POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-11 20:58:22
     */
	public function inputData($type) 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
				$data['WEB_TITLE'] = input('post.WEB_TITLE');
				$data['WEB_KEYWORD'] = input('post.WEB_KEYWORD');
				$data['WEB_COPYRIGHT'] = input('post.WEB_COPYRIGHT');
				$data['WEB_RECORD_NUMBER'] = input('post.WEB_RECORD_NUMBER');
				$data['WEB_DESCRIPTION'] = htmlentities(input('post.WEB_DESCRIPTION'));
			break;
			case 'add';
			break;
		}   	
		if(!empty($_FILES['web_logo']['tmp_name']))
		{
		    $file = parent::upload('logo','web_logo');
		    if($file){
		        $data['WEB_LOGO'] = $file;
		    }else{
		        return false;
		    }
		}
		if(!empty($_FILES['web_ico']['tmp_name']))
		{
		    $file = parent::upload('logo','web_ico');
		    if($file){
		        $data['WEB_ICO'] = $file;
		    }else{
		        return false;
		    }
		}
		return $data;
	}
	
    /**
     * 删除单个图片
	 * 创建人 韦丽明
	 * 时间 2017-09-15 00:33:04
     */
	public function setDelOnePic() 
	{
	    $data = array();
		$where = array();
	    $name = input('post.key');
	    $data['value'] = "";
		$where['name'] = $name;		
		if($this->setSave($where, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	
}