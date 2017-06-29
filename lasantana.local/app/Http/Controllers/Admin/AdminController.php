<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $title;
    protected $dirResource;
    protected $template = 'admin.index';
    
    protected $categoryRepository;
    protected $productRepository;
    
    protected $out;
    
    public function __construct() {

    }
    
    public function renderOutput() {
        $this->out['title'] = $this->title;

        return view($this->template)->with($this->out);
    }
    
}
