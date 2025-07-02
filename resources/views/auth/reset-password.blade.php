@extends('layouts.guest.main')
@section('short-message')
Reset password now.
@endsection
@section('content')
    <div class="card-body p-4">
        <div class="p-3">
            <form class=" mt-4" method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ $request->email }}">
                @error('email')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="mdi mdi-close-octagon" style="font-size: 24px;"></i> 
                        <div class="ms-3">
                            {{$message}}
                        </div>
                    </div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="userpassword">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="Confirmpassword">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="Confirmpassword" placeholder="Confirm password">
                    @error('password_confirmation')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <div class="col-12 text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset Password</button>
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