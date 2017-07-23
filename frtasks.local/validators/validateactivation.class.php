<?php

class ValidateActivation extends Validator {

    const MAX_LEN = 100;

    protected function validate() {
        if (mb_strlen($this->data) > self::MAX_LEN)
            $this->setError(self::CODE_UNKNOWN);
    }

}