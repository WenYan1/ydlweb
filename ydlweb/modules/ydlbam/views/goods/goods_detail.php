<link rel="stylesheet" href="/css/ydlbam_css/css_goods/goods.css">
<meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
<script>
	$("#goods-manage").css("border-left","6px solid #4e99b8");
	$("#goods-manage").css("color","#4e99b8");
</script>
<div class="body-main">
<?php
	$img_source = "http://172.18.240.62:8080/uploads/";
?>
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>

			<a href='<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/goods']); ?>'>产品管理</a>

			<span class="text-value">  > 产品详情</span>
		</div>
		<div class="orange-label">
			<p>操作</p>
		</div>

		<div class="space_top ">
			<div>
				<span class="text-value ">当前状态：</span>
				<span class="text-value space_left status-ing" id="<?php echo $goods["state"];?>">
					<?php
						if($goods['state'] == 0){
							echo "待审核";
						}else if($goods['state'] == 1){
							echo "通过审核";
						}else if($goods['state'] == -1){
							echo "未通过审核";
						}
					?>
				</span>
			</div>
			<div>
				<span class="text-value ">修改状态：</span>
				<select name="" id="option_state" class="text-value space_left option-supplier">
					<option value="0">待审核</option>
					<option value="1">通过审核</option>
					<option value="-1">未通过审核</option>
				</select>
				<span class=" font-blue space_left" id="change_state">确认修改</span>
				<input type="hidden" value="<?php echo $goods["id"];?>" id="goods-hide">
			</div>
		</div>
        <form actoin="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/supplier/goods-detail']); ?>" enctype="multipart/form-data" method="post">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
		<div class="orange-label">
			<p>商品信息</p>
		</div>
			<div class="container-fluid" style="min-width: 960px">
				<div class="row">
					<div class="row-fluid">
						<div class="col-md-6 col-xs-6">
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">供应商：</span>
								</div>
								<div class="col-md-8 col-xs-8">
									<a href="<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/supplier/supplier-detail','supplier_id'=>$goods['supplier_id']]);?>" class="sapce_left">
										<?php echo $goods['supplier_name']?>
									</a>
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">报关品名：</span>
								</div>
								<div class="col-md-8 col-xs-8">
									<span class="text-value sapce_left"><?php echo $goods['goods_name']?></span>
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">HS Code：</span>
								</div>
								<div class="col-md-4 col-xs-4">
									<span class="text-value sapce_left"><?php echo $goods['hs_code']?></span>
								</div>
                                <div class="col-md-4 col-xs-4">
                                    <input class="form-control" type="text" name="hs_code_remark" placeholder="HSCode未通过备注" value="<?php echo $goods['hs_code_remark']?>">
                                </div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4" >
									<span class="name-float">含税单价(元)：</span>
								</div>
								<div class="col-md-4 col-xs-4">
									<span class="text-value sapce_left"><?php echo $goods['original_price']?></span>
								</div>
                                <div class="col-md-4 col-xs-4">
                                    <input class="form-control" type="text" name="original_price_remark" placeholder="产品单价未通过备注" value="<?php echo $goods['original_price_remark']?>">
                                </div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">净重(kg)：</span>
								</div>
								<div class="col-md-8 col-xs-8">
									<span class="text-value sapce_left"><?php echo $goods['net_weight']?></span>
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">毛重(kg)：</span>
								</div>
								<div class="col-md-8 col-xs-8">
									<span class="text-value sapce_left"><?php echo $goods['gross_weight']?></span>
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">总箱数：</span>
								</div>
								<div class="col-md-6 col-xs-6">
									<span class="text-value sapce_left"><?php echo $goods['box_number']?></span>
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">尺寸(cm)(长/宽/高)：</span>
								</div>
								<div class="col-md-6 col-xs-6">
									<span class="text-value sapce_left"><?php echo $goods['goods_long']."/".$goods['goods_wide']."/".$goods['goods_height']?></span>
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">产品总体积：</span>
								</div>
								<div class="col-md-6 col-xs-6">
									<span class="text-value sapce_left"><?php echo $goods["goods_long"] * $goods["goods_wide"] * $goods["goods_height"]?></span>
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">图片：</span>
								</div>
								<div class="col-md-6 col-xs-6">
									 <img src="<?php echo $img_source.$goods['goods_image']?>" id="product_img" class="company-image " alt="产品图片">
								</div>
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">或上传历史报关单：</span>
								</div>
								<div class="col-md-6 col-xs-6">
									 <img src="" id="product_file" class="company-image " alt="图片">
								</div>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class=" col-md-4 col-xs-4">
									<span class="name-float">产品售卖链接：</span>
								</div>
								<div class="col-md-6 col-xs-6">
									<a href="<?=!empty($goods['goods_url']) ? $goods['goods_url'] : 'javascript:;'?>" target="_blank"><?=!empty($goods['goods_url']) ? $goods['goods_url'] : '未填写'?></a>
								</div>
							</div>
                            <div class="col-md-12 col-xs-12">
                                <div class=" col-md-4 col-xs-4">
                                    <span class="name-float">图片未通过备注：</span>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <textarea class="form-control" name="goods_image_remark" style=" width: 201px; height: 122px;resize:none"><?php echo $goods['goods_image_remark']?></textarea>
                                </div>
                            </div>
						</div>

						
							

						</div>
					
				</div>
			</div>
			<div class="orange-label">
				<p>单件产品信息</p>
			</div>
			<?php foreach($goodsAttr as $key => $value){?>
				<div style="min-width: 960px">
					<div class="container-fluid">
						<div class="row-fluid col-xs-12">
							<div class="col-xs-2">
								<span class="text-name name-float">编号：</span>
							</div>
							<div class="col-xs-4">
								<span class="text-value value-float"><?php echo count($goodsAttr).'-'.($key + 1)?></span>
							</div>
						</div>
						<div class="row-fluid col-xs-12">
							<div class="col-xs-2">
								<span class="text-name name-float">净重(kg)：</span>
							</div>
							<div class="col-xs-4">
								<span class="value-float"><?php echo $value["net_weight"]?></span>
							</div>
						</div>
						<div class="row-fluid col-sm-12">
							<div class="col-xs-2">
								<span class="text-name name-float">毛重(kg)：</span>
							</div>
							<div class="col-xs-4">
								<span class="text-value value-float"><?php echo $value["gross_weight"]?></span>
							</div>
						</div>
						<div class="row-fluid col-sm-12">
							<div class="col-xs-2">
								<span class="text-name name-float" style="width: 160px;text-align: right;">尺寸(cm)(长/宽/高)：</span>
							</div>
							<div class="col-xs-4">
								<span class="text-value value-float"><?php echo $value["goods_long"]."/".$value["goods_wide"]."/".$value["goods_height"]?></span>
							</div>
						</div>
						<div class="row-fluid col-sm-12">
							<div class="col-xs-2">
								<span class="text-name name-float">体积：</span>
							</div>
							<div class="col-xs-4">
								<span class="text-value value-float"><?php echo $value["goods_long"] * $value["goods_wide"] * $value["goods_height"]?></span>
							</div>
						</div>
						<div class="row-fluid col-sm-12">
							<div class="col-xs-2">
								<span class="text-name name-float">描述：</span>
							</div>
							<div class="col-xs-10">
								<span class="text-value value-float"><?php echo $value["attr_describe"]?></span>
							</div>
						</div>

					</div>
					<p class="goods-botder"></p>
				</div>
			<?php } ?>
            <input type="hidden" name="goods_id" value="<?php echo $goods["id"];?>">
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
		</div>
			<div class="modal fade bs-example-modal-lg" id="product-dialog" tabindex="-1" role="dialog" aria-labelledby="blLabel">
			  <div class="modal-dialog modal-lg">
			  	<div class="modal-header" style="border-bottom:0px;">
		            <button type="button" class="close" 
		               data-dismiss="modal" aria-hidden="true">
		                  &times;
		            </button>
		            <h4></h4>
		        </div>
			    <div class="modal-content modal-padding">
			     	<img  class="big-img" src="<?php echo $img_source.$goods['goods_image'];?>">
			    </div>
			  </div>
			</div>

	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_goods/goods_detail.js"></script>
