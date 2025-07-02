@extends('layouts.guest.main')
@section('short-message')
Sign in to start session.
@endsection
@section('content')
    <div class="card-body p-4">
        <div class="p-3">
            <form class="mt-4" method="POST" action="{{ route('login') }}">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="mdi mdi-check-circle" style="font-size: 24px;"></i> 
                        <div class="ms-3">
                            {{session('status')}}
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" required>
                    @error('email')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="userpassword">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" required>
                    @error('password')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customControlInline" name="remember">
                            <label class="form-check-label" for="customControlInline">Remember me</label>
                        </div>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

                <div class="mt-2 mb-0 row">
                    @if (Route::has('password.request'))
                        <div class="col-12 mt-4">
                            <a href="{{ route('password.request') }}">
                                <i class="mdi mdi-lock"></i> 
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>

            </form>

        </div>
    </div>
@endsection
@section('content-footer')
    <div class="mt-5 text-center">
        <p>Don't have an account ? <a href="{{ route('register') }}" class="fw-medium text-primary"> Signup now </a> </p>
    </div>
@endsection