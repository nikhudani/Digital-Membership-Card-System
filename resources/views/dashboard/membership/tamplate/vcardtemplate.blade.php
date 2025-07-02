<form action="{{route('qr-theme')}}" method="post">

    <div class="row">
        <div class="col-md-6">
            <label for="theme-default" class="p-1 cursor-pointer w-100">
                @include('dashboard.membership.tamplate.vcard.default')
            </label>
            <input type="radio" name="theme" class="btn-check" id="theme-default" value="default">
        </div>
        <div class="col-md-6">
            <label for="theme-modern" class="p-1 cursor-pointer w-100">
                @include('dashboard.membership.tamplate.vcard.modern')
            </label>
            <input type="radio" name="theme" class="btn-check" id="theme-modern" value="modern">
        </div>
    </div>
    <input type="hidden" name="id">
    <div class="row">
        <div class="col text-end">
            <button class="btn btn-warning" type="submit">Save</button>
        </div>
    </div>

</form>
