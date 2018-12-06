<?php

namespace app\modules\ydlbam\controllers;

use Yii;
use Tool;
use app\models\AdminUsers;
use app\modules\ydlbam\models\AdminGroups;
use app\modules\ydlbam\controllers\AdminBaseController;

class AdminerController extends AdminBaseController
{
    public function actionIndex()
    {
    	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
    	$this->initializeAttributes();
    	$adminer = AdminUsers::find()->where(['<>','rank',2])->all();
    	$adminer = Tool::convert2Array($adminer);
        	return $this->render('index',[
        			'models' => $adminer
        		]);
    }

    public function actionAddAdminer() {
    	$request = Yii::$app->request;
    	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
    	$this->initializeAttributes();

    	if($request->isGet){
    		$groups = AdminGroups::find()->all();
	    	$groups = Tool::convert2Array($groups);
                              unset($groups[0]);
                              unset($groups[1]);
	    	return $this->render('add',[
	    		'groups' => $groups
	    	]);
    	} else {
    		$adminUsersModel = new AdminUsers;
    		$password = $request->post('password');
    		$password = md5($password);
    		$data['user_name'] = $request->post('user_name');
    		$data['password'] = $password;
    		$data['group_id'] = $request->post('group_id');
    		$adminUsersModel->addUser($data,$message);
    		$this->redirect('/ydlbam/adminer');
    	}

    	
    }

}
