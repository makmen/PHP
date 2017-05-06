<?php
class Contact_model extends CI_Model {
    private $data;

    public function getData() {
        return $this->data;
    }
            
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function checkData() {
        $errs = array();
        $this->data['name'] = Text::safe($_POST['name']);
        $this->data['email'] = Text::safe($_POST['email']);
        $this->data['message'] = Text::safe($_POST['message']);

        if (trim($this->data['name']) ==''){
            $this->data['errs']['name'] = "Поле не должно быть пустым";
        }
        if (trim($this->data['email'])=='') { 
            $this->data['errs']['email']= "Поле не должно быть пустым";
        } else {
            if (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $this->data['email'])) {
                $this->data['errs']['email']= "Неверный адрес";
            }
        }
        if (trim($this->data['message'])=='') {
            $this->data['errs']['message'] = "Поле не должно быть пустым";
        }
    }
    
    function sendMessage() {
        if (empty($this->data['errs'])) {
            $this->load->library('Mailer');
            $message = $this->load->view('account/_emailmessage_tpl', $this->data, true);
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
                $this->data['name'] = $this->data['email'] = $this->data['message'] = "";
            } else {
                $this->data['errs']['sendError'] = "Письмо не отправлено, сайт перегружен, зайдите позже";
            }
        }
    }

}
