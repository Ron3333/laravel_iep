@extends('dashboard.layout')

@section('content')
    <h1>{{ $user->name }}</h1>
    <ul>
        <li>{{ $user->email }}</li>
    </ul>   
     <!-- <x-dashboard.user.role.permission.manage :user="$user" /> -->

     {{-- Solo mostrar la gestión de roles/permisos si el usuario tiene permiso de actualizar --}}
    @can('editor.user.update')
        <x-dashboard.user.role.permission.manage :user="$user" />
    @endcan
@endsection
