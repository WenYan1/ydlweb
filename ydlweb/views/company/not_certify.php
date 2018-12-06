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
		<script>
	        $(".company").css("border-left","6px solid #783390");
	        $(".company").css("background","#222222");
	    </script>
		<link rel="stylesheet" href="../css/certify/certify.css">
		<title>公司尚未认证</title>
		<div class="space-vertical certify-title ">
			<div class="font-title-size font-color-default spacing-left">公司认证</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div  class="non-certify-tip ">
					<div class="certify-non-border">
						<b class="title-size certify-CN font-color-default ">对不起，您的公司未认证！</b>
						<p class=" content-size font-grey certify-EN">Sorry,Your company is not certified.</p>
						<div>
							<a href="<?php echo Yii::$app->urlManager->createUrl(['/company/company-auth']);?>">
								<p class="certify-botton title-size">立即认证</p>
							</a>
							
						</div>
					</div>
				</div>
			</div>
		</div>