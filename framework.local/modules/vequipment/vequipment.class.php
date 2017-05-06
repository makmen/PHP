<?php

class vequipment extends module {
    
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
        $this->out['vequipment'] = db::select('
            SELECT *, LEFT(content, 200) as shortcontent
            FROM vequipment 
            ORDER BY  created DESC
            LIMIT '. $offset .','.$this->out['onpage']
        );
        if (!empty($this->out['vequipment'])) {
            foreach($this->out['vequipment'] as $k=>$v) {
                $this->out['vequipment'][$k]['created'] = date("d-m-Y H:i:s", $v['created']);
                $this->out['vequipment'][$k]['price'] = number::formatPrice($v['price']);
            }
        }
        $total_stat = db::selectOne('SELECT COUNT(*) as cnt FROM vequipment');
        $this->out['total_stat'] = $total_stat['cnt'];
        $this->out['pagging'] = number::pagging($this->out['total_stat'], $this->out['onpage']);
    }
    
    public function view() {
        $this->out['vequipment'] = db::selectOne('
            SELECT *  FROM vequipment WHERE id = '.$this->id
        );
        if (!empty($this->out['vequipment'])) {
            $this->out['vequipment']['created'] = date("d-m-Y H:i:s", $this->out['vequipment']['created']);
            $this->out['vequipment']['content'] = explode("\r\n", $this->out['vequipment']['content']);
            $this->out['vequipment']['technical_data'] = explode("\r\n", $this->out['vequipment']['technical_data']);
            $this->out['vequipment']['composition'] = explode("\r\n", $this->out['vequipment']['composition']);
            if ($this->out['vequipment']['photo'] != '') {
                $this->out['vequipment']['photo'] = SERVER_ROOT."images/tmp/".$this->out['vequipment']['photo'];
            }
            $this->out['vequipment']['price'] = number::formatPrice($this->out['vequipment']['price']);
            $technical_data = array();
            foreach($this->out['vequipment']['technical_data'] as $k=>$v) {
                if (!empty($v)) {
                    $technical_data[] = "<li>" .$v. "</li>";
                }
            }
            $this->out['vequipment']['technical_data'] = implode("\r\n", $technical_data );
            $content = array();
            foreach($this->out['vequipment']['content'] as $k=>$v) {
                if (!empty($v)) {
                    $content[] = "<p>" .$v. "</p>";
                }
            }
            $this->out['vequipment']['content'] = implode("\r\n", $content );
            $composition = array();
            foreach($this->out['vequipment']['composition'] as $k=>$v) {
                if (!empty($v)) {
                    $composition[] = "<li>" .$v. "</li>";
                }
            }
            $this->out['vequipment']['composition'] = implode("\r\n", $composition );

            $this->out['powers'] = db::select('
                SELECT 
                    `power`.`id`, `power`.`title`, vacuum_power.`idvacuum`
                FROM 
                    vacuum_power INNER JOIN `power` ON vacuum_power.idpower = `power`.id
                WHERE idvacuum =\''.$this->out['vequipment']['id'].'\''
            );
        }
    }
    
    public function edit() {
        if ($_SESSION['group'] != 1) {
            $this->out['noAccess'] = 1;
            return false;
        }
        $vequipment = db::selectOne('Select * from vequipment where id =\''.$this->out['id'].'\'');
        if (empty($vequipment)) { 
            $this->out['noAccess'] = 1;
            return false;
        }
        foreach ($vequipment as $k => $v) {
            $this->out[$k] = $v; 
        }
        $powers = db::select('SELECT * FROM vacuum_power where idvacuum =\''.$this->out['id'].'\'');
        if (!empty($powers)) {
            foreach($powers as $k=>$v) {
                $this->out['powers'][] = $v['idpower'];
            }
        } 
        else {
            $this->out['powers'] = array();
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
                $this->out['powers'] = array();
        }
        $this->out['allpowers'] = db::select('SELECT * FROM power');
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $vequipment[$k] = text::safe($v); 
            }
            unset($vequipment['powers']);
            if (count($_POST['powers']) > 0) {
                $this->out['powers'] = array();
                foreach($_POST['powers'] as $k => $v) {
                    $this->out['powers'][$k] = (int)$v;
                }
            } else {
                $this->out['errs']['powers']= "Не выбран источник питания";
            }
            $this->checkData(&$vequipment);
            if (!isset($vequipment['errs'])) {
                    $vequipment['account_id'] = $_SESSION['account_id'];
                    if ($this->out['mode'] =='add') {
                        $vequipment['created'] = time();
                        $res = db::insert('vequipment', $vequipment);
                    } else {
                        $vequipment['id'] = $this->out['id'];
                        $vequipment['created'] = $this->out['created'];
                        $res = db::update('vequipment', $vequipment);
                    }
                    if ($res) {
                        $vacuumPower = array();
                        if ($this->out['mode'] == 'add') {
                            $vacuumPower['idvacuum'] = $res;
                        } else {
                            $vacuumPower['idvacuum'] = $vequipment['id'];
                            db::execute('DELETE FROM vacuum_power WHERE idvacuum = '.$vequipment['id']);
                        }
                        foreach($this->out['powers'] as $k => $v) {
                            $vacuumPower['idpower'] = $v;
                            $res = db::insert('vacuum_power', $vacuumPower);
                            if ($res === FALSE) {
                                    break;
                            }
                        }
                        if ($res !== FALSE) {
                            request::redirect(SERVER_ROOT.$this->out['module']);
                        } else {
                            $vequipment['errs']['message'] = "Ошибка записи в базу данных"; 
                        }
                    } else {
                        $vequipment['errs']['message'] = "Ошибка записи в базу данных"; 
                    }
            }
            foreach ($vequipment as $k => $v) {
                $this->out[$k] = $v; 
            }
        }
    }
    
    public function checkData($vequipment) {
        if (trim($vequipment['title']) == '') {
            $vequipment['errs']['title']= "Поле не должно быть пустым";
        }
        if (trim($vequipment['content']) == '') {
            $vequipment['errs']['content']= "Поле не должно быть пустым";
        }
        if (trim($vequipment['price']) == '') {
            $vequipment['errs']['price']= "Поле не должно быть пустым";
        } elseif (!preg_match('/^([0-9]+(?:\.[0-9]*)?)$/i', $vequipment['price'])) {
            $vequipment['errs']['price']= "Непрвильный формат данных";
        }
        if (trim($vequipment['composition']) == '') {
            $vequipment['errs']['composition']= "Поле не должно быть пустым";
        }
        if (trim($vequipment['technical_data']) == '') {
            $vequipment['errs']['technical_data']= "Поле не должно быть пустым";
        }
        if (trim($vequipment['photo']) == '') {
            $vequipment['errs']['photo']= "Загрузите изображение";
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

