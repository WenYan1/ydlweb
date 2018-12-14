
        <title>编辑供应商</title>
        <script>
			$(".supplier").css("border-left","6px solid #4E99B8");
    		$(".supplier").css("background","#222222");
		</script>
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
        <link rel="stylesheet" type="text/css" href="../css/privider_manage/privider_about.css">
        <link rel="stylesheet" type="text/css" href="../css/public/jquery.datetimepicker.css"/ >
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
		<script type="text/javascript" src="../public/jquery.datetimepicker.js"></script>
		<script type="text/javascript" src="../js/privider_manage/add_privider.js"></script>
        	<div style="border-bottom:1px solid #d8d8d8;">
        		<a href='<?php echo Yii::$app->urlManager->createUrl(['supplier']);?>' class="spacing-left privider-sapce-top">
        			<p class="font-title-size">供应商管理</p>
        		</a>
        		<p class="font-title-size privider-sapce-top"> - 编辑供应商</p>
        		
        	</div>
			<div class="divider-padding2">
				<div class="divider"></div>
			</div>
			<form actoin=<?php echo Yii::$app->urlManager->createUrl(['edit']); ?>
				enctype="multipart/form-data" method="post">

			<div class="container-fluid add-privider-form">
				<?php if($supplier['supplier_state']==-1 && (!empty($supplier['business_license_remark']) || !empty($supplier['tax_registration_remark']) || !empty($supplier['organization_code_remark']) || !empty($supplier['other_image_remark']))){ ?>
                    <div class="alert alert-warning" role="alert">
                        <strong>未通过原因!</strong> <br>
						<?php if (!empty($supplier['business_license_remark'])){ ?>
                            <strong>营业执照:</strong> <?php echo $supplier['business_license_remark'];?><br>
						<?php } ?>
						<?php if (!empty($supplier['tax_registration_remark'])){ ?>
                            <strong>一般纳税人认证书:</strong> <?php echo $supplier['tax_registration_remark'];?><br>
						<?php } ?>
						<?php if (!empty($supplier['organization_code_remark'])){ ?>
                            <strong>上传以往开发的发票样本:</strong> <?php echo $supplier['organization_code_remark'];?><br>
						<?php } ?>
						<?php if (!empty($supplier['other_image_remark'])){ ?>
                            <strong>其他:</strong> <?php echo $supplier['other_image_remark'];?><br>
						<?php } ?>
                    </div>
				<?php } ?>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>纳税人识别号 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="code" name="identify_number" value="<?php echo $supplier['identify_number'];?>"/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票公司名称 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="name" name="company_name" value="<?php echo $supplier['company_name'];?>"/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>一般纳税人认定时间 :</p>
					</div>
					<div class="col-md-7">
						<div class="time">
							<input class="input-padding" id="date" name="cognizance_time" type="text" value="<?php echo $supplier['cognizance_time'];?>">
						</div>
					</div>
				</div>	
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人财务联系人 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="link-men" name="finance_contacts" value="<?php echo $supplier['finance_contacts'];?>"/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人联系方式:</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="link-men-phone" name="tel" value="<?php echo $supplier['tel'];?>"/>
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
							<option value="<?php echo $x_value['region_id']; ?>" <?php echo $supplier['province_id'] == $x_value['region_id'] ? 'selected' : ''?>><?php echo $x_value['region_name']; ?></option>
							<?php		
									}
								} 
							?>
							
						</select>
						
						<input style="display:none;" type="text" id="province_hide" name="province" value="<?php echo $supplier['province'];?>" data-id="<?php echo $supplier['province_id'];?>"/>
						
						
						<input style="display:none;" type="text" id="city_hide" name="city" value="<?php echo $supplier['city'];?>" data-id="<?php echo $supplier['city_id'];?>"/>

						
						<input style="display:none;" type="text" id="county_hide" name="county" value="<?php echo $supplier['county'];?>" data-id="<?php echo $supplier['county_id'];?>"/>
						
					</div>
					<div class="col-md-7 col-md-offset-5">
						<input type="text" id="detail-address" placeholder="添加详细地址" name="address" value="<?php echo $supplier['address'];?>" data-id="<?php echo $supplier['province_id'];?>"/>
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
					<input style="display:none;" type="text" id="source-hide" name="goods_source" value="<?php echo $supplier['goods_source'];?>"/>
				</div>
				<div class="row-fluid col-md-12 input-height">
					
					<div class="col-md-3 col-md-offset-2">
						<p>开票人增值税率 :</p>
					</div>
					
					<div class="col-md-7">
						<input class="input-padding" type="text" id="tax-rate" name="tax_rate" value="<?php echo $supplier['tax_rate'];?>"/>%
					</div>
				</div>
				<div class="row-fluid col-md-12">
					<div class="col-md-3 col-md-offset-2">
						<p>出口权 :</p>
					</div>
					<div class="export-right">
						<p><label><input  name="export_right" type="radio" value="1" <?php echo $supplier['export_right'] == 1 ? 'checked' : ''?>/>&nbsp&nbsp有&nbsp&nbsp</label>
						<label><input name="export_right" type="radio" value="0" <?php echo $supplier['export_right'] == 0 ? 'checked' : ''?>/>&nbsp&nbsp无</label></p>
					</div>
				</div>

			</div>
			<div class="container-fluid submit-img" style="background-color: #FAFAFA;">
				<div class="row-fluid col-md-12">
                    <div class="col-md-1" >
                        上传营业执照：
                    </div>
					<div class="col-md-2" >
                        <img id = "business-license-btn" src="<?php echo !empty($supplier['business_license']) ? $img_source.$supplier['business_license'] : '../images/upload_bg.png';?>"/>
                        <input id="business-license-input" type="file" accept="image/*" name="business_license" />
                        <input id="business-license-hide" type="hidden" value="<?php echo !empty($supplier['business_license']) ? $img_source.$supplier['business_license'] : '';?>>" />
                    </div>
                    <div class="col-md-1" >
                        上传一般纳税人认证书：
                    </div>
                    <div class="col-md-2" >
                        <img id = "tax-reg-btn" src="<?php echo !empty($supplier['tax_registration']) ? $img_source.$supplier['tax_registration'] : '../images/upload_bg.png';?>"/>
                        <input id="tax-reg-input" type="file" accept="image/*"  name="tax_registration"/>
                        <input id="tax-reg-hide" type="hidden" value="<?php echo !empty($supplier['business_license']) ? $img_source.$supplier['business_license'] : '';?>>" />
                    </div>
                    <div class="col-md-1" >
                        上传以往开发的发票样本：
                    </div>
                    <div class="col-md-2" >
                        <img id="organization-code-btn" src="<?php echo !empty($supplier['organization_code']) ? $img_source.$supplier['organization_code'] : '../images/upload_bg.png';?>"/>
                        <input id="organization-code-input" type="file" accept="image/*" name="organization_code"/>
                        <input id="organization-code-hide" type="hidden" value="<?php echo !empty($supplier['business_license']) ? $img_source.$supplier['business_license'] : '';?>>" />
                    </div>
                    <div class="col-md-1" >
                        其他：
                    </div>
                    <div class="col-md-2" >
                        <img id="other_image-btn" src="<?php echo !empty($supplier['other_image']) ? $img_source.$supplier['other_image'] : '../images/upload_bg.png';?>"/>
                        <input id="other_image-input" type="file" accept="image/*" name="other_image"/>
                        <input id="other_image-hide" type="hidden" value="<?php echo !empty($supplier['other_image']) ? $img_source.$supplier['other_image'] : '';?>>" />
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
		

