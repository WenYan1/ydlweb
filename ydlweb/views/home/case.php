<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>主页-案例</title>
<link rel="stylesheet" href="../css/index/case.css">
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
		<div class="col-xs-12 fixed-width" style="margin-bottom: 150px">
			<div class="fixed-title">
				<p class="excuse-words">业务流程</p>
                <img class="excuse-image" src="../images/case.jpg" style="margin-top: 50px;"/>
            </div>
		</div>

		<div class="col-xs-12" style="height: 100px;width: 100%;background: white">
		</div>

	</div>
</div>	
