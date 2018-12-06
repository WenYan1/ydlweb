<?php
namespace app\modules\ydlbam\controllers;

use app\models\CapitalLogs;
use app\models\Companys;
use app\models\Orders;
use app\models\Users;
use Tool;
use Yii;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;
use app\models\AdminUsers;

class UserController extends AdminBaseController {
	public $layout = 'ydlbam';
	public function actionIndex() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$email = $request->get('email');
		$page = $request->get('page') ? $request->get('page') : 1;
		if($session['rank'] == 2) {
			$query = Users::find()->leftJoin('companys', 'users.id=companys.user_id')->leftJoin('admin_users','users.custom_service_id=admin_users.id')->select(['users.id', 'users.email', 'users.phone', 'users.name', 'users.updated_at', 'companys.company_name', 'companys.id company_id','admin_users.user_name'])->where(['users.id'=>$session['usersIds']])->andFilterWhere(['like', 'email', $email]);
		} else {
			$query = Users::find()->leftJoin('companys', 'users.id=companys.user_id')->leftJoin('admin_users','users.custom_service_id=admin_users.id')->select(['users.id', 'users.email', 'users.phone', 'users.name', 'users.updated_at', 'companys.company_name', 'companys.id company_id','admin_users.user_name'])->filterWhere(['like', 'email', $email]);
		}
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

		return $this->render('user_manage', [
			'models' => $models,
			'pages' => $pages,
			'email' => $email,
			'page' => $page,
		]);
	}

	public function actionUserDetail() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$id = $request->get('id');
		$usersModel = new Users;
		$customers = AdminUsers::find()->where(['rank'=>2])->all();
		$customers = Tool::convert2Array($customers);
		$usersModel = $usersModel->findById($id);
		$company = $usersModel->company;
		$customServer = $usersModel->customServer;
		$company = $company ? $company->attributes : NULL;
		$customServer = $customServer ? $customServer->attributes : NULL;

		return $this->render('user_account_detail', [
				'user' => $usersModel->attributes,
				'company' => $company,
				'customServer' => $customServer,
				'customers' => $customers,
			]);
	}

	public function actionCompanyDetail() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$companyId = $request->get('company_id');
		$companysModel = new Companys;
		$companysModel = $companysModel->findById($companyId, $message);
		return $this->render('user_company_detail', [
			'company' => $companysModel->attributes,
		]);
	}

	public function actionCapitalLogs() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$id = $request->get('id');
		$capitalLogsModel = new CapitalLogs;
		$capitalLogsModel = $capitalLogsModel->findByUserId($id, $message);
		$capitalLogsModel = Tool::convert2Array($capitalLogsModel);

		return $this->render('', [
			'logs' => $capitalLogsModel,
		]);
	}

	public function actionOrders() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$userId = $request->get('user_id');
		$orders = Orders::find()->where(['user_id' => $userId])->all();
		$orders = Tool::convert2Array($orders);

		return $this->render('', [
			'orders' => $orders,
		]);
	}

	public function actionModifyCustomServer() {
		$request = Yii::$app->request;
		$usersModel = new Users;
		$id = $request->post('uid');
		$usersModel = $usersModel->findById($id);
		$usersModel->custom_service_id = $request->post('custom_server_id');
		if($usersModel->save()) {
			$this->redirect('/ydlbam/user');
		} 
	}
}
