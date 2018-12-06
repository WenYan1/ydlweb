<?php

namespace app\controllers;

use app\controllers\HomeBaseController;
use app\models\Companys;
use app\models\Users;
use Yii;
use yii\filters\AccessControl;

class FinancialServiceController extends HomeBaseController {

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
	public function actionIndex() {
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		$companysModel = new Companys;
		$companysModel = $companysModel->findByUserId($session['uid']);
		if ($companysModel && $companysModel->state === 1) {
			$usersModel = new Users;
			$usersModel = $usersModel->findById($session['uid']);

			return $this->render('financial_service', [
				'service' => $usersModel->attributes,
			]);
		} else if ($companysModel && $companysModel->state === 0) {
			return $this->render('/company/certify_tip', [
				'message' => '正在审核',
			]);
		} else {
			return $this->render('/company/not_certify');
		}
	}

}
