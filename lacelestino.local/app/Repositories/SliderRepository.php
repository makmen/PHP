<?php

namespace App\Repositories;

use App\Slider;

class SliderRepository extends Repository {
    
    public function __construct(Slider $model) {
        $this->model = $model;
    }
    


}
    