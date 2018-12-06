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
						<th>账号</th>
						<th>供应商名称</th>
						<th>订单金额</th>
						<th>时间</th>
						<th>首付款</th>
						<th>状态</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php for ($i = 0; $i < count($models); $i++) {?>
					<tr <?php if ($i % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td>
							<?php  echo ($page - 1) * 10 + ($i + 1);  ?>
						</td>


						<td>
							<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/order/order-detail','id'=>$models[$i]['id']]); ?>">
								<?php echo $models[$i]['order_sn']; ?></a>
							</td>
							<td><?php echo $models[$i]['email']; ?></td>
							<td><?php echo $models[$i]['supplier_name']; ?></td>
							<td><?php echo $models[$i]['order_total']; ?></td>
							<td><?php echo date(("Y-m-d"), $models[$i]['created_at']);?></td>
							<td><?php
								if($models[$i]['down_payment'] == 0){
									echo "无";
								}else{
									echo "有";

								}
								?></td>
								<td><?php
									if ($models[$i]['order_state']==0) {
						echo '下单审核';
					} elseif ($models[$i]['order_state']==2) {
						echo '工厂生产';
					}elseif ($models[$i]['order_state']==3) {
						echo '质检装柜';
					}elseif ($models[$i]['order_state']==4) {
						echo '到达口岸';
					}elseif ($models[$i]['order_state']==5) {
						echo '报关完成';
					}elseif ($models[$i]['order_state']==6) {
						echo '收集单据';
					}elseif ($models[$i]['order_state']==7) {
						echo '收汇';
					}elseif ($models[$i]['order_state']==8) {
						echo '垫付税款';
					}elseif ($models[$i]['order_state']==9) {
						echo '垫付采购款';
					}elseif ($models[$i]['order_state']==10) {
						echo '退税完成';
					}elseif ($models[$i]['order_state']==11) {
						echo '还本付息';
					}elseif ($models[$i]['order_state']==12) {
						echo '已完成';
					}
					elseif ($models[$i]['order_state']==-1) {
						echo '审核未通过';
					}elseif ($models[$i]['order_state']==-2) {
						echo '取消';
					}
									?></td>
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
		</script>
		<script type="text/javascript" src="/js/ydlbam_js/js_order/order_manage.js"></script>
