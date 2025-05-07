@extends('layouts.index')
@section('main-content')
<div class="pagename">
    <p>Admin Details<p>
</div>


<div class="row">
    <div class="card-body">
        <div class="container">
            @if(Session::has('success'))
                <p class="alert {{Session::get('alert-class', 'alert-success')}}">{{ Session::get('success') }}</p>
            @endif
        </div>

        <div style="display: flex; justify-content: flex-end; right: 20px; gap:10px" class="mb-3">
            <form method="GET" action="{{ route('search.register.resident') }}">
                <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request()->query('search') }}">
            </form>

            <a  href="{{route('admins.create')}}" class="btn btn-primary mb-4 text-center float-right">New Admins</a>
        </div>

        <div class="container mt-4">
            <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($admins as $index => $admin)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
         </div>
    </div>
</div>
@endsection
