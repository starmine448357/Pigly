@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card register-card">
        <div class="auth-title" style="color: #EC87EF; font-family: 'Lora', serif;">PiGLy</div>
        <div class="register-step2-subtitle">新規会員登録</div>
        <div class="register-step2-description">STEP2 体重データの入力</div>
        <form method="POST" action="{{ route('register.step2.store') }}" novalidate>
            @csrf
            <div class="auth-form-group" style="margin-bottom: 25px;">
                <label for="weight">現在の体重</label>
                <div style="display: flex; align-items: center;">
                    <input id="weight" type="text" name="weight" value="{{ old('weight') }}" placeholder="現在の体重を入力" required autofocus style="margin-right: 8px;">
                    <span>kg</span>
                </div>
                @error('weight')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="auth-form-group" style="margin-bottom: 35px;">
                <label for="target_weight">目標の体重</label>
                <div style="display: flex; align-items: center;">
                    <input id="target_weight" type="text" name="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力" required style="margin-right: 8px;">
                    <span>kg</span>
                </div>
                @error('target_weight')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="auth-button" style="margin-top: 10px;">アカウント作成</button>
        </form>
    </div>
</div>
@endsection
