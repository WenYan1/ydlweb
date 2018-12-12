<?php

namespace app\modules\ydlbam\controllers;

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
		if(!$session->isActive) $session->open();
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

		return $this->render('collection_manager', [
			'models'       => $models,
			'pages'        => $pages,
			'order_number' => $order_number,
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

		return $this->render('collection_detail', [
			'collection' => $collectionModel
		]);
	}

}
