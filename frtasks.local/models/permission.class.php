<?php

class Permission extends ObjectDB {

    protected static $table = "permissions";
    
    public function __construct() {
        parent::__construct(self::$table);
        $this->add("name", "ValidateName" );
    }
    
    public static function getAllPermisssions($role) {
        $select = new Select();
        $query =
            'SELECT permissions.id, permissions.name '
            . ' FROM ' 
            . self::$db->getTableName('permissions') . ' as permissions INNER JOIN '
            . self::$db->getTableName('permissions_roles') . ' as permissions_roles '
            . ' ON (permissions.id = permissions_roles.permission_id) '
            . 'WHERE `role_id` = ' . $role;
        $select->prepareSelectRaw( $query );

        return self::$db->selectRaw($select);
    }
    
    public static function getPermissions() {
        $select = new Select();
        $select->from(self::$table, "*");
        
        return self::$db->select($select);
    }
    
    public static function getPermissionsRoles() {
        $select = new Select();
        $select->from('permissions_roles', "*");
        
        return self::$db->select($select);
    }
    
    public static function hasPermission($permission_id, $role_id, $permissions_roles) {
        if ( count($permissions_roles) > 0 ) {
            foreach ($permissions_roles as $item) {
                if ($item['permission_id'] == $permission_id && $item['role_id'] == $role_id ) {
                    return true;
                }
            }
        }
        
        return false;
    }
    


}
