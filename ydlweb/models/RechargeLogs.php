<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recharge_logs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_email
 * @property string $bank_name
 * @property string $bank_account
 * @property string $recharge_amount
 * @property string $recharge_time
 * @property integer $state
 * @property integer $created_at
 * @property integer $update_at
 */
class RechargeLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recharge_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'state', 'created_at', 'update_at'], 'integer'],
            [['user_email', 'bank_name', 'bank_account', 'recharge_time', 'created_at', 'update_at'], 'required'],
            [['user_email', 'bank_name'], 'string', 'max' => 30],
            [['bank_account'], 'string', 'max' => 20],
            [['recharge_time'], 'string', 'max' => 10]
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
            'user_email' => 'User Email',
            'bank_name' => 'Bank Name',
            'bank_account' => 'Bank Account',
            'recharge_amount' => 'Recharge Amount',
            'recharge_time' => 'Recharge Time',
            'state' => 'State',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }

    public function add($data, &$message) {
            $model = new RechargeLogs;
            $model->setAttributes($data, false);
            if($model->validate()) {
                    if($model->save()) {
                            $message = '提交成功,等待审核';
                            return $model;
                    }else {
                            $message = '提交失败';
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

    public function findById($id,&$message) {
            $logs = self::findOne($id);
            if($logs) {
                    return $logs;
            } else {
                    $message = '此数据不存在';
                    return false;
            }
    }
}
