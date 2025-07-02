@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col-xl-3">
            <div class="user-sidebar">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-n4 position-relative">
                            <div class="text-center">
                                <img src="{{asset('images/user')}}/{{$myaccount->details->image}}" alt="User Image" class="avatar-xl rounded-circle img-thumbnail">
                                
                                <div class="mt-3">
                                    <h5 class="">{{$myaccount->name}}</h5>
                                    <div>
                                        <a href="#" class="text-muted m-1">{{$myaccount->role->name}}</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="p-0 mt-0">
                            <div class="row text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex justify-content-between p-2 font-size-15">
                                        <span class="text-muted">Since</span>
                                        <span>{{ \Carbon\Carbon::parse($myaccount->created_at)->format('Y, F j') }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between p-2 font-size-15">
                                        <span class="text-muted">Last Update</span>
                                        <span>{{ \Carbon\Carbon::parse(($myaccount->details->updated_at) ? $myaccount->details->updated_at:auth()->user()->updated_at)->format('Y, F j') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>                        
                        <div class="mt-n4 position-relative">
                            <div class="text-center">
                                <div class="mt-3">
                                    <div class="mt-4">
                                        <form action="{{route('account-upload')}}" method="post" enctype="multipart/form-data">
                                            <div class="mb-0">
                                                <input type="file" name="p_picture" class="filestyle" data-input="false" data-buttonname="btn-secondary" id="filestyle-1" accept=".png, .jpg, .jpeg, .svg" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                                <div class="bootstrap-filestyle input-group justify-content-center">
                                                    <span class="group-span-filestyle " tabindex="0">
                                                        <label for="filestyle-1" style="margin-bottom: 0;">
                                                            <span class="btn btn-primary waves-effect waves-light btn-sm">
                                                                Upload Profile Picture
                                                            </span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                    
                </div>
            </div>
        </div>
        <!--  -->
        <div class="col-xl-9">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#p_details" role="tab" aria-selected="true">
                            <span class="d-none d-md-block">Details</span>
                            <span class="d-block d-md-none">
                                <i class="mdi mdi-home-variant h5"></i>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#p_Security" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span class="d-none d-md-block">Security</span>
                            <span class="d-block d-md-none">
                                <i class="mdi mdi-account h5"></i>
                            </span>
                        </a>
                    </li>
                </ul>
        
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Tab Details -->
                    <div class="tab-pane p-3 active show" id="p_details" role="tabpanel">
                        <form method="POST" action="{{route('account-update')}}" class="needs-validation" novalidate="">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="{{$myaccount->name}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$myaccount->email}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-control select2">
                                        <option value="" selected disabled>Select</option>
                                        <option value="m">Male</option>
                                        <option value="f">Female</option>
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="Organization" class="form-label">Organization</label>
                                    <input type="text" class="form-control" id="Organization" name="organization" placeholder="Organization" value="{{$myaccount->details->organization}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="phone_number" class="form-label">Phone number</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="{{$myaccount->details->phone_number}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-7">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$myaccount->details->address}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col-md-5">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$myaccount->details->city}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{$myaccount->details->state}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="number" class="form-control" id="zip" name="zip" placeholder="Zip" value="{{$myaccount->details->zip}}" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="country" class="form-label">Country</label>
                                    <select id="country" name="country" class="form-control select2">
                                        <option value="" selected disabled>Select</option>
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-3">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tab Security -->
                    <div class="tab-pane p-3" id="p_Security" role="tabpanel">
                        <form method="POST" action="{{route('account-reset_password')}}" class="needs-validation" novalidate="">
                            <div class="form-group row mb-4">
                                <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="new_password" name="password" placeholder="New Password">
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="cpassword" name="password_confirmation" placeholder="Password Confirmation">
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-danger">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var gender = "{!! $myaccount->details->gender !!}";
        var country = "{!! $myaccount->details->country !!}";
    </script>
<script src="{{ asset('app/js/settings/account.js') }}"></script>
@endpush