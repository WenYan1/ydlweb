<?php

namespace app\modules\ydlbam\controllers;

use Yii;
use app\modules\ydlbam\controllers\AdminBaseController;
use app\modules\ydlbam\models\AdminModular;

class DefaultController extends AdminBaseController
{
    public $layout = 'ydlbam';

    public function actionIndex()
    {
    	return $this->renderPartial('/login/index');
    }

    public function actionWelcome() {
    	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
    	$this->initializeAttributes();
    	return $this->render('index');
    }

}
