<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\UpdateSiteRequest;
use App\Repositories\SiteRepository;
use Illuminate\Support\Facades\DB;
use Exception;
use Session;

class SiteController extends Controller
{
    public $repository;

    public function __construct(
        SiteRepository $repository

        )
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = NULL;
        try{
            $id = $this->repository->getIdConfigurationSite();
        }catch(Exception $e){
            return $e->getMessage();
        }
        return view('admin-site',['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteRequest $request, $id)
    {

        try{
           $this->repository->updateSiteConfiguration($request->validated(),$id);
           Session::flash('message','Site atualizado com sucesso! ');
        }catch(Exception $e){
           return $e->getMessage();
        }
        return redirect()->route('site.index');
    }

    public function getItensToVisitantPage(){

        $categories = Category::all();
        $posts = Post::limit(4)->get();
        $postsRecents = Post::orderBy('created_at','desc')->limit(3)->get();
        $postPrincipal  = DB::table('emphasis')->join('posts','emphasis.post_id','=','posts.id')->get();
        $sumPosts = Post::all()->count();
        return view('site.home',[
            'categorias'=>$categories,
            'posts'=>$posts,
            'postsRecentes'=>$postsRecents,
            'postPrincipal'=>$postPrincipal,
            'somaPosts' => $sumPosts
        ]);

    }

}
