<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ProductRepository;

use Route;
use Storage;
use Config;

class IndexController extends AppController
{
    protected $productRepository;
    
    public function __construct( ProductRepository $productRepository ) {
        parent::__construct();
        $this->dirResource = 'index';
        $this->productRepository = $productRepository;
    }
    
    public function index(Request $request) {
        $slider = view($this->template . '.slider')->render();
        
        $newProducts = view($this->template . '.newProducts')->
            with([
                'slider' => $slider,
                'newProducts' => $this->productRepository->getNewProducts( Config::get('settings.newproducts') ),
            ])->render();
        $this->out['content'] = view($this->template . '.content')->
            with([
                'slider' => $slider,
                'newProducts' => $newProducts,
            ])->render();
        
        return $this->renderOutput();
    }

    
}
