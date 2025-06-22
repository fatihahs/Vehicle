@extends('layouts.index')

@section('main-content')
<div class="pagename">
    <p>Edit Security Guard Details</p>
</div>

<div class="row">
    <div class="col-md-6-md-0 form-left-align">
        <div class="cardr-body">

            <form action="{{ route('guards.update', $guard->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $guard->name }}" required>
                </div>

                <div class="mb-2">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $guard->phone }}" required>
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $guard->email }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success mt-4">Update</button>
                <a href="{{ route('all.guards') }}" class="btn btn-secondary mt-4">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
