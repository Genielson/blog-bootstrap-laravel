<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\SiteController;

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



Route::get('/',[SiteController::class,'getItensToVisitantPage'])->name('home');

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

Route::get('/loadingPosts',function(){
    $row = $_GET['row'];

    $rowsPerPage = 4;
    $posts = Post::skip($row)->take($rowsPerPage)->get()->toArray();
    $html = "";
    foreach ($posts as $post){

       $html .= "<div class='col-lg-6 col-md-6 post'>";
       $html .= "<div class='single-what-news mb-100'>";
       $html .= "<div class='what-img'>";
       $html .= "<img src='".asset('public/image/'.$post['url_image'])."' alt=''>";
       $html .= "</div>";
       $html .= "<div class='what-cap'>";
       $html .= "<span class='color1'>Night party</span>";
       $html .= "<h4><a href='#'>".$post['title']."</a></h4>";
       $html .= "</div></div></div>";
    }

    echo $html;
});

Auth::routes();

Route::get('/home',[HomeAdminController::class,'index'] );

Route::resource('admin/category',
CategoryController::class
)->name('*','admin.category');


Route::group(['middleware'=>'auth'], function(){



    Route::resource('admin/posts',
    \App\Http\Controllers\PostController::class
    )->name('*','admin.posts')->middleware('can:isAdmin');


    Route::resource('admin/site',
        \App\Http\Controllers\SiteController::class
    )->name('*','admin.site')->middleware('can:isAdmin');

    Route::resource('admin/home',
        \App\Http\Controllers\HomeAdminController::class
    )->name('*','admin.site')->middleware('can:isAdmin');
});

