<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "suppliers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $identify_number
 * @property string  $company_name
 * @property string  $cognizance_time
 * @property string  $finance_contacts
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $county_id
 * @property string  $province
 * @property string  $city
 * @property string  $county
 * @property string  $address
 * @property string  $tel
 * @property string  $goods_source
 * @property integer $tax_rate
 * @property integer $export_right
 * @property string  $business_license
 * @property string  $business_license_remark
 * @property string  $business_license_risk
 * @property string  $tax_registration
 * @property string  $tax_registration_remark
 * @property string  $tax_registration_risk
 * @property string  $organization code
 * @property integer $supplier_state
 * @property integer $created_at
 * @property integer $updated_at
 */
class Suppliers extends \yii\db\ActiveRecord
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
		return 'suppliers';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'province_id', 'city_id', 'county_id', 'tax_rate', 'export_right', 'created_at', 'updated_at'], 'integer'],
			[['identify_number', 'company_name', 'cognizance_time', 'finance_contacts', 'province', 'city', 'county', 'address', 'tel', 'goods_source', 'business_license', 'tax_registration', 'organization_code'], 'required'],
			[['identify_number', 'finance_contacts', 'province', 'city', 'county', 'business_license', 'tax_registration', 'organization_code'], 'string', 'max' => 50],
			[['company_name', 'goods_source'], 'string', 'max' => 60],
			[['cognizance_time'], 'string', 'max' => 10],
			[['address'], 'string', 'max' => 90],
			[['tel'], 'string', 'max' => 20]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'                      => 'ID',
			'user_id'                 => 'User ID',
			'identify_number'         => 'Identify Number',
			'company_name'            => 'Company Name',
			'cognizance_time'         => 'Cognizance Time',
			'finance_contacts'        => 'Finance Contacts',
			'province_id'             => 'Province ID',
			'city_id'                 => 'City ID',
			'county_id'               => 'County ID',
			'province'                => 'Province',
			'city'                    => 'City',
			'county'                  => 'County',
			'address'                 => 'Address',
			'tel'                     => 'Tel',
			'goods_source'            => 'Goods Source',
			'tax_rate'                => 'Tax Rate',
			'export_right'            => 'Export Right',
			'business_license'        => 'Business License',
			'business_license_remark' => 'Business License Remark',
			'business_license_risk'   => 'Business License Risk',
			'tax_registration'        => 'Tax Registration',
			'tax_registration_remark' => 'Tax Registration Remark',
			'tax_registration_risk'   => 'Tax Registration Risk',
			'organization_code'       => 'Organization Code',
			'supplier_state'          => 'Supplier State',
			'created_at'              => 'Created At',
			'updated_at'              => 'Updated At',
		];
	}

	public function add($data, &$message)
	{
		$model = new Suppliers;
		$model->setAttributes($data, false);
		if ($model->validate()) {
			if ($model->save()) {
				$message = '供应商添加成功';
				return $model;
			} else {
				$message = '供应商添加失败';
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

	public function edit($condition, $data, &$message)
	{
		$supplier = self::find()->where($condition)->one();
		if ($supplier) {
			$supplier->setAttributes($data);
			if ($supplier->save()) {
				$message = '编辑成功';
				return true;
			} else {
				$message = '编辑失败';
				return false;
			}
		} else {
			$message = '该供应商不存在';
			return false;
		}
	}

	public function actDelete($condition, &$message)
	{
		$supplier = self::find()->where($condition)->one();
		if ($supplier) {
			if ($supplier->delete()) {
				$message = '删除成功';
				return true;
			} else {
				$message = '删除失败';
				return false;
			}
		} else {
			$message = '该供应商不存在';
			return false;
		}
	}

	public function getById($id, &$message)
	{
		$supplier = self::findOne($id);

		if ($supplier) {
			return $supplier;
		} else {
			$message = '该供应商不存在';
			return false;
		}
	}

	public function findByUserId($user_id)
	{
		$supplier = self::find()->where(['user_id' => $user_id])->orderBy('created_at DESC')->all();
		return $supplier;
	}

	public function findUsefulByUserId($user_id)
	{
		$supplier = self::find()->where(['user_id' => $user_id])->andFilterWhere(['supplier_state' => 1])->all();
		return $supplier;
	}

	public function findByCondition2($condition, &$message)
	{
		$supplier = self::find()->where($condition)->one();
		if ($supplier) {
			return $supplier;
		} else {
			$message = '该供应商不存在';
			return false;
		}
	}

	public function findById($id, &$message)
	{
		$supplier = self::findOne($id);
		if ($supplier) {
			return $supplier;
		} else {
			$message = '该供应商不存在';
			return false;
		}
	}


}
