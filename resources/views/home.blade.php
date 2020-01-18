@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">New Log</button>
        <div class="table-responsive">
            <table class="table display no-wrap" id="logs_table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Staff</th>
                        <th>Project</th>
                        <th>Time Logs</th>
                        {{-- @foreach ($log_types as $log_type)
                        <th>{{ $log_type->title }}</th>
                        @endforeach --}}
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('time-logs.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="entry_date" id="entry_date" value="{{ date('Y-m-d') }}">
                    <div class="form-group row">
                        <label for="project_id" class="col-md-4 col-form-label text-md-right">Project <span style="color: red;">*</span></label>
                        <div class="col-md-6">
                            <select name="project_id" id="project_id" class="form-control" required>
                                <option value="">-Select-</option>
                                @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>
                    @foreach ($log_types as $row)
                    <div class="form-group row">
                        <label for="log_type_{{ $row->id }}" class="col-md-4 col-form-label text-md-right">{{ $row->title }}</label>
                        <div class="col-md-6">
                            <input type="hidden" name="log_types[{{ $row->id }}][time_log_type_id]" id="log_type_id_{{ $row->id }}" value="{{ $row->id }}">
                            <input type="number" name="log_types[{{ $row->id }}][worked_hours]" id="log_type_{{ $row->id }}" step="0.1" min="0" class="form-control">
                        </div>                        
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
<script type="text/javascript">

    $(document).ready(function() {
        init_logs_table();
    });

    function init_logs_table() {
        var logs_table = $('#logs_table').DataTable();
        actionUrl = "{{ url('admin/time-logs/get-logs') }}";
        logs_table.destroy();
        $('#logs_table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: actionUrl,
            },
            columns: [
                /*{data: 'DT_RowIndex', name: 'DT_RowIndex'},*/
                {data: 'date', name: 'date'},
                {data: 'staff_name', name: 'staff_name'},
                {data: 'project', name: 'project'},
                {data: 'time_logs', name: 'time_logs'},
                {data: 'total_hours', name: 'total_hours'},
                {data: 'action', name: 'Action', orderable: false, searchable: false},
            ]
        });
        //$('#filter_modal').modal('hide');
    }
</script>
@endsection
