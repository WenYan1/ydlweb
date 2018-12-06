<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "capital_logs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $flow_sn
 * @property double $capital
 * @property string $capital_symbol
 * @property integer $capital_type
 * @property string $capital_explain
 * @property integer $created_at
 */
class CapitalLogs extends \yii\db\ActiveRecord {
	public function behaviors()
    {
        return [
        'timestamp' => [
                         'class' => 'yii\behaviors\TimestampBehavior',
                         'attributes' => [
                             ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                         ],
                     ],
                ];

    }
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'capital_logs';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['user_id', 'order_id', 'flow_sn', 'capital_type', 'created_at'], 'integer'],
			[['capital'], 'number'],
			[['capital_symbol', 'capital_explain'], 'required'],
			[['capital_symbol'], 'string', 'max' => 1],
			[['capital_explain'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'user_id' => 'User ID',
			'order_id' => 'Order ID',
			'flow_sn' => 'Flow Sn',
			'capital' => 'Capital',
			'capital_symbol' => 'Capital Symbol',
			'capital_type' => 'Capital Type',
			'capital_explain' => 'Capital Explain',
			'created_at' => 'Created At',
		];
	}

	public function add($data) {
		$model = new CapitalLogs;
		$model->setAttributes($data, false);
		if ($model->save()) {
			return true;
		} else {
			return false;
		}
	}

	public function findByUserId($id) {
		return  self::find()->where(['user_id'=>$id])->all();
	}
}
