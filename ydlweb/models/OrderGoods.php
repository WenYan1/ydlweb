<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_goods".
 *
 * @property integer $id
 * @property integer $order_id
 * @property double $goods_price
 * @property integer $goods_num
 * @property string $goods_name
 * @property string $goods_image
 * @property string $hs_code
 * @property double $goods_taxrate
 */
class OrderGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'goods_price' => 'Goods Price',
            'goods_num' => 'Goods Num',
            'goods_name' => 'Goods Name',
            'goods_image' => 'Goods Image',
            'hs_code' => 'Hs Code',
            'goods_taxrate' => 'Goods Taxrate',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

	public function actDeleteAll($o_id, &$message) {
		$result = OrderGoods::deleteAll('order_id = '.$o_id);
		if($result || $result === 0) {
			$message = '删除成功';
			return true;
		} else {
			$message = '删除失败';
			return false;
		}
	}
}
