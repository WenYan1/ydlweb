<?php

namespace app\controllers;

use Yii;
use Tool;
use app\models\PayLogs;
use app\models\Orders;
use app\models\Users;
use app\models\CapitalLogs;
use app\controllers\HomeBaseController;

class OrderPayController extends HomeBaseController
{
    /**
    * @支付首付款
    *
    *
    ***/
    public function actionFirstPayment() {
            $request = Yii::$app->request;
            $session = Yii::$app->session;
            if(!$session->isActive) $session->open();
            $orderModel = new Orders;

            if($request->isPost) {
            	     $userModel = new Users;
            	     $capitalLogsModel = new CapitalLogs;
            	     $payLogsModel = new PayLogs;
            	     $condition['id'] = $request->post('order_id');	
            	     $condition['user_id'] = $session['uid'];
            	     $orderModel = $orderModel->findById($condition,$message);
            	     $userModel = $userModel->findById($session['uid']);

            	     if($orderModel) {
            	     	if($userModel->user_capital >= $orderModel->firstpayment_amount) {
            	     	     $connection = Yii::$app->db;
	                    $transaction = $connection->beginTransaction();
	                    try{
	                    	$orderModel->is_pay = 1;
	                    	$orderModel->already_pay +=$orderModel->firstpayment_amount;
	                    	if($orderModel->save()) {
	                    		$userModel->user_capital -=$orderModel->firstpayment_amount;
	                    		if($userModel->save()) {
	                    			$data['user_id'] = $session['uid'];
	                    			$data['order_id'] = $request->post('order_id');
	                    			$data['flow_sn'] = time().rand(10000, 99999);
	                    			$data['capital'] = $orderModel->firstpayment_amount;
	                    			$data['capital_symbol'] = '-';
	                    			$data['capital_type'] = 1;
	                    			$data['capital_explain'] = '支付首付款';
	                    			$data['created_at'] = time();
	                    			$result = $capitalLogsModel->add($data);
	                    			if($result) {
	                    				$payData['user_id'] = $session['uid'];
	                    				$payData['order_id'] = $request->post('order_id');
	                    				$payData['payment_amount'] = $orderModel->firstpayment_amount;
	                    				$payData['pay_explain'] = '支付首付款';
	                    				$payData['pay_type'] = '账户余额支付';
	                    				$payResult = $payLogsModel->add($payData,$message);
	                    				if($payResult) {
	                    					$transaction->commit();
		                                                    		$this->_setSuccessMessage('支付成功');
		                                                    		$this->redirect('/capital');
		                                                    	}else {
		                                                    		$transaction->rollBack();
		                                    			$this->_setErrorMessage('首付款支付失败');
		                                    			$this->redirect(Yii::$app->request->referrer);
		                                                    	}
	                    			} else {
	                    				$transaction->rollBack();
	                                    			$this->_setErrorMessage('首付款支付失败');
	                                    			$this->redirect(Yii::$app->request->referrer);
	                    			}
	                    		} else {
	                    			$transaction->rollBack();
	                                    		$this->_setErrorMessage('首付款支付失败');
	                                    		$this->redirect(Yii::$app->request->referrer);
	                    		}	
	                    	} else {
	                    		$transaction->rollBack();
	                                    	$this->_setErrorMessage('首付款支付失败');
	                                    	$this->redirect(Yii::$app->request->referrer);
	                    	}
	                    } catch(Exception $e) {
	                    	$transaction->rollBack();
	                             $this->_setErrorMessage('首付款支付失败');
	                             $this->redirect(Yii::$app->request->referrer);
	                    }
	            	} else {
	            	     	$this->_setErrorMessage('账户余额不足');
	                    	$this->redirect(Yii::$app->request->referrer);
	            	}
            	     } else {
            	     	$this->_setErrorMessage('订单不存在');
	               $this->redirect(Yii::$app->request->referrer);
            	     }
            } else {
            	     $condition['id'] = $request->get('order_id');	
            	     $condition['user_id'] = $session['uid'];
                    $orderModel = $orderModel->findById($condition,$message);
                    if($orderModel) {
                    	return $this->render('pay_fp', [
	                     'order' => $orderModel->attributes,
	               ]);
                    } else {
                    	$this->_setErrorMessage($message);
                    	$this->redirect(Yii::$app->request->referrer);
                    }
            }
    }

    /**
    * @尾款支付
    *
    ***/
    public function actionBalancePayment() {
            $request = Yii::$app->request;
            $session = Yii::$app->session;
            if(!$session->isActive) $session->open();
            $orderModel = new Orders;

            if($request->isPost) {
            		$pay_type = $request->post('pay_type');
            		$paymentAmount = $request->post('payment_amount');

            		if($paymentAmount > 0) {
            			$userModel = new Users;
	            		$capitalLogsModel = new CapitalLogs;
	            		$payLogsModel = new PayLogs;
	            		$userModel = $userModel->findById($session['uid']);

            			if($pay_type == 1) {
            				//自有资金支付
	            			if($userModel->user_capital >= $paymentAmount) {
	            				$condition['id'] = $request->post('order_id');
	            				$condition['user_id'] = $session['uid'];
		            			$orderModel = $orderModel->findById($condition,$message);
		            			if($orderModel) {
		            				$toPaid = $orderModel->customs_money-$orderModel->already_pay;
		            				if($paymentAmount<=$toPaid) {
		            					$connection = Yii::$app->db;
			                    			$transaction = $connection->beginTransaction();
			                    			try{
			                    				$orderModel->already_pay +=$paymentAmount;
			                    				if($orderModel->save()) {
									$userModel->user_capital -=$paymentAmount;
									if($userModel->save()) {
										$data['user_id'] = $session['uid'];
						                    			$data['order_id'] = $request->post('order_id');
						                    			$data['flow_sn'] = time().rand(10000, 99999);
						                    			$data['capital'] = $paymentAmount;
														$data['factory_account_name'] = $request->post('factory_account_name');
														$data['account_name'] = $request->post('account_name');
						                    			$data['capital_symbol'] = '-';
						                    			$data['capital_type'] = 1;
						                    			$data['capital_explain'] = '订单支付';
						                    			//$data['created_at'] = time();
						                    			$result = $capitalLogsModel->add($data);
						                    			if($result) {
						                    				$payData['user_id'] = $session['uid'];
						                    				$payData['order_id'] = $request->post('order_id');
						                    				$payData['payment_amount'] = $paymentAmount;
						                    				$payData['pay_explain'] = '订单支付';
						                    				$payData['pay_type'] = '账户余额支付';
						                    				$payResult = $payLogsModel->add($payData,$message);
						                    				if($payResult) {
						                    					$transaction->commit();
							                                                    		$this->_setSuccessMessage('支付成功');
							                                                    		$this->redirect('/capital');
							                                                    	} else {
							                                                    		$transaction->rollBack();
									                             		$this->_setErrorMessage('支付失败1');
									                             		$this->redirect(Yii::$app->request->referrer);
							                                                    	}
						                    			} else {
						                    				$transaction->rollBack();
								                             		$this->_setErrorMessage('支付失败1');
								                             		$this->redirect(Yii::$app->request->referrer);
						                    			}
									} else {
										$transaction->rollBack();
								                             $this->_setErrorMessage('支付失败2');
								                             $this->redirect(Yii::$app->request->referrer);
									}
			                    				} else {
			                    					$transaction->rollBack();
							                             $this->_setErrorMessage('支付失败3');
							                             $this->redirect(Yii::$app->request->referrer);
			                    				}
			                    			} catch(Exception $e) {
			                    				$transaction->rollBack();
						                             $this->_setErrorMessage('支付失败4');
						                             $this->redirect(Yii::$app->request->referrer);
			                    			}
		            				} else {
		            					$this->_setErrorMessage('支付金额超出待付金额');
						               $this->redirect(Yii::$app->request->referrer);
		            				} 
		            				
		            			} else {
		            				$this->_setErrorMessage($message);
		                    			$this->redirect(Yii::$app->request->referrer);
		            			}
	            			} else {
	            				$this->_setErrorMessage('账户余额不足');
				               $this->redirect(Yii::$app->request->referrer);
	            			}
	            		} else if($pay_type == 2) {
	            			if($userModel->state === -2) {
	            				$this->_setErrorMessage('信用额度资金已冻结');
				               $this->redirect(Yii::$app->request->referrer);
	            			} else {
		            			$bond = $paymentAmount/10;
		            			if($userModel->user_capital >= $bond) {
		            				if($userModel->credi_limit >= $paymentAmount) {
		            					$data['id'] = $request->post('order_id');
		            					$data['user_id'] = $session['uid'];
				            			$orderModel = $orderModel->findById($data,$message);
				            			if($orderModel) {
				            				$toPaid = $orderModel->customs_money-$orderModel->already_pay;
				            				if($paymentAmount<=$toPaid) {
				            					$connection = Yii::$app->db;
					                    			$transaction = $connection->beginTransaction();
					                    			try {
					                    				$orderModel->already_pay += $paymentAmount; //订单已支付金额
					                    				$orderModel->bond += $bond; //订单保证金
					                    				$orderModel->credit_insurance +=$paymentAmount; //订单使用信保金额数
					                    				if($orderModel->save()) {
					                    					$userModel->credi_limit -= $paymentAmount; //用户可用信保金额数
					                    					$userModel->user_capital -=$bond; //用户自有资金
					                    					$userModel->bond +=$bond; //用户保证金总数
					                    					if($userModel->save()) {
								                    			$data = [
								                    				['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' => $paymentAmount, 'capital_symbol'=>'-','capital_type'=>2,'capital_explain'=>'订单支付'],
								                    				['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' => $bond, 'capital_symbol'=>'-','capital_type'=>1,'capital_explain'=>'支付保证金']
								                    			];
								                    			$result = $connection->createCommand()->batchInsert(CapitalLogs::tableName(), ['user_id','order_id','flow_sn','capital','capital_symbol','capital_type','capital_explain'], $data)->execute();
								                    			if($result) {
								                    				$payData['user_id'] = $session['uid'];
								                    				$payData['order_id'] = $request->post('order_id');
								                    				$payData['payment_amount'] = $paymentAmount;
								                    				$payData['pay_explain'] = '订单支付';
								                    				$payData['pay_type'] = '信用额度支付';
								                    				$payResult = $payLogsModel->add($payData,$message);
								                    				if($payResult) {
							                    						$transaction->commit();
								                                                    		$this->_setSuccessMessage('支付成功');
								                                                    		$this->redirect('/capital');
								                                                    	} else {
								                                                    		$transaction->rollBack();
										                             		$this->_setErrorMessage('支付失败1');
										                             		$this->redirect(Yii::$app->request->referrer);
								                                                    	}
								                    			} else {
								                    				$transaction->rollBack();
											                             $this->_setErrorMessage('支付失败');
											                             $this->redirect(Yii::$app->request->referrer);
								                    			}
					                    					} else {
					                    						$transaction->rollBack();
										                             $this->_setErrorMessage('支付失败');
										                             $this->redirect(Yii::$app->request->referrer);
					                    					}
					                    				} else {
					                    					$transaction->rollBack();
									                             $this->_setErrorMessage('支付失败');
									                             $this->redirect(Yii::$app->request->referrer);
					                    				}
					                    			} catch(Exception $e) {
					                    				$transaction->rollBack();
								                             $this->_setErrorMessage('支付失败');
								                             $this->redirect(Yii::$app->request->referrer);
					                    			}
				            				} else {
				            					$this->_setErrorMessage('支付金额超出待付金额');
						               		$this->redirect(Yii::$app->request->referrer);
				            				}
				            			} else {
				            				$this->_setErrorMessage($message);
				                    			$this->redirect(Yii::$app->request->referrer);
				            			}
		            				} else {
		            					$this->_setErrorMessage('信用额度余额不足');
					               	$this->redirect(Yii::$app->request->referrer);
		            				}
		            			} else {
		            				$this->_setErrorMessage('账户余额不足');
					               $this->redirect(Yii::$app->request->referrer);
		            			}
	            			}
	            		} else {
	            			$this->_setErrorMessage('非法请求');
	                    		$this->redirect(Yii::$app->request->referrer);
	            		}
            		} else {
            			$this->_setErrorMessage('支付金额不能少于0元');
	                    	$this->redirect(Yii::$app->request->referrer);
            		}
            } else {
            		$condition['id'] = $request->get('order_id');	
		$condition['user_id'] = $session['uid'];
		$orderModel = $orderModel->findById($condition,$message);

		if($orderModel) {
			return $this->render('pay', [
			 	'order' => $orderModel->attributes,
			]);
		} else {
			$this->_setErrorMessage($message);
			$this->redirect(Yii::$app->request->referrer);
		}
            }
    }

    /**
    * @结汇
    *
    **/
    public function actionSettlement() {
	$request = Yii::$app->request;
	$session = Yii::$app->session;
	if(!$session->isActive) $session->open();
	$orderModel = new Orders;
	$userModel = new Users;
	$payLogsModel = new PayLogs;
	$userModel = $userModel->findById($session['uid']);
	
	$bufferTime = 2*24*3600;
	$nowTime = time();

            if($request->isGet) {
            		$condition['id'] = $request->get('order_id');
            		$condition['user_id'] = $session['uid'];
            		$orderModel = $orderModel->findById($condition,$message);

            		if($orderModel) {
            			$settlementCycle = $orderModel->settlement_cycle; //结汇周期
            			$overdueTime = $settlementCycle*24*3600;
	            		$residualAmount =$orderModel->invoice_amount-$orderModel->already_pay+$orderModel->credit_insurance-$orderModel->drawback_money; //剩余金额
            			if($settlementCycle == 90) {
		            		$serviceCharge = $residualAmount*0.03; //代采购服务费
			} else if($settlementCycle == 120) {
		            		$serviceCharge = $residualAmount*0.04; 
			}
			$taxrefundServicefee = $orderModel->drawback_money*0.03;//退税服务费
            			if($orderModel->order_state<9 && $nowTime-$overdueTime>=$orderModel->delivery_time && $orderModel->delivery_time>=$nowTime-$overdueTime-$bufferTime) {
	            			$amountSettled = $residualAmount+$serviceCharge+$taxrefundServicefee; //结汇金额
	            			$lateFee = 0;
	            		} else if($orderModel->delivery_time !=0 && $orderModel->order_state<9 && $nowTime-$overdueTime-$bufferTime>$orderModel->delivery_time) {
	            			//逾期结汇
	            			$amountSettled = $residualAmount+$serviceCharge+$taxrefundServicefee;
	            			$lateDays = ($nowTime-$orderModel->delivery_time-$overdueTime-$bufferTime)/(24*3600);
	            			$lateDays = ceil($lateDays);
	            			if($lateDays>0 && $lateDays<=4) {
	            				$lateFee = $amountSettled*$lateDays*0.004;
	            			} else {
	            				$lateFee = $amountSettled*4*0.004;
	            				$lateDays -=4;
	            				$lateFee += $amountSettled*$lateDays*0.005;
	            			}
	            			$amountSettled += $lateFee;
	            		} else {
	            			$this->_setErrorMessage('操作被拒绝');
				$this->redirect(Yii::$app->request->referrer);
	            		}

			return $this->render('pay_se',[
				'serviceCharge' => $serviceCharge,
				'order' => $orderModel->attributes,
				'amountSettled' => $amountSettled,
				'lateFee' => $lateFee
			]);
            		} else {
            			$this->_setErrorMessage($message);
			$this->redirect(Yii::$app->request->referrer);
            		}
            } else {
            		$condition['id'] = $request->post('order_id');
            		$condition['user_id'] = $session['uid'];
            		$orderModel = $orderModel->findById($condition,$message);

            		if($orderModel) {
            			$settlementCycle = $orderModel->settlement_cycle; //结汇周期
            			$residualAmount =$orderModel->invoice_amount-$orderModel->already_pay+$orderModel->credit_insurance-$orderModel->drawback_money;
	            		if($settlementCycle == 90) {
		            		$serviceCharge = $residualAmount*0.03; //代采购服务费
			} else if($settlementCycle == 120) {
		            		$serviceCharge = $residualAmount*0.04; 
			}
			$taxrefundServicefee = $orderModel->drawback_money*0.03;//退税服务费
            			if($orderModel->order_state<9 && $nowTime-$overdueTime>=$orderModel->delivery_time && $nowTime-$overdueTime-$bufferTime<=$orderModel->delivery_time) {	
	            			$amountSettled = $residualAmount+$serviceCharge+$taxrefundServicefee;
	            			$orderModel->service_charge = $serviceCharge;
	            			$orderModel->settlement_money = $amountSettled;
            				$orderModel->order_state = 9;
            				$connection = Yii::$app->db;
			               $transaction = $connection->beginTransaction();
            				try {
            					if($userModel->user_capital>$amountSettled) {
            						if($orderModel->save()) {
	            						$userModel->credi_limit +=$orderModel->credit_insurance; //用户可用信用额度
	            						$userModel->user_capital -=$amountSettled; //用户自有资金
	            						$userModel->user_capital +=$orderModel->bond; //用户自有资金
	            						$userModel->bond -=$orderModel->bond; //用户保证金总数 
	            						if($userModel->save()) {
	            							$data = [['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' => $amountSettled, 'capital_symbol'=>'-','capital_type'=>1,'capital_explain'=>'订单结汇'],];
	            							if($orderModel->credit_insurance != 0) {
	            								$data[] = ['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' =>$orderModel->credit_insurance, 'capital_symbol'=>'+','capital_type'=>2,'capital_explain'=>'订单结汇返还'];
	            								$data[] = ['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' => $orderModel->bond, 'capital_symbol'=>'+','capital_type'=>1,'capital_explain'=>'保证金返还'];
	            							}
				                    			$result = $connection->createCommand()->batchInsert(CapitalLogs::tableName(), ['user_id','order_id','flow_sn','capital','capital_symbol','capital_type','capital_explain'], $data)->execute();
	            							if($result) {
	            								$payData['user_id'] = $session['uid'];
				                    				$payData['order_id'] = $request->post('order_id');
				                    				$payData['payment_amount'] = $amountSettled;
				                    				$payData['pay_explain'] = '订单结汇支付';
				                    				$payData['pay_type'] = '账户余额支付';
				                    				$payResult = $payLogsModel->add($payData,$message);
				                    				if($payResult) {
			                    						$transaction->commit();
				                                                    		$this->_setSuccessMessage('结汇成功');
				                                                    		$this->redirect('/capital');
				                                                    	} else {
				                                                    		$transaction->rollBack();
							                             	$this->_setErrorMessage('结汇失败');
							                             	$this->redirect(Yii::$app->request->referrer);
				                                                    	}
	            							} else {
	            								$transaction->rollBack();
							                             $this->_setErrorMessage('结汇失败');
							                             $this->redirect(Yii::$app->request->referrer);
	            							}
	            						} else {
	            							$transaction->rollBack();
						                             $this->_setErrorMessage('结汇失败');
						                             $this->redirect(Yii::$app->request->referrer);
	            						}
	            					} else {
	            						$transaction->rollBack();
					                             $this->_setErrorMessage('结汇失败');
					                             $this->redirect(Yii::$app->request->referrer);
	            					}
            					} else {
            						$transaction->rollBack();
				                           	$this->_setErrorMessage('账户余额不足');
				                             $this->redirect(Yii::$app->request->referrer);
            					}
            				} catch(Exception $e) {
	    				$transaction->rollBack();
			                           	$this->_setErrorMessage('结汇失败');
			                             $this->redirect(Yii::$app->request->referrer);
            				}
	            		} else if($orderModel->delivery_time !=0 && $orderModel->order_state<9 && $nowTime-$overdueTime-$bufferTime>$orderModel->delivery_time) {
	            			//逾期付款
	            			$amountSettled = $residualAmount+$serviceCharge+$taxrefundServicefee;
	            			$lateDays = ($nowTime-$orderModel->delivery_time-$overdueTime-$bufferTime)/(24*3600);
	            			$lateDays = ceil($lateDays);
	            			if($lateDays>0 && $lateDays<=4) {
	            				$lateFee = $amountSettled*$lateDays*0.004;
	            			} else {
	            				$lateFee = $amountSettled*4*0.004;
	            				$lateDays -=4;
	            				$lateFee += $amountSettled*$lateDays*0.005;
	            			}
	            			$amountSettled += $lateFee;
	            			$orderModel->service_charge = $serviceCharge;
	            			$orderModel->settlement_money = $amountSettled;
            				$orderModel->order_state = 9;
            				$orderModel->overdue_money = $lateFee;
	            			$connection = Yii::$app->db;
			               $transaction = $connection->beginTransaction();
			               try {
			               	if($userModel->user_capital>$amountSettled) {
			               		$orderFrozen = $orderModel->order_frozen;
			               		if($orderFrozen == 1) {
			               			$orderModel->order_frozen = 0;
			               		}
			               		if($orderModel->save()) {
		               				$userModel->credi_limit +=$orderModel->credit_insurance;
            							$userModel->user_capital -=$amountSettled;
            							$userModel->user_capital +=$orderModel->bond;
            							$userModel->bond -=$orderModel->bond;
            							if($orderFrozen == 1) {
            								$count = Orders::find()->where(['user_id' =>$session['uid'],'order_frozen'=>1])->count();
	            							if($count == 0) {
	            								$userModel->state = 1;
	            							}
            							}
            							if($userModel->save()) {
            								$data = [['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' => $amountSettled, 'capital_symbol'=>'-','capital_type'=>1,'capital_explain'=>'订单结汇'],];
	            							if($orderModel->credit_insurance != 0) {
	            								$data[] = ['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' =>$orderModel->credit_insurance, 'capital_symbol'=>'+','capital_type'=>2,'capital_explain'=>'订单结汇返还'];
	            								$data[] = ['user_id' => $session['uid'],'order_id'=>$request->post('order_id'),'flow_sn'=>time().rand(10000, 99999),'capital' => $orderModel->bond, 'capital_symbol'=>'+','capital_type'=>1,'capital_explain'=>'保证金返还'];
	            							}
				                    			$result = $connection->createCommand()->batchInsert(CapitalLogs::tableName(), ['user_id','order_id','flow_sn','capital','capital_symbol','capital_type','capital_explain'], $data)->execute();
				                    			if($result) {
				                    				$payData['user_id'] = $session['uid'];
				                    				$payData['order_id'] = $request->post('order_id');
				                    				$payData['payment_amount'] = $amountSettled;
				                    				$payData['pay_explain'] = '订单结汇支付';
				                    				$payData['pay_type'] = '账户余额支付';
				                    				$payResult = $payLogsModel->add($payData,$message);
				                    				if($payResult) {
			                    						$transaction->commit();
				                                                    		$this->_setSuccessMessage('结汇成功');
				                                                    		$this->redirect('/capital');
				                                                    	} else {
				                                                    		$transaction->rollBack();
							                             	$this->_setErrorMessage('结汇失败');
							                             	$this->redirect(Yii::$app->request->referrer);
				                                                    	}
				                    			} else {
				                    				$transaction->rollBack();
							                             $this->_setErrorMessage('逾期结汇失败');
							                             $this->redirect(Yii::$app->request->referrer);
				                    			}
            							} else {
            								$transaction->rollBack();
						                             $this->_setErrorMessage('逾期结汇失败');
						                             $this->redirect(Yii::$app->request->referrer);
            							}
		               			} else {
		               				$transaction->rollBack();
					                             $this->_setErrorMessage('逾期结汇失败');
					                             $this->redirect(Yii::$app->request->referrer);
		               			}
            					} else {
            						$transaction->rollBack();
				                           	$this->_setErrorMessage('账户余额不足');
				                             $this->redirect(Yii::$app->request->referrer);
            					}
			               } catch(Exception $e) {
			               	$transaction->rollBack();
			                           	$this->_setErrorMessage('逾期结汇失败');
			                             $this->redirect(Yii::$app->request->referrer);
			               }
	            		} else {
	            			$this->_setErrorMessage('操作被拒绝');
				$this->redirect(Yii::$app->request->referrer);
	            		}
            		} else {
            			$this->_setErrorMessage($message);
			$this->redirect(Yii::$app->request->referrer);
            		}
            }
    }

}
