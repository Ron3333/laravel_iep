@extends('dashboard.layout')

@section('content')
    {{-- Botón Crear - Solo visible si tiene permiso --}}
    @can('editor.post.create')
        <a class="btn btn-success my-3" href="{{ route('post.create') }}">Crear</a>
    @endcan

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Category</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->category->title ?? 'Sin categoría' }}</td>
                    <td>
                        {{-- Botón Editar - Solo visible si tiene permiso --}}
                        @can('editor.post.update')
                            <a class="mt-2 btn btn-primary" href="{{ route('post.edit', $p) }}">Editar</a>
                        @endcan

                        {{-- Botón Ver - Visible para todos los que pueden ver el índice --}}
                        <a class="mt-2 btn btn-primary" href="{{ route('post.show', $p) }}">Ver</a>

                        {{-- Botón Eliminar - Solo visible si tiene permiso --}}
                        @can('editor.post.destroy')
                            <form action="{{ route('post.destroy', $p) }}" method="post" style="display:inline-block;">
                                @method('DELETE')
                                @csrf
                                <button class="mt-2 btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection