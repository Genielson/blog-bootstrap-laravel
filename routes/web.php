<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function(){
    return view('site.home');
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
    return view('site.last-news');
})->name('last-news');

Auth::routes();


Route::group(['middleware'=>'auth'], function(){

    Route::resource('admin/category',
        CategoryController::class
    )->name('*','admin.category');

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
