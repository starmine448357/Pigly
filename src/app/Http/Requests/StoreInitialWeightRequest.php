<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInitialWeightRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'weight' => ['required', 'regex:/^\d{1,4}(\.\d)?$/'],
            'target_weight' => ['required', 'regex:/^\d{1,4}(\.\d)?$/'],
        ];
    }

    public function messages()
    {
        return [
            // 現在の体重
            'weight.required' => '現在の体重を入力してください',
            'weight.regex' => '4桁までの数字で、小数点は1桁で入力してください',
            // 目標の体重
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.regex' => '4桁までの数字で、小数点は1桁で入力してください',
        ];
    }
}
