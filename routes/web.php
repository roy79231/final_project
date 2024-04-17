<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[GameController::class,'main'])->name('main');

Route::get('/achievement',[GameController::class,'achievement'])->middleware('auth')->name('achievement');

Route::get('/post',[GameController::class,'post'])->middleware('auth')->name('post');

Route::get('/start',[GameController::class,'start'])->middleware('auth')->name('start');

Route::get('/finish',[GameController::class,'finish'])->name('finish');
