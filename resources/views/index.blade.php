<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/loader.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/employee.css')}}">
    @stack('styles')
    @stack('scripts')

    
</head>
<body>
         <!--sidebar-->
         @include('Public_Components.sidebar')
        <!--end-->
       <!--header bar -->
       @include('Public_Components.header')
        <!--end-->
        <div class="content-body-wrapper jsContentBody">
        
        </div>
    @livewireStyles
    @livewireScripts
    <script src="{{ asset('js/globalfunc.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>



    
</body>
</html>

