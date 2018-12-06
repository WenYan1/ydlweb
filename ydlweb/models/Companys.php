<?php

namespace app\models;

use Yii;


class Companys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'company_tel', 'expect_credit', 'expect_days', 'state', 'created_at'], 'integer'],
            [['company_name','user_id',  'address' , 'company_tel', 'expect_credit', 'expect_days'], 'required'],
            [['company_name'], 'string', 'max' => 60],
            [['country', 'city'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 90],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'company_name' => 'Company Name',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'county_id' => 'County ID',
            'province' => 'Province',
            'city' => 'City',
            'county' => 'County',
            'address' => 'Address',
            'business_license' => 'Business License',
            'tax_registration' => 'Tax Registration',
            'company_principal' => 'Company Principal',
            'company_tel' => 'Company Tel',
            'account_opening' => 'Account Opening',
            'bank_account' => 'Bank Account',
            'state' => 'State',
            'created_at' => 'Created At',
        ];
    }

    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function findByUserId($user_id) {
        $company = self::find()->where(['user_id'=>$user_id])->one();
        if($company) {
            return $company;
        } else {
            return false;
        }
    }

    public function add($data,&$message) {
        self::deleteAll(['user_id' => $data['user_id']]);
        $model = new Companys;
        $model->setAttributes($data, false);
        if($model->validate()) {
            if($model->save()) {
                $message = '提交成功';
                return $model;
            }else {
                $message = '提交失败';
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

    public function findById($id,&$message) {
        $company = self::findOne($id);

        if($company) {
            return $company;
        } else {
            $message = '该公司不存在';
            return false;
        }
    }
}
