@extends('layouts.index')
@section('main-content')
<div class="pagename">
    <p>Register Resident</p>
</div>

<div class="row">
    <div class="col-md-6-md-0 form-left-align">
            <div class="cardr-body">
                <form method="POST" action="{{ route('residents.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-2">
                        <label for="TagID">Tag ID</label>
                        <input type="text" name="TagID" class="form-control" required>
                        @error('TagID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="Name">Name</label>
                        <input type="text" name="Name" class="form-control" required>
                        @error('Name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="PlateNo">License Plate</label>
                        <input type="text" name="PlateNo" class="form-control" required>
                        @error('PlateNo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="Phone">Phone</label>
                        <input type="text" name="Phone" class="form-control" required>
                        @error('Phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="Address">Address</label>
                        <textarea name="Address" class="form-control"  required></textarea>
                        @error('Address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Register</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>

                </form>
            </div>
    </div>
</div>
@endsection
