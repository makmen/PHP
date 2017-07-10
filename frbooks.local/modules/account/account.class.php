<?php

class account extends module {
    
    public function __construct($template, $id) {
        parent::__construct(get_class(), $template, $id);
    }
    
    public function run() {
        if ($this->template != '' && @method_exists($this, $this->template)) {
            call_user_func(array($this, $this->template));
        } else {
            $this->template = 'add';
            $this->run();
        }
    }

    public function check() {
        if ($_POST['logIn'] == 1) {
            if (!empty($_POST)) {
                $login = text::safe($_POST['formlogin']);
                $password = text::safe($_POST['formpassword']);
                if ($login == '' && $password == '') {
                    return true;
                }
                $row = db::selectOne('Select * from accounts where login =\''.$login.'\' and password =\''.sha1($password).'\'');
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
    
    public function edit() {
        $this->out['title'] = "Редактирование пользователя";
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
        $this->add();
    }
    
    public function add() {
        $this->out['title'] = "Зарегистировать пользователя";
        if (isset($_SESSION['reg_ok'])) {
            $this->out['reg_ok'] = 1;
            unset($_SESSION['reg_ok']);
        }
        if (!isset($this->out['mode'])) {
            $this->out['mode'] = 'add';
        }
        if (!isset($this->out['reg_ok'])) {
            if (isset($_SESSION['login']) && $this->out['mode'] == 'add') {
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
                unset($register['imageField']);
                if ($this->out['mode'] =='add') {
                    $register['group'] = 1;
                    $register['password'] = sha1($register['password']);
                    unset($register['key']);
                    unset($register['repass']);
                    $res = db::insert('accounts', $register);
                } else {
                    $res = db::update('accounts', $register);
                }
                $register['password'] = "";
                if ($res) {
                    $_SESSION['reg_ok'] = 1;
                    if ($this->out['mode'] =='add') {
                        $_SESSION['login'] = $register['login'];
                        $_SESSION['group'] = $register['group'];
                        $_SESSION['account_id'] = $res;
                    }
                    $_SESSION['name'] = $register['name'];
                    $_SESSION['middlename'] = $register['middlename'];
                    $_SESSION['lastname'] = $register['lastname'];

                    request::redirect(SERVER_ROOT.$this->out['module']."/".$this->out['template']);
                } else {
                    $register['errs']['message'] = "Ошибка записи в базу данных"; 
                }
            } else {
                $register['password'] = "";
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
            if (trim($register['password']) == '') {
                $register['errs']['password']= "Поле не должно быть пустым";
            }
            if (trim($register['repass']) == '') {
                $register['errs']['repass']= "Поле не должно быть пустым";
            }
            if (!isset($register['errs']['password']) && !isset($register['errs']['repass'])) {
                if ($register['password'] != $register['repass']) {
                    $register['errs']['password']= "Пароли должны совпадать";
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
    
    public function logout() {
        session_destroy();
        request::redirect(SERVER_ROOT);
    }
    

    
}

