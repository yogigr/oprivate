<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/adminApp.css') }}">
    @stack('styles')
</head>
<body class="hold-transition {{ Auth::check() ? 'skin-blue sidebar-mini' : 'login-page' }} ">
    @if(Auth::check())
        <div class="wrapper" id="app">
            @include('admin.layouts.header')
            @include('admin.layouts.sidebar')
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        @yield('title')
                        <small>@yield('page_description')</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ url('admin') }}">
                                <i class="fa fa-dashboard"></i> 
                                Dashboard
                            </a>
                        </li>
                        @yield('breadcrumb')
                    </ol>
                </section>
                <section class="content container-fluid">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('error') }}
                        </div>
                    @endif
                    @if($errors->all())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @yield('content')

                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    @else
        <div class="login-box">
            @yield('content')
        </div>
    @endif
   
    <script src="{{ asset('js/adminApp.js') }}"></script>
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