<script>
  $(".order").css("border-left","6px solid #4E99B8");
  $(".order").css("background","#222222");
</script>
<link rel="stylesheet" type="text/css" href="../css/order/order.css">
<title>订单详情</title>

<div class="title-div">
  <a href="add-first-step">
    <p class="font-title-size default-blue spacing-left">订单管理</p>
  </a>
  <p class="font-title-size font-color-default"> - 添加订单</p>
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
</div>
<div class="orange-label">
  <p class="label-title">订单状态</p>
</div>

<div class="flowstep">
 <ol class="flowstep-5">
  <!-- li里面前面的ifelse是控制颜色；后面的ifelse控制图片 -->
  <li>
    <div>
     <?php if($order['order_state'] == 0){ ?>
     <div class="step-name default-blue">下单审核</div>
     <?php }else  { ?>
     <div class="step-name font-grey">下单审核</div>
     <?php } ?>

     <?php if($order['order_state'] > 0){ ?>
     <img src="../images/finished.jpg" alt="" class="examining-img">
     <img src="../images/blue_line.jpg" alt="" class="blue-line">
     <?php }else if($order['order_state'] == 0)  { ?>
     <img src="../images/being.jpg" alt="" class="examining-img">
     <img src="../images/default_line.jpg" alt="" class="blue-line">  
     <?php }else  { ?>
     <img src="../images/not-beginning.jpg" alt="" class="examining-img">
     <img src="../images/default_line.jpg" alt="" class="blue-line">
     <?php } ?>
   </div>
 </li>

 <li>
  <div>
    <?php if($order['order_state']-2 == 0){ ?>        
    <div class="step-name default-blue">工厂生产</div>
    <?php }else  { ?>
    <div class="step-name font-grey">工厂生产</div>
    <?php } ?>
    <?php if(($order['order_state']-2) >0){ ?>
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <img src="../images/finished.jpg" alt="" class="finished" >
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <?php }else if($order['order_state']-2 == 0)  { ?>
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <img src="../images/being.jpg" alt="" class="finished" >
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <?php }else  { ?>
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <img src="../images/not-beginning.jpg" alt="" class="finished" >
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <?php } ?>
  </div>
</li>

<li>
  <div>
    <?php if($order['is_pay'] == 1){ ?> 

    <?php if($order['down_payment'] == 1){ ?> 
    <div class="step-name default-blue">待付款</div>
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <img src="../images/being.jpg" alt="" class="finished" >
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <?php }else  { ?>
    <div class="step-name font-grey">待付款</div>
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <img src="../images/not-beginning.jpg" alt="" class="finished" >
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <?php } ?>

    <?php }else  { ?>
    <!--没有首付款不显示 -->
    <?php } ?>
  </div>
</li>

<li>
  <div>
   <?php if($order['order_state']-3 == 0){ ?>        
   <div class="step-name default-blue">质检装柜</div>
   <?php }else  { ?>
   <div class="step-name font-grey">质检装柜</div>
   <?php } ?>
   <?php if(($order['order_state']-3) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-3 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
 <div>
   <?php if($order['order_state']-4 == 0){ ?>        
   <div class="step-name default-blue">到达口岸</div>
   <?php }else  { ?>
   <div class="step-name font-grey">到达口岸</div>
   <?php } ?>
   <?php if(($order['order_state']-4) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-4 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
  <div>
    <?php if($order['order_state']-5 == 0){ ?>        
    <div class="step-name default-blue">报关完成</div>
    <?php }else  { ?>
    <div class="step-name font-grey">报关完成</div>
    <?php } ?>
    <?php if(($order['order_state']-5) >0){ ?>
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <img src="../images/finished.jpg" alt="" class="finished" >
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <?php }else if($order['order_state']-5 == 0)  { ?>
    <img src="../images/blue_line.jpg" alt="" class="blue-line">
    <img src="../images/being.jpg" alt="" class="finished" >
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <?php }else  { ?>
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <img src="../images/not-beginning.jpg" alt="" class="finished" >
    <img src="../images/default_line.jpg" alt="" class="blue-line">
    <?php } ?>
  </div>
</li>

<li>
  <div>
   <?php if($order['order_state']-6 == 0){ ?>        
   <div class="step-name default-blue">收集单据</div>
   <?php }else  { ?>
   <div class="step-name font-grey">收集单据</div>
   <?php } ?>
   <?php if(($order['order_state']-6) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-6 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
  <div>
   <?php if($order['order_state']-7 == 0){ ?>        
   <div class="step-name default-blue">收汇</div>
   <?php }else  { ?>
   <div class="step-name font-grey">收汇</div>
   <?php } ?>
   <?php if(($order['order_state']-7) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-7 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
 <div>
   <?php if($order['order_state']-8 == 0){ ?>        
   <div class="step-name default-blue">垫付税款</div>
   <?php }else  { ?>
   <div class="step-name font-grey">垫付税款</div>
   <?php } ?>
   <?php if(($order['order_state']-8) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-8 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
 <div>
   <?php if($order['order_state']-9 == 0){ ?>        
   <div class="step-name default-blue">垫付采购款</div>
   <?php }else  { ?>
   <div class="step-name font-grey">垫付采购款</div>
   <?php } ?>
   <?php if(($order['order_state']-9) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-9 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
 <div>
   <?php if($order['order_state']-10 == 0){ ?>        
   <div class="step-name default-blue">退税完成</div>
   <?php }else  { ?>
   <div class="step-name font-grey">退税完成</div>
   <?php } ?>
   <?php if(($order['order_state']-10) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-10 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
 <div>
   <?php if($order['order_state']-11 == 0){ ?>        
   <div class="step-name default-blue">还本付息</div>
   <?php }else  { ?>
   <div class="step-name font-grey">还本付息</div>
   <?php } ?>
   <?php if(($order['order_state']-11) >0){ ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/finished.jpg" alt="" class="finished" >
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <?php }else if($order['order_state']-11 == 0)  { ?>
   <img src="../images/blue_line.jpg" alt="" class="blue-line">
   <img src="../images/being.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php }else  { ?>
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <img src="../images/not-beginning.jpg" alt="" class="finished" >
   <img src="../images/default_line.jpg" alt="" class="blue-line">
   <?php } ?>
 </div>
</li>

<li>
  <div>
    <?php if($order['order_state']-12 == 0){ ?> 
    <div class="step-name default-blue">已完成</div>
    <?php }else  { ?>
    <div class="step-name font-grey">已完成</div>
    <?php } ?>
    <?php if($order['order_state']-12 == 0){ ?> 
    <img src="../images/blue_line.jpg" alt="" class="last-img">
    <img src="../images/being.jpg" alt="" class="finished">
    <?php }else  { ?>
    <img src="../images/default_line.jpg" alt="" class="last-img">
    <img src="../images/not-beginning.jpg" alt="" class="finished">
    <?php } ?>
  </div>
</li>
</ol>
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
            <span class="text-name name-float">结算方式 :</span>
        </div>
        <div class="col-xs-9">
            <span class="value-float"><?=ZJJConfig::get_settlement_type($order['settlement_type'])?></span>
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

<div class="container-fluid" >
    <table id="table"  class="table" >
        <thead>
        <tr>
            <th>出货产品清单</th>
            <th>总净重(Kg)</th>
            <th>总毛重(kg)</th>
            <th>产品数量和单位</th>
            <th>单价</th>
            <th>货值</th>
            <th>法定数量和单位</th>
            <th>开票人</th>
            <th>开票金额</th>
            <th>估算汇率</th>
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
                <td><?php echo $data['net_weight'];?></td>
                <td><?php echo $data['gross_weight'];?></td>
                <td><?php echo $data['box_number'];?>/<?=Tool::getGoodsUnit($data['box_unit']);?></td>
                <td><?=$data['goods_price'];?></td>
                <td><?=$data['subtotal'];?></td>
                <td><?=$data['standard_count'];?>套 / <?=$data['standard_count2'];?>千克</td>
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
                <td><?php echo $data['invoice_amount'];?></td>
                <td><?php echo $data['estimate'];?>%</td>
            </tr>
			<?php $i++; } ?>
        </tbody>
    </table>
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
            <span class="text-name name-float">合同编号 :</span>
        </div>
        <div class="col-xs-9">
            <span class="text-value value-float"><?=$order['contract_type']?></span>
        </div>
    </div>
</div>

<div class="orange-label" style="margin-top: 10px">
    <p class="label-title">4.附件上传</p>
</div>

<div class="container-fluid">
    <div class="row-fluid col-xs-12">
        <div class="col-xs-2">
            <span class="text-name name-float">上传采购订单或PI :</span>
        </div>
        <div class="col-xs-4">
            <a href="<?=!empty($order['purchasing_order']) ? $img_source.$order['purchasing_order'] : '../images/upload_bg.png'?>" target="_blank">
                <img src="<?=!empty($order['purchasing_order']) ? $img_source.$order['purchasing_order'] : '../images/upload_bg.png'?>" width="200">
            </a>
        </div>
        <div class="col-xs-2">
            <span class="text-name name-float">其他 :</span>
        </div>
        <div class="col-xs-4">
            <a href="<?=!empty($order['other_file']) ? $img_source.$order['other_file'] : '../images/upload_bg.png'?>" target="_blank">
                <img src="<?=!empty($order['other_file']) ? $img_source.$order['other_file'] : '../images/upload_bg.png'?>" width="200">
            </a>
        </div>
    </div>
</div>

<?php 
if($order['order_state'] == 11||$order['order_state'] == 0 || $order['order_state'] == -1||$order['order_state'] == -2){  
  ?>
  <div >
    <div class="orange-label">
      <p class="label-title">付款记录</p>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12" >
          <div class="">
            <div  style="margin-top:20px ;background: #f5f5f5">
              <table id="table" class="table">
                <thead>
                  <tr>
                    <th>流水单号</th>
                    <th>金额</th>
                    <th>资金类型</th>
                    <th>资金说明</th>
                    <th>时间</th>
                  </tr>
                </thead>
                <tbody style="background: #fff;border: 1px solid #eee;">
                  <?php
                  foreach ($payLogs as $key => $value) {
                    ?>
                    <tr style="height: 60px">
                      <td><?php echo $value['flow_sn']; ?></td>
                      <td><?php echo $value['capital_symbol'].$value['capital'];?></td>
                      <td><?php 
                        if($value['capital_type'] == 1){
                          echo "自有资金";
                        }else if($value['capital_type'] == 2){
                          echo "信用额度";
                        }else{
                          echo "保证金";
                        }
                        ?></td>
                        <td><?php echo $value['capital_explain']; ?></td>
                        <td><?php echo date("Y-m-d", $value['created_at']); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                   <?php
                        if(count($payLogs) == 0){
                    ?>
                    <div class="null-full container-fluid col-md-12">
                      <img height="20" width="20" src="../images/null_hint.png">
                      <span style="margin-left:5px;color:#666666;line-height:20px;">暂无数据</span>
                    </div>
                    <?php
                        }
                    ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      <?php }else  { ?>
      <div >
       <div class="orange-label">
        <p class="label-title">付款记录</p>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12" >
            <div class="">
              <div  style="margin-top:20px ;background: #f5f5f5">
                <table id="table" class="table">
                  <thead>
                    <tr>
                      <th>流水单号</th>
                      <th>金额</th>
                      <th>资金类型</th>
                      <th>资金说明</th>
                      <th>时间</th>
                    </tr>
                  </thead>
                  <tbody style="background: #fff;border: 1px solid #eee;">
                    <?php
                    foreach ($payLogs as $key => $value) {
                      ?>
                      <tr style="height: 60px">
                        <td><?php echo $value['flow_sn']; ?></td>
                        <td><?php echo $value['capital_symbol'].$value['capital'];?></td>
                        <td><?php 
                          if($value['capital_type'] == 1){
                            echo "自有资金";
                          }else if($value['capital_type'] == 2){
                            echo "信用额度";
                          }else{
                            echo "保证金";
                          }
                          ?></td>
                          <td><?php echo $value['capital_explain']; ?></td>
                          <td><?php echo date("Y-m-d", $value['created_at']); ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <?php
                        if(count($payLogs) == 0){
                    ?>
                    <div class="null-full container-fluid col-md-12">
                      <img height="20" width="20" src="../images/null_hint.png">
                      <span style="margin-left:5px;color:#666666;line-height:20px;">暂无数据</span>
                    </div>
                    <?php
                        }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="blue-border pay-right" style="width: 80px;margin-bottom: 30px">
          <a href="<?php echo Yii::$app->urlManager->createUrl(['capital']);?>" >
          <p style="color:#fff; text-align: center">立即支付</p>
          </a>
        </div>
        <?php } ?>

        

