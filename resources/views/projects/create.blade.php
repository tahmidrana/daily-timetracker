@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page">New Project</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">New Project Create Form</div>

            <div class="card-body">
                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Project Name') }} <span style="color: red;">*</span></label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Client Name') }} <span style="color: red;">*</span></label>
                        <div class="col-md-6">
                            <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" required autocomplete="client">
                            @error('client')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="starting_date" class="col-md-4 col-form-label text-md-right">{{ __('Starting Date') }} <span style="color: red;">*</span></label>
                        <div class="col-md-6">
                            <input id="starting_date" type="date" class="form-control @error('starting_date') is-invalid @enderror" name="starting_date" value="{{ old('starting_date') }}" required autocomplete="starting_date">
                            @error('starting_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ending_date" class="col-md-4 col-form-label text-md-right">{{ __('Ending Date') }}</label>
                        <div class="col-md-6">
                            <input id="ending_date" type="date" class="form-control @error('ending_date') is-invalid @enderror" name="ending_date" value="{{ old('ending_date') }}" autocomplete="ending_date">
                            @error('ending_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }} <span style="color: red;">*</span></label>
                        <div class="col-md-6">
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Upcoming</option>
                                <option value="2">Running</option>
                                <option value="3">Completed</option>
                                <option value="4">On Hold</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="users" class="col-md-4 col-form-label text-md-right">{{ __('Team Members') }} <span style="color: red;">*</span></label>
                        <div class="col-md-6">
                            <select name="users[]" id="users" class="form-control" multiple="multiple" required>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name_designation }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
