@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Task</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Title:</strong></div>
                        <div class="col-md-6">{{ $task->title }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Priority:</strong></div>
                        <div class="col-md-6">{{ $task->priority }}</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <a class="btn btn-secondary" href="{{ route('tasks.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
