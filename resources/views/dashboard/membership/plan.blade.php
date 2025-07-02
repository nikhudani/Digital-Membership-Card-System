@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Plan</h4>
                    {{-- <p class="card-title-desc">
                        Parsley is a javascript form validation
                        library. It helps you provide your users with feedback on their form
                        submission before sending it to your server. 
                    </p> --}}
                    <form action="{{route('create-plan')}}" method="POST" class="g-3 needs-validation" novalidate enctype="multipart/form-data">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Fullname" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="Fullname" value="{{old('name')}}" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="plan-image" class="form-label">Image</label>
                                <input type="file" id="plan-image" name="image" class="filestyle" data-buttonname="btn-secondary" accept=".png">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="theme-color" class="form-label">Theme Color</label>
                                <input type="text" name="color" class="form-control" id="theme-color" value="#626ed4">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3 flex-nowrap">
                            <div class="col">
                                <label for="Email" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="Email" value="{{old('price')}}" required>
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
                    <h4 class="card-title">Plans</h4>
                    <p class="card-title-desc">
                        List of all plans.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plan</th>
                                    <th>Theme Color</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $key => $plan)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td class="align-middle">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                <img src="{{asset("images/cards/$plan->name.png")}}" alt="{{$plan->name}}" width="64">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">{{$plan->name}}</h4>
                                                    <small><strong>RM </strong> {{$plan->price}}</small>                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge rounded-circle p-3" style="background-color: {{$plan->color}};">
                                                    <span class="visually-hidden">color</span>
                                                </span>
                                                <h6 class="mb-0">{{$plan->color}}</h6>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle pb-0">
                                            <input class="form-check form-switch" type="checkbox" data-te-status="{{$plan->id}}" id="switch{{$key}}" switch="bool" {{($plan->is_active) ? 'checked':''}}>
                                            <label class="form-label mb-0" for="switch{{$key}}" data-on-label="" data-off-label=""></label>
                                        </td>

                                        <td class="text-end align-middle">
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update-plan" data-te-edit="{{$key}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-delete="{{$plan->id}}">
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

    <div class="modal fade" id="update-plan" role="dialog" aria-labelledby="update-userTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-userTitle">Update Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('update-plan')}}" method="post" class="g-3" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="row justify-content-center mb-3">
                            <div class="col">
                                <img class="rounded-4" style="width: -webkit-fill-available">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit-full-name">Name</label>
                                <input type="text" name="update_name" id="edit-full-name" class="form-control" placeholder="Full Name">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="edit-plan-image" class="form-label">Image</label>
                                <input type="file" id="edit-plan-image" name="update_image" class="filestyle" data-buttonname="btn-secondary" accept=".png">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="edit-theme-color" class="form-label">Theme Color</label>
                                <input type="text" name="update_color" class="form-control" id="edit-theme-color">
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
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
    <script>
        var datalist = {!! $plans !!};
        var is_activeUrl = '{!! route("status-plan") !!}';
        var is_deleteUrl = '{!! route("delete-plan") !!}';
        var assetUrl = '{!! asset("images/cards") !!}';
    </script>
    <script src="{{asset('app/js/membership/plan.js')}}"></script>
@endpush