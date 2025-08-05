<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RegisterWeightController;
use App\Http\Controllers\WeightTargetController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/register/step2', [RegisterWeightController::class, 'create'])->name('register.step2');
    Route::post('/register/step2', [RegisterWeightController::class, 'store'])->name('register.step2.store');
});

Route::get('/', function () {
    return redirect()->route('weight_logs.index');
});

Route::get('/weight_target/edit', [WeightTargetController::class, 'edit'])->name('weight_target.edit');

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
});
