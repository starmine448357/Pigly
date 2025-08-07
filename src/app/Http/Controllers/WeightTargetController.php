<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use App\Http\Requests\WeightTargetRequest;

class WeightTargetController extends Controller
{
    /**
     * 目標体重編集画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();

        // ユーザーの目標体重を取得（なければnull）
        $target = WeightTarget::where('user_id', $user->id)->first();
        $targetWeight = $target ? $target->target_weight : null;

        return view('weight_target.edit', compact('targetWeight'));
    }

    /**
     * 目標体重の更新処理
     *
     * @param WeightTargetRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WeightTargetRequest $request)
    {
        $user = auth()->user();

        // ユーザーの目標体重レコードを取得、なければ新規作成
        $target = WeightTarget::firstOrNew(['user_id' => $user->id]);

        // 目標体重を更新して保存
        $target->target_weight = $request->target_weight;
        $target->save();

        return redirect()->route('weight_logs.index')
                         ->with('success', '目標体重を更新しました！');
    }
}
