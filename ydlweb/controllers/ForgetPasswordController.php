<?php

namespace app\controllers;

use Yii;
use Tool;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\ForgetPassword;
use app\models\ForgetPasswordForm;
use app\controllers\HomeBaseController;

class ForgetPasswordController extends HomeBaseController {

	public $layout = 'zety';

	public function behaviors()
	{
	    return [
	           'access' => [
	                'class' => AccessControl::className(),
	                'only' => ['apply'],
	                'rules' => [
	                    [
	                        'actions' => ['apply','captcha'],
	                        'allow' => true,
	                        'roles' => ['?'],
	                    ],
	                ],
	            ],
	            
	        ];
	    }
	    public function actions()
	    {
	        return [
	             'captcha' => [
	                  'class' => 'yii\captcha\CaptchaAction',
	                  'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null, 
	             ],
	         ];
	     }

	public function actionIndex() {
		$model = new ForgetPasswordForm;
		return $this->render("forget_password", ['model'=>$model]);
	}     

	public function actionApply() {
		$request = Yii::$app->request;

		if($request->isPost) {
			$model = new ForgetPasswordForm;
			$vc  = $request->post('ForgetPasswordForm');
			$model->verifyCode = $vc['verifyCode'];
			if($model->validate()) {
				$forgetPasswordModel = new ForgetPassword;
				$verifyCode = Tool::getVerifyCode();
				$email = $request->post('email');
				$data['email'] = $email;
				$data['token'] = $verifyCode;
				$data['create_at'] = time();
				$forgetPasswordModel = $forgetPasswordModel->add($data,$message);
				if($forgetPasswordModel) {
					Yii::$app->mailer->compose('forget_password',['email'=>$email,'verifyCode'=>$verifyCode])
		                                                ->setFrom('service@beforeship.com')
		                                                ->setTo($email)
		                                                ->setSubject('ZETY邮箱验证')
		                                                ->send();
					//$this->_setSuccessMessage($message);
				               $this->redirect('/');
				} else {
					$this->_setErrorMessage($message);
				               $this->redirect(Yii::$app->request->referrer);
				}
			} else {
				      $errors = $model->errors;
		                                    foreach($errors as $val) {
		                                            $message = $val[0];
		                                            break;
		                                    }
		                                   echo $message;
			}
		}
	}

}
