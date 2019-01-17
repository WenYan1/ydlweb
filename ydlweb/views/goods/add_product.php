<script>
    $(".products").css("border-left","6px solid #4E99B8");
    $(".products").css("background","#222222");
</script>
<meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
<title>添加商品</title>
<link rel="stylesheet" type="text/css" href="/css/product/add_product.css">

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

<div class="background-white">
    <div class="row-fluid title-div">
        <a href='<?php echo Yii::$app->urlManager->createUrl(['goods']);?>' class="linked"><p class="spacing-left" style="display: inline-block;">产品管理</p></a>
        <span> - </span>
        <p class="font-title-size product-title-space ">添加产品</p>
    </div>

    <form action=<?php echo Yii::$app->urlManager->createUrl(['goods/add']);?>
        enctype="multipart/form-data" method="post">

      <!--  <div class="row-fluid col-md-12" >
            <div class="orange-label">
                <p class="label-title">选择供应商</p>
            </div>
        </div>
        <div>
            <p class="font-content-size spacing-left">供应商</p>
            <select name="supplier_id" id="supplier_id" class="option-supplier">
			-->
              
                <input type="text" name="supplier_name" style="display:none;" id="supplier_name" value="" />
                <div class="row-fluid col-md-12" >
                    <div class="orange-label">
                        <p class="label-title">填写产品信息</p>
                    </div>
                </div>

                <div class="container-fluid message">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="product-message-left space--left">
                                <div class="space-top">
                                    <p class="font-content-size  font--title title-width" style="text-align: left;">报关品名:</p>

                                    <input type="text" required="required" name="goods_name" class="font--content input-padding" id="product-name" value="">

                                </div>
                                <div class="space-top">
                                    <p class="font-content-size font--title title-width" style="text-align: left;" >含税单价(RMB)：</p>
                                    <input type="text" required="required" name="original_price" class="font--content input-padding"  id="product-price" value="">
                                </div>
                                <div class="space-top" style="width: 380px">
                                    <p class="font-content-size font--title title-width" style="text-align: left;" >海关编码HS Code：</p>
                                    <input id="hs-code" type="text" required="required" name="hs_code" class="font--content input-padding"  id="product-code" value=""><br>
                                    <p id="search-rate">查询</p>
                                </div>
								<div class="space-top">
                                    <p class="font-content-size font--title title-width" style="text-align: left;" >申报要素：</p>
                                   <textarea class=" describe font--content input-padding" rows="3" cols="30" name="#####" placeholder="请填写海关要求的申报格式,如若不会，可为空"></textarea>
                                </div>
                                <div class="space-top">
                                    <p class="font-content-size font--title title-width" style="text-align: left;" >产品退税率：</p>
                                    <input type="text" placeholder="如12%税率则填写12" required="required" name="goods_taxrate" id="goods-rate" class="font--content input-padding" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="product-message-right">
                                <p class="font-content-size spacing-left product-add-tip">添加产品外观图片：</p>
                                <div class="product-img-style">
                                    <img src="../images/upload_bg.png" id="product_image">
                                    <input type="file" accept="image/*" id="up_image" style="display: none" name="goods_image" >
                                    <p class="product-img-tip">可传一张小于1M的图片</p>
                                </div>
                            </div>

                            <div class="space-top">
                                <p class="font-content-size font--title title-width" style="text-align: left;" >产品售卖链接：</p>
                                <input type="text" name="goods_url" class="font--content input-padding" value="">
                            </div>
                        </div>
						  <div class="col-md-4 col-lg-4">
     
							 <div class="product-message-right">
                                <p class="font-content-size spacing-left product-add-tip">或上传历史报关单：</p>
                                <div class="product-img-style">
                                    <img src="../images/upload_bg.png" id="product_file">
                                    <input type="file" id="up_file" style="display: none" name="up_file" >
                                    <p class="product-img-tip"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row-fluid col-md-12" style="background-color: #fff">
                    <div class="orange-label">
                        <p class="label-title">产品其他信息</p>
                    </div>
                </div>
                <div class="border-bottom-box">

                    <div id="product-list">
                        <ul>
                        </ul>
                    </div>
                    <p class="blue_border  spacing-left" id="add-product">
                        <a href="javascript:;">
                            <img src="../images/increase.png"/>
                            <span>添加</span>
                        </a>
                    </p>
                </div>


                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <input style="display:none;" id="sumbit-real" type="submit" value="Submit">                
            </form>
            <section class="submit submit-button">
                <p class="submit-btn">提交</p>
            </section> 

        </div>
        <script type="text/javascript" src="/js/product/add_product.js"></script>
