<?php

class History extends ObjectDB {

    protected static $table = "history_tasks";
    protected $timeBehavior = true;
    
    public static $editedInHistory = array( "trecker", "priority", "status", "executor" );
    

    public function __construct() {
        parent::__construct(self::$table);
        $this->add("comment", "ValidateTextEmpty", "" );
        $this->add("trecker", "ValidateIDs" );
        $this->add("priority", "ValidateIDs" );
        $this->add("status", "ValidateIDs");
        $this->add("executor", "ValidateIDs"); // может быть 0        
        $this->add("user_id", "ValidateID"); // author
        $this->add("task_id", "ValidateID"); // task
        $this->timeBehavior();
    }

    protected function postLoad() {
        $this->task_id = (int)URL::$id;;
    }
    
    protected  function preInsert() {
        $this->trecker = Task::$trecker{$this->trecker};
        $this->priority = Task::$priority{$this->priority};
        $this->status = Task::$status{$this->status};
    }

    public static function getUpdatedDataFromHistory(&$tasks, $whereIn) {
        if (!empty($tasks)) {
        $query =
            'SELECT hr.* FROM ('
            . ' SELECT history_tasks.id as h_id, history_tasks.task_id as id, history_tasks.trecker,'
            . ' history_tasks.priority, history_tasks.status, history_tasks.executor  '
            . ' FROM ' . self::$db->getTableName('history_tasks') .' as history_tasks '
            . ' WHERE history_tasks.task_id  IN  (' . $whereIn . ')' 
            . ' ORDER BY history_tasks.id DESC ) as hr '
            . ' GROUP BY hr.id ';

            $select = new Select();
            $select->prepareSelectRaw( $query );
            $data = self::$db->selectRaw($select, true);
            $users = User::getAllUser(true);
            foreach ($tasks as $k=>$v) {
                if (array_key_exists($v['id'], $data)) {
                    $tasks[$k]['trecker'] = $data[$v['id']]['trecker'];
                    $tasks[$k]['priority'] = $data[$v['id']]['priority'];
                    $tasks[$k]['status'] = $data[$v['id']]['status'];
                    $tasks[$k]['executor'] = $data[$v['id']]['executor'];
                    $tasks[$k]['name_executor'] = $users[$tasks[$k]['executor']]['name'];
                }
            }
        }
    }
    
    public static function getTask($id) {

    }
    
    public static function getLastHistory($task_id) {
        $select = new Select();
        $select->from(self::$table, "*")            
                ->where("`task_id` = " . self::$db->getSQ(), array($task_id) )
                ->order('id', false);

        return self::$db->selectOne($select);
    }


    public static function getAllHistory($task_id) {
        $select = new Select();
        $query =
            'SELECT history_tasks.*, users.name as history_updated, executor.name as name_executor  '
            . 'FROM ' 
            . self::$db->getTableName('users') .' as users INNER JOIN '
            . self::$db->getTableName('history_tasks') .' as history_tasks ON (users.id = history_tasks.user_id) '
            . 'left join ' . self::$db->getTableName('users') . ' executor ON (history_tasks.`executor` = executor.id) '
            . 'WHERE history_tasks.task_id = ' . $task_id;
        $select->prepareSelectRaw( $query );
        
        return self::$db->selectRaw($select);
    }

   
}
