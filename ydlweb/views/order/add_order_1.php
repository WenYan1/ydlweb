<script>
	$(".order").css("border-left","6px solid #4E99B8");
	$(".order").css("background","#222222");
</script>
<link rel="stylesheet" type="text/css" href="../css/order/order.css">
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
<meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
<title>添加订单-第一步</title>
<div class="title-div">
	<a href='<?php echo Yii::$app->urlManager->createUrl(['order']); ?>'>
		<p class="font-title-size default-blue spacing-left">订单管理</p>
	</a>
	<p class="font-title-size font-color-default"> - 添加订单</p>
	<span style="color:#666666;">(第一步)</span>
</div>

<div>
<div class="row-fluid col-md-12" >
	<div class="orange-label">
		<p class="label-title">选择结汇周期</p>
	</div>
</div>
<div>
	<input class='test' name='cycledays90' type='radio' style="margin-left:58px; margin-bottom: 12px" checked="checked" value="90"/>90天<br>
	<input class='test' name='cycledays90' type='radio' style="margin-left:58px;" value="120"/>120天<br>
</div>
</div>
<div class="row-fluid col-md-12" >
	<div class="orange-label">
		<p class="label-title">添加商品</p>	
	</div>
</div>
<?php
// var_dump($supplier);
?>
<div>
	<p style="margin-top: 20px" class="font-content-size spacing-left supplier">供应商：</p>
	<select class="option-supplier">
	<option selected="selected" value=""></option>
		<?php foreach ($supplier as $x => $x_value) {
			if ($x == 0) {
				foreach ($x_value as $y => $y_value) {
					if ($y == "id") {
						?>
						<option  value="<?php echo $y_value; ?>"><?php
						} else if ($y == "company_name") {
							?><?php echo $y_value; ?></option>
							<?php
						}
					}
				} else {
					foreach ($x_value as $y => $y_value) {
						if ($y == "id") {
							?>
							<option value="<?php echo $y_value; ?>"><?php
							} else if ($y == "company_name") {
								?><?php echo $y_value; ?></option>
								<?php

							}
						}
					}
				}?>
	</select>
</div>
		
		<div class="main">
			<div class="row">
				<div class="col-md-12" >
					<div class="">
						<div  style="margin-top:20px ;background: #f5f5f5">
							<table id="table" class="table">
								<thead>
									<tr>
										<th></th>
										<th>序号</th>
										<th>产品图片</th>
										<th>报关品名</th>
										<th>每种商品总毛重(kg)</th>
										<th>每种商品总净重(kg)</th>
										<th>箱数</th>
										<th>单价(元)</th>
										<th>数量</th>
									</tr>
								</thead>
								<form>
									<tbody style="background: #fff;">

									</tbody>
								</form>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="statistic">
					<p class="font-content-size space-vertical font-grey spacing-left">总价(元)：</p>
					<p id="total-price" class="font-color-default font-content-size order-left">0</p>
					<p class="font-content-size space-vertical font-grey spacing-left">总净重(kg)：</p>
					<p id='net-weight' class="font-color-default font-content-size order-left">0</p>
					<p class="font-content-size space-vertical font-grey spacing-left">总毛重(kg)：</p>
					<p id="gross-weoght" class="font-color-default font-content-size order-left">0</p>
					<p class="font-content-size space-vertical font-grey spacing-left">总箱数：</p>
					<p id="total-box" class="font-color-default font-content-size order-left">0</p>
					<p class="font-content-size space-vertical font-grey spacing-left">总体积(cm<sup>3</sup>)：</p>
					<p id="total-volume" class="font-color-default font-content-size order-left">0</p>
					<p class="font-content-size space-vertical font-grey spacing-left">总数量：</p>
					<p id='total-quantity' class="font-color-default font-content-size order-left">0</p>
				</div>
			</div>
			<div>
				<p id="next-step" class="default-background-blue font-content-size next-step">下一步</p>
			</div>
		</div>

		<script type="text/javascript" src="../js/order/order.js"></script>
