<link rel="stylesheet" href="/css/ydlbam_css/css_goods/goods.css">
<script>
	$("#goods-manage").css("border-left","6px solid #783390");
	$("#goods-manage").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">产品管理</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content ">
			<form id="form-filter" action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/goods']);?>" mothed="GET" >
				<div class="row-fluid space_bottom">
					<span class="text-name space_right">用户账号： <input placeholder="请输入用户账号" id="account" name="email" value="<?php echo $email?>"></span>
					<span class="text-name space_right">供应商： <input placeholder="请输入供应商名称" id="supplier_name" name="supplier" value="<?php echo $supplier?>"></span>
					<span class="text-name ">产品状态： </span>
					<select name="state" id="product_status" class="text-value option-supplier">
						<option value="">全部</option>
						<option value="0">待审核</option>
						<option value="1">通过审核</option>	
						<option value="-1">未通过审核</option>
					</select>
				</div>
				<div class="row-fluid space_bottom">
					<span class="text-name space-h--right">报关品名： <input placeholder="请输入产品" id="product_name" name="goods_name" value="<?php echo $goodsName?>"></span>
				</div>
				<div class="row-fluid space_bottom">
					<div class="search-button">
						<img src="/images/search.jpg">
						<span>搜索</span>
					</div>
				</div>
				<input id="submit" style="display: none;" type="submit"/>
				<input id="state_num" style="display: none;" type="hidden" value="<?php echo $state ?>"/>
				<input type="text" style="display: none;" name="page" id="page" value="<?php echo $page ?>">
			</form>
		</div>
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>报关品名</th>
						<th>HS编码</th>
						<th>退税率(%)</th>
						<th>供应商名称</th>
						<th>账号</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($key % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php echo $key+1+($page-1)*10?></td>
						<td><a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/goods/goods-detail','goods_id'=>$value['id']]);?>"><?php echo $value['goods_name']?></a></td>
                        <td><?php echo $value['hs_code']?></td>
                        <td><?php echo $value['goods_taxrate']?></td>
                        <td><?php echo $value['supplier_name']?></td>
						<td><?php echo $value['user_email']?></td>
						<td>
							<?php
								if($value['state'] == 0){
									echo "待审核";
								}else if($value['state'] == 1){
									echo "通过审核";
								}else if($value['state'] == -1){
									echo "未通过审核";
								}else{
									echo "补充材料";
								}
							?>
						</td>
						<td>
							<a href="javascript:;" class="ondel" data-id="<?php echo $value['id'];?>">删除</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
			<nav class="page-number">
			  <ul class="pagination">
			    <?php use yii\widgets\LinkPager;?>
			    <?php
					echo LinkPager::widget([
					    'pagination' => $pages,
					    'firstPageLabel'=>"首页",
					    'prevPageLabel'=>'上一页',
					    'nextPageLabel'=>'下一页',
					    'lastPageLabel'=>'尾页',
					]);
				?>
			  </ul>
			</nav>
	</div>
</div>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
<script type="text/javascript" >
$(".ondel").on('click', function(){
	var id = $(this).attr("data-id");
	var val = $(this).val();
	var csrfToken = $("#_csrf").val();
	var ds = confirm("确定删除数据吗？");
	
	if(ds){
		$.post("/ydlbam/goods/delete-order", {
			"order_id":id,
			"state":val,
			"_csrf":csrfToken
		}, function(data){
			var contentData = $.parseJSON(data);
			if (contentData.status){
				alert(contentData.message);
				window.location.reload();
			}else{
				alert("操作失败，稍后重试");
			}
		});
	}
});
</script>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_manage.js"></script>