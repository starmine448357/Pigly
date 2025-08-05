@extends('layouts.app')

@section('content')
<div class="container">
    <h2>体重記録一覧</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($logs->isEmpty())
        <p>まだ記録がありません。</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重 (kg)</th>
                    <th>運動時間 (分)</th>
                    <th>運動内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->date }}</td>
                        <td>{{ $log->weight }}</td>
                        <td>{{ $log->exercise_time ?? '-' }}</td>
                        <td>{{ $log->exercise_content ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{ route('weight_logs.create') }}">＋ 新しい記録を追加</a>
</div>
@endsection
