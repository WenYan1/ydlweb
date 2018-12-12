<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Collection extends \yii\db\ActiveRecord
{
	public function behaviors()
	{
		return [
			'timestamp' => [
				'class'      => 'yii\behaviors\TimestampBehavior',
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
		return 'collection';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'                     => 'ID',
			'user_id'                => 'user id',
			'user_email'             => 'user email',
			'order_number'           => 'order number',
			'tax_refund'             => 'tax refund',
			'supply_contract'        => 'supply contract',
			'invoice'                => 'invoice',
			'is_identification'      => 'is identification',
			'anticipated_tax_refund' => 'anticipated tax refund',
			'is_end'                 => 'is end',
			'created_at'             => 'created at',
			'updated_at'             => 'updated at',
		];
	}

	public function add($data, &$message)
	{
		$model = new Collection;
		$model->setAttributes($data, false);
		if ($model->validate()) {
			if ($model->save()) {
				$message = '添加成功';
				return $model;
			} else {
				$message = '添加失败';
				return false;
			}
		} else {
			$errors = $model->errors;
			foreach ($errors as $val) {
				$message = $val[0];
				break;
			}
			return false;
		}
	}

	public function findById($condition, &$message)
	{
		$collection = self::find()->where($condition)->one();
		if ($collection) {
			return $collection;
		} else {
			$message = '单据不存在';
			return false;
		}
	}
}
