<script>
	$(".order").css("border-left","6px solid #783390");
	$(".order").css("background","#222222");
</script>
<link rel="stylesheet" type="text/css" href="../css/order/order.css">
<?php 
if($this->context->_popSuccessMessage()) {
	?>
	<div class="hint-dialog_success" style="width:120px;">
		<p class="hint-info_success"><?php echo $this->context->_popSuccessMessage(); ?></p>
	</div>
	<?php
} else {
	$msg = $this->context->_popErrorMessage();
	if($msg != null){
		?>
		<div class="hint-dialog_fail" style="width:120px;">
			<p class="hint-info_fail"><?php echo $this->context->_popErrorMessage(); ?></p>
		</div>
		<?php   
	}
}
?>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<title>订单管理</title>


<div class="container-fluid">
	<div class="row-fluid title-div">
		<p class="spacing-left">订单管理</p>
	</div>
	<div class="row-fluid col-md-12" >
		<a class="blue-border spacing-left" href=<?php echo Yii::$app->urlManager->createUrl(['order/add-first-step']);?> id="add_product">
			<img src="../images/increase.png"/>
			<span>添加订单</span>
		</a>
	</div>
	<div class="row-fluid col-md-12" >
		<div class="orange-label">
			<p class="label-title">已添加的订单</p>
			<p class="label-total">(共计: <?php echo $pages->totalCount; ?>)</p>
		</div>
	</div>
</div>

<div>
	<p class="font-content-size spacing-left order-supplier">订单状态：</p>
	<select id="order-status" class="option-supplier">
		<option value="1">全部</option>	
		<option value="0">下单审核</option>
		<option value="2">工厂生产</option>	
		<option value="3">质检装柜</option>
		<option value="4">到达口岸</option>
		<option value="5">报关完成</option>
		<option value="6">收集单据</option>
		<option value="7">收汇</option>
		<option value="8">垫付税款</option>
		<option value="9">垫付采购款</option>
		<option value="10">退税完成</option>
		<option value="11">还本付息</option>
		<option value="12">已完成</option>
		<option value="-1">审核未通过</option>
		<option value="-2">取消</option>
	</select>

	<span style="margin: auto 20px;color: #e4e4e4">|</span>
	<input class="write-supply-name" placeholder="请输入供应商名称" />
	<span class="search-btn">
		<img style="width: 15px" src="../images/search.jpg">
		<span>搜索</span>
	</span>

	<form action="<?php echo Yii::$app->urlManager->createUrl(['order']);?>" method="get">
		<input id="state-hide" type="hidden" name="state" value="<?php echo $state;?>" />
		<input id="search-hide" type="hidden" name="search" />
		<input id="request-btn" type="submit" style="display: none;" />
	</form>



</div>
<div class="main">
	<div class="row">
		<div class="col-md-12" >
				<div  style="background: #f5f5f5;">
					<table id="table" class="table">
						<thead>
							<tr>
								<th>序号</th>
								<th>订单号</th>
								<th>生成日期</th>
								<th>服务类型</th>
                                <th>结算方式</th>
								<th>供应商</th>
                                
								<th>发票金额</th>
								<th>报关金额</th>
								<th>报关日期</th>
								<th>状态</th>
								<th>下载报关资料</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody style="background: #fff;">
							<?php $i = 1;
							foreach ($models as $data) {
								?>
								<tr>
									<td><?php echo ($page - 1) * 10 + $i; ?></td>
									<td><?php echo $data['contract_type']; ?></td>
									<td><?php echo date(("Y-m-d"), $data['created_at']); ?></td>
                                    <td>
                                        <?=ZJJConfig::get_service_type($data['service_type']);?>
                                    </td>
                                    <td>
                                        <?=ZJJConfig::get_settlement_type($data['settlement_type']);?>
                                    </td>
									<td><?php echo $data['supplier_name']; ?></td>
                                   
									<td><?=!empty($orders_goods[$data['id']]['invoice_amount']) ? $orders_goods[$data['id']]['invoice_amount'] : ''?></td>
									<td><?=!empty($orders_goods[$data['id']]['subtotal']) ? $orders_goods[$data['id']]['subtotal'] : ''?></td>
									<td><?php echo empty($data['delivery_time']) ? '' : date("Y-m-d", $data['delivery_time']);?></td>
									 <td><?php
										if ($data['order_state']==0) {
											echo '下单审核';
										} elseif ($data['order_state']==2) {
											echo '工厂生产';
										}elseif ($data['order_state']==3) {
											echo '质检装柜';
										}elseif ($data['order_state']==4) {
											echo '到达口岸';
										}elseif ($data['order_state']==5) {
											echo '报关完成';
										}elseif ($data['order_state']==6) {
											echo '收集单据';
										}elseif ($data['order_state']==7) {
											echo '收汇';
										}elseif ($data['order_state']==8) {
											echo '垫付税款';
										}elseif ($data['order_state']==9) {
											echo '垫付采购款';
										}elseif ($data['order_state']==10) {
											echo '退税完成';
										}elseif ($data['order_state']==11) {
											echo '还本付息';
										}
                                        elseif ($data['order_state']==11) {
											echo '已完成';
										}elseif ($data['order_state']==-1) {
											echo '审核未通过';
										}elseif ($data['order_state']==-2) {
											echo '取消';
										}

										?></td>
										<td></td>
										<td class="blue-color">
											<a href=<?php echo Yii::$app->urlManager->createUrl(['order/order-detail','id'=> $data['id']]);?>>
												查看
											</a>						
										</td>
									</tr>
									<?php $i++; } ?>	

									
								</tbody>
							</table>
							<?php
				                if(count($models) == 0){
				            ?>
				            <div class="null-full container-fluid col-md-12">
				            	<img height="20" width="20" src="../images/null_hint.png">
				            	<span style="margin-left:5px;color:#666666;line-height:20px;">暂无数据</span>
				            </div>
				            <?php
				                }
				            ?>

						</div>
					
				</div>
			</div>
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<nav class="page-number">		
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
				</nav>
			</div>
			<script type="text/javascript" src="/js/artdialog/jquery.artDialog.js"></script>
			<script type="text/javascript" src="/js/order/order-manage.js"></script>