<?php

namespace app\controllers;

use Yii;
use Tool;
use Upload;
use yii\web\UploadedFile;
use yii\data\Pagination;
use app\controllers\HomeBaseController;
use yii\filters\AccessControl;
use app\models\Collection;

class CollectionController extends HomeBaseController
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['index'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			]

		];
	}

	public function actionIndex()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		$order_number = $request->get('order_number');
		$is_identification = $request->get('is_identification');
		$is_end = $request->get('is_end');
		$page = $request->get('page') ? $request->get('page') : 1;

		$query = Collection::find()
			->where(['user_id' => $session['uid']])
			->andFilterWhere(['is_identification' => $is_identification])
			->andFilterWhere(['is_end' => $is_end])
			->andFilterWhere(['like', 'order_number', $order_number])
			->orderBy(['id' => SORT_DESC]);

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		return $this->render('collection_manager', [
			'models'       => $models,
			'pages'        => $pages,
			'order_number' => $order_number,
			'page'         => $page
		]);
	}

	public function actionAdd()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$collectionModel = new Collection;

			$dir = 'collection/';

			$data = [];
			$data['user_id'] = $session['uid'];
			$data['user_email'] = $session['userEmail'];
			$data['order_number'] = $request->post('order_number');
			$data['anticipated_tax_refund'] = $request->post('anticipated_tax_refund');
			$data['is_identification'] = $request->post('is_identification');
			$data['is_end'] = $request->post('is_end');

			$taxRefundFile = UploadedFile::getInstanceByName('tax_refund');
			$supplyContractFile = UploadedFile::getInstanceByName('supply_contract');
			$invoiceFile = UploadedFile::getInstanceByName('invoice');

			if (!empty($taxRefundFile)) {
				$tempPath = Upload::getPath($dir, $taxRefundFile->getExtension());
				$tempResult = $taxRefundFile->saveAs($tempPath['savePath'] . $tempPath['newName']);
				if (!$tempResult) {
					$this->_setErrorMessage('报关单退税联上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$data['tax_refund'] = $dir . $tempPath['newName'];
			}

			if (!empty($supplyContractFile)) {
				$tempPath = Upload::getPath($dir, $supplyContractFile->getExtension());
				$tempResult = $supplyContractFile->saveAs($tempPath['savePath'] . $tempPath['newName']);
				if (!$tempResult) {
					$this->_setErrorMessage('供货合同上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$data['supply_contract'] = $dir . $tempPath['newName'];
			}

			if (!empty($invoiceFile)) {
				$tempPath = Upload::getPath($dir, $invoiceFile->getExtension());
				$tempResult = $invoiceFile->saveAs($tempPath['savePath'] . $tempPath['newName']);
				if (!$tempResult) {
					$this->_setErrorMessage('增值税发票上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$data['invoice'] = $dir . $tempPath['newName'];
			}

			$supplier = $collectionModel->add($data, $message);
			if ($supplier) {
				$this->_setSuccessMessage($message);
				$this->redirect('/collection');
			} else {
				$this->_setErrorMessage($message);
				$this->redirect(Yii::$app->request->referrer);
			}


		} else {
			return $this->render('collection_add');
		}
	}

	public function actionEdit()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$collectionModel = new Collection;

			$dir = 'collection/';

			$data = [];
			$data['order_number'] = $request->post('order_number');
			$data['anticipated_tax_refund'] = $request->post('anticipated_tax_refund');
			$data['is_identification'] = $request->post('is_identification');
			$data['is_end'] = $request->post('is_end');

			$taxRefundFile = UploadedFile::getInstanceByName('tax_refund');
			$supplyContractFile = UploadedFile::getInstanceByName('supply_contract');
			$invoiceFile = UploadedFile::getInstanceByName('invoice');

			$tax_refund = '';
			if (!empty($taxRefundFile)) {
				$tempPath = Upload::getPath($dir, $taxRefundFile->getExtension());
				$tempResult = $taxRefundFile->saveAs($tempPath['savePath'] . $tempPath['newName']);
				if (!$tempResult) {
					$this->_setErrorMessage('报关单退税联上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$tax_refund = $dir . $tempPath['newName'];
			}

			$supply_contract = '';
			if (!empty($supplyContractFile)) {
				$tempPath = Upload::getPath($dir, $supplyContractFile->getExtension());
				$tempResult = $supplyContractFile->saveAs($tempPath['savePath'] . $tempPath['newName']);
				if (!$tempResult) {
					$this->_setErrorMessage('供货合同上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$supply_contract = $dir . $tempPath['newName'];
			}

			$invoice = '';
			if (!empty($invoiceFile)) {
				$tempPath = Upload::getPath($dir, $invoiceFile->getExtension());
				$tempResult = $invoiceFile->saveAs($tempPath['savePath'] . $tempPath['newName']);
				if (!$tempResult) {
					$this->_setErrorMessage('增值税发票上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$invoice = $dir . $tempPath['newName'];
			}

			$condition = [];
			$condition['id'] = $request->post('c_id');
			$condition['user_id'] = $session['uid'];
			$collectionModel = $collectionModel->findById($condition, $message);
			$collection = '';
			if ($collectionModel) {
				$collectionModel->order_number = $request->post('order_number');
				$collectionModel->anticipated_tax_refund = $request->post('anticipated_tax_refund');
				$collectionModel->is_identification = $request->post('is_identification');
				$collectionModel->is_end = $request->post('is_end');

				if (!empty($tax_refund)) {
					$collectionModel->tax_refund = $tax_refund;
				}
				if (!empty($supply_contract)) {
					$collectionModel->supply_contract = $supply_contract;
				}
				if (!empty($invoice)) {
					$collectionModel->invoice = $invoice;
				}

				$collection = $collectionModel->save();
			}

			if ($collection) {
				$this->_setSuccessMessage($message);
				$this->redirect('/collection');
			} else {
				$this->_setErrorMessage($message);
				$this->redirect(Yii::$app->request->referrer);
			}


		} else {
			$collectionModel = new Collection;
			$condition = [];
			$condition['id'] = $request->get('id');
			$condition['user_id'] = $session['uid'];
			$collectionModel = $collectionModel->findById($condition, $message);

			return $this->render('collection_edit', [
				'collection' => $collectionModel
			]);
		}
	}

}
