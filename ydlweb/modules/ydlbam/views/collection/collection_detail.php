<link rel="stylesheet" href="/css/ydlbam_css/css_supplier/supplier.css">
<meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
<script>
    $("#collection-manage").css("border-left","6px solid #783390");
    $("#collection-manage").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>

			<a href='<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/collection']) ?>'>单据收集</a>

			<span class="text-value">  > 单据详情</span>
		</div>

		<?php
		//todo
		//$img_source = "http://172.18.240.62:8080/uploads/";
		$img_source = "/uploads/";
		?>

		<form actoin="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/supplier/supplier-detail']); ?>" enctype="multipart/form-data" method="post">
			<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<div class="orange-label">
				<p>基本信息</p>
			</div>
			<div>
				<div class="container-fluid">
					<div class="row-fluid col-xs-12">
						<div class="col-xs-2">
							<span class="text-name name-float">订单号：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $collection['order_number']?></span>
						</div>
					</div>
					<div class="row-fluid col-xs-12">
						<div class="col-xs-2">
							<span class="text-name name-float">预计退税款：</span>
						</div>
						<div class="col-xs-9">
							<span class="value-float"><?php echo $collection["anticipated_tax_refund"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">是否认证：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $collection["is_identification"] == 1 ? '是' : '否';?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">是否收齐：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $collection["is_end"] == 1 ? '是' : '否';?></span>
						</div>
					</div>
                    <div class="row-fluid col-sm-12">
                        <div class="col-xs-2">
                            <span class="text-name name-float">报关单退税联：</span>
                        </div>
                        <div class="col-xs-2">
                            <img id="business-license-btn" src="<?php  echo $img_source.$collection["tax_refund"];?>" class="company-image " alt="报关单退税联">
                        </div>
                        <div class="col-xs-2">
                            <span class="text-name name-float">供货合同</span>
                        </div>
                        <div class="col-xs-2">
                            <img id="tax-reg-btn" src="<?php echo $img_source.$collection["supply_contract"];?>" class="company-image " alt="供货合同">
                        </div>
                        <div class="col-xs-2">
                            <span class="text-name name-float">增值税发票：</span>
                        </div>
                        <div class="col-xs-2">
                            <img id="organization-code-btn" src="<?php echo $img_source.$collection["invoice"];?>" class="company-image " alt="增值税发票">
                        </div>
				</div>
			</div>
		</form>
		<div class="modal fade bs-example-modal-lg" id="bl-dialog" tabindex="-1" role="dialog" aria-labelledby="blLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-header" style="border-bottom:0px;">
					<button type="button" class="close"
					        data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4></h4>
				</div>
				<div class="modal-content modal-padding">
					<img  class="big-img" src="<?php echo $img_source.$collection['tax_refund'];?>">
				</div>
			</div>
		</div>


		<div class="modal fade bs-example-modal-lg" id="tr-dialog" tabindex="-1" role="dialog" aria-labelledby="trLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-header" style="border-bottom:0px;">
					<button type="button" class="close"
					        data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4></h4>
				</div>
				<div class="modal-content modal-padding">
					<img class="big-img" src="<?php echo $img_source.$collection['supply_contract'];?>">
				</div>
			</div>
		</div>


		<div class="modal fade bs-example-modal-lg" id="oc-dialog" tabindex="-1" role="dialog" aria-labelledby="ocLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-header" style="border-bottom:0px;">
					<button type="button" class="close"
					        data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4></h4>
				</div>
				<div class="modal-content modal-padding">
					<img class="big-img" style="" src="<?php echo $img_source. $collection['invoice'];?>">
				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_supplier/supplier_detail.js"></script>