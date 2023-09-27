<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- NAV -->
    <x-app-layout>
    <div class="form-container">
        @yield('content')
    </div>
    </x-app-layout>
    <!-- END NAV -->
    <!-- PAGE -->
    <!-- END PAGE -->
</body>
</html>