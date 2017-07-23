<?php

class ValidateDate extends Validator {

    protected function validate() {
        if (!is_null($this->data) && strtotime($this->data) === false)
            $this->setError(self::CODE_UNKNOWN);
    }

}
