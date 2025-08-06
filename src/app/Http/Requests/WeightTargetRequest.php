<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightTargetRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // 認証済みユーザーのみ許可する場合は適宜変更
    }

    public function rules()
    {
        return [
            'target_weight' => [
                'required',
                'regex:/^\d{1,4}(\.\d)?$/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.regex' => '4桁までの数字で入力してください。小数点は1桁で入力してください',
        ];
    }
}
