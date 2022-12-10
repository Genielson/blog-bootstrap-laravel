<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateSiteRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\EmphasisRepository;
use App\Repositories\PostRepository;
use App\Repositories\SiteRepository;
use Exception;
use Session;

class SiteController extends Controller
{
    public $repository;
    public $categoryRepository;
    public $postRepository;
    public $emphasisRepository;

    public function __construct(
        SiteRepository $repository,
        CategoryRepository $categoryRepository,
        PostRepository $postRepository,
        EmphasisRepository $emphasisRepository

        )
    {
        $this->repository = $repository;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->emphasisRepository = $emphasisRepository;
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

        $categories = $this->categoryRepository->getAllCategories();
        $posts = $this->postRepository->getPostsPerNumber(4);
        $postsRecents = $this->postRepository->getPostsRecents();
        $postPrincipal  = $this->postRepository->getPostPrincipal();
        $sumPosts = $this->postRepository->getCountPosts();
        return view('site.home',[
            'categorias'=>$categories,
            'posts'=>$posts,
            'postsRecentes'=>$postsRecents,
            'postPrincipal'=>$postPrincipal,
            'somaPosts' => $sumPosts
        ]);

    }

}
