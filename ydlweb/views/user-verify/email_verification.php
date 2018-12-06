<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>登录邮箱激活账户</title>
</head>
<body style="margin:0 0;">
<script type="text/javascript">
	var time = 3; //时间,秒 
	function Redirect(){ 
		window.location = "<?php echo Yii::$app->urlManager->createUrl(['/']);?>"; 
	} 
	var i = 0; 
	function dis(){ 
		document.all.s.innerHTML = (time - i); 
		i++; 
	} 
	timer=setInterval('dis()', 1000);
	timer=setTimeout('Redirect()',time * 1000);  
</script>
	<a style="display">
	<div style="width:100%;display:block;">
		<div style="width:100%;border-bottom:1px solid #d8d8d8;padding:10px 0;">
			<img style="margin-left:100px;" src="../images/title_img.jpg">
		</div>
		<div style="padding:72px 0;width:100%;display:block;text-align:center;">
			<img  style="height:100px;width:100px;display:block;margin:10px auto;" src="../images/title_img.jpg">
			<h3 style="display:block;margin:30px auto;">邮件已发送，请登陆邮箱验证。</h3>
			<p style="display:block;margin:20px auto;font-size:14px;">等待<span id="s"></span>秒后自动跳转到首页，或点击 <a href="<?php echo Yii::$app->urlManager->createUrl(['/']);?>">这里</a> 到首页
			</P>

		<div/>
	</div>
</body>
</html>
	