
        <title>添加供应商</title>
        <script>
			$(".supplier").css("border-left","6px solid #4E99B8");
    		$(".supplier").css("background","#222222");
		</script>
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
        <link rel="stylesheet" type="text/css" href="../css/privider_manage/privider_about.css">
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
		<script type="text/javascript" src="../js/privider_manage/add_privider.js"></script>

        	<div style="border-bottom:1px solid #d8d8d8;">
        		<a href='<?php echo Yii::$app->urlManager->createUrl(['supplier']);?>' class="spacing-left privider-sapce-top">
        			<p class="font-title-size">供应商管理</p>
        		</a>
        		<p class="font-title-size privider-sapce-top"> - 添加供应商</p>
        		
        	</div>
			<div class="divider-padding2">
				<div class="divider"></div>
			</div>
			<form actoin=<?php echo Yii::$app->urlManager->createUrl(['add']); ?>
				enctype="multipart/form-data" method="post">
			<div class="container-fluid add-privider-form">
			
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>纳税人识别号 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="code" name="identify_number" value=""/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票公司名称 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="name" name="company_name" value=""/>
						<span style="color:#9e9e9e;">需为直接工厂，营业范围内有生产、加工、制造等字样</span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>一般纳税人认定时间 :</p>
					</div>
					<div class="col-md-7">
						<div class="time">
							<input class="input-padding" id="date" name="cognizance_time" type="text" >
							<span style="color:#9e9e9e;">一般纳税人认定时间需满一年</span>
						</div>
					</div>
				</div>	
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人财务联系人 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="link-men" name="finance_contacts" value=""/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人联系方式:</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="link-men-phone" name="tel" value=""/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人地址 :</p>
					</div>
					<div class="col-md-7">

						<select id="province_id" name="province_id">
							<?php 
								foreach($region as $x=>$x_value){
									if($x == 0){
													
							?>	
							<option selected="selected" value="<?php echo $x_value['region_id']; ?>"><?php echo $x_value['region_name']; ?></option>
							<?php 
									}else{
							?>
							<option value="<?php echo $x_value['region_id']; ?>"><?php echo $x_value['region_name']; ?></option>
							<?php		
									}
								} 
							?>
							
						</select>
						
						<input style="display:none;" type="text" id="province_hide" name="province" value=""/>
						
						
						<input style="display:none;" type="text" id="city_hide" name="city" value=""/>

						
						<input style="display:none;" type="text" id="county_hide" name="county" value=""/>
						
					</div>
					<div class="col-md-7 col-md-offset-5">
						<input type="text" id="detail-address" placeholder="添加详细地址" name="address" value=""/>
					</div>
					<div class="col-md-7 col-md-offset-5" style="margin-top:10px;">
						<span style="color:#9e9e9e;">开票人地址：即工厂地址，需和税务登记地址一致，如不一致，需提供证明材料</span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>境内货源地 :</p>
					</div>
					<div class="col-md-7">
						<span id="source" style="line-height:34px;color:#bdbdbd;"></span>
					</div>
					<input style="display:none;" type="text" id="source-hide" name="goods_source" value=""/>
				</div>
				<div class="row-fluid col-md-12 input-height">
					
					<div class="col-md-3 col-md-offset-2">
						<p>开票人增值税率 :</p>
					</div>
					
					<div class="col-md-7">
						<input class="input-padding" type="text" id="tax-rate" name="tax_rate" value=""/>%
						<span style="color:#9e9e9e;">需为一般纳税人,小规模纳税人不能操作</span>
					</div>
				</div>
				<div class="row-fluid col-md-12">
					<div class="col-md-3 col-md-offset-2">
						<p>出口权 :</p>
					</div>
					<div class="export-right">
						<p><label><input  name="export_right" type="radio" value="1" checked="checked"/>&nbsp&nbsp有&nbsp&nbsp</label>
						<label><input name="export_right" type="radio" value="0" />&nbsp&nbsp无</label></p>
					</div>
				</div>

			</div>
			<div class="container-fluid submit-img" style="background-color: #FAFAFA;">
                <div class="container-fluid submit-img" style="background-color: #FAFAFA;">
                    <div class="row-fluid col-md-12">
                        <div class="col-md-1" >
                            上传营业执照：
                        </div>
                        <div class="col-md-2" >
                            <img id = "business-license-btn" src="../images/upload_bg.png"/>
                            <input id="business-license-input" type="file" accept="image/*" name="business_license" />
                        </div>
                        <div class="col-md-1" >
                            上传一般纳税人认定书：
                        </div>
                        <div class="col-md-2" >
                            <img id = "tax-reg-btn" src="../images/upload_bg.png"/>
                            <input id="tax-reg-input" type="file" accept="image/*"  name="tax_registration"/>
                        </div>
                        <div class="col-md-1" >
                            上传以往开过的发票样本：
                        </div>
                        <div class="col-md-2" >
                            <img id="organization-code-btn" src="../images/upload_bg.png"/>
                            <input id="organization-code-input" type="file" accept="image/*" name="organization_code"/>
                        </div>
                        <div class="col-md-1" >
                            其他：
                        </div>
                        <div class="col-md-2" >
                            <img id="other_image-btn" src="../images/upload_bg.png"/>
                            <input id="other_image-input" type="file" accept="image/*" name="other_image"/>
                        </div>
                    </div>
                </div>
			</div>
			<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<input style="display:none;" id="sumbit-real" type="submit" value="Submit">
		</form>
		<div class="container-fluid" style="margin-top:50px;">
			<div class="row-fluid col-md-12">
				<p class="submit-btn">提交</p>
			</div>
		</div>

		<script>
	    	$('#date').datetimepicker({
	    		lang:'ch',
	    		format:'Y-m-d',
	    		timepicker:false,
	    	});
	  	</script>
		

