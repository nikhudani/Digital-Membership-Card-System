<form action="{{route('qr-contact')}}" method="POST" class="g-3 needs-validation" novalidate>

    <div class="row mt-3 mb-3">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-icnumber">
                    <i class="fas fa-id-card fa-lg"></i>
                </span>
                <input type="number" name="ic_number" class="form-control" id="Edit-icnumber" placeholder="IC Number" required>
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-phone">
                    <i class="fas fa-phone-alt fa-lg"></i>
                </span>
                <input type="number" name="phone_number" class="form-control" id="Edit-phone" placeholder="Mobile Number" required>
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    {{-- <div class="row mb-3">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-email">
                    <i class="fas fa-envelope fa-lg"></i>
                </span>
                <input type="email" name="email" class="form-control" id="Edit-email" placeholder="E Mail" required>
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div> --}}

    <div class="row mb-3">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-address">
                    <i class="fas fa-map-marker-alt fa-lg"></i>
                </span>
                <input type="text" name="address" class="form-control" id="Edit-address" placeholder="Address" required>
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <!-- end col -->
    <input type="hidden" name="id">
    <div class="row align-items-center">
        <div class="col text-end">
            <button class="btn btn-warning" type="submit">Save</button>
        </div>
    </div>
</form>