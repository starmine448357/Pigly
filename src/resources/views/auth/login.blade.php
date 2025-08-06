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
            <input id="email" type="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}" required>
            @if($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- パスワード -->
        <div class="auth-form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="パスワードを入力" required>
            @if($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- 資格情報不一致エラー -->
        @if($errors->has('login'))
            <div class="error">{{ $errors->first('login') }}</div>
        @endif

        <!-- その他すべてのエラーをまとめて最上部で出したい場合はここ（任意） -->
        {{-- 
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        --}}
    @endcomponent
</div>
@endsection
