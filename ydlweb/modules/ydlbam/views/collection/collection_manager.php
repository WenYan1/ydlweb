<link rel="stylesheet" type="text/css" href="/css/ydlbam_css/public/jquery.datetimepicker.css"/ >
<script type="text/javascript" src="/js/ydlbam_js/public/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/css/ydlbam_css/css_order/order.css">
<script>
    $("#collection-manage").css("border-left","6px solid #783390");
    $("#collection-manage").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">单据管理</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content" style="min-width: 1000px">
			<form action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/collection']);?>" id="myform" method="get">
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
				<div class="row-fluid space_bottom">
					<span class="text-name space_right">订单号： <input placeholder="请输入订单号" style="margin-left: 14px;" name="order_number" value=""></span>
					<span class="text-name ">是否认证： </span>
					<select name="is_identification" class="text-value option-supplier space_right">
						<option value="">全部</option>
						<option value="1">是</option>
						<option value="2">否</option>
					</select>
                    <span class="text-name ">是否收齐： </span>
                    <select name="is_end" class="text-value option-supplier space_right">
                        <option value="">全部</option>
                        <option value="1">是</option>
                        <option value="2">否</option>
                    </select>
				</div>
				<div class="row-fluid space_bottom">
					<div class="search-button" onclick="$('#myform').submit();">
						<img src="/images/search.jpg">
						<span>搜索</span>

					</div>
				</div>
			</form>
		</div>
		<div class="table-border">
			<table>
				<thead>
				<tr>
                    <th>序号</th>
                    <th>订单号</th>
                    <th>报关单退税联</th>
                    <th>供货合同</th>
                    <th>增值税发票</th>
                    <th>是否认证</th>
                    <th>预计退税款</th>
                    <th>是否收齐</th>
                    <th>创建时间</th>
                    <th>操作</th>
				</tr>
				</thead>
				<tbody>
				<tr style="height:5px;"></tr>
				<?php
				$img_source = "/uploads/";
				$i = 1;
				foreach ($models as $data) {
					?>
                    <tr>
                        <td><?php echo ($page - 1) * 10 + $i; ?></td>
                        <td><?=$data['order_number']?></td>
                        <td>
							<?php if (!empty($data['tax_refund'])){ ?>
                                <a href="<?php echo $img_source.$data['tax_refund']?>">下载</a>
							<?php } else { ?>
                                未上传
							<?php } ?>
                        </td>
                        <td>
							<?php if (!empty($data['supply_contract'])){ ?>
                                <a href="<?php echo $img_source.$data['supply_contract']?>">下载</a>
							<?php } else { ?>
                                未上传
							<?php } ?>
                        </td>
                        <td>
							<?php if (!empty($data['invoice'])){ ?>
                                <a href="<?php echo $img_source.$data['invoice']?>">下载</a>
							<?php } else { ?>
                                未上传
							<?php } ?>
                        </td>
                        <td>
							<?php
							if ($data['is_identification'] == 1){
								echo '是';
							}else if ($data['is_identification'] == 2){
								echo '否';
							}else{
								echo '';
							}
							?>
                        </td>
                        <td><?=$data['is_end']?></td>
                        <td>
							<?php
							if ($data['is_end'] == 1){
								echo '是';
							}else if ($data['is_end'] == 2){
								echo '否';
							}else{
								echo '';
							}
							?>
                        </td>
                        <td><?php echo date(("Y-m-d"), $data['created_at']); ?></td>
                        <td class="blue-color">
                            <a href=<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/collection/detail','id'=> $data['id']]);?>>
                                详情
                            </a>
                        </td>
                    </tr>
					<?php $i ++; } ?>
				</tbody>
			</table>
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
</div>
</div>
</div>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
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