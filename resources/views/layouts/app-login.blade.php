<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <link rel="shortcut icon" type="image/x-icon"  href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('assets/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
</head>
<body class="text-blue-primary">
    <div class="w-full h-full">
        <div class="h-full flex flex-col lg:flex-row justify-start">
            <div class="h-auto lg:h-full w-full lg:w-1/2 flex justify-center lg:justify-end items-center bg-blue-primary py-3 lg:py-0 pr-20 lg:pr-40 pl-20 lg:pl-5">
                <a href="{{ route('home') }}" class="block max-w-40 lg:max-w-full">
                    <img src="{{ asset('assets/img/login-logo.svg') }}" alt="JobHunter" />
                </a>
            </div>
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <x-toastr />
</body>
</html>
