<link rel="stylesheet" href="/css/ydlbam_css/css_supplier/supplier.css">
<script>
	$("#suplier-manage").css("border-left","6px solid #783390");
	$("#suplier-manage").css("color","#783390");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>
			<span class="text-value">供应商管理</span>
		</div>
		<div class="content-search_top">
			<span class="text-value">搜索条件</span>
		</div>
		<div class="content-search_content" style="min-width: 960px;">
			<form id="form-filter" action="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/supplier']);?>" mothed="GET">
				<div class="block2inline space_bottom">
					<span class="text-name space_right">供应商名称： <input placeholder="请输入供应商名称" id="supplier" name="supplier_name" value="<?php echo $supplierName ?>"></span>
					<span class="text-name space_right">用户账号： <input placeholder="请输入用户账号" id="user_account" name="email" value="<?php echo $email ?>"></span>
					<span class="text-name ">供应商状态： </span>
					<select name="state" id="product_status" class="text-value option-supplier">
						<option value="">全部</option>
						<option value="0">待审核</option>
						<option value="1">通过审核</option>
						<option value="-1">未通过审核</option>
					</select>
				</div>
				<div>
					<div class=" space_bottom">
					<div class="search-button" >
						<img src="/images/search.jpg">
						<span>搜索</span>
					</div>
					<input id="state_num" style="display: none;" type="hidden" value="<?php echo $state ?>"/>
					<input type="text" style="display: none;" name="page" id="page" value="<?php echo $page ?>">
				</div>
				</div>
				
				
				<input id="submit" style="display: none;" type="submit"/>
			</form>
		</div>
		<div class="table-border">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>供应商名称</th>
                        <th>纳税人识别号</th>
                        <th>函调垫税限额</th>
                        <th>已垫付税款金额</th>
						<th>账号</th>
						<th>申请日期</th>
						<th>状态</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:5px;"></tr>
					<?php
						foreach ($models as $key => $value) {
					?>
					<tr <?php if ($key % 2 != 1) {echo "style='background-color:#f5f5f5;'";}?> >
						<td><?php echo ($key+1)+($page-1)*10?></td>
						<td><a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/supplier/supplier-detail','supplier_id'=>$value['id']]);?>"><?php echo $value['company_name']?></a></td>
						<td><?php echo $value['identify_number']?></td>
						<td><input class="" type="text" data-allowance-type="true" value="<?php echo $value['allowance_limit']?>" data-id="<?php echo $value['id'];?>" title="鼠标离开后保存"></td>
						<td><?php echo $value['tax_paid_advance']?></td>
						<td><?php echo $value['user_email']?></td>
						<td><?php echo date(("Y-m-d"),$value['updated_at']);?></td>

						<td>
							<?php
								if($value['supplier_state'] == 0){
									echo "待审核";
								}else if($value['supplier_state'] == 1){
									echo "通过审核";
								}else if($value['supplier_state'] == -1){
									echo "未通过审核";
								}else{
									echo "补充材料";
								}
							?>
						</td>
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
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
<script type="text/javascript" src="/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="/js/ydlbam_js/js_supplier/supplier_manage.js"></script>
