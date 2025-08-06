<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;

class WeightLogController extends Controller
{
    /**
     * 一覧表示
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = WeightLog::where('user_id', $user->id);

        // 日付範囲で絞り込み
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8)->appends($request->all());

        $target = WeightTarget::where('user_id', $user->id)->first();
        $targetWeight = $target ? $target->target_weight : null;
        $latestWeight = optional($weightLogs->first())->weight;
        $diffText = ($targetWeight !== null && $latestWeight !== null)
            ? number_format($targetWeight - $latestWeight, 1)
            : '計算不可';

        // 検索条件と件数の表示用
        $searchInfo = null;
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $start = $request->start_date ?? '開始なし';
            $end = $request->end_date ?? '終了なし';
            $count = $weightLogs->total();
            $searchInfo = "{$start}〜{$end}の検索結果 {$count}件";
        }

        return view('weight_logs.index', [
            'weightLogs'   => $weightLogs,
            'targetWeight' => $targetWeight,
            'latestWeight' => $latestWeight,
            'diffText'     => $diffText,
            'searchInfo'   => $searchInfo,
        ]);
    }
        

    /**
     * 登録フォーム表示
     */
    public function create()
    {
        return view('weight_logs.create');
    }

    /**
     * 登録処理
     */
    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id'          => auth()->id(),
            'date'             => $request->date,
            'weight'           => $request->weight,
            'meal_calories'    => $request->meal_calories,
            'exercise_time'    => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '記録しました！');
    }

    /**
     * 詳細画面
     */
    public function show($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('weight_logs.show', compact('weightLog'));
    }

    /**
     * 編集フォーム表示
     */
    public function edit($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('weight_logs.edit', compact('weightLog'));
    }

    /**
     * 編集内容の保存
     */
    public function update(UpdateWeightLogRequest $request, $weightLogId)
    {
        $validated = $request->validated();

        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->update($validated);

        return redirect()->route('weight_logs.index')->with('success', '記録を更新しました！');
    }

        /**
         * 削除処理
         */
        public function destroy($weightLogId)
        {
            $weightLog = WeightLog::findOrFail($weightLogId);
            $weightLog->delete();

            return redirect()->route('weight_logs.index')->with('success', '記録を削除しました！');
        }
    }
