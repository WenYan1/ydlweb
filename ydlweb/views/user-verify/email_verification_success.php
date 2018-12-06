<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>账户激活</title>
</head>
<body style="margin:0 0;">
<script type="text/javascript">
	var winWidth = 0;
	if (window.innerWidth){
		winWidth = window.innerWidth;
	}else if ((document.body) && (document.body.clientWidth)){
		winWidth = document.body.clientWidth;
	}

	if(winWidth < 768){
		window.location="<?php echo Yii::$app->urlManager->createUrl(['/user-verify/translate-phone-success']);?>";
	} else {
		var time = 3; //时间,秒 
		function Redirect(){ 
			window.location = "<?php echo Yii::$app->urlManager->createUrl(['/login']);?>"; 
		} 
		var i = 0; 
		function dis(){ 
			document.all.s.innerHTML = (time - i); 
			i++; 
		} 
		timer=setInterval('dis()', 1000);
		timer=setTimeout('Redirect()',time * 1000);
	}
	
	  
</script>

	<div style="width:100%;display:block;">
		<div style="width:100%;border-bottom:1px solid #d8d8d8;padding:10px 0;">
			<img style="margin-left:100px;" src="../images/title_img.jpg" >
		</div>
		<div style="padding:80px 0;width:100%;display:block;text-align:center;">
			<h3 style="display:block;margin:20px auto;">激活成功。</h3>
			<div style="padding:0 40px;">
				<p style="display:block;margin:20px auto;font-size:14px;">等待<span id="s" style="font-size:16px;"></span>秒后自动跳转到登录页面，或点击<a href="<?php echo Yii::$app->urlManager->createUrl(['/login']);?>">这里</a>到登录页面
				</P>
			<div>
		<div/>
	</div>

</body>
</html>
