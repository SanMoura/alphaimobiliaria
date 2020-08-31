<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
       
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        
        
        <link rel="stylesheet" href="{{ asset('site')}}/assets/css/main.css">
        
    </head>
    <body class="is-preload">
        
        
            @yield('content')
        

        @guest()
            @include('layouts.footers.guest')
        @endguest
        <script src="{{ asset('site') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('site') }}/assets/js/browser.min.js"></script>
        <script src="{{ asset('site') }}/assets/js/breakpoints.min.js"></script>
        <script src="{{ asset('site') }}/assets/js/util.js"></script>
        <script src="{{ asset('site') }}/assets/js/main.js"></script>
        
        @stack('js')
        
        
   
 
    </body>
</html>