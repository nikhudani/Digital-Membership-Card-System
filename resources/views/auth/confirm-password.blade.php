@extends('layouts.guest.main')
@section('short-message')
This is a secure area of the application.
@endsection
@section('content')
<div class="card-body p-4">
    <div class="p-3">
        <form class=" mt-4" method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="mdi mdi-exclamation-thick" style="font-size: 24px;"></i> 
                <div class="ms-3">
                    Please confirm your password before continuing.
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="userpassword">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                @enderror
            </div>

            <div class="mb-3 row">
                <div class="col-12 text-end">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Confirm</button>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection
@section('content-footer')
    <div class="mt-5 text-center">
        <p>Remember It ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Sign In here </a> </p>
    </div>
@endsection