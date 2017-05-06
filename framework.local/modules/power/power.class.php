<?php

class power extends module {
    
    public function __construct() {
        parent::__construct();
        $this->run();
    }
    
    public function run() {
        if ($this->template != '' && @method_exists($this, $this->template)) {
            call_user_func(array($this, $this->template));
        } else {
            parent::defaultTemplate('all');
            $this->run();
        }
    }
    
    public function all() {
        $this->out['onpage'] = $this->options['onpage'];
        $p = (int)$_GET['p'];
        $offset = ($p > 0) ? ($p - 1)*$this->out['onpage'] : 0;
        $this->out['page'] = ($p > 0) ? $p : 1;
        $this->out['power'] = db::select('
            SELECT *, LEFT(content, 300) as shortcontent
            FROM power 
            ORDER BY  created DESC
            LIMIT '. $offset .','.$this->out['onpage']
        );
        if (!empty($this->out['power'])) {
            foreach($this->out['power'] as $k=>$v) {  
                $this->out['power'][$k]['created'] = date("d-m-Y H:i:s", $v['created']);
                $this->out['power'][$k]['price'] = number::formatPrice($v['price']);
            }
        }
        $total_stat = db::selectOne('SELECT COUNT(*) as cnt FROM power');
        $this->out['total_stat'] = $total_stat['cnt'];
        $this->out['pagging'] = number::pagging($this->out['total_stat'], $this->out['onpage']);
    }
    
    public function view() {
        $this->out['power'] = db::selectOne('
            SELECT *  FROM power WHERE id = '.$this->out['id']
        );
        if (!empty($this->out['power'])) {
            $this->out['power']['created'] = date("d-m-Y H:i:s", $this->out['power']['created']);
            $this->out['power']['content'] = explode("\r\n", $this->out['power']['content']);
            $this->out['power']['technical_data'] = explode("\r\n", $this->out['power']['technical_data']);
            if ($this->out['power']['photo'] != '') {
                $this->out['power']['photo'] = SERVER_ROOT."images/tmp/".$this->out['power']['photo'];
            }
            $this->out['power']['price'] = number::formatPrice($this->out['power']['price']);
            $technical_data = array();
            foreach($this->out['power']['technical_data'] as $k=>$v) {
                if (!empty($v)) {
                    $technical_data[] = "<li>" .$v. "</li>";
                }
            }
            $this->out['power']['technical_data'] = implode("\r\n", $technical_data );
            $content = array();
            foreach($this->out['power']['content'] as $k=>$v) {
                if (!empty($v)) {
                    $content[] = "<p>" .$v. "</p>";
                }
            }
            $this->out['power']['content'] = implode("\r\n", $content );
        }
    }
    
    public function edit() {
        if ($_SESSION['group'] != 1) {
            $this->out['noAccess'] = 1;
            return false;
        }
        $power = db::selectOne('Select * from power where id =\''.$this->out['id'].'\'');
        if (empty($power)) { 
            $this->out['noAccess'] = 1;
            return false;
        }
        foreach ($power as $k => $v) {
            $this->out[$k] = $v; 
        }
        $this->out['mode'] = 'edit';
        $this->add();
    }

    public function add() {
        if ($_SESSION['group'] != 1) {
            $this->out['noAccess'] = 1;
            return false;
        }
        if (!isset($this->out['mode'])) {
            $this->out['mode'] = 'add';
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $power[$k] = text::safe($v); 
            }
            $this->checkData(&$power);
            if (!isset($power['errs'])) {
                $power['account_id'] = $_SESSION['account_id'];
                if ($this->out['mode'] =='add') {
                    $power['created'] = time();
                    $res = db::insert('power', $power);
                } else {
                    $power['id'] = $this->out['id'];
                    $power['created'] = $this->out['created'];
                    $res = db::update('power', $power);
                }
                if ($res) {
                    request::redirect(SERVER_ROOT.$this->out['module']);
                } else {
                    $power['errs']['message'] = "Ошибка записи в базу данных"; 
                }
            }
            foreach ($power as $k => $v) {
                $this->out[$k] = $v; 
            }
        }
    }
    
    public function checkData($power) {
        if (trim($power['title']) == '') {
            $power['errs']['title']= "Поле не должно быть пустым";
        }
        if (trim($power['content']) == '') {
            $power['errs']['content']= "Поле не должно быть пустым";
        }
        if (trim($power['price']) == '') {
            $power['errs']['price']= "Поле не должно быть пустым";
        } elseif (!preg_match('/^([0-9]+(?:\.[0-9]*)?)$/i', $power['price'])) {
            $power['errs']['price']= "Непрвильный формат данных";
        }
        if (trim($power['technical_data']) == '') {
            $power['errs']['technical_data']= "Поле не должно быть пустым";
        }
        if (trim($power['photo']) == '') {
            $power['errs']['photo']= "Загрузите изображение";
        }
    }
    
    public function loader() {
        $uploaddir = DOC_ROOT . "images/tmp/";
        $imgExt = array('gif','png','jpg','jpeg','bmp');
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $ext = strtolower(end(explode(".", $_FILES['userfile']['name'])));
        if (!in_array($ext, $imgExt)) {
            $err = "Тип файла " . $ext . " не поддерживается";
        } elseif($_FILES['userfile']['size'] > 1048576) {
            $err = "Файл больше 1Мб";
        } elseif (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $err = "Ошибка копирования файла";
        } else {
            // переименовываем файл
            $newFile = rand(9999, 99999) ."(" . time() . ").".$ext;
            rename($uploadfile,  $uploaddir . $newFile);
        }
        if (isset($err)) {
            echo $err.";;;;;";
        } else {
            echo $newFile.";;;;;";
        }
    }

    
}

