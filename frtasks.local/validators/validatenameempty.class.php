<?php

class ValidateNameEmpty extends Validator {

    const MAX_LEN = 100;
    const CODE_INVALID = "ERROR_NAME_INVALID";
    const CODE_MAX_LEN = "ERROR_NAME_MAX_LEN";

    protected function validate() {

        if (mb_strlen($this->data) > self::MAX_LEN)
            $this->setError(self::CODE_MAX_LEN);
        elseif ($this->isContainQuotes($this->data))
            $this->setError(self::CODE_INVALID);
        
    }

}
