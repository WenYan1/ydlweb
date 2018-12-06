<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods_attrs".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property double $goods_long
 * @property double $goods_wide
 * @property double $goods_height
 * @property double $gross_weight
 * @property double $net_weight
 */
class GoodsAttrs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_attrs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['goods_long', 'goods_wide', 'goods_height', 'gross_weight', 'net_weight'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'Goods ID',
            'goods_long' => 'Goods Long',
            'goods_wide' => 'Goods Wide',
            'goods_height' => 'Goods Height',
            'gross_weight' => 'Gross Weight',
            'net_weight' => 'Net Weight',
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }

    public function actDeleteAll($goods_id, &$message) {
            $result = self::deleteAll('goods_id = :goods_id', [':goods_id' => $goods_id]);
            if($result || $result === 0) {
                $message = '删除成功';
                return true;
            } else {
                $message = '删除失败';
                return false;
            }
    }

    public function actDelete($id, &$message) {
        $attr = self::findOne($id);

        if($attr) {
            if($attr->delete()) {
                $message = '删除成功';
                return true;
            } else {
                $message = '删除失败';
                return false;
            }
        } else {
            $message = '属性不存在';
            return false;
        }
    }

    public function getById($id, &$message) {
            $attr = self::findOne($id);
            if($attr) {
                    return $attr;
            } else {
                    $message = '该包装不存在';
                    return false;
            }
    }

    public function add($data, &$message) {
            $model = new GoodsAttrs;
            $model->setAttributes($data, false);
            if($model->save()) {
                $message = '添加成功';
                return $model;
            } else {
                $message = '添加失败';
                return false;
            }
    }
}
