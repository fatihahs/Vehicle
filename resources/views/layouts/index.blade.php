@extends('layouts.admin')

@section('content')

 <!-- Menu -->
 <div class="sidebar p-3" style="width: 250px;">
    <h6 class="text-white fs-1 mb-5" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Admin Control</h6>
    <ul class="navbar-nav w-100  p-0 m-0" style="gap: 0; padding: 0;">
    @auth('admin')
        <li class="mb-4"><a href= "{{ route('admins.dashboard') }}" class="nav-item nav-link"><i class="fa fa-home me-3"></i>Dashboard</a></li>
        <li class="mb-4"><a href="{{ route('admins.all') }}" class="nav-item nav-link active"><i class="fa fa-user me-3"></i>Admin</a></li>
        <li class="mb-4"><a href="{{ route('all.residents') }}"class="nav-item nav-link"><i class="fa fa-user me-3"></i>Resident</a></li>
        <li style="margin-bottom: 12.6rem;"><a href="{{ route('all.guards') }}" class="nav-item nav-link"><i class="fa fa-user me-3"></i>Security Guard</a></li>

        <li class="nav-item dropup">

            <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hello, {{Auth::guard('admin')->user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
        </li>
        @endauth
    </ul>
    </div>
    </strong>
</div>

<div class="main-content">
    @yield('main-content')
</div>
@endsection
