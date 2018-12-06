<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject','email'], 'safe'],
            // email has to be a valid email address
            //['email', 'email'],
            // verifyCode needs to be entered correctly
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            //'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email,$emailView,$viewData)
    {
            Yii::$app->mailer->compose($emailView,$viewData)
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->send();

            return true;
    }
}

/*Yii::$app->mailer->compose('email_verify',['email'=>$email,'verifyCode'=>$verifyCode])
                                                ->setFrom('service@beforeship.com')
                                                ->setTo($email)
                                                ->setSubject('ZETY邮箱验证')
                                                ->send();*/
