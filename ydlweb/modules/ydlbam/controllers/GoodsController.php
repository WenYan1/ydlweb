<?php

namespace app\modules\ydlbam\controllers;

use app\models\Goods;
use Tool;
use Yii;
use yii\data\Pagination;
use app\modules\ydlbam\controllers\AdminBaseController;

class GoodsController extends AdminBaseController
{
	public $layout = 'ydlbam';

	public function actionIndex()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();

		$state = $request->get('state');
		$goodsName = $request->get('goods_name');
		$supplier = $request->get('supplier');
		$email = $request->get('email');
		$page = $request->get('page') ? $request->get('page') : 1;
		$query = Goods::find();
		if ($session['rank'] == 2) {
			$query->where(['user_id' => $session['usersIds']]);
			if ($state !== null || $goodsName !== null || $supplier !== null || $email !== null) {
				if ($state !== null) {
					$query->andWhere(['state' => $state])->andFilterWhere(['like', 'supplier_name', $supplier])->andFilterWhere(['like', 'goods_name', $goodsName])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($goodsName !== null) {
					$query->andWhere(['like', 'goods_name', $goodsName])->andFilterWhere(['like', 'supplier_name', $supplier])->andFilterWhere(['state' => $state])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($supplier !== null) {
					$query->andWhere(['like', 'supplier_name', $supplier])->andFilterWhere(['like', 'goods_name', $goodsName])->andFilterWhere(['state' => $state])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($email !== null) {
					$query->andWhere(['like', 'user_email', $email])->andFilterWhere(['like', 'goods_name', $goodsName])->andFilterWhere(['state' => $state])->andFilterWhere(['like', 'supplier_name', $supplier]);
				}
			}
		} else {
			if ($state !== null || $goodsName !== null || $supplier !== null || $email !== null) {
				if ($state !== null) {
					$query->where(['state' => $state])->andFilterWhere(['like', 'supplier_name', $supplier])->andFilterWhere(['like', 'goods_name', $goodsName])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($goodsName !== null) {
					$query->where(['like', 'goods_name', $goodsName])->andFilterWhere(['like', 'supplier_name', $supplier])->andFilterWhere(['state' => $state])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($supplier !== null) {
					$query->where(['like', 'supplier_name', $supplier])->andFilterWhere(['like', 'goods_name', $goodsName])->andFilterWhere(['state' => $state])->andFilterWhere(['like', 'user_email', $email]);
				} else if ($email !== null) {
					$query->where(['like', 'user_email', $email])->andFilterWhere(['like', 'goods_name', $goodsName])->andFilterWhere(['state' => $state])->andFilterWhere(['like', 'supplier_name', $supplier]);
				}
			}
		}

		$countQuery = clone $query->orderBy(['updated_at' => SORT_DESC]);
		$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		$models = Tool::convert2Array($models);

		return $this->render('goods_manage', [
			'models'    => $models,
			'pages'     => $pages,
			'state'     => $state,
			'goodsName' => $goodsName,
			'supplier'  => $supplier,
			'email'     => $email,
			'page'      => $page,
		]);
	}
	
	/**
	* 删除订单
	**/
	public function actionDeleteOrder(){
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();
		
		if ($request->isPost) {
			$goodsModel = new Goods;
			$id['id'] = $request->post('order_id');
			$goodsModel = $goodsModel->findById($id, $message);
			if ($goodsModel) {
				$ds = $goodsModel->delete(); 
				if($ds){
					return Tool::outputSuccess('删除成功');
				}else{
					return Tool::outputError('删除失败');
				}
			}else{
				return Tool::outputError('数据不存在');
			}
		}
	}
	

	public function actionAuditingGoods()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();

		if ($request->isPost) {
			$goodsModel = new Goods;
			$condition['id'] = $request->post('goods_id');
			$goodsModel = $goodsModel->findById($condition, $message);
			if ($goodsModel) {
				$goodsModel->state = $request->post('state');
				if ($goodsModel->save()) {
					return Tool::outputSuccess('审核成功');
				} else {
					return Tool::outputError('审核失败');
				}
			} else {
				return Tool::outputError($message);
			}
		} else {
			return Tool::outputError('非法请求');
		}
	}

	public function actionGoodsDetail()
	{
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		if (!$session->isActive) $session->open();
		$this->initializeAttributes();

		if ($request->isPost) {
			$goodsModel = new Goods;

			$condition['id'] = $request->post('goods_id');
			$goodsModel = $goodsModel->findById($condition, $message);

			$goods = false;
			if ($goodsModel) {
				$goodsModel->hs_code_remark = $request->post('hs_code_remark');
				$goodsModel->original_price_remark = $request->post('original_price_remark');
				$goodsModel->goods_image_remark = $request->post('goods_image_remark');
				$goodsModel->declaration_element = $request->post('declaration_element');
				$goods = $goodsModel->save();
			}

			if ($goods) {
				$this->redirect(Yii::$app->request->referrer);
			} else {
				$this->redirect(Yii::$app->request->referrer);
			}

		} else {
			$goodsModel = new Goods;
			$condition['id'] = $request->get('goods_id');
			$goodsModel = $goodsModel->findById($condition, $message);
			if ($goodsModel) {
				$goodsAttr = $goodsModel->getGoodsAttrs()->all();
				$goodsAttr = Tool::convert2Array($goodsAttr);
				$goodsModel = $goodsModel->attributes;

				return $this->render('goods_detail', [
					'goods'     => $goodsModel,
					'goodsAttr' => $goodsAttr,
				]);
			} else {
				$this->redirect(Yii::$app->request->referrer);
			}
		}
	}

}
