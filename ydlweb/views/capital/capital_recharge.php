        <title>资金充值</title>
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
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
        <link rel="stylesheet" type="text/css" href="../css/capital/capital.css">  
        <link rel="stylesheet" type="text/css" href="../css/public/jquery.datetimepicker.css"/ >  
        <script type="text/javascript" src="../js/capital/capital_recharge.js"></script>
        <script type="text/javascript" src="../public/jquery.datetimepicker.js"></script>
        

        <div class="background-white">
        	<a href='<?php echo Yii::$app->urlManager->createUrl(['capital']); ?>'>
        		<p class="font-title-size space-vertical spacing-left default-blue">资金管理</p>
        	</a>
        	<p class="font-title-size space-vertical font-color-default"> - 资金充值</p>
        </div>
        <div class="row-fluid col-md-12" >
            <div class="orange-label">
                <p class="label-title">平台汇款账号</p>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row" style="min-width: 1100px">
                <div class="col-md-12 col-lg-12">
                    <div class="">
                        <div class="space-top-bottom ">
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;padding-right: 5px;">币种：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">美元 (USD)</span>
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;padding-right: 5px;">币种：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">人民币 (RMB)</span>
                                </div>
                            </div>
                            <hr/>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;padding-right: 5px;">公司名稱：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">騰邦跨境商業服務有限公司</span>
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;padding-right: 5px;">开户行：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">上海浦东发展银行天津分行</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right; padding-right: 5px;">公司地址：</p>
                                    <span class=" col-md-4" style="padding-left: 9px;">香港德輔道西410號太平洋廣場26樓</span>
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right; padding-right: 5px;">开户名：</p>
                                    <span class=" col-md-4" style="padding-left: 9px;">天津腾邦易贸通外贸服务有限公司</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right; padding-right: 5px;">銀行帳號：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">368-114589-18</span>
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right; padding-right: 5px;">账号：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">77010078801000000961</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">開戶銀行名稱：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">香港渣打銀行</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">開戶銀行地址：</p>
                                    <span class=" col-md-4" style="padding-left: 9px;">中環德輔道中4-4號A</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">聯行號(SWIFT CODE)：</p>
                                    <span class="col-md-4" style="padding-left: 9px;">SCBLHKHHXXX</span>
                                </div>
                            </div>
                            <hr/>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;padding-right: 5px;">Correspondent Bank:</p>
                                    <span class="col-md-4" style="padding-left: 9px;">Standard Chartered Bank New York</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">Address:</p>
                                    <span class=" col-md-4" style="padding-left: 9px;">1 Evertrust Plaza, Suite 1101, Jersey City, New Jersey 07302, USA</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">Swift No.:</p>
                                    <span class="col-md-4" style="padding-left: 9px;">SCBLUS33XXX</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">Beneficiary Name:</p>
                                    <span class="col-md-4" style="padding-left: 9px;">Tempus Cross-border Commercial Service Limited</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">Beneficiary Address:</p>
                                    <span class=" col-md-4" style="padding-left: 9px;">26/F., Pacific Plaza, 410 Des Voeux Road West, Hong Kong</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">Account No.:</p>
                                    <span class="col-md-4" style="padding-left: 9px;">368-114589-18</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">Beneficiary Bank Name:</p>
                                    <span class="col-md-4" style="padding-left: 9px;">Standard Chartered Bank (Hong Kong) Ltd</span>
                                </div>
                            </div>
                            <div class="recharge-row">
                                <div class="row">
                                    <p class="font-content-size font-color-default space-recharge-left col-md-2" style="text-align: right;
                                        padding-right: 5px;">Bank Address:</p>
                                    <span class="col-md-4" style="padding-left: 9px;">15/F Standard Chartered Tower, 388 Kwun Tong Road, Kwun Tong, KLN, Hong Kong
SWIFT CODE:SCBLHKHHXXX</span>
                                </div>
                            </div>
                        </div>
                        </div>
                       
                </div>
            </div>
        </div>
         <div class="row-fluid col-md-12" >
            <div class="orange-label">
                <p class="label-title">填写充值信息</p>
            </div>
        </div>
        <div class="container-fluid ">
        	<div class="row">
        		<div class="col-md-8 col-lg-8 col-md-offset-2 ">
        			<form action="<?php echo Yii::$app->urlManager->createUrl(['/capital/recharge']);?>" method="post">
        				<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                                        <div class="">
        					<div class="space-top-bottom recharge-div">
        						<div class="recharge-row">
        							<p class="font-content-size font-color-default recharge-p space-recharge-left">付款人账户名：</p>
        							<input type="text" id="account_name" required="required" name="account_name" class="spacing-left recharge-to-input">
        						</div>
        						<div class="recharge-row">
        							<p class="font-content-size font-color-default recharge-p space-recharge-left">银行名称：</p>
        							<input type="text" id="bank_name" required="required" name="bank_name" class="spacing-left recharge-to-input">
        						</div>
        						<div class="recharge-row">
        							<p class="font-content-size font-color-default recharge-p space-recharge-left">银行账号：</p>
        							<input type="text" id="bank_account" required="required" name="bank_account" class="spacing-left recharge-to-input">
        						</div>
        						<div class="recharge-row">
        							<p class="font-content-size font-color-default recharge-p">充值金额(元)：</p>
        							<input type="text" id="recharge_amount" required="required" name="recharge_amount" class="spacing-left recharge-to-input">
        						</div>
								<div class="recharge-row">
        							<p class="font-content-size font-color-default recharge-p">币种：</p>
        							<input type="text" id="recharge_currency" required="required" name="recharge_currency" class="spacing-left recharge-to-input">
        						</div>
        						<div class="recharge-row">
        							<p class="font-content-size font-color-default recharge-p space-recharge-left">充值日期：</p>
        							<input type="text" id="recharge_time" name="recharge_time" class="spacing-left recharge-to-input">
        						</div>
        					</div>
        				</div>
        				<div id="submit-btn" style="text-align: center;">
        				    <p id="btn-submit" class="submit">提交</p>
        				</div>
        				<input style="display:none;" id="submit-real" type="submit" value="Submit"/>
        			</form>
        		</div>
        	</div>
        </div>
         <script>
                $('#recharge_time').datetimepicker({
                    lang:'ch',
                    format:'Y-m-d',
                    timepicker:false,
                });
        </script>

