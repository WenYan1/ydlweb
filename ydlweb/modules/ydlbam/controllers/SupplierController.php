<?php

namespace app\modules\ydlbam\controllers;

use app\models\Suppliers;
use Tool;
use Yii;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;

class SupplierController extends AdminBaseController {
	public $layout = 'ydlbam';
	public function actionIndex() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$state = $request->get('state');
		$supplierName = $request->get('supplier_name');
		$email = $request->get('email');
		$page = $request->get('page') ? $request->get('page') : 1;
		$query = Suppliers::find();
		if($session['rank'] == 2) {
			$query->where(['user_id'=>$session['usersIds']]);
			if ($state !== null || $supplierName !== null || $email !== null) {
				if ($state !== null) {
					$query->andWhere(['supplier_state' => $state])->andFilterWhere(['like', 'company_name', $supplierName])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($supplierName !== null) {
					$query->where(['like', 'company_name', $supplierName])->andWhere(['user_id'=>$session['usersIds']])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($email !== null) {
					$query->where(['like', 'user_email' , $email])->andWhere(['user_id'=>$session['usersIds']]);
				}
			}
		} else {
			if ($state !== null || $supplierName !== null || $email !== null) {
				if ($state !== null) {
					$query->where(['supplier_state' => $state])->andFilterWhere(['like', 'company_name', $supplierName])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($supplierName !== null) {
					$query->where(['like', 'company_name', $supplierName])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($email !== null) {
					$query->where(['like', 'user_email' , $email]);
				}
			}
		}

		$countQuery = clone $query->orderBy(['updated_at' => SORT_DESC]);
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		return $this->render('supplier_manage', [
			'models' => $models,
			'pages' => $pages,
			'state' => $state,
			'supplierName' => $supplierName,
			'email' => $email,
			'page' => $page,
		]);
	}

	public function actionSupplierDetail() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$supplierModel = new Suppliers;
		$id = $request->get('supplier_id');
		$supplierModel = $supplierModel->findById($id, $message);
		if ($supplierModel) {
			return $this->render('supplier_detail', [
				'supplier' => $supplierModel->attributes,
			]);
		} else {
			$this->redirect(Yii::$app->request->referrer);
		}
	}

	public function actionAuditingSupplier() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
    		
		if ($request->isPost) {
			$supplierModel = new Suppliers;
			$id = $request->post('supplier_id');
			$supplierModel = $supplierModel->findById($id, $message);
			if ($supplierModel) {
				$supplierModel->supplier_state = $request->post('state');
				if ($supplierModel->save()) {
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
