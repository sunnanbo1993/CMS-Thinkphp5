<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\data\wwwroot\yitian\admin\public/../application/index\view\index\index.html";i:1525851988;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>首页</title>
<link href="static/css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="static/js/jquery.min.js"></script>

<script type="text/javascript" src="static/js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="static/js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="static/js/jquery-ui.min.js"></script>

<script type="text/javascript" src="static/js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="static/js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="static/js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="static/js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="static/js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="static/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="static/js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="static/js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="static/js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="static/js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="static/js/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="static/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="static/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="static/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="static/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="static/js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="static/js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="static/js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="static/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="static/js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="static/js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="static/js/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="static/js/custom.js"></script>

<script type="text/javascript" src="static/js/charts/chart.js"></script>

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><a href="#"><img src="static/images/logo.png" alt="" /></a></div>
    
    <div class="sidebarSep mt0"></div>
    
    <!-- Search widget -->
    <form action="" class="sidebarSearch">
        <input type="text" name="search" placeholder="搜索..." id="ac" />
        <input type="submit" value="" />
    </form>
    
    <div class="sidebarSep"></div>

    <!-- Left navigation -->
    <?php echo $menu_list_html;?>
</div>


<!-- Right side -->
<div id="rightSide">

    <!-- Top fixed navigation -->
    <?php echo $top_nav_list_html;?>
    
    <!-- Responsive header -->
    <?php echo $resp_list_html;?>
    
    <!-- Title area -->
    
    <!-- Page statistics and control buttons area -->
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <?php echo $content_html;?>
    </div>
    
    <!-- Footer line -->
    <div id="footer">
        
    </div>

</div>

<div class="clear"></div>

</body>
</html>