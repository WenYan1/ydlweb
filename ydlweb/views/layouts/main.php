<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<?php $img_source = "http://107.170.254.164/uploads/"; ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/public/left.css">
    <script src="../public/jquery-1.11.3.js"></script>
    <script src="../public/bootstrap.min.js"></script>
    <script src="../js/left.js"></script>
    <style type="text/css">
        body{-moz-user-select:none}
    </style>

</head>
<body onselectstart="return false;" >
<?php $this->beginBody()?>
<script src='//kefu.easemob.com/webim/easemob.js?tenantId=16168&hide=true' async='async'></script>
    <div class="left-view">
        <div class="logo">
            <a href="">
                <image src="../images/logo.png"></image>
            </a>
        </div>
        <div class="console">
           <li class="overview"><a href='<?php echo Yii::$app->urlManager->createUrl(['overview']); ?>' >总览</a></li>
            <li class="products"><a href='<?php echo Yii::$app->urlManager->createUrl(['goods']); ?>' >产品管理</a></li>
           <li class="supplier"><a href='<?php echo Yii::$app->urlManager->createUrl(['supplier']); ?>' >供应商管理</a></li>
           <li class="order"><a href='<?php echo Yii::$app->urlManager->createUrl(['order']); ?>' >订单管理</a></li>
           <li class="collection"><a href='<?php echo Yii::$app->urlManager->createUrl(['collection']); ?>' >退税管理</a></li>
           <li class="capital">
               资金管理 <i class="icon"></i>
           </li>
            <div class="capital-detail">
				<li class="capital-balance"><a href='<?php echo Yii::$app->urlManager->createUrl(['capital/capital-logs']); ?>'>充值结汇</a></li>
                <li class="capital-manage"><a href='<?php echo Yii::$app->urlManager->createUrl(['capital']); ?>'>付款还款</a></li>
                
            </div>
          <li class="company"><a href="<?php echo Yii::$app->urlManager->createUrl(['/company']); ?>">公司认证</a></li>
          <li class="finance"><a href="<?php echo Yii::$app->urlManager->createUrl(['/financial-service']); ?>">金融服务</a></li>
          <li class="person-acount"><a href='<?php echo Yii::$app->urlManager->createUrl(['account']); ?>'>个人中心</a></li>
        </div>
    </div>
    <div class="main-content">
        <div id="main-top-nav">
            <p style="display:inline-block" class="mail" href=''><?php echo Yii::$app->session['userEmail']; ?></p>
            <a class="layout" href="<?php echo Yii::$app->urlManager->createUrl(['login/logout']); ?>">退出</a>
            <button style="margin-right:50px;" class="btn btn-primary" id='kefu' href="javascript:;" onclick="easemobIM()" tenantId=16168>联系客服</button>
        </div>
        <?=$content?>
    </div>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
