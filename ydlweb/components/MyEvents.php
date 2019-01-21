<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Event;
use app\models\Users;
use app\models\Orders;

class MyEvents extends Component
{
    const EVENT_FROZEN = 'frozenUser';

    public function frozen($parm)
    {
                $connection = Yii::$app->db;
                $bufferTime = 2*24*3600;
                $nowTime = time();
                $freezingTime = 10*24*3600;
                $userId = $parm->data;
                $orders = Orders::find()->where(['user_id' =>$userId,'order_frozen'=>0])->andWhere(['<>','delivery_time',0])->andWhere(['<','order_state',9])->all();
                $sign = false;
                foreach($orders as $val) {
                        $overdueTime = $val->settlement_cycle*24*3600;
                        if($nowTime-$overdueTime-$bufferTime-$freezingTime>$val->delivery_time) {
                                $sign = true;
                                $newOrders[] = $val;
                        }
                }


                if($sign) {
                        $user = Users::findOne($userId);
                        foreach($newOrders as $key=>$order) {
                                $orderId[] = $order->id;
                        }
                        Orders::updateAll(['order_frozen'=>1],['id'=>$orderId]);
                        if($user->state !== -2) {
                                // $sql = "update users set state=-2 where id=".$userId;
                                // $command = $connection->createCommand($sql);
                                // $command->execute();
                        }
                }

    }


    public function bar($parm)
    {
        echo "你应该会看到:".$parm->data.'<br>';
    }
}