<?php

namespace App\Repositories;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use App\Http\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;
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

    public function getCountPosts(){
        return $this->model::all()->count();
    }

    public function getPostPrincipal(){
        return DB::table('emphasis')->join('posts','emphasis.post_id','=','posts.id')->get();
    }

    public function getPostsRecents(){
        return Post::orderBy('created_at','desc')->limit(3)->get();
    }

    public function getPostsPerNumber(int $number){
        return Post::limit($number)->get();
    }

}
