<?php

class article extends module {
    
    public function __construct($template, $id) {
        parent::__construct(get_class(), $template, $id);
    }
    
    public function run() {
        if ($this->template != '' && @method_exists($this, $this->template)) {
            call_user_func(array($this, $this->template));
        } else {
            $this->template = 'contact';
            $this->run();
        }
    }
    
    public function about() {

    }
    
    public function contact() {
        $this->out['title'] = "Продаем книги в Минске - контакты";
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $contacts[$k] = text::safe($v);
            }
            if (trim($contacts['name'])==''){
                $contacts['errs']['name'] = "Поле не должно быть пустым";
            }
            if (trim($contacts['email'])=='') { 
                $contacts['errs']['email']= "Поле не должно быть пустым";
            } else {
                if (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $contacts['email'])) {
                    $contacts['errs']['email']= "Неверный адрес";
                }
            }
            if (trim($contacts['message'])==''){
                $contacts['errs']['message'] = "Поле не должно быть пустым";
            }
            foreach ($contacts as $k => $v) {
                $this->out[$k] = $v; 
            }
            if (!isset($contacts['errs'])) {
                // отправляем сообщение
                $message = $this->display('account/emailmessage.tpl' );
                $mail = new mailer(); 
                $mail->CharSet="utf-8";
                $mail->ContentType="text/html";
                $mail->Encoding="quoted-printable";
                $mail->Subject='Обратная связь';
                $mail->Body = $message;
                $mail->AddAddress('vactt@mail.ru');
                $mess=$mail->Send();
                if ($mess) {
                    $this->out['sendSuccess'] = true;
                    $this->out['name'] = $this->out['email'] = $this->out['message'] = "";
                } else {
                    $this->out['errs']['sendError'] = "Письмо не отправлено, сайт перегружен, зайдите позже";
                }
            }
        }
    }
    
}

