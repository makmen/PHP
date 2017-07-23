<?php

class User extends ObjectDB {

    protected static $table = "users";
    protected $timeBehavior = true;

   
    public function __construct() {
        parent::__construct(self::$table);
        $this->add("login", "ValidateLogin" );
        $this->add("name", "ValidateName" );
        $this->add("email", "ValidateEmailUnique" );
        $this->add("password", "ValidatePassword" );
        $this->add("repassword", "ValidateRePassword", null, false);
        $this->add("activation", "ValidateActivation", $this->getKey());
        $this->add("role_id", "ValidateIDs", Role::$roleDefault);
        $this->add("role_name", "ValidateNameEmpty", null, false);
        $this->add("captcha", "ValidateCaptcha", null, false);
        $this->timeBehavior();
    }
    
    public function setProperty($field, $validator) {
        $this->add( $field, $validator );
    }

    public static function getAuthUser() {
        if ( !empty($_SESSION["user"]) ) {
            return $_SESSION["user"];
        }

        return false;
    }
    
    public static function getAllUser($byId = false) {
        return parent::getAll(self::$table, $byId);
    }
    
    public static function getUser($id) {
        return parent::getById($id, self::$table);
    }
    
    public static function getUserByEmail($email) {
        $select = new Select();
        $select->from(self::$table, "*")
            ->where("`email` = " . self::$db->getSQ(), array($email) ) ;
            
        return self::$db->selectOne($select);
    }

    public static function setAuthUser($user) {
        if (is_object($user)) {
            $user = $user->toRequiredArray();
        }
        $user['permissions'] = Permission::getAllPermisssions($user['role_id']);
        $_SESSION["user"] = $user;
    }
    
    public static function getAllUserRoles( $pagination ) {
        $select = new Select();
        $query =
            'SELECT users.*, roles.name as role_name '
            . 'FROM ' 
            . self::$db->getTableName('users') .' as users INNER JOIN '
            . self::$db->getTableName('roles') .' as roles ON (users.role_id = roles.id) '
            . ' ORDER BY users.id '
            . ' LIMIT ' . $pagination->offset . ',   ' . $pagination->on_page;

        $select->prepareSelectRaw( $query );
        
        return self::$db->selectRaw($select);
    }
    
    public static function check($login = '', $password = '') {
        if ($login == '' || $password == '') {
            return false;
        }
        $password = self::hash($password, Config::SECRET);
        $select = new Select();
        
        $query =
            'SELECT users.*, roles.name as role_name '
            . 'FROM ' 
            . self::$db->getTableName('users') .' as users INNER JOIN '
            . self::$db->getTableName('roles') .' as roles ON (users.role_id = roles.id) '
            . 'WHERE `login` = ' . self::$db->getSQ() . ' AND '
            . ' `password` = ' . self::$db->getSQ();
        
        $select->prepareSelectRaw( $query, array($login, $password) );
        $user = self::$db->selectRawOne($select);
        /* $select->from(self::$table, '*')
                ->where("`login` = " . self::$db->getSQ(), array($login))
                ->where("`password` = " . self::$db->getSQ(), array($password));*/
        // $user = self::$db->selectOne($select);
        if ($user) {
            User::setAuthUser($user);
            return true;
        }

        return false;
    }
    
    public function uniqueParam($value, $param, $id) {
        $select = new Select();
        if ($id) {
            $select->from(User::$table, ["id"])
                    ->where('`' . $param . '` = ' . self::$db->getSQ(), array($value))
                    ->where('`id` <> ' . $id);
        } else {
            $select->from(User::$table, ["id"])
                    ->where('`' . $param . '` = ' . self::$db->getSQ(), array($value));
        }
        $res = self::$db->selectOne($select);
        if (self::$db->selectOne($select)) {
            return false;
        } else {
            return true;
        }
    }

    protected function postValidate() {
        $this->password = self::hash($this->password, Config::SECRET);

        return true;
    }

    public function logout() {
        if (!session_id())
            session_start();
        session_destroy();

    }

    public function getAvatar() {
        $avatar = basename($this->avatar);
        if ($avatar != Config::DEFAULT_AVATAR)
            return $avatar;
        return null;
    }

    public function getSecretKey() {
        return self::hash($this->email . $this->password, Config::SECRET);
    }
   
    
    public static function denied($field, $permissions, $require = false) {
        if (!is_array($field)) {
            foreach ($permissions as $item) {
                if ( $field == $item['name'] ) {
                    return FALSE;
                }
            }
            
            return TRUE;
            
        } else {
            foreach ($field as $item) {
                $item = self::denied($item);
                if ($item && !$require) {
                    return TRUE;
                } else if (!$item && $require) {
                    return FALSE;
                }
            }
        } 
    }

    

}
