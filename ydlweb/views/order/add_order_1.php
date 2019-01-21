
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
		<script type="text/javascript" src="../js/order/order1.js"></script>

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
			<form actoin=<?php echo Yii::$app->urlManager->createUrl(['add']); ?> enctype="multipart/form-data" method="post">
			<div class="container-fluid add-privider-form">
			
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>服务类型 :</p>
					</div>
					<div class="export-right">
						<p><label><input  name="service_type" type="radio" value="1" checked="checked"/>&nbsp&nbsp退税&nbsp&nbsp</label>
						<label><input name="service_type" type="radio" value="2" />&nbsp&nbsp代采购</label>
						<label><input name="service_type" type="radio" value="3" />&nbsp&nbsp退税+代采购</label>
						</p>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>退税手续费率:</p>
					</div>
					<div class="col-md-7">
						<input data-action="cost" class="input-padding" type="text" name="drawback_brokerage" id="drawback_brokerage" value="" />%
					</div>
		
				</div>
					
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>需要垫款天数:</p>
					</div>
					<div class="export-right">
						<p>
						<label><input  name="advance_days" type="radio" value="1" checked="checked"/>&nbsp&nbsp90天&nbsp&nbsp</label>
						<label><input name="advance_days" type="radio" value="2" />&nbsp&nbsp120天</label>
						<label><input name="advance_days" type="radio" value="3" />&nbsp&nbsp不需要</label>
						</p>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>年化利息报价:</p>
					</div>
					<div class="col-md-7">
						<input data-action="cost" class="input-padding" type="text" name="interest_offer" id="interest_offer" value="" />%
					</div>
		
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>结算方式 :</p>
					</div>
					<div class="export-right">
						<p><label><input  name="settlement_type" type="radio" value="1" checked="checked"/>&nbsp&nbsp先订金再交货时付尾款&nbsp&nbsp</label>
						<label><input name="settlement_type" type="radio" value="2" />&nbsp&nbsp交货时付全款</label>
						<label><input name="settlement_type" type="radio" value="3" />&nbsp&nbsp交货后付款</label></p>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>订金比例:</p>
					</div>
					<div class="col-md-7">
						<input class=""  type="text" id="deposit_ratio" name="deposit_ratio" value=""/>%
					</div>
		
				</div>
				
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>或订金金额:</p>
					</div>
					<div class="col-md-7">
						<input class="" type="text" id="order_amount" name="order_amount" value=""/>
					</div>
		
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>报关口岸 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="customs_port" name="customs_port" value=""/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>报关方式 :</p>
					</div>
					<div class="col-md-7">
						<div class="export-right">
						<p><label><input  name="customs_port_type" type="radio" value="1" checked="checked"/>&nbsp&nbsp客户指定报关行&nbsp&nbsp</label>
						<label><input name="customs_port_type" type="radio" value="2" />&nbsp&nbsp易贸通指定报关行</label></p>
					</div>
					</div>
				</div>	
					<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>报关形式 :</p>
					</div>
					<div class="col-md-7">
						<div class="export-right">
						<p><label><input name="customs_port_froms" type="radio" value="1" checked="checked"/>有纸化报关（易贸通寄出纸质报关资料）&nbsp&nbsp</label>
						<label><input name="customs_port_froms" type="radio" value="2" />&nbsp&nbsp无纸化报关（易贸通提供电子版报关资料）</label></p>
					</div>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>报关联系人 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="customs_contact" name="customs_contact" value=""/>
					</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
					<div class="col-md-3 col-md-offset-2">
						<p>联系方式 :</p>
					</div>
					<div class="col-md-7">
						<input class="input-padding" type="text" id="customs_contact_tel" name="customs_contact_tel" value=""/>
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
							<p>
                                <label><input  name="customs_currency" type="radio" value="1" checked="checked"/>&nbsp&nbsp美金USD</label>
							    <label><input name="customs_currency" type="radio" value="2" />&nbsp&nbsp人民币RMB&nbsp&nbsp</label>
                            </p>
					</div>
				</div>
			
				
                <div class="row-fluid col-md-12 input-height">
                    <div class="col-md-3 col-md-offset-2">
                        <p>成交方式 :</p>
                    </div>
                    <div class="export-right">
                        <p><label><input  name="cost_type" type="radio" value="1" checked="checked"/>&nbsp&nbspFOB&nbsp&nbsp</label>
                        <label><input name="cost_type" type="radio" value="2" />&nbsp&nbspCIF</label>
                        <label><input name="cost_type" type="radio" value="3" />&nbsp&nbspC&F </label></p>
                    </div>
                </div>
				
			
				
                <div class="row-fluid col-md-12 input-height">
                    <div class="col-md-3 col-md-offset-2">
                        <p>录入价格方式 :</p>
                    </div>
                    <div class="export-right">
                        <p><label><input  name="input_price_type" type="radio" value="1" checked="checked"/>&nbsp&nbsp报关发票金额固定&nbsp&nbsp</label>
                        <label><input name="input_price_type" type="radio" value="2" />&nbsp&nbsp报关美金金额固定</label>
                        </p>
                    </div>
                </div>
				
	
				
                <div class="row-fluid col-md-12 input-height">
                    <div class="col-md-3 col-md-offset-2">
                        <p>包装方式 :</p>
                    </div>
                    <div class="export-right">
                        <p><label><input  name="packing_way" type="radio" value="1" checked="checked"/>&nbsp&nbsp整装（同一包装中只含一种商品）&nbsp&nbsp</label>
                        <label><input name="packing_way" type="radio" value="2" />&nbsp&nbsp混装（任一包装中含两种或以上产品）</label>
                        </p>
                    </div>
					
				</div>

                <div class="row-fluid col-md-12 input-height">
                    <div class="col-md-3 col-md-offset-2">
                        <p>运抵国（地区） :</p>
                    </div>
                    <div class="col-md-7">
                        <input class="input-padding" type="text" id="destination_country_or_area" name="destination_country_or_area" value=""/>
                    </div>
                </div>


                <div class="row-fluid col-md-12 input-height">
                    <div class="col-md-3 col-md-offset-2">
                        <p>到达口岸 :</p>
                    </div>
                    <div class="col-md-7">
                        <input class="input-padding" type="text" id="arrive_port" name="arrive_port" value=""/>
                    </div>
                </div>

				
                <div class="row-fluid col-md-12 input-height">
                    <div class="col-md-3 col-md-offset-2">
                        <p>装柜方式 :</p>
                    </div>
                    <div class="export-right">
                        <p><label><input  name="risk_container_type" type="radio" value="1" checked="checked"/>&nbsp&nbsp整柜出口&nbsp&nbsp</label>
                        <label><input name="risk_container_type" type="radio" value="2" />&nbsp&nbsp拼柜出口</label>
                        <label><input name="risk_container_type" type="radio" value="3" />&nbsp&nbsp不使用集装箱出口</label>
                        </p>
                    </div>
                </div>
				
				<div class="row-fluid col-md-12 input-height">
                    <div class="col-md-3 col-md-offset-2">
                        <p>国内运杂费:</p>
                    </div>
                    <div class="col-md-7">
                        <input class="input-padding" type="text" id="freight" name="#####" value=""/>
						<span style="color:#9e9e9e;">通过腾邦付的国内运杂费RMB，若无写0</span>
                    </div>
                </div>
				
				<div class="container-fluid add-privider-form" >
					<table id="table" class="table">
                        <thead>
                            <tr>
                                <th>出货产品清单</th>
								<th >产品退税率</th>
                                <th >总净重(KG)</th>
                                <th >总毛重(KG)</th>
                                <th>申报数量和单位</th>
								<th >法定数量和单位</th>
                                <th >含税单价</th>
								<th >开票金额</th>
                                <th >供应商</th>
								<th >预计税款</th>
								<th >退税手续费</th>
								<th >预计利息</th>
								<th >报关汇率</th>
                                <th >报关金额</th>
								<th >报关单价</th>
                            </tr>
                        </thead>
                        <tbody style="background: #fff;">
                            <tr>
							<!--出货产品清单-->
                                <td style="width: 6%">
                                    <select name="goods[0][goods_id]" id="goods_id" data-field="true" data-field-name="goods_id" style="width: 100px;">
                                        <option value="">请选择</option>
                                        <?php foreach ($goods as $item){ ?>
                                            <option value="<?=$item['id']?>"><?=$item['goods_name']?></option>
                                        <?php } ?>
                                    </select>
                                </td>
								<!--产品退税率-->
								<td style="width: 6%"><input data-action="cost" class="input-padding" type="text" name="goods[0][tax_rebate_rate]" data-field="true" data-field-name="tax_rebate_rate" value=""  style="width:30px"/>%</td>
                               <!--总净重-->
							   <td style="width: 6%"><input class="input-padding" type="text" name="goods[0][net_weight]" id="net_weight" value="" data-field="true" data-field-name="net_weight" style="width:60px"/></td>
                                <!--总毛重-->
								<td style="width: 6%"><input class="input-padding" type="text" name="goods[0][gross_weight]" id="gross_weight" data-field="true" data-field-name="gross_weight" value="" style="width:60px"/></td>
                                <!--申报数量和单位--> 
								<td style="width: 6%"><input class="input-padding" data-action="cost" type="text" name="goods[0][box_number]" data-field="true" data-field-name="box_number" id="box_number" value="" style="width:60px"/>
                                    <select name="goods[0][box_unit]" id="box_unit" data-field="true" data-field-name="box_unit" style="width: 40px;">
                                        <option value=""></option>
                                        <?php $unit_list = Tool::getUnitList();
                                            foreach ($unit_list as $_key => $_item){
                                        ?>
                                        <option value="<?=$_key?>"><?=$_item?></option>
                                        <?php } ?>
                                    </select>
                                </td>
								<!--法定数量和单位-->
								  <td style="width: 6%">
                                    <input class="input-padding" type="text" name="goods[0][standard_count]" data-field="true" data-field-name="standard_count" id="standard_count" value="" style="width:60px"/>
									 <select name="goods[0][standard_count_unit]" data-field="true" data-field-name="standard_count_unit" style="width: 40px;">
                                        <option value=""></option>
                                        <?php $unit_list = Tool::getUnitList();
                                            foreach ($unit_list as $_key => $_item){
                                        ?>
                                        <option value="<?=$_key?>"><?=$_item?></option>
                                        <?php } ?>
                                    </select>
									</br>
                                    <input class="input-padding" type="text" name="goods[0][standard_count2]" data-field="true" data-field-name="standard_count2" id="standard_count2" value="" style="width:60px"/>
                                     <select name="goods[0][standard_count2_unit]" data-field="true" data-field-name="standard_count2_unit" style="width: 40px;">
                                        <option value=""></option>
                                        <?php $unit_list = Tool::getUnitList();
                                            foreach ($unit_list as $_key => $_item){
                                        ?>
                                        <option value="<?=$_key?>"><?=$_item?></option>
                                        <?php } ?>
                                    </select>
                                </td>
								<!--含税单价-->
							   <td style="width: 6%"><input class="input-padding" type="text" name="goods[0][goods_price]" data-field="true" data-field-name="goods_price" id="goods_price" value="" style="width:50px"/></td>
                               <!--开票金额-->
							   <td style="width: 6%"><input data-action="cost" class="input-padding" type="text" name="goods[0][invoice_amount]" data-field="true" data-field-name="invoice_amount" id="invoice_amount" value="" style="width:60px"/></td>
								<!--开票人-->	
							   <td style="width: 6%">
                                    <select name="goods[0][supplier_id]" data-field="true" data-field-name="supplier_id" id="supplier_id" style="width: 100px;">
                                      
		                                <?php foreach ($supplier as $item){ ?>
                                            <option value="<?=$item['id']?>"><?=$item['company_name']?></option>
		                                <?php } ?>
                                    </select>
                                </td>
								 <!--预计税款-->
								 <td style="width: 6%"><input class="input-padding" type="text" name="goods[0][tax_cost]" data-field="true" data-field-name="tax_cost" id="tax_cost" value="" style="width:60px"/></td>
							   <!--退税手续费-->
							   <td style="width: 6%"><input class="input-padding" type="text" name="goods[0][estimated_cost]" data-field="true" data-field-name="estimated_cost" id="estimated_cost" value="" style="width:60px"/></td>
                             
							  <!--预计利息-->
							   <td style="width: 6%"><input class="input-padding" type="text" name="goods[0][estimated_interest]" data-field="true" data-field-name="estimated_interest" id="estimated_interest" value="" style="width:60px"/></td>
							  <!--报关汇率-->
							  <td style="width: 6%"><input data-action="cost"  class="input-padding" type="text" name="goods[0][estimate]" data-field="true" data-field-name="estimate" id="estimate" value="" style="width:60px"/></td>
                               <!--报关总金额-->
							  <td style="width: 6%"><input class="input-padding" type="text" name="goods[0][subtotal]" id="subtotal" value="" data-field="true" data-field-name="subtotal" style="width:60px" /></td>
							 <!--报关单价-->
							 <td style="width: 6%"><input class="input-padding" type="text" name="goods[0][customs_declaration_price]" data-field="true" data-field-name="customs_declaration_price"  id="customs_declaration_price" value="" style="width:60px"/></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="left" style="width: 100px">
                        <p id="add_product" class="btn btn-primary" style="color: #ffffff">添加产品</p>
                    </div>
				</div>

			<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>整体包装件数 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="transport_package_count" name="transport_package_count" value=""/>
						</div>
				</div>
				<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>包装种类 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="pack_type_list" name="pack_type_list" value=""/>
						</div>
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
								<input class="input-padding" id="delivery_time" name="delivery_time" type="text" >
							</div>
					</div>
				
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>境外收货人 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="buyers_name" name="buyers_name" value=""/>
						</div>
				
					</div>
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>地址 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="buyers_address" name="buyers_address" value=""/>
						</div>
					</div>
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>联系方式:</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="buyers_contact" name="buyers_contact" value=""/>
						</div>
					</div>
				
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>贸易国（地区） :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="trading_country" name="trading_country" value=""/>
						</div>
					</div>
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>是否特殊关系 :</p>
						</div>
						<div class="export-right">
							<p><label><input  name="is_special_relation" type="radio" value="1" checked="checked"/>&nbsp&nbsp是&nbsp&nbsp</label>
							<label><input name="is_special_relation" type="radio" value="2" />&nbsp&nbsp否</label>
							</p>
						</div>
					</div>
				
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>境内货源地 :</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="goods_supply_id" name="goods_supply_id" value=""/>
						</div>
					</div>
				
				
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>目前货物存放地址:</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="goods_save_adr" name="goods_save_adr" value=""/>
						</div>
					</div>
				
			
				
					<div class="row-fluid col-md-12 input-height">
						<div class="col-md-3 col-md-offset-2">
							<p>合同编号:</p>
						</div>
						<div class="col-md-7">
							<input class="input-padding" type="text" id="contract_type" name="contract_type" value=""/>
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
                            <img id = "purchasing_order_btn" src="../images/up.png"/>
                            <input id="purchasing_order_input" type="file"  name="purchasing_order" />
                        </div>
            
                        <div class="col-md-1" >
                            其他：
                        </div>
                        <div class="col-md-2" >
                            <img id="other_file_btn" src="../images/up.png"/>
                            <input id="other_file_input" type="file"  name="other_file"/>
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
	    	$('#delivery_time').datetimepicker({
	    		lang:'ch',
	    		format:'Y-m-d',
	    		timepicker:false,
	    	});

	    	var ZJJ = {
                orderName: function () {
                    $("#table tbody tr").each(function (i) {
                        var tr = $(this);
                        var fields = tr.find('[data-field="true"]');
                        console.log(i);
                        fields.each(function () {
                            var that = $(this);
                            var field_name = that.attr('data-field-name');
                            that.attr('name', 'goods[' + i + '][' + field_name + ']');
                        });
                    });
                },
                cost:function(){
                    $("#table tbody tr").each(function () {
                        var tr = $(this);

                        //预计费用=开票金额/1.16*退税率*退税手续费
                        var invoice_amount =tr.find("[data-field-name='invoice_amount']").val();
                        var drawback_brokerage=$("#drawback_brokerage").val();

                        //预计利息=（开票金额-税款-订金）*利息报价/360*天数
                        var  interest_offer =$("#interest_offer").val();
                        var tax_rebate_rate=tr.find("[data-field-name='tax_rebate_rate']").val();

                        var tax =parseFloat(invoice_amount)/1.16*parseFloat(tax_rebate_rate)/100;

                        //预计税款tax_cost
                        tr.find("[data-field-name='tax_cost']").val(tax.toFixed(2));

                        var  sum=tax*parseFloat(drawback_brokerage)/100;
                        var estimated_cost=sum.toFixed(2);
                        tr.find("[data-field-name='estimated_cost']").val(estimated_cost);
                        var amount = $(".row-fluid").find("[name='advance_days']:checked").val();
                        var advance_days=0;
                        if(amount=="1"){
                            advance_days=90;
                        }else if(amount=="2") {
                            advance_days=120;
                        }else {
                            advance_days=0;
                        }

                        var deposit=0;
                        var a=0;
                        if($("#deposit_ratio").val()==''){
                            deposit=$("#order_amount").val();
                            a=parseFloat(invoice_amount)-tax-deposit;
                        }else if($("#order_amount").val()==''){
                            deposit=parseFloat($("#deposit_ratio").val())/100;
                            a=parseFloat(invoice_amount)-tax-parseFloat(invoice_amount)*deposit;
                        }

                        var estimated_interest=(a*parseFloat(interest_offer)/36000*parseFloat(advance_days)).toFixed(2);
						console.log(estimated_interest);
                        tr.find("[data-field-name='estimated_interest']").val(estimated_interest);

                        //报关总金额=【发票金额（1-1/1.16*退税率）+预计费用+预计利息+国内运杂费】/报关汇率
                        var invoice_amount_1=parseFloat(invoice_amount)-tax;//发票金额
						var freight =$("#freight").val();
                        var estimate =parseFloat(tr.find("[data-field-name='estimate']").val());
                        var b =invoice_amount_1+parseFloat(estimated_cost)+parseFloat(estimated_interest)+parseFloat(freight);
                        var subtotal =b/estimate;
                        tr.find("[data-field-name='subtotal']").val(subtotal.toFixed(2));

                        //报关单价=报关总金额/产品数量
                        var box_number = tr.find("[data-field-name='box_number']").val();

                        tr.find("[data-field-name='customs_declaration_price']").val((subtotal/parseInt(box_number)).toFixed(2));
                    });
                },
                initCost: function () {
                    var view = this;
                    $(".main-content").on("keyup blur", '[data-action="cost"]', function () {
                        view.cost();
                    });
                },
                init:function(){
	    	        var view = this;
                    $("#table").on('click','[data-action="delete"]',function(){
                        $(this).parents().eq(1).remove();
                        view.orderName();
                    });

                    $("#add_product").on('click',function(){
                        var table = $("#table");
                        var template = table.find("tbody tr").eq(0);
                        var tr = $(template).clone();

                        tr.find("input").val("");
                        tr.find("td").eq(0).prepend('<a href="javascript:;" data-action="delete"><i class="glyphicon glyphicon-remove"></i></a>');

                        table.find("tbody").append(tr);
                        view.orderName();
                    });

                    view.initCost();
                }
            };

            ZJJ.init();
	  	</script>
		

