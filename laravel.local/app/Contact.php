<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name','email','message'];
    
    public $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required'
    ];
    
}
