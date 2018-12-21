<script>
    $(".collection").css("border-left","6px solid #783390");
    $(".collection").css("background","#222222");
</script>
<link rel="stylesheet" type="text/css" href="../css/collection/collection.css">
<?php
$img_source = "/uploads/";
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
<title>退税管理</title>


<div class="container-fluid">
    <div class="row-fluid title-div">
        <p class="spacing-left">退税管理</p>
    </div>
    <div class="row-fluid col-md-12" >
        <a class="blue-border spacing-left" href=<?php echo Yii::$app->urlManager->createUrl(['collection/add']);?>>
            <img src="../images/increase.png"/>
            <span>添加单据</span>
        </a>
    </div>
    <div class="row-fluid col-md-12" >
        <div class="orange-label">
            <p class="label-title">已添加的单据</p>
            <p class="label-total">(共计: <?php echo $pages->totalCount; ?>)</p>
        </div>
    </div>
</div>

<div>
    <form action="<?php echo Yii::$app->urlManager->createUrl(['collection']);?>" id="myform" method="get">
        <p class="font-content-size spacing-left order-supplier">是否认证：</p>
        <select class="option-supplier" name="is_identification">
            <option value="">全部</option>
            <option value="1">是</option>
            <option value="2">否</option>
        </select>
        <p class="font-content-size spacing-left order-supplier">是否收齐：</p>
        <select class="option-supplier" name="is_end">
            <option value="">全部</option>
            <option value="1">是</option>
            <option value="2">否</option>
        </select>
        <span style="margin: auto 20px;color: #e4e4e4">|</span>
        <input class="write-supply-name" name="order_number" placeholder="请输入订单号" />
        <span class="search-btn" onclick="$('#myform').submit();">
            <img style="width: 15px" src="../images/search.jpg">
            <span>搜索</span>
        </span>
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
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
							<th>发票金额</th>
							<th>创建时间</th>
                            <th>报关单</th>
                            <th>供货合同</th>
                            <th>增值税发票</th>
                            <th>提单</th>
							<th>外汇状态</th>
                            <th>预计退税款</th>
                            <th>是否收齐</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody style="background: #fff;">
						<?php
						$i = 1;
						foreach ($models as $data) {
							?>
                            <tr> 
                                <td><?php echo ($page - 1) * 10 + $i; ?></td>
                                <td><?=$data['order_number']?></td>
								<td></td>
								<td><?php echo date(("Y-m-d"), $data['created_at']); ?></td>
                                <td><input name="#####" type="text" id="#####" value=""  style="width: 54px;">
                                    <?php if (!empty($data['tax_refund'])){ ?>
                                    <a href="<?php echo $img_source.$data['tax_refund']?>">下载</a>
                                    <?php } else { ?>
                                        未上传
                                    <?php } ?>
                                </td>
                                <td><input name="#####" type="text" id="#####" value="" style="width: 54px;">
                                    <?php if (!empty($data['supply_contract'])){ ?>
                                    <a href="<?php echo $img_source.$data['supply_contract']?>">下载</a>
                                    <?php } else { ?>
                                        未上传
                                    <?php } ?>
                                </td>
                                <td><input name="#####" type="text" id="#####" value="" style="width: 54px;">
                                    <?php if (!empty($data['invoice'])){ ?>
                                    <a href="<?php echo $img_source.$data['invoice']?>">下载</a>
                                    <?php } else { ?>
                                        未上传
                                    <?php } ?>
                                </td>
								
                                <td><input name="#####" type="text" id="#####" value="" style="width: 54px;">
									 <?php if (!empty($data['is_identification'])){ ?>
                                    <a href="<?php echo $img_source.$data['is_identification']?>">下载</a>
                                    <?php } else { ?>
                                        未上传
                                    <?php } ?>
                                </td>
								<td>
									<input name="#####" type="text" id="#####" value="" style="width: 54px;">
								</td>
                                <td><?=$data['anticipated_tax_refund']?></td>
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
                          
                                <td class="blue-color">
                                    <a href=<?php echo Yii::$app->urlManager->createUrl(['collection/edit','id'=> $data['id']]);?>>
                                        编辑
                                    </a>
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

                </div>
            
        </div>
    </div>
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
<script type="text/javascript" src="/js/collection/collection-manage.js"></script>