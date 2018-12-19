<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/css/ydlbam_css/public/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/ydlbam_css/public/base.css" />
    <script src="/js/ydlbam_js/public/jquery-1.11.3.js"></script>
    <script src="/js/ydlbam_js/public/bootstrap.min.js"></script>
    <script src="/js/ydlbam_js/public/base.js"></script>
    <style type="text/css">
        /*body{-moz-user-select:none}*/
    </style>
    <script type="text/javascript">
        $(function () {
            $("#adminer-manage").click(function () {
                $(".adminer-child").toggle();
            });

            $("#group-manage").click(function () {
                $(".group-child").toggle();
            });

            $("#custom_service-manage").click(function () {
                $(".custom_service-child").toggle();
            });

            $("#capital-manage").click(function () {
                $(".capital-child").toggle();
            });

        });
    </script>
</head>


<body>
    <?php $actionList = $this->context->_permission;
          $rank = $this->context->_rank;
          $adminer = $this->context->_adminer;
          $lastTime = $this->context->_lastTime;
    ?>
    <?php $this->beginBody()?>
    <div class="body-titlebar_top navbar-fixed-top">
        <img src="/images/logo.png" />
        <p class="titlebar_top-title">后台管理系统</p>
        <div class="titlebar_top-user">
            <?php if($rank == 0) {?>
            <p>超级管理员</p>
            <?php }else if($rank == 1) {?>
            <p>普通管理员</p>
            <?php } else if($rank == 2) {?>
            <p>客服</p>
            <?php }?>
            <p>
                <?php echo $adminer;?>
            </p>
            <p style="cursor:pointer;">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/login/login-out']); ?>">退出</a>
            </p>
        </div>
        <p class="last-login-time">
            上一次登录时间：<?php echo date('Y-m-d H:i');?>
        </p>
    </div>
    <div class="body-menu_left">
        <ul>
            <?php if(in_array('member', $actionList)) {?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/user']); ?>">
                <li id="user-manage">
                    <span>会员管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <?php }?>
            <?php if(in_array('company', $actionList)) {?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/company']); ?>">
                <li id="company-certify">
                    <span>公司认证</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <?php }?>
            <?php if(in_array('goods', $actionList)) {?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/goods']); ?>">
                <li id="goods-manage">
                    <span>产品管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <?php }?>
            <?php if(in_array('order', $actionList)) {?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/order']); ?>">
                <li id="order-manage">
                    <span>订单管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <?php }?>
	        <?php if(in_array('collection', $actionList)) {?>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/collection']); ?>">
                    <li id="collection-manage">
                        <span>退税管理</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
	        <?php }?>
            <?php if(in_array('supplier', $actionList)) {?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/supplier']); ?>">
                <li id="suplier-manage">
                    <span>供应商管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <?php }?>
            <?php if(in_array('finance', $actionList)) {?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/finance']); ?>">
                <li id="finance-service">
                    <span>金融服务</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <?php }?>
            <?php if(in_array('capital', $actionList) || in_array('recharge', $actionList) || in_array('log', $actionList) || in_array('pay_logs', $actionList)) {?>
            <a href="javascript:">
                <li id="capital-manage">
                    <span>资金管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <ul class="capital-child" style="display:none;">
                <?php if(in_array('capital', $actionList)) {?>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/user-capital']); ?>">
                    <li id="capital-user">
                        <span>用户资金</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
                <?php }?>
                <?php if(in_array('recharge', $actionList)) {?>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/recharge']); ?>">
                    <li id="capital-recharge">
                        <span>充值管理</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
                <?php }?>
                <?php if(in_array('log', $actionList)) {?>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/list-capital-logs', 'type'=>3, 'page'=>1, 'email'=> ""]); ?>">
                    <li id="capital-balance">
                        <span>流水详情</span>
                    </li>
                </a>
                <?php }?>
                <div class="menu_left-divider"></div>
                <?php if(in_array('pay_logs', $actionList)) {?>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/capital/pay-logs']); ?>">
                    <li id="pay-logs">
                        <span>支付记录</span>
                    </li>
                </a>
                <?php }?>
                <div class="menu_left-divider"></div>
            </ul>
            <?php }?>

            <?php if(in_array('user', $actionList)) {?>
            <a href="javascript:">
                <li id="adminer-manage">
                    <span>管理员管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <ul class="adminer-child" style="display:none;">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/adminer']); ?>">
                    <li id="adminer">
                        <span>&nbsp;&nbsp;管理员列表</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/adminer/add-adminer']); ?>">
                    <li id="add_adminer">
                        <span>&nbsp;&nbsp;添加管理员</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
            </ul>
            <?php }?>

            <?php if(in_array('group', $actionList)) {?>
            <a href="javascript:">
                <li id="group-manage">
                    <span>管理组管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <ul class="group-child" style="display:none;">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/adminer-group']); ?>">
                    <li id="adminer-group">
                        <span>&nbsp;&nbsp;管理组列表</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/adminer-group/add-group']); ?>">
                    <li id="add-group">
                        <span>&nbsp;&nbsp;添加管理组</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
            </ul>
            <?php }?>

            <?php if(in_array('custom_service', $actionList)) {?>
            <a href="javascript:">
                <li id="custom_service-manage">
                    <span>客服管理</span>
                </li>
            </a>
            <div class="menu_left-divider"></div>
            <ul class="custom_service-child" style="display:none;">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/custom-service']); ?>">
                    <li id="custom_service">
                        <span>&nbsp;&nbsp;客服列表</span>
                    </li>
                </a>
                <div class="menu_left-divider"></div>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['ydlbam/custom-service/add-custom-service']); ?>">
                    <li id="add_custom_service">
                        <span>&nbsp;&nbsp;添加客服</span>
                    </li>
                </a>
            </ul>
            <?php }?>

        </ul>
    </div>
    <?=$content?>
    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
