<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- <meta charset="utf-8"> --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('development/image/logo.png') }}">

        <title>@yield('title', 'TransForKr4b')</title>


        @stack('pre-css')

        @vite(['resources/css/app.css','resources/js/app.js'])

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @stack('post-css')

    </head>


    <body class=" bg-gray-800 dark">
        @include('web.frontend.layout.navbar')

        @yield('content')

        @include('web.frontend.layout.footer')
        @stack('pre-js')
        <script src="/helper.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> --}}
        @stack('post-js')
      </body>
</html>
