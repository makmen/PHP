<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LavaryMenu;

use App\Repositories\CategoryRepository;
use App\Category;

class AppController extends Controller
{
    protected $dirResource;
    public $template = 'index';
    
    protected $categoryRepository;

    protected $out = [];
    
    protected $title;
    protected $metaKeywords;
    protected $metaDescription;

    public function __construct(  ) {
        $this->categoryRepository = new CategoryRepository( new Category );
    }
    
    protected function renderOutput() {
        $this->out['title'] = $this->title;
        $this->out['metaKeywords'] = $this->metaKeywords;
        $this->out['metaDescription'] = $this->metaDescription;
        
        $this->out['navigation'] = view($this->template . '.navigation')->
            with([
                'menu' => $this->buildMenu()
            ])->render();

        return view($this->template . '.index')->with($this->out);
    }
    
    public function buildMenu() {
        $categories = $this->categoryRepository->getMany()->get();
        if ( count($categories) ) {
            $menu = LavaryMenu::make( 'Navigation', function($menu) use ($categories) {
                foreach($categories as $item) {
                    if ( !$item->parent_id ) {
                        $menu->add($item->title, route('home') . '/category/' . $item->id )->id($item->id);
                    } else {
                        if ( $parent = $menu->find( $item->parent_id ) ) {
                            $parent->add($item->title, route('home') . '/category/' . $item->id )->id($item->id);
                        }

                    }
                }
            });
        }

        return $menu;
    }
    

    
}
