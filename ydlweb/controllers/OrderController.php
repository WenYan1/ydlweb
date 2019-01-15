<?php

namespace app\controllers;

use app\controllers\HomeBaseController;
use app\models\Companys;
use app\models\Goods;
use app\models\OrderGoods;
use app\models\Orders;
use app\models\Suppliers;
use app\models\Users;
use Tool;
use Upload;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use app\models\WorldPorts;
use app\models\ChinaPorts;
use app\models\HSCodeTax;
use mPDF;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use Symfony\Component\Process\Process;

class OrderController extends HomeBaseController
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
				],
			],
			[
				'class'        => 'yii\filters\HttpCache',
				'only'         => ['index', 'order-detail'],
				'lastModified' => function ($action, $params) {
					$session = Yii::$app->session;
					if (!$session->isActive) $session->open();
					$q = new \yii\db\Query();
					$count = (new \yii\db\Query())->from('orders')->where(['user_id' => $session['uid']])->count();
					if ($count) {
						return $q->from('orders')->where(['user_id' => $session['uid']])->max('updated_at');
					} else {
						return $q->from('orders')->max('updated_at');
					}
				},
			],
		];
	}

	public function actionIndex()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		$status = $request->get('state');
		$search = $request->get('search');
		$page = $request->get('page') ? $request->get('page') : 1;
		$query = Orders::find()->where(['user_id' => $session['uid']])->andFilterWhere(['order_state' => $status])->andFilterWhere(['like', 'supplier_name', $search])->orderBy(['id' => SORT_DESC]);

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		$order_ids = '';

		foreach ($models as $item) {
			$order_ids .= $order_ids === '' ? $item['id'] : ',' . $item['id'];
		}

		// todo 多个产品调整此处  $_orders_goods[$item['order_id']] 为 $_orders_goods[$item['order_id']][]
		$_orders_goods = array();
		if (!empty($order_ids)) {
			$orders_goods = OrderGoods::find()->where("order_id in($order_ids)")->orderBy(['id' => SORT_DESC])->all();
			$orders_goods = Tool::convert2Array($orders_goods);
			foreach ($orders_goods as $item) {
				$_orders_goods[$item['order_id']] = $item;
			}
		}

		return $this->render('order_manage', [
			'models'       => $models,
			'pages'        => $pages,
			'state'        => $status,
			'search'       => $search,
			'orders_goods' => $_orders_goods,
			'page'         => $page
		]);
	}

	public function actionAddFirstStep()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$dir = 'orders/';

			$ordersModel = new Orders;
			$post = $request->post();
			$post['order_sn'] = $post['contract_type'];
			$post['user_id'] = $_SESSION['uid'];
			$post['email'] = $_SESSION['userEmail'];
			$post['delivery_time'] = empty($post['delivery_time']) ? '' : strtotime($post['delivery_time']);

			$goodsData = !empty($post['goods']) ? $post['goods'] : array();
			unset($post['goods']);

			unset($post['_csrf']);

			$purchasing_orderFile = UploadedFile::getInstanceByName('purchasing_order');
			$other_fileFile = UploadedFile::getInstanceByName('other_file');

			$purchasing_order = '';
			if (!empty($purchasing_orderFile)) {
				$temp = Upload::getPath($dir, $purchasing_orderFile->getExtension());
				$temp_result = $purchasing_orderFile->saveAs($temp['savePath'] . $temp['newName']);
				if (!$temp_result) {
					$this->_setErrorMessage('近期开过的发票样本风控附件上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$purchasing_order = $dir . $temp['newName'];
			}

			$other_file = '';
			if (!empty($other_fileFile)) {
				$temp = Upload::getPath($dir, $other_fileFile->getExtension());
				$temp_result = $other_fileFile->saveAs($temp['savePath'] . $temp['newName']);
				if (!$temp_result) {
					$this->_setErrorMessage('近期开过的发票样本风控附件上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$other_file = $dir . $temp['newName'];
			}

			$supplier = Suppliers::find()->where("id in({$goodsData[0]['supplier_id']})")->orderBy(['id' => SORT_DESC])->one();
			if (!empty($supplier)) {
				$post['supplier_id'] = $supplier['id'];
				$post['supplier_name'] = $supplier['company_name'];
			}

			$connection = Yii::$app->db;
			$transaction = $connection->beginTransaction();

			try {
				if (!empty($purchasing_order)) {
					$post['purchasing_order'] = $purchasing_order;
				}

				if (!empty($other_file)) {
					$post['other_file'] = $other_file;
				}

				$invoice_amount = 0;
				$customs_money = 0;
				foreach ($goodsData as $key => $item) {
					$invoice_amount += $item['invoice_amount'];
					$customs_money += $item['subtotal'];
				}

				$post['invoice_amount'] = $invoice_amount;
				$post['customs_money'] = $customs_money;
				$order = $ordersModel->add($post, $message);

				if ($order) {
					$order_id = $order->id;
					if (empty($goodsData)) {
						$transaction->rollBack();
						$this->_setErrorMessage('订单产品不能为空');
						$this->redirect(Yii::$app->request->referrer);
					} else {
						foreach ($goodsData as $key => $item) {
							$goodsData[$key]['order_id'] = $order_id;
						}
						$result = $connection->createCommand()->batchInsert(OrderGoods::tableName(), ['goods_id', 'tax_rebate_rate', 'net_weight', 'gross_weight', 'box_number', 'box_unit', 'standard_count', 'standard_count_unit', 'standard_count2', 'standard_count2_unit', 'goods_price', 'invoice_amount', 'supplier_id', 'tax_cost', 'estimated_cost', 'estimated_interest', 'estimate', 'subtotal', 'customs_declaration_price', 'order_id'], $goodsData)->execute();
						if ($result) {
							$transaction->commit();
							$this->_setSuccessMessage($message);
							$this->redirect('index');
						} else {
							$transaction->rollBack();
							$this->_setErrorMessage('订单提交失败');
							$this->redirect(Yii::$app->request->referrer);
						}
					}
				} else {
					$transaction->rollBack();
					$this->_setErrorMessage($message);
					$this->redirect(Yii::$app->request->referrer);
				}
			} catch (Exception $e) {
				$transaction->rollBack();
				$this->_setErrorMessage('订单提交失败');
				$this->redirect(Yii::$app->request->referrer);
			}


			$this->redirect('index');
		} else {
			$userModel = new Users;
			$suppliersModel = new Suppliers;
			$userModel = $userModel->findById($session['uid']);

			$goodsModel = new Goods;
			$condition['user_id'] = $session['uid'];
			$goodsModel = $goodsModel->findBySupplier($condition);
			$goodsModel = Tool::convert2Array($goodsModel);

			$suppliersModel = $suppliersModel->findByUserId($session['uid']);
			$suppliersModel = Tool::convert2Array($suppliersModel);
			return $this->render('add_order_1', [
				'supplier' => $suppliersModel,
				'goods'    => $goodsModel,
			]);

			if ($userModel->state === -2) {
				$this->_setErrorMessage('您还存在逾期订单未支付,暂时不能下单');
				$this->redirect(Yii::$app->request->referrer);
			} else {
				$suppliersModel = $suppliersModel->findByUserId($session['uid']);
				$suppliersModel = Tool::convert2Array($suppliersModel);
				return $this->render('add_order_1', [
					'supplier' => $suppliersModel,
					'goods'    => $goodsModel,
				]);
			}
		}
	}

	public function actionAddSecondStep()
	{
		$request = Yii::$app->request;
		$cookies = $request->cookies;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$ordersModel = new Orders;
			$post = $request->post();
			$orderInfo = $request->post('order_info');
			//$orderInfo['order_sn'] = time() . rand(10000, 99999);
			//$orderInfo['order_sn'] = $session['order_sn'];
			$orderInfo['user_id'] = $session['uid'];
			$orderInfo['email'] = $session['userEmail'];
			$orderInfo['invoice_amount'] = $orderInfo['invoice_amount'] * 1.17;
			$orderInfo['exchange_rate'] = $this->rmbToUsd();
			unset($post['order_info']);
			$connection = Yii::$app->db;
			$transaction = $connection->beginTransaction();
			if ($orderInfo['down_payment'] == 1) {
				if ($orderInfo['firstpayment_amount'] == 0) {
					$this->_setErrorMessage('首付款金额不能为0');
					$this->redirect(Yii::$app->request->referrer);
				} else if ($orderInfo['firstpayment_amount'] > $orderInfo['invoice_amount']) {
					$this->_setErrorMessage('首付款金额不能大于订单总金额');
					$this->redirect(Yii::$app->request->referrer);
				} else {
					try {
						$order = $ordersModel->add($orderInfo, $message);
						if ($order) {
							$order_id = $order->id;
							$orderGoods = array();
							foreach ($post as $value) {
								if (is_array($value)) {
									$goods = array();
									$goods[0] = $order_id;
									foreach ($value as $val) {
										$goods[] = $val;
									}
									$orderGoods[] = $goods;
								}
							}
							if (empty($orderGoods)) {
								$transaction->rollBack();
								$this->_setErrorMessage('订单产品不能为空');
								$this->redirect(Yii::$app->request->referrer);
							} else {
								$result = $connection->createCommand()->batchInsert(OrderGoods::tableName(), ['order_id', 'goods_id', 'goods_image', 'goods_name', 'gross_weight', 'net_weight', 'box_number', 'goods_price', 'goods_num', 'hs_code', 'goods_taxrate'], $orderGoods)->execute();
								if ($result) {
									$transaction->commit();
									$this->_setSuccessMessage($message);
									$this->redirect('index');
								} else {
									$transaction->rollBack();
									$this->_setErrorMessage('订单提交失败');
									$this->redirect(Yii::$app->request->referrer);
								}
							}
						} else {
							$transaction->rollBack();
							$this->_setErrorMessage($message);
							$this->redirect(Yii::$app->request->referrer);
						}
					} catch (Exception $e) {
						$transaction->rollBack();
						$this->_setErrorMessage('订单提交失败');
						$this->redirect(Yii::$app->request->referrer);
					}
				}
			} else {
				try {
					$order = $ordersModel->add($orderInfo, $message);
					if ($order) {
						$order_id = $order->id;
						$orderGoods = array();
						foreach ($post as $value) {
							if (is_array($value)) {
								$goods = array();
								$goods[0] = $order_id;
								foreach ($value as $val) {
									$goods[] = $val;
								}
								$orderGoods[] = $goods;
							}
						}
						if (empty($orderGoods)) {
							$transaction->rollBack();
							$this->_setErrorMessage('订单产品不能为空');
							$this->redirect(Yii::$app->request->referrer);
						} else {
							$result = $connection->createCommand()->batchInsert(OrderGoods::tableName(), ['order_id', 'goods_id', 'goods_image', 'goods_name', 'gross_weight', 'net_weight', 'box_number', 'goods_price', 'goods_num', 'hs_code', 'goods_taxrate'], $orderGoods)->execute();
							if ($result) {
								$transaction->commit();
								$this->_setSuccessMessage($message);
								$this->redirect('index');
							} else {
								$transaction->rollBack();
								$this->_setErrorMessage('订单提交失败');
								$this->redirect(Yii::$app->request->referrer);
							}
						}
					} else {
						$transaction->rollBack();
						$this->_setErrorMessage($message);
						$this->redirect(Yii::$app->request->referrer);
					}
				} catch (Exception $e) {
					$transaction->rollBack();
					$this->_setErrorMessage('订单提交失败');
					$this->redirect(Yii::$app->request->referrer);
				}
			}
		} else {
			$cookie = $cookies->get('order_goods');
			if ($cookie !== null) {
				$suppliersModel = new Suppliers;
				$companysModel = new Companys;
				$order_goods = $cookie->value;
				$supplier_id = $order_goods['supplier_id'];
				$globalPorts = WorldPorts::find()->all();
				$globalPorts = Tool::convert2Array($globalPorts);
				$globalPorts = json_encode($globalPorts);
				$chinaPorts = ChinaPorts::find()->all();
				$chinaPorts = Tool::convert2Array($chinaPorts);
				$chinaPorts = json_encode($chinaPorts);
				$huilv = $this->rmbToUsd();
				$supplier = $suppliersModel->getById($supplier_id, $message);
				if ($supplier) {
					$supplier = $supplier->attributes;
					$user_company = $companysModel->findByUserId($session['uid']);

					return $this->render('add_order_2', [
						'order_goods'   => $order_goods,
						'supplier'      => $supplier,
						'user_company'  => $user_company,
						'globalPorts'   => $globalPorts,
						'chinaPorts'    => $chinaPorts,
						'exchange_rate' => $huilv,
					]);
				} else {
					$this->_setErrorMessage('该供应商不存在');
					$this->redirect('add-first-step');
				}
			} else {
				$this->_setErrorMessage('请先选择供应商产品');
				$this->redirect('add-first-step');
			}
		}
	}

	public function actionOrderEdit()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$dir = 'orders/';
			$order_id = $request->post('order_id');

			$ordersModel = new Orders;
			$post = $request->post();
			$post['order_sn'] = $post['contract_type'];
			$post['user_id'] = $_SESSION['uid'];
			$post['email'] = $_SESSION['userEmail'];
			$post['delivery_time'] = empty($post['delivery_time']) ? '' : strtotime($post['delivery_time']);

			$goodsData = !empty($post['goods']) ? $post['goods'] : array();
			unset($post['goods']);
			unset($post['_csrf']);
			unset($post['order_id']);

			$purchasing_orderFile = UploadedFile::getInstanceByName('purchasing_order');
			$other_fileFile = UploadedFile::getInstanceByName('other_file');

			$purchasing_order = '';
			if (!empty($purchasing_orderFile)) {
				$temp = Upload::getPath($dir, $purchasing_orderFile->getExtension());
				$temp_result = $purchasing_orderFile->saveAs($temp['savePath'] . $temp['newName']);
				if (!$temp_result) {
					$this->_setErrorMessage('近期开过的发票样本风控附件上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$purchasing_order = $dir . $temp['newName'];
			}

			$other_file = '';
			if (!empty($other_fileFile)) {
				$temp = Upload::getPath($dir, $other_fileFile->getExtension());
				$temp_result = $other_fileFile->saveAs($temp['savePath'] . $temp['newName']);
				if (!$temp_result) {
					$this->_setErrorMessage('近期开过的发票样本风控附件上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$other_file = $dir . $temp['newName'];
			}

			$supplier = Suppliers::find()->where("id in({$goodsData[0]['supplier_id']})")->orderBy(['id' => SORT_DESC])->one();
			if (!empty($supplier)) {
				$post['supplier_id'] = $supplier['id'];
				$post['supplier_name'] = $supplier['company_name'];
			}

			$connection = Yii::$app->db;
			$transaction = $connection->beginTransaction();

			try {
				if (!empty($purchasing_order)) {
					$post['purchasing_order'] = $purchasing_order;
				}

				if (!empty($other_file)) {
					$post['other_file'] = $other_file;
				}

				$invoice_amount = 0;
				$customs_money = 0;
				$anticipated_tax_refund = 0;
				foreach ($goodsData as $key => $item) {
					$invoice_amount += $item['invoice_amount'];
					$customs_money += $item['subtotal'];
					$anticipated_tax_refund += $item['estimated_cost'];
				}

				$post['invoice_amount'] = $invoice_amount;
				$post['customs_money'] = $customs_money;
				$post['anticipated_tax_refund'] = $anticipated_tax_refund;
				$order = $ordersModel->edit(['id' => $order_id], $post, $message);

				if ($order) {
					if (empty($goodsData)) {
						$transaction->rollBack();
						$this->_setErrorMessage('订单产品不能为空');
						$this->redirect(Yii::$app->request->referrer);
					} else {
						$orderGoodsModel = new OrderGoods;
						$orderGoodsModel->actDeleteAll($order_id, $message);
						foreach ($goodsData as $key => $item) {
							$goodsData[$key]['order_id'] = $order_id;
						}
						$result = $connection->createCommand()->batchInsert(OrderGoods::tableName(), ['goods_id', 'tax_rebate_rate', 'net_weight', 'gross_weight', 'box_number', 'box_unit', 'standard_count', 'standard_count_unit', 'standard_count2', 'standard_count2_unit', 'goods_price', 'invoice_amount', 'supplier_id', 'tax_cost', 'estimated_cost', 'estimated_interest', 'estimate', 'subtotal', 'customs_declaration_price', 'order_id'], $goodsData)->execute();
						if ($result) {
							$transaction->commit();
							$this->_setSuccessMessage("订单编辑成功");
							$this->redirect('index');
						} else {
							$transaction->rollBack();
							$this->_setErrorMessage('订单提交失败');
							$this->redirect(Yii::$app->request->referrer);
						}
					}
				} else {
					$transaction->rollBack();
					$this->_setErrorMessage("订单编辑失败");
					$this->redirect(Yii::$app->request->referrer);
				}
			} catch (Exception $e) {
				$transaction->rollBack();
				$this->_setErrorMessage('订单提交失败');
				$this->redirect(Yii::$app->request->referrer);
			}

			$this->redirect('index');
		} else {
			$ordersModel = new Orders;
			$condition['id'] = $request->get('id');
			$condition['user_id'] = $session['uid'];
			$ordersModel = $ordersModel->findById($condition, $message);
			if ($ordersModel) {
				$orderGoods = $ordersModel->orderGoods;
				$orderGoods = Tool::convert2Array($orderGoods);
				$payLogs = $ordersModel->orderPayLog;
				$payLogs = Tool::convert2Array($payLogs);
				$ordersModel = $ordersModel->attributes;

				$goodsModel = new Goods;
				$goodsModel = $goodsModel->findBySupplier(['user_id' => $session['uid']]);
				$goodsModel = Tool::convert2Array($goodsModel);

				$suppliersModel = new Suppliers;
				$suppliersModel = $suppliersModel->findByUserId($session['uid']);
				$suppliersModel = Tool::convert2Array($suppliersModel);

				return $this->render('order_edit', [
					'order'      => $ordersModel,
					'orderGoods' => $orderGoods,
					'payLogs'    => $payLogs,
					'goods'      => $goodsModel,
					'supplier'   => $suppliersModel,
				]);
			} else {
				$this->_setErrorMessage($message);
				$this->redirect('order');
			}
		}
	}

	public function actionOrderDetail()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		$ordersModel = new Orders;
		$condition['id'] = $request->get('id');
		$condition['user_id'] = $session['uid'];
		$ordersModel = $ordersModel->findById($condition, $message);
		if ($ordersModel) {
			$orderGoods = $ordersModel->orderGoods;
			$orderGoods = Tool::convert2Array($orderGoods);
			$payLogs = $ordersModel->orderPayLog;
			$payLogs = Tool::convert2Array($payLogs);
			$ordersModel = $ordersModel->attributes;

			$goodsModel = new Goods;
			$goodsModel = $goodsModel->findBySupplier(['user_id' => $session['uid']]);
			$goodsModel = Tool::convert2Array($goodsModel);

			$suppliersModel = new Suppliers;
			$suppliersModel = $suppliersModel->findByUserId($session['uid']);
			$suppliersModel = Tool::convert2Array($suppliersModel);

			return $this->render('order_detail', [
				'order'      => $ordersModel,
				'orderGoods' => $orderGoods,
				'payLogs'    => $payLogs,
				'goods'      => $goodsModel,
				'supplier'   => $suppliersModel,
			]);
		} else {
			$this->_setErrorMessage($message);
			$this->redirect('order');
		}
	}

	public function actionSupplierGoods()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isAjax) {
			$goodsModel = new Goods;
			$condition['supplier_id'] = $request->post('supplier_id');
			$condition['user_id'] = $session['uid'];
			$goodsModel = $goodsModel->findBySupplier($condition);
			if ($goodsModel) {
				$goodsModel = Tool::convert2Array($goodsModel);
			} else {
				$goodsModel = array();
			}
			return Tool::outputData($goodsModel);
		}
	}

	public function rmbToUsd($rmb = 1)
	{
		//$ch = curl_init();
		//$url = "http://apis.baidu.com/apistore/currencyservice/currency?fromCurrency=CNY&toCurrency=USD&amount=$rmb";
		//$header = array(
		//	'apikey: 25afda0e49a0f0de2ba7a4e8e624008c',
		//);
		// 添加apikey到header
		//curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		//curl_setopt($ch , CURLOPT_URL , $url);
		//$res = curl_exec($ch);
		//$ress = json_decode($res, true);
		//$ress = $ress['retData'];
		//$ress = $ress['currency'];
		//$ress = round($ress, 4);
		//return $ress;
		$ch = curl_init();

		//api地址  https://www.nowapi.com/?app=account.login   用户名：yanwen  密码 ：123456789
		$url = "http://api.k780.com/?app=finance.rate&scur=CNY&tcur=USD&appkey=36687&sign=d2ed5db63eb5fcef744c8ee4acf79f89&format=json";
		//执行HTTP请求
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$res = curl_exec($ch);
		$ress = json_decode($res, true);
		$ress = $ress['result'];
		$ress = $ress['rate'];
		return $ress;
	}

	public function actionChangeSettlementType()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$ordersModel = new Orders;
			$condition = [];
			$condition['id'] = $request->post('order_id');
			$order = $ordersModel->findById($condition, $message);
			if ($order) {
				$order->settlement_type = $request->post('settlement_type');

				if ($order->save()) {
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

	public function actionChangeServiceType()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$ordersModel = new Orders;
			$condition = [];
			$condition['id'] = $request->post('order_id');
			$order = $ordersModel->findById($condition, $message);
			if ($order) {
				$order->service_type = $request->post('service_type');

				if ($order->save()) {
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

	public function actionOrderDownload(){

		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		$order_id = $request->get('id');

		// 查询订单信息
		$ordersModel = new Orders;
		$condition['id'] = $order_id;
		$condition['user_id'] = $session['uid'];
		$ordersModel = $ordersModel->findById($condition, $message);
		if ($ordersModel) {
			$orderGoods = $ordersModel->orderGoods;
			$orderGoods = Tool::convert2Array($orderGoods);
			$payLogs = $ordersModel->orderPayLog;
			$payLogs = Tool::convert2Array($payLogs);
			$ordersModel = $ordersModel->attributes;

			$goodsModel = new Goods;
			$goodsModel = $goodsModel->findBySupplier(['user_id' => $session['uid']]);
			$goodsModel = Tool::convert2Array($goodsModel);

			$suppliersModel = new Suppliers;
			$suppliersModel = $suppliersModel->findByUserId($session['uid']);
			$suppliersModel = Tool::convert2Array($suppliersModel);

			$base_path = Yii::getAlias("@app");

			$template_path = $base_path.'/template/1.docx';

			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_path);

			// 替换变量
			$templateProcessor->setValue('created_at',date('Ymd',$ordersModel->created_at)); // 申报日期
			$templateProcessor->setValue('delivery_time',date('Ymd',$ordersModel->delivery_time)); // 出口日期

			$templateProcessor->setValue('buyers_name',$ordersModel->buyers_name); // 境外收货人
			$templateProcessor->setValue('arrive_port',$ordersModel->arrive_port); // 指运港
			$templateProcessor->setValue('customs_port',$ordersModel->customs_port); // 离境口岸
			$templateProcessor->setValue('trading_country',$ordersModel->trading_country); // 贸易国（地区）
			$templateProcessor->setValue('destination_country_or_area',$ordersModel->destination_country_or_area); // 贸易国（地区）
			$templateProcessor->setValue('pack_type_list',$ordersModel->pack_type_list); // 包装种类
			$templateProcessor->setValue('transport_package_count',$ordersModel->transport_package_count); // 件数
			$templateProcessor->setValue('contract_type',$ordersModel->contract_type); // 合同编号
			// 商品信息
			$templateProcessor->cloneRow('goods_order', "2");
			$templateProcessor->setValue('goods_order#1',"test");
			$templateProcessor->setValue('goods_number#1',"test");
			// 结束替换变量

			$build_order_no = Tool::build_order_no();

			$save_template_path = $base_path.'/web/uploads/template/';

			$docx = $save_template_path.$build_order_no.'.docx';
			$pdf = $save_template_path;

			$templateProcessor->saveAs($docx);

			echo $cmd = "soffice --headless --convert-to pdf {$docx} --outdir {$pdf}";
			$process = new Process($cmd);
			$process->run();
			// executes after the command finishes
			if ($process->isSuccessful()) {

				Tool::force_download($pdf);
			}else{

			}
		}
	}

	/*
		//出口服务委托函
		public function actionConvertpdf1()
		{
			$request = Yii::$app->request;
			$session = Yii::$app->session;
			if (!$session->isActive) $session->open();

			$ordersModel = new Orders;
			$condition['id'] = $request->get('id');
			$condition['user_id'] = $session['uid'];
			$ordersModel = $ordersModel->findById($condition, $message);
			if ($ordersModel) {
				$orderGoods = $ordersModel->orderGoods;
				$orderGoods = Tool::convert2Array($orderGoods);
				$ordersModel = $ordersModel->attributes;

				$pdfHtmlView = $this->renderPartial('pdf1', ['order' => $ordersModel,
					'orderGoods' => $orderGoods,]);
			}
			$mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
			$mpdf->useAdobeCJK = true;
			$mpdf->SetAutoFont(AUTOFONT_ALL);
			$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
			$mpdf->setAutoBottomMargin = 'stretch';
			$mpdf->SetDisplayMode('fullpage');

			$mpdf->WriteHTML($pdfHtmlView);
			$mpdf->Output('出口服务委托函.pdf', 'D');
		}
	//潮安市潮安区古巷镇粤泰建筑陶瓷厂
		public function actionConvertpdf2()
		{
			$mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
			$mpdf->useAdobeCJK = true;
			$mpdf->SetAutoFont(AUTOFONT_ALL);
			$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
			$mpdf->setAutoBottomMargin = 'stretch';
			$mpdf->SetDisplayMode('fullpage');
			$pdfHtmlView = $this->renderPartial('pdf2', ['content'=>'中文测试'

			]);
			$mpdf->WriteHTML($pdfHtmlView);
			$mpdf->Output('供货合作合同.pdf', 'D');
		}

	//	报关草单_20151103110922
		public function actionConvertpdf3()
		{
			$mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
			$mpdf->useAdobeCJK = true;
			$mpdf->SetAutoFont(AUTOFONT_ALL);
			$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
			$mpdf->setAutoBottomMargin = 'stretch';
			$mpdf->SetDisplayMode('fullpage');
			$pdfHtmlView =  $this->renderPartial('pdf3', ['content'=>'中文测试'

			]);
			$mpdf->WriteHTML($pdfHtmlView);
			$mpdf->Output('出口货物报关单.pdf', 'D');
		}
	//_报关箱单_20151103110923
		public function actionConvertpdf4()
		{
			$mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
			$mpdf->useAdobeCJK = true;
			$mpdf->SetAutoFont(AUTOFONT_ALL);
			$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
			$mpdf->setAutoBottomMargin = 'stretch';
			$mpdf->SetDisplayMode('fullpage');
			$pdfHtmlView = $this->renderPartial('pdf4', ['content'=>'中文测试'

			]);
			$mpdf->WriteHTML($pdfHtmlView);
			$mpdf->Output('报关箱单.pdf', 'D');
		}
	//_报关委托书_20151103110923
		public function actionConvertpdf5()
		{
			$mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
			$mpdf->useAdobeCJK = true;
			$mpdf->SetAutoFont(AUTOFONT_ALL);
			$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
			$mpdf->setAutoBottomMargin = 'stretch';
			$mpdf->SetDisplayMode('fullpage');
			$pdfHtmlView = $this->renderPartial('pdf5', ['content'=>'中文测试'

			]);
			$mpdf->WriteHTML($pdfHtmlView);
			$mpdf->Output('代理报关委托书.pdf', 'D');
		}
		//_报关合同_20151103110923
		public function actionConvertpdf6()
		{
			$mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
			$mpdf->useAdobeCJK = true;
			$mpdf->SetAutoFont(AUTOFONT_ALL);
			$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
			$mpdf->setAutoBottomMargin = 'stretch';
			$mpdf->SetDisplayMode('fullpage');
			$pdfHtmlView = $this->renderPartial('pdf6', ['content'=>'中文测试'

			]);
			$mpdf->WriteHTML($pdfHtmlView);
			$mpdf->Output('报关合同.pdf', 'D');
		}
	//_报关发票_20151103110923
		public function actionConvertpdf7()
		{
			$mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
			$mpdf->useAdobeCJK = true;
			$mpdf->SetAutoFont(AUTOFONT_ALL);
			$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
			$mpdf->setAutoBottomMargin = 'stretch';
			$mpdf->SetDisplayMode('fullpage');
			$pdfHtmlView = $this->renderPartial('pdf7', ['content'=>'中文测试'

			]);
			$mpdf->WriteHTML($pdfHtmlView);
			$mpdf->Output('报关发票.pdf', 'D');
		}
		*/
}
