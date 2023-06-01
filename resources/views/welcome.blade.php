<!--extend layout master.blade.php -->
@extends('layouts.master')
<title>Welcome to Mini-Twitter</title>
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- from Master -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        @vite(['resources/css/app.css','resources/sass/app.scss','resources/css/areset.css', 'resources/css/custom.css',  'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/d4cbcb96c8.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/d4cbcb96c8.js" crossorigin="anonymous"></script>
        <title>Laravel</title>
    </head> --}}
<body class="antialiased">
<main>
    <div class="container">
        <div class="row text-center my-3">
                <div class="col-sm-12 mb-3 bg-info">   
                        <h1><i class="fa-brands fa-twitter fa-spin" style="--fa-animation-iteration-count: 1;"></i>
                        <a href="/messages">Mini Twitter Reloaded with LARAVEL Breeze</a></h1>
                        
                </div>
                <div class="col-sm-12 mb-3 bg-info">
                    @if (Route::has('login'))
                        
                            @auth
                                <h3><a href="{{ url('/dashboard') }}">Dashboard</a></h3>
                                @else
                                <h3><a href="{{ route('login') }}">Log in</a></h3>
        
                                @if (Route::has('register'))
                                <h3><a href="{{ route('register') }}">Register</a></h3>
                                @endif
                            @endauth
                    @endif
                </div>
            <div class="col-sm-12 mb-3">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</div>
        </div>
    </div>
</main>
    
</body>
</html>
