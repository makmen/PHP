<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PortfolioRepository;
use App\Portfolio;

use Config;

class PortfolioController extends AppController
{
    
    public function __construct() {
        parent::__construct();
        $this->dirResource = 'portfolio';
        $this->template = $this->dirResource . '.index';
    }  

    public function index() {
        $this->title = 'Портфолио';
        $this->metaKeywords = 'Портфолио';
        $this->metaDescription = 'Портфолио';
        $portfolios = $this->portfolioRepository->getPortfolios( Config::get( 'settings.pagginate_portfolios')  );
        $this->out['content'] = view($this->dirResource . '.content')->
            with( 'portfolios', $portfolios )->render();
        
        return $this->renderOutput();
    }
    
    public function show($id = 0)
    {
        $portfolio = $this->portfolioRepository->one($id);
        if($portfolio) {
            $portfolio->img = json_decode($portfolio->img);
        } else {
            abort(404);
        }
        $otherProjects = $this->portfolioRepository->getPortfoliosOtherProjects(
            $portfolio->id, Config::get( 'settings.portfolios_other_projects')
        );
        $this->title = $portfolio->project;
        $this->out['page_meta'] = '';
        $this->out['content'] = view($this->dirResource . '.show')->
            with([
                'portfolio' => $portfolio,
                'otherProjects' => $otherProjects,
        ])->render();        
        
        return $this->renderOutput();
    }
    
}
