<?php

use Illuminate\Support\Facades\Route;

//Agregando las nuevas rutas
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CitationController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
<<<<<<< HEAD
use App\Http\Controllers\UserController;
=======
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CitacionController;
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3

/*
|--------------------------------------------------------------------------
| Web Routes
|-----------------------------------------------------  ---------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//Rutas públicas
//Rutas para el componente de comunidad
Route::get('/community', [CommunityController::class, 'index']);

//Rutas para el componente de archivos
Route::get('/file', [FileController::class, 'index']);

//Rutas para el componente de home
Route::get('/home', [HomeController::class, 'index']);

//Rutas para el componente de la metadata
Route::get('/metadata', [MetadataController::class, 'index']);

//Rutas para el componente de búsqueda
<<<<<<< HEAD
Route::get('/search', [SearchController::class, 'index']);

//Rutas para el componente de login
Route::get('/login', [UserController::class, 'login']);

//Private route
//Route for author controller 
Route::resource('/author', AuthorController::class)->except([
    'show', 'edit', 'destroy'
]);

//Route for citation controller
Route::resource('/citation', CitationController::class)->except([
    'show', 'edit', 'destroy'
]);

//Route for collection controller
Route::resource('/collection', CollectionController::class)->except([
    'show', 'edit', 'destroy'
]);

//Route for file controller
Route::resource('/file', FileController::class)->except([
    'show', 'edit', 'destroy'
]);

//Route for tag controller
Route::resource('/tag', TagController::class)->except([
    'edit', 'destroy'
]);

//Roles routes
Route::resource('/role', RoleController::class);
Route::resource('/module', ModuleController::class);
Route::resource('/user', UserController::class);
Route::get('/role/{id}/permisos', [RoleController::class, 'permisos']);
Route::post('/role/{id}/actualizar_permisos', [RoleController::class, 'actualizar_permisos']);
=======
Route::resource('/search', SearchController::class)->only(['index']);

//Rutas para el componente de Tags
Route::resource('/tags', TagController::class)->only(['index']);

//Rutas para el componente de Autores
Route::resource('/autor', AutorController::class)->only(['index']);

//Rutas para el componente de Citaciones
Route::resource('/citaciones', CitacionController::class)->only(['index']);

>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3
