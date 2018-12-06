	<script>
        $(".company").css("border-left","6px solid #783390");
        $(".company").css("background","#222222");
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
  <link rel="stylesheet" href="../css/certify/certify.css">
	<title>公司认证提示</title>	
	<div class="space-vertical certify-title ">
			<div class="font-title-size font-color-default spacing-left">公司认证</div>
	</div>
	<?php if($message == "正在审核"){ ?>
    <div class="certify-tip">
      <p class="font-title-size font-color-default">
        您已申请公司认证，我们会在第一时间审核您的认证申请。
      </p>
    </div>
    <?php }else{ ?>
    <div class="certify-tip">
      <p class="font-title-size font-color-default">对不起，公司认证失败,请联系客服了解失败原因并重新认证。</p>
       <div>
         <a href="<?php echo Yii::$app->urlManager->createUrl(['/company/company-edit']);?>">
                <p class="certify-botton title-size">重新认证</p>
              </a>
       </div>
    </div>
    <?php } ?>