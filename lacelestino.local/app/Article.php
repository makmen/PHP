<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    
    protected $fillable = ['title','img','alias','text','description','keywords','meta_desc','category_id'];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
