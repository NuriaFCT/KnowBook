<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Esto contendrá las rutas de la aplicación
|
*/

/*--------Rutas en relacion al registro e inica sesion----------*/
Route::get('/', function () {
    //return view('welcome');
    return view('auth.login');
});

/*---------------Rutas en relacion al Inicio donde se visualizan los post de los seguidores----------*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*------Rutas en relacion a la interfaz y controlador de busqueda------*/
Route::get('/searchs', [SearchController::class,'index'])->middleware(['auth'])->name('searchs.index');

/*-------------Rutas en relacion al Usuario-----------*/
Route::get('/user/profile', [UserController::class,'profile'])->middleware(['auth'])->name('users.profile');

/*------Rutas en relacion a la interfaz y controlador de alerts------*/
Route::get('/alerts', [AlertController::class,'index'])->middleware(['auth'])->name('alerts.index');

/*------Rutas en relacion a la interfaz y controlador de posts------*/
Route::get('/posts', [PostController::class,'create'])->middleware(['auth'])->name('posts.create');