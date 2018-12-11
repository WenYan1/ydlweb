<script>
    $(".order").css("border-left","6px solid #783390");
    $(".order").css("background","#222222");
</script>
        <?php 
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
<link rel="stylesheet" type="text/css" href="../css/order/order.css">
<title>订单详情-付款记录(不包含首付款)</title>
<div class="space-vertical add-title">
            <a href="">
                <p class="font-title-size default-blue spacing-left">订单管理</p>
            </a>
            <p class="font-title-size "> - 订单详情</p>
        </div>
        <div class="space-vertical">
            <p class="orange"></p>
            <p class="font-title-size font-color-default add-product-title">订单状态</p>
        </div>
        <div class="flowstep">
            <ol class="flowstep-5">
                <li>
                    <div>
                        <div class="step-name font-grey">下单审核</div>
                        <img src="../images/finished.jpg" alt="" class="examining-img">
                        <img src="../images/blue_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey">工厂生产</div>
                        <img src="../images/blue_line.jpg" alt="" class="blue-line">
                        <img src="../images/finished.jpg" alt="" class="finished"   >
                        <img src="../images/blue_line.jpg" alt="" class="blue-line">
                        <!-- <img src="../images/blue_line.jpg" alt=""> -->
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey ">质检装柜</div>
                        <img src="../images/blue_line.jpg" alt="" class="blue-line">
                        <img src="../images/finished.jpg" alt="" class="finished"   >
                        <img src="../images/blue_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name default-blue">到达口岸</div>
                        <img src="../images/blue_line.jpg" alt="" class="blue-line">
                        <img src="../images/being.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey">报关完成</div>
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey">收集单据</div>
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey">收汇</div>
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey">垫付税款</div>
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey">垫付采购款</div>
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
				  <li>
                    <div>
                        <div class="step-name font-grey">退税完成</div>
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
				  <li>
                    <div>
                        <div class="step-name font-grey">还本付息</div>
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <img src="../images/default_line.jpg" alt="" class="blue-line">
                    </div>
                </li>
                <li>
                    <div>
                        <div class="step-name font-grey">完成</div>
                        <img src="../images/default_line.jpg" alt="" class="last-img">
                        <img src="../images/not-beginning.jpg" alt="" class="finished"  >
                        <!-- <img src="../images/default_line.jpg" alt="" class="blue-line"> -->
                    </div>
                </li>

            </ol>
        </div>
         <div class="space-vertical">
            <p class="orange"></p>
            <p class="font-title-size font-color-default add-product-title">基本信息</p>
        </div>
        <div class="space-vertical base-message" style="height: 100px;">
    <div class="info-custom">
        <div class="custom-inf">
            <p class="font-content-size">供应商：</p>
            <p class="font-content-size">上海有限公司</p>
        </div>
        <div class="custom-inf">
            <p class="font-content-size">联系人：</p>
            <p class="font-content-size">张军</p>
           
        </div>
        <div class="custom-inf">
            <p class="font-content-size">联系电话：</p>
            <p class="font-content-size">13888888888</p>
        </div>
        <div class="custom-inf">
            <p class="font-content-size">邮箱：</p>
            <p class="font-content-size">test@test.com</p>
           
        </div>
    </div>
    <div class="info-custom">
        <div class="custom-inf">
            <p class="font-content-size">我&nbsp&nbsp&nbsp&nbsp方：</p>
            <p class="font-content-size">上海有限公司</p>
        </div>
        <div class="custom-inf">
            <p class="font-content-size">联系人：</p>
            <p class="font-content-size">Tom</p>
        </div>
        <div class="custom-inf">
            <p class="font-content-size">联系电话：</p>
            <p class="font-content-size">13777777777</p>
        </div>
        <div class="custom-inf">
            <p class="font-content-size">邮箱：</p>
            <p class="font-content-size">admon@admin.com</p>
        </div>
    </div>
</div>
        <div class="base-message space-vertical">
            <div class="one-of-third spacing-left">
                <div>
                    <p class="font-content-size font-grey">订单总金额(元)：</p>
                    <p class="font-content-size font-color-default">269，000，000.00</p>
                </div>
                <div>
                    <p class="font-content-size font-grey">总&nbsp&nbsp毛&nbsp&nbsp重&nbsp&nbsp(kg)：</p>
                    <p class="font-content-size font-color-default">130</p>
                </div>
                <div>
                    <p class="font-content-size font-grey">报&nbsp&nbsp关&nbsp&nbsp口&nbsp&nbsp岸&nbsp&nbsp&nbsp：</p>
                    <p class="font-content-size font-color-default" >天津港</p>
                </div>
            </div>
            <div class="two-of-third ">
                <div>
                    <p class="font-content-size font-grey">首&nbsp&nbsp&nbsp付&nbsp&nbsp&nbsp款&nbsp：</p>
                    <p class="font-content-size font-color-default">10，000.00</p>
                </div>
                <div>
                    <p class="font-content-size font-grey">境内货源地：</p>
                    <p class="font-content-size font-color-default">深圳市</p>
                </div>
                
                <div>
                    <p class="font-content-size font-grey">到&nbsp达&nbsp口&nbsp&nbsp岸：</p>
                    <p class="font-content-size font-color-default" >大连港</p>
                </div>
                
            </div>
            <div class="three-of-third " >
                <div>
                    <p class="font-content-size font-grey">总净重(kg)：</p>
                    <p class="font-content-size font-color-default">130</p>
                </div>
                <div>
                    <p class="font-content-size font-grey">总&nbsp&nbsp&nbsp数&nbsp&nbsp&nbsp量&nbsp：</p>
                    <p class="font-content-size font-color-default">30</p>
                </div>
                
                <div>
                     <p class="font-content-size font-grey">总&nbsp&nbsp&nbsp箱&nbsp&nbsp&nbsp数&nbsp：</p>
                    <p class="font-content-size font-color-default" >10</p>
                </div>
            </div>
            
           
        </div>
             <div class="space-vertical">
            <p class="orange"></p>
            <p class="font-title-size font-color-default add-product-title">已添加商品</p>
        </div>
    
       
        <div class="container-fluid " >
            <div class="row " >
                <div class="col-md-12 col-lg-12  " style="background-color: #F5F5F5;">
                    <div class="spacing-left">
                        <div class=" order-top order-margin-space spacing-left" style="margin-right: 150px;" >
                            <p class="order-item-1 font-content-size "></p>
                            <p class="order-item-2 font-content-size">封面</p>
                            <p class="order-item-3 font-content-size">产品名称</p>
                            <p class="order-item-4 font-content-size">毛重(kg)</p>
                            <p class="order-item-5 font-content-size">净重(kg)</p>
                            <p class="order-item-6 font-content-size">箱数</p>
                            <p class="order-item-7 font-content-size">单价(元)</p>
                            <p class="order-item-8 font-content-size">数量</p>
                            
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-12 col-lg-12 " >
                    <div class="spacing-left" style="height:400px;overflow-x:hidden;position: relative;border:1px solid #eee;margin-right: 150px;">
                        <div class="order-item order-margin-space ">
                            <p class="order-item-1 font-content-size">01</p>
                              <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>
                        <div class="order-item order-margin-space ">
                            <p class="order-item-1 font-content-size">01</p>
                            <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>
                        <div class="order-item order-margin-space ">
                            <p class="order-item-1 font-content-size">01</p>
                             <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>
                       <div class="order-item order-margin-space ">
                            <p class="order-item-1 font-content-size">01</p>
                              <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>
                        <div class="order-item order-margin-space">
                            <p class="order-item-1 font-content-size">01</p>
                             <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>
                       <div class="order-item order-margin-space ">
                            <p class="order-item-1 font-content-size">01</p>
                              <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>
                       <div class="order-item order-margin-space ">
                            <p class="order-item-1 font-content-size">01</p>
                             <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>

                        <div class="order-item order-margin-space ">
                            <p class="order-item-1 font-content-size">01</p>
                            <div style="display: inline-block;"class="order-item-2">
                                <img src="../images/email_verification.jpg" alt="图片" class="order-item-2 font-content-size" style="height: 40px;width: 60px">
                            </div>
                            <p class="order-item-3 font-content-size">某某某家具</p>
                            <p class="order-item-4 font-content-size">150</p>
                            <p class="order-item-5 font-content-size">150</p>
                            <p class="order-item-6 font-content-size" >10</p>
                            <p class="order-item-7 font-content-size">154,000.00</p>
                            <p class="order-item-8 font-content-size">2</p>
                        </div>                    </div>
                </div>
                    
            </div>

        </div> 
        <div >
            <div class="option_pay ">
                <p class="orange"></p>
                <p class="font-title-size font-color-default add-product-title">付款详情</p>
            </div>
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="">
                                <div  style="margin-top:20px ;background: #f5f5f5">
                                    <table id="table" class="table">
                                        <thead>
                                            <tr>
                                                <th>日期</th>
                                                <th>金额</th>
                                                <th>支付方式</th>
                                                <th>已支付(元)</th>
                                                <th>待支付(元)</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background: #fff;border: 1px solid #eee;">
                                            <tr style="height: 60px">
                                                <td>2016-02-02</td>
                                                <td>10，000.00</td>
                                                <td>信用额度</td>
                                                <td>10，000.00</td>
                                                <td>90，000，000.00</td>
                                            </tr>
                                            <tr style="height: 60px">
                                                <td>2016-02-02</td>
                                                <td>10，000.00</td>
                                                <td>信用额度</td>
                                                <td>10，000.00</td>
                                                <td>90，000，000.00</td>
                                            </tr>
                                             <tr style="height: 60px">
                                                <td>2016-02-02</td>
                                                <td>10，000.00</td>
                                                <td>信用额度</td>
                                                <td>10，000.00</td>
                                                <td>90，000，000.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            
        </div>
        <div class="bottom-div">
            <a href="">
                <p class="next default-background-blue">立即支付</p>
            </a>
            
        </div>
