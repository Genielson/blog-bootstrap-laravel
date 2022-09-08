<?php

namespace App\Http\Controllers;

use App\Models\Emphasis;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
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
        $VALUE_ID_UPDATE = 1;
        $id = Auth::user()->id;
        $post = new Post();

        $post->title = $request->input("title");
        $post->description = $request->input("description");
        $post->slug = $request->input("slug");

        $image = $request->file('image');
        if($image != NULL) {
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('public/image'), $filename);
            $post->url_image = $filename;
        }
        $post->user_id = $id;
        $post->save();

        $emphasis = Emphasis::all();
        if(count($emphasis) == 0){
            $newEmphasis = new Emphasis();
            $newEmphasis->post_id = $post->id;
            $newEmphasis->save();
        }else{
            $emphasis = Emphasis::find($VALUE_ID_UPDATE);
            $emphasis->post_id = $post->id;
            $emphasis->save();
        }

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
        $emphasis = Emphasis::select()->where('post_id','=',$id)->get()->toArray();
        $categoriasDoPost = PostCategory::select('category_id')->
        where('post_id', "=",$id)->pluck('category_id')->toArray();

        return view(
            'post-edit', ['post'=>$post, 'categorias' => $categorias,
            'categoriasDoPost' => $categoriasDoPost,
                'destaque'=>$emphasis
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
        $VALUE_ID_UPDATE = 1;
        $post = Post::find($id);
        $emphasis = Emphasis::all();

        if(count($emphasis) == 0){
            $newEmphasis = new Emphasis();
            $newEmphasis->post_id = $id;
            $newEmphasis->save();
        }else{
            $emphasis = Emphasis::find($VALUE_ID_UPDATE);
            $emphasis->post_id = $id;
            $emphasis->save();
        }
        $image = $request->file('image');
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
            $image->move(public_path('public/image'), $filename);
            $post->url_image = $filename;
        }

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
        $file_path = public_path().'/public/image/'.$post->url_image;
        File::delete($file_path);
        $post->delete();
        $postCategory = PostCategory::where('post_id','=',$id);
        $postCategory->delete();
        return redirect('/admin/posts');
    }
}
