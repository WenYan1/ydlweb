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
<?php 
if($this->context->_popSuccessMessage()) {
  echo $this->context->_popSuccessMessage();
} else {
  echo $this->context->_popErrorMessage();
}
?>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<link rel="stylesheet" href="/css/certify/certify.css">
<title>公司认证信息填写</title>

<div class="space-vertical certify-title ">
  <div class="font-title-size font-color-default spacing-left">公司认证</div>
</div>

<div class="container-fluid">
  <div class="company-main">
    <form action="<?php echo Yii::$app->urlManager->createUrl(['/company/company-auth']);?>" enctype="multipart/form-data" method="post">
      <div class="company-part">  
        <div class="company-left">
          境外公司名称：
        </div>
        <div class="company-right"><input id="company-name" type="" name='company[company_name]' value="">
        </div>
      </div>
      <div class="company-part" style="height: 160px">
        <div class="company-left">
          公司地址：
        </div>
        <div class="company-right">
          <input type="" id="company-country" name='company[country]' value="" placeholder="Country/国家" /><br><br>
          <input type="" id="company-city" name='company[city]' value="" placeholder="City城市" /><br><br>
          <input type="" id="company-detail-address" name='company[address]' value="" placeholder="Address/详细地址" />
        </div>
      </div>
      <div class="company-part">
        <div class="company-left">
          联系人及电话：
        </div>
        <div class="company-right"><input id="company-tel" type="" name='company[company_tel]' value="" />
        </div>
      </div>
      <div class="company-part">
        <div class="company-left">
          期望授信金额：
        </div>
        <div class="company-right"><input id="company-expect-money" type="" name='company[expect_credit]' value="" />万美金
        </div>
      </div>
      <div class="company-part">
        <div class="company-left">
          期望授信天数：
        </div>
        <div class="company-right">
          <label><input name="company[expect_days]" type="radio" value="1">&nbsp&nbsp90天</label> 
          <label><input name="company[expect_days]" type="radio" value="2">&nbsp120天</label> 
        </div>
      </div>
      <!--<div class="company-part">
        <div class="company-left">
          此公司是否曾经申请信用保险额度：
        </div>
        <div class="company-right">
          <label><input name="company[apply_for]" type="radio" value="1" />&nbsp&nbsp是</label> 
          <label><input name="company[apply_for]" type="radio" value="0" />&nbsp&nbsp否</label> 
        </div>
      </div>
	  -->
	   <div class="company-part">
        <div class="company-left">
          国内公司名称：
        </div>
        <div class="company-right">
		<div class="company-right"><input id="company-apply-for" type="" name='company[apply_for]' value="" />
        </div>
      </div>

      <div class="company-part">
        <div class="company-left">
          出口产品以及大类：
        </div>
      </div>

      <div class="company-product">
        <?php for ($i = 0; $i < count($exportRange); $i++) {?>
        <div class="product-category">
          <input name="" type="checkbox" value="<?php echo $exportRange[$i]['id'];?>" >&nbsp&nbsp<?php echo $exportRange[$i]['name'];?>
        </div>
        <?php }?>
      </div>
      <input id="export-range" name="company[export_range]" type="hidden" value="">
      <div class="company-submit">
        <input name="_csrf" type="hidden"  value="<?= Yii::$app->request->csrfToken ?>">
        <button id="company-btn" style="display: none;"></button>
      </div>
    </form>
    <div style="text-align: center">
      <span id="company-submit">提交</span>
    </div>
    

  </div>
</div>


<script type="text/javascript" src="/js/company/certify_submit.js"></script>


