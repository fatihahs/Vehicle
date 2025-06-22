@extends('layouts.index')
@section('main-content')

<div class="container">

    <div class="pagename">
        <p>Admin Details<p>
    </div>

    <div class="contain">
        @if(Session::has('success'))
            <p class="alert {{Session::get('alert-class', 'alert-success')}}">{{ Session::get('success') }}</p>
        @endif
    </div>

    <div style="display: flex; justify-content: flex-end; right: 20px; gap:10px" class="mb-3">
        <form method="GET" action="{{ route('search.admins') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request()->query('search') }}">
        </form>
        <a  href="{{route('admins.admins')}}" class="btn btn-primary mb-4 text-center float-right">New Admin</a>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($admins as $index => $admin)
                    <tr>
                        <td>{{ ($admins->currentPage() -1)* $admins->perPage() + $index + 1 }}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>
                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-link text-dark p-0 mr-2" title="Edit" data-toggle="tooltip">
                                <i class="fas fa-pen"></i>
                            </a>

                            <button onclick="showConfirm('{{ $admin->id}}', '{{ $admin->name}}')" class="btn btn-link text-dark p-0" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <form id="delete-form-{{ $admin->id}}" action="{{route('admins.destroy', $admin->id)}}" method="POST" style="display:none;">
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
            @for($page =1 ; $page <= $admins -> lastpage(); $page++)
                <li class="page-item {{ $page ==$admins->currentPage()? 'active' : ''}}">
                    <a class="page-link" href="{{$admins->url($page)}}{{request('search')? '&search=' .request('search') : ''}}">{{$page}}</a>
                </li>
            @endfor
        </ul>
    </div>
</div>

<script>
    let currentFormId = '';

    function showConfirm(adminId, adminName){
        currentFormId = 'delete-form-' + adminId;
        document.getElementById('confirmMessage').textContent = `Are you sure to delete admin '${adminName}' ?`;
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
