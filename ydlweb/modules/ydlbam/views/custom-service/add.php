<link rel="stylesheet" href="/css/ydlbam_css/css_goods/goods.css">
<script>
	$("#add_custom_service").css("border-left","6px solid #783390");
	$("#add_custom_service").css("color","#783390");
	$(function(){
		$(".custom_service-child").css("display","block");
	})
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">添加客服</span>
		</div>
		<br>
		<div style="width:300px;">
			<form action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/custom-service/add-custom-service']);?>" method="post">
			<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			  <div class="form-group">
			    <label for="exampleInputEmail1">用户名</label>
			    <input type="text" name="user_name" class="form-control" id="exampleInputEmail1" placeholder="用户名">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">密码</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">客服邮箱</label>
			    <input type="text" name="custom_email" class="form-control" id="exampleInputEmail1" placeholder="客服邮箱">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">客服联系方式</label>
			    <input type="text" name="custom_tel" class="form-control" id="exampleInputEmail1" placeholder="客服联系方式">
			  </div>
			 
			  <button type="submit" class="btn btn-default">添加</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_manage.js"></script>