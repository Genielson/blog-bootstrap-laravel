<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::all();
        return view('post-create',['categorias' => $categorias]);
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
        $id = Auth::user()->id;
        $post = new Post();
        $post->title = $request->input("title");
        $post->description = $request->input("description");
        $post->slug = $request->input("slug");
        $post->user_id = $id;
        $post->save();

        foreach ($allInputs['categoria'] as $categoria){
            $postCategory = new PostCategory();
            $postCategory->category_id = $categoria;
            $postCategory->post_id = $post->id;
            $postCategory->save();
        }

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categorias = Category::all();
        $categoriasDoPost = PostCategory::select('category_id')->
        where('post_id', "=",$id)->pluck('category_id')->toArray();

        return view(
            'post-edit', ['post'=>$post, 'categorias' => $categorias,
            'categoriasDoPost' => $categoriasDoPost
            ]
        );
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
        $allInputs = $request->all();
        $post = Post::find($id);
        $post->fill(
            [
                'title'=>$request->input('title'),
                'description' => $request->input('description'),
                'slug' => $request->input('slug')
        ]);
        $post->save();
        $postCategory = PostCategory::where('post_id','=',$id);
        $postCategory->delete();
        foreach ($allInputs['categoria'] as $categoria){
            $postCategory = new PostCategory();
            $postCategory->category_id = $categoria;
            $postCategory->post_id = $post->id;
            $postCategory->save();
        }
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        $postCategory = PostCategory::where('post_id','=',$id);
        $postCategory->delete();
        return redirect('/admin/posts');
    }
}
