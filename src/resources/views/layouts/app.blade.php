<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>体重記録アプリ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    @yield('css')
</head>
<body class="@yield('body-class')">

    <header>
        @yield('header')
    </header>

    <main>
        @yield('content')
        @yield('scripts')
    </main>

</body>
</html>
