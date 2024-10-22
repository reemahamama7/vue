<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('posts', 'PostController@index');
// Route::group(['prefix' => 'post'], function () {
//     Route::post('create', 'PostController@create');
//     Route::get('edit/{id}', 'PostController@edit');
//     Route::post('update/{id}', 'PostController@update');
//     Route::delete('destroy/{id}', 'PostController@destroy');
// });
// Route::get('books', BookController::class,'index');
Route::get('books',[BookController::class,'index']);

Route::group(['prefix' => 'book'], function () {
    Route::post('add', [BookController::class,'add']);
    Route::get('edit/{id}', [BookController::class,'edit']);
    Route::post('/update/{id}', [BookController::class,'update']);
    Route::delete('/delete/{id}', [BookController::class,'delete']);
});
Route::get('/posts/author/{author}', [PostController::class, 'getPostsByAuthor']);
// Route::delete('/delete/books/{id}',[BookController::class,'delete']);
Route::get('/authors', [UserController::class, 'index']);
Route::get('/users-with-posts', [UserController::class, 'index2']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/users', function() {
    return User::select('id', 'name')->get();  // Only return id and name for dropdown
});
Route::put('/posts/{id}', [UserController::class, 'updatePost']);
Route::delete('/posts/{id}', [UserController::class, 'deletePost']);
Route::post('/users', [UserController::class, 'store']);