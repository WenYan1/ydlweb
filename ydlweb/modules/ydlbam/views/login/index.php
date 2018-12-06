<!DOCTYPE html>
<html  lang="zh-CN">
<head>
	<meat charset='utf-8' />
	<title>测试</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<style type="text/css">
	body{background-color: #2C404D; border-top: 1px solid #2C404D;}
	.form-control{width: 300px; height: 40px;}
	.contitle{text-align: center;color: #9FB3C0;font-weight: 600; font-size: 24px; margin-bottom: 35px; margin-top: 150px; }
	.con{width: 430px; margin: 0 auto; }
	</style>
</head>
<body>
<div class="contitle">后台管理系统</div>
<div class="con">
	<form class="form-horizontal" action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/login']);?>" method="post">
	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
	  <div class="form-group">
	    <label for="inputEmail3" style="color:#ccc;" class="col-sm-2 control-label">账号：</label>
	    <div class="col-sm-10">
	      <input type="text" name="user_name" class="form-control" id="inputEmail3" placeholder="请输入账号">
	    </div>
	  </div><br />
	  <div class="form-group">
	    <label for="inputPassword3" style="color:#ccc;" class="col-sm-2 control-label">密码：</label>
	    <div class="col-sm-10">
	      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="请输入密码">
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	     <button type="submit" class="btn btn-default">登录</button> 
	    </div>
	  </div>
	</form>
</div>	
</body>
</html>