<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_users".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $user_name
 * @property string $password
 * @property integer $rank
 * @property integer $state
 * @property integer $created_at
 */
class AdminUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'rank', 'state', 'created_at'], 'integer'],
            [['user_name', 'password', 'group_id'], 'required'],
            [['user_name'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'user_name' => 'User Name',
            'password' => 'Password',
            'rank' => 'Rank',
            'state' => 'State',
            'created_at' => 'Created At',
        ];
    }

    public function findByUserName($user_name) {
            $user = self::find()->where(['user_name'=>$user_name])->one();

            if($user) {
                    return $user;
            } else {
                    return false;
            }
    }

    public function addUser($data,&$message) {
            $model = new AdminUsers;
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
