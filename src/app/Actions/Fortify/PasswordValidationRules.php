<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }

    
}
return [
    // 他のルールと一緒に…

    'confirmed' => ':attributeが一致しません。',
    
    'attributes' => [
        'password' => 'パスワード',
        // 他に使ってるカラム名もここに入れると綺麗に表示される
    ],
];

