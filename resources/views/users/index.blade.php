@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Staffs</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('users.create') }}" class="btn btn-success mb-4" >New Staff</a>
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
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->userid }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->designation }}</td>
                        <td>{{ implode(', ', $user->roles->pluck('title')->toArray()) }}</td>
                        <td>{!! $user->is_active ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' !!}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
