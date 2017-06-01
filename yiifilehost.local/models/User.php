<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $repassword;
    public $verifyCode;
    public $mode = 'edit';
    
    public function getFiles() {
        return $this->hasMany(Files::className(), [ 'account_id' => 'id' ]);
    }
    
    public static function getUser() {
        return Yii::$app->user->identity;
    }

    public static function tableName() {
        return 'users';
    }
    
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'middlename', 'lastname', 'email', 'login', 'password'], 'required'],
            [['repassword'], 'required', 'when' => function($model) {
                return $model->mode == 'add';
            }],
            [['name', 'middlename', 'lastname', 'email', 'phone', 'login', 'password', 'repassword'], 'string', 'max' => 255],
            [ 'email', 'email', 'message' => 'Неверный формат почты' ],
            [ 'email', 'checkEmail', 'message' => 'Email уже присутствует в системе' ],
            [ 'login', 'checkLogin', 'when' => function($model) {
                return $model->mode == 'add';
            }],
            [ 'repassword', 'compare', 'compareAttribute' => 'password'],
            ['verifyCode', 'captcha', 'when' => function($model) {
                return $model->mode == 'add';
            }],
        ];
    }
    
    public function checkEmail($attribute, $params) {
        $user = User::getUser();
        $result = self::findByEmail($this->$attribute);
        if ( $user != null ) {
            if ( !empty( $result ) && $user->oldAttributes['email'] != $this->$attribute) {
                $this->addError($attribute, 'Email уже присутствует в системе');
            }
        } else {
            if ( !empty( $result ) ) {
                $this->addError($attribute, 'Email уже присутствует в системе');
            }
        }
    }
    
    public function checkLogin($attribute, $params) {
        if (!preg_match('/^[a-zA-Z]+$/i', $this->$attribute)) {
            $this->addError($attribute, 'Не верный формат');
        } else {
            if (!empty(self::findByLogin($this->$attribute))) {
                $this->addError($attribute, 'Логин уже присутствует в системе');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'name' => 'Имя',
            'middlename' => 'Отчество',
            'lastname' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
            'login' => 'Логин',
            'password' => 'Пароль',
            'repassword' => 'Павторить пароль',
            'verifyCode' => 'Проверочный код',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }
    
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
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

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
