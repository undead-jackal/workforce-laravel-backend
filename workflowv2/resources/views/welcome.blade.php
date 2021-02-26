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
    <link href="{{ asset('css/my-style.css') }}" rel="stylesheet">
    <link href="{{ asset('core_sb_template/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>
<body class="bg-gradient-primary">
    <div id="app" class="container home-page">
        <div class="row justify-content-center">
            <div class="col-10 main-title">
                <i class="fas fa-laugh-wink"></i>
                    <h1>WorkForce</h1>
            </div>
        </div>
        <div class="row justify-content-center pt-2">
            <div class="col-3 card m-2">
                <div class="card-header">
                    <h4>Freelancer</h4>
                </div>
                <div class="card-body">
                    <a href="registerFreelancer" class="btn btn-success w-100">Register</a>
                    <p class="p-3 w-100 text-center" >
                        <strong>OR</strong>
                    </p>
                    <a href="login" class="btn btn-success w-100">Login</a>
                </div>
            </div>

            <div class="col-3 card m-2">
                <div class="card-header">
                    <h4>Employer</h4>
                </div>
                <div class=" card-body ">
                    <a href="registerEmployer" class="btn btn-success w-100">Register</a>
                    <p class="p-3 w-100 text-center" >
                        <strong>OR</strong>
                    </p>
                    <a href="login" class="btn btn-success w-100">Login</a>
                </div>
            </div>

            <div class="col-3 card m-2">
                <div class="card-header">
                    <h4>Coordinator</h4>
                </div>
                <div class="card-body">
                    <a href="registerCoordinator" class="btn btn-success w-100">Register</a>
                    <p class="p-3 w-100 text-center" >
                        <strong>OR</strong>
                    </p>
                    <a href="login" class="btn btn-success w-100">Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('core_sb_template/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
