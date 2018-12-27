<?php

namespace app\modules\ydlbam\controllers;

use app\models\CollectionFile;
use Yii;
use Tool;
use yii\data\Pagination;
use app\models\Collection;

use app\modules\ydlbam\controllers\AdminBaseController;

class CollectionController extends AdminBaseController
{
	public $layout = 'ydlbam';

	public function actionIndex()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();

		$order_number = $request->get('order_number');
		$is_identification = $request->get('is_identification');
		$is_end = $request->get('is_end');
		$page = $request->get('page') ? $request->get('page') : 1;

		$query = Collection::find()
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

	public function actionDetail()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();

		$collectionModel = new Collection;
		$condition = [];
		$condition['id'] = $request->get('id');
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

		return $this->render('collection_detail', [
			'collection' => $collectionModel,
			'collectionFiles' => $_collectionFiles
		]);
	}

	public function actionChangeStateType()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();

		if ($request->isPost) {
			$CollectionModel = new Collection;
			$condition = [];
			$condition['id'] = $request->post('id');
			$Collection = $CollectionModel->findById($condition, $message);
			if ($Collection) {
				$Collection->foreign_exchange_status = $request->post('val');

				if ($Collection->save()) {
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
