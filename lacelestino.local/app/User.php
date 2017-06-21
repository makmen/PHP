<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'name', 'lastname', 'email', 'phone', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function articles() {
        return $this->hasMany('App\Article');
    }
    
    public function portfolios() {
        return $this->hasMany('App\Portfolio');
    }
    
    public function role() {
        return $this->belongsTo('App\Role');
    }
    
    public function denied($permission, $require = false) {
        if (!is_array($permission)) {
            foreach ($this->role->permissions as $item) {
                if (str_is($permission, $item->name)) {
                    return TRUE;
                }
            }
            return FALSE;
        } else {
            // потестить !!!
            foreach ($permission as $item) {
                $item = $this->denied($item);
                if ($item && !$require) {
                    return TRUE;
                } else if (!$item && $require) {
                    return FALSE;
                }
            }
            
        }
    }
    
}
