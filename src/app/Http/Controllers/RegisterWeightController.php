<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreInitialWeightRequest;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class RegisterWeightController extends Controller
{
    public function create()
    {
        return view('auth.register_step2');
    }

    public function store(StoreInitialWeightRequest $request)
    {
        $user = Auth::user();

        WeightTarget::create([
            'user_id'       => $user->id,
            'weight'        => $request->input('weight'),         // ←初期体重も保存
            'target_weight' => $request->input('target_weight'),
        ]);

        return redirect()->route('weight_logs.index'); // 仮
    }
}
