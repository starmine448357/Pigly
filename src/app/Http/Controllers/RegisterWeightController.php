<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreInitialWeightRequest;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class RegisterWeightController extends Controller
{
    /**
     * 初期体重登録フォームの表示
     */
    public function create()
    {
        return view('auth.register_step2');
    }

    /**
     * 初期体重と目標体重の保存処理
     *
     * @param StoreInitialWeightRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreInitialWeightRequest $request)
    {
        $user = Auth::user();

        // WeightTargetモデルに初期体重と目標体重を登録
        WeightTarget::create([
            'user_id'       => $user->id,
            'weight'        => $request->input('weight'),         // 初期体重
            'target_weight' => $request->input('target_weight'),  // 目標体重
        ]);

        // 体重ログ一覧ページへリダイレクト（仮のルート名）
        return redirect()->route('weight_logs.index');
    }
}
