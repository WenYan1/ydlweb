<?php

namespace app\controllers;

use app\controllers\HomeBaseController;
use app\models\CapitalLogs;
use app\models\RechargeLogs;
use app\models\Orders;
use app\models\Users;
use Tool;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;

class CapitalController extends HomeBaseController
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['index'],
				'rules' => [
					// 允许认证用户
					[
						'allow' => true,
						'roles' => ['@'],
					],
					// 默认禁止其他用户
				],
			],
		];
	}

	/**
	 * @资金管理
	 *
	 ***/
	public function actionIndex()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		$filter = $request->get('filter') ? $request->get('filter') : 1;
		$search = $request->get('search');
		$page = $request->get('page') ? $request->get('page') : 1;
		$overdueTime = 90 * 24 * 3600; //结汇时间
		$bufferTime = 2 * 24 * 3600; //还款缓冲期
		$nowTime = time();
		$timeDifference = $nowTime - $overdueTime; //结汇时间差
		$bufferTimeDifference = $nowTime - $overdueTime - $bufferTime; //缓冲时间差
		$query = Orders::find()->where(['user_id' => $session['uid']]);
		if ($filter == 1) {
			$query->andWhere(['or', ['and', 'delivery_time=0', 'order_state>=1'], ['and', 'delivery_time!=0', 'order_state<9', 'delivery_time>' . $timeDifference]])->andFilterWhere(['like', 'supplier_name', $search])->orderBy(['id' => SORT_DESC]);
		} else if ($filter == 2) {
			$query->andWhere(['<', 'order_state', 9])->andWhere(['<=', 'delivery_time', $timeDifference])->andWhere(['>=', 'delivery_time', $bufferTimeDifference])->andFilterWhere(['like', 'supplier_name', $search])->orderBy(['id' => SORT_DESC]);
		} else if ($filter == 3) {
			$query->andWhere(['<>', 'delivery_time', 0])->andWhere(['<', 'order_state', 9])->andWhere(['<', 'delivery_time', $bufferTimeDifference])->andFilterWhere(['like', 'supplier_name', $search])->orderBy(['id' => SORT_DESC]);
		} else if ($filter == 5) {
			$query->andWhere(['>=', 'order_state', 8])->andFilterWhere(['like', 'supplier_name', $search])->orderBy(['id' => SORT_DESC]);
		} else {
			$this->redirect('/capital/index');
		}
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);
		$usersModel = new Users;
		$usersModel = $usersModel->findById($session['uid']);

		return $this->render('capital_manager', [
			'models' => $models,
			'pages'  => $pages,
			'filter' => $filter,
			'search' => $search,
			'user'   => $usersModel->attributes,
			'page'   => $page
		]);
	}

	/**
	 * @资金流水
	 *
	 **/
	public function actionCapitalLogs()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		$type = $request->get('type') ? $request->get('type') : 3;
		$page = $request->get('page') ? $request->get('page') : 1;
		$startTime = $request->get('start_time') ? explode('-', $request->get('start_time')) : null;
		$endTime = $request->get('end_time') ? explode('-', $request->get('end_time')) : null;
		$startTimeStamp = $startTime ? mktime(0, 0, 0, $startTime[1], $startTime[2], $startTime[0]) : null;
		$endTimeStamp = $endTime ? mktime(0, 0, 0, $endTime[1], $endTime[2], $endTime[0]) : null;
		if ($type == 1 || $type == 2 || $type == 4) {
			$query = CapitalLogs::find()->where(['user_id' => $session['uid'], 'capital_type' => $type])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->orderBy(['id' => SORT_DESC]);
		} else {
			$query = RechargeLogs::find()->where(['user_id' => $session['uid']])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp])->orderBy(['created_at' => SORT_DESC]);
		}
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count()]);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);
		$usersModel = new Users;
		$usersModel = $usersModel->findById($session['uid']);

		$query = Orders::find()->where(['user_id' => $session['uid']])->orderBy(['created_at' => SORT_DESC])->all();
		$orders = Tool::convert2Array($query);

		return $this->render('capital_balance', [
			'models' => $models,
			'pages'  => $pages,
			'orders' => $orders,
			'type'   => $type,
			'user'   => $usersModel->attributes,
			'page'   => $page
		]);
	}

	public function actionRecharge()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$rechargeLogsModel = new RechargeLogs;
			$time = time();
			$data['user_id'] = $session['uid'];
			$data['user_email'] = $session['userEmail'];
			$data['account_name'] = $request->post('account_name');
			$data['bank_name'] = $request->post('bank_name');
			$data['bank_account'] = $request->post('bank_account');
			$data['recharge_amount'] = $request->post('recharge_amount');
			$data['currency'] = $request->post('currency');
			$data['recharge_time'] = $request->post('recharge_time');
			$data['created_at'] = $time;
			$data['update_at'] = $time;
			$rechargeLogsModel = $rechargeLogsModel->add($data, $message);
			if ($rechargeLogsModel) {
				$this->_setSuccessMessage($message);
				$this->redirect('/capital/capital-logs?type=3');
			} else {
				$this->_setErrorMessage($message);
				$this->redirect(Yii::$app->request->referrer);
			}
		} else {
			return $this->render('capital_recharge');
		}
	}

	public function actionChangeOrder()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$rechargeLogsModel = new RechargeLogs;
			$condition = [];
			$condition['id'] = $request->post('id');
			$recharge = $rechargeLogsModel->findById($condition, $message);
			if ($recharge) {
				$recharge->order_id = $request->post('val');

				if ($recharge->save()) {
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
