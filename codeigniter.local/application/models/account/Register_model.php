<?php
class Register_model extends CI_Model {
    private $data=array();
    private $mode;

    public function getData() {
        return $this->data;
    }
            
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function getUser($login) {
        $row = $this->db->query('Select * from accounts where login =\''. $login . '\'');
        $res = $row->result_array();
        if (count($res) > 0) {
            $this->data['id'] = $res[0]['id'];
            $this->data['login'] = $res[0]['login'];
            $this->data['password'] = $res[0]['password'];
        }

        return $res[0];
    }
    
    function setUser() {
        if (!isset($this->data["errs"])) {
            if ($this->mode == "add") {
                $query = 'INSERT INTO accounts (`login`,`password`, `email`, `name`)' .
                        'VALUES ("'.$this->data['login'].'", "' .
                        $this->data['password'].'", "' .
                        $this->data['email'].'", "' .
                        $this->data['name'].'")';
            } else {
                $query = 'Update  accounts Set `email` = "' .$this->data['email']. '",
                         name="' . $this->data['name'] . '" WHERE id = '. $this->data['id'];
            }
            if ($this->db->query($query)) {
                $this->data['success'] = true;
                if ($this->mode == "add") {
                    $this->Authorization();
                    header('Location:' . BASE_URL);
                }
            } else {
                $this->data['errs']['message'] = "Ошибка записи в базу данных"; 
            }
        }
    }
    
    function Authorization() {
        $this->session->set_userdata(
            array('login' => $this->data['login'],
                'email' => $this->data['email'], 
                'name' => $this->data['name']
                )
            );
    } 

    function checkData($mode) {
        $this->mode = $mode;
        foreach ($_POST as $k => $v) {
            $this->data[$k] = text::safe($v); 
        }
        $this->checkUser();
    }
    
    function checkUser() {
        if (trim($this->data['name']) == '') {
            $this->data['errs']['name']= "Поле не должно быть пустым";
        }
        if (trim($this->data['email'])=='') { 
            $this->data['errs']['email']= "Поле не должно быть пустым";
        } elseif (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $this->data['email'])) {
            $this->data['errs']['email']= "Неверный адрес";
        } else {
            if ($this->mode == 'add') {
                $row = $this->db->query("SELECT id FROM accounts WHERE email = '" . $this->data['email']."'");
            } else {
                $row = $this->db->query("SELECT id FROM accounts WHERE email = '" . $this->data['email']."' AND id != ".$this->data['id']);
            }
            $res = $row->result_array();
            if (!empty($res)) {
                $this->data['errs']['email']= "Email уже присутствует в системе";
            }
        }
        if ($this->mode == 'add') {
            if (trim($this->data['login'])=='') {
                $this->data['errs']['login']= "Поле не должно быть пустым";
            } elseif (!preg_match('/^[a-zA-Z]+$/iu', $this->data['login'])) {
                $this->data['errs']['login']= "Только латинские буквы";
            } else {
                $row = $this->db->query("SELECT id FROM accounts WHERE login = '" . $this->data['login']."'");
                $res = $row->result_array();
                if (!empty($res)) {
                    $this->data['errs']['login']= "Имя уже присутствует в системе";
                }
            }
            if (trim($this->data['password']) == '') {
                $this->data['errs']['password']= "Поле не должно быть пустым";
            }
            if (trim($this->data['repass']) == '') {
                $this->data['errs']['repass']= "Поле не должно быть пустым";
            }
            if (!isset($this->data['errs']['password']) && !isset($this->data['errs']['repass'])) {
                if ($this->data['password'] != $this->data['repass']) {
                    $this->data['errs']['password']= "Пароли должны совпадать";
                    $this->data['errs']['repass']= "Пароли должны совпадать";
                }
            }
            if (trim($this->data['key']) == '') {
                $this->data['errs']['key']= "Поле не должно быть пустым";
            } else if ($this->data['key'] != $this->session->userdata['captcha']) {
                $this->data['errs']['key'] = "Символы введены не верно";
            }
            $this->session->unset_userdata('captcha');
        }
    }

}
