@extends('layouts.guest.main')
@section('short-message')
Forgot password?
@endsection
@section('content')
    <div class="card-body p-4">
                                    
        <div class="p-3">

            <div class="alert alert-success mt-5" role="alert">
                Enter your Email and instructions will be sent to you!
            </div>


            <form class=" mt-4" method="POST" action="{{ route('password.email') }}">
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
                    <input type="email" name="email" class="form-control @error('password') is-invalid @enderror" id="email" placeholder="Enter email">
                    @error('password')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="row  mb-0">
                    <div class="col-12 text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
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