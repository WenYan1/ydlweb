<script>
	$("#finance-service").css("border-left","6px solid #783390");
	$("#finance-service").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">金融服务</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content">
			<div class="row-fluid space_bottom">
				<form action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/finance']); ?>" method="get">
				<input style="display:none;" type="submit" value="Submit" id="submit-real">
				<input type="hidden" name="page" value="<?php echo $page;?>">
				<span class="text-name space_right_50">用户账号： <input id="email" name="email" value="<?php echo $email;?>"></span>
				<div class="search-button">
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
						<th>公司名称</th>
						<th>信保额度(元)</th>
						<th>已用信保额度(元)</th>
						<th>剩余信保额度(元)</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
						$i=0;
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($i % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php if($page == 1){echo $i + 1;}else{echo ($page-1).($i+1);} ?></td>
						<td><?php echo $value['email'];?></td>
						<td class="company_name"><?php if($value['company_name'] === null){echo "公司信息未认证";}else{echo $value['company_name'];}?></td>
						<td><?php echo $value['total_creditlimit'];?></td>
						<td><?php echo $value['total_creditlimit']-$value['credi_limit'];?></td>
						<td><?php echo $value['credi_limit'];?></td>
						<td>
							<?php if($value['company_name'] === null){ ?>
								<span style="color:#9e9e9e;">尚未开通</span>
							<?php }else{ ?>
								<a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/finance/detail', 'id'=>$value['id']]); ?>">查看</a></td>
							<?php }?>
							
					</tr>
					<?php
					$i++;}
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
<script type="text/javascript" src="/js/ydlbam_js/js_finance/fs_manage.js"></script>