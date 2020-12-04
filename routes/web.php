<?php

use Illuminate\Support\Facades\Route;

//Agregando las nuevas rutas
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CitationController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

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

//Rutas para el componente de datos(meta data)
Route::get('/meta-data', [MetadataController::class, 'create']);
Route::get('/campos-form', function () {
    return view('metadata.campos');
})->name('campos-add');

//Rutas para el componente de home
Route::get('/home', [HomeController::class, 'index']);


//Rutas para el componente de búsqueda
Route::get('/search', [SearchController::class, 'index']);

//Rutas para el componente de login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout']);

//Rutas públicas para la api
Route::get('/public/collection', [CollectionController::class, 'publicCollections']);

//Private route
//Route for author controller
Route::resource('/author', AuthorController::class)->except([
    'edit', 'destroy'
])->middleware('auth');

//Route for citation controller
Route::resource('/citation', CitationController::class)->except([
    'show', 'edit', 'destroy'
])->middleware('auth');
Route::get('citation/file/{file_id}', [CitationController::class, 'getCitationsFile']);

//Route for collection
Route::group(['middleware' => ['needs_role']], function () {
    Route::resource('/collection', CollectionController::class)->except([
        'edit', 'destroy'
    ]);
});
Route::middleware('auth')->group(function(){
    Route::get('/collection/in/{collection_slug}', [CollectionController::class, 'inCollection']);
    Route::get('/collection/childs/{collection_id}', [CollectionController::class, 'getChilds']);
});

//Route for file controller
Route::resource('/file', FileController::class)->except([
    'edit', 'destroy'
])->middleware('auth');
Route::middleware('auth')->group(function(){
    Route::get('/file/tags/{file_id}', [FileController::class, 'getTagsFile']);
    Route::post('/files/tags', [FileController::class, 'setFileTag']);
    Route::post('/files/tags/delete', [FileController::class, 'removeFileTag']);
    Route::get('file/in/{collection_slug}', [FileController::class, 'inCollection']);
    Route::get('file/childs/{collection_id}', [FileController::class, 'getChilds']);
});

//Route for tag controller
Route::resource('/tag', TagController::class)->except([
    'edit', 'destroy'
])->middleware('auth');

//Roles routes
Route::resource('/role', RoleController::class);
Route::resource('/module', ModuleController::class);
Route::resource('/user', UserController::class);
Route::get('/role/{id}/permisos', [RoleController::class, 'permisos']);
Route::post('/role/{id}/actualizar_permisos', [RoleController::class, 'actualizar_permisos']);


