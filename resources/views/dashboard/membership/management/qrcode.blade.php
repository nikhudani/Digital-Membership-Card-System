@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Style QR Code</h4>
                    <p class="card-title-desc">
                        Style qr code for based on plan.
                    </p>

                    <div id="qr-code" class="d-flex justify-content-center align-items-center mt-3 mb-3 w-100"></div>

                </div>
            </div>
        </div>
        <!--  -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Plans</h4>
                    <p class="card-title-desc">
                        List of all plans.
                    </p>
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        @foreach ($plans as $key => $plan)
                            <li class="nav-item">
                                <a class="nav-link @if ($key == 0) active @endif" data-bs-toggle="tab" href="#{{$plan->name}}-{{$plan->id}}" role="tab">
                                    <span class="d-none d-md-block">
                                        {{ucfirst($plan->name)}}
                                    </span>
                                    <span class="d-block d-md-none">
                                        <i class="mdi mdi-home-variant h5"></i>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($plans as $key => $plan)
                            <div class="tab-pane @if ($key == 0) active @endif p-3" id="{{$plan->name}}-{{$plan->id}}" role="tabpanel">
                                <p class="mb-0">
                                    <form action="#" method="post">
    
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label for="render" class="form-label">Render Mode</label>
                                                <select name="render" class="form-select" id="render" style="width: 100%;" required>
                                                    <option value="canvas" selected>canvas</option>
                                                    <option value="image">image</option>
                                                    <option value="div">div</option>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="eclevel" class="form-label">Error Correction Level</label>
                                                <select name="eclevel" class="form-select" id="eclevel" style="width: 100%;" required>
                                                    <option value="L">L - Low (7%)</option>
                                                    <option value="M">M - Medium (15%)</option>
                                                    <option value="Q">Q - Quartile (25%)</option>
                                                    <option value="H" selected>H - High (30%)</option>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="fill" class="form-label">Fill</label>
                                                <input type="color" class="form-control form-control-color w-100" id="fill" value="#02a499" title="Choose your color">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="Background" class="form-label">Background</label>
                                                <input type="color" class="form-control form-control-color w-100" id="Background" value="#02a499" title="Choose your color">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-md-6 ps-3">
                                                <input type="text" class="qr_box">
                                            </div>
                            
                                            <div class="col-md-6">
                                                <input type="text" class="min_version">
                                            </div>
                                        </div>
                            
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-md-6 ps-3">
                                                <input type="text" class="quiet_zone">
                                            </div>
                            
                                            <div class="col-md-6">
                                                <input type="text" class="qr_border">
                                            </div>
                                        </div>
                            
                                        <div class="row justify-content-center mb-3">
                                            <div class="col">
                                                <label for="Background" class="form-label">QR Content</label>
                                                <textarea name="content" id="content" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        

                                    </form>
                                </p>
                            </div>
                        @endforeach
                    </div>
            
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="update-plan" role="dialog" aria-labelledby="update-userTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-userTitle">Update Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('update-plan')}}" method="post" class="g-3">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit-full-name">Name</label>
                                <input type="text" name="update_name" id="edit-full-name" class="form-control" placeholder="Full Name">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit-email">Price</label>
                                <input type="number" name="update_price" id="edit-email" class="form-control" placeholder="Email">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col">
                                <label for="edit-status" class="form-label">Status</label>
                                <select name="update_is_active" class="form-select" id="edit-status" required style="width: 100%">
                                    <option value="0">Deactivate</option>
                                    <option value="1" selected>Activate</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="id">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
    <script>
        var is_activeUrl = '{!! route("status-plan") !!}';
        var is_deleteUrl = '{!! route("delete-plan") !!}';
    </script>
    <script src="{{asset('app/js/membership/management/qrcode.js')}}"></script>
@endpush