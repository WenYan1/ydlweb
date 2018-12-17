<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>主页-价格</title>
<link rel="stylesheet" href="/css/index/price.css">
<div class="container-fluid">
	<div class="row">
		<!-- header -->
		<div class="col-xs-12" style="background: white;border-bottom: 1px solid #f2f2f2">
			<div class="col-xs-12">
				<div id="head">
					<div id="logo" class="col-xs-4">
						<a href="/"><img src="../images/beforeship-logo.png"></a>
					</div>
					<div id="navigation" class="col-xs-8">
						<ul id="menue">
							<li class="home"><a href="home">首页</a></li>
							<li class="product">
								<a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'product']); ?>">产品</a>
								<div class="home-product-list">
									<ul>
										<li>
										<a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'product']); ?>">物流服务</a>
										</li>
										<li>
										<a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'product']); ?>">出口退税</a>
										</li>
										<li>
										<a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'product']); ?>">代采购服务</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="case"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'case']); ?>">流程</a></li>
							<li class="about"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'about']); ?>">关于</a></li>
							<li class="price"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'price']); ?>">Q&A</a></li>
							<li class="login-btn"><a style="color: white" href="login">登录</a></li>
							<li class="register-btn"><a id="register-color" href=<?php echo Yii::$app->urlManager->createUrl(['login','act'=>'reg']); ?>>注册</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- main -->
		<div class="col-xs-12 fixed-width">
			<div class="fixed-form">
				<ul id="form-tab" class="nav nav-tabs">
					<li class="active">
						<a href="#product-price" data-toggle="tab">名词解释</a>
					</li>
					<li>
						<a href="#calculate" data-toggle="tab">价格计算器</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="product-price">
						<div class="fixed-title">
							<div class="fixed-small" style="height: 230px">
								<p class="calculate-top">注册成功开通金融服务即可享受高额的信保融资服务</p>
								<p class="calculate-centre">
									<span class="small-word">总信保额度下随用随还 </span>  
									<span class="small-word" style="padding: 0 30px">服务费低，整月低至1%</span>  
									<span class="small-word">可签订OA90-180天的合同</span> 
								</p>
								<a class="calculate-btn" href="">立即体验</a>
							</div>
							<p class="big-word">名词解释</p>
							<div class="fixed-small detail-msg">
								<p class="info-title-size">退税款计算</p>
								<hr>
								<p class="msg-brief">退税款=开票金额/1.16*产品退税率</br>
							退税手续费=退税款*费率</p>
								<p class="info-title-size">代采购费用</p>
								<hr>
								<p class="msg-brief">代采购费用根据客户月出口额阶梯收费</br>
								</p>
								
								
								<p class="info-title-size">定金</p>
								<hr>
								<p class="msg-brief">发票金额的10%~20%+退税手续费</p>
								<p class="info-title-size">保证金</p>
								<hr>
								<p style="padding-left: 80px">保证金=使用信保融资金额的10%作为保证金，保证金必须来自自有资金</p>
								<p class="msg-brief">（订单完成后保证金24小时内退回原账户）</p>
								<p class="info-title-size">结汇金额</p>
								<hr>
								<p class="msg-brief">结汇金额=（开票金额-出口退税款-已付资金+信保融资本金+信保融资服务费）</p>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="calculate">
						<div class="fixed-title">
							<p>价格计算</p>
							<div class="fixed-two-part">
								<p class="price-words">开票金额（元）:</p>
								<input class="price-input" type="text" placeholder="" >
								<p class="price-words">退税率（元）:</p>
								<input class="price-input" type="text" placeholder="" >
								<p class="price-words">订单信保资金使用额（元）:</p>
								<input class="price-input" type="text" placeholder="" >
								<p class="price-words">已支付金额（元）:</p>
								<input class="price-input" type="text" placeholder="" >
								<p class="price-words">逾期天数:</p>
								<input class="price-input" type="text" placeholder="" >
								<input class="price-btn" type="button" value="开始计算" >
							</div>
							<div class="fixed-two-part">
								<div class="price-result">
									<p>计算结果</p>
									<table>
										<tr>
											<th>类型</th>
											<th>费用</th>
										</tr>
										<tr>
											<td>退税款（元）</td>
											<td>￥10000</td>
										</tr>
										<tr>
											<td>信保融资费（元）</td>
											<td>￥10000</td>
										</tr>
										<tr>
											<td>逾期费用（元）</td>
											<td>￥10000</td>
										</tr>
										<tr>
											<td>结汇金额（元）</td>
											<td class="total-price">￥10000</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-12" style="height: 100px;width: 100%;background: white">
		</div>
		
	</div>
</div>	
