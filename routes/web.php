<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\PageController::class, 'home'])->name('home'); 


Route::get('/user/{id}' ,[App\Http\Controllers\PageController::class, 'userProfil'])->name('user');

Route::get('/searchFriend' ,[App\Http\Controllers\PageController::class, 'searchFriend'])->name('serachFriend');

//logout user 
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

