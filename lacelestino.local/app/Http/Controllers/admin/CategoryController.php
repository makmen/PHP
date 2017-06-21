<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use Config;
use App\Repositories\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use App\Category;

use Gate;

class CategoryController extends AdminController
{
    protected $categoryRepository;
    
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $this->title = 'Менеджер статей';
        if ( Gate::denies( 'view', new Category ) ) {
            abort(403);
        }
        $categories = $this->categoryRepository->getAll( 
            '*', Config::get( 'settings.pagginate_categories' )
        );
        $categories = $this->categoryRepository->defineParent($categories);
        $this->out['content'] = view('admin.category.content')->
                with([
                    'categories' => $categories,
                    'denies' => $this->allDenies()
                ])->render();

        return $this->renderOutput();
    }
    
    private function allDenies() {
        return [
            'add' => Gate::denies( 'add', new Category ),
            'update' => Gate::denies( 'update', new Category ),
            'delete' => Gate::denies( 'delete', new Category )
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Gate::denies( 'add', new Category ) ) {
            abort(403);
        }
        $this->title = "Добавить новую категорию";
        $this->out['content'] = view('admin.category.create_content')->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ( Gate::denies( 'add', new Category ) ) {
            abort(403);
        }
        $result = $this->categoryRepository->addCategory($request);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/categories')->with($result);
    }

    /**1
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if ( Gate::denies( 'update', new Category ) ) {
            abort(403);
        }
        $this->title = 'Реадактирование материала - ' . $category->title;
        $this->out['content'] = view('admin.category.create_content')->
                with(['category' => $category ])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ( Gate::denies( 'update', new Category ) ) {
            abort(403);
        }
        $result = $this->categoryRepository->updateCategory($request, $category);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/categories')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // удаление категории ведет к удалению всех статей и их коментов
    }
}
