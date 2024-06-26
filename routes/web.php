<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\upLoadControllers\achievementUpLoadController;
use App\Http\Controllers\upLoadControllers\achievementEventUpLoadController;
use App\Http\Controllers\upLoadControllers\normalEventUpLoadController;
use App\Http\Controllers\upLoadControllers\specialEventUpLoadController;
use App\Http\Controllers\upLoadControllers\talentUpLoadController;
use App\Http\Controllers\upLoadControllers\deadUpLoadController;
use App\Http\Controllers\talentController;

use Illuminate\Support\Facades\Auth;

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

Route::get('/addPoints',[TalentController::class,'showForm'])->middleware('auth')->name('addPoints');

Route::get('/achievement',[GameController::class,'achievement'])->middleware('auth')->name('achievement');

Route::get('/post',[GameController::class,'post'])->middleware('auth')->name('post');

Route::get('/start',[GameController::class,'start'])->middleware('auth')->name('start');

Route::post('/run',[GameController::class,'run'])->middleware('auth')->name('run');   //timlin:我在這裡把run 牽到monthlyevent的balde

Route::get('/finish',[GameController::class,'finish'])->name('finish');

// 更新成 ROLE_ADMIN---------------------------------------------------------------------------------------------------------------------------------------
Route::get('/roleControl', [RoleController::class,'index'])->name('index');
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

//這是討論區---------------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('forumindex/forumcreate',[forumcontroller::class,'forumcreate'])->name('forumcreate');
Route::get('/forumindex',[forumcontroller::class,'forumindex'])->name('forumindex')->middleware('auth');
Route::post('forumindex/forumcreate',[forumcontroller::class,'forumcreate'])->name('forumcreate');
Route::post('forumindex/forumdelete/{id}',[forumcontroller::class,'forumdelete'])->name('forumdelete');
Route::post('forumindex/forumchange/{id}',[forumcontroller::class,'forumchange'])->name("forumchange");
Route::get('/achievementindex/{user_id}', [achievementcontroller::class, 'showAchievements'])->name('showAchievements')->middleware('auth');
