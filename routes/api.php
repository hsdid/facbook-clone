<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//show all users
Route::get('allUsers',[App\Http\Controllers\HomeController::class, 'index']);

//add user to friend
Route::post('toFriend',[App\Http\Controllers\UserController::class, 'addToFriend']);

// remove from friends
Route::delete('removeFriend',[App\Http\Controllers\UserController::class, 'removeFriend']);

//show friends
Route::get('showFriends',[App\Http\Controllers\HomeController::class, 'showFriends']);

//send message
Route::post('sendMsg',[App\Http\Controllers\MessageController::class, 'store']);

//get msg
Route::get('showMsg',[App\Http\Controllers\MessageController::class,'showMsg']);

//show user profil 
Route::get('/user/{id}',[App\Http\Controllers\UserController::class,'show']);

//add article 
Route::post('addArticle',[App\Http\Controllers\ArticleController::class, 'add_article']);

//get all articles
Route::get('articles',[App\Http\Controllers\ArticleController::class,'all_articles']);

//get only one user articles 
Route::get('articles/user/{id}',[App\Http\Controllers\ArticleController::class,'user_articles']);

// delete article
Route::delete('article/destroy',[App\Http\Controllers\ArticleController::class,'destroy']);

///Add to favorite 

Route::post('addToFavorite',[App\Http\Controllers\FavoriteController::class, 'add_to_favorite']);

//show favorite posts

Route::get('showFavorite',[App\Http\Controllers\FavoriteController::class, 'index']);

//post comment
Route::post('comment',[App\Http\Controllers\CommentController::class, 'add_comment']);

// return comments
Route::get('comments',[App\Http\Controllers\CommentController::class, 'get_comment']);
