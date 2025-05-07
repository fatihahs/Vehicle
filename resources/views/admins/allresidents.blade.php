@extends('layouts.index')
@section('main-content')
<div class="pagename">
    <p>Residents Details<p>
</div>



<div class="row">
    <div class="card-body">
        <div class="container">
            @if(Session::has('success'))
                <p class="alert {{Session::get('alert-class', 'alert-success')}}">{{ Session::get('success') }}</p>
            @endif
        </div>

        <div style="display: flex; justify-content: flex-end; right: 20px;" class="mb-3">
            <form method="GET" action="{{ route('search.register.resident') }}">
                <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request()->query('search') }}">
            </form>

            <a href="{{ route('admins.residents') }}" class="btn btn-primary">Register Resident</a>
        </div>


        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tag ID</th>
                        <th>Name</th>
                        <th>License Plate</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($residents as $index => $resident)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $resident->TagID }}</td>
                            <td>{{ $resident->Name }}</td>
                            <td>{{ $resident->PlateNo }}</td>
                            <td>{{ $resident->Phone }}</td>
                            <td>{{ $resident->Address }}</td>
                            <td>
                                <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning btn-sm">Update</a>

                                <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                     @endforeach
                </tbody>
            </table>
         </div>
    </div>
</div>
@endsection
