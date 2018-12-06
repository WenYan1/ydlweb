        <link rel="stylesheet" href="../css/overview/overview.css">
		<title>总览</title>
		<script type="text/javascript" src="../js/overview/overview.js"></script>
        <div class="content-width spacing-left">
        	<div class="content-half" >
	    		<div class="overview-left">
	    			<div class="overview-vertical">
	    				<p class="welcome">欢迎,</p>
	    				<p class="font-content-size"><?php echo $user->email ?></p>
	    			</div>
	    			<?php 
	    				if($company === null){
	    			?>	
							<p class="company-name font-grey spacing-left">尚无认证的公司</p>
				    		<a href="<?php echo Yii::$app->urlManager->createUrl(['/company']); ?>" class="certified"><span>去认证</span></a>
				    <?php
	    				}else if($company['state'] == 0){
	    			?>
	    					<p class="company-name font-grey spacing-left">公司信息审核中...</p>
				    		<a href="<?php echo Yii::$app->urlManager->createUrl(['/company']); ?>" class="certified"><span>审核中</span></a>
	    			<?php
	    				}else if($company['state'] == -1){
	    			?>
	    					<p class="company-name font-grey spacing-left">公司信息审核未通过...</p>
				    		<a href="<?php echo Yii::$app->urlManager->createUrl(['/company']); ?>" class="certified"><span>查看原因</span></a>
	    			<?php
	    				}else if($company['state'] == 1){
	    			?>
	    					<p class="company-name font-grey spacing-left"><?php echo $company['company_name'];?></p>
				    		<a href="<?php echo Yii::$app->urlManager->createUrl(['/company']); ?>" class="certified"><span>已认证</span></a>
	    			<?php
	    				}
	    			?>
	    			
	    		</div>
        	</div>
        	<div class="content-half">
        		<div class="overview-right ">
	    			<div style="width: 24%;display: inline-block;">
			    		<p class="overview-order font-grey">全部订单</p>
			    		<p class="order-num"><a href="order" class="order-a default-blue"><?php echo $orderCount ?></a></p>
			    	</div>
			    	<div style="width: 24%;display: inline-block;">
			    		<p class="overview-order font-grey">待审核</p>
			    		<p class="order-num"><a href="order?state=2&search=" class="order-a default-blue"><?php echo $orderPendingAuditCount ?></a></p>
			    	</div>
			    	<div style="width: 24%;display: inline-block;">
			    		<p class="overview-order font-grey">待结汇</p>
			    		<p class="order-num"><a href="order?state=2&search=" class="order-a default-blue"><?php echo $orderForSettlementCount ?></a></p>
			    	</div>
			    	<div style="width: 24%;display: inline-block;">
			    		<p class="overview-order font-grey">已完成</p>
			    		<p class="order-num"><a href="order?state=11&search=" class="order-a default-blue"><?php echo $orderOverCount ?></a></p>
			    	</div>
	    		</div>
        	</div>
        </div>

	    <div class="my-capital spacing-left font-grey">我的资金</div>
	    <div class=" spacing-left my-capital-bg" style="width: 96%;min-width: 800px">
	    	<div class="capital-width-2">
	    		<p class="content-size capital-category-color text-center">可用资金：
	    			<img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="可用资金： 由用户转账至平台，可以用于支付首付款\尾款\结汇\信保代采购保证金。">
	    		</p>
		    	<div class="text-center capital-top">
		    		<p class="available-capital"><?php echo $user['user_capital']; ?></p>
			        <p class="font-content-size">元</p>
			    </div>
	    	</div>
	    	<div class="capital-width-2">
	    		<p class="content-size capital-category-color text-center">保证金：
	    			<img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="不可用资金： 每次使用信保代采购需要支付使用额度的10%作为保证金，待结汇后返还至可用资金。">
	    		</p>

		    		<p class="vertical-line">|</p>
		    		<div class="text-center capital-top col-md-offset-2">
		    			<p  class="useless-captial"><?php echo $user['bond']; ?></p>
			        	<p class="font-content-size">元</p>
		    		</div>
	    	</div>

	    	<div class="capital-width-2">
	    		<p class="content-size capital-category-color text-center">可用信用额度：
	    			<img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="可用信用额度： 当前可用的信保代采购金额。">
	    		</p>
		    		<p class="vertical-line">|</p>
		    		<div class="text-center capital-top col-md-offset-2">
		    			<p  class="available-credit"><?php echo $user['credi_limit']; ?></p>
			       		<p class="font-content-size">元</p>
		    		</div>
	    	</div>
	    	<div class="capital-width-2">
	    		<p class="content-size capital-category-color text-center">总信用额度：
	    			<img style="cursor:pointer;" class="capital-img" src="../images/capital_tip.jpg" data-toggle="tooltip" data-placement="right" title="总信用额度： 贵公司帐号当前的信保代采购金额.">
	    		</p>
		    		<p class="vertical-line">|</p>
		    		<div class="text-center capital-top col-md-offset-2">
			    		<p  class="total-credit"><?php echo $user['total_creditlimit']; ?></p>
			        	<p class="font-content-size">元</p>
		    		</div>
	    	</div>
	    	<a href="capital/recharge">
	        		<p class="default-background-blue font-content-size recharge spacing-left">充值</p>
	        	</a>
	    </div>

	    <div class="my-capital spacing-left font-grey">我的服务</div>
	    <div class="content-width spacing-left">
	    	<div class="content one-third">
	    		<p class="content-item font-color-default">订单</p>
	    		<p class="content-size content-item-a"><a href="order/add-first-step" class="order-a">添加订单</a></p>
	    	</div>
	    	<div class="content one-third " style="margin-left: 2%">
	    		<p class="content-item font-color-default">产品</p>
	    		<p class="content-size content-item-a"><a href="goods/add" class="order-a">添加产品</a></p>
	    	</div>
	    	<div class="content one-third" style="margin-left: 2%">
	    		<p class="content-item font-color-default">供应商</p>
	    		<p class="content-size content-item-a"><a href="supplier/add" class="order-a">添加供应商</a></p>
	    	</div>
	    </div>