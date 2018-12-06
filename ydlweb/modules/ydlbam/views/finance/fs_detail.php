<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<script>
	$("#finance-service").css("border-left","6px solid #783390");
	$("#finance-service").css("color","#783390");
</script>
<link rel="stylesheet" type="text/css" href="/css/ydlbam_css/css_finance/finance.css">

<div class="body-main">
	<?php $img_source = "http://107.170.254.164/uploads/"; 
		//unserialize($company['export_range']);
		//var_dump($exportRange);  
		$company_data = explode(',', unserialize($company['export_range']));                                                                  
	?>
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/finance']); ?>">金融服务</a>
			<span class="value-name">>查看详情</span>
		</div>
		<div class="orange-label"> 
			<p>信保额度状态</p>
		</div>
		<div class="container-fluid">
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">当前状态：</span>
				</div>
				<div class="col-md-2">
					<span id="state-text" class="text-value value-float">正常</span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">更改状态：</span>
				</div>
				<div class="col-md-2">
					<div class="btn-red"><span>冻结信保额度</span></div>
					<div style="display:none;" class="btn-blue"><span>解除冻结</span></div>
				</div>
			</div>
		</div>
		<div class="orange-label">
			<p>信保额度</p>
		</div>
		<div class="container-fluid">
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">信保额度(元)：</span>
				</div>
				<div class="col-md-9">
					<span id="user-id" style="display:none;"><?php echo $user['id']; ?></span>
					<input id="total-input" class="value-float" type="number" style="display:none;width:120px;">
					<a id="modefiy-ok" class="value-float space_left" style="display:none;">完成</a>
					<span id="total-span" class="value-float"><?php echo $user['total_creditlimit'];?></span>
					<a id="modefiy" class="value-float space_left">修改</a>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">已用信保额度(元)：</span>
				</div>
				<div class="col-md-9">
					<span id="already-use" class="value-float"><?php echo $user['total_creditlimit']-$user['credi_limit'];?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">剩余信保额度(元)：</span>
				</div>
				<div class="col-md-9">
					<span id="surplus-use" class="value-float"><?php echo $user['credi_limit'];?></span>
				</div>
			</div>
		</div>
		<div class="orange-label">
			<p>账号信息</p>
		</div>
		<div class="container-fluid">
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">账号邮箱：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $user['email'];?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">公司名称：</span>
				</div>
				<div class="col-md-9">
					<span class="value-float"><?php echo $company['company_name']; ?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">联系人：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $user['name'];?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">联系方式：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $company['company_tel'];?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">开户银行：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $user['bank_name'];?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">银行账号：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php ?></span>
				</div>
			</div>
		</div>
		<div class="orange-label">
			<p>公司信息</p>
		</div>
		<div class="container-fluid">
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">公司名称：</span>
				</div>
				<div class="col-md-9">
					<span class="value-float"><?php echo $company['company_name'];?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">公司地址：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $company['country'].$company['city'].$company['address'];?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">电话：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $company['company_tel']; ?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">期望授信额度：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php echo $company['expect_credit']; ?>万美金</span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">期望授信天数：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float">
					<?php if($company['expect_days'] == 1){echo "90天";}else{echo "120天";}; ?>
					</span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">是否申请过信保额度：</span>
				</div>
				<div class="col-md-9">
					<span class="text-value value-float"><?php if($company['apply_for'] == 0){echo "否";}else{echo "是";}; ?></span>
				</div>
			</div>
			<div class="row-fluid col-md-12">
				<div class="col-md-2">
					<span class="text-name name-float">出口产品及大类：</span>
				</div>
				<p class="font-title-size">
				        <?php for ($i = 0; $i < count($company_data); $i++) {?> 
				        <?php for ($a = 0; $a < count($exportRange); $a++) {?>
				        <?php if($exportRange[$a]['id']==$company_data[$i]) {
				          echo $exportRange[$a]['name'];
				        };?>
				        <?php } ?>
				        <?php } ?>
				      </p>
				<div class="col-md-9">
					<span class="text-value value-float"><?php ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_finance/fs_detail.js"></script>