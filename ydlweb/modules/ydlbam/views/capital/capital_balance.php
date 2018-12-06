<script>
	$("#capital-balance").css("border-left","6px solid #783390");
	$("#capital-balance").css("color","#783390");
</script>

<link rel="stylesheet" type="text/css" href="/css/ydlbam_css/css_capital/index.css">

<div class="body-main">
	
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">流水详情</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content">
			<div class="row-fluid space_bottom">
				<form action="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/list-capital-logs']);?>" method="get">

				<input id="type" type="hidden" name="type" value="<?php if($type!=null){} echo $type;?>">
				<input type="hidden" name="page" value="<?php echo $page;?>">
				<input style="display:none;" type="submit" value="Submit" id="submit-real">
				<span class="text-name space_right_50">用户账号：
					<input id="email" name="email" value="<?php if($email!=null){echo $email;}?>"></span>
				<div class="search-button">
					<img src="/images/search.jpg">
					<span>搜索</span>
				</div>
				</form>
			</div>
		</div>
		<div class="orange-label">
			<p>资金流水</p>
		</div>

		<div class="select-row">
			<table>
				<tr >
					<?php if ($type == 3) {?>
						<td class="select"><span>充值记录</span></td>
						<td class="no-select"><span>可用资金流水</span></td>
						<td class="no-select"><span>信保资金流水</span></td>
					<?php } else if ($type == 2) {?>
						<td class="no-select"><span>充值记录</span></td>
						<td class="select"><span>可用资金流水</span></td>
						<td class="no-select"><span>信保资金流水</span></td>
					<?php } else {?>
						<td class="no-select"><span>充值记录</span></td>
						<td class="no-select"><span>可用资金流水</span></td>
						<td class="select"><span>信保资金流水</span></td>
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
				<?php
				if ($type == 3) {
				?>
				<thead style="background-color: #fff;color:#333333">
					<tr>
						<th>序号</th>
						<th>充值资金</th>
						<th>银行名称</th>
						<th>银行账号</th>
						<th>充值日期</th>
						<th>状态</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
					$i = 0;
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($i % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php  echo ($page - 1) * 10 + ($i + 1);  ?></td>
						<td><?php echo $value['recharge_amount'];?></td>
						<td><?php echo $value['bank_name'];?></td>
						<td><?php echo $value['bank_account'];?></td>
						<td><?php echo $value['recharge_time']; ?></td>
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
				<?php
				} else if ($type == 2) {
				?>
				<thead style="background-color: #fff;color:#333333">
					<tr>
						<th>序号</th>
						<th>流水单号</th>
						<th>金额</th>
						<th>资金说明</th>
						<th>日期</th>
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
						<td><?php echo $value['flow_sn'];?></td>
						<td><?php echo $value['capital_symbol'].$value['capital'];?></td>
						<td><?php echo $value['capital_explain'];?></td>
						<td><?php echo date("Y-m-d", $value['created_at']); ?></td>
					</tr>
					<?php
					$i++;}
					?>
				</tbody>
				<?php
				} else {
				?>
				<thead style="background-color: #fff;color:#333333">
					<tr>
						<th>序号</th>
						<th>流水单号</th>
						<th>金额</th>
						<th>资金说明</th>
						<th>日期</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
					$i = 0;
					foreach ($models as $key => $value) {
						//var_dump($value);
					?>
					<tr <?php if ($i % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php if($page ==1){echo $i+1;}else{echo ($page-1).($i+1);} ?></td>
						<td><?php echo $value['flow_sn'];?></td>
						<td><?php echo $value['capital_symbol'].$value['capital'];?></td>
						<td><?php echo $value['capital_explain'];?></td>
						<td><?php echo date("Y-m-d", $value['created_at']); ?></td>
					</tr>
					<?php
					$i++;}
					?>
				</tbody>
				<?php
				}
				?>

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
