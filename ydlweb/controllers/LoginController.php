<?php

namespace app\controllers;

use Yii;
use Salt;
use Tool;
use yii\filters\AccessControl;
use app\models\Users;
use app\models\AdminUsers;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\MyEvents;

class LoginController extends \yii\web\Controller
{
    public $layout = 'zety';

    public function behaviors()
{
    return [
           'access' => [
                'class' => AccessControl::className(),
                'only' => ['register'],
                'rules' => [
                    [
                        'actions' => ['register','captcha'],
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

    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	$act = $request->get('act');
    	if($act == "reg") {
                             $model = new LoginForm;
    		return $this->render('register', ['model'=>$model]);
    	} else {
    		return $this->render('login');
    	}
    }

    public function actionRegister() {
    	$request = Yii::$app->request;
    	
    	if($request->isAjax) {
                            $userModel = new Users;  
                            $loginFormModel = new LoginForm;
                            $contactFormModel = new ContactForm();
                            $password = $request->post('password');
                            $passwordCompare = $request->post('password_compare');
                            $verifyCodeResult = $loginFormModel->validateVerifyCode($request->post('verify_code'),$message);
                            if($verifyCodeResult) {
                                if($password === $passwordCompare) {
                                        $email = $request->post('email');
                                        $verifyCode = Tool::getVerifyCode();
                                        $hash = Salt::generateSalt($password);
                                        $data['password'] = $hash['password'];
                                        $data['salt'] = $hash['salt'];
                                        $data['email'] = $email;
                                        $data['verify_code'] = $verifyCode;
                                        $data['custom_service_id'] = $this->distributionCustomServer();
                                        $userModel = $userModel->addUser($data,$message);
                                        if($userModel !== false) {
                                                $emailData = array('ContactForm'=>array('name'=>'腾邦易贸通','email'=>'TempusHoldITAlert@tempus.cn','subject'=>'腾邦易贸通邮箱验证'));
								
											  if($contactFormModel->load($emailData)&& $contactFormModel->contact($email,'email_verify',['email'=>$email,'verifyCode'=>$verifyCode])) {
								
													  $this->redirect('/user-verify/translate-email');
                                                } else {
													
                                                        return Tool::outputError('注册失败');
                                                }
                                        }else {
                                            return Tool::outputError($message);
                                        }
                                } else {
                                    return Tool::outputError('两次密码不一致');
                                }
                            } else {
                                    return Tool::outputError($message);
                            }
    	} else {
    		return Tool::outputError('非法请求');
    	}
    }

    public function actionLogin() {
                $request = Yii::$app->request;
                $session = Yii::$app->session;
                if(!$session->isActive) $session->open();

                if($request->isAjax) {
                        $userModel = new Users;
                        $email = $request->post('email');
                        $userModel = $userModel->findByEmail($email,$message);
                        if($userModel) {
                                $password = $request->post('password');
                                $hash = Salt::vertifySalt($password, $userModel->salt);
                                $isPass = $hash == $userModel->password ? true : false;
                                if($isPass) {
                                    if($userModel->state == 1) {
                                            $frozenEvent = new MyEvents;
                                            $frozenEvent->on(MyEvents::EVENT_FROZEN, [$frozenEvent, 'frozen'],$userModel->id);
                                            $frozenEvent->trigger(MyEvents::EVENT_FROZEN);
                                            $session['userEmail'] = $email;
                                            $session['uid'] = $userModel->id;
                                            if(Yii::$app->user->login($userModel, 0)) {
                                                    $this->redirect('overview');
                                            } else {
                                                    return Tool::outputError('登陆错误,请重新登录');
                                            }
                                    } else if($userModel->state == 0) {
                                            return Tool::outputError('你的账户还没激活,请到您的邮箱里激活后登录');
                                    } else if($userModel->state == -1) {
                                            return Tool::outputError('你的账户已被禁用,请联系客服');  
                                    } else {
                                            return Tool::outputError('666');  
                                    }
                                } else {
                                        return Tool::outputError('你输入的账号或密码错误');
                                }
                        } else {
                                return Tool::outputError($message);
                        }
                } else {
                        return Tool::outputError('非法请求');
                }
    }

    public function actionLogout() {
            Yii::$app->user->logout();
            $this->redirect('/home');
    }

    private function distributionCustomServer() {
            $customServer = AdminUsers::find()->where(['rank'=>2,'state'=>1])->orderBy(['customer_number' => SORT_ASC])->one();
            $customServerId = $customServer->id;
            $customServer->customer_number = $customServer->customer_number+1;
            $customServer->save();
            return $customServerId;
    }

}
