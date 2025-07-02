@extends('layouts.dashboard.main')
@section('main')
    <div class="row">        
        <!--  -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between align-items-center">
                        Types
                        <button type="button" class="btn btn-primary" data-tooltip="tooltip" title="Add new vendor type" data-bs-toggle="modal" data-bs-target="#add" data-te-vendor="type">
                            <i class="fa fa-plus"></i>
                        </button>
                    </h4>
                    <p class="card-title-desc">
                        You can manage vendor type here.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $key => $type)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td>
                                            {{$type->name}}
                                        </td>
                                        
                                        <td class="text-end align-middle">
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update" data-te-vendor="type" data-te-edit="{{$key}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-vendor="type" data-te-delete="{{$type->id}}">
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
        {{--  --}}
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between align-items-center">
                        Categories
                        <button type="button" class="btn btn-primary" data-tooltip="tooltip" title="Add new vendor category" data-bs-toggle="modal" data-bs-target="#add" data-te-vendor="category">
                            <i class="fa fa-plus"></i>
                        </button>
                    </h4>
                    <p class="card-title-desc">
                        You can manage vendor category here.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td>
                                            {{$category->name}}
                                        </td>
                                        
                                        <td class="text-end align-middle">
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update" data-te-vendor="category" data-te-edit="{{$key}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-vendor="category" data-te-delete="{{$category->id}}">
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
    <div class="row">        
        <!--  -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between align-items-center">
                        Locations
                        <button type="button" class="btn btn-primary" data-tooltip="tooltip" title="Add new vendor location" data-bs-toggle="modal" data-bs-target="#add" data-te-vendor="location">
                            <i class="fa fa-plus"></i>
                        </button>
                    </h4>
                    <p class="card-title-desc">
                        You can manage vendor location here.
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $key => $location)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td>
                                            {{$location->name}}
                                        </td>
                                        
                                        <td class="text-end align-middle">
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update" data-te-vendor="location" data-te-edit="{{$key}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-vendor="location" data-te-delete="{{$location->id}}">
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

    <div class="modal fade" id="add" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add-new" action="{{route('vendor-settings-store')}}" method="post" class="g-3">
                    <div class="modal-body">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="add-Fullname" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="add-Fullname" placeholder="Name of place" >
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="vendor">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="update" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update-path" action="{{route('vendor-settings-update')}}" method="post" class="g-3">
                    <div class="modal-body">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Fullname" class="form-label">Name</label>
                                <input type="text" name="update_name" class="form-control" id="edit-Fullname" placeholder="Name of" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="vendor">
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
        var datalist = {
            type: {!! $types !!},
            category: {!! $categories !!},
            location: {!! $locations !!},
        };
        var is_deleteUrl = '{!! route("vendor-settings-delete") !!}';
    </script>
    <script src="{{asset('app/js/vendor/settings.js')}}"></script>
@endpush