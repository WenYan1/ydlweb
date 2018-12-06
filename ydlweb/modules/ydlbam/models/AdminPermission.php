<?php

namespace app\modules\ydlbam\models;

use Yii;

/**
 * This is the model class for table "admin_permission".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $permission_name
 */
class AdminPermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'integer'],
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
            'group_id' => 'Group ID',
            'permission_name' => 'Permission Name',
        ];
    }

    public function getUserPermission($group_id) {
            $permissions = self::find()->where(['group_id'=>$group_id])->all();

            if($permissions) {
                    return $permissions;
            } else {
                    return false;
            }
    }
}
