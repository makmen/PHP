<?php

class ValidateID extends Validator {

    protected function validate() {

        if ( !(int)$this->data  ) {
            $this->setError(self::CODE_UNKNOWN);
        }
    
    }

}
