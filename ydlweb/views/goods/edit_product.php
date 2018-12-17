<script>
    $(".products").css("border-left","6px solid #4E99B8");
    $(".products").css("background","#222222");
</script>
<title>编辑产品</title>
<link rel="stylesheet" type="text/css" href="../css/product/add_product.css">
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>

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

<div class="background-white">

    <div class="row-fluid title-div">
        <a href='<?php echo Yii::$app->urlManager->createUrl(['goods']);?>' class="linked"><p class="spacing-left" style="display: inline-block;">产品管理</p></a>
        <span> - </span>
        <p class="font-title-size product-title-space ">编辑产品</p>
    </div>

    <input type="text" name="supplier_name" style="display:none;" id="supplier_name" value="" />
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
    <div class="row-fluid col-md-12" >
        <div class="orange-label">
            <p class="label-title">填写整件产品信息</p>
        </div>
    </div>

    <div class="container-fluid message">
        <div class="row">
            <form action=<?php echo Yii::$app->urlManager->createUrl(['goods/update','id'=>$goods['id']]);?> method="post" enctype="multipart/form-data">
                <div class="col-md-4 col-lg-4">
                    <div class="product-message-left space--left">
                        <div class="space-top">
                            <p class="font-content-size  font--title title-width" style="text-align: left;">报关品名:</p>

                            <input type="text" required="required" name="goods_name" class="font--content input-padding" id="product-name" value="<?php echo $goods['goods_name'];?>">

                        </div>
                        <div class="space-top">
                            <p class="font-content-size font--title title-width" style="text-align: left;" >含税单价(RMB)：</p>
                            <input type="text" required="required" name="original_price" class="font--content input-padding"  id="product-price" value="<?php echo $goods['original_price'];?>">
                        </div>
                        <div class="space-top" style="width: 380px">
                            <p class="font-content-size font--title title-width" style="text-align: left;" >HS Code：</p>
                            <input id="hs-code" type="text" required="required" name="hs_code" class="font--content input-padding"  id="product-code" value="<?php echo $goods['hs_code'];?>"><br>
                            <p id="search-rate">查询</p>
                        </div>

                        <div class="space-top">
                            <p class="font-content-size font--title title-width" style="text-align: left;" >产品退税率：</p>
                            <input type="text" placeholder="如12%税率则填写12" required="required" name="goods_taxrate" id="goods-rate" class="font--content input-padding" value="<?php echo $goods['goods_taxrate'];?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="product-message-right">
                        <p class="font-content-size spacing-left product-add-tip">产品图片：</p>
                        <div class="product-img-style">
                            <img src="<?php echo !empty($goods['goods_image']) ? $img_source.$goods['goods_image'] : '../images/upload_bg.png'?>" id="product_image">
                            <input type="file" accept="image/*" id="up_image" style="display: none" name="goods_image" >
                            <p class="product-img-tip">可传一张小于1M的图片</p>
                        </div>
                    </div>
                    <div class="space-top">
                        <p class="font-content-size font--title title-width" style="text-align: left;" >产品售卖链接：</p>
                        <input type="text" name="goods_url" class="font--content input-padding" value="<?=$goods['goods_url'];?>">
                    </div>
                </div>
				  <div class="product-message-right">
                        <p class="font-content-size spacing-left product-add-tip">或上传历史报关单：</p>
                        <div class="product-img-style">
                            <img src="" id="product_image">
                            <input type="file" accept="image/*" id="up_file" style="display: none" name="goods_file" >
                            <p class="product-img-tip">可传一张小于1M的图片</p>
                        </div>
                    </div>
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <input style="display:none;" id="sumbit-real" type="submit" value="Submit">

                <input type="text" id="goods_id" style="display: none;" name="id" value="<?php echo $goods['id'];?>">
            </form>
        </div>
    </div>


    <div class="border-bottom-box">
        <div class="row-fluid col-md-12" style="background-color: #fff">
            <div class="orange-label">
                <p class="label-title">填写每个产品信息</p>
            </div>
        </div>
        <div id="product-list">
            <ul>
                <?php foreach ($goodsAttr as $key => $value){ ?>
                <li id="<?php echo $value['id'];?>"> 
                    <div class="number">
                        <p class="font-content-size spacing-left number-space-top">
                            编号：<span id="count"> <?php echo count($goodsAttr)?></span> - <span class="num"><?php echo ++$key?></span>
                        </p>
                        <div class="setting">
                            <p class="font-content-size default-blue edit" >
                                <a href="javascript:;" class="linked delete"  id="<?php echo $value['id'];?>">
                                    删除
                                </a>
                            </p>
                            <p class="font-content-size edit-line" >|</p>
                            <p class="font-content-size default-blue edit editor">
                                <a href="javascript:;" class="linked edit " >编辑</a>
                            </p>
                        </div> 
                    </div>
                    <div class="pack">
                        <div class="container-fluid">
                            <div class="row ">
                                <div class="col-md-4 col-lg-4">
                                    <div class="product-message-left space-vertical space--left" >
                                        <div class=" space-top">
                                            <p class="font-content-size font--title title-width">
                                                单个产品净重(kg):
                                            </p> 
                                            <input type="text"  class="suttle delete-border font--content input-padding" name="attr" value="<?php echo $value['net_weight'];?>" disabled="true">
                                        </div> 
                                        <div class="space-top"> 
                                            <p class="font-content-size font--title title-width">单个产品毛重(kg):</p>
                                            <input type="text"   class="gross delete-border font--content input-padding" name="attr" value="<?php echo $value['gross_weight'];?>" disabled="true"> 
                                        </div>
                                        <div class="space-top">
                                            <p class="font-content-size font--title title-width">单个产品尺寸(cm):</p>
                                            <input type="text" class="p-input length delete-border font--content input-padding" name="goods_long delete-border" placeholder="长度" value="<?php echo $value['goods_long'];?>" disabled="true">
                                            <input type="text" class="p-input width delete-border font--content input-padding" style="margin-left: 7px" name="goods_wide delete-border" placeholder="宽度" value="<?php echo $value['goods_wide'];?>" disabled="true">
                                            <input type="text" class="p-input height delete-border font--content input-padding" style="margin-left: 7px" name="goods_height delete-border" placeholder="高度" value="<?php echo $value['goods_height'];?>" disabled="true"> 
                                        </div>
                                        <span id="<?php echo $value['id'];?>"  class="complete-edit font-content-size complete-hide">完成</span>
                                    </div> 
                                </div> 
                                <div class="row div col-md-4 col-lg-4">
                                    <div class="pack-message pack-space-left space-vertical">
                                        <p class="content-size spacing-left product-add-tip font--title " style="margin-left: 37px">包装箱内物品描述：</p>                 
                                        <textarea class="spacing-left describe delete-border font--content input-padding" rows="3" cols="30" name="attr_describe" placeholder="请添加不多于二十字的描述信息" 
                                        style="margin-left: 161px;" disabled="true"><?php echo trim($value['attr_describe']);?></textarea>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php }?>  

            </ul>
        </div>  
        <p class="blue_border space-vertical spacing-left" id="add-product">
            <a href="javascript:;">
                <img src="../images/increase.png"/>
                <span>添加</span>
            </a>
        </p>
    </div>
    <!-- <p class="submit-btn">提交</p> -->
    <section class="submit">
        <p class="submit-btn submit-button">提交</p>
    </section> 
</div>

<script type="text/javascript" src="/js/product/edit_product.js"></script>
