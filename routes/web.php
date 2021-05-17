<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FanArtController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\LoginRecordController;
use App\Models\FanArt;

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
Route::get('/', function () {
    $fanarts = FanArt::all()->sortByDesc("create_at");
    foreach ($fanarts as $key => $value) {
        $fanarts[$key]->category = Category::findOrFail($fanarts[$key]->id_category);

    }
    return view('public/index',['fanarts'=> $fanarts]);
});

Route::get('public/about', function () {
    return view('public/about');
});

// Public ROUTES
Route::get('/login',  [UserController::class, 'login'])->name('login');
Route::post('/login',  [UserController::class, 'log_in']);
Route::get('/logout',  [UserController::class, 'logout'])->name('logout');

//User Off
Route::get('/public/index', [UserController::class, 'index']);
Route::get('/public/new',  [UserController::class, 'create']);
Route::post('/user',  [UserController::class, 'store']);

//User On
Route::get('/user/users', [UserController::class, 'indexOn'])->middleware('auth');
Route::get('/user/{id}/show', [UserController::class, 'show'])->middleware('auth');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::post('/user/update/{id}', [UserController::class, 'update'])->middleware('auth');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->middleware('auth');

//Fanart
Route::get('/fanart/fanarts', [FanArtController::class, 'index'])->middleware('auth');
Route::get('/fanart/new',  [FanArtController::class, 'create'])->middleware('auth');
Route::post('/fanart',  [FanArtController::class, 'store'])->middleware('auth');
Route::get('/fanart/{id}/show', [FanArtController::class, 'show'])->middleware('auth');
Route::get('/fanart/{id}/edit', [FanArtController::class, 'edit'])->middleware('auth');
Route::post('/fanart/update/{id}', [FanArtController::class, 'update'])->middleware('auth');
Route::delete('/fanart/delete/{id}', [FanArtController::class, 'destroy'])->middleware('auth');

//Evaluation
Route::get('/evaluation/evaluations', [EvaluationController::class, 'index'])->middleware('auth');
//Route::get('/evaluation/new',  [EvaluationController::class, 'create'])->middleware('auth');
Route::post('/evaluation',  [EvaluationController::class, 'store'])->middleware('auth');
Route::get('/evaluation/{id}/show', [EvaluationController::class, 'show'])->middleware('auth');
Route::post('/evaluation/approve/{id}', [EvaluationController::class, 'toApprove'])->middleware('auth');
Route::get('/evaluation/{id}/edit', [EvaluationController::class, 'edit'])->middleware('auth');
Route::post('/evaluation/update/{id}', [EvaluationController::class, 'update'])->middleware('auth');
Route::delete('/evaluation/delete/{id}', [EvaluationController::class, 'destroy'])->middleware('auth');

//LoginRecords
Route::get('/loginrecord/loginrecords', [LoginRecordController::class, 'index'])->middleware('auth');
