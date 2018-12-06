<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forget_password".
 *
 * @property integer $id
 * @property string $email
 * @property string $token
 * @property integer $create_at
 */
class ForgetPassword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forget_password';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required','message'=>'{attribute}格式不正确'],
            ['email', 'email','message'=>'{attribute}格式不正确'],
            [['email'], 'string', 'max' => 30,'message'=>'{attribute}不能超过30个字符'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => '邮箱',
            'token' => 'Token',
            'create_at' => 'Create At',
        ];
    }

    public function add($data, &$message) {
            $model = new ForgetPassword;
            $model->setAttributes($data, false);
            if($model->validate()) {
                    if($model->save()) {
                            $message = '注册成功';
                            return $model;
                    }else {
                            $message = '注册失败';
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
