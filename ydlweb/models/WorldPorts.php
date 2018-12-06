<?php
namespace app\models;

use yii;

class WorldPorts extends \yii\db\ActiveRecord {

	public static function tableName() {
		return 'global_ports';
	}

	public function rules() {
		return [
			[['name', 'en', 'country', 'cn', 'countryCn', 'identifier'], 'required'],
		];
	}

	public function attributeLabels() {
		return [
			'name' => '港口名称',
			'en' => '港口英文名称',
			'country' => '港口所在国家英文名称',
			'cn' => '港口中文名称',
			'countryCn' => '港口所在国家中文名称',
			'identifier' => '港口标识符',
			'id' => '序列号',
		];
	}
	// 增加港口
	public function addPort($data, &$message) {
		$tmpModel = new ChinaPorts;
		$tmpModel->setAttributes($data, false);
		if ($tmpModel->validate()) {
			if ($tmpModel->save()) {
				$message = '添加成功';
				return $tmpModel;
			} else {
				$message = '添加失败';
				return false;
			}
		} else {
			$errors = $tmpModel->errors;
			foreach ($errors as $val) {
				$message = $val[0];
				break;
			}
			return false;
		}
	}

	// 根据identifier查看港口
	public function findByIdentifier($identifier, &$message) {
		$chinaPort = self::find()->where(['identifier' => $identifier])->one();
		if ($chinaPort) {
			return $chinaPort;
		} else {
			$message = '用户不存在';
			return false;
		}
	}

	// 修改港口
	public function editPort($data, &$message) {
		$targetModel = self::find()->where(['id' => $data['id']])->one();
		if ($targetModel) {
			$tmpModel->setAttributes($data, false);
			if (tmpModel) {
				$tmpModel->save();
				$message = '修改成功';
				return $tmpModel;
			} else {
				$errors = $model->errors;
				foreach ($errors as $val) {
					$message = $val[0];
					break;
				}
				return false;
			}
		} else {
			$message = '修改失败';
			return false;
		}
	}

	// 删除港口
	public function deletePort($data, &$message) {
		$targetModel = self::find()->where(['id' => $data['id']])->one();
		if ($targetModel) {
			$targetModel->delete();
			$message = '删除成功';
			return true;
		} else {
			$message = '删除失败, 未找到数据';
			return false;
		}
	}

	public function findAllPorts() {
		return self::find()->all();
	}
}
