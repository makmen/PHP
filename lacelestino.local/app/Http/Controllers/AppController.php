<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Menu;
use App\Article;
use App\Portfolio;
use App\Repositories\MenuRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\PortfolioRepository;

use Config;
use LavaryMenu;
use Illuminate\Support\Facades\Cache;

class AppController extends Controller
{
    protected $dirResource;
    
    protected $menuRepository;
    protected $articleRepository;
    protected $portfolioRepository;

    protected $template;
    protected $out = [];
    
    protected $title;
    protected $metaKeywords;
    protected $metaDescription;

    function getArticleRepository() {
        return $this->articleRepository;
    }

    function getPortfolioRepository() {
        return $this->portfolioRepository;
    }
    
    public function __construct(  ) {
        $this->menuRepository = new MenuRepository( new Menu );
        $this->articleRepository = new ArticleRepository( new Article );
        $this->portfolioRepository = new PortfolioRepository( new Portfolio );
    }
    
    protected function renderOutput() {
        $this->out['title'] = $this->title;
        $this->out['metaKeywords'] = $this->metaKeywords;
        $this->out['metaDescription'] = $this->metaDescription;
        $this->out['navigation'] = view('index.navigation')->
                with('menu', $this->buildMenu() )->render();
        $footerArticles = $this->articleRepository->getSeveralArticles( Config::get( 'settings.footer_articles' ) );
        $footerPortfolios = $this->portfolioRepository->getSeveralPortfolios( Config::get( 'settings.footer_portfolios' ));

        $this->out['footer'] = view('index.footer')->
            with([
                'footerArticles'=> $footerArticles,
                'footerPortfolios'=> $footerPortfolios,
            ])->render();

        return view($this->template)->with($this->out);
    }
    
    public function buildMenu() {
        // Cache::flush();
        $navigation = Cache::remember('menu', 2, function() {
            $menu = $this->menuRepository->getMainMenu();
            if ( count($menu) ) {
                $navigation = LavaryMenu::make( 'Navigation', function($m) use ($menu) {
                    foreach($menu as $item) {
                        if ( !$item->parent ) {
                            $m->add($item->title, $item->path)->id($item->id)->nickname($item->icon);
                        } else {
                            if ( $parent = $m->find($item->parent) ) {
                                $parent->add($item->title, $item->path)->id($item->id)->nickname($item->icon);
                            }
                        }
                    }
                });
            }
            
            return $navigation;
        });

        return $navigation;
    }

    
}
