<?php

namespace App\Repositories;
use App\Models\PostCategory;

class PostCategoryRepository {
    private $model;

    public function  __construction(){
        $this->model = new PostCategory();
    }

    public function create(array $allInputs,int $id){
        foreach ($allInputs['categoria'] as $categoria){
            $this->model->category_id = $categoria;
            $this->model->post_id = $id;
            $this->model->save();
        }
    }

    public function deletePostCategory(int $id){
        $postCategory = $this->model::where('post_id','=',$id);
        $postCategory->delete();
    }

}




