<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>主页-产品</title>
<link rel="stylesheet" href="../css/index/product.css">
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
                      <a targ="#logistics">物流服务</a>
                    </li>
                    <li>
                      <a targ="#trade">出口退税</a>
                    </li>
                    <li>
                      <a targ="#terrace">代采购服务</a>
                    </li>
                  </ul>
                </div>
              </li>
							<li class="price"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'price']); ?>">价格</a></li>
							<li class="case"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'case']); ?>">案例</a></li>
							<li class="about"><a href="<?php echo Yii::$app->urlManager->createUrl(['home','act'=>'about']); ?>">关于</a></li>
							<li class="login-btn"><a style="color: white" href="login">登录</a></li>
							<li class="register-btn"><a id="register-color" href=<?php echo Yii::$app->urlManager->createUrl(['login','act'=>'reg']); ?>>注册</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- main -->
		<!-- <div class="col-xs-12 fixed-width">
			<div class="fixed-title">
				<div class="anchor-point-three">
                    <a href="#logistics">物流服务</a>
				</div>
				<div class="anchor-point-three">
					<a href="#tax-clearance">出口退税</a>
				</div>
				<div class="anchor-point-three">
                    <a href="#financial-services">代采购服务</a>
				</div>
			</div>
		</div> -->
        <!-- 物流服务 -->
		<div>
      <div id="logisticsServe" class="aboutRightInfo">
        <div id="logistics" class="col-xs-12 fixed-width">
            <div class="fixed-title">
                <p class="point-title">物流服务</p>
                <p class="point-second-title">让物流更加简单</p>
                <div class="logistics-point-three">
                    <img src="../images/logistics1.png" />
                    <p>100%</p>
                    <p>服务透明</p>
                </div>
                <div class="logistics-point-three">
                    <img src="../images/logistics2.png" />
                    <p>100%</p>
                    <p>全程跟踪</p>
                </div>
                <div class="logistics-point-three">
                    <img src="../images/logistics3.png" />
                    <p>100%</p>
                    <p>服务保障</p>
                </div>
            </div>
        </div>

        <div class="col-xs-12 fixed-width fixed-image" style="background-image: url('../images/pic.png');">
            <div class="fixed-form">
                <ul id="form-tab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#ocean" data-toggle="tab">海运</a>
                    </li>
                    <li style="border-left:1px solid #f2f2f2;">
                        <a href="#sky" data-toggle="tab">空运</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="ocean">
                        <label class="port">始发港</label>
                        <input class="port-put" type="text" placeholder="输入中/英文" />
                        <br />
                        <label class="port">目的港</label>
                        <input class="port-put" type="text" placeholder="输入中/英文" />
                        <br />
                        <label class="port">柜型</label>
                        <input class="port-put-short" type="text" placeholder="" />
                        <label class="port">数量</label>
                        <input class="port-put-short" style="margin-right: -15px" type="text" placeholder="" />
                        <br />
                        <input class="transportant" type="button" value="运价查询" />
                    </div>
                    <div class="tab-pane fade" id="sky">
                        <p>空运</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
		<!-- 出口退税 -->
		<div id="tax-clearance" class="col-xs-12 fixed-width  aboutRightInfo">
			<div class="fixed-title">
				<p class="point-title">出口退税</p>
				<p class="point-second-title">让出口贸易更加安全快捷，让跨境卖家利润更大</p>
				<div class="fixed-small">
					<div class="logistics-image" style="background-image: url('../images/color1.png');">
						<p class="big-word">安全高效通关</p>
						<p class="small-word">我们合作的企业，都是双A企业，在海关有比较好的信用，通关免检率非常高。</p>
					</div>
					<div class="logistics-image" style="background-image: url('../images/color2.png');">
						<p class="big-word">费率低</p>
						<p class="small-word">我们合作的企业，都是双A企业，在海关有比较好的信用，通关免检率非常高。</p>
					</div>
					<div class="logistics-image" style="background-image: url('../images/color3.png');">
						<p class="big-word">多种货币结汇</p>
						<p class="small-word">减少汇率损失，提供多货币的结汇服务</p>
					</div>
				</div>
				<div class="right-now"><a class="expericen" href="">马上开通</a></div>
			</div>
		</div>

        <!-- 代采购服务 -->
      <div id="financial"  class="aboutRightInfo">
        <div id="financial-services" class="col-xs-12 fixed-width" style="margin-bottom: 60px">
            <div class="fixed-title">
                <p class="point-title">代采购服务</p>
                <p class="point-second-title top-empty">中信保&nbspeBay&nbsp腾邦易贸通&nbsp联合打造&nbsp更可信赖</p>
                <div class="financial-image">
                    <div class="financial-three financial-left">
                        <img src="/images/ebay.png" />
                    </div>
                    <div class="financial-three financial-left">
                        <img src="/images/zgxb.jpg" />
                    </div>
                    <div class="financial-three financial-right">
                        <img src="/images/beforeship-logo.png" />
                    </div>
                </div>
                <a class="expericen" style="clear: both;margin-top: 90px" href="">查看额度</a>
            </div>
        </div>

        <div class="col-xs-12 fixed-width" style="background: #f2f2f2">
            <div class="fixed-title">
                <div class="short-detail">
                    <div class="detail-centre">
                        <img src="../images/up.png" />
                        <div class="detail-word">
                            <p>代采购金额高</p>
                            <p>最高500万美金代采购</p>
                        </div>
                    </div>
                    <div class="detail-centre">
                        <img src="../images/$money.png" />
                        <div class="detail-word">
                            <p>还款时间灵活</p>
                            <p>授信额度管理，总额度下的随借随还。</p>
                        </div>
                    </div>
                </div>
                <div class="short-detail">
                    <div class="detail-centre">
                        <img src="../images/down.png" />
                        <div class="detail-word">
                            <p>贷款成本低</p>
                            <p>贷款成本低，整体服务费1%</p>
                            <p>&nbsp</p>
                        </div>
                    </div>
                    <div class="detail-centre">
                        <img src="../images/shouxin.png" />
                        <div class="detail-word">
                            <p>授信额度管理</p>
                            <p>还款时间灵活，可以签订OA90-180天的合同，</p>
                            <p>适合不同的国家海外仓</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		</div>
      </div>
	</div>
</div>
<script type="text/javascript">
    
        window.onload = function () {
          var businessList = $('.home-product-list li');
          var busCtnList = $('.aboutRightInfo');
          
          $.each(businessList, function(index, item) {
            $(item).on('click', function() {
              $(this).addClass('active').siblings().removeClass('active');

              $.each(busCtnList, function(ctnIndex, ctnItem) {
                if (ctnIndex == index) {
                  $('html,body').stop().animate({scrollTop: 0}, 300);
                  $(this).removeClass('showActive').siblings().addClass('showActive');
                }
              });
            });
          });


          var firstHash = window.location.hash;
          switch(firstHash) {
            case "#logistics": {
              $('.home-product-list li').eq('0').addClass('active').siblings().removeClass('active');
              $('.aboutRightInfo').eq('0').removeClass('showActive').siblings().addClass('showActive');
            }
            break;
            case "#trade": {
              $('.home-product-list li').eq('1').addClass('active').siblings().removeClass('active');
              $('.aboutRightInfo').eq('1').removeClass('showActive').siblings().addClass('showActive');
            }
            break;
            case "#terrace": {
              $('.home-product-list li').eq('2').addClass('active').siblings().removeClass('active');
              $('.aboutRightInfo').eq('2').removeClass('showActive').siblings().addClass('showActive');
            }
            break;
            default: {
              $('.aboutLeList li').eq('0').addClass('active').siblings().removeClass('active');
              $('.aboutRightInfo').eq('0').removeClass('showActive').siblings().addClass('showActive');
            }
            break;
          }
        }
    </script>