<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;


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


     $datos['posts']=Post::paginate(3);
    return view('auth.login', $datos);
});

/*-----------------------Rutas en relacion al Inicio donde se visualizan los post de los seguidores----------------*/
/*Una vez logueados, iremos a la pagina de inicio donde se visualizara post de los usuarios que seguimos
En caso contrario, se indicara e se incitara hacerlo
*/

Route::get('/dashboard', [InicioController::class,'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*-------------------------Rutas en relacion a la interfaz y controlador de busqueda----------------------------*/
/*En un principio no mostrará post o usuarios hasta que se metan los datos en el campo y se elija categoria
La vista que mostrará será igual a la del inicio en caso de ser post.*/
Route::get('/searchs/show', [SearchController::class,'show'])->middleware(['auth'])->name('searchs.show');
Route::get('/searchs/buscar', [SearchController::class,'index'])->middleware(['auth'])->name('searchs.index');

/*--------------------------------------------Rutas en relacion al Usuario------------------------------------------------------------------------*/
//Interfaz de perfil donde se visualizara los datos del usuario logueado asi como su contenido 
Route::get('/user/myprofile', [UserController::class,'myprofile'])->middleware(['auth'])->name('users.myprofile');
//Acceso al perfil del usuario conectado para su edicion
Route::get('/configuracion',[UserController::class, 'config'])->middleware(['auth'])->name('config');
//Guardado de perfil
Route::post('/user/saveProfile/{id}', [UserController::class,'saveProfile'])->middleware(['auth'])->name('user.saveProfile');
//Interfaz de perfild de usuario se podra borrar si es admin o seguir en ambos roles
Route::get('/users/{id}', [UserController::class,'profile'])->middleware(['auth'])->name('users.profile');
//Para borrar usuarios
Route::get('/user/destroy/{id}',[UserController::class, 'destroy'])->middleware(['auth'])->name('user.destroy');
//Ruta para seguir
Route::get('/user/follow/{id}',[UserController::class, 'follow'])->middleware(['auth'])->name('user.follow');
//Ruta para dejar de seguir
Route::get('/user/unfollow/{id}',[UserController::class, 'unfollow'])->middleware(['auth'])->name('user.unfollow');

/*------Rutas en relacion a la interfaz y controlador de alerts------*/
//Unica ruta que habrá para este ya que se ira actualizando sobre la misma
Route::get('/alerts', [AlertController::class,'index'])->middleware(['auth'])->name('alerts.index');

/*------Rutas en relacion a la interfaz y controlador de posts------*/
//Formulario que se reutilizara para editar
Route::get('/posts', [PostController::class,'create'])->middleware(['auth'])->name('posts.create');
//Ruta para a visualizacion de la imagen
Route::get('/post/image/{filename?}',[PostController::class, 'getImage'])->middleware(['auth'])->name('post.image');
//Dirige a la vista en detalle del post seleccionado
Route::get('/posts/show/{post}', [PostController::class,'show'])->middleware(['auth'])->name('posts.show');
//Ruta para almacenar la información del formulario de creacion de un post
Route::get('/posts/store', [PostController::class,'store'])->middleware(['auth'])->name('posts.store');
//Ruta para la edicion de un post desde el show (no funcional)
Route::get('/post/edit/{id}',[PostController::class, 'edit'])->middleware(['auth'])->name('post.edit');
//Ruta para actualizar post
Route::get('/post/update/{id}',[PostController::class, 'update'])->middleware(['auth'])->name('post.update');
//Ruta para eliminar post
Route::get('/post/destroy/{id}',[PostController::class, 'destroy'])->middleware(['auth'])->name('post.destroy');
//Ruta para los likes de post
Route::get('/post/like/{id}',[PostController::class, 'like'])->middleware(['auth'])->name('posts.like');
//Ruta para los comentarios de post. NO SE USA porque funciona como like, no tiene sentido
Route::get('/post/comentarios/{id}',[PostController::class, 'comentarios'])->middleware(['auth'])->name('posts.comentarios');
//Crear Comentarios
Route::get('/posts/createComment/{id}', [PostController::class,'createComment'])->middleware(['auth'])->name('posts.createComment');
//Guardar comentario
Route::get('/posts/saveComment', [PostController::class,'saveComment'])->middleware(['auth'])->name('posts.saveComment');
//Mostrar comentarios de ese post
Route::get('/posts/showComments/{post}', [PostController::class,'showComments'])->middleware(['auth'])->name('posts.showComments');
//Borrar comentarios
Route::get('/posst/destroyComments/{id}',[PostController::class, 'destroyComments'])->middleware(['auth'])->name('posts.destroyComments');
//Ruta para editar comentario
Route::get('/posts/editComment/{id}', [PostController::class,'editComment'])->middleware(['auth'])->name('posts.editComment');
//Ruta para actualizar comentario
Route::get('/posts/updateComment/{id}',[PostController::class, 'updateComment'])->middleware(['auth'])->name('posts.updateComment');