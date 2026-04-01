<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta property="og:title" content="Заголовок для ссылки" />
    <meta property="og:description" content="Краткое описание контента по ссылке" />
    <meta property="og:image" content="{{ asset('assets/favicon.ico') }}" />
    <meta name="robots" content="index, follow" />
    <link rel="shortcut icon" type="image/x-icon"  href="{{ asset('favicon.ico') }}" />
    @yield('assets')
    <link href="{{ asset('assets/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <style>
        .favourites-link svg{
            fill: white;
        }

        .favourites-link.active svg {
            fill: #27A746;
        }
    </style>
</head>
<body class="@yield('body_class') text-blue-primary">
<div class="wrapper flex flex-col h-full">
    <x-header/>
    @yield('content')

    <x-city-selector />
    <x-cookie/>
    <x-footer/>
</div>
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
@stack('scripts')
<x-toastr />
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
