<?php

class forgetForm {
    
    public $email;
    public $captcha;
    public $errors = array();
    
    public function __construct($data) {
        $this->email = $data['email'];
        $this->captcha = $data['captcha'];
    }
    
    public function validate() {
        $validator = new ValidateEmail($this, 'email');
        if (!$validator->isValid()) {
            $this->errors['email'] = $validator->getErrors();
        }
        $validator = new ValidateCaptcha($this, 'captcha');
        if (!$validator->isValid()) {
            $this->errors['captcha'] = $validator->getErrors();
        }
    }
    
    public function __call($name, $arguments) {
        
    }
    



}
