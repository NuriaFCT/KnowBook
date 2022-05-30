<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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

     $datos['posts']=Post::paginate(3);
    return view('auth.login', $datos);
});

/*-----------------------Rutas en relacion al Inicio donde se visualizan los post de los seguidores----------------*/
/*Una vez logueados, iremos a la pagina de inicio donde se visualizara post de los usuarios que seguimos
En caso contrario, se indicara e se incitara hacerlo
*/
Route::get('/dashboard', function (Request $request) {


    //---------------POSTS SEGUIDORES---------------
    //Sacar el id de logueado para usarlo en consulta
    $id = Auth::user()->id;

    //dd($id);

    //Sacar los id de las personas que sigo, mis seguidos
    $id_user_follower = DB::table('followers')
    ->select('followers.id_user_follower')
    ->join('users', 'users.id', '=', 'followers.user_id')
    ->where('users.id', '=', $id)
    ->get();

    $array_id_user_followers = array($id_user_follower);
    
    $posts = DB::table('posts')
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->join('followers', 'followers.id_user_follower', '=', 'users.id')
    ->get();
            
    $isEmpty = empty($array_id_user_followers[0][0]);

    //dd($array_id_user_followers[0][0]);
    //dd($isEmpty);

    if(!$isEmpty){

        foreach($array_id_user_followers as $id_user){

            $posts->Where('followers.id_user_follower', '=' , json_encode($id_user));
                
        }
    
    }else{

        $posts = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->join('followers', 'followers.id_user_follower', '=', 'users.id')
        ->where('followers.id_user_follower', '=' , 0)
        ->get();
    }

    //dd($posts);
    
    $array_id_posts = array($posts);
  
    //--------------------------------LIKES---------------------
    $array_id_posts = array($posts);

     //Con esta consulta sacaremos el numero de likes por cada post
     $likes = DB::table('likes')
     ->select(DB::raw('count(likes.id) as contador'))      
     ->get();
    

    foreach ($array_id_posts as  $id_posts){

    $likes->where('likes.post_id', '=', json_encode($id_posts));

    //$likes->where('likes.post_id', '=', 1);

    }

   // dd($likes);

    

     //------------COMMENT. ------------Con esta consulta sacaremos el numero de comentarios de cada post
     $comments = DB::table('comments')
     ->select(DB::raw('count(comments.post_id) as contadorComentarios'))
     ->where('comments.post_id', '=', 34)  //hay que cambiar el 34 igual que arriba
     ->get();


    return view('dashboard', ["posts" => $posts, "likes"=>$likes, "comments"=>$comments]);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*-------------------------Rutas en relacion a la interfaz y controlador de busqueda----------------------------*/
/*En un principio no mostrará post o usuarios hasta que se metan los datos en el campo y se elija categoria
La vista que mostrará será igual a la del inicio en caso de ser post.*/
Route::get('/searchs', [SearchController::class,'index'])->middleware(['auth'])->name('searchs.index');

/*--------------------------------------------Rutas en relacion al Usuario------------------------------------------------------------------------*/
//Interfaz de perfil donde se visualizara los datos del usuario logueado asi como su contenido 
Route::get('/user/myprofile', [UserController::class,'myprofile'])->middleware(['auth'])->name('users.myprofile');
//Acceso al perfil del usuario conectado para su edicion
Route::get('/configuracion',[UserController::class, 'config'])->middleware(['auth'])->name('config');
//Route::get('/user/edit',[UserController::class, 'edit'])->middleware(['auth'])->name('user.edit');
//Guardado de perfil
Route::post('/user/saveProfile', [UserController::class,'saveProfile'])->middleware(['auth'])->name('user.saveProfile');
//Interfaz de perfild de usuario se podra borrar si es admin o seguir en ambos roles
Route::get('/users/{user}', [UserController::class,'profile'])->middleware(['auth'])->name('users.profile');

/*------Rutas en relacion a la interfaz y controlador de alerts------*/
//Unica ruta que habrá para este ya que se ira actualizando sobre la misma
Route::get('/alerts', [AlertController::class,'index'])->middleware(['auth'])->name('alerts.index');

/*------Rutas en relacion a la interfaz y controlador de posts------*/
//Formulario que se reutilizara para editar
Route::get('/posts', [PostController::class,'create'])->middleware(['auth'])->name('posts.create');
//Ruta para a visualizacion de la imagen
Route::get('/post/image/{filename?}',[PostController::class, 'getImage'])->middleware(['auth'])->name('post.image');
//Dirige a la vista en detalle del post seleccionado
Route::get('/posts/{post}', [PostController::class,'show'])->middleware(['auth'])->name('posts.show');
//Ruta para almacenar la información del formulario de creacion de un post
Route::get('/posts/store', [PostController::class,'post'])->name('posts.store');
//Ruta para la edicion de un post desde el show (no funcional)
Route::get('/post/edit',[PostController::class, 'edit'])->middleware(['auth'])->name('post.edit');

//Route::resource('posts', PostController::class);