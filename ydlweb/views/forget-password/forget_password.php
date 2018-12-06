<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha; 
?>
<style type="text/css">
	#forgetpasswordform-verifycode{
		margin-left: 13px;
		height: 38px;
	}
	</style>
<title>忘记密码_填写邮箱</title>
<meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
<link rel="stylesheet" type="text/css" href="../css/registerAndLogin/register.css">
<script type="text/javascript" src="../js/regandlogin/getpassword.js"></script>
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
<div class="container forgetpasswd" style="margin-top: 100px;margin-bottom:200px">
	<div class="row">
		<form id="frm" method="post" class="form-style  col-md-6 col-md-offset-3" action="<?php echo Yii::$app->urlManager->createUrl(['/forget-password/apply']);?>">
		<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<p>
				<label class="word" for="account">账户邮箱: </label>
				<input id="account" name="email" style="height:38px;" class="edit-eamail" type="text" placeholder="请填写邮箱账号" required="required">
			</p>
			<p style="margin-top: 47px;">
				
				<?php $form = ActiveForm::begin(['id' => 'login-form']);?>
				<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['captchaAction'=>'forget-password/captcha','template' => '{input}{image}','options'=>['placeholder'=>' 验证码'],'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer;width:100px;']])->label('验证码:',['class'=>"word"])?>
				<?php ActiveForm::end() ?>
			</p>
		</form>
		
		<div id="next-step" style="background-color: #783390;border-radius: 5px;color: #fff;
		font-size: 16px;
		height: 35px;
		width:200px; 
		margin-top:200px; 
		text-align:center;margin-left:43%;line-height:35px;cursor: pointer;">下一步</div>
	</div>
</div>

<script type="text/javascript">
	$("#next-step").click(function(){
		$("#frm").submit();
	});
</script>
