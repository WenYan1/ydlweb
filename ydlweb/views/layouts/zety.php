<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/index/common.css">
    <script src="../public/jquery-1.11.3.js"></script>
    <script src="../public/bootstrap.min.js"></script>
    <style type="text/css">
        body{-moz-user-select:none}
    </style>
</head>
<body onselectstart="return false;" >
    <?php $this->beginBody() ?>
    <?= $content ?>
    <footer>
        <div class="col-xs-12 footer">
            <div class="main-footer">
                <div class="three-footer">
                    <p class="footer-big">微信公众号</p>
                    <img height="100" src="/images/weixin.jpg">
                    <p class="footer-small" style="padding-top: 30px">联系电话：86-755-83485999</p>
                    <p class="footer-small">传真：86-755-83485333</p>
                </div>
                <div class="three-footer special-footer">
                   <p class="footer-big">友情链接</p>
                   <p class="footer-small"> <a target="_blank" href="http://www.gsxt.gov.cn/index.html">全国企业信用查询</a></p>
                   <p class="footer-small"><a target="_blank" href="http://www.yibannashuiren.com/">一般纳税人认定时间查询</a></p>
                   <p class="footer-small"><a target="_blank" href="http://credit.customs.gov.cn/">企业海关进出口信用信息查询</a></p>
				   <p class="footer-small"><a target="_blank" href="http://www.haiguan.info/onlinesearch/gateway/ProductInfo.aspx">HS编码查询</a></p>
				   <p class="footer-small"><a target="_blank" href="http://www.hscode.net/IntegrateQueries/QueryYS/?q1=36269090&q2=">申报要素查询</a></p>
				   <p class="footer-small"><a target="_blank" href="http://www.boc.cn/sourcedb/whpj/">汇率查询</a></p>
                </div>
                <div class="three-footer special-footer">
                   <p class="footer-big">关于</p>
                   <p class="footer-small"><a href="">公司介绍</a></p>
                   <p class="footer-small"><a href="">加入我们</a></p>
                   <p class="footer-small"><a href="">联系我们</a></p>
                   <p class="footer-small"><a href="">合作伙伴</a></p>
                   <p class="footer-small"><a href="">友情链接</a></p>
                </div>
            </div>
        <p>粤ICP备08039416号-3</p>            
        </div>

    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
