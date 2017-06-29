<?php

namespace App\Repositories;

use App\Category;
use DB;


class CategoryRepository extends Repository {
    
    public function __construct(Category $model) {
        $this->model = $model;
    }
    
    public function getOne($id) {
        $category = $this->getById($id);
        if ( $category ) {
            $category->load('products');
        }
        
        return $category;
    }
    
    public function getCategories( $pagination ) {
        $builder = $this->getMany('*')->orderBy( 'id', 'ASC' );
        $categories = $this->defineParent( $builder->paginate( $pagination ) ) ;

        return $categories;
    }
    
    public function getTopParent($category) {
        if ($category->parent_id == 0) {
            
            return $category;
            
        }
        
        return $this->getTopParent( $this->getById($category->parent_id) );
    }
    
    

    private function defineParent($result) {
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
    
    public function buildTreeCategories() {
        $parentsCategory = $this->getWhere( 
            ['title', 'parent_id','id'], 
            ['parent_id' => 0] 
        )->get();
        $lists = $this->buildSelect($parentsCategory, '');
        
        return $this->prepareSelect($lists);
    }
    
    private function buildSelect($categories, $separator) {
        $lists = [];
        foreach ($categories as $category) {
            $lists[] = [ 'id' => $category->id, 'title' => $separator . $category->title,  'parent_id' => $category->parent_id];
            $children = $this->hasChildren($category);
            if ( count($children) > 0 ) {
                $children = $this->buildSelect($children, $separator . '- ');
                $lists = array_merge($lists, $children);
            }
        } 
        
        return $lists;
    }
    
    private function hasChildren($category) {
        return $this->getWhere(
                ['title', 'parent_id','id'], 
                ['parent_id' => $category->id ]
            )->get();
    }

    private function prepareSelect($categories) {
        $lists = [];
        foreach ($categories as $category) {
            $lists[$category['id']] = $category['title'];
        }

        return $lists;
    }

    public function add($request) {
        $data = $request->except('_token');
        if (empty($data)) {
            return array('error_message' => 'Нет данных');
        }
        $model = new Category;
        $model->fill( $data );
        if ( $model->save() ) {
            return ['status' => 'Категория добавлена'];
        }
    }

    public function update($request, $category) {
        $data = $request->except('_token');
        if (empty($data)) {
            return array('error_message' => 'Нет данных');
        }    
        $category->fill($data);
        if ($category->update()) {
            return ['status' => 'Категория обновлена'];
        } else {
            return array('error_message' => 'Ошибка работы с базой данных');
        }
    }

    public function delete($category) {

    }

}
    