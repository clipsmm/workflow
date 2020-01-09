<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page_title ?? "Control Panel" }}</title>
    <!-- Favicon -->
    <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Main CSS -->
    <link type="text/css" href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body class="{{ $class ?? '' }}">
<div class="main-content" id="app">
    {{--    @include('admin.partials.navbar')--}}
    @yield('header')
    <div class="container mt-5">
        @yield('content')
    </div>
</div>


<!-- Argon JS -->
<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')


</body>
</html>
