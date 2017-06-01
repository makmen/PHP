<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\ChangeForm;
use app\models\ForgetForm;
use app\models\LoginForm;
use yii\filters\AccessControl;

class UserController extends AppController
{
    public $out = [ ];
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [ 'edit', 'change' ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex() // add
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->setMeta('Файл хостинг регистрация', 'файлы, заливка, сервер', 'Новые возможности, новые цены');
        $this->out['user'] = new User();
        $this->out['user']->mode = 'add';
        if ( $this->out['user']->load(Yii::$app->request->post()) ) {
            $loginForm = new LoginForm();
            $loginForm->set_user( $this->out['user'] );
            $this->out['user']->password = $this->out['user']->repassword = Yii::$app->getSecurity()->generatePasswordHash( $this->out['user']->password );
            if ( $this->saveModel($this->out['user'], 'Данные сохранены', 'Ошибка сохранения данных') ) {
                $loginForm->login();
                return $this->redirect(\yii\helpers\Url::home());
            }
       	}
        $this->out['user']->password = $this->out['user']->repassword =  '';
        
        return $this->render('index', [ 'out' => $this->out ]  );
    }
            
    public function actionEdit() // edit
    {
        $this->setMeta('Файл хостинг обновления данных', 'файлы, заливка, сервер', 'Новые возможности, новые цены');
        $this->out['user'] = Yii::$app->user->identity;
        if ( $this->out['user']->load( Yii::$app->request->post()) ) {
            $this->saveModel($this->out['user'], 'Данные обновлены', 'Ошибка обновления данных');
        }

        return $this->render('edit', [ 'out' => $this->out ]  );
    }
    
    public function actionForget() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->setMeta('Файл хостинг востановление данных', 'файлы, заливка, сервер', 'Новые возможности, новые цены');
        $this->out['forget'] = new ForgetForm();
        if ( $this->out['forget']->load(Yii::$app->request->post()) && $this->out['forget']->validate() ) {
            $this->out['user'] = User::findOne( ['email' => $this->out['forget']->email] );
            if ( $this->out['user'] != null ) {
                $this->out['password'] = Yii::$app->security->generateRandomString(5);
                Yii::$app->mailer->compose('forget', ['out' => $this->out])
                    ->setFrom(['andreymakas@inbox.ru' => 'filehost.local'])
                    ->setTo($this->out['forget']->email)
                    ->setSubject('Востановление пароля')
                    ->send();
                $this->out['user']->password = Yii::$app->getSecurity()->generatePasswordHash( $this->out['password'] );
                $this->saveModel($this->out['user'], 'Письмо отправлено, проверьте ваш почтовый ящик', 'Ошибка отправки почты');
                $this->out['forget']->verifyCode = '';
            } else {
                Yii::$app->session->setFlash('success', 'Письмо отправлено, проверьте ваш почтовый ящик');
            }
        }
        
        return $this->render('forget', [ 'out' => $this->out ]  );
    }
        
    public function actionChange() {
        $this->setMeta('Файл хостинг обновления данных', 'файлы, заливка, сервер', 'Новые возможности, новые цены');
        $this->out['change'] = new ChangeForm();
        if ( $this->out['change']->load(Yii::$app->request->post()) ) {
            if ( $this->out['change']->validate() ) {
                $user = User::getUser();
                $user->password = Yii::$app->getSecurity()->generatePasswordHash( $this->out['change']->passwordnew );
                $this->saveModel($user, 'Пароль изменен', 'Ошибка обновления данных');
                $this->out['change'] = new ChangeForm();
            }
       	}
        
        return $this->render('change', [ 'out' => $this->out ]  );
    }
    
    
    private function saveModel($model, $success, $error ) {
        if ( $model->save() ) {
            Yii::$app->session->setFlash('success', $success);
            return true;
        } else {
            Yii::$app->session->setFlash('error', $error);
        }
        
        return false;
    }
   
}
