<?php

class cryptText {
    
    public function __construct() {

    }
    
    public function shifr($zip, $keyShifr, $shifrNameFiles) {
        $size = filesize( $zip );
        $divide = floor($size / FILE_NUM_READY );
        $fp = fopen($zip, "r");
        for ($i = 0; $i < FILE_NUM_READY; $i++) {
            $content = ($i != (FILE_NUM_READY - 1)) ? 
                fread($fp, $divide) :
                fread($fp, ( ($size - $divide * FILE_NUM_READY) + $divide));
            $content = $this->cryptText( base64_encode($content), $keyShifr, Data::$firstData); 
            files::writeFile(
                DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifrNameFiles[$i] . '.pdf', 
                $content,  "w" 
            );
        }
        fclose($fp);
    }
    
    public function cryptText($content, $keyShifr, $data) {
        $countAlphabet = count($data);
        $convertKey = files::ConvertText($keyShifr, $data);
        $countConvertKey = count($convertKey);
        $cryptogram = array();
        // шифром с автоключом при использовании открытого текста   
        for ($i = 0, $j = 0, $count = strlen($content); $i < $count; $i++, $j++) {
            $search = array_search( ord($content[$i]), $data);
            if ($search === false) {
                continue;
            }
            if ($j == $countConvertKey) {
                $j = 0;
            }
            $cryptogram[] = $this->crypt( $search, $convertKey[$j], $countAlphabet );
        }

        return self::textShifr($cryptogram, $data);
    }
    
    private function crypt($a, $b, $countAlphabet) {
        $code = 0;
        if ($b < 10) {
            $code = 21;
        } elseif (($b >= 10) && ($b < 20)) {
            $code = 32;
        } elseif (($b >= 20) && ($b < 40)) {
            $code = 16;
        } else {
            $code = -5;
        }
        $summa = $a + $b + $code;
        if ($summa > ($countAlphabet - 1))
            $summa -= $countAlphabet;
        
        return $summa;
    }
    
    public function unshifr($files, $keyShifr, $shifrNameFiles) {
        $content = '';
        foreach($files as $k=>$v) {
            $write = ( file_exists( DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifrNameFiles[$k] . '.pdf') ) ?
                file_get_contents(DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifrNameFiles[$k] . '.pdf') :
                file_get_contents(DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $v) ;  
            $write = $this->unCryptText($write, $keyShifr, Data::$firstData); //шифруем   
            $content .= base64_decode($write);
        }
        
        return $content;
    }

    public function unCryptText($content, $keyShifr, $data) {
        $countAlphabet = count($data);
        $convertKey = files::ConvertText($keyShifr, $data);
        $countConvertKey = count($convertKey);
        $cryptogram = array();
        // расшифровываем с автоключом при использовании открытого текста   
        for ($i = 0, $j = 0, $count = strlen($content); $i < $count; $i++, $j++) {
            $search = array_search( ord($content[$i]), $data);
            if ($search === false) {
                continue;
            }
            if ($j == $countConvertKey) {
                $j = 0;
            }
            $cryptogram[] = $this->uncript( $search, $convertKey[$j], $countAlphabet );
        }
        
        return self::textShifr($cryptogram, $data);
    }
    
    
    private function uncript($a, $b, $countAlphabet) {
        $code = 0;
        if ($b < 10) {
            $code = 21;
        } elseif (($b >= 10) && ($b < 20)) {
            $code = 32;
        } elseif (($b >= 20) && ($b < 40)) {
            $code = 16;
        } else {
            $code = -5;
        }
        $res = $a - $b - $code;
        if ($res < 0)
            $res += $countAlphabet;
        
        return $res;
    }

    public static function textShifr($text, $data) {
        $return = "";
        for ($i = 0, $count = count($text); $i < $count; $i++) {
             $return.= chr( $data[ $text[$i] ] );
        }
        
        return $return;
    }

}
