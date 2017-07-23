<?php

class ValidateCompare extends Validator {

    const CODE_PASSWORD_COMPARE = "ERROR_PASSWORD_COMPARE";
    
    protected function validate() {
        $data = $this->data;
        if (is_array($data)) {
            if ($data[0] != $data[1]) {
                $this->setError(self::CODE_PASSWORD_COMPARE);
            }
        } else {
            $this->setError(self::CODE_UNKNOWN);
        }
    }

}