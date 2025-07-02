@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add User</h4>
                    {{-- <p class="card-title-desc">
                        Parsley is a javascript form validation
                        library. It helps you provide your users with feedback on their form
                        submission before sending it to your server.
                    </p> --}}
                    <form action="{{route('create-user')}}" method="POST" class="g-3 needs-validation" novalidate>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Fullname" class="form-label">Fullname</label>
                                <input type="text" name="name" class="form-control" id="Fullname" value="{{old('name')}}" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="Email" value="{{old('email')}}" required>
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
                        <div class="row mb-3 flex-nowrap">
                            <div class="col">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select" id="role" required>
                                    <option selected disabled value="">--Select--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <select name="is_active" class="form-select" id="status" required>
                                    <option value="0">Deactivate</option>
                                    <option value="1" selected>Activate</option>
                                </select>
                                <span class="invalid-feedback"></span>
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
                    <h4 class="card-title">Users</h4>
                    <p class="card-title-desc">
                        You can management users here.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <img class="rounded-circle avatar-sm" src="{{asset('images/user')}}/{{$user->details->image}}" alt="{{$user->name}}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">{{$user->name}}</h4>
                                                    <span class="badge rounded-pill bg-{{ $rolesbg[$user->role->id] }}">{{$user->role->name}}</span> - <small class="text-muted">{{$user->email}}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle pb-0">
                                            @if (auth()->user()->id != $user->id)
                                                <input class="form-check form-switch" type="checkbox" data-te-status="{{$user->id}}" id="switch{{$key}}" switch="bool" {{($user->is_active) ? 'checked':''}}>
                                                <label class="form-label mb-0" for="switch{{$key}}" data-on-label="" data-off-label=""></label>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            @if (auth()->user()->id == $user->id)
                                                <a href="{{route('account')}}" class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="My Account">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update-user" data-te-edit="{{$key}}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-{{ ($user->is_ban) ? 'danger':'secondary' }} btn-sm edit" data-tooltip="tooltip" title="{{ ($user->is_ban) ? 'Unban':'Ban' }}" data-te-ban="{{$user->id}}">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                                <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-delete="{{$user->id}}">
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

    <div class="modal fade" id="update-user" role="dialog" aria-labelledby="update-userTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-userTitle">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('user_update')}}" method="post" class="g-3">
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
                                <label for="edit-email">Email</label>
                                <input type="email" name="update_email" id="edit-email" class="form-control" placeholder="Email">
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

                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit-role" class="form-label">Role</label>
                                <select name="update_role" class="form-select" id="edit-role" required style="width: 100%">
                                    <option selected disabled value="">--Select--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
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
    </div>
@endsection
@push('scripts')
    <script>
        var datalist = {!! $users !!};
        var is_activeUrl = '{!! route("user_status") !!}';
        var is_banUrl = '{!! route("user_ban") !!}';
        var is_deleteUrl = '{!! route("user_delete") !!}';
        
        $(function () {
            $.each(datalist, function (ind, val) { 
                datalist[ind].role = val.role.id;
            });
        });
    </script>
    <script src="{{asset('app/js/users/index.js')}}"></script>
@endpush