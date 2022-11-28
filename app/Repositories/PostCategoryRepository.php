<?php

namespace App\Repositories;
use App\Models\Emphasis;
use App\Models\PostCategory;

class PostCategoryRepository {
    private $model;

    public function  __construction(){
        $this->model = new PostCategory();
    }

    public function create(array $allInputs,$id){
        foreach ($allInputs['categoria'] as $categoria){
            $this->model->category_id = $categoria;
            $this->model->post_id = $id;
            $this->model->save();
        }
    }



}




