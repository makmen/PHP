<?php

class ValidateCaptcha extends Validator {

    const MAX_LEN = 10;
    const CODE_EMPTY = "ERROR_CAPTCHA_EMPTY";
    const CODE_INVALID = "ERROR_CAPTCHA_INVALID";
    const CODE_MAX_LEN = "ERROR_CAPTCHA_MAX_LEN";

    protected function validate() {

        if (mb_strlen($this->data) == 0) {
            $this->setError(self::CODE_EMPTY);
        } elseif (mb_strlen($this->data) > self::MAX_LEN) {
            $this->setError(self::CODE_MAX_LEN);
        } elseif ( !Captcha::check( $this->data ) ) {
            $this->setError(self::CODE_INVALID);
        } else {
            
        }

    }

}
