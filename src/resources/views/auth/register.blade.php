@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    @component('auth.components.form-card', [
        'title' => 'PiGLy',
        'subtitle' => '新規会員登録',
        'description' => 'STEP1 アカウント情報の登録',
        'action' => route('register'),
        'buttonText' => '登録',
        'footer' => '<a href="' . route('login') . '">ログインはこちら</a>',
        'cardClass' => 'auth-card register-card'
    ])
        <!-- 名前 -->
        <div class="auth-form-group">
            <label for="name">名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="名前を入力">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="auth-form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="メールアドレスを入力">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="auth-form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required placeholder="パスワードを入力">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    @endcomponent
</div>
@endsection
