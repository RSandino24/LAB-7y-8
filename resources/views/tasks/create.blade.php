@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Task</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Titulo</label>
                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control" placeholder="Title"
                                    value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="priority" class="col-md-4 col-form-label text-md-end">Prioridad</label>
                            <div class="col-md-6">
                                <select name="priority" class="form-control">
                                    <option value="baja" {{ old('priority') == 'baja' ? 'selected' : '' }}>Baja</option>
                                    <option value="media" {{ old('priority') == 'media' ? 'selected' : '' }}>Media
                                    </option>
                                    <option value="alta" {{ old('priority') == 'alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tags" class="col-md-4 col-form-label text-md-end">Etiquetas</label>
                            <div class="col-md-6">
                                <select name="tags[]" id="tags" class="form-control" multiple>
                                    @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear
                                </button>
                                <a class="btn btn-secondary" href="{{ route('tasks.index') }}">Regresar</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#tags').select2();
});
</script>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
