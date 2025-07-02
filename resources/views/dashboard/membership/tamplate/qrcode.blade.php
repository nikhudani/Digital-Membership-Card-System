<div class="row justify-content-center align-items-center mb-5">
    <div class="col-auto d-flex justify-content-center align-items-center shadow-sm">
        <div class="d-flex justify-content-center align-items-center" data-te-qr="code"></div>
    </div>
</div>

<form action="{{route('qr-size')}}" method="post">
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col-md-6">
            <input type="text" data-te-qr="box">
        </div>
    </div>
    <input type="hidden" name="id">
    <input type="hidden" name="qr_size">
    <div class="row align-items-center">
        <div class="col text-end">
            <button class="btn btn-warning" type="submit">Save</button>
        </div>
    </div>
</form>