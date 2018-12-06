<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\Users;
use app\models\Companys;

class HomeController extends \yii\web\Controller
{
    public $layout = 'zety';

    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	$act = $request->get('act');
    	if ($act == 'product') {	
    		return $this->render('product');
    	} elseif ($act == 'price') {
    		return $this->render('price');
    	} elseif ($act == 'case') {
    		return $this->render('case');
    	} elseif ($act =='about') {
    		return $this->render('about');
    	} else {
    		return $this->render('index');
    	}
    }
}
