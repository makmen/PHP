<?php

class Message {

    private $data;

    public function __construct($file) {
        $this->data = parse_ini_file($file);
    }

    public function get($name) {
        return $this->data[$name];
    }
    
    public function getErrors($errors) {
        if ( count($errors) > 0 ) {
            foreach ( $errors as $k => $v ) {
                foreach ( $v as $kk => $vv ) {
                    $errors[$k][$kk] = $this->get( $vv );
                }
            }
        }
        
        return $errors;
    }

}
