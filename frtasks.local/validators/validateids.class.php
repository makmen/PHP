<?php

class ValidateIDs extends Validator {

    protected function validate() { 
        if (is_null($this->data))
            return;
        if (!preg_match("/^\d+(,\d+)*\d?$/", $this->data))
            $this->setError(self::CODE_UNKNOWN);
    }

}