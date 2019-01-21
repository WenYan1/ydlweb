<?php

namespace app\controllers;

use app\models\CollectionFile;
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
			->andWhere(['>','order_status',0])
			->andFilterWhere(['is_identification' => $is_identification])
			->andFilterWhere(['is_end' => $is_end])
			->andFilterWhere(['like', 'order_number', $order_number])
			->orderBy(['id' => SORT_DESC]);

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		$cids = '';
		$Files = array();

		if (!empty($models)) {
			foreach ($models as $item) {
				$cids .= $cids === '' ? $item['id'] : ',' . $item['id'];
			}

			$FilesModel = CollectionFile::find()->where('c_id IN(' . $cids . ')')->all();
			$FilesModel = Tool::convert2Array($FilesModel);
			foreach ($FilesModel as $_file) {
				$Files[$_file['c_id']][$_file['category']] = true;
			}
		}


		return $this->render('collection_manager', [
			'models'       => $models,
			'pages'        => $pages,
			'order_number' => $order_number,
			'Files'        => $Files,
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

			$data = [];
			$data['user_id'] = $session['uid'];
			$data['user_email'] = $session['userEmail'];
			$data['order_number'] = $request->post('order_number');
			$data['anticipated_tax_refund'] = $request->post('anticipated_tax_refund');

			$files = $request->post('files');

			$connection = Yii::$app->db;
			$transaction = $connection->beginTransaction();

			$supplier = $collectionModel->add($data, $message);
			if ($supplier) {

				$id = $supplier->id;

				$collectionFile = array();
				$i = 0;
				$_time = time();
				foreach ($files as $category => $item) {
					if (!empty($item)) {
						foreach ($item as $file) {
							$collectionFile[$i]['c_id'] = $id;
							$collectionFile[$i]['user_id'] = $session['uid'];
							$collectionFile[$i]['category'] = $category;
							$collectionFile[$i]['client_name'] = $file['client_name'];
							$collectionFile[$i]['service_path'] = $file['service_path'];
							$collectionFile[$i]['extension'] = $file['extension'];
							$collectionFile[$i]['file_size'] = $file['file_size'];
							$collectionFile[$i]['created_at'] = $_time;
							$collectionFile[$i]['updated_at'] = $_time;

							$i++;
						}
					}
				}

				if (!empty($collectionFile)) {
					$result = $connection->createCommand()->batchInsert(CollectionFile::tableName(), [
						'c_id',
						'user_id',
						'category',
						'client_name',
						'service_path',
						'extension',
						'file_size',
						'created_at',
						'updated_at',
					], $collectionFile)->execute();

					if ($result) {
						$transaction->commit();
						$this->_setSuccessMessage($message);
						$this->redirect('/collection');
					} else {
						$transaction->rollBack();
						$this->_setErrorMessage($message);
					}
				} else {
					$transaction->rollBack();
					$this->_setErrorMessage("文件未上传");
				}
			} else {

				$transaction->rollBack();
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
			$collectionFilesModel = new CollectionFile;

			$c_id = $request->post('c_id');
			$files = $request->post('files');

			$data = [];
			$data['order_number'] = $request->post('order_number');
			$data['anticipated_tax_refund'] = $request->post('anticipated_tax_refund');
			$data['is_identification'] = $request->post('is_identification');
			$data['is_end'] = $request->post('is_end');

			$condition = [];
			$condition['id'] = $c_id;
			$condition['user_id'] = $session['uid'];
			$collectionModel = $collectionModel->findById($condition, $message);

			if ($collectionModel) {
				$collectionModel->order_number = $request->post('order_number');
				$collectionModel->anticipated_tax_refund = $request->post('anticipated_tax_refund');


				$connection = Yii::$app->db;
				$transaction = $connection->beginTransaction();

				$collectionFilesModel->actDeleteAll($c_id, $message);

				$collectionFile = array();
				$i = 0;
				$_time = time();
				foreach ($files as $category => $item) {
					if (!empty($item)) {
						foreach ($item as $file) {
							$collectionFile[$i]['c_id'] = $c_id;
							$collectionFile[$i]['user_id'] = $session['uid'];
							$collectionFile[$i]['category'] = $category;
							$collectionFile[$i]['client_name'] = $file['client_name'];
							$collectionFile[$i]['service_path'] = $file['service_path'];
							$collectionFile[$i]['extension'] = $file['extension'];
							$collectionFile[$i]['file_size'] = $file['file_size'];
							$collectionFile[$i]['created_at'] = $_time;
							$collectionFile[$i]['updated_at'] = $_time;

							$i++;
						}
					}
				}

				if (!empty($collectionFile)) {
					$result = $connection->createCommand()->batchInsert(CollectionFile::tableName(), [
						'c_id',
						'user_id',
						'category',
						'client_name',
						'service_path',
						'extension',
						'file_size',
						'created_at',
						'updated_at',
					], $collectionFile)->execute();

					if ($result) {
						$collection = $collectionModel->save();
						if ($collection) {
							$transaction->commit();
							$this->_setSuccessMessage("编辑成功");
							$this->redirect('/collection');
						} else {
							$transaction->rollBack();
							$this->_setErrorMessage("编辑失败");
							$this->redirect(Yii::$app->request->referrer);
						}
					} else {
						$transaction->rollBack();
						$this->_setErrorMessage("编辑失败");
					}
				} else {
					$transaction->rollBack();
					$this->_setErrorMessage("文件未上传");
				}
			}

		} else {
			$collectionModel = new Collection;
			$condition = [];
			$condition['id'] = $request->get('id');
			$condition['user_id'] = $session['uid'];
			$collectionModel = $collectionModel->findById($condition, $message);

			$CollectionFileModel = new CollectionFile;

			$collectionFiles = $CollectionFileModel->findByCid(['c_id' => $request->get('id')]);
			$collectionFiles = Tool::convert2Array($collectionFiles);

			$_collectionFiles = array();
			if (!empty($collectionFiles)) {
				foreach ($collectionFiles as $item) {
					$_collectionFiles[$item['category']][] = $item;
				}
			}

			return $this->render('collection_edit', [
				'collection'      => $collectionModel,
				'collectionFiles' => $_collectionFiles
			]);
		}
	}

	public function actionDoUpload()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$dir = 'collection/';
			$imageFile = UploadedFile::getInstanceByName('file');

			$result = array(
				'client_name' => $imageFile->name,
				'file_size'   => $imageFile->size
			);

			$path = Upload::getPath($dir, $imageFile->getExtension());
			$fileResult = $imageFile->saveAs($path['savePath'] . $path['newName']);

			$result['category'] = $request->post('category');
			$result['service_path'] = $dir . $path['newName'];
			$result['extension'] = $imageFile->getExtension();

			if ($fileResult) {
				$result = Tool::array2Json(array('state' => 1, 'file' => $result));
			} else {
				$result = Tool::array2Json(array('state' => 0));
			}

			exit($result);
		}
	}
}
