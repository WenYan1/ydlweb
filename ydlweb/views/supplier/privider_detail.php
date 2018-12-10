
        <title>供应商详情</title>
        <script>
			$(".supplier").css("border-left","6px solid #4E99B8");
    		$(".supplier").css("background","#222222");
		</script>
        <link rel="stylesheet" type="text/css" href="../css/privider_manage/privider_about.css">

		<?php 
           // $img_source = "http://107.170.254.164/uploads/";
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

        	<div style="border-bottom:1px solid #d8d8d8;">
        		<a href='<?php echo Yii::$app->urlManager->createUrl(['supplier']); ?>' class="spacing-left privider-sapce-top">
        			<p class="font-title-size">供应商管理</p>
        		</a>
        		<p class="font-title-size privider-sapce-top"> - 供应商详情</p>
        		
        	</div>
			<div class="divider-padding2">
				<div class="divider"></div>
			</div>
			<div class="container-fluid privider-detail">
				<?php if(!empty($supplier['supplier_state']) && (!empty($supplier['business_license_remark']) || !empty($supplier['tax_registration_remark']))){ ?>
                    <div class="alert alert-warning" role="alert">
                        <strong>未通过原因!</strong> <br>
						<?php if (!empty($supplier['business_license_remark'])){ ?>
                            <strong>营业执照:</strong> <?php echo $supplier['business_license_remark'];?><br>
						<?php } ?>
						<?php if (!empty($supplier['tax_registration_remark'])){ ?>
                            <strong>一般纳税人资质:</strong> <?php echo $supplier['tax_registration_remark'];?><br>
						<?php } ?>
                    </div>
				<?php } ?>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>纳税人识别号 :</p>
					</div>
					<div class="col-md-7">
						<span id="code"><?php echo $supplier['identify_number'];?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票公司名称 :</p>
					</div>
					<div class="col-md-7">
						<span id="name"><?php echo $supplier['company_name'];?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>一般纳税人认定时间 :</p>
					</div>
					<div class="col-md-7">
						<div class="time">
							<span id="name"><?php echo $supplier['cognizance_time'];?></span>
						</div>
					</div>
				</div>	
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人财务联系人 :</p>
					</div>
					<div class="col-md-7">
						<span id="link-men"><?php echo $supplier['finance_contacts'];?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人联系方式 :</p>
					</div>
					<div class="col-md-7">
						<span id="link-men-phone"><?php echo $supplier['tel'];?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人地址 :</p>
					</div>
					<div class="col-md-7">
						<span id="address"><?php echo $supplier['goods_source'];?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>境内货源地 :</p>
					</div>
					<div class="col-md-7">
						<span id="source"><?php echo $supplier['goods_source'];?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>开票人增值税率 :</p>
					</div>
					<div class="col-md-7">
						<span id="tax-rate"><?php echo $supplier['tax_rate']."%";?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>出口权 :</p>
					</div>
					<div class="col-md-7 ">
						<span id="export-right"><?php if($supplier['export_right'] == 1){echo "有";}else{echo "无";}?></span>
					</div>
				</div>

			</div>
			<div class="container-fluid submit-img" style="background-color: #FAFAFA;">
			<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">营业执照：</span>
						</div>
						<div class="col-xs-2">
							<a href="<?php echo $img_source.$supplier['business_license'];?>" target="_Blank"><img id = "business-license-btn" src="<?php echo $img_source.$supplier['business_license'];?>"/></a>
						</div>
						<div class="col-xs-2">
							<span class="text-name name-float">一般纳税人资格：</span>
						</div>
						<div class="col-xs-2">
							 <a href="<?php echo $img_source.$supplier['tax_registration'];?>" target="_Blank"><img id = "tax-reg-btn" src="<?php echo $img_source.$supplier['tax_registration'];?>"/></a>
						</div>
						<div class="col-xs-2">
							<span class="text-name name-float">其他信息：</span>
						</div>
						<div class="col-xs-2">
							 <a href="<?php echo $img_source. $supplier['organization_code'];?>" target="_Blank"><img id = "organization-code-btn" src="<?php echo $img_source. $supplier['organization_code'];?>"/></a>
						</div>
					</div>
				
				
				
			</div>
				
			
