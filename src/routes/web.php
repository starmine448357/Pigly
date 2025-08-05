<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| ログイン・登録画面の表示（Fortifyが必要）
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

/*
|--------------------------------------------------------------------------
| 認証が必要なルート（未ログインなら自動で /login に飛ばされる）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
});

/*
|--------------------------------------------------------------------------
| 登録POSTルート（Fortifyに必要）
|--------------------------------------------------------------------------
*/
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest'])
    ->name('register');

Route::get('/test', function () {
    return 'Test route is working!';
});
