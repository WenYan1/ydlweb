<?php

namespace app\models;

use Yii;

class CollectionFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collection_file';
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
	        'id'           => 'id',
	        'c_id'         => 'c_id',
	        'user_id'      => 'user_id',
	        'category'     => 'category',
	        'client_name'  => 'client_name',
	        'service_path' => 'service_path',
	        'extension'    => 'extension',
	        'file_size'    => 'file_size',
	        'created_at'   => 'created_at',
	        'updated_at'   => 'updated_at',
        ];
    }

	public function add($data, &$message)
	{
		$model = new CollectionFile;
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

	public function actDelete($condition, &$message)
	{
		$goods = self::find()->where($condition)->one();
		if ($goods) {
			if ($goods->delete()) {
				$message = '删除成功';
				return true;
			} else {
				$message = '删除失败';
				return false;
			}
		} else {
			$message = '该文件不存在';
			return false;
		}
	}

	public function actDeleteAll($c_id, &$message) {
		$result = CollectionFile::deleteAll('c_id = '.$c_id);
		if($result || $result === 0) {
			$message = '删除成功';
			return true;
		} else {
			$message = '删除失败';
			return false;
		}
	}

	public function findById($condition, &$message)
	{
		$goods = self::find()->where($condition)->one();
		if ($goods) {
			return $goods;
		} else {
			$message = '该文件不存在';
			return false;
		}
	}

	public function findByCid($condition)
	{
		$goods = self::find()->where($condition)->all();
		if ($goods) {
			return $goods;
		} else {
			return false;
		}
	}
}
