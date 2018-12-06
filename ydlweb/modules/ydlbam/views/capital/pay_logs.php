<script>
	$("#pay-logs").css("border-left","6px solid #783390");
	$("#pay-logs").css("color","#783390");
</script>

<link rel="stylesheet" type="text/css" href="/css/ydlbam_css/css_capital/index.css">

<div class="body-main">
	
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">支付记录</span>
		</div>
		<div class="orange-label">
			<p>支付记录</p>
		</div>

		<div class="select-row">
			<table>
				<tr >
					<?php if ($type == 0) {?>
						<td class="select">未审核</td>
						<td class="no-select"><a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/pay-logs','state'=>1]);?>">审核中</a></td>
						<td class="no-select"><a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/pay-logs','state'=>2]);?>">已审核</a></td>
					<?php } else if ($type == 1) {?>
						<td class="no-select"><a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/pay-logs','state'=>0]);?>">未审核</a></td>
						<td class="select"><span>审核中</span></td>
						<td class="no-select"><a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/pay-logs','state'=>2]);?>">已审核</a></td>
					<?php } else  if ($type == 2) {?>
						<td class="no-select"><a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/pay-logs','state'=>0]);?>">未审核</a></td>
						<td class="no-select"><a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/pay-logs','state'=>1]);?>">审核中</a></td>
						<td class="select"><span>已审核</span></td>
					<?php }?>
					<td class="bottom-line">
						<span>空白空白空白空白空白空白</span>
					</td>
					<td class="bottom-line">
						<span>空白空白空白空白空白空白</span>
					</td>
					<td class="bottom-line">
						<span>空白空白空白空白空白空白</span>
					</td>
				</tr>
			</table>
		</div>

		<div class="table-border" style="margin-top:0px;">
			<table>
				
				<thead style="background-color: #fff;color:#333333">
					<tr>
						<th>序号</th>
						<th>用户账号</th>
						<th>支付金额</th>
						<th>说明</th>
						<th>金额类型</th>
						<th>状态</th>
						<?php if($type != 2) {?>
						<th>操作</th>
						<?php }?>
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
						<td><?php echo $value['user_id'];?></td>
						<td><?php echo $value['payment_amount'];?></td>
						<td><?php echo $value['pay_explain'];?></td>
						<td><?php echo $value['pay_type']; ?></td>
						<?php
						if ($value['state'] == 0) {
						?>
						<td>未审核</td>
						<?php 
						} else if($value['state'] == 1){
						?>
						<td>审核中</td>
						<?php }else{ ?>
						<td>已审核</td>
						<?php }?>
						<?php if($type != 2) {?>
							<td>
							<?php if($value['state'] == 0) {?>
								<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/auditing-pay-logs','state'=>1,'id'=>$value['id']]);?>">审核中</a> | <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/auditing-pay-logs','state'=>2,'id'=>$value['id']]);?>">审核完成</a>
							<?php } else if($value['state'] == 1) {?>
								<a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/auditing-pay-logs','state'=>2,'id'=>$value['id']]);?>">审核完成</a>
							<?php }?>
							</td>
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
<script type="text/javascript" src="/js/ydlbam_js/js_capital/capital_balance.js"></script>
