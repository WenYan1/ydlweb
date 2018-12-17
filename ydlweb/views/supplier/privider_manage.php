
	<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
	<title>供应商列表</title>
	<script>
			$(".supplier").css("border-left","6px solid #4E99B8");
    		$(".supplier").css("background","#222222");
		</script>
	<link rel="stylesheet" type="text/css" href="../css/privider_manage/privider_about.css">

	<script type="text/javascript" src="../js/privider_manage/privider_manage.js"></script>

	<?php
            $img_source = "/uploads/";
            if($this->context->_popSuccessMessage()) {
        ?>
                <div class="hint-dialog_success" style="width:120px;">
                    <p class="hint-info_success"><?php echo $this->context->_popSuccessMessage(); ?></p>
                </div>
                <script>
                	setTimeout("hint()",3000);
                	function hint(){
						$(".hint-dialog_success").remove();
					}
                </script>
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

			<div class="container-fluid">
				<div class="row-fluid title-div">
					<p class="spacing-left">供应商管理</p>
				</div>
				<div class="row-fluid col-md-12" >
			        <a class="blue-border spacing-left" href="<?php echo Yii::$app->urlManager->createUrl(['supplier/add']);?>" id="add_product">
			        	<img src="../images/increase.png"/>
			            <span>添加供应商</span>
			        </a>
				</div>
				<div class="row-fluid col-md-12" >
					<div class="orange-label">
						<p class="label-title">已添加的供应商</p>
			            <p class="label-total">(共计: <?php echo  $count; ?>)</p>
					</div>
				</div>
	        </div>


			<div class="privider-filter container-fluid">
				<div class="row-fluid" style="padding-left:24px;">
						<?php
							if($state === null){
						?>
						<p id="all-state" class="font-size-default default-blue under-line">全部</p>
			            <p id="state-1" class="font-size-default">待审核</p>
			            <p id="state-2" class="font-size-default">通过审核</p>
			            <p id="state-3" class="font-size-default">未通过</p>
			            <?php }else if($state === "0"){ ?>
			            <p id="all-state" class="font-size-default">全部</p>
			            <p id="state-1" class="font-size-default default-blue under-line">待审核</p>
			            <p id="state-2" class="font-size-default">通过审核</p>
			            <p id="state-3" class="font-size-default">未通过</p>
			            <?php }else if($state === "1"){ ?>
			            <p id="all-state" class="font-size-default">全部</p>
			            <p id="state-1" class="font-size-default">待审核</p>
			            <p id="state-2" class="font-size-default default-blue under-line">通过审核</p>
			            <p id="state-3" class="font-size-default">未通过</p>
			        	<?php }else if($state === "-1"){ ?>
			        	<p id="all-state" class="font-size-default">全部</p>
			            <p id="state-1" class="font-size-default">待审核</p>
			            <p id="state-2" class="font-size-default">通过审核</p>
			            <p id="state-3" class="font-size-default default-blue under-line">未通过</p>
			        	<?php }?>
			        	
			            <p class="font-size-default vertical-line">|</p>
			            <input id="key" type="text" placeholder="请输入供应商名称查询" class="product_query" value="<?php if($search === null){}else{ echo $search;} ?>"  />

		            <div class="button_query">
		               <img src="../images/search.jpg" alt="搜索"><span>搜索</span>
		            </div>
		            <form id="form-filter" action="" method="get">
		            	<input id="submit-btn" type="submit" value="Submit"/>
		            </form>
				</div>

			</div>
			<table class="privider-list container-fluid col-md-12">
				<tbody>
					<tr class="privider-list-head row-fluid">
						<td class="number col-md-1">序号</td>
						<td class="col-md-1">供应商名称</td>
						<td class="">纳税人识别号</td>
						<td class="">函调垫税限额</td>
						<td class="">已垫付税款金额</td>
						<td class="">添加日期</td>
						<td class="status col-md-2">状态</td>
						<td class="operate col-md-2">操作</td>
					</tr>
					<?php $i = 1; foreach ($models as $x=>$x_value) { ?>

						<tr class="privider-list-item row-fluid">
						<td class="number col-md-1"><?php echo ($page - 1) * 10 + $i; ?></td>
						<td class="name col-md-1"><?php echo $x_value['company_name']; ?></td>
						<td class="name"><?php echo $x_value['identify_number']; ?></td>
						<td class="name"><?php echo $x_value['allowance_limit']; ?></td>
						<td class="name"><?php echo $x_value['tax_paid_advance']; ?></td>
						<td class="time"><?php echo date(("Y-m-d"),$x_value['created_at']); ?></td>
						<td class="status col-md-2"><?php
							if($x_value['supplier_state'] == 0){
								echo "待审核";
							}else if($x_value['supplier_state'] == 1){
								echo "通过审核";
							}else if($x_value['supplier_state'] == -1){
								echo "未通过审核";
							}
						 ?>
						</td>

					<td class="delete col-md-2">
                        <?php if ((!empty($state) && $state ==-1) || (!empty($x_value['supplier_state']) && $x_value['supplier_state'] == -1)){ ?>
						<a href="<?php echo Yii::$app->urlManager->createUrl(['/supplier/edit','supplier_id'=>$x_value['id']]);?>" class="deletePrivider">编辑</a>
                        |
                        <?php } ?>
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['/supplier/supplier-detail','supplier_id'=>$x_value['id']]);?>" class="deletePrivider">详情</a>
					</td>
					</tr>
				<?php $i ++; } ?>

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

			<!-- <div class="privider-list-foot">
						<div class="blue-border" id="next-pager" style="display: block;float: right;">
							<a>下一页</a>
						</div>
						<p style="line-height: 14px;margin-top:39px;display: block;float: right;">1/5<p>
			</div> -->


