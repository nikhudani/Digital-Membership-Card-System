@extends('layouts.dashboard.main')
@section('main')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Purchase History
                        @cannot('roleHas', ['customer'])
                            <button type="button" class="btn btn-primary float-end" data-tooltip="tooltip" title="Add Purchase" data-bs-toggle="modal" data-bs-target="#add" data-te-vendor="type">
                                <i class="fa fa-plus"></i>
                            </button>
                        @endcannot
                    </h4>
                    <p class="card-title-desc">
                        @can('roleHas', ['customer'])
                            List of all of my Purchase History.
                        @else
                            List of all Customers Purchase History.
                        @endcan
                    </p>

                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @cannot('roleHas', ['customer'])
                                        <th>Customer</th>
                                    @endcannot
                                    @cannot('roleHas', ['vendor'])
                                        <th>Vendor</th>
                                    @endcannot
                                    <th>Type & Location</th>
                                    <th class="text-center">Category</th>
                                    <th>Sub Total</th>
                                    @cannot('roleHas', ['customer'])
                                    <th class="text-center">Commission</th>
                                    @endcannot
                                    <th class="text-center">Date Purchased</th>
                                    @cannot('roleHas', ['customer'])
                                        <th class="text-end">Action</th>
                                    @endcannot
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $key => $purchase)
                                    <tr>
                                        <td class="align-middle">{{$key + 1}}</td>
                                        @cannot('roleHas', ['customer'])
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img class="rounded-circle avatar-sm" src="{{asset('images/user')}}/{{$purchase->customer->customer->details->image}}" alt="{{$purchase->customer->name}}">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h4 class="font-size-15 m-0">{{$purchase->customer->customer->name}}</h4>
                                                        <span class="badge rounded-pill bg-info">{{$purchase->customer->plan->name}}</span>
                                                        {{-- <br>
                                                        <small class="text-muted">{{$purchase->customer->details->phone_number}}</small> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        @endcannot
                                        
                                        @cannot('roleHas', ['vendor'])
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img class="rounded-circle avatar-sm" src="{{asset('images/user')}}/{{$purchase->vendor->details->image}}" alt="{{$purchase->vendor->name}}">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h4 class="font-size-15 m-0">{{$purchase->vendor->name}}</h4>
                                                        <small class="text-muted">
                                                            <i class="fas fa-building me-1"></i> {{$purchase->vendor->details->organization}}
                                                        </small>
                                                        {{-- <br>
                                                        <small class="text-muted">{{$purchase->customer->details->phone_number}}</small> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        @endcannot

                                        <td class="align-middle pb-0">
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt me-1"></i> {{$purchase->get_location->name}}
                                            </small>
                                            <br>
                                            -<span class="badge rounded-pill bg-light ms-1">{{$purchase->get_type->name}}</span>
                                        </td>

                                        <td class="text-center align-middle pb-0">
                                            @foreach ($purchase->categories as $category)
                                                <span class="badge rounded-pill bg-primary">{{$category['name']}}</span> <br>
                                            @endforeach
                                        </td>

                                        <td class="align-middle pb-0">
                                            @php
                                                $subtotal = $purchase->subtotal;
                                                $discount = $purchase->discount;
                                                $discountAmount = $discount; // Directly using the discount amount
                                                $summary = $subtotal - $discountAmount;
                                            @endphp
                                            
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-15 m-0 d-flex align-items-center">
                                                        RM{{$summary}} - <span class="badge rounded-pill bg-primary ms-1">-RM{{$discount}}</span>
                                                    </h4>
                                                    <small class="text-muted">
                                                        <strong>RM{{$subtotal}}</strong>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        @cannot('roleHas', ['customer'])
                                        <td class="align-middle pb-0">
                                        @php
                                            $subtotal = $purchase->subtotal;
                                            $discount = $purchase->discount;
                                            $discountAmount = $discount; // Directly using the discount amount
                                            $summary = $subtotal - $discountAmount;
                                            
                                            // Calculate 5% commission from the summary
                                            $commissionRate = 0.05; // 5% commission
                                            $commission = $summary * $commissionRate;
                                            $totalWithCommission = $summary + $commission; // If you want to add the commission to the summary
                                        @endphp
                                            
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h4 class="font-size-15 m-0 d-flex align-items-center">
                                                RM{{$commission}} - <span class="badge rounded-pill bg-success ms-1">5%</span>
                                                </h4>
                                            </div>
                                        </div>
                                        @endcannot
                                        <td class="text-center align-middle pb-0">
                                            <strong class="text-muted">{{$purchase->created_at}}</strong>                                            
                                        </td>

                                        @cannot('roleHas', ['customer'])
                                            <td class="text-end align-middle">
                                                <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Edit" data-te-update="{{$purchase->id}}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-secondary btn-sm edit" data-tooltip="tooltip" title="Delete" data-te-delete="{{$purchase->id}}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        @endcannot
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    
    <div class="modal fade" id="add" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Puchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('create-purchase')}}" method="POST" class="g-3 needs-validation">
                    <div class="modal-body">
                        <div class="row mt-3 mb-4">
                            <div class="col">
                                <label for="Customer" class="form-label">Customer</label>
                                <select name="customer_id" class="form-select" id="Customer" style="width: 100%;" required>
                                    <option selected disabled value="">--Select--</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->customer->id}}">{{$customer->customer->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                            @can('roleHas', ['vendor'])
                                <input type="hidden" name="vendor_id" value="{{auth()->user()->id}}">
                            @else
                                <div class="col">
                                    <label for="vendor" class="form-label">Vendor</label>
                                    <select name="vendor_id" class="form-select" id="vendor" style="width: 100%;" required>
                                        <option selected disabled value="">--Select--</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{$vendor->vendor->id}}">{{$vendor->vendor->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            @endcan
                        </div>

                        <div class="position-relative border pt-3 ps-2 pe-2 pb-2 rounded-2 mb-3">
                            <div class="position-absolute badge bg-light" style="top: -5%;">Wedding Option</div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="Type" class="form-label">Type</label>
                                    <select name="type" class="form-select" id="Type" style="width: 100%;" required @cannot('roleHas', ['vendor']) disabled @endcannot>
                                        <option selected disabled value="">--Select--</option>
                                        @can('roleHas', ['vendor'])
                                            @foreach ($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        @endcan
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col">
                                    <label for="Location" class="form-label">Location</label>
                                    <select name="location" class="form-select" id="Location" style="width: 100%;" required @cannot('roleHas', ['vendor']) disabled @endcannot>
                                        <option selected disabled value="">--Select--</option>
                                        @can('roleHas', ['vendor'])
                                            @foreach ($locations as $location)
                                                <option value="{{$location->id}}">{{$location->name}}</option>
                                            @endforeach
                                        @endcan
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="Category" class="form-label">Category</label>
                                    <select name="categories[]" id="Category" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..."  style="width: 100%;" required @cannot('roleHas', ['vendor']) disabled @endcannot>
                                        @can('roleHas', ['vendor'])
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endcan
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Sub-Total" class="form-label">Sub Total (RM)</label>
                                <input type="number" name="subtotal" class="form-control" id="Sub-Total" required>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col">
                                <label for="Discount" class="form-label">Discount (RM)</label>
                                <input type="number" name="discount" class="form-control" id="Discount" min="0" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="update" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Puchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('update-purchase')}}" method="POST" class="g-3 needs-validation">
                    <div class="modal-body">
                        
                        @can('roleHas', ['vendor'])
                            <input type="hidden" name="update_vendor_id" value="{{auth()->user()->id}}">
                        @else
                            <div class="row mt-3 mb-4">
                                <div class="col">
                                    <label for="Edit-vendor" class="form-label">Vendor</label>
                                    <select name="update_vendor_id" class="form-select" id="Edit-vendor" style="width: 100%;" required>
                                        <option selected disabled value="">--Select--</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{$vendor->vendor->id}}">{{$vendor->vendor->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endcan

                        <div class="position-relative border pt-3 ps-2 pe-2 pb-2 rounded-2 mb-3">
                            <div class="position-absolute badge bg-light" style="top: -5%;">Wedding Option</div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="Edit-Type" class="form-label">Type</label>
                                    <select name="update_type" class="form-select" id="Edit-Type" style="width: 100%;" required >
                                        {{-- <option selected disabled value="">--Select--</option> --}}
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="col">
                                    <label for="Edit-Location" class="form-label">Location</label>
                                    <select name="update_location" class="form-select" id="Edit-Location" style="width: 100%;" required >
                                        {{-- <option selected disabled value="">--Select--</option> --}}
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="Edit-Category" class="form-label">Category</label>
                                    <select name="update_categories[]" id="Edit-Category" class="form-select select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..."  style="width: 100%;" required ></select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="Edit-Sub-Total" class="form-label">Sub Total (RM)</label>
                                <input type="number" name="update_subtotal" class="form-control" id="Edit-Sub-Total" required>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col">
                                <label for="Edit-Discount" class="form-label">Discount (RM)</label>
                                <input type="number" name="update_discount" class="form-control" id="Edit-Discount" min ="0" required>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <button class="btn btn-warning" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')
    <script>
        var datalist = {!! $purchases !!};
        var is_deleteUrl = '{!! route("delete-purchase") !!}';
        var assetUrl = '{!! asset("images/user") !!}';
        var vendetails = '{!! route("vendordetails-purchase") !!}';
        var is_vendor = {!! auth()->user()->hasRole('vendor') ? 'true' : 'false' !!};
        $(function () {            

            $('table').DataTable({
                buttons: ["pdf", "excel"],
                columnDefs: [
                    { "orderable": false, "targets": [ @cannot('roleHas', ['customer', 'vendor']) 7 @endcannot ] }
                ]
            })
            .buttons()
            .container()
            .appendTo("#DataTables_Table_0_wrapper .col-md-6:eq(0)"),
                $(".dataTables_length select")
                    .addClass("form-select form-select-sm");
        });
    </script>
    <script src="{{asset('app/js/membership/puchases.js')}}"></script>
@endpush