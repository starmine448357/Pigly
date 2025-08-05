<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeightLogRequest;
use App\Models\WeightTarget;

class WeightLogController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $query = WeightLog::where('user_id', $user->id);

        // ...省略...

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);

        $target = WeightTarget::where('user_id', $user->id)->first();
        $targetWeight = $target ? $target->target_weight : null;
        $latestWeight = optional($weightLogs->first())->weight;
        $diffText = ($targetWeight !== null && $latestWeight !== null)
            ? number_format($targetWeight - $latestWeight, 1)
            : '計算不可';

        return view('weight_logs.index', [
            'weightLogs'   => $weightLogs,
            'targetWeight' => $targetWeight,
            'latestWeight' => $latestWeight,
            'diffText'     => $diffText,
        ]);
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id'          => auth()->id(),
            'date'             => $request->date,
            'weight'           => $request->weight,
            'meal_calories'    => $request->meal_calories,     // 食事摂取カロリー（必要なら追加）
            'exercise_time'    => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        // 一覧へリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '記録しました！');
    }

}
