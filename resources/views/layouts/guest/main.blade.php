<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/brand/favicon.ico')}}">

    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">

</head>
<body>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card overflow-hidden">
                        
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">{{ config('app.name') }}</h5>
                                <p class="text-white-50">@yield('short-message')</p>
                                <a href="{{request()->root()}}" class="logo logo-admin">
                                    <img src="{{asset('images/brand/favicon.ico')}}" height="64" alt="logo" onerror="this.parentNode.remove()">
                                </a>
                            </div>
                        </div>

                        @yield('content')

                    </div>

                    @yield('content-footer')
                    
                </div>
            </div>

        </div>
    </div>

    @include('layouts.guest.footer')

    @if (session()->has('error'))
        <script>
            $(function () {
                Swal.fire(
                    'Error',
                    "{!! session('error') !!}",
                    'error'
                )
            });
        </script>
    @endif

</body>
</html>