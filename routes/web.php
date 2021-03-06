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

Route::view('/', 'pages.index');

// Static Pages
Route::view('about', 'pages.static.about');
Route::view('contacts', 'pages.static.contacts');
Route::view('faq', 'pages.static.faq');
Route::view('statistics', 'pages.static.statistics');
// Route::view('recover-password', 'pages.static.recover-password');

// Post
Route::get('post', 'PostController@new')->middleware('auth');
Route::post('post', 'PostController@create');
Route::get('post/search', 'PostController@search');
Route::get('post/{id}', 'PostController@show');
Route::get('post/{id}/edit', 'PostController@edit');
Route::post('post/{id}/edit', 'PostController@update');
Route::get('post/{id}/delete', 'PostController@delete');

// Faculties api
Route::get('api/university/{id}/faculties', 'FacultyController@list');

// Flag Post
Route::get('flag/post/{id}', 'FlagPostController@show');
Route::post('flag/post/{id}', "FlagPostController@create")->middleware('auth');

// Flag User
Route::get('flag/user/{id}', 'FlagUserController@show');
Route::post('flag/user/{id}', "FlagUserController@create")->middleware('auth');

// Flag Comment
Route::get('flag/comment/{id}', 'FlagCommentController@show');
Route::post('flag/comment/{id}', "FlagCommentController@create")->middleware('auth');

// Votes
Route::post("post/{id}/vote", "VoteController@create")->middleware('auth');

// Authentication
Route::get('login', function () {return redirect('/?action=login');})->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('register', function () {return redirect('/?action=register');});
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register');

// Custom error pages
Route::view('404', 'errors.404');
Route::view('403', 'errors.403');


// Comments
Route::post('api/post/{id}/comment', 'CommentController@create');
Route::delete('api/post/comment/{cid}', 'CommentController@delete');
Route::put('api/post/comment/{cid}', 'CommentController@edit');

// User
Route::get('user/edit', 'UserController@edit')->middleware('auth');
Route::get('user/{username}', 'UserController@show');
Route::post('user/edit', 'UserController@editProfile');
Route::post('user/photo', 'UserController@uploadImage');
Route::post('user/{id}/follow', 'UserController@followUser')->middleware('auth');

// Admin
Route::get("/api/admin/users", "UserController@getAllUsers")->middleware("admin");
Route::get("/api/admin/usersSearch/{uname}", "UserController@getAllUsersLike")->middleware("admin");
Route::get("/api/admin/user/{uname}", "UserController@getUserDetails")->middleware("admin");
Route::put("/api/admin/user/{uid}/block", "UserController@blockUser")->middleware("admin");
Route::put("/api/admin/user/{uid}/block", "UserController@blockUser")->middleware("admin");
Route::delete("/api/admin/user/{uid}/deletePosts", "UserController@deleteUsersPosts")->middleware("admin");
Route::delete("/api/admin/user/{uid}/deleteComments", "UserController@deleteUsersComments")->middleware("admin");
Route::delete("/api/admin/user/{uid}/deleteAvatar", "UserController@deleteUsersAvatar")->middleware("admin");
Route::view("/admin/users", "pages.admin.users")->middleware("admin");
Route::view("/admin/users/{id}", "pages.admin.users")->middleware("admin");
Route::view("admin", "pages.admin.index")->middleware("admin");

Route::get("admin/universities", "UniversityController@manage")->middleware("admin");
Route::post("api/university", "UniversityController@create")->middleware("admin");
Route::get("university/{id}/edit", "UniversityController@edit")->middleware("admin");
Route::post("api/university/{id}/edit", "UniversityController@update")->middleware("admin");
Route::delete("api/university/{id}", "UniversityController@destroy")->middleware("admin");

Route::get("admin/faculties/{id}", "FacultyController@manage")->middleware("admin");
Route::post("api/faculty", "FacultyController@create")->middleware("admin");
Route::get("faculty/{id}/edit", "FacultyController@edit")->middleware("admin");
Route::post("api/faculty/{id}/edit", "FacultyController@update")->middleware("admin");
Route::delete("api/faculty/{id}", "FacultyController@destroy")->middleware("admin");

Route::get("admin/cities", "CityController@manage")->middleware("admin");
Route::post("api/city", "CityController@create")->middleware("admin");
Route::get("city/{id}/edit", "CityController@edit")->middleware("admin");
Route::post("api/city/{id}/edit", "CityController@update")->middleware("admin");
Route::delete("api/city/{id}", "CityController@destroy")->middleware("admin");

Route::get("admin/flagPosts", "FlagPostController@manage")->middleware("admin");
Route::post("/api/flagPosts/archive/{flagger_id}/{post_id}", "FlagPostController@archive")->middleware("admin");
Route::delete("/api/flagPosts/delete/{flagger_id}/{post_id}", "FlagPostController@delete")->middleware("auth");

Route::get("admin/flagUsers", "FlagUserController@manage")->middleware("admin");
Route::post("/api/flagUsers/archive/{flagger_id}/{flagged_id}", "FlagUserController@archive")->middleware("admin");
Route::delete("/api/flagUsers/delete/{flagger_id}/{flagged_id}", "FlagUserController@delete")->middleware("auth");

Route::get("admin/flagComments", "FlagCommentController@manage")->middleware("admin");
Route::post("/api/flagComments/archive/{flagger_id}/{comment_id}", "FlagCommentController@archive")->middleware("admin");
Route::delete("/api/flagComments/delete/{flagger_id}/{comment_id}", "FlagCommentController@delete")->middleware("auth");

Route::get('/admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware("admin");