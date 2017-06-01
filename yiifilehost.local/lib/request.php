<?php

namespace app\lib;

class request {

    public static $headers = Array(
        '200' => 'OK',
        '206' => 'Partial Content',
        '403' => 'Forbidden'
    );

    private function __construct() {
        
    }

    public static function header($code) {
        if (isSet(self::$headers[$code]) && self::$headers[$code] != '')
            header('HTTP/1.1 ' . $code . ' ' . self::$headers[$code]);
        else
            header($code);
    }

}
