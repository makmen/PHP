<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use App\Repositories\CategoryRepository;

use Config;

class ArticleController extends AppController
{
    protected $commentRepository;
    protected $categoryRepository;
    
    public function __construct(
        CommentRepository $commentRepository,
        CategoryRepository $categoryRepository
    ) {
        parent::__construct();    
        $this->commentRepository = $commentRepository;    
        $this->categoryRepository = $categoryRepository;  
        $this->dirResource = 'article';
        $this->template = $this->dirResource . '.index';
    }
    
    public function index($category = '0') {
        $modelCategory = false;
        if ($category > 0) {
            $modelCategory = $this->categoryRepository->getById($category);
            if (!$modelCategory ) {
                abort(404);
            }
            if (!$modelCategory->parent_id) {
                $category = 0;
            }
        }
        $this->out['page_meta'] = view($this->dirResource . '.page_meta')->
                with('category', $modelCategory )->render();
        $articles = $this->articleRepository->getArticles(
            Config::get( 'settings.pagginate_articles' ), $category 
        );
        $this->out['content'] = view($this->dirResource . '.content')->
                with( ['articles' => $articles ] )->render();
        
        return $this->renderOutput();
    }
    
    public function show($id = 0)
    {
        $article = $this->articleRepository->one($id, ['comments' => TRUE]);
        if($article) {
            $article->img = json_decode($article->img);
        } else {
            abort(404);
        }
        
        $this->title = $article->title;
        $this->metaKeywords = $article->keywords;
        $this->metaDescription = $article->description;
        
        $this->out['page_meta'] = view($this->dirResource . '.article_page_meta')->
                with('article',$article)->render();
        $this->out['content'] = view($this->dirResource . '.article_content')->
            with([
                'article' => $article, 
                'portfolios' => $this->portfolioRepository->getSeveralPortfolios( Config::get( 'settings.footer_portfolios' ))
        ])->render();        
        
        return $this->renderOutput();
    }
    
    
    
}
