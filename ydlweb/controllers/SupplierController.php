<?php

namespace app\controllers;

use Yii;
use Tool;
use Upload;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use app\models\Suppliers;
use app\models\Region;
use yii\data\Pagination;
use app\controllers\HomeBaseController;
use yii\filters\AccessControl;

class SupplierController extends HomeBaseController
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
			[
				'class'        => 'yii\filters\HttpCache',
				'only'         => ['index'],
				'lastModified' => function ($action, $params) {
					$session = Yii::$app->session;
					if (!$session->isActive) $session->open();
					$q = new \yii\db\Query();
					$count = (new \yii\db\Query())->from('suppliers')->where(['user_id' => $session['uid']])->count();
					if ($count) {
						return $q->from('suppliers')->where(['user_id' => $session['uid']])->max('updated_at');
					} else {
						return $q->from('suppliers')->max('updated_at');
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

		$state = $request->get('state');
		$search = $request->get('search');
		$page = $request->get('page') ? $request->get('page') : 1;
		$query = Suppliers::find()->where(['user_id' => $session['uid']])->andFilterWhere(['supplier_state' => $state])->andFilterWhere(['like', 'company_name', $search]);

		$countQuery = clone $query->orderBy(['updated_at' => SORT_DESC]);
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		return $this->render('privider_manage', [
			'models' => $models,
			'pages'  => $pages,
			'state'  => $state,
			'search' => $search,
			'count'  => $countQuery->count(),
			'page'   => $page
		]);
	}

	public function actionAdd()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$supplierModel = new Suppliers;
			$businessLicense = UploadedFile::getInstanceByName('business_license');
			$taxRegistration = UploadedFile::getInstanceByName('tax_registration');
			$organizationCode = UploadedFile::getInstanceByName('organization_code');

			if ($businessLicense && $taxRegistration && $organizationCode) {
				$dir = 'enterprise_data/';
				$businessLicensePath = Upload::getPath($dir, $businessLicense->getExtension());
				$taxRegistrationPath = Upload::getPath($dir, $taxRegistration->getExtension());
				$organizationCodePath = Upload::getPath($dir, $organizationCode->getExtension());
				$businessLicenseResult = $businessLicense->saveAs($businessLicensePath['savePath'] . $businessLicensePath['newName']);
				$taxRegistrationResult = $taxRegistration->saveAs($taxRegistrationPath['savePath'] . $taxRegistrationPath['newName']);
				$organizationCodeResult = $organizationCode->saveAs($organizationCodePath['savePath'] . $organizationCodePath['newName']);

				if (!$businessLicenseResult) {
					$this->_setErrorMessage('上传营业执照上传失败');
					$this->redirect(Yii::$app->request->referrer);
				} else if (!$taxRegistrationResult) {
					$this->_setErrorMessage('上传一般纳税人认证书上传失败');
					$this->redirect(Yii::$app->request->referrer);
				} else if (!$organizationCodeResult) {
					$this->_setErrorMessage('上传以往开发的发票样本上传失败');
					$this->redirect(Yii::$app->request->referrer);
				} else {

					$other_image = UploadedFile::getInstanceByName('other_image');
					if (!empty($other_image)) {
						$temp = Upload::getPath($dir, $other_image->getExtension());
						$tempResult = $other_image->saveAs($temp['savePath'] . $temp['newName']);
						if (!$tempResult) {
							$this->_setErrorMessage('其他上传失败');
							$this->redirect(Yii::$app->request->referrer);
						}
						$data['other_image'] = $dir . $temp['newName'];
					}

					$data['user_id'] = $session['uid'];
					$data['user_email'] = $session['userEmail'];
					$data['identify_number'] = $request->post('identify_number');
					$data['company_name'] = $request->post('company_name');
					$data['cognizance_time'] = $request->post('cognizance_time');
					$data['finance_contacts'] = $request->post('finance_contacts');
					$data['province_id'] = $request->post('province_id');
					$data['city_id'] = $request->post('city_id');
					$data['county_id'] = $request->post('county_id');
					$data['province'] = $request->post('province');
					$data['city'] = $request->post('city');
					$data['county'] = $request->post('county');
					$data['address'] = $request->post('address');
					$data['tel'] = $request->post('tel');
					$data['goods_source'] = $data['province'] . $data['city'];
					$data['tax_rate'] = $request->post('tax_rate');
					$data['export_right'] = $request->post('export_right');
					$data['business_license'] = $dir . $businessLicensePath['newName'];
					$data['tax_registration'] = $dir . $taxRegistrationPath['newName'];
					$data['organization_code'] = $dir . $organizationCodePath['newName'];
					$supplier = $supplierModel->add($data, $message);
					if ($supplier) {
						$this->_setSuccessMessage($message);
						$this->redirect('/supplier');
					} else {
						$this->_setErrorMessage($message);
						$this->redirect(Yii::$app->request->referrer);
					}
				}
			} else {
				$this->_setErrorMessage('营业执照、税务登记和组织机构代码证上传不完整');
				$this->redirect(Yii::$app->request->referrer);
			}
		} else {
			$regionModel = new Region;
			$condition['parent_id'] = 1;
			$regionModel = $regionModel->getRegion($condition, $message);
			$regionModel = Tool::convert2Array($regionModel);

			return $this->render('add_privider', [
				'region' => $regionModel
			]);
		}
	}

	public function actionEdit()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$supplierModel = new Suppliers;

			$dir = 'enterprise_data/';

			$data = [];
			$data['user_id'] = $session['uid'];
			$data['user_email'] = $session['userEmail'];
			$data['identify_number'] = $request->post('identify_number');
			$data['company_name'] = $request->post('company_name');
			$data['cognizance_time'] = $request->post('cognizance_time');
			$data['finance_contacts'] = $request->post('finance_contacts');
			$data['province_id'] = $request->post('province_id');
			$data['city_id'] = $request->post('city_id');
			$data['county_id'] = $request->post('county_id');
			$data['province'] = $request->post('province');
			$data['city'] = $request->post('city');
			$data['county'] = $request->post('county');
			$data['address'] = $request->post('address');
			$data['tel'] = $request->post('tel');
			$data['goods_source'] = $data['province'] . $data['city'];
			$data['tax_rate'] = $request->post('tax_rate');
			$data['export_right'] = $request->post('export_right');
			$data['supplier_state'] = 1;

			$businessLicense = UploadedFile::getInstanceByName('business_license');
			$taxRegistration = UploadedFile::getInstanceByName('tax_registration');
			$organizationCode = UploadedFile::getInstanceByName('organization_code');
			$other_image = UploadedFile::getInstanceByName('other_image');

			if (!empty($businessLicense)) {
				$businessLicensePath = Upload::getPath($dir, $businessLicense->getExtension());
				$businessLicenseResult = $businessLicense->saveAs($businessLicensePath['savePath'] . $businessLicensePath['newName']);
				if (!$businessLicenseResult) {
					$this->_setErrorMessage('上传营业执照上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$data['business_license'] = $dir . $businessLicensePath['newName'];
			}

			if (!empty($taxRegistration)) {
				$taxRegistrationPath = Upload::getPath($dir, $taxRegistration->getExtension());
				$taxRegistrationResult = $taxRegistration->saveAs($taxRegistrationPath['savePath'] . $taxRegistrationPath['newName']);
				if (!$taxRegistrationResult) {
					$this->_setErrorMessage('上传一般纳税人认证书上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$data['tax_registration'] = $dir . $taxRegistrationPath['newName'];
			}

			if (!empty($organizationCode)) {
				$organizationCodePath = Upload::getPath($dir, $organizationCode->getExtension());
				$organizationCodeResult = $organizationCode->saveAs($organizationCodePath['savePath'] . $organizationCodePath['newName']);
				if (!$organizationCodeResult) {
					$this->_setErrorMessage('上传以往开发的发票样本上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$data['organization_code'] = $dir . $organizationCodePath['newName'];
			}

			if (!empty($other_image)) {
				$temp = Upload::getPath($dir, $other_image->getExtension());
				$tempResult = $other_image->saveAs($temp['savePath'] . $temp['newName']);
				if (!$tempResult) {
					$this->_setErrorMessage('其他上传失败');
					$this->redirect(Yii::$app->request->referrer);
				}
				$data['other_image'] = $dir . $temp['newName'];
			}
			$condition1 = [];
			$condition1['id'] = $request->get('supplier_id');
			$condition1['user_id'] = $session['uid'];
			$supplier = $supplierModel->edit($condition1, $data, $message);

			$supplierModel = $supplierModel->findById($condition1['id'], $message);
			if ($supplierModel) {
				$supplierModel->supplier_state = 0;
				$supplierModel->save();
			}

			if ($supplier) {
				$this->_setSuccessMessage($message);
				$this->redirect('/supplier');
			} else {
				$this->_setErrorMessage($message);
				$this->redirect(Yii::$app->request->referrer);
			}
		} else {
			$regionModel = new Region;
			$condition['parent_id'] = 1;
			$regionModel = $regionModel->getRegion($condition, $message);
			$regionModel = Tool::convert2Array($regionModel);

			$supplierModel = new Suppliers;
			$condition1 = [];
			$condition1['id'] = $request->get('supplier_id');
			$condition1['user_id'] = $session['uid'];
			$supplierModel = $supplierModel->findByCondition2($condition1, $message);

			return $this->render('edit_privider', [
				'region'   => $regionModel,
				'supplier' => $supplierModel
			]);
		}
	}

	public function actionDelete()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isGet) {
			$supplierModel = new Suppliers;
			$condition['id'] = $request->get('id');
			$condition['user_id'] = $session['uid'];
			$result = $supplierModel->actDelete($condition, $message);
			if ($result) {
				$this->_setSuccessMessage($message);
			} else {
				$this->_setErrorMessage($message);
				$this->redirect(Yii::$app->request->referrer);
			}
		}

	}

	public function actionLowerArea()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$condition['parent_id'] = $request->post('parent_id');
			$regionModel = new Region;
			$regions = $regionModel->getRegion($condition, $message);
			if ($regions) {
				$regions = Tool::convert2Array($regions);
				return Tool::outputData($regions);
			} else {
				return Tool::outputError($message);
			}
		} else {
			return Tool::outputError('非法请求');
		}
	}

	public function actionSupplierDetail()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		$supplierModel = new Suppliers;
		$condition['id'] = $request->get('supplier_id');
		$condition['user_id'] = $session['uid'];
		$supplierModel = $supplierModel->findByCondition2($condition, $message);

		if ($supplierModel) {
			$supplierModel = $supplierModel->attributes;
			return $this->render('privider_detail', [
				'supplier' => $supplierModel
			]);
		} else {
			$this->_setErrorMessage($message);
			$this->redirect(Yii::$app->request->referrer);
		}

	}

}
