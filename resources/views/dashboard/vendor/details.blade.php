@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Vendor Details</h4>
                    {{-- <p class="card-title-desc">
                        Parsley is a javascript form validation
                        library. It helps you provide your users with feedback on their form
                        submission before sending it to your server.
                    </p> --}}
                    <form action="{{route('vendor-details-store')}}" method="POST" class="g-3">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Vendor" class="form-label">Vendor</label>
                                <select name="vendor_id" class="form-select" id="Vendor" required>
                                    <option selected disabled value="">--Select--</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Type" class="form-label">Type</label>
                                <select id="Type" name="types[]" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." required>
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Category" class="form-label">Category</label>
                                <select id="Category" name="categories[]" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Location" class="form-label">Location</label>
                                <select id="Location" name="locations[]" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." required>
                                    @foreach ($locations as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="row d-flex justify-content-between align-items-center">
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
                    <h4 class="card-title">Vendor Details</h4>
                    <p class="card-title-desc">
                        List of all Vendor Details.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $key => $detail)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img class="rounded-circle avatar-sm" src="{{asset('images/user')}}/{{$detail->vendor->details->image}}" alt="{{$detail->vendor->name}}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">
                                                        {{$detail->vendor->name}}
                                                    </h4>
                                                    <small class="text-muted">
                                                        <i class="fas fa-building me-1"></i> {{$detail->vendor->details->organization}}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            @foreach ($detail->types as $type)                                                
                                                <span class="badge rounded-pill bg-primary">{{$type['name']}}</span> <br>
                                            @endforeach
                                        </td>
                                        <td class="align-middle">
                                            @foreach ($detail->categories as $category)
                                                <span class="badge rounded-pill bg-primary">{{$category['name']}}</span> <br>
                                            @endforeach
                                        </td>
                                        <td class="align-middle">
                                            @foreach ($detail->locations as $location)
                                                <span class="badge rounded-pill bg-primary">{{$location['name']}}</span> <br>
                                            @endforeach
                                        </td>

                                        <td class="text-end align-middle">
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#details-vendor" data-te-edit="{{$key}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-delete="{{$detail->vendor->id}}">
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
    {{--  --}}
    <div class="modal fade" id="details-vendor" role="dialog" aria-labelledby="details-vendorTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="details-vendorTitle">Email Virtual Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('vendor-details-update')}}" method="post" class="g-3">
                    <div class="modal-body">

                        <div class="row mt-3 align-items-center justify-content-between">
                            <div class="col-sm-4">
                                <div class="card mb-0" style="height: 100%;">
                                    <div class="card-body">
                                        <div class="mt-n4 position-relative">
                                            <div class="text-center" id="vendor">
                                                <img class="avatar-xl rounded-circle shadow-sm">
        
                                                <div class="mt-3">
                                                    <h4 class=""></h4>
                                                    <div>
                                                        <i class="fas fa-building"></i> <span class="text-muted m-1" id="organization"></span>
                                                    </div>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col">
                                <div class="card mb-0 border" style="height: 100%;">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="edit-Type" class="form-label">Type</label>
                                                <select id="edit-Type" name="update_types[]" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." required style="width: 100%;">
                                                    @foreach ($types as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="edit-Category" class="form-label">Category</label>
                                                <select id="edit-Category" name="update_categories[]" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." required style="width: 100%;">
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="edit-Location" class="form-label">Location</label>
                                                <select id="edit-Location" name="update_locations[]" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." required style="width: 100%;">
                                                    @foreach ($locations as $location)
                                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
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
        var datalist = {!! $details !!};
        var is_deleteUrl = '{!! route("vendor-details-delete") !!}';
        var assetUrl = '{!! asset("images/user") !!}';
    </script>
    <script src="{{asset('app/js/vendor/details.js')}}"></script>
@endpush