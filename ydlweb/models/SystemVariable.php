<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_variable".
 *
 * @property integer $id
 * @property string $variable_name
 * @property string $data
 * @property string $variable_explain
 */
class SystemVariable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_variable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variable_name', 'data', 'variable_explain'], 'required'],
            [['variable_name', 'variable_explain'], 'string', 'max' => 50],
            [['data'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'variable_name' => 'Variable Name',
            'data' => 'Data',
            'variable_explain' => 'Variable Explain',
        ];
    }

    public function getSystemVariable($condition) {
            $systemVariable = self::find()->where($condition)->one();
    }
}
