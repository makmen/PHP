<?php

class Task extends ObjectDB {

    protected static $table = "tasks";
    protected $timeBehavior = true;
    
    public static $trecker = array(
        1 => "Bug", 
        2 => "Support", 
        3 => "Feature",
        4 => "Research",
        5 => "Request", 
        6 => "Idea"
    );
    public static $priority = array(
        "Low", "Normal", "High", "Urgent", "Immediate"
    );
    public static $status = array(
        "New", "In progress", "Resolved", "Feedback",
        "For test", "Rejected", "Approved", "For upload", "Closed"
    );

    public function __construct() {
        parent::__construct(self::$table);
        $this->add("title", "ValidateTitle" );
        $this->add("content", "ValidateText" );
        $this->add("trecker", "ValidateIDs" );
        $this->add("priority", "ValidateIDs" );
        $this->add("status", "ValidateIDs", 0);
        $this->add("executor", "ValidateIDs"); // может быть 0        
        $this->add("user_id", "ValidateID"); // author
        $this->add("project_id", "ValidateID"); // author
        $this->add("comment", "ValidateTextEmpty", "" );
        $this->add("task_id_updated", "ValidateIDs", 0);    
        $this->timeBehavior();
    }
    
    public static function setEnumParam($model) {
        $key = array_search($model->status, Task::$status);
        $model->status = ($key !== false) ? $key : $model->status;

        $key = array_search($model->trecker, Task::$trecker);
        $model->trecker = ($key !== false) ? $key : $model->trecker;

        $key = array_search($model->priority, Task::$priority);     
        $model->priority = ($key !== false) ? $key : $model->priority;
    }
    
    public static function getNameTreker($id) {
        $trecker = '';
        if ( $id != '' && isset( self::$trecker[$id] )) {
            $trecker =  self::$trecker[$id];
        }
        
        return $trecker;
    }
    
    public static function getTreckerCnt($item, $trecker ) {
        if ( empty($item['tasks']) ) {
            return 0;
        }
        foreach ($item['tasks'] as $k => $v) {
            if ($v['trecker'] == $trecker) {
                return $v['cnt'];
            }
        }
        
        return 0;
    }

    public static function addZeroCnt($projects) {
        foreach ($projects as $key => $item) {
            $projects[$key]['color'] = Project::$color[$key];
            $summa = 0;
            foreach (Task::$trecker as $trecker) {
                $cnt = self::getTreckerCnt( $item, $trecker );
                if ( $cnt > 0) {
                    $summa += $cnt;
                } else {
                    $projects[$key]['tasks'][] = array( 'trecker' => $trecker, 'cnt' => 0);
                }
            }
            $projects[$key]['totalCnt'] = $summa;
        }

        return $projects;
    }

    public static function getTask($id) {
        $select = new Select();
        $query =
            'SELECT tasks.*, users.name, executor.name as name_executor, updated.name as history_updated '
            . 'FROM ' 
            . self::$db->getTableName('users') .' as users INNER JOIN '
            . self::$db->getTableName('tasks') .' as tasks ON (users.id = tasks.user_id) '
            . 'left join ' . self::$db->getTableName('users') . ' executor ON (tasks.`executor` = executor.id) '
            . 'left join ' . self::$db->getTableName('users') . ' updated ON (tasks.`task_id_updated` = updated.id) '
            . 'WHERE tasks.id = ' . $id ;
        
        $select->prepareSelectRaw( $query );
        
        return self::$db->selectRawOne($select);
    }
    
    protected function postLoad() {
        if (!$this->id) {
            $user = User::getAuthUser();
            $this->user_id = $user['id'];
        }
        $this->task_id = (int)URL::$id;;
    }

    protected  function preSave() {
        $this->trecker = Task::$trecker{$this->trecker};
        $this->priority = Task::$priority{$this->priority};
    }
    
    protected  function preInsert() {
        $this->status = 'New';
    }

    protected  function preUpdate() {
        $this->status = Task::$status{$this->status};
    }
    
    public static function getCountPagination($id = '', $project) {
        $select = new Select();
        $select->from(static::$table, array("COUNT(id)") )->
            where('project_id = ' . $project);
        if ($id != '') {
            if ( isset( Task::$trecker[$id] )) {
                $select->where("`trecker` = " . self::$db->getSQ(), array( Task::$trecker[$id] ));
            }
        }
        $res = array_values( self::$db->selectOne($select) );
        
        return reset($res);
    }

    public static function getTasks($id = '', $project, $pagination) {
        $select = new Select();
        $query =
            'SELECT tasks.*, users.name, executor.name as name_executor  '
            . 'FROM ' 
            . self::$db->getTableName('users') .' as users INNER JOIN '
            . self::$db->getTableName('tasks') .' as tasks ON (users.id = tasks.user_id) '
            . 'left join ' . self::$db->getTableName('users') . ' executor ON (tasks.`executor` = executor.id) '
            . ' WHERE project_id = ' . $project; 

        $values = array();
        if ($id != '') {
            if ( isset( Task::$trecker[$id] )) {
                $query .= ' AND trecker = ' . self::$db->getSQ();
                $values[] = Task::$trecker[$id];
            }
        }
        $order = ' ORDER BY id DESC ';
        $limit = ' LIMIT ' . $pagination->offset . ',   ' . $pagination->on_page;
        
        $select->prepareSelectRaw( $query . $order . $limit, $values );
        
        return self::$db->selectRaw($select, true);
    }
    
    private function cleanStatuses($statuses, $allowed) {
        $newStatused = array();
        foreach ($allowed as $item) {
            $key = array_search($item, $statuses);
            $newStatused[$key] = $item;
        }
        
        return $newStatused;
    }
    
    public function canUpdateAllfields($auth_user, $owner, &$statuses) {
        $canUpdateAllfields = false;

        if ($auth_user['role_id'] == Role::$roleAdmin || $auth_user['role_id'] == Role::$roleManager) {
            $canUpdateAllfields = true;
        }
        
        if ($auth_user['id'] == $owner['id']) {
            $canUpdateAllfields = true;
        }
        if ($canUpdateAllfields && $this->status == 'Closed' ) {
            $statuses = $this->cleanStatuses($statuses, array( $this->status, "Feedback" ));
        }
        
        return $canUpdateAllfields;
    }
    
    public function canUpdateStatus($auth_user, &$statuses) {
        $canUpdateStatus = false;
        
        if ($auth_user['role_id'] != Role::$roleDeveloper && $auth_user['role_id'] != Role::$roleReporter) {
            return $canUpdateStatus;
        }

        if ($auth_user['role_id'] == Role::$roleDeveloper) {
            $allowed = array( "New", "In progress", "Resolved", "Feedback", "Rejected" );
        }
        if ($auth_user['role_id'] == Role::$roleReporter) {
            $allowed = array( "For test" );
        }
        
        if ( in_array($this->status, $allowed) ) {
            $canUpdateStatus = true;
        }

        if ( $canUpdateStatus ) {
            switch ( $this->status ) {
                case "New":
                    $allowed = array($this->status, "In progress", "Resolved");
                    break;
                case "In progress":
                    $allowed = array($this->status, "Resolved", "For test");
                    break;
                case "Resolved":
                    $allowed = array($this->status, "For test");
                    break;
                case "Feedback":
                    $allowed = array($this->status, "For test");
                    break;
                case "Rejected":
                    $allowed = array($this->status, "For test");
                    break;
                case "For test":
                    $allowed = array($this->status, "Feedback", "Rejected", "Approved");
                    break;
            }
                        
            $statuses = $this->cleanStatuses($statuses,$allowed);
        }

        return $canUpdateStatus;
    }

   
}
