<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>体重記録アプリ</title>
    {{-- ↓↓↓ これを削除 --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

    {{-- これだけでOK（ページごとにCSS読み込む） --}}
    @yield('css')
</head>
<body>

    <main>
        @yield('content')
    </main>

</body>
</html>
