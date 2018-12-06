<title>修改密码</title>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<script type="text/javascript" src="../js/account/ResetPassword.js"></script>
<link rel="stylesheet" type="text/css" href="../css/registerAndLogin/register.css">
<form class="form-style">
	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
	 <div class="forget-account">
                    <p class="spacing-left font-title-size product-title-space font-bold">
                        个人中心
                        <span> - </span>
                    </p>
                <p class="font-title-size product-title-space font-bold">修改密码</p>
            </div>
	<div class="forgettwo-main col-md-12">
		<div class="col-md-6 col-md-offset-3" style="">
			<div class="col-md-12 pwd-forget-zero"> 
				<label class="col-md-4 old-code" for="account" >原始密码: </label>
				<input  class="col-md-6 old-input" name="oldPassword" id="oldPassword"type="password" placeholder="请填写密码" required="required">
			</div>
			<div class="col-md-12 pwd-forget-one"> 
				<label class="col-md-4 new-code" for="account">请输入新密码: </label>
				<input  class="col-md-6 new-input" name="newPassword" id="newPassword" type="password" placeholder="请填写密码" required="required">
			</div>
			<div class="col-md-12 pwd-forget-two">
				<label class="col-md-4 again-pwd" for="account">再次确认密码: </label>
				<input  class="col-md-6 again-input" name="verifyPassword" id="verifyPassword" type="password" placeholder="请填写确认密码" class="input_style" required="required">

			</div>
			<div class="col-md-offset-4" style="margin-top: 40px;">
				<p id="submit" class=" pwd-forget-three default-background-blue submit-p" style="cursor:pointer;" <span>确认密码</span></p>
			</div>
			
			</div>
		</div>

	</div>		
</form>
