@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="mt-3">Tareas</h2>
            <a class="btn btn-success mt-3" href="{{ route('tasks.create') }}">Crear nueva tarea</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success mt-3">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Prioridad</th>
                <th>Completada</th>
                <th>Usuario</th>
                <th>Etiquetas</th>
                <th>Configuraciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>
                    @if ($task->priority == 'baja')
                        <span class="badge bg-success text-white">{{ $task->priority }}</span>
                    @elseif ($task->priority == 'media')
                        <span class="badge bg-warning text-dark">{{ $task->priority }}</span>
                    @elseif ($task->priority == 'alta')
                        <span class="badge bg-danger text-white">{{ $task->priority }}</span>
                    @endif
                </td>
                <td>
                    @if ($task->completed)
                        <span class="badge bg-success">Completada</span>
                    @else
                        <span class="badge bg-danger">Pendiente</span>
                    @endif
                </td>
                <td>{{ $task->user->name ?? 'No asignado' }}</td>
                <td>
                    @if($task->tags->isNotEmpty())
                        @foreach($task->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag->name }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Sin etiquetas</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">Completar</button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('tasks.edit', $task->id) }}">Editar</a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
