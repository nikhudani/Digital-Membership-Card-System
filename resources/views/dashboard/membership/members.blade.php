@extends('layouts.dashboard.main')
@push('styles')
    <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">    
@endpush
@section('main')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Customer</h4>
                    {{-- <p class="card-title-desc">
                        Parsley is a javascript form validation
                        library. It helps you provide your users with feedback on their form
                        submission before sending it to your server.
                    </p> --}}
                    <form action="{{route('create-customer')}}" method="POST" class="g-3 needs-validation" novalidate>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Fullname" class="form-label">Full name</label>
                                <input type="text" name="name" class="form-control" id="Fullname" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="Email" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Password" class="form-label">Password</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="password" class="form-control" id="Password" aria-describedby="Password" required>
                                    <button type="button" class="btn btn-warning" data-te="genpassword">
                                        <span class="mdi mdi-reload fa-lg"></span>
                                    </button>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-md-6 mb-3">
                                <label for="role" class="form-label">Plan</label>
                                <select name="plan" class="form-select" id="role" style="width: 100%;" required>
                                    <option selected disabled value="">--Select--</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col-md-3 col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="is_active" class="form-select" id="status" style="width: 100%;" required>
                                    <option value="0">Deactivate</option>
                                    <option value="1" selected>Activate</option>
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Mobile</label>
                                <input type="text" name="phone_number" class="form-control" id="phone_number" required>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col-md-3 col-md-6 mb-3">
                                <label for="Email" class="form-label">Plan Expiry Date</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="text" name="expiring_at" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-orientation="top" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <span class="invalid-feedback"></span>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col text-end">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
        <!--  -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Customers</h4>
                    <p class="card-title-desc">
                        List of all Customers.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Plan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $key => $member)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img class="rounded-circle avatar-sm" src="{{asset('images/user')}}/{{$member->customer->details->image}}" alt="{{$member->customer->name}}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">{{$member->customer->name}}</h4>
                                                    <small class="text-muted">{{$member->customer->email}}</small>
                                                    <br>
                                                    <small class="text-muted">{{$member->customer->details->phone_number}}</small>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="align-middle pb-0">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">{{$member->plan->name}}</h4>
                                                    <small class="text-muted">{{$member->expiringAt}}</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle pb-0">
                                            <input class="form-check form-switch" type="checkbox" data-te-status="{{$member->customer->id}}" id="switch{{$key}}" switch="bool" {{($member->customer->is_active) ? 'checked':''}}>
                                            <label class="form-label mb-0" for="switch{{$key}}" data-on-label="" data-off-label=""></label>
                                        </td>

                                        <td class="text-end align-middle">                                            
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update-user" data-te-edit="{{$key}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-{{ ($member->customer->is_ban) ? 'danger':'secondary' }} btn-sm edit" data-tooltip="tooltip" title="{{ ($member->customer->is_ban) ? 'Unban':'Ban' }}" data-te-ban="{{$member->customer->id}}">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-delete="{{$member->customer_id}}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update-user" role="dialog" aria-labelledby="update-userTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-userTitle">Update Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('update-customer')}}" method="post" class="g-3">
                    <div class="modal-body">

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Fullname" class="form-label">Full name</label>
                                <input type="text" name="update_name" class="form-control" id="edit-Fullname" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" name="update_email" class="form-control" id="edit-Email" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Password" class="form-label">Password</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="update_password" class="form-control" id="edit-Password" aria-describedby="Password">
                                    <button type="button" class="btn btn-warning" data-te="genpassword">
                                        <span class="mdi mdi-reload fa-lg"></span>
                                    </button>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <small class="text-muted">
                                    <em>Leave blank if password don't want to change.</em>
                                </small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col col-md-6">
                                <label for="role" class="form-label">Plan</label>
                                <select name="update_plan" class="form-select" id="edit-role" style="width: 100%;" required>
                                    <option selected disabled value="">--Select--</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="update_is_active" class="form-select" id="edit-status" style="width: 100%;" required>
                                    <option value="0">Deactivate</option>
                                    <option value="1" selected>Activate</option>
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="phone_number" class="form-label">Mobile</label>
                                <input type="text" name="update_phone_number" class="form-control" id="edit-phone_number" required>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col">
                                <label for="Email" class="form-label">Plan Expiry Date</label>
                                <div class="input-group" id="edit-datepicker1">
                                    <input type="text" name="update_expiring_at" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-orientation="top" data-date-container='#edit-datepicker1' data-provide="datepicker" data-date-autoclose="true">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <span class="invalid-feedback"></span>
                                </div><!-- input-group -->
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
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        var datalist = {!! $members !!};
        var is_activeUrl = '{!! route("user_status") !!}';
        var is_banUrl = '{!! route("user_ban") !!}';
        var is_deleteUrl = '{!! route("delete-customer") !!}';        
    </script>
    <script src="{{asset('app/js/membership/customer.js')}}"></script>
@endpush