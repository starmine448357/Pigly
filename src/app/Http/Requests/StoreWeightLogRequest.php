<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeightLogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

public function rules()
{
    return [
        'date' => 'required|date',
        'weight' => 'required|numeric|min:0|max:300',
        'exercise_time' => 'nullable|numeric|min:0|max:1000',
        'exercise_content' => 'nullable|string|max:100',
    ];
}

public function messages()
{
    return [
        'date.required' => '日付を入力してください。',
        'date.date' => '正しい日付を入力してください。',
        'weight.required' => '体重を入力してください。',
        'weight.numeric' => '体重は数値で入力してください。',
        'weight.min' => '体重は0kg以上で入力してください。',
        'weight.max' => '体重は300kg以下で入力してください。',
        'exercise_time.numeric' => '運動時間は数値で入力してください。',
        'exercise_time.min' => '運動時間は0分以上で入力してください。',
        'exercise_time.max' => '運動時間は1000分以下で入力してください。',
        'exercise_content.max' => '運動内容は100文字以内で入力してください。',
    ];
}
}