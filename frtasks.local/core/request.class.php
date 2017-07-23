<?php

class Request {

    public static $protocol='http';
    public static $user_agent;
    public static $isAjax = false;
    public static $requestMethodPost = false;
    private $data;
    
    public function __construct() {
        $this->data = $this->xss($_REQUEST);
    }
    
    public function __get($name) {
        if (isset($this->data[$name]))
            return $this->data[$name];
    }

    public static function inst(){
        if ( !empty($_SERVER['HTTPS']) && filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN)) {
            self::$protocol = 'https';
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::$requestMethodPost = true;
        }
        
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            self::$user_agent = $_SERVER['HTTP_USER_AGENT'];
        }
        
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            self::$isAjax = true;
        }
        URL::parse();
    }

    private function xss($data) {
        if (is_array($data)) {
            $escaped = array();
            foreach ($data as $key => $value) {
                $escaped[$key] = $this->xss($value);
            }
            return $escaped;
        }
        return trim(htmlspecialchars($data));
    }

}
