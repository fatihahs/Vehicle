@extends('layouts.index')
@section('main-content')

<div class="pagename">
    <p>Dashboard<p>
</div>

<div class="row">
    <div class="col-md-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Admin</h5>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
        <p class="card-text">number of admin: {{$adminCount}}</p>

        </div>
    </div>
    </div>
    <div class="col-md-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Resident</h5>

        <p class="card-text">number of resident: {{$residentCount}}</p>

        </div>
    </div>
    </div>
    <div class="col-md-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Security Guard</h5>

        <p class="card-text">number of security guard: {{$guardCount}}</p>

        </div>
    </div>
    </div>
</div>
@endsection
