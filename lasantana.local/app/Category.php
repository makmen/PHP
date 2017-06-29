<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [ 'title', 'parent_id', 'keywords', 'description'];
    
    public function products() {
        return $this->hasMany('App\Product');
    }
    
    
}
