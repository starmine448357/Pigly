<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use App\Http\Requests\WeightTargetRequest;

class WeightTargetController extends Controller
{
    // 編集画面表示
    public function edit()
    {
        $user = auth()->user();
        $target = WeightTarget::where('user_id', $user->id)->first();
        $targetWeight = $target ? $target->target_weight : null;

        return view('weight_target.edit', compact('targetWeight'));
    }

    // 更新処理
    public function update(WeightTargetRequest $request)
    {
        $user = auth()->user();

        $target = WeightTarget::firstOrNew(['user_id' => $user->id]);
        $target->target_weight = $request->target_weight;
        $target->save();

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました！');
    }
}
