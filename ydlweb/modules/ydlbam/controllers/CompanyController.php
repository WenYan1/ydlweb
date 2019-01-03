<?php

namespace app\modules\ydlbam\controllers;

use app\models\Companys;
use Tool;
use Yii;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;

class CompanyController extends AdminBaseController {
	public $layout = 'ydlbam';
	public function actionIndex() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$email = $request->get('email');
		$companyName = $request->get('company_name');
		$state = $request->get('state', null);
		$page = $request->get('page') ? $request->get('page') : 1;
		$query = Companys::find()->joinWith(['users'], false)->select(['users.id AS user_id', 'companys.id AS id', 'companys.company_name AS company_name', 'companys.company_tel AS company_tel', 'companys.created_at AS created_at', 'companys.state AS state', 'users.email AS user_email']);
		if($session['rank'] ==2) {
			$query->where(['user_id'=>$session['usersIds']]);
			if ($email !== null || $companyName !== null || $state !== null) {
				if ($email !== null) {
					$query->andWhere(['like', 'email', $email])->andFilterWhere(['like', 'company_name', $companyName])->andFilterWhere(['companys.state' => $state]);
				} else if ($companyName !== null) {
					$query->andFilterWhere(['like', 'company_name', $companyName])->andFilterWhere(['companys.state' => $state]);
				} else {
					$query->andFilterWhere(['companys.state' => $state]);
				}
			}
		} else {
			if ($email !== null || $companyName !== null || $state !== null) {
				if ($email !== null) {
					$query->where(['like', 'email', $email])->andFilterWhere(['like', 'company_name', $companyName])->andFilterWhere(['companys.state' => $state]);
				} else if ($companyName !== null) {
					$query->filterWhere(['like', 'company_name', $companyName])->andFilterWhere(['companys.state' => $state]);
				} else {
					$query->filterWhere(['companys.state' => $state]);
				}
			}

		}

		
		 $countQuery = clone $query;
		//$countQuery = clone $query->orderBy(['companys.created_at' => SORT_DESC]);
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->orderBy('created_at DESC')->offset($pages->offset)->limit($pages->limit)->asArray()->all();

		return $this->render('company_certify_manage', [
			'models' => $models,
			'pages' => $pages,
			'email' => $request->get('email'),
			'companyName' => $companyName,
			'page' => $page,
			'state' => $state,
		]);
	}

	public function actionCompanyDetail() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$id = $request->get('company_id');
		$companysModel = new Companys;
		$companysModel = $companysModel->findById($id, $message);
		header("Content-type:text/html;charset=utf8");
		// var_dump($companysModel->attributes);

		if ($companysModel) {
			return $this->render('company_detail', [
				'company' => $companysModel->attributes,
			]);
		} else {
			$this->redirect(Yii::$app->request->referrer);
		}
	}

	public function actionAuditingCompany() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
    		
		if ($request->isPost) {
			$companyModel = new Companys;
			$id = $request->post('company_id');
			$companyModel = $companyModel->findById($id, $message);
			if ($companyModel) {
				$companyModel->state = $request->post('state');
				if ($companyModel->save()) {
					return Tool::outputSuccess('审核成功');
				} else {
					return Tool::outputError('审核失败');
				}
			} else {
				return Tool::outputError($message);
			}
		} else {
			return Tool::outputError('非法请求');
		}
	}

}
