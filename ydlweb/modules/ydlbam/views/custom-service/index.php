<link rel="stylesheet" href="/css/ydlbam_css/css_goods/goods.css">
<script>
	$("#custom_service").css("border-left","6px solid #783390");
	$("#custom_service").css("color","#783390");
	$(function(){
		$(".custom_service-child").css("display","block");
	})
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">客服列表</span>
		</div>
		
		
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>客服名</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($key % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php echo $key+1;?></td>
						<td><?php echo $value['user_name'];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
			
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_manage.js"></script>