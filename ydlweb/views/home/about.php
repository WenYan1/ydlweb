<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>主页-关于</title>
<link rel="stylesheet" href="../css/index/about.css">
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
			<div class="about-bg" style="background-image: url('/images/about-bgp.png');">
				<p class="bgp-word-color bgp-big">简单·可信赖</p>
				<p class="bgp-word-color small-size">
					simple&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					&
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					reliable&nbsp&nbsp&nbsp&nbsp&nbsp</p>
				</div>
			</div>

			<div class="col-xs-12 about-centre">
				<div class="fixed-title">
					<div class="three-circle">
						<p class="circle-number">100</p>
					</div>
					<div class="three-circle" style="margin-left: 140px;margin-right: 140px">
						<p class="circle-number">50</p>
						<p class="circle-small">million</p>
					</div>
					<div class="three-circle">
						<p class="circle-number">100</p>
						<p class="circle-small">million</p>
					</div>
				</div>

				<div class="fixed-title">
					<div class="three-circle-word">
						<p>我们服务</p>
						<p>超过100个跨境大卖家</p>
					</div>
					<div class="three-circle-word" style="margin-left: 140px;margin-right: 140px">
						<p>累计出口</p>
						<p>超过5000万美金</p>
					</div>
					<div class="three-circle-word">
						<p>授信额度</p>
						<p>审批超过1亿美金</p>
					</div>
				</div>
			</div>

			<div class="col-xs-12 about-centre">
				<div class="fixed-title">
					<p class="about-detail">天津腾邦易贸通作为腾邦跨境电商落子版块，2018年3月成立，注册资本5000万元，肩负着集团服务跨境电商企业，打造进出口外贸平台，以互联网信息技术为手段，实现在线通关，外汇、物流、退税、金融和信用保险等外贸业务一站式电子化全流程服务。从而实现外贸服务的信息化、标准化、透明化，并以规模优势、资源整合、服务集成等特质，大幅度降低传统外贸的服务成本。</p>
				</div>
			</div>

			<div class="col-xs-12" style="height: 100px;width: 100%;background: white">
			</div>

		</div>
	</div>	
