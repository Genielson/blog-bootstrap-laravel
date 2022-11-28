<?php

namespace App\Repositories;
use App\Models\Category;
use Illuminate\Support\Facades\File;

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

    public function update(array $request, int $id){
        $category = $this->model::findOrFail($id);
        $file_path = public_path().'/public/image/'.$category->url_image;
        File::delete($file_path);
        $image = $request->file('image');
        $filename = date('YmdHi').$image->getClientOriginalName();
        $image->move(public_path('public/image'),$filename);
        $category->url_image = $filename;
        $category->title = $request->input('category');
        $category->save();
    }

    public function destroy(int $id){
        $category = $this->model::findOrFail($id);
        $file_path = public_path().'/public/image/'.$category->url_image;
        File::delete($file_path);
        $category->delete();
    }

}
