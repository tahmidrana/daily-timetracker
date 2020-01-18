@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Projects</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('projects.create') }}" class="btn btn-success mb-4" >New Project</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Client</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Team</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->client }}</td>
                        <td>{{ Carbon\Carbon::parse($project->starting_date)->diffForHumans() }}</td>
                        <td>{{ $project->ending_date ? Carbon\Carbon::parse($project->ending_date)->format('d M Y') : 'N/A' }}</td>
                        <td>{!! implode(',<br>', $project->staffs->pluck('name')->toArray()) !!}</td>
                        <td>
                            @if($project->status == 1) 
                            <span class="text-black-50">Upcomming</span>
                            @elseif($project->status == 2)
                            <span class="text-primary">Running</span>
                            @elseif($project->status == 3)
                            <span class="text-success">Completed</span>
                            @elseif($project->status == 4)
                            <span class="text-danger">On Hold</span>
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteProject({{ $project->id }});">Delete</a>
                            <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: none;">
                                @method('delete')
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@section('scripts')
    <script type="text/javascript">
        function deleteProject(id)
        {
            if(confirm('Are you sure want to delete?')) {
                document.getElementById('delete-form-'+id).submit();
            }
        }
    </script>
@endsection