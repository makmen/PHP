<?php

namespace App\Repositories;

use App\Article;
use App\Category;

use Image;
use Config;

class ArticleRepository extends Repository {
    
    public function __construct(Article $model) {
        $this->model = $model;
    }
    
    public function one($id, $attr = []) {
        $article = $this->getById($id);
        if ($article && !empty($attr)) {
            $article->load('comments');
            $article->comments->load('user');
            $article->load('category');
        }

        return $article;
    }
    
    public function getSeveralArticles($take) {
        $articles = $this->getSeveral('*', $take);
        if ( count($articles) > 0) {
            $articles->load('comments');
            $articles->load('user');
        }
        
        return $articles;
    }

    public function getArticles($pagination = 0, $category = 0, $orderBy  = false   ) {
        $builder = $this->get('*');
        if ($category) {
            $builder->where( 'category_id', $category );
        }
        if (!$orderBy) {
            $orderBy = ['id', 'DESC'];
        }
        $builder->orderBy( $orderBy[0], $orderBy[1] );
        $articles = $this->check( $builder->paginate( $pagination ) );
        if ( $articles ) { // жадная загрузка данных 
            $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }
    
    public function addArticle($request) {
        $data = $request->except('_token', 'image');
        if (empty($data)) {
            return array('error' => 'Нет данных');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) { // если изображение было скопировано на сервер
                $str = str_random(5) .  time();
                $obj = new \stdClass; // пустой объект
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->path = $str . '.jpg';
                
                $img = Image::make($image);
                $img->fit(Config::get('settings.image')['width'], Config::get('settings.image')['height'])->
                        save(public_path() . '/images/articles/' . $obj->path);
                $img->fit(Config::get('settings.articles_img')['max']['width'], Config::get('settings.articles_img')['max']['height'])->
                        save(public_path() . '/images/articles/' . $obj->max);
                $img->fit(Config::get('settings.articles_img')['mini']['width'], Config::get('settings.articles_img')['mini']['height'])->
                        save(public_path() . '/images/articles/' . $obj->mini);
                $data['img'] = json_encode($obj);
                $this->model->fill($data);
                if ($request->user()->articles()->save($this->model)) {
                    return ['status' => 'Материал добавлен'];
                }
            }
        } else {
            return ['error' => 'Файл не загружен'];
        }
    }

    public function updateArticle($request, $article) {
        $data = $request->except('_token', 'image', '_method');
        if (empty($data)) {
            return array('error' => 'Нет данных');
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $str = str_random(5) .  time();
                $obj = new \stdClass;
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->path = $str . '.jpg';
                $img = Image::make($image);
                $img->fit(Config::get('settings.image')['width'], Config::get('settings.image')['height'])->save(public_path() . '/' . env('THEME') . '/images/articles/' . $obj->path);
                $img->fit(Config::get('settings.articles_img')['max']['width'], Config::get('settings.articles_img')['max']['height'])->save(public_path() . '/images/articles/' . $obj->max);
                $img->fit(Config::get('settings.articles_img')['mini']['width'], Config::get('settings.articles_img')['mini']['height'])->save(public_path() . '/images/articles/' . $obj->mini);
                $data['img'] = json_encode($obj);
            }
        }
        $article->fill($data);
        if ($article->update()) {
            return ['status' => 'Материал обновлен'];
        }
    }
    
    public function deleteArticle($article) {
        /*
         * метод comments(), он реализует связь, он возвращает объект конструктора запросов
         * если используется динамическое свойство comments то данное свойство возвращает коллекцию выбранных моделей
         */

        $obj = json_decode( $article->img );
        if ($obj) {
            unlink(public_path() . '/images/articles/' . $obj->mini);
            unlink(public_path() . '/images/articles/' . $obj->max);
            unlink(public_path() . '/images/articles/' . $obj->path);
        }
        $article->comments()->delete();
        
        if ($article->delete()) {
            return ['status' => 'Материал удален'];
        }
    }
    
}
    