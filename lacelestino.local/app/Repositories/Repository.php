<?php

namespace App\Repositories;

use Config;

abstract class Repository {
    
    protected $model = false;
    
    protected function get($select = '*') {
        return $this->model->select($select);
    }

    protected function getWhere($select, $where ) {
        return $this->get($select)->where( $where );
    }
        
    
    public function getById($id, $select = '*') {
        return $this->getWhere($select, ['id' => $id] )->first();
    }
    
    public function getAll($select = '*') {
        return $this->get($select)->get();
    }    
    
    public function getSeveral($select = '*', $take, $orderBy  = false ) {
        $builder = $this->get('*');
        if (!$orderBy) {
            $orderBy = ['id', 'DESC'];
        }
        $builder->take($take)->orderBy( $orderBy[0], $orderBy[1] );
                
        return $builder->get();
    }    

    
    protected function check( $result ) {
        if ($result->isEmpty()) {
            return false;
        }
        $result->transform(function($item, $key) {
            if (is_string($item->img) && 
                    is_object(json_decode($item->img)) &&
                    (json_last_error() == JSON_ERROR_NONE) ) {
                $item->img = json_decode($item->img);
            }

            return $item;
        });
        
        return $result;
    }
    

}