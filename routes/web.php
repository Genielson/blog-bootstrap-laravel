<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function(){

    $categorias = Category::all();
    $posts = Post::all();

    return view('site.home',[
        'categorias'=>$categorias,
        'posts'=>$posts
    ]);

})->name('home');

Route::get('/categorias',function(){
    return view('site.categories');
})->name('categories');

Route::get('/contato',function(){
    return view('site.contact');
})->name('contact');

Route::get('/sobre',function(){
   return view('site.about');
})->name('about');

Route::get('/ultimas-noticias',function(){

    $posts = Post::orderBy('id','desc')->paginate(5);
    return view('site.last-news',
        compact('posts')
    );
})->name('last-news');

Auth::routes();


Route::group(['middleware'=>'auth'], function(){

    Route::resource('admin/category',
        CategoryController::class
    )->name('*','admin.category');

    Route::resource('admin/posts',
        \App\Http\Controllers\PostController::class
    )->name('*','admin.posts');



});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
