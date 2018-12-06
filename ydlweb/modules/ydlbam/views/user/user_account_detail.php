<script>
	$("#user-manage").css("border-left","6px solid #783390");
	$("#user-manage").css("color","#783390");
</script>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<div class="body-main">
	<div class="main-content">
		<?php
			 /*var_dump($user);
			 var_dump($company);*/
		?>
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/user']); ?>">用户管理</a>
			<span class="text-value">>账号详情</span>
		</div>
		<div class="orange-label">
			<p>基本信息</p>
		</div>
		<div class="container-fluid">
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">账号邮箱：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $user['email']?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">公司名称：</span>
				</div>
				<div class="col-md-9">
					<?php if($company != null){ ?>
						<span class="value-float"><?php echo $company['company_name']; ?></span>
					<?php
					}else{
					?>
					<span class="value-float">尚未进行公司认证</span>
					<?php
					}
					?>
					
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">联系人：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php //echo $company['company_principal']?></span>
				</div>
			</div> 
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">客服：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $customServer['user_name'];?></span>
				</div>
				<div>
					<input type="hidden" name="uid" value="<?php echo $user['id'];?>">
					<select name="custom_server_id" id="cid">
					  <option>请选择客服</option>
					  <?php foreach($customers as $val) {?>
					  <option value="<?php echo $val['id'];?>"><?php echo $val['user_name'];?></option>
					  <?php }?>
					</select>
					<span style="cursor:pointer;color:#783390" onclick="modifyCostomServer();">修改</span>
				</div>
			</div> 
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">联系方式：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $company['company_tel']?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">开户银行：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $user['bank_name']?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">银行账号：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php //echo $company['bank_account']?></span>
				</div>
			</div>
		</div>
		<div class="orange-label">
			<p>更多信息</p>
		</div>
		<div class="container-fluid">
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">用户订单：</span>
				</div>
				<div class="col-md-9">
					<a class="value-float" href="/ydlbam/order">查看</a>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">用户资金流水：</span>
				</div>
				<div class="col-md-9">
					<a class="value-float" href="/ydlbam/capital/list-capital-logs?type=3&page=1&email=">查看</a>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">用户资金(元)：</span>
				</div>
				<div class="col-md-9">
					<span class="value-float"><?php echo $user['user_capital']?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">用户不可用资金(元)：</span>
				</div>
				<div class="col-md-9">
					<span class="value-float"><?php echo $user['bond']?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">用户信用额度(元)：</span>
				</div>
				<div class="col-md-9">
					<span class="value-float"><?php echo $user['credi_limit']?></span>
				</div>
			</div>
		</div>


	</div>
</div>
<script type="text/javascript">
	function modifyCostomServer() {
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		var url = '<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/user/modify-custom-server']);?>';
		var sendData = {"uid":$("input[name='uid']").val(),"custom_server_id":$("#cid").val(),"_csrf":csrfToken};
		$.ajax({
		   type: "POST",
		   url: url,
		   data: sendData,
		   success: function(msg){
		     	//alert( "Data Saved: " + msg );
		   }
		});
	}
</script>