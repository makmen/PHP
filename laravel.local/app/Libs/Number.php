<?php
namespace App\Libs;

class Number {

    public static function numberFormat($num, $dec){
        $result = number_format($num, $dec, decSEP, thSEP);
        $result = preg_replace('/\.' . str_repeat('0', $dec) . '$/', '', $result);

        return $result;
    }
    
    public static function getNumberCaptaha($length) {
        $ret = "";
        $countLetters = 0; // должно быть не больше двух букв в капче
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '123456789';  
        for ($i = 0; $i < $length; $i++) {
            $rand = rand(0, 1); // 0 число, 1 строка
            if ($rand) {
                if ($countLetters < 2) {
                    $countLetters++;
                } else {
                    $rand = 0;
                }
            }
            $ret .= ($rand) ? substr($letters, rand(1, strlen($letters)) - 1, 1) :
                substr($numbers, rand(1, strlen($numbers)) - 1, 1);
        }

        return $ret;
    }
    
    public static function formatPrice($price){
        $price = strrev((string)round($price));
        $return = "";
        for ($i = 0, $count = strlen($price); $i < $count; $i++) {
            if ($i && !($i % 3)) {
                $return .= " ";
            }
            $return .= $price[$i];
        }
        $return = strrev($return);

        return $return;
    }

    public static function getNumberString($length) {
        $symbols = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($symbols, rand(1, strlen($symbols)) - 1, 1);
        }

        return $string;
    }
    
    public static function preparePagging(&$out) {
        $p = 1;
        if (isset($_GET['p'])) {
            $p = (int)$_GET['p'];
        }
        $offset = ($p > 0) ? ($p - 1)*$out['onpage'] : 0;
        $out['page'] = ($p > 0) ? $p : 1;
        
        return $offset;
    }
    
    public static function pagging($total, $onpage) {
        $pages = ceil($total / $onpage);
        $pagging = array();
        for ($i = 0; $i < $pages; $i++) {
            $pagging[] = $i + 1;
        }
        
        return $pagging;
    }


}