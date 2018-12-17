<script>
	$(".order").css("border-left","6px solid #4E99B8");
	$(".order").css("background","#222222");
	if(window.localStorage){
		localStorage.setItem("chinaPorts",JSON.stringify(<?php echo $chinaPorts;?>));
		localStorage.setItem("globalPorts",JSON.stringify(<?php echo $globalPorts;?>));
	}else{
		alert("不支持本地存储!");
	}
</script>
<link rel="stylesheet" type="text/css" href="../css/order/order.css">
<link rel="stylesheet" type="text/css" href="../css/public/jquery.datetimepicker.css"/ >
<style>
.custom-inf {
    width: 100%;
    float: left;
    margin-top: 17px;
}
</style>
<?php
$img_source = "/uploads/";
if($this->context->_popSuccessMessage()) {
	?>
	<div class="hint-dialog_success" style="width:120px;">
		<p class="hint-info_success"><?php echo $this->context->_popSuccessMessage(); ?></p>
	</div>
	<?php
} else {
	$msg = $this->context->_popErrorMessage();
	if($msg != null){
		?>
		<div class="hint-dialog_fail" style="width:120px;">
			<p class="hint-info_fail"><?php echo $this->context->_popErrorMessage(); ?></p>
		</div>
		<?php
	}
}
?>
<meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>

<title>添加订单-第二步</title>

<div style="min-width: 960px">
<form autocomplete="off" action=<?php echo Yii::$app->urlManager->createUrl(['order/add-second-step']); ?>
		enctype="multipart/form-data" method="post">
<div class="title-div">
			<a href="'<?php echo Yii::$app->urlManager->createUrl(['order']); ?>'">
				<p class="font-title-size default-blue spacing-left">订单管理</p>
			</a>
			<p class="font-title-size font-color-default"> - 添加订单</p>
			<span style="color:#666666;">(最后一步)</span>
		</div>
		<div class="row-fluid col-md-12">
			<div class="orange-label">
				<p class="label-title">选择收汇方式与报关方式</p>
			</div>
		</div>
		<div class="space-vertical base-message" style="">
			<div class="info-custom">
				<div class="custom-inf">
					<p>服务类型：
						<input id="####" class="input-padding"  name="order_info[settlement_style]" value="" />
					</p>
				</div>
			</div>
			</br>
			<div class="info-custom">
				<div class="custom-inf">
					<p>结算方式：
						<input id="####" class="input-padding"  name="order_info[settlement_style]" value="" />
					</p>
				</div>
			</div>
			</br>
			<div class="info-custom">
				<div class="custom-inf">
					<p >报关口岸:
							<input id="customs_port" name="order_info[customs_port]"  value="" >
							<div>
							</div>
						</p>
				</div>
			</div>
			</br>
			<div class="info-custom">
				<div class="custom-inf">
					<p>报关方式：
						<input id="####" class="input-padding"  name="order_info[settlement_style]" value="" />
					</p>
				</div>
			</div>
			</br>
		
			<div class="info-custom">
				<div class="custom-inf">
					<p>报关形式：
						<input id="####" class="input-padding"  name="order_info[settlement_style]" value="" />
					</p>
				</div>
			</div>
			</br>
			<div class="info-custom">
				<div class="custom-inf">
					<p>报关联系人：
						<input id="####" class="input-padding"  name="order_info[settlement_style]" value="" />
					</p>
				</div>
			</div>
			</br>
			
		</div>
</form>

</div>




<div style="min-width: 960px">
	<form autocomplete="off" action=<?php echo Yii::$app->urlManager->createUrl(['order/add-second-step']); ?>
		enctype="multipart/form-data" method="post">
		<div class="title-div">
			<a href="'<?php echo Yii::$app->urlManager->createUrl(['order']); ?>'">
				<p class="font-title-size default-blue spacing-left">订单管理</p>
			</a>
			<p class="font-title-size font-color-default"> - 添加订单</p>
			<span style="color:#666666;">(最后一步)</span>
		</div>
		<div class="row-fluid col-md-12">
			<div class="orange-label">
				<p class="label-title">基本信息</p>
			</div>
		</div>

		<div class="space-vertical base-message" style="">
			<div class="info-custom">
				<div class="custom-inf">
					<p>供应商：
						<span id="supplier_name">
							<input type="hidden" name='order_info[supplier_id]' value="<?php echo $order_goods['supplier_id'] ?>" />

							<input name="order_info[supplier_name]" type="hidden" value="<?php echo $order_goods['supplier_name'] ?>" />
							<input class="input-padding" name="order_info[supplier_name]" disabled="disabled" value="<?php echo $order_goods['supplier_name'] ?>" />
						</span>
					</p>
				</div>
				<div class="custom-inf">
					<p>联系人：
						<input id="supplier_principal" class="input-padding"  name="order_info[supplier_principal]" value="<?php echo $supplier['finance_contacts'] ?>" />
					</p>
				</div>
				<div class="custom-inf">
					<p>联系电话：
						<input id="supplier_tel" class="input-padding"  name="order_info[supplier_tel]" value="<?php echo $supplier['tel'] ?>" />
					</p>
				</div>
				<div class="custom-inf">
					<p>邮箱：
						<input id="supplier_email" class="input-padding" type="email" name="order_info[supplier_email]" value="" />
					</p>
				</div>
			</div>
			<div class="info-custom">
				<div class="custom-inf">
					<p>我&nbsp&nbsp&nbsp&nbsp方：
						<input id="user_company" class="input-padding" name="order_info[user_company]" value="" />
					</p>
				</div>
				<div class="custom-inf">
					<p>联系人：
						<input id="user_principal" class="input-padding"  name="order_info[user_principal]"  value="" />
					</p>
				</div>
				<div class="custom-inf">
					<p>联系电话：
						<input id="user_tel" class="input-padding"  name="order_info[user_tel]"  value="" />
					</p>
				</div>
				<div class="custom-inf">
					<p>邮箱：
						<input id="user_email" class="input-padding"  type="email" name="order_info[user_email]" value="" />
					</p>
				</div>
			</div>
		</div>

		<div class="row-fluid col-md-12">
			<div class="orange-label">
				<p class="label-title">报关信息</p>
			</div>
		</div>

		<div class="space-vertical base-message" style="">
			<div class="info-custom">
				<div class="order-inf">
					<p>订单总金额(美元)：
						<span id="order_total_USD">
						<?php echo round($order_goods['total_price']*($exchange_rate) ,2); ?>
						(今日汇率：<?php echo $exchange_rate; ?>)
						</span>
					</p>
				</div>
				<div class="order-inf">
					<p>境内货源地：
						<span id="original_place">
							<?php echo $supplier['province'] ?><?php echo $supplier['city'] ?><?php echo $supplier['county'] ?><?php echo $supplier['address'] ?>
						</span>
						<input type="hidden" name="order_info[original_place]" value="<?php echo $supplier['province'] ?><?php echo $supplier['city'] ?>" />
					</p>
				</div>
			</div>
			<div class="info-custom" >
				<div class="order-inf">
					<div style="float: left;width: 49%">
						<p>总毛重(kg)：
							<span id="gross_weoght"><?php echo $order_goods['gross_weight'] ?></span>
							<input type="hidden" name="order_info[gross_weoght]" value="<?php echo $order_goods['gross_weight'] ?>" />
						</p>
					</div>

					<div style="float: left;width: 49%">
						<p>总净重(kg)：&nbsp
							<span id="net_weight"><?php echo $order_goods['net_weight'] ?></span>
							<input type="hidden" name="order_info[net_weight]" value="<?php echo $order_goods['net_weight'] ?>" />
						</p>
					</div>
				</div>
				<div class="order-inf">
					<div style="float: left;width: 33%">
						<p>总数量：
							<span id="total_quantity"><?php echo $order_goods['total_quantity'] ?></span>
							<input type="hidden" name="order_info[total_quantity]" value="<?php echo $order_goods['total_quantity'] ?>" />

						</p>
					</div>
					<div style="float: left;width: 33%">
						<p>总箱数：
							<span id="total_box"><?php echo $order_goods['total_box'] ?></span>
							<input type="hidden" name="order_info[total_box]" value="<?php echo $order_goods['total_box'] ?>" />
						</p>
					</div>
					<div style="float: left;width: 33%">
						<p>总体积(</span>m<sup>3</sup>)：
							
								<input type="total_volume" name="order_info[total_volume]" value="<?php echo $order_goods['total_volume'] ?>" />

							</p>
						</div>
					</div>
				</div>
				
				<div class="info-custom row-fluid">
					<div class="order-inf">
						<p class="spacing-left">订单编号:
							<input id="order_sn" name="order_info[order_sn]" style="width:360px;" class="input-padding">
							<div>
							</div>
						</p>
					</div>
					<div class="order-inf">
						<p class="spacing-left">报关口岸:
							<input id="customs_port" name="order_info[customs_port]" style="width:360px;" class="input-padding">
							<div>
							</div>
						</p>
					</div>
					<div class="order-inf">
						<p class="spacing-left">到达口岸:
							<input id="arrive_port" name="order_info[arrive_port]" style="width:360px;" class="input-padding">
						</p>
					</div>
					<div class="order-inf">
						<p class="spacing-left">报关单号:
							<input id="arrive_port" name="order_info[customs_declaration]" style="width:360px;" class="input-padding">
						</p>
					</div>
                    <div class="order-inf">
                        <p class="spacing-left">商品编码:
                            <input id="arrive_port" name="order_info[commodity_code]" style="width:360px;" class="input-padding">
                        </p>
                    </div>
					<div class="order-inf">
						<p class="spacing-left">出口日期:
							<input id="date_departure" name="order_info[date_departure]" style="width:360px;" class="input-padding">
						</p>
					</div>
                    <div class="order-inf">
                        <p class="spacing-left">申报美金总价:
                            <input id="arrive_port" name="order_info[usd_total]" style="width:360px;" class="input-padding">
                        </p>
                    </div>
                    <div class="order-inf">
                        <p class="spacing-left">申报美金单价:
                            <input id="arrive_port" name="order_info[usd_unit_price]" style="width:360px;" class="input-padding">
                        </p>
                    </div>
                </div>

				<div class="row-fluid col-md-12">
					<div class="orange-label">
						<p class="label-title">支付信息</p>
					</div>
				</div>

				<div class="info-custom">
					<div class="order-inf">
						<p>订单总金额(元)：
							<span id="order_total"><?php echo $order_goods['total_price'] ?></span>
							<input type="hidden" name="order_info[order_total]" value="<?php echo $order_goods['total_price'] ?>" />
						</p>
					</div>
					<div class="div-first-pay">
						<p>首付款：
							<label class="first-money" style="margin-left:56px;">
								<input id="pay-no" name="order_info[down_payment]" title="0" type="radio" value="0" />&nbsp&nbsp无
							</label></br>
							<label class="first-money" style="margin-left:116px;">
								<input id="pay-has" name="order_info[down_payment]" title="1" type="radio" value="1" />&nbsp&nbsp自定义金额
							</label>
							<label id="first-pay-put" class="first-money">
								<input id="first-price"class="input-padding" style="margin-left:14px;font-weight: 100" value="" placeholder="请填写金额" /> 元</span>
							</label><span class="order-inf-span" id="first-price-hint1"></span></br>
							<label class="first-money" style="margin-left:116px;">
								<input id="pay-has" name="order_info[down_payment]" title="2" type="radio" value="1" />&nbsp&nbsp按百分比支付
							</label>
							<label id="first-pay-put" class="first-money">
								<input id="first-price-2"class="input-padding" style="font-weight: 100"  value="" placeholder="请填写百分比" /> <span> %</span>
							</label><span class="order-inf-span" id="first-price-hint2"></span></br>
							<input style="display:none;" name="order_info[firstpayment_amount]" id="firstpay_real">
						</p>
					</div>
				</div>
			</div>

			<div class="row-fluid col-md-12">
				<div class="orange-label">
					<p class="label-title">已添加商品</p>
				</div>
			</div>
			<div class="" >
				<div class="row" >
					<div class="col-md-12" >
						<table id="table"  class="table" >
							<thead>
								<tr>
									<th>序号</th>
									<th>产品图片</th>
									<th>报关品名</th>
									<th>毛重(kg)</th>
									<th>净重(kg)</th>
									<th>箱数</th>
									<th>单价(元)</th>
									<th>数量</th>
								</tr>
							</thead>
							<tbody style="background: #fff;">
								<?php $i = 0;foreach ($order_goods['product'] as $data) { ?>
								<tr id="sure-goods">
									<td><?php echo $data['product_number']; ?></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[goods_id]" value="2" />
									<td><a target="_Blank" href="<?php echo $img_source.$data['product_image']; ?>"><img style="cursor:pointer;" height="40" width="60" src="<?php echo $img_source.$data['product_image']; ?>"></a></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[goods_image]" value="<?php echo $data['product_image']; ?>" />
									<td class="good-name"><?php echo $data['product_name']; ?></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[goods_name]" value="<?php echo $data['product_name']; ?>" />
									<td class="good-gross-weight"><?php echo $data['gross_weoght']; ?></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[gross_weight]" value="<?php echo $data['gross_weoght']; ?>" />
									<td class="good-net-weight"><?php echo $data['net_weight']; ?></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[net_weight]" value="<?php echo $data['net_weight']; ?>" />
									<td class="good-box"><?php echo $data['single_box']; ?></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[box_number]" value="<?php echo $data['single_box']; ?>" />
									<td class="good-price"><?php echo $data['single_prince']; ?></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[goods_price]" value="<?php echo $data['single_prince']; ?>" />
									<td class="good-box-number"><?php echo $data['put_box_number']; ?></td>
									<input type="hidden" name="order_info<?php echo $i; ?>[goods_num]" value="<?php echo $data['put_box_number']; ?>" />
									<input type="hidden" name="order_info<?php echo $i; ?>[hs_code]" value="<?php echo $data['hs_code']; ?>" />
									<input type="hidden" name="order_info<?php echo $i; ?>[goods_taxrate]" value="<?php echo $data['goods_taxrate']; ?>" />
								</tr>
								<?php $i++;}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="button-div space-vertical">
				<a href="/?r=order/add_order_1">
					<p class="pre font-content-size">上一步</p>
				</a>
				<a class="spacing-left">
					<input id="submit-all-info" type="button" style="width: 90px" class="default-background-blue font-content-size submit" value="提&nbsp&nbsp&nbsp&nbsp交">
					<input type="submit" style="display: none;" id="submit-all-info-hidden" class="default-background-blue font-content-size submit" value="提&nbsp&nbsp&nbsp&nbsp交">
				</a>
			</div>
			<input name="_csrf" type="hidden" id="_csrf" value="<?=Yii::$app->request->csrfToken?>">
		</form>
	</div>

	<div class="down-div1">
	</div>
	<div class="down-div2">
	</div>
<script type="text/javascript" src="../public/jquery.datetimepicker.js"></script>
	<script type="text/javascript" src="../js/order/order-second-step.js"></script>


<script>
    $('#date_departure').datetimepicker({
        lang:'ch',
        format:'Y-m-d',
        timepicker:false,
    });
</script>