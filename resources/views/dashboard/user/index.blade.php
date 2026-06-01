@extends('dashboard.layout')

@section('content')
    {{-- Botón Crear - Solo visible si tiene permiso --}}
    @can('editor.user.create')
        <a class="my-2 btn btn-success" href="{{ route('user.create') }}">Create</a>
    @endcan

    <table class="table mb-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        {{-- Botón Editar - Solo visible si tiene permiso --}}
                        @can('editor.user.update')
                            <a class="btn btn-primary mt-2" href="{{ route('user.edit', $u) }}">Edit</a>
                        @endcan

                        {{-- Botón Ver - Siempre visible --}}
                        <a class="btn btn-primary mt-2" href="{{ route('user.show', $u) }}">Show</a>

                        {{-- Botón Eliminar - Solo visible si tiene permiso --}}
                        @can('editor.user.destroy')
                            <form action="{{ route('user.destroy', $u) }}" method="post" style="display:inline-block;">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger mt-2" type="submit">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection