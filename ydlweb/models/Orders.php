<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $order_sn
 * @property integer $user_id
 * @property string $user_company
 * @property string $user_principal
 * @property string $user_tel
 * @property string $user_email
 * @property integer $supplier_id
 * @property string $supplier_name
 * @property string $supplier_principal
 * @property string $supplier_tel
 * @property string $supplier_email
 * @property integer $customs_port
 * @property integer $arrive_port
 * @property double $order_total
 * @property string $original_place
 * @property double $gross_weoght
 * @property double $net_weight
 * @property integer $total_quantity
 * @property integer $total_box
 * @property integer $credit_insurance
 * @property double $service_charge
 * @property double $drawback_money
 * @property double $transfer_fee
 * @property double $overdue_money
 * @property double $settlement_money
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
                         'class' => 'yii\behaviors\TimestampBehavior',
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
            [['order_total', 'gross_weoght', 'net_weight', 'service_charge', 'drawback_money', 'transfer_fee', 'overdue_money', 'settlement_money'], 'number'],
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
            'id' => 'ID',
            'order_sn' => 'Order Sn',
            'user_id' => 'User ID',
            'user_company' => 'User Company',
            'user_principal' => 'User Principal',
            'user_tel' => 'User Tel',
            'user_email' => 'User Email',
            'supplier_id' => 'Supplier ID',
            'supplier_name' => 'Supplier Name',
            'supplier_principal' => 'Supplier Principal',
            'supplier_tel' => 'Supplier Tel',
            'supplier_email' => 'Supplier Email',
            'customs_port' => 'Customs Port',
            'arrive_port' => 'Arrive Port',
            'order_total' => 'Order Total',
            'original_place' => 'Original Place',
            'gross_weoght' => 'Gross Weoght',
            'net_weight' => 'Net Weight',
            'total_quantity' => 'Total Quantity',
            'total_box' => 'Total Box',
            'credit_insurance' => 'Credit Insurance',
            'service_charge' => 'Service Charge',
            'drawback_money' => 'Drawback Money',
            'transfer_fee' => 'Transfer Fee',
            'overdue_money' => 'Overdue Money',
            'settlement_money' => 'Settlement Money',
            'down_payment' => 'Down Payment',
            'is_pay' => 'Is Pay',
            'already_pay' => 'Already Pay',
            'delivery_time' => 'Delivery Time',
            'order_state' => 'Order State',
            'created_at' => 'Created At',
        ];
    }

    public function getOrderGoods()
    {
        return $this->hasMany(OrderGoods::className(), ['order_id' => 'id']);
    }

    public function getOrderPayLog() {
            return $this->hasMany(CapitalLogs::className(), ['order_id' => 'id']);
    }

    public function add($data, &$message) {
        $model = new Orders;
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

    public function findById($condition,&$message) {
            $order = self::find()->where($condition)->one();
            if($order) {
                return $order;
            } else {
                $message = '订单不存在';
                return false;
            }
    }
}
