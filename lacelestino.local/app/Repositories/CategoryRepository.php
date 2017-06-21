<?php

namespace App\Repositories;

use App\Category;
use DB;

class CategoryRepository extends Repository {
    
    public function __construct(Category $model) {
        $this->model = $model;
    }
    
    public function getAll($select = '*', $pagination = 0) {
        $builder = $this->get($select);
        $categories = ($pagination) ? $builder->paginate( $pagination ) : $builder->get();

        return $categories;
    }
    
    public function addCategory($request) {
        $data = $request->except('_token');
        if (empty($data)) {
            return array('error' => 'Нет данных');
        }    
        $parent = $this->getWhere(['id'], ['parent_id' => 0])->first();
        $model = new Category;
        $model->fill( $data ); 
        $model->parent_id = $parent->id;
        if ( $model->save() ) {
            return ['status' => 'Категория добавлена'];
        }        
    }
    
    public function defineParent($result) {
        if ($result->isEmpty()) {
            return false;
        }
        $categories = DB::select('
            SELECT distinct l.id, l.title
            FROM categories AS l left join categories AS r ON l.id = r.parent_id 
            WHERE r.title IS NOT NULL
        ');
        $result->transform(function($item, $key) use ($categories)  {
            if ( is_integer($item->parent_id)  ) {
                if ($item->parent_id > 0) {
                    $item->parent = $this->searchParent($categories, $item->parent_id);
                  } else {
                    $item->parent = 'родитель';
                }
            }

            return $item;
        });

        return $result;
    }
    
    private function searchParent($categories, $parent_id) {
        foreach($categories as $category) {
            if ($category->id == $parent_id) {
                return $category->title; 
            }
        }
    }

    public function updateCategory($request, $category) {
        $data = $request->except('_token');
        if (empty($data)) {
            return array('error' => 'Нет данных');
        }    
        $parent = $this->getWhere(['id'], ['parent_id' => 0])->first();
        $category->fill($data);
        if ($category->update()) {
            return ['status' => 'Категория обновлена'];
        }
    }
    
    


    
}
    