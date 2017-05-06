<?php

class request {
   
    public $protocol = 'http';
    
    public $user_agent;
    
    public $fullUrl;
    
    public $uri;
   
    public $module;
    
    public $template;
    
    public $id;
    
    public $isAjax = false;
    
    public static $headers=Array(
	//1xx: Informational
          '100'=>'Continue',
          '101'=>'Switching Protocols',
          '102'=>'Processing',
    //2xx: Success
          '200'=>'OK',
          '201'=>'Created',
          '202'=>'Accepted',
          '203'=>'Non-Authoritative Information',
          '204'=>'No Content',
          '205'=>'Reset Content',
          '206'=>'Partial Content',
          '207'=>'Multi-Status',
          '226'=>'IM Used',
    //3xx: Redirection
          '300'=>'Multiple Choices',
          '301'=>'Moved Permanently',
          '302'=>'Found',
          '303'=>'See Other',
          '304'=>'Not Modified',
          '305'=>'Use Proxy',
          '306'=>'',
          '307'=>'Temporary Redirect',
    //4xx: Client Error
          '400'=>'Bad Request',
          '401'=>'Unauthorized',
          '402'=>'Payment Required',
          '403'=>'Forbidden',
          '404'=>'Not Found',
          '405'=>'Method Not Allowed',
          '406'=>'Not Acceptable',
          '407'=>'Proxy Authentication Required',
          '408'=>'Request Timeout',
          '409'=>'Conflict',
          '410'=>'Gone',
          '411'=>'Length Required',
          '412'=>'Precondition Failed',
          '413'=>'Request Entity Too Large',
          '414'=>'Request-URI Too Long',
          '415'=>'Unsupported Media Type',
          '416'=>'Requested Range Not Satisfiable',
          '417'=>'Expectation Failed',
          '422'=>'Unprocessable Entity',
          '423'=>'Locked',
          '424'=>'Failed Dependency',
          '425'=>'Unordered Collection',
          '426'=>'Upgrade Required',
          '449'=>'Retry With',
    //5xx: Server Error
          '500'=>'Internal Server Error',
          '501'=>'Not Implemented',
          '502'=>'Bad Gateway',
          '503'=>'Service Unavailable',
          '504'=>'Gateway Timeout',
          '505'=>'HTTP Version Not Supported',
          '506'=>'Variant Also Negotiates',
          '507'=>'Insufficient Storage',
          '509'=>'Bandwidth Limit Exceeded',
          '510'=>'Not Extended',
	);
    
    public function __construct() {
        if ( !empty($_SERVER['HTTPS']) && filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN)) {
            $this->protocol = 'https';
        }
        
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        }
        
        if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || 
            $_REQUEST['ajax']==1) {
            $this->isAjax = true;
        }
      
        $this->uri = $this->stripUri(text::safe($_SERVER['REQUEST_URI']));
        
        $this->fullUrl = SERVER_NAME . $this->uri;

        $this->parse();
    }

    public static function redirect($url, $header=303){
        if (headers_sent()) {
            echo '<SCRIPT LANGUAGE="JavaScript"> location.href='."'".$url."'".'</SCRIPT>';
        } else{
            self::header($header);
            header('Location: '.$url."\n\n");
        }
        exit;
    }

    public static function header($code){
        if (isSet(self::$headers[$code]) && self::$headers[$code]!='') {
            header('HTTP/1.1 '.$code.' '.self::$headers[$code]);
        }

        else header($code);
    }

    public static function stripUri($uri){
        return str_replace(Array('$','{','}','(',')'),'',$uri);
    }

    public function parse(){
        $url = parse_url($this->fullUrl);
        $arr = explode('/', $url['path']);
        $this->module = (isset($arr[1]) ? $arr[1] : '');
        $this->template = (isset($arr[2]) ? $arr[2] : '');
        $this->id = (isset($arr[3]) ? $arr[3] : '');
    }

}