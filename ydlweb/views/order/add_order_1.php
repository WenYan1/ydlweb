
        <title>添加订单</title>
        <script>
			$(".order").css("border-left","6px solid #4E99B8");
    		$(".order").css("background","#222222");
		</script>
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
        <link rel="stylesheet" type="text/css" href="../css/privider_manage/privider_about.css">
        <link rel="stylesheet" type="text/css" href="../css/public/jquery.datetimepicker.css"/ >
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
		<script type="text/javascript" src="../public/jquery.datetimepicker.js"></script>
		<script type="text/javascript" src="../js/privider_manage/add_privider.js"></script>

        	<div style="border-bottom:1px solid #d8d8d8;">
        		<a href='<?php echo Yii::$app->urlManager->createUrl(['order']);?>' class="spacing-left privider-sapce-top">
        			<p class="font-title-size">订单管理</p>
        		</a>
        		<p class="font-title-size privider-sapce-top"> - 添加订单</p>
        		
        	</div>
			<div class="divider-padding2">
				<div class="divider"></div>
			</div>
			<div>
			<div>
			<p class="font-title-size privider-sapce-top"> 1.收汇方式与报关方式</p>
			</div>
			<form actoin=<?php echo Yii::$app->urlManager->createUrl(['add']); ?>
				enctype="multipart/form-data" method="post">
			<div class="container-fluid add-privider-form">
			
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>服务类型 :</p>
					</div>
					<div class="export-right">
						<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp退税&nbsp&nbsp</label>
						<label><input name="#####" type="radio" value="2" />&nbsp&nbsp退税+代采购</label></p>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>结算方式 :</p>
					</div>
					<div class="export-right">
						<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp先定金再交货时付尾款&nbsp&nbsp</label>
						<label><input name="#####" type="radio" value="2" />&nbsp&nbsp交货时付全款</label>
						<label><input name="#####" type="radio" value="3" />&nbsp&nbsp交货后付款</label></p>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>报关口岸 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="#####" name="#####" value=""/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>报关方式 :</p>
					</div>
					<div class="col-md-7">
						<div class="export-right">
						<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp客户自行报关&nbsp&nbsp</label>
						<label><input name="#####" type="radio" value="2" />&nbsp&nbsp易贸通报关（提供报关资料）</label></p>
					</div>
					</div>
				</div>	
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>报关联系人 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="#####" name="#####" value=""/>
					</div>
				</div>
				</div>
				<div>
					<p class="font-title-size privider-sapce-top"> 2.产品及开票人信息</p>
				</div>
				<div class="container-fluid add-privider-form">
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>报关币种 :</p>
						</div>
						<div class="export-right">
							<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp美金USD&nbsp&nbsp</label>
							<label><input name="#####" type="radio" value="2" />&nbsp&nbsp人民币RMB</label></p>
					</div>
				</div>
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>成交方式 :</p>
						</div>
						<div class="export-right">
							<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbspFOB&nbsp&nbsp</label>
							<label><input name="#####" type="radio" value="2" />&nbsp&nbspCIF</label>
							<label><input name="#####" type="radio" value="3" />&nbsp&nbspC&F </label></p>
						</div>
					</div>
				
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>录入价格方式 :</p>
						</div>
						<div class="export-right">
							<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp指定货物报关发票金额&nbsp&nbsp</label>
							<label><input name="#####" type="radio" value="2" />&nbsp&nbsp指定货物报关美金金额</label>
							</p>
						</div>
					</div>
				
	
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>包装方式 :</p>
						</div>
						<div class="export-right">
							<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp整装（同一包装中只含一种商品）&nbsp&nbsp</label>
							<label><input name="#####" type="radio" value="2" />&nbsp&nbsp混装（任一包装中含两种或以上产品）</label>
							</p>
						</div>
					
				</div>
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>运抵国（地区） :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>到达口岸 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>装柜方式 :</p>
						</div>
						<div class="export-right">
							<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp整柜出口&nbsp&nbsp</label>
							<label><input name="#####" type="radio" value="2" />&nbsp&nbsp拼柜出口</label>
							<label><input name="#####" type="radio" value="3" />&nbsp&nbsp不使用集装箱出口</label>
							</p>
						</div>
					
				</div>
				<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>整体包装件数 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>包装种类 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
				</div>
				<div class="container-fluid add-privider-form" >
					<table id="table" class="table">
								<thead>
									<tr>
										<th style="width:10%">出货产品清单</th>
										<th style="width: 10%">总净重(KG)</th>
										<th style="width: 10%">总毛重(KG)</th>
										<th style="width:10%">产品数量和单位</th>
										<th style="width:10%">单价</th>
										<th style="width: 10%">货值</th>
										<th style="width: 10%">法定数量和单位</th>
										<th style="width: 10%">开票人</th>
										<th style="width: 10%">估算汇率</th>
									</tr>
								</thead>
								<form>
									<tbody style="background: #fff;">
										<tr>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value=""  style="width:200px" /></td>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value=""  style="width:50px"/></td>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/></td>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/>
																	<input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/>
																	</td>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/></td>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px" /></td>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/>
																	<input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/></br>
																	<input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/>
																	<input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/>
																	</td>
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value="" style="width:200px"/></td>	
											<td style="width: 10%"><input class="input-padding" type="text" id="#####" name="#####" value="" style="width:50px"/></td>											
										</tr>
									</tbody>
								</form>
							</table>
				</div>
			
				
				</div>
				</div>
				<div>
					<p class="font-title-size privider-sapce-top"> 3.报关信息</p>
				</div>
				<div class="container-fluid add-privider-form">
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>预计出货日期:</p>
						</div>
							<div class="time col-md-7">
								<input class="input-padding" id="date" name="#####" type="text" >
							</div>
					</div>
				
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>境外收货人 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
				
					</div>
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>地址 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>联系方式:</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
				
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>贸易国（地区） :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>是否特殊关系 :</p>
						</div>
						<div class="export-right">
							<p><label><input  name="#####" type="radio" value="1" checked="checked"/>&nbsp&nbsp是&nbsp&nbsp</label>
							<label><input name="#####" type="radio" value="2" />&nbsp&nbsp否</label>
							</p>
						</div>
					</div>
				
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>境内货源地 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
				
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>目前货物存放地址:</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
				
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>合同编号:</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="#####" name="#####" value=""/>
						</div>
					</div>
				</div>
				<div>
					<p class="font-title-size privider-sapce-top"> 4.附件上传</p>
				</div>
				
				<div class="container-fluid submit-img" style="background-color: #FAFAFA; ">
                <div class="container-fluid submit-img" style="background-color: #FAFAFA;">
                    <div class="row-fluid col-md-12" style=" text-align:center">
                        <div class="col-md-1" >
                            上传采购订单或PI：
                        </div>
                        <div class="col-md-2" >
                            <img id = "business-license-btn" src="../images/upload_bg.png"/>
                            <input id="business-license-input" type="file"  name="#####" />
                        </div>
            
                        <div class="col-md-1" >
                            其他：
                        </div>
                        <div class="col-md-2" >
                            <img id="other_image-btn" src="../images/upload_bg.png"/>
                            <input id="other_image-input" type="file"  name="#####"/>
                        </div>
                    </div>
                
			</div>
			</div>
			<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<input style="display:none;" id="sumbit-real" type="submit" value="Submit">
		</form>
		<div class="container-fluid" style="margin-top:50px;">
			<div class="row-fluid col-md-12">
				<p class="submit-btn">提交</p>
			</div>
		</div>
</div>
		<script>
	    	$('#date').datetimepicker({
	    		lang:'ch',
	    		format:'Y-m-d',
	    		timepicker:false,
	    	});
	  	</script>
		

