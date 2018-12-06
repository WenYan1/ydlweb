<link rel="stylesheet" href="/css/ydlbam_css/css_goods/goods.css">
<script>
	$("#add_adminer").css("border-left","6px solid #783390");
	$("#add_adminer").css("color","#783390");
	$(function(){
		$(".adminer-child").css("display","block");
	})
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">添加管理员</span>
		</div>
		<div style="margin-top:20px;width:300px; margin-left:20px;">
			<form action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/adminer/add-adminer']);?>" method="post">
			<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<div style="margin-bottom:10px;">
				<label for="exampleInputEmail1">管理员所属组</label>
				<select class="form-control" name="group_id">
				  <option>请选择所属组</option>
				  <?php foreach($groups as $val) {?>
				  <option value="<?php echo $val['id'];?>"><?php echo $val['group_name'];?></option>
				  <?php }?>
				</select>
			</div>
			
			  <div class="form-group"  style="margin-bottom:10px;">
			    <label for="exampleInputEmail1">用户名</label>
			    <input type="text" name="user_name" class="form-control" id="exampleInputEmail1" placeholder="用户名">
			  </div>

			  <div class="form-group">
			    <label for="exampleInputPassword1">密码</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
			  </div>
			 
			  <button type="submit" class="btn btn-default">添加</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_manage.js"></script>