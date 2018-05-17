<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\erp\model;

use think\Db;

class Brand{

	public function insertBrandDataReturnId(array $data = [])
	{
		$return = 0;
		$return = Db::table('y_brand')->insertGetId($data);
		return $return;
	}
	public function getBrandListData()
	{
		$return = [];
		$field  = [
			'id', 'brand_name as name', 'brand_state as state', 'brand_sort as sort'
		];
		$return = Db::table('y_brand')->field($field)->select();
		return $return;
	}
	public function getBrandInfoDataById($id = 0)
	{
		$return = [];
		$field  = [
			'id', 'brand_name as name', 'brand_state as state', 'brand_sort as sort', 'brand_desc as `desc`'
		];
		$where  = [
			'id' => $id
		];
		$return = Db::table('y_brand')->field($field)->where($where)->find();
		return $return;
	}
	public function delBrandDataById()
	{
		$return = 0;
		return $return;
	}
	public function updateBrandDataById()
	{
		$return = 0;
		return $return;
	}

}