<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ForgetForm extends Model
{
    public $email;
    public $verifyCode;

    public function attributeLabels()
    {
        return [
            'email' => 'Ваш email',
            'verifyCode' => 'Проверочный код',
        ];
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'required'],
            [ 'email', 'email', 'message' => 'Неверный формат почты' ],
            ['verifyCode', 'captcha'],
        ];
    }

}
