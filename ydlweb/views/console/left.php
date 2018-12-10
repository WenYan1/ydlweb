<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>左边栏</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/public/left.css">
    <script src="../js/jquery-1.11.3.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/left.js"></script>
</head>
<body>
    <div class="left-view">
        <div class="logo">
            <a href="#">
                <image src="../images/logo.png"></image>
            </a>
        </div>
        <div class="console">
           <li class="overview"><a href="#">总览</a></li>
           <li class="products"><a href="../?r=product/product_manager">产品管理</a></li>
           <li class="supplier"><a href="../?r=privider_manage/privider_manage">供应商管理</a></li>
           <li class="order"><a href="../?r=order/add_order">我的订单</a></li>
           <li class="capital">
               资金管理 <i class="icon"></i>
           </li>
            <div class="capital-detail">
                <li><a href="../?r=capital/capital_manager">资金结算</a></li>
                <li><a href="../?r=capital/capital_balance">资金流水</a></li>
            </div>

          <li class="company"><a href="#">公司认证</a></li>
          <li class="finance"><a href="#">金融服务</a></li>
        </div>
    </div>
    <div class="main-content">
        <div id="main-top-nav">
            <a class="mail" href="">1033110136@qq.com</a>
            <a class="layout" href="">退出</a>
        </div>
    </div>
</body>
</html>