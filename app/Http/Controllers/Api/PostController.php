<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Emphasis;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $allInputs = $request->all();
        if( $allInputs['title'] == NULL || $allInputs['description'] == NULL ||
            $allInputs['user_id'] == NULL || $allInputs['slug'] == NULL ||
            $allInputs['url_image'] == NULL
        ){
            return response()->json([
                'message' => 'Titulo,descricao,user_id,slug e url_image está vazio, por favor, envie todos os parametros',
                'success' => false
            ],206);
        }
        $user = User::findOrFail($allInputs['user_id']);
        if($user == NULL){
            return response()->json([
                'message' => 'Nenhum usuario possui esse id',
                'success' => false
            ],404);
        }
        $id = $allInputs['user_id'];
        $post = new Post();
        $post->title = $request->input("title");
        $post->description = $request->input("description");
        $post->slug = $request->input("slug");
        $image = $request->file('url_image');
        $filename = date('YmdHi') . $image->getClientOriginalName();
        $post->user_id = $id;
        $post->url_image = $filename;
        if($post->save()){
            if($image != NULL) {
                $image->move(public_path('public/image'), $filename);
            }
            return response()->json([
                'message' => 'Post criado com sucesso',
                'success' => true
            ],200);
        }else{
            return response()->json([
                'message' => 'Não foi possivel criar o post, tente mais tarde',
                'success' => false
            ],200);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $allInputs = $request->all();
        if( $allInputs['title'] == NULL || $allInputs['description'] == NULL ||
            $allInputs['user_id'] == NULL || $allInputs['slug'] == NULL ||
            $allInputs['url_image'] == NULL ||  $allInputs['id']
        ){
            return response()->json([
                'message' => 'Titulo,descricao,user_id,slug,url_image ou id está vazio, por favor, envie todos os parametros',
                'success' => false
            ],206);
        }
        $post = Post::findOrFail($allInputs['id']);
        if($post == NULL){
            return response()->json([
                'message' => 'Nenhum Post possui esse id',
                'success' => false
            ],206);
        }

        $image = $request->file('url_image');
        $post->fill(
            [
                'title'=>$request->input('title'),
                'description' => $request->input('description')
            ]);
        $post->slug = $allInputs['slug'];
        if ($image != NULL) {
            $file_path = public_path() . '/public/image/' . $post->url_image;
            File::delete($file_path);
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $post->url_image = $filename;
        }
        if($post->save()){
            $image->move(public_path('public/image'), $filename);
            return response()->json([
                'message' => 'Post atualizado com sucesso',
                'success' => true
            ],200);
        }else{
            return response()->json([
                'message' => 'Não foi possivel atualizar o post, tente mais tarde',
                'success' => false
            ],200);

        }
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
