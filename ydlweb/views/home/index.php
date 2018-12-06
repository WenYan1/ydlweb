<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>主页</title>
<link rel="stylesheet" href="../css/index/index.css">
<div class="container-fluid">
	<div class="row">
		<!-- header -->
		<div class="col-xs-12" style="background: white">
			<div class="col-xs-12">
				<div id="head">
					<div id="logo" class="col-xs-4">
						<a href="/"><img src="/images/beforeship-logo.png"></a>
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
							<li class="price"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'price']); ?>">价格</a></li>
							<li class="case"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'case']); ?>">流程</a></li>
							<li class="about"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'about']); ?>">关于</a></li>
							<li class="login-btn"><a style="color: white" href="login">登录</a></li>
							<li class="register-btn"><a id="register-color" href=<?php echo Yii::$app->urlManager->createUrl(['login','act'=>'reg']); ?>>注册</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- main -->
		<div class="col-xs-12">
			<div class="box-img">
				<img class="index-image" src="../images/bgp.jpg">
			</div>
			<div class="col-xs-8 col-xs-offset-2 centre-info">
				<p class="enlish-word">专注于跨境电商的外贸综合服务商</p>
				<p class="sweat-word">Focus on cross-border e-commerce integrated services</p>
				<p class="sweat-word service-word"></p>
				<p style="padding-top: 40px">
					<a href="login"><img src="../images/GO.png"></a>
				</p>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="information">
				<div class="first-part">
					<p class="big-word">我们的特色</p>
					<p class="middle-word">打造全新的跨境电商综合服务平台</p>
				</div>
				<div class="three-part" style="background: #f9f9f9">
					<img src="../images/house.png">
					<p class="big-word">通关顺</p>
					<p>我们合作的企业，在海关有比较好的信用</p>
					<p>通关免检率较高 </p>
				</div>
				<div class="three-part white-part">
					<img src="../images/money.png">
					<p class="big-word">清关易</p>
					<p> 我们拥有全球布局的重要港口的清关资源</p>
					<p>让你的货运更加省心便捷</p>
					<!--<p>垫退税，合同签订时，把退税额退换给卖家。</p>-->
				</div>
				<div class="three-part" style="background: #f9f9f9">
					<img src="../images/hands.png">
					<p class="big-word">结汇快</p>
					<p>香港境外主体收汇</p>
					<p>境内付款</p>
					<p>为您节省繁琐的结汇手续</p>
					<p>给您一个便捷省心的交易体验</p>
				</div>
				<div class="three-part white-part">
					<img src="../images/book.png">
					<p class="big-word">代采购</p>
					<p>旺季来临之际</p>
					<p>我司可以帮客户垫付采购款给其国内供应商</p>
					<p>最长期限达180天</p>
				</div>
				<div class="three-part" style="background: #f9f9f9">
					<img src="../images/heart.png">
					<p class="big-word">帮退税</p>
					<p>跨境电商企业通过我司抬头出口产品后</p>
					<p>在提交相关合同单证后三天内</p>
					<p>即可快速拿到退税款</p>
				</div>
				<div class="three-part white-part">
					<img src="../images/thumb.png">
					<p class="big-word">省运费</p>
					<p>我们整合优势线路</p>
					<p>仓储资源，服务全程跟踪</p>
					<p>价格透明，所有开销尽在您的掌握</p>
				</div>
				<div class="one-part">
					<p class="big-word">我们可以这样合作</p>
					<p class="middle-word">结合线上线下的服务，让我们的合作更加轻松快捷</p>
				</div>
			</div>
		</div>

		<div class="col-xs-12 diamond">
			<img src="../images/diamond.png">
		</div>

		<div class="col-xs-12 parter">
			<div class="six-parter">
				<p class="big-word" style="padding-bottom: 30px">合作伙伴</p>
				<div class="three-parter" style="text-align: left;">
					<a href="javascript:void(0)"><img height="40" width="160" src="/images/zgxb.jpg"></a><br><br><br>
					<a href="javascript:void(0)"><img  width="160" src="/images/tempus.png"></a>
				</div>
				<div class="three-parter" style="text-align: center;">
					<a href="javascript:void(0)"><img height="40" width="100" src="/images/ebay.png"></a><br><br><br>
					<a href="javascript:void(0)"><img height="40" width="160" src="/images/zgyh.jpg"></a>
				</div>
				<div class="three-parter" style="text-align: right;">
					<a href="javascript:void(0)"><img style="margin-top: -20px" height="60" width="160" src="/images/amazon.jpg"></a><br><br><br>
					<a href="javascript:void(0)"><img height="40" width="160" src="/images/pf.jpg"></a>
				</div>
			</div>
		</div>

		<div class="col-xs-12 taste">
			<p class="big-word">强强联合&nbsp更有保障</p>
			<p class="small-word">
				<span>中信保</span>
				<!--<span>eBay</span>-->
				<span>tempus</span>
				<span>联合打造</span>
				<span>更可信赖</span>
			</p>
			<a class="taste-btn" href=<?php echo Yii::$app->urlManager->createUrl(['login','act'=>'reg']); ?>>立即体验</a>
		</div>

		<div class="col-xs-12" style="height: 100px;width: 100%;background: white">
		</div>


	</div>
</div>	
