        <script>
            $(".capital").css("border-left","6px solid #783390");
            $(".capital").css("background","#222222");
            $('.capital-detail').toggle();
        </script>
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
        <link rel="stylesheet" type="text/css" href="../css/order/order.css">
        <script type="text/javascript" src="../js/pay/pay_fp.js"></script>
        <title>支付首付款</title>

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
                 首付款
            </p>
            <div style="float:left;width:100%;background-color:#eeeeee;height:1px;"></div>
        </div>
        <div class="has-order-width">
            <div class="has-half-width">
                <div class="has-top spacing-left">
                    <p class="font-content-size font-grey">订单号：</p>
                    <p class="has-order-left font-content-size font-color-default"><?php echo $order['order_sn']; ?></p>
                </div>
                <div class="has-top spacing-left">
                    <p class="font-content-size font-grey">已支付(元)：</p>
                    <p class="has-pay-left font-content-size font-color-default"><?php echo $order['already_pay']; ?></p>
                </div>

            </div>
            <div class="has-half-width">
                <div class="has-top spacing-left">
                    <p class="font-content-size font-grey">订单总额(元)：</p>
                    <p class="has-all-order-left font-content-size font-color-default"><?php echo $order['invoice_amount']; ?></p>
                </div>
                <div class="has-top spacing-left">
                    <p class="font-content-size font-grey">待支付(元)：</p>
                    <p class="has-payed-left font-content-size font-color-default"><?php echo $order['invoice_amount'] - $order['already_pay']; ?></p>
                </div>
            </div>
            
       </div>
       <div class="has-order-width backgorund-color-f5">
            <div class="spacing-left option-first">
                <p class="font-title-size font-bold space-vertical">选择支付方式</p>
            </div>
            <div class="spacing-left">
                <input type="radio" name="pay_type" value="1" checked="true">
                <p class="font-content-size  ">可用资金支付</p>
            </div>
            <div class="spacing-left">
                 <p class="font-content-size">(将从自有资金中扣除使用信用额度支付金额的10%作为保证金，结汇时收取本单使用信用额度支付金额的3%作为服务费)</p>
            </div>
            <div class="space-vertical spacing-left option-third">
                <p style="display:inline;" class="font-content-size font-bold">支付金额(元):</p>
                <P style="display:inline;font-size:18px;font-weight:bold;"><?php echo $order['firstpayment_amount']; ?></P>
            </div>
            
            <form action="<?php echo Yii::$app->urlManager->createUrl(['order-pay/first-payment']);?>" method="post">
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <input style="display:none;" name="order_id" value="<?php echo $order['id']; ?>" >
                <input id="submit-real" style="display:none;" type="submit" value="Submit">
            </form>
       </div>
       <P class="submit-payinfo">确定支付</P>