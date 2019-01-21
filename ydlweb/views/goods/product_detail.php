
        <title>产品详情</title>
        <script>
			$(".products").css("border-left","6px solid #4E99B8");
          	$(".products").css("background","#222222");
		</script>
        <link rel="stylesheet" type="text/css" href="../css/product/product_detail.css">

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
        <?php if($goods['state']==-1 && (!empty($goods['hs_code_remark']) || !empty($goods['original_price_remark']) || !empty($goods['goods_image_remark']))){ ?>
            <div class="alert alert-warning" role="alert">
                <strong>未通过原因!</strong> <br>
		        <?php if (!empty($goods['hs_code_remark'])){ ?>
                    <strong>HS Code:</strong> <?php echo $goods['hs_code_remark'];?><br>
		        <?php } ?>
		        <?php if (!empty($goods['original_price_remark'])){ ?>
                    <strong>含税单价(RMB):</strong> <?php echo $goods['original_price_remark'];?><br>
		        <?php } ?>
		        <?php if (!empty($goods['goods_image_remark'])){ ?>
                    <strong>产品图片:</strong> <?php echo $goods['goods_image_remark'];?><br>
		        <?php } ?>
            </div>
        <?php } ?>

        	<div style="padding-top:12px;border-bottom:1px solid #d8d8d8;">
        		<a href='<?php echo Yii::$app->urlManager->createUrl(['goods']);?>' class="spacing-left privider-sapce-top">
        			<p class="font-title-size">产品管理</p>
        		</a>
        		<p class="font-title-size privider-sapce-top"> - 产品详情</p>
        		
        	</div>
			<div class="divider-padding2">
				<div class="divider"></div>
			</div>
			<div class="container-fluid product-detail">
					
				<div class="orange-label">
					<p class="font-title-size spacing-left">产品信息</p>
				</div>
				
				<div class="row-fluid col-md-12">
					<div class="col-md-1">
						<p>报关品名 :</p>
					</div>
					<div class="col-md-11">
						<span><?php echo $goods['goods_name']; ?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12">
					<div class="col-md-1">
						<p>含税单价(RMB) :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['original_price']; ?></span>
					</div>
					<div class="col-md-1">
						<p>海关编码（HS Code） :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['hs_code']; ?></span>
					</div>
						<div class="col-md-1">
						<p>申报要素:</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['declaration_element']; ?></span>
					</div>
					<div class="col-md-1">
						<p>退税率 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['goods_taxrate']."%"; ?></span>
					</div>
				</div>
				<!--
				<div class="row-fluid col-md-12">
					<div class="col-md-1">
						<p>商品长 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['goods_long']; ?></span>
					</div>
					<div class="col-md-1">
						<p>商品宽 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['goods_wide']; ?></span>
					</div>
					<div class="col-md-1">
						<p>商品高 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['goods_height']; ?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12">
					<div class="col-md-1">
						<p>总箱数 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['box_number']; ?></span>
					</div>
					<div class="col-md-1">
						<p>总净重 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['net_weight']; ?></span>
					</div>
					<div class="col-md-1">
						<p>总毛重 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['gross_weight']; ?></span>
					</div>
					<div class="col-md-1">
						<p>总体积 :</p>
					</div>
					<div class="col-md-2">
						<span><?php echo $goods['goods_volume']; ?></span>
					</div>
				</div>-->
				<div class="row-fluid col-md-12">
					<div class="col-md-1">
						<p>产品图片 :</p>
					</div>
					<div class="col-md-3">
						<a target="_Blank" href="<?php echo $img_source.$goods['goods_image']; ?>">
							<img id="product-img" style="width:100px;height:100px;cursor:pointer;" src="<?php echo $img_source.$goods['goods_image']; ?>">
						</a>
					</div>
				</div>

			</div>

			<div class="container-fluid product-detail">
					
				<div class="orange-label">
					<p class="font-title-size spacing-left">产品信息列表</p>
				</div>
				<?php
					$i = 1;
					$num = count($goodsAttr);
					foreach ($goodsAttr as $key => $value) {
				?>
				<div class="row-fluid" >
					<div class="col-md-12 gray-backgroud">
						<span style="margin-lef:24px;"><?php echo $num." - ".$i; ?></span>
					</div>
				</div>
				
				<div class="row-fluid col-md-12">
					<div class="col-md-1">
						<p>长 :</p>
					</div>
					<div class="col-md-1">
						<span><?php echo $value['goods_long']; ?></span>
					</div>
					<div class="col-md-1">
						<p>宽 :</p>
					</div>
					<div class="col-md-1">
						<span><?php echo $value['goods_wide']; ?></span>
					</div>
					<div class="col-md-1">
						<p>高 :</p>
					</div>
					<div class="col-md-1">
						<span><?php echo $value['goods_height']; ?></span>
					</div>
				</div>
				<div class="row-fluid col-md-12">
					<div class="col-md-1">
						<p>净重 :</p>
					</div>
					<div class="col-md-1">
						<span><?php echo $value['net_weight']; ?></span>
					</div>
					<div class="col-md-1">
						<p>毛重 :</p>
					</div>
					<div class="col-md-1">
						<span><?php echo $value['gross_weight']; ?></span>
					</div>
					<div class="col-md-1">
						<p>物品描述 :</p>
					</div>
					<div class="col-md-7">
						<span><?php echo $value['attr_describe']; ?></span>
					</div>
				</div>
				<?php $i++; }?>

			</div>
		      
