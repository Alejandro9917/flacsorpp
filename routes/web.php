<?php

use Illuminate\Support\Facades\Route;

//Agregando las nuevas rutas
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\SearchController;
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

//Rutas para el componente de home
Route::get('/home', [HomeController::class, 'index']);

//Rutas para el componente de la metadata
Route::get('/metadata', [MetadataController::class, 'index']);

//Rutas para el componente de búsqueda
Route::get('/search', [SearchController::class, 'index']);

//Rutas para el componente de usuario
Route::get('/login', [UserController::class, 'login']);

//Rutas privadas