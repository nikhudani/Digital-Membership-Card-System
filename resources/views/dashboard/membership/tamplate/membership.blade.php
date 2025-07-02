<form action="{{route('plan-card')}}" method="post">
    <div class="row justify-content-center mt-4">

        @foreach ($plans as $plan)
            <div class="col-md-6">
                <label for="plan-{{$plan->name}}" class="rounded mb-0 cursor-pointer rounded-4 p-1" style="max-width: 280px;">
                    <div class="position-relative">
                        <img class="shadow-sm rounded rounded-4" src="{{asset('images/cards')}}/{{strtolower($plan->name)}}.png" alt="{{$plan->name}}" style="width: -webkit-fill-available;">
                        <div class="position-absolute" style="top: 70%; left: 5%;">
                            <h6 class="text-white mb-1" data-te-vcard-memberid></h6>
                            <div class="d-flex align-items-center">
                                <small class="me-2 text-white-50" style="font-size: 8px;">VALID<br>THRU</small>
                                <strong class="text-white" style="font-size: 11px;" data-te-vcard-exp></strong>
                            </div>
                        </div>
                    </div>
                </label>
                <input type="radio" name="plan_id" id="plan-{{$plan->name}}" class="btn-check" value="{{$plan->id}}">
            </div>
        @endforeach

    </div>
    <div class="row align-items-center mt-3">
        <div class="col text-end">
            <input type="hidden" name="id">
            <button class="btn btn-warning" type="submit">Save</button>
        </div>
    </div>
</form>
