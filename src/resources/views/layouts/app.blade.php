<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <a class="header__logo" href="/">FashionablyLate</a>

        <div class="header__nav">
            @yield('header-nav')
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>