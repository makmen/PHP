<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $user;
    
    function __construct() {
        $this->user = User::getUser();
    }

    public function setParams() {
        $this->email = $this->user->email;
        $this->name = $this->user->name . ' ' . $this->user->lastname . ' ' . $this->user->middlename;
    }
    
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email', 'when' => function($model) {
                return $this->user == null;
            }],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'when' => function($model) {
                return $this->user == null;
            }],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Проверочный код',
        ];
    }

    public function contact($email)
    {
        $res = false;
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
           $res = true;
        }
        
        return $res;
    }
    
}
