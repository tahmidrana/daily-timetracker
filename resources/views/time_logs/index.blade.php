@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Time Logs</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm mr-2 mb-4" >New Staff</a>
        <a href="" class="btn btn-success btn-sm mb-4" >Time Log Types</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
