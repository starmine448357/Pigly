<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RegisterWeightController;
use App\Http\Controllers\WeightTargetController;

/*
|--------------------------------------------------------------------------
| 認証関連ルート（Fortifyカスタムビュー）
|--------------------------------------------------------------------------
*/

// ログイン画面（未認証のみ）
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// 会員登録画面（未認証のみ）
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

// 会員登録POST処理（Fortify）
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
| 認証必須エリア（体重記録管理）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // トップページは体重記録一覧へリダイレクト
    Route::get('/', fn() => redirect()->route('weight_logs.index'));

    // 体重記録一覧
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

    // 体重記録作成フォーム
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');

    // 体重記録保存
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

    // 体重記録検索
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

    // 体重記録詳細表示
    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show'])->name('weight_logs.show');

    // 体重記録編集フォーム表示
    Route::get('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'edit'])->name('weight_logs.edit');

    // 体重記録更新処理
    Route::put('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');

    // 体重記録削除
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

    // 目標体重編集（コントローラ未実装だったものを下に移動し有効化）
    Route::get('/weight_target/edit', [WeightTargetController::class, 'edit'])->name('weight_target.edit');
    Route::put('/weight_target/update', [WeightTargetController::class, 'update'])->name('weight_target.update');
});

/*
|--------------------------------------------------------------------------
| テスト用ルート（開発・動作確認用。不要なら削除OK）
|--------------------------------------------------------------------------

Route::get('/test', fn() => 'Test route is working!');
*/