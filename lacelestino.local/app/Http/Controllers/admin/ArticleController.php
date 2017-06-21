<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;

use App\Category;

use Config;
use Gate;
use App\Article;

class ArticleController extends AdminController
{
    protected $articleRepository;
    protected $categoryRepository;
    
    public function __construct(
        ArticleRepository $articleRepository, 
        CategoryRepository $categoryRepository
    ) {
        parent::__construct();
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $this->title = 'Менеджер статей';
        if ( Gate::denies( 'view', new Article ) ) {
            abort(403);
        }
        $articles = $this->articleRepository->getArticles( 
            Config::get( 'settings.pagginate_articles_admin' )
        );
        $this->out['content'] = view('admin.article.articles_content')->
                with(['articles' => $articles, 'denies' => $this->allDenies() ])->render();
        
        return $this->renderOutput();
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Gate::denies( 'add', new Article ) ) {
            abort(403);
        }
        $this->title = "Добавить новый материал";
        $categories = $this->categoryRepository->getAll( ['title', 'parent_id','id'] );
        $lists = [];
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $lists[$category->title] = [];
            } else {
                $lists[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }
        $this->out['content'] = view('admin.article.articles_create_content')->
            with([ 'categories' =>$lists ])->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        if ( Gate::denies( 'add', new Article ) ) {
            abort(403);
        }
        $result = $this->articleRepository->addArticle($request);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/articles')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if ( Gate::denies( 'update', new Article ) ) {
            abort(403);
        }
        $article->img = json_decode($article->img);
        $categories = $this->categoryRepository->getAll( ['title', 'parent_id','id'] );
        $lists = array();
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $lists[$category->title] = array();
            } else {
                $lists[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }
        $this->title = 'Реадактирование материала - ' . $article->title;
        $this->out['content'] = view('admin.article.articles_create_content')->
            with([
                'categories' => $lists,
                'article' => $article
            ])->render();

        return $this->renderOutput();
    }
    
    private function allDenies() {
        return [
            'add' => Gate::denies( 'add', new Article ),
            'update' => Gate::denies( 'update', new Article ),
            'delete' => Gate::denies( 'delete', new Article )
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        if ( Gate::denies( 'update', new Article ) ) {
            abort(403);
        }
        $result = $this->articleRepository->updateArticle($request, $article);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/articles')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ( Gate::denies( 'delete', new Article ) ) {
            abort(403);
        }
        $result = $this->articleRepository->deleteArticle($article);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/articles')->with($result);
    }
}
