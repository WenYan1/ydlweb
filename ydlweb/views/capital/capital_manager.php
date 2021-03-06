        <meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
        <link rel="stylesheet" type="text/css" href="../css/capital/capital.css">
        <script type="text/javascript" src="../js/capital/capital_manager.js"></script>
        <title>资金管理</title>
         <script>
            $(".capital-manage").css("border-left","6px solid #783390");
            $(".capital-manage").css("background","#222222");
            $('.capital-detail').show();
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

        <div class="row-fluid title-div">
            <p class="spacing-left">资金管理</p>
        </div>
        <div class="background-grey content-width">
        	<div >
        		<p class="spacing-left content-item-width font-content-size capital-category-color space-vertical">可用资金：
                    <img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="可用资金： 由用户转账至平台，可以用于支付首付款\尾款\结汇\信保代采购保证金。">
                </p>
        		<p class="content-item-width font-content-size capital-category-color space-vertical">不可用资金：
                    <img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="不可用资金： 每次使用信保代采购需要支付使用额度的10%作为保证金，待结汇后返还至可用资金。">
                </p>
        		<p class="content-item-width font-content-size capital-category-color space-vertical">可用信用额度：
                    <img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="可用信用额度： 当前可用的信保代采购金额。">
                </p>
        		<p class="content-item-width font-content-size capital-category-color space-vertical">总信用额度：
                    <img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="总信用额度： 贵公司帐号当前的信保代采购金额。">
                </p>
        	</div>

        	<div class="space-vertical content-width">
        		<div class="spacing-left capital-width">
        			<p class="available-capital"><?php echo $user['user_capital']; ?></p>
	        		<p class="font-content-size">元</p>
                    <p style="float:right;margin-right:40px;" class="vertical-line">|</p>
        		</div>
        		<div class="capital-width">
        			<p style="margin-left:12px;" class="useless-captial"><?php echo $user['bond']; ?></p>
	        		<p class="font-content-size">元</p>
                    <p style="float:right;margin-right:40px;" class="vertical-line">|</p>
        		</div>
        		<div class=" capital-width">
        			<p style="margin-left:12px;" class="available-credit"><?php echo $user['credi_limit']; ?></p>
	        		<p class="font-content-size">元</p>
                    <p style="float:right;margin-right:40px;" class="vertical-line">|</p>
        		</div>
        		<div class=" capital-width">
        			<p style="margin-left:12px;" class="total-credit"><?php echo $user['total_creditlimit']; ?></p>
	        		<p class="font-content-size">元</p>
        		</div>
        	</div>
        	<a href="<?php echo Yii::$app->urlManager->createUrl(['/capital/recharge']); ?>">
        		<p class="default-background-blue font-content-size recharge spacing-left">收汇</p>
        	</a>

        </div>
        <div class="row-fluid col-md-12" >
            <div class="orange-label">
                <p class="label-title">资金结算</p>
            </div>
        </div>
        <form action="<?php echo Yii::$app->urlManager->createUrl(['capital']);?>" id="myform" method="get">
        <div class="privider-select">
        	<?php
if ($filter == 1) {
	?>
            <p id="state-pay" style="margin-left:24px;" class="font-content-size default-blue under-line" >付款</p>
            <p id="state-of" style="margin-left:96px;" class="font-content-size font-color-default" >额度管理</p>
			<p id="state-st" style="margin-left:96px;" class="font-content-size font-color-default">结算记录</p>
			<!--<p id="state-dr" style="margin-left:96px;" class="font-content-size font-color-default">其他</p>-->
			
		
          
            <?php } else if ($filter == 3) {?>
            <p id="state-pay" style="margin-left:24px;" class="font-content-size font-color-default" >付款</p>
            <p id="state-of" style="margin-left:96px;" class="font-content-size default-blue under-line " >额度管理</p>
			<p id="state-st" style="margin-left:96px;" class="font-content-size font-color-default" >结算记录</p>
			<!--<p id="state-dr" style="margin-left:96px;" class="font-content-size font-color-default">其他</p>-->
			
			

              <?php } else if ($filter == 5) {?>
            <p id="state-pay" style="margin-left:24px;" class="font-content-size font-color-default" >付款</p>
            <p id="state-of" style="margin-left:96px;" class="font-content-size font-color-default" >额度管理</p>
			<p id="state-st" style="margin-left:96px;" class="font-content-size default-blue under-line" >结算记录</p>
			<!--<p id="state-dr" style="margin-left:96px;" class="font-content-size font-color-default">其他</p>-->
			
			
           
           
			
			
            <?php }?>

            <p style="margin:0 48px;" class="vertical-line-width vertical-line-color">|</p>
            <input id="key" name="search"  type="text" placeholder="请输入供应商名称" class="privider_query input-padding" value="<?php if ($search === null) {} else {echo $search;}?>">
            <div class="button_query" onclick="$('#myform').submit();">
                <img src="../images/search.jpg" alt="搜索"><span>搜索</span>
            </div>
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

        </div>
        </form>

            <?php
if ($filter == 1) {
	?>
                <table class="table-show">
                    <thead>
                      <tr>
						<th class="number" style="width:4%">序号</th>
                        <th class="capital-manager-1 ">订单号</th>
                        <th class="capital-manager-2">开票金额(元)</th>
                        <th class="capital-manager-3">供应商</th>
                        <th class="capital-manager-4">付款时间</th>
                        <th class="capital-manager-5">状态</th>
                        <th class="capital-manager-6">已付款(元)</th>
                        <th class="capital-manager-7">待付款(元)</th>
                        <th class="capital-manager-8">操作</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php   $i = 1; foreach ($models as $key => $value) {
		$state_info = '';
		$state_code = $value['order_state'];
		if ($state_code == '0') {
			$state_info = '待审核';
		} else if ($state_code == '2') {
			$state_info = '已审核';
		} else if ($state_code == '3') {
			$state_info = '工厂生产';
		} else if ($state_code == '4') {
			$state_info = '生产完成';
		} else if ($state_code == '5') {
			$state_info = '发运';
		} else if ($state_code == '6') {
			$state_info = '报关';
		} else if ($state_code == '7') {
			$state_info = '发票';
		} else if ($state_code == '8') {
			$state_info = '退税';
		} else if ($state_code == '9') {
			$state_info = '结汇';
		} else {
			$state_info = '完成';
		}
		?>
                        <tr>
							<td class="number " style="width:4%"><?php echo ($page - 1) * 10 + $i; ?></td>
                            <td class="capital-manager-1"><?php echo $value['order_sn']; ?></td>
                            <td class="capital-manager-2"><?php echo $value['invoice_amount']; ?></td>
                            <td class="capital-manager-3"><?php echo $value['supplier_name']; ?></td>
                            <td class="capital-manager-4"><?php echo $value['recharge_time']; ?></td>
                            <td class="capital-manager-5"><?php echo $state_info; ?></td>
                            <td class="capital-manager-6"><?php echo $value['already_pay']; ?></td>
                            <td class="capital-manager-7"><?php echo $value['invoice_amount'] - $value['already_pay']; ?></td>
                            <td class="capital-manager-8">
                                <?php if ($value['down_payment'] == 0) {?>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['order-pay/balance-payment', 'order_id' => $value['id']]); ?>"><?php echo "付款"; ?></a>
                                <?php } else if ($value['down_payment'] == 1 && $value['is_pay'] == 0) {?>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['order-pay/first-payment', 'order_id' => $value['id']]); ?>"><?php echo "付首付款"; ?></a>
                                <?php } else if ($value['down_payment'] == 1 && $value['is_pay'] == 1) {?>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['order-pay/balance-payment', 'order_id' => $value['id']]); ?>"><?php echo "付款"; ?></a>
                                <?php }?>
                            </td>
                          </tr>
                        <?php   $i ++;}?>
                 </tbody>
                </table>
            <?php } else if ($filter == 2) {
	?>

                <table >
                    <thead>

                      <tr>
                        <th class="exchange-1">订单号</th>
                        <th class="exchange-2">开票金额(元)</th>
                        <th class="exchange-3">供应商</th>
                        <th class="exchange-4">创建时间</th>
                        <th class="exchange-5">状态</th>
                        <th class="exchange-6">结汇金额(元)</th>
                        <th class="exchange-7">操作</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ($models as $key => $value) {
                    		$state_info = '';
                    		$state_code = $value['order_state'];
                    		if ($state_code == '0') {
                    			$state_info = '待审核';
                    		} else if ($state_code == '2') {
                    			$state_info = '已审核';
                    		} else if ($state_code == '3') {
                    			$state_info = '工厂生产';
                    		} else if ($state_code == '4') {
                    			$state_info = '生产完成';
                    		} else if ($state_code == '5') {
                    			$state_info = '发运';
                    		} else if ($state_code == '6') {
                    			$state_info = '报关';
                    		} else if ($state_code == '7') {
                    			$state_info = '发票';
                    		} else if ($state_code == '8') {
                    			$state_info = '退税';
                    		} else if ($state_code == '9') {
                    			$state_info = '结汇';
                    		} else {
                    			$state_info = '完成';
                    		}
                    	?>
                      <tr>
                        <td class="exchange-1"><?php echo $value['order_sn']; ?></td>
                        <td class="exchange-2"><?php echo $value['invoice_amount']; ?></td>
                        <td class="exchange-3"><?php echo $value['supplier_name']; ?></td>
                        <td class="exchange-4"><?php echo date("Y-m-d", $value['created_at']); ?></td>
                        <td class="exchange-5"><?php echo $state_info; ?></td>
                        <td class="exchange-6"><?php echo $value['settlement_money']; ?></td>
                        <td class="exchange-7"><a href="<?php echo Yii::$app->urlManager->createUrl(['order-pay/settlement', 'order_id' => $value['id']]); ?>">结汇</a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                </table>

            <?php } else if ($filter == 3) {
	?>
                <table id="a">
                    <thead>
                      <tr>
						<th class="number " style="width:4%">序号</th>
                        <th class="overdue-1">订单号</th>
                        <th class="overdue-2">开票金额(元)</th>
                        <th class="overdue-3">供应商</th>
						<th class="overdue-4">额度使用金额</th>
						<th class="overdue-5">开始时间</th>
						<th class="overdue-6">到期时间</th>
						<th class="overdue-7">退税手续费</th>
						<th class="overdue-8" style="display:none;">预计利息</th>
						<th class="overdue-9">预计总还款</th>
                        <th class="overdue-10">操作</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($models as $key => $value) {
                    		$state_info = '';
                    		$state_code = $value['order_state'];
                    		if ($state_code == '0') {
                    			$state_info = '待审核';
                    		} else if ($state_code == '2') {
                    			$state_info = '已审核';
                    		} else if ($state_code == '3') {
                    			$state_info = '工厂生产';
                    		} else if ($state_code == '4') {
                    			$state_info = '生产完成';
                    		} else if ($state_code == '5') {
                    			$state_info = '发运';
                    		} else if ($state_code == '6') {
                    			$state_info = '报关';
                    		} else if ($state_code == '7') {
                    			$state_info = '发票';
                    		} else if ($state_code == '8') {
                    			$state_info = '退税';
                    		} else if ($state_code == '9') {
                    			$state_info = '结汇';
                    		} else {
                    			$state_info = '完成';
                    		}
                    	?>
                      <tr>
						<td class="number " style="width:4%"><?php echo ($page - 1) * 10 + $i; ?></td>
                        <td class="overdue-1"><?php echo $value['order_sn']; ?></td>
                        <td class="overdue-2"><?php echo $value['invoice_amount']; ?></td>
                        <td class="overdue-3"><?php echo $value['supplier_name']; ?></td>
                        <td class="overdue-4"><?php echo $value['credit_insurance']; ?></td>
                        <td class="overdue-5"><?php echo $value['recharge_time']; ?></td>
                        <td class="overdue-6"><?php 
							if($value['advance_days'] == 1){
								echo date("Y-m-d", strtotime("+90 days", strtotime($value['recharge_time']))); 
							}else if($value['advance_days'] == 2){
								echo date("Y-m-d", strtotime("+120 days", strtotime($value['recharge_time']))); 
							}else{
								echo '';
							}
							
							?></td>
                        <td class="overdue-7"><?php echo $value['estimated_cost']; ?></td>
						<td class="overdue-8" style="display:none;"><?php echo $value['estimated_interest']; ?></td>
                        <td class="overdue-9"></td>
                        <td class="overdue-10"><a href="<?php echo Yii::$app->urlManager->createUrl(['order-pay/repayment', 'order_id' => $value['id']]); ?>">还款</a></td>
                      </tr>
                      <?php  $i++;}?>
                    </tbody>
              </table>
            <?php } else if($filter == 4){
	?>
                <table   >
                    <thead>
                      <tr>
                        <th class="duty_rate-1">订单号</th>
                        <th class="duty_rate-2">开票金额(元)</th>
                        <th class="duty_rate-3">供应商</th>
                        <th class="duty_rate-4">创建时间</th>
                        <th class="duty_rate-5">状态</th>
                        <th class="duty_rate-6">退税(元)</th>
                        <th class="duty_rate-7">退税时间</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($models as $key => $value) {
                    		$state_info = '';
                    		$state_code = $value['order_state'];
                    		if ($state_code == '0') {
                    			$state_info = '待审核';
                    		} else if ($state_code == '2') {
                    			$state_info = '已审核';
                    		} else if ($state_code == '3') {
                    			$state_info = '工厂生产';
                    		} else if ($state_code == '4') {
                    			$state_info = '生产完成';
                    		} else if ($state_code == '5') {
                    			$state_info = '发运';
                    		} else if ($state_code == '6') {
                    			$state_info = '报关';
                    		} else if ($state_code == '7') {
                    			$state_info = '发票';
                    		} else if ($state_code == '8') {
                    			$state_info = '退税';
                    		} else if ($state_code == '9') {
                    			$state_info = '结汇';
                    		} else {
                    			$state_info = '完成';
                    		}
                		?>
                      <tr>
                        <td class="duty_rate-1"><?php echo $value['order_sn']; ?></td>
                        <td class="duty_rate-2"><?php echo $value['invoice_amount']; ?></td>
                        <td class="duty_rate-3"><?php echo $value['supplier_name']; ?></td>
                        <td class="duty_rate-4"><?php echo date("Y-m-d", $value['created_at']); ?></td>
                        <td class="duty_rate-5"><?php echo $state_info; ?></td>
                        <td class="duty_rate-6"><?php echo $value['drawback_money']; ?></td>
                        <td class="duty_rate-7">dy记得加字段</td>
                      </tr>
                      <?php }?>
                    </tbody>
                </table>
            <?php }else{?>

             <table >
            <thead>
              <tr>
				<th class="number " style="width:4%">序号</th>
				<th class="balance-2">订单号</th>
                <th class="balance-3">流水单号</th>
                <th class="balance-4">金额</th>
                <th class="balance-5">资金类型</th>
                <th class="balance-6">资金说明</th>
                <th class="balance-7">时间</th>
              </tr>
              
            </thead>
            <tbody>
            
         
              <tr>
				<td class="number " style="width:4%"></td>
                <td class="balance-2"></td>
                <td class="balance-3"></td>
                <td class="balance-4"></td>
                <td class="balance-5"></td>
                <td class="balance-6"></td>
				<td class="balance-7"></td>
              </tr>
         
            </tbody>
          </table>
        <?php } ?>

           <?php
                if(count($models) == 0){
            ?>
            <div class="null-full container-fluid col-md-12">
                <img height="20" width="20" src="../images/null_hint.png">
                <span style="margin-left:5px;color:#666666;line-height:20px;">暂无数据</span>
            </div>
            <?php
                }
            ?>

          <nav class="page-number">
              <ul class="pagination">
                <?php use yii\widgets\LinkPager;?>
                <?php
echo LinkPager::widget([
	'pagination' => $pages,
	'firstPageLabel' => "首页",
	'prevPageLabel' => '上一页',
	'nextPageLabel' => '下一页',
	'lastPageLabel' => '尾页',
]);
?>
              </ul>
            </nav>
            <form id="form-filter" action="<?php echo Yii::$app->urlManager->createUrl(['capital']); ?>" method="get">
                <input id="submit-btn" type="submit" value="Submit"/>
            </form>
