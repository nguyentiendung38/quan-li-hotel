<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Trang chủ')</title>
    <link rel="stylesheet" href="{{ asset('page/css/app.css') }}">
    @yield('style')
</head>
<body>
    <header>
        <!-- ...existing header code... -->
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <!-- ...existing footer code... -->
    </footer>
    <script src="{{ asset('page/js/app.js') }}"></script>
    @yield('script')
</body>
</html>
