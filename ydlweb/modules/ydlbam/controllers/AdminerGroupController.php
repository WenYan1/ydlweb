<?php

namespace app\modules\ydlbam\controllers;

use Yii;
use Tool;
use app\modules\ydlbam\models\AdminModular;
use app\modules\ydlbam\models\AdminPermission;
use app\modules\ydlbam\models\AdminGroups;
use app\modules\ydlbam\controllers\AdminBaseController;

class AdminerGroupController extends AdminBaseController
{
    public function actionIndex()
    {
    	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
    	$this->initializeAttributes();
    	$groups = AdminGroups::find()->all();
    	$groups = Tool::convert2Array($groups);
        	return $this->render('index', [
        		'models' => $groups
        	]);
    }

    public function actionAddGroup() {
    	$request = Yii::$app->request;
    	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
    	$this->initializeAttributes();

    	if($request->isGet) {
    		$modular = AdminModular::find()->all();
    		$modular = Tool::convert2Array($modular);
    		return $this->render('add', [
    			'permission' => $modular
    		]);
    	} else {
    		$adminGroupsModel = new AdminGroups;
    		$connection = Yii::$app->db;
    		$groupInfo['group_name'] = $request->post('group_name');
    		$groupInfo['group_describe'] = $request->post('group_describe');
    		$adminGroupsModel = $adminGroupsModel->addGroup($groupInfo);
    		$permission = $request->post('permission');
    		foreach($permission as $val) {
    			$record['group_id'] = $adminGroupsModel->id;
    			$record['permission_name'] = $val;
    			$data[] = $record;
    		}
    		$result = $connection->createCommand()->batchInsert(AdminPermission::tableName(), ['group_id','permission_name'],$data)->execute();
    		$this->redirect('/ydlbam/adminer-group');
    	}
    }

    public function actionEditGroup() {
            $request = Yii::$app->request;
            $session = Yii::$app->session;
            if(!$session->isActive) $session->open();
            $this->initializeAttributes();

            if($request->isGet) {
                    $id = $request->get('id');
                    $group = AdminGroups::find()->where(['id'=>$id])->one();
                    $permissions = $group->groupPermission;
                    $data = array();
                    foreach($permissions as $val) {
                        $data[] = $val->permission_name;
                    }
                    $modular = AdminModular::find()->all();
                    $modular = Tool::convert2Array($modular);
                    return $this->render('edit', [
                        'permission' => $modular,
                        'group' => $group,
                        'myPermission' => $data,
                    ]);
            } else {
                $connection = Yii::$app->db;
                $id = $request->post('id');
                $group = AdminGroups::find()->where(['id'=>$id])->one();
                $group->group_name = $request->post('group_name');
                $group->group_describe = $request->post('group_describe');
                if($group->save()) {
                        AdminPermission::deleteAll('group_id = :id', [':id' => $id]);
                        $permission = $request->post('permission');
                        foreach($permission as $val) {
                            $record['group_id'] = $id;
                            $record['permission_name'] = $val;
                            $data[] = $record;
                        }
                        $result = $connection->createCommand()->batchInsert(AdminPermission::tableName(), ['group_id','permission_name'],$data)->execute();
                        $this->redirect('/ydlbam/adminer-group');
                }
            }
    }

}