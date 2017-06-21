<?php

namespace App\Repositories;

use App\Repositories\PortfolioController;
use App\Portfolio;

use Config;
use Image;

class PortfolioRepository extends Repository {

    public function __construct(Portfolio $model) {
        $this->model = $model;
    }

    public function one($id) {
        $portfolio = $this->getById($id);
        if ( $portfolio ) {
            $portfolio->load('user');
        }

        return $portfolio;
    }
    
    public function getSeveralPortfolios($take) {
        $portfolios = $this->getSeveral('*', $take);
        if ( count($portfolios) > 0) {
            $portfolios = $this->check($portfolios);
        }
        
        return $portfolios;
    }
    public function getPortfoliosOtherProjects($id, $count) {
        $portfolios =  $this->get('*')->where('id', '<>', $id)->take($count)->get();
        if ( count($portfolios) > 0) {
            $portfolios = $this->check($portfolios);
        }
        
        return $portfolios;
    }
   
    public function getPortfolios($pagination = 0, $orderBy  = false   ) {
        $builder = $this->get('*');
        if (!$orderBy) {
            $orderBy = ['id', 'DESC'];
        }
        
        $builder->orderBy( $orderBy[0], $orderBy[1] );
        $portfolios = $this->check( $builder->paginate( $pagination ) );
        if ( $portfolios ) { // жадная загрузка данных 
            $portfolios->load('user');
        }

        return $portfolios;
    }
    
    public function addPortfolio($request) {

        $data = $request->except('_token', 'image');
        if (empty($data)) {
            return array('error' => 'Нет данных');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ( $image->isValid() ) { // если изображение было скопировано на сервер
                $str = str_random(5) .  time();
                $obj = new \stdClass; // пустой объект
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->path = $str . '.jpg';
                
                $img = Image::make($image);
                $img->fit(Config::get('settings.image')['width'], Config::get('settings.image')['height'])->
                        save(public_path() . '/images/portfolios/' . $obj->path);
                $img->fit(Config::get('settings.articles_img')['max']['width'], Config::get('settings.articles_img')['max']['height'])->
                        save(public_path() . '/images/portfolios/' . $obj->max);
                $img->fit(Config::get('settings.articles_img')['mini']['width'], Config::get('settings.articles_img')['mini']['height'])->
                        save(public_path() . '/images/portfolios/' . $obj->mini);
                $data['img'] = json_encode($obj);

                $this->model->fill($data);
                if ($request->user()->portfolios()->save($this->model)) {
                    return ['status' => 'Портфолио добавлен'];
                }
            }
        } else {
            return ['error' => 'Файл не загружен'];
        }
    }
    
    public function updatePortfolio($request, $portfolio) {
   
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
                $img->fit(Config::get('settings.image')['width'], Config::get('settings.image')['height'])->save(public_path() . '/images/portfolios/' . $obj->path);
                $img->fit(Config::get('settings.articles_img')['max']['width'], Config::get('settings.articles_img')['max']['height'])->save(public_path() .  '/images/portfolios/' . $obj->max);
                $img->fit(Config::get('settings.articles_img')['mini']['width'], Config::get('settings.articles_img')['mini']['height'])->save(public_path() . '/images/portfolios/' . $obj->mini);
                $data['img'] = json_encode($obj);
            }
        }
        $portfolio->fill($data);
        if ($portfolio->update()) {
            return ['status' => 'Портфолио обновлено'];
        }
    }
    
    public function deletePortfolio($portfolio) {

        $obj = json_decode( $portfolio->img );
        if ($obj) {
            unlink(public_path() . '/images/portfolios/' . $obj->mini);
            unlink(public_path() . '/images/portfolios/' . $obj->max);
            unlink(public_path() . '/images/portfolios/' . $obj->path);
        }
        
        if ($portfolio->delete()) {
            return ['status' => 'Портфолио удалено'];
        } else {
            return ['error' => 'Ошибка сохранения в базу данных'];
        }
    }

    

}
    