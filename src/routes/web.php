<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RegisterWeightController;
use App\Http\Controllers\WeightTargetController;


/*
|--------------------------------------------------------------------------
| ログイン・会員登録画面（Fortify用・カスタムビュー）
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
| 会員登録POST（Fortify用）
|--------------------------------------------------------------------------
*/
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

/*
|--------------------------------------------------------------------------
| 初回登録ステップ（目標体重の初期登録）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/register/step2', [RegisterWeightController::class, 'create'])->name('register.step2');
    Route::post('/register/step2', [RegisterWeightController::class, 'store'])->name('register.step2.store');
});

/*
|--------------------------------------------------------------------------
| 認証必須エリア（WeightLog）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // トップ（一覧）
    Route::get('/', fn() => redirect()->route('weight_logs.index'));
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

    // 体重登録
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

    // 体重検索
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

    // 体重詳細
    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show'])->name('weight_logs.show');

    // 体重更新（編集フォーム表示・保存）
    Route::get('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');

    // 体重削除
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

    // 目標体重編集（コントローラ未実装のためコメントアウト）
    // Route::get('/weight_target/edit', [WeightTargetController::class, 'edit'])->name('weight_target.edit');
    // Route::post('/weight_target/update', [WeightTargetController::class, 'update'])->name('weight_target.update');
});

/*
|--------------------------------------------------------------------------
| テスト用ルート（開発・動作確認用。不要なら削除OK）
|--------------------------------------------------------------------------
*/
Route::get('/test', fn() => 'Test route is working!');

Route::get('/weight_target/edit', [WeightTargetController::class, 'edit'])->name('weight_target.edit');

Route::put('/weight_target/update', [WeightTargetController::class, 'update'])->name('weight_target.update');
