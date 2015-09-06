<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php if ($this->app_name): ?><?php echo html_escape($this->app_name);?><?php else: ?>出租车MIS系统<?php endif;?></title>

<!-- build:mainHeaderCss -->
<link href="/static/src/base/bower/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/static/src/base/bower/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="/static/src/base/css/common.css" rel="stylesheet" type="text/css" />
<link href="/static/src/base/css/index.css" rel="stylesheet" type="text/css" />
<link href="/static/src/base/css/comp.css" rel="stylesheet" type="text/css" />
<link href="/static/src/auth/css/auth.css" rel="stylesheet" type="text/css" />
<link href="/static/src/base/css/milk.css" rel="stylesheet" type="text/css" />
<!-- endbuild -->

<!--单独样式文件-->
<?php echo $this->getClip('css');?>

</head>
<body>
<div id="wrapper">
    <div id="header">
			<div class="entrance">
            	<a class="logo-href" href="http://me.xiaojukeji.com/" target="_blank"></a>
            	<span class="entra-drop">|</span>
				<span class="entra-word"><a href="<?php echo base_url();?>"><?php if ($this->app_name): ?><?php echo html_escape($this->app_name);?><?php else: ?>出租车MIS系统<?php endif;?></a></span>
			</div>
            <div class="loginName dropdown">
                <?php if (defined('USER_NAME')): ?>
				<a data-toggle="dropdown" class="header-user" aria-expanded="false"><?php echo html_escape(USER_NAME);?> <span class="glyphicon glyphicon-triangle-bottom"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="<?php echo site_url('login/logout/index');?>">退出登录</a></li>
				</ul>
                <?php endif;?>
			</div>
        </div>

        <input type="hidden" id="sys_menu" value='<?php echo json_encode($this->sys_menu);?>'>
    <div id="main">
        <h3 class="main-title"><?php echo isset($this->page_title) ? $this->page_title : '';?></h3>
        <?php echo $content;?>
    </div>
</div>

<message-show></message-show>
<ajax-loading></ajax-loading>

</body>

<!--公共JavaScript-->
<!-- build:mainHeaderJS -->
<script type="text/javascript" src="/static/src/base/bower/jquery.min.js"></script>
<script type="text/javascript" src="/static/src/base/bower/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/src/base/js/comp.js"></script>
<script type="text/javascript" src="/static/src/base/js/validate.js"></script>
<script type="text/javascript" src="/static/src/base/js/ajaxGlobal.js"></script>
<!-- endbuild -->
<script type="text/javascript" data-main="/static/src/fist/js/main.js" src="/static/src/base/bower/require.min.js"></script>

<!--功能页面的单独JavaScript-->
<?php echo $this->getClip('javascript');?>

</html>