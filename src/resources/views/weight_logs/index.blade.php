@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
<link rel="stylesheet" href="{{ asset('css/weightlog-modal.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Inter:wght@400;700&display=swap" rel="stylesheet">
@endsection

@section('header')
<div class="main-header">
    <div class="header-title">
        <span class="pigly-logo">PiGLy</span>
    </div>
    <div class="header-right">
        <a href="{{ route('weight_target.edit') }}" class="header-btn target-btn">目標体重設定</a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">ログアウト</button>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="weight-logs-wrapper">

    <div class="weight-logs-upper-card">
        <div class="summary-cards">
            <div class="summary-item">
                <div class="summary-title">目標体重</div>
                <div class="summary-value">{{ $targetWeight !== null ? number_format($targetWeight, 1) : '--' }}<span class="unit">kg</span></div>
            </div>
            <div class="summary-divider"></div>
            <div class="summary-item">
                <div class="summary-title">目標まで</div>
                <div class="summary-value">{{ isset($diffText) ? $diffText : '--' }}<span class="unit">kg</span></div>
            </div>
            <div class="summary-divider"></div>
            <div class="summary-item">
                <div class="summary-title">最新体重</div>
                <div class="summary-value">{{ $latestWeight !== null ? number_format($latestWeight, 1) : '--' }}<span class="unit">kg</span></div>
            </div>
        </div>
    </div>

    <div class="weight-logs-table-area">
        <div class="weight-logs-search-add-row">
            <form class="weight-logs-search-form" method="GET" action="{{ route('weight_logs.index') }}">
                <input type="date" name="start_date" value="{{ request('start_date') }}">
                <span class="date-separator">〜</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}">
                <button type="submit" class="search-btn">検索</button>
            </form>
            <button type="button" class="add-btn" id="open-add-modal">データ追加</button>
        </div>

        <div class="table-title">体重記録一覧</div>
        @if ($weightLogs->isEmpty())
            <div class="no-data">まだ記録がありません。</div>
        @else
            <table class="weight-logs-table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>体重</th>
                        <th>食事摂取カロリー</th>
                        <th>運動時間</th>
                        <th>編集</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weightLogs as $log)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                        <td>{{ $log->weight }}kg</td>
                        <td>{{ $log->meal_calories ?? '-' }}cal</td>
                        <td>{{ $log->exercise_time ?? '-' }}</td>
                        <td>
                            <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-btn">
                                <span class="edit-icon">✏️</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-area">
                {{ $weightLogs->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>
</div>

<!-- モーダル本体（フォーム） -->
<div class="modal-overlay" style="display: none;">
  <div class="modal-content">
    <h2 class="modal-title">Weight Logを追加</h2>
    <form action="{{ route('weight_logs.store') }}" method="POST" autocomplete="off">
      @csrf

      <div class="form-group">
        <label for="date">日付 <span class="required-box">必須</span></label>
        <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}">
        @error('date')
            <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
        <div class="form-group">
            <label for="weight">体重 <span class="required-box">必須</span></label>
            <div class="input-unit-row">
                <input type="text" step="0.1" name="weight" id="weight" value="{{ old('weight') }}">
                <span class="input-unit">kg</span>
            </div>
            @error('weight')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="meal_calories">摂取カロリー <span class="required-box">必須</span></label>
            <div class="input-unit-row">
                <input type="text" name="meal_calories" id="meal_calories" value="{{ old('meal_calories') }}">
                <span class="input-unit">cal</span>
            </div>
            @error('meal_calories')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
      <div class="form-group">
        <label for="exercise_time">運動時間 <span class="required-box">必須</span></label>
        <input type="text" name="exercise_time" id="exercise_time" value="{{ old('exercise_time') }}">
        @error('exercise_time')
            <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="exercise_content">運動内容 </label>
        <textarea name="exercise_content" id="exercise_content" rows="2" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
        @error('exercise_content')
            <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="modal-buttons">
        <button type="button" class="btn-back">戻る</button>
        <button type="submit" class="btn-register">登録</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  // モーダル表示
  document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('open-add-modal');
    const modal = document.querySelector('.modal-overlay');
    const closeBtn = document.querySelector('.btn-back');

    openBtn.addEventListener('click', function () {
      modal.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function () {
      modal.style.display = 'none';
    });

    // バリデーションエラー時はモーダル自動表示
    @if ($errors->any())
      modal.style.display = 'flex';
    @endif
  });
</script>
@endsection
