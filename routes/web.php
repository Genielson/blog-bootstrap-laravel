<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Post;
use App\Mail\ContactMail;
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
    $posts = Post::limit(4)->get();
    $postsRecentes = Post::orderBy('created_at','desc')->limit(3)->get();
    $postPrincipal  = DB::table('emphasis')->join('posts','emphasis.post_id','=','posts.id')->get();

    return view('site.home',[
        'categorias'=>$categorias,
        'posts'=>$posts,
        'postsRecentes'=>$postsRecentes,
        'postPrincipal'=>$postPrincipal
    ]);

})->name('home');

Route::get('/categorias',function(){
    return view('site.categories');
})->name('categories');

Route::get('/contato',function(){
    return view('site.contact');
})->name('contact');

Route::post('/envia-email-contato', function(){

    //Mail::send(new ContactMail('myUser'));

    Session::flash('message', 'Email enviado com sucesso! ');
    return redirect()->route('contact');

})->name('contact-send');

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

    Route::resource('admin/site',
        \App\Http\Controllers\SiteController::class
    )->name('*','admin.site');



});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
