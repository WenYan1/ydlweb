<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ForgetPasswordForm extends Model
{
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['verifyCode', 'required', 'message'=>'验证码不能为空'],
            ['verifyCode', 'captcha','message'=>'验证码不正确', 'captchaAction'=>'forget-password/captcha']
        ];
    }

   
}
