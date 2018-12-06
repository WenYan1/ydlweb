<title>登录</title>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<link rel="stylesheet" type="text/css" href="../css/registerAndLogin/sign_up.css">
<script type="text/javascript" src="../js/regandlogin/login.js"></script>

<nav class="topbar">
	<div class="container">
		<div class="row">
			<div class="top-inner">
				<img src="/images/beforeship-logo.png" alt="用户登录">
			</div>
		</div>
	</div>
</nav>

<div class="content" style="width:1000px;margin: 0 auto;">
	<div style="width: 100%;height: 500px;">
		<div class="login-left" style="padding-top: 50px;margin-right: 40px">
			<img src="/images/login_left_img.jpg" alt="用户登录">
		</div>
		<div class="login-right">
			<div class="login login_boder">
				<img height="40" src="/images/beforeship.png" alt="登录">
				<div class="login_form">
					<form autocomplete="off">
						<p class="form_input">
							账户
						</p>
						<input id="account" type="text" placeholder="请填写邮箱账号" class="input_style" required="required">
						<p class="form_input">
							密码
						</p>
						<input id="password" type="password" placeholder="请输入登录密码 (8~16位)" class="input_style" required="required">
						<div class="tip-message">
							<a href= "<?php echo Yii::$app->urlManager->createUrl(['forget-password']); ?>" >
								<span class="forget-password forget-position">忘记密码?</span>
							</a>
							<span class="tip-register">没有账号？
								<a href= "<?php echo Yii::$app->urlManager->createUrl(['login','act'=>'reg']); ?>" >
									<span class="forget-password"> 立即注册</span>
								</a>
							</span>
						</div>
						<p id="submit" style="cursor:pointer;" class="button login-button"><span>登录</span></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xs-12" style="height: 100px;width: 100%;background: white">
		</div>