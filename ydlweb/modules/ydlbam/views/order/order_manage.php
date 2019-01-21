<link rel="stylesheet" type="text/css" href="/css/ydlbam_css/public/jquery.datetimepicker.css"/ >
<script type="text/javascript" src="/js/ydlbam_js/public/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/css/ydlbam_css/css_order/order.css">
<script>
	$("#order-manage").css("border-left","6px solid #783390");
	$("#order-manage").css("color","#783390");
</script>
<?php 
// var_dump($models);
?>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">订单管理</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content" style="min-width: 1000px">
			<form id="form-filter" action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/order']);?>" method="get">
				<div class="row-fluid space_bottom">
					<span class="text-name space_right">订单号： <input placeholder="请输入订单号" style="margin-left: 14px;" id="order_number" name="" value="<?php echo $orderSn;?>"></span>
					<span class="text-name ">订单状态： </span>
					<input id="state_num" type="hidden" value="<?php echo $state;?>"/>
					<select name="" id="order_status" class="text-value option-supplier space_right">
						<option value="">全部</option>
						<option value="0">下单审核</option>
					<option value="2">工厂生产</option>	
					<option value="3">质检装柜</option>
					<option value="4">到达口岸</option>
					<option value="5">报关完成</option>
					<option value="6">收集单据</option>
					<option value="7">收汇</option>
					<option value="8">垫付税款</option>
					<option value="9">垫付采购款</option>
					<option value="10">退税完成</option>
					<option value="11">还本付息</option>
					<option value="12">已完成</option>
					<option value="-1">审核未通过</option>
					<option value="-2">取消</option>
					</select>
					<span class="text-name space_right" style="margin-left: 33px">日期：
						<input id="start_time" type="text" class="date-input" name="" value="<?php echo $startTime;?>" /> - <input id="end_time" type="text" class="date-input" name="" value="<?php echo $endTime;?>" />
					</span>
				</div>
				<div class="row-fluid space_bottom">
					<span class="text-name space_right">用户账户： <input placeholder="请输入账号" id="user_account" name="" value="<?php echo ($email);?>"></span>
					<span class="text-name space_right">供应商： <input id="supplier_manage" placeholder="请输入供应商" style="margin-left: 14px;" name="" value="<?php echo $supplierName;?>"></span>
					<span class="text-name space_right">首付款：</span>
					<input id="state_firstpay" type="hidden" value="<?php echo $downPatment;?>"/>
					<select name="" id="first_pay" class="text-value option-supplier space_right">
						<option value="">全部</option>
						<option value="1">有</option>
						<option value="0">无</option>
					</select>
				</div>
				<div class="row-fluid space_bottom">
					<div class="search-button">
						<img src="/images/search.jpg">
						<span>搜索</span>

					</div>
				</div>
				<input id="submit" style="display: none;" type="submit"/>
			</form>
		</div>
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>订单号</th>
                        <th>结算方式</th>
                        <th>服务类型</th>
						<th>账号</th>
						<th>供应商名称</th>
						<th>开票金额</th>
						<th>报关金额</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody style="font-size: 12px">
					<tr style="height:5px;"></tr>
					<?php for ($i = 0; $i < count($models); $i++) {?>
					<tr <?php if ($i % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td>
							<?php  echo ($page - 1) * 10 + ($i + 1);  ?>
						</td>


						<td>
							<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/order/order-detail','id'=>$models[$i]['id']]); ?>">
								<?php echo $models[$i]['contract_type']; ?></a>
							</td>
                        <td>
	                        <?=ZJJConfig::get_settlement_type($models[$i]['settlement_type']);?>
                        </td>
                        <td>
	                        <?=ZJJConfig::get_service_type($models[$i]['service_type']);?>
                        </td>
							<td><?php echo $models[$i]['email']; ?></td>
							<td><?php echo $models[$i]['supplier_name']; ?></td>
							<td><?=!empty($orders_goods[$models[$i]['id']]['invoice_amount']) ? $orders_goods[$models[$i]['id']]['invoice_amount'] : ''?></td>
							<td><?=!empty($orders_goods[$models[$i]['id']]['subtotal']) ? $orders_goods[$models[$i]['id']]['subtotal'] : ''?></td>
							

								<td>
								<select name="state" class="select_state" data-id="<?php echo $models[$i]['id'];?>">
									<option value="0" <?=$models[$i]['order_state'] == 0 ? 'selected' : ''?>>订单审核中</option>
									<option value="1" <?=$models[$i]['order_state'] == 1 ? 'selected' : ''?>>审核通过</option>
									<option value="2" <?=$models[$i]['order_state'] == 2 ? 'selected' : ''?>>工厂生产中</option>	
									<option value="3" <?=$models[$i]['order_state'] == 3 ? 'selected' : ''?>>质检装柜</option>
									<option value="4" <?=$models[$i]['order_state'] == 4 ? 'selected' : ''?>>到达口岸</option>
									<option value="5" <?=$models[$i]['order_state'] == 5 ? 'selected' : ''?>>报关完成</option>
									<option value="6" <?=$models[$i]['order_state'] == 6 ? 'selected' : ''?>>收集单据</option>
									<option value="7" <?=$models[$i]['order_state'] == 7 ? 'selected' : ''?>>收汇</option>
									<option value="8" <?=$models[$i]['order_state'] == 8 ? 'selected' : ''?>>垫付税款</option>
									<option value="9" <?=$models[$i]['order_state'] == 9 ? 'selected' : ''?>>垫付采购款</option>
									<option value="10" <?=$models[$i]['order_state'] == 10 ? 'selected' : ''?>>退税完成</option>
									<option value="11" <?=$models[$i]['order_state'] == 11 ? 'selected' : ''?>>还本付息</option>
									<option value="12" <?=$models[$i]['order_state'] == 12 ? 'selected' : ''?>>已完成</option>
									<option value="-1" <?=$models[$i]['order_state'] == -1 ? 'selected' : ''?>>审核未通过</option>
								</select>
									</td>
									<td>
										<a href="javascript:;" class="ondel" data-id="<?php echo $models[$i]['id'];?>">删除</a>
									</td>
								</tr>
								<?php }?>
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
			</div>
		</div>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
		<script>
			$('#start_time').datetimepicker({
				lang:'ch',
				format:'Y-m-d',
				timepicker:false,
			});
			$('#end_time').datetimepicker({
				lang:'ch',
				format:'Y-m-d',
				timepicker:false,
			});
			
			$(".ondel").on('click', function(){
				var id = $(this).attr("data-id");
				var val = $(this).val();
				var csrfToken = $("#_csrf").val();
				var ds = confirm("确定删除数据吗？");
				
				if(ds){
					$.post("/ydlbam/order/delete-order", {
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
			
			$(".select_state").on('change',function () {
				var id = $(this).attr("data-id");
				var val = $(this).val();
				var csrfToken = $("#_csrf").val();
				$.post("/ydlbam/order/auditing-order", {
					"order_id":id,
					"state":val,
					"_csrf":csrfToken
				}, function(data){
					var contentData = $.parseJSON(data);
					if (contentData.status){
						alert(contentData.message);
					}else{
						alert("操作失败，稍后重试");
					}
				});
			});
			
		</script>
<script type="text/javascript" src="/js/artdialog/jquery.artDialog.js"></script>
		<script type="text/javascript" src="/js/ydlbam_js/js_order/order_manage.js"></script>
