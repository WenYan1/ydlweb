<link rel="stylesheet" href="/css/ydlbam_css/css_company/company.css">
<script>
	$("#company-certify").css("border-left","6px solid #783390");
	$("#company-certify").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">公司认证</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<form id="" action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/company']); ?>" method="get">
			<div class="content-search_content" style="min-width: 960px">
				<div class=" space_bottom block2inline space_right">
					<span class="text-name space_right" id="company_name">公司名称：
						<input type="text" placeholder="请输入公司名称" id="company" name="" value="<?php echo $companyName;?>">
					</span>
					<span class="text-name space_right" id="account">用户账号：
						<input type="text" placeholder="请输入用户账号" id="user_account" name="" value="<?php echo $email;?>">
					</span>
					<span class="text-name">状态：</span>
					<input id="company-mange-state" type="hidden" value="<?php echo $state;?>" />
					<select name="state" id="company-status" class="text-value option-supplier">
						<!-- 状态 0:未审核,1:通过审核,-1:未通过审核 -->
						<option value="">全部</option>
						<option value="0">未审核</option>
						<option value="-1">未通过审核</option>
						<option value="1">通过审核</option>
					</select>

				</div>
				<div class="space_bottom block2inline">
					<div class="search-button">
						<img src="/images/search.jpg">
						<span id="search">搜索</span>
					</div>
				</div>
			</div>
			<input id="submit" style="display: none;" type="submit"/>
		</form>
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>公司名称</th>
						<th>账号</th>
						<th>联系电话</th>
						<th>申请日期</th>
						<th>状态</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
					for ($i = 0; $i < count($models); $i++) {
						?>
						<tr <?php if ($i % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
							<td>
								<?php  echo ($page - 1) * 10 + ($i + 1);  ?>
							</td>
							<td><a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/company/company-detail', 'company_id' => $models[$i]['id']]); ?>"><?php echo $models[$i]['company_name']; ?></a></td>
							<td><?php echo $models[$i]['user_email']; ?></td>
							<td><?php echo $models[$i]['company_tel']; ?></td>
							<td><?php echo date(("Y-m-d"), $models[$i]['created_at']); ?></td>
							<!-- 状态 0:未审核,1:通过审核,-1:未通过审核 -->
							<td><?php
								if ($models[$i]['state'] == 0) {
									echo "未审核";
								} else if ($models[$i]['state'] == 1) {
									echo "通过审核";
								} else if ($models[$i]['state'] == -1) {
									echo "未通过审核";
								} else {
									echo $models[$i]['state'];
								}
								?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<nav class="page-number">
				<ul class="pagination">
					<?php use yii\widgets\LinkPager;?>
					<?php echo LinkPager::widget([
						'pagination' => $pages,
						'firstPageLabel' => "首页",
						'prevPageLabel' => '上一页',
						'nextPageLabel' => '下一页',
						'lastPageLabel' => '尾页',
						]); ?>
					</ul>
				</nav>
			</div>
		</div>
		<script type="text/javascript" src="/js/ydlbam_js/js_company/company.js"></script>
