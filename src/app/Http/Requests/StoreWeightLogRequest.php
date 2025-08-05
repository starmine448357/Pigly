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
            'date' => ['required', 'date'],
            'weight' => [
                'required',
                'numeric',
                'regex:/^\d{1,4}(\.\d)?$/'
            ],
            'meal_calories' => [
                'required',
                'numeric',
            ],
            'exercise_time' => [
                'required',
                // 00:00 形式を厳格にする場合は、'date_format:H:i' を追加
            ],
            'exercise_content' => [
                'nullable',
                'max:120',
            ],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '正しい日付を入力してください',

            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.regex' => '4桁までの数字で入力してください。小数点は1桁で入力してください',

            'meal_calories.required' => '摂取カロリーを入力してください',
            'meal_calories.numeric' => '数字で入力してください',

            'exercise_time.required' => '運動時間を入力してください',
            // 'exercise_time.date_format' => '時:分（00:00）形式で入力してください',

            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }
}
