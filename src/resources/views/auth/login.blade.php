@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    @component('auth.components.form-card', [
        'title' => 'PiGLy',
        'subtitle' => 'ログイン',
        'action' => route('login'),
        'buttonText' => 'ログイン',
        'footer' => '<a href="' . route('register') . '">アカウント作成はこちら</a>'
    ])
        <!-- メールアドレス -->
        <div class="auth-form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" placeholder="メールアドレスを入力" required>            </div>

        <!-- パスワード -->
        <div class="auth-form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="パスワードを入力" required>        </div>
    @endcomponent
</div>
@endsection
