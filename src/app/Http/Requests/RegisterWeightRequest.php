<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterWeightRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // 4桁まで・小数点は1桁まで
        return [
            'weight' => ['required', 'regex:/^\d{1,4}(\.\d)?$/'],
            'target_weight' => ['required', 'regex:/^\d{1,4}(\.\d)?$/'],
        ];
    }

    public function messages()
    {
        return [
            'weight.required' => '現在の体重を入力してください',
            'weight.regex' => '4桁までの数字で、小数点は1桁で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.regex' => '4桁までの数字で、小数点は1桁で入力してください',
        ];
    }
}
