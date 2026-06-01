@extends('dashboard.layout')

@section('content')
    {{-- Botón Crear - Solo visible si tiene permiso --}}
    @can('editor.category.create')
        <a class="my-2 btn btn-success" href="{{ route('category.create') }}">Crear</a>
    @endcan

    <table class="table mb-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->title }}</td>
                    <td>
                        {{-- Botón Editar - Solo visible si tiene permiso --}}
                        @can('editor.category.update')
                            <a class="btn btn-primary mt-2" href="{{ route('category.edit', $c) }}">Editar</a>
                        @endcan

                        {{-- Botón Ver - Visible para todos --}}
                        <a class="btn btn-primary mt-2" href="{{ route('category.show', $c) }}">Ver</a>

                        {{-- Botón Eliminar - Solo visible si tiene permiso --}}
                        @can('editor.category.destroy')
                            <form action="{{ route('category.destroy', $c) }}" method="post" style="display:inline-block;">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger mt-2" type="submit">Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
@endsection