<?php

//Route::get('/', function () { return view('front.index') });
Route::get('/', 'ContentController@showHomePage');
Route::get('/rules', function (){ return view('front.rules'); }	);
Route::get('/feedBack', function (){ return view('front.feedBack'); }	);
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->back();
});

Route::get('/{provider}', 'Auth\AuthController@redirectToProvider');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('category/{id}', 'ContentController@showCaterory');
Route::get('article/{id}', 'ContentController@showArticle');
Route::post('create_comment', 'CommentController@create');

Route::post('feedBack', 'ContentController@feedBack');

Route::group(['middleware' => ['auth', 'role:admin']], function(){
	Route::get('adminzone/', 'AdminController@index');
		
	Route::get('adminzone/articles', 'AdminController@articles');
	Route::get('adminzone/article', 'AdminController@article');
	Route::get('adminzone/article/{id}', 'AdminController@article');
	Route::post('adminzone/create_article', 'AdminController@create_article');
	Route::post('adminzone/update_article', 'AdminController@update_article');
	Route::post('adminzone/delete_article', 'AdminController@delete_article');
	Route::post('adminzone/change_article_status', 'AdminController@change_article_status');

	Route::get('adminzone/categories', 'AdminController@categories');
	Route::post('adminzone/create_category', 'AdminController@create_category');
	Route::post('adminzone/delete_category', 'AdminController@delete_category');
	Route::post('adminzone/update_category', 'AdminController@update_category');
	
	Route::get('adminzone/comments', 'AdminController@comments');
	Route::get('adminzone/users', 'AdminController@users');
	Route::post('adminzone/delete_comment', 'CommentController@delete');
	Route::post('adminzone/approve_comment', 'CommentController@approve');
	Route::post('adminzone/delete_user_comments', 'CommentController@delete_user_comments');
	Route::post('adminzone/block_user', 'AdminController@block_user');
	Route::post('adminzone/set_user_role', 'AdminController@set_user_role');
});
