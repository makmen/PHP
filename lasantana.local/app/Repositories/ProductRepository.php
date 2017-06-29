<?php

namespace App\Repositories;

use App\Product;


class ProductRepository extends Repository {
    
    public function __construct(Product $model) {
        $this->model = $model;
    }
    
    public function getProductsNear($id) {
        $near = [];
        $near['next'] = $this->get('id')->where('id', '>', $id)->first();
        $near['prev'] = $this->get('id')->where('id', '<', $id)->orderBy( 'id', 'DESC' )->first();
        if ($near['next'] == null) {
            $near['next'] = $this->get('id')->first();
        }
        if ($near['prev'] == null) {
            $near['prev'] = $this->get('id')->orderBy( 'id', 'DESC' )->first();
        }

        return $near;
    }
    
    public function getProductByKeys($keys) {
        if ( !is_array($keys) && empty($key) ) {
            return false;
        }
        
        return $this->get('*')->whereIn('id', $keys)->get();
    }
    
    public function getProductsSearch($search, $pagination) {
        $builder = $this->get('*')->where('title', 'like', '%' . $search . '%' );
        $products = $builder->paginate( $pagination );
        
        return $this->img($products);
    }
    
    public function getNewProducts($take) {
        $products = $this->get('*')->where(['new' => '1'])->orderBy( 'id', 'DESC')->take($take)->get();
        // $products = $this->get('*')->orderBy( 'id', 'DESC')->take($take)->get();
        
        return $this->img($products);;
    }

    public function getOne($id) {

        return $product;
    }
    
    public function getProducts( $pagination ) {
        $builder = $this->getMany('*')->orderBy( 'id', 'ASC' );
        $products = $builder->paginate( $pagination );
        $products = $this->img($products);
        if ( $products ) {
            $products->load('category');
        }

        return $products;
    }
    
    public function getProductsByCategory($category,  $pagination ) {
        $builder =  $this->getWhere('*', ['category_id' => $category->id] );
        $builder = $builder->orderBy( 'id', 'ASC' );
        $products = $builder->paginate( $pagination );
        $products = $this->img( $products );
        
        return $products;
    }
    
    public function img( $result ) {
        if ($result->isEmpty()) {
            return false;
        }
        $result->transform(function($item, $key) {
            if (is_string($item->img) && 
                    is_array(json_decode($item->img)) &&
                    (json_last_error() == JSON_ERROR_NONE) ) {
                $item->img = $this->defineImages( json_decode($item->img) );
            }

            return $item;
        });
        
        return  $result;
    }
    
    public function defineImages($images) {
        $return = [];
        foreach ($images as $k => $image) {
            $return[$k] = [ 
                $this->model->getMini() => $this->model->getMini() . $image,
                $this->model->getNormal() => $this->model->getNormal() . $image,
                $this->model->getMax() => $this->model->getMax() . $image,
            ];
        }
        
        return $return;
    }
    
    public function add($request) {
        $data = $request->except('_token');
        if (empty($data)) {
            return array('error_message' => 'Нет данных');
        }
        $this->model->setImages($data['img']);
        $data['img'] = json_encode($data['img']);
        $this->model->fill($data);
        if ( \Auth::user()->products()->save($this->model) ) {
            $this->model->getProductDir();
            $this->model->addImages();
            
            return ['status' => 'Товар добавлен'];
            
        } else {
            return array('error_message' => 'Ошибка при работе с БД');
        }
    }

    public function update($request, $product) {
        $data = $request->except('_token');
        if (empty($data)) {
            return array('error_message' => 'Нет данных');
        }
        $product->getProductDir();
        // add new
        $product->setImages( $product->needAdd( $data['img'] ) );
        if ( !empty( $product->getImages() ) ) {
            $product->addImages(); 
        }
        // delete old
        $product->setImages( $product->needDelete( $data['img'] ) );
        if ( !empty( $product->getImages() ) ) {
            $product->deleteImages(); 
        }
        // update bd
        $data['img'] = json_encode($data['img']);
        if ( $product->fill($data)->update() ) {
            return ['status' => 'Товар изменен'];
        } else {
            return array('error_message' => 'Ошибка работы с базой данных');
        }
    }

    public function delete($product) {
        $product->getProductDir();
        $product->setImages( json_decode($product->img) );
        if ( !empty( $product->getImages() ) ) {
            $product->deleteImages(); 
        }
        if ($product->delete()) {
            return ['status' => 'Материал удален'];
        }
    }


}
    