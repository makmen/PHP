<?php

abstract class ObjectDB extends AbstractObjectDB {
    
    protected $timeBehavior = false;
    
    public function __construct($table) {
        parent::__construct($table, Config::FORMAT_DATE);
    }
    
    protected function timeBehavior() {
        if ($this->timeBehavior) {
            foreach ($this->timeCreated as $v) {
                $this->add($v, "ValidateDate");
            }
        }
    }
    
    public static function getCount() {
        $select = new Select();
        $select->from(static::$table, array("COUNT(id)") );
        $res = array_values( self::$db->selectOne($select) );

        return reset($res);
    }
    
    public static function getById($id, $table) {
        $select = new Select();
        $select->from($table, "*")->where("`id` = " . $id);
        
        return self::$db->selectOne($select);
    }
    
    public static function getAll($table, $byId = false) {
        $select = new Select();
        $select->from($table, "*");
        
        return self::$db->select($select, $byId);
    }
    
    public static function getBaseSelect($table) {
        $select = new Select();
        $select->from($table, "*");
        
        return $select;
    }

    public function preEdit($field, $value) {
        return true;
    }

    public function postEdit($field, $value) {
        return true;
    }

    public static function accessDenied($field) {
        $authUser = User::getAuthUser();
        if (!$authUser && !count($authUser['permissions']) ) {
            return false;
        }
        $result = User::denied($field, $authUser['permissions']);

        return $result;
    }


}
