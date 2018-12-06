<?php

namespace app\modules\ydlbam\controllers;

use Yii;
use Tool;
use app\models\AdminUsers;
use app\modules\ydlbam\models\AdminGroups;
use app\modules\ydlbam\controllers\AdminBaseController;

class CustomServiceController extends AdminBaseController
{
    public function actionIndex()
    {
    	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
    	$this->initializeAttributes();
    	$adminer = AdminUsers::find()->where(['rank'=>2])->all();
    	$adminer = Tool::convert2Array($adminer);
        	return $this->render('index',[
        		'models' => $adminer
        	]);
    }

    public function actionAddCustomService() {
    	$request = Yii::$app->request;
    	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
    	$this->initializeAttributes();

    	if($request->isGet) {
    		return $this->render('add');
    	} else {
    		$adminUsersModel = new AdminUsers;
    		$password = $request->post('password');
    		$password = md5($password);
    		$data['user_name'] = $request->post('user_name');
    		$data['password'] = $password;
    		$data['group_id'] = 2;
    		$data['rank'] = 2;
                          $data['custom_email'] = $request->post('custom_email');  
                          $data['custom_tel'] = $request->post('custom_tel');
    		$adminUsersModel->addUser($data,$message);
    		$this->redirect('/ydlbam/custom-service');
    	}
    }

}
