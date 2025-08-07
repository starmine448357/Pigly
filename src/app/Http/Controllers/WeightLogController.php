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
     * 体重記録一覧表示（検索・ページネーション対応）
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // ユーザーの体重記録を取得するクエリビルダー生成
        $query = WeightLog::where('user_id', $user->id);

        // 日付の範囲検索
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        // 日付降順で取得し、ページネーション(8件/ページ)、クエリパラメータ保持
        $weightLogs = $query->orderBy('date', 'desc')->paginate(8)->appends($request->all());

        // ユーザーの目標体重を取得
        $target = WeightTarget::where('user_id', $user->id)->first();
        $targetWeight = $target ? $target->target_weight : null;

        // 最新体重
        $latestWeight = optional($weightLogs->first())->weight;

        // 目標と最新の差分計算（なければ「計算不可」）
        $diffText = ($targetWeight !== null && $latestWeight !== null)
            ? number_format($targetWeight - $latestWeight, 1)
            : '計算不可';

        // 検索条件と件数の表示文作成
        $searchInfo = null;
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $start = $request->start_date ?? '開始なし';
            $end = $request->end_date ?? '終了なし';
            $count = $weightLogs->total();
            $searchInfo = "{$start}〜{$end}の検索結果 {$count}件";
        }

        // ビューにデータを渡して表示
        return view('weight_logs.index', [
            'weightLogs'   => $weightLogs,
            'targetWeight' => $targetWeight,
            'latestWeight' => $latestWeight,
            'diffText'     => $diffText,
            'searchInfo'   => $searchInfo,
        ]);
    }

    /**
     * 体重記録登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('weight_logs.create');
    }

    /**
     * 体重記録の登録処理
     *
     * @param StoreWeightLogRequest $request
     * @return \Illuminate\Http\RedirectResponse
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
     * 体重記録詳細画面表示
     *
     * @param int $weightLogId
     * @return \Illuminate\View\View
     */
    public function show($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('weight_logs.show', compact('weightLog'));
    }

    /**
     * 体重記録編集フォーム表示
     *
     * @param int $weightLogId
     * @return \Illuminate\View\View
     */
    public function edit($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('weight_logs.edit', compact('weightLog'));
    }

    /**
     * 体重記録編集の更新処理
     *
     * @param UpdateWeightLogRequest $request
     * @param int $weightLogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWeightLogRequest $request, $weightLogId)
    {
        $validated = $request->validated();

        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->update($validated);

        return redirect()->route('weight_logs.index')->with('success', '記録を更新しました！');
    }

    /**
     * 体重記録削除処理
     *
     * @param int $weightLogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->delete();

        return redirect()->route('weight_logs.index')->with('success', '記録を削除しました！');
    }
}
