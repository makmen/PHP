<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name','text','website','email','user_id','article_id','parent_id', 'user_id'];
    
    public function article() {
        return $this->belongsTo('App\Article');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
