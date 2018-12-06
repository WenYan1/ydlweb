<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ecic_change_logs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $new_quota
 * @property integer $old_quota
 * @property integer $created_at
 */
class EcicChangeLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ecic_change_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'new_quota', 'old_quota', 'created_at'], 'integer']
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
            'new_quota' => 'New Quota',
            'old_quota' => 'Old Quota',
            'created_at' => 'Created At',
        ];
    }

    public function findByUserId($id) {
        return  self::find()->where(['user_id'=>$id])->all();
    }
}
