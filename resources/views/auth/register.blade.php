@extends('layouts.guest.main')
@section('short-message')
Register an account now.
@endsection
@section('content')

    <div class="card-body p-4">
        <div class="p-3">
            <form class=" mt-4" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" placeholder="Full name">
                    @error('name')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="useremail">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="useremail" value="{{old('email')}}" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
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

                <div class="mb-3">
                    <label class="form-label" for="Confirmpassword">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="Confirmpassword" placeholder="Confirm password">
                    @error('password_confirmation')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                {{-- Additional fields for Plan, Mobile, and Plan Expiry Date --}}

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Mobile</label>
                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number">
                    @error('phone_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <div class="col-12 text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
@section('content-footer')
    <div class="mt-5 text-center">
        <p>Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Login </a> </p>
    </div>
@endsection