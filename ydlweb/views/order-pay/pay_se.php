        <script>
            $(".capital").css("border-left","6px solid #783390");
            $(".capital").css("background","#222222");
            $('.capital-detail').toggle();
        </script>
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
        <link rel="stylesheet" type="text/css" href="../css/order/order.css">
        <script type="text/javascript" src="../js/pay/pay_se.js"></script>
        <title>支付-结汇</title>
        <?php 
            $img_source = "http://107.170.254.164/uploads/";
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
        <div style="width:100%;float:left;padding-top:18px;">
            <!-- <p class="font-title-size spacing-left">
                <a href="" class="default-blue">订单管理</a> - 
            </p>
            <p class="font-title-size">
                <a href="" class="default-blue">订单详情</a> - 
            </p> -->
            <p class="font-title-size font-bold spacing-left">
               结汇
            </p>
            <div style="float:left;width:100%;background-color:#eeeeee;height:1px;"></div>
        </div>
        
        <div style="width:100%;float:left;">
            <p class="orange font-content-size"></p>
            <p style="font-weight:bold;" class="font-title-size font-color-default add-product-title">基本信息</p>
        </div>
        <div>
            <div class="paying-left"><p class="spacing-left">订单号:</p></div>
            <div class="paying-right"><p><?php echo $order['order_sn']; ?></p></div>
            <div class="paying-left"><p class="spacing-left">结汇周期:</p></div>
            <div class="paying-right"><p><?php echo $order['settlement_cycle']; ?></p></div
            <div class="paying-left"><p class="spacing-left">订单总金额(元):</p></div>
            <div class="paying-right"><p><?php echo $order['customs_money']; ?></p></div>
            <div class="paying-left"><p class="spacing-left">开票金额(元):</p></div>
            <div class="paying-right"><p><?php echo $order['customs_money']; ?></p></div>
            <div class="paying-left"><p class="spacing-left">待支付金额(元):</p></div>
            <div class="paying-right"><p><?php echo $order['customs_money'] - $order['already_pay']; ?></p></div>
            <div class="paying-left"><p class="spacing-left">退税(元):</p></div>
            <div class="paying-right"><p><?php echo $order['drawback_money']; ?></p></div>
            <div class="paying-left"><p class="spacing-left">保证金(元):</p></div>
            <div class="paying-right"><p><?php echo $order['bond']; ?></p></div>
            <div class=" spacing-left">
                 <p style="color:#999999;" class="font-content-size  ">(订单完成48小时后，系统会将保证金退回到您的可用资金，可在资金管理查看流水)</p>
            </div>
          
        </div>
        <div style="padding-top:24px;width:100%;float:left;">
            <p class="orange font-content-size"></p>
            <p style="font-weight:bold;" class="font-title-size font-color-default add-product-title">服务费用</p>
        </div>
        <div style="width:100%;float:left;">
            <div class="paying-left"><p class="spacing-left">境外中转手续费(元):</p></div>
            <div class="paying-right"><p><?php echo $order['transfer_fee']; ?></p></div>
            <div class="paying-left"><p class="spacing-left">信保代采购服务费(元):</p></div>
            <div class="paying-right"><p><?php echo $serviceCharge; ?></p></div>
            <div class="paying-left"><p class="spacing-left">逾期费用(元):</p></div>
            <div class="paying-right"><p><?php echo $lateFee; ?></p></div>
        </div>
        <div style="padding-top:24px;width:100%;float:left;">
            <p class="orange font-content-size"></p>
            <p style="font-weight:bold;" class="font-title-size font-color-default add-product-title">历史支付</p>
        </div>
        <div style="width:100%;float:left;">
            <div class="paying-left"><p class="spacing-left">首付款(元):</p></div>
            <div class="paying-right"><p><?php if($order['is_pay'] == 1){echo $order['firstpayment_amount'];}else{echo "0";} ?></p></div>
            <div class="paying-left"><p class="spacing-left">自有资金支付(元):</p></div>
            <div class="paying-right"><p><?php echo $order['already_pay']-$order['credit_insurance']; ?></p></div>
            <div class="paying-left"><p class="spacing-left">信保代采购支付(元):</p></div>
            <div class="paying-right"><p><?php echo $order['credit_insurance']; ?></p></div>
        </div>
        <div style="padding-top:24px;width:100%;float:left;background-color:#f5f5f5;">
            <p style="font-weight:bold;margin-left:24px;" class="font-title-size font-color-default add-product-title">结汇金额</p></br>
            <p class="spacing-left font-title-size font-color-default">共计：</p></br>
            <p style="color:#fd8b13;" class="spacing-left font-title-size"><?php echo $amountSettled; ?></p></br>
            <p style="font-size:15px;" class="spacing-left">(开票金额-出口退税款-已付资金+信保代采购本金+信保代采购服务费+境外中转手续费)</p>
        </div>
        <form action="<?php echo Yii::$app->urlManager->createUrl(['order-pay/settlement']);?>" method="post">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <input type="hidden" name="order_id" value="<?php echo $order['id'] ?>">
            <input id="submit-real" style="display:none;" type="submit" value="Submit">

        </form>
        <p class="submit-payinfo">确定支付</p>
  
        