<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{asset('assets/img/icon.png')}}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        @include('layouts.admin.main-css')
        <!-- Scripts -->
    </head>
    <body>
<div class='dashboard'>
    <div class="dashboard-nav">
            @include('layouts.admin.navigation')
    </div>

            <header class='dashboard-toolbar'> <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a></header>
            <div class='dashboard-app'>
                <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a></header>
                <div class='dashboard-content'>
                    <div class='container'>
                        @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                            @yield('content')

                    </div>
                </div>
            </div>

</div>



        @include('layouts.admin.main-js')
    </body>
</html>
