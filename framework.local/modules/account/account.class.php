<?php

class account extends module {
    
    public function __construct() {
        parent::__construct();
        $this->run();
    }
    
    public function run() {
        if ($this->template != '' && @method_exists($this, $this->template)) {
            call_user_func(array($this, $this->template));
        } else {
            parent::defaultTemplate('register');
            $this->run();
        }
    }
    
    public function edit() {
        if (!isset($_SESSION['login'])) {
            $this->out['noAccess'] = 1;
            return false;
        }
        $accounts = db::selectOne('Select * from accounts where login =\''.$_SESSION['login'].'\'');
        if (empty($accounts)) { 
            $this->out['noAccess'] = 1;
            return false;
        }
        foreach ($accounts as $k => $v) {
            $this->out[$k] = $v; 
        }
        $this->out['mode'] = 'edit';
        $this->register();
    }
    
    public function register() { 
        if (isset($_SESSION['reg_ok'])) {
            $this->out['reg_ok'] = 1;
            unset($_SESSION['reg_ok']);
        }
        if (!isset($this->out['mode'])) {
            $this->out['mode'] = 'add';
        }
        if (!isset($this->out['reg_ok'])) {
            if (isset($_SESSION['group']) && ($_SESSION['group'] != 1) && $this->out['mode'] == 'add') {
                $this->out['noAccess'] = 1;
                return false;
            }
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $register[$k] = text::safe($v); 
            }
            if ($this->out['mode'] == 'edit') {
                $register['id'] = $this->out['id'];
            }

            $this->checkUser(&$register, $this->out['mode']);
            if (!isset($register['errs'])) {
                if ($this->out['mode'] =='add') {
                    $register['group'] = isset($_SESSION['login']) ? 1 : 2;
                    $register['pass'] = sha1($register['pass']);
                    unset($register['key']);
                    unset($register['repass']);
                    $res = db::insert('accounts', $register);
                } else {
                    $res = db::update('accounts', $register);
                }
                if ($res) {
                    $_SESSION['reg_ok'] = 1;
                    if ($_SESSION['group'] != 1) {
                        if ($this->out['mode'] =='add') {
                            $_SESSION['login'] = $register['login'];
                            $_SESSION['group'] = $register['group'];
                            $_SESSION['account_id'] = $res;
                        }
                        $_SESSION['name'] = $register['name'];
                        $_SESSION['middlename'] = $register['middlename'];
                        $_SESSION['lastname'] = $register['lastname'];
                    }
                    request::redirect(SERVER_ROOT.$this->out['module']."/".$this->out['template']);
                } else {
                    $register['errs']['message'] = "Ошибка записи в базу данных"; 
                }
            } else {
                $register['pass'] = "";
                $register['repass'] = "";
            }
            foreach ($register as $k => $v) {
                $this->out[$k] = $v; 
            }
        }
    }
    
    function checkUser($register, $mode) {
        if (trim($register['name']) == '') {
            $register['errs']['name']= "Поле не должно быть пустым";
        }
        if (trim($register['lastname']) == '') {
            $register['errs']['lastname']= "Поле не должно быть пустым";
        }
        if (trim($register['middlename']) == '') {
            $register['errs']['middlename']= "Поле не должно быть пустым";
        }
        if (trim($register['email'])=='') { 
            $register['errs']['email']= "Поле не должно быть пустым";
        } elseif (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $register['email'])) {
            $register['errs']['email']= "Неверный адрес";
        } else {
            if ($mode == 'add') {
                $sql = db::select("SELECT id FROM accounts WHERE email = '" . $register['email']."'");
            } else {
                $sql = db::select("SELECT id FROM accounts WHERE email = '" . $register['email']."' AND id != ".$register['id']);
            }
            if (!empty($sql)) {
                $register['errs']['email']= "Email уже присутствует в системе";
            }
        }
        if ($mode == 'add') {
            if (trim($register['login'])=='') {
                $register['errs']['login']= "Поле не должно быть пустым";
            } elseif (!preg_match('/^[a-zA-Z]+$/iu', $register['login'])) {
                $register['errs']['login']= "Только латинские буквы";
            } else {
                $sql = db::select("SELECT id FROM accounts WHERE login = '" . $register['login']."'");
                if (!empty($sql)) {
                    $register['errs']['login']= "Имя уже присутствует в системе";
                }
            }
            if (trim($register['pass']) == '') {
                $register['errs']['pass']= "Поле не должно быть пустым";
            }
            if (trim($register['repass']) == '') {
                $register['errs']['repass']= "Поле не должно быть пустым";
            }
            if (!isset($register['errs']['pass']) && !isset($register['errs']['repass'])) {
                if ($register['pass'] != $register['repass']) {
                    $register['errs']['pass']= "Пароли должны совпадать";
                    $register['errs']['repass']= "Пароли должны совпадать";
                }
            }
            if (!isset($_SESSION['group'])) {
                if (trim($register['key']) == '') {
                    $register['errs']['key']= "Поле не должно быть пустым";
                } else if ($register['key'] != $_SESSION['captcha']) {
                    $register['errs']['key'] = "Символы введены не верно";
                }
                unset($_SESSION['captcha']);//Уничтажаем переменную
            }
        }
    }
    
    public function changepassword() {
        if (!isset($_SESSION['group'])) {
            $this->out['noAccess'] = 1;
            return false;
        }
        if (isset($_SESSION['reg_ok'])) {
            $this->out['reg_ok'] = 1;
            unset($_SESSION['reg_ok']);
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $password[$k] = text::safe($v); 
            }
            if (trim($password['oldpass']) == '') {
                $password['errs']['oldpass']= "Поле не должно быть пустым";
            } else {
                $sql = db::select("SELECT id FROM accounts WHERE login = '" . $_SESSION['login']."' AND pass = '".sha1($password['oldpass'])."'");
                if (empty($sql)) {
                    $password['errs']['oldpass']= "Не верный пароль";
                }
            }
            // дальнейшая проверка не имеет смысла
            if (!isset($password['errs'])) {
                if (trim($password['pass']) == '') {
                    $password['errs']['pass']= "Поле не должно быть пустым";
                }
                if (trim($password['repass']) == '') {
                    $password['errs']['repass']= "Поле не должно быть пустым";
                }
                if (!isset($password['errs']['pass']) && !isset($password['errs']['repass'])) {
                    if ($password['pass'] != $password['repass']) {
                        $password['errs']['pass']= "Пароли должны совпадать";
                        $password['errs']['repass']= "Пароли должны совпадать";
                    }
                }
            } else {
                $password['pass'] = $password['repass'] = "";
            }
            if (!isset($password['errs'])) {
                $res = db::execute("UPDATE accounts SET  pass='".sha1($password['pass'])."' WHERE login = '" . $_SESSION['login']."'");
                if ($res) {
                    $_SESSION['reg_ok'] = 1;
                    request::redirect(SERVER_ROOT.$this->out['module']."/".$this->out['template']);
                } else {
                    $password['errs']['message'] = "Ошибка записи в базу данных"; 
                }
            }
            foreach ($password as $k => $v) {
                $this->out[$k] = $v; 
            }
        }
    }
    
    public function restorepassword() {
        if (isset($this->id)) {
            $sql = db::selectOne("
                SELECT * FROM accounts
                WHERE activation = '" .$this->id. "'
            ");
            if (!empty($sql)) {
                $newPassword = number::getNumberString(6);
                $message = "Новый пароль: ".$newPassword;
                $mail = new mailer(); 
                $mail->CharSet="utf-8";
                $mail->ContentType="text/html";
                $mail->Encoding="quoted-printable";
                $mail->Subject='Обратная связь';
                $mail->Body = $message;
                $mail->AddAddress($sql['email']);
                $mess=$mail->Send();
                if ($mess) {
                    $this->out['restore'] = true;
                    db::execute("UPDATE accounts SET activation = NULL, pass='".sha1($newPassword)."' WHERE id = " . $sql['id']);
                }
            }
        }
    }
    
    public function forget() {
        if (isset($_SESSION['group'])) {
            $this->out['noAccess'] = 1;
            return false;
        }
        if (isset($_SESSION['reg_ok'])) {
            $this->out['reg_ok'] = 1;
            unset($_SESSION['reg_ok']);
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $forget[$k] = text::safe($v); 
            }
            if (trim($forget['email'])=='') { 
                $forget['errs']['email']= "Поле не должно быть пустым";
            } else {
                if (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $forget['email'])) {
                    $forget['errs']['email']= "Неверный адрес";
                }
            }
            if ($forget['key'] != $_SESSION['captcha']){
                $forget['errs']['key'] = "Символы введены не верно";
            }
            if (!isset($forget['errs'])) {
                $activation = number::getNumberString(8);
                $this->out['link'] = SERVER_ROOT.$this->out['module'].'/restorepassword'.'/'.$activation;
                $message = $this->createFromTemplate('account/forgetemail.tpl');
                // берем учётку
                $sql = db::selectOne("
                    SELECT * FROM accounts
                    WHERE email = '" .$forget['email']. "'
                ");
                if (!empty($sql)) {
                    db::execute("UPDATE accounts SET activation = '" . $activation. "' WHERE id = " . $sql['id']);
                }
                $mail = new mailer(); 
                $mail->CharSet="utf-8";
                $mail->ContentType="text/html";
                $mail->Encoding="quoted-printable";
                $mail->Subject='Обратная связь';
                $mail->Body = $message;
                $mail->AddAddress($forget['email']);
                $mess=$mail->Send();
                if ($mess) {
                    $_SESSION['reg_ok'] = 1;
                    request::redirect(SERVER_ROOT.$this->out['module']."/".$this->out['template']);
                } else {
                    $forget['errs']['sendError']= "Письмо не отправлено, сайт перегружен, зайдите позже";
                }
            }
            foreach ($forget as $k => $v) {
                $this->out[$k] = $v; 
            }
        }
    }
    
    public function makecaptcha() {
        header("Content-type: image/png");
        $image_x = 200;
        $image_y = 50;
        $symbol_min_angle = -45;
        $symbol_max_angle = 45;  
        $symbol_min_size = 18;
        $symbol_max_size = 20;
        
        $limitFonts = 5;
        $symbol_fonts = array();
        $font = DOC_ROOT.'font'.DIRECTORY_SEPARATOR;
        for($i = 1; $i <= $limitFonts; $i++) {
            $symbol_fonts[] = $font."load" . $i . ".ttf";
        }
        $text = number::getNumberCaptaha(5);
        $_SESSION["captcha"] = $text;
        $im = imagecreatetruecolor($image_x, $image_y);
        $backgroundcolor = imagecolorallocate( $im, 255 , 255 , 255 );
        imagefill($im, 0, 0, $backgroundcolor);
        // Текст
        $sx=0;
        $step=round($image_x/(strlen($text)+2));
        for($i=0;$i<strlen($text);$i++) {
            $symb = $text[$i];  
            $sx += $step+(rand(-round($step/5),round($step/5)));
            $sy = $image_y-round($image_y/3)+rand(-round($image_y/5),round($image_y/5));
            $sa = rand($symbol_min_angle,$symbol_max_angle);
            $ss = rand($symbol_min_size,$symbol_max_size);
            $sf = $symbol_fonts[rand(0, $limitFonts - 1)];
            $sc = imagecolorallocate($im, 50 + rand(-50,50), 50 + rand(-50,50), 50 + rand(-50,50));
            imagettftext($im, $ss, $sa, $sx, $sy, $sc, $sf, $symb);
        }
        // Линии
        $lines_count = rand(5, 8);
        for ($i=0;$i<$lines_count;$i++) {
            $st_x = rand(0,$image_x);
            $st_y = rand(0,$image_y);
            $en_x = rand(0,$image_x);
            $en_y = rand(0,$image_y);
            $lc = imagecolorallocate($im, 100 + rand(-100,100), 100 + rand(-100,100), 100 + rand(-100,100));
            //цвет
            imageline($im, $st_x, $st_y, $en_x, $en_y, $lc);
        }
        imagepng($im);
        imagedestroy($im);
    }

    public function check() {
        if ($_POST['logIn'] == 1) {
            if (!empty($_POST)) {
                $login = text::safe($_POST['formlogin']);
                $password = text::safe($_POST['formpassword']);
                if ($login == '' && $password == '') {
                    return true;
                }
                $row = db::selectOne('Select * from accounts where login =\''.$login.'\' and pass =\''.sha1($password).'\'');
                // если user в базе существует входим
                if (!empty($row))
                {
                    $_SESSION['login'] = $login;
                    $_SESSION['group'] = $row['group'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['middlename'] = $row['middlename'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['account_id'] = $row['id'];
                    if ($this->out['module'] != '') {
                        request::redirect(SERVER_ROOT.$this->out['module']."/".$this->out['template']);
                    } else {
                        request::redirect(SERVER_ROOT);
                    }
                } 
                else $this->out['checkfalse'] = true;
            } 
        }
    }
    
    public function checkmail() {
        if (isset($_POST['email'])) {
            $answer = "ok";
            $email = text::safe($_POST['email']);
            if (trim($email) == '') { 
                $answer = "Поле не должно быть пустым";
            } elseif (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $email)) {
                $answer = "Неверный адрес";
            } else {
                $sql = db::select("SELECT id FROM accounts WHERE email = '" . $email."'");
                if (!empty($sql)) {
                    $answer = "Email уже присутствует в системе";
                }
            }
            echo $answer;
        }
    }
    
    public function logout() {
        session_destroy();
        request::redirect(SERVER_ROOT);
    }
    
}

