<?php
/**
* 留言Service
*-------------------------------------------------------------------------------------------
* 版权所有 广州市素材火信息科技有限公司
* 创建日期 2017-09-14
* 版本 v.1.0.0
* 网站：www.sucaihuo.com
*--------------------------------------------------------------------------------------------
*/

namespace app\data\service\message;
use app\data\model\message\MessageModel  as MessageModel;
use app\data\service\BaseService as BaseService;

class MessageService extends BaseService 
{
	protected $cache = 'messages';
	
	public function __construct()
	{
		parent::__construct();	
		$this->message = new MessageModel();
		$this->cache = 'messages';
	}
	
    /**
     * 查询留言列表
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:10:21
     */
	public function messageList($where='', $field='*', $order='id desc', $cache='messages')
	{
		$list = $this->message->getList($where, $order, $field, $cache);
		return $list;
	}
	
    /**
     * 获取留言信息
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function messageInfo($where='', $field='*')
	{		
		$info =  $this->message->getInfo($where, $field, $this->cache);
		return $info;
	}
	
    /**
     * 条件统计留言数量
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:40:09
     */
	public function messageCount($where='')
	{		
		$Count =  $this->message->getCount($where);
		return $Count;
	}

    /**
     * 更新某个字段的值
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function messageSetField($where='', $field='', $data='')
	{		
		$SetField =  $this->message->getSetField($where, $field, $data, $this->cache);
		return $SetField;
	}

    /**
     * 自增数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 11:57:05           
     */	
	public function messageSetInc($where='', $field='', $data='')
	{		
		$SetInc =  $this->message->getSetInc($where, $field, $data, $this->cache);
		return $SetInc;
	}
	
    /**
     * 查询某一列的值
	 * 创建人 韦丽明
	 * 时间 2017-09-06 22:31:22          
     */	
	public function messageColumn($where='', $field='')
	{		
		$Column =  $this->message->getColumn($where, $field);
		return $Column;
	}
	
    /**
     * 添加一条留言数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function messageAdd($data='')
	{
		$list = $this->message->getAdd($data, $this->cache);
		return $list;
	}
	
	
    /**
     * 添加多条留言数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:10:00
     */
	public function messageAddAll($data='')
	{
		$list = $this->message->getAddAll($data, $this->cache);
		return $list;
	}
	
    /**
     * 留言分页查询
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:31:15
     */
	public function messagePageList($data)
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
		$list = $this->message->getPageList($where, $field, $order, $page, $this->cache);
		return $list;
	}
	
	/**
     * 更新留言数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 22:19:05
     */
    public function messageSave($where="", $data="")
    {	
        $save = $this->message->getSave($where, $data, $this->cache);
		return $save;       
    }
	
    /**
     * 删除一条留言数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:05:08      
     */
    public function messageDel($where='')
    {		
        $del = $this->message->getDel($where, $this->cache);
		return $del;  
    }
	
    /**
     * 删除多条留言数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:08:51       
     */
    public function messageDelMost($id_arr='')
    {		
        $delAll = $this->message->getDelMost($id_arr, $this->cache);
		return $delAll;  
    }
	
    /**
     * 留言列表分页
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function messageListShow($type=0, $field='*', $c_pid=0, $page=15) 
	{
		$email      = input('get.email');
		$username   = input('get.username');
		$states     = input('get.states');
		$tel        = input('get.tel');
		$skype      = input('get.skype');
		
    	$where = array();	
		$data = array();
		$cache = '';		
    	if($email!="")
		{
    		$where['m_email'] = array("LIKE","%$email%");
    	}
    	if($username!="")
		{
    	    $where['username'] = array("LIKE","%$username%");
    	}
    	if($states)
		{
    		$where['states'] = $states-1;
    	}
    	if($tel)
		{
    		$where['m_tel'] = array("LIKE","%$tel%");
    	}		
    	if($skype)
		{
    		$where['m_skype'] = array("LIKE","%$skype%");
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
    	$lists  = $this->messagePageList($data);	
        return $lists;
	}
	
    /**
     * 按条件更新留言
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function messageRoomEdit() 
	{
		$id = input('get.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();
		$where['id'] = $id;		
    	$result = $this->messageInfo($where);
		if($result)
		{
			if(!$result['look'])
			{
				$data = array();				
				$data['look'] = 1;
				$this->messageSave($where, $data);
			}			
		}	
		return $result;
	}

    /**
     * 按条件修改处理留言
	 * 创建人 韦丽明
	 * 时间 2017-09-14 13:34:05
     */
	public function messageRoomEditDoo() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		// 留言POST数据
		$type = 'edit';
		$data = $this->inputData($type);
		$where = array();		
		$where['id'] = $id;
		if($this->messageSave($where, $data))
		{			
			return true;		
		}
		else
		{
			return false;
		}
	}

    /**
     * 删除留言操作
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:10:16
     */
	public function messageRoomDel() 
	{
		$id = input('post.id');
		if ($id=='' || !is_numeric($id)) {
			return false;
		}
		$id=intval($id);
		$where = array();		
		$where['id'] = $id;		
    	$info = $this->messageInfo($where);
		if($info && $this->messageDel($where))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}	
	
    /**
     * 批量删除留言
	 * 创建人 韦丽明
	 * 时间 2017-09-14 14:35:11
     */
	public function messageRoomDelMost() 
	{
		$id = input('post.delid');
		if($this->messageDelMost($id))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 添加一条留言
	 * 创建人 韦丽明
	 * 时间 2017-09-14 21:39:01
     */
	public function messageRoomAdd() 
	{
		// 留言POST数据
		$type = 'add';
		$data = $this->inputData($type);		
		if($this->messageAdd($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
    /**
     * 留言POST数据
	 * 创建人 韦丽明
	 * 时间 2017-09-14 20:52:15
     */
	public function inputData($type) 
	{
		$data = array();
		switch($type)
		{
			case 'edit';
				$data['states'] = input('post.states');
			break;
			case 'add';
				input('post.contact') && $data['title']      = input('post.contact');
				input('post.email') && $data['m_email']      = input('post.email');
				input('post.company') && $data['username']      = input('post.company');
				input('post.tel') && $data['m_tel']             = input('post.tel');
				input('post.skype') && $data['m_skype']             = input('post.skype');				
				$data['states']           = 0 ;				
				input('post.content') && $data['m_content'] = htmlentities(input('post.content'));
				$data['addtime']           = time() ;
			break;
		}   	
		
		return $data;
	}
	
}