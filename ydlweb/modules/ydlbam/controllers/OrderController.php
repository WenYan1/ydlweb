<?php

namespace app\modules\ydlbam\controllers;

use app\models\Orders;
use Tool;
use Yii;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;

class OrderController extends AdminBaseController {
	public $layout = 'ydlbam';
	public function actionIndex() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$status = $request->get('state');
		$orderSn = $request->get('order_sn');
		$startTime = $request->get('start_time') ? explode('-', $request->get('start_time')) : null;
		$endTime = $request->get('end_time') ? explode('-', $request->get('end_time')) : null;
		$startTimeStamp = $startTime ? mktime(0, 0, 0, $startTime[1], $startTime[2], $startTime[0]) : null;
		$endTimeStamp = $endTime ? mktime(0, 0, 0, $endTime[1], $endTime[2], $endTime[0]) : null;
		$email = $request->get('email');
		$supplierName = $request->get('supplier_name');
		$downPatment = $request->get('down_payment');
		$page = $request->get('page') ? $request->get('page') : 1;
		$query = Orders::find();
		if($session['rank'] == 2) {
			$query->where(['user_id'=>$session['usersIds']]);
			if ($status !== null || $orderSn !== null || $email !== null || $downPatment !== null || $supplierName !== null || $startTimeStamp !== null || $endTimeStamp !== null) {
				if ($status !== null) {
					$query->andWhere(['order_state' => $status])->andFilterWhere(['like','order_sn',$orderSn])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'user_email' ,$email])->andFilterWhere(['like', 'supplier_name', $supplierName])->andFilterWhere(['down_payment' => $downPatment]);
				} else if ($orderSn !== null) {
					$query->andWhere(['like','order_sn',$orderSn])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'user_email', $email])->andFilterWhere(['like', 'supplier_name', $supplierName])->andFilterWhere(['down_payment' => $downPatment]);
				} else if ($email !== null) {
					$query->andWhere(['like', 'user_email',$email])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'supplier_name', $supplierName])->andFilterWhere(['down_payment' => $downPatment]);
				} else if ($downPatment !== null) {
					$query->andWhere(['down_payment' => $downPatment])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'supplier_name', $supplierName]);
				} else if ($supplierName !== null) {
					$query->andWhere(['like', 'supplier_name', $supplierName])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp]);
				} else if ($startTimeStamp !== null) {
					$query->andWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp]);
				} else {
					$query->andWhere(['<=', 'created_at', $endTimeStamp]);
				}
			}
		} else {
			if ($status !== null || $orderSn !== null || $email !== null || $downPatment !== null || $supplierName !== null || $startTimeStamp !== null || $endTimeStamp !== null) {
				if ($status !== null) {
					$query->where(['order_state' => $status])->andFilterWhere(['like','order_sn',$orderSn])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'user_email' ,$email])->andFilterWhere(['like', 'supplier_name', $supplierName])->andFilterWhere(['down_payment' => $downPatment]);
				} else if ($orderSn !== null) {
					$query->where(['like','order_sn',$orderSn])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'user_email', $email])->andFilterWhere(['like', 'supplier_name', $supplierName])->andFilterWhere(['down_payment' => $downPatment]);
				} else if ($email !== null) {
					$query->where(['like', 'user_email',$email])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'supplier_name', $supplierName])->andFilterWhere(['down_payment' => $downPatment]);
				} else if ($downPatment !== null) {
					$query->where(['down_payment' => $downPatment])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->andFilterWhere(['like', 'supplier_name', $supplierName]);
				} else if ($supplierName !== null) {
					$query->where(['like', 'supplier_name', $supplierName])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp]);
				} else if ($startTimeStamp !== null) {
					$query->where(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp]);
				} else {
					$query->where(['<=', 'created_at', $endTimeStamp]);
				}
			}
		}

		

		$countQuery = clone $query->orderBy(['created_at' => SORT_DESC]);
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);
		return $this->render('order_manage', [
			'models' => $models,
			'pages' => $pages,
			'state' => $status,
			'orderSn' => $orderSn,
			'startTime' => $request->get('start_time'),
			'endTime' => $request->get('end_time'),
			'email' => $request->get('email'),
			'supplierName' => $supplierName,
			'downPatment' => $downPatment,
			'page' => $page,
		]);
	}

	public function actionOrderDetail() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$ordersModel = new Orders;
		$condition['id'] = $request->get('id');
		$ordersModel = $ordersModel->findById($condition, $message);
		if ($ordersModel) {
			$orderGoods = $ordersModel->getOrderGoods()->all();
			$orderGoods = Tool::convert2Array($orderGoods);
			$payLogs = $ordersModel->getOrderPayLog()->all();
			$payLogs = Tool::convert2Array($payLogs);
			$ordersModel = $ordersModel->attributes;

			return $this->render('order_detail', [
				'order' => $ordersModel,
				'orderGoods' => $orderGoods,
				'payLogs' => $payLogs,
			]);
		} else {
			$this->_setErrorMessage($message);
			$this->redirect('order');
		}
	}
	/**
	* @审核订单
	*/
	public function actionAuditingOrder() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
    		
		if ($request->isPost) {
			$orderModel = new Orders;
			$id['id'] = $request->post('order_id');
			$orderModel = $orderModel->findById($id, $message);
			if ($orderModel) {

				$orderModel->order_state = $request->post('state');
				if ($orderModel->save()) {
					return Tool::outputSuccess('状态修改成功');
				} else {
					return Tool::outputError('状态修改失败');
				}
			} else {
				return Tool::outputError($message);
			}
		} else {
			return Tool::outputError('非法请求');
		}
	}

	public function actionChangeSettlementType (){
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$ordersModel = new Orders;
			$condition = [];
			$condition['id'] = $request->post('order_id');
			$order = $ordersModel->findById($condition,$message);
			if($order) {
				$order->settlement_type = $request->post('settlement_type');

				if($order->save()) {
					$arr = array(
						'state' => 1
					);
					$json = Tool::array2Json($arr);
					exit($json);
				}
			}
		}

		$arr = array(
			'state' => 0
		);

		$json = Tool::array2Json($arr);
		exit($json);
	}

	public function actionChangeServiceType (){
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$ordersModel = new Orders;
			$condition = [];
			$condition['id'] = $request->post('order_id');
			$order = $ordersModel->findById($condition,$message);
			if($order) {
				$order->service_type = $request->post('service_type');

				if($order->save()) {
					$arr = array(
						'state' => 1
					);
					$json = Tool::array2Json($arr);
					exit($json);
				}
			}
		}

		$arr = array(
			'state' => 0
		);

		$json = Tool::array2Json($arr);
		exit($json);
	}

	public function actionChangeFk (){
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$ordersModel = new Orders;
			$condition = [];
			$condition['id'] = $request->post('order_id');
			$order = $ordersModel->findById($condition,$message);

			$val = $request->post('val');
			$name = $request->post('name');

			if($order) {

				if ($name == 'first_payment_remark'){
					$order->first_payment_remark = $val;
				}

				if ($name == 'original_place_remark'){
					$order->original_place_remark = $val;
				}

				if($order->save()) {
					$arr = array(
						'state' => 1
					);
					$json = Tool::array2Json($arr);
					exit($json);
				}
			}
		}

		$arr = array(
			'state' => 0
		);

		$json = Tool::array2Json($arr);
		exit($json);
	}
}
