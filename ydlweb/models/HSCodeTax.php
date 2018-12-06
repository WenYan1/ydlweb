<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "HSCodeTax".
 *
 * @property string $CODE
 * @property string $ST_DATE
 * @property string $END_DATE
 * @property string $ZHCMCODE
 * @property string $NAME
 * @property string $DWCODE
 * @property string $UNIT
 * @property string $BCFLAG
 * @property string $STDFLAG
 * @property string $DWFLAG
 * @property string $SZ
 * @property integer $ZSSL_SET
 * @property string $CLDE
 * @property string $CJDL
 * @property string $TSL
 * @property string $SPLB
 * @property string $TSFLAG
 * @property string $NOTE
 * @property integer $id
 */
class HSCodeTax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'HSCodeTax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ZSSL_SET', 'id'], 'integer'],
            [['CODE', 'ST_DATE', 'END_DATE', 'ZHCMCODE', 'NAME', 'DWCODE', 'UNIT', 'BCFLAG', 'STDFLAG', 'DWFLAG', 'SZ', 'CLDE', 'CJDL', 'TSL', 'SPLB', 'TSFLAG', 'NOTE'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CODE' => 'Code',
            'ST_DATE' => 'St  Date',
            'END_DATE' => 'End  Date',
            'ZHCMCODE' => 'Zhcmcode',
            'NAME' => 'Name',
            'DWCODE' => 'Dwcode',
            'UNIT' => 'Unit',
            'BCFLAG' => 'Bcflag',
            'STDFLAG' => 'Stdflag',
            'DWFLAG' => 'Dwflag',
            'SZ' => 'Sz',
            'ZSSL_SET' => 'Zssl  Set',
            'CLDE' => 'Clde',
            'CJDL' => 'Cjdl',
            'TSL' => 'Tsl',
            'SPLB' => 'Splb',
            'TSFLAG' => 'Tsflag',
            'NOTE' => 'Note',
            'id' => 'ID',
        ];
    }
}
