<?php

namespace app\modules\ydlbam\controllers;

use Yii;
use Tool;
use app\modules\ydlbam\models\AdminPermission;
use app\modules\ydlbam\models\AdminModular;
use app\models\Users;

class AdminBaseController extends \yii\web\Controller
{
    public $layout = 'ydlbam';
    public $_permission;
    public $_rank;
    public $_adminer;
    public $_lastTime;

    protected function verifyDisplay($data)
    {
    	if($data['rank'] == 0) {
    		$modulars = AdminModular::find()->all();
    		foreach($modulars as $val) {
    			$permissions[] = $val->permission_name;
    		}
    		$this->_permission = $permissions;
    		return $permissions;
    	}
	$adminPermissionModel = new AdminPermission;
	$permissions = $adminPermissionModel->getUserPermission($data['gid']);
	foreach($permissions as $val) {
		$filterPermissions[] = $val->permission_name;
	}
	$this->_permission = $filterPermissions;
	return $filterPermissions;
    }

    protected function customServiceVerify($customServiceId) {
               $users = Users::find()->select(['id'])->where(['custom_service_id' => $customServiceId])->all();
               $data = array();
               foreach($users as $user) {
                    $data[] = $user->id;
               }
               return $data;
    }

    protected function verifyAuth() {

    }

    protected function initializeAttributes() {
        $session = Yii::$app->session;
        $this->_permission = $session['permissions'];
        $this->_rank = $session['rank'];
        $this->_adminer = $session['user_name'];
        $this->_lastTime = $session['lastTime'];
    }

}
