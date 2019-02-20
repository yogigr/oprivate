<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body style="{{ Request::segment(1) == '' ? 'padding-top: 75px;' :'padding-top: 100px;' }} padding-bottom: 100px;">
    <div id="app">
        @include('layouts.header')
        @guest
        <div class="container py-3">
            @yield('content')
        </div>
        @else
        <div class="container py-3">
            @if(Request::segment(1) == 'search-teacher' || Request::segment(1) == 'profile')
                @yield('content')
            @else
                <div class="row">
                    <div class="col-sm-3">
                        @include('layouts.sidebar')
                    </div>
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h3 class="card-title">@yield('title')</h3>
                            </div>
                            <div class="card-body">
                                @include('layouts.alert')
                                
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @endguest
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function(){
            setTimeout(function(){
                $('.alert-success').fadeOut();
            }, 2000);
        });
    </script>
    @stack('scripts')
</body>
</html>
