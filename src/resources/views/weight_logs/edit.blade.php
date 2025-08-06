@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_target_edit.css') }}">
@endsection

@section('content')
<div class="weight-target-edit-wrapper">
    <h2>目標体重設定</h2>

    <form action="{{ route('weight_target.update') }}" method="POST" class="weight-target-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input
                type="text"
                name="target_weight"
                value="{{ old('target_weight', $targetWeight ?? '') }}"
                placeholder="例）60.0"
                autofocus
            >
            <span>kg</span>
            @error('target_weight')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-btn-group">
            <a href="{{ route('weight_logs.index') }}" class="btn btn-back">戻る</a>
            <button type="submit" class="btn btn-submit">更新</button>
        </div>
    </form>
</div>
@endsection
