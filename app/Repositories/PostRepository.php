<?php

namespace App\Repositories;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use App\Http\Contracts\PostRepositoryInterface;
class PostRepository implements PostRepositoryInterface {

    public $model;
    public function __construct(){
        $this->model = new Post();
    }


    public function createOrUpdate(array $request, int $idPost = null) : int{

        if($idPost != null){
            $this->model::findOrFail($idPost);
        }

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

    public function deletePost($id){

        $post = $this->model::find($id);
        $file_path = public_path().'/public/image/'.$post->url_image;
        File::delete($file_path);
        $post->delete();

    }

    public function getSomePostsWithPaginate(){
        return $this->model::orderBy('id','desc')->paginate(5);
    }



}
