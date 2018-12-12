<link rel="stylesheet" href="/css/ydlbam_css/css_goods/goods.css">
<script>
	$("#adminer-group").css("border-left","6px solid #783390");
	$("#adminer-group").css("color","#783390");
	$(function(){
		$(".group-child").css("display","block");
	})
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">管理组编辑</span>
		</div>
		<br>
		<div>
			<form action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/adminer-group/edit-group']);?>" method="post">
			<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<input name="id" type="hidden" value="<?=  $group->id;?>">
			<div class="form-group" style="width:650px;">
			    <label for="exampleInputEmail1">组名</label>
			    <input type="text" name="group_name" class="form-control" id="exampleInputEmail1" placeholder="组名" value="<?php echo $group->group_name;?>">
			  </div>
			  <div class="form-group" style="width:650px;">
			    <label for="exampleInputEmail1">组描述</label>
			    <textarea class="form-control" name="group_describe" rows="3"><?php echo $group->group_describe;?></textarea>
			  </div>

			  <div class="checkbox" style="width:120px; float:left;">
			  <?php for($i=0;$i<3;$i++){
			  if(in_array($permission[$i]['permission_name'], $myPermission)){?>
			    <label style="margin-right:20px;">
			      <input type="checkbox" checked="checked" name="permission[]" style="width:210px;" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>
			    <?php }else {?>
			    <label style="margin-right:20px;">
			      <input type="checkbox" name="permission[]" style="width:210px;" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>	
			   <?php }}?>
			  </div>


			  <div class="checkbox" style="width:140px; float:left; margin-top:10px;">
			  <?php for($i=3;$i<6;$i++){
			  if(in_array($permission[$i]['permission_name'], $myPermission)){?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" checked="checked" name="permission[]" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>
			    <?php }else {?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" name="permission[]" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>	
			   <?php }}?>
			  </div>


			  <div class="checkbox" style="width:140px; float:left; margin-top:10px;">
			  <?php for($i=6;$i<9;$i++){
			    if(in_array($permission[$i]['permission_name'], $myPermission)){?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" checked="checked" name="permission[]" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>
			    <?php }else {?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" name="permission[]" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>	
			   <?php }}?>
			  </div>


			  <div class="checkbox" style="width:120px; float:left; margin-top:10px;">
			  <?php for($i=9;$i<12;$i++){
			    if(in_array($permission[$i]['permission_name'], $myPermission)){?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" checked="checked" name="permission[]" style="width:200px;" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>
			    <?php }else {?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" name="permission[]" style="width:200px;" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>	
			   <?php }}?>
			  </div>


			   <div class="checkbox" style="width:130px; float:left; margin-top:10px;">
			  <?php for($i=12;$i<=13;$i++){
			    if(in_array($permission[$i]['permission_name'], $myPermission)){?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" checked="checked" name="permission[]" style="width:180px;" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>
			    <?php }else {?>
			    <label style="margin-right:30px;">
			      <input type="checkbox" name="permission[]" style="width:180px;" value="<?php echo $permission[$i]['permission_name'];?>"><?php echo $permission[$i]['modular_explain'];?>
			    </label>	
			   <?php }}?>
			  </div><br><br><br><br>
			 
			  <button type="submit" class="btn btn-default">添加</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_manage.js"></script>