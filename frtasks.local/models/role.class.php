<?php

class Role extends ObjectDB {

    protected static $table = "roles";
    
    public static $roleAdmin = 1;
    public static $roleManager = 2;
    public static $roleDeveloper = 3;
    public static $roleReporter = 4;
    public static $roleDefault = 5;
    
    public function __construct() {
        parent::__construct(self::$table);
        $this->add("name", "ValidateName");
    }
    
    public static function getAllRoles($byId = true) {
        $select = new Select();
        $select->from(self::$table, "*");
        
        return self::$db->select($select, $byId);
    }
    
    public static function savePermissions($role, $data) {
        $success = self::$db->delete( 
            "permissions_roles", "`role_id` = " . self::$db->getSQ(), array($role['id'] )
        );
        if (!$success) {
            return false;
        }
        if ( !empty($data) ) {
            foreach ($data as $k=>$v) {
                $success = self::$db->insert( "permissions_roles", [ "permission_id" => $v, "role_id" => $role['id'] ]);
                if (!$success) {
                    return false;
                }
            }
        }
        
        return true;
    }
    


}
