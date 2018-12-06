<?php

namespace app\modules\ydlbam\controllers;

use Yii;
use Tool;
use app\models\AdminUsers;
use app\modules\ydlbam\controllers\AdminBaseController;

class LoginController extends AdminBaseController
{
    public function actionIndex()
    {
	$request = Yii::$app->request;
	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();

	if($request->isPost) {
		$adminUsersModel = new AdminUsers;
		$adminUsersModel = $adminUsersModel->findByUserName($request->post('user_name'));
		$password = $request->post('password');
                           $isPass = md5($password) == $adminUsersModel->password ? true : false;

                           if($isPass) {
                           		$data['rank'] = $adminUsersModel->rank;
                           		$data['gid'] = $adminUsersModel->group_id;
                           		$session['user_name'] = $adminUsersModel->user_name;
                           		$permissions = $this->verifyDisplay($data);
                           		$session['permissions'] = $permissions;
                                      $session['rank'] = $adminUsersModel->rank;
                                      $session['lastTime'] =$adminUsersModel->last_login;
                                      $session['adminuid'] = $adminUsersModel->id;
                                      if($adminUsersModel->rank == 2) {
                                            $usersId = $this->customServiceVerify($adminUsersModel->id);
                                            $session['usersIds'] = $usersId;
                                      }
                                      $adminUsersModel->last_login = time();
                                      $adminUsersModel->save();
                                      $this->redirect('/ydlbam/default/welcome');
                           }
	}
    }

    public function actionLoginOut() {
        $session = Yii::$app->session;
        if(!$session->isActive) $session->open();
        $session->destroy();
        $session->close();
        $this->redirect('/ydlbam');
    }

}
