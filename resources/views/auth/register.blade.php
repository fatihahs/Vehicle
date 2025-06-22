@extends('layouts.app')

@section('content')
<style>
    body {
    background: linear-gradient(to right, #3e2723, #5d4037);
    /* background: linear-gradient(to right, #1a1a2e, #3a1c71); */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

}
</style>
<body>
    <div class="r-container">
        <div class="login-wrapper">
            <div class="left-section">
                <div class="container-xxl py-5 header mb-5">
                    <div class="container text-center my-5 pt-5 pb-4">
                        <h1 class="display-3 text-white mb-3 animated slideInDown" style="font-family:sans-serif">Vehicle Monitoring</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center text-uppercase">
                                <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/login">Login</a></li>
                                <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/register">Register</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="right-section">
            <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="register-container text-center" style="width: 400px">
                <h1 class="text-dark mb-4" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Register</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                        <div class="form-floating mb-2">
                            <input  id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <label for="name">Name</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-2">
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel">
                            <label for="phone">Your Phone Number</label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-2">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <label for="email">Your Email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-2">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <label for="password">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-floating mb-2">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <label for="password">Confirm Password</label>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <button class="btn btn-primary py-3" name="submit" type="submit" style="border-radius: 40px; font-size: 14px; width:90%; ">Register</button>
                        </div>
                </form>
            </div>
            </div>

            </div>
        </div>
    </div>
</body>
@endsection

