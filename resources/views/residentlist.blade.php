@extends('layouts.app')

@section('content')
<body>

    <div class="container">


            <div class="pagename">
                <p>Registered Resident<p>
            </div>

            <div class=" searchC mb-3">
                <form method="GET" action="{{ route('search.residents') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request()->query('search') }}">
                    </div>
                </form>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <table class="table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>License Plate</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($residents as $index => $resident)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $resident->Name }}</td>
                                <td>{{ $resident->PlateNo }}</td>
                                <td>{{ $resident->Phone }}</td>
                                <td>{{ $resident->Address }}</td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>

    </div>
</body>


@endsection
