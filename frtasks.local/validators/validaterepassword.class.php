<?php

class ValidateRePassword extends Validator {

    const MIN_LEN = 6;
    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_PASSWORD_EMPTY";
    const CODE_CONTENT = "ERROR_PASSWORD_CONTENT";
    const CODE_MIN_LEN = "ERROR_PASSWORD_MIN_LEN";
    const CODE_MAX_LEN = "ERROR_PASSWORD_MAX_LEN";

    protected function validate() {

        if (mb_strlen($this->data) == 0) {
            $this->setError(self::CODE_EMPTY);
        } elseif (mb_strlen($this->data) < self::MIN_LEN) {
            $this->setError(self::CODE_MIN_LEN);
        } elseif (mb_strlen($this->data) > self::MAX_LEN) {
            $this->setError(self::CODE_MIN_LEN);
        } elseif (!preg_match("/^[a-z0-9_]+$/i", $this->data)) {
            $this->setError(self::CODE_CONTENT);
        } else {

        }

    }

}
