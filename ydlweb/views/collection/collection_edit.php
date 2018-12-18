
<title>单据收集</title>
<script>
    $(".collection").css("border-left","6px solid #4E99B8");
    $(".collection").css("background","#222222");
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
<script type="text/javascript" src="../js/collection/collection-add.js"></script>
<div style="border-bottom:1px solid #d8d8d8;">
	<a href='<?php echo Yii::$app->urlManager->createUrl(['collection']);?>' class="spacing-left privider-sapce-top">
		<p class="font-title-size">单据收集</p>
	</a>
	<p class="font-title-size privider-sapce-top"> - 编辑单据</p>

</div>
<div class="divider-padding2">
	<div class="divider"></div>
</div>
<form actoin=<?php echo Yii::$app->urlManager->createUrl(['add']); ?> enctype="multipart/form-data" method="post">

	<div class="container-fluid add-privider-form">

		<div class="row-fluid col-md-12 input-height">
			<div class="col-md-3 col-md-offset-2">
				<p>订单号 :</p>
			</div>
			<div class="col-md-7">
				<input class="input-padding" type="text" id="order_number" name="order_number" value="<?php echo $collection['order_number']?>"/>
			</div>
		</div>
		<div class="row-fluid col-md-12 input-height">
			<div class="col-md-3 col-md-offset-2">
				<p>预计退税款 :</p>
			</div>
			<div class="col-md-7">
				<input class="input-padding" type="text" id="anticipated_tax_refund" name="anticipated_tax_refund" value="<?php echo $collection['anticipated_tax_refund']?>"/>
			</div>
		</div>
		<div class="row-fluid col-md-12">
			<div class="col-md-3 col-md-offset-2">
				<p>是否认证 :</p>
			</div>
			<div class="export-right">
				<p><label><input  name="is_identification" type="radio" value="1" <?php echo $collection['is_identification'] == 1 ? 'checked' : ''?> />&nbsp&nbsp是&nbsp&nbsp</label>
					<label><input name="is_identification" type="radio" value="2" <?php echo $collection['is_identification'] == 2 ? 'checked' : ''?>/>&nbsp&nbsp否</label></p>
			</div>
		</div>
		<div class="row-fluid col-md-12">
			<div class="col-md-3 col-md-offset-2">
				<p>是否收齐 :</p>
			</div>
			<div class="export-right">
				<p><label><input  name="is_end" type="radio" value="1" <?php echo $collection['is_end'] == 1 ? 'checked' : ''?>/>&nbsp&nbsp是&nbsp&nbsp</label>
					<label><input name="is_end" type="radio" value="2" <?php echo $collection['is_end'] == 2 ? 'checked' : ''?>/>&nbsp&nbsp否</label></p>
			</div>
		</div>

	</div>
	<div class="container-fluid submit-img" style="background-color: #FAFAFA;">
		<div class="row-fluid col-md-12">
			<div class="col-md-4 col-md-offset-1" >
				<p style="display:block;float:right;">上传报关单退税联、供货合同、增值税发票、提单:</p>
			</div>
			<div class="col-md-7">
				<img id = "tax_refund_btn" src="<?php echo !empty($collection['tax_refund']) ? $img_source.$collection['tax_refund'] : '../images/upload_bg.png';?>"/>
				<input id="tax_refund_input" type="file" accept="image/*" name="tax_refund" />
				<img id = "supply_contract_btn" src="<?php echo !empty($collection['supply_contract']) ? $img_source.$collection['supply_contract'] : '../images/upload_bg.png';?>"/>
				<input id="supply_contract_input" type="file" accept="image/*" name="supply_contract" />
				<img id = "invoice_btn" src="<?php echo !empty($collection['invoice']) ? $img_source.$collection['invoice'] : '../images/upload_bg.png';?>"/>
				<input id="invoice_input" type="file" accept="image/*" name="invoice" />
				<img id = "invoice_btn" src=""/>
				<input id="#####" type="file" accept="image/*" name="#####" />

                <input id="tax_refund_hide" type="hidden" value="<?php echo !empty($collection['tax_refund']) ? $img_source.$collection['tax_refund'] : '';?>>" />
                <input id="supply_contract_hide" type="hidden" value="<?php echo !empty($collection['supply_contract']) ? $img_source.$collection['supply_contract'] : '';?>>" />
                <input id="invoice_hide" type="hidden" value="<?php echo !empty($collection['invoice']) ? $img_source.$collection['invoice'] : '';?>>" />
			</div>
		</div>
		<div class="row-fluid col-md-12">

		</div>
	</div>
	<input name="c_id" type="hidden" id="c_id" value="<?php echo $collection['id'];?>">
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


