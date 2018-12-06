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
			<span class="text-value">管理组列表</span>
		</div>
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>组名</th>
						<th>组描述</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($key % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php echo $key+1;?></td>
						<td><?php echo $value['group_name'];?></td>
						<td><?php echo $value['group_describe'];?></td>
						<?php if($key == 0) {?>
							<td></td>
						<?php } else if($key == 1) {?>
							<td><a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/adminer-group/edit-group','id'=>$value['id']]);?>">编辑</a></td>
						<?php } else {?>
							<td><a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/adminer-group/edit-group','id'=>$value['id']]);?>">编辑</a> | 删除</td>
						<?php }?>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
			
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_manage.js"></script>