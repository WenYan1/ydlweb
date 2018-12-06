<?php

namespace app\controllers;

use app\controllers\HomeBaseController;
use app\models\Companys;
use app\models\Region;
use app\models\Industry;
use Tool;
use Upload;
use Yii;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

class CompanyController extends HomeBaseController
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['index'],
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

	public function actionIndex()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		$companysModel = new Companys;
		$companysModel = $companysModel->findByUserId($session['uid']);
		if ($companysModel) {
			if ($companysModel->state === 0) {
				return $this->render('certify_tip', [
					'message' => '正在审核',
				]);
			} else if ($companysModel->state === -1) {
				return $this->render('certify_tip', [
					'message' => '审核未通过',
				]);
			} else if ($companysModel->state === 1) {
				$exportRange = new Industry();
				$data = $exportRange->find()->asArray()->all();
				return $this->render('certify_complete', [
					'company' => $companysModel->attributes,
					'exportRange' => $data,
				]);
			}
		} else {
			return $this->render('not_certify');
		}

	}

	public function actionCompanyEdit()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		$companysModel = new Companys;
		$companysModel = $companysModel->findByUserId($session['uid']);
		if ($companysModel) {
            $exportRange = new Industry();
            $data = $exportRange->find()->asArray()->all();

			return $this->render('certify_edit', [
				'company' => $companysModel->attributes,
                'exportRange' => $data,
			]);
		} else {
			return $this->render('not_certify');
		}
	}

	public function actionCompanyAuth()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		if ($request->isPost) {
			$companysModel = new Companys;
			$data = $request->post('company');
			$data['user_id'] = $session['uid'];
			$data['created_at'] = time();
//		将出口多选 id 数组序列化为字符串
			$exportRange = $data['export_range'];
			$exportRangeSerialize = serialize($exportRange);
			$data['export_range'] = $exportRangeSerialize;
			$result = $companysModel->add($data, $message);

			if ($result) {
				$this->_setSuccessMessage($message);
				$this->redirect('index');
			} else {
				$this->_setErrorMessage($message);
				$this->redirect(Yii::$app->request->referrer);
			}
		} else {
			$exportRange = new Industry();
			$data = $exportRange->find()->asArray()->all();
			//var_dump($data);
			return $this->render('certify_submit', [
				'exportRange' => $data,
			]);

		}
	}

	public function actionLowerArea() {
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
}
