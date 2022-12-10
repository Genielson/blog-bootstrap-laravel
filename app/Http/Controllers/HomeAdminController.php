<?php

namespace App\Http\Controllers;

use App\Models\LogAccessUser;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

class HomeAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public $postRepository;
     public $userRepository;
     public $categoryRepository;

    public function __construct(PostRepository $postRepository,
    CategoryRepository $categoryRepository,
    UserRepository $userRepository
    )
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $totalPosts = $this->postRepository->getCountPosts();
        $totalUsers = $this->userRepository->getCountUser();
        $totalCategories = $this->categoryRepository->getCountCategories();
        $totalVisitants = LogAccessUser::all()->count();

        return view('home',[
            'totalPosts'=>$totalPosts,
            'totalUsuarios'=>$totalUsers,
            'totalCategorias'=>$totalCategories,
            'totalVisitantes'=>$totalVisitants
        ]);
    }

}
