<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository {

    private $model;

    public function  __construction(){
        $this->model = new Category();
    }

    public function create(array $request){

        $this->model->title = $request->input('category');

        $image = $request->file('image');
        $filename = date('YmdHi').$image->getClientOriginalName();
        $image->move(public_path('public/image'),$filename);
        $this->model->url_image = $filename;
        $this->model->save();

    }


}
