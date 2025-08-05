<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeightLogRequest;

class WeightLogController extends Controller
{

    public function index()
    {
        $logs = WeightLog::latest()->get(); // ← auth() を外す
        return view('weight_logs.index', compact('logs'));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.create')->with('success', '記録しました！');
    }

}
