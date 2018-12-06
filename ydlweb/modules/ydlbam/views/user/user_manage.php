<script>
	$("#user-manage").css("border-left","6px solid #783390");
	$("#user-manage").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">用户管理</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content">
			<div class="row-fluid space_bottom">
				<form method="get" action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/user']);?>">
					<input type="hidden" value="Submit" id="submit-real">
					<span class="text-name space_right_50">邮箱： <input id="email" name="email" placeholder="请输入帐号" value="<?php echo $email ?>"></span>
					<div class="search-button">
						<img src="/images/search.jpg">
						<span>搜索</span>
					</div>
					<input id="submit" style="display: none;" type="submit"/>
					<input type="text" style="display: none;" name="page" id="page" value="<?php echo $page ?>">
				</form>
			</div>
		</div>
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>账号</th>
						<th>公司名称</th>
						<th>客服</th>
						<th>上次登录时间</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($key % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php  echo ($page - 1) * 8 + ($key + 1);  ?></td>
						<td><a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/user/user-detail','id'=>$value['id']]);?>"><?php echo $value['email']; ?></a></td>
						<td>
							<?php if($value['company_name'] === null){ ?>
							<span style="color:#9e9e9e;">公司未认证</span>
							<?php
							}else{
							?>
							<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/company/company-detail','company_id'=>$value['company_id']]);?>"><?php echo $value['company_name']; ?></a>
							<?php } ?>
							
						</td>
						<td><?php echo $value['user_name']; ?></td>
						<td><?php echo date(("Y-m-d H:i:s"), $value['updated_at']); ?></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			
		</div>
	</div>
	<nav class="page-number">
			  <ul class="pagination">
			    <?php use yii\widgets\LinkPager;?>
			    <?php
					echo LinkPager::widget([
					    'pagination' => $pages,
					    'firstPageLabel'=>"首页",
					    'prevPageLabel'=>'上一页',
					    'nextPageLabel'=>'下一页',
					    'lastPageLabel'=>'尾页',
					]);
				?>
			  </ul>
			</nav>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_user/user_manage.js"></script>
