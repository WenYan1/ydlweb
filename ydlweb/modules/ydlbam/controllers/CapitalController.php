<?php

namespace app\modules\ydlbam\controllers;

use app\models\CapitalLogs;
use app\models\Orders;
use app\models\RechargeLogs;
use app\models\Users;
use Tool;
use Yii;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;
use app\models\PayLogs;


class CapitalController extends AdminBaseController
{
	public $layout = 'ydlbam';

	public function actionCapitalLogs()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();
		$type = $request->get('type') ? $request->get('type') : 3;
		$page = $request->get('page') ? $request->get('page') : 1;
		$email = $request->get('email');
		$email = rawurldecode($email);

		if ($session['rank'] == 2) {
			if ($type == 3) {
				$query = RechargeLogs::find()->where(['user_id' => $session['usersIds']])->andFilterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			} else {
				$query = CapitalLogs::find()->where(['capital_type' => $type, 'user_id' => $session['usersIds']])->andFilterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			}
		} else {
			if ($type == 3) {
				$query = RechargeLogs::find()->filterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			} else {
				$query = CapitalLogs::find()->where(['capital_type' => $type])->andFilterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			}
		}

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count()]);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		return $this->render('capital_manage', [
			'models' => $models,
			'pages'  => $pages,
			'type'   => $type,
			'email'  => $email,
			'page'   => $page
		]);
	}

	public function actionListCapitalLogs()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();
		$type = $request->get('type') ? $request->get('type') : 3;
		$page = $request->get('page') ? $request->get('page') : 1;
		$email = $request->get('email');

		if ($session['rank'] == 2) {
			if ($type == 3) {
				$query = RechargeLogs::find()->where(['user_id' => $session['usersIds']])->andFilterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			} else {
				$query = CapitalLogs::find()->where(['capital_type' => $type, 'user_id' => $session['usersIds']])->andFilterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			}
		} else {
			if ($type == 3) {
				$query = RechargeLogs::find()->filterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			} else {
				$query = CapitalLogs::find()->where(['capital_type' => $type])->andFilterWhere(['user_email' => $email])->orderBy(['id' => SORT_DESC]);
			}
		}

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		return $this->render('capital_balance', [

			'models' => $models,
			'pages'  => $pages,
			'type'   => $type,
			'email'  => $email,
			'page'   => $page
		]);
	}


	public function actionUserCapital()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->_permission = $session['permissions'];
		$email = $request->get('email');
		if ($session['rank'] == 2) {
			$query = Users::find()->where(['user_id' => $session['usersIds']])->andFilterWhere(['email' => $email]);
		} else {
			$query = Users::find()->filterWhere(['email' => $email]);
		}

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$page = $request->get('page') ? $request->get('page') : 1;
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		return $this->render('user_capital', [
			'models' => $models,
			'pages'  => $pages,
			'email'  => $email,
			'page'   => $page,
		]);
	}


	public function actionRecharge()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->_permission = $session['permissions'];
		$page = $request->get('page') ? $request->get('page') : 1;
		$startTime = $request->get('start_time') ? explode('-', $request->get('start_time')) : null;
		$endTime = $request->get('end_time') ? explode('-', $request->get('end_time')) : null;
		$startTimeStamp = $startTime ? mktime(0, 0, 0, $startTime[1], $startTime[2], $startTime[0]) : null;
		$endTimeStamp = $endTime ? mktime(0, 0, 0, $endTime[1], $endTime[2], $endTime[0]) : null;
		$email = $request->get('email');
		$query = RechargeLogs::find();
		if ($session['rank'] == 2) {
			$query->where(['user_id' => $session['usersIds']]);
			if ($email !== null || $startTimeStamp !== null || $endTimeStamp !== null) {
				if ($email !== null) {
					$query->andWhere(['like', 'user_email', $email])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp]);
				} else if ($startTimeStamp !== null) {
					$query->andWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp]);
				} else {
					$query->andWhere(['<=', 'created_at', $endTimeStamp]);
				}
			}
		} else {
			if ($email !== null || $startTimeStamp !== null || $endTimeStamp !== null) {
				if ($email !== null) {
					$query->where(['like', 'user_email', $email])->andFilterWhere(['>=', 'created_at', $startTimeStamp])->andFilterWhere(['<=', 'created_at', $endTimeStamp]);
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

		$query = Orders::find()->orderBy(['created_at' => SORT_DESC])->all();
		$orders = Tool::convert2Array($query);

		return $this->render('capital_recharge', [
			'models'    => $models,
			'pages'     => $pages,
			'orders'    => $orders,
			'startTime' => $request->get('start_time'),
			'endTime'   => $request->get('end_time'),
			'email'     => $request->get('email'),
			'page'      => $page,
		]);
	}

	public function actionPayLogs()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->_permission = $session['permissions'];
		$page = $request->get('page') ? $request->get('page') : 1;
		$state = $request->get('state') ? $request->get('state') : 0;
		$query = PayLogs::find();
		if ($session['rank'] == 2) {
			$query->where(['user_id' => $session['usersIds'], 'state' => $state])->orderBy(['id' => SORT_DESC]);
		} else {
			$query->where(['state' => $state])->orderBy(['id' => SORT_DESC]);
		}
		$countQuery = clone $query->orderBy(['created_at' => SORT_DESC]);
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);
		return $this->render('pay_logs', [
			'models' => $models,
			'pages'  => $pages,
			'type'   => $state,
			'page'   => $page,
		]);
	}

	public function actionAuditingPayLogs()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->_permission = $session['permissions'];
		$id = $request->get('id');
		$state = $request->get('state');
		$payLogs = PayLogs::find()->where(['id' => $id])->one();
		$payLogs->state = $state;
		if ($payLogs->save()) {
			$this->redirect(Yii::$app->request->referrer);
		}

	}

	public function actionAuditingRecharge()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->_permission = $session['permissions'];
		if ($request->isAjax) {
			$rechargeLogsModel = new RechargeLogs;
			$id = $request->post('id');
			$rechargeLogsModel = $rechargeLogsModel->findById($id, $message);

			if ($rechargeLogsModel) {
				$state = $request->post('state');
				if ($state == 1) {
					$connection = Yii::$app->db;
					$transaction = $connection->beginTransaction();
					try {
						$rechargeLogsModel->state = 1;
						if ($rechargeLogsModel->save()) {
							$userModel = new Users;
							$userModel = $userModel->findById($rechargeLogsModel->user_id);
							if ($rechargeLogsModel->currency != 1) {
								if (empty($rechargeLogsModel->exchange_rate) || $rechargeLogsModel->exchange_rate == '0.00') {
									$transaction->rollBack();
									return Tool::outputError('客户选择的非人民币,请先设置汇率！');
								}
								$userModel->user_capital += $rechargeLogsModel->exchange_settlement_rmb;
							} else {
								$_capital = $rechargeLogsModel->recharge_amount;
								$userModel->user_capital += $_capital;
							}
							if ($userModel->save()) {
								$capitalLogsModel = new CapitalLogs;
								$data['user_id'] = $rechargeLogsModel->user_id;
								$data['user_email'] = $rechargeLogsModel->user_email;
								$data['currency'] = $rechargeLogsModel->currency;
								$data['re_id'] = $rechargeLogsModel->id;
								$data['flow_sn'] = time() . rand(10000, 99999);
								$data['capital'] = $rechargeLogsModel->recharge_amount;
								$data['exchange_rate'] = $rechargeLogsModel->exchange_rate;
								if ($rechargeLogsModel->currency != 1) {
									$data['exchange_settlement_rmb'] = $rechargeLogsModel->exchange_settlement_rmb;
								}
								$data['capital_symbol'] = '+';
								$data['capital_type'] = 1;
								if ($rechargeLogsModel->currency != 1) {
									$data['capital_type'] = 4;
								}
								$data['capital_explain'] = '充值';
								$data['created_at'] = time();
								$result = $capitalLogsModel->add($data);
								if ($result) {
									$transaction->commit();
									return Tool::outputSuccess('审核成功');
								} else {
									$transaction->rollBack();
									return Tool::outputError('审核失败');
								}
							} else {
								$transaction->rollBack();
								return Tool::outputError('审核失败');
							}
						} else {
							$transaction->rollBack();
							return Tool::outputError('审核失败');
						}
					} catch (Exception $e) {
						$transaction->rollBack();
						return Tool::outputError('审核失败');
					}
				} else {
					$rechargeLogsModel->state = -1;
					if ($rechargeLogsModel->save()) {
						return Tool::outputSuccess('审核成功');
					} else {
						return Tool::outputError('审核失败');
					}
				}
			} else {
				return Tool::outputError($message);
			}
		}
	}

	public function actionCapitalLog()
	{
		return $this->render('capital_balance');
	}

	public function actionExchangeRate()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isAjax) {
			$rechargeLogsModel = new RechargeLogs;
			$id = $request->post('id');
			$val = $request->post('val');

			$rechargeLogsModel = $rechargeLogsModel->findById($id, $message);

			if ($rechargeLogsModel) {
				$connection = Yii::$app->db;
				$transaction = $connection->beginTransaction();

				$rechargeLogsModel->exchange_rate = $val;
				$rechargeLogsModel->exchange_settlement_rmb = sprintf("%.2f", $rechargeLogsModel->exchange_rate * $rechargeLogsModel->recharge_amount);

				if ($rechargeLogsModel->save()) {
					$transaction->commit();
					return Tool::outputSuccess('修改成功');
				}
			}
		}
	}
}
