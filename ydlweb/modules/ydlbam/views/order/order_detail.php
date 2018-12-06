<?php
$img_source = "http://172.18.240.62:8080/uploads/";
// var_dump ($payLogs);
?>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<link rel="stylesheet" href="/css/ydlbam_css/css_order/order.css">
<script>
	$("#order-manage").css("border-left","6px solid #4e99b8");
	$("#order-manage").css("color","#4e99b8");
</script>
<div class="body-main">
	<div class="main-content">

		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/order']); ?>">订单管理</a>
			<span class="text-value">>订单详情</span>
		</div>
		<div class="orange-label">
			<p>订单状态</p>
		</div>
		<div class="space_top ">
			<div>
				<span class="text-value ">当前状态：</span>
				<span id="<?php echo $order['order_state'];?>" class="text-value space_left order_state">
					<?php 
					if ($order['order_state']==0) {
						echo '下单审核';
					} elseif ($order['order_state']==2) {
						echo '工厂生产';
					}elseif ($order['order_state']==3) {
						echo '质检装柜';
					}elseif ($order['order_state']==4) {
						echo '到达口岸';
					}elseif ($order['order_state']==5) {
						echo '报关完成';
					}elseif ($order['order_state']==6) {
						echo '收集单据';
					}elseif ($order['order_state']==7) {
						echo '收汇';
					}elseif ($order['order_state']==8) {
						echo '垫付税款';
					}elseif ($order['order_state']==9) {
						echo '垫付采购款';
					}elseif ($order['order_state']==10) {
						echo '退税完成';
					}elseif ($order['order_state']==11) {
						echo '还本付息';
					}elseif ($order['order_state']==12) {
						echo '已完成';
					}
					elseif ($order['order_state']==-1) {
						echo '审核未通过';
					}elseif ($order['order_state']==-2) {
						echo '取消';
					}
					?>
				</span>
			</div>
			<div>
				<span class="text-value">修改状态：</span>
				<input type="hidden" id="order_id" name="order_id"  value="<?php echo $order['id'];?>" />
				<select name="state" id="select_state" class="text-value space_left option-supplier">
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
				<span id="sure-edit" class="font-blue space_left">确认修改</span>
			</div>
		</div>
		<div class="orange-label">
			<p>基本信息</p>
		</div>
		<div class="down-line row">
			<div class="space_top " style="min-width: 1000px">
				<div class="col-md-3 col-xs-3">
					<span>供应商：</span>
					<span><?php echo $order['supplier_name'];?></span>
				</div>
				<div class="col-md-3 col-xs-3">
					<span>联系人：</span>
					<span><?php echo $order['supplier_principal'];?></span>
				</div>
				<div class="col-md-3 col-xs-3">
					<span>联系电话：</span>
					<span><?php echo $order['supplier_tel'];?></span>
				</div>
				<div class="col-md-3 col-xs-3">
					<span>邮箱：</span>
					<span><?php echo $order['supplier_email'];?></span>
				</div>
			</div>
			<div class="space_top" style="min-width: 1000px">
				<div class="col-md-3 col-xs-3">
					<span>我&nbsp&nbsp&nbsp方：</span>
					<span><?php echo $order['user_company'];?></span>
				</div>
				<div class="col-md-3 col-xs-3">
					<span>联系人：</span>
					<span><?php echo $order['user_principal'];?></span>
				</div>
				<div class="col-md-3 col-xs-3">
					<span>联系电话：</span>
					<span><?php echo $order['user_tel'];?></span>
				</div>
				<div class="col-md-3 col-xs-3" >
					<span>邮箱：</span>
					<span><?php echo $order['user_email'];?></span>
				</div>
			</div>

		</div>
		<div class="down-line row">
			<div class="space_top " style="min-width: 1000px">
				<div class="col-md-4 col-xs-4 ">
					<span  >订单总金额(元)：</span>
					<span  ><?php echo $order['order_total'];?></span>
				</div>
				<div class="col-md-4 col-xs-4">
					<span class="col-md-offset-1">首付款(元)：</span>
					<span >&nbsp<?php echo $order['firstpayment_amount'];?></span>
				</div>
				<div class="col-md-4 col-xs-4 " >
					<span class="col-md-offset-3">总净重(kg):</span>
					<span>&nbsp&nbsp<?php echo $order['net_weight'];?></span>
				</div>

			</div>
			<div class="space_top " style="min-width: 1000px">
				<div class="col-md-4 col-xs-4 ">
					<span>总毛重(kg)：</span>
					<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $order['gross_weoght'];?></span>
				</div>
				<div class="col-md-4 col-xs-4">
					<span class="col-md-offset-1">境内货源地：</span>
					<span ><?php echo $order['original_place'];?></span>
				</div>
				<div class="col-md-4 col-xs-4 " >
					<span class="col-md-offset-3">总数量:</span>
					<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $order['total_quantity'];?></span>
				</div>

			</div>

			<div class="space_top " style="min-width: 1000px">
				<div class="col-md-4 col-xs-4 ">
					<span>报关口岸：</span>
					<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $order['customs_port'];?></span>
				</div>
				<div class="col-md-4 col-xs-4">
					<span class="col-md-offset-1">到达口岸：</span>
					<span >&nbsp&nbsp&nbsp<?php echo $order['arrive_port'];?></span>
				</div>
				<div class="col-md-4 col-xs-4 " >
					<span class="col-md-offset-3">总箱数:</span>
					<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $order['total_box'];?></span>
				</div>

			</div>
		</div>
		<div class="orange-label">
			<p>已添加商品</p>
		</div>
		<div class="row space_top order_detail">
			<div class="col-md-12 col-xs-12">
				<table id="table">
					<thead>
						<tr>
							<th>序号</th>
							<th>封面</th>
							<th>产品名称</th>
							<th>毛重(kg)</th>
							<th>净重(kg)</th>
							<th>箱数</th>
							<th>单价(元)</th>
							<th>数量</th>
						</tr>
					</thead>
					<tbody>
						<tr style="height:5px;"></tr>
						<?php for ($i = 0; $i < count($orderGoods); $i++) {?>
						<tr  >
							<td>1</td>
							<td>
								<a target="_blank" href="<?php echo $img_source.$orderGoods[$i]['goods_image'];?>">
									<img src=<?php echo $img_source.$orderGoods[$i]['goods_image'];?> alt="图片" style="height: 40px;width: 60px;">
								</a>
							</td>
							<td><?php echo $orderGoods[$i]['goods_name'];?></td>
							<td><?php echo $orderGoods[$i]['gross_weight'];?></td>
							<td><?php echo $orderGoods[$i]['net_weight'];?></td>
							<td><?php echo $orderGoods[$i]['box_number'];?></td>
							<td><?php echo $orderGoods[$i]['goods_price'];?></td>
							<td><?php echo $orderGoods[$i]['goods_num'];?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="orange-label">
		<p>付款详情</p>
	</div>
	<div class="row space_top order_detail">
		<div class="col-md-12 col-xs-12">
			<table id="table">
				<thead>
					<tr>
						<th>日期</th>
						<th>金额</th>
						<th>支付方式</th>
						<th>备注</th>

					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
					for ($i = 0; $i < count($payLogs); $i++) {
						?>
						<tr  >
							<td><?php echo date(("Y-m-d"),$payLogs[$i]['created_at']);?></td>
							<td><?php echo $payLogs[$i]['capital']; ?></td>
							<td>
								<!-- pay_type(1:可用资金,2:信用额度) -->
								<?php 
								if ($payLogs[$i]['capital_type'] ==1) {
									echo "可用资金";
								} else if($payLogs[$i]['capital_type'] ==2) {
									echo "信用额度";
								} else{
									echo "未知支付方式";
								};
								?>
							</td>
							<td><?php echo $payLogs[$i]['capital_explain']; ?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>



</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_order/order_detail.js"></script>
