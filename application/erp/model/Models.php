<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\erp\model;

use think\Db;

class Models{

	public function getBrandListData()
	{
		$return = [];
		$field  = [
			'id', 'brand_name as name'
		];
		$return = Db::table('y_brand')->field($field)->select();
		return $return;
	}
	public function insertModelsDataReturnId($data = [], $color = [], $memory = [])
	{
		$return = 0;
		// 启动事务
		Db::startTrans();
		try{
		    $return = Db::table('y_models')->insertGetId($data);
			$models = ['models_id' => $return];
			$color  = array_merge($color, $models);
			$this->insertColor($color);
			$memory = array_merge($memory, $models);
			$this->insertMemory($memory);
		    // 提交事务
		    Db::commit(); 
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		}
		return $return;
	}
	public function insertColor($data = [])
	{	
		$color = [];
		foreach ($data as $key => $value) {
			$color[] = [
				'color_name' => $value
			];
		}
		Db::table('y_color')->insert($color);
	}
	public function insertMemory($data = [])
	{
		$memory = [];
		foreach ($data as $key => $value) {
			$memory[] = [
				'memory_name' => $value
			];
		}
		Db::table('y_memory')->insert($memory);
	}
	public function getModelsListData()
	{
		$return = [];
		$field  = [
			'id', 'brand_name as name'
		];
		$return = Db::table('y_models')->field($field)->select();
		foreach ($return as $key => $value) {
			$return[$key]['color_name']  = $this->getColorListDataToString($value['id']);
			$return[$key]['memory_name'] = $this->getColorListDataToString($value['id']);
		}
		return $return;
	}
	public function getColorListDataToString($models_id = 0)
	{
		$return = [];
		$field  = [
			'color_name as name'
		];
		$return = Db::table('y_color')->field($field)->where($where)->select();
		$return = implode(',', $return);
		return $return;
	}
	public function getMemoryListDataToString($models_id = 0)
	{
		$return = [];
		$field  = [
			'memory_name as name'
		];
		$return = Db::table('y_memory')->field($field)->where($where)->select();
		$return = implode(',', $return);
		return $return;
	}
	public function getModelsInfoDataById()
	{
		$return = [];
		return $return;
	}
	public function delModelsDataById()
	{
		$return = 0;
		return $return;
	}
	public function updateModelsDataById()
	{
		$return = 0;
		return $return;
	}
}