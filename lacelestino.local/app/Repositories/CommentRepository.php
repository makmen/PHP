<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository extends Repository {
    
    public function __construct(Comment $model) {
        $this->model = $model;
    }
    
    public function getAll($select = '*') {
        $builder = $this->get($select);
        
        return $builder->get();
    }
    
    public function getMainMenu($select = '*') {
        $builder = $this->get($select)->where(['user' => 0]);
        
        return $builder->get();
    }
    
}
    