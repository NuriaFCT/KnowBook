<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Esto contendrá las rutas de la aplicación
|
*/

/*------------------------Rutas en relacion al registro e inica sesion-------------*/
//Nada más acceder al proyecto, se nos pedirá loguearnos
Route::get('/', function () {
    //return view('welcome');
    return view('auth.login');
});

/*-----------------------Rutas en relacion al Inicio donde se visualizan los post de los seguidores----------------*/
/*Una vez logueados, iremos a la pagina de inicio donde se visualizara post de los usuarios que seguimos
En caso contrario, se indicara e se incitara hacerlo
*/
Route::get('/dashboard', function (Request $request) {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*-------------------------Rutas en relacion a la interfaz y controlador de busqueda----------------------------*/
/*En un principio no mostrará post o usuarios hasta que se metan los datos en el campo y se elija categoria
La vista que mostrará será igual a la del inicio en caso de ser post.*/
Route::get('/searchs', [SearchController::class,'index'])->middleware(['auth'])->name('searchs.index');

/*--------------------------------------------Rutas en relacion al Usuario------------------------------------------------------------------------*/
//Interfaz de perfil donde se visualizara los datos de un usuario asi como su contenido y se podrá acceder a edicion de este si corresponde al de logueado
Route::get('/user/profile', [UserController::class,'profile'])->middleware(['auth'])->name('users.profile');
//Guardado de perfil
Route::post('/user/saveProfile', [UserController::class,'saveProfile'])->middleware(['auth'])->name('user.saveProfile');


/*------Rutas en relacion a la interfaz y controlador de alerts------*/
//Unica ruta que habrá para este ya que se ira actualizando sobre la misma
Route::get('/alerts', [AlertController::class,'index'])->middleware(['auth'])->name('alerts.index');

/*------Rutas en relacion a la interfaz y controlador de posts------*/
//Formulario que se reutilizara para editar
Route::get('/posts', [PostController::class,'create'])->middleware(['auth'])->name('posts.create');
//Ruta para a visualizacion de la imagen
Route::get('/post/image/{filename?}',[PostController::class, 'getImage'])->middleware(['auth'])->name('post.image');
//Route::resource('posts', PostController::class);