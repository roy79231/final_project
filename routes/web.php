<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\forumcontroller;
use App\Http\Controllers\achievementcontroller;
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

Route::get('/achievement/{id}',[GameController::class,'achievement'])->middleware('auth')->name('achievement');

Route::get('/post',[GameController::class,'post'])->middleware('auth')->name('post');

Route::get('/start',[GameController::class,'start'])->middleware('auth')->name('start');

Route::get('/finish',[GameController::class,'finish'])->name('finish');




Route::post('forumindex/forumcreate',[forumcontroller::class,'forumcreate'])->name('forumcreate');

Route::get('/forumindex',[forumcontroller::class,'forumindex'])->name('forumindex')->middleware('auth');

Route::post('forumindex/forumcreate',[forumcontroller::class,'forumcreate'])->name('forumcreate');

Route::post('forumindex/forumdelete/{id}',[forumcontroller::class,'forumdelete'])->name('forumdelete');

Route::post('forumindex/forumchange/{id}',[forumcontroller::class,'forumchange'])->name("forumchange");

Route::get('/achievementindex/{user_id}', [achievementcontroller::class, 'showAchievements'])->name('showAchievements')->middleware('auth');
