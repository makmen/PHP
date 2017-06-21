<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use App\Repositories\SliderRepository;
use App\Slider;

class IndexController extends AppController
{
    protected $sliderRepository;
    
    public function __construct( SliderRepository $sliderRepository ) {
        parent::__construct();
        $this->sliderRepository = $sliderRepository;
        $this->dirResource = 'index';
        $this->template = $this->dirResource . '.index';
    }
    
    public function index() {
        $this->out['slider'] = view($this->dirResource . '.slider')->
            with('slider', $this->sliderRepository->getAll() )->render();
        $this->out['page_meta'] = view($this->dirResource . '.page_meta')->render();
        $this->out['content'] = view($this->dirResource . '.content')->render();
        
        return $this->renderOutput();
    }
    
    
    
}
