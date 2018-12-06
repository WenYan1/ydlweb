<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\controllers\HomeBaseController;

class UserVerifyController extends HomeBaseController
{
    
    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	$usersModel = new Users;
    	$token = $request->get('token');
    	$usersModel = $usersModel->emailVerify($token,$message);
    	if($usersModel) {
                            if($usersModel->state === 1) {
                                    $this->redirect('/login');
                            } else {
                                    $usersModel->state = 1;
                                    if($usersModel->save()) {
                                        $this->redirect('/user-verify/translate-success');
                                    } else {
                                        //$this->_setErrorMessage('邮箱验证失败');
                                        $this->redirect('/');
                                    }
                            }
    	} else {
    		//$this->_setErrorMessage($message);
		$this->redirect('/');
    	}
    }

    public function actionTranslateSuccess() {
            return $this->renderPartial('email_verification_success');
    }

    public function actionTranslatePhoneSuccess() {
            return $this->renderPartial('email_verification_success_phone');
    }

    public function actionTranslateEmail() {
            return $this->renderPartial('email_verification');
    }

}
