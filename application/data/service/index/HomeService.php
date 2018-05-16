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

namespace app\data\service\index;
use app\data\model\index\HomeModel  as HomeModel;
use app\data\service\BaseService as BaseService;

class HomeService extends BaseService 
{
	protected $cache = 'home';
	
	public function __construct()
	{
		parent::__construct();		
		$this->home = new HomeModel();
		$this->cache = 'home';
	}
	
    /**
     * 查询网站首页列表
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:10:21
     */
	public function homeList($where='', $field='*', $order='h_id desc')
	{
		$list = $this->home->getList($where, $order, $field, $this->cache);
		return $list;
	}
	
    /**
     * 获取网站首页信息
	 * 创建人 韦丽明
	 * 时间 2017-07-14 11:40:09
     */
	public function homeInfo($where='', $field='*')
	{		
		$info =  $this->home->getInfo($where, $field, $this->cache);
		return $info;
	}
	
	/**
     * 更新网站首页数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:19:05
     */
    public function homeSave($where="", $data="")
    {
        $save = $this->home->getSave($where, $data, $this->cache);
		return $save;       
    }

    /**
     * 批量更新网站首页
	 * 创建人 韦丽明
	 * 时间 2017-07-14 22:11:51
     */
	public function homeSaveAll($data='')
	{		
		$info =  $this->home->getSaveAll($data, $this->cache);
		return $info;
	}	
	
    /**
     * 批量更新网站首页数据
	 * 创建人 韦丽明
	 * 时间 2017-09-10 22:00:50
     */
	public function homeRoomEditDoo() 
	{  	
		$data = array();
		$type = input('post.h_type');
		$where = array();
		switch($type)
		{
			case '1' ;
				//单条更新				
				$where['h_id'] = input('post.h_id');
				$where['h_type'] = input('post.h_type');
				
				$data['h_text'] =  htmlentities(input('post.h_text'));
				
				if(!empty($_FILES['h_pic']['tmp_name']))
				{
					$file = parent::upload('home', 'h_pic');
					if($file){
						$data['h_pic'] = $file;
					}else{
						return false;
					}					
				}
				//dump($_FILES);die;
				$save = $this->homeSave($where, $data);				
			break;
			case '2' ;
				//批量更新
				$pid = input('post.h_pid/a');
				$pic = input('post.h_pic/a');		
				$j = 0;
				foreach(input('post.h_id/a') as $key=>$v)
				{
					$num = $key+1;
					$where['h_id'] = $v;
					$data['pid'] = $pid[$key];
					
					if(!empty($_FILES['h_pic'.$num]['tmp_name']))
					{
						
						$file = parent::upload('home','h_pic'.$num);
						//dump($file);die;
						if($file){
							$data['h_pic'] = $file;
						}else{
							return false;
						}
						unset($file);
					}

					$save = $this->homeSave($where, $data);

					
					if($save)
					{
						$j ++;
					}
					unset($where);
					unset($data);
				}
				if($j)
				{
					$save = true;
				}
			break;			
		}
    	if($save)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
}