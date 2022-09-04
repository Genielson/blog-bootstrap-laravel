<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAccess;
use App\Models\LogAccessUser;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalPosts = Post::all()->count();
        $totalUsuarios = User::all()->count();
        $totalCategorias = Category::all()->count();
        $totalVisitantes = LogAccessUser::all()->count();

        return view('home',[
            'totalPosts'=>$totalPosts,
            'totalUsuarios'=>$totalUsuarios,
            'totalCategorias'=>$totalCategorias,
            'totalVisitantes'=>$totalVisitantes
        ]);
    }
}
