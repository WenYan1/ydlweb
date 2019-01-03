<?php
//$img_source = "http://172.18.240.62:8080/uploads/";
// var_dump ($payLogs);
$img_source = "/uploads/";
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
						echo '订单审核中';
					}elseif ($order['order_state']==1) {
						echo '审核通过';
					}
					elseif ($order['order_state']==2) {
						echo '工厂生产中';
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
					}
					?>
				</span>
			</div>
			<div>
				<span class="text-value">修改状态：</span>
				<input type="hidden" id="order_id" name="order_id"  value="<?php echo $order['id'];?>" />
				<select name="state" id="select_state" class="text-value space_left option-supplier">
					<option value="0">订单审核中</option>
					<option value="1">审核通过</option>
					<option value="2">工厂生产中</option>	
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
				
				</select>
				<span id="sure-edit" class="font-blue space_left">确认修改</span>
			</div>
		</div>
        <div class="orange-label">
            <p class="label-title">1.收汇方式与报关方式</p>
        </div>

        <div class="container-fluid">
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">服务类型 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_service_type($order['service_type'])?></span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">退税手续费 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="value-float"><?=$order['drawback_brokerage'];?>%</span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">需要垫款天数 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_advance_days($order['advance_days'])?></span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">年化利息报价 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="value-float"><?=$order['interest_offer'];?>%</span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">结算方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="value-float"><?=ZJJConfig::get_settlement_type($order['settlement_type'])?></span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">订金比例 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="value-float"><?=$order['deposit_ratio'];?>%</span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">或订金金额 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="value-float"><?=$order['order_amount'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">报关口岸 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['customs_port'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">报关方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_customs_port_type($order['customs_port_type'])?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">报关形式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_customs_port_froms($order['customs_port_froms'])?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">报关联系人 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['customs_contact'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">报关联系方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['customs_contact_tel'];?></span>
                </div>
            </div>
        </div>

        <div class="orange-label" style="margin-top: 10px">
            <p class="label-title">2.产品及开票人信息</p>
        </div>

        <div class="container-fluid">
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">报关币种 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_customs_currency($order['customs_currency'])?></span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">成交方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="value-float"><?=ZJJConfig::get_cost_type($order['cost_type'])?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">录入价格方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_input_price_type($order['input_price_type'])?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">包装方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_packing_way($order['packing_way'])?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">运抵国（地区） :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['destination_country_or_area'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">到达口岸 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['arrive_port'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">装柜方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_risk_container_type($order['risk_container_type'])?></span>
                </div>
            </div>
        </div>

        <div class="container-fluid" >
            <table id="table"  class="table" >
                <thead>
                <tr>
                    <th >出货产品清单</th>
                    <th >产品退税率</th>
                    <th >总净重(KG)</th>
                    <th >总毛重(KG)</th>
                    <th>产品数量和单位</th>
                    <th >法定数量和单位</th>
                    <th >含税单价</th>
                    <th >开票金额</th>
                    <th >供应商</th>
                    <th >预计税款</th>
                    <th >退税手续费</th>
                    <th >预计利息</th>
                    <th >报关汇率</th>
                    <th >报关金额</th>
                    <th >报关单价</th>
                </tr>
                </thead>
                <tbody style="background: #fff;">
				<?php $i = 1;foreach($orderGoods as $data) {?>
                    <tr id="sure-goods">
                        <td>
							<?php foreach ($goods as $item){
								if ($item['id'] == $data['goods_id']){
									echo $item['goods_name'];
								}else{
									echo '';
								}
								?>
							<?php } ?>
                        </td>
                        <td><?php echo $data['tax_rebate_rate'];?>%</td>
                        <td><?php echo $data['net_weight'];?></td>
                        <td><?php echo $data['gross_weight'];?></td>
                        <td><?php echo $data['box_number'];?>/<?=Tool::getGoodsUnit($data['box_unit']);?></td>
                        <td><?=$data['standard_count'];?><?=Tool::getGoodsUnit($data['standard_count_unit']);?> / <?=$data['standard_count2'];?><?=Tool::getGoodsUnit($data['standard_count2_unit']);?></td>
                        <td><?=$data['goods_price'];?></td>
                        <td><?=$data['invoice_amount'];?></td>
                        <td>
							<?php foreach ($supplier as $item){
								if ($item['id'] == $data['supplier_id']){
									echo $item['company_name'];
								}else{
									echo '';
								}
								?>
							<?php } ?>
                        </td>
                        <td><?php echo $data['tax_cost'];?></td>
                        <td><?php echo $data['estimated_cost'];?></td>
                        <td><?php echo $data['estimated_interest'];?></td>
                        <td><?php echo $data['estimate'];?></td>
                        <td><?php echo $data['subtotal'];?></td>
                        <td><?php echo $data['customs_declaration_price'];?></td>
                    </tr>
					<?php $i++; } ?>
                </tbody>
            </table>
        </div>

        <div class="container-fluid">
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">整体包装件数 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['transport_package_count'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">包装种类 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['pack_type_list'];?></span>
                </div>
            </div>
        </div>

        <div class="orange-label" style="margin-top: 20px">
            <p class="label-title">3.报关信息</p>
        </div>

        <div class="container-fluid">
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">预计出货日期 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=date('Y-m-d',$order['delivery_time']);?></span>
                </div>
            </div>
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">境外收货人 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="value-float"><?=$order['buyers_name'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">地址 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['buyers_address'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">联系方式 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['buyers_contact'];?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">贸易国（地区） :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['trading_country']?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">是否特殊关系 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=ZJJConfig::get_is($order['is_special_relation'])?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">境内货源地 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['goods_supply_id']?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">目前货物存放地址 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['goods_save_adr']?></span>
                </div>
            </div>
            <div class="row-fluid col-sm-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">合同编号 :</span>
                </div>
                <div class="col-xs-9">
                    <span class="text-value value-float"><?=$order['contract_type']?></span>
                </div>
            </div>
        </div>

        <div class="orange-label">
            <p>4.附件上传</p>
        </div>

        <div class="container-fluid">
            <div class="row-fluid col-xs-12">
                <div class="col-xs-2">
                    <span class="text-name name-float">上传采购订单或PI :</span>
                </div>
                <div class="col-xs-4">
                    <a href="<?=!empty($order['purchasing_order']) ? $img_source.$order['purchasing_order'] : '../images/up.png'?>" target="_blank">
                        <img src="<?=!empty($order['purchasing_order']) ? Upload::get_file_thumbnail($img_source.$order['purchasing_order']) : '../images/up.png'?>" width="200">
                    </a>
                </div>
                <div class="col-xs-2">
                    <span class="text-name name-float">其他 :</span>
                </div>
                <div class="col-xs-4">
                    <a href="<?=!empty($order['other_file']) ? $img_source.$order['other_file'] : '../images/up.png'?>" target="_blank">
                        <img src="<?=!empty($order['other_file']) ? Upload::get_file_thumbnail($img_source.$order['other_file']) : '../images/up.png'?>" width="200">
                    </a>
                </div>
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
						<th>加工厂账户名</th>
						<th>账号信息</th>
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
							<td><?php echo $payLogs[$i]['factory_account_name']; ?></td>
							<td><?php echo $payLogs[$i]['account_name']; ?></td>
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
<script type="text/javascript" src="/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="/js/ydlbam_js/js_order/order_detail.js"></script>
