<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == NULL){
            return response()->json([
                'message' => 'O id deve ser diferente de zero'
            ],206);
        }
        $post = Post::findOrFail($id);
        if($post == NULL){
            return response()->json([
                'message' => 'Post não encontrado',
                'success' => false
            ],404);
        }
        if($post->delete()){
            $postCategory = PostCategory::where('post_id','=',$id);
            $postCategory->delete();
            return response()->json([
                'message' => 'Post deletado com sucesso',
                'success' => true
            ],204);
        }else{
            return response()->json([
                'message' => 'Usuario não pode ser deletado, tente mais tarde',
                'success' => false
            ],204);
        }

    }


}
