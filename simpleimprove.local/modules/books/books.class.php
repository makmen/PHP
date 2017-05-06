<?php

class books extends module {
    
    public function __construct($template, $id) {
        parent::__construct(get_class(), $template, $id);
    }
    
    public function run() {
        if ($this->template != '' && @method_exists($this, $this->template)) {
            call_user_func(array($this, $this->template));
        } else {
            $this->template = 'all';
            $this->run();
        }
    }
    
    public function all() {
        $this->out['onpage'] = $this->options['onpage'];
        $p = (int)$_GET['p'];
        $offset = ($p > 0) ? ($p - 1)*$this->out['onpage'] : 0;
        $this->out['page'] = ($p > 0) ? $p : 1;
        $this->out['books'] = db::select('
            SELECT *, LEFT(content, 200) as shortcontent
            FROM books 
            ORDER BY  created DESC
            LIMIT '. $offset .','.$this->out['onpage']
        );
        if (!empty($this->out['books'])) {
            foreach($this->out['books'] as $k=>$v) {
                $this->out['books'][$k]['created'] = date("d-m-Y H:i:s", $v['created']);
            }
        }
        $total_stat = db::selectOne('SELECT COUNT(*) as cnt FROM books');
        $this->out['total_stat'] = $total_stat['cnt'];
        $this->out['pagging'] = number::pagging($this->out['total_stat'], $this->out['onpage']);
    }
    
    public function view() {
        $this->out['books'] = db::selectOne('
            SELECT *  FROM books WHERE id = '.$this->id
        );
        if (!empty($this->out['books'])) {
            $this->out['books']['created'] = date("d-m-Y H:i:s", $this->out['books']['created']);
            $this->out['books']['content'] = explode("\r\n", $this->out['books']['content']);
            $content = array();
            foreach($this->out['books']['content'] as $k=>$v) {
                if (!empty($v)) {
                    $content[] = "<p>" .$v. "</p>";
                }
            }
            $this->out['books']['content'] = implode("\r\n", $content );
        }
    }
    
    public function add() {
        if (!isset($_SESSION['login'])) {
            $this->out['noAccess'] = 1;
            return false;
        }
        if (!isset($this->out['mode'])) {
            $this->out['mode'] = 'add';
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $books[$k] = text::safe($v); 
            }
            if ($this->out['mode'] == 'edit') {
                $books['id'] = $this->out['id'];
            }
            if (trim($books['title']) == '') {
                $books['errs']['title']= "Поле не должно быть пустым";
            } else{
                if (strlen($books['title']) > 255) {
                    $books['errs']['title']= "Поле слишком длинное";
                }
            }
            if (trim($books['author']) == '') {
                $books['errs']['author']= "Поле не должно быть пустым";
            } else{
                if (strlen($books['author']) > 255) {
                    $books['errs']['author']= "Поле слишком длинное";
                }
            }
            if (trim($books['content']) == '') {
                $books['errs']['content']= "Поле не должно быть пустым";
            }
            if (!isset($books['errs'])) {
                $books['account_id'] = $_SESSION['account_id'];
                unset($books['imageField']);
                if ($this->out['mode'] =='add') {
                    $books['created'] = time();
                    $res = db::insert('books', $books);
                } else {
                    $books['id'] = $this->out['id'];
                    $books['created'] = $this->out['created'];
                    $res = db::update('books', $books);
                }
                if ($res) {
                    request::redirect(SERVER_ROOT.$this->out['module']);
                } else {
                    $news['errs']['message'] = "Ошибка записи в базу данных"; 
                }
            }
            foreach ($books as $k => $v) {
                $this->out[$k] = $v; 
            }
        }
    }
    
    public function edit() {
        if (!isset($_SESSION['account_id'])) {
            $this->out['noAccess'] = 1;
            return false;
        }
        $books = db::selectOne('
            SELECT *  FROM books WHERE id = '.$this->id
        );
        if (empty($books)) { 
            $this->out['noAccess'] = 1;
            return false;
        }
        if ($books['account_id'] != $_SESSION['account_id']) {
            $this->out['noAccess'] = 1;
            return false;
        }
         foreach ($books as $k => $v) {
            $this->out[$k] = $v; 
        }
        $this->out['mode'] = 'edit';
        $this->add();
    }
    
}

