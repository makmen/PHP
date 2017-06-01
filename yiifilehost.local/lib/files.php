<?php

namespace app\lib;

class files {

    private function __construct() {
        
    }

    public static function clearDir($dir, $recursive = true, $time = 0, $rmsub = false) {
        if ($dir[strlen($dir) - 1] != DIRECTORY_SEPARATOR)
            $dir.=DIRECTORY_SEPARATOR;
        if (file_exists($dir) && is_dir($dir)) {
            if ($dP = @opendir($dir)) {
                while ($fp = @readdir($dP)) {
                    if ($fp != '.' && $fp != '..') {
                        if (file_exists($dir . $fp)) {
                            if (is_file($dir . $fp)) {
                                $fTime = @filectime($dir . $fp);
                                if ($fTime < (time() - $time) || $time === 0)
                                    @unlink($dir . $fp);
                            } elseif (is_dir($dir . $fp) && $recursive) {
                                clearDir($dir . $fp . '/', $recursive, $time);
                                if ($rmsub)
                                    @rmdir($dir . $fp . '/');
                            }
                        }
                    }
                }
            }
        }
    }

     public static function ru2Lat($string) {
        $string = str_replace(' ', '', $string);
        $string = str_replace('\'', '_', $string);
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'tc',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '_', 'ы' => 'y', 'ъ' => '_',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'Tc',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '_', 'Ы' => 'Y', 'Ъ' => '_',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        
        return strtr($string, $converter);
    }

    public static function downloadFile($dir, $file)
    {
        $path = $dir . '/' . $file;
        if (file_exists($path) && $fp = @fopen($path, "rb")) {
            $fsize=@filesize($path);
            if ($_SERVER['HTTP_RANGE']){
                $range = $_SERVER['HTTP_RANGE'];
                $range = str_replace("bytes=", "", $range);
                list($range, $range1) = explode("-",$range);
            }
            if (isset($range) && ($range <= $fsize)) {
                fseek($fp, $range);
                request::header('206');
            } else {
                request::header('200');
                $range = 0;
            }
            if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false)) {
                request::header('Content-Type: application/force-download');
            } else {
                request::header('Content-Type: application/octet-stream');
            }

            if (preg_match('/\.part[\d]{1,3}\([\d]{10}\)\.(rar|zip|arj|gzip|tar|bz|tgz)/i', $file, 
                $archParts)) {
                $file = preg_replace('/\([\d]{10}\)/','',$file);
            }
            request::header('Content-Disposition: attachment; filename='.$file);
            request::header('Content-Transfer-Encoding: binary');
            request::header('Content-Length: '.($fsize-$range));
            request::header('Content-Range: bytes '.$range.'-'.($fsize - 1).'/'.$fsize);
            request::header('Accept-Ranges: bytes');
            while(!feof($fp) and connection_status()==0){
                set_time_limit(0);
                print(fread($fp,1024*32));
                flush();
                ob_flush();
            }
            fclose($fp);
            exit;
        } else {
            request::header('403');
            exit();
        }
    }
    
}
