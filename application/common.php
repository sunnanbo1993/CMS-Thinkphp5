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