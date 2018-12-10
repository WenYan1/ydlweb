        <script>
          $(".products").css("border-left","6px solid #4E99B8");
          $(".products").css("background","#222222");
        </script>
        <title>产品管理</title>
        <link rel="stylesheet" type="text/css" href="../css/product/product_manager.css">
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
        
        <div class="container-fluid">
          
            <div class="row-fluid title-div">
              <p class="spacing-left">产品管理</p>
            </div>
            <div class="row-fluid col-md-12" >
              <a class="blue-border spacing-left" href="<?php echo Yii::$app->urlManager->createUrl(['/goods/add']);?>" id="add_product">
                <img src="../images/increase.png"/>
                  <span>添加产品</span>
              </a>
            </div>
            <div class="row-fluid col-md-12" >
              <div class="orange-label">
                <p class="label-title">已添加的产品</p>
                <p class="label-total">(共计: <?php echo  $goodsCount; ?>)</p>
              </div>
            </div>
           
          
        </div>
        

           <div class="product-list">
            <?php
              if($state === null){
            ?>
            <p class="font-size-default product-category font-bold blue under-line" id="all">全部</p>
            <p class="font-size-default product-category font-bold" id="checking">待审核</p>
            <p class="font-size-default product-category font-bold" id="checked">已审核</p>
            <p class="font-size-default product-category font-bold" id="not-pass">未通过</p>
            <?php }else if($state === "0"){ ?>
            <p class="font-size-default product-category font-bold" id="all">全部</p>
            <p class="font-size-default product-category font-bold  blue under-line" id="checking">待审核</p>
            <p class="font-size-default product-category font-bold" id="checked">已审核</p>
            <p class="font-size-default product-category font-bold" id="not-pass">未通过</p>
            <?php }else if($state === "1"){ ?>
            <p class="font-size-default product-category font-bold" id="all">全部</p>
            <p class="font-size-default product-category font-bold" id="checking">待审核</p>
            <p class="font-size-default product-category font-bold  blue under-line" id="checked">已审核</p>
            <p class="font-size-default product-category font-bold" id="not-pass">未通过</p>
            <?php }else{ ?>
            <p class="font-size-default product-category font-bold" id="all">全部</p>
            <p class="font-size-default product-category font-bold" id="checking">待审核</p>
            <p class="font-size-default product-category font-bold" id="checked">已审核</p>
            <p class="font-size-default product-category font-bold  blue under-line" id="not-pass">未通过</p> 
            <?php } ?>
            
            <p class="font-size-default vertical-line">|</p>
            <p class="font-size-default privider">供应商：</p>
            
            <select class="option-supplier" id = "supplier" >
              
              <?php
              if (!empty($suppliers)){
                  ?>
                  <option selected="selected" value="">全部</option>
                  <?php
	              foreach ($suppliers as $x => $x_value) {
		              foreach ($x_value as $y => $y_value) {
			              if($y == "id"){ ?>
                              <option value="<?php echo $y_value; ?>" <?php echo !empty($supplier) && $supplier == $y_value ? 'selected' : ''?>>
			              <?php }if($y == "company_name"){ ?><?php echo $y_value; ?></option>
			              <?php }
		              }
	              }
              }
              ?>
          
            </select>
           
            
            <input type="text" value="<?php if($search === null){}else{ echo $search;} ?>" placeholder="请输入产品关键字查询"  id="product_query" class="search input-padding">
            <div class="button_query">
               <img src="../images/search.jpg" alt="搜索"><span>搜索</span>
            </div>
             <form id="form-filter" action="<?php echo Yii::$app->urlManager->createUrl(['goods']);?>" method="get">
                  <input id="submit-btn" type="submit" value="Submit"/>
             </form>
          </div> 
         
          <table >
            <thead class="privider-list-head">
              <tr>
                <th class="product-item-1 protuct-center">序号</th>
                <th class="product-item-2 protuct-center">封面</th>
                <th class="product-item-3 protuct-center">产品名称</th>
                <th class="product-item-4 protuct-center">供应商</th>
                <th class="product-item-5 protuct-center">产品状态</th>
                <th class="product-item-6 protuct-center">操作</th>
              </tr>
              
            </thead>
            <tbody class="product-list">
                <?php 
                  $i = 1;
                  foreach ($models as $x => $x_val) {
                ?>
                <tr>
                  <td class="product-item-1 protuct-center"> <?php echo ($page - 1) * 10 + $i; ?> </td>
                  <td class="product-item-2 protuct-center">
                    <a href="<?php echo $img_source.$x_val['goods_image']; ?>" target="_Bank"><img class="product-img" style="cursor:pointer;" src="<?php echo $img_source.$x_val['goods_image']; ?>" ></a>
                  </td>
                  <td class="product-item-3 protuct-center product-option"><a href="<?php echo Yii::$app->urlManager->createUrl(['goods/goods-detail','id'=>$x_val['id']]);?>"><?php echo $x_val['goods_name']; ?></a></td>
                  <td class="product-item-4 protuct-center product-option"><a href="<?php echo Yii::$app->urlManager->createUrl(['/supplier/supplier-detail','supplier_id'=>$x_val['supplier_id']]);?>"><?php echo $x_val['supplier_name']; ?></a></td>
                  <td class="product-item-5 protuct-center"> 
                    <?php 
                      
                        if($x_val['state'] == 0){
                          echo "待审核"; 
                        }else if($x_val['state'] == 1){
                          echo "通过审核"; 
                        }else{
                          echo "未通过审核"; 
                        } 
                    ?>
                  </td>
                  <td class="product-item-6 protuct-center">
                      <span class="product-option"><a href="<?php echo Yii::$app->urlManager->createUrl(['goods/update','id'=>$x_val['id']]);?>">编辑</a></span>
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
        <nav class="privider-list-foot">
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
      
      <script type="text/javascript" src="../js/product/product_manage.js"></script>
     
