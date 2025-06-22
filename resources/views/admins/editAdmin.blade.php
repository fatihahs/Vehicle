@extends('layouts.index')
@section('main-content')


<div class="pagename">
    <p>Edit Admin Details</p>
</div>

<div class="row">
    <div class="col-md-6-md-0 form-left-align">
        <div class="cardr-body">
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
                </div>

                <div class="mb-2">
                    <label for="Email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $admin->email }}">
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="OldPassword" class="form-label">Old Password</label>
                    <input type="password" name="old_password" class="form-control" >
                    @if($errors->has('old_password'))
                        <div class="text-danger small">{{ $errors->first('old_password') }}</div>
                    @endif
                </div>

                <div class="mb-2">
                    <label for="NewPassword" class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" >
                    @if($errors->has('password')) <!-- For "Both passwords required" message -->
                        <div class="text-danger small">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="mb-2">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" >
                    @if($errors->has('password')) <!-- For "Both passwords required" message -->
                        <div class="text-danger small">{{ $errors->first('password') }}</div>
                    @endif
                    @if($errors->has('new_password'))
                        <div class="text-danger small">{{ $errors->first('new_password') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success mt-4">Update</button>
                <a href="{{ route('admins.all') }}" class="btn btn-secondary mt-4">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
