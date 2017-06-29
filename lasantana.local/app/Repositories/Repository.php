<?php

namespace App\Repositories;

abstract class Repository {
    
    protected $model = false;
    
    protected function get($select = '*') {
        return $this->model->select($select);
    }
    
    public function getWhere($select, $where) {
        return $this->get($select)->where( $where );
    }
    
    public function getWhereTake($select, $where, $take = 0) {
        return $this->get($select)->where( $where )->take($take);
    }
    
    public function getWhereNotEquelTake($select, $where, $take = 0) {
        return $this->get($select)->where( $where )->take($take);
    }

    public function getMany($select = '*', $take = 0) {
        $builder = $this->get('*');
        if ($take > 0) {
            $builder->take($take);
        }

        return $builder;
    }

    public function getById($id, $select = '*') {
        return $this->get($select)->where(['id' => $id])->first();
    }

}