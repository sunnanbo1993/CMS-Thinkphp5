<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:77:"D:\data\wwwroot\yitian\admin\public/../application/index\view\index\menu.html";i:1525853238;s:77:"D:\data\wwwroot\yitian\admin\public/../application/index\view\index\resp.html";i:1525851212;s:79:"D:\data\wwwroot\yitian\admin\public/../application/index\view\index\topnav.html";i:1525851207;s:80:"D:\data\wwwroot\yitian\admin\public/../application/index\view\index\welcome.html";i:1525845424;s:76:"D:\data\wwwroot\yitian\admin\public/../application/index\view\index\add.html";i:1525855141;}*/ ?>

    
        <!-- Note -->
        <div class="nNote nInformation hideit">
            <p>亲爱的<strong>华远网络 </strong>（Lv1，山东临沂市地区领导人）本月任务 <strong>1 </strong>次，已完成 <strong>1 </strong>次排单。</p>
        </div>


								<div class="widget rightTabs">
                    <div class="title"><img src="images/icons/dark/stats.png" alt="" class="titleIcon"><h6>我的资料</h6></div>
                    <ul class="tabs">
                        <li><a href="#tab1">基本信息</a></li>
                        <li><a href="#tab2">账户密码</a></li>
                        <li><a href="#tab3">安全密码</a></li>
                        <li><a href="#tab4">上传头像</a></li>
                    </ul>
                    <div class="tab_container">
                        <div id="tab1" class="tab_content np" style="display: block;">
													<form id="validate" class="form" method="post" action="">
									        	<fieldset>
					                    <div class="formRow">
					                        <label>我的名字：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required]" name="req" id="req"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>手机号码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required]" name="password1" id="password1"></div><div class="clear"></div>
					                    </div>
															<div class="formRow dnone">
					                    	<label>所在地区：</label>
					                        <div class="formRight">
					                            <span class="oneTwo"><input type="text" value="山东"></span>
					                            <span class="oneTwo"><input type="text" value="临沂市"></span>
					                        </div>
					                        <div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>支付宝：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required,minSize[6]]" name="minValid" id="minValid"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>微信号：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required,maxSize[6]]" value="0123456789" name="maxValid" id="maxValid"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>银行名称：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" value="this is an invalid char '.'" class="validate[required,custom[onlyLetterSp]]" name="lettersValid" id="lettersValid"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>银行卡号：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" value="10.1" class="validate[required,custom[onlyNumberSp]]" name="numsValid" id="numsValid"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>安全密码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" value="too many spaces obviously" class="validate[required,custom[onlyLetterNumber]]" name="regexValid" id="regexValid"></div><div class="clear"></div>
					                    </div>
					                    <div class="formSubmit"><input type="submit" value="修改" class="redB"></div>
					                    <div class="clear"></div>
								            </fieldset>
									        </form>
                        </div>
                        <div id="tab2" class="tab_content np" style="display: none;">
													<form id="validate" class="form" method="post" action="">
									        	<fieldset>
					                    <div class="formRow">
					                        <label>原密码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required]" name="req" id="req"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>新密码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required]" name="password1" id="password1"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>确认密码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required,minSize[6]]" name="minValid" id="minValid"></div><div class="clear"></div>
					                    </div>
					                    <div class="formSubmit"><input type="submit" value="修改" class="redB"></div>
					                    <div class="clear"></div>
								            </fieldset>
									        </form>
                   			</div>
                        <div id="tab3" class="tab_content np" style="display: none;">
													<form id="validate" class="form" method="post" action="">
									        	<fieldset>
					                    <div class="formRow">
					                        <label>原安全密码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required]" name="req" id="req"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>新安全密码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required]" name="password1" id="password1"></div><div class="clear"></div>
					                    </div>
					                    <div class="formRow">
					                        <label>确认新密码：<span class="req">*</span></label>
					                        <div class="formRight"><input type="text" class="validate[required,minSize[6]]" name="minValid" id="minValid"></div><div class="clear"></div>
					                    </div>
					                    <div class="formSubmit"><input type="submit" value="修改" class="redB"></div>
					                    <div class="clear"></div>
								            </fieldset>
									        </form>
                    	  </div>                    
                        <div id="tab4" class="tab_content np" style="display: none;">
													<form id="validate" class="form" method="post" action="">
									        	<fieldset>
					                    <div class="formRow">
					                        <label>上传头像<span class="req">*</span></label>
					                        <div class="formRight"><input type="file" class="validate[required]" name="req" id="req"></div><div class="clear"></div>
					                    </div>
					                    <div class="formSubmit"><input type="submit" value="修改" class="redB"></div>
					                    <div class="clear"></div>
								            </fieldset>
									        </form>
                   			</div>                    
                    </div>     
                </div>
                
