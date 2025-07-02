@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add New Vendor</h4>
                    {{-- <p class="card-title-desc">
                        Parsley is a javascript form validation
                        library. It helps you provide your users with feedback on their form
                        submission before sending it to your server.
                    </p> --}}
                    <form action="{{route('vendor-store')}}" method="POST" class="g-3 needs-validation" novalidate>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Fullname" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="Fullname" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="organization" class="form-label">Business Name</label>
                                <input type="text" name="organization" class="form-control" id="organization" aria-describedby="organization" required>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col">
                                <label for="phone_number" class="form-label">Phone No</label>
                                <input type="number" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number" required>
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
                        <!-- end col -->
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col d-flex align-items-center">
                                <input name="is_active" class="form-check-input mt-0" type="checkbox" id="Publish" checked>
                                <label class="form-check-label mb-0 ms-1" for="Publish">
                                    Active
                                </label>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Vendors</h4>
                    <p class="card-title-desc">
                        List of all Vendors.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor</th>
                                    <th>Business</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $key => $vendor)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img class="rounded-circle avatar-sm" src="{{asset('images/user')}}/{{$vendor->details->image}}" alt="{{$vendor->name}}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">{{$vendor->name}}</h4>
                                                    <small class="text-muted">
                                                        <i class="fas fa-envelope me-1"></i> {{$vendor->email}}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">
                                                        <i class="far fa-building me-1"></i> {{$vendor->details->organization}}
                                                    </h4>
                                                    <small class="text-muted">
                                                        <i class="fas fa-phone-alt me-1"></i> {{$vendor->details->phone_number}}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle pb-0">
                                            @if (auth()->user()->id != $vendor->id)
                                                <input class="form-check form-switch" type="checkbox" data-te-status="{{$vendor->id}}" id="switch{{$key}}" switch="bool" {{($vendor->is_active) ? 'checked':''}}>
                                                <label class="form-label mb-0" for="switch{{$key}}" data-on-label="" data-off-label=""></label>
                                            @endif
                                        </td>

                                        <td class="text-end align-middle">
                                            @if (auth()->user()->id == $vendor->id)
                                                <a href="{{route('account')}}" class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="My Account">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update-vendor" data-te-edit="{{$key}}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-{{ ($vendor->is_ban) ? 'danger':'secondary' }} btn-sm edit" data-tooltip="tooltip" title="{{ ($vendor->is_ban) ? 'Unban':'Ban' }}" data-te-ban="{{$vendor->id}}">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                                <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-delete="{{$vendor->id}}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
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
    {{--  --}}    
    <div class="modal fade" id="update-vendor" role="dialog" aria-labelledby="update-vendorTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-vendorTitle">Email Virtual Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('vendor-update')}}" method="post" class="g-3">
                    <div class="modal-body">

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Fullname" class="form-label">Name</label>
                                <input type="text" name="update_name" class="form-control" id="edit-Fullname" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="organization" class="form-label">Business Name</label>
                                <input type="text" name="update_organization" class="form-control" id="edit-organization" aria-describedby="organization" required>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col">
                                <label for="phone_number" class="form-label">Phone No</label>
                                <input type="number" name="update_phone_number" class="form-control" id="edit-phone_number" aria-describedby="phone_number" required>
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
                                <label for="edit-password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="text" name="update_password" class="form-control" id="edit-password" aria-describedby="Password">
                                    <button type="button" class="btn btn-warning" data-te="genpassword">
                                        <span class="mdi mdi-reload fa-lg"></span>
                                    </button>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <small class="text-muted">
                                    <em>Leave blank if password don't want to change.</em>
                                </small>
                            </div>
                        </div>
                        <!-- end col -->

                    </div>
                    <input type="hidden" name="id">
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var datalist = {!! $vendors !!};
        var is_activeUrl = '{!! route("user_status") !!}';
        var is_banUrl = '{!! route("user_ban") !!}';
        var is_deleteUrl = '{!! route("vendor-delete") !!}';
    </script>
    <script src="{{asset('app/js/vendor/vendor.js')}}"></script>
@endpush