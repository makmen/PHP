<?php

class Menu extends ObjectDB {

    protected static $table = "menus";

    public function __construct() {
        parent::__construct(self::$table);
        $this->add("id", "ValidateID");
        $this->add("title", "ValidateTitle");
        $this->add("path", "ValidateTitle");
        $this->add("parent", "ValidateID");
    }
    
    public static function getMainMenu($module) {
        $whereIn = array(0);
        foreach ($module->auth_user['permissions'] as $permission ) {
            $whereIn[] = $permission['id'];
        }

        $select = new Select();
        $select->from(self::$table, "*")
                ->whereIn('permission_id', $whereIn);
        $data = self::$db->select($select, true);
        
        $items = array();
        foreach ($data as $k=>$v) {
            if ($v['parent']) {
                $items[$v['parent']]['children'][] = $v;
            } else {
                $items[$k] = $v;
            }
        }
        $module->items = $items;
    }
    
    public static function getItemMenu($id) {
        return parent::getById($id, self::$table);
    }
    
    
    
}
