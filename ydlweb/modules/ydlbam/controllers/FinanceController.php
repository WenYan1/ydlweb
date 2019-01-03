<?php

namespace app\modules\ydlbam\controllers;

use Yii;
use Tool;
use app\models\Users;
use app\models\CapitalLogs;
use app\models\EcicChangeLogs;
use app\models\Industry;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;

class FinanceController extends AdminBaseController {
	public $layout = 'ydlbam';

	public function actionIndex() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$email = $request->get('email');
		$page = $request->get('page') ? $request->get('page') : 1;
		if($session['rank'] == 2) {
			$query = (new \yii\db\Query())->select("users.id,users.email,users.credi_limit,users.total_creditlimit,companys.company_name")->from('users')->leftJoin('companys', 'companys.user_id = users.id')->where(['user_id'=>$session['usersIds']])->andFilterWhere(['like','users.email', $email]);
		} else {
			$query = (new \yii\db\Query())->select("users.id,users.email,users.credi_limit,users.total_creditlimit,companys.company_name")->from('users')->leftJoin('companys', 'companys.user_id = users.id')->filterWhere(['like','users.email', $email]);
		}
		
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->orderBy('users.updated_at DESC')->offset($pages->offset)->limit($pages->limit)->all();

		return $this->render('fs_manage', [
			'models' => $models,
			'pages' => $pages,
			'email' => $email,
			'page' => $page,
		]);
	}

	public function actionDetail() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$id = $request->get('id');
		$usersModel = new Users;
		$usersModel = $usersModel->findById($id);
		$company = $usersModel->company;
		if ($company !== NULL) {

			$industry = new Industry;
			$data = $industry->find()->asArray()->all();

			return $this->render('fs_detail', [
			'user' => $usersModel->attributes,
			'company' => $company->attributes,
			'exportRange' => $data,
		]);
		}
		return $this->render('fs_detail', [
			'user' => $usersModel->attributes,
			'company' => NULL,
		]);
	}


	public function actionCapitalLogs() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$id = $request->get('id');
		$logs = CapitalLogs::find()->where(['user_id'=>$id,'capital_type'=>2])->all();
		$logs = Tool::convert2Array($logs);

		return $this->render('', [
			'logs' => $logs
		]);
	}

	public function actionEcicChangeLogs() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$id = $request->get('id');
		$ecicChangeLogsModel = new EcicChangeLogs;
		$ecicChangeLogsModel = $ecicChangeLogsModel->findByUserId($id,$message);
		$ecicChangeLogsModel = Tool::convert2Array($ecicChangeLogsModel);

		return $this->render('fs_use', [
			'change_logs' => $ecicChangeLogsModel
		]);
	}

	public function actionEditCredit() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$id = $request->post('id');
		$money = $request->post('money');
		$usersModel = new Users;
		$success = $usersModel->editUserCredit($id, $money, $message, $lastCredit);
		if ($success) {
			$data = array(
				'code' => 200,
				'status' => true,
				'message'=>$message,
				'lastCredit'=>$lastCredit,
			);
			$jsonData = json_encode($data);
			return $jsonData;
		} else {
			$data = array(
				'code' => 200,
				'status' => false,
				'message'=>$message,
				'lastCredit'=>$lastCredit,
			);
			$jsonData = json_encode($data);
			return $jsonData;
		}
	}
}
