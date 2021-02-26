<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('core_sb_template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

</head>
<body class="bg-gray-300">
<div id="app" class="flex">
        <div class="main relative w-full  bg-gray-300">
                <nav class="w-full bg-red-900 h-auto text-center text-white font-bold	">
                    <div class="text-3xl p-2">
                        <i class="fas fa-laugh-wink"></i>WorkForce
                    </div>
                </nav>
                <div class="body w-full py-4">
                    @yield('content')
                </div>
        </div>

    </div>
    <script src="{{ asset('core_sb_template/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
