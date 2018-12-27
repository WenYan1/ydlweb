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
                    <div class="container-fluid submit-img" style="background-color: #FAFAFA;">
                        <div class="row-fluid col-md-12">
                            <div class="col-md-2" >
                                <p style="display:block;float:right;">上传报关单退税联 :</p>
                            </div>
                            <div class="col-md-10" data-category="1">
								<?php if (!empty($collectionFiles[1])){
									foreach ($collectionFiles[1] as $key => $item){ ?>
                                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                                            <a href="<?=$img_source.$item['service_path']?>" target="_blank">
                                                <div class="thumbnail">
                                                    <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                                </div>
                                            </a>
                                        </div>
									<?php } }  ?>
                            </div>
                            <div class="space"></div>
                            <div class="col-md-2" >
                                <p style="display:block;float:right;">上传供货合同 :</p>
                            </div>
                            <div class="col-md-10" data-category="2">
								<?php if (!empty($collectionFiles[2])){
									foreach ($collectionFiles[2] as $key => $item){ ?>
                                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                                            <a href="<?=$img_source.$item['service_path']?>" target="_blank">
                                                <div class="thumbnail">
                                                    <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                                </div>
                                            </a>
                                        </div>

									<?php } }  ?>
                            </div>
                            <div class="space"></div>
                            <div class="col-md-2" >
                                <p style="display:block;float:right;">上传增值税发票 :</p>
                            </div>
                            <div class="col-md-10" data-category="3">
								<?php if (!empty($collectionFiles[3])){
									foreach ($collectionFiles[3] as $key => $item){ ?>
                                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                                            <div class="thumbnail">
                                                <a href="<?=$img_source.$item['service_path']?>" target="_blank">
                                                    <div class="thumbnail">
                                                        <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

									<?php } }  ?>
                            </div>
                            <div class="space"></div>
                            <div class="col-md-2" >
                                <p style="display:block;float:right;">上传提单 :</p>
                            </div>
                            <div class="col-md-10" data-category="4">
								<?php if (!empty($collectionFiles[4])){
									foreach ($collectionFiles[4] as $key => $item){ ?>
                                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                                            <div class="thumbnail">
                                                <a href="<?=$img_source.$item['service_path']?>" target="_blank">
                                                    <div class="thumbnail">
                                                        <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

									<?php } }  ?>
                            </div>
                        </div>
                        <div class="row-fluid col-md-12">

                        </div>
                    </div>
			</div>
		</form>

	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_supplier/supplier_detail.js"></script>