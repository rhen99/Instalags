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

Auth::routes();
//Posts
Route::resource('/posts', 'PostsController');
//Users
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/visit/{user}', 'HomeController@visit');
//Follow
Route::post('/follow', 'FollowsController@followUser')->name('followUser');
//Pages
Route::get('/', 'PagesController@index');
//Comments
Route::post('comments/posts/{post_id}', 'CommentsController@store');
Route::delete('comments/{id}', 'CommentsController@destroy');
//Like
Route::post('/like', 'LikesController@likePost')->name('like');

