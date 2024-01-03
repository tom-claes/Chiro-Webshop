<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('CSS/styles.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased flex flex-col min-h-screen">
        <div class="flex-grow">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                @if (session('success'))
                    <div class="flash-success">
                        {{session('success')}}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <footer style="background-color: #F9C349; color: #FFF; padding: 20px; width: 100%; text-align: left;">
            <a href="{{route('support.contact')}}" style="margin-right: 20px;">Contact</a>
            <a href="{{route('support.faq.category')}}" style="margin-right: 20px;">FAQ's</a>
            <a href="{{route('support.news')}}">Nieuws</a>
        </footer>
    </body>
</html>
