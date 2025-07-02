@extends('layouts.dashboard.main')
@section('main')
    <div class="row @can('roleHas', ['customer', 'vendor']) justify-content-center @endcan">
        
        @foreach ($boxs as $box)
            @can('roleHas', $box['role'])
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-{{ $box['color'] }} text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-start mini-stat-img me-4">
                                    <i class="{{ $box['icon'] }}"></i>
                                </div>
                                <h5 class="font-size-16 text-uppercase text-white-50">{{ $box['name'] }}</h5>
                                <h4 class="fw-medium font-size-24">{{ $box['total'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        @endforeach

    </div>

    <hr>

    <div class="row @can('roleHas', ['customer', 'vendor']) justify-content-center @endcan">
        @can('roleHas', ['customer'])
            @foreach ($plans as $plan)                    

                <!--<div class="col-md-6 col-lg-6 col-xl-3">
            
                    <div class="card rounded-4 p-2 shadow-sm">
                        <div class="position-relative">
                            <img class="card-img-top img-fluid rounded-4 shadow-sm" src="{{asset("images/cards/$plan->name.png")}}" alt="{{$plan->name}}">
                            <div class="position-absolute" style="top: 70%; left: 5%;">
                                <h6 class="text-white mb-1">{{$member->member_id}}</h6>
                                <div class="d-flex align-items-center">
                                    <small class="me-2 text-white-50" style="font-size: 8px;">VALID<br>THRU</small>
                                    <strong class="text-white" style="font-size: 11px;">
                                        @php
                                            $date = \Carbon\Carbon::createFromFormat('d M, Y', $member->expiring_at);
                                            echo $date->format('m/y');
                                        @endphp
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ucfirst($plan->name)}}
                            </h4>
                            <p class="card-text">
                                RM{{$plan->price}}
                            </p>
                            @if ($plan->id !== $member->plan_id)
                                <form action="{{route('plan-card')}}" method="post" class="m-0">
                                    <input type="hidden" name="id" value="{{$member->customer_id}}">
                                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Upgrade</button>
                                </form>
                            @else
                                <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-vcard">Add vCard</button>
                            @endif
                        </div>
                    </div> 

                </div>-->

            @endforeach
        @endcan
        @can('roleHas', ['admin', 'user'])
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Customer Membership Plan</h4>
                        <canvas id="pie" height="200"></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
        @endcan
        @can('roleHas', ['admin', 'user', 'vendor'])
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">@can('roleHas', ['vendor']) Customer Purchased Category @else Vendor Categories @endcan</h4>
                        <canvas id="cate" height="200"></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">@can('roleHas', ['vendor']) Customer Purchased Wedding Type @else Type of Vendor Wedding @endcan</h4>
                        <canvas id="type" height="200"></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
        @endcan
        @can('roleHas', ['admin', 'user'])
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Customer Activation</h4>
                        <canvas id="customers" height="200"></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
        @endcan
    </div>

    @can('roleHas', ['customer'])
        {{-- @include('dashboard.membership.tamplate.main') --}}
        <div class="modal fade" id="add-vcard" role="dialog" aria-labelledby="add-userTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-userTitle">Add vCard</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('create-card')}}" method="POST" class="g-3 needs-validation" novalidate>
                        <div class="modal-body">
                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <label for="Slugurl" class="form-label">Slug URL</label>
                                    <input type="text" name="slugurl" class="form-control" id="Slugurl" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="Cardname" class="form-label">Card Name</label>
                                    <input type="text" name="name" class="form-control" id="Cardname" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="hidden" name="is_active" value="1">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Create vCard</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@can('roleHas', ['customer'])
    @push('scripts')
        <script>
            var datalist = [];
        </script>
    @endpush
@endcan
@push('scripts')
    <script src="{{asset('app/js/membership/dashboard.js')}}"></script>    
@endpush
@can('roleHas', ['vendor'])
    @push('scripts')
        <script src="{{asset('assets/libs/chart.js/Chart.bundle.min.js')}}"></script>
        <script>
            var categories = {!! $categories !!};
            var types = {!! $types !!};
        </script>
        <script src="{{asset('app/js/charts/vendor.js')}}"></script>
    @endpush
@endcan
@can('roleHas', ['admin', 'user'])
    @push('scripts')
        <script src="{{asset('assets/libs/chart.js/Chart.bundle.min.js')}}"></script>
        <script>
            var xValues = {!! $plans['plans'] !!};
            var yValues = {!! $plans['total'] !!};
            var barColors = {!! $plans['colors'] !!};
            var categories = {!! $categories !!};
            var types = {!! $types !!};
            var customers = {!! $customers !!};
        </script>
        <script src="{{asset('app/js/charts/admin.js')}}"></script>
    @endpush
@endcan
