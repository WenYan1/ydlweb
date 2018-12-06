<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha; 
?>
<style type="text/css">
	#loginform-verifycode{
		display: inline;
		width:100px;
		height: 38px;
	}
</style>
<title>注册</title>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<script type="text/javascript" src="../js/regandlogin/register.js"></script>
<link rel="stylesheet" type="text/css" href="../css/registerAndLogin/register.css">
<div style="width:100%;">
	<div class="container-fluid" style="border-bottom: 1px solid #eeeeee">
		<div class="row">
			<nav class="tobar-black col-xs-12 col-lg-12 ">
				<div class="top-inner-black col-xs-offset-2">
					<img src="../images/beforeship-logo.png" alt="用户登录">
				</div>
			</nav>
		</div>
	</div>
	<div class="container-fluid main">
		<div class="row">
			<div class="background-color-white" style="width: 960px;height:460px;margin: 0 auto;margin-top: 50px;">
				<div class="col-xs-5 form pull-right" >
					<p class="font-title-size join-me-color">加入我们</p>
					<form id="form-reg" class="form-style">
						<div class="row col-xs-12" >
							<label class="account-label pull-left" for="email">账号邮箱: </label>
							<input id="email" class="col-xs-8 input_style"  type="email" placeholder="请填写邮箱账号" required="required">
						</div>
						<div class="row col-xs-12 public_top">
							<label class="account-label pull-left" for="password">密码:</label>
							<input id="password" class="col-xs-8 input_style" type="password" placeholder="请填写登录密码 (8~16位)" required="required">
						</div>
						<div class="row col-xs-12 public_top">
							<label class="account-label pull-left" for="password_compare">确认密码: </label>
							<input id="password_compare" class="col-xs-8 input_style"  type="password" placeholder="请确认登录密码 (8~16位)" required="required">
						</div>
						<div class="row col-xs-12 public_top" style="width:700px;">
							<div class="row col-xs-6">
							<?php $form = ActiveForm::begin(['id' => 'login-form']);?>
							<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['captchaAction'=>'login/captcha','template' => '{input}{image}','options'=>['placeholder'=>' 验证码'],'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer;width:100px;']])->label('验证码:',['class'=>"account-label pull-left"])?>
							<?php ActiveForm::end() ?>
							</div>
						</div>
						<p id="submit"  class="button complete font-content-size col-xs-10" >
							注册
						</p>
					</form>
				</div>
				<div class="col-xs-6 info">		
					<div class="row col-xs-12 public_top">
						<p class="describe-color col-xs-11">
							代采购金额高，最高<span class="describe-em-color describe-em-size">$5,000,000.00</span>的代采购。
						</p>
					</div>
					<div class="row col-xs-12 public_top">
						<p class=" describe-color col-xs-11">
							授信额度管理，总额度下的<span class="describe-em-color describe-em-size">随用随还</span>。
						</p>
					</div>
					<div class="row col-xs-12 public_top">
						<p class=" describe-color  col-xs-11">
							代采购成本低，整体服务费<span class="describe-em-color describe-em-size">1%</span>/月。
						</p>
					</div>
					<div class="row col-xs-12 public_top">
						<p class=" describe-color col-xs-11">
							还款时间灵活，可以<span class="describe-em-color describe-em-size">签订OA</span>90-180天的
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xs-12" style="height: 100px;width: 100%;background: white">
		</div>
