<?php

namespace app\modules\ydlbam\models;

use Yii;

/**
 * This is the model class for table "admin_groups".
 *
 * @property integer $id
 * @property string $group_name
 * @property string $group_describe
 * @property integer $created_at
 */
class AdminGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name', 'group_describe'], 'required'],
            [['created_at'], 'integer'],
            [['group_name'], 'string', 'max' => 30],
            [['group_describe'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => 'Group Name',
            'group_describe' => 'Group Describe',
            'created_at' => 'Created At',
        ];
    }

    public function getGroupPermission()
    {
        return $this->hasMany(AdminPermission::className(), ['group_id' => 'id']);
    }

    public function addGroup($data) {
            $model = new AdminGroups;
            $model->setAttributes($data, false);
            if($model->validate()) {
                    if($model->save()) {
                            return $model;
                    }else {
                            return false;
                    }
            }
    }
}
