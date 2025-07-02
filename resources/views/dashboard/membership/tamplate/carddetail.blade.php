<form action="{{route('update-card')}}" method="POST" class="g-3 needs-validation" novalidate>
    <div class="row mt-3 mb-3">
        <div class="col">
            <label for="Edit-Slugurl" class="form-label">Your EP Digital URL Name</label>
            <input type="text" name="update_slugurl" class="form-control" id="Edit-Slugurl" required>
            <span class="invalid-feedback"></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="Edit-Cardname" class="form-label">Card Name</label>
            <input type="text" name="update_name" class="form-control" id="Edit-Cardname" required>
            <span class="invalid-feedback"></span>
        </div>
    </div>

    @cannot('roleHas', ['customer'])
        <div class="row mb-3">
            <div class="col">
                <label for="Edit-Customer" class="form-label">Customer</label>
                <select name="update_customer_id" class="form-select" id="Edit-Customer" style="width: 100%;" required>
                    <option selected disabled value="">--Select--</option>
                    @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
                <span class="invalid-feedback"></span>
            </div>
        </div>
    @endcannot

    <!-- end col -->
    <input type="hidden" name="id">
    <div class="row d-flex justify-content-between align-items-center">
        @cannot('roleHas', ['customer'])
            <div class="col d-flex align-items-center">
                <input name="update_is_active" class="form-check-input mt-0" type="checkbox" id="Edit-Publish" checked>
                <label class="form-check-label mb-0 ms-1" for="Edit-Publish">
                    Active
                </label>
            </div>
        @endcannot
        <div class="col text-end">
            <button class="btn btn-warning" type="submit">Save</button>
        </div>
    </div>
</form>