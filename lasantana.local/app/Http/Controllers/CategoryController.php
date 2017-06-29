<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Category;
use App\Product;

use Session;
use Config;

class CategoryController extends AppController
{
    protected $productRepository;

    public function __construct( ProductRepository $productRepository ) {
        parent::__construct();
        $this->dirResource = 'category';
        $this->productRepository = $productRepository;
    }
    
    public function index($category = '0')
    {
        $category = $this->categoryRepository->getById($category);
        if (!$category) {
            abort(404);
        }
        $pager_select = Config::get('settings.select_pager');
        $pager = Session::get('pager', 0);

        $products = $this->productRepository->getProductsByCategory($category, $pager ?: $pager_select[0]);
        $parent = $this->categoryRepository->getTopParent($category);
        $children = $this->categoryRepository->getWhere('*', ['parent_id' => $parent->id])->get();
        
        $this->out['content'] = view($this->dirResource . '.content')->
            with([
                'parent' => $parent,
                'children' => $children,
                'category' => $category,
                'products' => $products,
                'pager_select' => $pager_select,
                'pager' => array_search($pager, $pager_select),
            ])->render();
        
        return $this->renderOutput();
    }
    
    public function pager() {
        $select = Config::get('settings.select_pager');
        $pager = (int)Input::get('pager');
        if (!in_array($pager, $select)) {
            $pager = $select[0];
        }
        Session::put( 'pager', $pager );
        
        return $pager;
    }
    
    public function search(Request $request)
    {
        $pager_select = Config::get('settings.select_pager');
        $pager = Session::get('pager', 0);

        $search = Input::get('q');
        
        $products = ($search) ? $this->productRepository->getProductsSearch($search, $pager ?: $pager_select[0]) : false;
        $search = '&q=' . $search;

        $this->out['content'] = view($this->dirResource . '.content')->
            with([
                'products' => $products,
                'search' => $search,
                'pager_select' => $pager_select,
                'pager' => array_search($pager, $pager_select),
            ])->render();

        return $this->renderOutput();

            
    }

    
}
