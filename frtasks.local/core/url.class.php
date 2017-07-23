<?php

class URL {

    public static $uri;
    public static $currentUrl;
    public static $controller;
    public static $action;
    public static $id;
    public static $params;
    
    public static function stripUri($uri){
        return str_replace(Array('$','{','}','(',')'),'',$uri);
    }    

    public static function parse() {
        self::$uri = self::stripUri( $_SERVER['REQUEST_URI'] );
        self::$currentUrl = Config::SERVER_NAME . self::$uri;
        $uri = parse_url( self::$uri );
        $arr = explode('/', substr($uri['path'], 1) );
        self::$controller = ($arr[0]) ? $arr[0] : Config::DEFAULT_CONTROLLER;
        self::$action = isset($arr[1]) ? $arr[1] : Config::DEFAULT_ACTION;
        self::$id = isset($arr[2]) ? (int)$arr[2] : '';
        self::$params = isset($uri['query']) ? $uri['query'] : '';
    }

    public static function getControllerAndAction() {
        return array(self::$controller, self::$action);
    }
    
    public static function buildUrl() {
        $url = Config::SERVER_NAME;
        if ( !func_num_args() ) {
            return $url;
        }
        foreach ( func_get_args() as $k =>$v) {
            $url .= '/' . $v;
        }

        return $url; 
    }

    public static function addGET($url, $name, $value, $amp = true) {
        if (strpos($url, "?") === false)
            $url = $url . "?" . $name . "=" . $value;
        else {
            $amp = ($amp) ? "&amp;" : "&";
            $url = $url . $amp . $name . "=" . $value;
        }
        return $url;
    }

    public static function deleteGET($url, $name, $amp = true) {
        $url = str_replace("&amp;", "&", $url);
        list($url_part, $qs_part) = array_pad(explode("?", $url), 2, "");
        parse_str($qs_part, $qs_vars);
        unset($qs_vars[$name]);
        if (count($qs_vars) != 0) {
            $url = $url_part . "?" . http_build_query($qs_vars);
            if ($amp)
                $url = str_replace("&", "&amp;", $url);
        } else {
            $url = $url_part;
        }
        
        return $url;
    }

}