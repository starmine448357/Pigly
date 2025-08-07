@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
<link rel="stylesheet" href="{{ asset('css/weightlog_edit.css') }}">
<!-- FontAwesome CDNはレイアウトで読み込み済なら不要 -->
@endsection

@section('body-class', 'app-body')

@section('header')
<div class="main-header">
    <div class="header-title">
        <span class="pigly-logo">PiGLy</span>
    </div>
    <div class="header-right">
        <a href="{{ route('weight_target.edit') }}" class="header-btn target-btn">
            <i class="fas fa-cog"></i> 目標体重設定
        </a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-door-open"></i> ログアウト
            </button>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="edit-weightlog-container">
    <h2 class="edit-title">Weight Log</h2>

    {{-- 編集フォーム --}}
    <form action="{{ route('weight_logs.update', $weightLog->id) }}" method="POST" class="edit-form" autocomplete="off">
        @csrf
        @method('PUT')

        {{-- 日付 --}}
        <div class="form-group">
            <label for="date">日付</label>
            <input type="date" id="date" name="date" value="{{ old('date', $weightLog->date) }}">
            @error('date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- 体重 --}}
        <div class="form-group">
            <label for="weight">体重</label>
            <div class="input-unit-row">
                <input type="text" id="weight" name="weight" value="{{ old('weight', $weightLog->weight) }}">
                <span class="input-unit">kg</span>
            </div>
            @error('weight')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- 摂取カロリー --}}
        <div class="form-group">
            <label for="meal_calories">摂取カロリー</label>
            <div class="input-unit-row">
                <input type="text" id="meal_calories" name="meal_calories" value="{{ old('meal_calories', $weightLog->meal_calories) }}">
                <span class="input-unit">cal</span>
            </div>
            @error('meal_calories')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- 運動時間 --}}
        <div class="form-group">
            <label for="exercise_time">運動時間</label>
            <input type="time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time ?? '00:00') }}">
            @error('exercise_time')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- 運動内容 --}}
        <div class="form-group">
            <label for="exercise_content">運動内容</label>
            <textarea id="exercise_content" name="exercise_content" rows="2" placeholder="運動内容を追加">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
            @error('exercise_content')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- ボタン群 --}}
        <div class="modal-buttons">
            <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-register">更新</button>
        </div>
    </form>

    {{-- 削除フォーム --}}
    <form action="{{ route('weight_logs.destroy', $weightLog->id) }}" method="POST" class="edit-delete-form" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">
            <i class="fas fa-trash trash-icon"></i>
        </button>
    </form>
</div>
@endsection
