<?php

return [

    'confirmed' => ':attributeが一致しません。',
    'required' => ':attributeは必須項目です。',
    'email' => ':attributeは有効なメールアドレス形式で入力してください。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],
    'unique' => 'その:attributeはすでに使用されています。',
    'string' => ':attributeは文字列で入力してください。',
    'integer' => ':attributeは整数で入力してください。',
    'numeric' => ':attributeは数値で入力してください。',
    'regex' => ':attributeの形式が正しくありません。',
    'same' => ':attributeと:otherが一致しません。',
    'in' => '選択された:attributeは無効です。',

    'custom' => [
        'name.required' => '名前を入力してください。',
        'email.required' => 'メールアドレスを入力してください。',
        'email.email' => '有効なメールアドレス形式で入力してください。',
        'password.required' => 'パスワードを入力してください。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'target_weight.required' => '目標の体重を入力してください。',
        'target_weight.numeric' => '目標の体重は数値で入力してください。',
    ],

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'target_weight' => '目標の体重',
    ],
];
