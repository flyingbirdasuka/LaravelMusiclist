<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\SongsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ListsController::class, 'index']);

Auth::routes();

Route::resource('lists', ListsController::class);

// Route::resource('songs', SongsController::class);
Route::get('/songs/create/{listId}', [SongsController::class, 'create']);
Route::post('/songs', [SongsController::class, 'store']);
Route::delete('/songs/{id}', [SongsController::class, 'destroy'])->name('song-destroy');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

