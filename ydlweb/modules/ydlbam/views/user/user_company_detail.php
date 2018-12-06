<script>
	$("#user-manage").css("border-left","6px solid #783390");
	$("#user-manage").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/user']); ?>">用户管理</a>
			<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/user/user-detail']); ?>">>账号详情</a>
			<span class="text-value">>公司详情</span>
		</div>
		<div class="orange-label">
			<p>基本信息</p>
		</div>
		<div class="container-fluid">
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">公司名称：</span>
				</div>
				<div class="col-md-9">
					<a class="value-float">上海XXX信息技术有限公司</a>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">地址：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float">上海市xx区xx街道xx号</span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">联系人：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float">张三</span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">联系方式：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float">1358569856</span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">银行账号：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float">xxxx xxxx xxxx xxxx xxx</span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">营业执照：</span>
				</div>
				<div class="col-md-9">
					<img class="img_100 value-float" src="../images/upload.png">
				</div>
			</div>
		</div>
	</div>
</div>
