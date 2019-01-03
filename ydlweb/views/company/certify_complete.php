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
    $company_data = explode(',', unserialize($company['export_range']));
   // var_dump($exportRange);
    ?>
    <link rel="stylesheet" href="/css/certify/certify.css">
    <title>公司认证信息</title>
    <div class="space-vertical certify-title "> 
     <div class="font-title-size font-color-default spacing-left">公司认证</div>
   </div>
   <div class="container-fluid">
    <div class="row-fluid">
      <div class="company-message col-md-8 col-lg-8 col-md-offset-4">
        <div>
          <p class="font-content-size">境外公司名称：</p>
          <p class="font-title-size ">
           <?php echo $company['company_name'];?>
         </p>
       </div>
       <div>
        <p class="font-content-size">注册地址：</p>
        <p class="font-title-size font-weight-bold">
          <?php echo $company['country'];?>
          <?php echo $company['city'];?>
          <?php echo $company['address'];?>
        </p>
      </div>
      <div>
        <p class="font-content-size">联系方式：</p>
        <p class="font-title-size ">
          <?php echo $company['company_tel'];?> 
        </p>
      </div>
    </div>
    <div class="under-line col-md-12 col-lg-12"></div>
    <div class="company-message col-md-8 col-lg-8 col-md-offset-4">
      <div>
        <p class="font-content-size">期望授信金额：</p>
        <p class="font-title-size font-weight-bold">
          <?php echo $company['expect_credit'];?>万美金
        </p>
      </div>
      <div>
        <p class="font-content-size">期望授信天数：</p>
        <p class="font-title-size ">
          <?php 
          if ($company['expect_days']==1) {
            echo "90天";
          }elseif ($company['expect_days']==2) {
            echo "120天";
          }elseif ($company['expect_days']==3) {
            echo "不需要";
          };?> 
        </p>
      </div>
      <div>
        <p class="font-content-size">国内公司名称：</p>
        <p class="font-title-size ">
    
		  <?php echo $company['apply_for'];?> 
      </p>
    </div>
	 <div>
        <p class="font-content-size">办公地址：</p>
        <p class="font-title-size ">
	        <?=$company['office_address']?>
		  
      </p>
    </div>
	 <div>
        <p class="font-content-size">联系电话：</p>
        <p class="font-title-size ">

	        <?=$company['contact_number']?>
      </p>
    </div>
	
  </div>
  <div class="under-line col-md-12 col-lg-12"></div>

  <div class="company-message col-md-7 col-lg-7 col-md-offset-4">
    <div>
      <p class="font-content-size">出口产品以及大类：</p>
      <p class="font-title-size">
        <?php for ($i = 0; $i < count($company_data); $i++) {?> 
        <?php for ($a = 0; $a < count($exportRange); $a++) {?>
        <?php if($exportRange[$a]['id']==$company_data[$i]) {
          echo $exportRange[$a]['name'];
        };?>
        <?php } ?>
        <?php } ?>
      </p>
    </div>
	<div>
      <p class="font-content-size">当前主要销售平台：</p>
      <p class="font-title-size">
	      <?=$company['sales_platform']?>
      </p>
    </div>
	<div>
      <p class="font-content-size">销售规模：</p>
      <p class="font-title-size">
	      <?=$company['sales_scale']?> 万美金/月
      </p>
    </div>
  </div>

</div>
</div>


<script type="text/javascript" src="/js/company/certify_submit.js"></script>