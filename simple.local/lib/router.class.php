<?php

class router {
    private $request;
    private $index = "_index.tpl";
    private $_404 = "_404.tpl";
    private $out = array();
    public $buffer = "";

    public function __construct($request) {
        $this->request = $request;
        $this->out["module"] = $this->request->module;
    }
    
    public function show() {
        if ($this->out["module"] != '') {
            if (method_exists($this, $this->out["module"])) {
                // вызываем нужный шаблон
                call_user_func(array($this, $this->out["module"]));
                $this->buffer = $this->dilspay( DOC_ROOT . 'templates/' . $this->index );
            } else {
                $this->out['title'] = "Ремонты под ключ";
                $this->buffer = $this->dilspay( DOC_ROOT . 'templates/' . $this->_404 );
            }
        } else {
            // пустой index
            $this->out['title'] = "Ремонты под ключ - главная";
            $this->buffer = $this->dilspay( DOC_ROOT . 'templates/' . $this->index );
        }
    }
    
    public function dilspay($path) {
        ob_start();
        include($path);
        $content = ob_get_contents();
        ob_end_clean(); 
        
        return $content;
    }
    
    public function technology() {
        $this->out['title'] = "Ремонты под ключ - технология ремонта";
        
    }
    public function gallery() {
        $this->out['title'] = "Ремонты под ключ - галлерея проектов";
        
    }
    public function comment() {
        $this->out['title'] = "Ремонты под ключ - отзывы";
        
    }
    public function contacts() {
        $this->out['title'] = "Ремонты под ключ - наши контакты";
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
                $message = $this->dilspay( DOC_ROOT . 'templates/emailmessage.tpl');
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