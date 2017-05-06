<?php

class news extends module {
    
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
        $this->out['news'] = db::select('
            SELECT *, LEFT(content, 200) as shortcontent
            FROM news 
            ORDER BY  created DESC
            LIMIT '. $offset .','.$this->out['onpage']
        );
        if (!empty($this->out['news'])) {
            foreach($this->out['news'] as $k=>$v) {
                $this->out['news'][$k]['created'] = date("d-m-Y H:i:s", $v['created']);
            }
        }
        $total_stat = db::selectOne('SELECT COUNT(*) as cnt FROM news');
        $this->out['total_stat'] = $total_stat['cnt'];
        $this->out['pagging'] = number::pagging($this->out['total_stat'], $this->out['onpage']);
    }
    
    public function view() {
        $this->out['news'] = db::selectOne('
            SELECT *  FROM news WHERE id = '.$this->id
        );
        if (!empty($this->out['news'])) {
            $this->out['news']['created'] = date("d-m-Y H:i:s", $this->out['news']['created']);
            $this->out['news']['content'] = explode("\r\n", $this->out['news']['content']);
            $content = array();
            foreach($this->out['news']['content'] as $k=>$v) {
                if (!empty($v)) {
                    $content[] = "<p>" .$v. "</p>";
                }
            }
            $this->out['news']['content'] = implode("\r\n", $content );
        }
    }
    
    public function edit() {
        if ($_SESSION['group'] != 2) {
            $this->out['noAccess'] = 1;
            return false;
        }
        $news = db::selectOne('Select * from news where id =\''.$this->id.'\'');
        if (empty($news)) { 
            $this->out['noAccess'] = 1;
            return false;
        }
        if ($news['account_id'] != $_SESSION['account_id']) {
            $this->out['noAccess'] = 1;
            return false;
        }
         foreach ($news as $k => $v) {
            $this->out[$k] = $v; 
        }
        $this->out['mode'] = 'edit';
        $this->add();
    }

    public function add() {
        if ($_SESSION['group'] != 2) {
            $this->out['noAccess'] = 1;
            return false;
        }
        if (!isset($this->out['mode'])) {
            $this->out['mode'] = 'add';
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $news[$k] = text::safe($v); 
            }
            if (trim($news['title']) == '') {
                $news['errs']['title']= "Поле не должно быть пустым";
            } else{
                if (strlen($news['title']) > 255) {
                    $news['errs']['title']= "Поле слишком длинное";
                }
            }
            if (trim($news['content']) == '') {
                $news['errs']['content']= "Поле не должно быть пустым";
            }
            if (!isset($news['errs'])) {
                $news['account_id'] = $_SESSION['account_id'];
                if ($this->out['mode'] =='add') {
                    $news['created'] = time();
                    $res = db::insert('news', $news);
                } else {
                    $news['id'] = $this->out['id'];
                    $news['created'] = $this->out['created'];
                    $res = db::update('news', $news);
                }
                if ($res) {
                    request::redirect(SERVER_ROOT.$this->out['module']);
                } else {
                    $news['errs']['message'] = "Ошибка записи в базу данных"; 
                }
            }

            foreach ($news as $k => $v) {
                $this->out[$k] = $v; 
            }
        }
    }

    
}

