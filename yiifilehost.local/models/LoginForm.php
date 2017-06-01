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
class LoginForm extends Model
{
    public $login;
    public $password;

    private $_user = false;
    
    public function set_user($_user) {
        $this->_user = $_user;
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required']
        ];
    }

    public function login()
    {
        $this->getUser();
        if (!$this->hasErrors()) {
            return Yii::$app->user->login($this->_user, 0);
        }
        
        return false;
    }


    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByLogin($this->login);
            if ( !$this->_user || !$this->_user->validatePassword( $this->password ) ) {
                $this->addError('logerror', 'Не правильный логин или пароль');
            }
        }

        return $this->_user;
    }
}
