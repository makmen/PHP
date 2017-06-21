<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class AboutController extends AppController
{

    public function __construct( ) {
        parent::__construct();
        $this->dirResource = 'about';
        $this->template = $this->dirResource . '.index';
    }
    
    public function index() {
        $this->out['page_meta'] = view($this->dirResource . '.page_meta')->render();
        $this->out['content'] = view($this->dirResource . '.content')->
            with([
                'portfolios' => $this->portfolioRepository->getSeveralPortfolios( Config::get( 'settings.footer_portfolios' ))
            ])->render();      
        
        return $this->renderOutput();
    }
    
}
