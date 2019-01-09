<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string  $order_sn
 * @property integer $user_id
 * @property string  $user_company
 * @property string  $user_principal
 * @property string  $user_tel
 * @property string  $user_email
 * @property integer $supplier_id
 * @property string  $supplier_name
 * @property string  $supplier_principal
 * @property string  $supplier_tel
 * @property string  $supplier_email
 * @property integer $customs_port
 * @property integer $arrive_port
 * @property double  $customs_money
 * @property string  $original_place
 * @property double  $gross_weoght
 * @property double  $net_weight
 * @property integer $total_quantity
 * @property integer $total_box
 * @property integer $credit_insurance
 * @property double  $service_charge
 * @property double  $drawback_money
 * @property double  $transfer_fee
 * @property double  $overdue_money
 * @property double  $settlement_money
 * @property integer $down_payment
 * @property integer $is_pay
 * @property integer $already_pay
 * @property integer $delivery_time
 * @property integer $order_state
 * @property integer $created_at
 */
class Orders extends \yii\db\ActiveRecord
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
		return 'orders';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			/*[['order_sn', 'user_id', 'supplier_id', 'total_quantity', 'total_box', 'credit_insurance', 'down_payment', 'is_pay', 'already_pay', 'delivery_time', 'order_state', 'created_at'], 'integer'],
			[['user_company', 'user_principal', 'user_tel', 'user_email', 'supplier_name', 'supplier_principal', 'supplier_tel', 'supplier_email', 'original_place', 'created_at'], 'required'],
			[['customs_money', 'gross_weoght', 'net_weight', 'service_charge', 'drawback_money', 'transfer_fee', 'overdue_money', 'settlement_money'], 'number'],
			[['user_company', 'supplier_name', 'original_place'], 'string', 'max' => 60],
			[['user_principal', 'user_email', 'supplier_principal', 'supplier_email'], 'string', 'max' => 30],
			[['user_tel', 'supplier_tel'], 'string', 'max' => 15]*/
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'                          => 'id',
			'order_sn'                    => 'order_sn',
			'user_id'                     => 'user_id',
			'email'                       => 'email',
			'user_company'                => 'user_company',
			'user_principal'              => 'user_principal',
			'user_tel'                    => 'user_tel',
			'user_email'                  => 'user_email',
			'supplier_id'                 => 'supplier_id',
			'supplier_name'               => 'supplier_name',
			'supplier_principal'          => 'supplier_principal',
			'supplier_tel'                => 'supplier_tel',
			'supplier_email'              => 'supplier_email',
			'customs_port'                => 'customs_port',
			'customs_port_type'           => 'customs_port_type',
			'customs_port_froms'          => 'customs_port_froms',
			'arrive_port'                 => 'arrive_port',
			'customs_money'                 => 'customs_money',
			'order_amount'                => 'order_amount',
			'invoice_amount'              => 'invoice_amount',
			'customs_money'               => 'customs_money',
			'original_place'              => 'original_place',
			'gross_weoght'                => 'gross_weoght',
			'net_weight'                  => 'net_weight',
			'total_quantity'              => 'total_quantity',
			'total_box'                   => 'total_box',
			'total_volume'                => 'total_volume',
			'credit_insurance'            => 'credit_insurance',
			'bond'                        => 'bond',
			'service_charge'              => 'service_charge',
			'drawback_money'              => 'drawback_money',
			'drawback_brokerage'          => 'drawback_brokerage',
			'transfer_fee'                => 'transfer_fee',
			'overdue_money'               => 'overdue_money',
			'settlement_money'            => 'settlement_money',
			'down_payment'                => 'down_payment',
			'firstpayment_amount'         => 'firstpayment_amount',
			'is_pay'                      => 'is_pay',
			'settlement_cycle'            => 'settlement_cycle',
			'settlement_type'             => 'settlement_type',
			'first_payment_remark'        => 'first_payment_remark',
			'original_place_remark'       => 'original_place_remark',
			'customs_declaration'         => 'customs_declaration',
			'commodity_code'              => 'commodity_code',
			'date_departure'              => 'date_departure',
			'usd_total'                   => 'usd_total',
			'usd_unit_price'              => 'usd_unit_price',
			'already_pay'                 => 'already_pay',
			'delivery_time'               => 'delivery_time',
			'service_type'                => 'service_type',
			'customs_contact'             => 'customs_contact',
			'customs_contact_tel'         => 'customs_contact_tel',
			'customs_currency'            => 'customs_currency',
			'cost_type'                   => 'cost_type',
			'input_price_type'            => 'input_price_type',
			'packing_way'                 => 'packing_way',
			'destination_country_or_area' => 'destination_country_or_area',
			'risk_container_type'         => 'risk_container_type',
			'transport_package_count'     => 'transport_package_count',
			'pack_type_list'              => 'pack_type_list',
			'buyers_name'                 => 'buyers_name',
			'buyers_address'              => 'buyers_address',
			'buyers_contact'              => 'buyers_contact',
			'trading_country'             => 'trading_country',
			'is_special_relation'         => 'is_special_relation',
			'goods_supply_id'             => 'goods_supply_id',
			'goods_save_adr'              => 'goods_save_adr',
			'contract_type'               => 'contract_type',
			'purchasing_order'            => 'purchasing_order',
			'interest_offer'              => 'interest_offer',
			'deposit_ratio'               => 'deposit_ratio',
			'advance_days'                => 'advance_days',
			'other_file'                  => 'other_file',
			'order_state'                 => 'order_state',
			'order_frozen'                => 'order_frozen',
			'created_at'                  => 'created_at',
			'updated_at'                  => 'updated_at',
			'exchange_rate'               => 'exchange_rate',
		];
	}

	public function getOrderGoods()
	{
		return $this->hasMany(OrderGoods::className(), ['order_id' => 'id']);
	}

	public function getOrderPayLog()
	{
		return $this->hasMany(CapitalLogs::className(), ['order_id' => 'id']);
	}

	public function edit($condition, $data, &$message)
	{
		$supplier = self::updateAll($data,$condition);
		if ($supplier) {
			$message = '编辑成功';
			return true;
		} else {
			$message = '编辑失败';
			return false;
		}
	}

	public function add($data, &$message)
	{
		$model = new Orders;
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
		$order = self::find()->where($condition)->one();
		if ($order) {
			return $order;
		} else {
			$message = '订单不存在';
			return false;
		}
	}
}
