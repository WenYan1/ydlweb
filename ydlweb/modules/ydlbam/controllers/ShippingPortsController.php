<?php

namespace app\modules\ydlbam\controllers;

use app\models\WorldPorts;
use Tool;
use Yii;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;

class ShippingPortsController extends AdminBaseController {
	public $layout = 'ydlbam';
	public function actionIndex() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if(!$session->isActive) $session->open();
    		$this->initializeAttributes();
		$tmpCountry = $request->get('country');
		$tmpName = $request->get('name');
		$page = $request->get('page') ? $request->get('page') : 1;
		$query = WorldPorts::find()->select(['id', 'name'])->where(['like', 'country', $tmpCountry])->andFilterWhere(['like', 'en', $tmpName])->orderBy(['name' => SORT_ASC]);

		$allPorts = clone $query;
		$pages = new Pagination(['totalCount' => $allPorts->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);
		header("Content-type:text/html;charset=utf8");
		var_dump($models);
		return $this->render('index', [
			'models' => $models,
			'country' => $tmpCountry,
			'name' => $tmpName,
			'pages' => $pages,
			'page' => $page,
		]);
	}
}
