@extends('layouts.auth', ['active' => 'Sign up - DiaCheck'])

@section('content')
    <div class="row row-cols-1 justify-content-center mx-0 w-100" style="height: 100svh">
        <div class="col col-12 col-md-6 col-lg-4 mx-0 d-flex flex-column align-items-center">
            <div class="d-flex flex-column align-items-center pt-4">
                <img src="{{ url('assets/images/diacheck-icon.png') }}" alt="icon">
                <h3 class="text-color fw-bold">Sign up</h3>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth mt-4 w-100">
                @csrf
        
                <div class="content mb-3">
                    <div class="pass-logo">
                        <i class='bx bx-user'></i>
                    </div>
                    <input type="name" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Username" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                </div>

                <div class="content mb-3">
                    <div class="pass-logo">
                        <i class='bx bx-envelope'></i>
                    </div>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                </div>
        
                <div class="content mb-3">
                    <div class="pass-logo">
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="d-flex align-items-center position-relative">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" style="padding-right: 45px;" placeholder="Password" required>
                        <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100" id="showPass" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;" onclick="showPass()">
                            <i class="fa-regular fa-eye-slash"></i>
                        </div>
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="content mb-3">
                    <div class="pass-logo">
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="d-flex align-items-center position-relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" style="padding-right: 45px;" placeholder="Confirm password" required>
                        <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100" id="showPass2" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;" onclick="showPass2()">
                            <i class="fa-regular fa-eye-slash"></i>
                        </div> 
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-primary d-block fw-semibold w-100" type="submit">Sign up</button>
                    <span class="fw-semibold text-center py-0 my-0">or</span>
                    <a href="{{ route('google.redirect') }}" class="btn btn-login-with-google fw-semibold w-100">
                        <img src="{{ url('assets/images/google-icon.png') }}" style="width: 20px;" alt="Google Icon">
                        Sign up with Google
                    </a>
                </div>
                <p class="mb-0 mt-2 text-color text-center">
                    Have an account?
                    <a href="{{ route('login') }}" class="text-decoration-underline">Login here!</a>
                </p>
            </form>
        </div>
    </div>
@endsection