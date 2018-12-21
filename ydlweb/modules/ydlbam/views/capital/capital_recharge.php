<script>
	$("#capital-recharge").css("border-left","6px solid #783390");
	$("#capital-recharge").css("color","#783390");
</script>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<link rel="stylesheet" type="text/css" href="/css/ydlbam_css/public/jquery.datetimepicker.css"/ >
<script type="text/javascript" src="/js/ydlbam_js/public/jquery.datetimepicker.js"></script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">充值管理</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content" style="min-width: 960px">
			<div class="row-fluid space_bottom">
				<form action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/capital/recharge']); ?>" method="get">
				<input style="display:none;" type="submit" value="Submit" id="submit-real">
				<span class="text-name space_right">用户账号： 
					<input id="email" name="email" value="<?php if($email!=null){echo $email;}?>"></span>
				<span class="text-name space_right">日期起止：
					<input id="start_time" name="start_time" type="text" value="<?php if($startTime!=null){echo $startTime;}?>"/> - 
					<input id="end_time" name="end_time" type="text" value="<?php if($endTime!=null){echo $endTime;}?>"/>
				</span>
				<input name="page" type="hidden" value="<?php echo $page;?>"/>
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
						<th>充值资金</th>
						<th>币种</th>
						<th>付款人账户</th>
						<th>银行名称</th>
						<th>银行账号</th>
						<th>充值日期</th>
						<th>订单</th>
						<th>当时汇率</th>
						<th>结汇后人民币</th>
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
						<td class="td-id" style="display:none;"><?php echo $value['id'];?></td>
						<td><?php  echo ($page - 1) * 10 + ($i + 1);  ?></td>
						<td><?php echo $value['user_email'];?></td>
						<td><?=Tool::getCurrency($value['currency']);?></td>
						<td><?php echo $value['recharge_amount'];?></td>
						<td><?php echo $value['account_name'];?></td>
						<td><?php echo $value['bank_name'];?></td>
						<td><?php echo $value['bank_account'];?></td>
						<td><?php echo date("Y-m-d", $value['created_at']); ?></td>
                        <td>
							<?php foreach ($orders as $item){ ?>
								<?=$value['order_id'] == $item['id'] ? $item['order_sn']:''?>
							<?php } ?>
                        </td>
						<td><input name="exchange_rate" data-exchange-rate="true" data-id="<?=$value['id']?>" type="text" value="<?=$value['exchange_rate']?>" style="width: 60px"/></td>
						<td><?=$value['exchange_settlement_rmb'];?></td>
                        <?php
						if ($value['state'] == 1) {
						?>
						<td>已同意</td>
						<?php 
						} else if($value['state'] == -1){
						?>
						<td>已拒绝</td>
						<?php }else{ ?>
						<td><a class="agree">同意</a><span> | </span>
							<a class="disagree">拒绝</a></td>
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
</div>

<script>
    $('#start_time').datetimepicker({
        lang:'ch',
        format:'Y-m-d',
        timepicker:false,
    });
    $('#end_time').datetimepicker({
        lang:'ch',
        format:'Y-m-d',
        timepicker:false,
    });
</script>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
<script type="text/javascript" src="/js/ydlbam_js/js_capital/capital_recharge.js"></script>