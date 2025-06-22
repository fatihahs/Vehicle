@extends('layouts.index')
@section('main-content')


<div class="container">

    <div class="pagename">
        <p>Residents Details<p>
    </div>


    <div class="contain">
        @if(Session::has('success'))
            <p class="alert {{Session::get('alert-class', 'alert-success')}}">{{ Session::get('success') }}</p>
        @endif
    </div>

    <div style="display: flex; justify-content: flex-end; right: 20px; gap:10px" class="mb-3">
        <form method="GET" action="{{ route('search.register.resident') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request()->query('search') }}">
        </form>

        <a href="{{ route('admins.residents') }}" class="btn btn-primary mb-4 text-center float-right">New Resident</a>
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
                        <td>{{ ($residents->currentPage() -1)* $residents->perPage() + $index + 1 }}</td>
                        <td>{{ $resident->TagID }}</td>
                        <td>{{ $resident->Name }}</td>
                        <td>{{ $resident->PlateNo }}</td>
                        <td>{{ $resident->Phone }}</td>
                        <td>{{ $resident->Address }}</td>
                        <td>
                            <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-link text-dark p-0 mr-2" title="Edit" data-toggle="tooltip">
                                <i class="fas fa-pen"></i>
                            </a>

                            <button onclick="showConfirm('{{ $resident->id}}', '{{ $resident->Name}}')" class="btn btn-link text-dark p-0" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <form id="delete-form-{{ $resident->id}}" action="{{route('residents.destroy', $resident->id)}}" method="POST" style="display:none;">
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
                @for($page =1 ; $page <= $residents -> lastpage(); $page++)
                    <li class="page-item {{ $page ==$residents->currentPage()? 'active' : ''}}">
                        <a class="page-link" href="{{$residents->url($page)}}{{request('search')? '&search=' .request('search') : ''}}">{{$page}}</a>
                    </li>
               @endfor
            </ul>
        </div>
</div>

<script>
    let currentFormId = '';

    function showConfirm(residentId, residentName){
        currentFormId = 'delete-form-' + residentId;
        document.getElementById('confirmMessage').textContent = `Are you sure to delete resident '${residentName}' ?`;
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
