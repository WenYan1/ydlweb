<link rel="stylesheet" href="/css/ydlbam_css/css_goods/goods.css">
<script>
	$("#adminer").css("border-left","6px solid #783390");
	$("#adminer").css("color","#783390");
	$(function(){
		$(".adminer-child").css("display","block");
	})
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">管理员列表</span>
		</div>
		
		
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>管理员名</th>
						<th>管理员类型</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($key % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php echo $key+1;?></td>
						<td><?php echo $value['user_name'];?></td>
						<td>
							<?php
								if($value['rank'] == 0){
									echo "超级管理员";
								}else if($value['rank'] == 1){
									echo "普通管理员";
								}else if($value['rank'] == 2){
									echo "客服";
								}
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
			
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_manage.js"></script>