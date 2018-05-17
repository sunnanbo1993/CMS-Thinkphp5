<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * [jsAlerts js弹窗]
 * @param  string $msg  [弹窗消息]
 * @param  int    $icon [弹窗标识，5是哭脸，6是笑脸]
 */
function jsAlerts(string $msg = 'error', int $icon = 5, string $url='/login'){
	echo "<script type='text/javascript' src='/static/lib/layui/layui.js' charset='utf-8'></script>";
	echo "<script type='text/javascript' src='/static/lib/layui/lay/modules/jquery.js' charset='utf-8'></script>";
	echo "<script type='text/javascript' src='/static/lib/layui/lay/modules/layer.js' charset='utf-8'></script>";
	echo "<script>";
	echo "layui.use(['layer'], function(){
          	var layer = layui.layer;
        	layer.alert('".$msg."', {icon: ".$icon."}, function(){
        		top.location.href='".$url."'; 
        	});
    	});";
    echo "</script>";
    exit();
}
/**
 * [create_guid php官方生成guid]
 * @param  string $namespace [description]
 * @return [type]            [description]
 */
function create_guid($namespace = '') {  
  static $guid = '';
  $uid = uniqid("", true);
  $data = $namespace;
  $data .= $_SERVER['REQUEST_TIME'];
  $data .= $_SERVER['HTTP_USER_AGENT'];
  $data .= $_SERVER['SERVER_ADDR'] ?? '0.0.0.0';
  $data .= $_SERVER['SERVER_PORT'] ?? '80';
  $data .= $_SERVER['REMOTE_ADDR'];
  $data .= $_SERVER['REMOTE_PORT'];
  $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
  $guid = '{' . 
      substr($hash, 0, 8) .
      '-' .
      substr($hash, 8, 4) .
      '-' .
      substr($hash, 12, 4) .
      '-' .
      substr($hash, 16, 4) .
      '-' .
      substr($hash, 20, 12) .
      '}';
  return $guid;
 }