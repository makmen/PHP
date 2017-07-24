<?php

class PermissionController extends Controller {

    public function actionIndex() {
        $this->title = "Привилегии пользователей";
        $this->meta_desc = "Привилегии пользователей";
        $this->meta_key = "Привилегии пользователей";
        $this->out['titlePage'] = "Привилегии пользователей";

        if ( User::accessDenied( 'VIEW_ALL_PERMISSIONS' ) ) {
            $this->accessDenied();
            throw new Exception("ACCESS_DENIED");
        }
        
        if ( !User::accessDenied( 'EDIT_ALL_PERMISSIONS' ) ) {
            $this->out['canEdit'] = true;
        }
        
        $this->breadcrumb->setDefault(URL::buildUrl(URL::$controller, 'index'));

        $this->out['roles'] = Role::getAllRoles();
        $this->out['permissions'] = Permission::getPermissions();
        $this->out['permissions_roles'] = Permission::getPermissionsRoles();

        if ( Request::$requestMethodPost ) {
            
            if ( User::accessDenied( 'EDIT_ALL_PERMISSIONS' ) ) {
                $this->accessDenied();
                throw new Exception("ACCESS_DENIED");
            }
            
            $success = true;
            $data = $this->request->getData();
            
            foreach ($this->out['roles'] as $role) {
                if (isset($data[$role['id']])) {
                    $success = Role::savePermissions($role, $data[$role['id']]);
                } else {
                    $success = Role::savePermissions($role, []);      
                }
                if (!$success) {
                    break;
                }
            }
           
            if ($success) {
                $this->out['ok'] = 'Данные обновлены';
                $this->out['permissions_roles'] = Permission::getPermissionsRoles();
            } else {
                $this->out['error'] = 'Ошибка обновления данных';
            }
            
        }

        $this->render("permission/index");
    }
    
}
