@extends('layouts.index')

@section('main-content')

<div class="pagename">
    <p>Edit Resident Details</p>
</div>

<div class="row">
    <div class="col-md-6-md-0 form-left-align">
        <div class="cardr-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('residents.update', $resident->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label for="TagID" class="form-label">Tag ID</label>
                    <input type="text" name="TagID" class="form-control" value="{{ $resident->TagID }}" required>
                </div>

                <div class="mb-2">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name="Name" class="form-control" value="{{ $resident->Name }}" required>
                </div>

                <div class="mb-2">
                    <label for="PlateNo" class="form-label">License Plate</label>
                    <input type="text" name="PlateNo" class="form-control" value="{{ $resident->PlateNo }}" required>
                </div>

                <div class="mb-2">
                    <label for="Phone" class="form-label">Phone</label>
                    <input type="text" name="Phone" class="form-control" value="{{ $resident->Phone }}" required>
                </div>

                <div class="mb-2">
                    <label for="Address" class="form-label">Address</label>
                    <textarea name="Address" class="form-control" required>{{ $resident->Address }}</textarea>
                </div>

                <button type="submit" class="btn btn-success mt-4">Update</button>
                <a href="{{ route('all.residents') }}" class="btn btn-secondary mt-4">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
