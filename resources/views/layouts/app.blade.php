<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Domain -->
    <title>{{ config('app.name') }} | Easy Ecommerce</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

    <div id="app">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/assets/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    <span style="letter-spacing: 2px; font-size: 1.4rem" class="ml-2">Trendy</span>
                </a>
                @yield('navbar')
            </div>
        </nav>

        <!-- Content -->
        <main class="container mt-4" style="min-height: 80vh">
            @yield('content');
        </main>

        <!-- Footer -->
        <footer class="bg-light">
            <div class="d-flex w-100 justify-content-between px-4">
                <div class="py-3">© 2020 Copyright:
                    <a href="https://trendy.paski.in/"> Trendy Shop</a>
                </div>
                <div class="py-3">
                    <a href="https://paski.in"> Paski.in </a>
                    Ecommerce product
                </div>
            </div>
        </footer>

    </div>

    <!-- fallback -->
    <noscript>You need to enable JavaScript to run this app.</noscript>

</body>
</html>
