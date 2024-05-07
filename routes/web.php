
<?php

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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // PARA CATEGORIAS
    Route::get('/categorias', [App\Http\Controllers\CategoriasController::class, 'index']);
    Route::get('/categorias/registrar', [App\Http\Controllers\CategoriasController::class, 'create']);
    Route::post('/categorias/registrar', [App\Http\Controllers\CategoriasController::class, 'store']);
    Route::get('/categorias/actualizar/{id}', [App\Http\Controllers\CategoriasController::class, 'edit']);
    Route::put('/categorias/actualizar/{id}', [App\Http\Controllers\CategoriasController::class, 'update']);
    Route::get('/categorias/estado/{id}', [App\Http\Controllers\CategoriasController::class, 'estado']);

    // PARA TAGS
    Route::get('/tags', [App\Http\Controllers\TagsController::class, 'index']);
    Route::get('/tags/registrar', [App\Http\Controllers\TagsController::class, 'create']);
    Route::post('/tags/registrar', [App\Http\Controllers\TagsController::class, 'store']);
    Route::get('/tags/actualizar/{id}', [App\Http\Controllers\TagsController::class, 'edit']);
    Route::put('/tags/actualizar/{id}', [App\Http\Controllers\TagsController::class, 'update']);
    Route::get('/tags/estado/{id}', [App\Http\Controllers\TagsController::class, 'estado']);

    // PARA POSTS
    Route::get('/posts', [App\Http\Controllers\PostsController::class, 'index']);
    Route::get('/posts/registrar', [App\Http\Controllers\PostsController::class, 'create']);
    Route::post('/posts/registrar', [App\Http\Controllers\PostsController::class, 'store']);
    Route::get('/posts/ver/{id}', [App\Http\Controllers\PostsController::class, 'show']);
    Route::get('/posts/actualizar/{id}', [App\Http\Controllers\PostsController::class, 'edit']);
    Route::put('/posts/actualizar/{id}', [App\Http\Controllers\PostsController::class, 'update']);
    Route::get('/posts/estado/{id}', [App\Http\Controllers\PostsController::class, 'estado']);

    // PARA COMENTARIOS
    Route::get('/comentarios', [App\Http\Controllers\ComentariosController::class, 'index']);
    Route::get('/comentarios/registrar/{post_id}', [App\Http\Controllers\ComentariosController::class, 'create']);
    Route::post('/comentarios/registrar/{post_id}', [App\Http\Controllers\ComentariosController::class, 'store']);
    Route::get('/comentarios/actualizar/{id}', [App\Http\Controllers\ComentariosController::class, 'edit']);
    Route::put('/comentarios/actualizar/{id}', [App\Http\Controllers\ComentariosController::class, 'update']);
    Route::get('/comentarios/estado/{id}', [App\Http\Controllers\ComentariosController::class, 'estado']);

    // PARA USUARIOS
    Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index']);
});
