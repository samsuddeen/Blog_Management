<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/ticker-style.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/slicknav.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">





        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
