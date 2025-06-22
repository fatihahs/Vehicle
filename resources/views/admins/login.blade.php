@extends('layouts.admin')

@section('content')
<style>
    body {
    background: linear-gradient(to right, #3e2723, #5d4037);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
</style>
<body>
<div class="r-container">
    <div class="login-wrapper">


        <div class="left-section">
            <div class="container-xxl py-5 header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Vehicle Monitoring</h1>
                </div>
            </div>
        </div>

        <div class="right-section">
        <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="register-container text-center" style="width: 400px">
            <h1 class="text-dark mb-4" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif" "> Admin Login</h1>
            <form method="POST" action="{{ route('check.login') }}">
                @csrf

                    <div class="form-floating mb-3">
                        <div class="form-outline mb-4">
                        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                    </div>

                    <div class="form-floating mb-3">
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                          </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" name="submit" class="btn btn-primary btn-custom mb-4 text-center">Login</button>
                    </div>

            </form>
        </div>
        </div>
    </div>
</div>

</body>
{{-- <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mt-5">Login</h5>
          <form method="POST" class="p-auto" action="login.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

              </div>


              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


            </form>

        </div>
   </div>
 </div>
</div> --}}
@endsection

