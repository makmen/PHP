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
class ChangeForm extends Model
{
    public $passwordold;
    public $passwordnew;
    public $repasswordnew;

    public function attributeLabels()
    {
        return [
            'passwordold' => 'Старый пароль',
            'passwordnew' => 'Новый пароль',
            'repasswordnew' => 'Повторить пароль',
        ];
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['passwordold', 'passwordnew', 'repasswordnew' ], 'required'],
            [['passwordold', 'passwordnew', 'repasswordnew'], 'string', 'max' => 255],
            ['repasswordnew', 'compare', 'compareAttribute' => 'passwordnew'],
            ['passwordold', 'checkPassword'],
        ];
    }
    
    public function checkPassword($attribute, $params) {
        if ( !User::getUser()->validatePassword($this->$attribute) ) {
            $this->addError($attribute, 'Не верный пароль');
        }
    }

}
