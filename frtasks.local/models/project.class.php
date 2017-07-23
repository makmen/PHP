<?php

class Project extends ObjectDB {

    protected static $table = "projects";
    protected $timeBehavior = true;
    
    public static $color = array(
        'grey', 'blue', 'red', 'green', 'yellow', 'orange', 'pink', 'lightSalmon', 'mediumVioletRed'
    );

    public function __construct() {
        parent::__construct(self::$table);
        $this->add("title", "ValidateTitle" );
        $this->add("user_id", "ValidateID");
        $this->timeBehavior();
    }

    protected function postLoad() {
        $user = User::getAuthUser();
        $this->user_id = $user['id'];
    }

    public static function getSessionProject() {
        if ( !empty($_SESSION["project"]) ) {
            return $_SESSION["project"];
        }

        return false;
    }
    
    public static function getProjects( $pagination ) {
        $select = new Select();
        $select->from(static::$table, array("id") )
            ->order("id", false)    
            ->limit($pagination->on_page, $pagination->offset);
        $projects = self::$db->select($select, true);
        $keys = array_keys($projects);
        $projects = self::getProjectsTasks($keys);
        
        $list = array();
        if ( count($projects) > 0 ) {
            foreach ($projects as $item) {
                $key = $item['id'];
                if (!isset($list[$key])) {
                    $list[$key]['id'] = $item['id'];
                    $list[$key]['title'] = $item['title'];
                    $list[$key]['user_id'] = $item['user_id'];
                    $list[$key]['tasks'] = array();  
                }

                if ($item['trecker']) {
                    $list[$key]['tasks'][] = array( 
                        'trecker' => $item['trecker'], 
                        'cnt' => $item['cnt'] 
                    );
                }
            }
        }

        return Task::addZeroCnt( array_values($list) );
    }
    
    public static function getProjectsTasks( $in ) {
        $select = new Select();
        $query =
            'SELECT `projects`.id, `projects`.title,`projects`.user_id, `tasks`.`trecker`, count(`tasks`.`trecker`) as cnt '
            . 'FROM ' 
            . self::$db->getTableName('projects') .' as projects LEFT JOIN '
            . self::$db->getTableName('tasks') .' as tasks ON (projects.id = tasks.project_id) '
            . ' WHERE projects.id IN (' . implode(",", $in) . ') '
            . ' GROUP BY projects.id, tasks.`trecker` ' 
            . ' ORDER BY `projects`.id DESC';

        $select->prepareSelectRaw( $query );
        
        return self::$db->selectRaw($select);
    }
    
    public static function getProject($id) {
        return parent::getById($id, self::$table);
    }

}
