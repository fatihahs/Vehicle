@extends('layouts.index')
@section('main-content')
<div class="pagename">
    <p>Register Resident</p>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('residents.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-outline mb-4 mt-4">
                        <label for="TagID">Tag ID</label>
                        <input type="text" name="TagID" class="form-control" required>
                        @error('TagID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label for="Name">Name</label>
                        <input type="text" name="Name" class="form-control" required>
                        @error('Name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label for="PlateNo">License Plate</label>
                        <input type="text" name="PlateNo" class="form-control" required>
                        @error('PlateNo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label for="Phone">Phone</label>
                        <input type="text" name="Phone" class="form-control" required>
                        @error('Phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label for="Address">Address</label>
                        <textarea name="Address" class="form-control" rows="3" required></textarea>
                        @error('Address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mb-4">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
