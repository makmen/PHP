<?php

class TaskController extends Controller {

    public function actionIndex() { // add
        $this->title = "Добавить новую задачу"; 
        $this->out['titlePage'] = "Добавить новую задачу";
        $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);
        
        $this->out['trecker'] = Task::$trecker; 
        $this->out['priority'] = Task::$priority; 
        $this->out['users'] = User::getAllUser();
        $this->out['task'] = new Task();
        
        if ( User::accessDenied( 'ADD_TASK' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }

        $project = Project::getSessionProject();
        if (!$project) {
            $_SESSION["message"] = "Выберите проект";
            $this->redirect( URL::buildUrl('project') );
        }
        $this->out['task']->project_id = Project::getSessionProject()['id'];


        if ( Request::$requestMethodPost ) {
            $this->out['task']->loadModel( $this->request->getData() );
            $this->out['task']->content = $_REQUEST['content'];
            $result = $this->out['task']->save();
            if ($result) {
                if ( ($this->out['task']->executor > 0) && 
                        $this->out['task']->executor != $this->out['task']->user_id ) {
                    $this->out['executor'] = User::getUser($this->out['task']->executor);
                    $this->out['owner'] = $this->auth_user;
                    $this->mail->send(
                        $this->out['executor']['email'], $this->out , "newtask"
                    );
                }
                $_SESSION["ok"] = 'Задача добавлена';
                $this->redirect( URL::buildUrl( URL::$controller, 'one', $this->out['task']->getID() ) );
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['task']->getErrors() );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
        }

        $this->render("task/add");
    }
    

    public function actionEdit() {
        $this->title = "Редактирование задачи";
        $this->out['titlePage'] = "Редактирование задачи";
        $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);
        
        $this->out['trecker'] = Task::$trecker; 
        $this->out['priority'] = Task::$priority; 
        $this->out['users'] = User::getAllUser();
        
        $id = (int)URL::$id;
        $this->out['task'] = new Task();
        if (!$this->out['task']->load( $id )) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }

        if ( User::accessDenied( 'EDIT_TASK' ) || $this->auth_user['id'] != $this->out['task']->user_id ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        
        if ($this->out['task']->status != 'New') {
            $this->accessDenied('Редактирование запрещено. Задача уже была обновлена. ');
            throw new Exception("ACCESS_DENIED");
        }

        if ( Request::$requestMethodPost ) {
            $this->out['task']->fieldsDenied = History::$editedInHistory; // denied specific fields 
            $this->out['task']->loadModel( $this->request->getData(), $this->out['task']->getId());
            $this->out['task']->content = $_REQUEST['content'];
            Task::setEnumParam($this->out['task']);
 
            $result = $this->out['task']->save();
            if ($result) {
                
                if ( ($this->out['task']->executor > 0) && 
                        $this->out['task']->executor != $this->out['task']->user_id ) {
                    $this->out['executor'] = User::getUser($this->out['task']->executor);
                    $this->out['owner'] = $this->auth_user;
                    $this->mail->send(
                        $this->out['executor']['email'], $this->out , "newtask"
                    );
                }
                
                $_SESSION["ok"] = 'Задача обновлена';
                $this->redirect( URL::buildUrl( URL::$controller, 'one', URL::$id) );
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['task']->getErrors() );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
        }

        $this->render("task/add");
    }
    
    public function actionView() {
        $this->title = "Задачи";
        $this->out['titlePage'] = "Задачи";
        $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        $trecker = Task::getNameTreker(URL::$id);
        if ($trecker != '') {
            $this->breadcrumb->addData($trecker, URL::$currentUrl);
        }
        
        if ( User::accessDenied( 'VIEW_ALL_TASKS' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }

        if (isset($_REQUEST['pr'])) {
            $project = Project::getProject( (int)$_REQUEST['pr'] );
            if ($project) {
                $_SESSION["project"] = $project;
            }
        } else {
            $project = Project::getSessionProject();
        }
        if (!$project) {
            $_SESSION["message"] = "Выберите проект";
            $this->redirect( URL::buildUrl('project') );
        }
        
        if ( !User::accessDenied( 'ADD_TASK' ) ) {
            $this->out['canAdd'] = true;
        }

        $this->out['pagination'] = $this->getPagination(
            Task::getCountPagination( URL::$id, $project['id'] ), Config::COUNT_TASKS_ON_PAGE, URL::$currentUrl
        );
        $this->out['tasks'] = Task::getTasks( URL::$id, $project['id'], $this->out['pagination'] );

        $this->render("task/view");
    }

    public function actionOne() {
        
        $this->title = "Задачи";
        $this->out['titlePage'] = "Задача #";

        if ( User::accessDenied( 'VIEW_TASK' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        
        $id = (int)URL::$id;
        $this->out['task'] = Task::getTask($id);

        if ( !$this->out['task'] ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }

        if (isset($_SESSION["ok"])) {
            $this->out['ok'] = $_SESSION["ok"];
            unset($_SESSION["ok"]);
        }
        
        if (!User::accessDenied('EDIT_TASK') &&
                $this->auth_user['id'] == $this->out['task']['user_id'] &&
                $this->out['task']['status'] == 'New') {
            $this->out['canEdit'] = true;
        }

        if ( !User::accessDenied( 'ADD_HISTORY' ) ) {
            $this->out['canEditHistory'] = true;
        }

        $this->out['titlePage'] .= $this->out['task']['id'];
        $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);
        
        $this->out['history'] = History::getAllHistory($id);

        if ( !empty($this->out['history']) ) {
            $this->out['revision'] = $this->out['history'][0];
            unset($this->out['history'][0]);
            $this->out['history'][] = $this->out['task'];
        }

        $this->render("task/one");
    }
    
    public function actionUpdate() { 
        $this->title = "Обновление задачи";
        $this->out['titlePage'] = "Обновление задачи ";

        $id = (int)URL::$id;
        if ( User::accessDenied( 'ADD_HISTORY' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        
        $this->out['task'] = new Task();
        if (!$this->out['task']->load( $id )) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        $this->out['titlePage'] .= '#' . $this->out['task']->id;

        $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'view'));
        $this->breadcrumb->addData("Задача #" . $this->out['task']->id, URL::buildUrl(URL::$controller, 'one', $this->out['task']->id));
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);

        $this->out['oldTask'] = clone $this->out['task'];
        
        $this->out['trecker'] = Task::$trecker; 
        $this->out['priority'] = Task::$priority; 
        $this->out['status'] = Task::$status; 
        $this->out['users'] = User::getAllUser(true);
        
        $this->out['owner'] = $this->out['users'][$this->out['task']->user_id];
        $this->out['canUpdateAllfields'] = $this->out['task']->canUpdateAllfields($this->auth_user, $this->out['owner'], $this->out['status']);
        $this->out['canUpdateStatus'] = true;
        if (!$this->out['canUpdateAllfields']) {
            $this->out['canUpdateStatus'] = $this->out['task']->canUpdateStatus($this->auth_user, $this->out['status']);
        }

        $this->out['history'] = new History();
        $this->out['history']->fieldsDenied = array("comment", "updated");
        $this->out['history']->loadModel( $this->out['task']->toRequiredArray() );

        Task::setEnumParam($this->out['history']);

        if ( Request::$requestMethodPost ) {
            
            // checking right status
            $status = ($_REQUEST['status']) ?? 0; 
            $result = array_key_exists((int)$status, $this->out['status']);

            if ($result) { // work with task
                   $this->out['task']->fieldsDenied = array("title", "content", "user_id", "project_id", "created");
                if ( !$this->out['canUpdateAllfields'] ) {
                    $this->out['task']->fieldsDenied = array_merge(
                        $this->out['task']->fieldsDenied, array ("trecker", "priority",  "executor")
                    );
                    if (!$this->out['canUpdateStatus']) {
                        $this->out['task']->fieldsDenied[] = "status";
                    }
                }
                
                $this->out['task']->loadModel( $this->request->getData(), $this->out['task']->id );
                $this->out['task']->comment = $_REQUEST['comment'];
                
                Task::setEnumParam($this->out['task']);
                $this->out['task']->task_id_updated = $this->auth_user['id']; 
                $this->out['task']->timeBehavior = false; // deny update timeBehavior
                $result = $this->out['task']->save();
            }

            if ($result) { // work with history
                $this->out['history']->user_id = ($this->out['oldTask']->task_id_updated) ?
                    $this->out['oldTask']->task_id_updated : $this->out['oldTask']->user_id;
                $this->out['history']->comment = $this->out['oldTask']->comment;
                $result = $this->out['history']->save();
            }
            
            if ($result) {
                $this->out['currentUser'] = $this->auth_user;
                $this->out['oldExecutor'] = ($this->out['oldTask']->executor > 0) ?
                        $this->out['users'][$this->out['oldTask']->executor] : 0;
                $this->out['executor'] = ($this->out['task']->executor > 0) ?
                        $this->out['users'][$this->out['task']->executor] : 0;

                // send a message to executor
                if ( $this->out['task']->executor > 0 &&
                    $this->out['task']->executor != $this->out['task']->task_id_updated ) {

                    $this->mail->send( $this->out['executor']['email'], $this->out , "updatetask" );
                }

                if ($this->out['oldTask']->status != $this->out['task']->status) {

                    if ($this->out['task']->status == 'For test') { // send a message to testers
                        foreach ($this->out['users'] as $k => $v) {
                            if ($v['role_id'] == Role::$roleReporter) {
                                $this->mail->send( $v['email'], $this->out , "updatetask" );
                            }
                        }
                    }
                    
                    if ( $this->out['task']->status == 'For upload' || $this->out['task']->status == 'Closed' ) { // send  a message to an owner
                        $this->mail->send( $this->out['owner']['email'], $this->out , "updatetask" );
                    }
                    
                }
                
                $_SESSION["ok"] = 'Задача обновлена';
                $this->redirect( URL::buildUrl( URL::$controller, 'one', URL::$id) );
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['history']->getErrors() );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
        }
        
        $this->render("task/update");
    }

    
}
