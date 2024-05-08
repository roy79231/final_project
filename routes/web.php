<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RoleController;

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

Route::get('/roleControl', [RoleController::class,'index'])->name('index');

// 更新成 ROLE_ADMIN
Route::put('/setAdmin/{user}', [RoleController::class,'setAdmin'])->name('setAdmin');
Route::put('/setUser/{user}',[RoleController::class,'setUser'])->name('setUser');

//上傳資料的部分-------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/achievementUpLoader',[achievementUpLoadController::class, "achievementUpLoader"])->name('achievementUpLoader');
Route::post('/upLoader/store', [achievementUpLoadController::class, 'upLoadStore'])->name('upLoader.store');
Route::delete('/upLoader/destroy/{id}', [achievementUpLoadController::class, 'upLoadDestroy'])->name('upLoader.destroy');
Route::patch('/upLoader/edit/{id}', [achievementUpLoadController::class, 'upLoadEdit'])->name('upLoader.edit');

Route::get('/achievementEventUpLoader',[achievementEventUpLoadController::class, "achievementEventUpLoader"])->name('achievementEventUpLoader');
Route::post('/achievementEventUpLoader/store', [achievementEventUpLoadController::class, 'achievementEventUpLoadStore'])->name('achievementEventUpLoader.store');
Route::delete('/achievementEventUpLoader/destroy/{id}', [achievementEventUpLoadController::class, 'achievementEventUpLoadDestroy'])->name('achievementEventUpLoader.destroy');
Route::patch('/achievementEventUpLoader/edit/{id}', [achievementEventUpLoadController::class, 'achievementEventUpLoadEdit'])->name('achievementEventUpLoader.edit');

Route::get('/normalEventUpLoader',[normalEventUpLoadController::class, "normalEventUpLoader"])->name('normalEventUpLoader');
Route::post('/normalEventUpLoader/store', [normalEventUpLoadController::class, 'normalEventUpLoadStore'])->name('normalEventUpLoader.store');
Route::delete('/normalEventUpLoader/destroy/{id}', [normalEventUpLoadController::class, 'normalEventUpLoadDestroy'])->name('normalEventUpLoader.destroy');
Route::patch('/normalEventUpLoader/edit/{id}', [normalEventUpLoadController::class, 'normalEventUpLoadEdit'])->name('normalEventUpLoader.edit');

Route::get('/specialEventUpLoader',[specialEventUpLoadController::class, "specialEventUpLoader"])->name('specialEventUpLoader');
Route::post('/specialEventUpLoader/store', [specialEventUpLoadController::class, 'specialEventUpLoadStore'])->name('specialEventUpLoader.store');
Route::delete('/specialEventUpLoader/destroy/{id}', [specialEventUpLoadController::class, 'specialEventUpLoadDestroy'])->name('specialEventUpLoader.destroy');
Route::patch('/specialEventUpLoader/edit/{id}', [specialEventUpLoadController::class, 'specialEventUpLoadEdit'])->name('specialEventUpLoader.edit');

Route::get('/talentUpLoader',[talentUpLoadController::class, "talentUpLoader"])->name('talentUpLoader');
Route::post('/talentUpLoader/store', [talentUpLoadController::class, 'talentUpLoadStore'])->name('talentUpLoader.store');
Route::delete('/talentUpLoader/destroy/{id}', [talentUpLoadController::class, 'talentUpLoadDestroy'])->name('talentUpLoader.destroy');
Route::patch('/talentUpLoader/edit/{id}', [talentUpLoadController::class, 'talentUpLoadEdit'])->name('talentUpLoader.edit');

Route::get('/deadUpLoader',[deadUpLoadController::class, "deadUpLoader"])->name('deadUpLoader');
Route::post('/deadUpLoader/store', [deadUpLoadController::class, 'deadUpLoadStore'])->name('deadUpLoader.store');
Route::delete('/deadUpLoader/destroy/{id}', [deadUpLoadController::class, 'deadUpLoadDestroy'])->name('deadUpLoader.destroy');
Route::patch('/deadUpLoader/edit/{id}', [deadUpLoadController::class, 'deadUpLoadEdit'])->name('deadUpLoader.edit');

//結算頁面的部份-------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/finish',[GameController::class,'finish'])->name('finish');



Route::post('forumindex/forumcreate',[forumcontroller::class,'forumcreate'])->name('forumcreate');

Route::get('/forumindex',[forumcontroller::class,'forumindex'])->name('forumindex')->middleware('auth');

Route::post('forumindex/forumcreate',[forumcontroller::class,'forumcreate'])->name('forumcreate');

Route::post('forumindex/forumdelete/{id}',[forumcontroller::class,'forumdelete'])->name('forumdelete');

Route::post('forumindex/forumchange/{id}',[forumcontroller::class,'forumchange'])->name("forumchange");

Route::get('/achievementindex/{user_id}', [achievementcontroller::class, 'showAchievements'])->name('showAchievements')->middleware('auth');
