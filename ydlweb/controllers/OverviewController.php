<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\Users;
use app\models\Companys;
use app\components\MyEvents;
use yii\filters\AccessControl;

class OverviewController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    // 允许认证用户
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // 默认禁止其他用户
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    	$session = Yii::$app->session;
    	if(!$session->isActive) $session->open();
    	$companysModel = new Companys;
    	$usersModel = new Users;
    	$overdueTime = 90*24*3600;
    	$bufferTime = 48*3600;
    	$nowTime = time();
    	$companysModel = $companysModel->findByUserId($session['uid']);
              $companysModel = $companysModel ? $companysModel->attributes : null;
    	$orderCount = Orders::find()->where(['user_id' => $session['uid']])->count();
    	$orderPendingAuditCount = Orders::find()->where(['user_id' => $session['uid'],'order_state'=>0])->count();
    	$orderForSettlementCount = Orders::find()->where(['user_id' => $session['uid']])->andWhere(['<','order_state',9])->andWhere(['<=','delivery_time',$nowTime-$overdueTime])->andWhere(['>=','delivery_time',$nowTime-$overdueTime-$bufferTime])->count();
    	$orderOverCount = Orders::find()->where(['order_state'=>11,'user_id' => $session['uid']])->count();
    	$usersModel = $usersModel->findById($session['uid']);
    	
    	return $this->render('overview', [
    		'orderCount' => $orderCount,
    		'orderPendingAuditCount' => $orderPendingAuditCount,
    		'orderForSettlementCount' => $orderForSettlementCount,
    		'orderOverCount' => $orderOverCount,
    		'user' => $usersModel,
                           'company' => $companysModel,

    	]);
    }

}
