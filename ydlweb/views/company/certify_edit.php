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
<link rel="stylesheet" href="/css/certify/certify.css">
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<title>公司认证信息填写</title>
<?php 
// var_dump($company['export_range']);
$company_data = explode(',', unserialize($company['export_range']));
if($this->context->_popSuccessMessage()) {
  echo $this->context->_popSuccessMessage();
} else {
  echo $this->context->_popErrorMessage();
}
?>

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
              <div class="company-right"><input id="company-name" type="text" name='company[company_name]' value="<?=$company['company_name']?>">
              </div>
          </div>
          <div class="company-part" style="height: 160px">
              <div class="company-left">
                  注册地址：
              </div>
              <div class="company-right">
                  <input type="" id="company-country" name='company[country]' value="<?=$company['country']?>" placeholder="Country/国家" /><br><br>
                  <input type="" id="company-city" name='company[city]' value="<?=$company['city']?>" placeholder="City城市" /><br><br>
                  <input type="" id="company-detail-address" name='company[address]' value="<?=$company['address']?>" placeholder="Address/详细地址" />
              </div>
          </div>
          <div class="company-part">
              <div class="company-left">
                  联系方式：
              </div>
              <div class="company-right"><input id="company-tel" type="text" name='company[company_tel]' value="<?=$company['company_tel']?>" />
              </div>
          </div>
          <div class="company-part">
              <div class="company-left">
                  期望授信金额：
              </div>
              <div class="company-right"><input id="company-expect-money" type="text" name='company[expect_credit]' value="<?=$company['expect_credit']?>" />万美金
              </div>
          </div>
          <div class="company-part">
              <div class="company-left">
                  期望授信天数：
              </div>
              <div class="company-right">
                  <label><input name="company[expect_days]" type="radio" value="1" <?=$company['expect_days'] == 1 ? 'checked' :''?>>&nbsp&nbsp90天</label>
                  <label><input name="company[expect_days]" type="radio" value="2" <?=$company['expect_days'] == 2 ? 'checked' :''?>>&nbsp120天</label>
                  <label><input name="company[expect_days]" type="radio" value="3" <?=$company['expect_days'] == 3 ? 'checked' :''?>>&nbsp不需要</label>
              </div>
          </div>
          <div class="company-part">
              <div class="company-left">
                  国内公司名称：
              </div>
              <div class="company-right"><input id="company-apply-for" type="text" name='company[apply_for]' value="<?=$company['apply_for']?>" /></div>
          </div>
          <div class="company-part">
              <div class="company-left">办公地址：</div>
              <div class="company-right"><input id="" type="text" name='company[office_address]' value="<?=$company['office_address']?>" /></div>
          </div>

          <div class="company-part">
              <div class="company-left">联系电话：</div>
              <div class="company-right"><input id="" type="text" name='company[contact_number]' value="<?=$company['contact_number']?>" /></div>
          </div>

          <div class="company-part">
              <div class="company-left">
                  出口产品以及大类：
              </div>
              <div class="company-right">
				  <?php for ($i = 0; $i < count($exportRange); $i++) {?>
                      <div class="product-category">
                          <input name="" type="checkbox" value="<?php echo $exportRange[$i]['id'];?>" >&nbsp&nbsp<?php echo $exportRange[$i]['name'];?>
                      </div>
				  <?php }?>
              </div>
          </div>
          <div class="company-part">
              <div class="company-left">当前主要销售平台：</div>
              <div class="company-right"><input id="" type="text" name='company[sales_platform]' value="<?=$company['sales_platform']?>" /></div>
          </div>
          <div class="company-part">
              <div class="company-left">销售规模：</div>
              <div class="company-right"><input id="" type="text" name='company[sales_scale]' value="<?=$company['sales_scale']?>" />万美金/月</div>
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