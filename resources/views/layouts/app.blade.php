<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ route('/') }}">


    <title>{{ config('app.name', 'RPS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="wrapper" v-cloak>
        @include("layouts.navigation")
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">{{ isset($title) ? $title : 'Dashboard/BC' }}</h3>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>


        {{--swal messages / responses --}}
        @if(session()->has("swal_message"))
            <input hidden id="swal-type" value="{{ session("swal_message")["type"] }}">
            <input hidden id="swal-message" value="{{ session("swal_message")["message"] }}">
        @endif

        {{-- toast message --}}
        @if(session()->has("toast_message"))
            <input hidden id="toast-type" value="{{ session("toast_message")["type"] }}">
            <input hidden id="toast-message" value="{{ session("toast_message")["message"] }}">
        @endif

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
