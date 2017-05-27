<?php

class files {

    private function __construct() {
        
    }
    
    public static function getFilesFromDir($dir = '') {
        $files = array();
        if ($dir != '' && file_exists($dir) && is_dir($dir)) {
            $fP = opendir($dir);
            while (false !== ($file = readdir($fP))) {
                if ($file != '.' && $file != '..' && !is_dir( $dir . DIRECTORY_SEPARATOR. $file )) {
                   $files[] = $file;
                }
	    }
            closedir($fP);
        }
        
        return $files;
    }
    
    public static function renameFiles($dir, $files) {
        for ($i = 0, $count = count($files); $i < $count; $i++) {
            $newName = files::ru2Lat( str_replace( array(' ', '\'') , array('_', '\'_'), $files[$i]) );
            rename($dir . DIRECTORY_SEPARATOR . $files[$i], $dir . DIRECTORY_SEPARATOR . $newName);
            $files[$i] = $newName;
        }
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

    public static function toArchive($dir, $name, $files) {
        if (count($files) <= 0)
            return false;
        $zip = new ZipArchive;
        if ($res = $zip->open($dir . DIRECTORY_SEPARATOR . $name, ZIPARCHIVE::CREATE)) {
            foreach ($files as $k => $v) {
                if (!is_dir( $dir . DIRECTORY_SEPARATOR. $v )) {
                    $res = $res && $zip->addFile($dir . DIRECTORY_SEPARATOR. $v, $v);
                } else {
                    $zip->addEmptyDir($v);
                    $zip = ZipDirectory($dir . DIRECTORY_SEPARATOR. $v, $zip, $v);
                }
            }
            $zip->close();
        }
        
        return $res;
    }

    public static function ZipDirectory($src_dir, $zip, $dir_in_archive = '') {
        $dirHandle = opendir($src_dir);
        while (false !== ($file = readdir($dirHandle))) {
            if (($file != '.') && ($file != '..')) {
                $oldfile = $file;
                $file = ru2Lat($file);
                rename($src_dir . DIRECTORY_SEPARATOR . $oldfile, $src_dir . DIRECTORY_SEPARATOR . $file);
                if (!is_dir($src_dir . DIRECTORY_SEPARATOR . $file)) {
                    $zip->addFile($src_dir . DIRECTORY_SEPARATOR . $file, $dir_in_archive . DIRECTORY_SEPARATOR . $file);
                } else {
                    $zip->addEmptyDir($dir_in_archive . DIRECTORY_SEPARATOR . $file);
                    $zip = ZipDirectory($src_dir . DIRECTORY_SEPARATOR . $file . DIRECTORY_SEPARATOR, $zip, $dir_in_archive . DIRECTORY_SEPARATOR . $file);
                }
            }
        }
        
        return $zip;
    }

     public static function ru2Lat($string) {
        $string = iconv("cp1251", "UTF-8", $string);
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

    public static function GetNumber() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $num = strlen($str);
        $string = '';
        for ($i = 0, $length = rand(12, 20); $i < $length; $i++) {
            $string .= substr($str, rand(1, $num) - 1, 1);
        }

        return $string;
    }
    
    public static function convertText($key, $data) {
        $return = array();
        for ($i = 0, $count = strlen($key); $i < $count; $i++) {
            $search = array_search( ord($key[$i]) , $data);
            if ($search !== false)
                $return[] = $search;
        }
            
        return $return;
    }
    
    public static function writeFile($name = '', $data = '', $option = 'w+') {
        if ($fp = fopen($name, $option)) {
            $rez = fwrite($fp, $data);
            fclose($fp);
            return $rez;
        } else
            return false;
    }
    
        
    public static function defineSizeFiles($dir, $files) {
        $filesize = 0;
        for ($i = 0, $count = count( $files ); $i < $count; $i++) {
            $filesize += filesize( $dir . DIRECTORY_SEPARATOR . $files[$i] );
        }
        
        return $filesize;
    }

}
