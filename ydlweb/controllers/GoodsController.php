<?php

namespace app\controllers;

use Yii;
use Tool;
use Upload;
use yii\web\UploadedFile;
use app\models\Goods;
use app\models\GoodsAttrs;
use app\models\Suppliers;
use yii\data\Pagination;
use app\controllers\HomeBaseController;
use yii\filters\AccessControl;
use yii\db\Query;
use app\models\HSCodeTax;

class GoodsController extends HomeBaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
             [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index'],
                'lastModified' => function ($action, $params) {
                    $session = Yii::$app->session;
                    if(!$session->isActive) $session->open();
                    $q = new \yii\db\Query();
                    $count = (new \yii\db\Query())->from('goods')->where(['user_id'=>$session['uid']])->count();
                    if($count) {
                        return $q->from('goods')->where(['user_id'=>$session['uid']])->max('updated_at');
                    } else {
                        return $q->from('goods')->max('updated_at');
                    } 
                },
            ],

        ];
    }

    public function actionIndex()
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if(!$session->isActive) $session->open();
        
        $state = $request->get('state');
        $kw = $request->get('search');
        $supplier = $request->get('supplier');
        $page = $request->get('page') ? $request->get('page') : 1;
        $query = Goods::find()->where(['user_id'=>$session['uid']])->andFilterWhere(['supplier_id'=>$supplier])->andFilterWhere(['state'=>$state])->andFilterWhere(['like','goods_name',$kw])->orderBy(['id' => SORT_DESC]);

        $countQuery = clone $query->orderBy(['created_at' => SORT_DESC]);
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        $models = Tool::convert2Array($models);
        $suppliersModel = new Suppliers;
        $suppliersModel = $suppliersModel->findByUserId($session['uid']);
        $suppliersModel = Tool::convert2Array($suppliersModel);
        $goodsCount = Goods::find()->where(['user_id'=>$session['uid']])->count();
        
        return $this->render('product_manager', [
            'models' => $models,
            'pages' => $pages,
            'state' => $state,
            'search' => $kw,
            'supplier' => $supplier,
            'suppliers' => $suppliersModel,
            'goodsCount' => $goodsCount,
            'page' => $page
        ]);
    }

    /**
    * @添加商品
    * @request [[get to view],[post submit]] 
    * @response
    * @date 2016-3-17
    */
    public function actionAdd() {
    	$request = Yii::$app->request;
    	$session = Yii::$app->session;
    	if(!$session->isActive) $session->open();
    	
    	if($request->isPost) {
    		$goodsModel = new Goods;
    		$imageFile = UploadedFile::getInstanceByName('goods_image');
    		if($imageFile) {
    			$dir = 'goods/';
    			$path = Upload::getPath($dir, $imageFile->getExtension());
    			$fileResult = $imageFile->saveAs($path['savePath'] . $path['newName']);
    			if($fileResult) {
    				$connection = Yii::$app->db;
    				$post  = $request->post();
    				//$time = time();
				    $data['user_id'] = $session['uid'];
                    $data['user_email'] = $session['userEmail'];
    				$data['supplier_id'] = $request->post('supplier_id');
    				$data['supplier_name'] = $request->post('supplier_name');
    				$data['goods_name'] = $request->post('goods_name');
    				$data['goods_image'] = $dir.$path['newName'];
    				$data['goods_long'] = $request->post('goods_long');
    				$data['goods_wide'] = $request->post('goods_wide');
    				$data['goods_height'] = $request->post('goods_height');
    				$data['gross_weight'] = $request->post('gross_weight');
    				$data['net_weight'] = $request->post('net_weight');
    				$data['hs_code'] = $request->post('hs_code');
    				$data['goods_taxrate'] = $request->post('goods_taxrate');
    				$data['box_number'] = $request->post('box_number');
                    $data['original_price'] = $request->post('original_price');
                    $data['goods_url'] = $request->post('goods_url');
                    $data['goods_volume'] = $request->post('goods_volume');
                    $data['declaration_element'] = $request->post('declaration_element');
					
    				/*$data['created_at'] = $time;
    				$data['updated_at'] = $time;*/
    				$transaction = $connection->beginTransaction();
    				try {
    				    $goods = $goodsModel->add($data, $message);	
    				    if($goods) {
    				    	    $goods_id = $goods->id;
    					    $attrs = array();
    					    foreach($post as $value) {
    						if(is_array($value)) {
    							$attr = array();
    							$attr[0] = $goods_id;
    							foreach($value as $val) {
    								$attr[] = $val;
    							}
    							$attrs[] = $attr;
    						}
    					    }
    					    if(!empty($attrs)) {
    					    	$result = $connection->createCommand()->batchInsert(GoodsAttrs::tableName(), ['goods_id','net_weight','gross_weight','goods_long','goods_wide','goods_height','attr_describe'], $attrs)->execute();
    					    	if($result) {
    					    		$transaction->commit();
        							$this->_setSuccessMessage($message);
    								$this->redirect('index');
    					    	} else {
    					    		$transaction->rollBack();
    							$this->_setErrorMessage('商品添加失败');
    							$this->redirect(Yii::$app->request->referrer);
    					    	}
    					    } else {
    					    	$transaction->commit();
        						$this->_setSuccessMessage($message);
        						$this->redirect('index');
    					    }
    				    } else {
    				    	$transaction->rollBack();
    					$this->_setErrorMessage('商品添加失败');
    					$this->redirect(Yii::$app->request->referrer);
    				    }
    				} catch(Exception $e) {
    				    $transaction->rollBack();
    				    $this->_setErrorMessage('商品添加失败');
    				    $this->redirect(Yii::$app->request->referrer);
    				}
        			} else {
        				$this->_setErrorMessage('商品图片上传失败');
    				$this->redirect(Yii::$app->request->referrer);
        			}
    		} else {
    			$this->_setErrorMessage('商品图片不能为空');
                $this->redirect(Yii::$app->request->referrer);
    		}
    	} else {
    		$suppliersModel = new Suppliers;
	    	$suppliersModel = $suppliersModel->findUsefulByUserId($session['uid']);
	    	$suppliersModel = Tool::convert2Array($suppliersModel);
    		return $this->render('add_product', [
                                     'supplier' => $suppliersModel
                             ]);
    	}
    }

    /**
    * @删除商品
    * @request [get] 
    * @param [int]
    * @date 2016-3-17
    */
    public function actionDetele() {
    	$request = Yii::$app->request;
    	$session = Yii::$app->session;
    	if(!$session->isActive) $session->open();

    	if($request->isGet) {
    		$connection = Yii::$app->db;
    		$goodsModel = new Goods;
    		$goodsAttrsModel = new GoodsAttrs;
    		$id = $request->get('id');
    		$condition['id'] = $id;
    		$condition['user_id'] = $session['uid'];
    		$transaction = $connection->beginTransaction();
    		try {
    			$result = $goodsModel->actDelete($condition, $message);
    			if($result) {
    				$result = $goodsAttrsModel->actDeleteAll($id, $message);
    				if($result) {
    					$transaction->commit();
    					$this->_setSuccessMessage($message);
					$this->redirect(Yii::$app->request->referrer);
    				} else {
    					$transaction->rollBack();
    					$this->_setErrorMessage($message);
					$this->redirect(Yii::$app->request->referrer);
    				}
    			} else {
    				$transaction->rollBack();
    				$this->_setErrorMessage($message);
				$this->redirect(Yii::$app->request->referrer);
    			}
    		} catch(Exception $e) {
    			$transaction->rollBack();
    			$this->_setErrorMessage('删除失败,系统错误');
			$this->redirect(Yii::$app->request->referrer);
    		}
    	} else {
    		$this->_setErrorMessage('非法请求');
		$this->redirect(Yii::$app->request->referrer);
    	}
    }

    /**
    * @编辑产品信息
    * @request [[get to view],[post to submit]]
    * @param [int]
    * @date 2016-3-17
    */
    public function actionUpdate() {
    	$request = Yii::$app->request;
    	$session = Yii::$app->session;
    	if(!$session->isActive) $session->open();
    	$goodsModel = new Goods;

    	if($request->isPost) {
    		$condition['id'] = $request->post('id');
    		$condition['user_id'] = $session['uid'];

		    $dir = 'goods/';
		    $imageFile = UploadedFile::getInstanceByName('goods_image');

		    $fileResult = '';
		    if (!empty($imageFile)){
			    $path = Upload::getPath($dir, $imageFile->getExtension());
			    $fileResult = $imageFile->saveAs($path['savePath'] . $path['newName']);
		    }

    		$goods = $goodsModel->findById($condition,$message);
    		if($goods) {
			    $goods->goods_name = $request->post('goods_name');
			    $goods->original_price = $request->post('original_price');
			    $goods->goods_long = $request->post('goods_long');
			    $goods->hs_code = $request->post('hs_code');
			    $goods->goods_taxrate = $request->post('goods_taxrate');
    			$goods->goods_wide = $request->post('goods_wide');
    			$goods->goods_height = $request->post('goods_height');
    			$goods->gross_weight = $request->post('gross_weight');
    			$goods->net_weight = $request->post('net_weight');
    			$goods->goods_url = $request->post('goods_url');
    			$goods->box_number = $request->post('box_number');
				$goods->declaration_element = $request->post('declaration_element');

			    if (!empty($fileResult)){
				    $goods->goods_image = $dir.$path['newName'];
			    }

    			$goods->state = 0;
    			if($goods->save()) {
    				$this->_setSuccessMessage('编辑成功');
					$this->redirect(Yii::$app->request->referrer);
    			} else {
    				$this->_setErrorMessage('商品基本信息编辑失败,请重新编辑');
				    $this->redirect(Yii::$app->request->referrer);
    			}
    		} else {
    			$this->_setErrorMessage($message);
                $this->redirect(Yii::$app->request->referrer);
    		}
    	} else {
    		$condition['id'] = $request->get('id');
    		$condition['user_id'] = $session['uid'];
    		$goodsModel = $goodsModel->findById($condition,$message);
    		if($goodsModel) {
    			$goodsAttr = $goodsModel->getGoodsAttrs()->all();
    			$goodsAttr = Tool::convert2Array($goodsAttr);
    			$goodsModel = $goodsModel->attributes;
				

    			return $this->render('edit_product', [
			     'goods' => $goodsModel,
			     'goodsAttr' => $goodsAttr,
			]);
    		} else {
    			$this->_setErrorMessage($message);
                $this->redirect(Yii::$app->request->referrer);
    		}
    	}
    }

    /**
    * @删除商品属性
    * @request [ajax] 
    * @response [json]
    * @param [int]
    * @date 2016-3-16
    */
    public function actionDeleteGoodsAttr() {
    	$request = Yii::$app->request;
    	$goodsAttrsModel = new GoodsAttrs;

    	if($request->isAjax) {
    		$id = $request->post('id');
    		$result = $goodsAttrsModel->actDelete($id, $message);
    		if($result) {
    			return Tool::outputSuccess($message);
    		} else {
    			return Tool::outputError($message);
    		}
    	}
    }

     /**
    * @更新商品属性
    * @request [ajax] 
    * @response [json]
    * @param [int]
    * @date 2016-3-17
    */
    public function actionUpdateGoodsAttr() {
    	$request = Yii::$app->request;
    	$goodsAttrsModel = new GoodsAttrs;

    	if($request->isAjax) {
    		$id = $request->post('id');
    		$goodsAttrsModel = $goodsAttrsModel->getById($id,$message);
    		if($goodsAttrsModel) {
    			$goodsAttrsModel->goods_long = $request->post('goods_long');
    			$goodsAttrsModel->goods_wide = $request->post('goods_wide');
    			$goodsAttrsModel->goods_height = $request->post('goods_height');
    			$goodsAttrsModel->gross_weight = $request->post('gross_weight');
    			$goodsAttrsModel->net_weight = $request->post('net_weight');
                $goodsAttrsModel->attr_describe = $request->post('attr_describe');
    			if($goodsAttrsModel->save()) {
    				return Tool::outputSuccess('修改成功');
    			} else {
    				return Tool::outputError('修改失败');
    			}
    		} else {
    			return Tool::outputError($message);
    		}
    	}
    }


    /**
    * @添加商品属性
    * @request [ajax] 
    * @response [json]
    * @param [int]
    * @date 2016-3-17
    */
    public function actionAddGoodsAttr() {
    	$request = Yii::$app->request;
    	$goodsAttrsModel = new GoodsAttrs;

    	if($request->isAjax) {
    		$data['goods_id'] = $request->post('goods_id');
    		$data['goods_long'] = $request->post('goods_long');
    		$data['goods_wide'] = $request->post('goods_wide');
    		$data['goods_height'] = $request->post('goods_height');
    		$data['gross_weight'] = $request->post('gross_weight');
    		$data['net_weight'] = $request->post('net_weight');
                             $data['attr_describe'] = $request->post('attr_describe');
    		$goodsAttrsModel = $goodsAttrsModel->add($data,$message);
            
    		if($goodsAttrsModel) {
    			$res_data = array('id' => $goodsAttrsModel->id);
    			return Tool::outputData($res_data);
    		} else {
    			return Tool::outputError($message);
    		}
    	}
    }

    public function actionGoodsDetail() {
            $request = Yii::$app->request;
            $session = Yii::$app->session;
            if(!$session->isActive) $session->open();
            $goodsModel = new Goods;

            $condition['id'] = $request->get('id');
            $condition['user_id'] = $session['uid'];
            $goodsModel = $goodsModel->findById($condition,$message);
            if($goodsModel) {
                $goodsAttr = $goodsModel->getGoodsAttrs()->all();
                $goodsAttr = Tool::convert2Array($goodsAttr);
                $goodsModel = $goodsModel->attributes;

                return $this->render('product_detail', [
                 'goods' => $goodsModel,
                 'goodsAttr' => $goodsAttr,
                ]);
            } else {
                $this->_setErrorMessage($message);
                $this->redirect(Yii::$app->request->referrer);
            }
    }

	public function actionTaxTsl()
	{
		$request = Yii::$app->request;
		if ($request->isPost){
			$code = $request->post('hscode');
			$goodsTax = HSCodeTax::find()->select(['CODE AS hscode', 'TSL AS tsl', 'NAME AS name'])->where(['CODE'=> $code])->asArray()->one();
			if ($goodsTax !== null) {
				return Tool::outputData($goodsTax);
			} else {
				return Tool::outputError('无此数据,请手动输入');
			}
		} else {
			$this->_setErrorMessage('非法请求');
		}
	}

}
