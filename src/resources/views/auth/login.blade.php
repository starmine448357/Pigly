@extends('layouts.app')

@section('body-class', 'app-body')

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
        {{-- メールアドレス入力フォーム --}}
        <div class="auth-form-group">
            <label for="email">メールアドレス</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                placeholder="メールアドレスを入力" 
                value="{{ old('email') }}" 
                required
            >
            @if($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        {{-- パスワード入力フォーム --}}
        <div class="auth-form-group">
            <label for="password">パスワード</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                placeholder="パスワードを入力" 
                required
            >
            @if($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        {{-- ログイン資格情報不一致エラー --}}
        @if($errors->has('login'))
            <div class="error">{{ $errors->first('login') }}</div>
        @endif

        {{-- 任意で全エラー表示をまとめて見たい場合はこちらのコメント解除で --}}
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
