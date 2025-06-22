@extends('layouts.index')
@section('main-content')
<div class="pagename">
    <p>Register Security Guard</p>
</div>

<div class="row">
    <div class="col-md-6-md-0 form-left-align">
        <div class="cardr-body">
            <form method="POST" action="{{ route('guards.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-outline mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-outline mb-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-outline mb-2">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-outline mb-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-outline mb-2">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                 </div>


                <button type="submit" class="btn btn-primary mt-4">Register</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>
            </form>
        </div>

    </div>
</div>
@endsection
