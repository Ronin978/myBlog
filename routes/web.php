<?php

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

Route::get('/', 'FrontController@index');
Route::get('/show/{id}', 'FrontController@show');
Route::get('/filter/{filter}', 'FrontController@sort');
Route::post('/show/{id}', 'CommentsController@save');


Route::group(['prefix'=>'adminzone','middleware'=>'checkAdmin'], function()
{
     Route::get('/', function()
     {
         return view('admin.dashboard');
     }  );

     Route::get('/article/delete/{id}', 'ArticlesController@delete');     
     Route::get('/comment/delete/{id}', 'CommentsController@delete');
     Route::get('/user/delete/{id}', 'UserController@delete');
     Route::get('/category/delete/{id}', 'CategoryController@delete');

     Route::get('/article/restore/{id}', 'ArticlesController@restore');
     Route::get('/comment/restore/{id}', 'CommentsController@restore');
     Route::get('/user/restore/{id}', 'UserController@restore');
     Route::get('/category/restore/{id}', 'CategoryController@restore');

     Route::resource('article','ArticlesController');
     Route::resource('comment','CommentsController');
     Route::resource('categories','CategoryController');
   
});

Route::resource('/my','UserController');

Route::get('/edit/my', 'UserController@myedit')->name('myEdit')->middleware('checkUser');
Route::get('/myshow/all', 'UserController@myshow')->name('myShow')->middleware('checkUser');

Auth::routes();

Route::get('/home', 'HomeController@index');
