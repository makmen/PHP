<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','content'];
    
    public $rules = [
        'title' => 'required|max:255',
        'content' => 'required',
        'country' => 'required',
    ];
}
