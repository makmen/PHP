<?php

class ValidateEmail extends Validator {

    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_EMAIL_EMPTY";
    const CODE_INVALID = "ERROR_EMAIL_INVALID";
    const CODE_MAX_LEN = "ERROR_EMAIL_MAX_LEN";
    const CODE_EMAIL_EXIST = "ERROR_EMAIL_EXIST";

    protected function validate() {

        if (mb_strlen($this->data) == 0) {
            $this->setError(self::CODE_EMPTY);
        } elseif (mb_strlen($this->data) > self::MAX_LEN) {
            $this->setError(self::CODE_MAX_LEN);
        } elseif (!preg_match("/^[a-z0-9_][a-z0-9\._-]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+$/i", $this->data)) {
            $this->setError(self::CODE_INVALID);
        } else {
            
        }
            

    }

}
