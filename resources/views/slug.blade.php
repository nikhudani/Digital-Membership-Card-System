<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ TE::system('title', env('APP_NAME')) }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/brand/favicon.ico')}}">

    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/libs/ion-rangeslider/css/ion.rangeSlider.min.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">
    <!-- Other Css-->
    
    <!-- jquery -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-qrcode/jquery-qrcode.min.js')}}"></script>

    <style>
        .btn-outline-white {
            border: 1px #fff solid;
            color: #fff
        }
        .btn-outline-white:hover {
            background-color: #fff;
            /* color: transparent */
        }
        .vcard-head-color {
            background-color: {{$vcards->plan->plan->color}};
        }
        .vcard-color {
            background-color: {{$vcards->plan->plan->color}}99;
        }
    </style>

</head>
    {{-- @dd($vcards) --}}
    <body>
        <main class="container" style="max-width: 350px;">
            <div class="row justify-content-center">
                <div class="col pt-3" id="vcard-template">
                    @include('dashboard.membership.tamplate.vcard.'.$vcards->plan->theme)
                </div>
            </div>
            {{--  --}}            
            <div class="row justify-content-center mt-1">
                <div class="col">
                    <div class="card rounded mb-0 shadow-sm">
                        <div class="card-body position-relative @if($vcards->plan->theme == 'default') bg-info2 @endif" @if ($vcards->plan->theme == 'modern') style="background-color: {{$vcards->plan->plan->color}}99;" @endif>
                            <img class="shadow-sm rounded rounded-4" src="{{asset('images/cards')}}/{{strtolower($vcards->plan->plan->name)}}.png" alt="{{$vcards->plan->plan->name}}" style="width: -webkit-fill-available; border: {{$vcards->plan->plan->color}} solid 3px;">
                            <div class="position-absolute" style="top: 55%; left: 13%;">
                                <h6 class="text-white mb-1" data-te-vcard-memberid></h6>
                                <div class="d-flex align-items-center">
                                    <small class="me-2 text-white-50" style="font-size: 8px;">VALID<br>THRU</small>
                                    @php
                                        $carbonDate = \Carbon\Carbon::createFromFormat('d M, Y', $vcards->plan->expiring_at);
                                        $formattedDate = $carbonDate->format('m/d');
                                    @endphp
                                    <strong class="text-white" style="font-size: 11px;">{{$formattedDate}}</strong>
                                </div>
                            </div>
                            <div class="col text-center">
                                    <button id="qr-download" class="btn btn-sm btn-outline-dark" data-te-qr-name="{{$vcards->slugurl}}">
                                        <i class="fas fa-check me-1"></i> Accept
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="row justify-content-center mt-1 mb-3">
                <div class="col">
                    <div class="card rounded-bottom-4 mb-0 shadow-sm">
                        <div class="card-body @if($vcards->plan->theme == 'default') bg-info2 @else rounded-bottom-4 @endif" @if ($vcards->plan->theme == 'modern') style="background-color: {{$vcards->plan->plan->color}}99;" @endif>
                            <div id="qrcode" class="d-flex justify-content-center align-items-center mb-3" data-te-qr="code" style="height: 285px;"></div>
                            <div class="row">
                                <div class="col text-center">
                                    <button id="qr-download" class="btn btn-sm btn-outline-dark" data-te-qr-name="{{$vcards->slugurl}}">
                                        <i class="fas fa-download me-1"></i> Download
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            var socials = {!!$vcards->social ?? json_encode([])!!};
                    
            var qrOptions = {
                render: 'canvas',
                minVersion: 1,
                ecLevel: 'H',
                radius: 0.5,
                quiet: 1,
                size: {!!$vcards->plan->qr_size!!},
                text: '{!!route("slug", $vcards->slugurl)!!}',
                // fill: '{!! ($vcards->plan->theme == "modern") ? "#ec4561":"#fff" !!}',
                // fill: '{!! $vcards->plan->plan->color !!}',
                background: null,
            };

            $(function () {
                $('[data-te-vcard-image]').attr('src', "{!!asset('images/user')!!}/{!!$vcards->customer->details->image!!}");
                $('[data-te-vcard-color]').addClass('vcard-color');
                $('[data-te-vcard-customer]').text('{!!$vcards->customer->name!!}');
                $('[data-te-vcard-header]').text('{!!$vcards->plan->member_id!!}');
                $('[data-te-vcard-memberid]').text('{!!$vcards->plan->member_id!!}');
                $('[data-te-vcard-phone]').text('{!!$vcards->customer->details->phone_number!!}');
                $('[data-te-vcard-email]').text('{!!$vcards->customer->email!!}'); 
                $('[data-te-vcard-address]').text('{!!$vcards->customer->details->address!!}'); 
                //$('[data-te-vcard-id]').text('{!!$vcards->customer->details->ic_number!!}');             
                //@if ($vcards->social)
                  //  $('[data-te-vcard-link]').text('{!!$vcards->social->website!!}');
                //@endif
                
            });
        </script>
        <script src="{{asset('app/js/membership/slug.js')}}"></script>
        <script>            
            var txtColor = textcolor('{!!$vcards->plan->plan->color!!}');
            $(function () {
                $('.text-color').css('color', txtColor);
            });
        </script>
    </body>
</html>