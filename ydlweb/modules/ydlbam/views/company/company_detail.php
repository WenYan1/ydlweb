<?php
$img_source = "http://172.18.240.62:8080/uploads/";
?>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<link rel="stylesheet" href="/css/ydlbam_css/css_company/company.css">
<script>
	$("#company-certify").css("border-left","6px solid #4e99b8");
	$("#company-certify").css("color","#4e99b8");
</script>
<div class="body-main">
	<div class="main-content">
		<div id="test" style="display: none;background-color: red;width: 100px;height: 30px;line-height: 30px;text-align: center;margin: 10px auto;">修改成功</div>
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<a class="text-value" href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/company']); ?>">公司认证</a>
			<span class="text-value">></span>
			<span class="text-value">公司详情</span>
		</div>
		<div class="orange-label">
			<p>操作</p>
		</div>
		
		<div class="space_top">
			<div>
				<span class="text-value ">当前状态：</span>
				<input id="company_id" type="hidden" value="<?php echo $company['id'];?>" />
				<input id="company_state" type="hidden" value="<?php echo $company['state'];?>" />
				<span class="text-value space_left">
					<?php 
					if ($company['state']==0) {
						echo "未审核";
					} else if ($company['state']==1) {
						echo "通过审核";
					} else if ($company['state']==-1){
						echo "未通过审核";
					}else{
						echo $company['state'];
					}
					?>
				</span>
			</div>
			<div>
				<span class="text-value ">修改状态：</span>
				<select name="" id="select_state_company" class="text-value space_left option-supplier">
					<!-- 状态 0:未审核,1:通过审核,-1:未通过审核 -->
					<option value="0">未审核</option>
					<option value="1">通过审核</option>
					<option value="-1">未通过审核</option>
				</select>
				<span id="sure-edit-company" class="font-blue space_left">确认修改</span>
			</div>
		</div>
		
		<div class="orange-label">
			<p>基本信息</p>
		</div>
		<div class="message-space-top message-space-left">
			<div class="message-space-top">
				<span class="text-value">公司名称:</span>
				<span class="text-value space_left"><?php echo $company['company_name']?></span>
			</div>
			<div class="message-space-top">
				<span class="text-value">公司地址:</span>
				<span class="text-value space_left">
					<?php echo $company['country']?>
					<?php echo $company['city']?>
					<?php echo $company['address']?>
				</span>
			</div>
			<div class="message-space-top">
				<span class="text-value">公司电话:</span>
				<span class="text-value space_left">
					<?php echo $company['company_tel']?>
				</span>
			</div>
		</div>
		
	</div>
</div>



<script type="text/javascript" src="/js/ydlbam_js/js_company/company.js"></script>