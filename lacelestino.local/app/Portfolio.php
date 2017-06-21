<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['project', 'text', 'img', 'customer', 'user_id'];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
