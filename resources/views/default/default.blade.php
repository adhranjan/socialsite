<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <script>window.Laravel = "{{ csrf_token() }}"</script>
    <title> Profile </title>
    <!-- Bootstrap -->
    <link href="{{ asset('public/assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('public/assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('public/assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('public/assets/build/css/custom.min.css') }} " rel="stylesheet">
    <!-- My Custom Style -->
    <link href="{{ asset('public/assets/customstyle.css') }} " rel="stylesheet">
    @yield('header')

</head>

<body class="nav-sm">
<div class="container body" id="app">
    <div class="main_container">
        @include('default.header')
        <init></init>
        <!-- page content -->
        <div class="right_col" role="main">
            @yield('body_content')
        </div>
        {{--@include('admin.includes.footer')--}}
    </div>
</div>
<!-- vue app.js-->
<script src="{{ asset('public/js/app.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('public/assets/vendors/iCheck/icheck.min.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('public/assets/build/js/custom.min.js') }}"></script>
@yield('footer')
<audio id="noty_audio">
    <source src="{{ asset('public/assets/notification.mp3') }}" >
</audio>
</body>
