<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightLogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date'   => ['required', 'date'],
            'weight' => [
                'required',
                'numeric',
                'regex:/^\d{1,4}(\.\d)?$/'
            ],
            'meal_calories' => ['required', 'numeric'],
            'exercise_time' => ['required'],
            'exercise_content' => ['max:120'],
        ];
    }

    public function messages()
    {
        return [
            // 日付
            'date.required' => '日付を入力してください',

            // 体重
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.regex' => '4桁までの数字で入力してください', // ※「小数点は1桁で入力してください」を分けて出したい場合は後述

            // 摂取カロリー
            'meal_calories.required' => '摂取カロリーを入力してください',
            'meal_calories.numeric' => '数字で入力してください',

            // 運動時間
            'exercise_time.required' => '運動時間を入力してください',

            // 運動内容
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }
}
