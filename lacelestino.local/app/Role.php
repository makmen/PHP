<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users() {
        return $this->hasMany('App\User');
    }
    
    public function permissions() {
        return $this->belongsToMany('App\Permission', 'permissions_roles');
    }
    
    public function hasPermission($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->permissions as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }
    
    public function savePermissions($inputPermissions) {
        if (!empty($inputPermissions)) {// не пустой масив
            /*
             * sync служит для синхронизации связанных моделей через связующую таблицу
             * в соответствии со списком идентификаторов
             */
            $this->permissions()->sync($inputPermissions); // синхронизация 
        } else {
            /*
             * противоположное sync то есть удаление
             */
            $this->permissions()->detach();
        }

        return TRUE;
    }
    
}
