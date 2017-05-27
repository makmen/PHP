<?php

class cryptKey {
    
    private $key;
    private $keyShifr;
    private $shifrNameFiles;
    private $rectangle = 4;
    
    function getKey() {
        return $this->key;
    }
    
    function getKeyShifr() {
        return $this->keyShifr;
    }

    function getShifrNameFiles() {
        return $this->shifrNameFiles;
    }
    
    public function __construct($key) {
        $this->key = $key;
    }
    
    public function shifrKey() {
        $data = files::convertText( base64_encode($this->key), Data::$firstData );
        $data = $this->keyLevelZero($data);
        $key = $this->keyLevelHigh($data, Data::$secondData);
        $this->keyShifr = cryptText::textShifr( $this->doKeyArray( $key, 100 ), Data::$firstData );
        $this->shifrNameFiles = self::getKeyArray( sha1($this->key) );
    }
    
    public static function getKeyArray($key) {
        $key = preg_replace('/\//', '', $key);
        $return = array();
        $repeatCode = array();
        for ($i = 0, $count = strlen($key); $i < $count; $i+=3) {
            $code = substr($key, $i, 5);
            if (!in_array($code, $repeatCode)) {
                $repeatCode[] = $code;
                if (count($return) < FILE_NUM_READY ) {
                    $return[] = $code;
                }
            }
        }
        
        return $return;
    }

    private function keyLevelZero($data) {
        $summa = ceil(array_sum($data) / 3) + $this->generator($data);
        while(true) {
            if ($summa > 64) {
                $summa -= 65;
            }
            else break;
        }
        for ($i = 0, $count = count($data); $i < $count; $i++) {
            $swap = $data[$i] + $summa;
            if ($swap > 64) {
                $swap -= 65;
            }
            $data[$i] = $swap;
        }
        $data = $this->keyLevelMiddle( array_reverse($data) );
        
        return $data;
    }

    private function generator($data) {
        sort($data);
        $gen = 0;
        for ($i = 0, $count = count($data); $i < $count; $i += 2) {
            $first = $data[$i];
            $second = $data[$i + 1] * ($i + 1);
            if ($first == 0) {
                $first = 15;
            }
            if ($second == 0) {
                $second = 15;
            }
            if (empty($second)) {
                $second = 1;
            }
            $gen += ( $first * $second );
        }
        
        return $gen;
    }
    
    private function keyLevelMiddle($data) {
        $return = array();
        $count = ceil( count($data) / $this->rectangle); 
        for ($i = 0; $i < $this->rectangle; $i++) {
            $return[] = $data[$i];
            for ($j = 1; $j < $count; $j++) {
                $buf = $i + $j * $this->rectangle;
                $return[] = $data[$buf];
            }
        }
        
        return $return;
    }
    
    private function analize($code, $int) {
        while($int < $code) {
            $code -= $int; 
        }

        return $code;
    }
    
    private function doKeyArray($kriptKey, $int) {
        $output = array();
        $kriptKeyLength = count($kriptKey);
        if ($kriptKeyLength >= $int)
            for ($i = 0; $i < $int; $i++) {
                $code = $kriptKey[$i] + $kriptKey[$i + 1];
                if ($i == ($int - 1))
                    $code = $kriptKey[$i] + $kriptKey[0];
                $output[] = analize($code, $int);
            }
        else {
            for ($i = 0; $i < $kriptKeyLength; $i++) {
                $code = $kriptKey[$i] + $kriptKey[$i + 1];
                if ($i == ($kriptKeyLength - 1))
                    $code = $kriptKey[$i] + $kriptKey[0];
                $output[] = $this->analize($code, $int);
            }
            for ($i = $kriptKeyLength; $i < $int; $i++) {
                $code = $output[$i - 1] + $output[$i - 2] + $output[$i - 3];
                $output[] = $this->analize($code, $int);
            }
        }
        return $output;
    }

    private function keyLevelHigh($key, $data) {
        $outmass = array();
        for ($i = 0, $count = count($key); $i < $count; $i++) {
            $code = $key[$i] + $data[$i];
            if ($code > 64) {
                $code -= 65;
            }
            $outmass[] = $code;
        }
        
        return $outmass;
    }

}
