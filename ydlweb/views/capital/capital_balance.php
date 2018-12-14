        <script>
            $(".capital-balance").css("border-left","6px solid #783390");
            $(".capital-balance").css("background","#222222");
            $('.capital-detail').show();
        </script>
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
        <title>资金流水</title>
        <link rel="stylesheet" type="text/css" href="../css/capital/capital.css">   
        <link rel="stylesheet" type="text/css" href="../css/public/jquery.datetimepicker.css"/ >  

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

        <script type="text/javascript" src="../public/jquery.datetimepicker.js"></script>
        <script type="text/javascript" src="../js/capital/capital_balance.js"></script>

        <div class="background-white">
            <p class="font-title-size space-vertical spacing-left" style="font-weight:bold;">资金流水</p>
        </div>
        <div class="background-grey content-width">
        	<div >
        		<p class="spacing-left content-item-width font-content-size capital-category-color space-vertical">结算流水：
                    <img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="结算流水： 由用户转账至平台，可以用于支付首付款\尾款\结汇记录\信保代采购保证金。">
                </p>
                <p class=" content-item-width font-content-size capital-category-color space-vertical">保证金：
                    <img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="不结算流水： 每次使用信保代采购需要支付使用额度的10%作为保证金，待结汇记录后返还至结算流水。">
                </p>
                <p class=" content-item-width font-content-size capital-category-color space-vertical">可用信用额度：
                    <img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="可用信用额度： 当前可用的信保代采购金额。">
                </p>
                <p class=" content-item-width font-content-size capital-category-color space-vertical">总信用额度：
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
        		<p class="default-background-blue font-content-size recharge spacing-left">充值</p>
        	</a>

        </div>
        <div class="row-fluid col-md-12" >
            <div class="orange-label">
                 <p class="label-title">流水资金</p>
            </div>
        </div>
        <div class="privider-select">
            <p id="type-val" style="display:none"><?php echo $type; ?></p>
            <?php
                if($type == '1'){
            ?>
					<div id="type-3" class="table-select select-false">
                        <p>充值流水</p>
                    </div>
					<div id="type-4" class="table-select select-false">
                        <p>结汇记录</p>
                    </div>
                    <div id="type-1" class="table-select select-true">
                        <p>结算流水</p>
                    </div>
                    <div id="type-2" class="table-select select-false">
                        <p>信用额度</p>
                    </div>
                   
            <?php
                }else if($type == '2'){
            ?>
					<div id="type-3" class="table-select select-false">
                        <p>充值流水</p>
                    </div>
						<div id="type-4" class="table-select select-false">
                        <p>结汇记录</p>
                    </div>
                    <div id="type-1" class="table-select select-false">
                        <p>结算流水</p>
                    </div>
                    <div id="type-2" class="table-select select-true">
                        <p>信用额度</p>
                    </div>
			 <?php
                }else if($type == '3'){
            ?>
					<div id="type-3" class="table-select select-true">
                        <p>充值流水</p>
                    </div>
					<div id="type-4" class="table-select select-false">
                        <p>结汇记录</p>
                    </div>
                    <div id="type-1" class="table-select select-false">
                        <p>结算流水</p>
                    </div>
                    <div id="type-2" class="table-select select-false">
                        <p>信用额度</p>
                    </div>
                  
            <?php
                }else{
            ?>
					<div id="type-3" class="table-select select-false">
                        <p>充值流水</p>
                    </div>
						<div id="type-4" class="table-select select-true">
                        <p>结汇记录</p>
                    </div>
                    <div id="type-1" class="table-select select-false">
                        <p>结算流水</p>
                    </div>
                    <div id="type-2" class="table-select select-false">
                        <p>信用额度</p>
                    </div>
                    
            <?php
                }
            ?>

            <div class="button_fileter">
                <p>筛选</p>
            </div>
            
            <div class="time-quantum">
                <p class="font-content-size">起止时间：</p>
                <input id="start_time" type="text"/>
                <p class="font-content-size">-</p>
                <input id="end_time" type="text"/>
                
            </div>  
        </div>
        <?php
            if($type == '3'){
        ?>
             <table >
            <thead>
              <tr>
                <th>金额</th>
				<th>币种</th>
                <th>转账银行</th>
                <th>银行账号</th>
                <th>时间</th>
                <th>申请结汇</th>
              </tr>
            </thead>
            <tbody>
            <?php
                foreach ($models as $key => $value) {
            ?>
              <tr>
                <td><?php echo $value['recharge_amount']; ?></td>
				<td></td> 
                <td><?php echo $value['bank_name'] ?></td> 
                <td><?php echo $value['bank_account']; ?></td>
                <td><?php echo date("Y-m-d", $value['created_at']); ?></td>
                <td>
                    <?php 
                        if($value['state'] == 0){
                            echo "未审核";
                        }else if($value['state'] == 1){
                            echo "通过审核";
                        }else{
                            echo "未通过审核";
                        }
                    ?>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
		  <?php
            }else if($type == '4'){
        ?>
             <table>
            <thead>
              <tr>
                <th>金额</th>
                <th>币种</th>
                <th>结汇汇率</th>
                <th>结汇后人民币金额</th>
                <th>关联订单</th>
              </tr>
            </thead>
            <tbody>
			
              <tr>
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
                <td>
                </td>
              </tr>
         
            </tbody>
          </table>
        <?php
            }else{
        ?>
             <table >
            <thead>
              <tr>
                <th class="balance-1">流水单号</th>
                <th class="balance-2">金额</th>
                <th class="balance-3">资金类型</th>
                <th class="balance-4">资金说明</th>
                <th class="balance-5">时间</th>
              </tr>
              
            </thead>
            <tbody>
            
            <?php
                foreach ($models as $key => $value) {
            ?>
              <tr>
                <td class="balance-1"><?php echo $value['flow_sn']; ?></td>
                <td class="balance-2"><?php echo $value['capital_symbol'].$value['capital']; ?></td>
                <td class="balance-3">
                    <?php 
                        if($value['capital_type'] == 1){
                            echo "自有资金";
                        }else if($value['capital_type'] == 2){
                            echo "信用额度";
                        }else{
                            echo "保证金";
                        }
                    ?>
                </td>
                <td class="balance-4"><?php echo $value['capital_explain']; ?></td>
                <td class="balance-5"><?php echo date("Y-m-d", $value['created_at']); ?></td>
              </tr>
            <?php } ?>
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
                        'firstPageLabel'=>"首页",
                        'prevPageLabel'=>'上一页',
                        'nextPageLabel'=>'下一页',
                        'lastPageLabel'=>'尾页',
                    ]);
                ?>
              </ul>
            </nav>
            <form id="form-filter" action="<?php echo Yii::$app->urlManager->createUrl(['capital/capital-logs']);?>" method="get">
                <input id="submit-btn" type="submit" value="Submit"/>
            </form>
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
