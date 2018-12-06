    <script>
        $(".person-acount").css("border-left","6px solid #783390");
        $(".person-acount").css("background","#222222");
    </script>
    <link rel="stylesheet" href="../css/account/account.css">
    <meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
    <script src='//kefu.easemob.com/webim/easemob.js?tenantId=16168&amp;hide=true' async='async'></script>
	<title>个人中心</title>
     <div class="space-vertical account-title ">
			<div class="font-title-size font-color-default spacing-left font-bold">个人中心</div>
		</div>
		<div class="space-vertical">
			<p class="orange"></p>
			<p class="font-title-size content-middle">账户信息</p>
			<div class="spacing-left  space-vertical">
				<div class="content-to-left">
					<p class="font-content-size font-grey">邮箱信息：</p>
					<p class="font-content-size font-color-default account-left"><?php echo $user->email ?></p>
				</div>
				<div class="space-vertical content-to-left">
					<p class="font-content-size font-grey">联系电话：</p>
					<?php if(empty($user->phone)){?>
						<a href="#" id="add_phone" class="content font-content-size account-click account-left">添加</a>
					<?php }else{ ?>
						<div id="modify" class="bind-phone">
							<p class="font-content-size font-color-default account-left" id = "default_phone"><?php echo $user->phone ?></p>
							<a href="#" id="modify_phone" class="content font-content-size account-click account-left">修改</a>
						</div>

					<?php } ?>
					<div id="bind-phone" class="hide bind-phone">
						<input type="phone" id="phone_input" class="account-phone account-left" >
						<a href="#" id="save_phone" class="content font-content-size account-click account-left">保存</a>
						<a href="#" title="" id="cancel" class="content font-content-size account-click account-left">取消</a>
					</div>
					<div id="phone-div" class="hide bind-phone">
						<p class="font-content-size font-color-default account-left" id="phone"></p>
						<a href="#" id="modify_phone2" class="content font-content-size account-click account-left">修改</a>
					</div>
				</div>
			</div>
		</div>
	<div class="space-vertical">
		<p class="orange"></p>
		<p class="font-title-size content-middle">客服</p>
		<div class="spacing-left  space-vertical">
			<div class="content-to-left">
				<p class="font-content-size font-grey">客服姓名：</p>
				<p class="font-content-size font-color-default account-left"><?php echo $customServer->user_name ?></p>
			</div>
			<div class="content-to-left">
				<p class="font-content-size font-grey">联系电话：</p>
				<p class="font-content-size font-color-default account-left"><?php echo $customServer->custom_tel ?></p>
			</div>
			<div class="content-to-left">
				<p class="font-content-size font-grey">客服邮箱：</p>
				<p class="font-content-size font-color-default account-left"><?php echo $customServer->custom_email ?></p>
			</div>
		</div>
	</div>
		<div class="space-vertical">
			<p class="orange"></p>
			<p class="font-title-size content-middle">安全设置</p>
			<div class="spacing-left  space-vertical">
				<div class="content-to-left">
					<a href= "<?php echo Yii::$app->urlManager->createUrl(['account', 'act' => 'resetPassword']); ?>" class="content font-content-size account-click account-left">修改密码</a>
				</div>
			</div>
		</div>
	<script type="text/javascript" src="../js/account/personal_account.js"></script>
