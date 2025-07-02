@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add EP Digital Card</h4>
                    {{-- <p class="card-title-desc">
                        Parsley is a javascript form validation
                        library. It helps you provide your users with feedback on their form
                        submission before sending it to your server.
                    </p> --}}
                    <form action="{{route('create-card')}}" method="POST" class="g-3 needs-validation" novalidate>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Slugurl" class="form-label">Your EP Digital URL Name</label>
                                <input type="text" name="slugurl" class="form-control" id="Slugurl" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Cardname" class="form-label">EynaPass Card Name</label>
                                <input type="text" name="name" class="form-control" id="Cardname" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            @can('roleHas', ['customer'])
                                <input type="hidden" name="customer_id" value="{{auth()->user()->id}}">
                            @else
                                <div class="col">
                                    <label for="Customer" class="form-label">Customer</label>
                                    <select name="customer_id" class="form-select" id="Customer" style="width: 100%;" required>
                                        <option selected disabled value="">--Select--</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            @endcan
                        </div>
                        <!-- end col -->
                        <div class="row d-flex justify-content-between align-items-center">
                            @cannot('roleHas', ['customer'])
                                <div class="col d-flex align-items-center">
                                    <input name="is_active" class="form-check-input mt-0" type="checkbox" id="Publish" checked>
                                    <label class="form-check-label mb-0 ms-1" for="Publish">
                                        Active
                                    </label>
                                </div>
                            @endcannot
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
                    <h4 class="card-title">
                        @can('roleHas', ['customer']) My ElynaPass @else EP Digital Cards @endcan
                    </h4>
                    <p class="card-title-desc">
                        @can('roleHas', ['customer']) List of all my ElynaPass. @else List of all Customers EP Digital Cards. @endcan                        
                    </p>
            
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>EP Digital Card</th>
                                    @cannot('roleHas', ['customer'])
                                        <th>Customer</th>
                                    @endcannot
                                    <th class="text-center">Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vcards as $key => $vcard)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        <td class="align-middle pb-0">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0">{{$vcard->name}}</h4>
                                                    <small class="text-muted">
                                                        <i class="fas fa-link me-1"></i> <a href="{{route('slug', $vcard->slugurl)}}" target="blank">
                                                            {{$vcard->slugurl}}
                                                        </a>                                                        
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        @can('roleHas', ['customer'])
                                            <td class="text-center align-middle pb-0 text-{{($vcard->is_active) ? 'success':'danger'}}">
                                                <i data-tooltip="tooltip" title="{{($vcard->is_active) ? 'Active':'Deactive'}}" class="mdi mdi-earth{{($vcard->is_active) ? '':'-off'}} fa-2x"></i>
                                            </td>
                                        @else
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img class="rounded-circle avatar-sm" src="{{asset('images/user')}}/{{$vcard->customer->details->image}}" alt="{{$vcard->customer->name}}">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h4 class="font-size-15 m-0">{{$vcard->customer->name}}</h4>
                                                        <small class="text-muted">{{$vcard->plan->plan->name}}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="text-center align-middle pb-0">
                                                <input class="form-check form-switch" type="checkbox" data-te-status="{{$vcard->id}}" id="switch{{$key}}" switch="bool" {{($vcard->is_active) ? 'checked':''}}>
                                                <label class="form-label mb-0" for="switch{{$key}}" data-on-label="" data-off-label=""></label>
                                            </td>
                                        @endcan

                                        <td class="text-end align-middle">
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#update-vcard" data-te-edit="{{$key}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            @cannot('roleHas', ['customer'])
                                                <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="E-Mail" data-bs-toggle="modal" data-bs-target="#email-vcard" data-te-email="{{$key}}">
                                                    <i class="fas fa-envelope"></i>
                                                </a>
                                            @endcannot
                                            <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-delete="{{$vcard->id}}">
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
    <div class="modal fade" id="update-vcard" role="dialog" aria-labelledby="update-userTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-userTitle">Update EP Digital Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Nav tabs -->
                @include('dashboard.membership.tamplate.main')
            </div>
        </div>
    </div>
    {{--  --}}    
    <div class="modal fade" id="email-vcard" role="dialog" aria-labelledby="email-vcardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="email-vcardTitle">Email EP Digital Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('qr-email')}}" method="post" class="g-3">
                    <div class="modal-body">

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Email-Subject" class="form-label">Subject</label>
                                <input type="text" name="email_subject" class="form-control" id="Email-Subject">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Email-Customer" class="form-label">Message</label>
                                <textarea name="email_message" id="Email-Customer" rows="5" class="form-control"></textarea>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="id">
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var datalist = {!! $vcards !!};
        var is_activeUrl = '{!! route("status-card") !!}';
        var is_deleteUrl = '{!! route("delete-card") !!}';
        var assetUrl = '{!! asset("images") !!}';
        var slugUrl = '{!! route("slug") !!}';
    </script>
    <script src="{{asset('app/js/membership/virtualcard.js')}}"></script>
@endpush