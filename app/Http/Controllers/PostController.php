<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\Emphasis;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Category;
use App\Repositories\PostRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\EmphasisRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public $postRepository;
    public $emphasisRepository;
    public $postCategoryRepository;

    public function __construct(PostRepository $postRepository,
                                EmphasisRepository $emphasisRepository,
                                PostCategoryRepository $postCategoryRepository

    ){
        $this->postRepository = $postRepository;
        $this->emphasisRepository = $emphasisRepository;
        $this->postCategoryRepository = $postCategoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $posts = Post::orderBy('id','desc')->paginate(5);
        }catch(Exception $e){
            return $e->getMessage();
        }
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
    public function store(StoreUser $request)
    {
        $allInputs = $request->all();
        try{
            $id = $this->postRepository->createOrUpdate($request->validated());
            $this->emphasisRepository->setEmphasisInPost($id);
            $this->postCategoryRepository->createOrUpdate($allInputs,$id);
        }catch(Exception $e){
            return $e->getMessage();
        }
        return redirect('/admin/posts');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = NULL;
        $categories = NULL;
        $postCategory = NULL;
        $emphasis = NULL;

        try{
            $post = Post::findOrFail($id);
            $categories = Category::all();
            $emphasis = Emphasis::getEmphasisById($id);
            $postCategory = PostCategory::getPostCategoryById($id);
        }catch(Exception $e){
            return $e->getMessage();
        }

        return view(
            'post-edit', ['post'=>$post, 'categorias' => $$categories,
            'categoriasDoPost' => $postCategory,
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
    public function update(StoreUser $request, $id)
    {
        $allInputs = $request->all();
        try{
            $id = $this->postRepository->createOrUpdate($request->validated());
            $this->emphasisRepository->setEmphasisInPost($id);
            $this->postCategoryRepository->createOrUpdate($allInputs,$id);
        }catch(Exception $e){
            return $e->getMessage();
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
        try{
            $this->postRepository->deletePost($id);
            $this->postCategoryRepository->deletePostCategory($id);
        }catch(Exception $e){
            return $e->getMessage();
        }
        return redirect('/admin/posts');
    }
}
