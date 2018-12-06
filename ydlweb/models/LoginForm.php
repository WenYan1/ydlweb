<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $verifyCode;
    /*public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;*/


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['verifyCode', 'required', 'message'=>'验证码不能为空'],
            ['verifyCode', 'captcha','message'=>'验证码不正确', 'captchaAction'=>'login/captcha'],
        ];
    }

    public function validateVerifyCode($param,&$message) {
            $model = new LoginForm;
            $model->verifyCode = $param;

            if($model->validate()) {
                    $message = '验证成功';
                    return true;
            } else {
                    $errors = $model->errors;
                    foreach($errors as $val) {
                            $message = $val[0];
                            break;
                    }
                    return false;
            }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    /*public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }*/


}
