<?php

class ProjectController extends Controller {
    
    public function actionIndex() {
        $this->title = "Менеджер проектов";
        $this->meta_desc = "менеджер проектов";
        $this->meta_key = "менеджер проектов";
        $this->out['titlePage'] = "Проекты";
        
        if ( User::accessDenied( 'VIEW_ALL_PROJECTS' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        
        if ( !User::accessDenied( 'ADD_PROJECT' ) ) {
            $this->out['canAdd'] = true;
        }

        if (isset($_SESSION["message"])) {
            $this->out['message'] = $_SESSION["message"];
            unset($_SESSION["message"]);
        }
        
        $this->out['user'] = $this->auth_user;
        $this->out['pagination'] = $this->getPagination(
            Project::getCount(), Config::COUNT_PROJECTS_ON_PAGE, URL::$currentUrl
        );
        $this->out['projects'] = Project::getProjects( $this->out['pagination'] );

        $this->render("project/index");
    }
    
    public function actionView() {
        $id = URL::$id;
        if (!$id) {
            $this->redirect( URL::buildUrl(URL::$controller) );
        }
        $project = Project::getProject($id);
        if ($project) {
            $_SESSION["project"] = $project;
        }

        $this->redirect( URL::buildUrl('task', 'view') );
    }
    
    public function actionAdd() {
        $this->title = "Добавить новый проект";
        $this->meta_desc = "Добавить новый проект";
        $this->meta_key = "Добавить новый проект";
        $this->out['titlePage'] = "Добавить проект"; 
        
        if ( User::accessDenied( 'ADD_PROJECT' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);        
        if ( Request::$requestMethodPost ) {
            $this->out['project'] = new Project();
            $this->out['project']->loadModel( $this->request->getData() );
            
            $result = $this->out['project']->save();
            if ($result) {
                $this->out['ok'] = 'Проект  добавлен';
                $this->out['project'] = new Project();
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['project']->getErrors() );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
        }

        $this->render("project/add");
    }
    
    public function actionEdit() {
        $this->title = "Редактирование проекта";
        $this->meta_desc = "Редактирование проекта";
        $this->meta_key = "Редактирование проекта";
        $this->out['titlePage'] = "Редактирование проекта";
        
        if ( User::accessDenied( 'EDIT_PROJECT' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        $this->breadcrumb->addData($this->out['titlePage'], URL::$currentUrl);  
        
        $id = (int)URL::$id;
        $project = Project::getProject($id);
        if (!$project || $project['user_id'] != $this->auth_user['id'] ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }

        $this->out['project'] = new Project();
        $this->out['project']->loadModel($project, $id);

        if ( Request::$requestMethodPost ) {
            $this->out['project']->loadModel( $this->request->getData(), $this->out['project']->getId());
            $result = $this->out['project']->save();
            if ($result) {
                $this->out['ok'] = 'Данные обновлены';
            } else {
                $this->out['errors'] = $this->message->getErrors( $this->out['project']->getErrors() );
                $this->out['allErrors'] = $this->view->render("errors/validator", $this->out, true);
            }
            
        }

        $this->render("project/add");
    }
   
}
