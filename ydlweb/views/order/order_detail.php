<script>
  $(".order").css("border-left","6px solid #4E99B8");
  $(".order").css("background","#222222");
</script>
<link rel="stylesheet" type="text/css" href="../css/order/order.css">
<title>订单详情</title>

<div class="title-div">
  <a href="add-first-step">
    <p class="font-title-size default-blue spacing-left">我的订单</p>
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
  <p class="label-title">基本信息</p>
</div>

<div class="space-vertical base-message" style="height: 107px;">
  <div class="info-custom">
      <div>
          <p>结汇周期：
              <input disabled="disabled" style="border-width: 0"value="<?php echo $order['settlement_cycle'];?>天" />
          </p>
      </div>
    <div class="custom-inf">
      <p>供应商：
        <input disabled="disabled" style="border-width: 0"value="<?php echo $order['supplier_name'];?>" />
      </p>
    </div>
    <div class="custom-inf">
      <p>联系人：
        <input disabled="disabled" style="border-width: 0" value="<?php echo $order['supplier_principal'];?>" />
      </p>
    </div>
    <div class="custom-inf">
      <p>联系电话：
        <input disabled="disabled"style="border-width: 0" value="<?php echo $order['supplier_tel'];?>" />
      </p>
    </div>
    <div class="custom-inf">
      <p>邮箱：
        <input disabled="disabled"style="border-width: 0" value="<?php echo $order['supplier_email'];?>" />
      </p>
    </div>
  </div>
  <div class="info-custom">
    <div class="custom-inf">
      <p>我&nbsp&nbsp&nbsp&nbsp方：
        <input  disabled="disabled"style="border-width: 0" value="<?php echo $order['user_company'];?>" />
      </p>
    </div>
    <div class="custom-inf">
      <p>联系人：
        <input disabled="disabled"style="border-width: 0" value="<?php echo $order['user_principal'];?>"/>
      </p>
    </div>
    <div class="custom-inf">
      <p>联系电话：
        <input  disabled="disabled"style="border-width: 0" value="<?php echo $order['user_tel'];?>" />
      </p>
    </div>
    <div class="custom-inf">
      <p>邮箱：
        <input disabled="disabled"style="border-width: 0" value="<?php echo $order['user_email'];?>" />
      </p>
    </div>
  </div>
</div>
<div class="space-vertical base-message" style="height: 130px;">
 <div class="info-custom">
  <div class="custom-inf-three">
    <p>订单总金额(元)：
      <input disabled="disabled" style="border-width: 0"value="<?php echo $order['order_total'];?>" />
    </p>
  </div>
  <div class="custom-inf-three">
    <p>首付款(元)：&nbsp
      <input disabled="disabled" style="border-width: 0" value="<?php echo $order['firstpayment_amount'];?>" />
    </p>
  </div>
  <div class="custom-inf-three">
    <p>总净重(kg)：
      <input disabled="disabled"style="border-width: 0" value="<?php echo $order['net_weight'];?>" />
    </p>
  </div>
</div>
<hr>
<div class="info-custom">
  <div class="custom-inf-three">
    <p>总毛重(kg)：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input  disabled="disabled"style="border-width: 0" value="<?php echo $order['gross_weoght'];?>" />
    </p>
  </div>
  <div class="custom-inf-three">
    <p>境内货源地：
      <input disabled="disabled"style="border-width: 0" value="<?php echo $order['original_place'];?>"/>
    </p>
  </div>
  <div class="custom-inf-three">
    <p>总数量：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input  disabled="disabled"style="border-width: 0" value="<?php echo $order['total_quantity'];?>" />
    </p>
  </div>
</div>
<hr>
<div class="info-custom">
  <div class="custom-inf-three">
    <p>报关口岸：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input  disabled="disabled"style="border-width: 0" value="<?php echo $order['customs_port'];?>" />
    </p>
  </div>
  <div class="custom-inf-three">
    <p>到达口岸：&nbsp&nbsp&nbsp
      <input disabled="disabled"style="border-width: 0" value="<?php echo $order['arrive_port'];?>"/>
    </p>
  </div>
  <div class="custom-inf-three">
    <p>总箱数：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input  disabled="disabled"style="border-width: 0" value="<?php echo $order['total_box'];?>" />
    </p>
  </div>
</div>
  <div class="info-custom">
    <div class="custom-inf-three">
      <p>总体积(cm<sup>3</sup>)：&nbsp&nbsp&nbsp&nbsp
        <input  disabled="disabled"style="border-width: 0" value="<?php echo $order['total_volume'];?>" />
      </p>
    </div>
  </div>
</div>

<div class="orange-label">
  <p class="label-title">已添加商品</p>
</div>

<div class="container-fluid" >
  <table id="table"  class="table" >
    <thead>
      <tr>
        <th></th>
        <th>封面</th>
        <th>产品名称</th>
        <th>毛重(kg)</th>
        <th>净重(kg)</th>
        <th>箱数</th>
        <th>单价(元)</th>
        <th>数量</th>
      </tr>
    </thead>
    <tbody style="background: #fff;"> 
      <?php $i = 1;foreach($orderGoods as $data) {?> 
      <tr id="sure-goods">
       <td><?php echo $i; ?></td>
       <td><a target="_Blank" href="<?php echo $img_source.$data['goods_image'];?>"><img width="60" height="40" src="<?php echo $img_source.$data['goods_image'];?>"></a></td>
       <td><?php echo $data['goods_name'];?></td>
       <td><?php echo $data['gross_weight'];?></td>
       <td><?php echo $data['net_weight'];?></td>
       <td><?php echo $data['box_number'];?></td>
       <td><?php echo $data['goods_price'];?></td>
       <td><?php echo $data['goods_num'];?></td>
     </tr>
     <?php $i++; } ?>
   </tbody>
 </table>
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
                          echo "自由资金";
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
                            echo "自由资金";
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

        

