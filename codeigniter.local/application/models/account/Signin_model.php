<?php
class Signin_model extends CI_Model {
    private $data;

    public function getData() {
        return $this->data;
    }
            
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function checkAccess() {
        $errs = array();
        $this->load->database();
        $this->data['login'] = Text::safe($_POST['login']);
        $this->data['password'] = Text::safe($_POST['password']);
        $row = $this->db->query('Select * from accounts where login =\''. $this->data['login'] . 
                '\' and password =\''.$this->data['password'].'\' Limit 1');
        $res = $row->result_array();
        if (count($res) > 0) {
            $this->data['result'] = $res[0];
            $this->data['access'] = true;
        } else {
            $this->data['access'] = false;
        }
    }

}
