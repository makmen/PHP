<?php
class Forget_model extends CI_Model {
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

    function checkData() {
        foreach ($_POST as $k => $v) {
            $this->data[$k] = text::safe($v); 
        }
        if (trim($this->data['email'])=='') { 
            $this->data['errs']['email']= "Поле не должно быть пустым";
        } elseif (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $this->data['email'])) {
            $this->data['errs']['email']= "Неверный адрес";
        } else {

        }
        if (trim($this->data['key']) == '') {
            $this->data['errs']['key']= "Поле не должно быть пустым";
        } else if ($this->data['key'] != $this->session->userdata['captcha']) {
            $this->data['errs']['key'] = "Символы введены не верно";
        }
        $this->session->unset_userdata('captcha');
    }
    
    function formLink() {
        if (empty($this->data['errs'])) {
            $this->load->library('Number');
            $activation = number::getNumberString(8);
            $this->data['link'] = BASE_URL.'account/restorepassword'.'/'.$activation;
            $row = $this->db->query("SELECT id FROM accounts WHERE email = '" . $this->data['email']."'");
            $res = $row->result_array();
            if (!empty($res)) {
                $query = 'Update  accounts Set `activation` = "' .$this->data['link']. '" WHERE id = '. $res[0]['id'];
                $this->db->query($query);
            } else {
                $this->data['errs']['db'] = "email не зарегестрирован";
            }
        }
    }
    
    function sendMessage() {
        if (empty($this->data['errs'])) {
            $this->load->library('Mailer');
            $message = $this->load->view('account/_forgetemail_tpl', $this->data, true);
            $mail = new Mailer(); 
            $mail->CharSet="utf-8";
            $mail->ContentType="text/html";
            $mail->Encoding="quoted-printable";
            $mail->Subject='Обратная связь';
            $mail->Body = $message;
            $mail->AddAddress('vactt@mail.ru');
            $mess=$mail->Send();
            if ($mess) {
                $this->data['sendSuccess'] = true;
                $this->data['email'] = $this->data['key'] =  "";
            } else {
                $this->data['errs']['sendError'] = "Письмо не отправлено, сайт перегружен, зайдите позже";
            }
        } elseif (isset($this->data['errs']['db'])) {
            $this->data['sendSuccess'] = true;
            $this->data['email'] = $this->data['key'] =  "";
        } else {
            
        }
    }


}
