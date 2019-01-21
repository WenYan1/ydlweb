<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pay_logs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $payment_amount
 * @property integer $state
 * @property string $pay_explain
 * @property integer $created_at
 * @property integer $updated_at
 */
class PayLogs extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
        'timestamp' => [
                         'class' => 'yii\behaviors\TimestampBehavior',
                         'attributes' => [
                             ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                             ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                         ],
                     ],
                ];

    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pay_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'state', 'created_at', 'updated_at'], 'integer'],
            //[['payment_amount'], 'number'],
            [['pay_explain'], 'required'],
            [['pay_explain'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
            'payment_amount' => 'Payment Amount',
            'state' => 'State',
            'pay_explain' => 'Pay Explain',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function add($data,&$message) {
        $model = new PayLogs;
        $model->setAttributes($data, false);
        if($model->validate()) {
            if($model->save()) {
                $message = '添加成功';
                return $model;
            } else {
                $message = '添加失败';
                return false;
            }
        } else {
            $errors = $model->errors;
            foreach($errors as $val) {
            $message = $val[0];
            break;
            }
            return false;
        }
    }
}
