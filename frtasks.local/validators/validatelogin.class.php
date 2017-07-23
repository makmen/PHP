<?php

class ValidateLogin extends Validator {

    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_LOGIN_EMPTY";
    const CODE_INVALID = "ERROR_LOGIN_INVALID";
    const CODE_MAX_LEN = "ERROR_LOGIN_MAX_LEN";
    const CODE_LOGIN_EXIST = "ERROR_LOGIN_EXIST";

    protected function validate() {

        if (mb_strlen($this->data) == 0) {
            $this->setError(self::CODE_EMPTY);
        } elseif (mb_strlen($this->data) > self::MAX_LEN)  {
            $this->setError(self::CODE_MAX_LEN);   
        } elseif ($this->isContainQuotes($this->data)) {
            $this->setError(self::CODE_INVALID);
        } elseif (!$this->model->uniqueParam($this->data, $this->value, $this->id)) {
            $this->setError(self::CODE_LOGIN_EXIST);
        } else {
            
        }
    }

}