@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Task</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>¡Vaya!</strong> Hubo algunos problemas con su entrada.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Título</label>

                            <div class="col-md-6">
                                <input type="text" name="title" value="{{ old('title', $task->title) }}" class="form-control" placeholder="Title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="priority" class="col-md-4 col-form-label text-md-end">Prioridad</label>

                            <div class="col-md-6">
                                <select name="priority" class="form-control">
                                    <option value="baja" @if(old('priority', $task->priority) == 'baja') selected @endif>Baja</option>
                                    <option value="media" @if(old('priority', $task->priority) == 'media') selected @endif>Media</option>
                                    <option value="alta" @if(old('priority', $task->priority) == 'alta') selected @endif>Alta</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="completed" class="col-md-4 col-form-label text-md-end">Completado</label>

                            <div class="col-md-6">
                                <select name="completed" class="form-control">
                                    <option value="0" @if(old('completed', $task->completed) == '0') selected @endif>Pendiente</option>
                                    <option value="1" @if(old('completed', $task->completed) == '1') selected @endif>Completada</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre Usuario</label>

                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tags" class="col-md-4 col-form-label text-md-end">Etiquetas</label>

                            <div class="col-md-6">
                                <select name="tags[]" class="form-control" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" @if(in_array($tag->id, old('tags', $task->tags->pluck('id')->toArray()))) selected @endif>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
