<?php

namespace app\modules\ydlbam\models;

use Yii;

/**
 * This is the model class for table "admin_modular".
 *
 * @property integer $id
 * @property string $permission_name
 */
class AdminModular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_modular';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permission_name'], 'required'],
            [['permission_name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permission_name' => 'Permission Name',
        ];
    }
}
