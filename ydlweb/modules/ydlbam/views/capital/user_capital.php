<link rel="stylesheet" type="text/css" href="/css/ydlbam_css/css_capital/index.css">
<script>
	$("#capital-user").css("border-left","6px solid #783390");
	$("#capital-user").css("color","#783390");
</script>

<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">用户资金</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content">
			<div class="row-fluid space_bottom">
				<form action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/capital/user-capital']); ?>" method="get">

				<input style="display:none;" type="submit" value="Submit" id="submit-real">
				<span class="text-name space_right_50">用户账号： 
					<input id="email" name="email" value="<?php if($email!=null){echo $email;}?>"></span>
				<input type="hidden" name="page" value="<?php echo $page;?>">
				<div class="search-button" onclick="submit_frm()">
					<img src="/images/search.jpg">
					<span>搜索</span>
				</div>
				</form>
			</div>
		</div>
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>账号</th>
						<th>可用资金</th>
						<th>保证金</th>
						<th>总信保额度</th>
						<th>已用信保额度</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
						$i = 0;
						foreach ($models as $key => $value) {
						?>
					<tr <?php if ($i % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php if($page ==1){echo $i+1;}else{echo ($page-1).($i+1);} ?></td>
						<td><?php echo $value['email'];?></td>
						<td><?php echo $value['user_capital'];?></td>
						<td><?php echo $value['bond'];?></td>
						<td><?php echo $value['total_creditlimit'];?></td>
						<td><?php echo $value['total_creditlimit'] - $value['credi_limit'];?></td>
						<?php $email = rawurlencode($value['email']);?>
						<td><a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/capital-logs', 'type'=>3, 'page'=>1, 'email'=>$email]); ?>">查看</a></td>
					</tr>
					<?php
					$i++; }
					?>
				</tbody>
			</table>
			<?php if(count($models) == 0){?>
			<div class="null-full container-fluid col-md-12">
                <img height="20" width="20" src="/images/null_hint.png">
                <span style="margin-left:5px;color:#666666;line-height:20px;">暂无数据</span>
            </div>
            <?php }?>
		</div>
		<nav class="page-number">
              	<ul class="pagination">
                <?php use yii\widgets\LinkPager;?>
                <?php
				echo LinkPager::widget([
					'pagination' => $pages,
					'firstPageLabel' => "首页",
					'prevPageLabel' => '上一页',
					'nextPageLabel' => '下一页',
					'lastPageLabel' => '尾页',
				]);
				?>
				</ul>
            </nav>
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_capital/user_capital.js"></script>