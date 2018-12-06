<?php

namespace app\models;

use Yii;
//use yii\base\Model;
//use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $goods_name
 * @property string $goods_image
 * @property double $goods_long
 * @property double $goods_wide
 * @property double $goods_height
 * @property double $gross_weight
 * @property double $net_weight
 * @property string $hs_code
 * @property integer $created_at
 * @property integer $updated_at
 */
class Goods extends \yii\db\ActiveRecord
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
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_name', 'goods_image', 'hs_code'], 'required'],
            [['goods_long', 'goods_wide', 'goods_height', 'gross_weight', 'net_weight'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['goods_name'], 'string', 'max' => 60],
            [['goods_image'], 'string', 'max' => 45],
            [['hs_code'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_name' => 'Goods Name',
            'goods_image' => 'Goods Image',
            'goods_long' => 'Goods Long',
            'goods_wide' => 'Goods Wide',
            'goods_height' => 'Goods Height',
            'gross_weight' => 'Gross Weight',
            'net_weight' => 'Net Weight',
            'hs_code' => 'Hs Code',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getGoodsAttrs()
    {
        return $this->hasMany(GoodsAttrs::className(), ['goods_id' => 'id']);
    }

   public function add($data, &$message) {
        $model = new Goods;
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

   public function actDelete($condition, &$message) {
        $goods = self::find()->where($condition)->one();
        if($goods) {
            if($goods->delete()) {
                $message = '删除成功';
                return true;
            } else {
                $message = '删除失败';
                return false;
            }
        } else {
            $message = '商品不存在';
            return false;
        }
    }

    public function findById($condition,&$message) {
        $goods = self::find()->where($condition)->one();
        if($goods) {
            return $goods;
        } else {
            $message = '该商品不存在';
            return false;
        }
    }

    public function findBySupplier($condition) {
            $goods = self::find()->where($condition)->all();
            if($goods) {
                    return $goods;
            } else {
                    return false;
            }
    }





}
