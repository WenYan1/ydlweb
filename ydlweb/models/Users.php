<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $name
 * @property string $foreign_currency
 * @property string $bank_name
 * @property integer $credi_limit
 * @property string $verify_code
 * @property string $customer_service
 * @property string $salt
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $username;

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
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'message' => '{attribute}不能为空'],
            [['email'], 'unique','message'=>'{attribute}已注册'],
            ['email', 'email','message'=>'{attribute}格式不正确'],
            //[['password'], 'string', 'min'=>8, 'max'=>16],
            /*[['phone', 'credi_limit', 'state', 'created_at', 'updated_at'], 'integer'],
            [['email', 'name'], 'string', 'max' => 30],
            [['password', 'verify_code', 'customer_service'], 'string', 'max' => 32],
            [['foreign_currency'], 'string', 'max' => 20],
            [['bank_name'], 'string', 'max' => 60],
            [['salt'], 'string', 'max' => 10]*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => '邮箱',
            'password' => '密码',
            'salt' => '附加码',
            'verify_code' => '激活码',
            'phone' => '手机号',
            'name' => 'Name',
            'foreign_currency' => 'Foreign Currency',
            'bank_name' => 'Bank Name',
            'credi_limit' => 'Credi Limit',
            'verify_code' => 'Verify Code',
            'customer_service' => 'Customer Service',
            'salt' => 'Salt',
            'state' => 'State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCompany() {
            return $this->hasOne(Companys::className(), ['user_id' => 'id']);
    }

    public function getCustomServer() {
            return $this->hasOne(AdminUsers::className(), ['id' => 'custom_service_id']);
    }

    public function addUser($data, &$message) {
            $model = new Users;
            $model->setAttributes($data, false);
            if($model->validate()) {
                    if($model->save()) {
                            $message = '注册成功';
                            return $model;
                    }else {
                            $message = '注册失败';
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

    public function emailVerify($token,&$message) {
            $user = self::find()->where(['verify_code' => $token])->one();
            if($user) {
                    return $user;
            } else {
                    $message = '验证码无效';
                    return false;
            }
    }

    public function findById($id) {
            return self::findOne($id);
    }

    public function resetPassword($password, $salt, $email, &$message)
    {
        $user = self::find()->where(['email'=>$email])->one();
        if($user) {
                $user->password = $password;
                $user->salt = $salt;
                $user->update();
                $message = '修改成功';
                return true;
            } else {
                $message = '修改失败';
                return false;
            }
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function findByEmail($email, &$message)
    {
        $user = self::find()->where(['email' => $email])->asArray()->one();

        if($user){
            return new static($user);
        } else {
            $message = '用户不存在';
            return false;
        }
    }

    public function editUserCredit($id, $money, &$message, &$lastCredit)
    {
        $user = self::find()->where(['id' => $id])->one();
        if ($user !== null) {
            if (($user->total_creditlimit -$user->credi_limit) < $money) {
                $user->credi_limit = $money - ($user->total_creditlimit - $user->credi_limit);
                $user->total_creditlimit = $money;
                $user->update();
                $lastCredit = $user->total_creditlimit;
                $message = '修改成功';
                return true;
            } else {
                $message = '授权额度小于当前已用额度';
                $lastCredit = $user->total_creditlimit;
                return false;
            }
        } else {
            $lastCredit = $user->total_creditlimit;
            $message = '修改失败';
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

}
