<?php

namespace App\Repositories;

use App\Http\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryRepository implements CategoryRepositoryInterface {

    private $model;

    function __construct() {
        $this->model = new Category();
    }

    public function create(array $request){
        $this->model->title = $request['category'];
        $image = $request['image'];
        $filename = date('YmdHi').$image->getClientOriginalName();
        $image->move(public_path('public/image'),$filename);
        $this->model->url_image = $filename;
        $this->model->save();

    }

    public function update(array $request, int $id){
        $category = $this->model::findOrFail($id);
        $file_path = public_path().'/public/image/'.$category->url_image;
        File::delete($file_path);
        $image = $request['image'];
        $filename = date('YmdHi').$image->getClientOriginalName();
        $image->move(public_path('public/image'),$filename);
        $category->url_image = $filename;
        $category->title = $request['category'];
        $category->save();
    }

    public function destroy(int $id){
        $category = $this->model::findOrFail($id);
        $file_path = public_path().'/public/image/'.$category->url_image;
        File::delete($file_path);
        $category->delete();
    }

    public function getSomeCategories(){
        return Category::paginate(5);
    }

    public function getCategoryById(int $id)
    {
        return Category::findOrFail($id);
    }

    public function getAllCategories()
    {
        return Category::all();
    }



}
