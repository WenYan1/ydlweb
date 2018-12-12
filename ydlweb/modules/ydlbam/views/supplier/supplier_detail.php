<link rel="stylesheet" href="/css/ydlbam_css/css_supplier/supplier.css">
<meta name="csrf-token" content="<?=Yii::$app->request->csrfToken?>"/>
<script>
	$("#suplier-manage").css("border-left","6px solid #4e99b8");
	$("#suplier-manage").css("color","#4e99b8");
</script>
<div class="body-main">
	<div class="main-content">
		<div class="content-position">
			<span class="text-name">您的位置： </span>

			<a href='<?php echo Yii::$app->urlManager->createUrl(['/ydlbam/supplier']) ?>'>供应商管理</a>

			<span class="text-value">  > 供应商详情</span>
		</div>
		<div class="orange-label">
			<p>操作</p>
		</div>

		<?php
            //todo
		    //$img_source = "http://172.18.240.62:8080/uploads/";
			$img_source = "/uploads/";
		?>
					
		<div class="space_top ">
			<div>
				<span class="text-value ">当前状态：</span>
				<span class="text-value space_left status-ing" id="<?php echo $supplier["supplier_state"];?>" >
					<?php

						if ($supplier["supplier_state"] == -1) {
							echo "未通过审核";
						}else if ($supplier["supplier_state"] == 0) {
							echo "待审核";
						}else if ($supplier["supplier_state"] == 1) {
							echo "通过审核";
						}
					?>
				</span>
			</div>
			<div>
				<span class="text-value " >修改状态：</span>
				<select name="" id="supplier-status" class="text-value space_left option-supplier">
					<option value="0">待审核</option>
					<option value="1">通过审核</option>
					<option value="-1">未通过审核</option>
				</select>
				<span class=" font-blue space_left" id="change_state">确认修改</span>
				<input type="hidden" value="<?php echo $supplier["id"];?>" id="supplier-hide">
			</div>
		</div>
        <form actoin="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/supplier/supplier-detail']); ?>" enctype="multipart/form-data" method="post">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <div class="orange-label">
                <p>开票人信息</p>
            </div>
			<div>
				<div class="container-fluid">
					<div class="row-fluid col-xs-12">
						<div class="col-xs-2">
							<span class="text-name name-float">开票人公司名称：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["company_name"];?></span>
						</div>
					</div>
					<div class="row-fluid col-xs-12">
						<div class="col-xs-2">
							<span class="text-name name-float">开票人财务联系人：</span>
						</div>
						<div class="col-xs-9">
							<span class="value-float"><?php echo $supplier["finance_contacts"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">开票人地址：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["goods_source"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">开票人联系方式：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["tel"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">开票人增值税率：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["tax_rate"]."%";?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="orange-label">
				<p>公司信息</p>
			</div>
			<div>
				<div class="container-fluid">
					<div class="row-fluid col-xs-12">
						<div class="col-xs-2">
							<span class="text-name name-float">纳税人识别号：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["identify_number"];?></span>
						</div>
					</div>
					<div class="row-fluid col-xs-12">
						<div class="col-xs-2">
							<span class="text-name name-float" style="text-align: right;width: 160px;">一般纳税人认定时间：</span>
						</div>
						<div class="col-xs-9">
							<span class="value-float"><?php echo $supplier["cognizance_time"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">出口权：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php if($supplier['export_right'] == 1){echo "有";}else{echo "无";}?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">联系人：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["company_name"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">联系人邮箱：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["user_email"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">联系人电话：</span>
						</div>
						<div class="col-xs-9">
							<span class="text-value value-float"><?php echo $supplier["tel"];?></span>
						</div>
					</div>
					<div class="row-fluid col-sm-12">
						<div class="col-xs-2">
							<span class="text-name name-float">营业执照：</span>
						</div>
						<div class="col-xs-2">
							 <img id="business-license-btn" src="<?php  echo $img_source.$supplier["business_license"];?>" class="company-image " alt="营业执照">
						</div>
						<div class="col-xs-2">
							<span class="text-name name-float">一般纳税人资格资质</span>
						</div>
						<div class="col-xs-2">
							 <img id="tax-reg-btn" src="<?php echo $img_source.$supplier["tax_registration"];?>" class="company-image " alt="税务登记">
						</div>
						<div class="col-xs-2">
							<span class="text-name name-float">近期开过的发票样本：</span>
						</div>
						<div class="col-xs-2">
							 <img id="organization-code-btn" src="<?php echo $img_source.$supplier["organization_code"];?>" class="company-image " alt="组织机构代码">
						</div>
					</div>
                    <div class="row-fluid col-sm-12">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <label>原因</label>
                                <textarea class="form-control" name="business_license_remark" style=" width: 201px; height: 122px;resize:none"><?php echo $supplier["business_license_remark"];?></textarea>
                            </div>
                            <div class="input-group">
                                <label>风控附件上传</label>
                                <input type="file" name="business_license_risk">
                                <?php $_temp = $img_source.$supplier["business_license_risk"]; if (!empty($supplier["business_license_risk"])){ ?>
                                <a href="<?php echo $_temp;?>">已上传点击下载</a>
                                <?php }else{ ?>
                                    <span class="red">未上传</span>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-xs-2"></div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <label>原因</label>
                                <textarea class="form-control" name="tax_registration_remark" style=" width: 201px; height: 122px;resize:none"><?php echo $supplier["tax_registration_remark"];?></textarea>
                            </div>
                            <div class="input-group">
                                <label>风控附件上传</label>
                                <input type="file" name="tax_registration_risk">
	                            <?php $_temp = $img_source.$supplier["tax_registration_risk"]; if (!empty($supplier["tax_registration_risk"])){ ?>
                                    <a href="<?php echo $_temp;?>">已上传点击下载</a>
	                            <?php }else{ ?>
                                    <span class="red">未上传</span>
	                            <?php }?>
                            </div>
                        </div>
                        <div class="col-xs-2"></div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <label>原因</label>
                                <textarea class="form-control" name="organization_code_remark" style=" width: 201px; height: 122px;resize:none"><?php echo $supplier["organization_code_remark"];?></textarea>
                            </div>
                            <div class="input-group">
                                <label>风控附件上传</label>
                                <input type="file" name="organization_code_risk">
	                            <?php $_temp = $img_source.$supplier["organization_code_risk"]; if (!empty($supplier["organization_code_risk"])){ ?>
                                    <a href="<?php echo $_temp;?>">已上传点击下载</a>
	                            <?php }else{ ?>
                                    <span class="red">未上传</span>
	                            <?php }?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="supplier_id" value="<?php echo $supplier["id"];?>">
                    <button type="submit" class="btn btn-primary">保存</button>
				</div>
			</div>
        </form>
			<div class="modal fade bs-example-modal-lg" id="bl-dialog" tabindex="-1" role="dialog" aria-labelledby="blLabel">
			  <div class="modal-dialog modal-lg">
			  	<div class="modal-header" style="border-bottom:0px;">
		            <button type="button" class="close" 
		               data-dismiss="modal" aria-hidden="true">
		                  &times;
		            </button>
		            <h4></h4>
		        </div>
			    <div class="modal-content modal-padding">
			     	<img  class="big-img" src="<?php echo $img_source.$supplier['business_license'];?>">
			    </div>
			  </div>
			</div>


			<div class="modal fade bs-example-modal-lg" id="tr-dialog" tabindex="-1" role="dialog" aria-labelledby="trLabel">
			  <div class="modal-dialog modal-lg">
			  	<div class="modal-header" style="border-bottom:0px;">
		            <button type="button" class="close" 
		               data-dismiss="modal" aria-hidden="true">
		                  &times;
		            </button>
		            <h4></h4>
		        </div>
			    <div class="modal-content modal-padding">
			     	<img class="big-img" src="<?php echo $img_source.$supplier['tax_registration'];?>">
			    </div>
			  </div>
			</div>

			
			<div class="modal fade bs-example-modal-lg" id="oc-dialog" tabindex="-1" role="dialog" aria-labelledby="ocLabel">
			  <div class="modal-dialog modal-lg">
			  	<div class="modal-header" style="border-bottom:0px;">
		            <button type="button" class="close"
		               data-dismiss="modal" aria-hidden="true">
		                  &times;
		            </button>
		            <h4></h4>
		        </div>
			    <div class="modal-content modal-padding">
			     	<img class="big-img" style="" src="<?php echo $img_source. $supplier['organization_code'];?>">
			    </div>
			  </div>
			</div>
			
	</div>
</div>
<script type="text/javascript" src="/js/ydlbam_js/js_supplier/supplier_detail.js"></script>
