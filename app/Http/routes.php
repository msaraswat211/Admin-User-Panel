<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', function(){
        return view('admin.index');
    });

    /*
     * route with resource controller for users
     */
    Route::resource('admin/users', 'AdminUsersController');

    /*
     * route with resource controller for posts
     */
    Route::resource('admin/posts', 'AdminPostsController');

    /*
     * route with resource controller for categories
     */
    Route::resource('admin/categories', 'AdminCategoryController');

    /*
     * route with resource controller for media
     */
    Route::resource('admin/media', 'AdminMediaController');

    /*
     * route with resource controller for comments on post
     */
    Route::resource('admin/comments', 'PostCommentsController');

    /*
     * route with resource controller for reply on comments
     */
    Route::resource('admin/comment/replies', 'CommentRepliesController');

});

Route::group(['middleware'=>'auth'], function(){

   /*
    * for create reply on comment of post must login
    */
    Route::post('comment/reply', 'CommentRepliesController@createReply');
});