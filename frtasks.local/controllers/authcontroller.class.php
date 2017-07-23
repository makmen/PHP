<?php

class AuthController extends Controller {

    public function actionIndex() {
        if ($this->auth_user) {
            $this->redirect( Config::SERVER_NAME );
        }
        $this->title = "Вход в личный кабинет";
        $this->meta_desc = "Вход в личный кабинет";
        $this->meta_key = "Вход в личный кабинет";
        $this->out['titlePage'] = "Вход в личный кабинет";

        if ( Request::$requestMethodPost ) {
            $result = false;
            if ( isset($_REQUEST["auth_login"]) && isset($_REQUEST["auth_password"])) {
                $result = User::check($_REQUEST["auth_login"], $_REQUEST["auth_password"] );
            }
            if ($result) {
                $this->redirect( Config::SERVER_NAME );
            }
            $this->out['loginError'] = $this->message->get("ERROR_AUTH_USER");
        }

        $this->render("auth/index");
    }
    
    public function actionRegister() {
        $this->title = "Регистрация пользователя";
        $this->meta_desc = "Регистрация пользователя";
        $this->meta_key = "Регистрация пользователя";
        $this->out['titlePage'] = "Регистрация пользователя";
        
        $denied = User::accessDenied( 'ADD_USER' );
        if ( $this->auth_user && $denied ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        $this->out['canWordWithUsers'] = ($this->auth_user) ? !$denied : false;
        if ($this->out['canWordWithUsers']) {
            $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        }
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);
        
        $this->out['user'] = new User();
        $this->out['roles'] = Role::getAllRoles();
        
        if ( Request::$requestMethodPost ) {
            $this->out['user']->loadModel($_REQUEST);
            $this->out['user']->role_id = ($this->out['canWordWithUsers']) ? 
                ( (isset($_REQUEST['role'])) ? (int)$_REQUEST['role'] : Role::$roleDefault )
                : Role::$roleDefault;

            if ($this->out['canWordWithUsers']) {
                $this->out['user']->validateDenied = array("captcha");
            }

            $this->out['user']->loadModel($_REQUEST);
            $result = $this->out['user']->save();
            if ($result) {
                if ($this->out['canWordWithUsers']) {
                    $this->redirect( URL::buildUrl(URL::$controller, 'view') );
                } else {
                    $user = $this->out['user']->toRequiredArray();
                    $user['role_name'] = $this->out['roles'][$this->out['user']->role_id]['name'];
                    User::setAuthUser( $user );
                    $this->redirect( Config::SERVER_NAME );
                }
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['user']->getErrors() );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
        }
        $this->render("auth/register");
    }
    
    public function actionEdit() {
        $this->title = "Редактирования данных пользователя";
        $this->meta_desc = "Редактирования данных пользователя";
        $this->meta_key = "Редактирования данных пользователя";
        $this->out['titlePage'] = "Редактирования данных пользователя";

        if (!$this->auth_user) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }

        $id = (int)URL::$id;
        $id = ($id) ? $id :  $this->auth_user['id'];

        $this->out['canWordWithUsers'] = false;
        $this->out['owner'] = false;
        
        $denied = User::accessDenied( 'EDIT_ALL_USERS' );
        if (!$denied) {
            $this->out['canWordWithUsers'] = true;
        }
            
        if ($id == $this->auth_user['id']) {
            $user = $this->auth_user;
            $this->out['owner'] = true;
        } else {
            if ( $denied ) {
                $this->accessDenied();
                throw new Exception("ACCESS_DENIED");
            }
            $user = User::getUser($id);
        }
        if ( !$user ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        if ($this->out['canWordWithUsers']) {
            $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        }
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);
        
        $this->out['roles'] = Role::getAllRoles();
        $this->out['user'] = new User();
        $this->out['user']->loadModel($user, $id);
        
        if ( Request::$requestMethodPost ) {
            $this->out['user']->fieldsDenied = array("role");
            if (!$this->out['owner']) {
                $this->out['user']->fieldsDenied = array_merge(
                    $this->out['user']->fieldsDenied, array ("password", "repassword")
                );
            }
            $this->out['user']->loadModel($_REQUEST, $this->out['user']->getId());
            if ($this->out['canWordWithUsers']) {
                $this->out['user']->role_id = ( (isset($_REQUEST['role'])) ? (int)$_REQUEST['role'] : Role::$roleDefault );
            }
            $this->out['user']->validateDenied = array("captcha");
            if (!$this->out['owner']) {
                $this->out['user']->validateDenied = array_merge(
                    $this->out['user']->validateDenied, array ("password", "repassword")
                );
            }
            if ( $this->out['user']->save() ) {
                if ( $id == $this->auth_user['id'] ) {
                    $user = $this->out['user']->toRequiredArray();
                    $user['role_name'] = $this->out['roles'][$this->out['user']->role_id]['name'];
                    User::setAuthUser( $user );
                    $this->out['ok'] = 'Данные обновлены';
                } else {
                    $this->redirect( URL::buildUrl(URL::$controller, 'view') );
                }
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['user']->getErrors() );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
        }

        $this->render("auth/register");
    }
    
    public function actionView() {
        $this->title = "Пользователи системы";
        $this->meta_desc = "Пользователи системы";
        $this->meta_key = "Пользователи системы";
        $this->out['titlePage'] =  "Пользователи системы";
        
        if ( User::accessDenied( 'VIEW_ALL_USERS' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        if ( !User::accessDenied( 'ADD_USER' ) ) {
            $this->out['canAdd'] = true;
        }
        if ( !User::accessDenied( 'EDIT_ALL_USERS' ) ) {
            $this->out['canEdit'] = true;
        }
        $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        
        $this->out['pagination'] = $this->getPagination(User::getCount(), Config::COUNT_USERS_ON_PAGE, URL::$currentUrl);
        $this->out['users'] = User::getAllUserRoles( $this->out['pagination'] );

        $this->render("auth/view");
    }


    public function actionForget() {
        if ($this->auth_user) {
            $this->redirect( Config::SERVER_NAME );
        }
        $this->title = "Востановление пароля";
        $this->meta_desc = "Востановление пароля";
        $this->meta_key = "Востановление пароля";
        $this->out['titlePage'] =  "Востановление пароля";
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);

        if ( Request::$requestMethodPost ) {
            $this->out['forget'] = new forgetForm($_REQUEST);
            $this->out['forget']->validate();
            if ( count($this->out['forget']->errors) == 0) {
                // send a message
                $user = User::getUserByEmail($this->out['forget']->email);
                $result = true;
                if ($user) {
                    $this->out['user'] = new User();
                    $this->out['user']->loadModel($user, $user['id']);
                    $password = $this->out['user']->password = Captcha::getNumberString( mt_rand(5, 7) );
                    $this->out['user']->validateDenied = array( "captcha", "password", "repassword" );
                    $result = $this->out['user']->save();
                    if ($result) {
                        $this->out['forget']->email = "";
                        $this->out['user']->password = $password;
                        $result = $this->mail->send(
                            $this->out['user']->email, array( "user" => $this->out['user'] ), "forget"
                        );
                        if (!$result) {
                            $this->out['error'] = 'Ошибка отправки письма';
                        }
                    }
                }
                
                if ($result) {
                    $this->out['ok'] = 'Письмо отправлено';
                }
                
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['forget']->errors );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
        }
        
        $this->render("auth/forget");
    }
    
    public function actionLogout() {
        session_destroy();
        $this->redirect( Config::SERVER_NAME );
    }
    
    
}
