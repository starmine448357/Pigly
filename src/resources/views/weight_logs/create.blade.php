@extends('layouts.app')

@section('content')
<div class="container">
    <h2>新しい体重記録</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('weight_logs.store') }}" method="POST">
        @csrf

        <!-- 日付 -->
        <div>
            <label for="date">日付</label><br>
            <input type="date" name="date" id="date" value="{{ old('date') }}">
            @error('date')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- 体重 -->
        <div>
            <label for="weight">体重 (kg)</label><br>
            <input type="number" name="weight" id="weight" step="0.1" value="{{ old('weight') }}">
            @error('weight')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- 運動時間 -->
        <div>
            <label for="exercise_time">運動時間 (分)</label><br>
            <input type="number" name="exercise_time" id="exercise_time" value="{{ old('exercise_time') }}">
            @error('exercise_time')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- 運動内容 -->
        <div>
            <label for="exercise_content">運動内容</label><br>
            <input type="text" name="exercise_content" id="exercise_content" value="{{ old('exercise_content') }}">
            @error('exercise_content')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <button type="submit">記録する</button>
    </form>

    <br>
    <a href="{{ route('weight_logs.index') }}">← 一覧に戻る</a>
</div>
@endsection
