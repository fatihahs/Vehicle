@extends('layouts.index')
@section('main-content')
<div class="pagename">
    <p>Security Guards Details<p>
</div>



<div class="row">
    <div class="card-body">
        <div class="container">
            @if(Session::has('success'))
                <p class="alert {{Session::get('alert-class', 'alert-success')}}">{{ Session::get('success') }}</p>
            @endif
        </div>

        <div style="display: flex; justify-content: flex-end; right: 20px; gap:10px" class="mb-3">
            <form method="GET" action="{{ route('search.guards') }}">
                <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request()->query('search') }}">
            </form>

            <a  href="{{route('guards.create')}}" class="btn btn-primary mb-4 mr-3 text-center float-right">New Security Guard</a>
        </div>

        <div class="container mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($guards as $index => $guard)
                        <tr>
                        <td>{{ ($guards->currentPage() -1)* $guards->perPage() + $index + 1 }}</td>
                            <td>{{ $guard->name }}</td>
                            <td>{{ $guard->phone }}</td>
                            <td>{{ $guard->email }}</td>
                            <td>
                                <a href="{{ route('guards.edit', $guard->id) }}" class="btn btn-link text-dark p-0 mr-2" title="Edit" data-toggle="tooltip">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <button onclick="showConfirm('{{ $guard->id}}', '{{ $guard->name}}')" class="btn btn-link text-dark p-0" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <form id="delete-form-{{ $guard->id}}" action="{{route('guards.destroy', $guard->id)}}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                     @endforeach
                </tbody>
            </table>

            <div id="confirmModal" class="modal-overlay">
                <div class="modal-box">
                    <p id="confirmMessage" class="modal-text"></p>
                    <button onclick="submitDelete()" class="btn-confirm">Confirm Delete</button>
                    <button onclick="hideConfirm()" class="btn-cancel">Cancel</button>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <ul class="pagination justify-content-center">
                @for($page =1 ; $page <= $guards -> lastpage(); $page++)
                    <li class="page-item {{ $page ==$guards->currentPage()? 'active' : ''}}">
                        <a class="page-link" href="{{$guards->url($page)}}{{request('search')? '&search=' .request('search') : ''}}">{{$page}}</a>
                    </li>
               @endfor
            </ul>
        </div>
    </div>
</div>

<script>
    let currentFormId = '';

    function showConfirm(guardId, guardName){
        currentFormId = 'delete-form-' + guardId;
        document.getElementById('confirmMessage').textContent = `Are you sure to delete guard '${guardName}' ?`;
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function hideConfirm(){
        document.getElementById('confirmModal').style.display = 'none';
    }

    function submitDelete(){
        document.getElementById(currentFormId).submit();
    }
</script>
@endsection
