<?php

use Illuminate\Support\Facades\Route;

//Agregando las nuevas rutas
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CitacionController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;

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

//Rutas para el componente de comunidad
Route::resource('/community', CommunityController::class)->only(['index']);

//Rutas para el componente de archivos
Route::resource('/file', FileController::class)->only(['index']);

//Rutas para el componente de home
Route::resource('/home', HomeController::class)->only(['index']);

//Rutas para el componente de login
Route::resource('/login', LoginController::class)->only(['index']);

//Rutas para el componente de la metadata
Route::resource('/metadata', MetadataController::class)->only(['index']);

//Rutas para el componente de búsqueda
Route::resource('/search', SearchController::class)->only(['index']);

//Rutas para el componente de Tags
Route::resource('/tags', TagController::class)->only(['index']);

//Rutas para el componente de Autores
Route::resource('/autor', AutorController::class)->only(['index']);

//Rutas para el componente de Citaciones
Route::resource('/citaciones', CitacionController::class)->only(['index']);

