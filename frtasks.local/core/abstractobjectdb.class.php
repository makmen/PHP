<?php

abstract class AbstractObjectDB {

    protected static $db = null;
    private $format_date = "";
    private $id = null;
    private $properties = array();
    protected $table_name = "";
    protected $timeCreated = array("created", "updated");
    protected $errors = array();
    public $fieldsDenied = array();
    public $validateDenied = array();
            
    public static function setDB($db) {
        self::$db = $db;
    }
    
    public function __construct($table_name, $format_date) {
        $this->table_name = $table_name;
        $this->format_date = $format_date;
    }
    
    public function getID() {
        return (int)$this->id;
    }
    
    public function getErrors() {
        return $this->errors;
    }

    public function load($id = 0) {
        if ($id > 0) {
            $select = new Select(self::$db);
            $select = $select->from($this->table_name, '*')
                    ->where("`id` = " . self::$db->getSQ(), array($id));
            $row = self::$db->selectOne($select);
            if (!$row) {
                return false;
            }
            $this->loadModel($row, $id);
        }

        return true;
        
    }

    public function loadModel($data, $id = 0) {
        $this->id = (int)$id;
        foreach ($this->properties as $key => $value) {
            if ( !isset($data[$key]) ) {
                continue;
            }
            if ( !empty($this->fieldsDenied) && in_array($key, $this->fieldsDenied) ) {
                continue;
            }
            
            $val = $data[$key];
            $this->properties[$key]["value"] = $val;
        }
        $this->fieldsDenied = array();

        $this->postLoad();
    }
    
    public function toRequiredArray() {
        $array = array( 'id' => $this->getID() );
        foreach ($this->properties as $key => $value) {
            if ($value['required']) {
                $array[$key] = $value["value"];
            }
        }
        
        return $array;
    }

    public function isSaved() {
        return $this->getID() > 0;
    }
    
    protected function postLoad() {
        return true;
    }
    
    private function setTimeBehavior($param) {
        if ( isset($this->properties[ $this->timeCreated[$param] ]) ) {
            $this->properties[ $this->timeCreated[$param] ]["value"] = $this->getDate();
        }
    }
    
    protected function preValidate() {
        return true;
    }
    
    protected function postValidate() {
        return true;
    }
    
    protected function preSave() {
        return true;
    }
    
    protected  function preInsert() {
        return true;
    }
    
    protected  function preUpdate() {
        return true;
    }
    
    protected  function preDelete() {
        return true;
    }
    
    private function formRow() {
        $row = array();
        foreach ($this->properties as $key => $value) {
            if ($value['required']) {
                $row[$key] = $value["value"];
            }
        }

        return $row;
    }

    public function save() {
        $update = $this->isSaved();
        $this->validate();
        if ( count( $this->errors ) > 0 ) {
            return false;
        }

        if ($this->timeBehavior) {
            $this->setTimeBehavior( (int)$update );
        }
       
        $this->preSave(); 
        
        if ($update) {
            $this->preUpdate();
            $success = self::$db->update($this->table_name, $this->formRow(), "`id` = " . self::$db->getSQ(), array($this->getID()));
            if (!$success) {
                return false;
            }
        }
        else {
            $this->preInsert();
            $this->id = self::$db->insert($this->table_name, $this->formRow());
            if (!$this->id) {
                return false;
            }
        }
        
        return true;
    }

    public function delete() {
        if (!$this->isSaved())
            return false;
        if (!$this->preDelete())
            return false;
        $success = self::$db->delete($this->table_name, "`id` = " . self::$db->getSQ(), array($this->getID()));
        if (!$success)
            throw new Exception();
        $this->id = null;
        return $this->postDelete();
    }
    
    public function __set($name, $value) {
        if (array_key_exists($name, $this->properties)) {
            $this->properties[$name]["value"] = $value;
            return true;
        } else
            $this->$name = $value;
    }

    public function __get($name) {
        if ($name == "id")
            return $this->getID();
        return array_key_exists($name, $this->properties) ? $this->properties[$name]["value"] : null;
    }

    public static function buildMultiple($class, $data) {
        $ret = array();

        if (!class_exists($class))
            throw new Exception();

        $test_obj = new $class();
        if (!$test_obj instanceof AbstractObjectDB)
            throw new Exception();
        foreach ($data as $row) {
            $obj = new $class();
            $obj->init($row);
            $ret[$obj->getID()] = $obj;
        }
        return $ret;
    }

    protected function add($field, $validator, $default = null, $required = true) {
        $this->properties[$field] = array("value" => $default, "validator" => $validator, "required" => $required);
    }

    public function getDate($date = false) {
        if (!$date)
            $date = time();
        return strftime($this->format_date, $date);
    }

    protected function getIP() {
        return $_SERVER["REMOTE_ADDR"];
    }

    protected static function hash($str, $secret = "") {
        return md5($str . $secret);
    }

    protected function getKey() {
        return uniqid();
    }

    private function validate() {
        $v = array();
        $this->errors = array();

        foreach ($this->properties as $key => $value) {
            if ( !empty($this->validateDenied) && in_array($key, $this->validateDenied) ) {
                continue;
            }
            
            $v[$key] = new $value["validator"]($this, $key);
        }
        foreach ($v as $key => $validator) {
            if (!$validator->isValid())
                $this->errors[$key] = $validator->getErrors();
        }

        if (count($this->errors) == 0) {
            $this->postValidate();
        } else {
            return false;
        }
        
        return true;

    }

}

