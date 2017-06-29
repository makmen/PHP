<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Category;

use Config;

class CategoryController extends AdminController
{

    public function __construct( CategoryRepository $categoryRepository ) {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->dirResource = 'category';
    }
    
    public function index()
    {
        $this->title = 'Категории товаров';
        $categories  = $this->categoryRepository->getCategories( Config::get('settings.pagginate_categories_admin') );
       
        $this->out['content'] = view( 'admin.' . $this->dirResource.'.content')->
                with('categories', $categories )->render();

        return $this->renderOutput();
    }

    public function create()
    {
        $this->title = "Добавить новую категорию";
        $this->out['content'] = view( 'admin.' . $this->dirResource.'.update' )->
            with([
                'categories' => $this->categoryRepository->buildTreeCategories()
            ])->render();

        return $this->renderOutput();
    }

    public function store(CategoryRequest $request)
    {
        $result = $this->categoryRepository->add($request);
        if (is_array($result) && !empty($result['error_message'])) {
            return back()->with($result);
        }

        return redirect('/admin/categories')->with($result);
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        $this->title = 'Реадактирование категории - ' . $category->title;
        $this->out['content'] = view('admin.' . $this->dirResource.'.update')->
            with([
                'category' => $category, 
                'categories' => $this->categoryRepository->buildTreeCategories()
            ])->render();

        return $this->renderOutput();
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $result = $this->categoryRepository->update($request, $category);
        if (is_array($result) && !empty($result['error_message'])) {
            return back()->with($result);
        }

        return redirect('/admin/categories')->with($result);
    }

    public function destroy($id)
    {
        //
    }
    
}
