<?php

//use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Route: get Consultar
 * Route: post Guardar
 * Route: delete Eliminar
 * Route: put Actualizar
 */

//Esta es otra forma de hacerlo y se ve mejor

Route::controller(PageController::class)->group(function(){
    Route::get('/',             'home')->name('home');
    Route::get('blog',          'blog')->name('blog');
    Route::get('blog/{post:slug}',   'post')->name('post');
});




//Route::get('/', [PageController::class, 'home'])->name('home');

//Cambia esta forma y se lleva la lógica al controlador
/* Route::get('/', function () {
    //Vistas en public/resources/view
     return 'Ruta home';
     return view('home');
})->name('home');
 */
/* Route::get('blog', function(){
    return 'Ruta blog';
}); */


//Route::get('blog', [PageController::class, 'blog'])->name('blog');

/* Route::get('blog', function() {
    //Consulta base de datos
    $posts = [
        ['id' => 1, 'title' => 'Post 1', 'slug' => 'php'],
        ['id' => 2, 'title' => 'Post 2', 'slug' => 'laravel'],
        ['id' => 3, 'title' => 'Post 3', 'slug' => 'javascript'],
        ['id' => 4, 'title' => 'Post 4', 'slug' => 'vue.js'],
    ];
    return view('blog', ['posts' => $posts]);
})->name('blog'); */


// Route::get('blog/{slug}', [PageController::class, 'post'])->name('post');

/* Route::get('blog/{slug}', function($slug){
    //Consulta base de datos
    $post = $slug;

    return view('post', ['post' => $post]);
})->name('post'); */




/* Route::get('blog/{slug}', function($slug){
    return $slug;
});
 */
/* Route::get('buscar', function(Request $request){
    //Consulta base de datos
    return $request->all();
}); */
/* Route::get('buscar', function(Request $request){
    //Consulta base de datos
    return $request->all();
}); */



