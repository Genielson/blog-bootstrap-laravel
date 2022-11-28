<?php

namespace App\Repositories;
use App\Models\Post;

class PostRepository {

    public $model;
    public function __construct(){
        $this->model = new Post();
    }


    public function create(array $request) : int{

        $allInputs = $request->all();
        $VALUE_ID_UPDATE = 1;
        $id = Auth::user()->id;

        $this->model->title = $request->input("title");
        $this->model->description = $request->input("description");
        $this->model->slug = $request->input("slug");
        $image = $request->file('image');
        if($image != NULL) {
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('public/image'), $filename);
            $this->model->url_image = $filename;
        }
        $this->model->user_id = $id;
        $this->model->save();
        return $this->model->id;
    }


}
