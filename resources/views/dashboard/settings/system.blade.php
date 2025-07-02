@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#branding" role="tab" aria-selected="false" tabindex="-1">
                        <span class="d-none d-md-block">Brand</span>
                        <span class="d-block d-md-none">
                            <i class="mdi mdi-copyright h5"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#email-setup" role="tab" aria-selected="false" tabindex="-1">
                        <span class="d-none d-md-block">Email</span>
                        <span class="d-block d-md-none">
                            <i class="mdi mdi-email-outline h5"></i>
                        </span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane p-3 active show" id="branding" role="tabpanel">
                    @include('dashboard.settings.templates.system.brand')
                </div>
                <div class="tab-pane p-3" id="email-setup" role="tabpanel">
                    @include('dashboard.settings.templates.system.email')
                </div>
            </div>
        
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('app/js/settings/system.js')}}"></script>
@endpush